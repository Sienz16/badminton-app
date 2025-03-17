<?php

namespace App\Livewire\Admin\Tournaments;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\GameMatch;
use App\Models\Venue;
use App\Models\User;
use App\Models\Player;
use App\Models\Court;
use App\Models\Umpire;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
    public $showUmpireModal = false;
    public $showScoringModal = false;
    public $showWinnerModal = false;
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

    // Add these properties for edit form
    public $editDate;
    public $editStartTime;
    public $editVenueId;
    public $editCourtNumber;
    public $editUmpireId;
    public $editPlayer1Id;
    public $editPlayer2Id;
    public $editAvailableCourts = [];

    protected $listeners = [
        'refreshComponent' => '$refresh',
        'match-updated' => '$refresh'
    ];

    public function openUmpireModal()
    {
        $this->showUmpireModal = true;
    }

    public function assignUmpire()
    {
        $this->validate([
            'umpireId' => 'required|exists:users,id'
        ]);

        try {
            DB::transaction(function () {
                $this->match->umpire_id = $this->umpireId;
                $this->match->save();
            });

            $this->match->load(['umpire', 'umpireUser']); // Reload the relationships
            $this->showUmpireModal = false;
            session()->flash('success', 'Umpire assigned successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to assign umpire. Please try again.');
        }
    }

    public function mount(GameMatch $match)
    {
        $this->match = $match->load([
            'player1.player',
            'player2.player',
            'venue',
            'umpireUser',
            'umpire',
            'court'
        ]);

        if ($this->match->umpire_id) {
            $this->umpireId = $this->match->umpire_id;
        }

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

        // Initialize properties
        $this->editAvailableCourts = [];
        
        // If we have a match loaded, prepare the edit data
        if ($this->match && $this->match->venue_id) {
            $venue = Venue::find($this->match->venue_id);
            if ($venue) {
                $this->editAvailableCourts = range(1, $venue->number_of_courts);
            }
        }

        // Load available courts for the current venue
        if ($this->match->venue_id) {
            $this->loadAvailableCourts($this->match->venue_id);
        }
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
        
        // Update matches_played for both players only when match completes
        Player::where('user_id', $this->match->player1_id)->increment('matches_played');
        Player::where('user_id', $this->match->player2_id)->increment('matches_played');
        
        // Update winner's matches_won
        Player::where('user_id', $player->id)->increment('matches_won');
        
        $this->match->save();

        session()->flash('success', 'Match completed successfully.');
    }

    public function deleteMatch()
    {
        try {
            // Begin transaction
            DB::beginTransaction();

            // If match was completed, decrement matches_played for both players
            if ($this->match->status === 'completed') {
                Player::where('user_id', $this->match->player1_id)->decrement('matches_played');
                Player::where('user_id', $this->match->player2_id)->decrement('matches_played');

                // If there was a winner, decrement their matches_won
                if ($this->match->final_winner_id) {
                    Player::where('user_id', $this->match->final_winner_id)->decrement('matches_won');
                }
            }

            // If there's a court associated, clear its match-related fields
            if ($this->match->court) {
                $this->match->court->update([
                    'match_id' => null,
                    'schedule_date' => null,
                    'start_time' => null,
                    'end_time' => null
                ]);
            }

            // Delete the match
            $this->match->delete();

            DB::commit();

            session()->flash('success', 'Match deleted successfully.');
            
            // Redirect to matches index page
            return $this->redirect(route('admin.tournaments'), navigate: true);

        } catch (\Exception $e) {
            DB::rollBack();
            logger()->error('Failed to delete match', [
                'match_id' => $this->match->id,
                'error' => $e->getMessage()
            ]);
            session()->flash('error', 'Failed to delete match. Please try again.');
        }
    }

    public function startMatch()
    {
        if (!$this->match->isLive()) {
            $this->match->status = 'in_progress';
            $this->match->played_at = now();
            $this->match->save();
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

    public function updatedEditVenueId($value)
    {
        $this->loadAvailableCourts($value);
    }

    private function loadAvailableCourts($venueId)
    {
        $this->editAvailableCourts = [];
        
        if ($venueId) {
            $venue = Venue::find($venueId);
            if ($venue) {
                // Get all courts for this venue
                $courts = Court::where('venue_id', $venueId)
                    ->orderBy('number')
                    ->pluck('number')
                    ->toArray();
                
                if (empty($courts)) {
                    // Fallback to venue's number_of_courts if no Court records exist
                    $this->editAvailableCourts = range(1, $venue->number_of_courts);
                } else {
                    $this->editAvailableCourts = $courts;
                }
            }
        }
    }

    public function prepareEdit()
    {
        // Load fresh data with relationships
        $this->match = $this->match->fresh([
            'player1.player',
            'player2.player',
            'venue',
            'umpireUser',
            'umpire',
            'court'
        ]);

        // Set all edit properties
        $this->editPlayer1Id = $this->match->player1_id;
        $this->editPlayer2Id = $this->match->player2_id;
        $this->editUmpireId = $this->match->umpire_id;
        $this->editVenueId = $this->match->venue_id;
        $this->editCourtNumber = $this->match->court_number;
        
        if ($this->match->scheduled_at) {
            $scheduledAt = Carbon::parse($this->match->scheduled_at);
            $this->editDate = $scheduledAt->format('Y-m-d');
            $this->editStartTime = $scheduledAt->format('H:i');
        }

        // Load courts for the selected venue
        if ($this->editVenueId) {
            $this->loadAvailableCourts($this->editVenueId);
        }

        // Dispatch the modal open event
        $this->dispatch('open-modal', 'edit-match-modal');
    }

    public function updateMatch()
    {
        $this->validate([
            'editDate' => 'required|date',
            'editStartTime' => 'required',
            'editVenueId' => 'required|exists:venues,id',
            'editCourtNumber' => 'required|integer',
            'editUmpireId' => 'required|exists:users,id',
            'editPlayer1Id' => 'required|exists:users,id',
            'editPlayer2Id' => 'required|exists:users,id|different:editPlayer1Id',
        ]);

        try {
            DB::beginTransaction();

            // Combine date and time for scheduled_at
            $scheduledAt = Carbon::parse($this->editDate . ' ' . $this->editStartTime);

            // Update the match properties
            $this->match->scheduled_at = $scheduledAt;
            $this->match->venue_id = $this->editVenueId;
            $this->match->court_number = $this->editCourtNumber;
            $this->match->umpire_id = $this->editUmpireId;
            $this->match->player1_id = $this->editPlayer1Id;
            $this->match->player2_id = $this->editPlayer2Id;
            
            // Save the match
            $this->match->save();

            // Update court availability
            $court = Court::where('venue_id', $this->editVenueId)
                ->where('number', $this->editCourtNumber)
                ->first();

            if ($court) {
                $court->update([
                    'match_id' => $this->match->id,
                    'schedule_date' => $this->editDate,
                    'start_time' => $this->editStartTime,
                    'end_time' => Carbon::parse($this->editStartTime)->addHour()->format('H:i:s')
                ]);
            }

            DB::commit();

            // Refresh the match with relationships
            $this->match = GameMatch::with([
                'player1.player',
                'player2.player',
                'venue',
                'umpireUser',
                'umpire',
                'court'
            ])->find($this->match->id);

            $this->dispatch('match-updated');
            $this->dispatch('close-modal');
            session()->flash('success', 'Match updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            logger()->error('Failed to update match', [
                'match_id' => $this->match->id,
                'error' => $e->getMessage()
            ]);
            session()->flash('error', 'Failed to update match. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.admin.tournaments.show', [
            'venues' => Venue::all(),
            'players' => User::where('role_id', 'player')->get(),
            'umpires' => User::where('role_id', 'umpire')->get(),
        ]);
    }
}