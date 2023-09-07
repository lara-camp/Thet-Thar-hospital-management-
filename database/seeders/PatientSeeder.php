<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Patient::truncate();
        $data = Patient::factory(10)->make();
        $chunks = $data->chunk(10);
        $chunks->each(function ($chunk) {
            Patient::insert($chunk->toArray());
        });
    }
}
