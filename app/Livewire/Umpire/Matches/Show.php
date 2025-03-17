<?php

namespace App\Livewire\Umpire\Matches;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\GameMatch;
use App\Models\Venue;
use App\Models\User;
use App\Models\Player;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
    public $showScoringModal = false;
    public $player1Score = 0;
    public $player2Score = 0;
    public $winnerId = null;
    public bool $isMatchLive = false;
    public string $elapsedTime = '00:00';
    public ?string $lastPointTime = null;
    public int $currentSet = 1;
    public array $sets = [
        1 => ['player1' => 0, 'player2' => 0],
        2 => ['player1' => 0, 'player2' => 0],
        3 => ['player1' => 0, 'player2' => 0],
    ];
    public bool $canDeclareWinner = false;
    public $matchWinner = null;
    public bool $currentSetCompleted = false;
    public bool $showNextSetButton = false;
    public $matchStatus;

    // Add this to make the status accessible
    public function getMatchStatusProperty()
    {
        return $this->match->status;
    }


    public function mount(GameMatch $match)
    {
        $this->match = $match;
        $this->matchStatus = $match->status;

        $this->match = $match->load([
            'player1.player',
            'player2.player',
            'venue',
            'umpireUser',
            'umpire',
            'court'
        ]);

        // if ($this->match->umpire_id) {
        //     $this->umpireId = $this->match->umpire_id;
        // }

        // Load existing scores from match_sets
        $matchSets = DB::table('match_sets')
            ->where('match_id', $this->match->id)
            ->orderBy('set_number')
            ->get();

        // Reset sets array first
        $this->sets = [
            1 => ['player1' => 0, 'player2' => 0],
            2 => ['player1' => 0, 'player2' => 0],
            3 => ['player1' => 0, 'player2' => 0],
        ];

        // Determine the current set
        $this->currentSet = 1; // Default to 1
        $lastCompletedSet = null;

        // Load scores from database
        foreach ($matchSets as $set) {
            if ($set->set_number <= 3) { // Ensure we don't exceed max sets
                $this->sets[$set->set_number]['player1'] = $set->player1_score;
                $this->sets[$set->set_number]['player2'] = $set->player2_score;
                
                if ($set->winner_id) {
                    $lastCompletedSet = $set->set_number;
                }
            }
        }

        // If we found a completed set, set current set to the next one
        if ($lastCompletedSet) {
            $this->currentSet = min($lastCompletedSet + 1, 3); // Ensure we don't exceed 3
        }

        // Update the initial scores to show only current set scores
        $this->player1Score = $this->sets[$this->currentSet]['player1'];
        $this->player2Score = $this->sets[$this->currentSet]['player2'];

        $this->isMatchLive = $this->match->status === 'in_progress';
        $this->updateCanDeclareWinner();
    }

    public function openScoringModal()
    {
        if ($this->match->isScheduled()) {
            // Start the match when opening scoring modal for the first time
            $this->match->status = 'in_progress';
            $this->match->played_at = now();
            $this->match->save();
        }
        
        $this->showScoringModal = true;
    }

    public function incrementScore($player)
    {
        // Only check for matchWinner, remove currentSetCompleted check
        if ($this->matchWinner) {
            return;
        }

        $p1Score = $this->sets[$this->currentSet]['player1'];
        $p2Score = $this->sets[$this->currentSet]['player2'];

        // Check if we should allow more points
        $canAddMorePoints = !($this->shouldDisableScoring($p1Score, $p2Score));

        if (!$canAddMorePoints) {
            return;
        }

        if ($player === 1) {
            $this->sets[$this->currentSet]['player1']++;
            // Update player1Score to show only current set score
            $this->player1Score = $this->sets[$this->currentSet]['player1'];
        } else {
            $this->sets[$this->currentSet]['player2']++;
            // Update player2Score to show only current set score
            $this->player2Score = $this->sets[$this->currentSet]['player2'];
        }

        $this->updateSetScore();
    }

    public function decrementScore($player)
    {
        if ($this->matchWinner) {
            return;
        }

        if ($player === 1 && $this->sets[$this->currentSet]['player1'] > 0) {
            $this->sets[$this->currentSet]['player1']--;
            // Update player1Score to show only current set score
            $this->player1Score = $this->sets[$this->currentSet]['player1'];
        } elseif ($player === 2 && $this->sets[$this->currentSet]['player2'] > 0) {
            $this->sets[$this->currentSet]['player2']--;
            // Update player2Score to show only current set score
            $this->player2Score = $this->sets[$this->currentSet]['player2'];
        }

        $this->updateSetScore();
    }

    private function updateSetScore()
    {
        // Update or create record in match_sets table
        $matchSet = DB::table('match_sets')
            ->where('match_id', $this->match->id)
            ->where('set_number', $this->currentSet)
            ->first();

        if ($matchSet) {
            DB::table('match_sets')
                ->where('match_id', $this->match->id)
                ->where('set_number', $this->currentSet)
                ->update([
                    'player1_score' => $this->sets[$this->currentSet]['player1'],
                    'player2_score' => $this->sets[$this->currentSet]['player2'],
                    'updated_at' => now(),
                ]);
        } else {
            DB::table('match_sets')->insert([
                'match_id' => $this->match->id,
                'set_number' => $this->currentSet,
                'player1_score' => $this->sets[$this->currentSet]['player1'],
                'player2_score' => $this->sets[$this->currentSet]['player2'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    private function checkSetWinner()
    {
        $p1Score = $this->sets[$this->currentSet]['player1'];
        $p2Score = $this->sets[$this->currentSet]['player2'];

        // Standard win condition: First to 21 points with at least 2-point lead
        if (($p1Score >= 21 && $p1Score - $p2Score >= 2) || 
            ($p2Score >= 21 && $p2Score - $p1Score >= 2) ||
            $p1Score >= 30 || $p2Score >= 30) {
            $this->currentSetCompleted = true;
        }
        // Deuce situation is handled automatically by the above conditions
    }

    public function startNextSet()
    {
        if (!$this->currentSetCompleted) {
            return;
        }

        $this->currentSet++;
        $this->currentSetCompleted = false;
        $this->showNextSetButton = false;

        // Initialize the new set if it doesn't exist
        if (!isset($this->sets[$this->currentSet])) {
            $this->sets[$this->currentSet] = ['player1' => 0, 'player2' => 0];
        }

        // Reset scores for the new set
        $this->sets[$this->currentSet]['player1'] = 0;
        $this->sets[$this->currentSet]['player2'] = 0;

        // Create new set record in database
        DB::table('match_sets')->insert([
            'match_id' => $this->match->id,
            'set_number' => $this->currentSet,
            'player1_score' => 0,
            'player2_score' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function handleMatchWin($player)
    {
        $this->matchWinner = $player;
        $this->match->status = 'completed';
        $this->match->final_winner_id = $player->id;
        $this->match->completed_at = now();
        $this->match->save();
        
        // Update the matchStatus property
        $this->matchStatus = 'completed';
        
        // Only update matches_played and matches_won after the match is fully completed
        if ($this->match->status === 'completed') {
            // Update matches_played for both players
            Player::whereIn('user_id', [
                $this->match->player1_id,
                $this->match->player2_id
            ])->increment('matches_played');
            
            // Update winner's matches_won
            Player::where('user_id', $player->id)->increment('matches_won');
        }
        
        session()->flash('success', 'Match completed successfully.');
    }

    public function startMatch()
    {
        if (!$this->match->isLive()) {
            $this->match->status = 'in_progress';
            $this->match->played_at = now();
            $this->match->save();
            
            // Update the status property to trigger the frontend
            $this->matchStatus = 'in_progress';
            $this->isMatchLive = true;
            $this->updateCanDeclareWinner();
        }
    }

    public function pauseMatch()
    {
        if ($this->match->isLive()) {
            $this->match->status = 'paused';
            $this->match->save();
            $this->isMatchLive = false;
            $this->canDeclareWinner = false;
        }
    }

    private function updateCanDeclareWinner()
    {
        $this->canDeclareWinner = 
            $this->match->isLive() && 
            ($this->player1Score > 0 || $this->player2Score > 0);
    }

    public function declareSetWinner($playerId)
    {
        if ($this->matchWinner) {
            return;
        }

        // Save current set winner
        DB::table('match_sets')
            ->where('match_id', $this->match->id)
            ->where('set_number', $this->currentSet)
            ->update([
                'winner_id' => $playerId,
                'updated_at' => now(),
            ]);

        // Check if match is won (best of 3)
        $player1Sets = DB::table('match_sets')
            ->where('match_id', $this->match->id)
            ->where('winner_id', $this->match->player1_id)
            ->count();

        $player2Sets = DB::table('match_sets')
            ->where('match_id', $this->match->id)
            ->where('winner_id', $this->match->player2_id)
            ->count();

        if ($player1Sets >= 2) {
            $this->handleMatchWin($this->match->player1);
        } elseif ($player2Sets >= 2) {
            $this->handleMatchWin($this->match->player2);
        } else {
            // Only proceed to next set if we haven't reached the maximum
            if ($this->currentSet < 3) {
                $this->currentSet++;
                $this->currentSetCompleted = false;

                // Initialize the new set
                $this->sets[$this->currentSet] = ['player1' => 0, 'player2' => 0];
                
                // Reset current scores to show only new set scores
                $this->player1Score = $this->sets[$this->currentSet]['player1'];
                $this->player2Score = $this->sets[$this->currentSet]['player2'];

                // Create new set record in database
                DB::table('match_sets')->insert([
                    'match_id' => $this->match->id,
                    'set_number' => $this->currentSet,
                    'player1_score' => 0,
                    'player2_score' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    private function shouldDisableScoring($p1Score, $p2Score)
    {
        return ($p1Score >= 21 && $p1Score - $p2Score >= 2) || 
               ($p2Score >= 21 && $p2Score - $p1Score >= 2) ||
               $p1Score >= 30 || $p2Score >= 30;
    }

    public function render()
    {
        return view('livewire.umpire.matches.show', [
            'venues' => Venue::all(),
            'players' => User::where('role_id', 'player')->get(),
            'umpires' => User::where('role_id', 'umpire')->get(),
            'playerMatches' => GameMatch::where(function($query) {
                $query->where('player1_id', $this->match->player1_id)
                      ->orWhere('player2_id', $this->match->player1_id)
                      ->orWhere('player1_id', $this->match->player2_id)
                      ->orWhere('player2_id', $this->match->player2_id);
            })->where('status', 'completed')->get()
        ]);
    }
}