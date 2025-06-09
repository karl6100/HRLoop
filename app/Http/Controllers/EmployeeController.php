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
        $employees = Employee::paginate(20); // Fetch all employees

        return view('employee.index', compact('employees'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suffixOptions = ['N/A', 'Jr.', 'Sr.', 'III', 'IV', 'V'];
        $bloodOptions = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
        $civilStatusOptions = ['Single', 'Married', 'Widowed', 'Separated', 'Divorced'];
        $genderOptions = ['Male', 'Female'];
        $jobLevelOptions = ['Rank-and-File/Staff', 'Supervisor', 'Department Manager', 'Division Manager', 'Executive', 'None'];
        $employmentStatusOptions = ['Probationary', 'Regular', 'Contractual', 'Casual', 'Job Order'];

        return view('employee.create', compact(
            'suffixOptions',
            'bloodOptions',
            'civilStatusOptions',
            'genderOptions',
            'jobLevelOptions',
            'employmentStatusOptions'
        ));
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
            'civil_status' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'birth_place' => 'nullable|string',
            'blood_type' => 'nullable|string',
            'gender' => 'nullable|string',
            'nationality' => 'nullable|string',
            'religion' => 'nullable|string',
            'telephone_number' => 'nullable|string',
            'mobile_number' => 'nullable|string|unique:employees,mobile_number',
            'email' => 'nullable|string|email|unique:employees,email',
            'department' => 'required|string',
            'company' => 'required|string',
            'position_title' => 'required|string',
            'job_level' => 'nullable|string',
            'hired_date' => 'required|date',
            'employment_status' => 'required|string',
            'sss_number' => 'nullable|string|unique:employees,sss_number',
            'philhealth_number' => 'nullable|string|unique:employees,philhealth_number',
            'pagibig_number' => 'nullable|string|unique:employees,pagibig_number',
            'tin_number' => 'nullable|string|unique:employees,tin_number',
            'education_level.*' => 'nullable|string',
            'school.*' => 'nullable|string',
            'degree.*' => 'nullable|string',
            'start_year.*' => 'nullable|integer',
            'end_year.*' => 'nullable|integer',
            'street_address.*' => 'nullable|string',
            'barangay.*' => 'nullable|string',
            'city.*' => 'nullable|string',
            'province.*' => 'nullable|string',
            'zip_code.*' => 'nullable|string',
            'country.*' => 'nullable|string',
            'is_current.*' => 'nullable|boolean',
            'dependent_fullname.*' => 'nullable|string',
            'dependent_relationship.*' => 'nullable|string',
            'dependent_birth_date.*' => 'nullable|date',
        ]);

        // Save the main employee data
    $employee = Employee::create($request->only([
        'employee_id',
        'first_name',
        'last_name',
        'middle_name',
        'suffix',
        'civil_status',
        'birth_date',
        'birth_place',
        'blood_type',
        'gender',
        'nationality',
        'religion',
        'telephone_number',
        'mobile_number',
        'email',
        'department',
        'company',
        'position_title',
        'job_level',
        'hired_date',
        'employment_status',
        'sss_number',
        'philhealth_number',
        'pagibig_number',
        'tin_number',
    ]));

        // Save education data
        if ($request->has('education_level')) {
            foreach ($request->education_level as $index => $level) {
                $employee->employee_educations()->create([                    
                    'education_level' => $level,
                    'school' => $request->school[$index],
                    'degree' => $request->degree[$index],
                    'start_year' => $request->start_year[$index],
                    'end_year' => $request->end_year[$index],                
                ]);
            }
        }
        // Save street data
        if ($request->has('street_address')) {
            foreach ($request->street_address as $index => $street) {
                $employee->employee_addresses()->create([
                    'street_address' => $street,
                    'barangay' => $request->barangay[$index],
                    'city' => $request->city[$index],
                    'province' => $request->province[$index],
                    'zip_code' => $request->zip_code[$index],
                    'country' => $request->country[$index],
                    'is_current' => (bool) ($request->is_current[$index] ?? 0),
                ]);
            }
        }

        // Save dependents data
        if ($request->has('dependent_fullname')) {
            foreach ($request->dependent_fullname as $index => $dependent_fullname) {
                $employee->employee_dependents()->create([
                    'fullname' => $dependent_fullname,
                    'relationship' => $request->dependent_relationship[$index],
                    'birth_date' => $request->dependent_birth_date[$index],
                ]);
            }
        }
        return redirect()->route('employees.create', $employee)
        ->with('message', 'Employee saved!');
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
