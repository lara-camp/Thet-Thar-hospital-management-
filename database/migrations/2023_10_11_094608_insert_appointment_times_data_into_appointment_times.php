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
        DB::table('appointment_times')->truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            [
                'doctor_id' => 15,
                'appointment_time' => '09:00:00',
            ],
            [
                'doctor_id' => 15,
                'appointment_time' => '09:30:00',
            ],
            [
                'doctor_id' => 15,
                'appointment_time' => '10:00:00',
            ],
            [
                'doctor_id' => 15,
                'appointment_time' => '10:30:00',
            ],
            [
                'doctor_id' => 15,
                'appointment_time' => '11:00:00',
            ],
            [
                'doctor_id' => 15,
                'appointment_time' => '11:30:00',
            ],
            [
                'doctor_id' => 16,
                'appointment_time' => '10:00:00',
            ],
            [
                'doctor_id' => 16,
                'appointment_time' => '10:30:00',
            ],
            [
                'doctor_id' => 16,
                'appointment_time' => '11:00:00',
            ],
            [
                'doctor_id' => 16,
                'appointment_time' => '11:30:00',
            ],
            [
                'doctor_id' => 16,
                'appointment_time' => '12:00:00',
            ],
            [
                'doctor_id' => 16,
                'appointment_time' => '12:30:00',
            ],
            [
                'doctor_id' => 16,
                'appointment_time' => '13:00:00',
            ],
            [
                'doctor_id' => 17,
                'appointment_time' => '8:30:00',
            ],
            [
                'doctor_id' => 17,
                'appointment_time' => '09:00:00',
            ],
            [
                'doctor_id' => 17,
                'appointment_time' => '09:30:00',
            ],
            [
                'doctor_id' => 17,
                'appointment_time' => '10:00:00',
            ],
            [
                'doctor_id' => 17,
                'appointment_time' => '10:30:00',
            ],
            [
                'doctor_id' => 17,
                'appointment_time' => '11:00:00',
            ],
            [
                'doctor_id' => 17,
                'appointment_time' => '11:30:00',
            ],
            [
                'doctor_id' => 17,
                'appointment_time' => '12:00:00',
            ],
            [
                'doctor_id' => 17,
                'appointment_time' => '12:30:00',
            ],
            [
                'doctor_id' => 18,
                'appointment_time' => '09:30:00',
            ],
            [
                'doctor_id' => 18,
                'appointment_time' => '10:00:00',
            ],
            [
                'doctor_id' => 18,
                'appointment_time' => '10:30:00',
            ],
            [
                'doctor_id' => 18,
                'appointment_time' => '11:00:00',
            ],
            [
                'doctor_id' => 18,
                'appointment_time' => '11:30:00',
            ],
            [
                'doctor_id' => 18,
                'appointment_time' => '12:00:00',
            ],
            [
                'doctor_id' => 18,
                'appointment_time' => '12:30:00',
            ],
            [
                'doctor_id' => 18,
                'appointment_time' => '13:00:00',
            ],
            [
                'doctor_id' => 18,
                'appointment_time' => '13:30:00',
            ],
            [
                'doctor_id' => 18,
                'appointment_time' => '14:00:00',
            ],
            [
                'doctor_id' => 18,
                'appointment_time' => '14:30:00',
            ],
            [
                'doctor_id' => 19,
                'appointment_time' => '11:00:00',
            ],
            [
                'doctor_id' => 19,
                'appointment_time' => '11:30:00',
            ],
            [
                'doctor_id' => 19,
                'appointment_time' => '12:00:00',
            ],
            [
                'doctor_id' => 19,
                'appointment_time' => '12:30:00',
            ],
            [
                'doctor_id' => 19,
                'appointment_time' => '13:00:00',
            ],
            [
                'doctor_id' => 19,
                'appointment_time' => '13:30:00',
            ],
            [
                'doctor_id' => 19,
                'appointment_time' => '14:00:00',
            ],
            [
                'doctor_id' => 19,
                'appointment_time' => '14:30:00',
            ],
            [
                'doctor_id' => 19,
                'appointment_time' => '15:00:00',
            ],
            [
                'doctor_id' => 19,
                'appointment_time' => '15:30:00',
            ],
            [
                'doctor_id' => 19,
                'appointment_time' => '16:00:00',
            ],
            [
                'doctor_id' => 20,
                'appointment_time' => '11:00:00',
            ],
            [
                'doctor_id' => 20,
                'appointment_time' => '11:30:00',
            ],
            [
                'doctor_id' => 20,
                'appointment_time' => '12:00:00',
            ],
            [
                'doctor_id' => 20,
                'appointment_time' => '12:30:00',
            ],
            [
                'doctor_id' => 20,
                'appointment_time' => '13:00:00',
            ],
            [
                'doctor_id' => 20,
                'appointment_time' => '13:30:00',
            ],
            [
                'doctor_id' => 20,
                'appointment_time' => '14:00:00',
            ],
            [
                'doctor_id' => 20,
                'appointment_time' => '14:30:00',
            ],
            [
                'doctor_id' => 20,
                'appointment_time' => '15:00:00',
            ],
            [
                'doctor_id' => 20,
                'appointment_time' => '15:30:00',
            ],
            [
                'doctor_id' => 20,
                'appointment_time' => '16:00:00',
            ],

        ];
        DB::table('appointment_times')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('appointment_times')->truncate();
        Schema::enableForeignKeyConstraints();
    }
};
