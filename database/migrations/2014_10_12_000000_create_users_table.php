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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('mobile')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('otp')->nullable();
            $table->string('image')->nullable();
            $table->string('doc_image')->nullable();
            $table->string('city')->nullable();
            $table->string('DIN')->nullable();
            $table->string('location')->nullable();
            $table->string('speciality_id')->nullable();
            $table->string('sleekcare_id')->nullable();
            $table->string('promotion_id')->nullable();
            $table->string('patient_id')->nullable();
            $table->string('role_id')->nullable();
            $table->string('clinic_id')->nullable();
            $table->string('package_id')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
