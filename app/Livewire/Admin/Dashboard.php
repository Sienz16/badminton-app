<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\User;
use App\Models\Venue;
use App\Models\GameMatch;
use Carbon\Carbon;

#[Layout('components.layouts.app')]
#[Title('Admin Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        $commonRelations = ['player1', 'player2', 'venue', 'umpireUser', 'winner'];

        // Get today's matches count
        $todayMatches = GameMatch::whereDate('scheduled_at', Carbon::today())->count();
        
        // Get live matches
        $liveMatches = GameMatch::where('status', 'in_progress')
            ->with($commonRelations)
            ->get();
        
        // Get upcoming matches
        $upcomingMatches = GameMatch::where('status', 'scheduled')
            ->whereDate('scheduled_at', '>', Carbon::today())
            ->with($commonRelations)
            ->orderBy('scheduled_at')
            ->limit(5)
            ->get();

        // Get recent matches
        $recentMatches = GameMatch::where('status', 'completed')
            ->with($commonRelations)
            ->orderBy('played_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('livewire.admin.dashboard', [
            'totalUsers' => User::count(),
            'newUsersToday' => User::whereDate('created_at', Carbon::today())->count(),
            'activeVenues' => Venue::count(),
            'totalCourts' => Venue::sum('courts_count'),
            'todayMatches' => $todayMatches,
            'liveMatchesCount' => $liveMatches->count(),
            'liveMatches' => $liveMatches,
            'pendingApprovals' => User::whereNull('admin_verified_at')->count(),
            'upcomingMatches' => $upcomingMatches,
            'recentMatches' => $recentMatches,
        ]);
    }
}
