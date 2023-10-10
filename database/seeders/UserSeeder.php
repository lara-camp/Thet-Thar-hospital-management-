<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate();
        $data = User::factory(10)->make();
        $chunks = $data->chunk(10);
        $chunks->each(function ($chunk) {
            User::insert($chunk->toArray());
        });
        User::factory(10)->create();
        User::insert([
            'name' => 'SuperAdmin',
            'email' => 'superadmin@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$/wQTKHDVTKcZXxqvgXHR5.yOr6vjBkHoErWrI0vhnHCs6rhF8LTRW',
            'remember_token' => Str::random(10),
            'is_visible' => true,
            'role' => 'superAdmin',
        ]);
        User::insert([
            'name' => 'Guest',
            'email' => 'guest@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$/wQTKHDVTKcZXxqvgXHR5.yOr6vjBkHoErWrI0vhnHCs6rhF8LTRW',
            'remember_token' => Str::random(10),
            'is_visible' => true,
            'role' => 'guest',
        ]);
        User::insert([
            'name' => 'Hospital Admin',
            'email' => 'hospital@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$/wQTKHDVTKcZXxqvgXHR5.yOr6vjBkHoErWrI0vhnHCs6rhF8LTRW',
            'remember_token' => Str::random(10),
            'is_visible' => true,
            'role' => 'hospitalAdmin',
        ]);
        User::insert([
            'name' => 'Patient',
            'email' => 'patient@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$/wQTKHDVTKcZXxqvgXHR5.yOr6vjBkHoErWrI0vhnHCs6rhF8LTRW',
            'remember_token' => Str::random(10),
            'is_visible' => true,
            'role' => 'patient',
        ]);
        User::insert([
            'name' => 'doctor',
            'email' => 'doctor@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$/wQTKHDVTKcZXxqvgXHR5.yOr6vjBkHoErWrI0vhnHCs6rhF8LTRW',
            'remember_token' => Str::random(10),
            'is_visible' => true,
            'role' => 'doctor',
        ]);
    }
}
