<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;
use App\Models\EmployeeStatus;
use Illuminate\Support\Facades\Log;

class EmployeeStatusForm extends Component
{
    public $employmentStatusOptions = ['Probationary', 'Regular', 'Temporary', 'Extra Helper', 'OJT','Terminated','Resigned','End of Contract'];

    public $employee;
    public $employment_status;
    public $remarks;
    public $effective_date;

    public $showStatusModal = false;

    protected $rules = [
        'employment_status' => 'required|string',
        'remarks' => 'required|string',
        'effective_date' => 'required|date',
    ];

    protected $messages = [
        'employment_status.required' => 'Employment status is required.',
        'remarks.required' => 'Remarks is required.',
        'effective_date.required' => 'Effective date is required.',
        'effective_date.date' => 'Effective date must be a valid date.',
    ];

    public function mount(Employee $employee)
    {
        // Log::debug('Mounting component with employee', ['employee_id' => $employee->id]);

        $this->employee = $employee;
        $this->employment_status = $employee->employment_status;
        $this->remarks = $employee->remarks ?? '';

        $latestStatus = $employee->employeeStatus()->latest()->first();
        // Log::debug('Latest status record', ['latest_status' => $latestStatus]);

        $this->effective_date = $latestStatus->effective_date ?? now();
    }

    public function openStatusModal()
    {
        // Log::debug('Opening status modal');
        $this->showStatusModal = true;
    }

    public function closeStatusModal()
    {
        // Log::debug('Closing status modal');
        $this->showStatusModal = false;
    }

    public function save()
    {
        // Log::debug('Save triggered', [
        //     'employment_status' => $this->employment_status,
        //     'remarks' => $this->remarks,
        //     'effective_date' => $this->effective_date,
        // ]);

        try {
            $this->validate();
            // Log::debug('Validation passed');
            // Log::debug('Employee model in save()', ['employee' => $this->employee]);
            $this->employee->employeeStatus()->create([
                'employment_status' => $this->employment_status,
                'remarks' => $this->remarks ?? 'Updated via modal',
                'effective_date' => $this->effective_date ?? now(),
            ]);
            // Log::debug('Status record created');

            $this->employee->update([
                'employment_status' => $this->employment_status,
            ]);
            // Log::debug('Employee record updated');

            session()->flash('success', 'Status and position updated.');
            // Log::debug('Flash message set');

            $this->closeStatusModal();
            $this->dispatch('status-updated');
            // Log::debug('Modal closed and event dispatched');

        } catch (\Exception $e) {
            Log::error('Error saving employee status', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            session()->flash('error', 'Something went wrong while saving the status.');
        }
        
    }

    public function render()
    {
        // Log::debug('Rendering employee-status-form');
        return view('livewire.employee-status-form');
    }
}
