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
        DB::table('doctors')->truncate();
        Schema::enableForeignKeyConstraints();
        $data = [
            [
                'user_id' => 15,
                'hospital_id' => 1,
                'department_id' => 1,
                'license' => 'Fresher123',
                'experience' => 2,
                'bio' => 'Dr. Smith specializes in cardiology and has 2 years of experience in the field.',
                'duty_start_time' => '09:00:00',
                'duty_end_time' => '11:30:00',
                'is_visible' => true,
            ],
            [
                'user_id' => 16,
                'hospital_id' => 1,
                'department_id' => 2,
                'license' => 'Expert456',
                'experience' => 8,
                'bio' => 'Dr. Johnson is an experienced orthopedic surgeon with 8 years of practice.',
                'duty_start_time' => '10:00:00',
                'duty_end_time' => '13:00:00',
                'is_visible' => true,
            ],
            [
                'user_id' => 17,
                'hospital_id' => 1,
                'department_id' => 3,
                'license' => 'ProDoc789',
                'experience' => 15,
                'bio' => 'Dr. Davis is a renowned neurologist with 15 years of expertise in treating neurological disorders.',
                'duty_start_time' => '08:30:00',
                'duty_end_time' => '12:30:00',
                'is_visible' => true,
            ],
            [
                'user_id' => 18,
                'hospital_id' => 1,
                'department_id' => 4,
                'license' => 'PediaDoc101',
                'experience' => 5,
                'bio' => 'Dr. Wilson is a compassionate pediatrician dedicated to providing excellent care for children.',
                'duty_start_time' => '09:30:00',
                'duty_end_time' => '14:30:00',
                'is_visible' => true,
            ],
            [
                'user_id' => 19,
                'hospital_id' => 1,
                'department_id' => 5,
                'license' => 'OncologyDoc2023',
                'experience' => 3,
                'bio' => 'Dr. Anderson specializes in oncology and is committed to cancer research and patient care.',
                'duty_start_time' => '11:00:00',
                'duty_end_time' => '16:00:00',
                'is_visible' => true,
            ],
            [
                'user_id' => 20,
                'hospital_id' => 2,
                'department_id' => 5,
                'license' => 'OncologyDoc2023',
                'experience' => 3,
                'bio' => 'Dr. Anderson specializes in oncology and is committed to cancer research and patient care.',
                'duty_start_time' => '11:00:00',
                'duty_end_time' => '16:00:00',
                'is_visible' => true,
            ],
        ];


        DB::table('doctors')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('doctors')->truncate();
        Schema::enableForeignKeyConstraints();
    }
};
