<div>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-2xl font-semibold text-white-900">{{ __('My Matches') }}</h1>
            <p class="mt-2 text-sm text-white-600">{{ __('View and manage all your badminton matches') }}</p>
        </div>

        <!-- Match Status Tabs -->
        <div class="mb-6 border-b border-gray-200">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                <button 
                    wire:click="$set('activeTab', 'upcoming')"
                    class="{{ $activeTab === 'upcoming' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium"
                >
                    {{ __('Upcoming') }}
                    @if($upcomingCount)
                        <span class="ml-2 rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-600">
                            {{ $upcomingCount }}
                        </span>
                    @endif
                </button>

                <button 
                    wire:click="$set('activeTab', 'live')"
                    class="{{ $activeTab === 'live' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium"
                >
                    {{ __('Live') }}
                    @if($liveCount)
                        <span class="ml-2 rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-600">
                            {{ $liveCount }}
                        </span>
                    @endif
                </button>

                <button 
                    wire:click="$set('activeTab', 'completed')"
                    class="{{ $activeTab === 'completed' ? 'border-gray-500 text-gray-600' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium"
                >
                    {{ __('Completed') }}
                </button>
            </nav>
        </div>

        <!-- Match List -->
        <div class="space-y-4">
            @if($activeTab === 'upcoming')
                @forelse($upcomingMatches as $match)
                    <div class="group relative overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm transition hover:border-blue-200">
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-50 text-blue-600">
                                            <flux:icon name="calendar" class="h-6 w-6" />
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-medium text-gray-900">
                                            {{ $match->player1->name }} vs {{ $match->player2->name }}
                                        </h3>
                                        <div class="mt-1 flex items-center space-x-4 text-sm text-gray-500">
                                            <div class="flex items-center">
                                                <flux:icon name="clock" class="mr-1.5 h-4 w-4" />
                                                {{ $match->scheduled_at->format('M j, Y g:i A') }}
                                            </div>
                                            <div class="flex items-center">
                                                <flux:icon name="map-pin" class="mr-1.5 h-4 w-4" />
                                                {{ $match->venue->name }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <flux:button 
                                        href="{{ route('player.matches.show', $match) }}"
                                        wire:navigate
                                        variant="outline"
                                    >
                                        {{ __('View Details') }}
                                    </flux:button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="rounded-lg border-2 border-dashed border-gray-200 p-12 text-center">
                        <div class="mx-auto h-12 w-12 text-gray-400">
                            <flux:icon name="calendar" class="h-12 w-12" />
                        </div>
                        <h3 class="mt-2 text-sm font-semibold text-gray-900">{{ __('No Upcoming Matches') }}</h3>
                        <p class="mt-1 text-sm text-gray-500">{{ __('You have no scheduled matches at the moment.') }}</p>
                    </div>
                @endforelse
            @endif

            @if($activeTab === 'live')
                @forelse($liveMatches as $match)
                    <div class="group relative overflow-hidden rounded-lg border border-green-200 bg-white shadow-sm">
                        <div class="absolute right-0 top-0 mr-4 mt-4">
                            <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">
                                <span class="mr-1.5 flex h-2 w-2">
                                    <span class="absolute inline-flex h-2 w-2 animate-ping rounded-full bg-green-400 opacity-75"></span>
                                    <span class="relative inline-flex h-2 w-2 rounded-full bg-green-500"></span>
                                </span>
                                {{ __('Live Now') }}
                            </span>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div>
                                        <h3 class="text-lg font-medium text-gray-900">
                                            {{ $match->player1->name }} vs {{ $match->player2->name }}
                                        </h3>
                                        <div class="mt-1 flex items-center space-x-4 text-sm text-gray-500">
                                            <div class="flex items-center">
                                                <flux:icon name="map-pin" class="mr-1.5 h-4 w-4" />
                                                {{ $match->venue->name }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-gray-900">{{ $match->score }}</div>
                                    <div class="mt-1 text-sm text-gray-500">{{ __('Current Score') }}</div>
                                </div>
                            </div>
                            <div class="mt-4 flex justify-end">
                                <flux:button 
                                    href="{{ route('player.matches.show', $match) }}"
                                    wire:navigate
                                    variant="primary"
                                >
                                    {{ __('Watch Live') }}
                                </flux:button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="rounded-lg border-2 border-dashed border-gray-200 p-12 text-center">
                        <div class="mx-auto h-12 w-12 text-gray-400">
                            <flux:icon name="play" class="h-12 w-12" />
                        </div>
                        <h3 class="mt-2 text-sm font-semibold text-gray-900">{{ __('No Live Matches') }}</h3>
                        <p class="mt-1 text-sm text-gray-500">{{ __('There are no matches being played right now.') }}</p>
                    </div>
                @endforelse
            @endif

            @if($activeTab === 'completed')
                @forelse($completedMatches as $match)
                    <div class="group relative overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div>
                                        <h3 class="text-lg font-medium text-gray-900">
                                            {{ $match->player1->name }} vs {{ $match->player2->name }}
                                        </h3>
                                        <div class="mt-1 flex items-center space-x-4 text-sm text-gray-500">
                                            <div class="flex items-center">
                                                <flux:icon name="clock" class="mr-1.5 h-4 w-4" />
                                                {{ $match->played_at->format('M j, Y g:i A') }}
                                            </div>
                                            <div class="flex items-center">
                                                <flux:icon name="map-pin" class="mr-1.5 h-4 w-4" />
                                                {{ $match->venue->name }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-gray-900">{{ $match->score }}</div>
                                    <div class="mt-1 text-sm text-gray-500">{{ __('Final Score') }}</div>
                                </div>
                            </div>
                            <div class="mt-4 flex justify-end">
                                <flux:button 
                                    href="{{ route('player.matches.show', $match) }}"
                                    wire:navigate
                                    variant="outline"
                                >
                                    {{ __('View Summary') }}
                                </flux:button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="rounded-lg border-2 border-dashed border-gray-200 p-12 text-center">
                        <div class="mx-auto h-12 w-12 text-gray-400">
                            <flux:icon name="check-circle" class="h-12 w-12" />
                        </div>
                        <h3 class="mt-2 text-sm font-semibold text-gray-900">{{ __('No Completed Matches') }}</h3>
                        <p class="mt-1 text-sm text-gray-500">{{ __('You haven\'t completed any matches yet.') }}</p>
                    </div>
                @endforelse

                @if($completedMatches->hasPages())
                    <div class="mt-6">
                        {{ $completedMatches->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
