<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'hospital_id' => $this->faker->numberBetween(1, 10),
            'department_id' => $this->faker->numberBetween(1, 10),
            'experience' => $this->faker->numberBetween(0, 10), // Assuming experience is an integer.
            'license'=> $this->faker->unique()->numberBetween(10000,99999),
            'bio' => $this->faker->text,
        ];
    }
}
