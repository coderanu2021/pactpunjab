@extends('layouts.backend')
@section('title', 'Events')

@section('content')
<div class="page-header">
  <div><h1><i class="fa-solid fa-calendar-days" style="color:var(--primary);margin-right:8px"></i>Events</h1><p>Create, manage and track association events.</p></div>
  <div class="header-actions">
    <button class="btn btn-primary" onclick="openModal('addModal')"><i class="fa-solid fa-plus"></i> Add Event</button>
  </div>
</div>

<div class="stats-grid">
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Total</div><div class="stat-value" style="margin-top:8px">{{ $data->total() }}</div></div><div class="stat-icon" style="background:var(--primary-soft);color:var(--primary)"><i class="fa-solid fa-calendar-days"></i></div></div><div class="stat-footer"><span class="stat-footer-label">All events</span></div></div>
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Upcoming</div><div class="stat-value" style="margin-top:8px;color:var(--success)">{{ $data->where('status','Active')->count() }}</div></div><div class="stat-icon" style="background:var(--success-soft);color:var(--success)"><i class="fa-solid fa-calendar-check"></i></div></div><div class="stat-footer"><span class="stat-footer-label">Active</span></div></div>
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Completed</div><div class="stat-value" style="margin-top:8px;color:var(--primary)">{{ $data->where('status','Completed')->count() }}</div></div><div class="stat-icon" style="background:var(--primary-soft);color:var(--primary)"><i class="fa-solid fa-circle-check"></i></div></div><div class="stat-footer"><span class="stat-footer-label">Past</span></div></div>
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Cancelled</div><div class="stat-value" style="margin-top:8px;color:var(--danger)">{{ $data->where('status','Cancelled')->count() }}</div></div><div class="stat-icon" style="background:var(--danger-soft);color:var(--danger)"><i class="fa-solid fa-circle-xmark"></i></div></div><div class="stat-footer"><span class="stat-footer-label">Cancelled</span></div></div>
</div>

<form method="GET" class="filters-bar">
  <div class="search-box"><i class="fa-solid fa-magnifying-glass"></i><input type="text" name="search" value="{{ request('search') }}" placeholder="Search events…" oninput="this.form.submit()"/></div>
  <select name="status" class="filter-select" onchange="this.form.submit()">
    <option value="">All Statuses</option>
    <option value="Active" {{ request('status')=='Active'?'selected':'' }}>Active</option>
    <option value="Completed" {{ request('status')=='Completed'?'selected':'' }}>Completed</option>
    <option value="Cancelled" {{ request('status')=='Cancelled'?'selected':'' }}>Cancelled</option>
  </select>
</form>

<div class="card">
  <div class="card-header"><div class="card-title">All Events</div><div class="card-subtitle">{{ $data->firstItem()??0 }}–{{ $data->lastItem()??0 }} of {{ $data->total() }}</div></div>
  <div style="overflow-x:auto">
    <table class="data-table">
      <thead><tr><th>Event ID</th><th>Name</th><th>Category</th><th>Date</th><th>Location</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        @forelse($data as $item)
        <tr>
          <td style="font-weight:600;color:var(--primary);font-family:monospace">{{ $item->event_id }}</td>
          <td><div class="user-name">{{ $item->name }}</div></td>
          <td style="color:var(--text-secondary)">{{ $item->category ?? '—' }}</td>
          <td style="color:var(--text-secondary)">{{ $item->event_date ? \Carbon\Carbon::parse($item->event_date)->format('d M Y') : '—' }}</td>
          <td style="color:var(--text-secondary)">{{ $item->location ?? '—' }}</td>
          <td>@php $cls=$item->status=='Cancelled'?'tag-rejected':($item->status=='Completed'?'tag-info':'tag-approved');@endphp<span class="tag {{ $cls }}">{{ $item->status }}</span></td>
          <td>
            <div class="action-group">
              <button class="icon-btn view" title="View" onclick="viewEvent({{ $item->id }})"><i class="fa-solid fa-eye"></i></button>
              <button class="icon-btn edit" title="Edit" onclick="editEvent({{ $item->id }})"><i class="fa-solid fa-pen"></i></button>
              <button class="icon-btn delete" title="Delete" onclick="crudDelete('/admin/events/{{ $item->id }}','{{ addslashes($item->name) }}')"><i class="fa-solid fa-trash"></i></button>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="7" style="text-align:center;padding:40px;color:var(--text-muted)">No events found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div style="padding:14px 20px;border-top:1px solid var(--border)">{{ $data->links('pagination::bootstrap-4') }}</div>
</div>

{{-- View Modal --}}
<div class="modal-overlay" id="viewModal">
  <div class="modal"><div class="modal-header"><h2><i class="fa-solid fa-calendar" style="color:var(--primary);margin-right:8px"></i>Event Details</h2><button class="modal-close" onclick="closeModal('viewModal')"><i class="fa-solid fa-xmark"></i></button></div>
  <div class="modal-body" id="viewModalBody"></div>
  <div class="modal-footer" id="viewModalFooter"><button class="btn btn-outline" onclick="closeModal('viewModal')">Close</button></div></div>
</div>

{{-- Edit Modal --}}
<div class="modal-overlay" id="editModal">
  <div class="modal"><div class="modal-header"><h2><i class="fa-solid fa-pen" style="color:var(--warning);margin-right:8px"></i>Edit Event</h2><button class="modal-close" onclick="closeModal('editModal')"><i class="fa-solid fa-xmark"></i></button></div>
  <div class="modal-body">
    <input type="hidden" id="eId"/>
    <div class="detail-grid" style="gap:14px">
      <div class="detail-item"><label>Event Name *</label><input type="text" class="form-input" id="eName"/></div>
      <div class="detail-item"><label>Category</label><input type="text" class="form-input" id="eCategory" placeholder="e.g. Sports, CSR"/></div>
      <div class="detail-item"><label>Date *</label><input type="date" class="form-input" id="eDate"/></div>
      <div class="detail-item"><label>Location *</label><input type="text" class="form-input" id="eLocation"/></div>
      <div class="detail-item"><label>Status</label><select class="form-input" id="eStatus"><option>Active</option><option>Completed</option><option>Cancelled</option></select></div>
      <div class="detail-item" style="grid-column:1/-1"><label>Description</label><textarea class="form-input" id="eDescription" rows="3"></textarea></div>
    </div>
    <div id="editModalError" class="form-error" style="display:none"></div>
  </div>
  <div class="modal-footer"><button class="btn btn-outline" onclick="closeModal('editModal')">Cancel</button><button class="btn btn-primary" onclick="submitEdit()"><i class="fa-solid fa-floppy-disk"></i> Save</button></div></div>
</div>

{{-- Add Modal --}}
<div class="modal-overlay" id="addModal">
  <div class="modal"><div class="modal-header"><h2><i class="fa-solid fa-plus" style="color:var(--primary);margin-right:8px"></i>Add Event</h2><button class="modal-close" onclick="closeModal('addModal')"><i class="fa-solid fa-xmark"></i></button></div>
  <div class="modal-body">
    <div class="detail-grid" style="gap:14px">
      <div class="detail-item"><label>Event Name *</label><input type="text" class="form-input" id="aName"/></div>
      <div class="detail-item"><label>Category</label><input type="text" class="form-input" id="aCategory" placeholder="e.g. Sports, CSR"/></div>
      <div class="detail-item"><label>Date *</label><input type="date" class="form-input" id="aDate"/></div>
      <div class="detail-item"><label>Location *</label><input type="text" class="form-input" id="aLocation"/></div>
      <div class="detail-item"><label>Status</label><select class="form-input" id="aStatus"><option>Active</option><option>Completed</option><option>Cancelled</option></select></div>
      <div class="detail-item" style="grid-column:1/-1"><label>Description</label><textarea class="form-input" id="aDescription" rows="3"></textarea></div>
    </div>
    <div id="addError" class="form-error" style="display:none"></div>
  </div>
  <div class="modal-footer"><button class="btn btn-outline" onclick="closeModal('addModal')">Cancel</button><button class="btn btn-primary" onclick="submitAdd()"><i class="fa-solid fa-save"></i> Save</button></div></div>
</div>
@endsection

@section('script')
@include('partials.crud-script')
<script>
function viewEvent(id){
  crudEdit(`/admin/events/${id}`,d=>{
    let h=`<div class="detail-grid"><div class="detail-item"><label>Event ID</label><div class="val">${d.event_id}</div></div><div class="detail-item"><label>Name</label><div class="val">${d.name}</div></div><div class="detail-item"><label>Category</label><div class="val">${d.category||'—'}</div></div><div class="detail-item"><label>Date</label><div class="val">${d.event_date}</div></div><div class="detail-item"><label>Location</label><div class="val">${d.location||'—'}</div></div><div class="detail-item"><label>Status</label><div class="val">${d.status}</div></div><div class="detail-item" style="grid-column:1/-1"><label>Description</label><div class="val">${d.description||'—'}</div></div></div>`;
    document.getElementById('viewModalBody').innerHTML=h;openModal('viewModal');
  });
}
function editEvent(id){
  crudEdit(`/admin/events/${id}`, d=>{
    document.getElementById('eId').value = d.id;
    document.getElementById('eName').value = d.name;
    document.getElementById('eCategory').value = d.category || '';
    document.getElementById('eDescription').value = d.description || '';
    if(d.event_date) document.getElementById('eDate').value = d.event_date.split('T')[0];
    document.getElementById('eLocation').value = d.location || '';
    document.getElementById('eStatus').value = d.status;
    openModal('editModal');
  });
}
function submitEdit(){
  const id=document.getElementById('eId').value;
  const fd=new FormData();
  fd.append('_method','PUT');
  fd.append('name',document.getElementById('eName').value);
  fd.append('category',document.getElementById('eCategory').value);
  fd.append('description',document.getElementById('eDescription').value);
  fd.append('event_date',document.getElementById('eDate').value);
  fd.append('location',document.getElementById('eLocation').value);
  fd.append('status',document.getElementById('eStatus').value);
  crudSave(`/admin/events/${id}`,'editModalError',()=>{closeModal('editModal');_reload();},fd);
}
function submitAdd(){
  const fd=new FormData();
  fd.append('name',document.getElementById('aName').value);
  fd.append('category',document.getElementById('aCategory').value);
  fd.append('description',document.getElementById('aDescription').value);
  fd.append('event_date',document.getElementById('aDate').value);
  fd.append('location',document.getElementById('aLocation').value);
  fd.append('status',document.getElementById('aStatus').value);
  crudSave('/admin/events/store','addError',()=>{closeModal('addModal');_reload();},fd);
}

// override crudSave to handle FormData
function crudSave(url, errorElId, onSuccess, formData){
  fetch(url,{method:'POST',body:formData,headers:{'X-CSRF-TOKEN':_CSRF,'X-Requested-With':'XMLHttpRequest','Accept':'application/json'}})
  .then(r=>r.json()).then(res=>{
    if(res.success){ showToast(res.message||'Saved.'); if(onSuccess) onSuccess(); else _reload(); }
    else{ const e=document.getElementById(errorElId); if(e){e.textContent=res.message||'Error.';e.style.display='block';} else showToast(res.message||'Error.','error'); }
  }).catch(()=>showToast('Network error.','error'));
}
</script>
@endsection
