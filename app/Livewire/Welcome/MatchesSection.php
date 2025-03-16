<?php

namespace App\Livewire\Welcome;

use Livewire\Component;
use App\Models\GameMatch;
use Illuminate\Support\Carbon;

class MatchesSection extends Component
{
    public $activeTab = 'today';

    public function getTodayMatchesProperty()
    {
        return GameMatch::whereDate('scheduled_at', Carbon::today())
            ->with(['player1.player', 'player2.player', 'venue'])
            ->orderBy('scheduled_at')
            ->get();
    }

    public function getUpcomingMatchesProperty()
    {
        return GameMatch::where('scheduled_at', '>', Carbon::today()->endOfDay())
            ->with(['player1.player', 'player2.player', 'venue'])
            ->orderBy('scheduled_at')
            ->get();
    }

    public function getPastMatchesProperty()
    {
        return GameMatch::where('scheduled_at', '<', Carbon::today())
            ->with(['player1.player', 'player2.player', 'venue'])
            ->orderBy('scheduled_at', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.welcome.matches-section');
    }
}