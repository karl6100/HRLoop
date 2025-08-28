<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class EmployeeDriverLicenses extends Component
{
    public $employee;
    public $license_number, $license_type, $expiry_date;
    public $categories = [];

    public function rules()
    {
        $licenseId = optional(optional($this->employee)->driverLicenses->first())->id;

        return [
            'license_number' => 'required|string|unique:driver_licenses,license_number,' . $licenseId,
            'license_type'   => 'required|string',
            'expiry_date'    => 'required|date',
            'categories'     => 'required|array|min:1',
        ];
    }

    public function mount($employee)
    {
        Log::info('Mounting EmployeeDriverLicenses component', [
            'incoming_employee' => $employee,
        ]);

        $this->employee = Employee::with('driverLicenses.categories')->find($employee->id);

        Log::info('Employee loaded in mount', [
            'employee' => $this->employee,
        ]);

        if ($this->employee && $this->employee->driverLicenses->isNotEmpty()) {
            $license = $this->employee->driverLicenses->first();
            Log::info('Existing license found', [
                'license' => $license,
                'categories' => $license->categories,
            ]);

            $this->license_number = $license->license_number;
            $this->license_type   = $license->license_type;
            $this->expiry_date    = $license->expiry_date
                ? Carbon::parse($license->expiry_date)->format('Y-m-d')
                : '';
            $this->categories     = $license->categories->pluck('category_code')->toArray();
        } else {
            Log::warning('No driver license found for employee');
            $this->license_number = '';
            $this->license_type   = '';
            $this->expiry_date    = '';
            $this->categories     = [];
        }
    }

    public function saveLicense()
    {
        Log::info('Saving license', [
            'employee_id' => $this->employee->id ?? null,
            'license_number' => $this->license_number,
            'license_type' => $this->license_type,
            'expiry_date' => $this->expiry_date,
            'categories' => $this->categories,
        ]);

        $this->validate();

        $employee = $this->employee;

        $license = $employee->driverLicenses()->updateOrCreate(
            ['license_number' => $this->license_number],
            [
                'license_type' => $this->license_type,
                'expiry_date'  => $this->expiry_date,
            ]
        );

        Log::info('License saved/updated', [
            'license' => $license,
        ]);

        // Replace categories
        $license->categories()->delete();
        foreach ($this->categories as $code) {
            $license->categories()->create(['category_code' => $code]);
        }

        Log::info('Categories saved for license', [
            'categories' => $this->categories,
        ]);

        session()->flash('message', 'Driver license saved successfully.');

        // Reload fresh relations
        $this->employee->load('driverLicenses.categories');
        Log::info('Employee reloaded after save', [
            'employee' => $this->employee,
        ]);
    }
}
