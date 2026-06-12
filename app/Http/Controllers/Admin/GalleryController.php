<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Image;

class GalleryController extends Controller
{
    public function albums() {
        $data = \App\Models\Album::latest()->paginate(10);
        return view('admin.gallery.albums', compact('data'));
    }
    public function images() {
        $data = \App\Models\Image::latest()->paginate(10);
        return view('admin.gallery.images', compact('data'));
    }

}
