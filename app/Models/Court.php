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

    public function isOccupied($date, $time = null)
    {
        if ($this->status === 'maintenance') {
            return true;
        }

        if ($this->match_id && $this->schedule_date) {
            $scheduleDate = Carbon::parse($this->schedule_date)->toDateString();
            $checkDate = Carbon::parse($date)->toDateString();

            if ($scheduleDate === $checkDate) {
                if ($time) {
                    // If time is provided, check if it falls within the match time
                    $matchStart = Carbon::parse($this->start_time);
                    $matchEnd = Carbon::parse($this->end_time);
                    $checkTime = Carbon::parse($time);
                    
                    return $checkTime->between($matchStart, $matchEnd);
                }
                return true;
            }
        }

        return false;
    }

    public function isAvailable($date, $time = null)
    {
        if ($this->status === 'maintenance') {
            return false;
        }

        return !$this->isOccupied($date, $time);
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

    public function hasMatchOn($date)
    {
        if ($this->schedule_date) {
            $scheduleDate = Carbon::parse($this->schedule_date)->toDateString();
            $checkDate = Carbon::parse($date)->toDateString();
            
            return $scheduleDate === $checkDate;
        }
        
        return false;
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