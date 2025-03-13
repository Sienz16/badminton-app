<?php

namespace App\Livewire\Admin\Tournaments;

use App\Models\User;
use App\Models\Venue;
use App\Models\Court;
use App\Models\GameMatch;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

    public function updatedVenueId($value)
    {
        if ($value) {
            $this->updateAvailableCourts();
        } else {
            $this->availableCourts = [];
        }
    }

    public function updatedDate($value)
    {
        if ($value) {
            $this->updateAvailableCourts();
        }
    }

    public function updatedStartTime($value)
    {
        if ($value) {
            $this->updateAvailableCourts();
        }
    }

    private function updateAvailableCourts()
    {
        $this->availableCourts = [];
        
        if (!$this->venueId || !$this->date || !$this->startTime) {
            return;
        }

        // Get all courts for the selected venue
        $courts = Court::where('venue_id', $this->venueId)->get();
        
        $startDateTime = Carbon::parse($this->date . ' ' . $this->startTime);
        $endDateTime = $startDateTime->copy()->addHour();

        // Get booked courts for the selected date/time range
        $bookedCourts = GameMatch::where('venue_id', $this->venueId)
            ->where(function($query) use ($startDateTime, $endDateTime) {
                $query->where(function($q) use ($startDateTime, $endDateTime) {
                    $q->whereIn('status', ['scheduled', 'in_progress'])
                      ->where(function($q) use ($startDateTime, $endDateTime) {
                          // Check if the new match time overlaps with existing matches
                          $q->where(function($q) use ($startDateTime, $endDateTime) {
                              $q->where('scheduled_at', '<', $endDateTime)
                                ->where(DB::raw('DATE_ADD(scheduled_at, INTERVAL 1 HOUR)'), '>', $startDateTime);
                          });
                      });
                });
            })
            ->pluck('court_number')
            ->toArray();

        // Filter available courts
        foreach ($courts as $court) {
            if (!in_array($court->number, $bookedCourts) && 
                $court->status !== 'maintenance') {
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

        $startDateTime = $this->date . ' ' . $this->startTime;
        $endDateTime = date('Y-m-d H:i:s', strtotime($startDateTime . ' +1 hour'));

        // Check if court is available
        $court = Court::where('venue_id', $this->venueId)
            ->where('number', $this->courtNumber)
            ->first();

        if (!$court || $court->status === 'maintenance') {
            $this->addError('courtNumber', 'This court is not available.');
            return;
        }

        // Check for any overlapping matches that are scheduled or in progress
        $existingMatch = GameMatch::where('venue_id', $this->venueId)
            ->where('court_number', $this->courtNumber)
            ->whereIn('status', ['scheduled', 'in_progress'])
            ->where(function($query) use ($startDateTime, $endDateTime) {
                $query->where(function($q) use ($startDateTime, $endDateTime) {
                    $q->where('scheduled_at', '>=', $startDateTime)
                      ->where('scheduled_at', '<', $endDateTime);
                });
            })
            ->exists();

        if ($existingMatch) {
            $this->addError('courtNumber', 'This court has an overlapping match scheduled.');
            return;
        }

        DB::transaction(function () use ($court, $startDateTime) {
            $match = new GameMatch();
            $match->player1_id = $this->player1Id;
            $match->player2_id = $this->player2Id;
            $match->venue_id = $this->venueId;
            $match->court_number = $this->courtNumber;
            $match->scheduled_at = $startDateTime;
            $match->umpire_id = $this->umpireId;
            $match->status = 'scheduled';
            $match->save();

            $court->update([
                'match_id' => $match->id,
                'schedule_date' => $this->date,
                'start_time' => $this->startTime,
                'end_time' => date('H:i:s', strtotime($startDateTime . ' +1 hour'))
            ]);
        });

        $this->dispatch('match-created');
        $this->js("document.querySelector('[data-modal=\"create-match-modal\"]').close()");
        
        // Reset only the form fields, not the loaded data
        $this->resetForm();
    }

    // Add new method to reset only form fields
    private function resetForm()
    {
        $this->player1Id = '';
        $this->player2Id = '';
        $this->venueId = '';
        $this->courtNumber = '';
        $this->date = '';
        $this->startTime = '';
        $this->umpireId = '';
        $this->availableCourts = [];
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

