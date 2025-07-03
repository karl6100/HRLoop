<x-layouts.app :title="__('Employee')">
    <div class="relative h-full flex-1 p-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 mt-1">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <!-- Header -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
                                <p class="text-sm text-gray-500">Employee ID: {{ $employee->employee_id }}</p>
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