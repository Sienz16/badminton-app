<?php

namespace App\Livewire\Matches;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\GameMatch;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.app')]
#[Title('Match Details')]
class Show extends Component
{
    public GameMatch $match;
    public int $player1Score = 0;
    public int $player2Score = 0;
    public bool $showWinnerModal = false;
    public ?string $winnerId = null;

    public function mount(GameMatch $match)
    {
        $this->match = $match;
        if ($match->score) {
            [$p1Score, $p2Score] = explode('-', $match->score);
            $this->player1Score = (int) $p1Score;
            $this->player2Score = (int) $p2Score;
        }
    }

    public function incrementScore($player)
    {
        if (!$this->match->isLive()) {
            return;
        }

        if ($player === 1 && $this->player1Score < 30) {
            $this->player1Score++;
        } elseif ($player === 2 && $this->player2Score < 30) {
            $this->player2Score++;
        }

        $this->match->score = "{$this->player1Score}-{$this->player2Score}";
        $this->match->save();
    }

    public function decrementScore($player)
    {
        if (!$this->match->isLive()) {
            return;
        }

        if ($player === 1 && $this->player1Score > 0) {
            $this->player1Score--;
        } elseif ($player === 2 && $this->player2Score > 0) {
            $this->player2Score--;
        }

        $this->match->score = "{$this->player1Score}-{$this->player2Score}";
        $this->match->save();
    }

    public function startMatch()
    {
        if ($this->match->isScheduled() && Auth::user()->id === $this->match->umpire_id) {
            $this->match->status = 'in_progress';
            $this->match->save();
        }
    }

    public function setWinner()
    {
        if (!$this->winnerId || !$this->match->isLive()) {
            return;
        }

        $this->match->status = 'completed';
        $this->match->played_at = now();
        $this->match->save();

        $this->showWinnerModal = false;
        $this->redirect(route('umpire.matches'));
    }

    public function declareWinner($playerId)
    {
        if (!$this->match->isLive()) {
            return;
        }

        $this->showWinnerModal = true;
        $this->winnerId = $playerId;
    }

    public function render()
    {
        return view('livewire.matches.show');
    }
}
