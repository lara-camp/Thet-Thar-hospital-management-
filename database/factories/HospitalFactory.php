<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hospital>
 */
class HospitalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'location' => fake()->randomElement(['Thingangyun', 'Insein', 'South Dangon', 'NorthDagon']),
            'user_id' => $this->faker->numberBetween(1, 10),
            'bio' => $this->faker->text,
        ];
    }
}
