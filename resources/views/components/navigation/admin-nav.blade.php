<flux:navlist.group :heading="__('Administration')">
    <flux:navlist.item icon="layout-grid" :href="route('admin.dashboard')" :current="request()->routeIs('admin.dashboard')" wire:navigate>
        {{ __('Dashboard') }}
    </flux:navlist.item>
    <flux:navlist.item icon="users" :href="route('admin.users')" :current="request()->routeIs('admin.users')" wire:navigate>
        {{ __('Users Management') }}
    </flux:navlist.item>
    <flux:navlist.item icon="map-pin" :href="route('admin.venues')" :current="request()->routeIs('admin.venues')" wire:navigate>
        {{ __('Venues') }}
    </flux:navlist.item>
    <flux:navlist.item icon="trophy" :href="route('admin.tournaments')" :current="request()->routeIs('admin.tournaments')" wire:navigate>
        {{ __('Tournaments') }}
    </flux:navlist.item>
</flux:navlist.group>
