<flux:modal wire:model="showUmpireModal" focusable>
    <div class="p-6">
        <div class="mb-6">
            <flux:heading size="lg">
                {{ $match->umpireUser ? 'Change Umpire' : 'Assign Umpire' }}
            </flux:heading>
            <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                Select an umpire to officiate this match.
            </p>
        </div>

        <div class="space-y-4">
            <div>
                <flux:label for="umpireId">Umpire</flux:label>
                <flux:select 
                    id="umpireId"
                    wire:model="umpireId"
                    class="mt-1 block w-full"
                >
                    <option value="">Select an umpire</option>
                    @foreach($umpires as $umpire)
                        <option value="{{ $umpire->id }}">
                            {{ $umpire->name }}
                        </option>
                    @endforeach
                </flux:select>
                @error('umpireId')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-6 flex justify-end gap-3">
            <flux:button 
                variant="ghost"
                wire:click="$set('showUmpireModal', false)"
            >
                Cancel
            </flux:button>

            <flux:button 
                wire:click="assignUmpire"
                wire:loading.attr="disabled"
            >
                <span wire:loading.remove wire:target="assignUmpire">
                    {{ $match->umpireUser ? 'Change Umpire' : 'Assign Umpire' }}
                </span>
                <span wire:loading wire:target="assignUmpire">
                    Saving...
                </span>
            </flux:button>
        </div>
    </div>
</flux:modal>