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
        return view('livewire.admin.dashboard', [
            // Stats
            'totalUsers' => User::count(),
            'newUsersToday' => User::whereDate('created_at', Carbon::today())->count(),
            'activeVenues' => Venue::count(),
            'totalCourts' => Venue::sum('courts_count'),
            'todayMatches' => GameMatch::whereDate('scheduled_at', Carbon::today())->count(),
            'liveMatches' => GameMatch::where('status', 'in_progress')->count(),
            'pendingApprovals' => User::whereNull('admin_verified_at')->count(),

            // Upcoming Matches
            'upcomingMatches' => GameMatch::with(['player1', 'player2', 'venue'])
                ->where('status', 'scheduled')
                ->where('scheduled_at', '>', Carbon::now())
                ->orderBy('scheduled_at')
                ->take(5)
                ->get(),
        ]);
    }
}
