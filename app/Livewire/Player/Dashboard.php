<?php

namespace App\Livewire\Player;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\GameMatch;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.app')]
#[Title('Player Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.player.dashboard', [
            'upcomingMatches' => GameMatch::upcoming()
                ->with(['player1', 'player2', 'venue', 'umpireUser'])
                ->get(),
                
            'liveMatches' => GameMatch::live()
                ->with(['player1', 'player2', 'venue', 'umpireUser'])
                ->get(),
                
            'pastMatches' => GameMatch::completed()
                ->with(['player1', 'player2', 'venue', 'umpireUser'])
                ->latest('played_at')
                ->limit(6)
                ->get(),
        ]);
    }
}
