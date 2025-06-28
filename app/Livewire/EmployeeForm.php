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
    public $employees = [];
    public $addresses = [];
    public $educations = [];
    public $dependents = [];

    /**
     * Initialize the form data when the component is mounted.
     */
    public function mount()
    {
        // Initialize employee data with default empty values
        $this->employees = [
            'employee_id' => '', 'first_name' => '', 'last_name' => '', 'middle_name' => '',
            'suffix' => '', 'civil_status' => '', 'birth_date' => '', 'birth_place' => '',
            'blood_type' => '', 'gender' => '', 'nationality' => '', 'religion' => '',
            'telephone_number' => '', 'mobile_number' => '', 'email' => '',
            'department' => '', 'company' => '', 'position_title' => '', 'job_level' => '',
            'hired_date' => '', 'employment_status' => '',
            'sss_number' => '', 'philhealth_number' => '', 'pagibig_number' => '', 'tin_number' => ''
        ];

        // Initialize with one blank address
        $this->addresses = [[
            'street' => '', 'barangay' => '', 'city' => '', 'province' => '',
            'zip_code' => '', 'country' => '', 'is_current' => false
        ]];

        // Initialize with one blank education
        $this->educations = [[
            'level_of_education' => '', 'school' => '', 'degree' => '',
            'start_year' => '', 'end_year' => ''
        ]];

        // Initialize with one blank dependent
        $this->dependents = [[
            'fullname' => '', 'dependent_relationship' => '', 'dependent_birth_date' => ''
        ]];
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
            'dependents.*.birth_date' => 'nullable|date',
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
        ];
    }

    // --- Dynamic Field Adders ---

    public function addAddress()
    {
        $this->addresses[] = [
            'street' => '', 'barangay' => '', 'city' => '', 'province' => '',
            'zip_code' => '', 'country' => '', 'is_current' => false
        ];
    }

    public function addEducation()
    {
        $this->educations[] = [
            'level_of_education' => '', 'school' => '', 'degree' => '',
            'start_year' => '', 'end_year' => ''
        ];
    }

    public function addDependent()
    {
        $this->dependents[] = [
            'fullname' => '', 'dependent_relationship' => '', 'dependent_birth_date' => ''
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
    // Validate form data
    $validated = $this->validate();

    // Save employee main info using validated data
    $employee = Employee::create($validated['$employees']);

    // Save employee's addresses
    foreach ($this->addresses as $address) {
        $employee->addresses()->create($address);
    }

    // Save employee's educations
    foreach ($this->educations as $education) {
        $employee->educations()->create($education);
    }

    // Save employee's dependents
    foreach ($this->dependents as $dependent) {
        $employee->dependents()->create($dependent);
    }

    // Flash a success message
    session()->flash('success', 'Employee saved successfully!');
}


    /**
     * Render the Livewire view
     */
    public function render()
    {
        logger('Rendering employee form');
        return view('livewire.employee-form');
    }
}

