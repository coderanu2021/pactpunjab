<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberCategory extends Model
{
    protected $fillable = ['name', 'description', 'features', 'is_popular', 'annual_fee', 'status'];

    protected $casts = [
        'features' => 'array',
        'is_popular' => 'boolean',
    ];

    public function members()
    {
        return $this->hasMany(Member::class, 'category_id');
    }
}
