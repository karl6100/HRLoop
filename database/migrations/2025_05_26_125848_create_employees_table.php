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
            $table->string('employee_id')->nullable(false);
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
            $table->enum('job_level');
            $table->string('function');
            $table->date('regularization_date')->nullable();
            $table->enum('employment_status');
        });

        Schema::create('employee_address', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('employee_id');
            $table->string('street_address');
            $table->string('barangay');
            $table->string('city');
            $table->string('province');
            $table->string('zip_code');
            $table->string('country')->default('Philippines');
            $table->boolean('is_current')->default(false);
        });

        Schema::create('employee_salary', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('employee_id');
            $table->enum('pay_type', ['Monthly', 'Daily', 'Hourly'])->default('Daily');
            $table->decimal('basic_salary', 10, 2);
            $table->decimal('monthly_rate', 10, 2);
            $table->decimal('allowances', 10, 2)->nullable();
        });

        Schema::create('employee_premiums', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('employee_id');
            $table->string('sss_no')->nullable();
            $table->string('philhealth_number')->nullable();
            $table->string('pagibig_number')->nullable();
            $table->string('tin_number')->nullable();
        });

        Schema::create('employee_education', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('employee_id');
            $table->string('school')->nullable();
            $table->string('attainment')->nullable();
            $table->string('year')->nullable();
        });

        Schema::create('employee_dependents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('employee_id');
            $table->string('fullname')->nullable();
            $table->string('birth_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
        Schema::dropIfExists('employee_address');
        Schema::dropIfExists('employee_salary');
        Schema::dropIfExists('employee_premiums');
        Schema::dropIfExists('employee_education');
        Schema::dropIfExists('employee_dependents');
    }
};
