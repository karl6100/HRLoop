<div class="p-4 border rounded">
    <h2 class="font-bold mb-2">Test Dropdown</h2>

    <label class="block mb-2">Select Role</label>
    <select wire:model="selectedRole" class="border p-2 rounded">
        <option value="">-- Choose Role --</option>
        @foreach ($roles as $role)
            <option value="{{ $role }}">{{ $role }}</option>
        @endforeach
    </select>

    <div class="mt-4">
        <strong>Debug:</strong> Selected Role = {{ $selectedRole }}
    </div>
</div>
