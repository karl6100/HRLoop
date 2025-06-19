<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Employee;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee_Salary>
 */
class EmployeeSalaryFactory extends Factory
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
            'basic_salary' => $this->faker->numberBetween(20000, 100000),
            'allowance' => $this->faker->numberBetween(5000, 20000),
            'monthly_rate' => function (array $attributes) {
                return $attributes['basic_salary'] + $attributes['allowance'];
            },
            'effective_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'remarks' => $this->faker->sentence,
            'is_current' => $this->faker->boolean(100),
            'pay_type' => $this->faker->randomElement(['Monthly', 'Bi-Weekly', 'Weekly']),
        ];
    }
}
