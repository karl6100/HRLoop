<div class="mb-6">
    <h class="text-2xl font-bold text-gray-900 dark:text-white">Compensation Details</h>
    <hr class="mt-1 border-gray-300 dark:border-gray-600">
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div class="relative w-full h-full mt-1  p-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div x-data="{
                        basic: @entangle('compensation.basic_salary'),
                        allowance: @entangle('compensation.allowance'),
                        get total() {
                            return (parseFloat(this.basic) || 0) + (parseFloat(this.allowance) || 0);
                        }
                    }">
                    <!-- Pay Type -->
                    <label class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Pay Type</label>
                    <select wire:model="compensation.pay_type"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach ($employeePayTypeOptions as $employeePayType)
                        <option value="{{ $employeePayType }}">{{ $employeePayType }}</option>
                        @endforeach
                    </select>

                    <!-- Basic Salary -->
                    <label class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white ">Basic Salary</label>
                    <input type="number" x-model="basic"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 appearance-none [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none [moz-appearance:textfield]"
                        placeholder="0.00" />

                    <!-- Allowance -->
                    <label class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Allowance</label>
                    <input type="number" x-model="allowance"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 appearance-none [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none [moz-appearance:textfield]"
                        placeholder="0.00" />

                    <!-- Total Compensation -->
                    <label class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Total Compensation</label>
                    <input type="text"
                        :value="`₱${total.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        disabled />
                </div>

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
                    <div class="mt-4 flex justify-start">
                    <button
                    type="button"
                    wire:click="saveCompensation"
                    class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    Add
                </button>
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
                @foreach ($employees as $employee)
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