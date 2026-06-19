<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = ['title', 'category', 'status'];

    public function images()
    {
        return $this->hasMany(Image::class, 'album_id');
    }
}
