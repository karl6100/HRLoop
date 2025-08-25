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
        Schema::create('driver_licenses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('fkey_employee_id');
            $table->foreign('fkey_employee_id')->references('employee_id')->on('employees')->onDelete('cascade');
            $table->string('license_number')->unique()->nullable(true);
            $table->string('license_type')->nullable(true); // Non-Professional / Professional
            $table->date('expiry_date')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_licenses');
    }
};
