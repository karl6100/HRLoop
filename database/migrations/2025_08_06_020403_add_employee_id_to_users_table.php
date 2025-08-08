<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('employee_id')->nullable()->unique();

            // Optionally add a foreign key constraint (if `employees.employee_id` is unique)
            $table->foreign('employee_id')
                  ->references('employee_id')
                  ->on('employees')
                  ->nullOnDelete(); // or ->cascadeOnDelete(), depending on your use case
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
            $table->dropColumn('employee_id');
        });
    }
};
