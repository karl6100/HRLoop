<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Admin Employee Record
        $employee = Employee::firstOrCreate(
            ['employee_id' => '1'],
            [
                'first_name'        => 'System',
                'last_name'         => 'Administrator',
                'middle_name'       => '',
                'suffix'            => '',
                'civil_status'      => 'Single',
                'birth_date'        => Carbon::parse('1990-01-01'),
                'birth_place'       => 'Unknown',
                'blood_type'        => null,
                'gender'            => 'Male',
                'nationality'       => 'Filipino',
                'religion'          => 'N/A',
                'telephone_number'  => null,
                'mobile_number'     => '09171234567',
                'email'             => 'admin@company.com',
                'department'        => 'IT Department',
                'company'           => 'Your Company',
                'position_title'    => 'System Administrator',
                'job_level'         => 'Executive',
                'hired_date'        => Carbon::today(),
                'employment_status' => 'Regular',
                'sss_number'        => null,
                'philhealth_number' => null,
                'pagibig_number'    => null,
                'tin_number'        => null,
            ]
        );

        // 2. Attach Initial Status
        $employee->employeeStatus()->firstOrCreate([
            'employment_status' => 'Regular',
            'effective_date'    => $employee->hired_date,
            'remarks'           => 'Initial employment record',
        ]);

        // 3. Attach Initial Position
        $employee->employeePositions()->firstOrCreate([
            'position_title' => 'System Administrator',
            'job_level'      => 'Executive',
            'department'     => 'IT Department',
            'company'        => 'Your Company',
            'effective_date' => $employee->hired_date,
            'remarks'        => 'Initial position record',
        ]);

        // 4. Create Linked User Account
        User::firstOrCreate(
            ['employee_id' => $employee->employee_id],
            [
                'name'        => $employee->first_name . ' ' . $employee->last_name,
                'email'       => $employee->email,
                'password'    => Hash::make('password123'), // Change after first login
            ]
        );
    }
}
