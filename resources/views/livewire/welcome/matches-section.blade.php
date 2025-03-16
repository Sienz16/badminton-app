<div class="relative py-24 bg-gradient-to-b from-emerald-50 to-white dark:from-emerald-950 dark:to-gray-900">
    <!-- Section Header -->
    <div class="text-center mb-16">
        <div class="flex items-center justify-center space-x-4 mb-4">
            <div class="h-px w-8 bg-emerald-600 dark:bg-emerald-400"></div>
            <h2 class="text-sm font-semibold leading-7 text-emerald-600 dark:text-emerald-400 uppercase tracking-wider">
                Matches
            </h2>
            <div class="h-px w-8 bg-emerald-600 dark:bg-emerald-400"></div>
        </div>
        <h3 class="text-4xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-5xl font-['Poppins']">
            Tournament Schedule
        </h3>
        <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
            Stay updated with all matches - past, present, and future
        </p>
    </div>

    <!-- Matches Tabs -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Tab Buttons -->
        <div class="flex justify-center space-x-4 mb-8">
            <button 
                type="button"
                wire:click="$set('activeTab', 'today')" 
                class="px-6 py-3 rounded-lg font-semibold shadow-sm transition-all duration-200 hover:scale-105
                {{ $activeTab === 'today' ? 'bg-emerald-600 text-white' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300' }}"
            >
                Today's Matches
            </button>
            <button 
                type="button"
                wire:click="$set('activeTab', 'upcoming')" 
                class="px-6 py-3 rounded-lg font-semibold shadow-sm transition-all duration-200 hover:scale-105
                {{ $activeTab === 'upcoming' ? 'bg-emerald-600 text-white' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300' }}"
            >
                Upcoming
            </button>
            <button 
                type="button"
                wire:click="$set('activeTab', 'past')" 
                class="px-6 py-3 rounded-lg font-semibold shadow-sm transition-all duration-200 hover:scale-105
                {{ $activeTab === 'past' ? 'bg-emerald-600 text-white' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300' }}"
            >
                Past Matches
            </button>
        </div>

        <!-- Matches Grid -->
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @if($activeTab === 'today')
                @forelse($this->todayMatches as $match)
                    <div class="group relative block overflow-hidden rounded-xl border-2 border-gray-400/50 
                               bg-white dark:bg-gray-900/30 
                               transition duration-300 ease-in-out
                               hover:border-gray-500 dark:hover:border-gray-700
                               hover:shadow-lg hover:shadow-gray-500/10 
                               hover:transform hover:scale-[1.02]
                               dark:hover:shadow-gray-800/20">
                        
                        <!-- Status Badge (Top Right) -->
                        <div class="absolute right-4 top-4 flex items-center gap-2">
                            @if($match->isLive())
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-red-100 px-3 py-1 text-xs 
                                           font-medium text-red-700 dark:bg-red-900/30 dark:text-red-400">
                                    <span class="relative flex h-2 w-2">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                                    </span>
                                    LIVE
                                </span>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <!-- Venue & Court -->
                            <div class="mb-4 flex items-center justify-between text-sm text-gray-600 dark:text-gray-400">
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ $match->venue?->name }}
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                    Court {{ $match->court_number }}
                                </div>
                            </div>

                            <!-- Players Section -->
                            <div class="mb-4 grid grid-cols-7 items-center gap-4">
                                <!-- Player 1 -->
                                <div class="col-span-3 flex items-center gap-3">
                                    <div class="h-12 w-12 overflow-hidden rounded-full">
                                        @if($match->player1?->player?->profile_photo)
                                            <img src="{{ Storage::url($match->player1->player->profile_photo) }}" 
                                                 alt="{{ $match->player1->name }}"
                                                 class="h-full w-full object-cover">
                                        @else
                                            <div class="flex h-full w-full items-center justify-center bg-gray-100 dark:bg-gray-800">
                                                <span class="text-lg font-medium text-gray-900 dark:text-white">
                                                    {{ substr($match->player1->name ?? '', 0, 2) }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                    <span class="font-medium text-gray-900 dark:text-white truncate">
                                        {{ $match->player1->name }}
                                    </span>
                                </div>

                                <!-- VS -->
                                <div class="col-span-1 text-center">
                                    <span class="text-sm font-semibold text-gray-500">VS</span>
                                </div>

                                <!-- Player 2 -->
                                <div class="col-span-3 flex items-center gap-3 justify-end">
                                    <span class="font-medium text-gray-900 dark:text-white truncate">
                                        {{ $match->player2->name }}
                                    </span>
                                    <div class="h-12 w-12 overflow-hidden rounded-full">
                                        @if($match->player2?->player?->profile_photo)
                                            <img src="{{ Storage::url($match->player2->player->profile_photo) }}" 
                                                 alt="{{ $match->player2->name }}"
                                                 class="h-full w-full object-cover">
                                        @else
                                            <div class="flex h-full w-full items-center justify-center bg-gray-100 dark:bg-gray-800">
                                                <span class="text-lg font-medium text-gray-900 dark:text-white">
                                                    {{ substr($match->player2->name ?? '', 0, 2) }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Match Info Footer -->
                            <div class="flex items-center justify-between text-sm text-gray-600 dark:text-gray-400">
                                <!-- Date & Time -->
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $match->scheduled_at->format('d M Y, H:i') }}
                                </div>
                                <!-- Umpire -->
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    {{ $match->umpireUser?->name ?? 'Not assigned' }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500 dark:text-gray-400">
                        No matches scheduled for today
                    </div>
                @endforelse
            @elseif($activeTab === 'upcoming')
                @forelse($this->upcomingMatches as $match)
                    <div class="group relative block overflow-hidden rounded-xl border-2 border-gray-400/50 
                               bg-white dark:bg-gray-900/30 
                               transition duration-300 ease-in-out
                               hover:border-gray-500 dark:hover:border-gray-700
                               hover:shadow-lg hover:shadow-gray-500/10 
                               hover:transform hover:scale-[1.02]
                               dark:hover:shadow-gray-800/20">
                        
                        <!-- Content -->
                        <div class="p-6">
                            <!-- Venue & Court -->
                            <div class="mb-4 flex items-center justify-between text-sm text-gray-600 dark:text-gray-400">
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ $match->venue?->name }}
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                    Court {{ $match->court_number }}
                                </div>
                            </div>

                            <!-- Players Section -->
                            <div class="mb-4 grid grid-cols-7 items-center gap-4">
                                <!-- Player 1 -->
                                <div class="col-span-3 flex items-center gap-3">
                                    <div class="h-12 w-12 overflow-hidden rounded-full">
                                        @if($match->player1?->player?->profile_photo)
                                            <img src="{{ Storage::url($match->player1->player->profile_photo) }}" 
                                                 alt="{{ $match->player1->name }}"
                                                 class="h-full w-full object-cover">
                                        @else
                                            <div class="flex h-full w-full items-center justify-center bg-gray-100 dark:bg-gray-800">
                                                <span class="text-lg font-medium text-gray-900 dark:text-white">
                                                    {{ substr($match->player1->name ?? '', 0, 2) }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                    <span class="font-medium text-gray-900 dark:text-white truncate">
                                        {{ $match->player1->name }}
                                    </span>
                                </div>

                                <!-- VS -->
                                <div class="col-span-1 text-center">
                                    <span class="text-sm font-semibold text-gray-500">VS</span>
                                </div>

                                <!-- Player 2 -->
                                <div class="col-span-3 flex items-center gap-3 justify-end">
                                    <span class="font-medium text-gray-900 dark:text-white truncate">
                                        {{ $match->player2->name }}
                                    </span>
                                    <div class="h-12 w-12 overflow-hidden rounded-full">
                                        @if($match->player2?->player?->profile_photo)
                                            <img src="{{ Storage::url($match->player2->player->profile_photo) }}" 
                                                 alt="{{ $match->player2->name }}"
                                                 class="h-full w-full object-cover">
                                        @else
                                            <div class="flex h-full w-full items-center justify-center bg-gray-100 dark:bg-gray-800">
                                                <span class="text-lg font-medium text-gray-900 dark:text-white">
                                                    {{ substr($match->player2->name ?? '', 0, 2) }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Match Info Footer -->
                            <div class="flex items-center justify-between text-sm text-gray-600 dark:text-gray-400">
                                <!-- Date & Time -->
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $match->scheduled_at->format('d M Y, H:i') }}
                                </div>
                                <!-- Umpire -->
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    {{ $match->umpireUser?->name ?? 'Not assigned' }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500 dark:text-gray-400">
                        No upcoming matches scheduled
                    </div>
                @endforelse
            @elseif($activeTab === 'past')
                @forelse($this->pastMatches as $match)
                    <div class="group relative block overflow-hidden rounded-xl border-2 border-gray-400/50 
                               bg-white dark:bg-gray-900/30 
                               transition duration-300 ease-in-out
                               hover:border-gray-500 dark:hover:border-gray-700
                               hover:shadow-lg hover:shadow-gray-500/10 
                               hover:transform hover:scale-[1.02]
                               dark:hover:shadow-gray-800/20">
                        
                        <!-- Content -->
                        <div class="p-6">
                            <!-- Venue & Court -->
                            <div class="mb-4 flex items-center justify-between text-sm text-gray-600 dark:text-gray-400">
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ $match->venue?->name }}
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                    Court {{ $match->court_number }}
                                </div>
                            </div>

                            <!-- Players Section -->
                            <div class="mb-4 grid grid-cols-7 items-center gap-4">
                                <!-- Player 1 -->
                                <div class="col-span-3 flex items-center gap-3">
                                    <div class="h-12 w-12 overflow-hidden rounded-full">
                                        @if($match->player1?->player?->profile_photo)
                                            <img src="{{ Storage::url($match->player1->player->profile_photo) }}" 
                                                 alt="{{ $match->player1->name }}"
                                                 class="h-full w-full object-cover">
                                        @else
                                            <div class="flex h-full w-full items-center justify-center bg-gray-100 dark:bg-gray-800">
                                                <span class="text-lg font-medium text-gray-900 dark:text-white">
                                                    {{ substr($match->player1->name ?? '', 0, 2) }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                    <span class="font-medium {{ $match->final_winner_id === $match->player1_id ? 'text-emerald-600 dark:text-emerald-400' : 'text-gray-900 dark:text-white' }} truncate">
                                        {{ $match->player1->name }}
                                        @if($match->final_winner_id === $match->player1_id)
                                            <span class="ml-2">👑</span>
                                        @endif
                                    </span>
                                </div>

                                <!-- VS -->
                                <div class="col-span-1 text-center">
                                    <span class="text-sm font-semibold text-gray-500">VS</span>
                                </div>

                                <!-- Player 2 -->
                                <div class="col-span-3 flex items-center gap-3 justify-end">
                                    <span class="font-medium {{ $match->final_winner_id === $match->player2_id ? 'text-emerald-600 dark:text-emerald-400' : 'text-gray-900 dark:text-white' }} truncate">
                                        {{ $match->player2->name }}
                                        @if($match->final_winner_id === $match->player2_id)
                                            <span class="ml-2">👑</span>
                                        @endif
                                    </span>
                                    <div class="h-12 w-12 overflow-hidden rounded-full">
                                        @if($match->player2?->player?->profile_photo)
                                            <img src="{{ Storage::url($match->player2->player->profile_photo) }}" 
                                                 alt="{{ $match->player2->name }}"
                                                 class="h-full w-full object-cover">
                                        @else
                                            <div class="flex h-full w-full items-center justify-center bg-gray-100 dark:bg-gray-800">
                                                <span class="text-lg font-medium text-gray-900 dark:text-white">
                                                    {{ substr($match->player2->name ?? '', 0, 2) }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Set Scores -->
                            <div class="mt-6 mb-4">
                                <div class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-2">Set History</div>
                                <div class="flex items-center gap-2">
                                    @forelse($match->matchSets as $set)
                                        <div class="flex-1 rounded {{ $set->winner_id ? 'bg-emerald-100 dark:bg-emerald-900/30' : 'bg-gray-100 dark:bg-gray-800' }} px-2 py-1.5 text-center">
                                            <div class="font-medium {{ $set->winner_id ? 'text-emerald-700 dark:text-emerald-400' : 'text-gray-900 dark:text-white' }}">
                                                {{ $set->player1_score }}-{{ $set->player2_score }}
                                            </div>
                                            @if($set->winner_id)
                                                <div class="mt-1 text-[10px] {{ $set->winner_id === $match->player1_id ? 'text-emerald-600 dark:text-emerald-400' : 'text-emerald-600 dark:text-emerald-400' }}">
                                                    Set {{ $set->set_number }}
                                                </div>
                                            @endif
                                        </div>
                                    @empty
                                        <div class="text-sm text-gray-500 dark:text-gray-400">No sets recorded</div>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Match Info Footer -->
                            <div class="flex items-center justify-between text-sm text-gray-600 dark:text-gray-400 mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                                <!-- Date & Time -->
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $match->completed_at?->format('d M Y, H:i') }}
                                </div>
                                <!-- Winner Badge -->
                                <div class="inline-flex items-center rounded-full bg-emerald-100 px-2.5 py-0.5 text-xs font-medium text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400">
                                    Winner: {{ $match->winner?->name }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500 dark:text-gray-400">
                        No past matches found
                    </div>
                @endforelse
            @endif
        </div>

        <!-- View All Matches Button -->
        <div class="mt-12 text-center">
            <a href="{{ route('login') }}" 
                class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-700 transition-colors duration-300"
            >
                Sign in to view all matches
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </div>
</div>