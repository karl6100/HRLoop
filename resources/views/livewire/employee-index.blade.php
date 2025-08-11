<div>
    <div>
        <div class="py-4">
            <div class="flex items-center justify-start space-x-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Employee Management</h1>
                    <p class="text-lg text-gray-600 dark:text-gray-400">Manage your team members and their information.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-wrap sm:flex-nowrap items-center justify-between pb-4 space-y-4 sm:space-y-0 w-full">
        <!-- Left: Add Employee -->
        <div>
            <button onclick="window.location='{{ route('employee.create') }}'" method="GET"
                type="submit"
                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                Add Employee
            </button>
        </div>

        <!-- Right: Search Input and Button -->
        <div class="flex items-center justify-end space-x-2 w-full sm:w-auto">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 
                          4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <input type="text"
                    wire:model.defer="searchQuery"
                    placeholder="Search employees..."
                    class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <button wire:click="performSearch"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Search
            </button>

            <!-- Toggle View Button -->
            <div class="inline-flex rounded-md shadow-xs" role="group">
                <button wire:click="$set('viewMode', 'list')" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border border-gray-900 rounded-s-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="#9e9e9e"
                        stroke-width="1"
                        stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M9 6l11 0" />
                        <path d="M9 12l11 0" />
                        <path d="M9 18l11 0" />
                        <path d="M5 6l0 .01" />
                        <path d="M5 12l0 .01" />
                        <path d="M5 18l0 .01" />
                    </svg>
                </button>
                <button wire:click="$set('viewMode', 'tile')" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border border-gray-900 rounded-e-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="#9e9e9e"
                        stroke-width="1"
                        stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                        <path d="M14 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                        <path d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                        <path d="M14 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                    </svg>
                </button>
            </div>
        </div>


    </div>

    @if ($viewMode === 'list')
    <div class="relative flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Employee Number
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Department
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Position
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Company
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($employees as $employee)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-2 py-2">{{ $employee->employee_id }}</td>
                        <td class="px-2 py-2">
                            {{ $employee->first_name }} {{ $employee->last_name }}
                            @if ($employee->suffix !== '')
                            {{ $employee->suffix }}
                            @endif
                        </td>
                        <td class="px-2 py-2">{{ $employee->department }}</td>
                        <td class="px-2 py-2">{{ $employee->position_title }}</td>
                        <td class="px-2 py-2">{{ $employee->company }}</td>
                        <td class="px-2 py-2">
                            <div class="flex gap-4">
                                <!-- view -->
                                <button onclick="window.location='{{ route('employee.show', $employee->employee_id) }}'" type="button"
                                    class="hover:bg-green-100 dark:hover:bg-green-900 text-white text-sm font-medium rounded-md px-1 py-1 cursor-pointer">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="28"
                                        height="28"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="#009688"
                                        stroke-width="1"
                                        stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                    </svg>
                                </button>
                                <!-- edit -->
                                <button onclick="window.location='{{ route('employee.edit', $employee->employee_id) }}'" type="button"
                                    class="hover:bg-yellow-100 dark:hover:bg-yellow-600 text-white text-sm font-medium rounded-md px-1 py-1 cursor-pointer">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="28"
                                        height="28"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="#ffcc00"
                                        stroke-width="1"
                                        stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                        <path d="M16 5l3 3" />
                                    </svg>
                                </button>
                                <!-- delete -->
                                <form action="{{ route('employee.destroy', $employee->employee_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this employee?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="hover:bg-red-100 dark:hover:bg-red-900 text-white text-sm font-medium rounded-md px-1 py-1 cursor-pointer">
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
                                            <path d="M4 7l16 0" />
                                            <path d="M10 11l0 6" />
                                            <path d="M14 11l0 6" />
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            No records found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @endif

    @if ($viewMode === 'tile')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
        @forelse ($employees as $employee)
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow p-4">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                {{ $employee->first_name }} {{ $employee->last_name }}
            </h3>
            <p class="text-gray-500 dark:text-gray-400">
                {{ $employee->position_title }} at {{ $employee->company }}
            </p>
            <p class="text-sm text-gray-600 dark:text-gray-300">Department: {{ $employee->department }}</p>
            <div class="mt-3 flex items-center gap-2">
                <a href="{{ route('employee.show', $employee->employee_id) }}"
                    class="text-sm text-green-600 hover:underline">View</a>
                <a href="{{ route('employee.edit', $employee->employee_id) }}"
                    class="text-sm text-yellow-600 hover:underline">Edit</a>
                <form action="{{ route('employee.destroy', $employee->employee_id) }}" method="POST"
                    onsubmit="return confirm('Are you sure?');" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="text-sm text-red-600 hover:underline">Delete</button>
                </form>
            </div>
        </div>
        @empty
        <p class="text-center text-gray-500 dark:text-gray-400 col-span-full">No records found.</p>
        @endforelse
    </div>
    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $employees->links() }}
    </div>
    @endif

    <div class="mt-4">
        <button onclick="window.location='{{ route('employee.create') }}'" method="GET"
            type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Add Employee</button>
    </div>
</div>