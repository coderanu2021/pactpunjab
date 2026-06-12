@extends('layouts.backend')
@section('title', 'Certificate Verification')

@section('content')

<div class="page-header">
  <div>
    <h1><i class="fa-solid fa-shield-check" style="color:var(--primary);margin-right:8px"></i>Certificate Verification</h1>
    <p>Verify the authenticity of any issued certificate by entering its unique ID.</p>
  </div>
</div>

<!-- Verification Search -->
<div class="card" style="margin-bottom:24px">
  <div class="card-header" style="padding:20px 24px;border-bottom:1px solid var(--border)">
    <div>
      <div class="card-title">Verify a Certificate</div>
      <div class="card-subtitle">Enter the certificate ID found on the document</div>
    </div>
  </div>
  <div style="padding:28px 24px">
    <form method="GET" action="{{ route('admin.certificates.verification') }}" style="display:flex;gap:12px;align-items:flex-end;flex-wrap:wrap">
      <div style="flex:1;min-width:260px">
        <label style="display:block;font-size:11px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px">Certificate ID</label>
        <div style="position:relative">
          <i class="fa-solid fa-magnifying-glass" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);color:var(--text-muted);font-size:13px"></i>
          <input type="text" name="cert_id" value="{{ $certId ?? '' }}"
            placeholder="e.g. CERT-2024-001"
            style="width:100%;padding:10px 14px 10px 38px;border:1px solid var(--border);border-radius:8px;font-family:var(--font);font-size:14px;color:var(--text-main);outline:none;transition:border-color .15s"
            onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='var(--border)'"/>
        </div>
      </div>
      <button type="submit" class="btn btn-primary" style="height:42px;padding:0 24px">
        <i class="fa-solid fa-search"></i> Verify
      </button>
      @if($certId)
      <a href="{{ route('admin.certificates.verification') }}" class="btn btn-outline" style="height:42px;padding:0 18px">
        <i class="fa-solid fa-rotate-left"></i> Clear
      </a>
      @endif
    </form>
  </div>
</div>

<!-- Result -->
@if($certId)
  @if($result)
  <div class="card">
    <div style="padding:28px 24px">
      <div style="display:flex;align-items:center;gap:16px;padding:20px;background:var(--success-soft);border:1px solid #BBF7D0;border-radius:12px;margin-bottom:24px">
        <div style="width:48px;height:48px;border-radius:50%;background:var(--success);display:flex;align-items:center;justify-content:center;color:#fff;font-size:22px;flex-shrink:0">
          <i class="fa-solid fa-circle-check"></i>
        </div>
        <div>
          <div style="font-size:15px;font-weight:700;color:var(--success)">Certificate is Valid</div>
          <div style="font-size:13px;color:#16A34A;margin-top:2px">This certificate is authentic and has been issued by PACT Punjab.</div>
        </div>
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
        <div>
          <div style="font-size:11px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:4px">Certificate ID</div>
          <div style="font-size:14px;font-weight:700;color:var(--primary);font-family:monospace">{{ $result->cert_id }}</div>
        </div>
        <div>
          <div style="font-size:11px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:4px">Issued To</div>
          <div style="font-size:14px;font-weight:600;color:var(--text-main)">{{ $result->issued_to ?? $result->association_name ?? '—' }}</div>
        </div>
        <div>
          <div style="font-size:11px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:4px">Issue Date</div>
          <div style="font-size:14px;color:var(--text-secondary)">{{ $result->issue_date ? \Carbon\Carbon::parse($result->issue_date)->format('d M Y') : '—' }}</div>
        </div>
        <div>
          <div style="font-size:11px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:4px">Expiry Date</div>
          <div style="font-size:14px;color:var(--text-secondary)">{{ $result->expiry_date ? \Carbon\Carbon::parse($result->expiry_date)->format('d M Y') : '—' }}</div>
        </div>
        <div>
          <div style="font-size:11px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:4px">Status</div>
          <div>
            @php $cls = ($result->status == 'Active') ? 'tag-approved' : 'tag-rejected'; @endphp
            <span class="tag {{ $cls }}">{{ $result->status }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  @else
  <div class="card">
    <div style="padding:48px 24px;text-align:center">
      <div style="display:inline-flex;align-items:center;justify-content:center;width:64px;height:64px;border-radius:50%;background:var(--danger-soft);color:var(--danger);font-size:28px;margin-bottom:16px">
        <i class="fa-solid fa-circle-xmark"></i>
      </div>
      <h3 style="font-size:16px;font-weight:700;color:var(--text-main);margin-bottom:8px">Certificate Not Found</h3>
      <p style="font-size:13px;color:var(--text-muted)">No certificate with ID <strong style="color:var(--danger);font-family:monospace">{{ $certId }}</strong> exists in the system.</p>
      <p style="font-size:12px;color:var(--text-muted);margin-top:8px">Please double-check the certificate ID and try again.</p>
    </div>
  </div>
  @endif
@else
<div class="card">
  <div style="padding:60px 24px;text-align:center">
    <div style="display:inline-flex;align-items:center;justify-content:center;width:72px;height:72px;border-radius:50%;background:var(--primary-soft);color:var(--primary);font-size:30px;margin-bottom:20px">
      <i class="fa-solid fa-shield-check"></i>
    </div>
    <h3 style="font-size:16px;font-weight:700;color:var(--text-main);margin-bottom:8px">Enter a Certificate ID to Verify</h3>
    <p style="font-size:13px;color:var(--text-muted);max-width:400px;margin:0 auto">Use the search box above to verify any certificate issued by PACT Punjab. The certificate ID can be found printed on the certificate document.</p>
  </div>
</div>
@endif

@endsection
