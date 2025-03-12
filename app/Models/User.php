<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use App\Models\GameMatch;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'admin_verified_at',
        'email_verified_at',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'admin_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    public function initials(){
        return substr($this->name, 0, 1);
    }

    public function scopeRole(Builder $query, string $role): Builder
    {
        return $query->where('role_id', $role);
    }

    public function player()
    {
        return $this->hasOne(Player::class);
    }

    public function umpire()
    {
        return $this->hasOne(Umpire::class);
    }

    public function matches()
    {
        return $this->hasMany(GameMatch::class);
    }
}
