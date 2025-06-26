<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;

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

    public function render()
    {
        logger('Rendering employee form');
        return view('livewire.employee-form');
    }
}
