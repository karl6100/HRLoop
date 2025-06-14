<?php

use Faker\Provider\ar_EG\Address;
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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('employee_id')->unique()->nullable(false);
            $table->string('first_name')->nullable(false);
            $table->string('last_name')->nullable(false);
            $table->string('middle_name')->nullable(true);
            $table->string('suffix');
            $table->string('civil_status');
            $table->date('birth_date');
            $table->string('birth_place');
            $table->string('blood_type');
            $table->string('gender');
            $table->string('nationality');
            $table->string('religion');
            $table->string('telephone_number');
            $table->string('mobile_number')->unique();
            $table->string('email')->unique();
            $table->string('department');
            $table->string('company');
            $table->string('position_title');
            $table->string('job_level');
            $table->date('hired_date');
            $table->string('employment_status');
            $table->string('sss_number')->nullable();
            $table->string('philhealth_number')->nullable();
            $table->string('pagibig_number')->nullable();
            $table->string('tin_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
