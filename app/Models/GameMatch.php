<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class GameMatch extends Model
{
    protected $table = 'matches';

    protected $casts = [
        'scheduled_at' => 'datetime',
        'played_at' => 'datetime',
    ];

    // Status checker methods
    public function isLive(): bool
    {
        return $this->status === 'in_progress';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    public function isScheduled(): bool
    {
        return $this->status === 'scheduled';
    }

    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('scheduled_at', '>', Carbon::now())
                    ->where('status', 'scheduled')
                    ->orderBy('scheduled_at');
    }

    public function scopeLive(Builder $query): Builder
    {
        return $query->where('status', 'in_progress')
                    ->orderBy('scheduled_at', 'desc');
    }

    public function scopeCompleted(Builder $query): Builder
    {
        return $query->where('status', 'completed')
                    ->orderBy('played_at', 'desc');
    }

    public function scopeForPlayer(Builder $query, $playerId): Builder
    {
        return $query->where(function($query) use ($playerId) {
            $query->where('player1_id', $playerId)
                  ->orWhere('player2_id', $playerId);
        });
    }

    public function player1()
    {
        return $this->belongsTo(User::class, 'player1_id');
    }

    public function player2()
    {
        return $this->belongsTo(User::class, 'player2_id');
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'umpire_id');
    }
}
