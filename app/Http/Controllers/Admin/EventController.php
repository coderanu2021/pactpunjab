<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventRegistration;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::latest();
        if ($request->search) {
            $q = $request->search;
            $query->where(function ($qb) use ($q) {
                $qb->where('name', 'like', "%$q%")
                   ->orWhere('event_id', 'like', "%$q%")
                   ->orWhere('location', 'like', "%$q%");
            });
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        $data = $query->paginate(10)->withQueryString();
        return view('admin.events.index', compact('data'));
    }

    public function show($id)
    {
        return response()->json(Event::findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'event_date' => 'required|date',
            'location'   => 'required|string|max:255',
            'status'     => 'required|in:Active,Completed,Cancelled',
        ]);
        $year   = now()->format('Y');
        $count  = Event::whereYear('created_at', $year)->count() + 1;
        $data   = $request->only('name', 'event_date', 'location', 'status');
        $data['event_id'] = 'EVT-' . $year . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);
        Event::create($data);
        return response()->json(['success' => true, 'message' => 'Event created successfully.']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'event_date' => 'required|date',
            'location'   => 'required|string|max:255',
            'status'     => 'required|in:Active,Completed,Cancelled',
        ]);
        Event::findOrFail($id)->update($request->only('name', 'event_date', 'location', 'status'));
        return response()->json(['success' => true, 'message' => 'Event updated.']);
    }

    public function destroy($id)
    {
        Event::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Event deleted.']);
    }

    // ── Event Registrations ───────────────────────────────────────────────────

    public function registrations(Request $request)
    {
        $query = EventRegistration::latest();
        if ($request->search) {
            $q = $request->search;
            $query->where(function ($qb) use ($q) {
                $qb->where('attendee_name', 'like', "%$q%")
                   ->orWhere('reg_id', 'like', "%$q%");
            });
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        $data   = $query->paginate(10)->withQueryString();
        $events = Event::where('status', 'Active')->get();
        return view('admin.events.registrations', compact('data', 'events'));
    }

    public function registrationShow($id)
    {
        return response()->json(EventRegistration::with('event')->findOrFail($id));
    }

    public function registrationStore(Request $request)
    {
        $request->validate([
            'attendee_name'  => 'required|string|max:255',
            'event_id'       => 'required|exists:events,id',
            'payment_status' => 'required|in:Paid,Pending',
            'status'         => 'required|in:Confirmed,Pending,Cancelled',
        ]);
        $year  = now()->format('Y');
        $count = EventRegistration::whereYear('created_at', $year)->count() + 1;
        $data  = $request->only('attendee_name', 'event_id', 'payment_status', 'status');
        $data['reg_id'] = 'EREG-' . $year . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
        EventRegistration::create($data);
        return response()->json(['success' => true, 'message' => 'Event registration added.']);
    }

    public function registrationUpdate(Request $request, $id)
    {
        $request->validate([
            'attendee_name'  => 'required|string|max:255',
            'event_id'       => 'required|exists:events,id',
            'payment_status' => 'required|in:Paid,Pending',
            'status'         => 'required|in:Confirmed,Pending,Cancelled',
        ]);
        EventRegistration::findOrFail($id)->update(
            $request->only('attendee_name', 'event_id', 'payment_status', 'status')
        );
        return response()->json(['success' => true, 'message' => 'Registration updated.']);
    }

    public function registrationDestroy($id)
    {
        EventRegistration::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Registration deleted.']);
    }
}
