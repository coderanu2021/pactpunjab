@extends('layouts.backend')
@section('title', 'Downloads')
@section('content')
<div class="page-header">
  <div><h1><i class="fa-solid fa-folder-arrow-down" style="color:var(--primary);margin-right:8px"></i>Downloads</h1><p>Manage downloadable files, forms and resources for members.</p></div>
  <div class="header-actions"><button class="btn btn-primary" onclick="openModal('addModal')"><i class="fa-solid fa-upload"></i> Upload File</button></div>
</div>
<div class="stats-grid">
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Total Files</div><div class="stat-value" style="margin-top:8px">{{ $data->total() }}</div></div><div class="stat-icon" style="background:var(--primary-soft);color:var(--primary)"><i class="fa-solid fa-folder-open"></i></div></div></div>
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Active</div><div class="stat-value" style="margin-top:8px;color:var(--success)">{{ $data->where('status','Active')->count() }}</div></div><div class="stat-icon" style="background:var(--success-soft);color:var(--success)"><i class="fa-solid fa-circle-check"></i></div></div></div>
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Inactive</div><div class="stat-value" style="margin-top:8px;color:var(--danger)">{{ $data->where('status','Inactive')->count() }}</div></div><div class="stat-icon" style="background:var(--danger-soft);color:var(--danger)"><i class="fa-solid fa-circle-xmark"></i></div></div></div>
</div>
<form method="GET" class="filters-bar">
  <div class="search-box"><i class="fa-solid fa-magnifying-glass"></i><input type="text" name="search" value="{{ request('search') }}" placeholder="Search files…" oninput="this.form.submit()"/></div>
  <select name="status" class="filter-select" onchange="this.form.submit()"><option value="">All</option><option value="Active" {{ request('status')=='Active'?'selected':'' }}>Active</option><option value="Inactive" {{ request('status')=='Inactive'?'selected':'' }}>Inactive</option></select>
</form>
<div class="card">
  <div class="card-header"><div class="card-title">All Download Files</div><div class="card-subtitle">{{ $data->firstItem()??0 }}–{{ $data->lastItem()??0 }} of {{ $data->total() }}</div></div>
  <div style="overflow-x:auto"><table class="data-table"><thead><tr><th>#</th><th>File Title</th><th>Category</th><th>Filename</th><th>Status</th><th>Actions</th></tr></thead>
  <tbody>
    @forelse($data as $item)
    <tr>
      <td style="color:var(--text-muted)">{{ $item->id }}</td>
      <td><div style="display:flex;align-items:center;gap:10px"><div style="width:34px;height:34px;border-radius:8px;background:var(--primary-soft);color:var(--primary);display:flex;align-items:center;justify-content:center"><i class="fa-solid fa-file-arrow-down"></i></div><div class="user-name">{{ $item->title }}</div></div></td>
      <td style="color:var(--text-muted)">{{ $item->category ?? '—' }}</td>
      <td style="color:var(--text-muted);font-size:12px">{{ $item->file_path ? basename($item->file_path) : '—' }}</td>
      <td>@php $c=$item->status=='Active'?'tag-approved':'tag-rejected';@endphp<span class="tag {{ $c }}">{{ $item->status }}</span></td>
      <td><div class="action-group">
        @if($item->file_path)<a href="{{ asset('storage/'.$item->file_path) }}" target="_blank" class="icon-btn view" style="text-decoration:none" title="Download"><i class="fa-solid fa-download"></i></a>@endif
        <button class="icon-btn edit" onclick="editR({{ $item->id }})"><i class="fa-solid fa-pen"></i></button>
        <button class="icon-btn delete" onclick="crudDelete('/admin/documents/downloads/{{ $item->id }}','{{ addslashes($item->title) }}')"><i class="fa-solid fa-trash"></i></button>
      </div></td>
    </tr>
    @empty<tr><td colspan="6" style="text-align:center;padding:40px;color:var(--text-muted)">No files.</td></tr>@endforelse
  </tbody></table></div>
  <div style="padding:14px 20px;border-top:1px solid var(--border)">{{ $data->links('pagination::bootstrap-4') }}</div>
</div>

<div class="modal-overlay" id="editModal"><div class="modal" style="width:440px">
  <div class="modal-header"><h2><i class="fa-solid fa-pen" style="color:var(--warning);margin-right:8px"></i>Edit File</h2><button class="modal-close" onclick="closeModal('editModal')"><i class="fa-solid fa-xmark"></i></button></div>
  <div class="modal-body"><input type="hidden" id="eId"/>
    <div class="detail-grid" style="gap:14px">
      <div class="detail-item" style="grid-column:1/-1"><label>Title *</label><input type="text" class="form-input" id="eTitle"/></div>
      <div class="detail-item"><label>Category</label><input type="text" class="form-input" id="eCategory" placeholder="e.g. Forms, Circulars"/></div>
      <div class="detail-item"><label>Status</label><select class="form-input" id="eStatus"><option value="Active">Active</option><option value="Inactive">Inactive</option></select></div>
    </div><div id="editModalError" class="form-error" style="display:none"></div>
  </div>
  <div class="modal-footer"><button class="btn btn-outline" onclick="closeModal('editModal')">Cancel</button><button class="btn btn-primary" onclick="submitEdit()"><i class="fa-solid fa-floppy-disk"></i> Save</button></div>
</div></div>

<div class="modal-overlay" id="addModal"><div class="modal">
  <div class="modal-header"><h2><i class="fa-solid fa-upload" style="color:var(--primary);margin-right:8px"></i>Upload File</h2><button class="modal-close" onclick="closeModal('addModal')"><i class="fa-solid fa-xmark"></i></button></div>
  <div class="modal-body">
    <form id="addForm" enctype="multipart/form-data">
      <div class="detail-grid" style="gap:14px">
        <div class="detail-item" style="grid-column:1/-1"><label>File Title *</label><input type="text" class="form-input" name="title" placeholder="e.g. Membership Form 2025"/></div>
        <div class="detail-item"><label>Category</label><input type="text" class="form-input" name="category" placeholder="e.g. Forms, Circulars"/></div>
        <div class="detail-item"><label>File *</label><input type="file" class="form-input" name="file" accept=".pdf,.doc,.docx,.xlsx,.zip"/></div>
        <div class="detail-item"><label>Status</label><select class="form-input" name="status"><option value="Active">Active</option><option value="Inactive">Inactive</option></select></div>
      </div><div id="addError" class="form-error" style="display:none"></div>
    </form>
  </div>
  <div class="modal-footer"><button class="btn btn-outline" onclick="closeModal('addModal')">Cancel</button><button class="btn btn-primary" onclick="submitAdd()"><i class="fa-solid fa-upload"></i> Upload</button></div>
</div></div>
@endsection
@section('script')
@include('partials.crud-script')
<script>
function post(url,fd,errId,cb){fetch(url,{method:'POST',body:fd,headers:{'X-CSRF-TOKEN':_CSRF,'X-Requested-With':'XMLHttpRequest','Accept':'application/json'}}).then(r=>r.json()).then(res=>{if(res.success){showToast(res.message);cb();}else{const e=document.getElementById(errId);if(e){e.textContent=res.message;e.style.display='block';}else showToast(res.message,'error');}}).catch(()=>showToast('Network error','error'));}
function editR(id){crudEdit(`/admin/documents/downloads/${id}`,d=>{document.getElementById('eId').value=d.id;document.getElementById('eTitle').value=d.title;document.getElementById('eCategory').value=d.category||'';document.getElementById('eStatus').value=d.status;});}
function submitEdit(){const id=document.getElementById('eId').value;const fd=new FormData();fd.append('title',document.getElementById('eTitle').value);fd.append('category',document.getElementById('eCategory').value);fd.append('status',document.getElementById('eStatus').value);post(`/admin/documents/downloads/${id}`,fd,'editModalError',()=>{closeModal('editModal');_reload();});}
function submitAdd(){const form=document.getElementById('addForm');const fd=new FormData(form);post('/admin/documents/downloads/store',fd,'addError',()=>{closeModal('addModal');_reload();});}
</script>
@endsection
