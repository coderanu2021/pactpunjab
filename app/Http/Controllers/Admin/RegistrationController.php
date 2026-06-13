<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CertificationRegistration;
use App\Models\PersonalCertificate;
use Carbon\Carbon;

class RegistrationController extends Controller
{
    // ── List views ───────────────────────────────────────────────────────────

    public function personal(Request $request)
    {
        $query = CertificationRegistration::latest();
        if ($request->search) {
            $q = $request->search;
            $query->where(function ($qb) use ($q) {
                $qb->where('firm_name', 'like', "%$q%")
                   ->orWhere('proprietor', 'like', "%$q%")
                   ->orWhere('district', 'like', "%$q%")
                   ->orWhere('email', 'like', "%$q%");
            });
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        $data = $query->paginate(10)->withQueryString();
        $stats = [
            'total'    => CertificationRegistration::count(),
            'pending'  => CertificationRegistration::where('status', 'Pending')->count(),
            'approved' => CertificationRegistration::where('status', 'Approved')->count(),
            'rejected' => CertificationRegistration::where('status', 'Rejected')->count(),
        ];
        return view('admin.registration.personal_registrations', compact('data', 'stats'));
    }

    public function association(Request $request)
    {
        $query = CertificationRegistration::latest();
        if ($request->search) {
            $q = $request->search;
            $query->where(function ($qb) use ($q) {
                $qb->where('firm_name', 'like', "%$q%")
                   ->orWhere('association', 'like', "%$q%")
                   ->orWhere('district', 'like', "%$q%");
            });
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        $data = $query->paginate(10)->withQueryString();
        $stats = [
            'total'    => CertificationRegistration::count(),
            'pending'  => CertificationRegistration::where('status', 'Pending')->count(),
            'approved' => CertificationRegistration::where('status', 'Approved')->count(),
            'rejected' => CertificationRegistration::where('status', 'Rejected')->count(),
        ];
        return view('admin.registration.association_registrations', compact('data', 'stats'));
    }

    public function pending(Request $request)
    {
        $data = CertificationRegistration::where('status', 'Pending')
            ->latest()->paginate(10)->withQueryString();
        return view('admin.registration.pending_approvals', compact('data'));
    }

    public function approved(Request $request)
    {
        $data = CertificationRegistration::where('status', 'Approved')
            ->latest()->paginate(10)->withQueryString();
        return view('admin.registration.approved_registrations', compact('data'));
    }

    public function rejected(Request $request)
    {
        $data = CertificationRegistration::where('status', 'Rejected')
            ->latest()->paginate(10)->withQueryString();
        return view('admin.registration.rejected_registrations', compact('data'));
    }

    // ── AJAX show (for view modal) ────────────────────────────────────────────

    public function show($id)
    {
        $reg = CertificationRegistration::with('certificate')->findOrFail($id);
        return response()->json($reg);
    }

    // ── Store (admin manual add) ──────────────────────────────────────────────

    public function store(Request $request)
    {
        $validated = $request->validate([
            'association'          => 'required|string|max:255',
            'firm_name'            => 'required|string|max:255',
            'district'             => 'required|string|max:100',
            'address'              => 'required|string',
            'proprietor'           => 'required|string|max:255',
            'mobile_primary'       => 'required|string|max:20',
            'contact2_name'        => 'nullable|string|max:255',
            'mobile_secondary'     => 'nullable|string|max:20',
            'email'                => 'required|email|max:255',
            'website'              => 'nullable|url|max:255',
            'companies_dealt_with' => 'required|string',
            'services_offered'     => 'required|array',
            'status'               => 'required|in:Pending,Approved,Rejected',
        ]);

        CertificationRegistration::create($validated);

        return redirect()->route('admin.registration.personal')
            ->with('success', 'Registration added successfully.');
    }

    // ── Update ────────────────────────────────────────────────────────────────

    public function update(Request $request, $id)
    {
        $reg = CertificationRegistration::findOrFail($id);

        $validated = $request->validate([
            'association'          => 'required|string|max:255',
            'firm_name'            => 'required|string|max:255',
            'district'             => 'required|string|max:100',
            'address'              => 'required|string',
            'proprietor'           => 'required|string|max:255',
            'mobile_primary'       => 'required|string|max:20',
            'contact2_name'        => 'nullable|string|max:255',
            'mobile_secondary'     => 'nullable|string|max:20',
            'email'                => 'required|email|max:255',
            'website'              => 'nullable|max:255',
            'companies_dealt_with' => 'required|string',
        ]);

        $reg->update($validated);

        return response()->json(['success' => true, 'message' => 'Registration updated successfully.']);
    }

    // ── Delete ────────────────────────────────────────────────────────────────

    public function destroy($id)
    {
        $reg = CertificationRegistration::findOrFail($id);
        $reg->delete();

        return response()->json(['success' => true, 'message' => 'Registration deleted successfully.']);
    }

    // ── Approve ───────────────────────────────────────────────────────────────

    public function approve($id)
    {
        $reg = CertificationRegistration::findOrFail($id);
        $reg->update(['status' => 'Approved', 'rejection_reason' => null]);

        return response()->json([
            'success' => true,
            'message' => "Registration for '{$reg->firm_name}' has been approved.",
        ]);
    }

    // ── Reject ────────────────────────────────────────────────────────────────

    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'nullable|string|max:500',
        ]);

        $reg = CertificationRegistration::findOrFail($id);
        $reg->update([
            'status'           => 'Rejected',
            'rejection_reason' => $request->rejection_reason ?? 'Application does not meet requirements.',
        ]);

        return response()->json([
            'success' => true,
            'message' => "Registration for '{$reg->firm_name}' has been rejected.",
        ]);
    }

    // ── Issue Certificate ─────────────────────────────────────────────────────

    public function issueCertificate(Request $request, $id)
    {
        $reg = CertificationRegistration::findOrFail($id);

        if ($reg->status !== 'Approved') {
            return response()->json(['success' => false, 'message' => 'Only approved registrations can be issued a certificate.'], 422);
        }

        // Check if already issued
        if ($reg->certificate) {
            return response()->json([
                'success' => false,
                'message' => 'A certificate has already been issued for this registration.',
                'cert_id' => $reg->certificate->cert_id,
            ], 422);
        }

        $year    = now()->format('Y');
        $count   = PersonalCertificate::whereYear('created_at', $year)->count() + 1;
        $cert_id = 'PACT-' . $year . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);

        $cert = PersonalCertificate::create([
            'registration_id' => $reg->id,
            'cert_id'         => $cert_id,
            'issued_to'       => $reg->firm_name . ' (' . $reg->proprietor . ')',
            'issue_date'      => Carbon::today()->toDateString(),
            'expiry_date'     => Carbon::today()->addYears(3)->toDateString(),
            'status'          => 'Active',
        ]);

        return response()->json([
            'success'  => true,
            'message'  => "Certificate issued successfully! Certificate ID: {$cert_id}",
            'cert_id'  => $cert_id,
            'cert'     => $cert,
        ]);
    }
}
