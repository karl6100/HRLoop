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
        Schema::create('employee_compensation', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('fkey_employee_id');
            $table->foreign('fkey_employee_id')->references('employee_id')->on('employees')->onDelete('cascade');
            $table->string('pay_type')->nullable(true);
            $table->decimal('basic_salary', 10, 2)->nullable(true);
            $table->decimal('allowance', 10, 2)->nullable()->nullable(true);
            $table->decimal('monthly_rate', 10, 2)->nullable();
            $table->date('effective_date')->nullable(true);
            $table->string('remarks')->nullable();
            $table->boolean('is_current')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_compensation');
    }
};
