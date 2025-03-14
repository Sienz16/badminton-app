<div>
    <x-pending-approval-notice />
    
    <!-- Summary Cards -->
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4 mb-6">
        <!-- Today's Matches Card -->
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-zinc-800">
            <div class="flex items-center gap-4">
                <div class="rounded-lg bg-blue-100 p-3 dark:bg-blue-900/30">
                    <flux:icon name="calendar-days" class="size-6 text-blue-600 dark:text-blue-400" />
                </div>
                <div>
                    <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Today's Matches</p>
                    <p class="text-2xl font-semibold text-neutral-900 dark:text-white">{{ $todayMatches->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Live Matches Card -->
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-zinc-800">
            <div class="flex items-center gap-4">
                <div class="rounded-lg bg-red-100 p-3 dark:bg-red-900/30">
                    <flux:icon name="signal" class="size-6 text-red-600 dark:text-red-400" />
                </div>
                <div>
                    <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Live Matches</p>
                    <p class="text-2xl font-semibold text-neutral-900 dark:text-white">{{ $liveMatches->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Upcoming Matches Card -->
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-zinc-800">
            <div class="flex items-center gap-4">
                <div class="rounded-lg bg-green-100 p-3 dark:bg-green-900/30">
                    <flux:icon name="calendar" class="size-6 text-green-600 dark:text-green-400" />
                </div>
                <div>
                    <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Upcoming Matches</p>
                    <p class="text-2xl font-semibold text-neutral-900 dark:text-white">{{ $upcomingMatches->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Past Matches Card -->
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-zinc-800">
            <div class="flex items-center gap-4">
                <div class="rounded-lg bg-purple-100 p-3 dark:bg-purple-900/30">
                    <flux:icon name="clock" class="size-6 text-purple-600 dark:text-purple-400" />
                </div>
                <div>
                    <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Past Matches</p>
                    <p class="text-2xl font-semibold text-neutral-900 dark:text-white">{{ $pastMatches->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <!-- Today's Matches -->
        <div>
            <h2 class="mb-4 text-xl font-semibold text-gray-900 dark:text-white">Today's Matches</h2>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($todayMatches as $match)
                    <div class="group rounded-xl border border-neutral-200 bg-white p-6 transition hover:border-blue-500/50 hover:shadow-lg dark:border-neutral-700 dark:bg-zinc-800">
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">
                                {{ $match->scheduled_at->format('H:i') }}
                            </span>
                            <span class="text-sm text-neutral-500 dark:text-neutral-400">
                                Court {{ $match->court_number }}
                            </span>
                        </div>
                        <div class="mt-4 space-y-4">
                            <div class="flex items-center justify-between gap-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-neutral-100 font-medium text-neutral-900 dark:bg-neutral-800 dark:text-white">
                                        {{ substr($match->player1->name, 0, 2) }}
                                    </div>
                                    <span class="font-medium text-neutral-900 dark:text-white">{{ $match->player1->name }}</span>
                                </div>
                                <span class="text-sm font-semibold text-neutral-500">VS</span>
                                <div class="flex items-center gap-3">
                                    <span class="font-medium text-neutral-900 dark:text-white">{{ $match->player2->name }}</span>
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-neutral-100 font-medium text-neutral-900 dark:bg-neutral-800 dark:text-white">
                                        {{ substr($match->player2->name, 0, 2) }}
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between text-sm text-neutral-600 dark:text-neutral-300">
                                <div class="flex items-center gap-2">
                                    <flux:icon name="map-pin" class="size-4" />
                                    {{ $match->venue->name }}
                                </div>
                                <div class="flex items-center gap-2">
                                    <flux:icon name="user" class="size-4" />
                                    {{ $match->umpireUser?->name ?? 'TBA' }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full rounded-xl border border-neutral-200 p-8 text-center dark:border-neutral-700">
                        <p class="text-neutral-600 dark:text-neutral-400">No matches scheduled for today</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Upcoming Matches -->
        <div>
            <h2 class="mb-4 text-xl font-semibold text-gray-900 dark:text-white">Upcoming Matches</h2>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($upcomingMatches as $match)
                    <div class="group rounded-xl border border-neutral-200 bg-white p-6 transition hover:border-blue-500/50 hover:shadow-lg dark:border-neutral-700 dark:bg-zinc-800">
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">
                                {{ $match->scheduled_at->format('M d, Y - H:i') }}
                            </span>
                            <span class="text-sm text-neutral-500 dark:text-neutral-400">
                                Court {{ $match->court_number }}
                            </span>
                        </div>
                        <div class="mt-4 space-y-4">
                            <div class="flex items-center justify-between gap-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-neutral-100 font-medium text-neutral-900 dark:bg-neutral-800 dark:text-white">
                                        {{ substr($match->player1->name, 0, 2) }}
                                    </div>
                                    <span class="font-medium text-neutral-900 dark:text-white">{{ $match->player1->name }}</span>
                                </div>
                                <span class="text-sm font-semibold text-neutral-500">VS</span>
                                <div class="flex items-center gap-3">
                                    <span class="font-medium text-neutral-900 dark:text-white">{{ $match->player2->name }}</span>
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-neutral-100 font-medium text-neutral-900 dark:bg-neutral-800 dark:text-white">
                                        {{ substr($match->player2->name, 0, 2) }}
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between text-sm text-neutral-600 dark:text-neutral-300">
                                <div class="flex items-center gap-2">
                                    <flux:icon name="map-pin" class="size-4" />
                                    {{ $match->venue->name }}
                                </div>
                                <div class="flex items-center gap-2">
                                    <flux:icon name="user" class="size-4" />
                                    {{ $match->umpireUser?->name ?? 'TBA' }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full rounded-xl border border-neutral-200 p-8 text-center dark:border-neutral-700">
                        <p class="text-neutral-600 dark:text-neutral-400">No upcoming matches</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Live Matches -->
        <div>
            <h2 class="mb-4 text-xl font-semibold text-gray-900 dark:text-white">Live Matches</h2>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($liveMatches as $match)
                    <div class="rounded-xl border border-red-500/30 bg-white p-6 shadow-md dark:bg-zinc-800">
                        <div class="flex items-center justify-between">
                            <div class="inline-flex items-center gap-2">
                                <span class="relative flex h-3 w-3">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                                </span>
                                <span class="text-sm font-medium text-red-500">LIVE NOW</span>
                            </div>
                            <span class="text-sm text-neutral-500 dark:text-neutral-400">
                                Court {{ $match->court_number }}
                            </span>
                        </div>
                        <div class="mt-4 space-y-4">
                            <div class="flex items-center justify-between gap-4">
                                <div class="flex flex-col items-start gap-1">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-neutral-100 font-medium text-neutral-900 dark:bg-neutral-800 dark:text-white">
                                            {{ substr($match->player1->name, 0, 2) }}
                                        </div>
                                        <span class="font-medium text-neutral-900 dark:text-white">{{ $match->player1->name }}</span>
                                    </div>
                                    <span class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $match->currentSet?->player1_score ?? 0 }}</span>
                                </div>
                                <span class="text-lg font-semibold text-neutral-500">VS</span>
                                <div class="flex flex-col items-end gap-1">
                                    <div class="flex items-center gap-3">
                                        <span class="font-medium text-neutral-900 dark:text-white">{{ $match->player2->name }}</span>
                                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-neutral-100 font-medium text-neutral-900 dark:bg-neutral-800 dark:text-white">
                                            {{ substr($match->player2->name, 0, 2) }}
                                        </div>
                                    </div>
                                    <span class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $match->currentSet?->player2_score ?? 0 }}</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between text-sm text-neutral-600 dark:text-neutral-300">
                                <div class="flex items-center gap-2">
                                    <flux:icon name="map-pin" class="size-4" />
                                    {{ $match->venue->name }}
                                </div>
                                <div class="flex items-center gap-2">
                                    <flux:icon name="user" class="size-4" />
                                    {{ $match->umpireUser?->name ?? 'TBA' }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full rounded-xl border border-neutral-200 p-8 text-center dark:border-neutral-700">
                        <p class="text-neutral-600 dark:text-neutral-400">No live matches</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Past Matches -->
        <div>
            <h2 class="mb-4 text-xl font-semibold text-gray-900 dark:text-white">Past Matches</h2>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($pastMatches as $match)
                    <div class="group rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-zinc-800 
                                transition duration-300 ease-in-out hover:border-blue-500/50 hover:shadow-lg hover:scale-[1.02]
                                cursor-pointer relative overflow-hidden">
                        <!-- Subtle gradient overlay on hover -->
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-500/0 to-purple-500/0 opacity-0 
                                    group-hover:opacity-5 transition-opacity duration-300"></div>
                        
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-neutral-100 px-3 py-1 text-xs 
                                       font-medium text-neutral-700 dark:bg-neutral-800 dark:text-neutral-300
                                       group-hover:bg-blue-100 group-hover:text-blue-700 
                                       dark:group-hover:bg-blue-900/30 dark:group-hover:text-blue-400
                                       transition-colors duration-300">
                                {{ $match->played_at?->format('M d, Y - H:i') }}
                            </span>
                            <span class="text-sm text-neutral-500 dark:text-neutral-400">
                                Court {{ $match->court_number }}
                            </span>
                        </div>

                        <!-- Set Scores -->
                        <div class="mt-4 flex items-center justify-center gap-4">
                            @foreach($match->matchSets as $set)
                                <div class="flex flex-col items-center">
                                    <span class="text-xs font-medium text-neutral-500 dark:text-neutral-400 mb-1">
                                        Set {{ $loop->iteration }}
                                    </span>
                                    <div class="flex items-center">
                                        <span class="text-lg font-semibold {{ 
                                            $set->winner_id === $match->player1_id 
                                                ? 'text-green-600 dark:text-green-400' 
                                                : 'text-red-600 dark:text-red-400' 
                                        }}">
                                            {{ $set->player1_score }}
                                        </span>
                                        <span class="text-neutral-400 mx-2 text-lg">-</span>
                                        <span class="text-lg font-semibold {{ 
                                            $set->winner_id === $match->player2_id 
                                                ? 'text-green-600 dark:text-green-400' 
                                                : 'text-red-600 dark:text-red-400' 
                                        }}">
                                            {{ $set->player2_score }}
                                        </span>
                                    </div>
                                </div>
                                @if(!$loop->last)
                                    <span class="text-neutral-300 dark:text-neutral-600">|</span>
                                @endif
                            @endforeach
                        </div>

                        <div class="mt-4 space-y-4">
                            <div class="flex items-center justify-between gap-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full 
                                              bg-neutral-100 font-medium text-neutral-900 
                                              dark:bg-neutral-800 dark:text-white
                                              group-hover:bg-blue-100 group-hover:text-blue-700
                                              dark:group-hover:bg-blue-900/30 dark:group-hover:text-blue-400
                                              transition-colors duration-300">
                                        {{ substr($match->player1->name, 0, 2) }}
                                    </div>
                                    <span class="font-medium text-neutral-900 dark:text-white">{{ $match->player1->name }}</span>
                                </div>
                                <span class="text-sm font-semibold text-neutral-500 group-hover:text-blue-500 transition-colors duration-300">VS</span>
                                <div class="flex items-center gap-3">
                                    <span class="font-medium text-neutral-900 dark:text-white">{{ $match->player2->name }}</span>
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full 
                                              bg-neutral-100 font-medium text-neutral-900 
                                              dark:bg-neutral-800 dark:text-white
                                              group-hover:bg-blue-100 group-hover:text-blue-700
                                              dark:group-hover:bg-blue-900/30 dark:group-hover:text-blue-400
                                              transition-colors duration-300">
                                        {{ substr($match->player2->name, 0, 2) }}
                                    </div>
                                </div>
                            </div>

                            @if($match->final_winner_id)
                                <div class="flex items-center justify-center gap-2 rounded-full 
                                          bg-green-100 px-4 py-2 dark:bg-green-900/30
                                          group-hover:bg-green-200 dark:group-hover:bg-green-800/40
                                          transition-colors duration-300">
                                    <span class="text-sm font-medium text-green-700 dark:text-green-400">
                                        Winner: {{ $match->final_winner_id === $match->player1->id 
                                            ? $match->player1->name 
                                            : $match->player2->name }} 👑
                                    </span>
                                </div>
                            @endif

                            <div class="flex items-center justify-between text-sm text-neutral-600 dark:text-neutral-300">
                                <div class="flex items-center gap-2 group-hover:text-blue-500 transition-colors duration-300">
                                    <flux:icon name="map-pin" class="size-4" />
                                    {{ $match->venue->name }}
                                </div>
                                <div class="flex items-center gap-2 group-hover:text-blue-500 transition-colors duration-300">
                                    <flux:icon name="user" class="size-4" />
                                    {{ $match->umpireUser?->name ?? 'N/A' }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full rounded-xl border border-neutral-200 p-8 text-center dark:border-neutral-700">
                        <p class="text-neutral-600 dark:text-neutral-400">No past matches</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
