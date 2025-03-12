<?php

namespace App\Observers;

use App\Models\Venue;
use App\Models\Court;
use Illuminate\Support\Facades\Log;

class VenueObserver
{
    public function created(Venue $venue)
    {
        Log::info('Creating courts for venue:', ['venue_id' => $venue->id, 'courts_count' => $venue->courts_count]);

        // Create courts for the new venue
        for ($i = 1; $i <= $venue->courts_count; $i++) {
            Court::create([
                'venue_id' => $venue->id,
                'number' => $i,
                'status' => 'available',
                'match_id' => null,
                'schedule_date' => null,
                'start_time' => null,
                'end_time' => null
            ]);
        }

        Log::info('Courts created successfully');
    }

    public function updated(Venue $venue)
    {
        // If courts_count was increased, create new courts
        if ($venue->wasChanged('courts_count')) {
            $oldCount = $venue->getOriginal('courts_count');
            $newCount = $venue->courts_count;

            if ($newCount > $oldCount) {
                // Create only the additional courts
                for ($i = $oldCount + 1; $i <= $newCount; $i++) {
                    Court::create([
                        'venue_id' => $venue->id,
                        'number' => $i,
                        'status' => 'available'
                    ]);
                }
            }
        }
    }
}
