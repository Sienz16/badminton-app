<?php

namespace App\Livewire\Welcome;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\GameMatch;
use Illuminate\Support\Carbon;

class MatchesSection extends Component
{
    use WithPagination;
    
    public $activeTab = 'today';
    private const PER_PAGE = 6;

    // Add these lines to preserve scroll position
    protected $paginationTheme = 'tailwind';
    protected $queryString = ['activeTab'];

    // Add this method to prevent page refresh
    public function updatingActiveTab()
    {
        $this->resetPage();
    }

    public function getTodayMatchesProperty()
    {
        return GameMatch::whereDate('scheduled_at', Carbon::today())
            ->with(['player1.player', 'player2.player', 'venue'])
            ->orderBy('scheduled_at')
            ->paginate(self::PER_PAGE);
    }

    public function getUpcomingMatchesProperty()
    {
        return GameMatch::where('scheduled_at', '>', Carbon::today()->endOfDay())
            ->with(['player1.player', 'player2.player', 'venue'])
            ->orderBy('scheduled_at')
            ->paginate(self::PER_PAGE);
    }

    public function getPastMatchesProperty()
    {
        return GameMatch::where('scheduled_at', '<', Carbon::today())
            ->with(['player1.player', 'player2.player', 'venue'])
            ->orderBy('scheduled_at', 'desc')
            ->paginate(self::PER_PAGE);
    }

    public function render()
    {
        return view('livewire.welcome.matches-section');
    }
}