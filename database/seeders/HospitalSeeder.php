<?php

namespace Database\Seeders;

use App\Models\Hospital;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hospital::truncate();
        $data = Hospital::factory(100)->make();
        $chunks = $data->chunk(10);
        $chunks->each(function ($chunk) {
            Hospital::insert($chunk->toArray());
        });
    }
}
