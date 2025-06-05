<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAddress extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeAddressFactory> */
    use HasFactory;

    protected $fillable = [
        'employee_id', // Foreign key to the Employee table
        'street_address',
        'barangay',
        'city',
        'province',
        'zip_code',
        'country',
        'is_current',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }
}
