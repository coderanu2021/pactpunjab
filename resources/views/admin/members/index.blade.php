@extends('layouts.backend')
@section('title', 'Members')

@section('content')

<div class="page-header">
  <div>
    <h1><i class="fa-solid fa-users" style="color:var(--primary);margin-right:8px"></i>Members</h1>
    <p>Manage all registered members of PACT Punjab.</p>
  </div>
  <div class="header-actions">
    <button class="btn btn-primary" onclick="openModal('addModal')"><i class="fa-solid fa-plus"></i> Add Member</button>
  </div>
</div>

<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-top"><div><div class="stat-label">Total Members</div><div class="stat-value" style="margin-top:8px">{{ $data->total() }}</div></div>
      <div class="stat-icon" style="background:var(--primary-soft);color:var(--primary)"><i class="fa-solid fa-users"></i></div></div>
    <div class="stat-footer"><span class="stat-footer-label">All categories</span></div>
  </div>
  <div class="stat-card">
    <div class="stat-top"><div><div class="stat-label">Active</div><div class="stat-value" style="margin-top:8px;color:var(--success)">{{ $data->where('status','Active')->count() }}</div></div>
      <div class="stat-icon" style="background:var(--success-soft);color:var(--success)"><i class="fa-solid fa-circle-check"></i></div></div>
    <div class="stat-footer"><span class="stat-footer-label">Active members</span></div>
  </div>
</div>

<form method="GET" class="filters-bar">
  <div class="search-box">
    <i class="fa-solid fa-magnifying-glass"></i>
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, ID, firm…" oninput="this.form.submit()"/>
  </div>
  <select name="status" class="filter-select" onchange="this.form.submit()">
    <option value="">All Statuses</option>
    <option value="Active" {{ request('status')=='Active'?'selected':'' }}>Active</option>
    <option value="Inactive" {{ request('status')=='Inactive'?'selected':'' }}>Inactive</option>
    <option value="Pending" {{ request('status')=='Pending'?'selected':'' }}>Pending</option>
  </select>
</form>

<div class="card">
  <div class="card-header">
    <div class="card-title">All Members</div>
    <div class="card-subtitle">{{ $data->firstItem()??0 }}–{{ $data->lastItem()??0 }} of {{ $data->total() }}</div>
  </div>
  <div style="overflow-x:auto">
    <table class="data-table">
      <thead><tr>
        <th>Member ID</th><th>Name / Firm</th><th>Category</th><th>Status</th><th>Actions</th>
      </tr></thead>
      <tbody>
        @forelse($data as $item)
        <tr>
          <td style="font-weight:600;color:var(--primary);font-family:monospace">{{ $item->member_id }}</td>
          <td>
            <div class="user-name">{{ $item->name }}</div>
            <div class="user-email">{{ $item->firm_company }}</div>
          </td>
          <td><span class="tag tag-info">{{ $item->category->name ?? 'N/A' }}</span></td>
          <td>
            @php $cls=$item->status=='Active'?'tag-approved':($item->status=='Pending'?'tag-pending':'tag-rejected'); @endphp
            <span class="tag {{ $cls }}">{{ $item->status }}</span>
          </td>
          <td>
            <div class="action-group">
              <button class="icon-btn view" title="View" onclick="viewMember({{ $item->id }})"><i class="fa-solid fa-eye"></i></button>
              <button class="icon-btn edit" title="Edit" onclick="editMember({{ $item->id }})"><i class="fa-solid fa-pen"></i></button>
              <button class="icon-btn delete" title="Delete" onclick="deleteMember({{ $item->id }},'{{ addslashes($item->name) }}')"><i class="fa-solid fa-trash"></i></button>
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

{{-- View Modal --}}
<div class="modal-overlay" id="viewModal">
  <div class="modal">
    <div class="modal-header"><h2><i class="fa-solid fa-user" style="color:var(--primary);margin-right:8px"></i>Member Details</h2>
      <button class="modal-close" onclick="closeModal('viewModal')"><i class="fa-solid fa-xmark"></i></button></div>
    <div class="modal-body" id="viewContent"></div>
    <div class="modal-footer"><button class="btn btn-outline" onclick="closeModal('viewModal')">Close</button></div>
  </div>
</div>

{{-- Add Modal --}}
<div class="modal-overlay" id="addModal">
  <div class="modal">
    <div class="modal-header"><h2><i class="fa-solid fa-plus" style="color:var(--primary);margin-right:8px"></i>Add Member</h2>
      <button class="modal-close" onclick="closeModal('addModal')"><i class="fa-solid fa-xmark"></i></button></div>
    <div class="modal-body">
      <div class="detail-grid" style="gap:14px" id="addFields">
        <div class="detail-item"><label>Member ID *</label><input type="text" class="form-input" id="a_member_id" placeholder="MEM-0001"/></div>
        <div class="detail-item"><label>Full Name *</label><input type="text" class="form-input" id="a_name"/></div>
        <div class="detail-item"><label>Firm / Company</label><input type="text" class="form-input" id="a_firm_company"/></div>
        <div class="detail-item"><label>Category *</label>
          <select class="form-input" id="a_category_id">
            @foreach($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="detail-item"><label>Status</label>
          <select class="form-input" id="a_status">
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
            <option value="Pending">Pending</option>
          </select>
        </div>
      </div>
      <div id="addError" class="form-error" style="display:none;margin-top:12px"></div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-outline" onclick="closeModal('addModal')">Cancel</button>
      <button class="btn btn-primary" onclick="submitAdd()"><i class="fa-solid fa-save"></i> Save Member</button>
    </div>
  </div>
</div>

{{-- Edit Modal --}}
<div class="modal-overlay" id="editModal">
  <div class="modal">
    <div class="modal-header"><h2><i class="fa-solid fa-pen" style="color:var(--warning);margin-right:8px"></i>Edit Member</h2>
      <button class="modal-close" onclick="closeModal('editModal')"><i class="fa-solid fa-xmark"></i></button></div>
    <div class="modal-body">
      <input type="hidden" id="e_id"/>
      <div class="detail-grid" style="gap:14px">
        <div class="detail-item"><label>Member ID *</label><input type="text" class="form-input" id="e_member_id"/></div>
        <div class="detail-item"><label>Full Name *</label><input type="text" class="form-input" id="e_name"/></div>
        <div class="detail-item"><label>Firm / Company</label><input type="text" class="form-input" id="e_firm_company"/></div>
        <div class="detail-item"><label>Category *</label>
          <select class="form-input" id="e_category_id">
            @foreach($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="detail-item"><label>Status</label>
          <select class="form-input" id="e_status">
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
            <option value="Pending">Pending</option>
          </select>
        </div>
      </div>
      <div id="editError" class="form-error" style="display:none;margin-top:12px"></div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-outline" onclick="closeModal('editModal')">Cancel</button>
      <button class="btn btn-primary" onclick="submitEdit()"><i class="fa-solid fa-floppy-disk"></i> Save Changes</button>
    </div>
  </div>
</div>

@endsection

@section('script')
<style>
.toast{position:fixed;bottom:28px;right:28px;z-index:999;padding:13px 20px;border-radius:10px;font-size:13px;font-weight:500;display:flex;align-items:center;gap:10px;box-shadow:0 8px 30px rgba(0,0,0,.18);animation:slideUp .3s;}
.toast.success{background:var(--success);color:#fff;}.toast.error{background:var(--danger);color:#fff;}
.form-error{background:var(--danger-soft);color:var(--danger);border:1px solid #FECACA;border-radius:8px;padding:10px 14px;font-size:13px;}
@keyframes slideUp{from{transform:translateY(20px);opacity:0}to{transform:translateY(0);opacity:1}}
</style>
<script>
const CSRF='{{ csrf_token() }}';
function openModal(id){document.getElementById(id).classList.add('open');}
function closeModal(id){document.getElementById(id).classList.remove('open');}
document.querySelectorAll('.modal-overlay').forEach(m=>m.addEventListener('click',e=>{if(e.target===m)m.classList.remove('open');}));
function showToast(msg,type='success'){document.querySelectorAll('.toast').forEach(t=>t.remove());const t=document.createElement('div');t.className='toast '+type;t.innerHTML=`<i class="fa-solid fa-${type==='success'?'circle-check':'circle-exclamation'}"></i> ${msg}`;document.body.appendChild(t);setTimeout(()=>{t.style.opacity='0';t.style.transition='opacity .4s';setTimeout(()=>t.remove(),400);},3500);}
function reload(){setTimeout(()=>location.reload(),600);}

function viewMember(id){
  openModal('viewModal');
  document.getElementById('viewContent').innerHTML='<div style="text-align:center;padding:30px"><i class="fa-solid fa-spinner fa-spin" style="font-size:22px;color:var(--primary)"></i></div>';
  fetch(`/admin/members/${id}`,{headers:{'X-Requested-With':'XMLHttpRequest'}}).then(r=>r.json()).then(d=>{
    document.getElementById('viewContent').innerHTML=`<div class="detail-grid">
      <div class="detail-item"><label>Member ID</label><p style="font-family:monospace;color:var(--primary)">${d.member_id}</p></div>
      <div class="detail-item"><label>Name</label><p>${d.name}</p></div>
      <div class="detail-item"><label>Firm / Company</label><p>${d.firm_company||'—'}</p></div>
      <div class="detail-item"><label>Category ID</label><p>${d.category_id}</p></div>
      <div class="detail-item"><label>Status</label><p>${d.status}</p></div>
    </div>`;
  });
}

function editMember(id){
  fetch(`/admin/members/${id}`,{headers:{'X-Requested-With':'XMLHttpRequest'}}).then(r=>r.json()).then(d=>{
    document.getElementById('e_id').value=d.id;
    document.getElementById('e_member_id').value=d.member_id;
    document.getElementById('e_name').value=d.name;
    document.getElementById('e_firm_company').value=d.firm_company||'';
    document.getElementById('e_category_id').value=d.category_id;
    document.getElementById('e_status').value=d.status;
    document.getElementById('editError').style.display='none';
    openModal('editModal');
  });
}

function submitAdd(){
  const data=new FormData();
  data.append('member_id',document.getElementById('a_member_id').value);
  data.append('name',document.getElementById('a_name').value);
  data.append('firm_company',document.getElementById('a_firm_company').value);
  data.append('category_id',document.getElementById('a_category_id').value);
  data.append('status',document.getElementById('a_status').value);
  fetch('/admin/members/store',{method:'POST',body:data,headers:{'X-CSRF-TOKEN':CSRF,'X-Requested-With':'XMLHttpRequest'}})
  .then(r=>r.json()).then(res=>{
    if(res.success){closeModal('addModal');showToast(res.message);reload();}
    else{const e=document.getElementById('addError');e.textContent=res.message;e.style.display='block';}
  });
}

function submitEdit(){
  const id=document.getElementById('e_id').value;
  const data=new FormData();
  data.append('_method','PUT');
  data.append('member_id',document.getElementById('e_member_id').value);
  data.append('name',document.getElementById('e_name').value);
  data.append('firm_company',document.getElementById('e_firm_company').value);
  data.append('category_id',document.getElementById('e_category_id').value);
  data.append('status',document.getElementById('e_status').value);
  fetch(`/admin/members/${id}`,{method:'POST',body:data,headers:{'X-CSRF-TOKEN':CSRF,'X-Requested-With':'XMLHttpRequest'}})
  .then(r=>r.json()).then(res=>{
    if(res.success){closeModal('editModal');showToast(res.message);reload();}
    else{const e=document.getElementById('editError');e.textContent=res.message;e.style.display='block';}
  });
}

function deleteMember(id,name){
  if(!confirm(`Delete member "${name}"? This cannot be undone.`)) return;
  fetch(`/admin/members/${id}`,{method:'DELETE',headers:{'X-CSRF-TOKEN':CSRF,'X-Requested-With':'XMLHttpRequest'}})
  .then(r=>r.json()).then(res=>{
    if(res.success){showToast(res.message);reload();}
    else showToast(res.message,'error');
  });
}
</script>
@endsection
