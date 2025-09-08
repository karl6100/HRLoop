<div>
    {{-- Tab Navigation --}}
    <ul class="flex border-b text-sm font-medium text-center text-gray-500 dark:text-gray-400">
        <li class="mr-2">
            <a href="#" wire:click.prevent="setActiveTab('profile')"
                class="inline-flex items-center gap-2 p-4 rounded-t-lg {{ $activeTab === 'profile' ? 'text-blue-600 bg-gray-100 dark:bg-gray-800 dark:text-blue-500' : 'hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300' }}">
                <x-heroicon-o-user class="h-5 w-5" />
                Profile
            </a>
        </li>
        @can('employees-compensation.view')
        <li class="mr-2">
            <a href="#" wire:click.prevent="setActiveTab('compensation')"
                class="inline-flex items-center gap-2 p-4 rounded-t-lg {{ $activeTab === 'compensation' ? 'text-blue-600 bg-gray-100 dark:bg-gray-800 dark:text-blue-500' : 'hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300' }}">
                <x-heroicon-o-currency-dollar class="h-5 w-5" />  
                Compensation
            </a>
        </li>
        @endcan
        @if ($mode !== 'create')
        @can('employees-employment-info.view')
        <li class="mr-2">
            <a href="#" wire:click.prevent="setActiveTab('employment-info')"
                class="inline-flex items-center gap-2 p-4 rounded-t-lg {{ $activeTab === 'employment-info' ? 'text-blue-600 bg-gray-100 dark:bg-gray-800 dark:text-blue-500' : 'hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300' }}">
                <x-heroicon-o-document-text class="h-5 w-5" />
                Employment Information
            </a>
        </li>
        @endcan
        @can('employees-drivers-license.view')  
        <li class="mr-2">
            <a href="#" wire:click.prevent="setActiveTab('drivers-license')"
                class="inline-flex items-center gap-2 p-4 rounded-t-lg {{ $activeTab === 'drivers-license' ? 'text-blue-600 bg-gray-100 dark:bg-gray-800 dark:text-blue-500' : 'hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300' }}">
                <x-heroicon-o-identification class="h-5 w-5" />
                Drivers License
            </a>
        </li>
        @endcan
        @endif
    </ul>
    {{-- Tab Content --}}
    <div class="mt-4">
        @if ($activeTab === 'profile')
        @include('livewire.employee-tabs.profile')
        @elseif ($activeTab === 'compensation')
        @include('livewire.employee-tabs.compensation')
        @elseif ($activeTab === 'employment-info')
        @include('livewire.employee-tabs.employment-info')
        @elseif ($activeTab === 'drivers-license')
        @include('livewire.employee-tabs.drivers-license')
        @endif
    </div>

    <!-- Toggle button for switching modes -->
    <div class="mt-6 mb-2 flex items-center gap-4">
        @if($mode === 'create')
        <!-- Save Button (visible only in create mode) -->
        @can('employees.create')
        <button
            type="button"
            wire:click="save"
            class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
            Save
        </button>
        @endcan
        @elseif($mode === 'edit')
        <!-- Update Button (visible only in edit mode) -->
        @if ($activeTab === 'profile')
        @can('employees.edit')
        <button
            type="button"
            wire:click="update"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Update
        </button>
        @endcan
        @endif
        @else
        <!-- View Mode: Edit + Delete aligned at far ends -->
        <div class="flex w-full items-center justify-between">
            <!-- Edit Button (left-aligned) -->
            <button
                type="button"
                wire:click="toggleEdit"
                class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                Edit
            </button>

            <!-- Delete Button (right-aligned) -->
            <div x-data>
                @can('employees.delete')
                <button
                    @click="if (confirm('Are you sure you want to delete this employee?')) { $wire.deleteEmployee() }"
                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                    type="button">
                    Delete Employee
                </button>
                @endcan
            </div>
        </div>
        @endif

        <!-- Cancel Button (shown only in create or edit mode) -->
        @if($mode !== 'view')
        <button
            type="button"
            wire:click="cancel"
            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
            Cancel
        </button>
        @endif
    </div>


    </fieldset>

    {{-- Success Toast --}}
    <div
        x-data="{ show: @entangle('successMessage').defer }"
        x-show="show"
        x-init="if (show) setTimeout(() => show = false, 3000)"
        x-transition
        class="fixed bottom-4 right-4 z-50">
        <div id="toast-success"
            class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-sm dark:text-gray-400 dark:bg-gray-800"
            role="alert">
            <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ms-3 text-sm font-normal" x-text="$wire.successMessage"></div>
            <button
                type="button"
                @click="show = false"
                class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 14 14">
                    <path d="M1 1l6 6m0 0l6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    </div>
    <script>
        window.addEventListener('toast-error', event => {
            const msg = event.detail.message;
            // Dynamically show toast using JS or Alpine logic
            alert(msg); // Or insert into DOM
        });
    </script>
</div>