<?php

namespace App\Livewire\Admin\Tournaments;

use Livewire\Component;
use App\Models\GameMatch;

class Index extends Component
{
    public function render()
    {
        $matches = GameMatch::with(['player1', 'player2', 'venue'])
            ->orderBy('scheduled_at', 'asc')
            ->get();

        return view('livewire.admin.tournaments.index', [
            'matches' => $matches
        ]);
    }
}
