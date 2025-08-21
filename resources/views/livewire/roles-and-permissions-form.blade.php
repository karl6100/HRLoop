<fieldset>
    <div class="mb-6">
        <!-- Back Link -->
        <a href="{{ route('roles.index') }}"
            class="flex items-center space-x-2 dark:text-white text-gray-600 hover:text-gray-900 transition-colors mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span>Back</span>
        </a>
        <!-- Header -->
        <div class="mb-4 mt-4 rounded p-1 transition-colors duration-300 bg-blue-100 dark:bg-gray-800">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                Manage Roles & Permissions
            </h1>
        </div>

        <!-- User Info Card -->
        <div class="grid gap-6 mb-6">
            <div class="relative w-full h-full mt-1 p-4 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role Name</label>
                <input
                    type="text"
                    wire:model.defer="name"
                    class="block w-full p-2.5 text-sm text-gray-900 bg-gray-100 rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white
        @error('name') border-red-500 dark:border-red-500 @enderror"
                    @if($mode!=='create' ) disabled @endif />

                <!-- Error message -->
                @error('name')
                <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Permissions -->
            <div class="relative w-full h-full mt-1 p-4 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <h2 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Permissions</h2>
                <div class="grid grid-cols-1 gap-1">
                    @foreach($permissions as $permission)
                    <label class="flex items-center p-2 bg-gray-50 rounded-lg dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer">
                        <input type="checkbox" wire:model="selectedPermissions"
                            value="{{ $permission->name }}"
                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" @if($mode==='view' ) disabled @endif>
                        <span class="ml-2 text-sm text-gray-900 dark:text-gray-300">{{ ucfirst($permission->name) }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Save Button -->

        <!-- Toggle button for switching modes -->
        <div class="mt-6 mb-2 flex items-center gap-4">
            @if($mode === 'create')
            <!-- Save Button (visible only in create mode) -->
            <button
                type="button"
                wire:click="save"
                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                Save
            </button>
            @elseif($mode === 'edit')
            <!-- Save button (reused for edit mode) -->
            <button
                type="button"
                wire:click="save"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Update
            </button>
            @else
            <!-- View Mode: Edit + Delete aligned at far ends -->
            <div class="flex w-full items-center justify-between">
                <!-- Edit Button (left-aligned) -->
                <button
                    type="button"
                    wire:click="toggleEdit"
                    class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                    Edit
                </button>

                <!-- Delete Button (right-aligned) -->
                <div x-data>
                    <button
                        @click="if (confirm('Are you sure you want to delete this employee?')) { $wire.delete() }"
                        class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                        type="button">
                        Delete Role
                    </button>
                </div>
            </div>
            @endif

            <!-- Cancel Button (shown only in create or edit mode) -->
            @if($mode !== 'view')
            <button
                type="button"
                wire:click="cancel"
                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                Cancel
            </button>
            @endif
        </div>
    </div>
</fieldset>