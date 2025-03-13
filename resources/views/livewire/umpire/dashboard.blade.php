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
                        <p class="text-sm text-neutral-600 dark:text-neutral-400">Completed</p>
                        <p class="text-2xl font-semibold text-neutral-900 dark:text-white">{{ $recentMatches->count() }}</p>
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
                    <a href="{{ route('umpire.matches.show', $match) }}" 
                       class="group relative block overflow-hidden rounded-xl border {{ $match->isAssignedToMe ? 'border-blue-500/50' : 'border-neutral-200' }} bg-white p-6 transition hover:border-blue-500/50 hover:shadow-sm dark:border-neutral-700 dark:bg-zinc-900 dark:hover:border-blue-500/50"
                       wire:navigate>
                        
                        <!-- Assigned to me badge -->
                        @if($match->isAssignedToMe)
                            <div class="absolute left-4 top-4">
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">
                                    Assigned to me
                                </span>
                            </div>
                        @endif

                        <!-- Status Badge (Live or Time) -->
                        <div class="absolute right-4 top-4">
                            @if($match->isLive())
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-red-100 px-3 py-1 text-xs font-medium text-red-700 dark:bg-red-900/30 dark:text-red-400">
                                    <span class="relative flex h-2 w-2">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                                    </span>
                                    LIVE
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-neutral-100 px-3 py-1 text-xs font-medium text-neutral-600 dark:bg-neutral-800 dark:text-neutral-400">
                                    {{ $match->scheduled_at->format('H:i') }}
                                </span>
                            @endif
                        </div>

                        <div class="flex flex-col space-y-4">
                            <!-- Players Section -->
                            <div class="flex items-center justify-between gap-4">
                                <!-- Player 1 -->
                                <div class="flex items-center gap-2">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-neutral-100 font-medium text-neutral-900 dark:bg-neutral-800 dark:text-white">
                                        {{ substr($match->player1->name, 0, 2) }}
                                    </div>
                                    <span class="font-medium {{ $match->final_winner_id === $match->player1_id ? 'text-green-600 dark:text-green-400' : 'text-neutral-900 dark:text-white' }}">
                                        {{ $match->player1->name }}
                                        @if($match->final_winner_id === $match->player1_id)
                                            <span class="ml-2">👑</span>
                                        @endif
                                    </span>
                                </div>

                                <!-- VS -->
                                <div class="text-sm font-medium text-neutral-500 dark:text-neutral-400">
                                    VS
                                </div>

                                <!-- Player 2 -->
                                <div class="flex items-center gap-2">
                                    <span class="font-medium text-right {{ $match->final_winner_id === $match->player2_id ? 'text-green-600 dark:text-green-400' : 'text-neutral-900 dark:text-white' }}">
                                        {{ $match->player2->name }}
                                        @if($match->final_winner_id === $match->player2_id)
                                            <span class="ml-2">👑</span>
                                        @endif
                                    </span>
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-neutral-100 font-medium text-neutral-900 dark:bg-neutral-800 dark:text-white">
                                        {{ substr($match->player2->name, 0, 2) }}
                                    </div>
                                </div>
                            </div>

                            <!-- Sets Section -->
                            @if(($match->isLive() || $match->isCompleted()) && $match->matchDetails)
                                <div class="flex items-center justify-center gap-4">
                                    @foreach($match->matchDetails as $setNumber => $set)
                                        <div class="flex items-center gap-1">
                                            <span class="text-xs text-neutral-500 dark:text-neutral-400">Set {{ $setNumber }}</span>
                                            <span class="text-sm font-medium {{ $match->isLive() ? 'text-red-600 dark:text-red-400' : 'text-neutral-900 dark:text-neutral-100' }}">
                                                {{ $set['player1'] }}-{{ $set['player2'] }}
                                            </span>
                                            @if($set['winner_id'])
                                                <span class="text-xs">
                                                    {{ $set['winner_id'] === $match->player1_id ? '(P1)' : '(P2)' }}
                                                </span>
                                            @endif
                                        </div>
                                        @if(!$loop->last)
                                            <span class="text-neutral-300 dark:text-neutral-600">|</span>
                                        @endif
                                    @endforeach
                                </div>
                            @endif

                            <!-- Match Info -->
                            <div class="flex items-center justify-between text-sm">
                                <div class="flex items-center gap-2 text-neutral-600 dark:text-neutral-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4">
                                        <path fill-rule="evenodd" d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 00.281-.14c.186-.096.446-.24.757-.433.62-.384 1.445-.966 2.274-1.765C15.302 14.988 17 12.493 17 9A7 7 0 103 9c0 3.492 1.698 5.988 3.355 7.584a13.731 13.731 0 002.273 1.765 11.842 11.842 0 00.976.544l.062.029.018.008.006.003zM10 11.25a2.25 2.25 0 100-4.5 2.25 2.25 0 000 4.5z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $match->venue->name }}
                                </div>
                                <div class="text-neutral-500 dark:text-neutral-400">
                                    {{ $match->scheduled_at->format('H:i') }}
                                </div>
                            </div>
                        </div>

                        <!-- Add Umpire info if not assigned to current user -->
                        @if(!$match->isAssignedToMe)
                            <div class="mt-2 text-sm text-neutral-500 dark:text-neutral-400">
                                Umpire: {{ $match->umpire ? $match->umpire->name : 'Not assigned' }}
                            </div>
                        @endif
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
                        <div class="absolute right-4 top-4">
                            <span class="inline-flex items-center gap-1 rounded-full bg-red-100 px-2 py-1 text-xs font-medium text-red-700 dark:bg-red-900/30 dark:text-red-400">
                                <span class="relative flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                                </span>
                                LIVE
                            </span>
                        </div>

                        <div class="flex flex-col gap-4">
                            <div>
                                <div class="flex items-center justify-between gap-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-neutral-100 font-medium text-neutral-900 dark:bg-neutral-800 dark:text-white">
                                            {{ substr($match->player1->name, 0, 2) }}
                                        </div>
                                        <div class="font-medium text-neutral-900 dark:text-white">
                                            {{ $match->player1->name }}
                                        </div>
                                    </div>
                                    <div class="text-lg font-medium text-blue-600 dark:text-blue-400">
                                        {{ explode('-', $match->score ?? '0-0')[0] }}
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-center">
                                <div class="text-sm font-medium text-neutral-500 dark:text-neutral-400">VS</div>
                            </div>

                            <div>
                                <div class="flex items-center justify-between gap-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-neutral-100 font-medium text-neutral-900 dark:bg-neutral-800 dark:text-white">
                                            {{ substr($match->player2->name, 0, 2) }}
                                        </div>
                                        <div class="font-medium text-neutral-900 dark:text-white">
                                            {{ $match->player2->name }}
                                        </div>
                                    </div>
                                    <div class="text-lg font-medium text-blue-600 dark:text-blue-400">
                                        {{ explode('-', $match->score ?? '0-0')[1] }}
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between text-sm">
                                <div class="flex items-center gap-2 text-neutral-600 dark:text-neutral-400">
                                    <flux:icon name="map-pin" class="h-4 w-4" />
                                    {{ $match->venue->name }}
                                </div>
                                <div class="text-neutral-500 dark:text-neutral-400">
                                    Umpire: {{ $match->user->name }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full rounded-xl border border-neutral-200 bg-white p-8 text-center dark:border-neutral-700 dark:bg-zinc-900">
                        <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-neutral-100 dark:bg-neutral-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-neutral-600 dark:text-neutral-400">
                                <path stroke-linecap="round" d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                        </div>
                        <h3 class="mb-1 text-sm font-medium text-neutral-900 dark:text-white">No Live Matches</h3>
                        <p class="text-sm text-neutral-600 dark:text-neutral-400">There are no matches being played right now.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Upcoming Matches -->
        <div>
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Upcoming Matches</h2>
                <a href="{{ route('umpire.matches') }}" class="text-sm text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300" wire:navigate>
                    View all →
                </a>
            </div>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($upcomingMatches as $match)
                    <a href="{{ route('umpire.matches.show', $match) }}" 
                       class="group relative block overflow-hidden rounded-xl border border-neutral-200 bg-white p-4 transition hover:border-blue-500/50 dark:border-neutral-700 dark:bg-zinc-900 dark:hover:border-blue-500/50"
                       wire:navigate>
                        <div class="absolute right-4 top-4">
                            <span class="rounded-full bg-neutral-100 px-2 py-1 text-xs font-medium text-neutral-600 dark:bg-neutral-800 dark:text-neutral-400">
                                {{ $match->scheduled_at->format('M d, H:i') }}
                            </span>
                        </div>

                        <div class="flex flex-col gap-4">
                            <div>
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-neutral-100 font-medium text-neutral-900 dark:bg-neutral-800 dark:text-white">
                                        {{ substr($match->player1->name, 0, 2) }}
                                    </div>
                                    <div class="font-medium text-neutral-900 dark:text-white">
                                        {{ $match->player1->name }}
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-center">
                                <div class="text-sm font-medium text-neutral-500 dark:text-neutral-400">VS</div>
                            </div>

                            <div>
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-neutral-100 font-medium text-neutral-900 dark:bg-neutral-800 dark:text-white">
                                        {{ substr($match->player2->name, 0, 2) }}
                                    </div>
                                    <div class="font-medium text-neutral-900 dark:text-white">
                                        {{ $match->player2->name }}
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-2 text-sm text-neutral-600 dark:text-neutral-400">
                                <flux:icon name="map-pin" class="h-4 w-4" />
                                {{ $match->venue->name }}
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full rounded-xl border border-neutral-200 bg-white p-8 text-center dark:border-neutral-700 dark:bg-zinc-900">
                        <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-neutral-100 dark:bg-neutral-800">
                            <flux:icon name="calendar" class="h-6 w-6 text-neutral-600 dark:text-neutral-400" />
                        </div>
                        <h3 class="mb-1 text-sm font-medium text-neutral-900 dark:text-white">No Upcoming Matches</h3>
                        <p class="text-sm text-neutral-600 dark:text-neutral-400">You have no upcoming matches scheduled.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Recent Matches -->
        <div>
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Recent Matches</h2>
                <a href="{{ route('umpire.matches') }}" class="text-sm text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300" wire:navigate>
                    View all →
                </a>
            </div>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($recentMatches as $match)
                    <a href="{{ route('umpire.matches.show', $match) }}" 
                       class="group relative block overflow-hidden rounded-xl border border-neutral-200 bg-white p-4 transition hover:border-blue-500/50 dark:border-neutral-700 dark:bg-zinc-900 dark:hover:border-blue-500/50"
                       wire:navigate>
                        <div class="absolute right-4 top-4">
                            <span class="rounded-full bg-neutral-100 px-2 py-1 text-xs font-medium text-neutral-600 dark:bg-neutral-800 dark:text-neutral-400">
                                {{ $match->played_at->format('M d, H:i') }}
                            </span>
                        </div>

                        <div class="flex flex-col gap-4">
                            <div>
                                <div class="flex items-center justify-between gap-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-neutral-100 font-medium text-neutral-900 dark:bg-neutral-800 dark:text-white">
                                            {{ substr($match->player1->name, 0, 2) }}
                                        </div>
                                        <div class="font-medium text-neutral-900 dark:text-white">
                                            {{ $match->player1->name }}
                                        </div>
                                    </div>
                                    <div class="text-lg font-medium text-blue-600 dark:text-blue-400">
                                        {{ explode('-', $match->score ?? '0-0')[0] }}
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-center">
                                <div class="text-sm font-medium text-neutral-500 dark:text-neutral-400">VS</div>
                            </div>

                            <div>
                                <div class="flex items-center justify-between gap-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-neutral-100 font-medium text-neutral-900 dark:bg-neutral-800 dark:text-white">
                                            {{ substr($match->player2->name, 0, 2) }}
                                        </div>
                                        <div class="font-medium text-neutral-900 dark:text-white">
                                            {{ $match->player2->name }}
                                        </div>
                                    </div>
                                    <div class="text-lg font-medium text-blue-600 dark:text-blue-400">
                                        {{ explode('-', $match->score ?? '0-0')[1] }}
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-2 text-sm text-neutral-600 dark:text-neutral-400">
                                <flux:icon name="map-pin" class="h-4 w-4" />
                                {{ $match->venue->name }}
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full rounded-xl border border-neutral-200 bg-white p-8 text-center dark:border-neutral-700 dark:bg-zinc-900">
                        <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-neutral-100 dark:bg-neutral-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-neutral-600 dark:text-neutral-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="mb-1 text-sm font-medium text-neutral-900 dark:text-white">No Recent Matches</h3>
                        <p class="text-sm text-neutral-600 dark:text-neutral-400">You haven't umpired any matches recently.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
