<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssociationCertificate extends Model
{
    protected $fillable = ['cert_id', 'association_name', 'issue_date', 'expiry_date', 'status'];
}
