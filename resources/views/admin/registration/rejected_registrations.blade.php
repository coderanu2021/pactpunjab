@extends('layouts.backend')
@section('title', 'Rejected Registrations')
@section('content')
<div class="page-header">
  <div><h1><i class="fa-solid fa-circle-xmark" style="color:var(--danger);margin-right:8px"></i>Rejected Registrations</h1><p>Registrations that were reviewed and rejected.</p></div>
</div>
<div class="stats-grid">
  <div class="stat-card"><div class="stat-top"><div><div class="stat-label">Total Rejected</div><div class="stat-value" style="margin-top:8px;color:var(--danger)">{{ $data->total() }}</div></div><div class="stat-icon" style="background:var(--danger-soft);color:var(--danger)"><i class="fa-solid fa-circle-xmark"></i></div></div></div>
</div>
<form method="GET" class="filters-bar">
  <div class="search-box"><i class="fa-solid fa-magnifying-glass"></i><input type="text" name="search" value="{{ request('search') }}" placeholder="Search…" oninput="this.form.submit()"/></div>
</form>
<div class="card">
  <div class="card-header"><div class="card-title">Rejected Registrations</div><div class="card-subtitle">{{ $data->total() }} rejected</div></div>
  <div style="overflow-x:auto"><table class="data-table"><thead><tr><th>#</th><th>Firm Name</th><th>Proprietor</th><th>District</th><th>Mobile</th><th>Rejection Reason</th><th>Actions</th></tr></thead>
  <tbody>
    @forelse($data as $item)
    <tr>
      <td style="color:var(--text-muted)">{{ $item->id }}</td>
      <td><div class="user-name">{{ $item->firm_name }}</div><div class="user-email">{{ $item->association }}</div></td>
      <td style="color:var(--text-secondary)">{{ $item->proprietor }}</td>
      <td style="color:var(--text-secondary)">{{ $item->district }}</td>
      <td style="color:var(--text-secondary)">{{ $item->mobile_primary }}</td>
      <td style="color:var(--danger);font-size:12px;max-width:200px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ $item->rejection_reason ?? '—' }}</td>
      <td><div class="action-group">
        <button class="icon-btn view" onclick="viewR({{ $item->id }})"><i class="fa-solid fa-eye"></i></button>
        <button class="icon-btn" title="Reconsider" style="background:var(--warning-soft);color:var(--warning)" onclick="reconsider({{ $item->id }},'{{ addslashes($item->firm_name) }}')"><i class="fa-solid fa-rotate-left"></i></button>
        <button class="icon-btn delete" onclick="crudDelete('/admin/registration/{{ $item->id }}/destroy','{{ addslashes($item->firm_name) }}')"><i class="fa-solid fa-trash"></i></button>
      </div></td>
    </tr>
    @empty<tr><td colspan="7" style="text-align:center;padding:40px;color:var(--text-muted)">No rejected registrations.</td></tr>@endforelse
  </tbody></table></div>
  <div style="padding:14px 20px;border-top:1px solid var(--border)">{{ $data->links('pagination::bootstrap-4') }}</div>
</div>

<div class="modal-overlay" id="viewModal"><div class="modal">
  <div class="modal-header"><h2><i class="fa-solid fa-eye" style="color:var(--primary);margin-right:8px"></i>Registration Details</h2><button class="modal-close" onclick="closeModal('viewModal')"><i class="fa-solid fa-xmark"></i></button></div>
  <div class="modal-body" id="viewModalBody"></div><div class="modal-footer" id="viewModalFooter"><button class="btn btn-outline" onclick="closeModal('viewModal')">Close</button></div>
</div></div>
@endsection
@section('script')
@include('partials.crud-script')
<script>
function viewR(id){crudView(`/admin/registration/${id}/show`,d=>`<div class="detail-grid">${detailRow('Firm',d.firm_name)}${detailRow('Proprietor',d.proprietor)}${detailRow('District',d.district)}${detailRow('Mobile',d.mobile_primary)}${detailRow('Email',d.email)}${detailRow('Address',d.address,true)}${d.rejection_reason?`<div class="detail-item" style="grid-column:1/-1"><label style="color:var(--danger)">Rejection Reason</label><p style="color:var(--danger)">${d.rejection_reason}</p></div>`:''}`);}
function reconsider(id,name){
  if(!confirm(`Re-consider "${name}" application? This will set status back to Pending.`)) return;
  fetch(`/admin/registration/${id}/approve`,{method:'POST',headers:{'X-CSRF-TOKEN':_CSRF,'X-Requested-With':'XMLHttpRequest','Content-Type':'application/json'}}).then(r=>r.json()).then(res=>{if(res.success){showToast('Moved to Pending for re-review.');setTimeout(()=>location.reload(),700);}else showToast(res.message,'error');});
}
</script>
@endsection
