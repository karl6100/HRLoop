<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;

class EmployeeIndex extends Component
{
    public $search = '';
    public $searchQuery = '';
    public $viewMode = 'list'; // default to list view


    public function performSearch()
    {
        $this->search = $this->searchQuery;
    }

    public function render()
    {
        $employees = Employee::query()
            ->when($this->search, function ($query) {
                $query->where('employee_id', 'like', '%' . $this->search . '%')
                    ->orWhere('first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('last_name', 'like', '%' . $this->search . '%')
                    ->orWhere('department', 'like', '%' . $this->search . '%')
                    ->orWhere('position_title', 'like', '%' . $this->search . '%')
                    ->orWhere('company', 'like', '%' . $this->search . '%');
            })
            ->orderBy('employee_id')
            ->paginate(10); // or ->get() if not using pagination

        return view('livewire.employee-index', [
            'employees' => $employees,
        ]);
    }
}
