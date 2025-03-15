<div>
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <!-- Stats Overview -->
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Total Users Card -->
            <div class="rounded-xl border-2 border-green-400/50 bg-white p-6 dark:border-green-600/50 dark:bg-green-900/30">
                <div class="flex items-center gap-4">
                    <div class="rounded-lg bg-blue-100 p-3 dark:bg-blue-900/30">
                        <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-green-700 dark:text-green-300">Today's Matches</p>
                        <p class="text-2xl font-semibold text-green-900 dark:text-green-50">{{ $todayMatches }}</p>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-green-600 dark:text-green-400">
                    <span>{{ $liveMatchesCount > 0 ? $liveMatchesCount . ' matches in progress' : 'No matches in progress' }}</span>
                </div>
            </div>

            <!-- Active Venues Card -->
            <div class="rounded-xl border-2 border-green-400/50 bg-white p-6 dark:border-green-600/50 dark:bg-green-900/30">
                <div class="flex items-center gap-4">
                    <div class="rounded-lg bg-purple-100 p-3 dark:bg-purple-900/30">
                        <svg class="h-6 w-6 text-purple-600 dark:text-purple-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-neutral-600 dark:text-neutral-400">Active Venues</p>
                        <p class="text-2xl font-semibold text-neutral-900 dark:text-white">{{ $activeVenues }}</p>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-neutral-600 dark:text-neutral-400">
                    <span>{{ $totalCourts }} available courts</span>
                </div>
            </div>

            <!-- Today's Matches Card -->
            <div class="rounded-xl border-2 border-green-400/50 bg-white p-6 dark:border-green-600/50 dark:bg-green-900/30">
                <div class="flex items-center gap-4">
                    <div class="rounded-lg bg-amber-100 p-3 dark:bg-amber-900/30">
                        <svg class="h-6 w-6 text-amber-600 dark:text-amber-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 002.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 012.916.52 6.003 6.003 0 01-5.395 4.972m0 0a6.726 6.726 0 01-2.749 1.35m0 0a6.772 6.772 0 01-3.044 0" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-neutral-600 dark:text-neutral-400">Today's Matches</p>
                        <p class="text-2xl font-semibold text-neutral-900 dark:text-white">{{ $todayMatches }}</p>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-neutral-600 dark:text-neutral-400">
                    <span>{{ $liveMatchesCount > 0 ? $liveMatchesCount . ' matches in progress' : 'No matches in progress' }}</span>
                </div>
            </div>

            <!-- Pending Approvals Card -->
            <div class="rounded-xl border-2 border-green-400/50 bg-white p-6 dark:border-green-600/50 dark:bg-green-900/30">
                <div class="flex items-center gap-4">
                    <div class="rounded-lg bg-red-100 p-3 dark:bg-red-900/30">
                        <svg class="h-6 w-6 text-red-600 dark:text-red-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-neutral-600 dark:text-neutral-400">Pending Approvals</p>
                        <p class="text-2xl font-semibold text-neutral-900 dark:text-white">{{ $pendingApprovals }}</p>
                    </div>
                </div>
                <a href="{{ route('admin.users') }}" class="mt-4 inline-flex items-center text-sm text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300">
                    Review requests
                    <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Matches Grid -->
        <div class="grid gap-6 lg:grid-cols-3">
            <!-- Upcoming Matches -->
            <div class="rounded-xl border-2 border-green-400/50 bg-white p-6 dark:border-green-600/50 dark:bg-green-900/30">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-green-900 dark:text-green-50">Upcoming Matches</h2>
                    <a href="{{ route('admin.tournaments') }}" class="text-sm text-green-600 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300" wire:navigate>
                        View all
                    </a>
                </div>
                <div class="mt-6 space-y-4">
                    @forelse($upcomingMatches as $match)
                        <div class="group rounded-lg border border-green-400/30 bg-green-50/50 p-4 transition hover:border-green-500/50 dark:border-green-600/30 dark:bg-green-800/20 dark:hover:border-green-500/50">
                            <!-- Header: Date -->
                            <div class="flex items-center justify-between mb-3">
                                <div class="text-sm text-green-600 dark:text-green-400">
                                    <div>{{ $match->scheduled_at->format('M d, Y') }}</div>
                                    <div>{{ $match->scheduled_at->format('H:i') }}</div>
                                </div>
                            </div>

                            <!-- Players -->
                            <div class="text-center mb-4">
                                <div class="font-medium text-lg text-green-900 dark:text-green-50">
                                    {{ $match->player1?->name ?? 'Player 1' }}
                                    <span class="text-green-500 dark:text-green-600 mx-2">vs</span>
                                    {{ $match->player2?->name ?? 'Player 2' }}
                                </div>
                            </div>

                            <!-- Footer Info -->
                            <div class="flex items-center justify-between text-sm text-green-600 dark:text-green-400">
                                <div class="flex items-center gap-1">
                                    <flux:icon name="map-pin" class="size-4" />
                                    {{ $match->venue?->name }}
                                </div>
                                <div class="flex items-center gap-1">
                                    <flux:icon name="layout-grid" class="size-4" />
                                    Court {{ $match->court_number }}
                                </div>
                                <div class="flex items-center gap-1">
                                    <flux:icon name="user" class="size-4" />
                                    {{ $match->umpireUser?->name ?? 'No umpire' }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-lg border-2 border-dashed border-green-400/50 p-6 text-center dark:border-green-600/50">
                            <div class="mx-auto h-12 w-12 text-green-400 dark:text-green-600">
                                <flux:icon name="calendar" class="h-12 w-12" />
                            </div>
                            <h3 class="mt-2 text-sm font-medium text-green-900 dark:text-green-50">No Upcoming Matches</h3>
                            <p class="mt-1 text-sm text-green-600 dark:text-green-400">No matches are currently scheduled.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Live Matches -->
            <div class="rounded-xl border-2 border-green-400/50 bg-white p-6 dark:border-green-600/50 dark:bg-green-900/30">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-green-900 dark:text-green-50">Live Matches</h2>
                    <a href="{{ route('admin.tournaments') }}" class="text-sm text-green-600 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300" wire:navigate>
                        View all
                    </a>
                </div>
                <div class="mt-6 space-y-4">
                    @forelse($liveMatches as $match)
                        <div class="group rounded-lg border border-red-500/50 bg-red-50/50 p-4 transition hover:border-red-600/50 dark:border-red-500/30 dark:bg-red-900/5 dark:hover:border-red-400/50">
                            <!-- Header: Live Badge -->
                            <div class="flex items-center justify-between mb-3">
                                <div class="text-sm text-neutral-500 dark:text-neutral-400">
                                    <div>{{ $match->scheduled_at->format('M d, Y') }}</div>
                                    <div>{{ $match->scheduled_at->format('H:i') }}</div>
                                </div>
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-red-100 px-3 py-1 text-xs font-medium text-red-700 dark:bg-red-900/30 dark:text-red-400">
                                    <span class="relative flex h-2 w-2">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                                    </span>
                                    LIVE
                                </span>
                            </div>

                            <!-- Players -->
                            <div class="text-center mb-4">
                                <div class="font-medium text-lg text-neutral-900 dark:text-white">
                                    {{ $match->player1?->name ?? 'Player 1' }}
                                    <span class="text-neutral-400 dark:text-neutral-500 mx-2">vs</span>
                                    {{ $match->player2?->name ?? 'Player 2' }}
                                </div>
                            </div>

                            <!-- Footer Info -->
                            <div class="flex items-center justify-between text-sm text-neutral-600 dark:text-neutral-400">
                                <div class="flex items-center gap-1">
                                    <flux:icon name="map-pin" class="size-4" />
                                    {{ $match->venue?->name }}
                                </div>
                                <div class="flex items-center gap-1">
                                    <flux:icon name="layout-grid" class="size-4" />
                                    Court {{ $match->court_number }}
                                </div>
                                <div class="flex items-center gap-1">
                                    <flux:icon name="user" class="size-4" />
                                    {{ $match->umpireUser?->name ?? 'No umpire' }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-lg border-2 border-dashed border-green-400/50 p-6 text-center dark:border-green-600/50">
                            <div class="mx-auto h-12 w-12 text-green-400 dark:text-green-600">
                                <flux:icon name="play-circle" class="h-12 w-12" />
                            </div>
                            <h3 class="mt-2 text-sm font-medium text-green-900 dark:text-green-50">No Live Matches</h3>
                            <p class="mt-1 text-sm text-green-600 dark:text-green-400">There are no matches being played right now.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Recent Matches -->
            <div class="rounded-xl border-2 border-green-400/50 bg-white p-6 dark:border-green-600/50 dark:bg-green-900/30">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-green-900 dark:text-green-50">Recent Matches</h2>
                    <a href="{{ route('admin.tournaments') }}" class="text-sm text-green-600 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300" wire:navigate>
                        View all
                    </a>
                </div>
                <div class="mt-6 space-y-4">
                    @forelse($recentMatches as $match)
                        <div class="group rounded-lg border border-green-400/30 bg-green-50/50 p-4 transition hover:border-green-500/50 dark:border-green-600/30 dark:bg-green-800/20 dark:hover:border-green-500/50">
                            <!-- Header: Date and Winner -->
                            <div class="flex items-center justify-between mb-3">
                                <div class="text-sm text-green-600 dark:text-green-400">
                                    <div>{{ $match->played_at->format('M d, Y') }}</div>
                                    <div>{{ $match->played_at->format('H:i') }}</div>
                                </div>
                                @if($match->final_winner_id)
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm font-medium text-green-600 dark:text-green-400">
                                            {{ $match->winner?->name }}
                                        </span>
                                        <span class="text-xl">👑</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Players -->
                            <div class="text-center mb-4">
                                <div class="font-medium text-lg text-green-900 dark:text-green-50">
                                    {{ $match->player1?->name ?? 'Player 1' }}
                                    <span class="text-green-500 dark:text-green-600 mx-2">vs</span>
                                    {{ $match->player2?->name ?? 'Player 2' }}
                                </div>
                            </div>

                            <!-- Set Scores -->
                            <div class="mb-4 grid grid-cols-3 gap-3 bg-white dark:bg-neutral-800 rounded-lg p-3 border-2 border-green-500">
                                @foreach($match->matchSets as $set)
                                    <div class="text-center">
                                        <div class="text-xs font-medium text-neutral-500 dark:text-neutral-400">SET {{ $set->set_number }}</div>
                                        <div class="flex items-center justify-center gap-2 mt-1">
                                            <span class="text-sm font-bold {{ 
                                                $set->winner_id === $match->player1_id 
                                                    ? 'text-green-600 dark:text-green-400' 
                                                    : 'text-red-600 dark:text-red-400' 
                                            }}">
                                                {{ $set->player1_score }}
                                            </span>
                                            <span class="text-xs text-neutral-400">-</span>
                                            <span class="text-sm font-bold {{ 
                                                $set->winner_id === $match->player2_id 
                                                    ? 'text-green-600 dark:text-green-400' 
                                                    : 'text-red-600 dark:text-red-400' 
                                            }}">
                                                {{ $set->player2_score }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Footer Info -->
                            <div class="grid grid-cols-3 gap-2 text-sm text-green-600 dark:text-green-400">
                                <div class="flex items-center gap-1">
                                    <flux:icon name="map-pin" class="size-4" />
                                    <span class="truncate">{{ $match->venue?->name }}</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <flux:icon name="layout-grid" class="size-4" />
                                    <span>Court {{ $match->court_number }}</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <flux:icon name="user" class="size-4" />
                                    <span class="truncate">{{ $match->umpireUser?->name ?? 'No umpire' }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-lg border-2 border-dashed border-green-400/50 p-6 text-center dark:border-green-600/50">
                            <div class="mx-auto h-12 w-12 text-green-400 dark:text-green-600">
                                <flux:icon name="trophy" class="h-12 w-12" />
                            </div>
                            <h3 class="mt-2 text-sm font-medium text-green-900 dark:text-green-50">No Recent Matches</h3>
                            <p class="mt-1 text-sm text-green-600 dark:text-green-400">No matches have been completed yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
