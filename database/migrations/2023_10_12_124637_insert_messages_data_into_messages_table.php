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
        DB::table('messages')->truncate();
        Schema::enableForeignKeyConstraints();
        $data = [
            [
                'receiver_id' =>  15,
                'sender_id' =>  6,
                'booking_id' => "fresher.123",
                'message' => "This is a test appointment",
            ],
            [
                'receiver_id' =>  16,
                'sender_id' =>  7,
                'booking_id' => "fresher.223",
                'message' => "This is a test appointment",
            ],
            [
                'receiver_id' =>  16,
                'sender_id' => 6,
                'booking_id' => "fresher.1123",
                'message' => "This is a test appointment",
            ],
            [
                'receiver_id' =>  17,
                'sender_id' =>  6,
                'booking_id' => "fresher.33",
                'message' => "This is a test appointment",
            ],
            [
                'receiver_id' =>  18,
                'sender_id' =>  6,
                'booking_id' => "fresher.30",
                'message' => "This is a test appointment",
            ],
            [
                'receiver_id' =>  19,
                'sender_id' =>  6,
                'booking_id' => "fresher.39",
                'message' => "This is a test appointment",
            ],
        ];
        DB::table('messages')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('messages')->truncate();
        Schema::enableForeignKeyConstraints();
    }
};
