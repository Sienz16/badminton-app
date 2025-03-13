<?php

namespace App\Livewire\Matches;

use Livewire\Component;
use App\Models\GameMatch;
use Illuminate\Support\Facades\DB;

class Scoring extends Component
{
    public GameMatch $match;
    public int $player1Score = 0;
    public int $player2Score = 0;
    public bool $showWinnerModal = false;
    public ?string $winnerId = null;

    public function mount(GameMatch $match)
    {
        $this->match = $match;
        if ($this->match->score) {
            [$this->player1Score, $this->player2Score] = explode('-', $this->match->score);
        }
    }

    public function startMatch()
    {
        if ($this->match->isScheduled()) {
            $this->match->status = 'in_progress';
            $this->match->played_at = now();
            $this->match->save();
            
            $this->dispatch('match-started');
        }
    }

    public function incrementScore($player)
    {
        if (!$this->match->isLive()) return;

        if ($player === 1) {
            $this->player1Score++;
        } else {
            $this->player2Score++;
        }

        $this->updateScore();
    }

    public function decrementScore($player)
    {
        if (!$this->match->isLive()) return;

        if ($player === 1 && $this->player1Score > 0) {
            $this->player1Score--;
        } elseif ($player === 2 && $this->player2Score > 0) {
            $this->player2Score--;
        }

        $this->updateScore();
    }

    private function updateScore()
    {
        $this->match->score = "{$this->player1Score}-{$this->player2Score}";
        $this->match->save();
        $this->dispatch('score-updated');
    }

    public function render()
    {
        return view('livewire.matches.scoring');
    }
}