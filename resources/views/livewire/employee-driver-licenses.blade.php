<div class="p-4">
    <h2 class="text-xl font-bold mb-2">Driver’s Licenses</h2>
    {{-- Add Form --}}
    <form wire:submit.prevent="save" class="space-y-3">
        <input type="text" wire:model="license_number" placeholder="License Number" class="border p-2 w-full">
        <select wire:model="license_type" class="border p-2 w-full">
            <option value="">-- Select License Type --</option>
            <option value="Non-Professional">Non-Professional</option>
            <option value="Professional">Professional</option>
        </select>
        <input type="date" wire:model="expiry_date" class="border p-2 w-full">
        {{-- Philippine Categories --}}
        <label class="font-semibold">Categories</label>
        <div class="flex flex-col space-y-2">
            @foreach([
            ['code' => 'A', 'desc' => 'Motorcycle'],
            ['code' => 'A1', 'desc' => 'Tricycle'],
            ['code' => 'B', 'desc' => 'Passenger Car'],
            ['code' => 'B1', 'desc' => 'Passenger Van or Jeepney'],
            ['code' => 'B2', 'desc' => 'Light Commercial Vehicle'],
            ['code' => 'C', 'desc' => 'Heavy Commercial Vehicle'],
            ['code' => 'D', 'desc' => 'Passenger Bus'],
            ['code' => 'BE', 'desc' => 'Light Articulated Vehicle'],
            ['code' => 'CE', 'desc' => 'Heavy Articulated Vehicle'],
            ] as $cat)
            <label class="flex items-center space-x-2">
                <input
                    type="checkbox"
                    wire:model="categories"
                    value="{{ $cat['code'] }}">
                <span>{{ $cat['code'] }} - {{ $cat['desc'] }}</span>
            </label>
            @endforeach
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>