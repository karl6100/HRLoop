<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        $employeePayTypeOptions = ['Monthly', 'Daily', 'Hourly'];

        return view('employee.create', compact(
            'suffixOptions',
            'bloodOptions',
            'civilStatusOptions',
            'genderOptions',
            'jobLevelOptions',
            'employmentStatusOptions',
            'employeePayTypeOptions'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            // dd($request->all());
            $request->validate([ //Fields from view
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
                'employee_pay_type' => 'nullable|string',
                'basic_salary' => 'nullable|numeric',
                'allowance' => 'nullable|numeric',
                'salary_effective_date' => 'nullable|date',
                'total_compensation' => 'nullable|numeric',
                'compensation_remarks' => 'nullable|string',
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
                    $employee->employeeEducations()->create([
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
                    // Check if the current address is marked as "is_current"
                    $isCurrent = (bool) ($request->is_current[$index] ?? 0);

                    if ($isCurrent) {
                        // Set all other addresses of the employee to "is_current = false"
                        $employee->employeeAddresses()->update(['is_current' => false]);
                    }

                    // Create the new address
                    $employee->employeeAddresses()->create([
                        'street_address' => $street,
                        'barangay' => $request->barangay[$index],
                        'city' => $request->city[$index],
                        'province' => $request->province[$index],
                        'zip_code' => $request->zip_code[$index],
                        'country' => $request->country[$index],
                        'is_current' => $isCurrent,
                    ]);
                }
            }

            // Save dependents data
            if ($request->has('dependent_fullname')) {
                foreach ($request->dependent_fullname as $index => $dependent_fullname) {
                    $employee->employeeDependents()->create([
                        'fullname' => $dependent_fullname,
                        'relationship' => $request->dependent_relationship[$index],
                        'birth_date' => $request->dependent_birth_date[$index],
                    ]);
                }
            }

            // Save employee salary data
            if ($request->has('employee_pay_type')) {
                foreach ($request->employee_pay_type as $index => $employee_pay_type) {
                    // Check if the current compensation is marked as "is_current"
                    $isCurrent = (bool) ($request->is_current[$index] ?? 0);

                    if ($isCurrent) {
                        // Set all other compensation of the employee to "is_current = false"
                        $employee->employeeSalaries()->update(['is_current' => false]);
                    }

                    $employee->employeeSalaries()->create([
                        'pay_type' => $request->employee_pay_type,
                        'basic_salary' => $request->basic_salary,
                        'allowance' => $request->allowance,
                        'effective_date' => $request->salary_effective_date,
                        'monthly_rate' => $request->total_compensation,
                        'remarks' => $request->compensation_remarks,
                    ]);
                }
            }

            return redirect()->route('employee.create')
                ->with('message', 'Employee saved successfully!');
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error saving employee data: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->route('employee.create')
                ->with('error', 'Failed to save employee data. Please try again.');
        }
    }



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
            'employeeSalaries',
        ])->findOrFail($employee_id);

        $employee->birth_date = Carbon::parse($employee->birth_date)->format('m/d/Y'); // Example: 10/01/23
        $employee->hired_date = Carbon::parse($employee->hired_date)->format('m/d/Y');
        $employee->employeeDependents->each(function ($dependent) {
            $dependent->dependent_birth_date = Carbon::parse($dependent->dependent_birth_date)->format('m/d/Y');
        });

        // Pass the employee data to the view
        return view('employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($employee_id)
    {
        // Retrieve the employee record along with related data
        $suffixOptions = ['N/A', 'Jr.', 'Sr.', 'III', 'IV', 'V'];
        $bloodOptions = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
        $civilStatusOptions = ['Single', 'Married', 'Widowed', 'Separated', 'Divorced'];
        $genderOptions = ['Male', 'Female'];
        $jobLevelOptions = ['Rank-and-File/Staff', 'Supervisor', 'Department Manager', 'Division Manager', 'Executive', 'None'];
        $employmentStatusOptions = ['Probationary', 'Regular', 'Contractual', 'Casual', 'Job Order'];
        $employeePayTypeOptions = ['Monthly', 'Daily', 'Hourly'];

        $employee = Employee::with([
            'employeeEducations',
            'employeeAddresses',
            'employeeDependents',
            'employeeSalaries',
        ])->findOrFail($employee_id);

        $employee->birth_date = Carbon::parse($employee->birth_date)->format('m/d/Y'); // Example: 10/01/23
        $employee->hired_date = Carbon::parse($employee->hired_date)->format('m/d/Y');
        $employee->employeeDependents->each(function ($dependent) {
            $dependent->dependent_birth_date = Carbon::parse($dependent->dependent_birth_date)->format('m/d/Y');
        });

        // Pass the employee data to the view
        return view('employee.edit', compact('employee',
            'suffixOptions',
            'bloodOptions',
            'civilStatusOptions',
            'genderOptions',
            'jobLevelOptions',
            'employmentStatusOptions',
            'employeePayTypeOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $employee_id)
{
    try {
        // Validate the incoming request
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
            'mobile_number' => 'nullable|string|unique:employees,mobile_number,' . $employee_id,
            'email' => 'nullable|string|email|unique:employees,email,' . $employee_id,
            'department' => 'required|string',
            'company' => 'required|string',
            'position_title' => 'required|string',
            'job_level' => 'nullable|string',
            'hired_date' => 'required|date',
            'employment_status' => 'required|string',
            'sss_number' => 'nullable|string|unique:employees,sss_number,' . $employee_id,
            'philhealth_number' => 'nullable|string|unique:employees,philhealth_number,' . $employee_id,
            'pagibig_number' => 'nullable|string|unique:employees,pagibig_number,' . $employee_id,
            'tin_number' => 'nullable|string|unique:employees,tin_number,' . $employee_id,
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
            'employee_pay_type' => 'nullable|string',
            'basic_salary' => 'nullable|numeric',
            'allowance' => 'nullable|numeric',
            'salary_effective_date' => 'nullable|date',
            'total_compensation' => 'nullable|numeric',
            'compensation_remarks' => 'nullable|string',
        ]);

        // Find the employee record
        $employee = Employee::findOrFail($employee_id);

        // Update the main employee data
        $employee->update($request->only([
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
        // dd($employee);
        // Update education data
        $employee->employeeEducations()->delete(); // Remove existing records
        if ($request->has('education_level')) {
            // dd($request->education_level);
            foreach ($request->education_level as $index => $level) {
                $employee->employeeEducations()->create([
                    'education_level' => $level,
                    'school' => $request->school[$index],
                    'degree' => $request->degree[$index],
                    'start_year' => $request->start_year[$index],
                    'end_year' => $request->end_year[$index],
                ]);
            }
        }

        // Update address data
        $employee->employeeAddresses()->delete(); // Remove existing records
        if ($request->has('street_address')) {
            foreach ($request->street_address as $index => $street) {
                $isCurrent = (bool) ($request->is_current[$index] ?? 0);

                $employee->employeeAddresses()->create([
                    'street_address' => $street,
                    'barangay' => $request->barangay[$index],
                    'city' => $request->city[$index],
                    'province' => $request->province[$index],
                    'zip_code' => $request->zip_code[$index],
                    'country' => $request->country[$index],
                    'is_current' => $isCurrent,
                ]);
            }
        }

        // Update dependents data
        $employee->employeeDependents()->delete(); // Remove existing records
        if ($request->has('dependent_fullname')) {
            foreach ($request->dependent_fullname as $index => $dependent_fullname) {
                $employee->employeeDependents()->create([
                    'fullname' => $dependent_fullname,
                    'relationship' => $request->dependent_relationship[$index],
                    'birth_date' => $request->dependent_birth_date[$index],
                ]);
            }
        }

        // Update salary data
        $employee->employeeSalaries()->delete(); // Remove existing records
        if ($request->has('employee_pay_type')) {
            foreach ($request->employee_pay_type as $index => $employee_pay_type) {
                $employee->employeeSalaries()->create([
                    'pay_type' => $employee_pay_type,
                    'basic_salary' => $request->basic_salary,
                    'allowance' => $request->allowance,
                    'effective_date' => $request->salary_effective_date,
                    'monthly_rate' => $request->total_compensation,
                    'remarks' => $request->compensation_remarks,
                ]);
            }
        }

        return redirect()->route('employee.edit', $employee_id)
            ->with('message', 'Employee updated successfully!');
    } catch (\Exception $e) {
        // Log the error for debugging
        \Log::error('Error updating employee data: ' . $e->getMessage());

        // Redirect back with an error message
        return redirect()->route('employee.edit', $employee_id)
            ->with('error', 'Failed to update employee data. Please try again.');
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
