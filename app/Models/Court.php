<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Court extends Model
{
    protected $fillable = [
        'venue_id',
        'match_id',
        'number',
        'status',
        'schedule_date',
        'start_time',
        'end_time'
    ];

    protected $casts = [
        'schedule_date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i'
    ];

    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class);
    }

    public function match(): BelongsTo
    {
        return $this->belongsTo(GameMatch::class);
    }

    public function isAvailable(): bool
    {
        return $this->status === 'available';
    }

    public function hasScheduleConflict($date, $startTime, $endTime): bool
    {
        if ($this->schedule_date !== $date) {
            return false;
        }

        $newStart = Carbon::createFromFormat('H:i', $startTime);
        $newEnd = Carbon::createFromFormat('H:i', $endTime);
        $existingStart = Carbon::createFromFormat('H:i', $this->start_time);
        $existingEnd = Carbon::createFromFormat('H:i', $this->end_time);

        return $newStart->between($existingStart, $existingEnd) ||
               $newEnd->between($existingStart, $existingEnd) ||
               ($newStart->lte($existingStart) && $newEnd->gte($existingEnd));
    }
}