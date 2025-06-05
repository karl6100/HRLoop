<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee_Address>
 */
class EmployeeAddressFactory extends Factory
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
            'street_address' => $this->faker->streetAddress,
            'barangay' => $this->faker->word,
            'city' => $this->faker->city,
            'province' => $this->faker->word,
            'zip_code' => $this->faker->postcode,
            'country' => $this->faker->country,
            'is_current' => $this->faker->boolean(100),
        ];
    }
}
