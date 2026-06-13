@extends('layouts.backend')
@section('title', 'Personal Certificates')
@section('content')
<div class="page-header">
  <div><h1><i class="fa-solid fa-id-badge" style="color:var(--primary);margin-right:8px"></i>Personal Certificates</h1><p>View and manage certificates issued to individual members.</p></div>
  <div class="header-actions"><a href="{{ route('admin.certificates.generated') }}" class="btn btn-primary"><i class="fa-solid fa-award"></i> Issue Certificate</a></div>
</div>
<div class="stats-grid">
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Total</div><div class="stat-value" style="margin-top:8px">{{ $data->total() }}</div></div><div class="stat-icon" style="background:var(--primary-soft);color:var(--primary)"><i class="fa-solid fa-certificate"></i></div></div></div>
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Active</div><div class="stat-value" style="margin-top:8px;color:var(--success)">{{ $data->where('status','Active')->count() }}</div></div><div class="stat-icon" style="background:var(--success-soft);color:var(--success)"><i class="fa-solid fa-circle-check"></i></div></div></div>
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Expired</div><div class="stat-value" style="margin-top:8px;color:var(--danger)">{{ $data->where('status','Expired')->count() }}</div></div><div class="stat-icon" style="background:var(--danger-soft);color:var(--danger)"><i class="fa-solid fa-hourglass-end"></i></div></div></div>
</div>
<form method="GET" class="filters-bar">
  <div class="search-box"><i class="fa-solid fa-magnifying-glass"></i><input type="text" name="search" value="{{ request('search') }}" placeholder="Search cert ID, issued to…" oninput="this.form.submit()"/></div>
  <select name="status" class="filter-select" onchange="this.form.submit()"><option value="">All</option><option value="Active" {{ request('status')=='Active'?'selected':'' }}>Active</option><option value="Expired" {{ request('status')=='Expired'?'selected':'' }}>Expired</option></select>
</form>
<div class="card">
  <div class="card-header"><div class="card-title">Personal Certificates</div><div class="card-subtitle">{{ $data->firstItem()??0 }}–{{ $data->lastItem()??0 }} of {{ $data->total() }}</div></div>
  <div style="overflow-x:auto"><table class="data-table"><thead><tr><th>Cert ID</th><th>Issued To</th><th>Issue Date</th><th>Expiry</th><th>Status</th><th>Actions</th></tr></thead>
  <tbody>
    @forelse($data as $item)
    <tr>
      <td style="font-weight:600;color:var(--primary);font-family:monospace">{{ $item->cert_id }}</td>
      <td><div class="user-name">{{ $item->issued_to }}</div></td>
      <td style="color:var(--text-secondary)">{{ $item->issue_date ? \Carbon\Carbon::parse($item->issue_date)->format('d M Y') : '—' }}</td>
      <td style="color:var(--text-secondary)">{{ $item->expiry_date ? \Carbon\Carbon::parse($item->expiry_date)->format('d M Y') : '—' }}</td>
      <td>@php $c=in_array($item->status,['Expired','Revoked'])?'tag-rejected':'tag-approved';@endphp<span class="tag {{ $c }}">{{ $item->status }}</span></td>
      <td><div class="action-group">
        <button class="icon-btn view" onclick="viewR({{ $item->id }})"><i class="fa-solid fa-eye"></i></button>
        @if($item->registration_id)<a href="{{ route('admin.certificates.generated') }}?reg_id={{ $item->registration_id }}" class="icon-btn" title="Print" style="background:var(--success-soft);color:var(--success);text-decoration:none"><i class="fa-solid fa-print"></i></a>@endif
        <button class="icon-btn edit" onclick="editR({{ $item->id }})"><i class="fa-solid fa-pen"></i></button>
        <button class="icon-btn delete" onclick="crudDelete('/admin/certificates/personal/{{ $item->id }}','{{ addslashes($item->cert_id) }}')"><i class="fa-solid fa-trash"></i></button>
      </div></td>
    </tr>
    @empty<tr><td colspan="6" style="text-align:center;padding:40px;color:var(--text-muted)">No certificates found.</td></tr>@endforelse
  </tbody></table></div>
  <div style="padding:14px 20px;border-top:1px solid var(--border)">{{ $data->links('pagination::bootstrap-4') }}</div>
</div>

<div class="modal-overlay" id="viewModal"><div class="modal">
  <div class="modal-header"><h2><i class="fa-solid fa-id-badge" style="color:var(--primary);margin-right:8px"></i>Certificate Details</h2><button class="modal-close" onclick="closeModal('viewModal')"><i class="fa-solid fa-xmark"></i></button></div>
  <div class="modal-body" id="viewModalBody"></div><div class="modal-footer" id="viewModalFooter"><button class="btn btn-outline" onclick="closeModal('viewModal')">Close</button></div>
</div></div>

<div class="modal-overlay" id="editModal"><div class="modal">
  <div class="modal-header"><h2><i class="fa-solid fa-pen" style="color:var(--warning);margin-right:8px"></i>Edit Certificate</h2><button class="modal-close" onclick="closeModal('editModal')"><i class="fa-solid fa-xmark"></i></button></div>
  <div class="modal-body"><input type="hidden" id="eId"/>
    <div class="detail-grid" style="gap:14px">
      <div class="detail-item" style="grid-column:1/-1"><label>Issued To *</label><input type="text" class="form-input" id="eIssuedTo"/></div>
      <div class="detail-item"><label>Issue Date *</label><input type="date" class="form-input" id="eIssue"/></div>
      <div class="detail-item"><label>Expiry Date *</label><input type="date" class="form-input" id="eExpiry"/></div>
      <div class="detail-item"><label>Status</label><select class="form-input" id="eStatus"><option value="Active">Active</option><option value="Expired">Expired</option><option value="Revoked">Revoked</option></select></div>
    </div><div id="editModalError" class="form-error" style="display:none"></div>
  </div>
  <div class="modal-footer"><button class="btn btn-outline" onclick="closeModal('editModal')">Cancel</button><button class="btn btn-primary" onclick="submitEdit()"><i class="fa-solid fa-floppy-disk"></i> Save</button></div>
</div></div>
@endsection
@section('script')
@include('partials.crud-script')
<script>
function post(url,fd,errId,cb){fetch(url,{method:'POST',body:fd,headers:{'X-CSRF-TOKEN':_CSRF,'X-Requested-With':'XMLHttpRequest','Accept':'application/json'}}).then(r=>r.json()).then(res=>{if(res.success){showToast(res.message);cb();}else{const e=document.getElementById(errId);if(e){e.textContent=res.message;e.style.display='block';}else showToast(res.message,'error');}}).catch(()=>showToast('Network error','error'));}
function viewR(id){crudView(`/admin/certificates/personal/${id}`,d=>{
  const printBtn=d.registration_id?`<a href="/admin/certificates/generated?reg_id=${d.registration_id}" class="btn btn-primary" style="text-decoration:none;padding:8px 16px;font-size:13px"><i class="fa-solid fa-print"></i> Print Certificate</a>`:'';
  return `<div class="detail-grid">${detailRow('Cert ID',`<span style="font-family:monospace;color:var(--primary)">${d.cert_id}</span>`)}${detailRow('Issued To',d.issued_to)}${detailRow('Issue Date',d.issue_date)}${detailRow('Expiry Date',d.expiry_date)}${detailRow('Status',d.status)}</div>${printBtn?'<div style="margin-top:16px">'+printBtn+'</div>':''}`;
});}
function editR(id){crudEdit(`/admin/certificates/personal/${id}`,d=>{document.getElementById('eId').value=d.id;document.getElementById('eIssuedTo').value=d.issued_to;document.getElementById('eIssue').value=d.issue_date||'';document.getElementById('eExpiry').value=d.expiry_date||'';document.getElementById('eStatus').value=d.status;});}
function submitEdit(){const id=document.getElementById('eId').value;const fd=new FormData();fd.append('_method','PUT');fd.append('issued_to',document.getElementById('eIssuedTo').value);fd.append('issue_date',document.getElementById('eIssue').value);fd.append('expiry_date',document.getElementById('eExpiry').value);fd.append('status',document.getElementById('eStatus').value);post(`/admin/certificates/personal/${id}`,fd,'editModalError',()=>{closeModal('editModal');_reload();});}
</script>
@endsection
