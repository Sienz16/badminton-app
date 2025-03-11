<div>
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <!-- Stats Overview -->
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Total Users Card -->
            <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-900">
                <div class="flex items-center gap-4">
                    <div class="rounded-lg bg-blue-100 p-3 dark:bg-blue-900/30">
                        <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-neutral-600 dark:text-neutral-400">Total Users</p>
                        <p class="text-2xl font-semibold text-neutral-900 dark:text-white">{{ $totalUsers }}</p>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-green-600 dark:text-green-400">
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                    </svg>
                    <span class="ml-2">+{{ $newUsersToday }} today</span>
                </div>
            </div>

            <!-- Active Venues Card -->
            <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-900">
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
            <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-900">
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
                    <span>{{ $liveMatches }} matches in progress</span>
                </div>
            </div>

            <!-- Pending Approvals Card -->
            <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-900">
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

        <!-- Upcoming Matches -->
        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-900">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-neutral-900 dark:text-white">Upcoming Matches</h2>
                <a href="#" class="text-sm text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">View all</a>
            </div>
            <div class="mt-6 space-y-4">
                @foreach($upcomingMatches as $match)
                    <div class="flex items-center justify-between gap-4 rounded-lg border border-neutral-200 bg-neutral-50 p-4 dark:border-neutral-700 dark:bg-neutral-800">
                        <div class="min-w-0 flex-1">
                            <div class="flex items-center justify-between gap-4">
                                <p class="truncate text-sm font-medium text-neutral-900 dark:text-white">
                                    {{ $match->player1->name }} vs {{ $match->player2->name }}
                                </p>
                                <div class="hidden sm:flex sm:flex-col sm:items-end">
                                    <p class="text-sm text-neutral-900 dark:text-white">{{ $match->venue->name }}</p>
                                </div>
                            </div>
                            <div class="mt-2 flex items-center justify-between gap-4">
                                <p class="text-sm text-neutral-500 dark:text-neutral-400">
                                    Court {{ $match->court_number }}
                                </p>
                                <p class="text-sm text-neutral-500 dark:text-neutral-400">
                                    {{ $match->scheduled_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
