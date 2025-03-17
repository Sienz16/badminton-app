<div
    x-data="{ show: false }"
    x-show="show"
    x-on:open-modal.window="if ($event.detail === 'edit-match-modal') show = true"
    x-on:close-modal.window="show = false"
    @match-updated.window="show = false"
    class="relative z-50"
    style="display: none;"
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
                <form wire:submit.prevent="updateMatch" class="space-y-6">
                    <div class="p-6">
                        <div class="mb-6">
                            <flux:heading size="lg" class="text-green-900 dark:text-green-100">Edit Match</flux:heading>
                            <p class="mt-1 text-sm text-green-600 dark:text-green-400">
                                Update the match details below
                            </p>
                        </div>

                        <div class="space-y-6">
                            <!-- Players Selection -->
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                <div>
                                    <flux:label for="player1" class="text-green-900 dark:text-green-100">Player 1</flux:label>
                                    <div class="mt-2">
                                        <flux:select 
                                            wire:model.live="editPlayer1Id" 
                                            class="w-full bg-green-50 border-green-200 focus:border-green-500 focus:ring-green-500 dark:bg-green-900/30 dark:border-green-700 dark:focus:ring-green-500"
                                        >
                                            <option value="">Select Player 1</option>
                                            @foreach($players as $player)
                                                <option value="{{ $player->id }}" @selected($editPlayer1Id == $player->id)>
                                                    {{ $player->name }}
                                                </option>
                                            @endforeach
                                        </flux:select>
                                    </div>
                                    @error('editPlayer1Id') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <flux:label for="player2" class="text-green-900 dark:text-green-100">Player 2</flux:label>
                                    <div class="mt-2">
                                        <flux:select 
                                            wire:model="editPlayer2Id" 
                                            class="w-full bg-green-50 border-green-200 focus:border-green-500 focus:ring-green-500 dark:bg-green-900/30 dark:border-green-700 dark:focus:ring-green-500"
                                        >
                                            <option value="">Select Player 2</option>
                                            @foreach($players->where('id', '!=', $editPlayer1Id) as $player)
                                                <option value="{{ $player->id }}" @selected($editPlayer2Id == $player->id)>
                                                    {{ $player->name }}
                                                </option>
                                            @endforeach
                                        </flux:select>
                                    </div>
                                    @error('editPlayer2Id') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Date and Time -->
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                <div>
                                    <flux:label for="editDate" class="text-green-900 dark:text-green-100">Date</flux:label>
                                    <div class="mt-2">
                                        <flux:input 
                                            type="date" 
                                            id="editDate"
                                            wire:model="editDate"
                                            value="{{ $editDate }}"
                                            class="w-full bg-green-50 border-green-200 focus:border-green-500 focus:ring-green-500 dark:bg-green-900/30 dark:border-green-700 dark:focus:ring-green-500"
                                        />
                                    </div>
                                    @error('editDate') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <flux:label for="editStartTime" class="text-green-900 dark:text-green-100">Start Time</flux:label>
                                    <div class="mt-2">
                                        <flux:input 
                                            type="time" 
                                            id="editStartTime"
                                            wire:model="editStartTime"
                                            value="{{ $editStartTime }}"
                                            class="w-full bg-green-50 border-green-200 focus:border-green-500 focus:ring-green-500 dark:bg-green-900/30 dark:border-green-700 dark:focus:ring-green-500"
                                        />
                                    </div>
                                    @error('editStartTime') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Venue and Court -->
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                <div>
                                    <flux:label for="editVenueId" class="text-green-900 dark:text-green-100">Venue</flux:label>
                                    <div class="mt-2">
                                        <flux:select 
                                            id="editVenueId"
                                            wire:model.live="editVenueId" 
                                            class="w-full bg-green-50 border-green-200 focus:border-green-500 focus:ring-green-500 dark:bg-green-900/30 dark:border-green-700 dark:focus:ring-green-500"
                                        >
                                            <option value="">Select Venue</option>
                                            @foreach($venues as $venue)
                                                <option value="{{ $venue->id }}">{{ $venue->name }}</option>
                                            @endforeach
                                        </flux:select>
                                    </div>
                                    @error('editVenueId') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <flux:label for="editCourtNumber" class="text-green-900 dark:text-green-100">Court Number</flux:label>
                                    <div class="mt-2">
                                        <flux:select 
                                            id="editCourtNumber"
                                            wire:model.live="editCourtNumber" 
                                            class="w-full bg-green-50 border-green-200 focus:border-green-500 focus:ring-green-500 dark:bg-green-900/30 dark:border-green-700 dark:focus:ring-green-500"
                                        >
                                            <option value="">Select Court</option>
                                            @if($editVenueId && !empty($editAvailableCourts))
                                                @foreach($editAvailableCourts as $court)
                                                    <option value="{{ $court }}" @selected($editCourtNumber == $court)>
                                                        Court {{ $court }}
                                                    </option>
                                                @endforeach
                                            @else
                                                <option value="" disabled>Please select a venue first</option>
                                            @endif
                                        </flux:select>
                                    </div>
                                    @error('editCourtNumber') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Umpire Selection -->
                            <div>
                                <flux:label for="editUmpireId" class="text-green-900 dark:text-green-100">Umpire</flux:label>
                                <div class="mt-2">
                                    <flux:select 
                                        id="editUmpireId"
                                        wire:model="editUmpireId" 
                                        class="w-full bg-green-50 border-green-200 focus:border-green-500 focus:ring-green-500 dark:bg-green-900/30 dark:border-green-700 dark:focus:ring-green-500"
                                    >
                                        <option value="">Select Umpire</option>
                                        @foreach($umpires as $umpire)
                                            <option value="{{ $umpire->id }}">{{ $umpire->name }}</option>
                                        @endforeach
                                    </flux:select>
                                </div>
                                @error('editUmpireId') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="flex items-center justify-end gap-3 border-t border-green-200 bg-green-50/50 px-6 py-4 dark:border-green-800 dark:bg-green-900/30">
                        <flux:button type="button" x-on:click="show = false" variant="ghost" class="text-green-700 hover:bg-green-100 dark:text-green-400 dark:hover:bg-green-900/50">
                            Cancel
                        </flux:button>
                        <flux:button type="submit" variant="primary" class="bg-green-600 hover:bg-green-700 focus:ring-green-500 dark:bg-green-500 dark:hover:bg-green-600">
                            <span wire:loading.remove wire:target="updateMatch">Update Match</span>
                            <span wire:loading wire:target="updateMatch">Updating...</span>
                        </flux:button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>