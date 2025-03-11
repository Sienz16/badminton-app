<div class="mt-4 flex flex-col gap-6">
    <div class="text-center">
        <h2 class="text-2xl font-bold">{{ __('Account Pending Approval') }}</h2>
        <p class="mt-2 text-gray-600 dark:text-gray-400">
            {{ __('Your account is pending approval from an administrator. You will receive an email notification once your account has been approved.') }}
        </p>
    </div>

    <div class="flex flex-col items-center justify-between space-y-3">
        <flux:link href="{{ route('login') }}" class="text-sm cursor-pointer" wire:navigate>
            {{ __('Return to login') }}
        </flux:link>
    </div>
</div>