<!-- Scoring Modal -->
<div 
x-data="{ 
    showScoringModal: @entangle('showScoringModal'),
    matchTimer: null,
    elapsedTime: '00:00:00',
    startTimer() {
        if ('{{ $match->status }}' === 'completed') {
            return;
        }
        
        const startTime = new Date('{{ $match->played_at ?? now() }}');
        this.matchTimer = setInterval(() => {
            const now = new Date();
            const diff = Math.floor((now - startTime) / 1000);
            const hours = Math.floor(diff / 3600).toString().padStart(2, '0');
            const minutes = Math.floor((diff % 3600) / 60).toString().padStart(2, '0');
            const seconds = (diff % 60).toString().padStart(2, '0');
            this.elapsedTime = `${hours}:${minutes}:${seconds}`;
            
            // Stop timer if match is completed
            if ('{{ $match->status }}' === 'completed') {
                clearInterval(this.matchTimer);
            }
        }, 1000);
    }
}"
x-init="
    $watch('showScoringModal', value => {
        if(value && '{{ $match->status }}' !== 'completed') {
            document.body.classList.add('overflow-hidden');
            startTimer();
        } else {
            document.body.classList.remove('overflow-hidden');
            if(matchTimer) clearInterval(matchTimer);
        }
    })
"
@keydown.escape="showScoringModal = false"
>
<!-- Teleported Modal -->
<template x-teleport="body">
    <div 
        x-show="showScoringModal"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[99] overflow-y-auto"
    >
        <div class="flex min-h-screen items-center justify-center p-4">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" @click="showScoringModal = false"></div>

            <!-- Modal Content -->
            <div class="relative w-full max-w-7xl rounded-2xl bg-white shadow-2xl dark:bg-gray-900 sm:w-11/12">
                <!-- Header -->
                <div class="flex items-center justify-between border-b border-gray-200 p-6 dark:border-gray-700">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Live Scoring</h2>
                        <p class="mt-1 text-l text-gray-600 dark:text-gray-400">Match Information</p>
                    </div>
                    
                    <div class="text-right">
                        <div class="text-3xl font-mono font-bold text-primary dark:text-primary/90" x-text="elapsedTime"></div>
                        <div class="mt-1">
                            <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-medium
                                {{ $match->isScheduled() ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/40 dark:text-yellow-400' : '' }}
                                {{ $match->isLive() ? 'bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary/90' : '' }}
                                {{ $match->isCompleted() ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-400' : '' }}">
                                {{ ucfirst($match->status) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="p-6">
                    @if($matchWinner)
                        <div class="mb-6 rounded-lg bg-primary/10 p-4 text-primary dark:bg-primary/20 dark:text-primary/90">
                            <p class="text-center text-lg font-medium">
                                Match Winner: {{ $matchWinner->name }}
                            </p>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-7">
                        <!-- Player 1 Card -->
                        <div class="lg:col-span-3">
                            <div class="relative overflow-hidden rounded-2xl ml-8 border-2 border-blue-500 bg-blue-500/10 p-6 dark:bg-blue-900/20">
                                <div class="relative">
                                    <div class="flex flex-col items-center space-y-6">
                                        <div class="text-center">
                                            <div class="text-2xl font-bold text-blue-900 dark:text-blue-100">
                                                {{ $match->player1?->name ?? 'Player 1'}}
                                            </div>
                                            <div class="mt-1 text-sm text-blue-600 dark:text-blue-400">
                                                Rank #{{ $match->player1?->ranking ?? 'N/A' }}
                                            </div>
                                        </div>
                                        
                                        <div class="flex items-center space-x-6">
                                            <button 
                                                wire:click="decrementScore(1)"
                                                wire:loading.attr="disabled"
                                                wire:target="decrementScore(1)"
                                                @if($matchWinner) disabled @endif
                                                class="group relative inline-flex h-16 w-16 items-center justify-center overflow-hidden rounded-full bg-blue-500 text-white shadow-lg transition-all duration-200 hover:bg-blue-600 hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed sm:h-20 sm:w-20"
                                            >
                                                <svg class="relative h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                                </svg>
                                            </button>
                                            
                                            <div class="text-center">
                                                <div class="font-mono text-6xl font-bold text-blue-600 tabular-nums dark:text-blue-400 sm:text-8xl">
                                                    {{ $player1Score }}
                                                </div>
                                                <div class="mt-2 text-sm font-medium text-blue-500/70 dark:text-blue-400/60">
                                                    CURRENT POINTS
                                                </div>
                                            </div>

                                            <button 
                                                wire:click="incrementScore(1)"
                                                wire:loading.attr="disabled"
                                                wire:target="incrementScore(1)"
                                                class="group relative inline-flex h-16 w-16 items-center justify-center overflow-hidden rounded-full bg-blue-500 text-white shadow-lg transition-all duration-200 hover:bg-blue-600 hover:shadow-xl disabled:opacity-50 sm:h-20 sm:w-20"
                                            >
                                                <svg class="relative h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                </svg>
                                            </button>
                                        </div>

                                        <!-- Declare Winner Button -->
                                        <button 
                                            wire:click="declareSetWinner({{ $match->player1->id }})"
                                            @if($currentSetCompleted || $matchWinner) disabled @endif
                                            class="w-full group relative inline-flex items-center justify-center overflow-hidden rounded-lg bg-blue-600 px-6 py-3 text-white transition-all duration-300 hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed"
                                        >
                                            <span class="absolute right-0 -mt-12 h-32 w-8 translate-x-12 rotate-12 transform bg-white opacity-10 transition-transform duration-1000 ease-out group-hover:-translate-x-40"></span>
                                            <span class="relative font-medium">Declare Set Winner</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- VS Section -->
                        <div class="lg:col-span-1 flex items-center justify-center">
                            <span class="text-3xl font-black text-gray-400">VS</span>
                        </div>

                        <!-- Player 2 Card -->
                        <div class="lg:col-span-3">
                            <div class="relative overflow-hidden rounded-2xl mr-8 border-2 border-red-500 bg-red-500/10 p-6 dark:bg-red-900/20">
                                <div class="relative">
                                    <div class="flex flex-col items-center space-y-6">
                                        <div class="text-center">
                                            <div class="text-2xl font-bold text-red-900 dark:text-red-100">
                                                {{ $match->player2?->name ?? 'Player 2'}}
                                            </div>
                                            <div class="mt-1 text-sm text-red-600 dark:text-red-400">
                                                Rank #{{ $match->player2?->ranking ?? 'N/A' }}
                                            </div>
                                        </div>
                                        
                                        <div class="flex items-center space-x-6">
                                            <button 
                                                wire:click="decrementScore(2)"
                                                wire:loading.attr="disabled"
                                                wire:target="decrementScore(2)"
                                                @if($matchWinner) disabled @endif
                                                class="group relative inline-flex h-16 w-16 items-center justify-center overflow-hidden rounded-full bg-red-500 text-white shadow-lg transition-all duration-200 hover:bg-red-600 hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed sm:h-20 sm:w-20"
                                            >
                                                <svg class="relative h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                                </svg>
                                            </button>
                                            
                                            <div class="text-center">
                                                <div class="font-mono text-6xl font-bold text-red-600 tabular-nums dark:text-red-400 sm:text-8xl">
                                                    {{ $player2Score }}
                                                </div>
                                                <div class="mt-2 text-sm font-medium text-red-500/70 dark:text-red-400/60">
                                                    CURRENT POINTS
                                                </div>
                                            </div>

                                            <button 
                                                wire:click="incrementScore(2)"
                                                wire:loading.attr="disabled"
                                                wire:target="incrementScore(2)"
                                                class="group relative inline-flex h-16 w-16 items-center justify-center overflow-hidden rounded-full bg-red-500 text-white shadow-lg transition-all duration-200 hover:bg-red-600 hover:shadow-xl disabled:opacity-50 sm:h-20 sm:w-20"
                                            >
                                                <svg class="relative h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                </svg>
                                            </button>
                                        </div>

                                        <!-- Declare Winner Button -->
                                        <button 
                                            wire:click="declareSetWinner({{ $match->player2->id }})"
                                            @if($currentSetCompleted || $matchWinner) disabled @endif
                                            class="w-full group relative inline-flex items-center justify-center overflow-hidden rounded-lg bg-red-600 px-6 py-3 text-white transition-all duration-300 hover:bg-red-700 disabled:opacity-50 disabled:cursor-not-allowed"
                                        >
                                            <span class="absolute right-0 -mt-12 h-32 w-8 translate-x-12 rotate-12 transform bg-white opacity-10 transition-transform duration-1000 ease-out group-hover:-translate-x-40"></span>
                                            <span class="relative font-medium">Declare Set Winner</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sets Section -->
                    <div class="mt-8 p-6 border-2 border-green-300 bg-green-50/50 dark:bg-green-900/20 rounded-xl border border-green-100 dark:border-green-800">
                        <div class="text-center mb-4">
                            <h3 class="text-lg font-semibold text-green-900 dark:text-green-100">
                                Current Set: {{ $currentSet }}
                            </h3>
                            <p class="text-sm text-green-600 dark:text-green-400">
                                Set Score: {{ $sets[$currentSet]['player1'] }} - {{ $sets[$currentSet]['player2'] }}
                            </p>
                        </div>
                        
                        <div class="grid grid-cols-3 gap-8">
                            <!-- Set 1 -->
                            <div class="text-center">
                                <div class="text-sm font-medium text-green-600 dark:text-green-400 mb-2">SET 1</div>
                                <div class="flex items-center justify-center space-x-4">
                                    <span class="text-2xl font-bold {{ $match->set1_winner === 1 ? 'text-primary dark:text-primary/90' : 'text-green-900 dark:text-green-100' }}">
                                        {{ $sets[1]['player1'] ?? '0' }}
                                    </span>
                                    <span class="text-xl text-green-400 dark:text-green-600">-</span>
                                    <span class="text-2xl font-bold {{ $match->set1_winner === 2 ? 'text-primary dark:text-primary/90' : 'text-green-900 dark:text-green-100' }}">
                                        {{ $sets[1]['player2'] ?? '0' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Set 2 -->
                            <div class="text-center">
                                <div class="text-sm font-medium text-green-600 dark:text-green-400 mb-2">SET 2</div>
                                <div class="flex items-center justify-center space-x-4">
                                    <span class="text-2xl font-bold {{ $match->set2_winner === 1 ? 'text-primary dark:text-primary/90' : 'text-green-900 dark:text-green-100' }}">
                                        {{ $sets[2]['player1'] ?? '0' }}
                                    </span>
                                    <span class="text-xl text-green-400 dark:text-green-600">-</span>
                                    <span class="text-2xl font-bold {{ $match->set2_winner === 2 ? 'text-primary dark:text-primary/90' : 'text-green-900 dark:text-green-100' }}">
                                        {{ $sets[2]['player2'] ?? '0' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Set 3 -->
                            <div class="text-center">
                                <div class="text-sm font-medium text-green-600 dark:text-green-400 mb-2">SET 3</div>
                                <div class="flex items-center justify-center space-x-4">
                                    <span class="text-2xl font-bold {{ $match->set3_winner === 1 ? 'text-primary dark:text-primary/90' : 'text-green-900 dark:text-green-100' }}">
                                        {{ $sets[3]['player1'] ?? '0' }}
                                    </span>
                                    <span class="text-xl text-green-400 dark:text-green-600">-</span>
                                    <span class="text-2xl font-bold {{ $match->set3_winner === 2 ? 'text-primary dark:text-primary/90' : 'text-green-900 dark:text-green-100' }}">
                                        {{ $sets[3]['player2'] ?? '0' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="border-t border-gray-200 p-6 dark:border-gray-700">
                    <div class="flex justify-end">
                        <button 
                            @click="showScoringModal = false"
                            class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700"
                        >
                            <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
</div>