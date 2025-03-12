<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Player extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'phone_number',
        'date_of_birth',
        'gender',
        'nationality',
        'playing_hand',
        'matches_played',
        'matches_won',
        'bio',
        'profile_photo',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_of_birth' => 'date',
        'matches_played' => 'integer',
        'matches_won' => 'integer',
    ];

    /**
     * Get the user that owns the player profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the win rate percentage of the player.
     */
    public function getWinRateAttribute(): float
    {
        if ($this->matches_played === 0) {
            return 0;
        }
        
        return round(($this->matches_won / $this->matches_played) * 100, 2);
    }

    /**
     * Get the player's matches as player 1.
     */
    public function matchesAsPlayer1()
    {
        return $this->hasMany(GameMatch::class, 'player1_id', 'user_id');
    }

    /**
     * Get the player's matches as player 2.
     */
    public function matchesAsPlayer2()
    {
        return $this->hasMany(GameMatch::class, 'player2_id', 'user_id');
    }

    /**
     * Get all matches for the player.
     */
    public function getAllMatchesAttribute()
    {
        return GameMatch::where('player1_id', $this->user_id)
            ->orWhere('player2_id', $this->user_id);
    }

    /**
     * Get the profile photo URL.
     */
    public function getProfilePhotoUrlAttribute(): string
    {
        if ($this->profile_photo) {
            return asset('storage/' . $this->profile_photo);
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->user->name) . '&color=7F9CF5&background=EBF4FF';
    }
}