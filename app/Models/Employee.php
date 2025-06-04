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
    ];
    
    public function employee_educations()
    {
        return $this->hasMany(Employee_Education::class);
    }
    
    public function employee_addresses()
    {
        return $this->hasMany(Employee_Address::class);
    }
    
    public function employee_dependents()
    {
        return $this->hasMany(Employee_Dependents::class);
    }
}

