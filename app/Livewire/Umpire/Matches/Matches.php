<?php

namespace App\Livewire\Umpire\Matches;

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
        $umpire = Auth::user();
        $query = GameMatch::where('umpire_id', $umpire->id);

        return view('livewire.umpire.matches.index', [
            'upcomingMatches' => $query->clone()->upcoming()->get(),
            'liveMatches' => $query->clone()->live()->get(),
            'completedMatches' => $query->clone()->completed()->paginate(10),
            'upcomingCount' => $query->clone()->upcoming()->count(),
            'liveCount' => $query->clone()->live()->count(),
            'completedCount' => $query->clone()->completed()->count(),
        ]);
    }
}
