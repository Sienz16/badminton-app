<?php

namespace App\Livewire\Umpire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\GameMatch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

#[Layout('components.layouts.app')]
#[Title('Umpire Dashboard')]
class Dashboard extends Component
{
    public function getMatchDetails($matchId)
    {
        return DB::table('match_sets')
            ->where('match_id', $matchId)
            ->orderBy('set_number')
            ->get()
            ->mapWithKeys(function ($set) {
                return [$set->set_number => [
                    'player1' => $set->player1_score,
                    'player2' => $set->player2_score,
                    'winner_id' => $set->winner_id,
                    'set_number' => $set->set_number
                ]];
            });
    }

    public function render()
    {
        // Get today's matches (including live matches)
        $todayMatches = GameMatch::with([
                'player1.player', 
                'player2.player', 
                'matchSets',
                'venue',
                'umpireUser'
            ])
            ->whereDate('scheduled_at', today())
            ->get()
            ->map(function ($match) {
                $match->matchDetails = $this->getMatchDetails($match->id);
                $match->isAssignedToMe = $match->umpire_id === Auth::id();
                return $match;
            });

        // Get all live matches with enhanced relationships
        $allLiveMatches = GameMatch::where('status', 'in_progress')
            ->with([
                'player1.player', 
                'player2.player',
                'venue',
                'umpireUser',
                'matchSets' => function($query) {
                    $query->orderBy('set_number', 'asc');
                }
            ])
            ->get()
            ->map(function ($match) {
                // Get the current set
                $match->current_set = $match->matchSets->last();
                // Calculate sets won by each player
                $match->sets_won = $match->matchSets
                    ->where('winner_id', '!=', null)
                    ->groupBy('winner_id')
                    ->map(function ($sets) {
                        return $sets->count();
                    });
                return $match;
            });

        // Get all upcoming matches
        $upcomingMatches = GameMatch::where('status', 'scheduled')
            ->whereDate('scheduled_at', '>', today())
            ->with([
                'player1.player',
                'player2.player',
                'venue',
                'umpireUser'
            ])
            ->orderBy('scheduled_at')
            ->limit(6)
            ->get();

        // Get past matches
        $pastMatches = GameMatch::with([
                'player1.player',
                'player2.player',
                'matchSets',
                'venue',
                'umpireUser'
            ])
            ->where('status', 'completed')
            ->orderBy('completed_at', 'desc')
            ->limit(6)
            ->get()
            ->map(function ($match) {
                $match->matchDetails = $this->getMatchDetails($match->id);
                return $match;
            });

        return view('livewire.umpire.dashboard', [
            'todayMatches' => $todayMatches,
            'allLiveMatches' => $allLiveMatches,
            'upcomingMatches' => $upcomingMatches,
            'pastMatches' => $pastMatches,
        ]);
    }
}
