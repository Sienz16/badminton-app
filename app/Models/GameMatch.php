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

    // Add these scope methods
    public function scopeUpcoming(Builder $query): void
    {
        $query->where('status', 'scheduled')
            ->where('scheduled_at', '>', now())
            ->orderBy('scheduled_at');
    }

    public function scopeLive(Builder $query): void
    {
        $query->where('status', 'in_progress');
    }

    public function scopeCompleted(Builder $query): void
    {
        $query->where('status', 'completed')
            ->orderBy('played_at', 'desc');
    }

    // Add winner relationship
    public function winner()
    {
        return $this->belongsTo(User::class, 'winner_id');
    }

    // Existing relationships
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

    public function umpire()
    {
        return $this->belongsTo(User::class, 'umpire_id');
    }

    // Status checker methods
    public function isLive(): bool
    {
        return $this->status === 'in_progress';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isScheduled(): bool
    {
        return $this->status === 'scheduled';
    }

    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }
}
