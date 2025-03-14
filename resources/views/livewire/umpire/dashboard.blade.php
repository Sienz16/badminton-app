<div>
    <x-pending-approval-notice />
    
    <div class="flex h-full w-full flex-1 flex-col gap-8">
        <!-- Stats Overview -->
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-zinc-900">
                <div class="flex items-center gap-4">
                    <div class="rounded-lg bg-blue-100 p-3 dark:bg-blue-900/30">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-blue-600 dark:text-blue-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-neutral-600 dark:text-neutral-400">Today's Matches</p>
                        <p class="text-2xl font-semibold text-neutral-900 dark:text-white">{{ $todayMatches->count() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-zinc-900">
                <div class="flex items-center gap-4">
                    <div class="rounded-lg bg-red-100 p-3 dark:bg-red-900/30">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-red-600 dark:text-red-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.348 14.651a3.75 3.75 0 010-5.303m5.304 0a3.75 3.75 0 010 5.303m-7.425 2.122a6.75 6.75 0 010-9.546m9.546 0a6.75 6.75 0 010 9.546M5.106 18.894c-3.808-3.808-3.808-9.98 0-13.789m13.788 0c3.808 3.808 3.808 9.981 0 13.79M12 12h.008v.007H12V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-neutral-600 dark:text-neutral-400">Live Matches</p>
                        <p class="text-2xl font-semibold text-neutral-900 dark:text-white">{{ $allLiveMatches->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-zinc-900">
                <div class="flex items-center gap-4">
                    <div class="rounded-lg bg-amber-100 p-3 dark:bg-amber-900/30">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-amber-600 dark:text-amber-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-neutral-600 dark:text-neutral-400">Upcoming</p>
                        <p class="text-2xl font-semibold text-neutral-900 dark:text-white">{{ $upcomingMatches->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-zinc-900">
                <div class="flex items-center gap-4">
                    <div class="rounded-lg bg-green-100 p-3 dark:bg-green-900/30">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-green-600 dark:text-green-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-neutral-600 dark:text-neutral-400">Past Matches</p>
                        <p class="text-2xl font-semibold text-neutral-900 dark:text-white">{{ $pastMatches->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Today's Matches Section -->
        <div>
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Today's Matches</h2>
                <a href="{{ route('umpire.matches') }}" class="inline-flex items-center gap-1 text-sm text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300" wire:navigate>
                    View all
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4">
                        <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($todayMatches as $match)
                    <!-- Match Card Template - Used for Today's and Upcoming Matches -->
                    <a href="{{ route('umpire.matches.show', $match) }}" 
                       class="group relative block overflow-hidden rounded-xl border 
                              {{ $match->isAssignedToMe ? 'border-blue-500/50' : 'border-neutral-200' }} 
                              bg-white dark:bg-zinc-900 
                              transition duration-300 ease-in-out
                              hover:border-blue-500/50 hover:shadow-lg hover:scale-[1.02]
                              dark:border-neutral-700 dark:hover:border-blue-500/50"
                       wire:navigate>
                        
                        <!-- Subtle gradient overlay on hover -->
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-500/0 to-purple-500/0 opacity-0 
                                    group-hover:opacity-5 transition-opacity duration-300"></div>

                        <!-- Assigned to me badge -->
                        @if($match->isAssignedToMe)
                            <div class="absolute left-4 top-4">
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-blue-100 px-3 py-1 text-xs 
                                           font-medium text-blue-700 dark:bg-blue-900/30 dark:text-blue-400
                                           group-hover:bg-blue-200 dark:group-hover:bg-blue-800/40
                                           transition-colors duration-300">
                                    Assigned to me
                                </span>
                            </div>
                        @endif

                        <!-- Status Badge and Court (Top Right) -->
                        <div class="absolute right-4 top-4 flex items-center gap-2">
                            @if($match->court_number)
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-neutral-100 px-3 py-1 text-xs 
                                           font-medium text-neutral-600 dark:bg-neutral-800 dark:text-neutral-400
                                           group-hover:bg-blue-100 group-hover:text-blue-700 
                                           dark:group-hover:bg-blue-900/30 dark:group-hover:text-blue-400
                                           transition-colors duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                                    </svg>
                                    Court {{ $match->court_number }}
                                </span>
                            @endif

                            @if($match->isLive())
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-red-100 px-3 py-1 text-xs 
                                           font-medium text-red-700 dark:bg-red-900/30 dark:text-red-400
                                           group-hover:bg-red-200 dark:group-hover:bg-red-800/40
                                           transition-colors duration-300">
                                    <span class="relative flex h-2 w-2">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                                    </span>
                                    LIVE
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-neutral-100 px-3 py-1 text-xs 
                                           font-medium text-neutral-600 dark:bg-neutral-800 dark:text-neutral-400
                                           group-hover:bg-blue-100 group-hover:text-blue-700 
                                           dark:group-hover:bg-blue-900/30 dark:group-hover:text-blue-400
                                           transition-colors duration-300">
                                    {{ $match->scheduled_at->format('H:i') }}
                                </span>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="p-6 flex flex-col space-y-4">
                            <!-- Match Info -->
                            <div class="mb-3">
                                <div class="text-sm text-neutral-500 dark:text-neutral-400">
                                    Court {{ $match->court_number }} • {{ $match->venue->name }}
                                </div>
                            </div>

                            <!-- Players Section -->
                            <div class="flex items-center justify-between gap-4">
                                <!-- Player 1 -->
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full 
                                              bg-neutral-100 font-medium text-neutral-900 
                                              dark:bg-neutral-800 dark:text-white
                                              group-hover:bg-blue-100 group-hover:text-blue-700
                                              dark:group-hover:bg-blue-900/30 dark:group-hover:text-blue-400
                                              transition-colors duration-300">
                                        {{ substr($match->player1->name, 0, 2) }}
                                    </div>
                                    <span class="font-medium {{ $match->final_winner_id === $match->player1_id 
                                        ? 'text-green-600 dark:text-green-400' 
                                        : 'text-neutral-900 dark:text-white' }}">
                                        {{ $match->player1->name }}
                                        @if($match->final_winner_id === $match->player1_id)
                                            <span class="ml-2">👑</span>
                                        @endif
                                    </span>
                                </div>

                                <!-- VS -->
                                <div class="text-sm font-semibold text-neutral-500 group-hover:text-blue-500 transition-colors duration-300">
                                    VS
                                </div>

                                <!-- Player 2 -->
                                <div class="flex items-center gap-3">
                                    <span class="font-medium text-right {{ $match->final_winner_id === $match->player2_id 
                                        ? 'text-green-600 dark:text-green-400' 
                                        : 'text-neutral-900 dark:text-white' }}">
                                        {{ $match->player2->name }}
                                        @if($match->final_winner_id === $match->player2_id)
                                            <span class="ml-2">👑</span>
                                        @endif
                                    </span>
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

                            <!-- Set Scores -->
                            <div class="mt-2 flex justify-center gap-4 text-sm text-neutral-600 dark:text-neutral-400">
                                @foreach($match->sets as $set)
                                    <span>{{ $set->player1_score }}-{{ $set->player2_score }}</span>
                                    @if(!$loop->last)
                                        <span class="text-neutral-300 dark:text-neutral-600">|</span>
                                    @endif
                                @endforeach
                            </div>

                            <!-- Match Info -->
                            <div class="flex items-center justify-between text-sm">
                                <div class="flex items-center gap-2 text-neutral-600 dark:text-neutral-400
                                          group-hover:text-blue-500 transition-colors duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4">
                                        <path fill-rule="evenodd" d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 00.281-.14c.186-.096.446-.24.757-.433.62-.384 1.445-.966 2.274-1.765C15.302 14.988 17 12.493 17 9A7 7 0 103 9c0 3.492 1.698 5.988 3.355 7.584a13.731 13.731 0 002.273 1.765 11.842 11.842 0 00.976.544l.062.029.018.008.006.003zM10 11.25a2.25 2.25 0 100-4.5 2.25 2.25 0 000 4.5z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $match->venue->name }}
                                </div>
                                <div class="text-neutral-500 dark:text-neutral-400 group-hover:text-blue-500 transition-colors duration-300">
                                    {{ $match->scheduled_at->format('H:i') }}
                                </div>
                            </div>

                            <!-- Add Umpire info if not assigned to current user -->
                            @if(!$match->isAssignedToMe)
                                <div class="mt-2 text-sm text-neutral-500 dark:text-neutral-400 
                                          group-hover:text-blue-500 transition-colors duration-300">
                                    Umpire: {{ $match->umpire ? $match->umpire->name : 'Not assigned' }}
                                </div>
                            @endif
                        </div>
                    </a>
                @empty
                    <div class="col-span-full rounded-xl border border-neutral-200 p-8 text-center dark:border-neutral-700">
                        <p class="text-neutral-600 dark:text-neutral-400">No matches scheduled for today</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Live Matches -->
        <div>
            <h2 class="mb-4 text-xl font-semibold text-gray-900 dark:text-white">Live Matches</h2>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($allLiveMatches as $match)
                    <div class="group relative block overflow-hidden rounded-xl border border-red-500/30 bg-white p-4 dark:bg-zinc-900">
                        <!-- Live Indicator -->
                        <div class="absolute right-4 top-4">
                            <span class="inline-flex items-center gap-1 rounded-full bg-red-100 px-2 py-1 text-xs font-medium text-red-700 dark:bg-red-900/30 dark:text-red-400">
                                <span class="relative flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                                </span>
                                LIVE
                            </span>
                        </div>

                        <!-- Match Info -->
                        <div class="mt-2">
                            <div class="mb-3">
                                <div class="text-sm text-neutral-500 dark:text-neutral-400">
                                    Court {{ $match->court_number }} • {{ $match->venue->name }}
                                </div>
                            </div>

                            <!-- Players -->
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div class="h-8 w-8 rounded-full bg-neutral-100 dark:bg-neutral-800"></div>
                                        <span class="font-medium text-neutral-900 dark:text-white">{{ $match->player1->name }}</span>
                                    </div>
                                    <div class="text-lg font-semibold text-neutral-900 dark:text-white">
                                        {{ $match->matchSets->last()?->player1_score ?? 0 }}
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div class="h-8 w-8 rounded-full bg-neutral-100 dark:bg-neutral-800"></div>
                                        <span class="font-medium text-neutral-900 dark:text-white">{{ $match->player2->name }}</span>
                                    </div>
                                    <div class="text-lg font-semibold text-neutral-900 dark:text-white">
                                        {{ $match->matchSets->last()?->player2_score ?? 0 }}
                                    </div>
                                </div>
                            </div>

                            <!-- Set History -->
                            <div class="mt-4 flex items-center gap-2">
                                @foreach($match->matchSets as $set)
                                    <div class="flex-1 rounded bg-neutral-100 px-2 py-1 text-center text-xs dark:bg-neutral-800">
                                        <span class="font-medium text-neutral-900 dark:text-white">
                                            {{ $set->player1_score }}-{{ $set->player2_score }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Action Button -->
                            <div class="mt-4">
                                <a href="{{ route('umpire.matches.show', $match) }}" 
                                   class="block w-full rounded-lg bg-red-50 px-4 py-2 text-center text-sm font-medium text-red-700 hover:bg-red-100 dark:bg-red-900/30 dark:text-red-400 dark:hover:bg-red-900/50"
                                   wire:navigate>
                                    View Match
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full rounded-xl border-2 border-dashed border-neutral-200 p-8 text-center dark:border-neutral-800">
                        <div class="mx-auto h-12 w-12 text-neutral-400 dark:text-neutral-600">
                            <svg class="h-12 w-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                        </div>
                        <h3 class="mt-2 text-sm font-medium text-neutral-900 dark:text-white">No Live Matches</h3>
                        <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">There are no matches being played right now.</p>
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

        <!-- Past Matches Section -->
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

                        <div class="mt-4 space-y-4">
                            <!-- Players -->
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

                            <!-- Match Winner -->
                            @if($match->final_winner_id)
                                <div class="mt-4 flex items-center justify-center gap-2 rounded-full 
                                          bg-green-100 px-4 py-2 dark:bg-green-900/30
                                          group-hover:bg-green-200 dark:group-hover:bg-green-800/40
                                          transition-colors duration-300">
                                    <span class="text-sm font-medium text-green-700 dark:text-green-400">
                                        Winner: {{ $match->final_winner_id === $match->player1_id 
                                            ? $match->player1->name 
                                            : $match->player2->name }} 👑
                                    </span>
                                </div>
                            @endif

                            <!-- Footer Info -->
                            <div class="mt-4 flex justify-between items-center text-sm text-neutral-600 dark:text-neutral-400">
                                <div class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                    </svg>
                                    <span class="truncate">
                                        {{ $match->venue->name }}
                                    </span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                    </svg>
                                    <span class="truncate">
                                        {{ $match->umpireUser?->name ?? 'No umpire assigned' }}
                                    </span>
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
