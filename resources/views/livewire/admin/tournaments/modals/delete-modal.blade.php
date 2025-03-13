<flux:modal name="delete-match-modal" focusable>
    <div class="p-6">
        <div class="mb-6">
            <flux:heading size="lg">Delete Match</flux:heading>
            <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                Are you sure you want to delete this match? This action cannot be undone.
            </p>
        </div>

        <div class="mt-4">
            <div class="rounded-md bg-red-50 dark:bg-red-900/50 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400 dark:text-red-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-red-800 dark:text-red-200">
                            This will permanently delete:
                        </p>
                        <ul class="mt-2 list-disc list-inside text-sm text-red-700 dark:text-red-300">
                            <li>Match details and scores</li>
                            <li>Court scheduling information</li>
                            <li>Match history and statistics</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex justify-end gap-3">
            <flux:modal.close>
                <flux:button variant="ghost">
                    Cancel
                </flux:button>
            </flux:modal.close>

            <flux:button 
                variant="danger"
                wire:click="deleteMatch"
                wire:loading.attr="disabled"
            >
                <div wire:loading.remove wire:target="deleteMatch">
                    Delete Match
                </div>
                <div wire:loading wire:target="deleteMatch">
                    Deleting...
                </div>
            </flux:button>
        </div>
    </div>
</flux:modal>