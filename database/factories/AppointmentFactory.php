<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'patient_id' =>  $this->faker->numberBetween(1, 10),
            'doctor_id' =>  $this->faker->numberBetween(1, 10),
            'booking_id' => $this->faker->unique()->bothify('Hello ##??'),
            'appointment_time' => $this->faker->time(),
            'appointment_date' => $this->faker->date(),
            'description' => $this->faker->text(),
        ];
    }
}
