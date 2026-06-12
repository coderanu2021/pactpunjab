<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertificationRegistration extends Model
{
    protected $fillable = [
        'association',
        'firm_name',
        'district',
        'address',
        'proprietor',
        'mobile_primary',
        'contact2_name',
        'mobile_secondary',
        'email',
        'website',
        'portal',
        'companies_dealt_with',
        'services_offered',
    ];

    protected $casts = [
        'services_offered' => 'array',
    ];
}
