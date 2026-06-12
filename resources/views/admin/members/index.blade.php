@extends('layouts.backend')
@section('title', 'Members')

@section('content')

<!-- Page Header -->
<div class="page-header">
  <div>
    <h1><i class="fa-solid fa-users" style="color:var(--primary);margin-right:8px"></i>Members</h1>
    <p>View and manage all registered members of the association.</p>
  </div>
  <div class="header-actions">
    <button class="btn btn-outline"><i class="fa-solid fa-download"></i> Export</button>
    <button class="btn btn-primary" onclick="document.getElementById('addModal').classList.add('open')"><i class="fa-solid fa-plus"></i> Add Member</button>
  </div>
</div>

<!-- Stats -->
<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Total Members</div><div class="stat-value" style="margin-top:8px">{{ $data->total() }}</div></div>
      <div class="stat-icon" style="background:var(--primary-soft);color:var(--primary)"><i class="fa-solid fa-users"></i></div>
    </div>
    <div class="stat-footer"><span class="badge-change badge-up"><i class="fa-solid fa-arrow-up"></i>8%</span><span class="stat-footer-label">vs last month</span></div>
  </div>
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Active</div><div class="stat-value" style="margin-top:8px;color:var(--success)">{{ $data->where('status','Active')->count() }}</div></div>
      <div class="stat-icon" style="background:var(--success-soft);color:var(--success)"><i class="fa-solid fa-circle-check"></i></div>
    </div>
    <div class="stat-footer"><span class="stat-footer-label">Currently active members</span></div>
  </div>
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Inactive</div><div class="stat-value" style="margin-top:8px;color:var(--danger)">{{ $data->where('status','Inactive')->count() }}</div></div>
      <div class="stat-icon" style="background:var(--danger-soft);color:var(--danger)"><i class="fa-solid fa-circle-xmark"></i></div>
    </div>
    <div class="stat-footer"><span class="stat-footer-label">Inactive / suspended</span></div>
  </div>
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Pending</div><div class="stat-value" style="margin-top:8px;color:var(--warning)">{{ $data->where('status','Pending')->count() }}</div></div>
      <div class="stat-icon" style="background:var(--warning-soft);color:var(--warning)"><i class="fa-solid fa-clock"></i></div>
    </div>
    <div class="stat-footer"><span class="stat-footer-label">Awaiting approval</span></div>
  </div>
</div>

<!-- Filters -->
<div class="filters-bar">
  <div class="search-box">
    <i class="fa-solid fa-magnifying-glass"></i>
    <input type="text" placeholder="Search by name, ID, firm…" id="searchInput" oninput="clientFilter()"/>
  </div>
  <select class="filter-select" id="statusFilter" onchange="clientFilter()">
    <option value="">All Statuses</option>
    <option value="Active">Active</option>
    <option value="Pending">Pending</option>
    <option value="Inactive">Inactive</option>
  </select>
</div>

<!-- Table Card -->
<div class="card">
  <div class="card-header">
    <div>
      <div class="card-title">All Members</div>
      <div class="card-subtitle">Showing {{ $data->firstItem() }}–{{ $data->lastItem() }} of {{ $data->total() }} entries</div>
    </div>
  </div>
  <div style="overflow-x:auto">
    <table class="data-table" id="mainTable">
      <thead>
        <tr>
          <th><input type="checkbox" style="cursor:pointer"/></th>
          <th>Member ID</th>
          <th>Name / Firm</th>
          <th>Category</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="tableBody">
        @forelse($data as $item)
        <tr>
          <td><input type="checkbox" style="cursor:pointer"/></td>
          <td style="font-weight:600;color:var(--primary);font-family:monospace">{{ $item->member_id }}</td>
          <td>
            <div class="user-name">{{ $item->name }}</div>
            @if($item->firm_company)
            <div class="user-email">{{ $item->firm_company }}</div>
            @endif
          </td>
          <td><span class="tag tag-info">{{ $item->category_id }}</span></td>
          <td>
            @php
              $cls = 'tag-approved';
              if($item->status == 'Pending') $cls = 'tag-pending';
              if($item->status == 'Inactive') $cls = 'tag-rejected';
            @endphp
            <span class="tag {{ $cls }}">{{ $item->status }}</span>
          </td>
          <td>
            <div class="action-group">
              <button class="icon-btn view" title="View"><i class="fa-solid fa-eye"></i></button>
              <button class="icon-btn edit" title="Edit"><i class="fa-solid fa-pen"></i></button>
              <button class="icon-btn delete" title="Delete"><i class="fa-solid fa-trash"></i></button>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="6" style="text-align:center;padding:40px;color:var(--text-muted)"><i class="fa-solid fa-inbox" style="font-size:24px;display:block;margin-bottom:8px"></i>No members found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div style="padding:14px 20px;border-top:1px solid var(--border);background:var(--surface)">
    {{ $data->links('pagination::bootstrap-4') }}
  </div>
</div>

<!-- Add Member Modal -->
<div class="modal-overlay" id="addModal">
  <div class="modal">
    <div class="modal-header">
      <h2><i class="fa-solid fa-user-plus" style="color:var(--primary);margin-right:8px"></i>Add New Member</h2>
      <button class="modal-close" onclick="document.getElementById('addModal').classList.remove('open')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body">
      <form>
        <div class="detail-grid">
          <div class="detail-item"><label>Member ID</label><input type="text" class="form-input" placeholder="MEM-001"/></div>
          <div class="detail-item"><label>Full Name</label><input type="text" class="form-input" placeholder="Full name"/></div>
          <div class="detail-item"><label>Firm / Company</label><input type="text" class="form-input" placeholder="Company name"/></div>
          <div class="detail-item"><label>Category</label>
            <select class="form-input">
              <option>Select category</option>
            </select>
          </div>
          <div class="detail-item"><label>Status</label>
            <select class="form-input">
              <option>Active</option>
              <option>Inactive</option>
              <option>Pending</option>
            </select>
          </div>
        </div>
      </form>
    </div>
    <div class="modal-footer">
      <button class="btn btn-outline" onclick="document.getElementById('addModal').classList.remove('open')">Cancel</button>
      <button class="btn btn-primary"><i class="fa-solid fa-save"></i> Save Member</button>
    </div>
  </div>
</div>

@endsection

@section('script')
<script>
function clientFilter() {
  const q = document.getElementById('searchInput').value.toLowerCase();
  const st = document.getElementById('statusFilter').value.toLowerCase();
  document.querySelectorAll('#tableBody tr').forEach(row => {
    const text = row.innerText.toLowerCase();
    const matchQ = !q || text.includes(q);
    const matchS = !st || text.includes(st);
    row.style.display = (matchQ && matchS) ? '' : 'none';
  });
}
document.querySelectorAll('.modal-overlay').forEach(m => {
  m.addEventListener('click', e => { if(e.target === m) m.classList.remove('open'); });
});
</script>
@endsection
