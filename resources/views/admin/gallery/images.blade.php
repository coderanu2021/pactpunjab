@extends('layouts.backend')
@section('title', 'Gallery Images')
@section('content')
<div class="page-header">
  <div><h1><i class="fa-solid fa-image" style="color:var(--primary);margin-right:8px"></i>Gallery Images</h1><p>Upload and manage images across all gallery albums.</p></div>
  <div class="header-actions"><button class="btn btn-primary" onclick="openModal('addModal')"><i class="fa-solid fa-upload"></i> Upload Image</button></div>
</div>
<div class="stats-grid">
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Total Images</div><div class="stat-value" style="margin-top:8px">{{ $data->total() }}</div></div><div class="stat-icon" style="background:var(--primary-soft);color:var(--primary)"><i class="fa-solid fa-image"></i></div></div></div>
</div>
<form method="GET" class="filters-bar">
  <div class="search-box"><i class="fa-solid fa-magnifying-glass"></i><input type="text" name="search" value="{{ request('search') }}" placeholder="Search images…" oninput="this.form.submit()"/></div>
  <select name="album_id" class="filter-select" onchange="this.form.submit()">
    <option value="">All Albums</option>
    @foreach($albums as $al)<option value="{{ $al->id }}" {{ request('album_id')==$al->id?'selected':'' }}>{{ $al->title }}</option>@endforeach
  </select>
</form>
<div class="card">
  <div class="card-header"><div class="card-title">All Images</div><div class="card-subtitle">{{ $data->firstItem()??0 }}–{{ $data->lastItem()??0 }} of {{ $data->total() }}</div></div>
  <div style="overflow-x:auto"><table class="data-table"><thead><tr><th>Preview</th><th>Title</th><th>Album</th><th>Status</th><th>Actions</th></tr></thead>
  <tbody>
    @forelse($data as $item)
    <tr>
      <td><div style="width:48px;height:48px;border-radius:8px;background:var(--primary-soft);overflow:hidden;display:flex;align-items:center;justify-content:center;color:var(--primary)">
        @if($item->file_path)<img src="{{ asset('storage/'.$item->file_path) }}" style="width:100%;height:100%;object-fit:cover" onerror="this.parentNode.innerHTML='<i class=\'fa-solid fa-image\'></i>'">@else<i class="fa-solid fa-image"></i>@endif
      </div></td>
      <td><div class="user-name">{{ $item->title ?? '—' }}</div></td>
      <td style="color:var(--text-secondary)">{{ $item->album->title ?? $item->album_id }}</td>
      <td>@php $c=isset($item->status)&&$item->status=='Active'?'tag-approved':'tag-rejected';@endphp<span class="tag {{ $c }}">{{ $item->status ?? 'Active' }}</span></td>
      <td><div class="action-group">
        <button class="icon-btn view" onclick="viewR({{ $item->id }})"><i class="fa-solid fa-eye"></i></button>
        <button class="icon-btn edit" onclick="editR({{ $item->id }})"><i class="fa-solid fa-pen"></i></button>
        <button class="icon-btn delete" onclick="crudDelete('/admin/gallery/images/{{ $item->id }}','{{ addslashes($item->title ?? 'image') }}')"><i class="fa-solid fa-trash"></i></button>
      </div></td>
    </tr>
    @empty<tr><td colspan="5" style="text-align:center;padding:40px;color:var(--text-muted)">No images.</td></tr>@endforelse
  </tbody></table></div>
  <div style="padding:14px 20px;border-top:1px solid var(--border)">{{ $data->links('pagination::bootstrap-4') }}</div>
</div>

<div class="modal-overlay" id="viewModal"><div class="modal">
  <div class="modal-header"><h2><i class="fa-solid fa-image" style="color:var(--primary);margin-right:8px"></i>Image Details</h2><button class="modal-close" onclick="closeModal('viewModal')"><i class="fa-solid fa-xmark"></i></button></div>
  <div class="modal-body" id="viewModalBody"></div><div class="modal-footer" id="viewModalFooter"><button class="btn btn-outline" onclick="closeModal('viewModal')">Close</button></div>
</div></div>

<div class="modal-overlay" id="editModal"><div class="modal" style="width:440px">
  <div class="modal-header"><h2><i class="fa-solid fa-pen" style="color:var(--warning);margin-right:8px"></i>Edit Image</h2><button class="modal-close" onclick="closeModal('editModal')"><i class="fa-solid fa-xmark"></i></button></div>
  <div class="modal-body"><input type="hidden" id="eId"/>
    <div class="detail-grid" style="gap:14px">
      <div class="detail-item" style="grid-column:1/-1"><label>Title</label><input type="text" class="form-input" id="eTitle"/></div>
      <div class="detail-item"><label>Album *</label><select class="form-input" id="eAlbum">@foreach($albums as $al)<option value="{{ $al->id }}">{{ $al->title }}</option>@endforeach</select></div>
      <div class="detail-item"><label>Status</label><select class="form-input" id="eStatus"><option value="Active">Active</option><option value="Inactive">Inactive</option></select></div>
    </div><div id="editModalError" class="form-error" style="display:none"></div>
  </div>
  <div class="modal-footer"><button class="btn btn-outline" onclick="closeModal('editModal')">Cancel</button><button class="btn btn-primary" onclick="submitEdit()"><i class="fa-solid fa-floppy-disk"></i> Save</button></div>
</div></div>

<div class="modal-overlay" id="addModal"><div class="modal">
  <div class="modal-header"><h2><i class="fa-solid fa-upload" style="color:var(--primary);margin-right:8px"></i>Upload Image</h2><button class="modal-close" onclick="closeModal('addModal')"><i class="fa-solid fa-xmark"></i></button></div>
  <div class="modal-body">
    <form id="addForm" enctype="multipart/form-data">
      <div class="detail-grid" style="gap:14px">
        <div class="detail-item" style="grid-column:1/-1"><label>Title</label><input type="text" class="form-input" name="title" id="aTitle" placeholder="Optional"/></div>
        <div class="detail-item"><label>Album *</label><select class="form-input" name="album_id">@foreach($albums as $al)<option value="{{ $al->id }}">{{ $al->title }}</option>@endforeach</select></div>
        <div class="detail-item"><label>Status</label><select class="form-input" name="status"><option value="Active">Active</option><option value="Inactive">Inactive</option></select></div>
        <div class="detail-item" style="grid-column:1/-1"><label>Image File *</label><input type="file" class="form-input" name="image" accept="image/*"/></div>
      </div>
      <div id="addError" class="form-error" style="display:none"></div>
    </form>
  </div>
  <div class="modal-footer"><button class="btn btn-outline" onclick="closeModal('addModal')">Cancel</button><button class="btn btn-primary" onclick="submitAdd()"><i class="fa-solid fa-upload"></i> Upload</button></div>
</div></div>
@endsection
@section('script')
@include('partials.crud-script')
<script>
function post(url,fd,errId,cb){fetch(url,{method:'POST',body:fd,headers:{'X-CSRF-TOKEN':_CSRF,'X-Requested-With':'XMLHttpRequest','Accept':'application/json'}}).then(r=>r.json()).then(res=>{if(res.success){showToast(res.message);cb();}else{const e=document.getElementById(errId);if(e){e.textContent=res.message;e.style.display='block';}else showToast(res.message,'error');}}).catch(()=>showToast('Network error','error'));}
function viewR(id){crudView(`/admin/gallery/images/${id}`,d=>`<div class="detail-grid">${d.file_path?`<div class="detail-item" style="grid-column:1/-1"><label>Preview</label><img src="/storage/${d.file_path}" style="width:100%;max-height:300px;object-fit:contain;border-radius:8px"/></div>`:''}${detailRow('Title',d.title)}${detailRow('Album',d.album_id)}${detailRow('Status',d.status)}</div>`);}
function editR(id){crudEdit(`/admin/gallery/images/${id}`,d=>{document.getElementById('eId').value=d.id;document.getElementById('eTitle').value=d.title||'';document.getElementById('eAlbum').value=d.album_id;document.getElementById('eStatus').value=d.status||'Active';});}
function submitEdit(){const id=document.getElementById('eId').value;const fd=new FormData();fd.append('_method','PUT');fd.append('title',document.getElementById('eTitle').value);fd.append('album_id',document.getElementById('eAlbum').value);fd.append('status',document.getElementById('eStatus').value);post(`/admin/gallery/images/${id}`,fd,'editModalError',()=>{closeModal('editModal');_reload();});}
function submitAdd(){const form=document.getElementById('addForm');const fd=new FormData(form);post('/admin/gallery/images/store',fd,'addError',()=>{closeModal('addModal');_reload();});}
</script>
@endsection
