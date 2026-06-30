@extends('layouts.backend')
@section('title', 'FAQs — CMS')

@section('content')
<div class="page-header">
  <div>
    <h1><i class="fa-solid fa-circle-question" style="color:var(--primary);margin-right:8px"></i>Frequently Asked Questions</h1>
    <p>Manage the FAQs displayed on various pages like Grievance Cell, GST Helpdesk, etc.</p>
  </div>
  <div class="header-actions">
    <button class="btn btn-primary" onclick="openModal('addModal')"><i class="fa-solid fa-plus"></i> Add FAQ</button>
  </div>
</div>

<form method="GET" class="filters-bar">
  <div class="search-box">
    <i class="fa-solid fa-magnifying-glass"></i>
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search questions…" oninput="this.form.submit()"/>
  </div>
</form>

<div class="card">
  <div class="card-header">
    <div class="card-title">All FAQs</div>
    <div class="card-subtitle">{{ $data->firstItem()??0 }}–{{ $data->lastItem()??0 }} of {{ $data->total() }}</div>
  </div>
  <div style="overflow-x:auto">
    <table class="data-table">
      <thead>
        <tr>
          <th>Question</th>
          <th>Category</th>
          <th>Sort Order</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($data as $item)
        <tr>
          <td><div class="user-name">{{ $item->question }}</div></td>
          <td style="color:var(--text-secondary)">{{ $item->category ?? 'General' }}</td>
          <td style="color:var(--text-secondary)">{{ $item->sort_order }}</td>
          <td>
            <div class="action-group">
              <button class="icon-btn edit" title="Edit" onclick="editFaq({{ $item->id }})"><i class="fa-solid fa-pen"></i></button>
              <button class="icon-btn delete" title="Delete" onclick="crudDelete('/admin/cms/faqs/{{ $item->id }}','{{ addslashes($item->question) }}')"><i class="fa-solid fa-trash"></i></button>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="4" style="text-align:center;padding:40px;color:var(--text-muted)">No FAQs found.</td></tr>
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
      <h2><i class="fa-solid fa-pen" style="color:var(--warning);margin-right:8px"></i>Edit FAQ</h2>
      <button class="modal-close" onclick="closeModal('editModal')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body">
      <input type="hidden" id="eId"/>
      <div class="detail-grid" style="gap:14px">
        <div class="detail-item" style="grid-column:1/-1"><label>Question *</label><input type="text" class="form-input" id="eQuestion"/></div>
        <div class="detail-item"><label>Category</label><input type="text" class="form-input" id="eCategory" placeholder="e.g. GST, General"/></div>
        <div class="detail-item"><label>Sort Order</label><input type="number" class="form-input" id="eSortOrder" value="0"/></div>
        <div class="detail-item" style="grid-column:1/-1"><label>Answer *</label><textarea class="form-input" id="eAnswer" rows="4"></textarea></div>
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
      <h2><i class="fa-solid fa-plus" style="color:var(--primary);margin-right:8px"></i>Add FAQ</h2>
      <button class="modal-close" onclick="closeModal('addModal')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body">
      <div class="detail-grid" style="gap:14px">
        <div class="detail-item" style="grid-column:1/-1"><label>Question *</label><input type="text" class="form-input" id="aQuestion"/></div>
        <div class="detail-item"><label>Category</label><input type="text" class="form-input" id="aCategory" placeholder="e.g. GST, General"/></div>
        <div class="detail-item"><label>Sort Order</label><input type="number" class="form-input" id="aSortOrder" value="0"/></div>
        <div class="detail-item" style="grid-column:1/-1"><label>Answer *</label><textarea class="form-input" id="aAnswer" rows="4"></textarea></div>
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
function editFaq(id){
  crudEdit(`/admin/cms/faqs/${id}`, d=>{
    document.getElementById('eId').value = d.id;
    document.getElementById('eQuestion').value = d.question;
    document.getElementById('eCategory').value = d.category || '';
    document.getElementById('eAnswer').value = d.answer;
    document.getElementById('eSortOrder').value = d.sort_order;
    openModal('editModal');
  });
}
function submitEdit(){
  const id=document.getElementById('eId').value;
  const fd=new FormData();
  fd.append('_method','PUT');
  fd.append('question',document.getElementById('eQuestion').value);
  fd.append('category',document.getElementById('eCategory').value);
  fd.append('answer',document.getElementById('eAnswer').value);
  fd.append('sort_order',document.getElementById('eSortOrder').value);
  crudSave(`/admin/cms/faqs/${id}`,'editModalError',()=>{closeModal('editModal');_reload();},fd);
}
function submitAdd(){
  const fd=new FormData();
  fd.append('question',document.getElementById('aQuestion').value);
  fd.append('category',document.getElementById('aCategory').value);
  fd.append('answer',document.getElementById('aAnswer').value);
  fd.append('sort_order',document.getElementById('aSortOrder').value);
  crudSave('/admin/cms/faqs','addError',()=>{closeModal('addModal');_reload();},fd);
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
