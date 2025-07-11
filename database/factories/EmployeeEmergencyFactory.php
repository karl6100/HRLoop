<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Employee;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmployeeEmergency>
 */
class EmployeeEmergencyFactory extends Factory
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
            'emergency_contact_name' => $this->faker->firstName() . ' ' . $this->faker->lastName(), // Generate a random last name
            'emergency_contact_relationship' => $this->faker->randomElement(['Parent', 'Sibling', 'Spouse', 'Friend']),
            'emergency_contact_phone' => $this->faker->phoneNumber(),
            'emergency_street' => $this->faker->streetAddress(),
            'emergency_barangay' => $this->faker->word(),
            'emergency_city' => $this->faker->city(),
            'emergency_province' => $this->faker->state(),
            'emergency_zip_code' => $this->faker->postcode(),
            'emergency_country' => $this->faker->country(),
        ];
    }
}
