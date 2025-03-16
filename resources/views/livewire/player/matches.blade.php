<div>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ __('My Matches') }}</h1>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ __('View and manage all your badminton matches') }}</p>
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
                    class="{{ $activeTab === 'live' ? 'border-green-500 text-green-600 dark:text-green-400' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' }} whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium"
                >
                    {{ __('Live') }}
                    @if($liveCount > 0)
                        <span class="ml-2 rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">
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

        <!-- Match List -->
        <div class="space-y-4">
            <!-- Upcoming Matches -->
            @if($activeTab === 'upcoming')
                @forelse($upcomingMatches as $match)
                    <div class="flex flex-col space-y-4">
                        <!-- Match Card -->
                        <a href="{{ route('player.matches.show', $match) }}" wire:navigate
                           class="block overflow-hidden rounded-lg bg-white shadow dark:bg-zinc-800 border-2 border-green-300 dark:border-green-700 transition-all duration-300 hover:shadow-lg hover:border-primary/50 dark:hover:border-primary/50">
                            <div class="p-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div>
                                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                                                {{ $match->player1?->name ?? 'Player 1' }} vs {{ $match->player2?->name ?? 'Player 2' }}
                                            </h3>
                                            <div class="mt-1 flex items-center text-sm text-gray-500 dark:text-gray-400">
                                                <flux:icon name="user" class="mr-1.5 h-4 w-4" />
                                                {{ __('Umpire:') }} {{ $match->umpireUser?->name ?? __('Not assigned') }}
                                            </div>
                                            <div class="mt-1 flex items-center text-sm text-gray-500 dark:text-gray-400">
                                                <flux:icon name="calendar" class="mr-1.5 h-4 w-4" />
                                                {{ $match->scheduled_at->format('d M Y, h:i A') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                            {{ __('Match Status') }}
                                        </div>
                                        <div class="mt-1 text-lg font-bold text-blue-600 dark:text-blue-400">
                                            {{ __('Upcoming') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="rounded-lg border-2 border-dashed border-gray-200 p-12 text-center dark:border-gray-700">
                        <div class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-600">
                            <flux:icon name="calendar" class="h-12 w-12" />
                        </div>
                        <h3 class="mt-2 text-sm font-semibold text-gray-900 dark:text-white">{{ __('No Upcoming Matches') }}</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('You have no upcoming matches scheduled.') }}</p>
                    </div>
                @endforelse
            @elseif($activeTab === 'live')
                @forelse($liveMatches as $match)
                    <div class="flex flex-col space-y-4">
                        <!-- Match Card -->
                        <a href="{{ route('player.matches.show', $match) }}" wire:navigate
                           class="block overflow-hidden rounded-lg bg-white shadow dark:bg-zinc-800 border-2 border-green-300 dark:border-green-700 transition-all duration-300 hover:shadow-lg hover:border-primary/50 dark:hover:border-primary/50">
                            <div class="p-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div>
                                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                                                {{ $match->player1?->name ?? 'Player 1' }} vs {{ $match->player2?->name ?? 'Player 2' }}
                                            </h3>
                                            <div class="mt-1 flex items-center text-sm text-gray-500 dark:text-gray-400">
                                                <flux:icon name="user" class="mr-1.5 h-4 w-4" />
                                                {{ __('Umpire:') }} {{ $match->umpireUser?->name ?? __('Not assigned') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $match->current_score }}</div>
                                        <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('Current Score') }}</div>
                                        <div class="mt-2 text-sm font-medium text-green-600 dark:text-green-400">
                                            {{ __('In Progress') }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Set Scores -->
                                <div class="mt-4 border-t border-gray-200 pt-4 dark:border-gray-700">
                                    <div class="grid grid-cols-3 gap-4">
                                        @foreach(range(1, 3) as $setNumber)
                                        @php
                                            $setScore = DB::table('match_sets')
                                                ->where('match_id', $match->id)
                                                ->where('set_number', $setNumber)
                                                ->first();
                                        @endphp
                                        <div class="text-center">
                                            <div class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">
                                                SET {{ $setNumber }}
                                            </div>
                                            <div class="text-lg font-bold text-gray-900 dark:text-white">
                                                {{ $setScore?->player1_score ?? '0' }} - {{ $setScore?->player2_score ?? '0' }}
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </a>
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
            @elseif($activeTab === 'completed')
                @forelse($completedMatches as $match)
                    <div class="flex flex-col space-y-4">
                        <!-- Match Card -->
                        <a href="{{ route('player.matches.show', $match) }}" wire:navigate
                           class="block overflow-hidden rounded-lg bg-white shadow dark:bg-zinc-800 border-2 border-green-300 dark:border-green-700 transition-all duration-300 hover:shadow-lg hover:border-primary/50 dark:hover:border-primary/50">
                            <div class="p-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div>
                                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                                                {{ $match->player1?->name ?? 'Player 1' }} vs {{ $match->player2?->name ?? 'Player 2' }}
                                            </h3>
                                            <div class="mt-1 flex items-center text-sm text-gray-500 dark:text-gray-400">
                                                <flux:icon name="user" class="mr-1.5 h-4 w-4" />
                                                {{ __('Umpire:') }} {{ $match->umpireUser?->name ?? __('Not assigned') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $match->final_score }}</div>
                                        <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('Final Score') }}</div>
                                        <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                            {{ $match->winner_id === Auth::id() ? __('Won') : __('Lost') }}
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
                                            <div class="text-lg font-bold {{ $setWinner?->winner_id === Auth::id() ? 'text-green-600 dark:text-green-400' : 'text-gray-900 dark:text-white' }}">
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
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="rounded-lg border-2 border-dashed border-gray-200 p-12 text-center dark:border-gray-700">
                        <div class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-600">
                            <flux:icon name="check-circle" class="h-12 w-12" />
                        </div>
                        <h3 class="mt-2 text-sm font-semibold text-gray-900 dark:text-white">{{ __('No Completed Matches') }}</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('You haven\'t completed any matches yet.') }}</p>
                    </div>
                @endforelse

                @if($completedMatches->hasPages())
                    <div class="mt-4">
                        {{ $completedMatches->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
