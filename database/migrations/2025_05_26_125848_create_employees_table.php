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
            $table->string('suffix')->nullable(true);
            $table->string('civil_status')->nullable(true);
            $table->date('birth_date')->nullable(true);
            $table->string('birth_place')->nullable(true);
            $table->string('blood_type')->nullable(true);
            $table->string('gender')->nullable(true);
            $table->string('nationality')->nullable(true);
            $table->string('religion')->nullable(true);
            $table->string('telephone_number')->nullable(true);
            $table->string('mobile_number')->unique()->nullable(true);
            $table->string('email')->unique()->nullable(true);
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
            $table->string('emergency_contact_name')->nullable(true);
            $table->string('emergency_contact_relationship')->nullable(true);
            $table->string('emergency_contact_number')->nullable(true);
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
