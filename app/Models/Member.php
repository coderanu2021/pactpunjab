<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'member_id', 'name', 'firm_company', 'category_id', 'status',
    ];

    public function category()
    {
        return $this->belongsTo(MemberCategory::class, 'category_id');
    }
}
