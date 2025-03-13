<?php

namespace App\Livewire\Umpire\Matches;

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
    
    // Add these properties for scoring modal
    public bool $showScoringModal = false;
    public bool $isMatchLive = false;
    public string $elapsedTime = '00:00';
    public array $scoreHistory = [];
    public ?string $lastPointTime = null;

    public function mount(GameMatch $match)
    {
        $this->match = $match;
        if ($this->match->score) {
            [$this->player1Score, $this->player2Score] = explode('-', $this->match->score);
        }
        $this->scoreHistory = $this->match->scoreHistory()->orderBy('created_at', 'desc')->get()->toArray();
    }

    public function startMatch()
    {
        $this->isMatchLive = true;
        $this->match->status = 'live';
        $this->match->save();
    }

    public function pauseMatch()
    {
        $this->isMatchLive = false;
        $this->match->status = 'paused';
        $this->match->save();
    }

    public function incrementScore(int $playerNumber)
    {
        if (!$this->isMatchLive) {
            return;
        }

        if ($playerNumber === 1) {
            $this->player1Score++;
        } else {
            $this->player2Score++;
        }

        $this->saveScore();
    }

    public function decrementScore(int $playerNumber)
    {
        if (!$this->isMatchLive) {
            return;
        }

        if ($playerNumber === 1 && $this->player1Score > 0) {
            $this->player1Score--;
        } elseif ($playerNumber === 2 && $this->player2Score > 0) {
            $this->player2Score--;
        }

        $this->saveScore();
    }

    public function undoLastPoint()
    {
        $lastScore = $this->match->scoreHistory()->latest()->first();
        if ($lastScore) {
            $this->player1Score = $lastScore->player1_score;
            $this->player2Score = $lastScore->player2_score;
            $lastScore->delete();
            $this->scoreHistory = $this->match->scoreHistory()->orderBy('created_at', 'desc')->get()->toArray();
        }
    }

    private function saveScore()
    {
        $this->match->score = "{$this->player1Score}-{$this->player2Score}";
        $this->match->save();

        $this->match->scoreHistory()->create([
            'player1_score' => $this->player1Score,
            'player2_score' => $this->player2Score,
        ]);

        $this->lastPointTime = now()->format('H:i:s');
        $this->scoreHistory = $this->match->scoreHistory()->orderBy('created_at', 'desc')->get()->toArray();
    }

    public function declareWinner($playerId)
    {
        if (!$this->match->isLive()) {
            return;
        }

        $this->showWinnerModal = true;
        $this->winnerId = $playerId;
    }

    public function setWinner()
    {
        if (!$this->winnerId || !$this->match->isLive()) {
            return;
        }

        $this->match->status = 'completed';
        $this->match->played_at = now();
        $this->match->winner_id = $this->winnerId;
        $this->match->save();

        $this->showWinnerModal = false;
        $this->redirect(route('umpire.matches'));
    }

    public function render()
    {
        return view('livewire.umpire.matches.show');
    }
}