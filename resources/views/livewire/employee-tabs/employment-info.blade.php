<fieldset @if($mode==='view' ) disabled @endif>
    {{-- Employment Form --}}
    <pre>{{ var_dump($position) }}</pre>
    <div class="mb-4 mt-4 rounded p-1 transition-colors duration-300 bg-blue-100 dark:bg-gray-800">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Employment Information</h1>
    </div>
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div>
            @if($mode === 'edit')
            @livewire('employee-position-form')
            @endif
        </div>
        <div>
            @if($mode === 'edit')
            @livewire('employee-status-form')
            @endif
        </div>
    </div>
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div class="relative w-full h-full mt-1  p-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <div>
                <div class="py-8">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div>
                                <div class="space-y-1">
                                    <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                        {{ $position['position_title'] ?? $position->position_title ?? 'N/A' }}
                                    </p>

                                    <p class="text-sm text-gray-700 dark:text-gray-300">
                                        {{ $position['department'] ?? $position->department ?? 'N/A' }}
                                    </p>

                                    <p class="text-sm text-gray-700 dark:text-gray-300">
                                        {{ $position['company'] ?? $position->company ?? 'N/A' }}
                                    </p>

                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ \Carbon\Carbon::parse($position['effective_date'] ?? $position->effective_date ?? now())->format('F d, Y') }}
                                    </p>
                                    <p class="text-sm italic text-gray-500 dark:text-gray-400">
                                        {{ $position['remarks'] ?? $position->remarks ?? 'N/A' }}
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="relative w-full h-full mt-1  p-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <div>
                <div class="py-8">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div>
                                <p class="text-lg text-gray-900 dark:text-white">
                                    Employment Status
                                </p>
                                <p class="text-sm text-gray-900 dark:text-white">Effective Date</p>
                                <p class="text-sm text-gray-900 dark:text-white">Remarks</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</fieldset>