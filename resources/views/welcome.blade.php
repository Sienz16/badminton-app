<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Badminton Tournament</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gradient-to-br from-[#FDFDFC] to-[#F8F8F7] dark:from-[#0a0a0a] dark:to-[#1a1a1a] text-[#1b1b18] min-h-screen">
        <!-- Hero Section -->
        <div class="relative overflow-hidden">
            <!-- Decorative background elements -->
            <div class="absolute inset-0 bg-gradient-to-r from-blue-500/10 to-purple-500/10 dark:from-blue-900/20 dark:to-purple-900/20"></div>
            <div class="absolute inset-y-0 right-0 hidden w-1/2 sm:block lg:w-1/3">
                <div class="absolute inset-0 bg-gradient-to-l from-blue-500/10 to-transparent"></div>
                <div class="absolute inset-0 bg-[url('/images/pattern.svg')] opacity-30 dark:opacity-20"></div>
            </div>
            
            <!-- Header -->
            <header class="relative z-10 border-b border-neutral-200/80 dark:border-neutral-800 backdrop-blur-sm bg-white/70 dark:bg-black/70">
                <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-20 items-center justify-between">
                        <div class="flex items-center">
                            <div class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                🏸 Badminton Tournament
                            </div>
                        </div>
                        <div class="flex items-center gap-6">
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="rounded-full px-6 py-2.5 font-semibold bg-gradient-to-r from-blue-600 to-purple-600 text-white hover:opacity-90 transition">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="font-semibold hover:text-blue-600 dark:text-neutral-400 dark:hover:text-white transition">Log in</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="rounded-full px-6 py-2.5 font-semibold bg-gradient-to-r from-blue-600 to-purple-600 text-white hover:opacity-90 transition">Register</a>
                                    @endif
                                @endauth
                            @endif
                        </div>
                    </div>
                </nav>
            </header>

            <!-- Hero Content -->
            <div class="relative">
                <div class="mx-auto max-w-7xl">
                    <div class="relative z-10 lg:w-2/3 lg:max-w-2xl px-4 sm:px-6 lg:px-8 pt-20 pb-16 lg:pt-32 lg:pb-28">
                        <div class="text-center lg:text-left">
                            <h1 class="text-4xl font-bold tracking-tight sm:text-6xl lg:text-7xl">
                                <span class="block text-neutral-900 dark:text-white">Experience the Thrill of</span>
                                <span class="block bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Professional Badminton</span>
                            </h1>
                            <p class="mt-6 text-lg leading-8 text-neutral-600 dark:text-neutral-400">
                                Join our premier badminton tournament platform where players compete, connect, and achieve excellence. Experience world-class matches, real-time scoring, and professional organization.
                            </p>
                            <div class="mt-10 flex items-center justify-center lg:justify-start gap-6">
                                <a href="{{ route('register') }}" class="rounded-full px-8 py-3 text-lg font-semibold bg-gradient-to-r from-blue-600 to-purple-600 text-white hover:opacity-90 transition">
                                    Join Tournament
                                </a>
                                <a href="#features" class="text-lg font-semibold text-neutral-900 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition">
                                    Learn More →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Section with Animation -->
            <div class="relative z-10 -mt-8 lg:-mt-16">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="mx-auto grid max-w-xl grid-cols-1 gap-6 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-4">
                        <div class="flex flex-col gap-3 rounded-3xl bg-white/50 dark:bg-neutral-900/50 backdrop-blur-sm border border-neutral-200/50 dark:border-neutral-800 p-8 hover:border-blue-500/50 transition duration-300">
                            <dt class="text-base leading-7 text-neutral-600 dark:text-neutral-400">Active Players</dt>
                            <dd class="text-4xl font-bold tracking-tight text-blue-600 dark:text-blue-400">1,200+</dd>
                        </div>
                        <div class="flex flex-col gap-3 rounded-3xl bg-white/50 dark:bg-neutral-900/50 backdrop-blur-sm border border-neutral-200/50 dark:border-neutral-800 p-8 hover:border-purple-500/50 transition duration-300">
                            <dt class="text-base leading-7 text-neutral-600 dark:text-neutral-400">Tournaments</dt>
                            <dd class="text-4xl font-bold tracking-tight text-purple-600 dark:text-purple-400">50+</dd>
                        </div>
                        <div class="flex flex-col gap-3 rounded-3xl bg-white/50 dark:bg-neutral-900/50 backdrop-blur-sm border border-neutral-200/50 dark:border-neutral-800 p-8 hover:border-indigo-500/50 transition duration-300">
                            <dt class="text-base leading-7 text-neutral-600 dark:text-neutral-400">Matches Played</dt>
                            <dd class="text-4xl font-bold tracking-tight text-indigo-600 dark:text-indigo-400">5,000+</dd>
                        </div>
                        <div class="flex flex-col gap-3 rounded-3xl bg-white/50 dark:bg-neutral-900/50 backdrop-blur-sm border border-neutral-200/50 dark:border-neutral-800 p-8 hover:border-pink-500/50 transition duration-300">
                            <dt class="text-base leading-7 text-neutral-600 dark:text-neutral-400">Prize Pool</dt>
                            <dd class="text-4xl font-bold tracking-tight text-pink-600 dark:text-pink-400">$50K</dd>
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

            <!-- Live Matches Section -->
            <section class="relative z-10 py-24">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <h2 class="text-3xl font-bold tracking-tight sm:text-4xl bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Live Matches</h2>
                        <p class="mt-4 text-lg text-neutral-600 dark:text-neutral-400">Watch exciting matches happening right now</p>
                    </div>

                    <div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($dummyLiveMatches as $match)
                            <div class="group relative rounded-3xl bg-white/50 dark:bg-neutral-900/50 backdrop-blur-sm border border-red-500/30 p-6 hover:border-red-500/50 transition duration-300">
                                <div class="absolute -top-3 right-4 inline-flex items-center rounded-full bg-red-50 dark:bg-red-900/20 px-3 py-1 text-xs font-semibold text-red-600 dark:text-red-400 ring-1 ring-inset ring-red-500/30">
                                    <span class="relative flex h-2 w-2 mr-2">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                                    </span>
                                    LIVE
                                </div>

                                <div class="mt-4">
                                    <h3 class="text-xl font-semibold text-neutral-900 dark:text-white">{{ $match['player1'] }} vs {{ $match['player2'] }}</h3>
                                    <div class="mt-2 flex flex-col gap-2">
                                        <div class="flex items-center text-neutral-600 dark:text-neutral-400">
                                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            {{ $match['venue'] }}
                                        </div>
                                        <div class="flex items-center text-neutral-600 dark:text-neutral-400">
                                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            {{ $match['duration'] }}
                                        </div>
                                        <div class="mt-2 text-lg font-semibold text-neutral-900 dark:text-white">
                                            Score: {{ $match['score'] }}
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <a href="#" class="inline-flex items-center text-sm font-semibold text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300">
                                        Watch Match
                                        <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- Features Section -->
            <section id="features" class="relative z-10 py-24 bg-neutral-50/50 dark:bg-neutral-900/50 backdrop-blur-sm">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <h2 class="text-3xl font-bold tracking-tight sm:text-4xl bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Why Choose Us</h2>
                        <p class="mt-4 text-lg text-neutral-600 dark:text-neutral-400">Everything you need to organize and participate in professional tournaments</p>
                    </div>

                    <div class="mt-16 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                        <!-- Feature 1 -->
                        <div class="flex flex-col gap-6 rounded-3xl bg-white/50 dark:bg-neutral-800/50 p-8 hover:bg-white/80 dark:hover:bg-neutral-800/80 transition duration-300">
                            <div class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-blue-500/10 text-blue-600 dark:bg-blue-400/10 dark:text-blue-400">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-neutral-900 dark:text-white">Professional Organization</h3>
                                <p class="mt-2 text-neutral-600 dark:text-neutral-400">Automated scheduling, real-time scoring, and professional tournament management.</p>
                            </div>
                        </div>

                        <!-- Feature 2 -->
                        <div class="flex flex-col gap-6 rounded-3xl bg-white/50 dark:bg-neutral-800/50 p-8 hover:bg-white/80 dark:hover:bg-neutral-800/80 transition duration-300">
                            <div class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-purple-500/10 text-purple-600 dark:bg-purple-400/10 dark:text-purple-400">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-neutral-900 dark:text-white">Player Community</h3>
                                <p class="mt-2 text-neutral-600 dark:text-neutral-400">Connect with fellow players, form teams, and participate in discussions.</p>
                            </div>
                        </div>

                        <!-- Feature 3 -->
                        <div class="flex flex-col gap-6 rounded-3xl bg-white/50 dark:bg-neutral-800/50 p-8 hover:bg-white/80 dark:hover:bg-neutral-800/80 transition duration-300">
                            <div class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-pink-500/10 text-pink-600 dark:bg-pink-400/10 dark:text-pink-400">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-neutral-900 dark:text-white">Statistics & Rankings</h3>
                                <p class="mt-2 text-neutral-600 dark:text-neutral-400">Detailed player statistics, rankings, and performance analytics.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Footer -->
            <footer class="relative z-10 border-t border-neutral-200/80 dark:border-neutral-800 backdrop-blur-sm bg-white/70 dark:bg-black/70">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
                    <div class="grid grid-cols-1 gap-8 lg:grid-cols-4">
                        <div class="lg:col-span-2">
                            <div class="flex flex-col gap-6">
                                <div class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent flex items-center gap-3">
                                    🏸 Badminton Tournament
                                </div>
                                <p class="text-neutral-600 dark:text-neutral-400 max-w-md">
                                    Join the excitement of competitive badminton. Experience thrilling matches, 
                                    meet fellow players, and be part of our growing community.
                                </p>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold uppercase tracking-wider text-neutral-900 dark:text-white">Quick Links</h3>
                            <ul class="mt-4 space-y-3">
                                <li><a href="#" class="text-neutral-600 hover:text-blue-600 dark:text-neutral-400 dark:hover:text-blue-400 transition">Tournaments</a></li>
                                <li><a href="#" class="text-neutral-600 hover:text-blue-600 dark:text-neutral-400 dark:hover:text-blue-400 transition">Rankings</a></li>
                                <li><a href="#" class="text-neutral-600 hover:text-blue-600 dark:text-neutral-400 dark:hover:text-blue-400 transition">Schedule</a></li>
                                <li><a href="#" class="text-neutral-600 hover:text-blue-600 dark:text-neutral-400 dark:hover:text-blue-400 transition">Rules</a></li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold uppercase tracking-wider text-neutral-900 dark:text-white">Contact</h3>
                            <ul class="mt-4 space-y-3">
                                <li class="flex items-center gap-2 text-neutral-600 dark:text-neutral-400">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    contact@badminton.com
                                </li>
                                <li class="flex items-center gap-2 text-neutral-600 dark:text-neutral-400">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    +1 (555) 123-4567
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-12 pt-8 border-t border-neutral-200/80 dark:border-neutral-800">
                        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                            <div class="text-sm text-neutral-600 dark:text-neutral-400">
                                © 2024 Badminton Tournament. All rights reserved.
                            </div>
                            <div class="flex gap-6 text-sm">
                                <a href="#" class="text-neutral-600 hover:text-blue-600 dark:text-neutral-400 dark:hover:text-blue-400 transition">Privacy Policy</a>
                                <a href="#" class="text-neutral-600 hover:text-blue-600 dark:text-neutral-400 dark:hover:text-blue-400 transition">Terms of Service</a>
                                <a href="#" class="text-neutral-600 hover:text-blue-600 dark:text-neutral-400 dark:hover:text-blue-400 transition">Cookie Policy</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
