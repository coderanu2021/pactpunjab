@extends('layouts.backend')
@section('title', 'Certificate Generator')

@section('content')

{{-- Google Fonts --}}
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700;900&family=EB+Garamond:ital,wght@0,400;0,600;1,400&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
/* ── Page Header ── */
.gen-header {
  display: flex; align-items: flex-start;
  justify-content: space-between; margin-bottom: 24px; flex-wrap: wrap; gap: 14px;
}
.gen-header h1 { font-size: 22px; font-weight: 700; color: var(--text-main); }
.gen-header p  { font-size: 13px; color: var(--text-muted); margin-top: 3px; }

/* ── Selector card ── */
.selector-card {
  background: var(--surface); border: 1px solid var(--border);
  border-radius: var(--radius); padding: 22px 24px;
  box-shadow: var(--shadow-sm); margin-bottom: 24px;
}
.selector-row { display: flex; gap: 18px; flex-wrap: wrap; align-items: flex-end; }
.selector-field { flex: 1; min-width: 220px; }
.selector-field label {
  display: block; font-size: 11px; font-weight: 600;
  color: var(--text-muted); text-transform: uppercase;
  letter-spacing: .05em; margin-bottom: 6px;
}
.selector-field select, .selector-field input {
  width: 100%; padding: 10px 14px;
  border: 1px solid var(--border); border-radius: 8px;
  font-family: var(--font); font-size: 13px; color: var(--text-main);
  background: var(--bg); outline: none; transition: border-color .15s;
}
.selector-field select:focus, .selector-field input:focus { border-color: var(--primary); }

/* ── Preview wrapper ── */
.preview-section {
  background: #E8EDF2;
  border-radius: var(--radius);
  padding: 40px;
  margin-bottom: 24px;
  display: flex;
  flex-direction: column;
  align-items: center;
}

/* ══════════════════════════════════════════════════
   CERTIFICATE DESIGN (shared between preview & print)
   ══════════════════════════════════════════════════ */
#certPaper {
  width: 1000px;
  min-height: 700px;
  background: #fff;
  position: relative;
  font-family: 'EB Garamond', serif;
  box-shadow: 0 20px 80px rgba(0,0,0,.20);
}

/* Multi-layer border */
.cert-frame {
  position: absolute; inset: 0;
  border: 18px solid var(--cert-outer, #0F172A);
  box-sizing: border-box;
}
.cert-frame::before {
  content: '';
  position: absolute; inset: 4px;
  border: 2px solid var(--cert-inner, #C9A227);
  box-sizing: border-box;
}
.cert-frame::after {
  content: '';
  position: absolute; inset: 8px;
  border: 1px solid var(--cert-inner, #C9A227);
  box-sizing: border-box;
  opacity: .5;
}

/* Corner ornaments */
.cert-corner {
  position: absolute; width: 60px; height: 60px;
  display: flex; align-items: center; justify-content: center;
  font-size: 26px; color: var(--cert-inner, #C9A227);
  z-index: 2;
}
.cert-corner.tl { top: 14px;  left: 14px; }
.cert-corner.tr { top: 14px;  right: 14px; transform: scaleX(-1); }
.cert-corner.bl { bottom: 14px; left: 14px; transform: scaleY(-1); }
.cert-corner.br { bottom: 14px; right: 14px; transform: scale(-1,-1); }

/* Inner content area */
.cert-inner {
  position: relative;
  padding: 50px 70px;
  z-index: 1;
  min-height: 700px;
  display: flex;
  flex-direction: column;
  align-items: center;
}

/* Watermark */
.cert-watermark {
  position: absolute; inset: 0;
  display: flex; align-items: center; justify-content: center;
  font-size: 200px; font-weight: 900;
  color: rgba(15,23,42,.03); pointer-events: none;
  font-family: 'Cinzel', serif; z-index: 0;
  line-height: 1;
}

/* Header strip */
.cert-header-strip {
  width: 100%; display: flex; align-items: center;
  justify-content: space-between; margin-bottom: 28px;
  padding-bottom: 20px;
  border-bottom: 1px solid var(--cert-inner, #C9A227);
  position: relative; z-index: 1;
}
.cert-org-logo {
  width: 70px; height: 70px; border-radius: 50%;
  background: var(--cert-outer, #0F172A);
  display: flex; align-items: center; justify-content: center;
  color: var(--cert-inner, #C9A227); font-size: 28px;
  border: 2px solid var(--cert-inner, #C9A227);
  flex-shrink: 0;
}
.cert-org-name { text-align: center; flex: 1; padding: 0 20px; }
.cert-org-name .full-name {
  font-family: 'Cinzel', serif; font-size: 18px; font-weight: 700;
  color: var(--cert-outer, #0F172A); text-transform: uppercase;
  letter-spacing: .12em; line-height: 1.3;
}
.cert-org-name .abbr {
  font-size: 12px; color: #64748B; margin-top: 3px;
  letter-spacing: .06em;
}
.cert-cert-no {
  text-align: right; font-size: 11px; color: #64748B;
  line-height: 1.7;
}
.cert-cert-no strong { color: var(--cert-outer, #0F172A); font-size: 13px; }

/* Title */
.cert-title-block { text-align: center; margin-bottom: 22px; position: relative; z-index: 1; }
.cert-title-label {
  font-size: 11px; font-weight: 600; letter-spacing: .18em; text-transform: uppercase;
  color: var(--cert-inner, #C9A227); margin-bottom: 6px;
  display: flex; align-items: center; justify-content: center; gap: 10px;
}
.cert-title-label::before, .cert-title-label::after {
  content: ''; display: inline-block; width: 40px; height: 1px;
  background: var(--cert-inner, #C9A227);
}
.cert-main-title {
  font-family: 'Cinzel', serif; font-size: 42px; font-weight: 900;
  color: var(--cert-outer, #0F172A); text-transform: uppercase;
  letter-spacing: .06em; line-height: 1.1;
}

/* Body text */
.cert-body-text {
  text-align: center; position: relative; z-index: 1;
  width: 100%; margin-bottom: 12px;
}
.cert-body-text .presented-to {
  font-size: 14px; color: #64748B; font-style: italic; margin-bottom: 10px;
}
.cert-recipient-name {
  font-family: 'Cinzel', serif;
  font-size: 38px; font-weight: 700;
  color: var(--cert-outer, #0F172A);
  border-bottom: 2px solid var(--cert-inner, #C9A227);
  display: inline-block;
  padding: 0 30px 8px;
  margin: 6px 0 14px;
  line-height: 1.2;
}
.cert-desc-text {
  font-size: 15px; color: #334155; line-height: 1.8;
  max-width: 740px; margin: 0 auto;
}
.cert-desc-text strong { color: var(--cert-outer, #0F172A); font-weight: 600; }

/* Details row */
.cert-details-row {
  display: flex; justify-content: center; gap: 32px;
  margin: 16px 0 28px;
  position: relative; z-index: 1;
  flex-wrap: wrap;
}
.cert-detail-pill {
  background: #F8FAFC; border: 1px solid #E2E8F0;
  border-radius: 8px; padding: 8px 18px; text-align: center;
}
.cert-detail-pill .label {
  font-size: 10px; font-weight: 600; text-transform: uppercase;
  letter-spacing: .06em; color: #94A3B8; display: block; margin-bottom: 2px;
}
.cert-detail-pill .value {
  font-size: 13px; font-weight: 600; color: #0F172A;
}

/* Divider */
.cert-divider {
  width: 100%; border: none; border-top: 1px solid #E2E8F0;
  margin: 0 0 24px; position: relative; z-index: 1;
}

/* Footer */
.cert-footer-row {
  width: 100%; display: flex; justify-content: space-between;
  align-items: flex-end; position: relative; z-index: 1;
}
.cert-sig { text-align: center; width: 180px; }
.cert-sig .sig-line {
  border-top: 1.5px solid var(--cert-outer, #0F172A);
  padding-top: 8px; margin-top: 36px;
  font-size: 11px; font-weight: 700; text-transform: uppercase;
  letter-spacing: .06em; color: var(--cert-outer, #0F172A);
}
.cert-sig .sig-title {
  font-size: 10px; color: #64748B; margin-top: 3px; letter-spacing: .04em;
}

/* Seal */
.cert-seal-wrap { display: flex; flex-direction: column; align-items: center; gap: 10px; }
.cert-seal {
  width: 100px; height: 100px; border-radius: 50%;
  background: var(--cert-outer, #0F172A);
  border: 3px solid var(--cert-inner, #C9A227);
  box-shadow: 0 0 0 4px rgba(201,162,39,.2);
  display: flex; flex-direction: column;
  align-items: center; justify-content: center;
  color: var(--cert-inner, #C9A227); text-align: center;
  font-size: 10px; font-weight: 700; text-transform: uppercase;
  letter-spacing: .08em; line-height: 1.5;
}
.cert-seal i { font-size: 22px; display: block; margin-bottom: 4px; }

/* QR + Verify strip */
.cert-verify-strip {
  text-align: center; margin-top: 16px;
  font-size: 10px; color: #94A3B8;
  position: relative; z-index: 1;
  padding-top: 12px;
  border-top: 1px dashed #E2E8F0;
  width: 100%;
}
.cert-verify-strip strong { color: #475569; }

/* ── Print Styles ── */
@media print {
  * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
  body > * { display: none !important; }
  body { margin: 0; padding: 0; background: white; }
  #printArea { display: block !important; position: fixed; inset: 0; z-index: 99999; background: white; }
  #printArea #certPaper {
    width: 100vw; min-height: 100vh;
    box-shadow: none; margin: 0;
  }
  .cert-inner { padding: 40px 60px; min-height: 100vh; }
  @page { size: A4 landscape; margin: 0; }
}
#printArea { display: none; }

/* ── All certs table ── */
.cert-list-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow-sm); }
</style>

{{-- ─────────────────────────────────────────────── --}}
{{-- PAGE HEADER                                      --}}
{{-- ─────────────────────────────────────────────── --}}
<div class="gen-header">
  <div>
    <h1><i class="fa-solid fa-award" style="color:var(--primary);margin-right:8px"></i>Certificate Export</h1>
    <p>Generate, preview and export certificates for approved registrations.</p>
  </div>
  <div style="display:flex;gap:10px;flex-wrap:wrap">
    @if($selectedRegistration)
    <button class="btn btn-outline" onclick="printCert()">
      <i class="fa-solid fa-print"></i> Print
    </button>
    <button class="btn btn-primary" onclick="printCert()">
      <i class="fa-solid fa-file-pdf"></i> Export PDF
    </button>
    @endif
  </div>
</div>

{{-- ─────────────────────────────────────────────── --}}
{{-- SELECTOR                                         --}}
{{-- ─────────────────────────────────────────────── --}}
<div class="selector-card">
  <form method="GET" action="{{ route('admin.certificates.generated') }}">
    <div class="selector-row">
      <div class="selector-field">
        <label><i class="fa-solid fa-building"></i> Select Approved Registration</label>
        <select name="reg_id" onchange="this.form.submit()">
          <option value="">— Select applicant —</option>
          @foreach($registrations as $reg)
          <option value="{{ $reg->id }}"
            {{ ($selectedRegistration && $selectedRegistration->id == $reg->id) ? 'selected' : '' }}>
            {{ $reg->firm_name }} — {{ $reg->district }}
            @if($reg->certificate) ✓ @endif
          </option>
          @endforeach
        </select>
      </div>
      <div class="selector-field">
        <label><i class="fa-solid fa-palette"></i> Certificate Template</label>
        <select name="template_id" onchange="this.form.submit()">
          @foreach($templates as $tmpl)
          <option value="{{ $tmpl->id }}"
            {{ ($selectedTemplate && $selectedTemplate->id == $tmpl->id) ? 'selected' : '' }}>
            {{ $tmpl->name }}
          </option>
          @endforeach
        </select>
      </div>
    </div>
  </form>
</div>

{{-- ─────────────────────────────────────────────── --}}
{{-- CERTIFICATE PREVIEW                              --}}
{{-- ─────────────────────────────────────────────── --}}
@if($selectedRegistration)

@php
  // Colour themes per template name
  $themes = [
    'standard' => ['outer'=>'#166534', 'inner'=>'#EAB308'],
    'premium'  => ['outer'=>'#1E1B4B', 'inner'=>'#0EA5E9'],
    'gold'     => ['outer'=>'#78350F', 'inner'=>'#D97706'],
    'silver'   => ['outer'=>'#1E293B', 'inner'=>'#94A3B8'],
    'default'  => ['outer'=>'#0F172A', 'inner'=>'#C9A227'],
  ];
  $themeName = 'default';
  if ($selectedTemplate) {
    $n = strtolower($selectedTemplate->name);
    foreach ($themes as $key => $_) {
      if (str_contains($n, $key)) { $themeName = $key; break; }
    }
  }
  $outer = $themes[$themeName]['outer'];
  $inner = $themes[$themeName]['inner'];

  $cert     = $selectedRegistration->certificate;
  $certId   = $cert ? $cert->cert_id : 'PACT-' . date('Y') . '-XXXX';
  $issued   = $cert ? \Carbon\Carbon::parse($cert->issue_date)->format('d F Y') : date('d F Y');
  $expiry   = $cert ? \Carbon\Carbon::parse($cert->expiry_date)->format('d F Y') : \Carbon\Carbon::now()->addYears(3)->format('d F Y');
  $verifyUrl = url('/admin/certificates/verification?cert_id=' . $certId);
@endphp

<div class="preview-section">
  <div style="text-align:center;margin-bottom:16px;display:flex;align-items:center;gap:12px;color:#64748B;font-size:12px">
    <i class="fa-solid fa-magnifying-glass-plus"></i>
    <span>Certificate Preview — <strong style="color:#0F172A">{{ $selectedRegistration->firm_name }}</strong></span>
    @if($cert)
      <span class="tag tag-approved" style="font-family:monospace">{{ $certId }}</span>
    @else
      <span style="color:var(--warning);font-weight:600"><i class="fa-solid fa-triangle-exclamation"></i> Certificate not issued yet</span>
    @endif
  </div>

  <div id="certPaper" style="--cert-outer:{{ $outer }};--cert-inner:{{ $inner }}">

    {{-- Frame & corners --}}
    <div class="cert-frame"></div>
    <div class="cert-corner tl"><i class="fa-solid fa-clover"></i></div>
    <div class="cert-corner tr"><i class="fa-solid fa-clover"></i></div>
    <div class="cert-corner bl"><i class="fa-solid fa-clover"></i></div>
    <div class="cert-corner br"><i class="fa-solid fa-clover"></i></div>

    <div class="cert-inner">

      {{-- Watermark --}}
      <div class="cert-watermark">PACT</div>

      {{-- Header --}}
      <div class="cert-header-strip">
        <div class="cert-org-logo">
          <i class="fa-solid fa-building-shield"></i>
        </div>
        <div class="cert-org-name">
          <div class="full-name">Punjab Association of Computer Traders</div>
          <div class="abbr">Regd. under Societies Registration Act · Est. 1996 · Punjab, India</div>
        </div>
        <div class="cert-cert-no">
          <strong>{{ $certId }}</strong><br>
          Issue Date: {{ $issued }}<br>
          Valid Until: {{ $expiry }}
        </div>
      </div>

      {{-- Title --}}
      <div class="cert-title-block">
        <div class="cert-title-label">Certificate of Registration</div>
        <div class="cert-main-title">Membership</div>
      </div>

      {{-- Body --}}
      <div class="cert-body-text">
        <div class="presented-to">This is to certify that</div>
        <div class="cert-recipient-name">{{ $selectedRegistration->firm_name }}</div>
        <div class="cert-desc-text">
          Owned and operated by <strong>{{ $selectedRegistration->proprietor }}</strong>,
          located at <strong>{{ $selectedRegistration->address ?? $selectedRegistration->district }}</strong>,
          dealing in <strong>{{ $selectedRegistration->companies_dealt_with }}</strong>,
          is hereby officially recognised as a <strong>Registered Member</strong> of the
          <strong>{{ $selectedRegistration->association }}</strong> — an affiliate of
          <strong>Punjab Association of Computer Traders (PACT Punjab)</strong>.
        </div>
      </div>

      {{-- Details pills --}}
      <div class="cert-details-row">
        <div class="cert-detail-pill">
          <span class="label">District</span>
          <span class="value">{{ $selectedRegistration->district }}</span>
        </div>
        <div class="cert-detail-pill">
          <span class="label">Association</span>
          <span class="value">{{ $selectedRegistration->association }}</span>
        </div>
        <div class="cert-detail-pill">
          <span class="label">Mobile</span>
          <span class="value">{{ $selectedRegistration->mobile_primary }}</span>
        </div>
        <div class="cert-detail-pill">
          <span class="label">Email</span>
          <span class="value">{{ $selectedRegistration->email }}</span>
        </div>
      </div>

      <hr class="cert-divider">

      {{-- Footer --}}
      <div class="cert-footer-row">
        <div class="cert-sig">
          <div class="sig-line">President</div>
          <div class="sig-title">PACT Punjab</div>
        </div>

        <div class="cert-seal-wrap">
          <div class="cert-seal" style="background:{{ $outer }};border-color:{{ $inner }};color:{{ $inner }}">
            <i class="fa-solid fa-award"></i>
            PACT<br>PUNJAB<br>{{ date('Y') }}
          </div>
        </div>

        <div class="cert-sig">
          <div class="sig-line">General Secretary</div>
          <div class="sig-title">PACT Punjab</div>
        </div>
      </div>

      {{-- Verify strip --}}
      <div class="cert-verify-strip">
        <strong>Verify online:</strong> {{ $verifyUrl }}
        &nbsp;|&nbsp; <strong>Certificate ID:</strong> {{ $certId }}
        &nbsp;|&nbsp; This certificate is digitally generated and is valid without a physical seal.
      </div>

    </div>{{-- /.cert-inner --}}
  </div>{{-- /#certPaper --}}
</div>{{-- /.preview-section --}}

{{-- Issue certificate button if not yet issued --}}
@if(!$cert)
<div style="text-align:center;margin:-10px 0 24px">
  <div style="background:var(--warning-soft);border:1px solid #FDE68A;border-radius:10px;padding:14px 20px;display:inline-flex;align-items:center;gap:12px;font-size:13px;color:var(--warning)">
    <i class="fa-solid fa-triangle-exclamation"></i>
    <span>Certificate not issued yet for this registration.</span>
    <button class="btn btn-primary" style="padding:6px 16px;font-size:12px" onclick="issueNow({{ $selectedRegistration->id }},'{{ addslashes($selectedRegistration->firm_name) }}')">
      <i class="fa-solid fa-certificate"></i> Issue Now
    </button>
  </div>
</div>
@endif

{{-- Hidden print area --}}
<div id="printArea">
  <div id="certPaperPrint" style="--cert-outer:{{ $outer }};--cert-inner:{{ $inner }}"></div>
</div>

@else
{{-- No registration selected --}}
<div style="text-align:center;padding:70px 24px;background:var(--surface);border-radius:var(--radius);border:2px dashed var(--border);margin-bottom:24px">
  <i class="fa-solid fa-certificate" style="font-size:44px;color:var(--border);display:block;margin-bottom:16px"></i>
  <h3 style="font-size:16px;font-weight:700;color:var(--text-main);margin-bottom:6px">No Applicant Selected</h3>
  <p style="font-size:13px;color:var(--text-muted)">Choose an approved registration from the dropdown above to preview and export its certificate.</p>
</div>
@endif

{{-- ─────────────────────────────────────────────── --}}
{{-- ALL ISSUED CERTIFICATES TABLE                    --}}
{{-- ─────────────────────────────────────────────── --}}
@php
  $issuedCerts = \App\Models\PersonalCertificate::with('registration')->whereNotNull('registration_id')->latest()->get();
@endphp

<div class="cert-list-card">
  <div class="card-header" style="border-bottom:1px solid var(--border)">
    <div>
      <div class="card-title"><i class="fa-solid fa-list" style="color:var(--primary);margin-right:6px"></i>All Issued Certificates</div>
      <div class="card-subtitle">{{ $issuedCerts->count() }} certificates issued to approved registrations</div>
    </div>
    <a href="{{ route('admin.registration.approved') }}" class="btn btn-outline" style="padding:6px 14px;font-size:12px">
      <i class="fa-solid fa-arrow-right"></i> Approved Registrations
    </a>
  </div>
  <div style="overflow-x:auto">
    <table class="data-table">
      <thead>
        <tr>
          <th>Certificate ID</th>
          <th>Firm Name</th>
          <th>Proprietor</th>
          <th>District</th>
          <th>Issue Date</th>
          <th>Expiry Date</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($issuedCerts as $c)
        <tr>
          <td style="font-weight:700;color:var(--primary);font-family:monospace;font-size:12px">{{ $c->cert_id }}</td>
          <td>
            <div class="user-name">{{ $c->registration->firm_name ?? $c->issued_to }}</div>
            @if($c->registration)
            <div class="user-email">{{ $c->registration->association }}</div>
            @endif
          </td>
          <td style="color:var(--text-secondary)">{{ $c->registration->proprietor ?? '—' }}</td>
          <td style="color:var(--text-secondary)">{{ $c->registration->district ?? '—' }}</td>
          <td style="color:var(--text-secondary)">{{ \Carbon\Carbon::parse($c->issue_date)->format('d M Y') }}</td>
          <td style="color:var(--text-secondary)">{{ \Carbon\Carbon::parse($c->expiry_date)->format('d M Y') }}</td>
          <td>
            @php
              $now = now();
              $expDate = \Carbon\Carbon::parse($c->expiry_date);
              $autoStatus = $expDate->isPast() ? 'Expired' : $c->status;
              $cls = $autoStatus == 'Active' ? 'tag-approved' : ($autoStatus == 'Expired' ? 'tag-rejected' : 'tag-pending');
            @endphp
            <span class="tag {{ $cls }}">{{ $autoStatus }}</span>
          </td>
          <td>
            <div class="action-group">
              <a href="{{ route('admin.certificates.generated') }}?reg_id={{ $c->registration_id }}" class="icon-btn view" title="Preview" style="text-decoration:none">
                <i class="fa-solid fa-eye"></i>
              </a>
              <a href="{{ route('admin.certificates.generated') }}?reg_id={{ $c->registration_id }}&print=1" class="icon-btn" title="Print / Export" style="background:var(--success-soft);color:var(--success);text-decoration:none" onclick="event.preventDefault(); printById({{ $c->registration_id }})">
                <i class="fa-solid fa-print"></i>
              </a>
              <a href="{{ route('admin.certificates.verification') }}?cert_id={{ $c->cert_id }}" class="icon-btn" title="Verify" style="background:var(--primary-soft);color:var(--primary);text-decoration:none">
                <i class="fa-solid fa-shield-check"></i>
              </a>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="8" style="text-align:center;padding:40px;color:var(--text-muted)">
          <i class="fa-solid fa-certificate" style="font-size:26px;display:block;margin-bottom:8px;opacity:.3"></i>
          No certificates issued yet. Approve registrations and issue certificates from the Registrations page.
        </td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

{{-- Issue Certificate Modal --}}
<div class="modal-overlay" id="issueModal">
  <div class="modal" style="width:440px">
    <div class="modal-header">
      <h2><i class="fa-solid fa-certificate" style="color:var(--success);margin-right:8px"></i>Issue Certificate</h2>
      <button class="modal-close" onclick="closeModal('issueModal')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body" style="text-align:center;padding:28px 24px">
      <div style="width:60px;height:60px;border-radius:50%;background:var(--success-soft);display:flex;align-items:center;justify-content:center;margin:0 auto 14px;font-size:24px;color:var(--success)"><i class="fa-solid fa-certificate"></i></div>
      <h3 id="issueFirmTitle" style="font-size:14px;margin-bottom:8px;color:var(--text-main)"></h3>
      <p style="font-size:12px;color:var(--text-muted)">A certificate will be generated with today's date and 3-year validity.</p>
      <input type="hidden" id="issueId"/>
    </div>
    <div class="modal-footer">
      <button class="btn btn-outline" onclick="closeModal('issueModal')">Cancel</button>
      <button class="btn" style="background:var(--success);color:#fff" onclick="submitIssue()"><i class="fa-solid fa-certificate"></i> Issue Certificate</button>
    </div>
  </div>
</div>

@endsection

@section('script')
<style>
.toast{position:fixed;bottom:28px;right:28px;z-index:9999;padding:13px 20px;border-radius:10px;font-size:13px;font-weight:500;display:flex;align-items:center;gap:10px;box-shadow:0 8px 30px rgba(0,0,0,.18);animation:slideUp .3s;}
.toast.success{background:var(--success);color:#fff;}.toast.error{background:var(--danger);color:#fff;}
@keyframes slideUp{from{transform:translateY(20px);opacity:0}to{transform:translateY(0);opacity:1}}
</style>

<script>
const CSRF = '{{ csrf_token() }}';

function openModal(id)  { document.getElementById(id).classList.add('open'); }
function closeModal(id) { document.getElementById(id).classList.remove('open'); }
document.querySelectorAll('.modal-overlay').forEach(m => m.addEventListener('click', e => { if(e.target===m) m.classList.remove('open'); }));

function showToast(msg, type='success') {
  document.querySelectorAll('.toast').forEach(t => t.remove());
  const t = document.createElement('div');
  t.className = 'toast ' + type;
  t.innerHTML = `<i class="fa-solid fa-${type==='success'?'circle-check':'circle-exclamation'}"></i> ${msg}`;
  document.body.appendChild(t);
  setTimeout(() => { t.style.opacity='0'; t.style.transition='opacity .4s'; setTimeout(()=>t.remove(),400); }, 3500);
}

// ── Print current certificate ─────────────────────────────────────────────
function printCert() {
  // Copy certPaper HTML into printArea for clean print
  const src  = document.getElementById('certPaper');
  const dest = document.getElementById('certPaperPrint');
  if (!src || !dest) return;
  dest.innerHTML = src.innerHTML;
  dest.style.cssText = src.style.cssText;
  // Set same CSS variables
  dest.style.setProperty('--cert-outer', src.style.getPropertyValue('--cert-outer'));
  dest.style.setProperty('--cert-inner', src.style.getPropertyValue('--cert-inner'));
  document.getElementById('printArea').style.display = 'block';
  window.print();
  document.getElementById('printArea').style.display = 'none';
}

// ── Print by registration ID (from table) ────────────────────────────────
function printById(regId) {
  window.location.href = `{{ route('admin.certificates.generated') }}?reg_id=${regId}&autoprint=1`;
}

// ── Issue Certificate ─────────────────────────────────────────────────────
function issueNow(id, name) {
  document.getElementById('issueId').value = id;
  document.getElementById('issueFirmTitle').textContent = `Issue to: ${name}`;
  openModal('issueModal');
}

function submitIssue() {
  const id = document.getElementById('issueId').value;
  fetch(`/admin/registration/${id}/issue-certificate`, {
    method: 'POST',
    headers: { 'X-CSRF-TOKEN': CSRF, 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(r => r.json())
  .then(res => {
    if (res.success) {
      closeModal('issueModal');
      showToast(res.message);
      setTimeout(() => location.reload(), 800);
    } else {
      showToast(res.message, 'error');
    }
  });
}

// ── Auto-print if ?autoprint=1 ────────────────────────────────────────────
@if(request('autoprint'))
window.addEventListener('load', () => setTimeout(printCert, 800));
@endif
</script>
@endsection
