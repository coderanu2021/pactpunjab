<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Download;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    // ── Reports ───────────────────────────────────────────────────────────────

    public function reports(Request $request)
    {
        $query = Report::latest();
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        $data = $query->paginate(10)->withQueryString();
        return view('admin.documents.reports', compact('data'));
    }

    public function reportShow($id)
    {
        return response()->json(Report::findOrFail($id));
    }

    public function reportStore(Request $request)
    {
        $request->validate([
            'title'  => 'required|string|max:255',
            'file'   => 'required|file|mimes:pdf,doc,docx|max:10240',
            'status' => 'required|in:Published,Draft',
        ]);
        $path = $request->file('file')->store('reports', 'public');
        Report::create(['title' => $request->title, 'file_path' => $path, 'status' => $request->status]);
        return response()->json(['success' => true, 'message' => 'Report uploaded.']);
    }

    public function reportUpdate(Request $request, $id)
    {
        $report = Report::findOrFail($id);
        $request->validate([
            'title'  => 'required|string|max:255',
            'status' => 'required|in:Published,Draft',
        ]);
        if ($request->hasFile('file')) {
            $request->validate(['file' => 'file|mimes:pdf,doc,docx|max:10240']);
            Storage::disk('public')->delete($report->file_path);
            $report->file_path = $request->file('file')->store('reports', 'public');
        }
        $report->update(['title' => $request->title, 'status' => $request->status, 'file_path' => $report->file_path]);
        return response()->json(['success' => true, 'message' => 'Report updated.']);
    }

    public function reportDestroy($id)
    {
        $report = Report::findOrFail($id);
        Storage::disk('public')->delete($report->file_path);
        $report->delete();
        return response()->json(['success' => true, 'message' => 'Report deleted.']);
    }

    // ── Downloads ─────────────────────────────────────────────────────────────

    public function downloads(Request $request)
    {
        $query = Download::latest();
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        $data = $query->paginate(10)->withQueryString();
        return view('admin.documents.downloads', compact('data'));
    }

    public function downloadShow($id)
    {
        return response()->json(Download::findOrFail($id));
    }

    public function downloadStore(Request $request)
    {
        $request->validate([
            'title'  => 'required|string|max:255',
            'file'   => 'required|file|mimes:pdf,doc,docx,xlsx,zip|max:10240',
            'status' => 'required|in:Active,Inactive',
        ]);
        $path = $request->file('file')->store('downloads', 'public');
        Download::create(['title' => $request->title, 'file_path' => $path, 'status' => $request->status]);
        return response()->json(['success' => true, 'message' => 'File uploaded.']);
    }

    public function downloadUpdate(Request $request, $id)
    {
        $dl = Download::findOrFail($id);
        $request->validate([
            'title'  => 'required|string|max:255',
            'status' => 'required|in:Active,Inactive',
        ]);
        if ($request->hasFile('file')) {
            $request->validate(['file' => 'file|mimes:pdf,doc,docx,xlsx,zip|max:10240']);
            Storage::disk('public')->delete($dl->file_path);
            $dl->file_path = $request->file('file')->store('downloads', 'public');
        }
        $dl->update(['title' => $request->title, 'status' => $request->status, 'file_path' => $dl->file_path]);
        return response()->json(['success' => true, 'message' => 'File updated.']);
    }

    public function downloadDestroy($id)
    {
        $dl = Download::findOrFail($id);
        Storage::disk('public')->delete($dl->file_path);
        $dl->delete();
        return response()->json(['success' => true, 'message' => 'File deleted.']);
    }
}
