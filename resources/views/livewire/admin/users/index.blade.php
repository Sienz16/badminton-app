<div class="flex h-full w-full flex-1 flex-col gap-4">
    <!-- Header with Stats -->
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <!-- Total Users Card -->
        <div class="rounded-xl border-2 border-green-400/50 bg-white p-6 dark:border-green-600/50 dark:bg-blue-900/30">
            <div class="flex items-center gap-4">
                <div class="rounded-lg bg-blue-100 p-3 dark:bg-blue-900/30">
                    <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-blue-600 dark:text-blue-400">Total Users</p>
                    <p class="text-2xl font-semibold text-blue-900 dark:text-blue-50">{{ $users->total() }}</p>
                </div>
            </div>
        </div>
        
        <!-- Verified Users Card -->
        <div class="rounded-xl border-2 border-green-400/50 bg-white p-6 dark:border-green-600/50 dark:bg-emerald-900/30">
            <div class="flex items-center gap-4">
                <div class="rounded-lg bg-emerald-100 p-3 dark:bg-emerald-900/30">
                    <svg class="h-6 w-6 text-emerald-600 dark:text-emerald-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-emerald-600 dark:text-emerald-400">Verified Users</p>
                    <p class="text-2xl font-semibold text-emerald-900 dark:text-emerald-50">{{ $verifiedCount }}</p>
                </div>
            </div>
        </div>

        <!-- Pending Verification Card -->
        <div class="rounded-xl border-2 border-green-400/50 bg-white p-6 dark:border-green-600/50 dark:bg-amber-900/30">
            <div class="flex items-center gap-4">
                <div class="rounded-lg bg-amber-100 p-3 dark:bg-amber-900/30">
                    <svg class="h-6 w-6 text-amber-600 dark:text-amber-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-amber-600 dark:text-amber-400">Pending Verification</p>
                    <p class="text-2xl font-semibold text-amber-900 dark:text-amber-50">{{ $pendingCount }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Role Tabs -->
    <div class="rounded-xl border-2 border-green-400/50 bg-white dark:border-green-600/50 dark:bg-green-900/30">
        <div class="border-b border-green-400/30 dark:border-green-600/30">
            <nav class="flex space-x-8 px-6" aria-label="Tabs">
                <button
                    wire:click="$set('selectedRole', 'umpire')"
                    class="relative py-4 text-sm font-medium transition-colors {{ $selectedRole === 'umpire' ? 'text-green-600' : 'text-green-600/70 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300' }}"
                >
                    <span class="flex items-center gap-2">
                        Umpires
                        @if($umpireCount > 0)
                            <span class="rounded-full {{ $selectedRole === 'umpire' ? 'bg-green-50 text-green-600 dark:bg-green-900/50 dark:text-green-400' : 'bg-green-50/50 text-green-600 dark:bg-green-900/30 dark:text-green-400' }} px-2.5 py-0.5 text-xs font-medium">
                                {{ $umpireCount }}
                            </span>
                        @endif
                    </span>
                    @if($selectedRole === 'umpire')
                        <span class="absolute inset-x-0 bottom-0 h-0.5 bg-green-600"></span>
                    @endif
                </button>

                <button
                    wire:click="$set('selectedRole', 'player')"
                    class="relative py-4 text-sm font-medium transition-colors {{ $selectedRole === 'player' ? 'text-green-600' : 'text-green-600/70 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300' }}"
                >
                    <span class="flex items-center gap-2">
                        Players
                        @if($playerCount > 0)
                            <span class="rounded-full {{ $selectedRole === 'player' ? 'bg-green-50 text-green-600 dark:bg-green-900/50 dark:text-green-400' : 'bg-green-50/50 text-green-600 dark:bg-green-900/30 dark:text-green-400' }} px-2.5 py-0.5 text-xs font-medium">
                                {{ $playerCount }}
                            </span>
                        @endif
                    </span>
                    @if($selectedRole === 'player')
                        <span class="absolute inset-x-0 bottom-0 h-0.5 bg-green-600"></span>
                    @endif
                </button>

                <button
                    wire:click="$set('selectedRole', 'admin')"
                    class="relative py-4 text-sm font-medium transition-colors {{ $selectedRole === 'admin' ? 'text-green-600' : 'text-green-600/70 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300' }}"
                >
                    <span class="flex items-center gap-2">
                        Admins
                        @if($adminCount > 0)
                            <span class="rounded-full {{ $selectedRole === 'admin' ? 'bg-green-50 text-green-600 dark:bg-green-900/50 dark:text-green-400' : 'bg-green-50/50 text-green-600 dark:bg-green-900/30 dark:text-green-400' }} px-2.5 py-0.5 text-xs font-medium">
                                {{ $adminCount }}
                            </span>
                        @endif
                    </span>
                    @if($selectedRole === 'admin')
                        <span class="absolute inset-x-0 bottom-0 h-0.5 bg-green-600"></span>
                    @endif
                </button>
            </nav>
        </div>

        <!-- Filters -->
        <div class="grid gap-4 p-6 md:grid-cols-2">
            <flux:input 
                wire:model.live="search" 
                type="search" 
                placeholder="Search users..."
                icon="magnifying-glass"
            />
            
            @if($selectedRole !== 'admin')
                <flux:select 
                    wire:model.live="verificationStatus"
                    icon="funnel"
                >
                    <option value="">All Status</option>
                    <option value="verified">Admin Verified</option>
                    <option value="unverified">Pending Verification</option>
                </flux:select>
            @endif

            <!-- Add this new button -->
            <div class="md:col-span-2 flex justify-end">
                <flux:modal.trigger name="create-user-modal">
                    <flux:button variant="primary" class="bg-green-600 hover:bg-green-700">
                        <span class="flex items-center gap-2">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                            </svg>
                            Create New User
                        </span>
                    </flux:button>
                </flux:modal.trigger>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="overflow-hidden rounded-xl border-2 border-green-400/50 bg-white dark:border-green-600/50 dark:bg-green-900/30">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-green-400/30 dark:divide-green-600/30">
                <thead class="bg-green-50 dark:bg-green-900/30">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-green-600 dark:text-green-400">Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-green-600 dark:text-green-400">Email</th>
                        @if($selectedRole !== 'admin')
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-green-600 dark:text-green-400">Status</th>
                        @endif
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-green-600 dark:text-green-400">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-green-400/30 dark:divide-green-600/30 bg-white dark:bg-green-900/10">
                    @forelse($users as $user)
                        <tr class="group transition-colors hover:bg-green-50/50 dark:hover:bg-green-900/20">
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-green-900 dark:text-green-50">
                                {{ $user->name }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-green-600 dark:text-green-400">
                                {{ $user->email }}
                            </td>
                            @if($selectedRole !== 'admin')
                                <td class="whitespace-nowrap px-6 py-4 text-sm">
                                    @if($user->admin_verified_at)
                                        <span class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 dark:bg-green-900/50 dark:text-green-400">
                                            <svg class="h-3 w-3" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10 3L4.5 8.5L2 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            Verified
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 rounded-full bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-700 dark:bg-yellow-900/50 dark:text-yellow-400">
                                            <svg class="h-3 w-3" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6 3V6M6 9H6.01M11 6C11 8.76142 8.76142 11 6 11C3.23858 11 1 8.76142 1 6C1 3.23858 3.23858 1 6 1C8.76142 1 11 3.23858 11 6Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            Pending
                                        </span>
                                    @endif
                                </td>
                            @endif
                            <td class="whitespace-nowrap px-6 py-4 text-sm">
                                @if($user->is_active)
                                    <span class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 dark:bg-green-900/50 dark:text-green-400">
                                        <span class="h-1.5 w-1.5 rounded-full bg-green-600 dark:bg-green-400"></span>
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 rounded-full bg-red-50 px-2 py-1 text-xs font-medium text-red-700 dark:bg-red-900/50 dark:text-red-400">
                                        <span class="h-1.5 w-1.5 rounded-full bg-red-600 dark:bg-red-400"></span>
                                        Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm">
                                <div class="flex items-center gap-2">
                                    @if($selectedRole !== 'admin' && !$user->admin_verified_at)
                                        <flux:modal.trigger name="verify-user-modal">
                                            <flux:button 
                                                size="xs"
                                                variant="primary"
                                                wire:click="$set('selectedUserId', {{ $user->id }})"
                                            >
                                                <span class="flex items-center gap-1">
                                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                                    </svg>
                                                    Verify
                                                </span>
                                            </flux:button>
                                        </flux:modal.trigger>
                                    @endif
                                    <flux:button 
                                        size="xs" 
                                        variant="{{ $user->is_active ? 'danger' : 'success' }}"
                                        wire:click="toggleUserStatus({{ $user->id }})"
                                        wire:confirm="Are you sure you want to {{ $user->is_active ? 'deactivate' : 'activate' }} this user?"
                                    >
                                        <span class="flex items-center gap-1">
                                            @if($user->is_active)
                                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 011.06 1.06L10 11.06l3.72 3.72a.75.75 0 011.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                                </svg>
                                            @else
                                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M10 12.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" />
                                                    <path fill-rule="evenodd" d="M.664 10.59a1.651 1.651 0 010-1.186A10.004 10.004 0 0110 3c4.257 0 7.893 2.66 9.336 6.41.147.381.146.804 0 1.186A10.004 10.004 0 0110 17c-4.257 0-7.893-2.66-9.336-6.41zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                                </svg>
                                            @endif
                                            {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                                        </span>
                                    </flux:button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="rounded-full bg-neutral-100 p-3 dark:bg-neutral-800">
                                        <svg class="h-6 w-6 text-neutral-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                        </svg>
                                    </div>
                                    <h3 class="mt-2 text-sm font-medium text-neutral-900 dark:text-white">No users found</h3>
                                    <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">Try adjusting your search or filter to find what you're looking for.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="border-t border-neutral-200 px-6 py-4 dark:border-neutral-700">
            {{ $users->links() }}
        </div>
    </div>

    <!-- Verify User Modal -->
    <flux:modal name="verify-user-modal" class="max-w-lg">
        <div class="p-8">
            <!-- Header -->
            <div class="flex items-start gap-4">
                <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-emerald-100 dark:bg-emerald-900/30">
                    <svg class="h-6 w-6 text-emerald-600 dark:text-emerald-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-xl font-semibold leading-6 text-gray-900 dark:text-white">
                        Verify User Account
                    </h3>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        You're about to verify this user account. This will grant them full access to their role-specific features.
                    </p>
                </div>
            </div>

            <!-- Content -->
            <div class="mt-6">
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-800/50">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 01.67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 11-.671-1.34l.041-.022zM12 9a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Important Note</h4>
                            <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                <ul class="list-disc space-y-1 pl-5">
                                    <li>This action cannot be undone</li>
                                    <li>User will receive email notification</li>
                                    <li>Access will be granted immediately</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="flex justify-end gap-3">
                <flux:modal.close>
                    <flux:button variant="subtle" class="px-4">
                        Cancel
                    </flux:button>
                </flux:modal.close>
                
                <flux:button 
                    variant="primary"
                    wire:click="verifyUser"
                    wire:loading.attr="disabled"
                    class="bg-emerald-600 hover:bg-emerald-700 focus:ring-emerald-500 px-4"
                >
                    <span wire:loading.remove wire:target="verifyUser">
                        <svg class="-ml-1 mr-2 h-5 w-5 inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" />
                        </svg>
                        Confirm Verification
                    </span>
                    <span wire:loading wire:target="verifyUser">
                        <svg class="-ml-1 mr-2 h-5 w-5 animate-spin inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Verifying...
                    </span>
                </flux:button>
            </div>
        </div>
    </flux:modal>

    <flux:modal 
        name="create-user-modal" 
        :show="$errors->isNotEmpty()"
        x-on:close-modal.window="if ($event.detail.modal === 'create-user-modal') $dispatch('close')"
        focusable
    >
        <form wire:submit="createUser" class="space-y-6 p-6">
            <div>
                <flux:heading size="lg" class="text-green-900 dark:text-green-50">Create New User</flux:heading>
                <p class="mt-1 text-sm text-green-600 dark:text-green-400">
                    Fill in the details to create a new player or umpire
                </p>
            </div>

            <!-- Basic Information -->
            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <flux:label for="name" class="text-green-700 dark:text-green-300">Name</flux:label>
                    <flux:input 
                        wire:model="name" 
                        type="text" 
                        required 
                        class="bg-green-50 border-green-200 focus:border-green-500 focus:ring-green-500 dark:bg-green-900/30 dark:border-green-600/50"
                    />
                    <flux:error field="name" class="text-red-600" />
                </div>

                <div>
                    <flux:label for="email" class="text-green-700 dark:text-green-300">Email</flux:label>
                    <flux:input 
                        wire:model="email" 
                        type="email" 
                        required 
                        class="bg-green-50 border-green-200 focus:border-green-500 focus:ring-green-500 dark:bg-green-900/30 dark:border-green-600/50"
                    />
                    <flux:error field="email" />
                </div>

                <div>
                    <flux:label for="password" class="text-green-700 dark:text-green-300">Temporary Password</flux:label>
                    <flux:input 
                        wire:model="password" 
                        type="password" 
                        required 
                        autocomplete="new-password"
                        class="bg-green-50 border-green-200 focus:border-green-500 focus:ring-green-500 dark:bg-green-900/30 dark:border-green-600/50"
                    />
                    <p class="mt-1 text-sm text-green-600 dark:text-green-400">Set a temporary password for the user</p>
                    <flux:error field="password" />
                </div>

                <div>
                    <flux:label for="phone_number">Phone Number</flux:label>
                    <flux:input wire:model="phone_number" type="tel" />
                    <flux:error field="phone_number" />
                </div>

                <div>
                    <flux:label for="role_id">Role</flux:label>
                    <flux:select wire:model.live="role_id" required>
                        <option value="player">Player</option>
                        <option value="umpire">Umpire</option>
                    </flux:select>
                    <flux:error field="role_id" />
                </div>
            </div>

            <!-- Profile Photo -->
            <div>
                <flux:label for="profile_photo">Profile Photo</flux:label>
                <flux:input wire:model="profile_photo" type="file" accept="image/*" />
                <flux:error field="profile_photo" />
            </div>

            <!-- Bio -->
            <div>
                <flux:label for="bio" class="text-green-700 dark:text-green-300">Bio</flux:label>
                <flux:textarea 
                    wire:model="bio" 
                    rows="3"
                    class="bg-green-50 border-green-200 focus:border-green-500 focus:ring-green-500 dark:bg-green-900/30 dark:border-green-600/50"
                />
                <flux:error field="bio" />
            </div>

            <!-- Player Fields -->
            @if($role_id === 'player')
            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <flux:label for="date_of_birth" class="text-green-700 dark:text-green-300">Date of Birth</flux:label>
                    <flux:input 
                        wire:model="date_of_birth" 
                        type="date" 
                        required 
                        class="bg-green-50 border-green-200 focus:border-green-500 focus:ring-green-500 dark:bg-green-900/30 dark:border-green-600/50"
                    />
                    <flux:error field="date_of_birth" />
                </div>

                <div>
                    <flux:label for="gender" class="text-green-700 dark:text-green-300">Gender</flux:label>
                    <flux:select 
                        wire:model="gender" 
                        required
                        class="bg-green-50 border-green-200 focus:border-green-500 focus:ring-green-500 dark:bg-green-900/30 dark:border-green-600/50"
                    >
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </flux:select>
                    <flux:error field="gender" />
                </div>

                <div>
                    <flux:label for="nationality">Nationality</flux:label>
                    <flux:input wire:model="nationality" type="text" required />
                    <flux:error field="nationality" />
                </div>

                <div>
                    <flux:label for="playing_hand">Playing Hand</flux:label>
                    <flux:select wire:model="playing_hand" required>
                        <option value="right">Right</option>
                        <option value="left">Left</option>
                        <option value="ambidextrous">Ambidextrous</option>
                    </flux:select>
                    <flux:error field="playing_hand" />
                </div>
            </div>
            @endif

            <!-- Umpire Fields -->
            @if($role_id === 'umpire')
            <div>
                <flux:label for="status">Status</flux:label>
                <flux:select wire:model="status" required>
                    <option value="available">Available</option>
                    <option value="unavailable">Unavailable</option>
                </flux:select>
                <flux:error field="status" />
            </div>
            @endif

            <div class="flex justify-end gap-3">
                <flux:button type="button" variant="ghost" x-on:click="$dispatch('close')" class="text-green-700 hover:bg-green-50 dark:text-green-300 dark:hover:bg-green-900/30">
                    Cancel
                </flux:button>
                <flux:button type="submit" variant="primary" class="bg-green-600 hover:bg-green-700">
                    Create User
                </flux:button>
            </div>
        </form>
    </flux:modal>
</div>
