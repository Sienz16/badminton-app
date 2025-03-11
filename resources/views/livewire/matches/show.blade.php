<div>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Match Status Header -->
        <div class="mb-6 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Match Details</h1>
                <div class="rounded-full px-4 py-1 text-sm font-medium
                    @if($match->isLive()) bg-green-100 text-green-800
                    @elseif($match->isCompleted()) bg-gray-100 text-gray-800
                    @elseif($match->isCancelled()) bg-red-100 text-red-800
                    @else bg-blue-100 text-blue-800 @endif">
                    @if($match->isLive())
                        <div class="flex items-center space-x-2">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                            </span>
                            <span>{{ __('Live') }}</span>
                        </div>
                    @elseif($match->isCompleted())
                        {{ __('Completed') }}
                    @elseif($match->isCancelled())
                        {{ __('Cancelled') }}
                    @else
                        {{ __('Scheduled') }}
                    @endif
                </div>
            </div>

            @if($match->isScheduled() && Auth::user()->id === $match->umpire_id)
                <button 
                    wire:click="startMatch"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-500 dark:hover:bg-indigo-600"
                >
                    {{ __('Start Match') }}
                </button>
            @endif
        </div>

        <!-- Scoring Section -->
        <div class="mb-8 grid grid-cols-3 gap-4">
            <!-- Player 1 -->
            <div class="flex flex-col items-center space-y-4 rounded-lg bg-white p-6 shadow-sm dark:bg-gray-800">
                <div class="text-lg font-semibold">{{ $match->player1->name }}</div>
                @if($match->isLive() && Auth::user()->id === $match->umpire_id)
                    <div class="flex flex-col items-center space-y-4">
                        <div class="flex items-center space-x-4">
                            <button 
                                wire:click="decrementScore(1)"
                                wire:loading.attr="disabled"
                                class="inline-flex items-center px-3 py-1 border border-gray-300 text-sm rounded-md bg-white hover:bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:hover:bg-gray-600 disabled:opacity-50"
                            >
                                <span wire:loading.remove wire:target="decrementScore(1)">-</span>
                                <span wire:loading wire:target="decrementScore(1)" class="h-4 w-4">
                                    <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </span>
                            </button>
                            <span class="text-3xl font-bold">{{ $player1Score }}</span>
                            <button 
                                wire:click="incrementScore(1)"
                                wire:loading.attr="disabled"
                                class="inline-flex items-center px-3 py-1 border border-gray-300 text-sm rounded-md bg-white hover:bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:hover:bg-gray-600 disabled:opacity-50"
                            >
                                <span wire:loading.remove wire:target="incrementScore(1)">+</span>
                                <span wire:loading wire:target="incrementScore(1)" class="h-4 w-4">
                                    <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </span>
                            </button>
                        </div>
                        <button 
                            wire:click="declareWinner('{{ $match->player1_id }}')"
                            class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700"
                        >
                            Declare Winner
                        </button>
                    </div>
                @else
                    <span class="text-3xl font-bold">{{ $player1Score }}</span>
                @endif
            </div>

            <!-- VS -->
            <div class="flex items-center justify-center">
                <span class="text-2xl font-bold">VS</span>
            </div>

            <!-- Player 2 -->
            <div class="flex flex-col items-center space-y-4 rounded-lg bg-white p-6 shadow-sm dark:bg-gray-800">
                <div class="text-lg font-semibold">{{ $match->player2->name }}</div>
                @if($match->isLive() && Auth::user()->id === $match->umpire_id)
                    <div class="flex flex-col items-center space-y-4">
                        <div class="flex items-center space-x-4">
                            <button 
                                wire:click="decrementScore(2)"
                                wire:loading.attr="disabled"
                                class="inline-flex items-center px-3 py-1 border border-gray-300 text-sm rounded-md bg-white hover:bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:hover:bg-gray-600 disabled:opacity-50"
                            >
                                <span wire:loading.remove wire:target="decrementScore(2)">-</span>
                                <span wire:loading wire:target="decrementScore(2)" class="h-4 w-4">
                                    <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </span>
                            </button>
                            <span class="text-3xl font-bold">{{ $player2Score }}</span>
                            <button 
                                wire:click="incrementScore(2)"
                                wire:loading.attr="disabled"
                                class="inline-flex items-center px-3 py-1 border border-gray-300 text-sm rounded-md bg-white hover:bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:hover:bg-gray-600 disabled:opacity-50"
                            >
                                <span wire:loading.remove wire:target="incrementScore(2)">+</span>
                                <span wire:loading wire:target="incrementScore(2)" class="h-4 w-4">
                                    <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </span>
                            </button>
                        </div>
                        <button 
                            wire:click="declareWinner('{{ $match->player2_id }}')"
                            class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700"
                        >
                            Declare Winner
                        </button>
                    </div>
                @else
                    <span class="text-3xl font-bold">{{ $player2Score }}</span>
                @endif
            </div>
        </div>

        <!-- Match Details -->
        <div class="rounded-lg bg-white p-6 shadow-sm dark:bg-gray-800">
            <dl class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Venue</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-300">{{ $match->venue->name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Scheduled Time</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-300">{{ $match->scheduled_at->format('M j, Y g:i A') }}</dd>
                </div>
                @if($match->played_at)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Played At</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-300">{{ $match->played_at->format('M j, Y g:i A') }}</dd>
                    </div>
                @endif
            </dl>
        </div>
    </div>

    <!-- Winner Modal -->
    @if($showWinnerModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex min-h-screen items-end justify-center px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                <!-- Modal panel -->
                <div class="relative inline-block transform overflow-hidden rounded-lg bg-white text-left align-bottom shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:align-middle dark:bg-gray-800">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 dark:bg-gray-800">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:text-left">
                                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white" id="modal-title">
                                    Confirm Winner
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500 dark:text-gray-300">
                                        Are you sure you want to end the match and declare {{ $winnerId === $match->player1_id ? $match->player1->name : $match->player2->name }} as the winner?
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 dark:bg-gray-700">
                        <button 
                            wire:click="setWinner"
                            type="button"
                            class="inline-flex w-full justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm"
                        >
                            Confirm Winner
                        </button>
                        <button 
                            wire:click="$set('showWinnerModal', false)"
                            type="button"
                            class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm dark:bg-gray-600 dark:border-gray-500 dark:text-gray-300 dark:hover:bg-gray-500"
                        >
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
