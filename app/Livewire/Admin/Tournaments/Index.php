<?php

namespace App\Livewire\Admin\Tournaments;

use App\Models\User;
use App\Models\Venue;
use App\Models\Court;
use App\Models\GameMatch;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    public $player1Id = '';
    public $player2Id = '';
    public $venueId = '';
    public $courtNumber = '';
    public $date = '';
    public $startTime = '';
    public $umpireId = '';
    
    public $availableCourts = [];
    public $venues = [];
    public $players = [];
    public $umpires = [];

    public function mount()
    {
        $this->venues = Venue::all();
        $this->players = User::where('role_id', 'player')->get();
        $this->umpires = User::where('role_id', 'umpire')->get();
    }

    public function updatedVenueId()
    {
        $this->updateAvailableCourts();
    }

    public function updatedDate()
    {
        $this->updateAvailableCourts();
    }

    public function updatedStartTime()
    {
        $this->updateAvailableCourts();
    }

    protected function updateAvailableCourts()
    {
        $this->reset('courtNumber', 'availableCourts');

        if (!$this->venueId) {
            return;
        }

        $allCourts = Court::where('venue_id', $this->venueId)
            ->orderBy('number')

        $matches = GameMatch::with(['player1', 'player2', 'venue'])
            ->orderBy('scheduled_at', 'asc')
            ->get();

        $this->availableCourts = [];

        foreach ($allCourts as $court) {
            if ($this->date && $this->startTime) {
                $hasConflict = Court::where('venue_id', $this->venueId)
                    ->where('number', $court->number)
                    ->where('schedule_date', $this->date)
                    ->where('start_time', $this->startTime)
                    ->exists();

                if (!$hasConflict) {
                    $this->availableCourts[] = $court->number;
                }
            } else {
                $this->availableCourts[] = $court->number;
            }
        }
    }

    public function createMatch()
    {
        $this->validate([
            'player1Id' => 'required|exists:users,id',
            'player2Id' => 'required|exists:users,id|different:player1Id',
            'venueId' => 'required|exists:venues,id',
            'courtNumber' => 'required|integer|min:1',
            'date' => 'required|date|after_or_equal:today',
            'startTime' => 'required',
            'umpireId' => 'required|exists:users,id|different:player1Id|different:player2Id',
        ]);

        // Check if court is available for the requested date and time
        $court = Court::where('venue_id', $this->venueId)
            ->where('number', $this->courtNumber)
            ->first();

        if (!$court->isAvailable($this->date)) {
            $this->addError('courtNumber', 'This court is not available for the selected date and time.');
            return;
        }

        DB::transaction(function () use ($court) {
            $match = new GameMatch();
            $match->player1_id = $this->player1Id;
            $match->player2_id = $this->player2Id;
            $match->venue_id = $this->venueId;
            $match->court_number = $this->courtNumber;
            $match->scheduled_at = $this->date . ' ' . $this->startTime;
            $match->umpire_id = $this->umpireId;
            $match->status = 'scheduled';
            $match->save();

            $court->update([
                'match_id' => $match->id,
                'schedule_date' => $this->date,
                'start_time' => $this->startTime,
                'end_time' => $this->endTime
            ]);
        });

        $this->dispatch('match-created');
        $this->js("document.querySelector('[data-modal=\"create-match-modal\"]').close()");
        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.tournaments.index', [
            'matches' => GameMatch::with(['player1', 'player2', 'venue'])
                ->orderBy('scheduled_at', 'desc')
                ->get(),
            'venues' => $this->venues,
            'players' => $this->players,
            'umpires' => $this->umpires,
        ]);
    }
}
