<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Doctor::truncate();
        $data = Doctor::factory(10)->make();
        $chunks = $data->chunk(10);
        $chunks->each(function ($chunk) {
            Doctor::insert($chunk->toArray());
        });
    }
}
