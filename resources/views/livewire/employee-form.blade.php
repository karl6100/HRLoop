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
                <option value="">-- Select Employment Status --</option>
                @foreach ($employmentStatusOptions as $employmentStatus)
                <option value="{{ $employmentStatus }}">{{ $employmentStatus }}</option>
                @endforeach
                @error('employees.employment_status')
                <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
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
                <input
                    type="date"
                    wire:model="employees.birth_date"
                    x-data
                    x-ref="birthDateInput"
                    x-init="
                        if ($el.value) {
                            const birthDate = new Date($el.value);
                            const today = new Date();
                            let age = today.getFullYear() - birthDate.getFullYear();
                            const m = today.getMonth() - birthDate.getMonth();
                            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) age--;
                            $refs.ageInput.value = age > 0 ? age : 0;
                        }
                    "
                                    x-on:input="
                        const birthDate = new Date($el.value);
                        const today = new Date();
                        let age = today.getFullYear() - birthDate.getFullYear();
                        const m = today.getMonth() - birthDate.getMonth();
                        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) age--;
                        $refs.ageInput.value = age > 0 ? age : 0;
                    "
                    value="{{ \Carbon\Carbon::parse($employees['birth_date'] ?? '')->format('Y-m-d') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Select date" />
            </div>
        </div>
        <div>
            <label for="age" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Age</label>
            <input type="text" x-ref="ageInput" name="age" id="age" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value=0 disabled>
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
            @error('employees.email')
            <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telephone Number</label>
            <input type="tel" wire:model="employees.telephone_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tel. Number" />
            @error('employees.telephone_number')
            <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="mobile" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mobile Number</label>
            <input type="tel" wire:model="employees.mobile_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="09**-***-****" />
            @error('employees.mobile_number')
            <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="grid gap-2 mb-2 md:grid-cols-4">
        <div>
            <label for="tin_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">TIN Number</label>
            <input type="text" wire:model="employees.tin_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="123-456-789-000" maxlength="15" />
            @error('employees.tin_number')
            <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="sss_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SSS Number</label>
            <input type="text" wire:model="employees.sss_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="123-456-7890" maxlength="12" />
            @error('employees.sss_number')
            <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="philhealth_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">PhilHealth Number</label>
            <input type="text" wire:model="employees.philhealth_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="00-123456789-0" maxlength="14" />
            @error('employees.philhealth_number')
            <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="pagibig_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pag-Ibig Number</label>
            <input type="text" wire:model="employees.pagibig_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="1234-5678-9101" maxlength="14" />
            @error('employees.pagibig_number')
            <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
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
                <option value="">-- Select Job Level --</option>
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
                <input type="text" wire:model="educations.{{ $index }}.education_level" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Elementary, High School, College" />
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
                <div class="flex gap-2 items-center mt-2 justify-end">
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
        <div class="grid gap-2 mb-1 mt-1 md:grid-cols-3">
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full Name</label>
                <input type="text" wire:model="dependents.{{ $index }}.fullname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Full Name" />
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Relationship</label>
                <input type="text" wire:model="dependents.{{ $index }}.relationship" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Relationship" />
            </div>

            <div x-data="{ 
                    calculateAge(e) {
                        const birthDate = new Date(e.target.value);
                        const today = new Date();
                        let age = today.getFullYear() - birthDate.getFullYear();
                        const m = today.getMonth() - birthDate.getMonth();
                        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) age--;
                        this.$refs.dependentAgeInput.value = age > 0 ? age : 0;
                    } 
                }">
                <div class="grid gap-2 md:grid-cols-2">
                    <div>
                        <label for="birth_date_{{ $index }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Date of Birth
                        </label>
                        <input
                            id="dependent_birth_date_{{ $index }}"
                            type="date"
                            wire:model="dependents.{{ $index }}.dependent_birth_date"
                            x-on:input="calculateAge"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Select date" />
                    </div>

                    <div>
                        <label for="dependent_age_{{ $index }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Age
                        </label>
                        <input
                            id="dependent_age_{{ $index }}"
                            type="text"
                            x-ref="dependentAgeInput"
                            wire:model="dependents.{{ $index }}.age"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="0" disabled />
                    </div>
                </div>
            </div>
        </div>
        <div class="flex gap-2 items-center justify-end">
            <button wire:click="removeDependent({{ $index }})" type="button"
                class="bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md px-3 py-2">
                Remove
            </button>
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
    </div>
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