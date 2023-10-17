<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->unsigned();
            $table->foreignId('doctor_id')->unsigned();
            $table->string('booking_id')->unique();
            $table->time('appointment_time')->default(now()->toTimeString());
            $table->date('appointment_date')->default(now()->toDateString());
            $table->text('description')->nullable();
            $table->enum('status', ['completed', 'cancelled', 'upcoming', 'active'])->default('upcoming');
            $table->enum('appointment_type', ['outpatient', 'chat', 'video'])->nullable();
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
