<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function albums(Request $request)
    {
        $query = Album::withCount('images')->latest();
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        $data = $query->paginate(10)->withQueryString();
        return view('admin.gallery.albums', compact('data'));
    }

    public function albumShow($id)
    {
        return response()->json(Album::withCount('images')->findOrFail($id));
    }

    public function albumStore(Request $request)
    {
        $request->validate([
            'title'  => 'required|string|max:255',
            'status' => 'required|in:Published,Draft',
        ]);
        Album::create($request->only('title', 'status'));
        return response()->json(['success' => true, 'message' => 'Album created.']);
    }

    public function albumUpdate(Request $request, $id)
    {
        $request->validate([
            'title'  => 'required|string|max:255',
            'status' => 'required|in:Published,Draft',
        ]);
        Album::findOrFail($id)->update($request->only('title', 'status'));
        return response()->json(['success' => true, 'message' => 'Album updated.']);
    }

    public function albumDestroy($id)
    {
        Album::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Album deleted.']);
    }

    // ── Images ────────────────────────────────────────────────────────────────

    public function images(Request $request)
    {
        $query = Image::with('album')->latest();
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->album_id) {
            $query->where('album_id', $request->album_id);
        }
        $data   = $query->paginate(15)->withQueryString();
        $albums = Album::where('status', 'Published')->get();
        return view('admin.gallery.images', compact('data', 'albums'));
    }

    public function imageShow($id)
    {
        return response()->json(Image::with('album')->findOrFail($id));
    }

    public function imageStore(Request $request)
    {
        $request->validate([
            'album_id'  => 'required|exists:albums,id',
            'title'     => 'nullable|string|max:255',
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'status'    => 'required|in:Active,Inactive',
        ]);
        $path = $request->file('image')->store('gallery', 'public');
        Image::create([
            'album_id'  => $request->album_id,
            'title'     => $request->title,
            'file_path' => $path,
            'status'    => $request->status,
        ]);
        return response()->json(['success' => true, 'message' => 'Image uploaded.']);
    }

    public function imageUpdate(Request $request, $id)
    {
        $request->validate([
            'album_id' => 'required|exists:albums,id',
            'title'    => 'nullable|string|max:255',
            'status'   => 'required|in:Active,Inactive',
        ]);
        $image = Image::findOrFail($id);
        if ($request->hasFile('image')) {
            $request->validate(['image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:4096']);
            Storage::disk('public')->delete($image->file_path);
            $image->file_path = $request->file('image')->store('gallery', 'public');
        }
        $image->update([
            'album_id' => $request->album_id,
            'title'    => $request->title,
            'status'   => $request->status,
            'file_path'=> $image->file_path,
        ]);
        return response()->json(['success' => true, 'message' => 'Image updated.']);
    }

    public function imageDestroy($id)
    {
        $image = Image::findOrFail($id);
        Storage::disk('public')->delete($image->file_path);
        $image->delete();
        return response()->json(['success' => true, 'message' => 'Image deleted.']);
    }
}
