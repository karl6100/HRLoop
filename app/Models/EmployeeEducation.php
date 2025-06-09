<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeEducation extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeEducationFactory> */
    use HasFactory;

    protected $fillable = [
        'fkey_employee_id', // Foreign key to the Employee table
        'education_level',
        'school',
        'degree',
        'start_year',
        'end_year',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'fkey_employee_id', 'employee_id');
    }
}
