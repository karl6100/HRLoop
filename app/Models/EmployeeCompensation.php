<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeCompensation extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeCompensationFactory> */
    use HasFactory;

    protected $fillable = [
        'fkey_employee_id', // Foreign key to the Employee table
        'pay_type',
        'basic_salary',
        'allowance',
        'monthly_rate', 
        'effective_date',
        'remarks',
        'is_current',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'fkey_employee_id', 'employee_id');
    }
}
