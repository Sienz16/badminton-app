<div>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="space-y-6">
            <div class="border-b border-zinc-200 pb-5 dark:border-zinc-700">
                <h3 class="text-2xl font-semibold leading-6 text-zinc-900 dark:text-white">
                    {{ __('My Matches') }}
                </h3>
            </div>

            <div>
                <!-- Simple tabs without flux -->
                <div class="border-b border-zinc-200 dark:border-zinc-700">
                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                        <button
                            wire:click="$set('activeTab', 'upcoming')"
                            class="whitespace-nowrap border-b-2 px-1 py-4 text-sm font-medium transition-colors {{ $activeTab === 'upcoming' ? 'border-indigo-500 text-indigo-600 dark:border-indigo-400 dark:text-indigo-400' : 'border-transparent text-zinc-500 hover:border-zinc-300 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-300' }}"
                        >
                            {{ __('Upcoming') }}
                            @if($upcomingCount)
                                <span class="ml-2 rounded-full bg-zinc-100 px-2.5 py-0.5 text-xs font-medium text-zinc-600 dark:bg-zinc-700 dark:text-zinc-300">
                                    {{ $upcomingCount }}
                                </span>
                            @endif
                        </button>

                        <button
                            wire:click="$set('activeTab', 'live')"
                            class="whitespace-nowrap border-b-2 px-1 py-4 text-sm font-medium transition-colors {{ $activeTab === 'live' ? 'border-indigo-500 text-indigo-600 dark:border-indigo-400 dark:text-indigo-400' : 'border-transparent text-zinc-500 hover:border-zinc-300 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-300' }}"
                        >
                            {{ __('Live') }}
                            @if($liveCount)
                                <span class="ml-2 rounded-full bg-zinc-100 px-2.5 py-0.5 text-xs font-medium text-zinc-600 dark:bg-zinc-700 dark:text-zinc-300">
                                    {{ $liveCount }}
                                </span>
                            @endif
                        </button>

                        <button
                            wire:click="$set('activeTab', 'completed')"
                            class="whitespace-nowrap border-b-2 px-1 py-4 text-sm font-medium transition-colors {{ $activeTab === 'completed' ? 'border-indigo-500 text-indigo-600 dark:border-indigo-400 dark:text-indigo-400' : 'border-transparent text-zinc-500 hover:border-zinc-300 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-300' }}"
                        >
                            {{ __('Completed') }}
                            @if($completedCount)
                                <span class="ml-2 rounded-full bg-zinc-100 px-2.5 py-0.5 text-xs font-medium text-zinc-600 dark:bg-zinc-700 dark:text-zinc-300">
                                    {{ $completedCount }}
                                </span>
                            @endif
                        </button>
                    </nav>
                </div>

                <div class="mt-6">
                    <div x-show="$wire.activeTab === 'upcoming'">
                        @if($upcomingMatches->isEmpty())
                            <div class="text-center py-12">
                                <div class="text-zinc-900 dark:text-white text-lg font-semibold">
                                    {{ __('No upcoming matches') }}
                                </div>
                                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                                    {{ __('You have no upcoming matches scheduled.') }}
                                </p>
                            </div>
                        @else
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-700">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                                {{ __('Players') }}
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                                {{ __('Venue') }}
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                                {{ __('Date & Time') }}
                                            </th>
                                            <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only">{{ __('Actions') }}</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-zinc-800 divide-y divide-zinc-200 dark:divide-zinc-700">
                                        @foreach($upcomingMatches as $match)
                                            <tr wire:key="{{ $match->id }}">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-900 dark:text-white">
                                                    {{ $match->player1->name }} vs {{ $match->player2->name }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-900 dark:text-white">
                                                    {{ $match->venue->name }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-900 dark:text-white">
                                                    {{ $match->scheduled_at->format('M j, Y g:i A') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                                    <a 
                                                        href="{{ route('umpire.matches.show', $match) }}"
                                                        wire:navigate
                                                        class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300"
                                                    >
                                                        {{ __('View Details') }}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>

                    <div x-show="$wire.activeTab === 'live'">
                        @if($liveMatches->isEmpty())
                            <div class="text-center py-12">
                                <div class="text-zinc-900 dark:text-white text-lg font-semibold">
                                    {{ __('No live matches') }}
                                </div>
                                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                                    {{ __('You have no matches in progress.') }}
                                </p>
                            </div>
                        @else
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-700">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                                {{ __('Players') }}
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                                {{ __('Venue') }}
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                                {{ __('Score') }}
                                            </th>
                                            <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only">{{ __('Actions') }}</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-zinc-800 divide-y divide-zinc-200 dark:divide-zinc-700">
                                        @foreach($liveMatches as $match)
                                            <tr wire:key="{{ $match->id }}">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-900 dark:text-white">
                                                    {{ $match->player1->name }} vs {{ $match->player2->name }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-900 dark:text-white">
                                                    {{ $match->venue->name }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-900 dark:text-white">
                                                    {{ $match->score }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                                    <a 
                                                        href="{{ route('umpire.matches.show', $match) }}"
                                                        wire:navigate
                                                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600"
                                                    >
                                                        {{ __('Continue Match') }}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>

                    <div x-show="$wire.activeTab === 'completed'">
                        @if($completedMatches->isEmpty())
                            <div class="text-center py-12">
                                <div class="text-zinc-900 dark:text-white text-lg font-semibold">
                                    {{ __('No completed matches') }}
                                </div>
                                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                                    {{ __('You have no completed matches yet.') }}
                                </p>
                            </div>
                        @else
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-700">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                                {{ __('Players') }}
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                                {{ __('Venue') }}
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                                {{ __('Final Score') }}
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                                {{ __('Played At') }}
                                            </th>
                                            <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only">{{ __('Actions') }}</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-zinc-800 divide-y divide-zinc-200 dark:divide-zinc-700">
                                        @foreach($completedMatches as $match)
                                            <tr wire:key="{{ $match->id }}">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-900 dark:text-white">
                                                    {{ $match->player1->name }} vs {{ $match->player2->name }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-900 dark:text-white">
                                                    {{ $match->venue->name }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-900 dark:text-white">
                                                    {{ $match->score }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-900 dark:text-white">
                                                    {{ $match->played_at->format('M j, Y g:i A') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                                    <a 
                                                        href="{{ route('umpire.matches.show', $match) }}"
                                                        wire:navigate
                                                        class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300"
                                                    >
                                                        {{ __('View Details') }}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-4">
                                {{ $completedMatches->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
