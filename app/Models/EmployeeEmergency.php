<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeEmergency extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeEmergencyFactory> */
    use HasFactory;

    protected $fillable = [
        'fkey_employee_id', // Foreign key to the Employee table
        'emergency_contact_name',
        'emergency_contact_relationship',
        'emergency_contact_phone',
        'emergency_street',
        'emergency_barangay',
        'emergency_city',
        'emergency_province',
        'emergency_zip_code',
        'emergency_country',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'fkey_employee_id', 'employee_id');
    }
}
