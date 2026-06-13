<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalCertificate extends Model
{
    protected $fillable = [
        'registration_id', 'cert_id', 'issued_to',
        'issue_date', 'expiry_date', 'status',
    ];

    public function registration()
    {
        return $this->belongsTo(CertificationRegistration::class, 'registration_id');
    }
}
