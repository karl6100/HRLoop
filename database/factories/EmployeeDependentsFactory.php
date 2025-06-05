<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee_Dependents>
 */
class EmployeeDependentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'employee_id' => $employee->id, // Associate with the employee
            'fullname' => $this->faker->firstName() . ' ' . $employee->last_name, // Use employee's last name
            'relationship' => $this->faker->randomElement(['Spouse', 'Son', 'Daughter']),
            'birthdate' => $this->faker->dateTimeBetween('-30 years', '-1 year')->format('Y-m-d'),
        ];
    }
}
