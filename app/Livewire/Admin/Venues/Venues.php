<?php

namespace App\Livewire\Admin\Venues;

use App\Models\Venue;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.app')]
#[Title('Venues')]
class Venues extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $selectedVenueId = null;
    
    // Form properties
    public $name = '';
    public $address = '';
    public $courts_count = 1;
    public $contact_phone = '';
    public $contact_email = '';
    public $venue_img = null;
    public $isUploading = false;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'courts_count' => 'required|integer|min:1',
            'contact_phone' => 'nullable|string',
            'contact_email' => 'nullable|email',
            'venue_img' => 'nullable|image|max:20480', // 20MB limit
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->isUploading = false;
    }

    public function updatedVenueImg()
    {
        try {
            if (!$this->venue_img) {
                return;
            }

            $this->validateOnly('venue_img');

            // Verify the file is actually an image
            if (!in_array($this->venue_img->getMimeType(), [
                'image/jpeg', 'image/png', 'image/gif', 'image/webp'
            ])) {
                throw new \Exception('Invalid image format');
            }

        } catch (\Exception $e) {
            Log::error('Venue image upload error: ' . $e->getMessage());
            $this->venue_img = null;
            $this->addError('venue_img', 'Invalid image. Please try again with a different file.');
        }
    }

    #[On('resetForm')]
    public function resetForm()
    {
        $this->reset([
            'name', 
            'address', 
            'courts_count', 
            'contact_phone', 
            'contact_email', 
            'venue_img'
        ]);
        $this->resetValidation();
        $this->isUploading = false;
    }

    public function removeUploadedImage()
    {
        $this->venue_img = null;
    }

    public function createVenue()
    {
        $this->validate();

        try {
            $venue = new Venue();
            $venue->name = $this->name;
            $venue->courts_count = $this->courts_count;
            $venue->address = $this->address;
            $venue->contact_phone = $this->contact_phone;
            $venue->contact_email = $this->contact_email;

            if ($this->venue_img) {
                $filename = time() . '_' . $this->venue_img->getClientOriginalName();
                $path = $this->venue_img->storeAs('venues', $filename, 'public');
                $venue->venue_img = $path;
            }

            $venue->save();
            
            $this->resetForm();
            $this->dispatch('venue-created');
            $this->js("document.querySelector('[data-modal=\"create-venue-modal\"]').close()");

        } catch (\Exception $e) {
            Log::error('Venue creation error: ' . $e->getMessage());
            $this->addError('form', 'Failed to create venue. Please try again.');
        }
    }

    public function confirmVenueDeletion($venueId)
    {
        $this->selectedVenueId = $venueId;
    }

    public function deleteVenue()
    {
        try {
            $venue = Venue::findOrFail($this->selectedVenueId);
            
            // Delete the image file if it exists
            if ($venue->venue_img && Storage::disk('public')->exists($venue->venue_img)) {
                Storage::disk('public')->delete($venue->venue_img);
            }
            
            $venue->delete();
            
            $this->selectedVenueId = null;
            $this->dispatch('close-modal', ['name' => 'delete-venue-modal']);
            session()->flash('success', 'Venue deleted successfully.');
            
        } catch (\Exception $e) {
            Log::error('Venue deletion error: ' . $e->getMessage());
            session()->flash('error', 'Failed to delete venue. Please try again.');
        }
    }

    public function paginationView()
    {
        return 'vendor.livewire.custom-pagination';
    }

    public function render()
    {
        $venues = Venue::when($this->search, function($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })->latest()->paginate(9);

        return view('livewire.admin.venues.index', [
            'venues' => $venues
        ]);
    }
}
