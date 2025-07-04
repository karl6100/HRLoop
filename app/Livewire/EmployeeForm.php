<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;
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
    public $addresses = [];
    public $educations = [];
    public $dependents = [];
    public $emergency = [];
    public $successMessage = '';

    /**
     * Initialize the form data when the component is mounted.
     */
    public $employee_id;
    public $employee;
    public $mode = 'create';
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
            $employee = Employee::with(['employeeAddresses', 'employeeEducations', 'employeeDependents', 'employeeEmergencies'])->findOrFail($employee_id);

            $this->employees = $employee->toArray();
            $this->employees['birth_date'] = optional($employee->birth_date)->format('Y-m-d');
            $this->employees['hired_date'] = optional($employee->hired_date)->format('Y-m-d');
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
                'emergency_contact_phone' => ''
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
                'nullable',
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
            'emergency_contact_phone' => ''
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
                !empty($contact['emergency_contact_phone'])
            ) {
                $employee->employeeEmergencies()->create($contact);
            }
        }

        // STEP 5: Notify UI of success
        logger()->debug('✅ All data saved successfully.');
        session()->flash('success', 'Employee saved successfully!');
        $this->successMessage = 'Saved successfully';

        $this->employee_id = $employee->employee_id; // Set ID for viewing
        $this->mode = 'view'; // Switch to view mode
        $this->mount($employee->employee_id, 'view'); // Reload data for newly saved employee
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
                !empty($contact['emergency_contact_phone'])
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


    // public function show($employee_id)
    // {

    //     $this->employeeId = $employee_id;
    //     $employee = Employee::with(['employeeAddresses', 'employeeEducations', 'employeeDependents','employeeEmergencies'])->findOrFail($employee_id);
    //     $this->employees = [
    //         'employee_id' => $employee->employee_id,
    //         'first_name' => $employee->first_name,
    //         'last_name' => $employee->last_name,
    //         'middle_name' => $employee->middle_name,
    //         'suffix' => $employee->suffix,
    //         'civil_status' => $employee->civil_status,
    //         'birth_date' => optional($employee->birth_date),
    //         'birth_place' => $employee->birth_place,
    //         'blood_type' => $employee->blood_type,
    //         'gender' => $employee->gender,
    //         'nationality' => $employee->nationality,
    //         'religion' => $employee->religion,
    //         'telephone_number' => $employee->telephone_number,
    //         'mobile_number' => $employee->mobile_number,
    //         'email' => $employee->email,
    //         'department' => $employee->department,
    //         'company' => $employee->company,
    //         'position_title' => $employee->position_title,
    //         'job_level' => $employee->job_level,
    //         'hired_date' => optional($employee->hired_date),
    //         'employment_status' => $employee->employment_status,
    //         'sss_number' => $employee->sss_number,
    //         'philhealth_number' => $employee->philhealth_number,
    //         'pagibig_number' => $employee->pagibig_number,
    //         'tin_number' => $employee->tin_number,
    //     ];

    //     $this->addresses = $employee->employeeAddresses->map(function ($address) {
    //         return [
    //             'street' => $address->street,
    //             'barangay' => $address->barangay,
    //             'city' => $address->city,
    //             'province' => $address->province,
    //             'zip_code' => $address->zip_code,
    //             'country' => $address->country,
    //             'is_current' => $address->is_current,
    //         ];
    //     })->toArray();

    //     $this->educations = $employee->employeeEducations->map(function ($edu) {
    //         return [
    //             'education_level' => $edu->education_level,
    //             'school' => $edu->school,
    //             'degree' => $edu->degree,
    //             'start_year' => $edu->start_year,
    //             'end_year' => $edu->end_year,
    //         ];
    //     })->toArray();

    //     $this->dependents = $employee->employeeDependents->map(function ($dep) {
    //         return [
    //             'fullname' => $dep->fullname,
    //             'relationship' => $dep->relationship,
    //             'dependent_birth_date' => optional($dep->dependent_birth_date)->format('m/d/Y'),
    //         ];
    //     })->toArray();

    //     $this->emergency = $employee->emergency->map(function ($emer) {
    //         return [
    //             'emergency_contact_name' => $emer->emergency_contact_name,
    //             'emergency_contact_relationship' => $emer->emergency_contact_relationship,
    //             'emergency_contact_phone' => $emer->emergency_contact_phone,
    //         ];
    //     })->toArray();
    // }

    // public function edit($employee_id)
    // {
    //     $this->mode = 'edit';
    //     $this->employeeId = $employee_id;

    //     $employee = Employee::with(['employeeAddresses', 'employeeEducations', 'employeeDependents','employeeEmergencies'])->findOrFail($employee_id);

    //     $this->employees = [
    //         'employee_id' => $employee->employee_id,
    //         'first_name' => $employee->first_name,
    //         'last_name' => $employee->last_name,
    //         'middle_name' => $employee->middle_name,
    //         'suffix' => $employee->suffix,
    //         'civil_status' => $employee->civil_status,
    //         'birth_date' => optional($employee->birth_date)->format('Y-m-d'),
    //         'birth_place' => $employee->birth_place,
    //         'blood_type' => $employee->blood_type,
    //         'gender' => $employee->gender,
    //         'nationality' => $employee->nationality,
    //         'religion' => $employee->religion,
    //         'telephone_number' => $employee->telephone_number,
    //         'mobile_number' => $employee->mobile_number,
    //         'email' => $employee->email,
    //         'department' => $employee->department,
    //         'company' => $employee->company,
    //         'position_title' => $employee->position_title,
    //         'job_level' => $employee->job_level,
    //         'hired_date' => optional($employee->hired_date)->format('Y-m-d'),
    //         'employment_status' => $employee->employment_status,
    //         'sss_number' => $employee->sss_number,
    //         'philhealth_number' => $employee->philhealth_number,
    //         'pagibig_number' => $employee->pagibig_number,
    //         'tin_number' => $employee->tin_number,
    //     ];

    //     $this->addresses = $employee->employeeAddresses->toArray();

    //     $this->educations = $employee->employeeEducations->toArray();

    //     $this->dependents = $employee->employeeDependents->map(function ($dep) {
    //         return [
    //             'fullname' => $dep->fullname,
    //             'relationship' => $dep->relationship,
    //             'dependent_birth_date' => optional($dep->dependent_birth_date)->format('Y-m-d'),
    //             'age' => $dep->dependent_birth_date ? \Carbon\Carbon::parse($dep->dependent_birth_date)->age : null,
    //         ];
    //     })->toArray();

    //     $this->emergency = $employee->employeeEmergencies->map(function ($emer) {
    //         return [
    //             'emergency_contact_name' => $emer->emergency_contact_name,
    //             'emergency_contact_relationship' => $emer->emergency_contact_relationship,
    //             'emergency_contact_phone' => $emer->emergency_contact_phone,
    //         ];
    //     })->toArray();
    // }
}
