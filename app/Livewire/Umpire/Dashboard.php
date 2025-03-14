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
        $sets = DB::table('match_sets')
            ->where('match_id', $matchId)
            ->orderBy('set_number')
            ->get()
            ->mapWithKeys(function ($set) {
                return [$set->set_number => [
                    'player1' => $set->player1_score,
                    'player2' => $set->player2_score,
                    'winner_id' => $set->winner_id
                ]];
            });

        return $sets;
    }

    public function render()
    {
        $todayMatches = GameMatch::with(['player1', 'player2', 'matchSets'])
            ->whereDate('scheduled_at', today())
            ->get()
            ->map(function ($match) {
                $match->matchDetails = $this->getMatchDetails($match->id);
                $match->isAssignedToMe = $match->umpire_id === Auth::id();
                return $match;
            });

        // Get all live matches
        $allLiveMatches = GameMatch::where('status', 'in_progress')
            ->with(['player1', 'player2', 'venue', 'umpire'])
            ->get();

        // Get all upcoming matches
        $upcomingMatches = GameMatch::where('status', 'scheduled')
            ->whereDate('scheduled_at', '>', today())
            ->with(['player1', 'player2', 'venue', 'umpire'])
            ->orderBy('scheduled_at')
            ->limit(6)
            ->get();

        // Get past matches
        $pastMatches = GameMatch::with(['player1', 'player2', 'matchSets'])
            ->where('status', 'completed')
            ->orderBy('completed_at', 'desc')
            ->limit(6)
            ->get();

        return view('livewire.umpire.dashboard', [
            'todayMatches' => $todayMatches,
            'allLiveMatches' => $allLiveMatches,
            'upcomingMatches' => $upcomingMatches,
            'pastMatches' => $pastMatches,
        ]);
    }
}
