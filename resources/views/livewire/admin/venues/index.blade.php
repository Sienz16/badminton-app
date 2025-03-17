<div>
    <div class="flex h-full w-full flex-1 flex-col gap-4">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Venues</h1>
            <flux:modal.trigger name="create-venue-modal">
                <flux:button variant="primary" class="bg-green-600 hover:bg-green-500">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Add Venue
                </flux:button>
            </flux:modal.trigger>
        </div>

        <!-- Search and Filters -->
        <div class="flex items-center gap-4">
            <div class="flex-1">
                <flux:input 
                    type="search" 
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search venues..."
                    class="w-full"
                />
            </div>
        </div>

        <!-- Venues Grid -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($venues as $venue)
                <a href="{{ route('admin.venues.show', $venue) }}" wire:navigate class="group relative flex flex-col overflow-hidden rounded-xl border-3 border-green-200 bg-surface-card transition-all hover:border-green-300 hover:shadow-lg dark:border-green-900 dark:bg-zinc-900 dark:hover:border-green-700">
                    <!-- Status Badge (New) -->
                    <div class="absolute left-4 top-4 z-10">
                        <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900/30 dark:text-green-500">
                            Active
                        </span>
                    </div>

                    <!-- Image Section -->
                    <div class="aspect-[16/9] w-full overflow-hidden bg-green-50 dark:bg-zinc-800">
                        @if ($venue->venue_img && Storage::disk('public')->exists($venue->venue_img))
                            <img 
                                src="{{ Storage::url($venue->venue_img) }}"
                                class="h-full w-full object-cover"
                                alt="{{ $venue->name }}"
                            />
                        @else
                            <div class="flex h-full items-center justify-center">
                                <svg class="h-12 w-12 text-green-300 dark:text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Content Section -->
                    <div class="flex flex-1 flex-col p-4">
                        <h3 class="font-medium text-zinc-900 dark:text-white">{{ $venue->name }}</h3>
                        <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">{{ $venue->address }}</p>
                        <div class="mt-4 flex items-center gap-2 text-sm text-green-600 dark:text-green-400">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
                            <span>{{ $venue->courts_count }} Courts</span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full">
                    <div class="flex flex-col items-center justify-center rounded-xl border border-dashed border-neutral-300 bg-white/50 px-6 py-16 dark:border-neutral-800 dark:bg-neutral-900/50">
                        <svg class="h-12 w-12 text-neutral-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                        <h3 class="mt-4 text-base font-medium text-neutral-900 dark:text-white">No venues</h3>
                        <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">Get started by creating a new venue.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-6 pt-6 border-t border-zinc-200 dark:border-zinc-700">
            {{ $venues->links() }}
        </div>

        <!-- Create Venue Modal -->
        <flux:modal name="create-venue-modal" :show="$errors->isNotEmpty()" focusable class="max-w-2xl">
            <form wire:submit="createVenue" class="space-y-8 p-6">
                <div>
                    <flux:heading size="lg" class="text-green-900 dark:text-green-50">Add New Venue</flux:heading>
                </div>

                <!-- Image Upload Section -->
                <div 
                    class="relative rounded-lg border-2 border-dashed border-green-300 p-6 dark:border-green-700"
                    x-data
                    x-on:dragover.prevent="$el.classList.add('border-green-500')"
                    x-on:dragleave.prevent="$el.classList.remove('border-green-500')"
                    x-on:drop.prevent="
                        $el.classList.remove('border-green-500');
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
                            <!-- Preview -->
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
                        @else
                            <!-- Upload UI -->
                            <div class="mb-3 h-12 w-12 text-green-600 dark:text-green-500">
                                <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                            </div>
                        @endif

                        <label for="venue_img" class="cursor-pointer">
                            <span class="text-green-600 hover:text-green-500 dark:text-green-400 dark:hover:text-green-300">Upload venue image</span>
                            <span class="text-green-700 dark:text-green-400"> or drag and drop</span>
                        </label>
                        <p class="mt-1 text-xs text-green-600 dark:text-green-400">PNG, JPG, GIF up to 20MB</p>

                        <!-- Loading indicator -->
                        <div wire:loading wire:target="venue_img" class="mt-2">
                            <div class="flex items-center justify-center text-sm text-green-600">
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

                <!-- Basic Information Section -->
                <div class="space-y-6">
                    <div class="flex items-center gap-x-3">
                        <div class="h-9 w-9 rounded-lg bg-green-100 p-2 dark:bg-green-900">
                            <svg class="h-5 w-5 text-green-500 dark:text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                            </svg>
                        </div>
                        <h2 class="text-lg font-medium text-green-900 dark:text-green-50">Basic Information</h2>
                    </div>

                    <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-2">
                        <!-- Venue Name -->
                        <div class="col-span-2 sm:col-span-1">
                            <label for="name" class="block text-sm font-medium leading-6 text-green-900 dark:text-green-100">
                                Venue Name <span class="text-red-500">*</span>
                            </label>
                            <div class="relative mt-2 rounded-md">
                                <div class="relative">
                                    <input 
                                        type="text" 
                                        id="name"
                                        wire:model="name"
                                        class="block w-full rounded-md border-0 py-2.5 pl-4 pr-10 bg-green-50 text-green-900 ring-1 ring-inset ring-green-300 placeholder:text-green-400 focus:ring-2 focus:ring-inset focus:ring-green-600 dark:bg-green-900/30 dark:text-green-100 dark:ring-green-700 dark:placeholder:text-green-500 dark:focus:ring-green-500 sm:text-sm sm:leading-6"
                                        placeholder="Enter venue name"
                                    />
                                    @error('name')
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                            <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    @enderror
                                </div>
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Number of Courts -->
                        <div class="col-span-2 sm:col-span-1">
                            <label for="courts_count" class="block text-sm font-medium leading-6 text-green-900 dark:text-green-100">
                                Number of Courts <span class="text-red-500">*</span>
                            </label>
                            <div class="relative mt-2 rounded-md">
                                <div class="relative">
                                    <input 
                                        type="number" 
                                        id="courts_count"
                                        wire:model="courts_count"
                                        min="1"
                                        class="block w-full rounded-md border-0 py-2.5 pl-4 pr-10 bg-green-50 text-green-900 ring-1 ring-inset ring-green-300 placeholder:text-green-400 focus:ring-2 focus:ring-inset focus:ring-green-600 dark:bg-green-900/30 dark:text-green-100 dark:ring-green-700 dark:placeholder:text-green-500 dark:focus:ring-green-500 sm:text-sm sm:leading-6"
                                        placeholder="Enter number of courts"
                                    />
                                    @error('courts_count')
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                            <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    @enderror
                                </div>
                                @error('courts_count')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="col-span-2">
                            <label for="address" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">
                                Address <span class="text-red-500">*</span>
                            </label>
                            <div class="relative mt-2 rounded-md">
                                <div class="relative">
                                    <textarea 
                                        id="address"
                                        wire:model="address"
                                        rows="3"
                                        class="block w-full rounded-md border-0 py-2.5 pl-4 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 dark:bg-gray-800 dark:text-white dark:ring-gray-700 dark:placeholder:text-gray-500 dark:focus:ring-blue-500 sm:text-sm sm:leading-6"
                                        placeholder="Enter complete venue address"
                                    ></textarea>
                                    @error('address')
                                        <div class="pointer-events-none absolute top-2 right-0 flex items-center pr-3">
                                            <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    @enderror
                                </div>
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
                </div>

                <!-- Footer Buttons -->
                <div class="mt-8 flex justify-end gap-3">
                    <flux:modal.close>
                        <flux:button variant="ghost" class="px-4">
                            Cancel
                        </flux:button>
                    </flux:modal.close>

                    <flux:button type="submit" variant="primary">
                        Add Venue
                    </flux:button>
                </div>
            </form>
        </flux:modal>
        </div>

        <!-- Delete Venue Modal -->
        <flux:modal name="delete-venue-modal" focusable>
            <div class="p-6">
                <div class="mb-6">
                    <flux:heading size="lg">Delete Venue</flux:heading>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        Are you sure you want to delete this venue? This action cannot be undone.
                    </p>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <flux:modal.close>
                        <flux:button variant="ghost">
                            Cancel
                        </flux:button>
                    </flux:modal.close>

                    <flux:button 
                        variant="danger"
                        wire:click="deleteVenue"
                        wire:loading.attr="disabled"
                    >
                        <span wire:loading.remove wire:target="deleteVenue">Delete Venue</span>
                        <span wire:loading wire:target="deleteVenue">Deleting...</span>
                    </flux:button>
                </div>
            </div>
        </flux:modal>

        <!-- Flash Messages -->
        @if (session()->has('success'))
            <div class="fixed bottom-4 right-4 z-50">
                <div class="rounded-md bg-green-50 p-4 dark:bg-green-900/50">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800 dark:text-green-200">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="fixed bottom-4 right-4 z-50">
                <div class="rounded-md bg-red-50 p-4 dark:bg-red-900/50">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-800 dark:text-red-200">
                                {{ session('error') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
