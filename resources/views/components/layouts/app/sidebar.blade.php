<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-green-50 dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="border-r border-green-400/50 bg-green-300/90 dark:border-green-600/20 dark:bg-green-200/90">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="mr-5 flex items-center space-x-2" wire:navigate>
                <x-app-logo />
            </a>

            <flux:navlist variant="outline" class="text-green-900 dark:text-green-50">
                <x-navigation.main-nav />
            </flux:navlist>

            <flux:spacer />

            <!-- Desktop User Menu -->
            <flux:dropdown position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevrons-up-down"
                    class="bg-green-300/80 dark:bg-green-700/80 text-green-950 dark:text-green-50"
                />

                <flux:menu class="w-[220px] bg-green-200/95 dark:bg-green-800/95 border border-green-400/50 dark:border-green-700/50">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span class="flex h-full w-full items-center justify-center rounded-lg bg-green-300/80 dark:bg-green-700/80 text-green-950 dark:text-green-50">
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-left text-sm leading-tight">
                                    <span class="truncate font-semibold text-green-950 dark:text-green-50">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs text-green-800 dark:text-green-200">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator class="bg-green-400/30 dark:bg-green-600/30" />

                    <flux:menu.radio.group>
                        <flux:menu.item href="/settings/profile" icon="cog" wire:navigate 
                            class="text-green-900 dark:text-green-50 hover:bg-green-300/20 dark:hover:bg-green-700/20">
                            {{ __('Settings') }}
                        </flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator class="bg-green-400/30 dark:bg-green-600/30" />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" 
                            class="w-full text-green-900 dark:text-green-50 hover:bg-green-300/20 dark:hover:bg-green-700/20">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile Header -->
        <flux:header class="lg:hidden bg-green-300/90 dark:bg-green-800/90 border-b border-green-400/50 dark:border-green-600/20">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                    class="bg-green-300 dark:bg-green-800"
                />

                <!-- Mobile menu content with same styling as desktop -->
                <flux:menu class="bg-green-200 dark:bg-green-900">
                    <!-- ... rest of the mobile menu content with same classes as desktop ... -->
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts
    </body>
</html>
