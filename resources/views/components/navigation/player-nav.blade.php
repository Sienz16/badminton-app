<flux:navbar class="space-x-1">
    <flux:navbar.item 
        :href="route('player.dashboard')" 
        :current="request()->routeIs('player.dashboard')"
        wire:navigate
    >
        {{ __('Dashboard') }}
    </flux:navbar.item>
    <flux:navbar.item 
        :href="route('player.matches')" 
        :current="request()->routeIs('player.matches')"
        wire:navigate
    >
        {{ __('My Matches') }}
    </flux:navbar.item>

    <flux:spacer />
</flux:navbar>
