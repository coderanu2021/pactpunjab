<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MediaItem;
use Illuminate\Support\Facades\Storage;

class MediaItemController extends Controller
{
    public function index(Request $request)
    {
        $query = MediaItem::latest('published_date');
        
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('outlet', 'like', '%' . $request->search . '%');
            });
        }
        
        if ($request->type) {
            $query->where('type', $request->type);
        }
        
        $data = $query->paginate(10)->withQueryString();
        
        return view('admin.cms.media_items', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:coverage,release',
            'title' => 'required|string|max:255',
            'outlet' => 'nullable|string|max:255',
            'published_date' => 'required|date',
            'url' => 'nullable|url|max:500',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:10240',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50'
        ]);

        $data = $request->except('file');
        
        if ($request->hasFile('file')) {
            $data['file_path'] = $request->file('file')->store('media_items', 'public');
        }
        
        MediaItem::create($data);
        
        return response()->json(['success' => true, 'message' => 'Media item added successfully.']);
    }

    public function show($id)
    {
        return response()->json(MediaItem::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $item = MediaItem::findOrFail($id);
        
        $request->validate([
            'type' => 'required|in:coverage,release',
            'title' => 'required|string|max:255',
            'outlet' => 'nullable|string|max:255',
            'published_date' => 'required|date',
            'url' => 'nullable|url|max:500',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:10240',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50'
        ]);

        $data = $request->except('file');
        
        if ($request->hasFile('file')) {
            if ($item->file_path && Storage::disk('public')->exists($item->file_path)) {
                Storage::disk('public')->delete($item->file_path);
            }
            $data['file_path'] = $request->file('file')->store('media_items', 'public');
        }
        
        $item->update($data);
        
        return response()->json(['success' => true, 'message' => 'Media item updated successfully.']);
    }

    public function destroy($id)
    {
        $item = MediaItem::findOrFail($id);
        
        if ($item->file_path && Storage::disk('public')->exists($item->file_path)) {
            Storage::disk('public')->delete($item->file_path);
        }
        
        $item->delete();
        
        return response()->json(['success' => true, 'message' => 'Media item deleted successfully.']);
    }
}
