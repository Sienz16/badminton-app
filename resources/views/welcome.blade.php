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
        <!-- Hero Section with Gradient Overlay -->
        <div class="relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-500/10 to-purple-500/10 dark:from-blue-900/20 dark:to-purple-900/20"></div>
            
            <!-- Header -->
            <header class="relative z-10 border-b border-neutral-200/80 dark:border-neutral-800 backdrop-blur-sm bg-white/70 dark:bg-black/70">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
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
                </div>
            </header>

            <!-- Main Content -->
            <main class="relative z-10 py-16">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <!-- Stats Overview -->
                    <div class="grid grid-cols-3 gap-8 mb-16">
                        <div class="flex flex-col items-center p-8 rounded-2xl bg-white/50 dark:bg-neutral-900/50 backdrop-blur-sm border border-neutral-200/50 dark:border-neutral-800">
                            <div class="text-4xl font-bold text-blue-600 dark:text-blue-400">24</div>
                            <div class="mt-2 text-neutral-600 dark:text-neutral-400">Active Players</div>
                        </div>
                        <div class="flex flex-col items-center p-8 rounded-2xl bg-white/50 dark:bg-neutral-900/50 backdrop-blur-sm border border-neutral-200/50 dark:border-neutral-800">
                            <div class="text-4xl font-bold text-purple-600 dark:text-purple-400">12</div>
                            <div class="mt-2 text-neutral-600 dark:text-neutral-400">Ongoing Tournaments</div>
                        </div>
                        <div class="flex flex-col items-center p-8 rounded-2xl bg-white/50 dark:bg-neutral-900/50 backdrop-blur-sm border border-neutral-200/50 dark:border-neutral-800">
                            <div class="text-4xl font-bold text-indigo-600 dark:text-indigo-400">156</div>
                            <div class="mt-2 text-neutral-600 dark:text-neutral-400">Matches Played</div>
                        </div>
                    </div>

                    <!-- Upcoming Matches -->
                    <section class="mb-16">
                        <h2 class="text-3xl font-bold mb-8 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Upcoming Matches</h2>
                        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                            @php
                                $upcomingMatches = [
                                    [
                                        'date' => '2024-03-25 14:00',
                                        'player1' => 'John Doe',
                                        'player2' => 'Jane Smith',
                                        'venue' => 'Court A',
                                    ],
                                    [
                                        'date' => '2024-03-26 15:30',
                                        'player1' => 'Mike Johnson',
                                        'player2' => 'Sarah Williams',
                                        'venue' => 'Court B',
                                    ],
                                    [
                                        'date' => '2024-03-27 16:00',
                                        'player1' => 'Tom Brown',
                                        'player2' => 'Lisa Davis',
                                        'venue' => 'Court C',
                                    ],
                                ];
                            @endphp

                            @foreach($upcomingMatches as $match)
                                <div class="group rounded-2xl border border-neutral-200/50 dark:border-neutral-800 p-6 bg-white/50 dark:bg-neutral-900/50 backdrop-blur-sm hover:border-blue-500/50 transition">
                                    <div class="text-sm text-neutral-500 dark:text-neutral-400">{{ \Carbon\Carbon::parse($match['date'])->format('M d, Y - H:i') }}</div>
                                    <div class="mt-3 font-semibold text-lg dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">{{ $match['player1'] }} vs {{ $match['player2'] }}</div>
                                    <div class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        {{ $match['venue'] }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>

                    <!-- Live Matches -->
                    <section class="mb-16">
                        <h2 class="text-3xl font-bold mb-8 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Live Matches</h2>
                        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                            @php
                                $liveMatches = [
                                    [
                                        'player1' => 'Alex Turner',
                                        'player2' => 'Chris Martin',
                                        'score' => '21-19, 16-21, 11-8',
                                        'venue' => 'Court D',
                                    ],
                                ];
                            @endphp

                            @foreach($liveMatches as $match)
                                <div class="rounded-2xl border border-red-500/30 p-6 bg-white/50 dark:bg-neutral-900/50 backdrop-blur-sm">
                                    <div class="inline-flex items-center gap-2">
                                        <span class="relative flex h-3 w-3">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                                        </span>
                                        <span class="text-sm font-medium text-red-500">LIVE NOW</span>
                                    </div>
                                    <div class="mt-3 font-semibold text-lg dark:text-white">{{ $match['player1'] }} vs {{ $match['player2'] }}</div>
                                    <div class="mt-2 text-lg font-medium text-blue-600 dark:text-blue-400">{{ $match['score'] }}</div>
                                    <div class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        {{ $match['venue'] }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>

                    <!-- Recent Results -->
                    <section>
                        <h2 class="text-3xl font-bold mb-8 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Recent Results</h2>
                        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                            @php
                                $pastMatches = [
                                    [
                                        'date' => '2024-03-20 15:00',
                                        'player1' => 'David Wilson',
                                        'player2' => 'Emma Thompson',
                                        'score' => '21-18, 21-15',
                                        'venue' => 'Court A',
                                    ],
                                    [
                                        'date' => '2024-03-19 16:30',
                                        'player1' => 'Peter Parker',
                                        'player2' => 'Mary Jane',
                                        'score' => '21-19, 19-21, 21-18',
                                        'venue' => 'Court B',
                                    ],
                                    [
                                        'date' => '2024-03-18 14:00',
                                        'player1' => 'Bruce Wayne',
                                        'player2' => 'Clark Kent',
                                        'score' => '21-15, 21-17',
                                        'venue' => 'Court C',
                                    ],
                                ];
                            @endphp

                            @foreach($pastMatches as $match)
                                <div class="rounded-2xl border border-neutral-200/50 dark:border-neutral-800 p-6 bg-white/50 dark:bg-neutral-900/50 backdrop-blur-sm">
                                    <div class="text-sm text-neutral-500 dark:text-neutral-400">{{ \Carbon\Carbon::parse($match['date'])->format('M d, Y - H:i') }}</div>
                                    <div class="mt-3 font-semibold text-lg dark:text-white">{{ $match['player1'] }} vs {{ $match['player2'] }}</div>
                                    <div class="mt-2 text-lg font-medium text-purple-600 dark:text-purple-400">{{ $match['score'] }}</div>
                                    <div class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        {{ $match['venue'] }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                </div>
            </main>

            <!-- Footer -->
            <footer class="relative z-10 border-t border-neutral-200/80 dark:border-neutral-800 mt-12 backdrop-blur-sm bg-white/70 dark:bg-black/70">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="py-16">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                            <!-- Brand Section -->
                            <div class="col-span-1 md:col-span-2">
                                <div class="flex flex-col gap-6">
                                    <div class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent flex items-center gap-3">
                                        🏸 Badminton Tournament
                                    </div>
                                    <p class="text-neutral-600 dark:text-neutral-400 max-w-md">
                                        Join the excitement of competitive badminton. Experience thrilling matches, 
                                        meet fellow players, and be part of our growing community.
                                    </p>
                                    <div class="flex gap-4">
                                        <a href="#" class="text-neutral-600 hover:text-blue-600 dark:text-neutral-400 dark:hover:text-blue-400 transition">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                                            </svg>
                                        </a>
                                        <a href="#" class="text-neutral-600 hover:text-blue-600 dark:text-neutral-400 dark:hover:text-blue-400 transition">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path>
                                            </svg>
                                        </a>
                                        <a href="#" class="text-neutral-600 hover:text-blue-600 dark:text-neutral-400 dark:hover:text-blue-400 transition">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Links -->
                            <div class="col-span-1">
                                <h3 class="text-sm font-semibold text-neutral-900 dark:text-white uppercase tracking-wider mb-4">Quick Links</h3>
                                <ul class="space-y-3">
                                    <li>
                                        <a href="#" class="text-neutral-600 hover:text-blue-600 dark:text-neutral-400 dark:hover:text-blue-400 transition">Tournaments</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-neutral-600 hover:text-blue-600 dark:text-neutral-400 dark:hover:text-blue-400 transition">Rankings</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-neutral-600 hover:text-blue-600 dark:text-neutral-400 dark:hover:text-blue-400 transition">Schedule</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-neutral-600 hover:text-blue-600 dark:text-neutral-400 dark:hover:text-blue-400 transition">Rules</a>
                                    </li>
                                </ul>
                            </div>

                            <!-- Contact -->
                            <div class="col-span-1">
                                <h3 class="text-sm font-semibold text-neutral-900 dark:text-white uppercase tracking-wider mb-4">Contact</h3>
                                <ul class="space-y-3">
                                    <li class="flex items-center gap-2 text-neutral-600 dark:text-neutral-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                        contact@badminton.com
                                    </li>
                                    <li class="flex items-center gap-2 text-neutral-600 dark:text-neutral-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                        +1 (555) 123-4567
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Copyright -->
                        <div class="pt-8 mt-12 border-t border-neutral-200/80 dark:border-neutral-800">
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
                </div>
            </footer>
        </div>
    </body>
</html>
                           



