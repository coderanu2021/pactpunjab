<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['album_id', 'file_path', 'title'];

    public function album()
    {
        return $this->belongsTo(Album::class, 'album_id');
    }
}
