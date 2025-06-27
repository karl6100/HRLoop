<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

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
        $suffixOptions = ['', 'Jr.', 'Sr.', 'III', 'IV', 'V'];
        $bloodOptions = ['', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
        $civilStatusOptions = ['', 'Single', 'Married', 'Widowed', 'Separated', 'Divorced'];
        $genderOptions = ['', 'Male', 'Female'];
        $jobLevelOptions = ['Rank-and-File/Staff', 'Supervisor', 'Department Manager', 'Division Manager', 'Executive', 'None'];
        $employmentStatusOptions = ['Probationary', 'Regular', 'Contractual', 'Casual', 'Job Order'];
        $employeePayTypeOptions = ['', 'Monthly', 'Daily', 'Hourly'];

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
        DB::beginTransaction();
        try {

            // dd($request->all());
            $validatedData = $request->validate([ //Fields from view
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
                'job_level' => 'required|string',
                'hired_date' => 'required|date',
                'employment_status' => 'required|string',
                'sss_number' => 'nullable|string|unique:employees,sss_number',
                'philhealth_number' => 'nullable|string|unique:employees,philhealth_number',
                'pagibig_number' => 'nullable|string|unique:employees,pagibig_number',
                'tin_number' => 'nullable|string|unique:employees,tin_number',
            ]);

            foreach ($educations as $education) {
                Validator::make($education, [
                    'level_of_education' => 'nullable|string',
                    'school' => 'nullable|string',
                    'degree' => 'nullable|string',
                    'start_year' => 'nullable|integer',
                    'end_year' => 'nullable|integer',
                ])->validate();
            }

            foreach ($dependents as $dependent) {
                Validator::make($dependent, [
                    'dependent_fullname' => 'nullable|string',
                    'dependent_relationship' => 'nullable|string',
                    'dependent_birth_date' => 'nullable|date',
                ])->validate();
            }

            foreach ($addresses as $address) {
                Validator::make($address, [
                    'street' => 'nullable|string',
                    'barangay' => 'nullable|string',
                    'city' => 'nullable|string',
                    'province' => 'nullable|string',
                    'zip_code' => 'nullable|string',
                    'country' => 'nullable|string',
                    'is_current' => 'nullable|boolean',
                ])->validate();
            }

            \Log::info('✅ Validated request', $validatedData);

            // Save the main employee data
            $employee = Employee::create($validatedData);

            \Log::info('✅ Employee created', ['employee_id' => $employee->employee_id]);

            // Save education data
            foreach ($educations ?? [] as $education) {
                $employee->employeeEducations()->create($education);
            }

            // Save address data
            foreach ($addresses ?? [] as $address) {
                $employee->employeeAddresses()->create($address);
            }

            // Save dependents data
            foreach ($dependents ?? [] as $dependent) {
                $employee->employeeDependents()->create($dependent);
            }


            // Save employee salary data
            if ($request->filled('employee_pay_type')) {
                $isCurrent = (bool) ($request->is_current[0] ?? 0);

                if ($isCurrent) {
                    $employee->employeeSalaries()->update(['is_current' => false]);
                }

                $employee->employeeSalaries()->create([
                    'pay_type' => $request->employee_pay_type,
                    'basic_salary' => $request->basic_salary,
                    'allowance' => $request->allowance,
                    'effective_date' => $request->salary_effective_date,
                    'monthly_rate' => $request->total_compensation,
                    'remarks' => $request->compensation_remarks,
                    'is_current' => $isCurrent,
                ]);
            }


            DB::commit(); // ✅ All good, commit transaction

            return redirect()->route('employee.show', $employee->employee_id)
                ->with('message', 'Employee created successfully!');
        } catch (\Exception $e) {
            DB::rollback(); // ❗ Roll back if error

            \Log::error('Error storing employee: ' . $e->getMessage());

            return redirect()->route('employee.create')
                ->with('error', 'Failed to create employee. Please try again.');
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


        $employee->birth_date = $employee->birth_date
            ? Carbon::parse($employee->birth_date)->format('m/d/Y')
            : null;

        $employee->hired_date = $employee->hired_date
            ? Carbon::parse($employee->hired_date)->format('m/d/Y')
            : null;

        $employee->employeeDependents->each(function ($dependent) {
            $dependent->dependent_birth_date = $dependent->dependent_birth_date
                ? Carbon::parse($dependent->dependent_birth_date)->format('m/d/Y')
                : null;
        });

        return view('employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($employee_id)
    {
        // Retrieve the employee record along with related data
        $suffixOptions = ['', 'Jr.', 'Sr.', 'III', 'IV', 'V'];
        $bloodOptions = ['', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
        $civilStatusOptions = ['', 'Single', 'Married', 'Widowed', 'Separated', 'Divorced'];
        $genderOptions = ['', 'Male', 'Female'];
        $jobLevelOptions = ['Rank-and-File/Staff', 'Supervisor', 'Department Manager', 'Division Manager', 'Executive', 'None'];
        $employmentStatusOptions = ['Probationary', 'Regular', 'Contractual', 'Casual', 'Job Order'];
        $employeePayTypeOptions = ['', 'Monthly', 'Daily', 'Hourly'];

        $employee = Employee::with([
            'employeeEducations',
            'employeeAddresses',
            'employeeDependents',
            'employeeSalaries',
        ])->findOrFail($employee_id);

        $employee->birth_date = $employee->birth_date
            ? Carbon::parse($employee->birth_date)->format('m/d/Y')
            : null;

        $employee->hired_date = $employee->hired_date
            ? Carbon::parse($employee->hired_date)->format('m/d/Y')
            : null;

        $employee->employeeDependents->each(function ($dependent) {
            $dependent->dependent_birth_date = $dependent->dependent_birth_date
                ? Carbon::parse($dependent->dependent_birth_date)->format('m/d/Y')
                : null;
        });


        // Pass the employee data to the view
        return view('employee.edit', compact(
            'employee',
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, $employee_id)
    {
        DB::beginTransaction();
        try {
            // Validate the incoming request
            dd($request->all());
            // dd('Update function hit');
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
                'unique:employees,mobile_number,' . $employee_id . ',employee_id',
                'unique:employees,email,' . $employee_id . ',employee_id',
                'department' => 'required|string',
                'company' => 'required|string',
                'position_title' => 'required|string',
                'job_level' => 'required|string',
                'hired_date' => 'required|date',
                'employment_status' => 'required|string',
                'unique:employees,sss_number,' . $employee_id . ',employee_id',
                'unique:employees,philhealth_number,' . $employee_id . ',employee_id',
                'unique:employees,pagibig_number,' . $employee_id . ',employee_id',
                'unique:employees,tin_number,' . $employee_id . ',employee_id',
                'education_level' => 'nullable|array',
                'education_level.*' => 'nullable|string',
                'school' => 'nullable|array',
                'school.*' => 'nullable|string',
                'degree' => 'nullable|array',
                'degree.*' => 'nullable|string',
                'start_year' => 'nullable|array',
                'start_year.*' => 'nullable|integer',
                'end_year' => 'nullable|array',
                'end_year.*' => 'nullable|integer',
                'street_address' => 'nullable|array',
                'street_address.*' => 'nullable|string',
                'barangay' => 'nullable|array',
                'barangay.*' => 'nullable|string',
                'city' => 'nullable|array',
                'city.*' => 'nullable|string',
                'province' => 'nullable|array',
                'province.*' => 'nullable|string',
                'zip_code' => 'nullable|array',
                'zip_code.*' => 'nullable|string',
                'country' => 'nullable|array',
                'country.*' => 'nullable|string',
                'is_current' => 'nullable|array',
                'is_current.*' => 'nullable|boolean',
                'dependent_fullname' => 'nullable|array',
                'dependent_fullname.*' => 'nullable|string',
                'dependent_relationship' => 'nullable|array',
                'dependent_relationship.*' => 'nullable|string',
                'dependent_birth_date' => 'nullable|array',
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
            if (is_array($request->education_level)) {
                foreach ($request->education_level as $index => $level) {
                    $employee->employeeEducations()->create([
                        'education_level' => $level,
                        'school' => $request->school[$index] ?? null,
                        'degree' => $request->degree[$index] ?? null,
                        'start_year' => $request->start_year[$index] ?? null,
                        'end_year' => $request->end_year[$index] ?? null,
                    ]);
                }
            }


            // Update address data
            $employee->employeeAddresses()->delete(); // Remove existing records
            if (is_array($request->street_address)) {
                foreach ($request->street_address as $index => $street) {
                    $isCurrent = (bool) ($request->is_current[$index] ?? 0);

                    $employee->employeeAddresses()->create([
                        'street_address' => $street,
                        'barangay' => $request->barangay[$index] ?? null,
                        'city' => $request->city[$index] ?? null,
                        'province' => $request->province[$index] ?? null,
                        'zip_code' => $request->zip_code[$index] ?? null,
                        'country' => $request->country[$index] ?? null,
                        'is_current' => $isCurrent,
                    ]);
                }
            }


            // Update dependents data
            $employee->employeeDependents()->delete(); // Remove existing records
            if (is_array($request->dependent_fullname)) {
                foreach ($request->dependent_fullname as $index => $fullname) {
                    $employee->employeeDependents()->create([
                        'fullname' => $fullname,
                        'relationship' => $request->dependent_relationship[$index] ?? null,
                        'birth_date' => $request->dependent_birth_date[$index] ?? null,
                    ]);
                }
            }


            // Update salary data
            $employee->employeeSalaries()->delete(); // Remove existing records
            if ($request->filled('employee_pay_type')) {
                $employee->employeeSalaries()->create([
                    'pay_type' => $request->employee_pay_type,
                    'basic_salary' => $request->basic_salary,
                    'allowance' => $request->allowance,
                    'effective_date' => $request->salary_effective_date,
                    'monthly_rate' => $request->total_compensation,
                    'remarks' => $request->compensation_remarks,
                ]);
            }

            \Log::info('Employee updated', ['employee_id' => $employee_id]);
            DB::commit();
            return redirect()->route('employee.show', $employee_id)
                ->with('message', 'Employee updated successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Error updating employee data for employee ID ' . $employee_id . ': ' . $e->getMessage());
            return redirect()->route('employee.show', $employee_id)
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
