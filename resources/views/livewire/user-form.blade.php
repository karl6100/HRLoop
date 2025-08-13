<fieldset>
    <div class="mb-6">
        <!-- Back Link -->
        <a href="{{ route('users.index') }}"
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
            <!-- Active Status Toggle -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Status
                </label>

                <label class="inline-flex items-center cursor-pointer">
                    <input
                        type="checkbox"
                        class="sr-only peer"
                        wire:model.live="user.deactivate"
                        @if($mode==='view' ) disabled @endif>
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

            <div class="relative w-full h-full mt-1 p-4 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full Name</label>
                <input type="text" value="{{ $user->name }}" readonly
                    class="block w-full p-2.5 text-sm text-gray-900 bg-gray-100 rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />

                <label class="block mt-4 mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                <input type="email" value="{{ $user->email }}" readonly
                    class="block w-full p-2.5 text-sm text-gray-900 bg-gray-100 rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />

                <!-- Role Selection -->
                <label class="block mt-4 mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                <select id="role" wire:model="selectedRole"
                    class="block w-full p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" @if($mode==='view' ) disabled @endif>
                    <option value="">-- Select Role --</option>
                    @foreach($roles as $role)
                    <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                    @endforeach
                </select>
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

        <div class="mt-4 flex justify-start items-center gap-4">
            @if($mode === 'edit')
            <button type="button" wire:click="save"
                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                Save Changes
            </button>

            <!-- Cancel Button (shown only in edit mode) -->
            <button
                type="button"
                wire:click="cancel"
                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                Cancel
            </button>
            @else
            <button
                type="button"
                wire:click="toggleEdit"
                class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                Edit
            </button>
            @endif
        </div>
    </div>
</fieldset>