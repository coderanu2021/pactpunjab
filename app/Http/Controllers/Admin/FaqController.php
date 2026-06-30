<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $query = Faq::orderBy('sort_order', 'asc')->latest();
        if ($request->search) {
            $query->where('question', 'like', "%{$request->search}%")
                  ->orWhere('answer', 'like', "%{$request->search}%");
        }
        $data = $query->paginate(10)->withQueryString();
        return view('admin.cms.faqs', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'category' => 'nullable|string',
            'sort_order' => 'integer'
        ]);
        Faq::create($request->all());
        return response()->json(['success' => true, 'message' => 'FAQ added successfully.']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'category' => 'nullable|string',
            'sort_order' => 'integer'
        ]);
        Faq::findOrFail($id)->update($request->all());
        return response()->json(['success' => true, 'message' => 'FAQ updated successfully.']);
    }

    public function destroy($id)
    {
        Faq::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'FAQ deleted successfully.']);
    }

    public function show($id)
    {
        return response()->json(Faq::findOrFail($id));
    }
}
