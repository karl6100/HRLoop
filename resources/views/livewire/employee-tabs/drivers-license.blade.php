<div>
    <h3 class="font-semibold">Driver Licenses</h3>

    @if ($mode !== 'view')
        <form wire:submit.prevent="saveLicense" class="space-y-2">
            <input type="text" wire:model="license_number" placeholder="License Number" class="border rounded p-1">
            <input type="text" wire:model="license_type" placeholder="License Type" class="border rounded p-1">
            <input type="date" wire:model="expiry_date" class="border rounded p-1">

            <div>
                <label class="font-medium">Categories:</label>
                @foreach(['A','B','C','D','E'] as $cat)
                    <label class="ml-2">
                        <input type="checkbox" wire:model="license_categories" value="{{ $cat }}">
                        {{ $cat }}
                    </label>
                @endforeach
            </div>

            <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded">Add License</button>
        </form>
    @endif

    <ul class="mt-3 space-y-1">
        @foreach($licenses as $license)
            <li class="border p-2 rounded flex justify-between items-center">
                <div>
                    <span class="font-semibold">{{ $license['license_number'] }}</span>
                    — {{ $license['license_type'] }} (expires {{ $license['expiry_date'] }})
                    <div class="text-sm text-gray-500">
                        Categories: 
                        {{ collect($license['categories'])->pluck('category_code')->implode(', ') }}
                    </div>
                </div>

                @if ($mode !== 'view')
                    <button wire:click="deleteLicense({{ $license['id'] }})"
                            class="text-red-600 hover:underline">
                        Delete
                    </button>
                @endif
            </li>
        @endforeach
    </ul>
</div>
