<?php

namespace App\Livewire;

use Livewire\Component;

class EmployeeForm extends Component
{
    public $addresses = [];
    public $educations = [];
    public $dependents = [];

    public function mount()
    {
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
    // Example: $key = "2.birth_date"
    if (str_ends_with($key, 'dependent_birth_date')) {
        [$index, $field] = explode('.', $key);
        $birthDate = $this->dependents[$index]['dependent_birth_date'];

        if ($birthDate) {
            $this->dependents[$index]['age'] = \Carbon\Carbon::parse($birthDate)->age;
        } else {
            $this->dependents[$index]['age'] = '';
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

    public function render()
    {
        logger('Rendering employee form');
        return view('livewire.employee-form');
    }
}
