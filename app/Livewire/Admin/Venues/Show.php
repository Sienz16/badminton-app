<?php

namespace App\Livewire\Admin\Venues;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;
use App\Models\Venue;
use App\Models\Court;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

#[Layout('components.layouts.app')]
#[Title('Venue Details')]
class Show extends Component
{
    use WithFileUploads;

    public Venue $venue;
    public $selectedDate;
    
    // Edit form properties
    public $name;
    public $courts_count;
    public $address;
    public $contact_phone;
    public $contact_email;
    public $venue_img;
    public $existing_venue_img;
    public $isUploading = false;

    public function mount(Venue $venue)
    {
        $this->venue = $venue;
        $this->selectedDate = now()->format('Y-m-d');
        
        // Initialize form fields
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->name = $this->venue->name;
        $this->courts_count = $this->venue->courts_count;
        $this->address = $this->venue->address;
        $this->contact_phone = $this->venue->contact_phone;
        $this->contact_email = $this->venue->contact_email;
        $this->existing_venue_img = $this->venue->venue_img;
        $this->venue_img = null;
    }

    public function updatedVenueImg()
    {
        $this->isUploading = true;
        try {
            $this->validate([
                'venue_img' => 'image|max:10240', // 10MB max
            ]);

            if (!in_array($this->venue_img->getMimeType(), [
                'image/jpeg', 'image/png', 'image/gif', 'image/webp'
            ])) {
                throw new \Exception('Invalid image format');
            }

        } catch (\Exception $e) {
            $this->venue_img = null;
            $this->addError('venue_img', 'Invalid image. Please try again with a different file.');
        }
        $this->isUploading = false;
    }

    public function removeUploadedImage()
    {
        $this->venue_img = null;
    }

    public function removeExistingImage()
    {
        $this->existing_venue_img = null;
    }

    public function updateVenue()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'courts_count' => 'required|integer|min:1',
            'address' => 'required|string',
            'contact_phone' => 'nullable|string',
            'contact_email' => 'nullable|email',
            'venue_img' => 'nullable|image|max:10240', // 10MB max
        ]);

        try {
            // Check if courts_count is being reduced
            if ($this->courts_count < $this->venue->courts_count) {
                // Get courts that would be removed
                $courtsToRemove = $this->venue->courts()
                    ->where('number', '>', $this->courts_count)
                    ->get();

                // Check if any of these courts are occupied or have scheduled matches
                $unavailableCourts = $courtsToRemove->filter(function ($court) {
                    return $court->status === 'occupied' || 
                           $court->match_id !== null ||
                           ($court->schedule_date !== null && $court->schedule_date >= now()->toDateString());
                });

                if ($unavailableCourts->isNotEmpty()) {
                    $this->addError('courts_count', 'Cannot reduce courts. Some courts are currently in use or have scheduled matches.');
                    return;
                }

                // Delete the excess courts
                $this->venue->courts()
                    ->where('number', '>', $this->courts_count)
                    ->delete();
            }
            // If courts_count is being increased, the VenueObserver will handle creating new courts

            $this->venue->name = $this->name;
            $this->venue->courts_count = $this->courts_count;
            $this->venue->address = $this->address;
            $this->venue->contact_phone = $this->contact_phone;
            $this->venue->contact_email = $this->contact_email;

            // Handle image updates
            if ($this->venue_img) {
                // Delete old image if it exists
                if ($this->venue->venue_img && Storage::disk('public')->exists($this->venue->venue_img)) {
                    Storage::disk('public')->delete($this->venue->venue_img);
                }

                // Store new image
                $filename = time() . '_' . $this->venue_img->getClientOriginalName();
                $path = $this->venue_img->storeAs('venues', $filename, 'public');
                $this->venue->venue_img = $path;
            } elseif ($this->existing_venue_img === null && $this->venue->venue_img) {
                // If existing image was removed
                Storage::disk('public')->delete($this->venue->venue_img);
                $this->venue->venue_img = null;
            }

            $this->venue->save();
            
            $this->dispatch('venue-updated');
            session()->flash('success', 'Venue updated successfully.');
            $this->js("document.querySelector('[data-modal=\"edit-venue-modal\"]').close()");

        } catch (\Exception $e) {
            logger()->error('Failed to update venue', [
                'error' => $e->getMessage()
            ]);
            $this->addError('form', 'Failed to update venue. Please try again.');
        }
    }

    public function deleteVenue()
    {
        try {
            // Check if any courts are occupied or have scheduled matches
            $unavailableCourts = $this->venue->courts()
                ->where(function ($query) {
                    $query->where('status', 'occupied')
                        ->orWhereNotNull('match_id')
                        ->orWhere(function ($q) {
                            $q->whereNotNull('schedule_date')
                              ->where('schedule_date', '>=', now()->toDateString());
                        });
                })
                ->exists();

            if ($unavailableCourts) {
                session()->flash('error', 'Cannot delete venue. Some courts are currently in use or have scheduled matches.');
                $this->js("document.querySelector('[data-modal=\"delete-venue-modal\"]').close()");
                return;
            }

            // Delete the venue image if it exists
            if ($this->venue->venue_img && Storage::disk('public')->exists($this->venue->venue_img)) {
                Storage::disk('public')->delete($this->venue->venue_img);
            }

            // Delete the venue (courts will be deleted via cascade)
            $this->venue->delete();

            session()->flash('success', 'Venue deleted successfully.');
            
            // Redirect to the venues index page with wire:navigate
            return $this->redirect(route('admin.venues'), navigate: true);

        } catch (\Exception $e) {
            logger()->error('Failed to delete venue', [
                'venue_id' => $this->venue->id,
                'error' => $e->getMessage()
            ]);
            session()->flash('error', 'Failed to delete venue. Please try again.');
            $this->js("document.querySelector('[data-modal=\"delete-venue-modal\"]').close()");
        }
    }

    public function render()
    {
        $courts = $this->venue->courts()
            ->orderBy('number')
            ->get();

        return view('livewire.admin.venues.show', [
            'courts' => $courts
        ]);
    }
}
