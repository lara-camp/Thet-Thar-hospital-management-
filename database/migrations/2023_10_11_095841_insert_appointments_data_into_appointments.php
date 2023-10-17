<?php

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
        DB::table('appointments')->truncate();
        Schema::enableForeignKeyConstraints();
        $data = [
            [
                'patient_id' =>  6,
                'doctor_id' =>  1,
                'booking_id' => "fresher.123",
                'appointment_time' => "09:00:00",
                'appointment_date' => now(),
                'status' => 'upcoming',
                'appointment_type' => 'chat',
                'description' => "This is a test appointment",
            ],
            [
                'patient_id' =>  7,
                'doctor_id' =>  2,
                'booking_id' => "fresher.223",
                'appointment_time' => "09:30:00",
                'appointment_date' => now(),
                'status' => 'upcoming',
                'appointment_type' => 'chat',
                'description' => "This is a test appointment",
            ],
            [
                'patient_id' =>  6,
                'doctor_id' =>  2,
                'booking_id' => "fresher.1123",
                'appointment_time' => "10:00:00",
                'appointment_date' => now(),
                'status' => 'upcoming',
                'appointment_type' => 'outpatient',
                'description' => "This is a test appointment",
            ],
            [
                'patient_id' =>  6,
                'doctor_id' =>  3,
                'booking_id' => "fresher.33",
                'appointment_time' => "10:30:00",
                'appointment_date' => now(),
                'status' => 'completed',
                'appointment_type' => 'video',
                'description' => "This is a test appointment",
            ],
            [
                'patient_id' =>  23,
                'doctor_id' =>  4,
                'booking_id' => "fresher.30",
                'appointment_time' => "11:00:00",
                'appointment_date' => now(),
                'status' => 'completed',
                'appointment_type' => 'video',
                'description' => "This is a test appointment",
            ],
            [
                'patient_id' =>  6,
                'doctor_id' =>  5,
                'booking_id' => "fresher.39",
                'appointment_time' => "11:30:00",
                'appointment_date' => now(),
                'status' => 'cancelled',
                'appointment_type' => 'chat',
                'description' => "This is a test appointment",
            ],
        ];
        DB::table('appointments')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('appointments')->truncate();
        Schema::enableForeignKeyConstraints();
    }
};
