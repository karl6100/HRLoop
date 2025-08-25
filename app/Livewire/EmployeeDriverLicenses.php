<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;
use App\Models\DriverLicense;
use App\Models\DriverLicenseCategory;

class EmployeeDriverLicenses extends Component
{
    public Employee $employee;

    public $license_number, $license_type, $expiry_date;
    public $categories = []; // array of selected categories

    protected $rules = [
        'license_number' => 'required|string|unique:driver_licenses,license_number',
        'license_type'   => 'required|string',
        'expiry_date'    => 'required|date',
        'categories'     => 'required|array|min:1',
    ];

    public function mount(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function save()
    {
        $this->validate();

        $license = $this->employee->driverLicenses()->create([
            'license_number' => $this->license_number,
            'license_type'   => $this->license_type,
            'expiry_date'    => $this->expiry_date,
        ]);
        
        foreach ($this->categories as $code) {
            $license->categories()->create([
                'category_code' => $code,
            ]);
        }

        $this->resetExcept('employee');
        session()->flash('message', 'Driver license added successfully.');
    }

    public function render()
    {
        return view('livewire.employee-driver-licenses', [
            'licenses' => $this->employee->driverLicenses()->with('categories')->get(),
        ]);
    }
}
