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
        Schema::create('driver_license_categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreign('driver_license_id')->references('id')->on('drivers_license')->onDelete('cascade');
            $table->string('category_code');        // A, B, C, D, etc.
            $table->string('description')->nullable(true); // ex. "Motorcycle", "Passenger Cars"
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_license_categories');
    }
};
