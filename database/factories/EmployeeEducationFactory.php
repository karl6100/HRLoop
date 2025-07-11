<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Employee;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee_Education>
 */
class EmployeeEducationFactory extends Factory
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
            'education_level' => $this->faker->word,
            'school' => $this->faker->company,
            'degree' => $this->faker->word,
            'start_year' => $this->faker->year,
            'end_year' => $this->faker->year,
        ];
    }
}
