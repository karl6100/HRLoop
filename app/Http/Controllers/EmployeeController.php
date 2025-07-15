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
        return view('employee.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store() {}



    /**
     * Display the specified resource.
     */
    public function show($employee_id)
    {
        // Retrieve the employee record along with related data
        $employee = Employee::with([
            'employeeEducations',
            'employeeAddresses',
            'employeeDependents',
            'employeeCompensations',
            'employeeEmergencies'
        ])->findOrFail($employee_id);

        return view('employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($employee_id)
    {
        // Retrieve the employee record along with related data
        $employee = Employee::with([
            'employeeEducations',
            'employeeAddresses',
            'employeeDependents',
            'employeeCompensations'
        ])->findOrFail($employee_id);

        return view('employee.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update() {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($employee_id)
    {
        $employee = Employee::findOrFail($employee_id);
        $employee->delete();

        return redirect()->route('employee.index')->with('success', 'Employee deleted successfully.');
    }
}
