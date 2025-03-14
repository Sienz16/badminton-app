<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MatchSet extends Model
{
    protected $fillable = [
        'match_id',
        'set_number',
        'player1_score',
        'player2_score',
        'winner_id'
    ];

    /**
     * Get the match that owns the set.
     */
    public function match(): BelongsTo
    {
        return $this->belongsTo(GameMatch::class, 'match_id');
    }

    /**
     * Get the winner of the set.
     */
    public function winner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'winner_id');
    }
}