<div>
    <!-- Header -->
    <div class="py-4">
        <div class="flex items-center justify-start space-x-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Roles and Permissions Management</h1>
                <p class="text-lg text-gray-600 dark:text-gray-400">Manage your application roles and permissions.</p>
            </div>
        </div>
    </div>

    <!-- Controls: Search + Toggle View -->
    <div class="flex flex-wrap sm:flex-nowrap items-center justify-between pb-4 space-y-4 sm:space-y-0 w-full">
        <div><!-- Left: Add Employee -->
            <button onclick="window.location='{{ route('roles.create') }}'" method="GET"
                type="submit"
                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                Add Roles
            </button>
        </div>

        <!-- Right: Search Input and Button + Toggle -->
        <div class="flex items-center justify-end space-x-2 w-full sm:w-auto">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </div>

                <input
                    type="text"
                    wire:model.defer="searchQuery"
                    placeholder="Search roles..."
                    class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <button wire:click="performSearch"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Search
            </button>
        </div>
    </div>

    <div class="relative flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">#</th>
                        <th scope="col" class="px-6 py-3">Role</th>
                        <th scope="col" class="px-6 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roles as $role)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-3">{{ $roles->firstItem() + $loop->index }}</td>
                        <td class="px-6 py-3">{{ $role->name }}</td>
                        <td class="px-6 py-3 text-center">
                            <div class="flex items-center justify-center gap-3">
                                <!-- view -->
                                <a href="{{ route('roles.show', $role->id) }}" class="p-1 rounded-md hover:bg-green-100 dark:hover:bg-green-900" title="View">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#009688" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M10 12a2 2 0 1 0 4 0 2 2 0 0 0-4 0" />
                                        <path d="M21 12c-2.4 4-5.4 6-9 6s-6.6-2-9-6c2.4-4 5.4-6 9-6s6.6 2 9 6" />
                                    </svg>
                                </a>

                                <!-- edit -->
                                <a href="{{ route('roles.edit', $role->id) }}" class="p-1 rounded-md hover:bg-yellow-100 dark:hover:bg-yellow-600" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#ffcc00" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1" />
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 9.999V13h3l8.385-8.415z" />
                                        <path d="M16 5l3 3" />
                                    </svg>
                                </a>
                                <!-- delete -->

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">No records found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination Links for tile -->
    <div class="mt-4">
        {{ $roles->links() }}
    </div>
    <div class="mt-4">
        <button onclick="window.location='{{ route('roles.create') }}'" method="GET"
            type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Add Roles</button>
    </div>
</div>