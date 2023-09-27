<?php

use Carbon\Carbon;
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
        // Truncate the criteria table
        Schema::disableForeignKeyConstraints();
        DB::table('appointment_times')->truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            [
                "id" => 1,
                "doctor_id" => 1,
                "appointment_time" => "13:00:00",
                "updated_at" => Carbon::now(),
                "created_at" => Carbon::now(),
            ],
            [
                "id" => 2,
                "doctor_id" => 1,
                "appointment_time" => "13:30:00",
                "updated_at" => Carbon::now(),
                "created_at" => Carbon::now(),
            ],
            [
                "id" => 3,
                "doctor_id" => 1,
                "appointment_time" => "14:00:00",
                "updated_at" => Carbon::now(),
                "created_at" => Carbon::now(),
            ],

            [
                "id" => 4,
                "doctor_id" => 1,
                "appointment_time" => "14:30:00",
                "updated_at" => Carbon::now(),
                "created_at" => Carbon::now(),
            ],
            [
                "id" => 5,
                "doctor_id" => 1,
                "appointment_time" => "15:00:00",
                "updated_at" => Carbon::now(),
                "created_at" => Carbon::now(),
            ],



        ];
        DB::table('appointment_times')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('appointment_times')->delete();
    }
};
