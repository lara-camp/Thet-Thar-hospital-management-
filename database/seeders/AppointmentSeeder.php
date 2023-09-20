<?php

namespace Database\Seeders;

use App\Models\Appointment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Appointment::truncate();
        $data = Appointment::factory(20)->make();
        $chunks = $data->chunk(20);
        $chunks->each(function ($chunk) {
            Appointment::insert($chunk->toArray());
        });
    }
}
