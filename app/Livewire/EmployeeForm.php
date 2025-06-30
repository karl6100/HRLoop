<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;

class EmployeeForm extends Component
{
    // --- Dropdown Option Lists ---
    public $suffixOptions = ['', 'Jr.', 'Sr.', 'III', 'IV', 'V'];
    public $bloodOptions = ['', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
    public $civilStatusOptions = ['', 'Single', 'Married', 'Widowed', 'Separated', 'Divorced'];
    public $genderOptions = ['', 'Male', 'Female'];
    public $jobLevelOptions = ['Rank-and-File/Staff', 'Supervisor', 'Department Manager', 'Division Manager', 'Executive', 'None'];
    public $employmentStatusOptions = ['Probationary', 'Regular', 'Contractual', 'Casual', 'Job Order'];
    public $employeePayTypeOptions = ['', 'Monthly', 'Daily', 'Hourly'];

    // --- Form Data Structures ---
    public $employeeId;
    public $employees = [];
    public $addresses = [];
    public $educations = [];
    public $dependents = [];
    public $successMessage = '';

    /**
     * Initialize the form data when the component is mounted.
     */
    public $mode = 'create';

    public function mount($employee_id = null, $mode = 'create')
    {
        $this->mode = $mode;

        if ($employee_id) {
            $employee = Employee::with(['employeeAddresses', 'employeeEducations', 'employeeDependents'])->findOrFail($employee_id);

            $this->employees = $employee->toArray();            
            $this->addresses = $employee->employeeAddresses->toArray();
            $this->educations = $employee->employeeEducations->toArray();

            $this->dependents = $employee->employeeDependents->map(function ($dep) {
                return [
                    'fullname' => $dep->fullname,
                    'relationship' => $dep->relationship,
                    'dependent_birth_date' => optional($dep->dependent_birth_date)->format('m/d/Y'),
                ];
            })->toArray();
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
                'emergency_contact_name' => '',
                'emergency_contact_relationship' => '',
                'emergency_contact_number' => ''
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
        }
    }

    /**
     * Define validation rules for each field.
     */
    protected function rules()
    {
        return [
            'employees.employee_id' => 'required|string|unique:employees,employee_id',
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
            'employees.telephone_number' => 'nullable|string',
            'employees.mobile_number' => 'nullable|string|unique:employees,mobile_number',
            'employees.email' => 'nullable|string|email|unique:employees,email',
            'employees.department' => 'required|string',
            'employees.company' => 'required|string',
            'employees.position_title' => 'required|string',
            'employees.job_level' => 'required|string',
            'employees.hired_date' => 'required|date',
            'employees.employment_status' => 'required|string',
            'employees.sss_number' => 'nullable|string|unique:employees,sss_number',
            'employees.philhealth_number' => 'nullable|string|unique:employees,philhealth_number',
            'employees.pagibig_number' => 'nullable|string|unique:employees,pagibig_number',
            'employees.tin_number' => 'nullable|string|unique:employees,tin_number',
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
            'employees.emergency_contact_name' => 'nullable|string',
            'employees.emergency_contact_relationship' => 'nullable|string',
            'employees.emergency_contact_number' => 'nullable|string',
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
        logger()->debug('💾 Inserting employee record...');
        $employee = Employee::create($employeeData);

        // STEP 4: Save related records (addresses, education, dependents)
        logger()->debug('📦 Inserting related records...');

        foreach ($this->addresses as $address) {
            $employee->employeeAddresses()->create($address);
        }

        foreach ($this->educations as $education) {
            $employee->employeeEducations()->create($education);
        }

        foreach ($this->dependents as $dependent) {
            $employee->employeeDependents()->create($dependent);
        }

        // STEP 5: Notify UI of success
        logger()->debug('✅ All data saved successfully.');
        session()->flash('success', 'Employee saved successfully!');
        $this->successMessage = 'Saved successfully';
        $this->mount(); // reset form
    }

    /**
     * Render the Livewire view
     */
    public function render()
    {
        logger('Rendering employee form');
        return view('livewire.employee-form');
    }


    public function show($employee_id)
    {
        $this->employeeId = $employee_id;
        $employee = Employee::with(['employeeAddresses', 'employeeEducations', 'employeeDependents'])->findOrFail($employee_id);

        $this->employees = [
            'employee_id' => $employee->employee_id,
            'first_name' => $employee->first_name,
            'last_name' => $employee->last_name,
            'middle_name' => $employee->middle_name,
            'suffix' => $employee->suffix,
            'civil_status' => $employee->civil_status,
            'birth_date' => optional($employee->birth_date)->format('m/d/Y'),
            'birth_place' => $employee->birth_place,
            'blood_type' => $employee->blood_type,
            'gender' => $employee->gender,
            'nationality' => $employee->nationality,
            'religion' => $employee->religion,
            'telephone_number' => $employee->telephone_number,
            'mobile_number' => $employee->mobile_number,
            'email' => $employee->email,
            'department' => $employee->department,
            'company' => $employee->company,
            'position_title' => $employee->position_title,
            'job_level' => $employee->job_level,
            'hired_date' => optional($employee->hired_date)->format('m/d/Y'),
            'employment_status' => $employee->employment_status,
            'sss_number' => $employee->sss_number,
            'philhealth_number' => $employee->philhealth_number,
            'pagibig_number' => $employee->pagibig_number,
            'tin_number' => $employee->tin_number,
            'emergency_contact_name' => $employee->emergency_contact_name,
            'emergency_contact_relationship' => $employee->emergency_contact_relationship,
            'emergency_contact_number' => $employee->emergency_contact_number,
        ];

        $this->addresses = $employee->employeeAddresses->map(function ($address) {
            return [
                'street' => $address->street,
                'barangay' => $address->barangay,
                'city' => $address->city,
                'province' => $address->province,
                'zip_code' => $address->zip_code,
                'country' => $address->country,
                'is_current' => $address->is_current,
            ];
        })->toArray();

        $this->educations = $employee->employeeEducations->map(function ($edu) {
            return [
                'education_level' => $edu->education_level,
                'school' => $edu->school,
                'degree' => $edu->degree,
                'start_year' => $edu->start_year,
                'end_year' => $edu->end_year,
            ];
        })->toArray();

        $this->dependents = $employee->employeeDependents->map(function ($dep) {
            return [
                'fullname' => $dep->fullname,
                'relationship' => $dep->relationship,
                'dependent_birth_date' => optional($dep->dependent_birth_date)->format('m/d/Y'),
            ];
        })->toArray();
    }
}
