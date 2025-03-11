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
        $player = Auth::user();

        return view('livewire.player.dashboard', [
            'upcomingMatches' => GameMatch::upcoming()->forPlayer($player->id)->get(),
            'liveMatches' => GameMatch::live()->forPlayer($player->id)->get(),
            'pastMatches' => GameMatch::completed()->forPlayer($player->id)->latest('played_at')->limit(6)->get(),
        ]);
    }
}
