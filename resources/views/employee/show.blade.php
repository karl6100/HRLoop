<x-layouts.app :title="__('Employee')">
    <div class="relative h-full flex-1 p-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 mt-1">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <!-- Header -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="py-8">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            @if($employee->avatar)
                            <img src="{{ $employee->avatar }}" alt="{{ $employee->name ?? ($employee->first_name . ' ' . $employee->last_name) }}" class="w-16 h-16 rounded-full object-cover">
                            @else
                            <div class="w-16 h-16 rounded-full bg-gray-300 dark:bg-gray-600 flex items-center justify-center text-xl font-bold text-white uppercase">
                                {{ $employee->initials() }}
                            </div>
                            @endif

                            <div>
                                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                                    {{ $employee->first_name }} {{ $employee->last_name }}
                                    @if ($employee->suffix !== 'N/A')
                                    {{ $employee->suffix }}
                                    @endif
                                </h1>
                                <p class="text-lg text-gray-600">{{ $employee->position_title }} • {{ $employee->department }}</p>
                                <p class="text-sm text-gray-500">Employee ID: {{ $employee->employee_id }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Navigation -->
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
            <div id="view-profile" class="view-section">
                <div>
                    @livewire('employee-form', ['employee_id' => $employee->employee_id, 'mode' => 'view'])
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
                                    <label for="pay_type" class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Pay Type</label>
                                    <input type="text" name="pay_type" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />

                                    <label for="basic_salary" class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Basic Salary</label>
                                    <input type="number" name="basic_salary" id="numberInput" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 appearance-none [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none [moz-appearance:textfield]" placeholder="0.00" />

                                    <label for="allowance" class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Allowance</label>
                                    <input type="number" name="allowance" id="numberInput" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 appearance-none [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none [moz-appearance:textfield]" placeholder="0.00" />

                                    <label for="total_compensation" class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Total Compensation</label>
                                    <input type="number" name="total_compensation" id="numberInput" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 appearance-none [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none [moz-appearance:textfield]" placeholder="0.00" disabled />
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
                                @if($employee->employeeSalaries->count() > 0)
                                @foreach($employee->employeeSalaries as $compensation)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4">{{ $compensation->effective_date }}</td>
                                    <td class="px-6 py-4">PHP {{ number_format($compensation->basic_salary, 2) }}</td>
                                    <td class="px-6 py-4">PHP {{ number_format($compensation->allowance, 2) }}</td>
                                    <td class="px-6 py-4">PHP {{ number_format($compensation->monthly_rate, 2) }}</td>
                                    <td class="px-6 py-4">{{ $compensation->remarks }}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        <!-- Pagination Links -->
                        <div class="mt-4">

                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('employee.edit', ['employee_id' => $employee->employee_id]) }}" method="get">
                @csrf
                <!-- Edit Button -->
                <div class="mt-6 flex justify-start">
                    <button type="edit" class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">Edit</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Change input into currency layout -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const currencyInputs = document.querySelectorAll('input.currency-format');

            currencyInputs.forEach(input => {
                // Format the input value on page load
                if (input.value) {
                    input.value = formatCurrency(input.value);
                }

                // Add event listener to format the value dynamically
                input.addEventListener('input', function() {
                    const value = input.value.replace(/,/g, ''); // Remove existing commas
                    if (!isNaN(value) && value !== '') {
                        input.value = formatCurrency(value);
                    } else {
                        input.value = ''; // Clear the input if invalid
                    }
                });
            });

            // Function to format a number as currency
            function formatCurrency(value) {
                return parseFloat(value).toLocaleString('en-US', {
                    style: 'currency',
                    currency: 'PHP',
                    minimumFractionDigits: 2,
                }).replace('$', ''); // Remove the dollar sign if not needed
            }
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



</x-layouts.app>