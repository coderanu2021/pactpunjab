<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommitteeMember extends Model
{
    protected $fillable = ['name', 'designation', 'type', 'image_path', 'sort_order'];
}
