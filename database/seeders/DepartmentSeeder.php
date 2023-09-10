<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::truncate();
        $data = Department::factory(10)->make();
        $chunks = $data->chunk(10);
        $chunks->each(function ($chunk) {
            Department::insert($chunk->toArray());
        });
    }
}
