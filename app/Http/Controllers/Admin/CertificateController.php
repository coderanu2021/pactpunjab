<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CertificateTemplate;
use App\Models\PersonalCertificate;
use App\Models\AssociationCertificate;

class CertificateController extends Controller
{
    public function templates() {
        $data = \App\Models\CertificateTemplate::latest()->paginate(10);
        return view('admin.certificates.templates', compact('data'));
    }
    public function personal() {
        $data = \App\Models\PersonalCertificate::latest()->paginate(10);
        return view('admin.certificates.personal', compact('data'));
    }
    public function association() {
        $data = \App\Models\AssociationCertificate::latest()->paginate(10);
        return view('admin.certificates.association', compact('data'));
    }
    public function verification(Request $request) {
        $certId = $request->input('cert_id');
        $result = null;
        if ($certId) {
            $result = \App\Models\PersonalCertificate::where('cert_id', $certId)->first()
                   ?? \App\Models\AssociationCertificate::where('cert_id', $certId)->first();
        }
        return view('admin.certificates.verification', compact('certId', 'result'));
    }

    public function generated(Request $request) {
        $registrations = \Illuminate\Support\Facades\DB::table('certification_registrations')->get();
        $templates = \App\Models\CertificateTemplate::all();

        $regId = $request->input('reg_id');
        $templateId = $request->input('template_id');

        $selectedRegistration = $regId 
            ? $registrations->firstWhere('id', $regId) 
            : $registrations->first();
            
        $selectedTemplate = $templateId 
            ? $templates->firstWhere('id', $templateId) 
            : $templates->first();

        return view('admin.certificates.generated', compact('registrations', 'templates', 'selectedRegistration', 'selectedTemplate'));
    }
}
