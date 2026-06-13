@extends('layouts.backend')
@section('title', 'Approved Registrations')

@section('content')

<div class="page-header">
  <div>
    <h1><i class="fa-solid fa-circle-check" style="color:var(--success);margin-right:8px"></i>Approved Registrations</h1>
    <p>Verified registrations — issue certificates from here.</p>
  </div>
  <div class="header-actions">
    <a href="{{ route('admin.certificates.generated') }}" class="btn btn-primary">
      <i class="fa-solid fa-award"></i> Certificate Generator
    </a>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <div>
      <div class="card-title">Approved Registrations</div>
      <div class="card-subtitle">{{ $data->total() }} approved applications</div>
    </div>
  </div>
  <div style="overflow-x:auto">
    <table class="data-table">
      <thead>
        <tr>
          <th>#</th>
          <th>Firm / Association</th>
          <th>Proprietor</th>
          <th>District</th>
          <th>Mobile</th>
          <th>Email</th>
          <th>Certificate</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($data as $item)
        <tr>
          <td style="color:var(--text-muted)">{{ $item->id }}</td>
          <td>
            <div class="user-name">{{ $item->firm_name }}</div>
            <div class="user-email">{{ $item->association }}</div>
          </td>
          <td style="color:var(--text-secondary)">{{ $item->proprietor }}</td>
          <td style="color:var(--text-secondary)">{{ $item->district }}</td>
          <td style="color:var(--text-secondary);font-size:12px">{{ $item->mobile_primary }}</td>
          <td style="color:var(--text-secondary);font-size:12px">{{ $item->email }}</td>
          <td>
            @if($item->certificate)
              <span class="tag tag-approved" style="font-family:monospace;font-size:11px">{{ $item->certificate->cert_id }}</span>
            @else
              <button class="btn btn-outline" style="padding:4px 12px;font-size:11px;color:var(--success)" onclick="issueCert({{ $item->id }},'{{ addslashes($item->firm_name) }}')">
                <i class="fa-solid fa-certificate"></i> Issue Now
              </button>
            @endif
          </td>
          <td>
            <div class="action-group">
              <button class="icon-btn view" title="View" onclick="viewReg({{ $item->id }})"><i class="fa-solid fa-eye"></i></button>
              @if($item->certificate)
              <a href="{{ route('admin.certificates.generated') }}?reg_id={{ $item->id }}" class="icon-btn" title="Print Certificate" style="background:var(--primary-soft);color:var(--primary);text-decoration:none"><i class="fa-solid fa-print"></i></a>
              @endif
              <button class="icon-btn delete" title="Delete" onclick="delReg({{ $item->id }},'{{ addslashes($item->firm_name) }}')"><i class="fa-solid fa-trash"></i></button>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="8" style="text-align:center;padding:40px;color:var(--text-muted)">No approved registrations found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div style="padding:14px 20px;border-top:1px solid var(--border)">
    {{ $data->links('pagination::bootstrap-4') }}
  </div>
</div>

{{-- View Modal --}}
<div class="modal-overlay" id="viewModal">
  <div class="modal" style="width:640px">
    <div class="modal-header">
      <h2><i class="fa-solid fa-eye" style="color:var(--primary);margin-right:8px"></i>Registration Details</h2>
      <button class="modal-close" onclick="closeModal('viewModal')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body" id="viewContent"></div>
    <div class="modal-footer"><button class="btn btn-outline" onclick="closeModal('viewModal')">Close</button></div>
  </div>
</div>

{{-- Issue Certificate Modal --}}
<div class="modal-overlay" id="issueModal">
  <div class="modal" style="width:440px">
    <div class="modal-header">
      <h2><i class="fa-solid fa-certificate" style="color:var(--success);margin-right:8px"></i>Issue Certificate</h2>
      <button class="modal-close" onclick="closeModal('issueModal')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body" style="text-align:center;padding:28px">
      <div style="width:60px;height:60px;border-radius:50%;background:var(--success-soft);display:flex;align-items:center;justify-content:center;margin:0 auto 14px;font-size:24px;color:var(--success)"><i class="fa-solid fa-certificate"></i></div>
      <h3 id="issueFirmTitle" style="font-size:14px;margin-bottom:8px"></h3>
      <p style="font-size:12px;color:var(--text-muted)">Certificate will be valid for 3 years from today.</p>
      <input type="hidden" id="issueId"/>
    </div>
    <div class="modal-footer">
      <button class="btn btn-outline" onclick="closeModal('issueModal')">Cancel</button>
      <button class="btn" style="background:var(--success);color:#fff" onclick="submitIssue()"><i class="fa-solid fa-certificate"></i> Issue</button>
    </div>
  </div>
</div>

@endsection

@section('script')
<style>.toast{position:fixed;bottom:28px;right:28px;z-index:999;padding:13px 20px;border-radius:10px;font-size:13px;font-weight:500;display:flex;align-items:center;gap:10px;box-shadow:0 8px 30px rgba(0,0,0,.18);animation:slideUp .3s;}.toast.success{background:var(--success);color:#fff;}.toast.error{background:var(--danger);color:#fff;}@keyframes slideUp{from{transform:translateY(20px);opacity:0}to{transform:translateY(0);opacity:1}}</style>
<script>
const CSRF='{{ csrf_token() }}';
function openModal(id){document.getElementById(id).classList.add('open');}
function closeModal(id){document.getElementById(id).classList.remove('open');}
document.querySelectorAll('.modal-overlay').forEach(m=>m.addEventListener('click',e=>{if(e.target===m)m.classList.remove('open');}));
function showToast(msg,type='success'){document.querySelectorAll('.toast').forEach(t=>t.remove());const t=document.createElement('div');t.className='toast '+type;t.innerHTML=`<i class="fa-solid fa-circle-check"></i> ${msg}`;document.body.appendChild(t);setTimeout(()=>{t.style.opacity='0';t.style.transition='opacity .4s';setTimeout(()=>t.remove(),400);},3500);}

function viewReg(id) {
  openModal('viewModal');
  document.getElementById('viewContent').innerHTML='<div style="text-align:center;padding:30px"><i class="fa-solid fa-spinner fa-spin" style="font-size:22px;color:var(--primary)"></i></div>';
  fetch(`/admin/registration/${id}/show`,{headers:{'X-Requested-With':'XMLHttpRequest'}}).then(r=>r.json()).then(d=>{
    const cert = d.certificate ? `<span class="tag tag-approved" style="font-family:monospace">${d.certificate.cert_id}</span> — Issued ${d.certificate.issue_date}` : 'Not issued yet';
    document.getElementById('viewContent').innerHTML=`<div class="detail-grid">
      <div class="detail-item"><label>Firm</label><p>${d.firm_name}</p></div>
      <div class="detail-item"><label>Proprietor</label><p>${d.proprietor}</p></div>
      <div class="detail-item"><label>District</label><p>${d.district}</p></div>
      <div class="detail-item"><label>Mobile</label><p>${d.mobile_primary}</p></div>
      <div class="detail-item"><label>Email</label><p>${d.email}</p></div>
      <div class="detail-item"><label>Certificate</label><p>${cert}</p></div>
      <div class="detail-item" style="grid-column:1/-1"><label>Address</label><p>${d.address}</p></div>
      <div class="detail-item" style="grid-column:1/-1"><label>Services</label><p>${Array.isArray(d.services_offered)?d.services_offered.join(', '):d.services_offered}</p></div>
    </div>`;
  });
}

function issueCert(id, name) {
  document.getElementById('issueId').value=id;
  document.getElementById('issueFirmTitle').textContent=`Issue to: ${name}`;
  openModal('issueModal');
}

function submitIssue() {
  const id=document.getElementById('issueId').value;
  fetch(`/admin/registration/${id}/issue-certificate`,{method:'POST',headers:{'X-CSRF-TOKEN':CSRF,'X-Requested-With':'XMLHttpRequest'}})
  .then(r=>r.json()).then(res=>{
    if(res.success){closeModal('issueModal');showToast(res.message);setTimeout(()=>location.reload(),700);}
    else showToast(res.message,'error');
  });
}

function delReg(id, name) {
  if(!confirm(`Delete registration for "${name}"? This cannot be undone.`)) return;
  fetch(`/admin/registration/${id}/destroy`,{method:'DELETE',headers:{'X-CSRF-TOKEN':CSRF,'X-Requested-With':'XMLHttpRequest'}})
  .then(r=>r.json()).then(res=>{
    if(res.success){showToast(res.message);setTimeout(()=>location.reload(),700);}
    else showToast(res.message,'error');
  });
}
</script>
@endsection
