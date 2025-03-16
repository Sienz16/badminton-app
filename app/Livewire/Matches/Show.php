<?php

namespace App\Livewire\Matches;

use Livewire\Component;
use App\Models\GameMatch;
use Illuminate\Support\Facades\DB;

class Show extends Component
{
    public GameMatch $match;
    public $sets = [];

    public function mount(GameMatch $match)
    {
        $this->match = $match;
        $this->loadMatchSets();
    }

    protected function loadMatchSets()
    {
        // Get all sets for this match
        $matchSets = DB::table('match_sets')
            ->where('match_id', $this->match->id)
            ->orderBy('set_number')
            ->get();

        // Format sets data
        foreach ($matchSets as $set) {
            $this->sets[$set->set_number] = [
                'player1' => $set->player1_score,
                'player2' => $set->player2_score
            ];
        }
    }

    public function render()
    {
        return view('livewire.matches.show');
    }
}
