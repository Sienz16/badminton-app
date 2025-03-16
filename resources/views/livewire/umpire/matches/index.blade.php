<div>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ __('My Matches') }}</h1>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ __('View and manage all your assigned matches') }}</p>
        </div>

        <!-- Match Status Tabs -->
        <div class="mb-6 border-b border-gray-200 dark:border-gray-700">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                <button 
                    wire:click="$set('activeTab', 'upcoming')"
                    class="{{ $activeTab === 'upcoming' ? 'border-blue-500 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' }} whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium"
                >
                    {{ __('Upcoming') }}
                    @if($upcomingCount > 0)
                        <span class="ml-2 rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                            {{ $upcomingCount }}
                        </span>
                    @endif
                </button>

                <button 
                    wire:click="$set('activeTab', 'live')"
                    class="{{ $activeTab === 'live' ? 'border-blue-500 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' }} whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium"
                >
                    {{ __('Live') }}
                    @if($liveCount > 0)
                        <span class="ml-2 rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 dark:bg-red-900 dark:text-red-300">
                            {{ $liveCount }}
                        </span>
                    @endif
                </button>

                <button 
                    wire:click="$set('activeTab', 'completed')"
                    class="{{ $activeTab === 'completed' ? 'border-gray-500 text-gray-600 dark:text-gray-400' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' }} whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium"
                >
                    {{ __('Completed') }}
                    @if($completedCount > 0)
                        <span class="ml-2 rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800 dark:bg-gray-900 dark:text-gray-300">
                            {{ $completedCount }}
                        </span>
                    @endif
                </button>
            </nav>
        </div>

        <!-- Match Cards Section -->
        <div class="space-y-6">
            @if($activeTab === 'upcoming')
                <div class="flex flex-col space-y-4">
                    @forelse($upcomingMatches as $match)
                        <div class="group overflow-hidden rounded-xl bg-white shadow-lg dark:bg-zinc-800 
                                  border-2 border-green-300 dark:border-green-700 
                                  transition-all duration-300 
                                  hover:border-green-500/50 dark:hover:border-green-500/50 
                                  hover:shadow-xl hover:scale-[1.02]">
                            <div class="p-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div>
                                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                                                <div class="flex items-center gap-4">
                                                    <!-- Player 1 -->
                                                    <div class="flex items-center gap-2">
                                                        @if($match->player1?->player?->profile_photo)
                                                            <img src="{{ Storage::url($match->player1->player->profile_photo) }}" 
                                                                 class="h-10 w-10 rounded-full object-cover"
                                                                 alt="{{ $match->player1->name }}">
                                                        @else
                                                            <div class="flex h-10 w-10 items-center justify-center rounded-full 
                                                                      bg-green-100 font-medium text-green-800 
                                                                      dark:bg-green-900/30 dark:text-green-400">
                                                                {{ substr($match->player1->name ?? 'P1', 0, 2) }}
                                                            </div>
                                                        @endif
                                                        <span>{{ $match->player1?->name ?? 'Player 1' }}</span>
                                                    </div>
                                                    
                                                    <span class="text-sm font-semibold text-green-600 dark:text-green-400">VS</span>
                                                    
                                                    <!-- Player 2 -->
                                                    <div class="flex items-center gap-2">
                                                        <span>{{ $match->player2?->name ?? 'Player 2' }}</span>
                                                        @if($match->player2?->player?->profile_photo)
                                                            <img src="{{ Storage::url($match->player2->player->profile_photo) }}" 
                                                                 class="h-10 w-10 rounded-full object-cover"
                                                                 alt="{{ $match->player2->name }}">
                                                        @else
                                                            <div class="flex h-10 w-10 items-center justify-center rounded-full 
                                                                      bg-green-100 font-medium text-green-800 
                                                                      dark:bg-green-900/30 dark:text-green-400">
                                                                {{ substr($match->player2->name ?? 'P2', 0, 2) }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </h3>
                                            <div class="mt-2 flex items-center space-x-3 text-sm text-gray-500 dark:text-gray-400">
                                                <div class="flex items-center">
                                                    <flux:icon name="map-pin" class="mr-1.5 h-4 w-4" />
                                                    {{ $match->venue?->name }}
                                                </div>
                                                <div class="flex items-center">
                                                    <flux:icon name="calendar" class="mr-1.5 h-4 w-4" />
                                                    {{ $match->scheduled_at?->format('M j, Y g:i A') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{ route('umpire.matches.show', $match) }}"
                                       wire:navigate
                                       class="inline-flex items-center rounded-md bg-green-600 px-4 py-2 text-sm font-semibold text-white shadow-sm 
                                              hover:bg-green-500 dark:bg-green-500 dark:hover:bg-green-400 
                                              transition-colors duration-300">
                                        {{ __('View Match') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-lg border-2 border-dashed border-gray-200 p-12 text-center dark:border-gray-700">
                            <div class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-600">
                                <flux:icon name="calendar" class="h-12 w-12" />
                            </div>
                            <h3 class="mt-2 text-sm font-semibold text-gray-900 dark:text-white">{{ __('No Upcoming Matches') }}</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('You have no upcoming matches to officiate.') }}</p>
                        </div>
                    @endforelse
                </div>
            @elseif($activeTab === 'live')
                <div class="flex flex-col space-y-4">
                    @forelse($liveMatches as $match)
                        <div class="group overflow-hidden rounded-xl bg-white shadow-lg dark:bg-zinc-800 
                                  border-2 border-red-300 dark:border-red-700
                                  transition-all duration-300 
                                  hover:border-red-500/50 dark:hover:border-red-500/50 
                                  hover:shadow-xl hover:scale-[1.02]">
                            <div class="p-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div>
                                            <div class="flex items-center space-x-2">
                                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                                                    <div class="flex items-center gap-4">
                                                        <!-- Player 1 -->
                                                        <div class="flex items-center gap-2">
                                                            @if($match->player1?->player?->profile_photo)
                                                                <img src="{{ Storage::url($match->player1->player->profile_photo) }}" 
                                                                     class="h-10 w-10 rounded-full object-cover"
                                                                     alt="{{ $match->player1->name }}">
                                                            @else
                                                                <div class="flex h-10 w-10 items-center justify-center rounded-full 
                                                                          bg-red-100 font-medium text-red-800 
                                                                          dark:bg-red-900/30 dark:text-red-400">
                                                                    {{ substr($match->player1->name ?? 'P1', 0, 2) }}
                                                                </div>
                                                            @endif
                                                            <span>{{ $match->player1?->name ?? 'Player 1' }}</span>
                                                        </div>
                                                        
                                                        <span class="text-sm font-semibold text-red-600 dark:text-red-400">VS</span>
                                                        
                                                        <!-- Player 2 -->
                                                        <div class="flex items-center gap-2">
                                                            <span>{{ $match->player2?->name ?? 'Player 2' }}</span>
                                                            @if($match->player2?->player?->profile_photo)
                                                                <img src="{{ Storage::url($match->player2->player->profile_photo) }}" 
                                                                     class="h-10 w-10 rounded-full object-cover"
                                                                     alt="{{ $match->player2->name }}">
                                                            @else
                                                                <div class="flex h-10 w-10 items-center justify-center rounded-full 
                                                                          bg-red-100 font-medium text-red-800 
                                                                          dark:bg-red-900/30 dark:text-red-400">
                                                                    {{ substr($match->player2->name ?? 'P2', 0, 2) }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </h3>
                                                <span class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 dark:bg-red-900/30 dark:text-red-400">
                                                    Live
                                                </span>
                                            </div>
                                            <div class="mt-2 flex items-center space-x-3 text-sm text-gray-500 dark:text-gray-400">
                                                <div class="flex items-center">
                                                    <flux:icon name="map-pin" class="mr-1.5 h-4 w-4" />
                                                    {{ $match->venue?->name }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{ route('umpire.matches.show', $match) }}"
                                       wire:navigate
                                       class="inline-flex items-center rounded-md bg-red-600 px-4 py-2 text-sm font-semibold text-white shadow-sm 
                                              hover:bg-red-500 dark:bg-red-500 dark:hover:bg-red-400 
                                              transition-colors duration-300">
                                        {{ __('Continue Match') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-lg border-2 border-dashed border-gray-200 p-12 text-center dark:border-gray-700">
                            <div class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-600">
                                <flux:icon name="play-circle" class="h-12 w-12" />
                            </div>
                            <h3 class="mt-2 text-sm font-semibold text-gray-900 dark:text-white">{{ __('No Live Matches') }}</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('You have no matches in progress.') }}</p>
                        </div>
                    @endforelse
                </div>
            @else
                <div class="flex flex-col space-y-4">
                    @forelse($completedMatches as $match)
                        <div class="group overflow-hidden rounded-xl bg-white shadow-lg dark:bg-zinc-800 
                                  border-2 border-blue-300 dark:border-blue-700
                                  transition-all duration-300 
                                  hover:border-blue-500/50 dark:hover:border-blue-500/50 
                                  hover:shadow-xl hover:scale-[1.02]">
                            <div class="p-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div>
                                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                                                <div class="flex items-center gap-4">
                                                    <!-- Player 1 -->
                                                    <div class="flex items-center gap-2">
                                                        @if($match->player1?->player?->profile_photo)
                                                            <img src="{{ Storage::url($match->player1->player->profile_photo) }}" 
                                                                 class="h-10 w-10 rounded-full object-cover"
                                                                 alt="{{ $match->player1->name }}">
                                                        @else
                                                            <div class="flex h-10 w-10 items-center justify-center rounded-full 
                                                                      bg-blue-100 font-medium text-blue-800 
                                                                      dark:bg-blue-900/30 dark:text-blue-400">
                                                                {{ substr($match->player1->name ?? 'P1', 0, 2) }}
                                                            </div>
                                                        @endif
                                                        <span>{{ $match->player1?->name ?? 'Player 1' }}</span>
                                                    </div>
                                                    
                                                    <span class="text-sm font-semibold text-blue-600 dark:text-blue-400">VS</span>
                                                    
                                                    <!-- Player 2 -->
                                                    <div class="flex items-center gap-2">
                                                        <span>{{ $match->player2?->name ?? 'Player 2' }}</span>
                                                        @if($match->player2?->player?->profile_photo)
                                                            <img src="{{ Storage::url($match->player2->player->profile_photo) }}" 
                                                                 class="h-10 w-10 rounded-full object-cover"
                                                                 alt="{{ $match->player2->name }}">
                                                        @else
                                                            <div class="flex h-10 w-10 items-center justify-center rounded-full 
                                                                      bg-blue-100 font-medium text-blue-800 
                                                                      dark:bg-blue-900/30 dark:text-blue-400">
                                                                {{ substr($match->player2->name ?? 'P2', 0, 2) }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </h3>
                                            <div class="mt-2 flex items-center space-x-3 text-sm text-gray-500 dark:text-gray-400">
                                                <div class="flex items-center">
                                                    <flux:icon name="map-pin" class="mr-1.5 h-4 w-4" />
                                                    {{ $match->venue?->name }}
                                                </div>
                                                <div class="flex items-center">
                                                    <flux:icon name="clock" class="mr-1.5 h-4 w-4" />
                                                    {{ $match->completed_at?->format('M j, Y g:i A') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $match->final_score }}</div>
                                        <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('Final Score') }}</div>
                                        <div class="mt-2">
                                            <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                                {{ __('Winner:') }} {{ $match->winner?->name }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Set Scores -->
                                <div class="mt-4 border-t border-gray-200 pt-4 dark:border-gray-700">
                                    <div class="grid grid-cols-3 gap-4">
                                        @foreach(range(1, 3) as $setNumber)
                                            @php
                                                $setWinner = DB::table('match_sets')
                                                    ->where('match_id', $match->id)
                                                    ->where('set_number', $setNumber)
                                                    ->first();
                                                
                                                $winnerName = null;
                                                if ($setWinner?->winner_id) {
                                                    $winnerName = $setWinner->winner_id === $match->player1_id 
                                                        ? $match->player1?->name 
                                                        : $match->player2?->name;
                                                }
                                            @endphp
                                            <div class="text-center">
                                                <div class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">
                                                    SET {{ $setNumber }}
                                                </div>
                                                <div class="text-lg font-bold text-gray-900 dark:text-white">
                                                    {{ $setWinner?->player1_score ?? '0' }} - {{ $setWinner?->player2_score ?? '0' }}
                                                </div>
                                                @if($winnerName)
                                                    <div class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                                        Winner: {{ $winnerName }}
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- View Details Link -->
                                <div class="mt-4 text-right">
                                    <a href="{{ route('umpire.matches.show', $match) }}"
                                       wire:navigate
                                       class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 text-sm font-medium">
                                        {{ __('View Match Details') }} →
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-lg border-2 border-dashed border-gray-200 p-12 text-center dark:border-gray-700">
                            <div class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-600">
                                <flux:icon name="check-circle" class="h-12 w-12" />
                            </div>
                            <h3 class="mt-2 text-sm font-semibold text-gray-900 dark:text-white">{{ __('No Completed Matches') }}</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('You have no completed matches yet.') }}</p>
                        </div>
                    @endforelse

                    <!-- Pagination -->
                    @if($completedMatches->hasPages())
                        <div class="mt-4">
                            {{ $completedMatches->links() }}
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
