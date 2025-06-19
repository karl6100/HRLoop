<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Employee;

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
           'fkey_employee_id' => Employee::query()->inRandomOrder()->value('employee_id'),
            'fullname' => $this->faker->firstName() . ' ' . $this->faker->lastName(), // Generate a random last name
            'relationship' => $this->faker->randomElement(['Spouse', 'Son', 'Daughter']),
            'birth_date' => $this->faker->dateTimeBetween('-30 years', '-1 year')->format('Y-m-d'),
        ];
    }
}
