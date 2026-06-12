<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    public function home() {
        return view('admin.cms.home');
    }

    public function about() {
        return view('admin.cms.about');
    }

    public function contact() {
        return view('admin.cms.contact');
    }

    public function dynamic() {
        return view('admin.cms.dynamic');
    }

}
