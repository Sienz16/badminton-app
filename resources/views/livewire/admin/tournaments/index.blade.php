<div>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-2xl font-semibold text-zinc-900 dark:text-white">Tournaments</h1>
                <p class="mt-2 text-sm text-zinc-700 dark:text-zinc-400">Manage all badminton tournaments and their matches.</p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                {{-- <flux:button href="{{ route('admin.tournaments.create') }}" wire:navigate>
                    <flux:icon name="plus" class="h-4 w-4" />
                    <span>New Tournament</span>
                </flux:button> --}}
            </div>
        </div>

        <!-- Content -->
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg dark:ring-white dark:ring-opacity-10">
                        <table class="min-w-full divide-y divide-zinc-300 dark:divide-zinc-600">
                            <thead class="bg-zinc-50 dark:bg-zinc-800">
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-zinc-900 dark:text-white sm:pl-6">Match</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-zinc-900 dark:text-white">Venue</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-zinc-900 dark:text-white">Date</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-zinc-900 dark:text-white">Status</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-200 bg-white dark:divide-zinc-700 dark:bg-zinc-900">
                                @foreach($matches as $match)
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                            <div class="font-medium text-zinc-900 dark:text-white">
                                                {{ $match->player1->name }} vs {{ $match->player2->name }}
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-zinc-500 dark:text-zinc-400">
                                            {{ $match->venue->name }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-zinc-500 dark:text-zinc-400">
                                            {{ $match->scheduled_at->format('M d, Y H:i') }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm">
                                            <span @class([
                                                'inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset',
                                                'bg-green-50 text-green-700 ring-green-600/20 dark:bg-green-400/10 dark:text-green-400 dark:ring-green-400/20' => $match->status === 'completed',
                                                'bg-yellow-50 text-yellow-700 ring-yellow-600/20 dark:bg-yellow-400/10 dark:text-yellow-400 dark:ring-yellow-400/20' => $match->status === 'in_progress',
                                                'bg-blue-50 text-blue-700 ring-blue-600/20 dark:bg-blue-400/10 dark:text-blue-400 dark:ring-blue-400/20' => $match->status === 'scheduled',
                                            ])>
                                                {{ str($match->status)->title() }}
                                            </span>
                                        </td>
                                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                            <a href="{{ route('admin.tournaments.show', $match) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300" wire:navigate>
                                                View<span class="sr-only">, {{ $match->player1->name }} vs {{ $match->player2->name }}</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>