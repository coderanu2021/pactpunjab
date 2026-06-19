@extends('layouts.backend')
@section('title', 'Member Categories')
@section('content')
<div class="page-header">
  <div><h1><i class="fa-solid fa-tags" style="color:var(--primary);margin-right:8px"></i>Member Categories</h1><p>Manage membership tiers, categories and fees.</p></div>
  <div class="header-actions"><button class="btn btn-primary" onclick="openModal('addModal')"><i class="fa-solid fa-plus"></i> Add Category</button></div>
</div>
<div class="stats-grid">
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Total</div><div class="stat-value" style="margin-top:8px">{{ $data->total() }}</div></div><div class="stat-icon" style="background:var(--primary-soft);color:var(--primary)"><i class="fa-solid fa-layer-group"></i></div></div></div>
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Active</div><div class="stat-value" style="margin-top:8px;color:var(--success)">{{ $data->where('status','Active')->count() }}</div></div><div class="stat-icon" style="background:var(--success-soft);color:var(--success)"><i class="fa-solid fa-circle-check"></i></div></div></div>
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Inactive</div><div class="stat-value" style="margin-top:8px;color:var(--danger)">{{ $data->where('status','Inactive')->count() }}</div></div><div class="stat-icon" style="background:var(--danger-soft);color:var(--danger)"><i class="fa-solid fa-circle-xmark"></i></div></div></div>
</div>
<div class="card">
  <div class="card-header"><div class="card-title">All Member Categories</div><div class="card-subtitle">{{ $data->total() }} total</div></div>
  <div style="overflow-x:auto"><table class="data-table"><thead><tr><th>#</th><th>Category Name</th><th>Annual Fee (₹)</th><th>Status</th><th>Actions</th></tr></thead>
  <tbody>
    @forelse($data as $item)
    <tr>
      <td style="color:var(--text-muted)">{{ $loop->iteration }}</td>
      <td style="font-weight:600">{{ $item->name }} @if($item->is_popular) <span class="tag tag-info" style="font-size:10px;margin-left:6px">Popular</span> @endif</td>
      <td style="font-weight:600;color:var(--primary)">₹ {{ number_format($item->annual_fee,2) }}</td>
      <td>@php $c=$item->status=='Active'?'tag-approved':'tag-rejected';@endphp<span class="tag {{ $c }}">{{ $item->status }}</span></td>
      <td><div class="action-group">
        <button class="icon-btn view" onclick="viewR({{ $item->id }})"><i class="fa-solid fa-eye"></i></button>
        <button class="icon-btn edit" onclick="editR({{ $item->id }})"><i class="fa-solid fa-pen"></i></button>
        <button class="icon-btn delete" onclick="crudDelete('/admin/members/categories/{{ $item->id }}','{{ addslashes($item->name) }}')"><i class="fa-solid fa-trash"></i></button>
      </div></td>
    </tr>
    @empty<tr><td colspan="5" style="text-align:center;padding:40px;color:var(--text-muted)">No categories.</td></tr>@endforelse
  </tbody></table></div>
  <div style="padding:14px 20px;border-top:1px solid var(--border)">{{ $data->links('pagination::bootstrap-4') }}</div>
</div>

<div class="modal-overlay" id="viewModal"><div class="modal" style="width:420px">
  <div class="modal-header"><h2><i class="fa-solid fa-tag" style="color:var(--primary);margin-right:8px"></i>Category Details</h2><button class="modal-close" onclick="closeModal('viewModal')"><i class="fa-solid fa-xmark"></i></button></div>
  <div class="modal-body" id="viewModalBody"></div><div class="modal-footer" id="viewModalFooter"><button class="btn btn-outline" onclick="closeModal('viewModal')">Close</button></div>
</div></div>

<div class="modal-overlay" id="editModal"><div class="modal" style="width:440px">
  <div class="modal-header"><h2><i class="fa-solid fa-pen" style="color:var(--warning);margin-right:8px"></i>Edit Category</h2><button class="modal-close" onclick="closeModal('editModal')"><i class="fa-solid fa-xmark"></i></button></div>
  <div class="modal-body"><input type="hidden" id="eId"/>
    <div class="detail-grid" style="gap:14px">
      <div class="detail-item" style="grid-column:1/-1"><label>Category Name *</label><input type="text" class="form-input" id="eName"/></div>
      <div class="detail-item"><label>Annual Fee (₹) *</label><input type="number" class="form-input" id="eFee" step="0.01"/></div>
      <div class="detail-item"><label>Status</label><select class="form-input" id="eStatus"><option value="Active">Active</option><option value="Inactive">Inactive</option></select></div>
      <div class="detail-item" style="grid-column:1/-1"><label>Description</label><textarea class="form-input" id="eDescription" rows="2"></textarea></div>
      <div class="detail-item" style="grid-column:1/-1"><label>Features (One per line)</label><textarea class="form-input" id="eFeatures" rows="3"></textarea></div>
      <div class="detail-item" style="grid-column:1/-1"><label style="display:flex;align-items:center;gap:8px;cursor:pointer"><input type="checkbox" id="ePopular" value="1"/> Mark as Most Popular Plan</label></div>
    </div><div id="editModalError" class="form-error" style="display:none"></div>
  </div>
  <div class="modal-footer"><button class="btn btn-outline" onclick="closeModal('editModal')">Cancel</button><button class="btn btn-primary" onclick="submitEdit()"><i class="fa-solid fa-floppy-disk"></i> Save</button></div>
</div></div>

<div class="modal-overlay" id="addModal"><div class="modal" style="width:440px">
  <div class="modal-header"><h2><i class="fa-solid fa-tag" style="color:var(--primary);margin-right:8px"></i>Add Category</h2><button class="modal-close" onclick="closeModal('addModal')"><i class="fa-solid fa-xmark"></i></button></div>
  <div class="modal-body">
    <div class="detail-grid" style="gap:14px">
      <div class="detail-item" style="grid-column:1/-1"><label>Category Name *</label><input type="text" class="form-input" id="aName" placeholder="e.g. Life Member"/></div>
      <div class="detail-item"><label>Annual Fee (₹) *</label><input type="number" class="form-input" id="aFee" step="0.01" placeholder="0.00"/></div>
      <div class="detail-item"><label>Status</label><select class="form-input" id="aStatus"><option value="Active">Active</option><option value="Inactive">Inactive</option></select></div>
      <div class="detail-item" style="grid-column:1/-1"><label>Description</label><textarea class="form-input" id="aDescription" rows="2"></textarea></div>
      <div class="detail-item" style="grid-column:1/-1"><label>Features (One per line)</label><textarea class="form-input" id="aFeatures" rows="3"></textarea></div>
      <div class="detail-item" style="grid-column:1/-1"><label style="display:flex;align-items:center;gap:8px;cursor:pointer"><input type="checkbox" id="aPopular" value="1"/> Mark as Most Popular Plan</label></div>
    </div><div id="addError" class="form-error" style="display:none"></div>
  </div>
  <div class="modal-footer"><button class="btn btn-outline" onclick="closeModal('addModal')">Cancel</button><button class="btn btn-primary" onclick="submitAdd()"><i class="fa-solid fa-save"></i> Save</button></div>
</div></div>
@endsection
@section('script')
@include('partials.crud-script')
<script>
function post(url,fd,errId,cb){fetch(url,{method:'POST',body:fd,headers:{'X-CSRF-TOKEN':_CSRF,'X-Requested-With':'XMLHttpRequest','Accept':'application/json'}}).then(r=>r.json()).then(res=>{if(res.success){showToast(res.message);cb();}else{const e=document.getElementById(errId);if(e){e.textContent=res.message;e.style.display='block';}else showToast(res.message,'error');}}).catch(()=>showToast('Network error','error'));}
function viewR(id){crudView(`/admin/members/categories/${id}`,d=>`<div class="detail-grid">${detailRow('Name',d.name,true)}${detailRow('Annual Fee','₹ '+parseFloat(d.annual_fee).toFixed(2))}${detailRow('Status',d.status)}<div class="detail-item" style="grid-column:1/-1"><label>Description</label><div class="val">${d.description||'—'}</div></div><div class="detail-item" style="grid-column:1/-1"><label>Features</label><div class="val">${d.features?d.features.join(', '):'—'}</div></div><div class="detail-item"><label>Popular</label><div class="val">${d.is_popular?'Yes':'No'}</div></div></div>`);}
function editR(id){crudEdit(`/admin/members/categories/${id}`,d=>{document.getElementById('eId').value=d.id;document.getElementById('eName').value=d.name;document.getElementById('eFee').value=d.annual_fee;document.getElementById('eStatus').value=d.status;document.getElementById('eDescription').value=d.description||'';document.getElementById('eFeatures').value=(d.features||[]).join('\n');document.getElementById('ePopular').checked=d.is_popular;});}
function submitEdit(){const id=document.getElementById('eId').value;const fd=new FormData();fd.append('_method','PUT');fd.append('name',document.getElementById('eName').value);fd.append('annual_fee',document.getElementById('eFee').value);fd.append('status',document.getElementById('eStatus').value);fd.append('description',document.getElementById('eDescription').value);fd.append('features',document.getElementById('eFeatures').value);if(document.getElementById('ePopular').checked)fd.append('is_popular','1');post(`/admin/members/categories/${id}`,fd,'editModalError',()=>{closeModal('editModal');_reload();});}
function submitAdd(){const fd=new FormData();fd.append('name',document.getElementById('aName').value);fd.append('annual_fee',document.getElementById('aFee').value);fd.append('status',document.getElementById('aStatus').value);fd.append('description',document.getElementById('aDescription').value);fd.append('features',document.getElementById('aFeatures').value);if(document.getElementById('aPopular').checked)fd.append('is_popular','1');post('/admin/members/categories/store',fd,'addError',()=>{closeModal('addModal');_reload();});}
</script>
@endsection
