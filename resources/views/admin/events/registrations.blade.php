@extends('layouts.backend')
@section('title', 'Event Registrations')

@section('content')
<div class="page-header">
  <div><h1><i class="fa-solid fa-clipboard-list" style="color:var(--primary);margin-right:8px"></i>Event Registrations</h1><p>Track attendee registrations and payment status.</p></div>
  <div class="header-actions">
    <button class="btn btn-primary" onclick="openModal('addModal')"><i class="fa-solid fa-plus"></i> Add Registration</button>
  </div>
</div>

<div class="stats-grid">
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Total</div><div class="stat-value" style="margin-top:8px">{{ $data->total() }}</div></div><div class="stat-icon" style="background:var(--primary-soft);color:var(--primary)"><i class="fa-solid fa-clipboard-list"></i></div></div></div>
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Confirmed</div><div class="stat-value" style="margin-top:8px;color:var(--success)">{{ $data->where('status','Confirmed')->count() }}</div></div><div class="stat-icon" style="background:var(--success-soft);color:var(--success)"><i class="fa-solid fa-circle-check"></i></div></div></div>
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Paid</div><div class="stat-value" style="margin-top:8px;color:var(--primary)">{{ $data->where('payment_status','Paid')->count() }}</div></div><div class="stat-icon" style="background:var(--primary-soft);color:var(--primary)"><i class="fa-solid fa-money-bill"></i></div></div></div>
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Pending Payment</div><div class="stat-value" style="margin-top:8px;color:var(--warning)">{{ $data->where('payment_status','Pending')->count() }}</div></div><div class="stat-icon" style="background:var(--warning-soft);color:var(--warning)"><i class="fa-solid fa-clock"></i></div></div></div>
</div>

<form method="GET" class="filters-bar">
  <div class="search-box"><i class="fa-solid fa-magnifying-glass"></i><input type="text" name="search" value="{{ request('search') }}" placeholder="Search attendee, ID…" oninput="this.form.submit()"/></div>
  <select name="status" class="filter-select" onchange="this.form.submit()">
    <option value="">All Statuses</option>
    <option value="Confirmed" {{ request('status')=='Confirmed'?'selected':'' }}>Confirmed</option>
    <option value="Pending" {{ request('status')=='Pending'?'selected':'' }}>Pending</option>
    <option value="Cancelled" {{ request('status')=='Cancelled'?'selected':'' }}>Cancelled</option>
  </select>
</form>

<div class="card">
  <div class="card-header"><div class="card-title">All Event Registrations</div><div class="card-subtitle">{{ $data->firstItem()??0 }}–{{ $data->lastItem()??0 }} of {{ $data->total() }}</div></div>
  <div style="overflow-x:auto">
    <table class="data-table">
      <thead><tr><th>Reg ID</th><th>Attendee</th><th>Event</th><th>Payment</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        @forelse($data as $item)
        <tr>
          <td style="font-weight:600;color:var(--primary);font-family:monospace">{{ $item->reg_id }}</td>
          <td><div class="user-name">{{ $item->attendee_name }}</div></td>
          <td style="color:var(--text-secondary);font-family:monospace">{{ $item->event->event_id ?? $item->event_id }}</td>
          <td>@php $pc=$item->payment_status=='Paid'?'tag-approved':'tag-pending';@endphp<span class="tag {{ $pc }}">{{ $item->payment_status }}</span></td>
          <td>@php $sc=$item->status=='Cancelled'?'tag-rejected':($item->status=='Pending'?'tag-pending':'tag-approved');@endphp<span class="tag {{ $sc }}">{{ $item->status }}</span></td>
          <td>
            <div class="action-group">
              <button class="icon-btn view" title="View" onclick="viewReg({{ $item->id }})"><i class="fa-solid fa-eye"></i></button>
              <button class="icon-btn edit" title="Edit" onclick="editReg({{ $item->id }})"><i class="fa-solid fa-pen"></i></button>
              <button class="icon-btn delete" title="Delete" onclick="crudDelete('/admin/events/registrations/{{ $item->id }}','{{ addslashes($item->attendee_name) }}')"><i class="fa-solid fa-trash"></i></button>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="6" style="text-align:center;padding:40px;color:var(--text-muted)">No registrations found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div style="padding:14px 20px;border-top:1px solid var(--border)">{{ $data->links('pagination::bootstrap-4') }}</div>
</div>

<div class="modal-overlay" id="viewModal">
  <div class="modal"><div class="modal-header"><h2><i class="fa-solid fa-eye" style="color:var(--primary);margin-right:8px"></i>Registration Details</h2><button class="modal-close" onclick="closeModal('viewModal')"><i class="fa-solid fa-xmark"></i></button></div>
  <div class="modal-body" id="viewModalBody"></div>
  <div class="modal-footer" id="viewModalFooter"><button class="btn btn-outline" onclick="closeModal('viewModal')">Close</button></div></div>
</div>

<div class="modal-overlay" id="editModal">
  <div class="modal"><div class="modal-header"><h2><i class="fa-solid fa-pen" style="color:var(--warning);margin-right:8px"></i>Edit Registration</h2><button class="modal-close" onclick="closeModal('editModal')"><i class="fa-solid fa-xmark"></i></button></div>
  <div class="modal-body">
    <input type="hidden" id="eId"/>
    <div class="detail-grid" style="gap:14px">
      <div class="detail-item"><label>Attendee Name *</label><input type="text" class="form-input" id="eAttendeeName"/></div>
      <div class="detail-item"><label>Event *</label>
        <select class="form-input" id="eEventId">
          @foreach($events as $ev)<option value="{{ $ev->id }}">{{ $ev->name }}</option>@endforeach
        </select>
      </div>
      <div class="detail-item"><label>Payment Status</label><select class="form-input" id="ePayment"><option value="Paid">Paid</option><option value="Pending">Pending</option></select></div>
      <div class="detail-item"><label>Status</label><select class="form-input" id="eStatus"><option value="Confirmed">Confirmed</option><option value="Pending">Pending</option><option value="Cancelled">Cancelled</option></select></div>
    </div>
    <div id="editModalError" class="form-error" style="display:none"></div>
  </div>
  <div class="modal-footer"><button class="btn btn-outline" onclick="closeModal('editModal')">Cancel</button><button class="btn btn-primary" onclick="submitEdit()"><i class="fa-solid fa-floppy-disk"></i> Save</button></div></div>
</div>

<div class="modal-overlay" id="addModal">
  <div class="modal"><div class="modal-header"><h2><i class="fa-solid fa-plus" style="color:var(--primary);margin-right:8px"></i>Add Event Registration</h2><button class="modal-close" onclick="closeModal('addModal')"><i class="fa-solid fa-xmark"></i></button></div>
  <div class="modal-body">
    <div class="detail-grid" style="gap:14px">
      <div class="detail-item"><label>Attendee Name *</label><input type="text" class="form-input" id="aName"/></div>
      <div class="detail-item"><label>Event *</label>
        <select class="form-input" id="aEventId">
          @foreach($events as $ev)<option value="{{ $ev->id }}">{{ $ev->name }}</option>@endforeach
        </select>
      </div>
      <div class="detail-item"><label>Payment Status</label><select class="form-input" id="aPayment"><option value="Paid">Paid</option><option value="Pending">Pending</option></select></div>
      <div class="detail-item"><label>Status</label><select class="form-input" id="aStatus"><option value="Confirmed">Confirmed</option><option value="Pending">Pending</option><option value="Cancelled">Cancelled</option></select></div>
    </div>
    <div id="addError" class="form-error" style="display:none"></div>
  </div>
  <div class="modal-footer"><button class="btn btn-outline" onclick="closeModal('addModal')">Cancel</button><button class="btn btn-primary" onclick="submitAdd()"><i class="fa-solid fa-save"></i> Save</button></div></div>
</div>
@endsection

@section('script')
@include('partials.crud-script')
<script>
function viewReg(id){
  crudView(`/admin/events/registrations/${id}`, d=>`
    <div class="detail-grid">
      ${detailRow('Reg ID', d.reg_id)}
      ${detailRow('Attendee', d.attendee_name)}
      ${detailRow('Event ID', d.event_id)}
      ${detailRow('Payment', d.payment_status)}
      ${detailRow('Status', d.status)}
    </div>`);
}
function editReg(id){
  crudEdit(`/admin/events/registrations/${id}`, d=>{
    document.getElementById('eId').value=d.id;
    document.getElementById('eAttendeeName').value=d.attendee_name;
    document.getElementById('eEventId').value=d.event_id;
    document.getElementById('ePayment').value=d.payment_status;
    document.getElementById('eStatus').value=d.status;
  });
}
function submitEdit(){
  const id=document.getElementById('eId').value;
  const fd=new FormData();fd.append('_method','PUT');
  fd.append('attendee_name',document.getElementById('eAttendeeName').value);
  fd.append('event_id',document.getElementById('eEventId').value);
  fd.append('payment_status',document.getElementById('ePayment').value);
  fd.append('status',document.getElementById('eStatus').value);
  postSave(`/admin/events/registrations/${id}`,fd,'editModalError',()=>{closeModal('editModal');_reload();});
}
function submitAdd(){
  const fd=new FormData();
  fd.append('attendee_name',document.getElementById('aName').value);
  fd.append('event_id',document.getElementById('aEventId').value);
  fd.append('payment_status',document.getElementById('aPayment').value);
  fd.append('status',document.getElementById('aStatus').value);
  postSave('/admin/events/registrations/store',fd,'addError',()=>{closeModal('addModal');_reload();});
}
function postSave(url,fd,errId,cb){
  fetch(url,{method:'POST',body:fd,headers:{'X-CSRF-TOKEN':_CSRF,'X-Requested-With':'XMLHttpRequest','Accept':'application/json'}})
  .then(r=>r.json()).then(res=>{
    if(res.success){showToast(res.message||'Saved.');cb();}
    else{const e=document.getElementById(errId);if(e){e.textContent=res.message||'Error.';e.style.display='block';}else showToast(res.message,'error');}
  }).catch(()=>showToast('Network error.','error'));
}
</script>
@endsection
