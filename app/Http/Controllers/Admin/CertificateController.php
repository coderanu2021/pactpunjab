<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CertificateTemplate;
use App\Models\PersonalCertificate;
use App\Models\AssociationCertificate;
use App\Models\CertificationRegistration;
use Carbon\Carbon;

class CertificateController extends Controller
{
    // ── Templates CRUD ───────────────────────────────────────────────────────

    public function templates(Request $request)
    {
        $query = CertificateTemplate::latest();
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        $data = $query->paginate(10)->withQueryString();
        return view('admin.certificates.templates', compact('data'));
    }

    public function templateStore(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'orientation' => 'required|in:landscape,portrait',
            'status'      => 'required|in:Active,Inactive',
        ]);
        CertificateTemplate::create($request->only('name', 'orientation', 'status'));
        return response()->json(['success' => true, 'message' => 'Template created successfully.']);
    }

    public function templateShow($id)
    {
        return response()->json(CertificateTemplate::findOrFail($id));
    }

    public function templateUpdate(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'orientation' => 'required|in:landscape,portrait',
            'status'      => 'required|in:Active,Inactive',
        ]);
        $t = CertificateTemplate::findOrFail($id);
        $t->update($request->only('name', 'orientation', 'status'));
        return response()->json(['success' => true, 'message' => 'Template updated successfully.']);
    }

    public function templateDestroy($id)
    {
        CertificateTemplate::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Template deleted.']);
    }

    // ── Personal Certificates CRUD ────────────────────────────────────────────

    public function personal(Request $request)
    {
        $query = PersonalCertificate::with('registration')->latest();
        if ($request->search) {
            $q = $request->search;
            $query->where(function ($qb) use ($q) {
                $qb->where('cert_id', 'like', "%$q%")
                   ->orWhere('issued_to', 'like', "%$q%");
            });
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        $data = $query->paginate(10)->withQueryString();
        return view('admin.certificates.personal', compact('data'));
    }

    public function personalShow($id)
    {
        return response()->json(PersonalCertificate::with('registration')->findOrFail($id));
    }

    public function personalUpdate(Request $request, $id)
    {
        $request->validate([
            'issued_to'   => 'required|string|max:255',
            'issue_date'  => 'required|date',
            'expiry_date' => 'required|date|after:issue_date',
            'status'      => 'required|in:Active,Expired,Revoked',
        ]);
        $cert = PersonalCertificate::findOrFail($id);
        $cert->update($request->only('issued_to', 'issue_date', 'expiry_date', 'status'));
        return response()->json(['success' => true, 'message' => 'Certificate updated.']);
    }

    public function personalDestroy($id)
    {
        PersonalCertificate::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Certificate deleted.']);
    }

    // ── Association Certificates CRUD ─────────────────────────────────────────

    public function association(Request $request)
    {
        $query = AssociationCertificate::latest();
        if ($request->search) {
            $q = $request->search;
            $query->where(function ($qb) use ($q) {
                $qb->where('cert_id', 'like', "%$q%")
                   ->orWhere('association_name', 'like', "%$q%");
            });
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        $data = $query->paginate(10)->withQueryString();
        return view('admin.certificates.association', compact('data'));
    }

    public function associationStore(Request $request)
    {
        $request->validate([
            'association_name' => 'required|string|max:255',
            'issue_date'       => 'required|date',
            'expiry_date'      => 'required|date|after:issue_date',
            'status'           => 'required|in:Active,Expired,Revoked',
        ]);
        $year  = now()->format('Y');
        $count = AssociationCertificate::whereYear('created_at', $year)->count() + 1;
        $data  = $request->only('association_name', 'issue_date', 'expiry_date', 'status');
        $data['cert_id'] = 'APACT-' . $year . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
        AssociationCertificate::create($data);
        return response()->json(['success' => true, 'message' => 'Association certificate issued.']);
    }

    public function associationShow($id)
    {
        return response()->json(AssociationCertificate::findOrFail($id));
    }

    public function associationUpdate(Request $request, $id)
    {
        $request->validate([
            'association_name' => 'required|string|max:255',
            'issue_date'       => 'required|date',
            'expiry_date'      => 'required|date|after:issue_date',
            'status'           => 'required|in:Active,Expired,Revoked',
        ]);
        AssociationCertificate::findOrFail($id)->update(
            $request->only('association_name', 'issue_date', 'expiry_date', 'status')
        );
        return response()->json(['success' => true, 'message' => 'Certificate updated.']);
    }

    public function associationDestroy($id)
    {
        AssociationCertificate::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Certificate deleted.']);
    }

    // ── Verification ──────────────────────────────────────────────────────────

    public function verification(Request $request)
    {
        $certId = $request->input('cert_id');
        $result = null;
        if ($certId) {
            $result = PersonalCertificate::where('cert_id', $certId)->with('registration')->first()
                   ?? AssociationCertificate::where('cert_id', $certId)->first();
        }
        return view('admin.certificates.verification', compact('certId', 'result'));
    }

    // ── Certificate Generator (preview + print) ───────────────────────────────

    public function generated(Request $request)
    {
        $registrations = CertificationRegistration::where('status', 'Approved')->get();
        $templates     = CertificateTemplate::where('status', 'Active')->get();

        $regId      = $request->input('reg_id');
        $templateId = $request->input('template_id');

        $selectedRegistration = $regId
            ? $registrations->firstWhere('id', $regId)
            : $registrations->first();

        $selectedTemplate = $templateId
            ? $templates->firstWhere('id', $templateId)
            : $templates->first();

        return view('admin.certificates.generated', compact(
            'registrations', 'templates', 'selectedRegistration', 'selectedTemplate'
        ));
    }
}
