<div>
    @if($match->isScheduled())
        <div class="flex justify-center">
            <button 
                wire:click="startMatch"
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-semibold rounded-lg shadow-sm text-white bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                </svg>
                {{ __('Start Match') }}
            </button>
        </div>
    @endif

    @if($match->isLive())
        <div class="grid grid-cols-7 gap-4 items-center">
            <!-- Player 1 -->
            <div class="col-span-3 bg-gradient-to-br from-zinc-50 to-zinc-100 dark:from-zinc-700 dark:to-zinc-800 rounded-xl p-6 shadow-sm">
                <div class="flex flex-col items-center space-y-6">
                    <div class="text-xl font-bold text-zinc-900 dark:text-white">{{ $match->player1->name }}</div>
                    <div class="flex items-center space-x-6">
                        <button 
                            wire:click="decrementScore(1)"
                            class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-red-500 hover:bg-red-600 text-white"
                        >-</button>
                        <span class="text-6xl font-bold tabular-nums">{{ $player1Score }}</span>
                        <button 
                            wire:click="incrementScore(1)"
                            class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-green-500 hover:bg-green-600 text-white"
                        >+</button>
                    </div>
                </div>
            </div>

            <div class="col-span-1 flex justify-center">
                <span class="text-3xl font-black text-zinc-400">VS</span>
            </div>

            <!-- Player 2 -->
            <div class="col-span-3 bg-gradient-to-br from-zinc-50 to-zinc-100 dark:from-zinc-700 dark:to-zinc-800 rounded-xl p-6 shadow-sm">
                <div class="flex flex-col items-center space-y-6">
                    <div class="text-xl font-bold text-zinc-900 dark:text-white">{{ $match->player2->name }}</div>
                    <div class="flex items-center space-x-6">
                        <button 
                            wire:click="decrementScore(2)"
                            class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-red-500 hover:bg-red-600 text-white"
                        >-</button>
                        <span class="text-6xl font-bold tabular-nums">{{ $player2Score }}</span>
                        <button 
                            wire:click="incrementScore(2)"
                            class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-green-500 hover:bg-green-600 text-white"
                        >+</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>