@extends('layouts.backend')
@section('title', 'Services — CMS')

@section('content')
<div class="page-header">
  <div>
    <h1><i class="fa-solid fa-cogs" style="color:var(--primary);margin-right:8px"></i>Services & Activities</h1>
    <p>Manage the list of services and activities displayed on the frontend.</p>
  </div>
  <div class="header-actions">
    <button class="btn btn-primary" onclick="openModal('addModal')"><i class="fa-solid fa-plus"></i> Add Service</button>
  </div>
</div>

<form method="GET" class="filters-bar">
  <div class="search-box">
    <i class="fa-solid fa-magnifying-glass"></i>
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title…" oninput="this.form.submit()"/>
  </div>
</form>

<div class="card">
  <div class="card-header">
    <div class="card-title">All Services</div>
    <div class="card-subtitle">{{ $data->firstItem()??0 }}–{{ $data->lastItem()??0 }} of {{ $data->total() }}</div>
  </div>
  <div style="overflow-x:auto">
    <table class="data-table">
      <thead>
        <tr>
          <th>Icon</th>
          <th>Title</th>
          <th>Category</th>
          <th>Sort Order</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($data as $item)
        <tr>
          <td><i class="{{ $item->icon_class ?? 'fa-solid fa-check' }}" style="font-size:20px;color:var(--primary)"></i></td>
          <td><div class="user-name">{{ $item->title }}</div></td>
          <td style="color:var(--text-secondary)">{{ $item->category ?? '—' }}</td>
          <td style="color:var(--text-secondary)">{{ $item->sort_order }}</td>
          <td>
            <div class="action-group">
              <button class="icon-btn edit" title="Edit" onclick="editService({{ $item->id }})"><i class="fa-solid fa-pen"></i></button>
              <button class="icon-btn delete" title="Delete" onclick="crudDelete('/admin/cms/services/{{ $item->id }}','{{ addslashes($item->title) }}')"><i class="fa-solid fa-trash"></i></button>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="5" style="text-align:center;padding:40px;color:var(--text-muted)">No services found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div style="padding:14px 20px;border-top:1px solid var(--border)">{{ $data->links('pagination::bootstrap-4') }}</div>
</div>

{{-- Edit Modal --}}
<div class="modal-overlay" id="editModal">
  <div class="modal">
    <div class="modal-header">
      <h2><i class="fa-solid fa-pen" style="color:var(--warning);margin-right:8px"></i>Edit Service</h2>
      <button class="modal-close" onclick="closeModal('editModal')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body">
      <input type="hidden" id="eId"/>
      <div class="detail-grid" style="gap:14px">
        <div class="detail-item"><label>Title *</label><input type="text" class="form-input" id="eTitle"/></div>
        <div class="detail-item"><label>Category</label><input type="text" class="form-input" id="eCategory" placeholder="e.g. Service, Activity"/></div>
        <div class="detail-item"><label>FontAwesome Icon Class</label><input type="text" class="form-input" id="eIcon" placeholder="e.g. fa-solid fa-star"/></div>
        <div class="detail-item"><label>Sort Order</label><input type="number" class="form-input" id="eSortOrder" value="0"/></div>
        <div class="detail-item" style="grid-column:1/-1"><label>Description</label><textarea class="form-input" id="eDescription" rows="3"></textarea></div>
      </div>
      <div id="editModalError" class="form-error" style="display:none"></div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-outline" onclick="closeModal('editModal')">Cancel</button>
      <button class="btn btn-primary" onclick="submitEdit()"><i class="fa-solid fa-floppy-disk"></i> Save</button>
    </div>
  </div>
</div>

{{-- Add Modal --}}
<div class="modal-overlay" id="addModal">
  <div class="modal">
    <div class="modal-header">
      <h2><i class="fa-solid fa-plus" style="color:var(--primary);margin-right:8px"></i>Add Service</h2>
      <button class="modal-close" onclick="closeModal('addModal')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body">
      <div class="detail-grid" style="gap:14px">
        <div class="detail-item"><label>Title *</label><input type="text" class="form-input" id="aTitle"/></div>
        <div class="detail-item"><label>Category</label><input type="text" class="form-input" id="aCategory" placeholder="e.g. Service, Activity"/></div>
        <div class="detail-item"><label>FontAwesome Icon Class</label><input type="text" class="form-input" id="aIcon" placeholder="e.g. fa-solid fa-star"/></div>
        <div class="detail-item"><label>Sort Order</label><input type="number" class="form-input" id="aSortOrder" value="0"/></div>
        <div class="detail-item" style="grid-column:1/-1"><label>Description</label><textarea class="form-input" id="aDescription" rows="3"></textarea></div>
      </div>
      <div id="addError" class="form-error" style="display:none"></div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-outline" onclick="closeModal('addModal')">Cancel</button>
      <button class="btn btn-primary" onclick="submitAdd()"><i class="fa-solid fa-save"></i> Save</button>
    </div>
  </div>
</div>
@endsection

@section('script')
@include('partials.crud-script')
<script>
function editService(id){
  crudEdit(`/admin/cms/services/${id}`, d=>{
    document.getElementById('eId').value = d.id;
    document.getElementById('eTitle').value = d.title;
    document.getElementById('eCategory').value = d.category || '';
    document.getElementById('eIcon').value = d.icon_class || '';
    document.getElementById('eDescription').value = d.description || '';
    document.getElementById('eSortOrder').value = d.sort_order;
    openModal('editModal');
  });
}
function submitEdit(){
  const id=document.getElementById('eId').value;
  const fd=new FormData();
  fd.append('_method','PUT');
  fd.append('title',document.getElementById('eTitle').value);
  fd.append('category',document.getElementById('eCategory').value);
  fd.append('icon_class',document.getElementById('eIcon').value);
  fd.append('description',document.getElementById('eDescription').value);
  fd.append('sort_order',document.getElementById('eSortOrder').value);
  crudSave(`/admin/cms/services/${id}`,'editModalError',()=>{closeModal('editModal');_reload();},fd);
}
function submitAdd(){
  const fd=new FormData();
  fd.append('title',document.getElementById('aTitle').value);
  fd.append('category',document.getElementById('aCategory').value);
  fd.append('icon_class',document.getElementById('aIcon').value);
  fd.append('description',document.getElementById('aDescription').value);
  fd.append('sort_order',document.getElementById('aSortOrder').value);
  crudSave('/admin/cms/services','addError',()=>{closeModal('addModal');_reload();},fd);
}

function crudSave(url, errorElId, onSuccess, formData){
  fetch(url,{method:'POST',body:formData,headers:{'X-CSRF-TOKEN':_CSRF,'X-Requested-With':'XMLHttpRequest','Accept':'application/json'}})
  .then(r=>r.json()).then(res=>{
    if(res.success){ showToast(res.message||'Saved.'); if(onSuccess) onSuccess(); else _reload(); }
    else{ const e=document.getElementById(errorElId); if(e){e.textContent=res.message||'Error.';e.style.display='block';} else showToast(res.message||'Error.','error'); }
  }).catch(()=>showToast('Network error.','error'));
}
</script>
@endsection
