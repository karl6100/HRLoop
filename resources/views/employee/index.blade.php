<x-layouts.app :title="__('Employee')">
    <form action="{{ route('employee.create') }}" method="GET" class="mb-2">
        @csrf
        <div class="mt-6">
            <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Create</button>
        </div>
    </form>
    <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
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
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $employee->first_name }} {{ $employee->last_name }}
                            @if ($employee->suffix !== 'N/A')
                            {{ $employee->suffix }}
                            @endif
                        </th>
                        <td class="px-6 py-4">{{ $employee->department }}</td>
                        <td class="px-6 py-4">{{ $employee->position_title }}</td>
                        <td class="px-6 py-4 text-right">{{ $employee->company }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $employees->links() }}
            </div>
        </div>

    </div>
</x-layouts.app>