<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Employee;
use Carbon\Carbon;

class DashboardMain extends Component
{
    public $totalEmployees;
    public $activeDepartments;
    public $attendanceToday;
    public $absentToday;

    public function mount()
    {
        $today = Carbon::today();

        // Total employees
        $this->totalEmployees = Employee::count();

        // Count unique departments
        // $this->activeDepartments = Departments::count();

        // Example attendance tracking (assuming you have an `attendances` table)
        // $this->attendanceToday = \DB::table('attendances')
        //     ->whereDate('created_at', $today)
        //     ->distinct('employee_id')
        //     ->count('employee_id');

        // $this->absentToday = $this->totalEmployees - $this->attendanceToday;
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard-main');
    }
}
