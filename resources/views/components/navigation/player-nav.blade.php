<flux:navlist.group :heading="__('Player Portal')">
    <flux:navlist.item icon="layout-grid" :href="route('player.dashboard')" :current="request()->routeIs('player.dashboard')" wire:navigate>
        {{ __('Dashboard') }}
    </flux:navlist.item>
    <flux:navlist.item icon="play-circle" href="#" :current="request()->routeIs('player.matches')" wire:navigate>
        {{ __('My Matches') }}
    </flux:navlist.item>
    <flux:navlist.item icon="trophy" href="#" :current="request()->routeIs('player.tournaments')" wire:navigate>
        {{ __('Tournaments') }}
    </flux:navlist.item>
</flux:navlist.group>
