<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalCertificate extends Model
{
    protected $fillable = ['cert_id', 'issued_to', 'issue_date', 'expiry_date', 'status'];
}
