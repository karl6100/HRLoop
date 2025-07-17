<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmployeeStatus>
 */
class EmployeeStatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fkey_employee_id' => \App\Models\Employee::query()->inRandomOrder()->value('employee_id'),
            'employment_status' => $this->faker->randomElement(['Active', 'Inactive', 'On Leave']),
            'effective_date' => $this->faker->date(),
            'remarks' => $this->faker->sentence(10),
        ];
    }
}
