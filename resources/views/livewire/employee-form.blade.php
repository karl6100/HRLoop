<div>
    <!-- Personal Information -->
    {{-- Personal Form --}}
    <div class="mb-4 mt-4 rounded p-1 transition-colors duration-300 bg-blue-100 dark:bg-gray-800">
        <h class="text-2xl font-bold text-gray-900 dark:text-white">Personal Information</h>
    </div>
    <div class="grid gap-2 mb-2 md:grid-cols-4">
        <div>
            <label for="employee_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Employee ID</label>
            <input type="text" wire:model="employees.employee_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="ID" required />
            @error('employees.employee_id')
            <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div>
        </div>
        <div>
        </div>
        <div>
            <label for="employment_status" class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Employee Status</label>
            <select name="employment_status" wire:model="employees.employment_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @foreach ($employmentStatusOptions as $employmentStatus)
                <option value="{{ $employmentStatus }}">{{ $employmentStatus }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="grid gap-2 mb-2 md:grid-cols-4">
        <div>
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
            <input type="text" wire:model="employees.first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" required />
            @error('employees.first_name')
            <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
            <input type="text" wire:model="employees.last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Doe" required />
            @error('employees.last_name')
            <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="middle_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Middle Name</label>
            <input type="text" wire:model="employees.middle_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Die" />
        </div>
        <div>
            <label for="suffix" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Suffix</label>
            <select name="suffix" wire:model="employees.suffix" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @foreach ($suffixOptions as $suffix)
                <option value="{{ $suffix }}">{{ $suffix }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="birth_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date of Birth</label>
            <div class="relative max-w-sm">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                    </svg>
                </div>
                <input datepicker wire:model="employees.birth_date" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
            </div>
        </div>
        <div>
            <label for="age" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Age</label>
            <input type="text" name="age" id="age" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value=0 disabled>
        </div>
        <div>
            <label for="birth_place" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Place of Birth</label>
            <input type="text" wire:model="employees.birth_place" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Place of Birth" />
        </div>
        <div>
            <label for="blood_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Blood Type</label>
            <select name="blood_type" wire:model="employees.blood_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @foreach ($bloodOptions as $bloodType)
                <option value="{{ $bloodType }}">{{ $bloodType }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="grid gap-2 mb-2 md:grid-cols-4">
        <div>
            <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender</label>
            <select name="gender" wire:model="employees.gender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @foreach ($genderOptions as $gender)
                <option value="{{ $gender }}">{{ $gender }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="civil_status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Civil Status</label>
            <select name="civil_status" wire:model="employees.civil_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @foreach ($civilStatusOptions as $status)
                <option value="{{ $status }}">{{ $status }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="nationality" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nationality</label>
            <input type="text" wire:model="employees.nationality" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" />
        </div>
        <div>
            <label for="religion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Religion</label>
            <input type="text" wire:model="employees.religion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" />
        </div>
    </div>
    <div class="grid gap-2 mb-2 md:grid-cols-4">
        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email address</label>
            <input type="email" wire:model="employees.email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="john.doe@company.com" />
        </div>
        <div>
            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telephone Number</label>
            <input type="tel" wire:model="employees.telephone_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tel. Number" />
        </div>
        <div>
            <label for="mobile" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mobile Number</label>
            <input type="tel" wire:model="employees.mobile_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="09**-***-****" />
        </div>
    </div>
    <div class="grid gap-2 mb-2 md:grid-cols-4">
        <div>
            <label for="tin_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">TIN Number</label>
            <input type="text" wire:model="employees.tin_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="123-456-789-000" maxlength="15" />
        </div>
        <div>
            <label for="sss_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SSS Number</label>
            <input type="text" wire:model="employees.sss_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="123-456-7890" maxlength="12" />
        </div>
        <div>
            <label for="philhealth_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">PhilHealth Number</label>
            <input type="text" wire:model="employees.philhealth_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="00-123456789-0" maxlength="14" />
        </div>
        <div>
            <label for="pagibig_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pag-Ibig Number</label>
            <input type="text" wire:model="employees.pagibig_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="1234-5678-9101" maxlength="14" />
        </div>
    </div>
    <div class="mb-4 mt-4 rounded p-1 transition-colors duration-300 bg-blue-100 dark:bg-gray-800">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Employment Information</h1>
    </div>
    <div class="grid gap-2 mb-2 md:grid-cols-4">
        <div>
            <label for="company" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Company</label>
            <input type="text" wire:model="employees.company" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Position" required />
            @error('employees.company')
            <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="department" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department</label>
            <input type="text" wire:model="employees.department" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Position" required />
            @error('employees.department')
            <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="position_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Position</label>
            <input type="text" wire:model="employees.position_title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Position" required />
            @error('employees.position_title')
            <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="job_level" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Job Level</label>
            <select name="job_level" wire:model="employees.job_level" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @foreach ($jobLevelOptions as $jobLevel)
                <option value="{{ $jobLevel }}">{{ $jobLevel }}</option>
                @endforeach
                @error('employees.job_level')
                <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </select>
        </div>
    </div>
    <div class="grid gap-6 mb-6 md:grid-cols-4">
        <div>
            <label for="hired_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date Hired</label>
            <div class="relative max-w-sm">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                    </svg>
                </div>
                <input datepicker wire:model="employees.hired_date" id="default-datepicker" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                @error('employees.hired_date')
                <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <!-- Education Information -->
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

    <!-- Submit Button -->
    <div class="mt-6 text-right flex items-center gap-4">
        <button
            type="button"
            wire:click="save"
            class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded">
            Save
        </button>

        @if (session()->has('success'))
        <div class="text-green-600 font-medium">{{ session('success') }}</div>
        @endif
    </div>
</div>
