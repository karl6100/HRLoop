<fieldset @if($mode==='view' ) disabled @endif>
    {{-- Employment Form --}}
    <div class="mb-4 mt-4 rounded p-1 transition-colors duration-300 bg-blue-100 dark:bg-gray-800">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Employment Information</h1>
    </div>
    <div class="grid gap-2 mb-2 md:grid-cols-2">
        <div>
            <p class="text-md font-semibold text-gray-900 dark:text-white">
                Position Title History
            </p>
            @if($mode === 'edit')
            <livewire:employee-position-form :employee="$employee" />
            @endif
        </div>
        <div>
            <p class="text-md font-semibold text-gray-900 dark:text-white">
                Employment Status History
            </p>
            @if($mode === 'edit')
            <livewire:employee-status-form :employee="$employee" />
            @endif
        </div>
    </div>
    <div class="grid gap-2 mb-2 md:grid-cols-2">
        <div>
            {{-- Position Loop (Descending by effective_date) --}}
            @foreach (collect($position)->sortByDesc(fn($item) => $item['effective_date'] ?? $item->effective_date) as $positions)
            <div class="flex items-center justify-between mt-2 border border-gray-300 dark:border-gray-600 rounded-lg p-1 space-y-4">
                <div class="flex items-center space-x-4">
                    <div>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $positions['position_title'] ?? $positions->position_title ?? 'N/A' }}
                        </p>
                        <p class="text-sm text-gray-700 dark:text-gray-300">
                            {{ $positions['department'] ?? $positions->department ?? 'N/A' }}
                        </p>
                        <p class="text-sm text-gray-700 dark:text-gray-300">
                            {{ $positions['company'] ?? $positions->company ?? 'N/A' }}
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            {{ \Carbon\Carbon::parse($positions['effective_date'] ?? $positions->effective_date ?? now())->format('F d, Y') }}
                        </p>
                        <p class="text-sm italic text-gray-500 dark:text-gray-400">
                            {{ $positions['remarks'] ?? $positions->remarks ?? 'N/A' }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div>
            {{-- Status Loop (Descending by effective_date) --}}
            @foreach (collect($status)->sortByDesc(fn($item) => $item['effective_date'] ?? $item->effective_date) as $statuses)
            <div class="flex items-center justify-between mt-2 border border-gray-300 dark:border-gray-600 rounded-lg p-1 space-y-4">
                <div class="flex items-center space-x-4">
                    <div>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $statuses['employment_status'] ?? $statuses->employment_status ?? 'N/A' }}
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            {{ \Carbon\Carbon::parse($statuses['effective_date'] ?? $statuses->effective_date ?? now())->format('F d, Y') }}
                        </p>
                        <p class="text-sm italic text-gray-500 dark:text-gray-400">
                            {{ $statuses['remarks'] ?? $statuses->remarks ?? 'N/A' }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</fieldset>