<div>
    <!-- Header -->
    <div class="py-4">
        <div class="flex items-center justify-start space-x-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">User Management</h1>
                <p class="text-lg text-gray-600 dark:text-gray-400">Manage your application users and their access.</p>
            </div>
        </div>
    </div>

    <!-- Controls: Search + Toggle View -->
    <div class="flex flex-wrap sm:flex-nowrap items-center justify-between pb-4 space-y-4 sm:space-y-0 w-full">
        <!-- Left: (Empty - no Add button as requested) -->
        <div></div>

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
                    placeholder="Search users..."
                    class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <button wire:click="performSearch"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Search
            </button>

            <!-- Toggle View Button -->
            <div class="inline-flex rounded-md shadow-xs" role="group">
                <button type="button" wire:click="$set('viewMode','list')"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border border-gray-900 rounded-s-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 dark:border-white dark:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                    <!-- list icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#9e9e9e" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 6h11" />
                        <path d="M9 12h11" />
                        <path d="M9 18h11" />
                        <path d="M5 6h.01" />
                        <path d="M5 12h.01" />
                        <path d="M5 18h.01" />
                    </svg>
                </button>
                <button type="button" wire:click="$set('viewMode','tile')"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border border-gray-900 rounded-e-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 dark:border-white dark:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                    <!-- tile icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#9e9e9e" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="4" y="4" width="6" height="6" rx="1" />
                        <rect x="14" y="4" width="6" height="6" rx="1" />
                        <rect x="4" y="14" width="6" height="6" rx="1" />
                        <rect x="14" y="14" width="6" height="6" rx="1" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- LIST VIEW -->
    @if ($viewMode === 'list')
    <div class="relative flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">#</th>
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Role(s)</th>
                        <th scope="col" class="px-6 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-3">{{ $users->firstItem() + $loop->index }}</td>
                        <td class="px-6 py-3">{{ $user->name }}</td>
                        <td class="px-6 py-3">{{ $user->email }}</td>
                        <td class="px-6 py-3">
                            {{ $user->roles->pluck('name')->join(', ') ?: '—' }}
                        </td>
                        <td class="px-6 py-3 text-center">
                            <div class="flex items-center justify-center gap-3">
                                <!-- view -->
                                <a href="{{ route('users.show', $user->id) }}" class="p-1 rounded-md hover:bg-green-100 dark:hover:bg-green-900" title="View">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#009688" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M10 12a2 2 0 1 0 4 0 2 2 0 0 0-4 0" />
                                        <path d="M21 12c-2.4 4-5.4 6-9 6s-6.6-2-9-6c2.4-4 5.4-6 9-6s6.6 2 9 6" />
                                    </svg>
                                </a>

                                <!-- edit -->
                                <a href="{{ route('users.edit', $user->id) }}" class="p-1 rounded-md hover:bg-yellow-100 dark:hover:bg-yellow-600" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#ffcc00" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1" />
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 9.999V13h3l8.385-8.415z" />
                                        <path d="M16 5l3 3" />
                                    </svg>
                                </a>

                                <!-- delete -->
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1 rounded-md hover:bg-red-100 dark:hover:bg-red-900" title="Deactivate">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="28"
                                            height="28"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="#ff3b30"
                                            stroke-width="1"
                                            stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" />
                                            <path d="M19 19m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                            <path d="M17 21l4 -4" />
                                        </svg>

                                    </button>
                                </form>
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
    @endif

    <!-- TILE VIEW -->
    @if ($viewMode === 'tile')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
        @forelse ($users as $user)
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow p-4">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $user->name }}</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
            <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">Roles: {{ $user->roles->pluck('name')->join(', ') ?: '—' }}</p>

            <div class="mt-3 flex items-center gap-3">
                <a href="{{ route('users.show', $user->id) }}" class="text-sm text-green-600 hover:underline">View</a>
                <a href="{{ route('users.edit', $user->id) }}" class="text-sm text-yellow-600 hover:underline">Edit</a>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-sm text-red-600 hover:underline">Deactivate</button>
                </form>
            </div>
        </div>
        @empty
        <p class="text-center text-gray-500 dark:text-gray-400 col-span-full">No records found.</p>
        @endforelse
    </div>

    <!-- Pagination Links for tile -->
    <div class="mt-4">
        {{ $users->links() }}
    </div>
    @endif
</div>