<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;
use App\Models\EmployeePosition;
use Illuminate\Support\Facades\Log;

class EmployeePositionForm extends Component
{
    // --- Dropdown Option Lists ---
    public $jobLevelOptions = ['Rank-and-File/Staff', 'Supervisor', 'Department Manager', 'Division Manager', 'Executive', 'None'];

    public $employee;
    public $position_title;
    public $job_level;
    public $company;
    public $department;
    public $remarks;
    public $effective_date;

    public $showPositionModal = false;

    protected $rules = [
        'position_title' => 'required|string',
        'job_level' => 'required|string',
        'company' => 'required|string',
        'department' => 'required|string',
        'remarks' => 'required|string',
        'effective_date' => 'required|date',
    ];

    protected $messages = [
        'position_title.required' => 'Employment status is required.',
        'job_level.required' => 'Remarks is required.',
        'company.required' => 'Company is required.',
        'department.required' => 'Department is required.',
        'remarks.required' => 'Remarks is required.',
        'effective_date.required' => 'Effective date is required.',
        'effective_date.date' => 'Effective date must be a valid date.',
    ];

    public function mount(Employee $employee)
    {
        // Log::debug('Mounting component with employee', ['employee_id' => $employee->id]);

        $this->employee = $employee;
        $this->position_title = $employee->position_title;
        $this->job_level = $employee->job_level ?? 'None';
        $this->company = $employee->company ?? '';
        $this->department = $employee->department ?? '';
        $this->remarks = $employee->remarks ?? '';

        $latestPosition = $employee->employeePositions()->latest()->first();
        // Log::debug('Latest position title record', ['latest_position' => $latestPosition]);

        $this->effective_date = $latestPosition->effective_date ?? now();
    }

    public function openPositionModal()
    {
        $this->showPositionModal = true;
    }

    public function closePositionModal()
    {
        $this->showPositionModal = false;
    }

    public function save()
    {
        // Log::debug('Save triggered', [
        //     'position_title' => $this->position_title,
        //     'job_level' => $this->job_level,
        //     'company' => $this->company,
        //     'department' => $this->department,
        //     'remarks' => $this->remarks,
        //     'effective_date' => $this->effective_date,
        // ]);
        try {
            $this->validate();
            // Log::debug('Validation passed');
            // Log::debug('Employee model in save()', ['employee' => $this->employee]);
            // Save to status table
            $this->employee->employeePositions()->create([
                'position_title' => $this->position_title,
                'job_level' => $this->job_level,
                'company' => $this->company,
                'department' => $this->department,
                'remarks' => $this->remarks ?? 'Updated via modal',
                'effective_date' => $this->effective_date ?? now(),
            ]);
            // Log::debug('Position title record created');

            // Update employee’s main record if needed
            $this->employee->update([
                'position_title' => $this->position_title,
                'job_level' => $this->job_level,
                'company' => $this->company,
                'department' => $this->department,
            ]);
            // Log::debug('Employee record updated');

            session()->flash('success', 'Position title updated.');
            // Log::debug('Flash message set');

            $this->closePositionModal();
            $this->dispatch('position-updated'); // optional
            // Log::debug('Modal closed and event dispatched');

        } catch (\Exception $e) {
            Log::error('Error saving employee position title', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            session()->flash('error', 'Something went wrong while saving the position title.');
        }
    }
    public function render()
    {
        // Log::debug('Rendering employee-position-form');
        return view('livewire.employee-position-form');
    }
}
