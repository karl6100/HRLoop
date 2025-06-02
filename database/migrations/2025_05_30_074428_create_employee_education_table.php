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
        Schema::create('employee_education', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('employee_id');
            $table->string('school')->nullable();
            $table->string('education_level')->nullable();
            $table->string('degree')->nullable();
            $table->string('start_year')->nullable();
            $table->string('end_year')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_education');
    }
};
