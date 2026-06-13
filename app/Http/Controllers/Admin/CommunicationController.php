<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Circular;
use App\Models\Enquiry;
use App\Models\Notification;
use App\Models\Newsletter;

class CommunicationController extends Controller
{
    // ── Notifications ─────────────────────────────────────────────────────────

    public function notifications(Request $request)
    {
        $query = Notification::latest();
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        $data = $query->paginate(10)->withQueryString();
        return view('admin.communication.notifications', compact('data'));
    }

    public function notificationShow($id)
    {
        return response()->json(Notification::findOrFail($id));
    }

    public function notificationStore(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'message' => 'required|string',
            'status'  => 'required|in:Active,Inactive',
        ]);
        Notification::create($request->only('title', 'message', 'status'));
        return response()->json(['success' => true, 'message' => 'Notification created.']);
    }

    public function notificationUpdate(Request $request, $id)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'message' => 'required|string',
            'status'  => 'required|in:Active,Inactive',
        ]);
        Notification::findOrFail($id)->update($request->only('title', 'message', 'status'));
        return response()->json(['success' => true, 'message' => 'Notification updated.']);
    }

    public function notificationDestroy($id)
    {
        Notification::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Notification deleted.']);
    }

    // ── Circulars ─────────────────────────────────────────────────────────────

    public function circulars(Request $request)
    {
        $query = Circular::latest();
        if ($request->search) {
            $q = $request->search;
            $query->where(function ($qb) use ($q) {
                $qb->where('subject', 'like', "%$q%")
                   ->orWhere('circular_id', 'like', "%$q%");
            });
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        $data = $query->paginate(10)->withQueryString();
        return view('admin.communication.circulars', compact('data'));
    }

    public function circularShow($id)
    {
        return response()->json(Circular::findOrFail($id));
    }

    public function circularStore(Request $request)
    {
        $request->validate([
            'subject'         => 'required|string|max:255',
            'date_issued'     => 'required|date',
            'target_audience' => 'required|string|max:255',
            'status'          => 'required|in:Published,Draft',
        ]);
        $year  = now()->format('Y');
        $count = Circular::whereYear('created_at', $year)->count() + 1;
        $data  = $request->only('subject', 'date_issued', 'target_audience', 'status');
        $data['circular_id'] = 'CIR-' . $year . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);
        Circular::create($data);
        return response()->json(['success' => true, 'message' => 'Circular published.']);
    }

    public function circularUpdate(Request $request, $id)
    {
        $request->validate([
            'subject'         => 'required|string|max:255',
            'date_issued'     => 'required|date',
            'target_audience' => 'required|string|max:255',
            'status'          => 'required|in:Published,Draft',
        ]);
        Circular::findOrFail($id)->update(
            $request->only('subject', 'date_issued', 'target_audience', 'status')
        );
        return response()->json(['success' => true, 'message' => 'Circular updated.']);
    }

    public function circularDestroy($id)
    {
        Circular::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Circular deleted.']);
    }

    // ── Newsletter ────────────────────────────────────────────────────────────

    public function newsletter(Request $request)
    {
        $query = Newsletter::latest();
        if ($request->search) {
            $query->where('subject', 'like', '%' . $request->search . '%');
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        $data = $query->paginate(10)->withQueryString();
        return view('admin.communication.newsletter', compact('data'));
    }

    public function newsletterShow($id)
    {
        return response()->json(Newsletter::findOrFail($id));
    }

    public function newsletterStore(Request $request)
    {
        $request->validate([
            'subject'   => 'required|string|max:255',
            'sent_date' => 'required|date',
            'status'    => 'required|in:Sent,Draft',
        ]);
        Newsletter::create($request->only('subject', 'sent_date', 'status'));
        return response()->json(['success' => true, 'message' => 'Newsletter saved.']);
    }

    public function newsletterUpdate(Request $request, $id)
    {
        $request->validate([
            'subject'   => 'required|string|max:255',
            'sent_date' => 'required|date',
            'status'    => 'required|in:Sent,Draft',
        ]);
        Newsletter::findOrFail($id)->update($request->only('subject', 'sent_date', 'status'));
        return response()->json(['success' => true, 'message' => 'Newsletter updated.']);
    }

    public function newsletterDestroy($id)
    {
        Newsletter::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Newsletter deleted.']);
    }

    // ── Enquiries ─────────────────────────────────────────────────────────────

    public function enquiries(Request $request)
    {
        $query = Enquiry::latest();
        if ($request->search) {
            $q = $request->search;
            $query->where(function ($qb) use ($q) {
                $qb->where('sender_name', 'like', "%$q%")
                   ->orWhere('subject', 'like', "%$q%")
                   ->orWhere('enquiry_id', 'like', "%$q%");
            });
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        $data = $query->paginate(10)->withQueryString();
        return view('admin.communication.enquiries', compact('data'));
    }

    public function enquiryShow($id)
    {
        return response()->json(Enquiry::findOrFail($id));
    }

    public function enquiryUpdate(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:Open,Resolved,Closed']);
        Enquiry::findOrFail($id)->update(['status' => $request->status]);
        return response()->json(['success' => true, 'message' => 'Enquiry status updated.']);
    }

    public function enquiryDestroy($id)
    {
        Enquiry::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Enquiry deleted.']);
    }
}
