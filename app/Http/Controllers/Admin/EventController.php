<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventRegistration;

class EventController extends Controller
{
    public function index() {
        $data = \App\Models\Event::latest()->paginate(10);
        return view('admin.events.index', compact('data'));
    }
    public function registrations() {
        $data = \App\Models\EventRegistration::latest()->paginate(10);
        return view('admin.events.registrations', compact('data'));
    }

}
