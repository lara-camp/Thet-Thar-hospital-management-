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
        // Truncate the criteria table
        Schema::disableForeignKeyConstraints();
        DB::table('hospitals')->truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            [
                'id' => 1,
                'name' => 'Hospital One',
                'phone' => '+13129498088',
                'email' => 'hospitalone@gmail.com',
                'address' => '9717 Kihn Lakes Edaview, WI 99814',
                'location' => 'Yangon',
                'is_visible' => 1,
                'user_id' => 1,
                'bio' => 'The special one of yangon',
            ],
            [
                'id' => 2,
                'name' => 'Medical Center A',
                'phone' => '+19876543210',
                'email' => 'medicalcenterA@example.com',
                'address' => '1234 Elm Street, Springfield, IL 62701',
                'location' => 'Springfield',
                'is_visible' => 1,
                'user_id' => 2,
                'bio' => 'Providing quality healthcare in Springfield',
            ],
            [
                'id' => 3,
                'name' => 'Healthcare Hub',
                'phone' => '+11234567890',
                'email' => 'healthcarehub@mail.com',
                'address' => '555 Elm Avenue, Rivertown, CA 90210',
                'location' => 'Rivertown',
                'is_visible' => 1,
                'user_id' => 3,
                'bio' => 'Your trusted partner for health and wellness',
            ],
            [
                'id' => 4,
                'name' => 'Life Care Center',
                'phone' => '+19990001122',
                'email' => 'lifecarecenter@mail.org',
                'address' => '555 Sycamore Avenue, Tranquil Town, CO 80001',
                'location' => 'Tranquil Town',
                'is_visible' => 0,
                'user_id' => 4,
                'bio' => 'Caring for your life, one step at a time',
            ],
            [
                'id' => 5,
                'name' => 'Central Health Clinic',
                'phone' => '+12223334455',
                'email' => 'centralhealthclinic@example.net',
                'address' => '777 Willow Lane, Central City, WA 98001',
                'location' => 'Central City',
                'is_visible' => 0,
                'user_id' => 5,
                'bio' => 'Your central destination for healthcare',
            ]
        ];

        DB::table('hospitals')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('hospitals')->truncate();
        Schema::enableForeignKeyConstraints();
    }
};
