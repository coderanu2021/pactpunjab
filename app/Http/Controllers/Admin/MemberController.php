<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\MemberCategory;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $query = Member::with('category')->latest();
        if ($request->search) {
            $q = $request->search;
            $query->where(function ($qb) use ($q) {
                $qb->where('name', 'like', "%$q%")
                   ->orWhere('member_id', 'like', "%$q%")
                   ->orWhere('firm_company', 'like', "%$q%");
            });
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        $data       = $query->paginate(10)->withQueryString();
        $categories = MemberCategory::where('status', 'Active')->get();
        return view('admin.members.index', compact('data', 'categories'));
    }

    public function show($id)
    {
        return response()->json(Member::with('category')->findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id'    => 'required|string|unique:members,member_id',
            'name'         => 'required|string|max:255',
            'firm_company' => 'nullable|string|max:255',
            'category_id'  => 'required|exists:member_categories,id',
            'status'       => 'required|in:Active,Inactive,Pending',
        ]);
        Member::create($request->only('member_id', 'name', 'firm_company', 'category_id', 'status'));
        return response()->json(['success' => true, 'message' => 'Member added successfully.']);
    }

    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);
        $request->validate([
            'member_id'    => 'required|string|unique:members,member_id,' . $id,
            'name'         => 'required|string|max:255',
            'firm_company' => 'nullable|string|max:255',
            'category_id'  => 'required|exists:member_categories,id',
            'status'       => 'required|in:Active,Inactive,Pending',
        ]);
        $member->update($request->only('member_id', 'name', 'firm_company', 'category_id', 'status'));
        return response()->json(['success' => true, 'message' => 'Member updated successfully.']);
    }

    public function destroy($id)
    {
        Member::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Member deleted.']);
    }

    // ── Member Categories ─────────────────────────────────────────────────────

    public function categories(Request $request)
    {
        $data = MemberCategory::latest()->paginate(10)->withQueryString();
        return view('admin.members.categories', compact('data'));
    }

    public function categoryShow($id)
    {
        return response()->json(MemberCategory::findOrFail($id));
    }

    public function categoryStore(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|unique:member_categories,name',
            'annual_fee' => 'required|numeric|min:0',
            'status'     => 'required|in:Active,Inactive',
        ]);
        MemberCategory::create($request->only('name', 'annual_fee', 'status'));
        return response()->json(['success' => true, 'message' => 'Category added.']);
    }

    public function categoryUpdate(Request $request, $id)
    {
        $request->validate([
            'name'       => 'required|string|unique:member_categories,name,' . $id,
            'annual_fee' => 'required|numeric|min:0',
            'status'     => 'required|in:Active,Inactive',
        ]);
        MemberCategory::findOrFail($id)->update($request->only('name', 'annual_fee', 'status'));
        return response()->json(['success' => true, 'message' => 'Category updated.']);
    }

    public function categoryDestroy($id)
    {
        MemberCategory::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Category deleted.']);
    }
}
