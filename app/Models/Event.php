<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['event_id', 'name', 'category', 'description', 'event_date', 'location', 'status'];

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class, 'event_id');
    }
}
