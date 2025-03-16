<div>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <button
                        onclick="history.back()"
                        class="group flex items-center gap-1 text-sm font-medium text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-300 transition-colors"
                    >
                        <svg class="h-5 w-5 transition-transform group-hover:-translate-x-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                        Back
                    </button>
                </div>
            </div>

            <!-- Match Title Card -->
            <div class="mt-6 rounded-xl bg-primary p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <h1 class="text-3xl font-bold text-white">
                        Match Information
                    </h1>
                    <span class="rounded-full px-4 py-1 text-sm font-semibold
                        @if($match->status === 'completed') bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-400
                        @elseif($match->status === 'in_progress') bg-yellow-100 text-yellow-800 dark:bg-yellow-900/40 dark:text-yellow-400
                        @else bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-400 @endif">
                        {{ ucfirst($match->status ?? 'Unknown') }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Match Details -->
        <div class="space-y-6">
            <!-- Head to Head Section -->
            <div class="rounded-xl bg-white p-6 shadow-lg dark:bg-zinc-800 border-2 border-green-200 dark:border-green-900/30">
                <div class="flex flex-col lg:flex-row items-center gap-6">
                    <!-- Player 1 Card -->
                    <div class="w-full lg:w-5/12">
                        <div class="group overflow-hidden rounded-xl bg-white shadow-lg dark:bg-zinc-800 border-2 border-green-300 dark:border-green-700 transition-all duration-300 hover:border-primary/50 dark:hover:border-primary/50 hover:shadow-xl hover:scale-[1.02]">
                            <!-- Player Image -->
                            <div class="aspect-[4/3] w-full bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/30 dark:to-green-800/30 relative overflow-hidden">
                                @if($match->player1?->player?->profile_photo)
                                    <img src="{{ Storage::url($match->player1->player->profile_photo) }}" 
                                         class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110"
                                         alt="{{ $match->player1?->name }}">
                                @else
                                    <div class="flex h-full items-center justify-center">
                                        <svg class="h-24 w-24 text-green-300 dark:text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                @endif
                                <!-- Ranking Badge -->
                                <div class="absolute top-4 right-4 bg-primary text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg transition-transform duration-300 group-hover:scale-110">
                                    Rank #{{ $match->player1?->player?->ranking ?? 'N/A' }}
                                </div>
                            </div>

                            <!-- Player Info -->
                            <div class="p-6 space-y-6">
                                <!-- Basic Info -->
                                <div class="text-center">
                                    <h3 class="text-2xl font-bold text-zinc-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">
                                        {{ $match->player1?->name ?? 'Player 1' }}
                                    </h3>
                                    <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                                        {{ $match->player1?->player?->nationality ?? 'Unknown Nationality' }}
                                    </p>
                                </div>

                                <!-- Stats Grid -->
                                <div class="grid grid-cols-2 gap-4">
                                    <!-- Age -->
                                    <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg transition-all duration-300 hover:bg-green-100 dark:hover:bg-green-800/30 cursor-pointer text-center border-2 border-green-200 dark:border-green-700">
                                        <div class="flex items-center justify-center gap-2">
                                            <span class="text-zinc-500 dark:text-zinc-400 text-sm">Age</span>
                                            <svg class="w-4 h-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <p class="mt-1 text-lg font-semibold text-zinc-900 dark:text-white">
                                            @if($match->player1?->player?->date_of_birth)
                                                {{ \Carbon\Carbon::parse($match->player1->player->date_of_birth)->age }}
                                            @else
                                                N/A
                                            @endif
                                        </p>
                                    </div>

                                    <!-- Playing Hand -->
                                    <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg transition-all duration-300 hover:bg-green-100 dark:hover:bg-green-800/30 cursor-pointer text-center border-2 border-green-200 dark:border-green-700">
                                        <div class="flex items-center justify-center gap-2">
                                            <span class="text-zinc-500 dark:text-zinc-400 text-sm">Hand</span>
                                            <svg class="w-4 h-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11" />
                                            </svg>
                                        </div>
                                        <p class="mt-1 text-lg font-semibold text-zinc-900 dark:text-white">
                                            {{ ucfirst($match->player1?->player?->playing_hand ?? 'N/A') }}
                                        </p>
                                    </div>

                                    <!-- Match Stats -->
                                    <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg transition-all duration-300 hover:bg-green-100 dark:hover:bg-green-800/30 cursor-pointer text-center border-2 border-green-200 dark:border-green-700">
                                        <div class="flex items-center justify-center gap-2">
                                            <span class="text-zinc-500 dark:text-zinc-400 text-sm">Matches</span>
                                            <svg class="w-4 h-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                            </svg>
                                        </div>
                                        <p class="mt-1 text-lg font-semibold text-zinc-900 dark:text-white">
                                            {{ $match->player1?->player?->matches_played ?? '0' }}
                                        </p>
                                    </div>

                                    <!-- Win Rate -->
                                    <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg transition-all duration-300 hover:bg-green-100 dark:hover:bg-green-800/30 cursor-pointer text-center border-2 border-green-200 dark:border-green-700">
                                        <div class="flex items-center justify-center gap-2">
                                            <span class="text-zinc-500 dark:text-zinc-400 text-sm">Win Rate</span>
                                            <svg class="w-4 h-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                        </div>
                                        <p class="mt-1 text-lg font-semibold text-zinc-900 dark:text-white">
                                            @if($match->player1?->player?->matches_played > 0)
                                                {{ number_format(($match->player1->player->matches_won / $match->player1->player->matches_played) * 100, 1) }}%
                                            @else
                                                N/A
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <!-- Bio -->
                                @if($match->player1?->player?->bio)
                                <div class="pt-4 border-t border-zinc-200 dark:border-zinc-700 text-center">
                                    <p class="text-sm text-zinc-600 dark:text-zinc-300 italic">
                                        "{{ $match->player1->player->bio }}"
                                    </p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- VS Badge -->
                    <div class="ml-6 mr-6 flex-shrink-0 flex flex-col items-center justify-center">
                        <div class="border-2 border-green-200 rounded-full bg-primary/10 dark:bg-primary/20 p-6">
                            <span class="text-2xl font-bold text-primary dark:text-primary-light">VS</span>
                        </div>
                        @if($match->scheduled_at)
                            <div class="mt-2 text-center">
                                <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">
                                    {{ $match->scheduled_at->format('M d, Y') }}
                                </p>
                                <p class="text-sm font-bold text-zinc-900 dark:text-white">
                                    {{ $match->scheduled_at->format('h:i A') }}
                                </p>
                            </div>
                        @endif
                    </div>

                    <!-- Player 2 Card -->
                    <div class="w-full lg:w-5/12">
                        <div class="group overflow-hidden rounded-xl bg-white shadow-lg dark:bg-zinc-800 border-2 border-green-300 dark:border-green-700 transition-all duration-300 hover:border-primary/50 dark:hover:border-primary/50 hover:shadow-xl hover:scale-[1.02]">
                            <!-- Player Image -->
                            <div class="aspect-[4/3] w-full bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/30 dark:to-green-800/30 relative overflow-hidden">
                                @if($match->player2?->player?->profile_photo)
                                    <img src="{{ Storage::url($match->player2->player->profile_photo) }}" 
                                         class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110"
                                         alt="{{ $match->player2?->name }}">
                                @else
                                    <div class="flex h-full items-center justify-center">
                                        <svg class="h-24 w-24 text-green-300 dark:text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                @endif
                                <!-- Ranking Badge -->
                                <div class="absolute top-4 right-4 bg-primary text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg transition-transform duration-300 group-hover:scale-110">
                                    Rank #{{ $match->player2?->player?->ranking ?? 'N/A' }}
                                </div>
                            </div>

                            <!-- Player Info -->
                            <div class="p-6 space-y-6">
                                <!-- Basic Info -->
                                <div class="text-center">
                                    <h3 class="text-2xl font-bold text-zinc-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">
                                        {{ $match->player2?->name ?? 'Player 2' }}
                                    </h3>
                                    <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                                        {{ $match->player2?->player?->nationality ?? 'Unknown Nationality' }}
                                    </p>
                                </div>

                                <!-- Stats Grid -->
                                <div class="grid grid-cols-2 gap-4">
                                    <!-- Age -->
                                    <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg transition-all duration-300 hover:bg-green-100 dark:hover:bg-green-800/30 cursor-pointer text-center border-2 border-green-200 dark:border-green-700">
                                        <div class="flex items-center justify-center gap-2">
                                            <span class="text-zinc-500 dark:text-zinc-400 text-sm">Age</span>
                                            <svg class="w-4 h-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <p class="mt-1 text-lg font-semibold text-zinc-900 dark:text-white">
                                            @if($match->player2?->player?->date_of_birth)
                                                {{ \Carbon\Carbon::parse($match->player2->player->date_of_birth)->age }}
                                            @else
                                                N/A
                                            @endif
                                        </p>
                                    </div>

                                    <!-- Playing Hand -->
                                    <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg transition-all duration-300 hover:bg-green-100 dark:hover:bg-green-800/30 cursor-pointer text-center border-2 border-green-200 dark:border-green-700">
                                        <div class="flex items-center justify-center gap-2">
                                            <span class="text-zinc-500 dark:text-zinc-400 text-sm">Hand</span>
                                            <svg class="w-4 h-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11" />
                                            </svg>
                                        </div>
                                        <p class="mt-1 text-lg font-semibold text-zinc-900 dark:text-white">
                                            {{ ucfirst($match->player2?->player?->playing_hand ?? 'N/A') }}
                                        </p>
                                    </div>

                                    <!-- Match Stats -->
                                    <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg transition-all duration-300 hover:bg-green-100 dark:hover:bg-green-800/30 cursor-pointer text-center border-2 border-green-200 dark:border-green-700">
                                        <div class="flex items-center justify-center gap-2">
                                            <span class="text-zinc-500 dark:text-zinc-400 text-sm">Matches</span>
                                            <svg class="w-4 h-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                            </svg>
                                        </div>
                                        <p class="mt-1 text-lg font-semibold text-zinc-900 dark:text-white">
                                            {{ $match->player2?->player?->matches_played ?? '0' }}
                                        </p>
                                    </div>

                                    <!-- Win Rate -->
                                    <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg transition-all duration-300 hover:bg-green-100 dark:hover:bg-green-800/30 cursor-pointer text-center border-2 border-green-200 dark:border-green-700">
                                        <div class="flex items-center justify-center gap-2">
                                            <span class="text-zinc-500 dark:text-zinc-400 text-sm">Win Rate</span>
                                            <svg class="w-4 h-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                        </div>
                                        <p class="mt-1 text-lg font-semibold text-zinc-900 dark:text-white">
                                            @if($match->player2?->player?->matches_played > 0)
                                                {{ number_format(($match->player2->player->matches_won / $match->player2->player->matches_played) * 100, 1) }}%
                                            @else
                                                N/A
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <!-- Bio -->
                                <div class="pt-4 border-t border-zinc-200 dark:border-zinc-700 text-center">
                                    <p class="text-sm text-zinc-600 dark:text-zinc-300 italic">
                                        @if($match->player2?->player?->bio)
                                            "{{ $match->player2->player->bio }}"
                                        @else
                                            <span class="text-zinc-400 dark:text-zinc-500">No player description available</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Match Details Section -->
            <div class="space-y-6">
                <!-- Venue & Court Information -->
                <div class="rounded-xl bg-white p-6 shadow-lg dark:bg-zinc-800 border-2 border-green-200 dark:border-green-900/30">
                    <h2 class="mb-6 text-xl font-semibold text-zinc-900 dark:text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                        Venue & Court Details
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="border-2 border-green-200 bg-green-50 dark:bg-green-900/20 rounded-lg p-4">
                            <h3 class="text-sm font-medium text-green-700 dark:text-green-400">Venue</h3>
                            <p class="mt-2 text-lg font-semibold text-zinc-900 dark:text-white">{{ $match->venue?->name ?? 'Not assigned' }}</p>
                            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-300">{{ $match->venue?->address ?? 'Address not available' }}</p>
                        </div>
                        
                        <div class="border-2 border-green-200 bg-green-50 dark:bg-green-900/20 rounded-lg p-4">
                            <h3 class="text-sm font-medium text-green-700 dark:text-green-400">Court</h3>
                            <p class="mt-2 text-lg font-semibold text-zinc-900 dark:text-white">
                                @if($match->court_number)
                                    Court {{ $match->court_number }}
                                @else
                                    Not assigned
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Match Details -->
                <div class="border-2 border-green-200 rounded-xl bg-white p-6 shadow-lg dark:bg-zinc-800">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-semibold text-zinc-900 dark:text-white flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 0 1-.982-3.172M9.497 14.25a7.454 7.454 0 0 0 .981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 0 0 7.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 0 0 2.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 0 1 2.916.52 6.003 6.003 0 0 1-5.395 4.972m0 0a6.726 6.726 0 0 1-2.749 1.35m0 0a6.772 6.772 0 0 1-3.044 0" />
                            </svg>
                            Match Details
                        </h2>

                        <div class="flex items-center gap-3">
                            <!-- Match Status Badge -->
                            <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-medium
                                @if($match->isScheduled()) bg-yellow-100 text-yellow-800
                                @elseif($match->isLive()) bg-green-100 text-green-800
                                @elseif($match->isCompleted()) bg-blue-100 text-blue-800
                                @endif">
                                {{ ucfirst($match->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Schedule Information -->
                        <div class="rounded-xl bg-white dark:bg-zinc-800 shadow-lg p-6 border-2 border-green-200 dark:border-green-900/30">
                            <div class="relative">
                                <!-- Status Badge - Positioned Absolute Top Right -->
                                <div class="absolute top-0 right-0">
                                    <span class="inline-flex items-center rounded-full px-3 py-1.5 text-sm font-medium
                                        @if($match->status === 'completed') bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-400
                                        @elseif($match->status === 'in_progress') bg-yellow-100 text-yellow-800 dark:bg-yellow-900/40 dark:text-yellow-400
                                        @else bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-400 @endif">
                                        {{ ucfirst($match->status) }}
                                    </span>
                                </div>

                                <!-- Header -->
                                <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-100 mb-4 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                    </svg>
                                    Schedule Details
                                </h3>
                            </div>
                            
                            <div class="space-y-4">
                                <!-- Date and Time -->
                                <div class="bg-green-50 dark:bg-green-900/20 rounded-lg p-4 border border-green-200 dark:border-green-800">
                                    <div class="flex items-center gap-2 text-green-700 dark:text-green-400 mb-2">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        <span class="text-sm font-medium">Match Time</span>
                                    </div>
                                    <p class="text-lg font-semibold text-zinc-900 dark:text-white">
                                        {{ $match->scheduled_at ? $match->scheduled_at->format('M d, Y') : 'Date not set' }}
                                    </p>
                                    <p class="text-md text-zinc-700 dark:text-zinc-300">
                                        {{ $match->scheduled_at ? $match->scheduled_at->format('h:i A') : 'Time not set' }}
                                    </p>
                                </div>

                                @if($match->status === 'completed')
                                    <!-- Match Result -->
                                    <div class="pt-4 border-t border-zinc-200 dark:border-zinc-700">
                                        <div class="bg-green-50 dark:bg-green-900/20 rounded-lg p-4 border border-green-200 dark:border-green-800">
                                            <h4 class="text-sm font-medium text-green-700 dark:text-green-400 mb-3">Match Result</h4>
                                            <div class="flex items-center gap-3">
                                                <span class="text-amber-500 text-2xl" title="Winner">👑</span>
                                                <span class="text-lg font-bold text-zinc-900 dark:text-zinc-100">
                                                    @if($match->final_winner_id)
                                                        @if($match->final_winner_id === $match->player1_id && $match->player1)
                                                            {{ $match->player1->name }}
                                                        @elseif($match->final_winner_id === $match->player2_id && $match->player2)
                                                            {{ $match->player2->name }}
                                                        @else
                                                            Winner Not Found
                                                        @endif
                                                    @else
                                                        No Winner Declared
                                                    @endif
                                                </span>
                                            </div>
                                            <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">
                                                Completed: {{ $match->completed_at ? $match->completed_at->format('M d, Y h:i A') : 'N/A' }}
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Scoring Section -->
                        <div class="rounded-xl bg-white dark:bg-zinc-800 shadow-lg p-6 border-2 border-green-200 dark:border-green-900/30">
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-100 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 0 1-.982-3.172M9.497 14.25a7.454 7.454 0 0 0 .981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 0 0 7.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 0 0 2.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 0 1 2.916.52 6.003 6.003 0 0 1-5.395 4.972m0 0a6.726 6.726 0 0 1-2.749 1.35m0 0a6.772 6.772 0 0 1-3.044 0" />
                                </svg>
                                Match Score
                            </h3>
                            
                            @if($match->status !== 'scheduled')
                                <div class="space-y-4">
                                    <!-- Sets Display -->
                                    @foreach($sets as $setNumber => $score)
                                        <div class="flex items-center justify-between p-4 bg-green-50 dark:bg-green-900/20 rounded-lg border border-green-200 dark:border-green-800">
                                            <span class="text-sm font-medium text-green-700 dark:text-green-400">Set {{ $setNumber }}</span>
                                            <div class="flex items-center gap-3">
                                                <span class="text-lg font-bold text-zinc-900 dark:text-zinc-100">
                                                    {{ $score['player1'] }} - {{ $score['player2'] }}
                                                </span>
                                                @php
                                                    $setWinner = DB::table('match_sets')
                                                        ->where('match_id', $match->id)
                                                        ->where('set_number', $setNumber)
                                                        ->value('winner_id');
                                                
                                                    $winnerName = null;
                                                    if ($setWinner) {
                                                        if ($setWinner === $match->player1_id && $match->player1) {
                                                            $winnerName = $match->player1->name;
                                                        } elseif ($setWinner === $match->player2_id && $match->player2) {
                                                            $winnerName = $match->player2->name;
                                                        }
                                                    }
                                                @endphp
                                                @if($setWinner && $winnerName)
                                                    <div class="flex items-center gap-2 px-2 py-1 bg-green-100 dark:bg-green-800 rounded-full">
                                                        <span class="text-amber-500" title="Set Winner">👑</span>
                                                        <span class="text-sm font-medium text-green-700 dark:text-green-300">
                                                            {{ $winnerName }}
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="rounded-lg border-2 border-dashed border-green-200 dark:border-green-700 p-6 text-center">
                                    <svg class="mx-auto h-12 w-12 text-primary dark:text-green-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-zinc-900 dark:text-white">Match not started</h3>
                                    <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">The match scoring will appear here once the game begins.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>