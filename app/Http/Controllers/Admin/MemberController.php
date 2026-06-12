<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MemberCategory;
use App\Models\Member;

class MemberController extends Controller
{
    public function categories() {
        $data = \App\Models\MemberCategory::latest()->paginate(10);
        return view('admin.members.categories', compact('data'));
    }
    public function index() {
        $data = \App\Models\Member::latest()->paginate(10);
        return view('admin.members.index', compact('data'));
    }

}
