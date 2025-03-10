<?php

namespace App\Livewire\Player;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Player Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.player.dashboard');
    }
}