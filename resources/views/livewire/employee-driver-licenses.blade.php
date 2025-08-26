<div class="p-4">
    <h2 class="text-xl font-bold mb-2">Driver’s Licenses</h2>
    {{-- Add Form --}}
    <form wire:submit.prevent="save" class="space-y-3">
        <input type="text" wire:model="license_number" placeholder="License Number" class="border p-2 w-full">
        <input type="text" wire:model="license_type" placeholder="License Type" class="border p-2 w-full">

        {{-- Philippine Categories --}}
        <label class="font-semibold">Categories</label>
        <div class="flex flex-wrap gap-2">
            @foreach(['A','B','C','D','BE','CE'] as $cat)
                <label class="flex items-center space-x-1">
                    <input type="checkbox" wire:model="categories" value="{{ $cat }}">
                    <span>{{ $cat }}</span>
                </label>
            @endforeach
        </div>
        <input type="date" wire:model="expiry_date" class="border p-2 w-full">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save</button>
    </form>
    {{-- Display Licenses --}}
    <table class="mt-4 w-full border">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2">Number</th>
                <th class="p-2">Type</th>
                <th class="p-2">Categories</th>
                <th class="p-2">Expiry</th>
            </tr>
        </thead>
        <tbody>
            @foreach($licenses as $license)
            <tr>
                <td class="p-2">{{ $license->license_number }}</td>
                <td class="p-2">{{ $license->license_type }}</td>
                <td class="p-2">
                    {{ $license->categories->pluck('category_code')->join(', ') }}
                </td>
                <td class="p-2">{{ $license->expiry_date }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
