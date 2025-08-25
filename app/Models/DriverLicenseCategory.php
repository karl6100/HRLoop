<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverLicenseCategory extends Model
{
    /** @use HasFactory<\Database\Factories\DriverLicenseCategoryFactory> */
    use HasFactory;

    protected $fillable = [
        'driver_license_id',
        'category_code',
        'description'
    ];

    public function license()
    {
        return $this->belongsTo(DriverLicense::class);
    }
}
