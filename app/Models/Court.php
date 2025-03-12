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
        'start_time' => 'datetime',
        'end_time' => 'datetime'
    ];

    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class);
    }

    public function match(): BelongsTo
    {
        return $this->belongsTo(GameMatch::class, 'match_id');
    }

    public function isOccupied($checkDate = null, $checkTime = null): bool
    {
        // If no specific date is provided, use today
        $checkDate = $checkDate ?? now()->toDateString();

        // If court is in maintenance, it's not available
        if ($this->status === 'maintenance') {
            return true;
        }

        // If no date/time provided, consider current date/time
        $checkDate = $checkDate ?? now()->toDateString();
        $checkTime = $checkTime ?? now()->format('H:i:s');

        // If no schedule, it's not occupied
        if (!$this->schedule_date || !$this->start_time || !$this->end_time) {
            return false;
        }

        // Check if the date matches
        if ($this->schedule_date->toDateString() !== $checkDate) {
            return false;
        }

        // If no specific time to check, just return true since it's booked for this date
        if ($checkTime === null) {
            return true;
        }

        // Convert times to Carbon for comparison
        $checkDateTime = Carbon::parse($checkDate . ' ' . $checkTime);
        $startDateTime = Carbon::parse($checkDate . ' ' . $this->start_time);
        $endDateTime = Carbon::parse($checkDate . ' ' . $this->end_time);

        // Check if the time falls within the scheduled period
        return $checkDateTime->between($startDateTime, $endDateTime);
    }

    public function isAvailable($checkDate = null, $checkTime = null): bool
    {
        return !$this->isOccupied($checkDate, $checkTime);
    }

    public function matches()
    {
        return $this->hasMany(GameMatch::class, 'court_number', 'number')
                    ->where('venue_id', $this->venue_id);
    }

    public function getMatchesForDate($date)
    {
        return $this->matches()
            ->whereDate('scheduled_at', $date)
            ->orderBy('scheduled_at')
            ->get();
    }

    public function hasMatchOn($date): bool
    {
        return $this->matches()
            ->whereDate('scheduled_at', $date)
            ->exists();
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