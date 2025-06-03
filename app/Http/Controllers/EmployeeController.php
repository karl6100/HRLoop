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
        // dd($request->all());
        $request->validate([
            'employee_id' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'suffix' => 'nullable|string',
            'civil_status' => 'required|string',
            'birth_date' => 'required|date',
            'birth_place' => 'required|string',
            'blood_type' => 'required|string',
            'gender' => 'required|string',
            'nationality' => 'required|string',
            'religion' => 'required|string',
            'telephone_number' => 'required|string',
            'mobile_number' => 'required|string|unique:employees,mobile_number',
            'email' => 'required|string|email|unique:employees,email',
            'department' => 'required|string',
            'company' => 'required|string',
            'position_title' => 'required|string',
            'job_level' => 'required|string',
            'hired_date' => 'required|date',
            'employment_status' => 'required|string',
        ]);

        // Save the employee data
        Employee::create($request->all());

        return redirect()->back()->with('success', 'Employee saved successfully!');

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
