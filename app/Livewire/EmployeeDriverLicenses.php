<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;
use App\Models\DriverLicense;

class EmployeeDriverLicenses extends Component
{
    public $employee;
    public $license_number, $license_type, $expiry_date;
    public $categories = [];

    public function rules()
    {
        $licenseId = optional($this->employee->driverLicenses->first())->id;

        return [
            'license_number' => 'required|string|unique:driver_licenses,license_number,' . $licenseId,
            'license_type'   => 'required|string',
            'expiry_date'    => 'required|date',
            'categories'     => 'required|array|min:1',
        ];
    }

    public function mount(Employee $employee)
    {
        $this->employee = $employee->load('driverLicenses.categories');

        if ($this->employee->driverLicenses->isNotEmpty()) {
            $license = $this->employee->driverLicenses->first();

            $this->license_number = $license->license_number;
            $this->license_type   = $license->license_type;
            $this->expiry_date    = $license->expiry_date;
            $this->categories     = $license->categories->pluck('category_code')->toArray();
        }
    }

    public function save()
    {
        $this->validate();

        $license = $this->employee->driverLicenses()->updateOrCreate(
            ['license_number' => $this->license_number],
            [
                'license_type' => $this->license_type,
                'expiry_date'  => $this->expiry_date,
            ]
        );

        // replace categories
        $license->categories()->delete();
        foreach ($this->categories as $code) {
            $license->categories()->create(['category_code' => $code]);
        }

        session()->flash('message', 'Driver license saved successfully.');
    }

    public function render()
    {
        return view('livewire.employee-driver-licenses', [
            'licenses' => $this->employee->driverLicenses()->with('categories')->get(),
        ]);
    }
}
