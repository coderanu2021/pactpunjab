<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CommitteeMember;

class CommitteeMemberController extends Controller
{
    public function index(Request $request)
    {
        $query = CommitteeMember::orderBy('sort_order', 'asc')->latest();
        if ($request->search) {
            $query->where('name', 'like', "%{$request->search}%")
                  ->orWhere('designation', 'like', "%{$request->search}%");
        }
        $data = $query->paginate(10)->withQueryString();
        return view('admin.cms.committee', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'type' => 'required|string',
            'sort_order' => 'integer'
        ]);
        CommitteeMember::create($request->all());
        return response()->json(['success' => true, 'message' => 'Member added successfully.']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'type' => 'required|string',
            'sort_order' => 'integer'
        ]);
        CommitteeMember::findOrFail($id)->update($request->all());
        return response()->json(['success' => true, 'message' => 'Member updated successfully.']);
    }

    public function destroy($id)
    {
        CommitteeMember::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Member deleted successfully.']);
    }

    public function show($id)
    {
        return response()->json(CommitteeMember::findOrFail($id));
    }
}
