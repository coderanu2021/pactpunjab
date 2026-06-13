@extends('layouts.backend')
@section('title', 'Pending Approvals')

@section('content')

<div class="page-header">
  <div>
    <h1><i class="fa-solid fa-hourglass-half" style="color:var(--warning);margin-right:8px"></i>Pending Approvals</h1>
    <p>Review and approve or reject pending certification registrations.</p>
  </div>
  <div class="header-actions">
    <span class="tag tag-pending" style="padding:7px 16px;font-size:13px"><i class="fa-solid fa-clock"></i> {{ $data->total() }} Pending</span>
  </div>
</div>

@if($data->total() == 0)
<div style="text-align:center;padding:80px 24px;background:var(--surface);border-radius:var(--radius);border:1px solid var(--border)">
  <div style="width:72px;height:72px;border-radius:50%;background:var(--success-soft);display:flex;align-items:center;justify-content:center;margin:0 auto 18px;font-size:30px;color:var(--success)">
    <i class="fa-solid fa-circle-check"></i>
  </div>
  <h3 style="font-size:18px;font-weight:700;color:var(--text-main);margin-bottom:8px">All caught up!</h3>
  <p style="font-size:14px;color:var(--text-muted)">No pending registrations to review at this time.</p>
  <a href="{{ route('admin.registration.personal') }}" class="btn btn-primary" style="margin-top:20px">
    <i class="fa-solid fa-list"></i> View All Registrations
  </a>
</div>
@else
<div class="card">
  <div class="card-header">
    <div>
      <div class="card-title">Applications Awaiting Review</div>
      <div class="card-subtitle">{{ $data->total() }} applications need your decision</div>
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
          <th>Submitted</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $item)
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
          <td style="color:var(--text-muted);font-size:12px">{{ $item->created_at->diffForHumans() }}</td>
          <td>
            <div class="action-group">
              <button class="icon-btn view" title="View Details" onclick="viewRecord({{ $item->id }})"><i class="fa-solid fa-eye"></i></button>
              <button class="icon-btn" title="Approve" style="background:var(--success-soft);color:var(--success)" onclick="approveRecord({{ $item->id }},'{{ addslashes($item->firm_name) }}')"><i class="fa-solid fa-check"></i></button>
              <button class="icon-btn" title="Reject"  style="background:var(--danger-soft);color:var(--danger)"  onclick="rejectRecord({{ $item->id }},'{{ addslashes($item->firm_name) }}')"><i class="fa-solid fa-xmark"></i></button>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div style="padding:14px 20px;border-top:1px solid var(--border)">
    {{ $data->links('pagination::bootstrap-4') }}
  </div>
</div>
@endif

{{-- View Modal --}}
<div class="modal-overlay" id="viewModal">
  <div class="modal" style="width:680px">
    <div class="modal-header">
      <h2><i class="fa-solid fa-eye" style="color:var(--primary);margin-right:8px"></i>Registration Details</h2>
      <button class="modal-close" onclick="closeModal('viewModal')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body" id="viewContent"><div style="text-align:center;padding:30px"><i class="fa-solid fa-spinner fa-spin" style="font-size:22px;color:var(--primary)"></i></div></div>
    <div class="modal-footer" id="viewFooter">
      <button class="btn btn-outline" onclick="closeModal('viewModal')">Close</button>
    </div>
  </div>
</div>

{{-- Reject Modal --}}
<div class="modal-overlay" id="rejectModal">
  <div class="modal" style="width:440px">
    <div class="modal-header">
      <h2><i class="fa-solid fa-xmark" style="color:var(--danger);margin-right:8px"></i>Reject Registration</h2>
      <button class="modal-close" onclick="closeModal('rejectModal')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body">
      <p style="font-size:13px;color:var(--text-secondary);margin-bottom:14px">Rejecting: <strong id="rejectFirmName"></strong></p>
      <input type="hidden" id="rejectId"/>
      <label style="display:block">
        <span style="font-size:11px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:.05em;display:block;margin-bottom:5px">Rejection Reason (optional)</span>
        <textarea class="form-input" id="rejectReason" rows="3" placeholder="State reason…"></textarea>
      </label>
    </div>
    <div class="modal-footer">
      <button class="btn btn-outline" onclick="closeModal('rejectModal')">Cancel</button>
      <button class="btn" style="background:var(--danger);color:#fff" onclick="submitReject()"><i class="fa-solid fa-xmark"></i> Reject</button>
    </div>
  </div>
</div>

@endsection

@section('script')
<style>
.toast { position:fixed;bottom:28px;right:28px;z-index:999;padding:13px 20px;border-radius:10px;font-size:13px;font-weight:500;display:flex;align-items:center;gap:10px;box-shadow:0 8px 30px rgba(0,0,0,.18);animation:slideUp .3s;max-width:380px; }
.toast.success { background:var(--success);color:#fff; }
.toast.error   { background:var(--danger);color:#fff; }
@keyframes slideUp { from{transform:translateY(20px);opacity:0} to{transform:translateY(0);opacity:1} }
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

function viewRecord(id) {
  openModal('viewModal');
  document.getElementById('viewContent').innerHTML = '<div style="text-align:center;padding:30px"><i class="fa-solid fa-spinner fa-spin" style="font-size:22px;color:var(--primary)"></i></div>';
  fetch(`/admin/registration/${id}/show`, { headers:{'X-Requested-With':'XMLHttpRequest'} })
    .then(r => r.json())
    .then(d => {
      const services = Array.isArray(d.services_offered) ? d.services_offered.join(', ') : d.services_offered;
      document.getElementById('viewContent').innerHTML = `
        <div class="detail-grid">
          <div class="detail-item"><label>Firm Name</label><p>${d.firm_name}</p></div>
          <div class="detail-item"><label>Association</label><p>${d.association}</p></div>
          <div class="detail-item"><label>Proprietor</label><p>${d.proprietor}</p></div>
          <div class="detail-item"><label>District</label><p>${d.district}</p></div>
          <div class="detail-item"><label>Mobile</label><p>${d.mobile_primary}</p></div>
          <div class="detail-item"><label>Email</label><p>${d.email}</p></div>
          <div class="detail-item" style="grid-column:1/-1"><label>Address</label><p>${d.address}</p></div>
          <div class="detail-item" style="grid-column:1/-1"><label>Companies Dealt With</label><p>${d.companies_dealt_with}</p></div>
          <div class="detail-item" style="grid-column:1/-1"><label>Services Offered</label><p>${services}</p></div>
        </div>`;
      document.getElementById('viewFooter').innerHTML = `
        <button class="btn btn-outline" onclick="closeModal('viewModal')">Close</button>
        <button class="btn" style="background:var(--danger-soft);color:var(--danger)" onclick="closeModal('viewModal');rejectRecord(${d.id},'${d.firm_name}')"><i class="fa-solid fa-xmark"></i> Reject</button>
        <button class="btn btn-primary" onclick="closeModal('viewModal');approveRecord(${d.id},'${d.firm_name}')"><i class="fa-solid fa-check"></i> Approve</button>`;
    });
}

function approveRecord(id, name) {
  if(!confirm(`Approve registration for "${name}"?`)) return;
  fetch(`/admin/registration/${id}/approve`, {
    method:'POST', headers:{'X-CSRF-TOKEN':CSRF,'X-Requested-With':'XMLHttpRequest','Content-Type':'application/json'}
  }).then(r=>r.json()).then(res => {
    if(res.success) { showToast(res.message); setTimeout(()=>location.reload(),700); }
    else showToast(res.message,'error');
  });
}

function rejectRecord(id, name) {
  document.getElementById('rejectId').value = id;
  document.getElementById('rejectFirmName').textContent = name;
  document.getElementById('rejectReason').value = '';
  openModal('rejectModal');
}

function submitReject() {
  const id = document.getElementById('rejectId').value;
  const reason = document.getElementById('rejectReason').value;
  fetch(`/admin/registration/${id}/reject`, {
    method:'POST', headers:{'X-CSRF-TOKEN':CSRF,'X-Requested-With':'XMLHttpRequest','Content-Type':'application/json'},
    body: JSON.stringify({rejection_reason: reason})
  }).then(r=>r.json()).then(res => {
    if(res.success) { closeModal('rejectModal'); showToast(res.message); setTimeout(()=>location.reload(),700); }
    else showToast(res.message,'error');
  });
}
</script>
@endsection
