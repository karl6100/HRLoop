<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employee = Employee::all(); // Fetch all employees
        
        return view('employee.index', compact('employee'));
    }    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suffixOptions = ['N/A','Jr.', 'Sr.', 'III', 'IV', 'V'];
        $bloodOptions = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+','O-'];
        $civilStatusOptions = ['Single', 'Married', 'Widowed', 'Separated', 'Divorced'];
        $genderOptions = ['Male','Female'];
        $jobLevelOptions =['Rank-and-File/Staff', 'Supervisor', 'Department Manager', 'Division Manager', 'Executive', 'None'];
        $employmentStatusOptions = ['Probationary', 'Regular', 'Contractual', 'Casual', 'Job Order'];
        
        return view('employee.create', compact('suffixOptions', 'bloodOptions', 'civilStatusOptions', 'genderOptions',
            'jobLevelOptions', 'employmentStatusOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $employee = Employee::findOrFail($employee_id); // Fetch the employee by ID
        return view('employee.edit', compact('employee')); // Return the edit view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
