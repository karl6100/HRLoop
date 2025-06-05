<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'employee_id' => \App\Models\Employee::factory(),
            'education_level' => $this->faker->word,
            'school' => $this->faker->company,
            'degree' => $this->faker->word,
            'start_year' => $this->faker->year,
            'end_year' => $this->faker->year,
        ];
    }
}
