<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDependents extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeDependentsFactory> */
    use HasFactory;

    protected $fillable = [
        'fkey_employee_id', // Foreign key to the Employee table
        'fullname',
        'relationship',
        'dependent_birth_date',
    ];

    protected $casts = [
        'dependent_birth_date' => 'date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'fkey_employee_id', 'employee_id');
    }
}
