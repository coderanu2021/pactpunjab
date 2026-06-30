@extends('layouts.backend')
@section('title', 'Committee Members — CMS')

@section('content')
<div class="page-header">
  <div>
    <h1><i class="fa-solid fa-users" style="color:var(--primary);margin-right:8px"></i>Committee Members</h1>
    <p>Manage office bearers, executive members, and other board members shown on the frontend.</p>
  </div>
  <div class="header-actions">
    <button class="btn btn-primary" onclick="openModal('addModal')"><i class="fa-solid fa-plus"></i> Add Member</button>
  </div>
</div>

<form method="GET" class="filters-bar">
  <div class="search-box">
    <i class="fa-solid fa-magnifying-glass"></i>
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or designation…" oninput="this.form.submit()"/>
  </div>
</form>

<div class="card">
  <div class="card-header">
    <div class="card-title">All Members</div>
    <div class="card-subtitle">{{ $data->firstItem()??0 }}–{{ $data->lastItem()??0 }} of {{ $data->total() }}</div>
  </div>
  <div style="overflow-x:auto">
    <table class="data-table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Designation</th>
          <th>Type</th>
          <th>Sort Order</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($data as $item)
        <tr>
          <td><div class="user-name">{{ $item->name }}</div></td>
          <td style="color:var(--text-secondary)">{{ $item->designation ?? '—' }}</td>
          <td>
            <span class="tag tag-info">{{ $item->type }}</span>
          </td>
          <td style="color:var(--text-secondary)">{{ $item->sort_order }}</td>
          <td>
            <div class="action-group">
              <button class="icon-btn edit" title="Edit" onclick="editMember({{ $item->id }})"><i class="fa-solid fa-pen"></i></button>
              <button class="icon-btn delete" title="Delete" onclick="crudDelete('/admin/cms/committee/{{ $item->id }}','{{ addslashes($item->name) }}')"><i class="fa-solid fa-trash"></i></button>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="5" style="text-align:center;padding:40px;color:var(--text-muted)">No members found.</td></tr>
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
      <h2><i class="fa-solid fa-pen" style="color:var(--warning);margin-right:8px"></i>Edit Member</h2>
      <button class="modal-close" onclick="closeModal('editModal')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body">
      <input type="hidden" id="eId"/>
      <div class="detail-grid" style="gap:14px">
        <div class="detail-item"><label>Name *</label><input type="text" class="form-input" id="eName"/></div>
        <div class="detail-item"><label>Designation</label><input type="text" class="form-input" id="eDesignation" placeholder="e.g. President, Member"/></div>
        <div class="detail-item">
          <label>Type *</label>
          <select class="form-input" id="eType">
            <option value="Office Bearer">Office Bearer</option>
            <option value="Executive Committee">Executive Committee</option>
            <option value="Advisory Board">Advisory Board</option>
            <option value="Sub Committee">Sub Committee</option>
            <option value="Special Invitee">Special Invitee</option>
          </select>
        </div>
        <div class="detail-item"><label>Sort Order</label><input type="number" class="form-input" id="eSortOrder" value="0"/></div>
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
      <h2><i class="fa-solid fa-plus" style="color:var(--primary);margin-right:8px"></i>Add Member</h2>
      <button class="modal-close" onclick="closeModal('addModal')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body">
      <div class="detail-grid" style="gap:14px">
        <div class="detail-item"><label>Name *</label><input type="text" class="form-input" id="aName"/></div>
        <div class="detail-item"><label>Designation</label><input type="text" class="form-input" id="aDesignation" placeholder="e.g. President, Member"/></div>
        <div class="detail-item">
          <label>Type *</label>
          <select class="form-input" id="aType">
            <option value="Office Bearer">Office Bearer</option>
            <option value="Executive Committee">Executive Committee</option>
            <option value="Advisory Board">Advisory Board</option>
            <option value="Sub Committee">Sub Committee</option>
            <option value="Special Invitee">Special Invitee</option>
          </select>
        </div>
        <div class="detail-item"><label>Sort Order</label><input type="number" class="form-input" id="aSortOrder" value="0"/></div>
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
function editMember(id){
  crudEdit(`/admin/cms/committee/${id}`, d=>{
    document.getElementById('eId').value = d.id;
    document.getElementById('eName').value = d.name;
    document.getElementById('eDesignation').value = d.designation || '';
    document.getElementById('eType').value = d.type;
    document.getElementById('eSortOrder').value = d.sort_order;
    openModal('editModal');
  });
}
function submitEdit(){
  const id=document.getElementById('eId').value;
  const fd=new FormData();
  fd.append('_method','PUT');
  fd.append('name',document.getElementById('eName').value);
  fd.append('designation',document.getElementById('eDesignation').value);
  fd.append('type',document.getElementById('eType').value);
  fd.append('sort_order',document.getElementById('eSortOrder').value);
  crudSave(`/admin/cms/committee/${id}`,'editModalError',()=>{closeModal('editModal');_reload();},fd);
}
function submitAdd(){
  const fd=new FormData();
  fd.append('name',document.getElementById('aName').value);
  fd.append('designation',document.getElementById('aDesignation').value);
  fd.append('type',document.getElementById('aType').value);
  fd.append('sort_order',document.getElementById('aSortOrder').value);
  crudSave('/admin/cms/committee','addError',()=>{closeModal('addModal');_reload();},fd);
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
