<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;

    public function initials(): string
    {
        return Str::of("{$this->first_name} {$this->last_name}")
            ->explode(' ')
            ->map(fn($name) => Str::substr($name, 0, 1))
            ->implode('');
    }

    protected $primaryKey = 'employee_id';
    public $incrementing = false;      // employee_id comes from the UI, not AUTO_INCREMENT
    protected $keyType = 'string';     // or 'int' if it’s numeric

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

    protected $casts = [
        'birth_date' => 'date',
        'hired_date' => 'date',
    ];

    public function employeeEducations()
    {
        return $this->hasMany(EmployeeEducation::class, 'fkey_employee_id', 'employee_id');
    }

    public function employeeAddresses()
    {
        return $this->hasMany(EmployeeAddress::class, 'fkey_employee_id', 'employee_id');
    }

    public function employeeDependents()
    {
        return $this->hasMany(EmployeeDependents::class, 'fkey_employee_id', 'employee_id');
    }

    public function employeeCompensations()
    {
        return $this->hasMany(EmployeeCompensation::class, 'fkey_employee_id', 'employee_id');
    }

    public function employeeEmergencies()
    {
        return $this->hasMany(EmployeeEmergency::class, 'fkey_employee_id', 'employee_id');
    }

    public function employeePositions()
    {
        return $this->hasMany(EmployeePosition::class, 'fkey_employee_id', 'employee_id');
    }

    public function employeeStatus()
    {
        return $this->hasMany(EmployeeStatus::class, 'fkey_employee_id', 'employee_id');
    }
}
