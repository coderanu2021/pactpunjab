@extends('layouts.backend')
@section('title', 'Association Registrations')
@section('content')
<div class="page-header">
  <div><h1><i class="fa-solid fa-building-user" style="color:var(--primary);margin-right:8px"></i>Association Registrations</h1><p>Manage all association/organization certification registrations.</p></div>
  <div class="header-actions"><button class="btn btn-outline"><i class="fa-solid fa-download"></i> Export</button></div>
</div>
<div class="stats-grid">
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Total</div><div class="stat-value" style="margin-top:8px">{{ $stats['total'] }}</div></div><div class="stat-icon" style="background:var(--primary-soft);color:var(--primary)"><i class="fa-solid fa-building"></i></div></div></div>
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Pending</div><div class="stat-value" style="margin-top:8px;color:var(--warning)">{{ $stats['pending'] }}</div></div><div class="stat-icon" style="background:var(--warning-soft);color:var(--warning)"><i class="fa-solid fa-clock"></i></div></div></div>
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Approved</div><div class="stat-value" style="margin-top:8px;color:var(--success)">{{ $stats['approved'] }}</div></div><div class="stat-icon" style="background:var(--success-soft);color:var(--success)"><i class="fa-solid fa-circle-check"></i></div></div></div>
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Rejected</div><div class="stat-value" style="margin-top:8px;color:var(--danger)">{{ $stats['rejected'] }}</div></div><div class="stat-icon" style="background:var(--danger-soft);color:var(--danger)"><i class="fa-solid fa-circle-xmark"></i></div></div></div>
</div>
<form method="GET" action="{{ route('admin.registration.association') }}" class="filters-bar">
  <div class="search-box"><i class="fa-solid fa-magnifying-glass"></i><input type="text" name="search" value="{{ request('search') }}" placeholder="Search firm, district…" oninput="this.form.submit()"/></div>
  <select name="status" class="filter-select" onchange="this.form.submit()">
    <option value="">All</option>
    <option value="Pending" {{ request('status')=='Pending'?'selected':'' }}>Pending</option>
    <option value="Approved" {{ request('status')=='Approved'?'selected':'' }}>Approved</option>
    <option value="Rejected" {{ request('status')=='Rejected'?'selected':'' }}>Rejected</option>
  </select>
</form>
<div class="card">
  <div class="card-header"><div class="card-title">Association / Organization Registrations</div><div class="card-subtitle">{{ $data->firstItem()??0 }}–{{ $data->lastItem()??0 }} of {{ $data->total() }}</div></div>
  <div style="overflow-x:auto"><table class="data-table"><thead><tr><th>#</th><th>Firm Name</th><th>Proprietor</th><th>District</th><th>Mobile</th><th>Status</th><th>Actions</th></tr></thead>
  <tbody>
    @forelse($data as $item)
    <tr>
      <td style="color:var(--text-muted)">{{ $item->id }}</td>
      <td><div class="user-name">{{ $item->firm_name }}</div><div class="user-email">{{ $item->association }}</div></td>
      <td style="color:var(--text-secondary)">{{ $item->proprietor }}</td>
      <td style="color:var(--text-secondary)">{{ $item->district }}</td>
      <td style="color:var(--text-secondary)">{{ $item->mobile_primary }}</td>
      <td>@php $c=$item->status=='Approved'?'tag-approved':($item->status=='Rejected'?'tag-rejected':'tag-pending');@endphp<span class="tag {{ $c }}">{{ $item->status ?? 'Pending' }}</span></td>
      <td><div class="action-group">
        <button class="icon-btn view" onclick="viewR({{ $item->id }})"><i class="fa-solid fa-eye"></i></button>
        @if($item->status=='Pending' || $item->status==null)
        <button class="icon-btn" title="Approve" style="background:var(--success-soft);color:var(--success)" onclick="approveR({{ $item->id }},'{{ addslashes($item->firm_name) }}')"><i class="fa-solid fa-check"></i></button>
        <button class="icon-btn" title="Reject" style="background:var(--danger-soft);color:var(--danger)" onclick="rejectR({{ $item->id }},'{{ addslashes($item->firm_name) }}')"><i class="fa-solid fa-xmark"></i></button>
        @endif
        <button class="icon-btn delete" onclick="crudDelete('/admin/registration/{{ $item->id }}/destroy','{{ addslashes($item->firm_name) }}')"><i class="fa-solid fa-trash"></i></button>
      </div></td>
    </tr>
    @empty<tr><td colspan="7" style="text-align:center;padding:40px;color:var(--text-muted)">No association registrations.</td></tr>@endforelse
  </tbody></table></div>
  <div style="padding:14px 20px;border-top:1px solid var(--border)">{{ $data->links('pagination::bootstrap-4') }}</div>
</div>

<div class="modal-overlay" id="viewModal"><div class="modal" style="width:680px">
  <div class="modal-header"><h2><i class="fa-solid fa-building-user" style="color:var(--primary);margin-right:8px"></i>Registration Details</h2><button class="modal-close" onclick="closeModal('viewModal')"><i class="fa-solid fa-xmark"></i></button></div>
  <div class="modal-body" id="viewModalBody"></div><div class="modal-footer" id="viewModalFooter"><button class="btn btn-outline" onclick="closeModal('viewModal')">Close</button></div>
</div></div>

<div class="modal-overlay" id="rejectModal"><div class="modal" style="width:440px">
  <div class="modal-header"><h2><i class="fa-solid fa-xmark" style="color:var(--danger);margin-right:8px"></i>Reject Registration</h2><button class="modal-close" onclick="closeModal('rejectModal')"><i class="fa-solid fa-xmark"></i></button></div>
  <div class="modal-body"><input type="hidden" id="rjId"/><p style="font-size:13px;color:var(--text-secondary);margin-bottom:12px">Rejecting: <strong id="rjName"></strong></p>
    <label style="display:block"><span style="font-size:11px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:.05em;display:block;margin-bottom:5px">Reason (optional)</span>
      <textarea class="form-input" id="rjReason" rows="3"></textarea>
    </label>
  </div>
  <div class="modal-footer"><button class="btn btn-outline" onclick="closeModal('rejectModal')">Cancel</button><button class="btn" style="background:var(--danger);color:#fff" onclick="submitReject()"><i class="fa-solid fa-xmark"></i> Reject</button></div>
</div></div>
@endsection
@section('script')
@include('partials.crud-script')
<script>
function viewR(id){
  crudView(`/admin/registration/${id}/show`,d=>`<div class="detail-grid">${detailRow('Firm',d.firm_name)}${detailRow('Association',d.association)}${detailRow('Proprietor',d.proprietor)}${detailRow('District',d.district)}${detailRow('Mobile',d.mobile_primary)}${detailRow('Email',d.email)}${detailRow('Address',d.address,true)}${detailRow('Companies',d.companies_dealt_with,true)}</div>`);
  window._viewFooterFn=(d,footer)=>{
    if(d.status==='Pending'||!d.status){
      footer.innerHTML=`<button class="btn btn-outline" onclick="closeModal('viewModal')">Close</button>
        <button class="btn" style="background:var(--danger-soft);color:var(--danger)" onclick="closeModal('viewModal');rejectR(${d.id},'${d.firm_name}')"><i class="fa-solid fa-xmark"></i> Reject</button>
        <button class="btn btn-primary" onclick="closeModal('viewModal');approveR(${d.id},'${d.firm_name}')"><i class="fa-solid fa-check"></i> Approve</button>`;
    }
  };
}
function approveR(id,name){
  if(!confirm(`Approve "${name}"?`)) return;
  fetch(`/admin/registration/${id}/approve`,{method:'POST',headers:{'X-CSRF-TOKEN':_CSRF,'X-Requested-With':'XMLHttpRequest','Content-Type':'application/json'}})
  .then(r=>r.json()).then(res=>{if(res.success){showToast(res.message);setTimeout(()=>location.reload(),700);}else showToast(res.message,'error');});
}
function rejectR(id,name){document.getElementById('rjId').value=id;document.getElementById('rjName').textContent=name;document.getElementById('rjReason').value='';openModal('rejectModal');}
function submitReject(){
  const id=document.getElementById('rjId').value;const reason=document.getElementById('rjReason').value;
  fetch(`/admin/registration/${id}/reject`,{method:'POST',headers:{'X-CSRF-TOKEN':_CSRF,'X-Requested-With':'XMLHttpRequest','Content-Type':'application/json'},body:JSON.stringify({rejection_reason:reason})})
  .then(r=>r.json()).then(res=>{if(res.success){closeModal('rejectModal');showToast(res.message);setTimeout(()=>location.reload(),700);}else showToast(res.message,'error');});
}
</script>
@endsection
