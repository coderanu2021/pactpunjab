<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::orderBy('sort_order', 'asc')->latest();
        if ($request->search) {
            $query->where('title', 'like', "%{$request->search}%")
                  ->orWhere('description', 'like', "%{$request->search}%");
        }
        $data = $query->paginate(10)->withQueryString();
        return view('admin.cms.services', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon_class' => 'nullable|string',
            'category' => 'nullable|string',
            'sort_order' => 'integer'
        ]);
        Service::create($request->all());
        return response()->json(['success' => true, 'message' => 'Service added successfully.']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon_class' => 'nullable|string',
            'category' => 'nullable|string',
            'sort_order' => 'integer'
        ]);
        Service::findOrFail($id)->update($request->all());
        return response()->json(['success' => true, 'message' => 'Service updated successfully.']);
    }

    public function destroy($id)
    {
        Service::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Service deleted successfully.']);
    }

    public function show($id)
    {
        return response()->json(Service::findOrFail($id));
    }
}
