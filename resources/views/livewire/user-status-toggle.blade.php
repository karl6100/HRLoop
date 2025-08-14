<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
        Status
    </label>

    <label class="inline-flex items-center cursor-pointer">
        <input
            type="checkbox"
            class="sr-only peer"
            wire:model.live="user.deactivate"
            @if($mode === 'view') disabled @endif
        >

        <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-red-500
            after:content-[''] after:absolute after:top-[2px] after:left-[2px]
            after:bg-white after:border-gray-300 after:border after:rounded-full
            after:h-5 after:w-5 after:transition-all
            peer-checked:after:translate-x-full peer-checked:after:border-white">
        </div>

        <span class="ml-3 text-sm text-gray-900 dark:text-gray-300">
            {{ $user->deactivate ? 'Inactive' : 'Active' }}
        </span>

        <span wire:loading wire:target="user.deactivate" class="ml-2 text-xs text-gray-500">
            Saving…
        </span>
    </label>
</div>
