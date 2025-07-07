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
        Schema::table('employee_emergencies', function (Blueprint $table) {
            $table->string('emergency_street')->nullable(true);
            $table->string('emergency_barangay')->nullable(true);
            $table->string('emergency_city')->nullable(true);
            $table->string('emergency_province')->nullable(true);
            $table->string('emergency_zip_code')->nullable(true);
            $table->string('emergency_country')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employee_emergencies', function (Blueprint $table) {
            $table->dropColumn([
                'emergency_street',
                'emergency_barangay',
                'emergency_city',
                'emergency_province',
                'emergency_zip_code',
                'emergency_country'
            ]);
        });
    }
};
