<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'first_name',
        'last_name',
        'middle_name',
        'suffix',
        'civil_status',
        'birth_date',
        'birth_place',
        'blood_type',
        'telephone_number',
        'mobile_number',
        'email',
        'department',
        'position_title',
        'job_level',
        'function',
        'regularization_date',
        'employment_status'
    ];
}
