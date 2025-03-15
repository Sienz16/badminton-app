<flux:navlist.group :heading="__('Administration')">
    <flux:navlist.item 
        icon="layout-grid" 
        :href="route('admin.dashboard')" 
        :current="request()->routeIs('admin.dashboard*')" 
        wire:navigate
        class="text-zinc-800 dark:text-zinc-100 
               hover:bg-green-200 dark:hover:bg-green-800 
               [&[aria-current]]:bg-green-300 dark:[&[aria-current]]:bg-green-700
               [&[aria-current]]:text-zinc-950 dark:[&[aria-current]]:text-zinc-50"
    >
        {{ __('Dashboard') }}
    </flux:navlist.item>
    
    <flux:navlist.item 
        icon="users" 
        :href="route('admin.users')" 
        :current="request()->routeIs('admin.users*')" 
        wire:navigate
        class="text-zinc-800 dark:text-zinc-100 
               hover:bg-green-200 dark:hover:bg-green-800 
               [&[aria-current]]:bg-green-300 dark:[&[aria-current]]:bg-green-700
               [&[aria-current]]:text-zinc-950 dark:[&[aria-current]]:text-zinc-50"
    >
        {{ __('Users Management') }}
    </flux:navlist.item>
    
    <flux:navlist.item 
        icon="map-pin" 
        :href="route('admin.venues')" 
        :current="request()->routeIs('admin.venues*')" 
        wire:navigate
        class="text-zinc-800 dark:text-zinc-100 
               hover:bg-green-200 dark:hover:bg-green-800 
               [&[aria-current]]:bg-green-300 dark:[&[aria-current]]:bg-green-700
               [&[aria-current]]:text-zinc-950 dark:[&[aria-current]]:text-zinc-50"
    >
        {{ __('Venues') }}
    </flux:navlist.item>
    
    <flux:navlist.item 
        icon="trophy" 
        :href="route('admin.tournaments')" 
        :current="request()->routeIs('admin.tournaments*')" 
        wire:navigate
        class="text-zinc-800 dark:text-zinc-100 
               hover:bg-green-200 dark:hover:bg-green-800 
               [&[aria-current]]:bg-green-300 dark:[&[aria-current]]:bg-green-700
               [&[aria-current]]:text-zinc-950 dark:[&[aria-current]]:text-zinc-50"
    >
        {{ __('Tournaments') }}
    </flux:navlist.item>
</flux:navlist.group>
