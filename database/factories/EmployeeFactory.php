<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_id' => $this->faker->unique()->numerify('EMP-#####'),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'middle_name' => $this->faker->lastName(),
            'suffix' => $this->faker->randomElement(['Jr.', 'Sr.', 'III', 'IV', 'V', 'None']),
            'civil_status' => $this->faker->randomElement(['Single', 'Married', 'Widowed', 'Separated', 'Divorced']),
            'birth_date' => $this->faker->date(),
            'birth_place' => $this->faker->city(),
            'blood_type' => $this->faker->randomElement(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']),
            'telephone_number' => $this->faker->phoneNumber(),
            'mobile_number' => $this->faker->unique()->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'department' => $this->faker->word(),
            'position_title' => $this->faker->jobTitle(),
            'job_level' => $this->faker->randomElement(['Rank-and-File/Staff', 'Supervisor', 'Department Manager', 'Division Manager', 'Executive', 'None']),
            'function' => $this->faker->word(),
            'regularization_date' => $this->faker->optional()->date(),
            'employment_status' => $this->faker->randomElement(['Probationary', 'Regular', 'Contractual', 'Casual', 'Job Order']),
        ];
    }
}
