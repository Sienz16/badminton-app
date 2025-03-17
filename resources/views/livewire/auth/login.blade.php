<div class="flex flex-col gap-6">
    <x-auth-header 
        :title="__('Log in to your account')" 
        :description="__('Enter your email and password below to log in')"
        class="text-green-800 dark:text-green-200" 
    />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="login" class="flex flex-col gap-6">
        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('Email address')"
            type="email"
            required
            autofocus
            autocomplete="email"
            placeholder="email@example.com"
            class="bg-green-50 border-green-200 focus:border-green-500 focus:ring-green-500 dark:bg-green-900/30 dark:border-green-700 dark:focus:ring-green-500"
        />

        <!-- Password -->
        <div class="relative">
            <flux:input
                wire:model="password"
                :label="__('Password')"
                type="password"
                required
                autocomplete="current-password"
                :placeholder="__('Password')"
                class="bg-green-50 border-green-200 focus:border-green-500 focus:ring-green-500 dark:bg-green-900/30 dark:border-green-700 dark:focus:ring-green-500"
            />

            @if (Route::has('password.request'))
                <flux:link 
                    class="absolute right-0 top-0 text-sm text-green-600 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300" 
                    :href="route('password.request')" 
                    wire:navigate
                >
                    {{ __('Forgot your password?') }}
                </flux:link>
            @endif
        </div>

        <!-- Remember Me -->
        <flux:checkbox 
            wire:model="remember" 
            :label="__('Remember me')"
            class="text-green-600 focus:ring-green-500 dark:text-green-500 dark:focus:ring-green-400"
        />

        <div class="flex items-center justify-end">
            <flux:button 
                variant="primary" 
                type="submit" 
                class="w-full bg-green-600 hover:bg-green-700 focus:ring-green-500 dark:bg-green-500 dark:hover:bg-green-600"
            >
                {{ __('Log in') }}
            </flux:button>
        </div>
    </form>

    @if (Route::has('register'))
        <div class="space-x-1 text-center text-sm text-green-600 dark:text-green-400">
            {{ __('Don\'t have an account?') }}
            <flux:link 
                :href="route('register')" 
                wire:navigate
                class="text-green-700 hover:text-green-800 dark:text-green-300 dark:hover:text-green-200"
            >
                {{ __('Sign up') }}
            </flux:link>
        </div>
    @endif
</div>
