<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function website() {
        return view('admin.settings.website');
    }

    public function email() {
        return view('admin.settings.email');
    }

    public function general() {
        return view('admin.settings.general');
    }

}
