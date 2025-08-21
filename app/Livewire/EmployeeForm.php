<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;


class EmployeeForm extends Component
{
    // --- Dropdown Option Lists ---
    public $suffixOptions = ['', 'Jr.', 'Sr.', 'III', 'IV', 'V'];
    public $bloodOptions = ['', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
    public $civilStatusOptions = ['', 'Single', 'Married', 'Widowed', 'Separated', 'Divorced'];
    public $genderOptions = ['', 'Male', 'Female'];
    public $jobLevelOptions = ['Rank-and-File/Staff', 'Supervisor', 'Department Manager', 'Division Manager', 'Executive', 'None'];
    public $employmentStatusOptions = ['Probationary', 'Regular', 'Temporary', 'Extra Helper', 'OJT'];
    public $employeePayTypeOptions = ['', 'Monthly', 'Daily', 'Hourly'];

    // --- Form Data Structures ---
    public $employees = [];
    public $status = [];
    public $position = [];
    public $addresses = [];
    public $educations = [];
    public $dependents = [];
    public $emergency = [];
    public $compensations = [];
    public $successMessage = '';

    /**
     * Initialize the form data when the component is mounted.
     */
    public $employee_id;
    public $email;
    public $password;
    public $employee;
    public $mode;
    public $activeTab = 'profile'; // default tab

    public function toggleEdit()
    {
        logger('toggleEdit clicked');
        $this->mode = $this->mode === 'view' ? 'edit' : 'view';
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function cancel()
    {
        if ($this->mode === 'create') {
            return redirect()->route('employee.index');
        } elseif ($this->mode === 'edit') {
            $this->mode = 'view'; // Just go back to view mode
        }
    }

    public function mount($employee_id = null, $mode = 'create')
    {
        $this->mode = $mode;

        if ($employee_id) {
            $employee = Employee::with(['employeeAddresses', 'employeeEducations', 'employeeDependents', 'employeeEmergencies', 'employeeCompensations', 'employeeStatus', 'employeePositions'])->findOrFail($employee_id);

            $this->employee = $employee;

            $this->employees = $employee->toArray();
            $this->employees['birth_date'] = optional($employee->birth_date)->format('Y-m-d');
            $this->employees['hired_date'] = optional($employee->hired_date)->format('Y-m-d');
            $this->status = $employee->employeeStatus->map(function ($stat) {
                return [
                    'employment_status' => $stat->employment_status,
                    'effective_date' => optional($stat->effective_date)->format('Y-m-d'),
                    'remarks' => $stat->remarks,
                ];
            })->toArray();
            $this->position = $employee->employeePositions->map(function ($pos) {
                return [
                    'position_title' => $pos->position_title,
                    'job_level' => $pos->job_level,
                    'department' => $pos->department,
                    'company' => $pos->company,
                    'effective_date' => optional($pos->effective_date)->format('Y-m-d'),
                    'remarks' => $pos->remarks,
                ];
            })->toArray();
            $this->addresses = $employee->employeeAddresses->toArray();
            $this->educations = $employee->employeeEducations->toArray();
            $this->emergency = $employee->employeeEmergencies->toArray();
            $this->dependents = $employee->employeeDependents->map(function ($dep) {
                return [
                    'fullname' => $dep->fullname,
                    'relationship' => $dep->relationship,
                    'dependent_birth_date' => optional($dep->dependent_birth_date)->format('Y-m-d'),
                    'age' => $dep->dependent_birth_date ? \Carbon\Carbon::parse($dep->dependent_birth_date)->age : null,
                ];
            })->toArray();

            // Load latest position and status history descending by effective_date
            $this->position = $employee->employeePositions()->orderByDesc('effective_date')->get();
            $this->status = $employee->employeeStatus()->orderByDesc('effective_date')->get();

            $this->compensations = $employee->employeeCompensations->toArray();

            // dd($this->dependents);
        } else {
            // Keep your existing initialization for 'create' mode
            $this->employees = [
                'employee_id' => '',
                'first_name' => '',
                'last_name' => '',
                'middle_name' => '',
                'suffix' => '',
                'civil_status' => '',
                'birth_date' => '',
                'birth_place' => '',
                'blood_type' => '',
                'gender' => '',
                'nationality' => '',
                'religion' => '',
                'telephone_number' => '',
                'mobile_number' => '',
                'email' => '',
                'department' => '',
                'company' => '',
                'position_title' => '',
                'job_level' => '',
                'hired_date' => '',
                'employment_status' => '',
                'sss_number' => '',
                'philhealth_number' => '',
                'pagibig_number' => '',
                'tin_number' => '',
            ];

            $this->addresses = [[
                'street' => '',
                'barangay' => '',
                'city' => '',
                'province' => '',
                'zip_code' => '',
                'country' => '',
                'is_current' => false
            ]];

            $this->educations = [[
                'education_level' => '',
                'school' => '',
                'degree' => '',
                'start_year' => '',
                'end_year' => ''
            ]];

            $this->dependents = [[
                'fullname' => '',
                'relationship' => '',
                'dependent_birth_date' => ''
            ]];

            $this->emergency = [[
                'emergency_contact_name' => '',
                'emergency_contact_relationship' => '',
                'emergency_contact_phone' => '',
                'emergency_street' => '',
                'emergency_barangay' => '',
                'emergency_city' => '',
                'emergency_province' => '',
                'emergency_zip_code' => '',
                'emergency_country' => ''
            ]];

            $this->compensations = [[
                'fkey_employee_id' => '',
                'pay_type' => '',
                'basic_salary' => '',
                'allowance' => '',
                'monthly_rate' => '',
                'effective_date' => '',
                'remarks' => '',
                'is_current' => false
            ]];

            $this->status = [[
                'employment_status' => '',
                'effective_date' => '',
                'remarks' => '',
            ]];

            $this->position = [[
                'position_title' => '',
                'job_level' => '',
                'department' => '',
                'company' => '',
                'effective_date' => '',
                'remarks' => '',
            ]];
        }
    }

    /**
     * Define validation rules for each field.
     */
    protected function rules()
    {
        $employee_id = $this->employee_id ?? null;

        return [
            'employees.employee_id' => [
                'required',
                'string',
                Rule::unique('employees', 'employee_id')->ignore($employee_id, 'employee_id'),
            ],
            'employees.first_name' => 'required|string',
            'employees.last_name' => 'required|string',
            'employees.middle_name' => 'nullable|string',
            'employees.suffix' => 'nullable|string',
            'employees.civil_status' => 'nullable|string',
            'employees.birth_date' => 'nullable|date',
            'employees.birth_place' => 'nullable|string',
            'employees.blood_type' => 'nullable|string',
            'employees.gender' => 'nullable|string',
            'employees.nationality' => 'nullable|string',
            'employees.religion' => 'nullable|string',
            'employees.telephone_number' => [
                'nullable',
                'string',
                Rule::unique('employees', 'telephone_number')->ignore($this->employee_id, 'employee_id'),
            ],
            'employee.mobile_number' => [
                'nullable',
                'string',
                Rule::unique('employees', 'mobile_number')->ignore($this->employee_id, 'employee_id'),
            ],
            'employees.email' => [
                'required',
                'string',
                'email',
                Rule::unique('employees', 'email')->ignore($this->employee_id, 'employee_id'),
            ],
            'employees.department' => 'required|string',
            'employees.company' => 'required|string',
            'employees.position_title' => 'required|string',
            'employees.job_level' => 'required|string',
            'employees.hired_date' => 'required|date',
            'employees.employment_status' => 'required|string',
            'employees.sss_number' => [
                'nullable',
                'string',
                Rule::unique('employees', 'sss_number')->ignore($this->employee_id, 'employee_id'),
            ],
            'employees.philhealth_number' => [
                'nullable',
                'string',
                Rule::unique('employees', 'philhealth_number')->ignore($this->employee_id, 'employee_id'),
            ],
            'employees.pagibig_number' => [
                'nullable',
                'string',
                Rule::unique('employees', 'pagibig_number')->ignore($this->employee_id, 'employee_id'),
            ],
            'employees.tin_number' => [
                'nullable',
                'string',
                Rule::unique('employees', 'tin_number')->ignore($this->employee_id, 'employee_id'),
            ],
            'status.employment_status' => 'nullable|string',
            'status.effective_date' => 'nullable|date',
            'status.remarks' => 'nullable|string',
            'position.position_title' => 'nullable|string',
            'position.job_level' => 'nullable|string',
            'position.department' => 'nullable|string',
            'position.company' => 'nullable|string',
            'position.effective_date' => 'nullable|date',
            'position.remarks' => 'nullable|string',
            'addresses.*.street' => 'nullable|string',
            'addresses.*.barangay' => 'nullable|string',
            'addresses.*.city' => 'nullable|string',
            'addresses.*.province' => 'nullable|string',
            'addresses.*.zip_code' => 'nullable|string',
            'addresses.*.country' => 'nullable|string',
            'addresses.*.is_current' => 'boolean',
            'educations.*.education_level' => 'nullable|string',
            'educations.*.school' => 'nullable|string',
            'educations.*.degree' => 'nullable|string',
            'educations.*.start_year' => 'nullable|date_format:Y',
            'educations.*.end_year' => 'nullable|date_format:Y',
            'dependents.*.fullname' => 'nullable|string',
            'dependents.*.relationship' => 'nullable|string',
            'dependents.*.dependent_birth_date' => 'nullable|date',
            'emergency.*.emergency_contact_name' => 'nullable|string',
            'emergency.*.emergency_contact_relationship' => 'nullable|string',
            'emergency.*.emergency_contact_phone' => 'nullable|string',
            'emergency.*.emergency_street' => 'nullable|string',
            'emergency.*.emergency_barangay' => 'nullable|string',
            'emergency.*.emergency_city' => 'nullable|string',
            'emergency.*.emergency_province' => 'nullable|string',
            'emergency.*.emergency_zip_code' => 'nullable|string',
            'emergency.*.emergency_country' => 'nullable|string',
        ];
    }
    /**
     * Custom validation error messages.
     */
    protected function messages()
    {
        return [
            'employees.employee_id.required' => 'Employee ID is required.',
            'employees.employee_id.unique' => 'This Employee ID is already taken.',
            'employees.first_name.required' => 'Please enter the first name.',
            'employees.last_name.required' => 'Please enter the last name.',
            'employees.email.required' => 'Email field is required.',
            'employees.email.email' => 'The email must be a valid email address.',
            'employees.email.unique' => 'This email is already taken.',
            'employees.department.required' => 'Department field is required.',
            'employees.company.required' => 'Company field is required.',
            'employees.position_title.required' => 'Position title is required.',
            'employees.job_level.required' => 'Job level is required.',
            'employees.hired_date.required' => 'Hired date is required.',
            'employees.telephone_number' => 'Hired date must be a valid date.',
            'employees.mobile_number.unique' => 'This mobile number is already taken.',
            'employees.sss_number.unique' => 'This SSS number is already taken.',
            'employees.philhealth_number.unique' => 'This PhilHealth number is already taken.',
            'employees.pagibig_number.unique' => 'This Pag-IBIG number is already taken.',
            'compensations.basic_salary.required' => 'The basic salary is required.',
            'compensations.basic_salary.numeric' => 'The basic salary must be a number.',
            'compensations.pay_type.required' => 'Please select a pay type.',
            'compensations.monthly_rate.required' => 'The monthly rate is required.',
            'compensations.effective_date.required' => 'The effective date is required.',
            'compensations.remarks.required' => 'Please provide remarks.',
        ];
    }

    // --- Dynamic Field Adders ---

    public function addAddress()
    {
        $this->addresses[] = [
            'street' => '',
            'barangay' => '',
            'city' => '',
            'province' => '',
            'zip_code' => '',
            'country' => '',
            'is_current' => false
        ];
    }

    public function addEducation()
    {
        $this->educations[] = [
            'education_level' => '',
            'school' => '',
            'degree' => '',
            'start_year' => '',
            'end_year' => ''
        ];
    }

    public function addDependent()
    {
        $this->dependents[] = [
            'fullname' => '',
            'relationship' => '',
            'dependent_birth_date' => ''
        ];
    }

    public function addEmergencyContact()
    {
        $this->emergency[] = [
            'emergency_contact_name' => '',
            'emergency_contact_relationship' => '',
            'emergency_contact_phone' => '',
            'emergency_street' => '',
            'emergency_barangay' => '',
            'emergency_city' => '',
            'emergency_province' => '',
            'emergency_zip_code' => '',
            'emergency_country' => ''
        ];
    }

    // --- Remove Item Functions (with reindexing) ---

    public function removeAddress($index)
    {
        unset($this->addresses[$index]);
        $this->addresses = array_values($this->addresses);
    }

    public function removeEducation($index)
    {
        unset($this->educations[$index]);
        $this->educations = array_values($this->educations);
    }

    public function removeDependent($index)
    {
        unset($this->dependents[$index]);
        $this->dependents = array_values($this->dependents);
    }

    public function removeEmergencyContact($index)
    {
        unset($this->emergency[$index]);
        $this->emergency = array_values($this->emergency);
    }

    /**
     * Save validated data into the database
     */
    public function save()
    {
        logger()->debug('💾 Save method triggered');

        // STEP 1: Sanitize input data before validation
        logger()->debug('📌 Sanitizing and validating data...');

        // Convert empty strings to null for nullable employee fields
        foreach (['birth_date', 'mobile_number', 'email', 'sss_number', 'philhealth_number', 'pagibig_number', 'tin_number'] as $field) {
            if (empty($this->employees[$field])) {
                $this->employees[$field] = null;
            }
        }

        // Convert empty dependent birth_date to null to avoid SQL error
        foreach ($this->dependents as &$dependent) {
            if (empty($dependent['dependent_birth_date'])) {
                $dependent['dependent_birth_date'] = null;
            }
        }
        // Always unset reference variable when using foreach by reference to avoid unexpected bugs
        unset($dependent);

        // STEP 2: Validate all input data based on defined rules
        try {
            $validated = $this->validate();
            logger()->debug('✅ Validation passed.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            logger()->error('❌ Validation failed:', $e->errors());
            throw $e; // Rethrow to let Livewire handle the UI error display
        }

        // STEP 3: Save Employee main data
        $employeeData = $validated['employees'];
        // dd($employeeData, $this->addresses, $this->educations, $this->dependents);
        logger()->debug('💾 Inserting employee record...');
        $employee = Employee::create($employeeData);

        // STEP 4: Create initial status/position record
        logger()->debug('🔄 Inserting employee status and position records...');
        $employee->employeeStatus()->create([
            'employment_status' => $employeeData['employment_status'],
            'effective_date' => $employeeData['hired_date'],
            'remarks'           => 'Initial employment record',
        ]);

        $employee->employeePositions()->create([
            'position_title' => $employeeData['position_title'],
            'job_level'      => $employeeData['job_level'],
            'department'     => $employeeData['department'],
            'company'        => $employeeData['company'],
            'effective_date' => $employeeData['hired_date'],
            'remarks'        => 'Initial position record',
        ]);

        // STEP 4: Save related records (addresses, education, dependents)
        logger()->debug('📦 Inserting related records...');

        // Save only non-empty addresses
        foreach ($this->addresses as $address) {
            if (
                !empty($address['street']) ||
                !empty($address['barangay']) ||
                !empty($address['city']) ||
                !empty($address['province']) ||
                !empty($address['zip_code']) ||
                !empty($address['country'])
            ) {
                $employee->employeeAddresses()->create($address);
            }
        }

        // Save only non-empty education entries
        foreach ($this->educations as $education) {
            if (
                !empty($education['education_level']) ||
                !empty($education['school']) ||
                !empty($education['degree']) ||
                !empty($education['start_year']) ||
                !empty($education['end_year'])
            ) {
                $employee->employeeEducations()->create($education);
            }
        }

        // Save only non-empty dependents
        foreach ($this->dependents as $dependent) {
            if (
                !empty($dependent['fullname']) ||
                !empty($dependent['relationship']) ||
                !empty($dependent['dependent_birth_date'])
            ) {
                $employee->employeeDependents()->create($dependent);
            }
        }

        // Save emergency contacts if provided
        foreach ($this->emergency as $contact) {
            if (
                !empty($contact['emergency_contact_name']) ||
                !empty($contact['emergency_contact_relationship']) ||
                !empty($contact['emergency_contact_phone']) ||
                !empty($contact['emergency_street']) ||
                !empty($contact['emergency_barangay']) ||
                !empty($contact['emergency_city']) ||
                !empty($contact['emergency_province']) ||
                !empty($contact['emergency_zip_code']) ||
                !empty($contact['emergency_country'])
            ) {
                $employee->employeeEmergencies()->create($contact);
            }
        }

        /// STEP 5: Create linked User account
        logger()->debug('👤 Creating user account...');
        try {
            $user = User::create([
                'name' => $employeeData['first_name'] . ' ' . $employeeData['last_name'],
                'email' => $employeeData['email'],
                'password' => Hash::make('password123'),
                'employee_id' => $employeeData['employee_id'],
            ]);

            if ($user && $user->exists) {
                logger()->debug('✅ User account created and saved to database:', $user->toArray());
            } else {
                logger()->warning('⚠️ User instance created but not saved to database.');
            }
        } catch (\Exception $e) {
            logger()->error('❌ Failed to create user account:', ['error' => $e->getMessage()]);
            session()->flash('error', 'Employee created but user account failed to create.');
        }
        // STEP 6: Notify UI of success
        logger()->debug('✅ All data saved successfully.');
        session()->flash('success', 'Employee saved successfully!');
        $this->successMessage = 'Saved successfully';

        $this->employee_id = $employee->employee_id; // Set ID for viewing

        return redirect()->route('employee.show', ['employee_id' => $this->employee_id]);
        // $this->mode = 'view'; // Switch to view mode
        // $this->mount($employee->employee_id, 'view'); // Reload data for newly saved employee
    }

    /**
     * Render the Livewire view
     */
    public function render()
    {
        logger('Rendering employee form');
        return view('livewire.employee-form');
    }

    public function update()
    {
        logger()->debug('✏️ Update method triggered');

        // STEP 1: Sanitize input data before validation
        logger()->debug('📌 Sanitizing and validating data...');

        foreach (['birth_date', 'mobile_number', 'email', 'sss_number', 'philhealth_number', 'pagibig_number', 'tin_number'] as $field) {
            if (empty($this->employees[$field])) {
                $this->employees[$field] = null;
            }
        }

        foreach ($this->dependents as &$dependent) {
            if (empty($dependent['dependent_birth_date'])) {
                $dependent['dependent_birth_date'] = null;
            }
        }
        unset($dependent);

        // STEP 2: Validate
        try {
            $validated = $this->validate();
            logger()->debug('✅ Validation passed.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            logger()->error('❌ Validation failed:', $e->errors());
            throw $e;
        }

        // STEP 3: Update main employee record
        $employee = Employee::findOrFail($this->employee_id);
        $employee->update($validated['employees']);
        logger()->debug('✏️ Employee main data updated.');

        // STEP 4: Sync related data
        logger()->debug('🔄 Syncing related data...');

        // Addresses
        $employee->employeeAddresses()->delete();
        foreach ($this->addresses as $address) {
            if (
                !empty($address['street']) ||
                !empty($address['barangay']) ||
                !empty($address['city']) ||
                !empty($address['province']) ||
                !empty($address['zip_code']) ||
                !empty($address['country'])
            ) {
                $employee->employeeAddresses()->create($address);
            }
        }

        // Educations
        $employee->employeeEducations()->delete();
        foreach ($this->educations as $education) {
            if (
                !empty($education['education_level']) ||
                !empty($education['school']) ||
                !empty($education['degree']) ||
                !empty($education['start_year']) ||
                !empty($education['end_year'])
            ) {
                $employee->employeeEducations()->create($education);
            }
        }

        // Dependents
        $employee->employeeDependents()->delete();
        foreach ($this->dependents as $dependent) {
            if (
                !empty($dependent['fullname']) ||
                !empty($dependent['relationship']) ||
                !empty($dependent['dependent_birth_date'])
            ) {
                $employee->employeeDependents()->create($dependent);
            }
        }

        // Emergency Contacts
        $employee->employeeEmergencies()->delete();
        foreach ($this->emergency as $contact) {
            if (
                !empty($contact['emergency_contact_name']) ||
                !empty($contact['emergency_contact_relationship']) ||
                !empty($contact['emergency_contact_phone']) ||
                !empty($contact['emergency_street']) ||
                !empty($contact['emergency_barangay']) ||
                !empty($contact['emergency_city']) ||
                !empty($contact['emergency_province']) ||
                !empty($contact['emergency_zip_code']) ||
                !empty($contact['emergency_country'])
            ) {
                $employee->employeeEmergencies()->create($contact);
            }
        }

        // STEP 5: Success Feedback
        logger()->debug('✅ Update complete.');
        session()->flash('success', 'Employee updated successfully!');
        $this->successMessage = 'Updated successfully';

        $this->mode = 'view'; // Switch to view mode
        $this->mount($this->employee_id, 'view'); // Reload data from DB
    }

    public function deleteEmployee()
    {
        $employee = Employee::findOrFail($this->employee_id);

        $employee->delete();

        session()->flash('success', 'Employee deleted successfully.');

        // Optionally refresh the employee list
        $this->employees = Employee::all();

        // Redirect to index
        return redirect()->route('employee.index');
    }

    protected function rulesCompensation()
    {
        return [
            'compensations.pay_type'       => 'required|string',
            'compensations.basic_salary'   => 'required|numeric|min:0',
            'compensations.allowance'      => 'nullable|numeric|min:0',
            'compensations.monthly_rate'   => 'required|numeric|min:0',
            'compensations.effective_date' => 'required|date',
            'compensations.remarks'        => 'required|string',
            // 'compensations.is_current'     => 'required|boolean',
        ];
    }

    public function saveCompensation()
    {
        logger()->debug('💵 Saving single employee compensation...');

        try {
            $validated = $this->validate($this->rulesCompensation());
            logger()->debug('✅ Compensation validation passed.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            logger()->error('❌ Compensation validation failed:', $e->errors());
            throw $e;
        }
        // Trap: convert "" to null for numeric fields
        if ($this->compensations['allowance'] === '') {
            $this->compensations['allowance'] = null;
        }

        $this->compensations['monthly_rate'] =
            floatval($this->compensations['basic_salary']) + floatval($this->compensations['allowance'] ?? 0);


        $employee = Employee::findOrFail($this->employee_id);

        // Compute monthly_rate if not present
        $this->compensations['monthly_rate'] = floatval($this->compensations['basic_salary']) + floatval($this->compensations['allowance']);


        $employee->employeeCompensations()->create($this->compensations);

        session()->flash('success', 'Employee compensation saved successfully.');
        $this->successMessage = 'Compensation saved successfully';

        // Optionally reload the view with latest data
        $this->mount($employee->employee_id, 'edit');
    }

    public function deleteCompensation($compensationId)
    {
        $employee = Employee::findOrFail($this->employee_id);

        $compensation = $employee->employeeCompensations()->find($compensationId);

        if ($compensation) {
            $compensation->delete();
            session()->flash('success', 'Compensation deleted successfully.');
        } else {
            session()->flash('error', 'Compensation not found.');
        }

        // Re-fetch the latest compensations
        $this->compensations = $employee->employeeCompensations()->orderByDesc('effective_date')->get();
        $this->successMessage = 'Compensation deleted successfully.';
    }
}
