<?php

namespace App\Livewire\Admin\Tournaments;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\GameMatch;
use App\Models\Venue;
use App\Models\User;
use App\Models\Player;
use App\Models\Umpire;

#[Layout('components.layouts.app')]
#[Title('Match Details')]
class Show extends Component
{
    public GameMatch $match;
    public $selectedVenue = '';
    public $selectedCourt = '';
    public $selectedDate = '';
    public $selectedTime = '';
    public $player1Id = '';
    public $player2Id = '';
    public $umpireId = '';
    
    public function mount(GameMatch $match)
    {
        // Eager load all related data
        // $this->match = $match->load([
        //     'player1',  // This will load both Player and User data
        //     'player2',
        //     'venue',
        //     'umpire',
        //     'court'
        // ]);
        $this->match = $match->load([
            'player1.player',  // This loads the User and their Player profile
            'player2.player',  // This loads the User and their Player profile
            'venue',
            'umpire'
        ]);
    }

    public function updateScore($player, $action)
    {
        if ($this->match->status !== 'in_progress') {
            return;
        }

        $scores = explode('-', $this->match->score ?: '0-0');
        $player1Score = (int)$scores[0];
        $player2Score = (int)$scores[1];

        if ($action === 'increment') {
            if ($player === 1) $player1Score++;
            if ($player === 2) $player2Score++;
        } else {
            if ($player === 1 && $player1Score > 0) $player1Score--;
            if ($player === 2 && $player2Score > 0) $player2Score--;
        }

        $this->match->score = "{$player1Score}-{$player2Score}";
        $this->match->save();
    }

    public function setWinner($winnerId)
    {
        if ($this->match->status !== 'in_progress') {
            return;
        }

        $this->match->status = 'completed';
        $this->match->winner_id = $winnerId;
        $this->match->played_at = now();
        $this->match->save();
    }

    public function render()
    {
        return view('livewire.admin.tournaments.show', [
            'venues' => Venue::all(),
            'players' => User::where('role_id', 'player')->get(),
            // Get all matches for these players
            'playerMatches' => GameMatch::where(function($query) {
                $query->where('player1_id', $this->match->player1_id)
                      ->orWhere('player2_id', $this->match->player1_id)
                      ->orWhere('player1_id', $this->match->player2_id)
                      ->orWhere('player2_id', $this->match->player2_id);
            })->where('status', 'completed')->get()
        ]);
    }
}