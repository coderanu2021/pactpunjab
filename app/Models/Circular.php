<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Circular extends Model
{
    protected $fillable = ['circular_id', 'subject', 'date_issued', 'target_audience', 'status'];
}
