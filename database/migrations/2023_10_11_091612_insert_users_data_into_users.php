<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();
        $data = [
            [
                'id' => 1,
                'name' => 'HospitalAdminOne',
                'email' => 'aungzawphyo1102@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$/wQTKHDVTKcZXxqvgXHR5.yOr6vjBkHoErWrI0vhnHCs6rhF8LTRW',
                'remember_token' => Str::random(10),
                'is_visible' => true,
                'role' => 'hospitalAdmin',
            ],
            [
                'id' => 2,
                'name' => 'HospitalAdminTwo',
                'email' => 'hospitaltwo@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$/wQTKHDVTKcZXxqvgXHR5.yOr6vjBkHoErWrI0vhnHCs6rhF8LTRW',
                'remember_token' => Str::random(10),
                'is_visible' => true,
                'role' => 'hospitalAdmin',
            ],
            [
                'id' => 3,
                'name' => 'HospitalAdminThree',
                'email' => 'hospitalthree@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$/wQTKHDVTKcZXxqvgXHR5.yOr6vjBkHoErWrI0vhnHCs6rhF8LTRW',
                'remember_token' => Str::random(10),
                'is_visible' => true,
                'role' => 'hospitalAdmin',
            ],
            [
                'id' => 4,
                'name' => 'HospitalAdminFour',
                'email' => 'hospitalfour@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$/wQTKHDVTKcZXxqvgXHR5.yOr6vjBkHoErWrI0vhnHCs6rhF8LTRW',
                'remember_token' => Str::random(10),
                'is_visible' => false,
                'role' => 'hospitalAdmin',
            ],
            [
                'id' => 5,
                'name' => 'HospitalAdminFive',
                'email' => 'hospitalfive@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$/wQTKHDVTKcZXxqvgXHR5.yOr6vjBkHoErWrI0vhnHCs6rhF8LTRW',
                'remember_token' => Str::random(10),
                'is_visible' => false,
                'role' => 'hospitalAdmin',
            ],
            [
                'id' => 6,
                'name' => 'PatientOne',
                'email' => 'albert.einstein.beta@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$/wQTKHDVTKcZXxqvgXHR5.yOr6vjBkHoErWrI0vhnHCs6rhF8LTRW',
                'remember_token' => Str::random(10),
                'is_visible' => true,
                'role' => 'patient',
            ],
            [
                'id' => 7,
                'name' => 'PatientTwo',
                'email' => 'patienttwo@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$/wQTKHDVTKcZXxqvgXHR5.yOr6vjBkHoErWrI0vhnHCs6rhF8LTRW',
                'remember_token' => Str::random(10),
                'is_visible' => true,
                'role' => 'patient',
            ],
            [
                'id' => 8,
                'name' => 'PatientThree',
                'email' => 'patientthree@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$/wQTKHDVTKcZXxqvgXHR5.yOr6vjBkHoErWrI0vhnHCs6rhF8LTRW',
                'remember_token' => Str::random(10),
                'is_visible' => true,
                'role' => 'patient',
            ],
            [
                'id' => 9,
                'name' => 'GuestOne',
                'email' => 'guestone@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$/wQTKHDVTKcZXxqvgXHR5.yOr6vjBkHoErWrI0vhnHCs6rhF8LTRW',
                'remember_token' => Str::random(10),
                'is_visible' => true,
                'role' => 'guest',
            ],
            [
                'id' => 10,
                'name' => 'GuestTwo',
                'email' => 'guesttwo@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$/wQTKHDVTKcZXxqvgXHR5.yOr6vjBkHoErWrI0vhnHCs6rhF8LTRW',
                'remember_token' => Str::random(10),
                'is_visible' => true,
                'role' => 'guest',
            ],
            [
                'id' => 11,
                'name' => 'Guest',
                'email' => 'guest@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$/wQTKHDVTKcZXxqvgXHR5.yOr6vjBkHoErWrI0vhnHCs6rhF8LTRW',
                'remember_token' => Str::random(10),
                'is_visible' => true,
                'role' => 'guest',
            ],
            [
                'id' => 12,
                'name' => 'GuestThree',
                'email' => 'guestthree@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$/wQTKHDVTKcZXxqvgXHR5.yOr6vjBkHoErWrI0vhnHCs6rhF8LTRW',
                'remember_token' => Str::random(10),
                'is_visible' => true,
                'role' => 'guest',
            ],
            [
                'id' => 13,
                'name' => 'GuestFour',
                'email' => 'guestfour@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$/wQTKHDVTKcZXxqvgXHR5.yOr6vjBkHoErWrI0vhnHCs6rhF8LTRW',
                'remember_token' => Str::random(10),
                'is_visible' => true,
                'role' => 'guest',
            ],
            [
                'id' => 14,
                'name' => 'GuestFive',
                'email' => 'guestfive@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$/wQTKHDVTKcZXxqvgXHR5.yOr6vjBkHoErWrI0vhnHCs6rhF8LTRW',
                'remember_token' => Str::random(10),
                'is_visible' => true,
                'role' => 'guest',
            ],
            [
                'id' => 15,
                'name' => 'DoctorOne',
                'email' => 'doctorone@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$/wQTKHDVTKcZXxqvgXHR5.yOr6vjBkHoErWrI0vhnHCs6rhF8LTRW',
                'remember_token' => Str::random(10),
                'is_visible' => true,
                'role' => 'doctor',
            ],
            [
                'id' => 16,
                'name' => 'DoctorTwo',
                'email' => 'doctortwo@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$/wQTKHDVTKcZXxqvgXHR5.yOr6vjBkHoErWrI0vhnHCs6rhF8LTRW',
                'remember_token' => Str::random(10),
                'is_visible' => true,
                'role' => 'doctor',
            ],
            [
                'id' => 17,
                'name' => 'DoctorThree',
                'email' => 'doctorthree@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$/wQTKHDVTKcZXxqvgXHR5.yOr6vjBkHoErWrI0vhnHCs6rhF8LTRW',
                'remember_token' => Str::random(10),
                'is_visible' => true,
                'role' => 'doctor',
            ],
            [
                'id' => 18,
                'name' => 'DoctorFour',
                'email' => 'doctorfour@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$/wQTKHDVTKcZXxqvgXHR5.yOr6vjBkHoErWrI0vhnHCs6rhF8LTRW',
                'remember_token' => Str::random(10),
                'is_visible' => true,
                'role' => 'doctor',
            ],
            [
                'id' => 19,
                'name' => 'DoctorFive',
                'email' => 'doctorfive@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$/wQTKHDVTKcZXxqvgXHR5.yOr6vjBkHoErWrI0vhnHCs6rhF8LTRW',
                'remember_token' => Str::random(10),
                'is_visible' => true,
                'role' => 'doctor',
            ],
            [
                'id' => 20,
                'name' => 'DoctorSix',
                'email' => 'doctorsix@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$/wQTKHDVTKcZXxqvgXHR5.yOr6vjBkHoErWrI0vhnHCs6rhF8LTRW',
                'remember_token' => Str::random(10),
                'is_visible' => true,
                'role' => 'doctor',
            ],
            [
                'id' => 21,
                'name' => 'SuperAdmin',
                'email' => 'superadmin@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$/wQTKHDVTKcZXxqvgXHR5.yOr6vjBkHoErWrI0vhnHCs6rhF8LTRW',
                'remember_token' => Str::random(10),
                'is_visible' => true,
                'role' => 'superAdmin',
            ],
            [
                'id' => 22,
                'name' => 'PatientFour',
                'email' => 'patientfour@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$/wQTKHDVTKcZXxqvgXHR5.yOr6vjBkHoErWrI0vhnHCs6rhF8LTRW',
                'remember_token' => Str::random(10),
                'is_visible' => true,
                'role' => 'patient',
            ],
            [
                'id' => 23,
                'name' => 'PatientFive',
                'email' => 'patientfive@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$/wQTKHDVTKcZXxqvgXHR5.yOr6vjBkHoErWrI0vhnHCs6rhF8LTRW',
                'remember_token' => Str::random(10),
                'is_visible' => true,
                'role' => 'patient',
            ],
            [
                'id' => 24,
                'name' => 'PatientSix',
                'email' => 'patientsix@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$/wQTKHDVTKcZXxqvgXHR5.yOr6vjBkHoErWrI0vhnHCs6rhF8LTRW',
                'remember_token' => Str::random(10),
                'is_visible' => true,
                'role' => 'patient',
            ],

        ];
        DB::table('users')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();
    }
};
