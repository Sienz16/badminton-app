<?php

namespace App\Livewire\Admin\Tournaments;

use App\Models\User;
use App\Models\Venue;
use App\Models\GameMatch;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Create extends Component
{
    public $player1Id = '';
    public $player2Id = '';
    public $venueId = '';
    public $courtNumber = '';
    public $date = '';
    public $startTime = '';
    public $endTime = '';
    public $umpireId = '';

    public function createMatch()
    {
        $this->validate([
            'player1Id' => 'required|exists:users,id',
            'player2Id' => 'required|exists:users,id|different:player1Id',
            'venueId' => 'required|exists:venues,id',
            'courtNumber' => 'required|integer|min:1',
            'date' => 'required|date|after_or_equal:today',
            'startTime' => 'required',
            'endTime' => 'required|after:startTime',
            'umpireId' => 'required|exists:users,id|different:player1Id|different:player2Id',
        ]);

        DB::transaction(function () {
            $match = new GameMatch();
            $match->player1_id = $this->player1Id;
            $match->player2_id = $this->player2Id;
            $match->venue_id = $this->venueId;
            $match->court_number = $this->courtNumber;
            $match->scheduled_at = $this->date . ' ' . $this->startTime;
            $match->played_at = $this->date . ' ' . $this->endTime;
            $match->umpire_id = $this->umpireId;
            $match->status = 'scheduled';
            $match->save();
        });

        $this->dispatch('match-created');
        $this->dispatch('close-modal');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.tournaments.create', [
            'players' => User::role('player')->orderBy('name')->get(),
            'venues' => Venue::orderBy('name')->get(),
            'umpires' => User::role('umpire')->orderBy('name')->get(),
        ]);
    }
}