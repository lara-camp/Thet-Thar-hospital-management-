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
        DB::table('hospital_doctors')->truncate();
        Schema::enableForeignKeyConstraints();
        $data = [
            [
                'id' => 1,
                'hospital_id' => 1,
                'doctor_id' => 15,
            ],
            [
                'id' => 2,
                'hospital_id' => 1,
                'doctor_id' => 16,
            ],
            [
                'id' => 3,
                'hospital_id' => 1,
                'doctor_id' => 17,
            ],
            [
                'id' => 4,
                'hospital_id' => 1,
                'doctor_id' => 18,
            ],
            [
                'id' => 5,
                'hospital_id' => 1,
                'doctor_id' => 19,
            ],
            [
                'id' => 6,
                'hospital_id' => 2,
                'doctor_id' => 20,
            ],
        ];
        DB::table('hospital_doctors')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('hospital_doctors')->truncate();
        Schema::enableForeignKeyConstraints();
    }
};
