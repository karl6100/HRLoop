<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDependents extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeDependentsFactory> */
    use HasFactory;

    protected $fillable = [
        'employee_id', // Foreign key to the Employee table
        'fullname',
        'relationship',
        'birth_date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }
}
