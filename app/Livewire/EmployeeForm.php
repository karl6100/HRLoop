<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class EmployeeForm extends Component
{
    public $suffixOptions = ['', 'Jr.', 'Sr.', 'III', 'IV', 'V'];
    public $bloodOptions = ['', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
    public $civilStatusOptions = ['', 'Single', 'Married', 'Widowed', 'Separated', 'Divorced'];
    public $genderOptions = ['', 'Male', 'Female'];
    public $jobLevelOptions = ['Rank-and-File/Staff', 'Supervisor', 'Department Manager', 'Division Manager', 'Executive', 'None'];
    public $employmentStatusOptions = ['Probationary', 'Regular', 'Contractual', 'Casual', 'Job Order'];
    public $employeePayTypeOptions = ['', 'Monthly', 'Daily', 'Hourly'];

    public $employees = [];
    public $addresses = [];
    public $educations = [];
    public $dependents = [];

    public function mount()
    {
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

        $this->addresses = [
            [
                'street' => '',
                'barangay' => '',
                'city' => '',
                'province' => '',
                'zip_code' => '',
                'country' => '',
                'is_current' => false,
            ]
        ];

        $this->educations = [
            [
                'level_of_education' => '',
                'school' => '',
                'degree' => '',
                'start_year' => '',
                'end_year' => '',
            ]
        ];

        $this->dependents = [
            [
                'fullname' => '',
                'dependent_relationship' => '',
                'dependent_birth_date' => '',
            ]
        ];
    }

    protected function rules()
    {
        return [
            'employees.employee_id' => 'required|string',
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
        ];
    }

    public function addAddress()
    {
        $this->addresses[] = [
            'street' => '',
            'barangay' => '',
            'city' => '',
            'province' => '',
            'zip_code' => '',
            'country' => '',
            'is_current' => false,
        ];
    }

    public function addEducation()
    {
        $this->educations[] = [
            'level_of_education' => '',
            'school' => '',
            'degree' => '',
            'start_year' => '',
            'end_year' => '',
        ];
    }

    public function addDependent()
    {
        $this->dependents[] = [
            'fullname' => '',
            'dependent_relationship' => '',
            'dependent_birth_date' => '',
        ];
    }

    public function updatedDependents($value, $key)
    {
        if (str_ends_with($key, 'dependent_birth_date')) {
            [$index, $field] = explode('.', $key);
            $birthDate = $this->dependents[$index]['dependent_birth_date'] ?? null;

            if ($birthDate) {
                $this->dependents[$index]['dependent_age'] = Carbon::parse($birthDate)->age;
            } else {
                $this->dependents[$index]['dependent_age'] = null;
            }
        }
    }

    public function removeAddress($index)
    {
        unset($this->addresses[$index]);
        $this->addresses = array_values($this->addresses); // reindex
    }

    public function removeEducation($index)
    {
        unset($this->educations[$index]);
        $this->educations = array_values($this->educations); // reindex
    }

    public function removeDependent($index)
    {
        unset($this->dependents[$index]);
        $this->dependents = array_values($this->dependents); // reindex
    }

    public function save()
    {
        // Example validation (adjust rules as needed)
        $validated = $this->validate();

        // Store employee
        $employee = \App\Models\Employee::create($this->employees);

        // Store addresses
        foreach ($this->addresses as $address) {
            $employee->addresses()->create($address);
        }

        // Store educations
        foreach ($this->educations as $education) {
            $employee->educations()->create($education);
        }

        // Store dependents
        foreach ($this->dependents as $dependent) {
            $employee->dependents()->create($dependent);
        }

        session()->flash('success', 'Employee saved successfully!');
    }

    public function render()
    {
        logger('Rendering employee form');
        return view('livewire.employee-form');
    }
}
