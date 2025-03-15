<div>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Header with Actions -->
        <div class="mb-8 sm:flex sm:items-center sm:justify-between">
            <!-- Back Button and Title -->
            <div class="min-w-0 flex-1">
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.venues') }}" wire:navigate class="inline-flex items-center gap-1 text-sm text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-300">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                        Back to venues
                    </a>
                </div>
                <br>
                <h2 class="mt-4 text-2xl font-bold leading-7 text-zinc-900 dark:text-white sm:truncate sm:text-3xl">{{ $venue->name }}</h2>
            </div>
        </div>

        <!-- Venue Info and Image Grid -->
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            <!-- Venue Image -->
            <div class="lg:col-span-2">
                @if($venue->venue_img && Storage::disk('public')->exists($venue->venue_img))
                    <div class="overflow-hidden rounded-lg border border-green-200 dark:border-green-700">
                        <img 
                            src="{{ Storage::url($venue->venue_img) }}"
                            alt="{{ $venue->name }}"
                            class="h-full w-full object-cover"
                        >
                    </div>
                @endif
            </div>

            <!-- Venue Details -->
            <div class="lg:col-span-1">
                <div class="overflow-hidden rounded-lg border border-green-200 bg-white shadow-sm transition-all hover:border-green-300 
                            dark:border-green-700 dark:bg-green-900/30 dark:hover:border-green-600">
                    <div class="px-4 py-5 sm:p-6">
                        <!-- Status Badge -->
                        <div class="mb-6">
                            <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 
                                       dark:bg-green-900/30 dark:text-green-400">
                                Active
                            </span>
                        </div>

                        <!-- Address -->
                        <div class="flex items-start gap-x-3">
                            <svg class="h-5 w-5 flex-shrink-0 text-green-600 dark:text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                            <div>
                                <h3 class="text-sm font-medium text-green-900 dark:text-green-50">Location</h3>
                                <p class="mt-1 text-sm text-green-700 dark:text-green-300">{{ $venue->address }}</p>
                            </div>
                        </div>

                        <!-- Facility Details -->
                        <div class="mt-6 space-y-6">
                            <!-- Courts -->
                            <div class="flex items-start gap-x-3">
                                <svg class="h-5 w-5 flex-shrink-0 text-green-600 dark:text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                </svg>
                                <div>
                                    <h3 class="text-sm font-medium text-green-900 dark:text-green-50">Courts</h3>
                                    <p class="mt-1 text-sm text-green-700 dark:text-green-300">{{ $venue->courts_count }} Available Courts</p>
                                </div>
                            </div>

                            <!-- Contact Email -->
                            <div class="flex items-start gap-x-3">
                                <svg class="h-5 w-5 flex-shrink-0 text-green-600 dark:text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                                <div>
                                    <h3 class="text-sm font-medium text-green-900 dark:text-green-50">Contact Email</h3>
                                    <p class="mt-1 text-sm text-green-700 dark:text-green-300">
                                        @if($venue->contact_email)
                                            {{ $venue->contact_email }}
                                        @else
                                            <em>N/A</em>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="mt-8 flex flex-col gap-3">
                            <flux:modal.trigger name="edit-venue-modal">
                                <flux:button variant="filled" class="w-full">
                                    <svg class="mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                    Edit Venue
                                </flux:button>
                            </flux:modal.trigger>

                            <flux:modal.trigger name="delete-venue-modal">
                                <flux:button variant="danger" class="w-full">
                                    <svg class="mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                    Delete Venue
                                </flux:button>
                            </flux:modal.trigger>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Divider -->
        <div class="relative my-8">
            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                <div class="w-full border-t border-zinc-200 dark:border-zinc-700"></div>
            </div>
        </div>

        <br>

        <!-- Courts Section -->
        <div>
            <div class="mb-6">
                <h3 class="text-lg font-medium text-zinc-900 dark:text-white">Court Schedules</h3>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">View and manage court schedules for this venue.</p>
            </div>

            <!-- Date Selector -->
            <div class="mb-6 lg:max-w-xs">
                <label for="schedule-date" class="block text-sm font-medium text-green-900 dark:text-green-50">Select Date</label>
                <div class="relative mt-1.5">
                    <input 
                        type="date" 
                        id="schedule-date"
                        wire:model.live="selectedDate"
                        class="block w-full rounded-lg border-green-200 bg-white px-3 py-2.5 text-sm text-green-900 
                               shadow-sm ring-1 ring-inset ring-green-200 placeholder:text-green-400 
                               focus:border-green-500 focus:ring-2 focus:ring-green-500 
                               dark:border-green-700 dark:bg-green-900/30 dark:text-green-50 
                               dark:ring-green-700 dark:placeholder:text-green-500 
                               dark:focus:border-green-500 dark:focus:ring-green-500"
                    >
                </div>
            </div>

            <!-- Courts Grid -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($courts as $court)
                    <div class="overflow-hidden rounded-lg border-3 border-green-200 bg-white dark:border-green-700 dark:bg-green-900/30">
                        <div class="border-b border-green-200 bg-green-50 px-4 py-3 dark:border-green-700 dark:bg-green-900/50">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-medium text-zinc-900 dark:text-white">Court {{ $court->number }}</h3>
                                <div class="flex items-center gap-2">
                                    @if($court->status === 'maintenance')
                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-500">
                                            Maintenance
                                        </span>
                                    @elseif($court->hasMatchOn($selectedDate) && $court->start_time && $court->end_time)
                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium">
                                            {{ \Carbon\Carbon::parse($court->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($court->end_time)->format('H:i') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-4">
                            @if($selectedDate)
                                <div class="mb-4">
                                    <h4 class="text-sm font-medium text-zinc-900 dark:text-white mb-2">
                                        Schedule for {{ \Carbon\Carbon::parse($selectedDate)->format('j M Y') }}
                                    </h4>
                                    
                                    @php
                                        $matchesForDate = $court->getMatchesForDate($selectedDate);
                                    @endphp
                                    
                                    @if($matchesForDate->isNotEmpty())
                                        @foreach($matchesForDate as $match)
                                            <div class="rounded-md">
                                                <div class="flex items-center border-2 border-green-200 justify-between bg-green-50 dark:bg-green-900/30 p-3 rounded-md">
                                                    <div>
                                                        <div class="flex items-center gap-2 mb-1">
                                                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium border-2 border-amber-100 bg-amber-50 text-amber-800 dark:bg-amber-900/30 dark:text-amber-200">
                                                                {{ $match->scheduled_at->format('H:i') }} - 
                                                                {{ $match->scheduled_at->addHours(1)->format('H:i') }}
                                                            </span>
                                                        </div>
                                                        <p class="text-sm text-green-900 dark:text-green-50">
                                                            {{ $match->player1->name }} vs {{ $match->player2->name }}
                                                        </p>
                                                    </div>
                                                    {{-- <a href="{{ route('admin.matches.show', $match) }}" wire:navigate>
                                                        <flux:button size="xs" variant="outline">View Match</flux:button>
                                                    </a> --}}
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-sm text-zinc-500 dark:text-zinc-400">No matches scheduled for this date</p>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Delete Venue Modal -->
    <flux:modal name="delete-venue-modal" focusable>
        <div class="p-6">
            <div class="mb-8">
                <!-- Warning Icon and Title -->
                <div class="flex items-center gap-3">
                    <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 dark:bg-red-900/30">
                        <svg class="h-6 w-6 text-red-600 dark:text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>
                    <div>
                        <flux:heading size="lg" class="text-red-600 dark:text-red-500">Delete Venue</flux:heading>
                        <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                            This action cannot be undone. Are you sure you want to permanently delete this venue?
                        </p>
                    </div>
                </div>

                <!-- Venue Details -->
                <div class="mt-6 rounded-lg bg-zinc-50 p-4 dark:bg-zinc-800/50">
                    <div class="flex items-center gap-4">
                        @if ($venue->venue_img && Storage::disk('public')->exists($venue->venue_img))
                            <img 
                                src="{{ Storage::url($venue->venue_img) }}"
                                class="h-16 w-16 rounded-lg object-cover"
                                alt="{{ $venue->name }}"
                            />
                        @else
                            <div class="flex h-16 w-16 items-center justify-center rounded-lg bg-zinc-200 dark:bg-zinc-700">
                                <svg class="h-8 w-8 text-zinc-400 dark:text-zinc-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                            </div>
                        @endif
                        <div>
                            <h4 class="font-medium text-zinc-900 dark:text-white">{{ $venue->name }}</h4>
                            <div class="mt-1 flex items-center gap-2 text-sm text-zinc-600 dark:text-zinc-400">
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                </svg>
                                <span>{{ $venue->courts_count }} Courts</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Warning Message -->
                <div class="mt-6 text-sm text-zinc-600 dark:text-zinc-400">
                    <p class="font-medium text-red-600 dark:text-red-500">The following will be permanently deleted:</p>
                    <ul class="mt-2 list-inside list-disc space-y-1">
                        <li>All venue information and settings</li>
                        <li>All associated courts and their configurations</li>
                        <li>All booking history and schedules</li>
                        <li>All related images and media files</li>
                    </ul>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end gap-3">
                <flux:modal.close>
                    <flux:button variant="ghost" class="px-4 py-2">
                        Cancel
                    </flux:button>
                </flux:modal.close>

                <flux:button 
                    variant="danger"
                    wire:click="deleteVenue"
                    wire:loading.attr="disabled"
                    class="inline-flex items-center justify-center px-4 py-2"
                >
                    <div class="flex items-center gap-2">
                        <div wire:loading.remove wire:target="deleteVenue">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </div>
                        <div wire:loading wire:target="deleteVenue">
                            <svg class="h-5 w-5 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                        <span wire:loading.remove wire:target="deleteVenue">Delete Venue</span>
                        <span wire:loading wire:target="deleteVenue">Deleting...</span>
                    </div>
                </flux:button>
            </div>
        </div>
    </flux:modal>

    <!-- Edit Venue Modal -->
    <flux:modal name="edit-venue-modal" focusable class="max-w-2xl">
        <form wire:submit="updateVenue" class="space-y-8 p-6">
            <div>
                <flux:heading size="lg">Edit Venue</flux:heading>
            </div>

            <!-- Image Upload Section -->
            <div 
                class="relative rounded-lg border-2 border-dashed border-gray-300 p-6 dark:border-gray-700"
                x-data
                x-on:dragover.prevent="$el.classList.add('border-blue-500')"
                x-on:dragleave.prevent="$el.classList.remove('border-blue-500')"
                x-on:drop.prevent="
                    $el.classList.remove('border-blue-500');
                    const input = $el.querySelector('input[type=file]');
                    input.files = $event.dataTransfer.files;
                    input.dispatchEvent(new Event('change'));
                "
            >
                <div class="flex flex-col items-center justify-center text-center">
                    <input 
                        type="file" 
                        id="venue_img"
                        wire:model="venue_img"
                        class="sr-only"
                        accept="image/*"
                    />
                    
                    @if($venue_img)
                        <!-- New image preview -->
                        <div class="relative mb-4">
                            <button 
                                type="button"
                                wire:click="removeUploadedImage"
                                class="absolute -right-2 -top-2 rounded-full bg-red-100 p-1 text-red-600 hover:bg-red-200 dark:bg-red-900/30 dark:text-red-500"
                            >
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                            <img src="{{ $venue_img->temporaryUrl() }}" class="max-h-48 rounded" alt="Preview">
                        </div>
                    @elseif($existing_venue_img && Storage::disk('public')->exists($existing_venue_img))
                        <!-- Existing image preview -->
                        <div class="relative mb-4">
                            <button 
                                type="button"
                                wire:click="removeExistingImage"
                                class="absolute -right-2 -top-2 rounded-full bg-red-100 p-1 text-red-600 hover:bg-red-200 dark:bg-red-900/30 dark:text-red-500"
                            >
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                            <img src="{{ Storage::url($existing_venue_img) }}" class="max-h-48 rounded" alt="Current Image">
                        </div>
                    @else
                        <!-- Upload UI -->
                        <div class="mb-3 h-12 w-12 text-gray-400 dark:text-gray-500">
                            <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                        </div>
                    @endif

                    <label for="venue_img" class="cursor-pointer">
                        <span class="text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300">Upload new image</span>
                        <span class="text-gray-500 dark:text-gray-400"> or drag and drop</span>
                    </label>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">PNG, JPG, GIF up to 10MB</p>

                    <!-- Loading indicator -->
                    <div wire:loading wire:target="venue_img" class="mt-2">
                        <div class="flex items-center justify-center text-sm text-gray-500">
                            <svg class="mr-2 h-4 w-4 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Uploading...
                        </div>
                    </div>
                </div>
                @error('venue_img') 
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Fields -->
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-4">
                    <flux:label for="name">Venue Name</flux:label>
                    <div class="mt-2">
                        <flux:input 
                            type="text" 
                            id="name" 
                            wire:model="name" 
                            placeholder="Enter venue name"
                        />
                        @error('name')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="col-span-6 sm:col-span-2">
                    <flux:label for="courts_count">Number of Courts</flux:label>
                    <div class="mt-2">
                        <flux:input 
                            type="number" 
                            id="courts_count" 
                            wire:model="courts_count" 
                            min="1"
                        />
                        @error('courts_count')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="col-span-6">
                    <flux:label for="address">Address</flux:label>
                    <div class="mt-2">
                        <flux:textarea 
                            id="address" 
                            wire:model="address" 
                            rows="3"
                            placeholder="Enter venue address"
                        />
                        @error('address')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="col-span-6 sm:col-span-3">
                    <flux:label for="contact_phone">Contact Phone</flux:label>
                    <div class="mt-2">
                        <flux:input 
                            type="tel" 
                            id="contact_phone" 
                            wire:model="contact_phone" 
                            placeholder="Enter contact phone"
                        />
                        @error('contact_phone')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <flux:label for="contact_email">Contact Email</flux:label>
                    <div class="mt-2">
                        <flux:input 
                            type="email" 
                            id="contact_email" 
                            wire:model="contact_email" 
                            placeholder="Enter contact email"
                        />
                        @error('contact_email')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Footer Buttons -->
            <div class="mt-8 flex justify-end gap-3">
                <flux:modal.close>
                    <flux:button variant="ghost" class="px-4">
                        Cancel
                    </flux:button>
                </flux:modal.close>

                <flux:button type="submit" variant="primary">
                    Save Changes
                </flux:button>
            </div>
        </form>
    </flux:modal>
</div>
