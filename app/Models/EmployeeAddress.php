<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAddress extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeAddressFactory> */
    use HasFactory;

    protected $fillable = [
        'fkey_employee_id', // Foreign key to the Employee table
        'street',
        'barangay',
        'city',
        'province',
        'zip_code',
        'country',
        'is_current',
    ];
    
    protected $casts = [
        'is_current' => 'boolean',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'fkey_employee_id', 'employee_id');
    }
}
