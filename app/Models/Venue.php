<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Venue extends Model
{
    protected $fillable = [
        'name',
        'address',
        'courts_count',
    ];

    public function matches(): HasMany
    {
        return $this->hasMany(GameMatch::class);
    }
}
