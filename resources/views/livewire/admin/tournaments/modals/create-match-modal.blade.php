<div
    x-data="{ show: false }"
    x-show="show"
    x-on:open-modal.window="if ($event.detail === 'create-match-modal') show = true"
    x-on:close-modal.window="show = false"
    @match-created.window="show = false"
    class="relative z-50"
>
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-green-900/20 dark:bg-green-900/40 backdrop-blur-sm"></div>
    
    <div class="fixed inset-0 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4">
            <div
                x-show="show"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                x-on:click.away="show = false"
                class="w-full max-w-2xl overflow-hidden rounded-xl bg-white shadow-xl ring-1 ring-green-900/10 dark:bg-green-900/50 dark:ring-green-200/10"
            >
                <form wire:submit="createMatch" class="space-y-6">
                    <div class="p-6">
                        <div class="mb-6">
                            <flux:heading size="lg" class="text-green-900 dark:text-green-100">Schedule New Match</flux:heading>
                            <p class="mt-1 text-sm text-green-600 dark:text-green-400">
                                Fill in the details below to schedule a new match
                            </p>
                        </div>

                        <div class="space-y-6">
                            <!-- Players Selection -->
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                <div>
                                    <flux:label for="player1" class="text-green-900 dark:text-green-100">Player 1</flux:label>
                                    <div class="mt-2">
                                        <flux:select 
                                            wire:model.live="player1Id" 
                                            class="w-full bg-green-50 border-green-200 focus:border-green-500 focus:ring-green-500 dark:bg-green-900/30 dark:border-green-700 dark:focus:ring-green-500"
                                        >
                                            <option value="">Select Player 1</option>
                                            @foreach($players as $player)
                                                <option value="{{ $player->id }}">{{ $player->name }}</option>
                                            @endforeach
                                        </flux:select>
                                    </div>
                                    @error('player1Id') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <flux:label for="player2" class="text-green-900 dark:text-green-100">Player 2</flux:label>
                                    <div class="mt-2">
                                        <flux:select 
                                            wire:model="player2Id" 
                                            class="w-full bg-green-50 border-green-200 focus:border-green-500 focus:ring-green-500 dark:bg-green-900/30 dark:border-green-700 dark:focus:ring-green-500"
                                        >
                                            <option value="">Select Player 2</option>
                                            @foreach($players->where('id', '!=', $player1Id) as $player)
                                                <option value="{{ $player->id }}">{{ $player->name }}</option>
                                            @endforeach
                                        </flux:select>
                                    </div>
                                    @error('player2Id') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Date and Time -->
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                <div>
                                    <flux:label for="date" class="text-green-900 dark:text-green-100">Date</flux:label>
                                    <div class="mt-2">
                                        <flux:input 
                                            type="date" 
                                            wire:model="date"
                                            min="{{ date('Y-m-d') }}"
                                            class="w-full bg-green-50 border-green-200 focus:border-green-500 focus:ring-green-500 dark:bg-green-900/30 dark:border-green-700 dark:focus:ring-green-500"
                                        />
                                    </div>
                                    @error('date') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <flux:label for="time" class="text-green-900 dark:text-green-100">Start Time</flux:label>
                                    <div class="mt-2">
                                        <flux:input 
                                            type="time" 
                                            wire:model="startTime"
                                            class="w-full bg-green-50 border-green-200 focus:border-green-500 focus:ring-green-500 dark:bg-green-900/30 dark:border-green-700 dark:focus:ring-green-500"
                                        />
                                    </div>
                                    @error('startTime') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Venue and Court -->
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                <div>
                                    <flux:label for="venue" class="text-green-900 dark:text-green-100">Venue</flux:label>
                                    <div class="mt-2">
                                        <flux:select 
                                            wire:model.live="venueId" 
                                            class="w-full bg-green-50 border-green-200 focus:border-green-500 focus:ring-green-500 dark:bg-green-900/30 dark:border-green-700 dark:focus:ring-green-500"
                                        >
                                            <option value="">Select Venue</option>
                                            @foreach($venues as $venue)
                                                <option value="{{ $venue->id }}">{{ $venue->name }}</option>
                                            @endforeach
                                        </flux:select>
                                    </div>
                                    @error('venueId') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <flux:label for="court" class="text-green-900 dark:text-green-100">Court Number</flux:label>
                                    <div class="mt-2">
                                        <flux:select 
                                            wire:model="courtNumber" 
                                            class="w-full bg-green-50 border-green-200 focus:border-green-500 focus:ring-green-500 dark:bg-green-900/30 dark:border-green-700 dark:focus:ring-green-500"
                                        >
                                            <option value="">Select Court</option>
                                            @if(count($availableCourts) > 0)
                                                @foreach($availableCourts as $court)
                                                    <option value="{{ $court }}">Court {{ $court }}</option>
                                                @endforeach
                                            @else
                                                <option value="" disabled>No courts available</option>
                                            @endif
                                        </flux:select>
                                    </div>
                                    @error('courtNumber') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Umpire Selection -->
                            <div>
                                <flux:label for="umpire" class="text-green-900 dark:text-green-100">Umpire</flux:label>
                                <div class="mt-2">
                                    <flux:select 
                                        wire:model="umpireId" 
                                        class="w-full bg-green-50 border-green-200 focus:border-green-500 focus:ring-green-500 dark:bg-green-900/30 dark:border-green-700 dark:focus:ring-green-500"
                                    >
                                        <option value="">Select Umpire</option>
                                        @foreach($umpires as $umpire)
                                            <option value="{{ $umpire->id }}">{{ $umpire->name }}</option>
                                        @endforeach
                                    </flux:select>
                                </div>
                                @error('umpireId') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="flex items-center justify-end gap-3 border-t border-green-200 bg-green-50/50 px-6 py-4 dark:border-green-800 dark:bg-green-900/30">
                        <flux:button x-on:click="show = false" variant="ghost" class="text-green-700 hover:bg-green-100 dark:text-green-400 dark:hover:bg-green-900/50">
                            Cancel
                        </flux:button>
                        <flux:button type="submit" variant="primary" class="bg-green-600 hover:bg-green-700 focus:ring-green-500 dark:bg-green-500 dark:hover:bg-green-600">
                            <span wire:loading.remove wire:target="createMatch">Schedule Match</span>
                            <span wire:loading wire:target="createMatch">Scheduling...</span>
                        </flux:button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>