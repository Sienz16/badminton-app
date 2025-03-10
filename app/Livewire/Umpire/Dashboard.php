<?php

namespace App\Livewire\Umpire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Umpire Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.umpire.dashboard');
    }
}