<flux:navlist.group :heading="__('Administration')">
    <flux:navlist.item icon="layout-grid" :href="route('admin.dashboard')" :current="request()->routeIs('admin.dashboard')" wire:navigate>
        {{ __('Dashboard') }}
    </flux:navlist.item>
    <flux:navlist.item icon="users" href="#" :current="request()->routeIs('admin.users')" wire:navigate>
        {{ __('Users Management') }}
    </flux:navlist.item>
    <flux:navlist.item icon="trophy" href="#" :current="request()->routeIs('admin.tournaments')" wire:navigate>
        {{ __('Tournaments') }}
    </flux:navlist.item>
</flux:navlist.group>