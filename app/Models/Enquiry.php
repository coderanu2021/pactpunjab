<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = ['enquiry_id', 'sender_name', 'subject', 'status'];
}
