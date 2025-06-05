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
        'gender',
        'nationality',
        'religion',
        'telephone_number',
        'mobile_number',
        'email',
        'department',
        'company',
        'position_title',
        'job_level',
        'hired_date',
        'employment_status',
        'sss_number',
        'philhealth_number',
        'pagibig_number',
        'tin_number',        
    ];
    
    public function employee_educations()
    {
        return $this->hasMany(EmployeeEducation::class);
    }
    
    public function employee_addresses()
    {
        return $this->hasMany(EmployeeAddress::class);
    }
    
    public function employee_dependents()
    {
        return $this->hasMany(EmployeeDependents::class);
    }
}

