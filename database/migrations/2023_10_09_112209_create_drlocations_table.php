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
        Schema::create('drlocations', function (Blueprint $table) {
            $table->id();
            $table->string('drid')->nullable();
            $table->string('address')->nullable();
            $table->string('status')->nullable();
            $table->string('avalaivility')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drlocations');
    }
};
