@extends('layouts.backend')
@section('title', 'Circulars')
@section('content')
<div class="page-header">
  <div><h1><i class="fa-solid fa-scroll" style="color:var(--primary);margin-right:8px"></i>Circulars</h1><p>Manage official circulars issued to members.</p></div>
  <div class="header-actions"><button class="btn btn-primary" onclick="openModal('addModal')"><i class="fa-solid fa-plus"></i> Add Circular</button></div>
</div>
<div class="stats-grid">
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Total</div><div class="stat-value" style="margin-top:8px">{{ $data->total() }}</div></div><div class="stat-icon" style="background:var(--primary-soft);color:var(--primary)"><i class="fa-solid fa-scroll"></i></div></div></div>
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Published</div><div class="stat-value" style="margin-top:8px;color:var(--success)">{{ $data->where('status','Published')->count() }}</div></div><div class="stat-icon" style="background:var(--success-soft);color:var(--success)"><i class="fa-solid fa-circle-check"></i></div></div></div>
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Draft</div><div class="stat-value" style="margin-top:8px;color:var(--warning)">{{ $data->where('status','Draft')->count() }}</div></div><div class="stat-icon" style="background:var(--warning-soft);color:var(--warning)"><i class="fa-solid fa-file-pen"></i></div></div></div>
</div>
<form method="GET" class="filters-bar">
  <div class="search-box"><i class="fa-solid fa-magnifying-glass"></i><input type="text" name="search" value="{{ request('search') }}" placeholder="Search circulars…" oninput="this.form.submit()"/></div>
  <select name="status" class="filter-select" onchange="this.form.submit()"><option value="">All</option><option value="Published" {{ request('status')=='Published'?'selected':'' }}>Published</option><option value="Draft" {{ request('status')=='Draft'?'selected':'' }}>Draft</option></select>
</form>
<div class="card">
  <div class="card-header"><div class="card-title">All Circulars</div><div class="card-subtitle">{{ $data->firstItem()??0 }}–{{ $data->lastItem()??0 }} of {{ $data->total() }}</div></div>
  <div style="overflow-x:auto"><table class="data-table"><thead><tr><th>Circular ID</th><th>Subject</th><th>Date Issued</th><th>Audience</th><th>Status</th><th>Actions</th></tr></thead>
  <tbody>
    @forelse($data as $item)
    <tr>
      <td style="font-weight:600;color:var(--primary);font-family:monospace">{{ $item->circular_id }}</td>
      <td><div class="user-name">{{ $item->subject }}</div></td>
      <td style="color:var(--text-secondary)">{{ $item->date_issued ? \Carbon\Carbon::parse($item->date_issued)->format('d M Y') : '—' }}</td>
      <td style="color:var(--text-secondary)">{{ $item->target_audience ?? '—' }}</td>
      <td>@php $c=$item->status=='Published'?'tag-approved':'tag-pending';@endphp<span class="tag {{ $c }}">{{ $item->status }}</span></td>
      <td><div class="action-group">
        <button class="icon-btn view" onclick="viewR({{ $item->id }})"><i class="fa-solid fa-eye"></i></button>
        <button class="icon-btn edit" onclick="editR({{ $item->id }})"><i class="fa-solid fa-pen"></i></button>
        <button class="icon-btn delete" onclick="crudDelete('/admin/communication/circulars/{{ $item->id }}','{{ addslashes($item->subject) }}')"><i class="fa-solid fa-trash"></i></button>
      </div></td>
    </tr>
    @empty<tr><td colspan="6" style="text-align:center;padding:40px;color:var(--text-muted)">No circulars.</td></tr>@endforelse
  </tbody></table></div>
  <div style="padding:14px 20px;border-top:1px solid var(--border)">{{ $data->links('pagination::bootstrap-4') }}</div>
</div>

<div class="modal-overlay" id="viewModal"><div class="modal">
  <div class="modal-header"><h2><i class="fa-solid fa-scroll" style="color:var(--primary);margin-right:8px"></i>Circular Details</h2><button class="modal-close" onclick="closeModal('viewModal')"><i class="fa-solid fa-xmark"></i></button></div>
  <div class="modal-body" id="viewModalBody"></div><div class="modal-footer" id="viewModalFooter"><button class="btn btn-outline" onclick="closeModal('viewModal')">Close</button></div>
</div></div>

<div class="modal-overlay" id="editModal"><div class="modal">
  <div class="modal-header"><h2><i class="fa-solid fa-pen" style="color:var(--warning);margin-right:8px"></i>Edit Circular</h2><button class="modal-close" onclick="closeModal('editModal')"><i class="fa-solid fa-xmark"></i></button></div>
  <div class="modal-body"><input type="hidden" id="eId"/>
    <div class="detail-grid" style="gap:14px">
      <div class="detail-item" style="grid-column:1/-1"><label>Subject *</label><input type="text" class="form-input" id="eSubject"/></div>
      <div class="detail-item"><label>Date Issued</label><input type="date" class="form-input" id="eDate"/></div>
      <div class="detail-item"><label>Target Audience</label><input type="text" class="form-input" id="eAudience"/></div>
      <div class="detail-item"><label>Status</label><select class="form-input" id="eStatus"><option value="Published">Published</option><option value="Draft">Draft</option></select></div>
    </div><div id="editModalError" class="form-error" style="display:none"></div>
  </div>
  <div class="modal-footer"><button class="btn btn-outline" onclick="closeModal('editModal')">Cancel</button><button class="btn btn-primary" onclick="submitEdit()"><i class="fa-solid fa-floppy-disk"></i> Save</button></div>
</div></div>

<div class="modal-overlay" id="addModal"><div class="modal">
  <div class="modal-header"><h2><i class="fa-solid fa-scroll" style="color:var(--primary);margin-right:8px"></i>Add Circular</h2><button class="modal-close" onclick="closeModal('addModal')"><i class="fa-solid fa-xmark"></i></button></div>
  <div class="modal-body">
    <div class="detail-grid" style="gap:14px">
      <div class="detail-item" style="grid-column:1/-1"><label>Subject *</label><input type="text" class="form-input" id="aSubject"/></div>
      <div class="detail-item"><label>Date Issued</label><input type="date" class="form-input" id="aDate"/></div>
      <div class="detail-item"><label>Target Audience</label><input type="text" class="form-input" id="aAudience" placeholder="All Members…"/></div>
      <div class="detail-item"><label>Status</label><select class="form-input" id="aStatus"><option value="Published">Published</option><option value="Draft">Draft</option></select></div>
    </div><div id="addError" class="form-error" style="display:none"></div>
  </div>
  <div class="modal-footer"><button class="btn btn-outline" onclick="closeModal('addModal')">Cancel</button><button class="btn btn-primary" onclick="submitAdd()"><i class="fa-solid fa-save"></i> Save</button></div>
</div></div>
@endsection
@section('script')
@include('partials.crud-script')
<script>
function post(url,fd,errId,cb){fetch(url,{method:'POST',body:fd,headers:{'X-CSRF-TOKEN':_CSRF,'X-Requested-With':'XMLHttpRequest','Accept':'application/json'}}).then(r=>r.json()).then(res=>{if(res.success){showToast(res.message);cb();}else{const e=document.getElementById(errId);if(e){e.textContent=res.message;e.style.display='block';}else showToast(res.message,'error');}}).catch(()=>showToast('Network error','error'));}
function viewR(id){crudView(`/admin/communication/circulars/${id}`,d=>`<div class="detail-grid">${detailRow('Circular ID',d.circular_id)}${detailRow('Date Issued',d.date_issued)}${detailRow('Audience',d.target_audience)}${detailRow('Status',d.status)}${detailRow('Subject',d.subject,true)}</div>`);}
function editR(id){crudEdit(`/admin/communication/circulars/${id}`,d=>{document.getElementById('eId').value=d.id;document.getElementById('eSubject').value=d.subject;document.getElementById('eDate').value=d.date_issued||'';document.getElementById('eAudience').value=d.target_audience||'';document.getElementById('eStatus').value=d.status;});}
function submitEdit(){const id=document.getElementById('eId').value;const fd=new FormData();fd.append('_method','PUT');fd.append('subject',document.getElementById('eSubject').value);fd.append('date_issued',document.getElementById('eDate').value);fd.append('target_audience',document.getElementById('eAudience').value);fd.append('status',document.getElementById('eStatus').value);post(`/admin/communication/circulars/${id}`,fd,'editModalError',()=>{closeModal('editModal');_reload();});}
function submitAdd(){const fd=new FormData();fd.append('subject',document.getElementById('aSubject').value);fd.append('date_issued',document.getElementById('aDate').value);fd.append('target_audience',document.getElementById('aAudience').value);fd.append('status',document.getElementById('aStatus').value);post('/admin/communication/circulars/store',fd,'addError',()=>{closeModal('addModal');_reload();});}
</script>
@endsection
