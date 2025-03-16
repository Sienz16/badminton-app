<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-green-50 dark:bg-grey-800">
        <flux:header container class="border-b border-green-400/50 bg-green-300/90 dark:border-green-800 dark:bg-green-200/90">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <a href="{{ route('dashboard') }}" class="ml-2 mr-5 flex items-center space-x-2 lg:ml-0" wire:navigate>
                <x-app-logo />
            </a>

            <flux:navbar class="-mb-px max-lg:hidden">
                <x-navigation.main-nav />
            </flux:navbar>

            <flux:spacer />

            <flux:navbar class="mr-1.5 space-x-0.5 py-0!">
                <flux:tooltip :content="__('Search')" position="bottom">
                    <flux:navbar.item 
                        class="!h-10 [&>div>svg]:size-5 text-green-900 dark:text-green-100 hover:bg-green-300/80 dark:hover:bg-green-800" 
                        icon="magnifying-glass" 
                        href="#" 
                        :label="__('Search')" 
                    />
                </flux:tooltip>
            </flux:navbar>

            <!-- Desktop User Menu -->
            <flux:dropdown position="top" align="end">
                <flux:profile
                    class="cursor-pointer bg-green-400/80 dark:bg-green-400 text-green-950 dark:text-green-50"
                    :initials="auth()->user()->initials()"
                />

                <flux:menu class="bg-green-200/95 dark:bg-green-900/95 border border-green-400/50 dark:border-green-800">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-green-300/80 dark:bg-green-800 text-green-950 dark:text-green-50"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-left text-sm leading-tight">
                                    <span class="truncate font-semibold text-green-900 dark:text-green-50">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs text-green-700 dark:text-green-300">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator class="bg-green-400/50 dark:bg-green-800" />

                    <flux:menu.radio.group>
                        <flux:menu.item 
                            href="/settings/profile" 
                            icon="cog" 
                            wire:navigate
                            class="text-green-900 dark:text-green-100 hover:bg-green-300/80 dark:hover:bg-green-800"
                        >
                            {{ __('Settings') }}
                        </flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator class="bg-green-400/50 dark:bg-green-800" />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item 
                            as="button" 
                            type="submit" 
                            icon="arrow-right-start-on-rectangle" 
                            class="w-full text-green-900 dark:text-green-100 hover:bg-green-300/80 dark:hover:bg-green-800"
                        >
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        <!-- Mobile Menu -->
        <flux:sidebar stashable sticky class="lg:hidden border-r border-green-400/50 bg-green-300/90 dark:border-green-800 dark:bg-green-200/90">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="ml-1 flex items-center space-x-2" wire:navigate>
                <x-app-logo />
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Platform')" class="text-green-900 dark:text-green-50">
                    <flux:navlist.item 
                        icon="layout-grid" 
                        :href="route('dashboard')" 
                        :current="request()->routeIs('dashboard')" 
                        wire:navigate
                        class="text-green-900 dark:text-green-100 hover:bg-green-300/80 dark:hover:bg-green-800"
                    >
                        {{ __('Dashboard') }}
                    </flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>

            <flux:spacer />

            <flux:navlist variant="outline">
                <flux:navlist.item 
                    icon="folder-git-2" 
                    href="https://github.com/laravel/livewire-starter-kit" 
                    target="_blank"
                    class="text-green-900 dark:text-green-100 hover:bg-green-300/80 dark:hover:bg-green-800"
                >
                    {{ __('Repository') }}
                </flux:navlist.item>

                <flux:navlist.item 
                    icon="book-open-text" 
                    href="https://laravel.com/docs/starter-kits" 
                    target="_blank"
                    class="text-green-900 dark:text-green-100 hover:bg-green-300/80 dark:hover:bg-green-800"
                >
                    {{ __('Documentation') }}
                </flux:navlist.item>
            </flux:navlist>
        </flux:sidebar>

        {{ $slot }}

        @fluxScripts
    </body>
</html>
