<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CertificationRegistration;

class RegistrationController extends Controller
{
    public function personal(Request $request) {
        $data = CertificationRegistration::latest()->paginate(10);
        return view('admin.registration.personal_registrations', compact('data'));
    }

    public function association(Request $request) {
        $data = CertificationRegistration::latest()->paginate(10);
        return view('admin.registration.association_registrations', compact('data'));
    }

    public function pending(Request $request) {
        $data = CertificationRegistration::where('status', 'Pending')->orWhereNull('status')->latest()->paginate(10);
        return view('admin.registration.pending_approvals', compact('data'));
    }

    public function approved(Request $request) {
        $data = CertificationRegistration::where('status', 'Approved')->latest()->paginate(10);
        return view('admin.registration.approved_registrations', compact('data'));
    }

    public function rejected(Request $request) {
        $data = CertificationRegistration::where('status', 'Rejected')->latest()->paginate(10);
        return view('admin.registration.rejected_registrations', compact('data'));
    }
}
