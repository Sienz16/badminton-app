<flux:navbar class="space-x-1">
    <flux:navbar.item 
        :href="route('umpire.dashboard')" 
        :current="request()->routeIs('umpire.dashboard')"
        wire:navigate
        class="text-zinc-800 dark:text-zinc-100 
               hover:bg-green-200 dark:hover:bg-green-800 
               [&[aria-current]]:bg-green-300 dark:[&[aria-current]]:bg-green-700
               [&[aria-current]]:text-zinc-950 dark:[&[aria-current]]:text-zinc-50"
    >
        {{ __('Dashboard') }}
    </flux:navbar.item>
    <flux:navbar.item 
        :href="route('umpire.matches')" 
        :current="request()->routeIs('umpire.matches*')"
        wire:navigate
        class="text-zinc-800 dark:text-zinc-100 
               hover:bg-green-200 dark:hover:bg-green-800 
               [&[aria-current]]:bg-green-300 dark:[&[aria-current]]:bg-green-700
               [&[aria-current]]:text-zinc-950 dark:[&[aria-current]]:text-zinc-50"
    >
        {{ __('My Matches') }}
    </flux:navbar.item>

    <flux:spacer />
</flux:navbar>
