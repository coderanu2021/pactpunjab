<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaItem extends Model
{
    protected $fillable = [
        'type', 'title', 'description', 'outlet', 'icon', 'published_date', 'url', 'file_path'
    ];
    
    protected $casts = [
        'published_date' => 'date',
    ];
}
