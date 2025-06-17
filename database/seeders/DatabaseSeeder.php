<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\EmployeeEducation;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // // Check if the user already exists before creating
        // User::firstOrCreate(
        //     ['email' => 'test@example.com'], // Check condition
        //     [ // Attributes to set if the user doesn't exist
        //         'name' => 'Test User',
        //         'email' => 'test@example.com',
        //     ]);
        
        $this->call([
            EmployeeSeeder::class,
            EmployeeAddressSeeder::class,
            EmployeeDependentsSeeder::class,
            EmployeeEducationSeeder::class,
            EmployeeSalarySeeder::class,

            // Add other seeders here as needed
        ]);
    }
}
