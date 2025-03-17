<div class="flex flex-col gap-6">
    <x-auth-header 
        :title="__('Create an account')" 
        :description="__('Enter your details below to create your account')"
        class="text-green-800 dark:text-green-200" 
    />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        <flux:input
            wire:model="name"
            :label="__('Name')"
            type="text"
            required
            autofocus
            autocomplete="name"
            :placeholder="__('Full name')"
            class="bg-green-50 border-green-200 focus:border-green-500 focus:ring-green-500 dark:bg-green-900/30 dark:border-green-700 dark:focus:ring-green-500"
        />

        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('Email address')"
            type="email"
            required
            autocomplete="email"
            placeholder="email@example.com"
            class="bg-green-50 border-green-200 focus:border-green-500 focus:ring-green-500 dark:bg-green-900/30 dark:border-green-700 dark:focus:ring-green-500"
        />

        <!-- Role Selection -->
        <flux:radio.group 
            wire:model="role_id" 
            :label="__('Register as')" 
            variant="segmented"
            class="[&_[data-flux-radio-option][aria-checked=true]]:bg-green-600 [&_[data-flux-radio-option][aria-checked=true]]:text-white dark:[&_[data-flux-radio-option][aria-checked=true]]:bg-green-500"
        >
            <flux:radio value="player" class="text-green-800 dark:text-green-200">{{ __('Player') }}</flux:radio>
            <flux:radio value="umpire" class="text-green-800 dark:text-green-200">{{ __('Umpire') }}</flux:radio>
        </flux:radio.group>

        <!-- Password -->
        <flux:input
            wire:model="password"
            :label="__('Password')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Password')"
            class="bg-green-50 border-green-200 focus:border-green-500 focus:ring-green-500 dark:bg-green-900/30 dark:border-green-700 dark:focus:ring-green-500"
        />

        <!-- Confirm Password -->
        <flux:input
            wire:model="password_confirmation"
            :label="__('Confirm password')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Confirm password')"
            class="bg-green-50 border-green-200 focus:border-green-500 focus:ring-green-500 dark:bg-green-900/30 dark:border-green-700 dark:focus:ring-green-500"
        />

        <div class="flex items-center justify-end">
            <flux:button 
                type="submit" 
                variant="primary" 
                class="w-full bg-green-600 hover:bg-green-700 focus:ring-green-500 dark:bg-green-500 dark:hover:bg-green-600"
            >
                {{ __('Create account') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 text-center text-sm text-green-600 dark:text-green-400">
        {{ __('Already have an account?') }}
        <flux:link 
            :href="route('login')" 
            wire:navigate
            class="text-green-700 hover:text-green-800 dark:text-green-300 dark:hover:text-green-200"
        >
            {{ __('Log in') }}
        </flux:link>
    </div>
</div>
