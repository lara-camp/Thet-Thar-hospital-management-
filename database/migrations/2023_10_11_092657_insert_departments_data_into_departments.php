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
        DB::table('departments')->truncate();
        Schema::enableForeignKeyConstraints();
        $data = [
            [
                'id' => 1,
                'name' => 'Cardiology',
            ],
            [
                'id' => 2,
                'name' => 'Orthopedics',
            ],
            [
                'id' => 3,
                'name' => 'Neurology',
            ],
            [
                'id' => 4,
                'name' => 'Pediatrics',
            ],
            [
                'id' => 5,
                'name' => 'Oncology',
            ],
            [
                'id' => 6,
                'name' => 'Dermatology',
            ],
            [
                'id' => 7,
                'name' => 'Gynecology',
            ],
            [
                'id' => 8,
                'name' => 'Urology',
            ],
            [
                'id' => 9,
                'name' => 'ENT (Ear, Nose, and Throat)',
            ],
            [
                'id' => 10,
                'name' => 'Ophthalmology',
            ],
        ];

        DB::table('departments')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('departments')->truncate();
        Schema::enableForeignKeyConstraints();
    }
};
