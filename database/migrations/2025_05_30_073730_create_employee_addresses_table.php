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
        Schema::create('employee_addresses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('fkey_employee_id');
            $table->foreign('fkey_employee_id')->references('employee_id')->on('employees')->onDelete('cascade');
            $table->string('street_address')->nullable(true);
            $table->string('barangay')->nullable(true);
            $table->string('city')->nullable(true);
            $table->string('province')->nullable(true);
            $table->string('zip_code')->nullable(true);
            $table->string('country')->nullable(true);
            $table->boolean('is_current')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_addresses');
    }
};
