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
            $table->enum('suffix', ['Jr.', 'Sr.', 'III', 'IV', 'V', 'None'])->default('None');
            $table->enum('civil_status', ['Single', 'Married', 'Widowed', 'Separated', 'Divorced'])->default('Single');
            $table->date('birth_date');
            $table->string('birth_place');
            $table->enum('blood_type', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])->default('O+');
            $table->string('telephone_number');
            $table->string('mobile_number')->unique();
            $table->string('email')->unique();
            $table->string('department');
            $table->string('position_title');
            $table->enum('job_level', ['Rank-and-File/Staff', 'Supervisor', 'Department Manager', 'Division Manager', 'Executive', 'None'])->default('None');
            $table->string('function');
            $table->date('regularization_date')->nullable();
            $table->enum('employment_status', ['Probationary', 'Regular', 'Contractual', 'Casual', 'Job Order']);
        });

        Schema::create('address', function (Blueprint $table) {
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

        Schema::create('salary', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('employee_id');
            $table->enum('pay_type', ['Monthly', 'Daily', 'Hourly'])->default('Daily');
            $table->decimal('basic_salary', 10, 2);
            $table->decimal('monthly_rate', 10, 2);
            $table->decimal('allowances', 10, 2)->nullable();
        });

        Schema::create('premiums', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('employee_id');
            $table->string('sss_no')->nullable();
            $table->string('philhealth_number')->nullable();
            $table->string('pagibig_number')->nullable();
            $table->string('tin_number')->nullable();
        });

        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('employee_id');
            $table->string('school')->nullable();
            $table->string('attainment')->nullable();
            $table->string('year')->nullable();
        });

        Schema::create('dependents', function (Blueprint $table) {
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
        Schema::dropIfExists('address');
        Schema::dropIfExists('salary');
        Schema::dropIfExists('premiums');
        Schema::dropIfExists('education');
        Schema::dropIfExists('dependents');
    }
};
