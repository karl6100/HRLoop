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
                        <form action="{{ route('employee.destroy', $employee->employee_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this employee?');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
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