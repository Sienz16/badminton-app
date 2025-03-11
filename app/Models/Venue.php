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
        'venue_img',
        'contact_phone',
        'contact_email',
    ];

    /**
     * Get the matches for the venue.
     */
    public function matches(): HasMany
    {
        return $this->hasMany(GameMatch::class);
    }

    /**
     * Get the courts for the venue.
     */
    public function courts(): HasMany
    {
        return $this->hasMany(Court::class);
    }

    /**
     * Get the contact information as an array.
     */
    public function getContactInfoAttribute(): array
    {
        return [
            'phone' => $this->contact_phone,
            'email' => $this->contact_email,
        ];
    }

    /**
     * Check if the venue has any contact information.
     */
    public function hasContactInfo(): bool
    {
        return !empty($this->contact_phone) || !empty($this->contact_email);
    }
}
