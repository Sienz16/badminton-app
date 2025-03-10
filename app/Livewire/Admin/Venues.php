<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Venues')]
class Venues extends Component
{
    public function render()
    {
        return view('livewire.admin.venues');
    }
}