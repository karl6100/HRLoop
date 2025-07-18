<fieldset @if($mode==='view' ) disabled @endif>
    {{-- Employment Form --}}
    <div class="mb-4 mt-4 rounded p-1 transition-colors duration-300 bg-blue-100 dark:bg-gray-800">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Employment Information</h1>
    </div>
    @if($mode === 'edit')
    @livewire('employee-status-form')
    @endif
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div class="relative w-full h-full mt-1  p-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <div>
                <div class="py-8">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div>
                                <p class="text-lg text-gray-900 dark:text-white">
                                    Position Title
                                </p>
                                <p class="text-lg text-gray-900 dark:text-white">Department • Company</p>
                                <p class="text-md text-gray-900 dark:text-white">Effective Date</p>
                                <p class="text-sm text-gray-900 dark:text-white">Remarks</p>
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