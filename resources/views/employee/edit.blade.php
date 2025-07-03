<x-layouts.app :title="__('Employee')">
    <div class="relative h-full flex-1 p-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 mt-1">
        <div>
            @livewire('employee-form', ['employee_id' => $employee->employee_id, 'mode' => 'edit'])
        </div>
</x-layouts.app>