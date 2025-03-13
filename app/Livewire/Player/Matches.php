<?php

namespace App\Livewire\Player;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\GameMatch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

#[Layout('components.layouts.app')]
#[Title('My Matches')]
class Matches extends Component
{
    use WithPagination;

    public string $activeTab = 'upcoming';
    
    public function render()
    {
        $player = Auth::user();
        
        $query = GameMatch::with(['venue', 'umpire', 'player1', 'player2'])
            ->where(function($q) use ($player) {
                $q->where('player1_id', $player->id)
                  ->orWhere('player2_id', $player->id);
            });

        // Get completed matches with eager loading
        $completedMatches = $query->clone()
            ->where('status', 'completed')
            ->orderBy('played_at', 'desc')
            ->paginate(10);

        // Get live matches
        $liveMatches = $query->clone()
            ->where('status', 'in_progress')
            ->get();

        // Get upcoming matches
        $upcomingMatches = $query->clone()
            ->where('status', 'scheduled')
            ->orderBy('scheduled_at', 'asc')
            ->get();

        return view('livewire.player.matches', [
            'completedMatches' => $completedMatches,
            'liveMatches' => $liveMatches,
            'upcomingMatches' => $upcomingMatches,
            'upcomingCount' => $upcomingMatches->count(),
            'liveCount' => $liveMatches->count(),
            'completedCount' => $query->clone()->where('status', 'completed')->count(),
        ]);
    }

    private function formatScore($set)
    {
        if (!$set) return '0-0';
        return "{$set->player1_score}-{$set->player2_score}";
    }

    private function formatSetsScore($sets)
    {
        if ($sets->isEmpty()) return 'No scores';
        return $sets->map(function($set) {
            return "{$set->player1_score}-{$set->player2_score}";
        })->join(' | ');
    }
}
