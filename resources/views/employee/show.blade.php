<x-layouts.app :title="__('Employee')">
    <div class="relative h-full flex-1 p-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 mt-1">
        <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400">
            <li class="me-2">
                <a href="#" id="tab-profile" class="inline-block p-4 text-blue-600 bg-gray-100 rounded-t-lg active dark:bg-gray-800 dark:text-blue-500" onclick="showView('profile')">Profile</a>
            </li>
            <li class="me-2">
                <a href="#" id="tab-compensation" class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300" onclick="showView('compensation')">Compensation</a>
            </li>
            <li class="me-2">
                <a href="#" id="tab-credits" class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300" onclick="showView('credits')">Leave Credits</a>
            </li>
            <li class="me-2">
                <a href="#" id="tab-writeups" class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300" onclick="showView('contacts')">Other Information</a>
            </li>
        </ul>
        <form action="{{ route('employee.store') }}" method="POST">
            @csrf
            <div id="view-profile" class="view-section">
                <!-- Success Message and Confirmation Dialog -->
                @if (session('success'))
                <script>
                    if (confirm("{{ session('success') }}")) {
                        // Redirect to the create page if the user clicks "Yes"
                        window.location.href = "{{ route('employee.create') }}";
                    } else {
                        // Redirect to the index page if the user clicks "No"
                        window.location.href = "{{ route('employee.index') }}";
                    }
                </script>
                @endif


                <div class="mb-6">
                    <h class="text-2xl font-bold text-gray-900 dark:text-white">Personal Information</h>
                    <hr class="mt-1 border-gray-300 dark:border-gray-600">
                </div>
                <div class="grid gap-6 mb-6 md:grid-cols-4">
                    <div>
                        <label for="employee_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Employee ID</label>
                        <input type="text" name="employee_id" id="employee_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="ID" required />
                    </div>
                    <div>
                    </div>
                    <div>
                    </div>
                    <div>
                        <label for="employment_status" class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Employee Status</label>
                        <select name="employment_status" id="employment_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($employmentStatusOptions as $employmentStatus)
                            <option value="{{ $employmentStatus }}">{{ $employmentStatus }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid gap-6 mb-6 md:grid-cols-4">
                    <div>
                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                        <input type="text" name="first_name" id="first_name" value="{{ $employee->first_name }}" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" required />
                    </div>
                    <div>
                        <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
                        <input type="text" name="last_name" id="last_name" value="{{ $employee->last_name }}" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Doe" required />
                    </div>
                    <div>
                        <label for="middle_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Middle Name</label>
                        <input type="text" name="middle_name" id="middle_name" value="{{ $employee->middle_name }}" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Die" />
                    </div>
                    <div>

                        <label for="suffix" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Suffix</label>
                        <select name="suffix" id="suffix" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($suffixOptions as $suffix)
                            <option value="{{ $suffix }}" {{ (old('suffix', $employee->suffix ?? '') === $suffix) ? 'selected' : '' }}>
                                {{ $suffix }}
                            </option>
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
                            <input datepicker name="birth_date" id="birth_date" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                        </div>
                    </div>
                    <div>
                        <label for="age" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Age</label>
                        <input type="text" name="age" id="age" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value=0 disabled>
                    </div>
                    <div>
                        <label for="birth_place" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Place of Birth</label>
                        <input type="text" name="birth_place" id="birth_place" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Place of Birth" />
                    </div>
                    <div>

                        <label for="blood_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Blood Type</label>
                        <select name="blood_type" id="blood_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($bloodOptions as $bloodType)
                            <option value="{{ $bloodType }}">{{ $bloodType }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="grid gap-6 mb-6 md:grid-cols-4">
                    <div>

                        <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender</label>
                        <select name="gender" id="gender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($genderOptions as $gender)
                            <option value="{{ $gender }}">{{ $gender }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div>

                        <label for="civil_status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Civil Status</label>
                        <select name="civil_status" id="civil_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($civilStatusOptions as $status)
                            <option value="{{ $status }}">{{ $status }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div>
                        <label for="nationality" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nationality</label>
                        <input type="text" name="nationality" id="nationality" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" />
                    </div>
                    <div>
                        <label for="religion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Religion</label>
                        <input type="text" name="religion" id="religion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" />
                    </div>
                </div>
                <div class="grid gap-6 mb-6 md:grid-cols-4">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email address</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="john.doe@company.com" />
                    </div>
                    <div>
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telephone Number</label>
                        <input type="tel" name="telephone_number" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tel. Number" />
                    </div>
                    <div>
                        <label for="mobile" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mobile Number</label>
                        <input type="tel" name="mobile_number" id="mobile" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="09**-***-****" />
                    </div>
                </div>
                <div class="grid gap-6 mb-6 md:grid-cols-4">
                    <div>
                        <label for="tin_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">TIN Number</label>
                        <input type="text" name="tin_number" id="tin_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="123-456-789-000" maxlength="15" />
                    </div>
                    <div>
                        <label for="sss_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SSS Number</label>
                        <input type="text" name="sss_number" id="sss_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="123-456-7890" maxlength="12" />
                    </div>
                    <div>
                        <label for="philhealth_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">PhilHealth Number</label>
                        <input type="text" name="philhealth_number" id="philhealth_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="00-123456789-0" maxlength="14" />
                    </div>
                    <div>
                        <label for="pagibig_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pag-Ibig Number</label>
                        <input type="text" name="pagibig_number" id="pagibig_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="1234-5678-9101" maxlength="14" />
                    </div>
                </div>
                <div class="mb-6">
                </div>
                <hr class="mt-2 border-gray-300 dark:border-gray-600">
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Employment Information</h1>
                    <hr class="mt-2 border-gray-300 dark:border-gray-600">
                </div>
                <div class="grid gap-6 mb-6 md:grid-cols-4">
                    <div>
                        <label for="company" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Company</label>
                        <input type="text" name="company" id="company" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Position" required />
                    </div>
                    <div>
                        <label for="department" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department</label>
                        <input type="text" name="department" id="department" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Position" required />
                    </div>
                    <div>
                        <label for="position_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Position</label>
                        <input type="text" name="position_title" id="position_title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Position" required />
                    </div>
                    <div>

                        <label for="job_level" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Job Level</label>
                        <select name="job_level" id="job_level" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($jobLevelOptions as $jobLevel)
                            <option value="{{ $jobLevel }}">{{ $jobLevel }}</option>
                            @endforeach
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
                            <input datepicker name="hired_date" id="default-datepicker" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                        </div>
                    </div>
                </div>
                <div class="mb-6">
                </div>
                <hr class="mt-2 border-gray-300 dark:border-gray-600">
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Educational Background</h1>
                    <hr class="mt-2 border-gray-300 dark:border-gray-600">
                </div>

                <!-- Dynamic Input Section -->
                <div id="education-input-container">
                    <div class="grid gap-6 mb-6 md:grid-cols-4">
                        <div>
                            <label for="education_level" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Level of Education</label>
                            <input type="text" name="education_level[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter level of education" />
                        </div>
                        <div>
                            <label for="school" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">School</label>
                            <input type="text" name="school[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter school name" />
                        </div>
                        <div>
                            <label for="degree" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Degree</label>
                            <input type="text" name="degree[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter degree" />
                        </div>
                        <div>
                            <label for="inclusive_years" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Inclusive Years</label>
                            <div class="flex gap-2">
                                <input type="number" name="start_year[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 appearance-none [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none [moz-appearance:textfield]" placeholder="Start Year" min="1900" max="2099" />
                                <input type="number" name="end_year[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 appearance-none [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none [moz-appearance:textfield]" placeholder="End Year" min="1900" max="2099" />
                                <button type="button" class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" onclick="addInputField('education-input-container')">+</button>
                                <button type="button" class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" onclick="removeInputField(this)">-</button>
                            </div>
                        </div>
                    </div>
                </div>


                <hr class="mt-2 border-gray-300 dark:border-gray-600">
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Dependents</h1>
                    <hr class="mt-2 border-gray-300 dark:border-gray-600">
                </div>

                <div id="dependents-input-container">
                    <div class="grid gap-6 mb-6 md:grid-cols-4">
                        <div>
                            <label for="dependent_fullname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full name</label>
                            <input type="text" name="dependent_fullname[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Full name" />
                        </div>
                        <div>
                            <label for="dependent_relationship" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Relationship</label>
                            <input type="text" name="dependent_relationship[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Spouse, Son, Daughter, etc." />
                        </div>
                        <div>
                            <label for="dependent_birth_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date of Birth</label>
                            <input type="date" name="dependent_birth_date[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" />
                        </div>
                        <div>
                            <label for="dependent_age" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Age</label>
                            <div class="flex gap-2">
                                <input type="text" name="dependent_age[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0" disabled />
                                <button type="button" class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" onclick="addInputField('dependents-input-container')">+</button>
                                <button type="button" class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" onclick="removeInputField(this)">-</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                </div>
                <hr class="mt-2 border-gray-300 dark:border-gray-600">
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Address Information</h1>
                    <hr class="mt-2 border-gray-300 dark:border-gray-600">
                </div>

                <div id="address-input-container">
                    <div class="grid gap-6 mb-6 md:grid-cols-4">
                        <div>
                            <label for="street_address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Street Address</label>
                            <input type="text" name="street_address[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter street address" />
                        </div>
                        <div>
                            <label for="barangay" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Barangay</label>
                            <input type="text" name="barangay[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter barangay" />
                        </div>
                        <div>
                            <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
                            <input type="text" name="city[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter city" />
                        </div>
                        <div>
                            <label for="province" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Province</label>
                            <input type="text" name="province[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter province" />
                        </div>
                        <div>
                            <label for="zip_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Zip Code</label>
                            <input type="text" name="zip_code[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter zip code" />
                        </div>
                        <div>
                            <label for="country" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country</label>
                            <input type="text" name="country[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter country" />
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <label for="is_current" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Is Current Address?</label>
                                <input type="checkbox" name="is_current[]" class="bg-gray-50 border border-gray-300 text-blue-600 focus:ring-blue-500 focus:border-blue-500 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                                <span class="text-sm text-gray-900 dark:text-white">Yes</span>
                            </div>
                        </div>
                        <div class="flex gap-2 items-center">
                            <button type="button" class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-10 h-10 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" onclick="addInputField('address-input-container')">+</button>
                            <button type="button" class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-10 h-10 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" onclick="removeInputField(this)">-</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="view-compensation" class="view-section hidden">
                <div class="mb-6">
                    <h class="text-2xl font-bold text-gray-900 dark:text-white">Compensation Details</h>
                    <hr class="mt-1 border-gray-300 dark:border-gray-600">
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div class="relative w-full h-full mt-1  p-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                            <div class="grid gap-6 mb-6 md:grid-cols-2">
                                <div>
                                    <label for="employment_status" class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Pay Type</label>
                                    <select name="employment_status" id="employment_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        @foreach ($employeePayTypeOptions as $employeePayType)
                                        <option value="{{ $employeePayType }}">{{ $employeePayType }}</option>
                                        @endforeach
                                    </select>

                                    <label for="basic_salary" class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Basic Salary</label>
                                    <input type="number" name="basic_salary" id="numberInput" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 appearance-none [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none [moz-appearance:textfield]" placeholder="0.00" />

                                    <label for="allowance" class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Allowance</label>
                                    <input type="number" name="allowance" id="numberInput" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 appearance-none [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none [moz-appearance:textfield]" placeholder="0.00" />

                                    <label for="total_compensation" class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Total Compensation</label>
                                    <input type="number" name="total_compensation" id="numberInput" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 appearance-none [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none [moz-appearance:textfield]" placeholder="0.00" disabled />
                                </div>
                                <div>
                                    <div>
                                        <label for="hired_date" class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Effective Date</label>
                                        <div class="relative max-w-sm">
                                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                                </svg>
                                            </div>
                                            <input datepicker name="hired_date" id="default-datepicker" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Compensation Table -->
                <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Effective Date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Basic Salary
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Allowance
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Total Compensation
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Remarks
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4"></td>
                                    <td class="px-6 py-4"></td>
                                    <td class="px-6 py-4"></td>
                                    <td class="px-6 py-4"></td>
                                    <td class="px-6 py-4"></td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- Pagination Links -->
                        <div class="mt-4">

                        </div>
                    </div>
                </div>
            </div>
            <!-- Submit Button -->
            <div class="mt-6 flex justify-start">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </div>
        </form>
    </div>



    <!-- JavaScript for Dynamic Input Fields -->
    <script>
        function addInputField(containerId) {
            const container = document.getElementById(containerId);
            const newField = document.createElement('div');
            newField.className = 'grid gap-6 mb-6 md:grid-cols-4';

            // Generate fields based on the container ID
            if (containerId === 'education-input-container') {
                newField.innerHTML = `
                <div>
                    <input type="text" name="education_level[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter level of education" />
                </div>
                <div>
                    <input type="text" name="school[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter school name" />
                </div>
                <div>
                    <input type="text" name="degree[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter degree" />
                </div>
                <div>
                    <div class="flex gap-2">
                        <input type="number" name="start_year[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Start Year" min="1900" max="2099" />
                        <input type="number" name="end_year[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="End Year" min="1900" max="2099" />
                        <button type="button" class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" onclick="addInputField('${containerId}')">+</button>
                        <button type="button" class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 remove-btn" onclick="removeInputField(this, '${containerId}')">-</button>
                    </div>
                </div>
            `;
            } else if (containerId === 'dependents-input-container') {
                newField.innerHTML = `
                <div>
                    <input type="text" name="dependent_fullname[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Full name" />
                </div>
                <div>
                    <input type="text" name="dependent_relationship[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Spouse, Son, Daughter, etc." />
                </div>
                <div>
                    <input type="date" name="dependent_birth_date[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" />
                </div>
                <div class="flex gap-2 items-center">
                    <input type="text" name="dependent_age[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0" disabled />
                    <button type="button" class="inline-flex items-center justify-center text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-10 h-10 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" onclick="addInputField('${containerId}')">+</button>
                    <button type="button" class="inline-flex items-center justify-center text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-10 h-10 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 remove-btn" onclick="removeInputField(this, '${containerId}')">-</button>
                </div>
            `;
            } else if (containerId === 'address-input-container') {
                newField.innerHTML = `
                <div>
                    <label for="street_address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Street Address</label>
                    <input type="text" name="street_address[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter street address" />
                </div>
                <div>
                    <label for="barangay" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Barangay</label>
                    <input type="text" name="barangay[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter barangay" />
                </div>
                <div>
                    <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
                    <input type="text" name="city[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter city" />
                </div>
                <div>
                    <label for="province" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Province</label>
                    <input type="text" name="province[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter province" />
                </div>
                <div>
                    <label for="zip_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Zip Code</label>
                    <input type="text" name="zip_code[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter zip code" />
                </div>
                <div>
                    <label for="country" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country</label>
                    <input type="text" name="country[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter country" />
                </div>
                <div class="flex items-center gap-2">
                    <label for="is_current" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Is Current Address?</label>
                    <input type="checkbox" name="is_current[]" class="bg-gray-50 border border-gray-300 text-blue-600 focus:ring-blue-500 focus:border-blue-500 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    <span class="text-sm text-gray-900 dark:text-white">Yes</span>
                </div>
                <div class="flex gap-2 items-center">
                    <button type="button" class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-10 h-10 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" onclick="addInputField('${containerId}')">+</button>
                    <button type="button" class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-10 h-10 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 remove-btn" onclick="removeInputField(this, '${containerId}')">-</button>
                </div>
            `;
            }
            container.appendChild(newField);
            updateRemoveButtons(containerId); // Update remove button visibility
        }

        function removeInputField(button, containerId) {
            const container = document.getElementById(containerId);
            const rows = container.querySelectorAll('.grid');
            if (rows.length > 1) {
                const row = button.closest('.grid');
                row.remove();
            }
            updateRemoveButtons(containerId); // Update remove button visibility
        }

        function updateRemoveButtons(containerId) {
            const container = document.getElementById(containerId);
            const rows = container.querySelectorAll('.grid');
            const removeButtons = container.querySelectorAll('.remove-btn');

            // Hide or disable remove buttons if only one row remains
            if (rows.length === 1) {
                removeButtons.forEach(button => {
                    button.style.display = 'none'; // Hide the button
                    button.disabled = true; // Optionally disable the button
                });
            } else {
                removeButtons.forEach(button => {
                    button.style.display = 'inline-block'; // Show the button
                    button.disabled = false; // Enable the button
                });
            }
        }

        // Initial call to update remove button visibility
        document.addEventListener('DOMContentLoaded', () => {
            updateRemoveButtons('education-input-container');
            updateRemoveButtons('dependents-input-container');
            updateRemoveButtons('address-input-container');
        });
    </script>

    <script>
        // Function to format input with dashes
        function formatWithDashes(input, pattern) {
            let value = input.value.replace(/[^0-9]/g, ''); // Remove non-numeric characters
            let formattedValue = '';
            let index = 0;

            for (let i = 0; i < pattern.length; i++) {
                if (pattern[i] === '-') {
                    formattedValue += '-';
                } else {
                    if (index < value.length) {
                        formattedValue += value[index];
                        index++;
                    }
                }
            }

            input.value = formattedValue;
        }

        // Add event listeners for each input field
        document.getElementById('tin_number').addEventListener('input', function() {
            formatWithDashes(this, '123-456-789-000');
        });

        document.getElementById('sss_number').addEventListener('input', function() {
            formatWithDashes(this, '123-456-7890');
        });

        document.getElementById('philhealth_number').addEventListener('input', function() {
            formatWithDashes(this, '00-123456789-0');
        });

        document.getElementById('pagibig_number').addEventListener('input', function() {
            formatWithDashes(this, '1234-5678-9101');
        });
    </script>

    <script>
        function showView(viewId) {
            // Hide all view sections
            document.querySelectorAll('.view-section').forEach(section => {
                section.classList.add('hidden');
            });

            // Show the selected view section
            document.getElementById(`view-${viewId}`).classList.remove('hidden');

            // Remove active class from all tabs
            document.querySelectorAll('ul > li > a').forEach(tab => {
                tab.classList.remove('text-blue-600', 'bg-gray-100', 'dark:bg-gray-800', 'dark:text-blue-500');
            });

            // Add active class to the selected tab
            document.getElementById(`tab-${viewId}`).classList.add('text-blue-600', 'bg-gray-100', 'dark:bg-gray-800', 'dark:text-blue-500');
        }
    </script>

    <!-- Age Calculation Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const birthDateInput = document.getElementById('birth_date');
            const ageInput = document.getElementById('age');

            birthDateInput.addEventListener('input', function() {
                const birthDate = new Date(birthDateInput.value);
                const today = new Date();

                if (birthDateInput.value) {
                    // Compute the age
                    let age = today.getFullYear() - birthDate.getFullYear();
                    const monthDiff = today.getMonth() - birthDate.getMonth();
                    const dayDiff = today.getDate() - birthDate.getDate();

                    // Adjust age if the birthdate hasn't occurred yet this year
                    if (monthDiff < 0 || (monthDiff === 0 && dayDiff < 0)) {
                        age--;
                    }

                    // Display the computed age
                    ageInput.value = age;
                } else {
                    ageInput.value = ''; // Clear the age input if no date is selected
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dependentsContainer = document.getElementById('dependents-input-container');

            dependentsContainer.addEventListener('input', function(event) {
                if (event.target.name === 'dependent_birth_date[]') {
                    const birthDateInput = event.target;
                    const ageInput = birthDateInput.parentElement.nextElementSibling.querySelector('input[name="dependent_age[]"]');
                    const birthDate = new Date(birthDateInput.value);
                    const today = new Date();

                    if (birthDateInput.value) {
                        let age = today.getFullYear() - birthDate.getFullYear();
                        const monthDiff = today.getMonth() - birthDate.getMonth();
                        const dayDiff = today.getDate() - birthDate.getDate();

                        if (monthDiff < 0 || (monthDiff === 0 && dayDiff < 0)) {
                            age--;
                        }

                        ageInput.value = age;
                    } else {
                        ageInput.value = ''; // Clear the age input if no date is selected
                    }
                }
            });
        });
    </script>

</x-layouts.app>