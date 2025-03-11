<div>
    <x-pending-approval-notice />
    
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <!-- Upcoming Matches -->
        <div>
            <h2 class="mb-4 text-xl font-semibold text-gray-900 dark:text-white">Upcoming Matches</h2>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($upcomingMatches as $match)
                    <div class="group rounded-xl border border-neutral-200 p-4 transition hover:border-blue-500/50 dark:border-neutral-700 dark:hover:border-blue-500/50">
                        <div class="text-sm text-neutral-500 dark:text-neutral-400">
                            {{ $match->scheduled_at->format('M d, Y - H:i') }}
                        </div>
                        <div class="mt-2 font-semibold text-gray-900 dark:text-white">
                            {{ $match->player1->name }} vs {{ $match->player2->name }}
                        </div>
                        <div class="mt-2 flex items-center gap-2 text-sm text-neutral-600 dark:text-neutral-300">
                            <flux:icon name="map-pin" class="size-4" />
                            {{ $match->venue->name }}
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
                    <div class="rounded-xl border border-red-500/30 p-4">
                        <div class="inline-flex items-center gap-2">
                            <span class="relative flex h-3 w-3">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                            </span>
                            <span class="text-sm font-medium text-red-500">LIVE NOW</span>
                        </div>
                        <div class="mt-2 font-semibold text-gray-900 dark:text-white">
                            {{ $match->player1->name }} vs {{ $match->player2->name }}
                        </div>
                        <div class="mt-2 text-lg font-medium text-blue-600 dark:text-blue-400">
                            {{ $match->score }}
                        </div>
                        <div class="mt-2 flex items-center gap-2 text-sm text-neutral-600 dark:text-neutral-300">
                            <flux:icon name="map-pin" class="size-4" />
                            {{ $match->venue->name }}
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
                    <div class="rounded-xl border border-neutral-200 p-4 dark:border-neutral-700">
                        <div class="text-sm text-neutral-500 dark:text-neutral-400">
                            {{ $match->played_at->format('M d, Y - H:i') }}
                        </div>
                        <div class="mt-2 font-semibold text-gray-900 dark:text-white">
                            {{ $match->player1->name }} vs {{ $match->player2->name }}
                        </div>
                        <div class="mt-2 text-lg font-medium text-blue-600 dark:text-blue-400">
                            {{ $match->score }}
                        </div>
                        <div class="mt-2 flex items-center gap-2 text-sm text-neutral-600 dark:text-neutral-300">
                            <flux:icon name="map-pin" class="size-4" />
                            {{ $match->venue->name }}
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
