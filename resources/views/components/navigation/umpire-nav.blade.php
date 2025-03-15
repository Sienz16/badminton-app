<flux:navbar class="space-x-1">
    <flux:navbar.item 
        :href="route('umpire.dashboard')" 
        :current="request()->routeIs('umpire.dashboard')"
        wire:navigate
        class="text-green-900 dark:text-green-100 
               hover:bg-green-200 dark:hover:bg-green-800 
               [&[aria-current]]:bg-green-300 dark:[&[aria-current]]:bg-green-700
               [&[aria-current]]:text-green-950 dark:[&[aria-current]]:text-green-50"
    >
        {{ __('Dashboard') }}
    </flux:navbar.item>
    <flux:navbar.item 
        :href="route('umpire.matches')" 
        :current="request()->routeIs('umpire.matches')"
        wire:navigate
        class="text-green-900 dark:text-green-100 
               hover:bg-green-200 dark:hover:bg-green-800 
               [&[aria-current]]:bg-green-300 dark:[&[aria-current]]:bg-green-700
               [&[aria-current]]:text-green-950 dark:[&[aria-current]]:text-green-50"
    >
        {{ __('My Matches') }}
    </flux:navbar.item>

    <flux:spacer />

    <!-- Theme Switcher Button -->
    <div x-data="{ 
        isDark: localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches),
        toggleTheme() {
            this.isDark = !this.isDark;
            localStorage.setItem('theme', this.isDark ? 'dark' : 'light');
            if (this.isDark) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        }
    }" 
    x-init="
        if (isDark) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    "
    class="relative">
        <flux:button 
            variant="ghost" 
            size="sm" 
            @click="toggleTheme()"
            class="flex items-center justify-center w-10 h-10 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
        >
            <flux:icon 
                x-show="!isDark" 
                name="sun" 
                class="h-5 w-5 text-amber-500"
            />
            <flux:icon 
                x-show="isDark" 
                name="moon" 
                class="h-5 w-5 text-blue-400"
            />
        </flux:button>
    </div>
</flux:navbar>
