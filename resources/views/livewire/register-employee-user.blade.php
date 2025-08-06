<div>
    <form wire:submit.prevent="register">
        <div>
            <label for="employee">Select Employee</label>
            <select wire:model="employee_id" id="employee">
                <option value="">-- Select --</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->employee_id }}">{{ $employees->first_name }} {{ $employees->last_name }}</option>
                @endforeach
            </select>
            @error('employee_id') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" wire:model="email">
            @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" wire:model="password">
            @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit">Register</button>
    </form>
</div>
