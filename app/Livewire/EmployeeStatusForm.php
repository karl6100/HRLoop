<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;
use App\Models\EmployeeStatus;

class EmployeeStatusForm extends Component
{
    public $employee;
    public $employment_status;
    public $position_title;
    public $remarks;
    public $effective_date;

    public $showModal = false;

    protected $rules = [
        'employment_status' => 'required|string',
        'position_title' => 'required|string',
        'remarks' => 'nullable|string',
        'effective_date' => 'nullable|date',
    ];

    public function mount(Employee $employee)
    {
        if (!$employee) {
            abort(404, 'Employee not found');
        }
        $this->employee = $employee;
        $this->employment_status = $employee->employment_status;
        $this->position_title = $employee->position_title;
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function save()
    {
        $this->validate();

        // Save to status table
        $this->employee->employeeStatus()->create([
            'employment_status' => $this->employment_status,
            'position_title' => $this->position_title,
            'remarks' => $this->remarks ?? 'Updated via modal',
            'effective_date' => $this->effective_date ?? now(),
        ]);

        // Update employee’s main record if needed
        $this->employee->update([
            'employment_status' => $this->employment_status,
            'position_title' => $this->position_title,
        ]);

        session()->flash('success', 'Status and position updated.');

        $this->closeModal();
        $this->dispatch('status-updated'); // optional
    }

    public function render()
    {
        return view('livewire.employee-status-form');
    }
}

