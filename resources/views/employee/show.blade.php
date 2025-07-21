<x-layouts.app :title="__('Employee')">
    <div class="relative h-full flex-1 p-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 mt-1">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <!-- Back Link -->
            <a href="{{ route('employee.index') }}"
                class="flex items-center space-x-2 dark:text-white text-gray-600 hover:text-gray-900 transition-colors mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span>Back to Directory</span>
            </a>
            <!-- Header -->
            <div class="w-full px-4 sm:px-6 lg:px-8">

                <div class="py-8">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            @if($employee->avatar)
                            <img src="{{ $employee->avatar }}" alt="{{ $employee->name ?? ($employee->first_name . ' ' . $employee->last_name) }}" class="w-16 h-16 rounded-full object-cover">
                            @else
                            <div class="w-16 h-16 rounded-full bg-gray-300 dark:bg-gray-600 flex items-center justify-center text-xl font-bold text-white uppercase">
                                {{ $employee->initials() }}
                            </div>
                            @endif

                            <div>
                                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                                    {{ $employee->first_name }} {{ $employee->last_name }}
                                    @if ($employee->suffix !== 'N/A')
                                    {{ $employee->suffix }}
                                    @endif
                                </h1>
                                <p class="text-lg text-gray-600">{{ $employee->position_title }} • {{ $employee->department }}</p>
                                <p class="text-lg text-gray-600">{{ $employee->company }}</p>
                                <p class="text-sm text-gray-500">Employee ID: {{ $employee->employee_id }}</p>
                                <p class="text-sm text-gray-500">Employment Status: {{ $employee->employment_status }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                @livewire('employee-form', ['employee_id' => $employee->employee_id, 'mode' => 'view'])
            </div>
        </div>
</x-layouts.app>