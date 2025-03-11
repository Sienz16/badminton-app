<?php

namespace App\Livewire\Umpire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\GameMatch;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.app')]
#[Title('Umpire Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        $umpire = Auth::user();
        
        return view('livewire.umpire.dashboard', [
            'todayMatches' => GameMatch::where('umpire_id', $umpire->id)
                ->whereDate('scheduled_at', today())
                ->orderBy('scheduled_at')
                ->get(),
                
            'upcomingMatches' => GameMatch::where('umpire_id', $umpire->id)
                ->where('status', 'scheduled')
                ->whereDate('scheduled_at', '>', today())
                ->orderBy('scheduled_at')
                ->limit(5)
                ->get(),
                
            'recentMatches' => GameMatch::where('umpire_id', $umpire->id)
                ->where('status', 'completed')
                ->latest('played_at')
                ->limit(5)
                ->get(),
                
            'allTodayMatches' => GameMatch::whereDate('scheduled_at', today())
                ->orderBy('scheduled_at')
                ->get(),
                
            'allLiveMatches' => GameMatch::where('status', 'live')
                ->orderBy('scheduled_at')
                ->get(),
        ]);
    }
}
