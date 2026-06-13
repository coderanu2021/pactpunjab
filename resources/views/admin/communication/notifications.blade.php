@extends('layouts.backend')
@section('title', 'Notifications')
@section('content')
<div class="page-header">
  <div><h1><i class="fa-solid fa-bell" style="color:var(--primary);margin-right:8px"></i>Notifications</h1><p>Create and manage notifications sent to members.</p></div>
  <div class="header-actions"><button class="btn btn-primary" onclick="openModal('addModal')"><i class="fa-solid fa-plus"></i> New Notification</button></div>
</div>
<div class="stats-grid">
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Total</div><div class="stat-value" style="margin-top:8px">{{ $data->total() }}</div></div><div class="stat-icon" style="background:var(--primary-soft);color:var(--primary)"><i class="fa-solid fa-bell"></i></div></div></div>
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Active</div><div class="stat-value" style="margin-top:8px;color:var(--success)">{{ $data->where('status','Active')->count() }}</div></div><div class="stat-icon" style="background:var(--success-soft);color:var(--success)"><i class="fa-solid fa-circle-check"></i></div></div></div>
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Inactive</div><div class="stat-value" style="margin-top:8px;color:var(--danger)">{{ $data->where('status','Inactive')->count() }}</div></div><div class="stat-icon" style="background:var(--danger-soft);color:var(--danger)"><i class="fa-solid fa-bell-slash"></i></div></div></div>
</div>
<form method="GET" class="filters-bar">
  <div class="search-box"><i class="fa-solid fa-magnifying-glass"></i><input type="text" name="search" value="{{ request('search') }}" placeholder="Search…" oninput="this.form.submit()"/></div>
  <select name="status" class="filter-select" onchange="this.form.submit()"><option value="">All</option><option value="Active" {{ request('status')=='Active'?'selected':'' }}>Active</option><option value="Inactive" {{ request('status')=='Inactive'?'selected':'' }}>Inactive</option></select>
</form>
<div class="card">
  <div class="card-header"><div class="card-title">All Notifications</div><div class="card-subtitle">{{ $data->firstItem()??0 }}–{{ $data->lastItem()??0 }} of {{ $data->total() }}</div></div>
  <div style="overflow-x:auto"><table class="data-table"><thead><tr><th>#</th><th>Title</th><th>Message</th><th>Status</th><th>Actions</th></tr></thead>
  <tbody>
    @forelse($data as $item)
    <tr>
      <td style="color:var(--text-muted)">{{ $item->id }}</td>
      <td><div class="user-name">{{ $item->title }}</div></td>
      <td style="color:var(--text-secondary);max-width:280px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ $item->message }}</td>
      <td>@php $c=$item->status=='Active'?'tag-approved':'tag-rejected';@endphp<span class="tag {{ $c }}">{{ $item->status }}</span></td>
      <td><div class="action-group">
        <button class="icon-btn view" onclick="viewR({{ $item->id }})"><i class="fa-solid fa-eye"></i></button>
        <button class="icon-btn edit" onclick="editR({{ $item->id }})"><i class="fa-solid fa-pen"></i></button>
        <button class="icon-btn delete" onclick="crudDelete('/admin/communication/notifications/{{ $item->id }}','{{ addslashes($item->title) }}')"><i class="fa-solid fa-trash"></i></button>
      </div></td>
    </tr>
    @empty<tr><td colspan="5" style="text-align:center;padding:40px;color:var(--text-muted)">No notifications.</td></tr>@endforelse
  </tbody></table></div>
  <div style="padding:14px 20px;border-top:1px solid var(--border)">{{ $data->links('pagination::bootstrap-4') }}</div>
</div>

<div class="modal-overlay" id="viewModal"><div class="modal">
  <div class="modal-header"><h2><i class="fa-solid fa-eye" style="color:var(--primary);margin-right:8px"></i>Notification Details</h2><button class="modal-close" onclick="closeModal('viewModal')"><i class="fa-solid fa-xmark"></i></button></div>
  <div class="modal-body" id="viewModalBody"></div>
  <div class="modal-footer" id="viewModalFooter"><button class="btn btn-outline" onclick="closeModal('viewModal')">Close</button></div>
</div></div>

<div class="modal-overlay" id="editModal"><div class="modal">
  <div class="modal-header"><h2><i class="fa-solid fa-pen" style="color:var(--warning);margin-right:8px"></i>Edit Notification</h2><button class="modal-close" onclick="closeModal('editModal')"><i class="fa-solid fa-xmark"></i></button></div>
  <div class="modal-body"><input type="hidden" id="eId"/>
    <div class="detail-grid" style="gap:14px">
      <div class="detail-item" style="grid-column:1/-1"><label>Title *</label><input type="text" class="form-input" id="eTitle"/></div>
      <div class="detail-item" style="grid-column:1/-1"><label>Message *</label><textarea class="form-input" id="eMsg" rows="3"></textarea></div>
      <div class="detail-item"><label>Status</label><select class="form-input" id="eStatus"><option value="Active">Active</option><option value="Inactive">Inactive</option></select></div>
    </div>
    <div id="editModalError" class="form-error" style="display:none"></div>
  </div>
  <div class="modal-footer"><button class="btn btn-outline" onclick="closeModal('editModal')">Cancel</button><button class="btn btn-primary" onclick="submitEdit()"><i class="fa-solid fa-floppy-disk"></i> Save</button></div>
</div></div>

<div class="modal-overlay" id="addModal"><div class="modal">
  <div class="modal-header"><h2><i class="fa-solid fa-bell" style="color:var(--primary);margin-right:8px"></i>New Notification</h2><button class="modal-close" onclick="closeModal('addModal')"><i class="fa-solid fa-xmark"></i></button></div>
  <div class="modal-body">
    <div class="detail-grid" style="gap:14px">
      <div class="detail-item" style="grid-column:1/-1"><label>Title *</label><input type="text" class="form-input" id="aTitle"/></div>
      <div class="detail-item" style="grid-column:1/-1"><label>Message *</label><textarea class="form-input" id="aMsg" rows="3"></textarea></div>
      <div class="detail-item"><label>Status</label><select class="form-input" id="aStatus"><option value="Active">Active</option><option value="Inactive">Inactive</option></select></div>
    </div>
    <div id="addError" class="form-error" style="display:none"></div>
  </div>
  <div class="modal-footer"><button class="btn btn-outline" onclick="closeModal('addModal')">Cancel</button><button class="btn btn-primary" onclick="submitAdd()"><i class="fa-solid fa-paper-plane"></i> Create</button></div>
</div></div>
@endsection
@section('script')
@include('partials.crud-script')
<script>
function post(url,fd,errId,cb){fetch(url,{method:'POST',body:fd,headers:{'X-CSRF-TOKEN':_CSRF,'X-Requested-With':'XMLHttpRequest','Accept':'application/json'}}).then(r=>r.json()).then(res=>{if(res.success){showToast(res.message);cb();}else{const e=document.getElementById(errId);if(e){e.textContent=res.message;e.style.display='block';}else showToast(res.message,'error');}}).catch(()=>showToast('Network error','error'));}
function viewR(id){crudView(`/admin/communication/notifications/${id}`,d=>`<div class="detail-grid">${detailRow('Title',d.title,true)}${detailRow('Message',d.message,true)}${detailRow('Status',d.status)}</div>`);}
function editR(id){crudEdit(`/admin/communication/notifications/${id}`,d=>{document.getElementById('eId').value=d.id;document.getElementById('eTitle').value=d.title;document.getElementById('eMsg').value=d.message;document.getElementById('eStatus').value=d.status;});}
function submitEdit(){const id=document.getElementById('eId').value;const fd=new FormData();fd.append('_method','PUT');fd.append('title',document.getElementById('eTitle').value);fd.append('message',document.getElementById('eMsg').value);fd.append('status',document.getElementById('eStatus').value);post(`/admin/communication/notifications/${id}`,fd,'editModalError',()=>{closeModal('editModal');_reload();});}
function submitAdd(){const fd=new FormData();fd.append('title',document.getElementById('aTitle').value);fd.append('message',document.getElementById('aMsg').value);fd.append('status',document.getElementById('aStatus').value);post('/admin/communication/notifications/store',fd,'addError',()=>{closeModal('addModal');_reload();});}
</script>
@endsection
