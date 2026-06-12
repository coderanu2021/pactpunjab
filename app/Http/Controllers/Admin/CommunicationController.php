<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Circular;
use App\Models\Enquiry;
use App\Models\Notification;
use App\Models\Newsletter;

class CommunicationController extends Controller
{
    public function circulars() {
        $data = \App\Models\Circular::latest()->paginate(10);
        return view('admin.communication.circulars', compact('data'));
    }
    public function enquiries() {
        $data = \App\Models\Enquiry::latest()->paginate(10);
        return view('admin.communication.enquiries', compact('data'));
    }
    public function notifications() {
        $data = \App\Models\Notification::latest()->paginate(10);
        return view('admin.communication.notifications', compact('data'));
    }
    public function newsletter() {
        $data = \App\Models\Newsletter::latest()->paginate(10);
        return view('admin.communication.newsletter', compact('data'));
    }

}
