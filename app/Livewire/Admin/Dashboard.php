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
        $commonRelations = ['player1', 'player2', 'venue', 'umpireUser'];

        return view('livewire.admin.dashboard', [
            // Stats
            'totalUsers' => User::count(),
            'newUsersToday' => User::whereDate('created_at', Carbon::today())->count(),
            'activeVenues' => Venue::count(),
            'totalCourts' => Venue::sum('courts_count'),
            'todayMatches' => GameMatch::whereDate('scheduled_at', Carbon::today())->count(),
            'liveMatches' => GameMatch::where('status', 'in_progress')->count(),
            'pendingApprovals' => User::whereNull('admin_verified_at')->count(),

            // Load matches with proper relationship handling
            'upcomingMatches' => GameMatch::with($commonRelations)
                ->where('status', 'scheduled')
                ->orderBy('scheduled_at')
                ->take(5)
                ->get(),
            
            'recentMatches' => GameMatch::with([...$commonRelations, 'winner'])
                ->where('status', 'completed')
                ->orderByDesc('played_at')
                ->take(5)
                ->get(),
            
            'liveMatches' => GameMatch::with($commonRelations)
                ->where('status', 'in_progress')
                ->orderBy('scheduled_at')
                ->take(5)
                ->get(),
        ]);
    }
}
