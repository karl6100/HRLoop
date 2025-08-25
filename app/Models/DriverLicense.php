<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverLicense extends Model
{
    /** @use HasFactory<\Database\Factories\DriverLicenseFactory> */
    use HasFactory;

    protected $fillable = [
        'fkey_employee_id',
        'license_number',
        'license_type',
        'expiry_date'

    ];

    public function categories()
    {
        return $this->hasMany(DriverLicenseCategory::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
