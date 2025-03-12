<div>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-2xl font-semibold text-zinc-900 dark:text-white">Tournaments</h1>
                <p class="mt-2 text-sm text-zinc-700 dark:text-zinc-400">Manage all badminton tournaments and their matches.</p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <flux:modal.trigger name="create-match-modal">
                    <flux:button>
                        <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Schedule Match
                    </flux:button>
                </flux:modal.trigger>
            </div>
        </div>

        <!-- Content -->
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg dark:ring-white dark:ring-opacity-10">
                        <table class="min-w-full divide-y divide-zinc-300 dark:divide-zinc-600">
                            <thead class="bg-zinc-50 dark:bg-zinc-800">
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-zinc-900 dark:text-white sm:pl-6">Match</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-zinc-900 dark:text-white">Venue</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-zinc-900 dark:text-white">Date</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-zinc-900 dark:text-white">Status</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-200 bg-white dark:divide-zinc-700 dark:bg-zinc-900">
                                @foreach($matches as $match)
                                
                                {{-- @php dd([
                                    'match' => $match->toArray(),
                                    'players' => $match->player1?->toArray(),
                                    'player1_user' => $match->player1?->user?->toArray(),
                                ]);
                                @endphp  --}}
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                            <div class="font-medium text-zinc-900 dark:text-white">
                                                @if($match->player1 && $match->player2)
                                                    {{ $match->player1->name }} vs {{ $match->player2->name }}
                                                @else
                                                    <span class="text-red-500">Invalid match data</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-zinc-500 dark:text-zinc-400">
                                            {{ $match->venue->name }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-zinc-500 dark:text-zinc-400">
                                            {{ $match->scheduled_at->format('M d, Y H:i') }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm">
                                            <span @class([
                                                'inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset',
                                                'bg-green-50 text-green-700 ring-green-600/20 dark:bg-green-400/10 dark:text-green-400 dark:ring-green-400/20' => $match->status === 'completed',
                                                'bg-yellow-50 text-yellow-700 ring-yellow-600/20 dark:bg-yellow-400/10 dark:text-yellow-400 dark:ring-yellow-400/20' => $match->status === 'in_progress',
                                                'bg-blue-50 text-blue-700 ring-blue-600/20 dark:bg-blue-400/10 dark:text-blue-400 dark:ring-blue-400/20' => $match->status === 'scheduled',
                                            ])>
                                                {{ str($match->status)->title() }}
                                            </span>
                                        </td>
                                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                            <a href="{{ route('admin.tournaments.show', $match) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300" wire:navigate>
                                                View<span class="sr-only">, {{ $match->player1->name }} vs {{ $match->player2->name }}</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Match Modal -->
    <flux:modal name="create-match-modal" :show="$errors->isNotEmpty()" focusable class="max-w-7xl"> <!-- Increased to max-w-7xl -->
        <form wire:submit="createMatch" class="space-y-8">
            <div class="p-8"> <!-- Increased padding from p-6 to p-8 -->
                <!-- Header -->
                <div class="mb-8">
                    <flux:heading size="lg">Schedule New Match</flux:heading>
                    <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">
                        Fill in the details below to schedule a new match
                    </p>
                </div>

                <!-- Fixed height container -->
                <div class="space-y-8 h-[400px] overflow-y-auto px-4"> <!-- Increased space-y-6 to space-y-8 and added px-4 -->
                    <!-- Players Selection -->
                    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2"> <!-- Increased gap-6 to gap-8 -->
                        <div class="w-full">
                            <flux:label for="player1">Player 1</flux:label>
                            <div class="mt-2"> <!-- Added wrapper div with margin -->
                                <flux:select 
                                    wire:model="player1Id"
                                    class="w-full"
                                >
                                    <option value="">Select Player 1</option>
                                    @foreach($players as $player)
                                        <option value="{{ $player->id }}">{{ $player->name }}</option>
                                    @endforeach
                                </flux:select>
                            </div>
                            @error('player1Id') <span class="mt-2 text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div class="w-full">
                            <flux:label for="player2">Player 2</flux:label>
                            <div class="mt-2">
                                <flux:select 
                                    wire:model="player2Id"
                                    class="w-full"
                                >
                                    <option value="">Select Player 2</option>
                                    @foreach($players as $player)
                                        <option value="{{ $player->id }}">{{ $player->name }}</option>
                                    @endforeach
                                </flux:select>
                            </div>
                            @error('player2Id') <span class="mt-2 text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Date and Time -->
                    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2">
                        <div class="w-full">
                            <flux:label for="date">Date</flux:label>
                            <div class="mt-2">
                                <flux:input 
                                    type="date" 
                                    wire:model.live="date"
                                    min="{{ date('Y-m-d') }}"
                                    class="w-full"
                                />
                            </div>
                            @error('date') <span class="mt-2 text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div class="w-full">
                            <flux:label for="startTime">Start Time</flux:label>
                            <div class="mt-2">
                                <flux:input 
                                    type="time" 
                                    wire:model.live="startTime"
                                    class="w-full"
                                />
                            </div>
                            @error('startTime') <span class="mt-2 text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Venue and Court -->
                    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2">
                        <div class="w-full">
                            <flux:label for="venue">Venue</flux:label>
                            <div class="mt-2">
                                <flux:select 
                                    wire:model.live="venueId"
                                    class="w-full"
                                >
                                    <option value="">Select Venue</option>
                                    @foreach($venues as $venue)
                                        <option value="{{ $venue->id }}">{{ $venue->name }}</option>
                                    @endforeach
                                </flux:select>
                            </div>
                            @error('venueId') <span class="mt-2 text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div class="w-full">
                            <flux:label for="court">Court Number</flux:label>
                            <div class="mt-2">
                                <flux:select 
                                    wire:model.live="courtNumber"
                                    class="w-full"
                                >
                                    <option value="">Select Court</option>
                                    @foreach($availableCourts as $court)
                                        <option value="{{ $court }}">Court {{ $court }}</option>
                                    @endforeach
                                </flux:select>
                            </div>
                            @error('courtNumber') <span class="mt-2 text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Umpire Selection -->
                    <div class="w-full">
                        <flux:label for="umpire">Umpire</flux:label>
                        <div class="mt-2">
                            <flux:select 
                                wire:model="umpireId"
                                class="w-full"
                            >
                                <option value="">Select Umpire</option>
                                @foreach($umpires as $umpire)
                                    <option value="{{ $umpire->id }}">{{ $umpire->name }}</option>
                                @endforeach
                            </flux:select>
                        </div>
                        @error('umpireId') <span class="mt-2 text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="flex items-center justify-end gap-3 bg-zinc-50 px-8 py-4 dark:bg-zinc-800/50"> <!-- Increased padding -->
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
