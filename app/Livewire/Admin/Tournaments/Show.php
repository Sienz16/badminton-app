<?php

namespace App\Livewire\Admin\Tournaments;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Tournament;
use App\Models\GameMatch;
use App\Models\Venue;
use App\Models\User;

#[Layout('components.layouts.app')]
#[Title('Tournament Details')]
class Show extends Component
{
    public Tournament $tournament;
    public $selectedVenue = '';
    public $selectedCourt = '';
    public $selectedDate = '';
    public $selectedTime = '';
    public $player1Id = '';
    public $player2Id = '';
    public $umpireId = '';
    
    public function mount(Tournament $tournament)
    {
        $this->tournament = $tournament;
    }

    public function createMatch()
    {
        $this->validate([
            'selectedVenue' => 'required|exists:venues,id',
            'selectedCourt' => 'required|numeric',
            'selectedDate' => 'required|date',
            'selectedTime' => 'required',
            'player1Id' => 'required|exists:users,id',
            'player2Id' => 'required|exists:users,id|different:player1Id',
            'umpireId' => 'required|exists:users,id'
        ]);

        $match = new GameMatch();
        $match->tournament_id = $this->tournament->id;
        $match->venue_id = $this->selectedVenue;
        $match->court_number = $this->selectedCourt;
        $match->scheduled_at = $this->selectedDate . ' ' . $this->selectedTime;
        $match->player1_id = $this->player1Id;
        $match->player2_id = $this->player2Id;
        $match->umpire_id = $this->umpireId;
        $match->status = 'scheduled';
        $match->save();

        $this->reset(['selectedVenue', 'selectedCourt', 'selectedDate', 'selectedTime', 
                     'player1Id', 'player2Id', 'umpireId']);
        
        $this->dispatch('match-created');
    }

    public function updateScore($matchId, $player, $action)
    {
        $match = GameMatch::findOrFail($matchId);
        
        if ($match->status !== 'in_progress') {
            return;
        }

        $scores = explode('-', $match->score ?: '0-0');
        $player1Score = (int)$scores[0];
        $player2Score = (int)$scores[1];

        if ($action === 'increment') {
            if ($player === 1) $player1Score++;
            if ($player === 2) $player2Score++;
        } else {
            if ($player === 1 && $player1Score > 0) $player1Score--;
            if ($player === 2 && $player2Score > 0) $player2Score--;
        }

        $match->score = "{$player1Score}-{$player2Score}";
        $match->save();
    }

    public function setWinner($matchId, $winnerId)
    {
        $match = GameMatch::findOrFail($matchId);
        
        if ($match->status !== 'in_progress') {
            return;
        }

        $match->status = 'completed';
        $match->winner_id = $winnerId;
        $match->played_at = now();
        $match->save();
    }

    public function render()
    {
        return view('livewire.admin.tournaments.show', [
            'venues' => Venue::all(),
            'players' => User::where('role_id', 'player')->get(),
            'umpires' => User::where('role_id', 'umpire')->get(),
            'matches' => $this->tournament->matches()
                ->with(['player1', 'player2', 'umpire', 'venue'])
                ->get()
        ]);
    }
}