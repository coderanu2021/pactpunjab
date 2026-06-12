<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    protected $fillable = ['reg_id', 'attendee_name', 'event_id', 'payment_status', 'status'];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
