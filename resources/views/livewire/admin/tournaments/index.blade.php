<div>
    <div class="flex items-center justify-between pb-6 border-b border-zinc-200 dark:border-zinc-700">
        <div>
            <h1 class="text-2xl font-semibold text-zinc-900 dark:text-white">Tournaments</h1>
            <p class="mt-2 text-sm text-zinc-700 dark:text-zinc-300">Manage tournament matches and schedules</p>
        </div>

        <flux:button 
            x-on:click="$dispatch('open-modal', 'create-match-modal')"
            variant="primary"
            class="flex items-center bg-green-600 hover:bg-green-700 focus:ring-green-500"
        >
            <svg class="mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Schedule Match
        </flux:button>
    </div>

    <!-- Match Grid -->
    <div class="mt-8">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-3">
            @foreach($matches as $match)
            <div class="group overflow-hidden rounded-xl border-2 border-green-200 bg-white shadow-sm transition-all hover:shadow-md hover:border-green-300 dark:border-green-700 dark:bg-green-900/30 dark:hover:border-green-600">
                <div class="p-6">
                    <!-- Match Header -->
                    <div class="flex items-center justify-between">
                        <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900/30 dark:text-green-400">
                            Court {{ $match->court_number }}
                        </span>
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                            @if($match->isScheduled()) bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400
                            @elseif($match->isLive()) bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400
                            @elseif($match->isCompleted()) bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400
                            @endif">
                            {{ ucfirst($match->status) }}
                        </span>
                    </div>

                    <!-- Players -->
                    <div class="mt-4">
                        <div class="rounded-lg border border-green-100 bg-green-50/50 p-4 dark:border-green-800 dark:bg-green-900/20">
                            <div class="flex items-center justify-between space-x-4">
                                <!-- Player 1 -->
                                <div class="flex items-center space-x-3">
                                    <div class="h-10 w-10 flex-shrink-0 overflow-hidden rounded-full">
                                        @if($match->player1?->player?->profile_photo)
                                            <img 
                                                src="{{ Storage::url($match->player1->player->profile_photo) }}" 
                                                class="h-full w-full object-cover"
                                                alt="{{ $match->player1->name }}"
                                            />
                                        @else
                                            <div class="flex h-full w-full items-center justify-center bg-green-100 dark:bg-green-800/70">
                                                <svg class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <p class="truncate text-sm font-medium text-green-900 dark:text-green-100">{{ $match->player1->name }}</p>
                                        <p class="text-xs text-green-600 dark:text-green-400">Player 1</p>
                                    </div>
                                </div>

                                <div class="flex h-8 w-8 items-center justify-center rounded-full bg-green-100 dark:bg-green-800/50">
                                    <span class="text-sm font-medium text-green-600 dark:text-green-400">vs</span>
                                </div>

                                <!-- Player 2 -->
                                <div class="flex items-center space-x-3">
                                    <div class="h-10 w-10 flex-shrink-0 overflow-hidden rounded-full">
                                        @if($match->player2?->player?->profile_photo)
                                            <img 
                                                src="{{ Storage::url($match->player2->player->profile_photo) }}" 
                                                class="h-full w-full object-cover"
                                                alt="{{ $match->player2->name }}"
                                            />
                                        @else
                                            <div class="flex h-full w-full items-center justify-center bg-green-100 dark:bg-green-800/70">
                                                <svg class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <p class="truncate text-sm font-medium text-green-900 dark:text-green-100">{{ $match->player2->name }}</p>
                                        <p class="text-xs text-green-600 dark:text-green-400">Player 2</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Match Details -->
                    <div class="mt-4 space-y-3">
                        <div class="flex items-center justify-between">
                            <!-- Date -->
                            <div class="flex items-center text-sm text-green-600 dark:text-green-400">
                                <svg class="mr-1.5 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25" />
                                </svg>
                                {{ $match->scheduled_at->format('M d, Y') }}
                            </div>

                            <!-- Time -->
                            <div class="flex items-center text-sm text-green-600 dark:text-green-400">
                                <svg class="mr-1.5 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                @if($match->status === 'completed')
                                    {{ $match->played_at->format('h:i A') }}
                                @else
                                    {{ $match->scheduled_at->format('h:i A') }}
                                @endif
                            </div>
                        </div>

                        <!-- Venue -->
                        <div class="flex items-center text-sm text-green-600 dark:text-green-400">
                            <svg class="mr-1.5 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                            {{ $match->venue->name }}
                        </div>

                        <!-- Umpire -->
                        <div class="flex items-center text-sm text-green-600 dark:text-green-400">
                            <svg class="mr-1.5 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                            </svg>
                            {{ $match->umpire?->name ?? 'Not Assigned' }}
                        </div>
                    </div>

                    <!-- Action Button -->
                    <div class="mt-6">
                        <a href="{{ route('admin.tournaments.show', $match) }}" 
                           class="block w-full rounded-lg border-2 border-green-200 bg-green-50 px-4 py-2.5 text-center text-sm font-medium text-green-700 transition-all 
                                  hover:bg-green-100 hover:text-green-800
                                  dark:bg-green-900/20 dark:text-green-400 dark:hover:bg-green-900/30 dark:hover:text-green-300">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6 pt-6 border-t border-grey-200 dark:border-grey-700">
            {{ $matches->links() }}
        </div>
    </div>

    <!-- Include Create Match Modal -->
    @include('livewire.admin.tournaments.modals.create-match-modal')
</div>
