<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberCategory extends Model
{
    protected $fillable = ['name', 'annual_fee', 'status'];

    public function members()
    {
        return $this->hasMany(Member::class, 'category_id');
    }
}
