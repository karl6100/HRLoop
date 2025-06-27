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
                <div>
                    @livewire('employee-form')
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
                                    <label for="employee_pay_type" class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Pay Type</label>
                                    <select name="employee_pay_type" id="employee_pay_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        @foreach ($employeePayTypeOptions as $employeePayType)
                                        <option value="{{ $employeePayType }}">{{ $employeePayType }}</option>
                                        @endforeach
                                    </select>

                                    <label for="basic_salary" class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Basic Salary</label>
                                    <input type="number" name="basic_salary" id="basic_salary" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 appearance-none [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none [moz-appearance:textfield]" placeholder="0.00" />

                                    <label for="allowance" class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Allowance</label>
                                    <input type="number" name="allowance" id="allowance" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 appearance-none [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none [moz-appearance:textfield]" placeholder="0.00" />

                                    <label for="total_compensation" class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Total Compensation</label>
                                    <input type="number" name="total_compensation" id="total_compensation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 appearance-none [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none [moz-appearance:textfield]" placeholder="0.00" disabled />
                                </div>
                                <div>
                                    <div>
                                        <label for="salary_effective_date" class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Effective Date</label>
                                        <div class="relative max-w-sm">
                                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                                </svg>
                                            </div>
                                            <input datepicker name="salary_effective_date" id="default-datepicker" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                                        </div>
                                        <label for="compensation_remarks" class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Remarks</label>
                                        <textarea id="compensation_remarks" name="compensation_remarks" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const basicSalaryInput = document.getElementById('basic_salary');
            const allowanceInput = document.getElementById('allowance');
            const totalCompensationInput = document.getElementById('total_compensation');

            function calculateTotalCompensation() {
                const basicSalary = parseFloat(basicSalaryInput.value) || 0;
                const allowance = parseFloat(allowanceInput.value) || 0;

                // Calculate total compensation
                const totalCompensation = basicSalary + allowance;

                // Update the total compensation field
                totalCompensationInput.value = totalCompensation.toFixed(2);
            }

            // Add event listeners to recalculate total compensation when inputs change
            basicSalaryInput.addEventListener('input', calculateTotalCompensation);
            allowanceInput.addEventListener('input', calculateTotalCompensation);
        });
    </script>

</x-layouts.app>