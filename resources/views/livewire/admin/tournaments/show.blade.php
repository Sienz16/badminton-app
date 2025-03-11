<div>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.tournaments') }}" wire:navigate class="text-sm text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-300">
                    <div class="flex items-center gap-1">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                        Back to tournaments
                    </div>
                </a>
            </div>
            <h1 class="mt-4 text-2xl font-bold text-zinc-900 dark:text-white">{{ $tournament->name }}</h1>
        </div>

        <!-- Add Match Section -->
        <div class="mb-8 rounded-lg bg-white p-6 shadow dark:bg-zinc-800">
            <h2 class="mb-4 text-lg font-semibold">Add New Match</h2>
            <form wire:submit="createMatch" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Venue Selection -->
                <div>
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Venue</label>
                    <select wire:model="selectedVenue" class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm dark:border-zinc-600 dark:bg-zinc-700">
                        <option value="">Select Venue</option>
                        @foreach($venues as $venue)
                            <option value="{{ $venue->id }}">{{ $venue->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Court Number -->
                <div>
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Court Number</label>
                    <input type="number" wire:model="selectedCourt" class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm dark:border-zinc-600 dark:bg-zinc-700">
                </div>

                <!-- Date and Time -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Date</label>
                        <input type="date" wire:model="selectedDate" class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm dark:border-zinc-600 dark:bg-zinc-700">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Time</label>
                        <input type="time" wire:model="selectedTime" class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm dark:border-zinc-600 dark:bg-zinc-700">
                    </div>
                </div>

                <!-- Players and Umpire -->
                <div>
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Player 1</label>
                    <select wire:model="player1Id" class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm dark:border-zinc-600 dark:bg-zinc-700">
                        <option value="">Select Player 1</option>
                        @foreach($players as $player)
                            <option value="{{ $player->id }}">{{ $player->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Player 2</label>
                    <select wire:model="player2Id" class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm dark:border-zinc-600 dark:bg-zinc-700">
                        <option value="">Select Player 2</option>
                        @foreach($players as $player)
                            <option value="{{ $player->id }}">{{ $player->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Umpire</label>
                    <select wire:model="umpireId" class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm dark:border-zinc-600 dark:bg-zinc-700">
                        <option value="">Select Umpire</option>
                        @foreach($umpires as $umpire)
                            <option value="{{ $umpire->id }}">{{ $umpire->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-span-full">
                    <flux:button type="submit" class="w-full">Add Match</flux:button>
                </div>
            </form>
        </div>

        <!-- Matches List -->
        <div class="space-y-6">
            <h2 class="text-lg font-semibold">Tournament Matches</h2>
            @foreach($matches as $match)
                <div class="rounded-lg bg-white p-6 shadow dark:bg-zinc-800">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-medium">{{ $match->player1->name }} vs {{ $match->player2->name }}</h3>
                            <p class="mt-1 text-sm text-zinc-500">
                                {{ $match->venue->name }} - Court {{ $match->court_number }}
                                <span class="ml-2">{{ $match->scheduled_at->format('d M Y, H:i') }}</span>
                            </p>
                        </div>
                        <div class="flex items-center gap-4">
                            @if($match->status === 'in_progress')
                                <div class="flex items-center gap-2">
                                    <!-- Player 1 Score -->
                                    <div class="flex items-center gap-1">
                                        <button wire:click="updateScore({{ $match->id }}, 1, 'decrement')" class="rounded-md bg-zinc-100 p-1 hover:bg-zinc-200 dark:bg-zinc-700 dark:hover:bg-zinc-600">
                                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                                            </svg>
                                        </button>
                                        <span class="min-w-[2rem] text-center">{{ explode('-', $match->score ?: '0-0')[0] }}</span>
                                        <button wire:click="updateScore({{ $match->id }}, 1, 'increment')" class="rounded-md bg-zinc-100 p-1 hover:bg-zinc-200 dark:bg-zinc-700 dark:hover:bg-zinc-600">
                                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                        </button>
                                    </div>
                                    <span>-</span>
                                    <!-- Player 2 Score -->
                                    <div class="flex items-center gap-1">
                                        <button wire:click="updateScore({{ $match->id }}, 2, 'decrement')" class="rounded-md bg-zinc-100 p-1 hover:bg-zinc-200 dark:bg-zinc-700 dark:hover:bg-zinc-600">
                                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                                            </svg>
                                        </button>
                                        <span class="min-w-[2rem] text-center">{{ explode('-', $match->score ?: '0-0')[1] }}</span>
                                        <button wire:click="updateScore({{ $match->id }}, 2, 'increment')" class="rounded-md bg-zinc-100 p-1 hover:bg-zinc-200 dark:bg-zinc-700 dark:hover:bg-zinc-600">
                                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <flux:button wire:click="setWinner({{ $match->id }}, {{ $match->player1_id }})" size="sm">
                                        Player 1 Wins
                                    </flux:button>
                                    <flux:button wire:click="setWinner({{ $match->id }}, {{ $match->player2_id }})" size="sm">
                                        Player 2 Wins
                                    </flux:button>
                                </div>
                            @else
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $match->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ ucfirst($match->status) }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>