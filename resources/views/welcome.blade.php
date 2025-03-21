<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Badminton Tournament</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600|poppins:300,400,500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script defer src="https://unpkg.com/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body 
        x-data="{ scrolled: false }" 
        x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50 })"
        class="bg-gradient-to-br from-[#f0fdf4] to-[#dcfce7] dark:from-[#052e16] dark:to-[#064e3b] text-[#1b1b18] min-h-screen selection:bg-green-500/30 selection:text-green-900 dark:selection:text-green-200"
    >
        <!-- Enhanced Header with distinct style -->
        <header 
            :class="{ 'bg-green-500/95 shadow-lg': scrolled, 'bg-green-500': !scrolled }"
            class="fixed w-full z-50 transition-all duration-300"
        >
            <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-20 items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex items-center space-x-3">
                            <span class="text-4xl">🏸</span>
                            <span class="text-2xl font-extrabold tracking-tight text-white font-['Poppins']">
                                Badminton<span class="text-emerald-300">App</span>
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" 
                                    class="relative inline-flex items-center justify-center overflow-hidden rounded-lg bg-white group px-6 py-2.5
                                    hover:scale-105 transition-all duration-300"
                                >
                                    <span class="relative text-emerald-700 font-semibold group-hover:text-emerald-800">
                                        {{ __('Dashboard') }}
                                    </span>
                                </a>
                            @else
                                <a href="{{ route('login') }}" 
                                    class="text-[#F4F7ED] hover:text-white px-4 py-2 rounded-lg transition-all duration-300
                                    hover:bg-emerald-600/20 font-medium"
                                >
                                    {{ __('Log in') }}
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" 
                                        class="relative inline-flex items-center justify-center overflow-hidden rounded-lg 
                                        bg-gradient-to-r from-emerald-500 to-teal-500 group p-0.5
                                        hover:scale-105 transition-all duration-300"
                                    >
                                        <span class="relative px-6 py-2.5 bg-white dark:bg-black rounded-md transition-all duration-300
                                            group-hover:bg-transparent group-hover:text-white font-semibold">
                                            {{ __('Register') }}
                                        </span>
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </nav>
        </header>

        <!-- Main Content with different background -->
        <main class="bg-gradient-to-br from-[#f0fdf4] to-[#dcfce7] dark:from-[#052e16] dark:to-[#064e3b] min-h-screen">
            <!-- Hero Section -->
            <div class="relative overflow-hidden">
                <!-- Enhanced background elements -->
                <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/10 via-emerald-500/10 to-teal-500/10 dark:from-emerald-900/20 dark:via-emerald-900/20 dark:to-teal-900/20 animate-gradient-x"></div>
                <div class="absolute inset-y-0 right-0 hidden w-1/2 sm:block lg:w-1/3">
                    <div class="absolute inset-0 bg-gradient-to-l from-emerald-500/10 to-transparent"></div>
                    <div class="absolute inset-0 opacity-30 dark:opacity-20 animate-pulse-slow">
                        <x-placeholder-pattern class="w-full h-full text-emerald-500/10" />
                    </div>
                </div>

                <!-- Enhanced Hero Content -->
                <div class="relative pt-32">
                    <div class="mx-auto max-w-7xl">
                        <div class="relative z-10 flex flex-col lg:flex-row items-center px-4 sm:px-6 lg:px-8 pt-20 pb-16 lg:pt-32 lg:pb-28">
                            <!-- Text Content -->
                            <div class="lg:w-1/2 lg:pr-8">
                                <div class="text-center lg:text-left">
                                    <h1 class="text-4xl font-bold tracking-tight sm:text-6xl lg:text-7xl font-['Poppins']">
                                        <span class="block text-neutral-900 dark:text-white mb-4">
                                            Experience the Thrill of
                                        </span>
                                        <span class="block bg-gradient-to-r from-emerald-600 via-emerald-500 to-teal-500 bg-clip-text text-transparent animate-gradient-x font-extrabold">
                                            Professional Badminton
                                        </span>
                                    </h1>
                                    <p class="mt-8 text-lg leading-relaxed text-neutral-600 dark:text-neutral-400 font-['Inter'] max-w-2xl">
                                        Join our premier badminton tournament platform where players compete, connect, and achieve excellence. Experience world-class matches, real-time scoring, and professional organization.
                                    </p>
                                    <div class="mt-10 flex items-center justify-center lg:justify-start gap-6">
                                        <a href="{{ route('register') }}" 
                                            class="group relative inline-flex items-center justify-center rounded-full bg-gradient-to-r from-emerald-600 via-emerald-500 to-teal-500 p-[2px] font-semibold hover:scale-105 transition-transform"
                                        >
                                            <span class="absolute inset-0 rounded-full bg-gradient-to-r from-emerald-600 via-emerald-500 to-teal-500 opacity-0 blur transition-opacity group-hover:opacity-50"></span>
                                            <span class="relative rounded-full bg-white dark:bg-black px-8 py-3.5 text-[15px] font-['Poppins'] text-neutral-900 dark:text-white group-hover:bg-transparent group-hover:text-white transition-colors">
                                                Join Tournament
                                            </span>
                                        </a>
                                        <a href="#features" class="group text-[15px] font-['Poppins'] font-semibold text-neutral-900 dark:text-white hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">
                                            Learn More 
                                            <span class="inline-block transition-transform group-hover:translate-x-1 ml-1">→</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Image Content -->
                            <div class="lg:w-1/2 mt-12 lg:mt-0">
                                <div class="relative">
                                    <!-- Decorative elements -->
                                    <div class="absolute -inset-4">
                                        <div class="w-full h-full mx-auto opacity-30 blur-lg filter">
                                            <div class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-teal-500 rounded-full"></div>
                                        </div>
                                    </div>

                                    <!-- Main image -->
                                    <div class="relative flex justify-center">
                                        <img
                                            src="/storage/images/hero-badminton.png"
                                            alt="Professional Badminton Player"
                                            class="w-3/4 h-auto transform hover:scale-105 transition-transform duration-500"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @php
                $dummyLiveMatches = [
                    [
                        'player1' => 'John Smith',
                        'player2' => 'Mike Johnson',
                        'venue' => 'Central Court',
                        'score' => '21-19, 16-21, 11-8',
                        'duration' => '45 minutes'
                    ],
                    [
                        'player1' => 'Sarah Williams',
                        'player2' => 'Emma Davis',
                        'venue' => 'Court 2',
                        'score' => '21-15, 19-21',
                        'duration' => '35 minutes'
                    ],
                    [
                        'player1' => 'David Brown',
                        'player2' => 'James Wilson',
                        'venue' => 'Court 3',
                        'score' => '21-18, 18-21, 15-13',
                        'duration' => '52 minutes'
                    ]
                ];
                @endphp

                <!-- Features Section -->
                <section id="features" class="relative z-10 py-32 bg-gradient-to-b from-emerald-50 to-white dark:from-emerald-950 dark:to-gray-900">
                    <!-- Decorative background elements -->
                    <div class="absolute inset-0">
                        <div class="absolute inset-0 bg-[linear-gradient(30deg,#10B98130_12%,transparent_12.5%,transparent_87%,#10B98130_87.5%,#10B98130_100%)] opacity-20 dark:opacity-10"></div>
                        <div class="absolute inset-0 bg-[linear-gradient(150deg,#10B98130_12%,transparent_12.5%,transparent_87%,#10B98130_87.5%,#10B98130_100%)] opacity-20 dark:opacity-10"></div>
                    </div>

                    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <!-- Section Header -->
                        <div class="flex flex-col items-center text-center max-w-3xl mx-auto space-y-4">
                            <!-- Eyebrow text with decorative line -->
                            <div class="flex items-center space-x-4">
                                <div class="h-px w-8 bg-emerald-600 dark:bg-emerald-400"></div>
                                <h2 class="text-sm font-semibold leading-7 text-emerald-600 dark:text-emerald-400 uppercase tracking-wider">
                                    Why Choose Us
                                </h2>
                                <div class="h-px w-8 bg-emerald-600 dark:bg-emerald-400"></div>
                            </div>
                            
                            <!-- Main heading with gradient text -->
                            <div class="relative">
                                <h3 class="text-4xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-5xl font-['Poppins']">
                                    Everything you need for
                                </h3>
                                <p class="mt-2 text-4xl font-bold tracking-tight sm:text-5xl font-['Poppins'] bg-gradient-to-r from-emerald-600 via-emerald-500 to-teal-500 bg-clip-text text-transparent">
                                    Professional Tournaments
                                </p>
                            </div>

                            <!-- Description text -->
                            <p class="mt-4 text-lg leading-8 text-gray-600 dark:text-gray-300 max-w-2xl">
                                Experience world-class tournament management with our comprehensive suite of features designed to elevate your badminton competitions to the next level.
                            </p>

                            <!-- Decorative separator -->
                            <div class="w-24 h-1.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full mt-8"></div>
                        </div>

                        <div class="mt-16 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                            <!-- Feature 1: Professional Organization -->
                            <div class="group relative overflow-hidden rounded-3xl bg-white dark:bg-gray-800/50 shadow-xl dark:shadow-gray-800/20 hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                                <div class="p-8">
                                    <div class="flex items-center gap-4">
                                        <div class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-emerald-500 to-teal-500 text-white shadow-lg">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Professional Organization</h3>
                                    </div>
                                    <p class="mt-4 text-gray-600 dark:text-gray-300 leading-relaxed">
                                        Automated scheduling, real-time scoring, and professional tournament management tools at your fingertips.
                                    </p>
                                    <div class="mt-6">
                                        <a href="#" class="inline-flex items-center text-emerald-600 dark:text-emerald-400 font-medium">
                                            Learn more
                                            <svg class="ml-2 h-5 w-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Feature 2: Player Community -->
                            <div class="group relative overflow-hidden rounded-3xl bg-white dark:bg-gray-800/50 shadow-xl dark:shadow-gray-800/20 hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                                <div class="p-8">
                                    <div class="flex items-center gap-4">
                                        <div class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-purple-500 to-indigo-500 text-white shadow-lg">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                            </svg>
                                        </div>
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Player Community</h3>
                                    </div>
                                    <p class="mt-4 text-gray-600 dark:text-gray-300 leading-relaxed">
                                        Connect with fellow players, form teams, and participate in discussions within our vibrant community.
                                    </p>
                                    <div class="mt-6">
                                        <a href="#" class="inline-flex items-center text-purple-600 dark:text-purple-400 font-medium">
                                            Learn more
                                            <svg class="ml-2 h-5 w-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Feature 3: Real-time Analytics -->
                            <div class="group relative overflow-hidden rounded-3xl bg-white dark:bg-gray-800/50 shadow-xl dark:shadow-gray-800/20 hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                                <div class="p-8">
                                    <div class="flex items-center gap-4">
                                        <div class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-pink-500 to-rose-500 text-white shadow-lg">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                            </svg>
                                        </div>
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Real-time Analytics</h3>
                                    </div>
                                    <p class="mt-4 text-gray-600 dark:text-gray-300 leading-relaxed">
                                        Track performance metrics, match statistics, and player rankings with detailed analytics.
                                    </p>
                                    <div class="mt-6">
                                        <a href="#" class="inline-flex items-center text-pink-600 dark:text-pink-400 font-medium">
                                            Learn more
                                            <svg class="ml-2 h-5 w-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bottom CTA -->
                        <div class="mt-16 text-center">
                            <a href="#" class="inline-flex items-center justify-center px-8 py-3 text-base font-medium text-white bg-gradient-to-r from-emerald-600 to-teal-500 rounded-full hover:from-emerald-700 hover:to-teal-600 transition-all duration-300 shadow-lg hover:shadow-xl">
                                Explore All Features
                                <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </section>

                <!-- Top Players Section -->
                @php
                // Get top ranked players based on win rate
                $topPlayers = App\Models\Player::with('user')
                    ->where('matches_played', '>', 0) // Only include players who have played matches
                    ->select('*')
                    ->selectRaw('(CAST(matches_won AS FLOAT) / matches_played * 100) as win_rate')
                    ->orderByDesc('win_rate')
                    ->orderByDesc('matches_played') // Secondary sort by matches played
                    ->limit(5) // Get top 5 players
                    ->get()
                    ->map(function($player) {
                        return [
                            'name' => $player->user->name,
                            'matches_played' => $player->matches_played,
                            'matches_won' => $player->matches_won,
                            'win_rate' => number_format(($player->matches_won / $player->matches_played * 100), 1)
                        ];
                    });

                // For debugging
                // dd($topPlayers);
                @endphp

                <section id="top-players" class="py-16">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <!-- Section Header -->
                        <div class="text-center max-w-3xl mx-auto mb-16">
                            <div class="flex items-center justify-center space-x-4">
                                <div class="h-px w-8 bg-emerald-600 dark:bg-emerald-400"></div>
                                <h2 class="text-sm font-semibold leading-7 text-emerald-600 dark:text-emerald-400 uppercase tracking-wider">
                                    Rankings
                                </h2>
                                <div class="h-px w-8 bg-emerald-600 dark:bg-emerald-400"></div>
                            </div>
                            <p class="mt-2 text-3xl font-bold tracking-tight text-neutral-900 dark:text-white sm:text-4xl">
                                Top Ranked Players
                            </p>
                            <p class="mt-4 text-lg leading-8 text-neutral-600 dark:text-neutral-400">
                                Our highest performing players based on win rate and match participation
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @php
                                // Define rank colors
                                $rankColors = [
                                    0 => 'bg-yellow-500', // Gold for 1st
                                    1 => 'bg-neutral-400', // Silver for 2nd
                                    2 => 'bg-amber-600', // Bronze for 3rd
                                    3 => 'bg-emerald-500', // Green for 4th
                                    4 => 'bg-blue-500', // Blue for 5th
                                ];
                            @endphp

                            @forelse($topPlayers as $index => $player)
                                <div class="bg-white dark:bg-neutral-800 rounded-xl shadow-lg p-6 transform hover:scale-105 transition-transform duration-300">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <div class="w-14 h-14 rounded-full {{ $rankColors[$index] ?? 'bg-emerald-500' }} flex items-center justify-center shadow-lg">
                                                <span class="text-2xl font-bold text-white">#{{ $index + 1 }}</span>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xl font-semibold text-neutral-900 dark:text-white truncate">
                                                {{ $player['name'] }}
                                            </p>
                                            <div class="flex flex-col mt-2 gap-1">
                                                <div class="flex items-center">
                                                    <span class="text-lg text-emerald-500 dark:text-emerald-400 font-bold">
                                                        {{ $player['win_rate'] }}% Win Rate
                                                    </span>
                                                </div>
                                                <span class="text-sm text-neutral-600 dark:text-neutral-400">
                                                    Won {{ $player['matches_won'] }} of {{ $player['matches_played'] }} matches
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-full text-center text-neutral-600 dark:text-neutral-400">
                                    No ranked players yet.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </section>

                <!-- Matches Section -->
                <livewire:welcome.matches-section />

                <!-- Footer -->
                <footer class="relative z-10 border-t border-neutral-200/80 dark:border-neutral-800 backdrop-blur-sm bg-white/70 dark:bg-black/70">
                    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16">
                        <!-- Main Footer Content -->
                        <div class="grid grid-cols-1 gap-12 lg:grid-cols-4">
                            <!-- Brand Section -->
                            <div class="lg:col-span-2">
                                <div class="flex flex-col gap-6">
                                    <div class="flex items-center space-x-3">
                                        <span class="text-4xl">🏸</span>
                                        <span class="text-2xl font-extrabold tracking-tight bg-gradient-to-r from-emerald-600 to-teal-500 bg-clip-text text-transparent font-['Poppins']">
                                            Badminton<span class="text-emerald-400">App</span>
                                        </span>
                                    </div>
                                    <p class="text-neutral-600 dark:text-neutral-400 max-w-md">
                                        Join our thriving badminton community and experience professional tournament management, real-time scoring, and seamless player connections.
                                    </p>
                                    <div class="flex space-x-4">
                                        <a href="#" class="text-neutral-600 hover:text-emerald-500 dark:text-neutral-400 dark:hover:text-emerald-400 transition-colors">
                                            <span class="sr-only">Twitter</span>
                                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/></svg>
                                        </a>
                                        <a href="#" class="text-neutral-600 hover:text-emerald-500 dark:text-neutral-400 dark:hover:text-emerald-400 transition-colors">
                                            <span class="sr-only">GitHub</span>
                                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"/></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Links -->
                            <div>
                                <h3 class="text-sm font-semibold text-neutral-900 dark:text-white uppercase tracking-wider">Quick Links</h3>
                                <ul class="mt-4 space-y-3">
                                    <li><a href="#features" class="text-neutral-600 hover:text-emerald-500 dark:text-neutral-400 dark:hover:text-emerald-400 transition-colors">Features</a></li>
                                    <li><a href="#tournaments" class="text-neutral-600 hover:text-emerald-500 dark:text-neutral-400 dark:hover:text-emerald-400 transition-colors">Tournaments</a></li>
                                    <li><a href="#stats" class="text-neutral-600 hover:text-emerald-500 dark:text-neutral-400 dark:hover:text-emerald-400 transition-colors">Statistics</a></li>
                                    <li><a href="#about" class="text-neutral-600 hover:text-emerald-500 dark:text-neutral-400 dark:hover:text-emerald-400 transition-colors">About Us</a></li>
                                </ul>
                            </div>

                            <!-- Contact Info -->
                            <div>
                                <h3 class="text-sm font-semibold text-neutral-900 dark:text-white uppercase tracking-wider">Contact</h3>
                                <ul class="mt-4 space-y-3">
                                    <li class="flex items-center text-neutral-600 dark:text-neutral-400">
                                        <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                        contact@badmintonapp.com
                                    </li>
                                    <li class="flex items-center text-neutral-600 dark:text-neutral-400">
                                        <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                        +1 (555) 123-4567
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Bottom Bar -->
                        <div class="mt-12 pt-8 border-t border-neutral-200/80 dark:border-neutral-800">
                            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                                <div class="text-sm text-neutral-600 dark:text-neutral-400">
                                    © {{ date('Y') }} BadmintonApp. All rights reserved.
                                </div>
                                <div class="flex space-x-6">
                                    <a href="#" class="text-sm text-neutral-600 hover:text-emerald-500 dark:text-neutral-400 dark:hover:text-emerald-400 transition-colors">Privacy Policy</a>
                                    <a href="#" class="text-sm text-neutral-600 hover:text-emerald-500 dark:text-neutral-400 dark:hover:text-emerald-400 transition-colors">Terms of Service</a>
                                    <a href="#" class="text-sm text-neutral-600 hover:text-emerald-500 dark:text-neutral-400 dark:hover:text-emerald-400 transition-colors">Cookie Policy</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <style>
                @keyframes gradient-x {
                    0% { background-position: 0% 50%; }
                    50% { background-position: 100% 50%; }
                    100% { background-position: 0% 50%; }
                }
                .animate-gradient-x {
                    background-size: 200% 200%;
                    animation: gradient-x 15s ease infinite;
                }
                .animate-pulse-slow {
                    animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
                }
                .fade-in-up {
                    opacity: 1 !important;
                    transform: translateY(0) !important;
                }
            </style>
        </body>
    </html>
