<div>
    <flux:modal name="create-match-modal" :show="$errors->isNotEmpty()" focusable class="max-w-2xl">
        <form wire:submit="createMatch" class="space-y-8">
            <div class="p-6">
                <!-- Header -->
                <div class="mb-8">
                    <flux:heading size="lg">Schedule New Match</flux:heading>
                    <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">
                        Fill in the details below to schedule a new match
                    </p>
                </div>

                <div class="space-y-6">
                    <!-- Players Selection -->
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <flux:label for="player1">Player 1</flux:label>
                            <flux:select 
                                wire:model="player1Id"
                                class="mt-1"
                            >
                                <option value="">Select Player 1</option>
                                @foreach($players as $player)
                                    <option value="{{ $player->id }}">{{ $player->name }}</option>
                                @endforeach
                            </flux:select>
                            @error('player1Id') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <flux:label for="player2">Player 2</flux:label>
                            <flux:select 
                                wire:model="player2Id"
                                class="mt-1"
                            >
                                <option value="">Select Player 2</option>
                                @foreach($players as $player)
                                    <option value="{{ $player->id }}">{{ $player->name }}</option>
                                @endforeach
                            </flux:select>
                            @error('player2Id') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Venue and Court -->
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <flux:label for="venue">Venue</flux:label>
                            <flux:select 
                                wire:model="venueId"
                                class="mt-1"
                            >
                                <option value="">Select Venue</option>
                                @foreach($venues as $venue)
                                    <option value="{{ $venue->id }}">{{ $venue->name }}</option>
                                @endforeach
                            </flux:select>
                            @error('venueId') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <flux:label for="court">Court Number</flux:label>
                            <flux:input 
                                type="number" 
                                wire:model="courtNumber"
                                min="1"
                                placeholder="Enter court number"
                                class="mt-1"
                            />
                            @error('courtNumber') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Date and Time -->
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                        <div>
                            <flux:label for="date">Date</flux:label>
                            <flux:input 
                                type="date" 
                                wire:model="date"
                                min="{{ date('Y-m-d') }}"
                                class="mt-1"
                            />
                            @error('date') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <flux:label for="startTime">Start Time</flux:label>
                            <flux:input 
                                type="time" 
                                wire:model="startTime"
                                class="mt-1"
                            />
                            @error('startTime') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <flux:label for="endTime">End Time</flux:label>
                            <flux:input 
                                type="time" 
                                wire:model="endTime"
                                class="mt-1"
                            />
                            @error('endTime') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Umpire Selection -->
                    <div>
                        <flux:label for="umpire">Umpire</flux:label>
                        <flux:select 
                            wire:model="umpireId"
                            class="mt-1"
                        >
                            <option value="">Select Umpire</option>
                            @foreach($umpires as $umpire)
                                <option value="{{ $umpire->id }}">{{ $umpire->name }}</option>
                            @endforeach
                        </flux:select>
                        @error('umpireId') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="flex items-center justify-end gap-3 bg-zinc-50 px-6 py-4 dark:bg-zinc-800/50">
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>

                <flux:button type="submit" variant="primary">
                    <div wire:loading.remove wire:target="createMatch">
                        Schedule Match
                    </div>
                    <div wire:loading wire:target="createMatch">
                        Scheduling...
                    </div>
                </flux:button>
            </div>
        </form>
    </flux:modal>
</div>