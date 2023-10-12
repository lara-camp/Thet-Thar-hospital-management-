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
        DB::table('hospital_doctor')->truncate();
        Schema::enableForeignKeyConstraints();
        $data = [
            [
                'id' => 1,
                'hospital_id' => 1,
                'doctor_id' => 1,
            ],
            [
                'id' => 2,
                'hospital_id' => 1,
                'doctor_id' => 2,
            ],
            [
                'id' => 3,
                'hospital_id' => 1,
                'doctor_id' => 3,
            ],
            [
                'id' => 4,
                'hospital_id' => 1,
                'doctor_id' => 4,
            ],
            [
                'id' => 5,
                'hospital_id' => 1,
                'doctor_id' => 5,
            ],
            [
                'id' => 6,
                'hospital_id' => 2,
                'doctor_id' => 6,
            ],
        ];
        DB::table('hospital_doctor')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('hospital_doctor')->truncate();
        Schema::enableForeignKeyConstraints();
    }
};
