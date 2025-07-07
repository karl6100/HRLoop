<x-layouts.app :title="__('Employee')">
    <!-- Header -->
    <div>
        <div class="py-4">
            <div class="flex items-center justify-start space-x-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Employee Management</h1>
                    <p class="text-lg text-gray-600">Manage your team members and their information.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
        <div>
            <div>
                <button onclick="window.location='{{ route('employee.create') }}'" method="GET"
                    type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">+ Add Employee</button>
            </div>
        </div>
        <div>

        </div>
        <label for="table-search" class="sr-only">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <input type="text" id="table-search" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
        </div>
    </div>

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
                    @foreach ($employees as $employee)
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
                                        width="32"
                                        height="32"
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
                                        width="32"
                                        height="32"
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
                                <button type="button"
                                    class="hover:bg-red-100 dark:hover:bg-red-900 text-white text-sm font-medium rounded-md px-1 py-1 cursor-pointer">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="32"
                                        height="32"
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
                            </div>
                        </td>
                    </tr>
                    </a>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $employees->links() }}
        </div>
    </div>
    <div class="mt-4">
        <button onclick="window.location='{{ route('employee.create') }}'" method="GET"
            type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">+ Add Employee</button>
    </div>
</x-layouts.app>