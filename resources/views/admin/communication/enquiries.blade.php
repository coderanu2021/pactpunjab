@extends('layouts.backend')
@section('title', 'Enquiries')
@section('content')
<div class="page-header">
  <div><h1><i class="fa-solid fa-question-circle" style="color:var(--primary);margin-right:8px"></i>Enquiries</h1><p>Review and respond to incoming enquiries.</p></div>
</div>
<div class="stats-grid">
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Total</div><div class="stat-value" style="margin-top:8px">{{ $data->total() }}</div></div><div class="stat-icon" style="background:var(--primary-soft);color:var(--primary)"><i class="fa-solid fa-question-circle"></i></div></div></div>
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Open</div><div class="stat-value" style="margin-top:8px;color:var(--warning)">{{ $data->where('status','Open')->count() }}</div></div><div class="stat-icon" style="background:var(--warning-soft);color:var(--warning)"><i class="fa-solid fa-envelope-open"></i></div></div></div>
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Resolved</div><div class="stat-value" style="margin-top:8px;color:var(--success)">{{ $data->where('status','Resolved')->count() }}</div></div><div class="stat-icon" style="background:var(--success-soft);color:var(--success)"><i class="fa-solid fa-circle-check"></i></div></div></div>
</div>
<form method="GET" class="filters-bar">
  <div class="search-box"><i class="fa-solid fa-magnifying-glass"></i><input type="text" name="search" value="{{ request('search') }}" placeholder="Search sender, subject…" oninput="this.form.submit()"/></div>
  <select name="status" class="filter-select" onchange="this.form.submit()"><option value="">All</option><option value="Open" {{ request('status')=='Open'?'selected':'' }}>Open</option><option value="Resolved" {{ request('status')=='Resolved'?'selected':'' }}>Resolved</option><option value="Closed" {{ request('status')=='Closed'?'selected':'' }}>Closed</option></select>
</form>
<div class="card">
  <div class="card-header"><div class="card-title">All Enquiries</div><div class="card-subtitle">{{ $data->firstItem()??0 }}–{{ $data->lastItem()??0 }} of {{ $data->total() }}</div></div>
  <div style="overflow-x:auto"><table class="data-table"><thead><tr><th>Enquiry ID</th><th>Sender</th><th>Subject</th><th>Status</th><th>Actions</th></tr></thead>
  <tbody>
    @forelse($data as $item)
    <tr>
      <td style="font-weight:600;color:var(--primary);font-family:monospace">{{ $item->enquiry_id }}</td>
      <td><div style="display:flex;align-items:center;gap:8px"><div style="width:30px;height:30px;border-radius:50%;background:var(--primary);display:flex;align-items:center;justify-content:center;color:#fff;font-size:11px;font-weight:700;flex-shrink:0">{{ strtoupper(substr($item->sender_name,0,2)) }}</div><div class="user-name">{{ $item->sender_name }}</div></div></td>
      <td style="color:var(--text-secondary)">{{ $item->subject }}</td>
      <td>@php $c=$item->status=='Resolved'?'tag-approved':($item->status=='Closed'?'tag-rejected':'tag-pending');@endphp<span class="tag {{ $c }}">{{ $item->status }}</span></td>
      <td><div class="action-group">
        <button class="icon-btn view" onclick="viewR({{ $item->id }})"><i class="fa-solid fa-eye"></i></button>
        <button class="icon-btn edit" onclick="editR({{ $item->id }})"><i class="fa-solid fa-circle-check"></i></button>
        <button class="icon-btn delete" onclick="crudDelete('/admin/communication/enquiries/{{ $item->id }}','{{ addslashes($item->subject) }}')"><i class="fa-solid fa-trash"></i></button>
      </div></td>
    </tr>
    @empty<tr><td colspan="5" style="text-align:center;padding:40px;color:var(--text-muted)">No enquiries.</td></tr>@endforelse
  </tbody></table></div>
  <div style="padding:14px 20px;border-top:1px solid var(--border)">{{ $data->links('pagination::bootstrap-4') }}</div>
</div>

<div class="modal-overlay" id="viewModal"><div class="modal">
  <div class="modal-header"><h2><i class="fa-solid fa-eye" style="color:var(--primary);margin-right:8px"></i>Enquiry Details</h2><button class="modal-close" onclick="closeModal('viewModal')"><i class="fa-solid fa-xmark"></i></button></div>
  <div class="modal-body" id="viewModalBody"></div><div class="modal-footer" id="viewModalFooter"><button class="btn btn-outline" onclick="closeModal('viewModal')">Close</button></div>
</div></div>

<div class="modal-overlay" id="editModal"><div class="modal" style="width:400px">
  <div class="modal-header"><h2><i class="fa-solid fa-circle-check" style="color:var(--success);margin-right:8px"></i>Update Status</h2><button class="modal-close" onclick="closeModal('editModal')"><i class="fa-solid fa-xmark"></i></button></div>
  <div class="modal-body"><input type="hidden" id="eId"/>
    <p style="font-size:13px;color:var(--text-secondary);margin-bottom:14px" id="eLabel"></p>
    <label style="display:block"><span style="font-size:11px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:.05em;display:block;margin-bottom:5px">Status</span>
      <select class="form-input" id="eStatus"><option value="Open">Open</option><option value="Resolved">Resolved</option><option value="Closed">Closed</option></select>
    </label>
    <div id="editModalError" class="form-error" style="display:none"></div>
  </div>
  <div class="modal-footer"><button class="btn btn-outline" onclick="closeModal('editModal')">Cancel</button><button class="btn btn-primary" onclick="submitEdit()"><i class="fa-solid fa-floppy-disk"></i> Update</button></div>
</div></div>
@endsection
@section('script')
@include('partials.crud-script')
<script>
function post(url,fd,errId,cb){fetch(url,{method:'POST',body:fd,headers:{'X-CSRF-TOKEN':_CSRF,'X-Requested-With':'XMLHttpRequest','Accept':'application/json'}}).then(r=>r.json()).then(res=>{if(res.success){showToast(res.message);cb();}else{const e=document.getElementById(errId);if(e){e.textContent=res.message;e.style.display='block';}else showToast(res.message,'error');}}).catch(()=>showToast('Network error','error'));}
function viewR(id){crudView(`/admin/communication/enquiries/${id}`,d=>`<div class="detail-grid">${detailRow('Enquiry ID',d.enquiry_id)}${detailRow('Sender',d.sender_name)}${detailRow('Status',d.status)}${detailRow('Subject',d.subject,true)}</div>`);}
function editR(id){crudEdit(`/admin/communication/enquiries/${id}`,d=>{document.getElementById('eId').value=d.id;document.getElementById('eLabel').textContent='Enquiry: '+d.subject;document.getElementById('eStatus').value=d.status;});}
function submitEdit(){const id=document.getElementById('eId').value;const fd=new FormData();fd.append('_method','PUT');fd.append('status',document.getElementById('eStatus').value);post(`/admin/communication/enquiries/${id}`,fd,'editModalError',()=>{closeModal('editModal');_reload();});}
</script>
@endsection
