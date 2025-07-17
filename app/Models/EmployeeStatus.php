<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'fkey_employee_id', // Foreign key to the Employee table
        'employment_status', // e.g., 'Active', 'Inactive', 'On Leave'
        'effective_date', // Date when the status became effective
        'remarks', // Additional notes or remarks about the status change
    ];

    protected $casts = [
        'effective_date' => 'date', // Cast effective_date to a date type
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'fkey_employee_id', 'employee_id');
    }
}
