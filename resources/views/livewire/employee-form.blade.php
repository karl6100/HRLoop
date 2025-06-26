<!-- Education Information -->
<div>
    {{-- Education Form --}}
    <div class="mb-4 mt-4 rounded p-1 transition-colors duration-300 bg-blue-100 dark:bg-gray-800">
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
                <input type="text" wire:model="educations.{{ $index }}.level_of_education" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Elementary, High School, College" />
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">School</label>
                <input type="text" wire:model="educations.{{ $index }}.school" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="School" />
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Degree</label>
                <input type="text" wire:model="educations.{{ $index }}.degree" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Primary Education, Secondary, Bachelor, Masteral, Doctorate" />
            </div>
            <div class="text-center">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Inclusive Years </label>
                <div class="flex gap-2">
                    <input type="text" wire:model="educations.{{ $index }}.start_year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Start Year" />
                    <input type="text" wire:model="educations.{{ $index }}.end_year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="End Year" />
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
    <div class="mb-4 mt-4 rounded p-1 transition-colors duration-300 bg-blue-100 dark:bg-gray-800">
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
                <input type="text" wire:model="dependents.{{ $index }}.fullname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Full Name" />
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Relationship</label>
                <input type="text" wire:model="dependents.{{ $index }}.dependent_relationship" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Relationship" />
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date of Birth</label>
                <div class="relative max-w-sm">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                        </svg>
                    </div>
                    <input
                        type="date"
                        wire:model="dependents.{{ $index }}.dependent_birth_date"
                        x-data
                        x-on:input="
                        const birthDate = new Date($el.value);
                        const today = new Date();
                        let age = today.getFullYear() - birthDate.getFullYear();
                        const m = today.getMonth() - birthDate.getMonth();
                        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) age--;
                        $refs.ageInput.value = age > 0 ? age : 0;
                    " class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                </div>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Age</label>
                <div class="flex gap-2">
                    <input
                        type="text"
                        x-ref="ageInput"
                        wire:model="dependents.{{ $index }}.dependent_age" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0" disabled />

                    <div class="flex gap-2 items-center justify-end">
                        <button wire:click="removeDependent({{ $index }})" type="button"
                            class="bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md px-3 py-2">
                            Remove
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Address Information -->

    {{-- Address Form --}}
    <div class="mb-4 mt-4 rounded p-1 transition-colors duration-300 bg-blue-100 dark:bg-gray-800">
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
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Street" />
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Barangay</label>
                <input type="text" wire:model="addresses.{{ $index }}.barangay"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Barangay" />
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
                <input type="text" wire:model="addresses.{{ $index }}.city"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="City" />
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Province</label>
                <input type="text" wire:model="addresses.{{ $index }}.province"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Province" />
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country</label>
                <input type="text" wire:model="addresses.{{ $index }}.country"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Country" />
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ZIP Code</label>
                    <input type="text" wire:model="addresses.{{ $index }}.zip_code"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Zip Code" />
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