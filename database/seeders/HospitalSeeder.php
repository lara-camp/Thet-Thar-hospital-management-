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
        $data = Hospital::factory(10)->make();
        $chunks = $data->chunk(10);
        $chunks->each(function ($chunk) {
            Hospital::insert($chunk->toArray());
        });
        Hospital::insert([
            'name' => 'Hospital One',
            'phone' => '+13129498088',
            'email' => 'hospitalone@gmail.com',
            'address' => '9717 Kihn Lakes Edaview, WI 99814',
            'location' => 'Yangon',
            'is_visible' => true,
            'user_id' => 3,
            'bio' => 'The special one of yangon',
        ]);
    }
}
