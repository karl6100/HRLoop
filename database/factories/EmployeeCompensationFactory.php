<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmployeeCompensation>
 */
class EmployeeCompensationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $basic_salary = $this->faker->numberBetween(20000, 100000);
        $allowance = $this->faker->numberBetween(1000, 50000);

        return [
            'fkey_employee_id' => \App\Models\Employee::query()->inRandomOrder()->value('employee_id'),
            'pay_type' => $this->faker->randomElement(['Monthly', 'Daily', 'Hourly']),
            'basic_salary' => $basic_salary,
            'allowance' => $allowance,
            'monthly_rate' => $basic_salary + $allowance, // Calculate monthly_rate here
            'effective_date' => $this->faker->date(),
            'remarks' => $this->faker->sentence(10),
        ];
    }
}
