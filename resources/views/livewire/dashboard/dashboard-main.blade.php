    <div class="flex flex-col gap-6">
        {{-- Top Stats --}}
        <div class="grid gap-6 md:grid-cols-3">
            <div class="p-6 rounded-2xl shadow bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-medium text-neutral-600 dark:text-neutral-300">Total Employees</h3>
                    <x-heroicon-o-user class="h-5 w-5 text-blue-500" />
                </div>
                <p class="mt-3 text-2xl font-semibold text-neutral-900 dark:text-neutral-100">{{ $totalEmployees }}</p>
                <p class="text-sm text-green-600 dark:text-green-400">+4 this month</p>
            </div>
            <div class="p-6 rounded-2xl shadow bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-medium text-neutral-600 dark:text-neutral-300">Active Departments</h3>
                    <x-heroicon-o-building-office class="h-5 w-5 text-purple-500" />
                </div>
                <p class="mt-3 text-2xl font-semibold text-neutral-900 dark:text-neutral-100">8</p>
                <p class="text-sm text-neutral-500">HR, IT, Sales, etc.</p>
            </div>

            <div class="p-6 rounded-2xl shadow bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-medium text-neutral-600 dark:text-neutral-300">Attendance Today</h3>
                    <x-heroicon-o-calendar class="h-5 w-5 text-green-500" />
                </div>
                <p class="mt-3 text-2xl font-semibold text-neutral-900 dark:text-neutral-100">138 / 152</p>
                <p class="text-sm text-red-500">14 absent</p>
            </div>
        </div>

        {{-- Charts / Widgets --}}
        <div class="grid gap-6 md:grid-cols-2">
            <div class="p-6 rounded-2xl shadow bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-700">
                <h3 class="text-base font-semibold text-neutral-900 dark:text-neutral-100 mb-4">Employee Growth</h3>
            </div>

            <div class="p-6 rounded-2xl shadow bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-700">
                <h3 class="text-base font-semibold text-neutral-900 dark:text-neutral-100 mb-4">Department Breakdown</h3>
            </div>
        </div>

        {{-- Recent Activity --}}
        <div class="p-6 rounded-2xl shadow bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-700">
            <h3 class="text-base font-semibold text-neutral-900 dark:text-neutral-100 mb-4">Recent Employee Activity</h3>
            <ul class="divide-y divide-neutral-200 dark:divide-neutral-700">
                <li class="py-3 flex justify-between text-sm">
                    <span class="text-neutral-700 dark:text-neutral-300">Juan Dela Cruz - Promoted to Supervisor</span>
                    <span class="text-neutral-500">2d ago</span>
                </li>
                <li class="py-3 flex justify-between text-sm">
                    <span class="text-neutral-700 dark:text-neutral-300">Maria Santos - New Hire (HR)</span>
                    <span class="text-neutral-500">5d ago</span>
                </li>
                <li class="py-3 flex justify-between text-sm">
                    <span class="text-neutral-700 dark:text-neutral-300">John Doe - Resigned</span>
                    <span class="text-neutral-500">1w ago</span>
                </li>
            </ul>
        </div>
    </div>
