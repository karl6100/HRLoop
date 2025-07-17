<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmployeePosition>
 */
class EmployeePositionFactory extends Factory
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
            'position_title' => $this->faker->jobTitle(),
            'department' => $this->faker->word(),
            'company' => $this->faker->company(),
            'remarks' => $this->faker->sentence(10),
            'effective_date' => $this->faker->date(),
        ];
    }
}
