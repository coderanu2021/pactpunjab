@extends('layouts.backend')
@section('title', 'Certificate Templates')
@section('content')
<div class="page-header">
  <div><h1><i class="fa-solid fa-file-contract" style="color:var(--primary);margin-right:8px"></i>Certificate Templates</h1><p>Manage templates used for issuing certificates.</p></div>
  <div class="header-actions"><button class="btn btn-primary" onclick="openModal('addModal')"><i class="fa-solid fa-plus"></i> Add Template</button></div>
</div>
<div class="stats-grid">
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Total</div><div class="stat-value" style="margin-top:8px">{{ $data->total() }}</div></div><div class="stat-icon" style="background:var(--primary-soft);color:var(--primary)"><i class="fa-solid fa-layer-group"></i></div></div></div>
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Active</div><div class="stat-value" style="margin-top:8px;color:var(--success)">{{ $data->where('status','Active')->count() }}</div></div><div class="stat-icon" style="background:var(--success-soft);color:var(--success)"><i class="fa-solid fa-circle-check"></i></div></div></div>
</div>
<form method="GET" class="filters-bar">
  <div class="search-box"><i class="fa-solid fa-magnifying-glass"></i><input type="text" name="search" value="{{ request('search') }}" placeholder="Search templates…" oninput="this.form.submit()"/></div>
  <select name="status" class="filter-select" onchange="this.form.submit()"><option value="">All</option><option value="Active" {{ request('status')=='Active'?'selected':'' }}>Active</option><option value="Inactive" {{ request('status')=='Inactive'?'selected':'' }}>Inactive</option></select>
</form>
<div class="card">
  <div class="card-header"><div class="card-title">Certificate Templates</div><div class="card-subtitle">{{ $data->firstItem()??0 }}–{{ $data->lastItem()??0 }} of {{ $data->total() }}</div></div>
  <div style="overflow-x:auto"><table class="data-table"><thead><tr><th>#</th><th>Template Name</th><th>Orientation</th><th>Status</th><th>Actions</th></tr></thead>
  <tbody>
    @forelse($data as $item)
    <tr>
      <td style="color:var(--text-muted)">{{ $item->id }}</td>
      <td><div style="display:flex;align-items:center;gap:10px"><div style="width:34px;height:34px;border-radius:8px;background:var(--purple-soft);color:var(--purple);display:flex;align-items:center;justify-content:center"><i class="fa-solid fa-file-contract"></i></div><div class="user-name">{{ $item->name }}</div></div></td>
      <td><span class="tag tag-info">{{ ucfirst($item->orientation) }}</span></td>
      <td>@php $c=$item->status=='Active'?'tag-approved':'tag-rejected';@endphp<span class="tag {{ $c }}">{{ $item->status }}</span></td>
      <td><div class="action-group">
        <button class="icon-btn view" onclick="viewR({{ $item->id }})"><i class="fa-solid fa-eye"></i></button>
        <button class="icon-btn edit" onclick="editR({{ $item->id }})"><i class="fa-solid fa-pen"></i></button>
        <button class="icon-btn delete" onclick="crudDelete('/admin/certificates/templates/{{ $item->id }}','{{ addslashes($item->name) }}')"><i class="fa-solid fa-trash"></i></button>
      </div></td>
    </tr>
    @empty<tr><td colspan="5" style="text-align:center;padding:40px;color:var(--text-muted)">No templates.</td></tr>@endforelse
  </tbody></table></div>
  <div style="padding:14px 20px;border-top:1px solid var(--border)">{{ $data->links('pagination::bootstrap-4') }}</div>
</div>

<div class="modal-overlay" id="viewModal"><div class="modal" style="width:420px">
  <div class="modal-header"><h2><i class="fa-solid fa-file-contract" style="color:var(--primary);margin-right:8px"></i>Template Details</h2><button class="modal-close" onclick="closeModal('viewModal')"><i class="fa-solid fa-xmark"></i></button></div>
  <div class="modal-body" id="viewModalBody"></div><div class="modal-footer" id="viewModalFooter"><button class="btn btn-outline" onclick="closeModal('viewModal')">Close</button></div>
</div></div>

<div class="modal-overlay" id="editModal"><div class="modal" style="width:440px">
  <div class="modal-header"><h2><i class="fa-solid fa-pen" style="color:var(--warning);margin-right:8px"></i>Edit Template</h2><button class="modal-close" onclick="closeModal('editModal')"><i class="fa-solid fa-xmark"></i></button></div>
  <div class="modal-body"><input type="hidden" id="eId"/>
    <div class="detail-grid" style="gap:14px">
      <div class="detail-item" style="grid-column:1/-1"><label>Name *</label><input type="text" class="form-input" id="eName"/></div>
      <div class="detail-item"><label>Orientation</label><select class="form-input" id="eOrientation"><option value="landscape">Landscape</option><option value="portrait">Portrait</option></select></div>
      <div class="detail-item"><label>Status</label><select class="form-input" id="eStatus"><option value="Active">Active</option><option value="Inactive">Inactive</option></select></div>
    </div><div id="editModalError" class="form-error" style="display:none"></div>
  </div>
  <div class="modal-footer"><button class="btn btn-outline" onclick="closeModal('editModal')">Cancel</button><button class="btn btn-primary" onclick="submitEdit()"><i class="fa-solid fa-floppy-disk"></i> Save</button></div>
</div></div>

<div class="modal-overlay" id="addModal"><div class="modal" style="width:440px">
  <div class="modal-header"><h2><i class="fa-solid fa-plus" style="color:var(--primary);margin-right:8px"></i>Add Template</h2><button class="modal-close" onclick="closeModal('addModal')"><i class="fa-solid fa-xmark"></i></button></div>
  <div class="modal-body">
    <div class="detail-grid" style="gap:14px">
      <div class="detail-item" style="grid-column:1/-1"><label>Name *</label><input type="text" class="form-input" id="aName" placeholder="e.g. Membership Certificate"/></div>
      <div class="detail-item"><label>Orientation</label><select class="form-input" id="aOrientation"><option value="landscape">Landscape</option><option value="portrait">Portrait</option></select></div>
      <div class="detail-item"><label>Status</label><select class="form-input" id="aStatus"><option value="Active">Active</option><option value="Inactive">Inactive</option></select></div>
    </div><div id="addError" class="form-error" style="display:none"></div>
  </div>
  <div class="modal-footer"><button class="btn btn-outline" onclick="closeModal('addModal')">Cancel</button><button class="btn btn-primary" onclick="submitAdd()"><i class="fa-solid fa-save"></i> Save</button></div>
</div></div>
@endsection
@section('script')
@include('partials.crud-script')
<script>
function post(url,fd,errId,cb){fetch(url,{method:'POST',body:fd,headers:{'X-CSRF-TOKEN':_CSRF,'X-Requested-With':'XMLHttpRequest','Accept':'application/json'}}).then(r=>r.json()).then(res=>{if(res.success){showToast(res.message);cb();}else{const e=document.getElementById(errId);if(e){e.textContent=res.message;e.style.display='block';}else showToast(res.message,'error');}}).catch(()=>showToast('Network error','error'));}
function viewR(id){crudView(`/admin/certificates/templates/${id}`,d=>`<div class="detail-grid">${detailRow('Name',d.name,true)}${detailRow('Orientation',d.orientation)}${detailRow('Status',d.status)}</div>`);}
function editR(id){crudEdit(`/admin/certificates/templates/${id}`,d=>{document.getElementById('eId').value=d.id;document.getElementById('eName').value=d.name;document.getElementById('eOrientation').value=d.orientation;document.getElementById('eStatus').value=d.status;});}
function submitEdit(){const id=document.getElementById('eId').value;const fd=new FormData();fd.append('_method','PUT');fd.append('name',document.getElementById('eName').value);fd.append('orientation',document.getElementById('eOrientation').value);fd.append('status',document.getElementById('eStatus').value);post(`/admin/certificates/templates/${id}`,fd,'editModalError',()=>{closeModal('editModal');_reload();});}
function submitAdd(){const fd=new FormData();fd.append('name',document.getElementById('aName').value);fd.append('orientation',document.getElementById('aOrientation').value);fd.append('status',document.getElementById('aStatus').value);post('/admin/certificates/templates/store',fd,'addError',()=>{closeModal('addModal');_reload();});}
</script>
@endsection
