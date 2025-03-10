<flux:navlist.group :heading="__('Umpire Portal')">
    <flux:navlist.item icon="layout-grid" :href="route('umpire.dashboard')" :current="request()->routeIs('umpire.dashboard')" wire:navigate>
        {{ __('Dashboard') }}
    </flux:navlist.item>
    <flux:navlist.item icon="flag" href="#" :current="request()->routeIs('umpire.matches')" wire:navigate>
        {{ __('My Matches') }}
    </flux:navlist.item>
    <flux:navlist.item icon="calendar" href="#" :current="request()->routeIs('umpire.schedule')" wire:navigate>
        {{ __('Schedule') }}
    </flux:navlist.item>
</flux:navlist.group>
