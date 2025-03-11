<div>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="space-y-8">
            <!-- Header -->
            <div class="border-b border-zinc-200 pb-5 dark:border-zinc-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-3xl font-bold tracking-tight text-zinc-900 dark:text-white">
                        {{ __('Match Details') }}
                    </h3>
                    @if($match->isScheduled() && Auth::user()->id === $match->umpire_id)
                        <button
                            wire:click="startMatch"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-semibold rounded-lg shadow-sm text-white bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                            </svg>
                            {{ __('Start Match') }}
                        </button>
                    @endif
                </div>
            </div>

            <!-- Match Info -->
            <div class="bg-white dark:bg-zinc-800 shadow-lg rounded-2xl p-6 backdrop-blur-xl backdrop-filter">
                <dl class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-3">
                    <div class="relative">
                        <dt class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('Venue') }}</dt>
                        <dd class="mt-2 text-lg font-semibold text-zinc-900 dark:text-white">{{ $match->venue->name }}</dd>
                    </div>
                    <div class="relative">
                        <dt class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('Scheduled At') }}</dt>
                        <dd class="mt-2 text-lg font-semibold text-zinc-900 dark:text-white">{{ $match->scheduled_at->format('M j, Y g:i A') }}</dd>
                    </div>
                    <div class="relative">
                        <dt class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('Status') }}</dt>
                        <dd class="mt-2">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $match->isLive() ? 'bg-green-100 text-green-800' : ($match->isCompleted() ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') }}">
                                {{ ucfirst($match->status) }}
                            </span>
                        </dd>
                    </div>
                </dl>
            </div>

            <!-- Scoring Section (Only visible for live matches) -->
            @if($match->isLive())
                <div class="bg-white dark:bg-zinc-800 shadow-lg rounded-2xl p-8 backdrop-blur-xl backdrop-filter">
                    <div class="grid grid-cols-7 gap-4 items-center">
                        <!-- Player 1 -->
                        <div class="col-span-3 bg-gradient-to-br from-zinc-50 to-zinc-100 dark:from-zinc-700 dark:to-zinc-800 rounded-xl p-6 shadow-sm">
                            <div class="flex flex-col items-center space-y-6">
                                <div class="text-xl font-bold text-zinc-900 dark:text-white">{{ $match->player1->name }}</div>
                                <div class="flex items-center space-x-6">
                                    <button 
                                        wire:click="decrementScore(1)"
                                        wire:loading.attr="disabled"
                                        wire:target="decrementScore(1)"
                                        class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-red-500 hover:bg-red-600 text-white shadow-lg hover:shadow-xl transition-all duration-200 disabled:opacity-50"
                                    >
                                        <span wire:loading.remove wire:target="decrementScore(1)" class="text-2xl font-bold">-</span>
                                        <span wire:loading wire:target="decrementScore(1)" class="h-6 w-6">
                                            <svg class="animate-spin h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                        </span>
                                    </button>
                                    <span class="text-6xl font-bold text-zinc-900 dark:text-white tabular-nums">{{ $player1Score }}</span>
                                    <button 
                                        wire:click="incrementScore(1)"
                                        wire:loading.attr="disabled"
                                        wire:target="incrementScore(1)"
                                        class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-green-500 hover:bg-green-600 text-white shadow-lg hover:shadow-xl transition-all duration-200 disabled:opacity-50"
                                    >
                                        <span wire:loading.remove wire:target="incrementScore(1)" class="text-2xl font-bold">+</span>
                                        <span wire:loading wire:target="incrementScore(1)" class="h-6 w-6">
                                            <svg class="animate-spin h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                                <button 
                                    wire:click="declareWinner('{{ $match->player1_id }}')"
                                    class="inline-flex items-center px-6 py-3 text-sm font-semibold rounded-lg text-white bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 shadow-md hover:shadow-lg transition-all duration-200"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    {{ __('Declare Winner') }}
                                </button>
                            </div>
                        </div>

                        <!-- VS -->
                        <div class="col-span-1 flex items-center justify-center">
                            <span class="text-3xl font-black text-zinc-400 dark:text-zinc-500">VS</span>
                        </div>

                        <!-- Player 2 -->
                        <div class="col-span-3 bg-gradient-to-br from-zinc-50 to-zinc-100 dark:from-zinc-700 dark:to-zinc-800 rounded-xl p-6 shadow-sm">
                            <div class="flex flex-col items-center space-y-6">
                                <div class="text-xl font-bold text-zinc-900 dark:text-white">{{ $match->player2->name }}</div>
                                <div class="flex items-center space-x-6">
                                    <button 
                                        wire:click="decrementScore(2)"
                                        wire:loading.attr="disabled"
                                        wire:target="decrementScore(2)"
                                        class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-red-500 hover:bg-red-600 text-white shadow-lg hover:shadow-xl transition-all duration-200 disabled:opacity-50"
                                    >
                                        <span wire:loading.remove wire:target="decrementScore(2)" class="text-2xl font-bold">-</span>
                                        <span wire:loading wire:target="decrementScore(2)" class="h-6 w-6">
                                            <svg class="animate-spin h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                        </span>
                                    </button>
                                    <span class="text-6xl font-bold text-zinc-900 dark:text-white tabular-nums">{{ $player2Score }}</span>
                                    <button 
                                        wire:click="incrementScore(2)"
                                        wire:loading.attr="disabled"
                                        wire:target="incrementScore(2)"
                                        class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-green-500 hover:bg-green-600 text-white shadow-lg hover:shadow-xl transition-all duration-200 disabled:opacity-50"
                                    >
                                        <span wire:loading.remove wire:target="incrementScore(2)" class="text-2xl font-bold">+</span>
                                        <span wire:loading wire:target="incrementScore(2)" class="h-6 w-6">
                                            <svg class="animate-spin h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                                <button 
                                    wire:click="declareWinner('{{ $match->player2_id }}')"
                                    class="inline-flex items-center px-6 py-3 text-sm font-semibold rounded-lg text-white bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 shadow-md hover:shadow-lg transition-all duration-200"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    {{ __('Declare Winner') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Winner Modal -->
    <div
        x-data
        x-show="$wire.showWinnerModal"
        class="fixed inset-0 z-50 overflow-y-auto"
        style="display: none;"
    >
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div
                x-show="$wire.showWinnerModal"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 transition-opacity"
                aria-hidden="true"
            >
                <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div
                x-show="$wire.showWinnerModal"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block align-bottom bg-white dark:bg-zinc-800 rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6"
            >
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 dark:bg-green-900 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-green-600 dark:text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
                            {{ __('Confirm Winner') }}
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ __('Are you sure you want to declare this player as the winner? This action cannot be undone.') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                    <button
                        wire:click="setWinner"
                        type="button"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm"
                    >
                        {{ __('Confirm') }}
                    </button>
                    <button
                        wire:click="$set('showWinnerModal', false)"
                        type="button"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-zinc-700 text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-zinc-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm"
                    >
                        {{ __('Cancel') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
