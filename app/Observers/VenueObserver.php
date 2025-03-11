<?php

namespace App\Observers;

use App\Models\Venue;
use App\Models\Court;

class VenueObserver
{
    public function created(Venue $venue)
    {
        // Create courts for the new venue
        for ($i = 1; $i <= $venue->courts_count; $i++) {
            Court::create([
                'venue_id' => $venue->id,
                'number' => $i,
                'status' => 'available'
            ]);
        }
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
