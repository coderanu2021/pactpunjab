@extends('layouts.backend')
@section('title', 'Reports')
@section('content')
<div class="page-header">
  <div><h1><i class="fa-solid fa-file-chart-column" style="color:var(--primary);margin-right:8px"></i>Reports</h1><p>Upload and manage official reports and publications.</p></div>
  <div class="header-actions"><button class="btn btn-primary" onclick="openModal('addModal')"><i class="fa-solid fa-upload"></i> Upload Report</button></div>
</div>
<div class="stats-grid">
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Total</div><div class="stat-value" style="margin-top:8px">{{ $data->total() }}</div></div><div class="stat-icon" style="background:var(--primary-soft);color:var(--primary)"><i class="fa-solid fa-file-lines"></i></div></div></div>
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Published</div><div class="stat-value" style="margin-top:8px;color:var(--success)">{{ $data->where('status','Published')->count() }}</div></div><div class="stat-icon" style="background:var(--success-soft);color:var(--success)"><i class="fa-solid fa-circle-check"></i></div></div></div>
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Draft</div><div class="stat-value" style="margin-top:8px;color:var(--warning)">{{ $data->where('status','Draft')->count() }}</div></div><div class="stat-icon" style="background:var(--warning-soft);color:var(--warning)"><i class="fa-solid fa-file-pen"></i></div></div></div>
</div>
<form method="GET" class="filters-bar">
  <div class="search-box"><i class="fa-solid fa-magnifying-glass"></i><input type="text" name="search" value="{{ request('search') }}" placeholder="Search reports…" oninput="this.form.submit()"/></div>
  <select name="status" class="filter-select" onchange="this.form.submit()"><option value="">All</option><option value="Published" {{ request('status')=='Published'?'selected':'' }}>Published</option><option value="Draft" {{ request('status')=='Draft'?'selected':'' }}>Draft</option></select>
</form>
<div class="card">
  <div class="card-header"><div class="card-title">All Reports</div><div class="card-subtitle">{{ $data->firstItem()??0 }}–{{ $data->lastItem()??0 }} of {{ $data->total() }}</div></div>
  <div style="overflow-x:auto"><table class="data-table"><thead><tr><th>#</th><th>Title</th><th>File</th><th>Status</th><th>Actions</th></tr></thead>
  <tbody>
    @forelse($data as $item)
    <tr>
      <td style="color:var(--text-muted)">{{ $item->id }}</td>
      <td><div style="display:flex;align-items:center;gap:10px"><div style="width:34px;height:34px;border-radius:8px;background:var(--danger-soft);color:var(--danger);display:flex;align-items:center;justify-content:center"><i class="fa-solid fa-file-pdf"></i></div><div class="user-name">{{ $item->title }}</div></div></td>
      <td style="color:var(--text-muted);font-size:12px">{{ $item->file_path ? basename($item->file_path) : '—' }}</td>
      <td>@php $c=$item->status=='Published'?'tag-approved':'tag-pending';@endphp<span class="tag {{ $c }}">{{ $item->status }}</span></td>
      <td><div class="action-group">
        @if($item->file_path)<a href="{{ asset('storage/'.$item->file_path) }}" target="_blank" class="icon-btn view" style="text-decoration:none"><i class="fa-solid fa-download"></i></a>@else<button class="icon-btn view" onclick="viewR({{ $item->id }})"><i class="fa-solid fa-eye"></i></button>@endif
        <button class="icon-btn edit" onclick="editR({{ $item->id }})"><i class="fa-solid fa-pen"></i></button>
        <button class="icon-btn delete" onclick="crudDelete('/admin/documents/reports/{{ $item->id }}','{{ addslashes($item->title) }}')"><i class="fa-solid fa-trash"></i></button>
      </div></td>
    </tr>
    @empty<tr><td colspan="5" style="text-align:center;padding:40px;color:var(--text-muted)">No reports.</td></tr>@endforelse
  </tbody></table></div>
  <div style="padding:14px 20px;border-top:1px solid var(--border)">{{ $data->links('pagination::bootstrap-4') }}</div>
</div>

<div class="modal-overlay" id="editModal"><div class="modal" style="width:440px">
  <div class="modal-header"><h2><i class="fa-solid fa-pen" style="color:var(--warning);margin-right:8px"></i>Edit Report</h2><button class="modal-close" onclick="closeModal('editModal')"><i class="fa-solid fa-xmark"></i></button></div>
  <div class="modal-body"><input type="hidden" id="eId"/>
    <div class="detail-grid" style="gap:14px">
      <div class="detail-item" style="grid-column:1/-1"><label>Title *</label><input type="text" class="form-input" id="eTitle"/></div>
      <div class="detail-item"><label>Status</label><select class="form-input" id="eStatus"><option value="Published">Published</option><option value="Draft">Draft</option></select></div>
    </div><div id="editModalError" class="form-error" style="display:none"></div>
  </div>
  <div class="modal-footer"><button class="btn btn-outline" onclick="closeModal('editModal')">Cancel</button><button class="btn btn-primary" onclick="submitEdit()"><i class="fa-solid fa-floppy-disk"></i> Save</button></div>
</div></div>

<div class="modal-overlay" id="addModal"><div class="modal">
  <div class="modal-header"><h2><i class="fa-solid fa-file-arrow-up" style="color:var(--primary);margin-right:8px"></i>Upload Report</h2><button class="modal-close" onclick="closeModal('addModal')"><i class="fa-solid fa-xmark"></i></button></div>
  <div class="modal-body">
    <form id="addForm" enctype="multipart/form-data">
      <div class="detail-grid" style="gap:14px">
        <div class="detail-item" style="grid-column:1/-1"><label>Report Title *</label><input type="text" class="form-input" name="title" placeholder="Annual Report 2025…"/></div>
        <div class="detail-item"><label>PDF File *</label><input type="file" class="form-input" name="file" accept=".pdf,.doc,.docx"/></div>
        <div class="detail-item"><label>Status</label><select class="form-input" name="status"><option value="Published">Published</option><option value="Draft">Draft</option></select></div>
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
function viewR(id){const el=document.getElementById('viewModalBody'); if(!el){openModal('addModal');return;} /* fallback */}
function editR(id){crudEdit(`/admin/documents/reports/${id}`,d=>{document.getElementById('eId').value=d.id;document.getElementById('eTitle').value=d.title;document.getElementById('eStatus').value=d.status;});}
function submitEdit(){const id=document.getElementById('eId').value;const fd=new FormData();fd.append('title',document.getElementById('eTitle').value);fd.append('status',document.getElementById('eStatus').value);post(`/admin/documents/reports/${id}`,fd,'editModalError',()=>{closeModal('editModal');_reload();});}
function submitAdd(){const form=document.getElementById('addForm');const fd=new FormData(form);post('/admin/documents/reports/store',fd,'addError',()=>{closeModal('addModal');_reload();});}
</script>
@endsection
