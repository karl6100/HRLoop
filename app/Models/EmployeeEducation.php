<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeEducation extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeEducationFactory> */
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'school',
        'degree',
        'education_level',
        'start_year',
        'end_year',
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
