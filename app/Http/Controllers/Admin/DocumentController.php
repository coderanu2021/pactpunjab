<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Download;

class DocumentController extends Controller
{
    public function reports() {
        $data = \App\Models\Report::latest()->paginate(10);
        return view('admin.documents.reports', compact('data'));
    }
    public function downloads() {
        $data = \App\Models\Download::latest()->paginate(10);
        return view('admin.documents.downloads', compact('data'));
    }

}
