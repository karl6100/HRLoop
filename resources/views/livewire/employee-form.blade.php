<!-- Education Information -->
<div>
    {{-- Education Form --}}
    <div class="mb-2 rounded bg-blue-100 p-1">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Educational Background</h1>
    </div>
    <div class="flex items-center justify-end mb-4">
        <button
            type="button"
            wire:click="addEducation"
            class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4v16m8-8H4" />
            </svg>
            Add Education
        </button>
    </div>
    @foreach ($this->educations as $index => $education)
    <div class="mt-2 border border-gray-300 dark:border-gray-600 rounded-lg p-1 space-y-4">
        <div class="grid gap-2 mb-1 mt-1 md:grid-cols-4">
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Level of Education</label>
                <input type="text" wire:model="educations.{{ $index }}.level_of_education"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">School</label>
                <input type="text" wire:model="educations.{{ $index }}.school"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Degree</label>
                <input type="text" wire:model="educations.{{ $index }}.degree"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
            </div>
            <div class="text-center">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Inclusive Years </label>
                <div class="flex gap-2">
                    <input type="text" wire:model="educations.{{ $index }}.start_year"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="Start Year" />
                    <input type="text" wire:model="educations.{{ $index }}.end_year"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="End Year" />
                </div>
                <div class="flex gap-2 items-center mt-4 justify-end">
                    <button wire:click="removeEducation({{ $index }})" type="button"
                        class="bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md px-3 py-2">
                        Remove
                    </button>
                </div>
            </div>
        </div>
    </div>
        @endforeach

        <!-- Dependent Information -->
        {{-- Dependent Form --}}
        <div class="mb-4 mt-4 rounded bg-blue-100 p-1">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Dependents</h1>
        </div>
        <div class="flex items-center justify-end mb-4">
            <button
                type="button"
                wire:click="addDependent"
                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v16m8-8H4" />
                </svg>
                Add Dependent
            </button>
        </div>
        @foreach ($this->dependents as $index => $dependent)
        <div class="mt-2 border border-gray-300 dark:border-gray-600 rounded-lg p-1 space-y-4">
            <div class="grid gap-2 mb-1 mt-1 md:grid-cols-4">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full Name</label>
                    <input type="text" wire:model="dependents.{{ $index }}.fullname"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Relationship</label>
                    <input type="text" wire:model="dependents.{{ $index }}.dependent_relationship"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date of Birth</label>
                    <input type="text" wire:model="dependents.{{ $index }}.dependent_birth_date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
                </div>
                <div class="flex gap-2 items-center mt-4 justify-end">
                    <button wire:click="removeDependent({{ $index }})" type="button"
                        class="bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md px-3 py-2">
                        Remove
                    </button>
                </div>
            </div>
        </div>
        @endforeach

        <!-- Address Information -->

        {{-- Address Form --}}
        <div class="mb-4 mt-4 rounded bg-blue-100 p-1">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Address Information</h1>

        </div>
        <div class="flex items-center justify-end mb-4">
            <button
                type="button"
                wire:click="addAddress"
                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v16m8-8H4" />
                </svg>
                Add Address
            </button>
        </div>
        @foreach ($this->addresses as $index => $address)
        <div class="mt-2 border border-gray-300 dark:border-gray-600 rounded-lg p-1 space-y-4">
            <div class="grid gap-2 mb-2 mt-1 md:grid-cols-4">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Street Address</label>
                    <input type="text" wire:model="addresses.{{ $index }}.street"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Barangay</label>
                    <input type="text" wire:model="addresses.{{ $index }}.barangay"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
                    <input type="text" wire:model="addresses.{{ $index }}.city"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Province</label>
                    <input type="text" wire:model="addresses.{{ $index }}.province"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ZIP Code</label>
                    <input type="text" wire:model="addresses.{{ $index }}.zip_code"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country</label>
                    <input type="text" wire:model="addresses.{{ $index }}.country"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
                </div>
                <div class="flex items-center gap-2 mt-4">
                    <label class="flex items-center text-sm text-gray-700 dark:text-white">
                        <input type="checkbox" wire:model="addresses.{{ $index }}.is_current"
                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" />
                        <span class="ml-2">Primary Address</span>
                    </label>
                </div>
                <div class="flex gap-2 items-center mt-8 justify-end">
                    <button wire:click="removeAddress({{ $index }})" type="button"
                        class="bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md px-3 py-2">
                        Remove
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
