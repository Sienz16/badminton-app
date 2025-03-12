<div>
    @if(app()->environment('local'))
    <div class="p-4 mb-4 bg-gray-100 rounded">
        <pre class="text-xs">
            Player 1 Data: {{ print_r($match->player1?->toArray(), true) }}
            Player 1 Details: {{ print_r($match->player1?->player?->toArray(), true) }}
        </pre>
    </div>
@endif
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.tournaments') }}" wire:navigate 
                   class="group flex items-center gap-1 rounded-full bg-white px-4 py-2 text-sm font-medium text-zinc-500 shadow-sm transition hover:bg-zinc-50 dark:bg-zinc-800 dark:text-zinc-400 dark:hover:bg-zinc-700">
                    <svg class="h-5 w-5 transition-transform group-hover:-translate-x-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    Back to tournaments
                </a>
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
                        <div class="overflow-hidden rounded-xl bg-white shadow-lg dark:bg-zinc-800">
                            <!-- Player Image -->
                            <div class="aspect-[4/3] w-full bg-zinc-100 dark:bg-zinc-700">
                                @if($match->player1?->profile_photo)
                                    <img src="{{ Storage::url($match->player1->profile_photo) }}" 
                                         class="h-full w-full object-cover"
                                         alt="{{ $match->player1?->name }}">
                                @else
                                    <div class="flex h-full items-center justify-center">
                                        <svg class="h-24 w-24 text-zinc-300 dark:text-zinc-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <!-- Player Info -->
                            <div class="p-4">
                                <h3 class="text-xl font-bold text-zinc-900 dark:text-white text-center">
                                    {{ $match->player1?->name ?? 'Player 1' }}
                                </h3>
                                <p class="text-sm text-zinc-500 dark:text-zinc-400 text-center mb-4">
                                    Ranking: #{{ $match->player1?->player?->ranking ?? 'N/A' }}
                                </p>

                                <!-- Stats Grid -->
                                <div class="grid grid-cols-2 gap-3 text-sm">
                                    <div class="space-y-1">
                                        <p class="text-zinc-500 dark:text-zinc-400">Age</p>
                                        <p class="font-medium text-zinc-900 dark:text-white">
                                            {{ $match->player1?->player?->age ?? 'N/A' }}
                                        </p>
                                    </div>
                                    <div class="space-y-1">
                                        <p class="text-zinc-500 dark:text-zinc-400">Hand</p>
                                        <p class="font-medium text-zinc-900 dark:text-white">
                                            {{ $match->player1?->player?->playing_hand ?? 'N/A' }}
                                        </p>
                                    </div>
                                    <div class="space-y-1">
                                        <p class="text-zinc-500 dark:text-zinc-400">Matches</p>
                                        <p class="font-medium text-zinc-900 dark:text-white">
                                            {{ $match->player1?->player?->matches_played ?? '0' }}
                                        </p>
                                    </div>
                                    <div class="space-y-1">
                                        <p class="text-zinc-500 dark:text-zinc-400">Win Rate</p>
                                        <p class="font-medium text-zinc-900 dark:text-white">
                                            @if($match->player1?->player?->matches_played > 0)
                                                {{ number_format(($match->player1->player->matches_won / $match->player1->player->matches_played) * 100, 1) }}%
                                            @else
                                                N/A
                                            @endif
                                        </p>
                                    </div>
                                </div>
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
                        <div class="overflow-hidden rounded-xl bg-white shadow-lg dark:bg-zinc-800">
                            <!-- Player Image -->
                            <div class="aspect-[4/3] w-full bg-zinc-100 dark:bg-zinc-700">
                                @if($match->player2?->profile_photo)
                                    <img src="{{ Storage::url($match->player2->profile_photo) }}" 
                                         class="h-full w-full object-cover"
                                         alt="{{ $match->player2?->name }}">
                                @else
                                    <div class="flex h-full items-center justify-center">
                                        <svg class="h-24 w-24 text-zinc-300 dark:text-zinc-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <!-- Player Info -->
                            <div class="p-4">
                                <h3 class="text-xl font-bold text-zinc-900 dark:text-white text-center">
                                    {{ $match->player2?->name ?? 'Player 2' }}
                                </h3>
                                <p class="text-sm text-zinc-500 dark:text-zinc-400 text-center mb-4">
                                    Ranking: #{{ $match->player2?->player?->ranking ?? 'N/A' }}
                                </p>

                                <!-- Stats Grid -->
                                <div class="grid grid-cols-2 gap-3 text-sm">
                                    <div class="space-y-1">
                                        <p class="text-zinc-500 dark:text-zinc-400">Age</p>
                                        <p class="font-medium text-zinc-900 dark:text-white">
                                            {{ $match->player2?->player?->age ?? 'N/A' }}
                                        </p>
                                    </div>
                                    <div class="space-y-1">
                                        <p class="text-zinc-500 dark:text-zinc-400">Hand</p>
                                        <p class="font-medium text-zinc-900 dark:text-white">
                                            {{ $match->player2?->player?->playing_hand ?? 'N/A' }}
                                        </p>
                                    </div>
                                    <div class="space-y-1">
                                        <p class="text-zinc-500 dark:text-zinc-400">Matches</p>
                                        <p class="font-medium text-zinc-900 dark:text-white">
                                            {{ $match->player2?->player?->matches_played ?? '0' }}
                                        </p>
                                    </div>
                                    <div class="space-y-1">
                                        <p class="text-zinc-500 dark:text-zinc-400">Win Rate</p>
                                        <p class="font-medium text-zinc-900 dark:text-white">
                                            @if($match->player2?->player?->matches_played > 0)
                                                {{ number_format(($match->player2->player->matches_won / $match->player2->player->matches_played) * 100, 1) }}%
                                            @else
                                                N/A
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Match Details Card -->
            <div class="rounded-xl bg-white p-6 shadow-lg dark:bg-zinc-800">
                <h2 class="mb-6 text-xl font-semibold text-zinc-900 dark:text-white">Match Information</h2>
                <div class="space-y-6">
                    <!-- Venue -->
                    <div class="flex items-start gap-3">
                        <div class="rounded-lg bg-blue-100 p-2 dark:bg-blue-900">
                            <svg class="h-5 w-5 text-blue-600 dark:text-blue-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Venue</p>
                            <p class="mt-1 font-medium text-zinc-900 dark:text-white">
                                {{ $match->venue?->name ?? 'Not assigned' }}
                            </p>
                        </div>
                    </div>

                    <!-- Umpire -->
                    <div class="flex items-start gap-3">
                        <div class="rounded-lg bg-indigo-100 p-2 dark:bg-indigo-900">
                            <svg class="h-5 w-5 text-indigo-600 dark:text-indigo-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Umpire</p>
                            <p class="mt-1 font-medium text-zinc-900 dark:text-white">
                                {{ $match->umpire?->name ?? 'Not assigned' }}
                            </p>
                        </div>
                    </div>

                    <!-- Schedule -->
                    <div class="flex items-start gap-3">
                        <div class="rounded-lg bg-green-100 p-2 dark:bg-green-900">
                            <svg class="h-5 w-5 text-green-600 dark:text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Scheduled For</p>
                            <p class="mt-1 font-medium text-zinc-900 dark:text-white">
                                {{ $match->scheduled_at ? $match->scheduled_at->format('M d, Y h:i A') : 'Not scheduled' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
