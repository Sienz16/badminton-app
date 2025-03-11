<?php

namespace App\Livewire\Player;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\GameMatch;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.app')]
#[Title('My Matches')]
class Matches extends Component
{
    use WithPagination;

    public string $activeTab = 'upcoming';
    
    public function render()
    {
        $player = Auth::user();
        $query = GameMatch::forPlayer($player->id);

        return view('livewire.player.matches', [
            'upcomingMatches' => $query->upcoming()->get(),
            'liveMatches' => $query->live()->get(),
            'completedMatches' => $query->completed()->paginate(10),
            'upcomingCount' => $query->upcoming()->count(),
            'liveCount' => $query->live()->count()
        ]);
    }
}
