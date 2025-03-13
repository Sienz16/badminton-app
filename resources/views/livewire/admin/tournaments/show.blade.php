<div>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.tournaments') }}" wire:navigate 
                       class="group flex items-center gap-1 rounded-full bg-white px-4 py-2 text-sm font-medium text-zinc-500 shadow-sm transition hover:bg-zinc-50 dark:bg-zinc-800 dark:text-zinc-400 dark:hover:bg-zinc-700">
                        <svg class="h-5 w-5 transition-transform group-hover:-translate-x-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                        Back to tournaments
                    </a>
                </div>
                
                <!-- Delete button in header -->
                <flux:modal.trigger name="delete-match-modal">
                    <flux:button variant="danger" size="sm">
                        <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                        Delete Match
                    </flux:button>
                </flux:modal.trigger>
            </div>
            
            <!-- Match Title Card -->
            <div class="mt-6 rounded-xl bg-gradient-to-r from-blue-500 to-indigo-600 p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <h1 class="text-3xl font-bold text-white">
                        Match Information
                    </h1>
                    <span class="rounded-full px-4 py-1 text-sm font-semibold
                        @if($match->status === 'completed') bg-green-100 text-green-800
                        @elseif($match->status === 'in_progress') bg-yellow-100 text-yellow-800
                        @else bg-blue-100 text-blue-800 @endif">
                        {{ ucfirst($match->status ?? 'Unknown') }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Match Details -->
        <div class="space-y-6">
            <!-- Head to Head Section -->
            <div class="rounded-xl bg-white p-6 shadow-lg dark:bg-zinc-800">
                <div class="flex flex-col lg:flex-row items-center gap-6">
                    <!-- Player 1 Card -->
                    <div class="w-full lg:w-5/12">
                        <div class="group overflow-hidden rounded-xl bg-white shadow-lg dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 transition-all duration-300 hover:border-blue-500/50 dark:hover:border-blue-500/50 hover:shadow-xl hover:scale-[1.02]">
                            <!-- Player Image -->
                            <div class="aspect-[4/3] w-full bg-gradient-to-br from-zinc-50 to-zinc-100 dark:from-zinc-700 dark:to-zinc-800 relative overflow-hidden">
                                @if($match->player1?->player?->profile_photo)
                                    <img src="{{ Storage::url($match->player1->player->profile_photo) }}" 
                                         class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110"
                                         alt="{{ $match->player1?->name }}">
                                @else
                                    <div class="flex h-full items-center justify-center">
                                        <svg class="h-24 w-24 text-zinc-300 dark:text-zinc-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                @endif
                                <!-- Ranking Badge -->
                                <div class="absolute top-4 right-4 bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg transition-transform duration-300 group-hover:scale-110">
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
                                    <div class="bg-zinc-50 dark:bg-zinc-900 p-4 rounded-lg transition-all duration-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 cursor-pointer text-center">
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
                                    <div class="bg-zinc-50 dark:bg-zinc-900 p-4 rounded-lg transition-all duration-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 cursor-pointer text-center">
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
                                    <div class="bg-zinc-50 dark:bg-zinc-900 p-4 rounded-lg transition-all duration-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 cursor-pointer text-center">
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
                                    <div class="bg-zinc-50 dark:bg-zinc-900 p-4 rounded-lg transition-all duration-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 cursor-pointer text-center">
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
                    <div class="flex-shrink-0 flex flex-col items-center justify-center">
                        <div class="rounded-full bg-red-500 p-4 shadow-lg">
                            <span class="text-xl font-bold text-white">VS</span>
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
                        <div class="group overflow-hidden rounded-xl bg-white shadow-lg dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 transition-all duration-300 hover:border-blue-500/50 dark:hover:border-blue-500/50 hover:shadow-xl hover:scale-[1.02]">
                            <!-- Player Image -->
                            <div class="aspect-[4/3] w-full bg-gradient-to-br from-zinc-50 to-zinc-100 dark:from-zinc-700 dark:to-zinc-800 relative overflow-hidden">
                                @if($match->player2?->player?->profile_photo)
                                    <img src="{{ Storage::url($match->player2->player->profile_photo) }}" 
                                         class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110"
                                         alt="{{ $match->player2?->name }}">
                                @else
                                    <div class="flex h-full items-center justify-center">
                                        <svg class="h-24 w-24 text-zinc-300 dark:text-zinc-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                @endif
                                <!-- Ranking Badge -->
                                <div class="absolute top-4 right-4 bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg transition-transform duration-300 group-hover:scale-110">
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
                                    <div class="bg-zinc-50 dark:bg-zinc-900 p-4 rounded-lg transition-all duration-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 cursor-pointer text-center">
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
                                    <div class="bg-zinc-50 dark:bg-zinc-900 p-4 rounded-lg transition-all duration-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 cursor-pointer text-center">
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
                                    <div class="bg-zinc-50 dark:bg-zinc-900 p-4 rounded-lg transition-all duration-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 cursor-pointer text-center">
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
                                    <div class="bg-zinc-50 dark:bg-zinc-900 p-4 rounded-lg transition-all duration-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 cursor-pointer text-center">
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
                <div class="rounded-xl bg-white p-6 shadow-lg dark:bg-zinc-800">
                    <h2 class="mb-6 text-xl font-semibold text-zinc-900 dark:text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                        Venue & Court Details
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-zinc-50 dark:bg-zinc-900 rounded-lg p-4">
                            <h3 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Venue</h3>
                            <p class="mt-2 text-lg font-semibold text-zinc-900 dark:text-white">{{ $match->venue?->name ?? 'Not assigned' }}</p>
                            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-300">{{ $match->venue?->address ?? 'Address not available' }}</p>
                        </div>
                        
                        <div class="bg-zinc-50 dark:bg-zinc-900 rounded-lg p-4">
                            <h3 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Court</h3>
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

                <!-- Umpire Information -->
                <div class="rounded-xl bg-white p-6 shadow-lg dark:bg-zinc-800">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-semibold text-zinc-900 dark:text-white flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                            Match Official
                        </h2>
                        
                        <!-- Add Umpire Button if none assigned -->
                        @if(!$match->umpireUser)
                            <button 
                                type="button" 
                                wire:click="openUmpireModal"
                                class="inline-flex items-center gap-x-1.5 rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
                            >
                                <svg class="-ml-0.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                </svg>
                                Assign Umpire
                            </button>
                        @endif
                    </div>

                    @if($match->umpireUser && $match->umpire)
                        <div class="bg-zinc-50 dark:bg-zinc-900 rounded-xl overflow-hidden">
                            <div class="p-6">
                                <div class="flex items-start gap-6">
                                    <!-- Umpire Photo/Avatar -->
                                    <div class="flex-shrink-0">
                                        <div class="relative">
                                            @if($match->umpire->profile_photo)
                                                <img src="{{ asset('storage/' . $match->umpire->profile_photo) }}" 
                                                     alt="{{ $match->umpireUser->name }}" 
                                                     class="h-20 w-20 rounded-lg object-cover">
                                            @else
                                                <div class="h-20 w-20 rounded-lg bg-gradient-to-br from-blue-100 to-blue-200 dark:from-blue-800 dark:to-blue-900 flex items-center justify-center">
                                                    <span class="text-2xl font-bold text-blue-600 dark:text-blue-300">
                                                        {{ substr($match->umpireUser->name, 0, 1) }}
                                                    </span>
                                                </div>
                                            @endif
                                            
                                            <!-- Status Indicator -->
                                            <div class="absolute -bottom-2 -right-2">
                                                <span @class([
                                                    'flex h-6 w-6 items-center justify-center rounded-full border-2 border-white dark:border-zinc-900 text-xs font-medium',
                                                    'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300' => $match->umpire->status === 'available',
                                                    'bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300' => $match->umpire->status !== 'available',
                                                ])>
                                                    @if($match->umpire->status === 'available')
                                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                    @else
                                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                                        </svg>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Umpire Details -->
                                    <div class="flex-1">
                                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">
                                            {{ $match->umpireUser->name }}
                                        </h3>

                                        <!-- Experience/Stats -->
                                        <div class="mt-4 flex items-center gap-4">
                                            <div class="flex">
                                                @if($match->umpire->phone_number)
                                                    <div class="flex items-center text-sm text-zinc-600 dark:text-zinc-300">
                                                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                                        </svg>
                                                        {{ $match->umpire->phone_number }}
                                                    </div>
                                                @endif
                                                
                                                @if($match->umpire->user->email)
                                                    <div class="flex ml-5 items-center text-sm text-zinc-600 dark:text-zinc-300">
                                                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                                        </svg>
                                                        {{ $match->umpire->user->email }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Actions -->
                                    <div class="flex-shrink-0">
                                        <button 
                                            type="button" 
                                            wire:click="openUmpireModal"
                                            class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 hover:bg-zinc-50 dark:bg-zinc-800 dark:text-white dark:ring-zinc-700 dark:hover:bg-zinc-700"
                                        >
                                            Change Umpire
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="rounded-lg border-2 border-dashed border-zinc-300 dark:border-zinc-700 p-6 text-center">
                            <svg class="mx-auto h-12 w-12 text-zinc-400 dark:text-zinc-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-semibold text-zinc-900 dark:text-white">No umpire assigned</h3>
                            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Assign an umpire to manage this match.</p>
                            <div class="mt-6">
                                <button 
                                    type="button" 
                                    wire:click="openUmpireModal"
                                    class="inline-flex items-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
                                >
                                    <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                    </svg>
                                    Assign Umpire
                                </button>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Match Details -->
                <div class="rounded-xl bg-white p-6 shadow-lg dark:bg-zinc-800">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-semibold text-zinc-900 dark:text-white flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 002.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 012.916.52 6.003 6.003 0 01-5.395 4.972m0 0a6.726 6.726 0 01-2.749 1.35m0 0a6.772 6.772 0 01-3.044 0" />
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

                            <!-- Action Button based on match status -->
                            @if($match->isScheduled())
                                <button 
                                    wire:click="openScoringModal"
                                    class="inline-flex items-center gap-x-1.5 rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500"
                                >
                                    <svg class="-ml-0.5 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347c-.75.412-1.667-.13-1.667-.986V5.653Z" />
                                    </svg>
                                    Start Match
                                </button>
                            @elseif($match->isLive())
                                <button 
                                    wire:click="openScoringModal"
                                    class="inline-flex items-center gap-x-1.5 rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500"
                                >
                                    <svg class="-ml-0.5 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8.688c0-.864.933-1.405 1.683-.977l7.108 4.062a1.125 1.125 0 0 1 0 1.953l-7.108 4.062A1.125 1.125 0 0 1 3 16.81V8.688ZM12.75 8.688c0-.864.933-1.405 1.683-.977l7.108 4.062a1.125 1.125 0 0 1 0 1.953l-7.108 4.062a1.125 1.125 0 0 1-1.683-.977V8.688Z" />
                                    </svg>
                                    Continue Match
                                </button>
                            @elseif($match->isCompleted())
                                <div class="inline-flex items-center gap-x-1.5 rounded-md bg-gray-100 px-3 py-2 text-sm font-medium text-gray-600">
                                    <svg class="-ml-0.5 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v1.5M3 21v-6m0 0 2.77-.693a9 9 0 0 1 6.208.682l.108.054a9 9 0 0 0 6.086.71l3.114-.732a48.524 48.524 0 0 1-.005-10.499l-3.11.732a9 9 0 0 1-6.085-.711l-.108-.054a9 9 0 0 0-6.208-.682L3 4.5M3 15V4.5" />
                                    </svg>
                                    Match Completed
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Schedule Information -->
                        <div class="bg-zinc-50 dark:bg-zinc-900 rounded-lg p-4">
                            <h3 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Schedule</h3>
                            <div class="mt-2 space-y-2">
                                <p class="text-lg font-semibold text-zinc-900 dark:text-white">
                                    {{ $match->scheduled_at ? $match->scheduled_at->format('M d, Y') : 'Date not set' }}
                                </p>
                                <p class="text-md text-zinc-700 dark:text-zinc-300">
                                    {{ $match->scheduled_at ? $match->scheduled_at->format('h:i A') : 'Time not set' }}
                                </p>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($match->status === 'completed') bg-green-100 text-green-800
                                    @elseif($match->status === 'in_progress') bg-yellow-100 text-yellow-800
                                    @else bg-blue-100 text-blue-800 @endif">
                                    {{ ucfirst($match->status) }}
                                </span>

                                @if($match->status === 'completed')
                                    <div class="mt-4 pt-4 border-t border-zinc-200 dark:border-zinc-600">
                                        <h4 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Match Result</h4>
                                        <div class="mt-2">
                                            <div class="flex items-center gap-2">
                                                <span class="text-lg font-bold text-green-600 dark:text-green-400">
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
                                                <span class="text-2xl">👑</span>
                                            </div>
                                            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                                                Completed at: {{ $match->completed_at ? $match->completed_at->format('d M Y H:i') : 'N/A' }}
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Scoring Section -->
                        <div class="bg-white dark:bg-zinc-800 shadow rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-100 mb-4">Match Score</h3>
                            
                            @if($match->status !== 'scheduled')
                                <div class="space-y-4">
                                    <!-- Sets Display -->
                                    @foreach($sets as $setNumber => $score)
                                        <div class="flex items-center justify-between p-3 bg-zinc-50 dark:bg-zinc-700 rounded-lg">
                                            <span class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Set {{ $setNumber }}</span>
                                            <div class="flex items-center gap-2">
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
                                                    <div class="flex items-center gap-1">
                                                        <span class="text-yellow-500" title="Set Winner">👑</span>
                                                        <span class="text-sm font-medium text-green-600 dark:text-green-400">
                                                            {{ $winnerName }}
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-center text-zinc-500 dark:text-zinc-400">Match hasn't started yet</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('livewire.admin.tournaments.modals.delete-modal')
    @include('livewire.admin.tournaments.modals.umpire-modal')
    @include('livewire.admin.tournaments.modals.scoring-modal')
</div>