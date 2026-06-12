@extends('layouts.backend')
@section('title', 'Association Registrations')

@section('content')

<div class="page-header">
  <div>
    <h1><i class="fa-solid fa-building-user" style="color:var(--primary);margin-right:8px"></i>Association Registrations</h1>
    <p>Manage all association / organization certification registrations.</p>
  </div>
  <div class="header-actions">
    <button class="btn btn-outline"><i class="fa-solid fa-download"></i> Export</button>
  </div>
</div>

<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Total</div><div class="stat-value" style="margin-top:8px">{{ $data->total() }}</div></div>
      <div class="stat-icon" style="background:var(--primary-soft);color:var(--primary)"><i class="fa-solid fa-building"></i></div>
    </div>
    <div class="stat-footer"><span class="stat-footer-label">All submissions</span></div>
  </div>
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Pending</div><div class="stat-value" style="margin-top:8px;color:var(--warning)">{{ $data->where('status','Pending')->count() }}</div></div>
      <div class="stat-icon" style="background:var(--warning-soft);color:var(--warning)"><i class="fa-solid fa-clock"></i></div>
    </div>
    <div class="stat-footer"><span class="stat-footer-label">Awaiting review</span></div>
  </div>
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Approved</div><div class="stat-value" style="margin-top:8px;color:var(--success)">{{ $data->where('status','Approved')->count() }}</div></div>
      <div class="stat-icon" style="background:var(--success-soft);color:var(--success)"><i class="fa-solid fa-circle-check"></i></div>
    </div>
    <div class="stat-footer"><span class="stat-footer-label">Approved associations</span></div>
  </div>
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Rejected</div><div class="stat-value" style="margin-top:8px;color:var(--danger)">{{ $data->where('status','Rejected')->count() }}</div></div>
      <div class="stat-icon" style="background:var(--danger-soft);color:var(--danger)"><i class="fa-solid fa-circle-xmark"></i></div>
    </div>
    <div class="stat-footer"><span class="stat-footer-label">Rejected applications</span></div>
  </div>
</div>

<div class="filters-bar">
  <div class="search-box">
    <i class="fa-solid fa-magnifying-glass"></i>
    <input type="text" placeholder="Search by firm, district, proprietor…" id="searchInput" oninput="clientFilter()"/>
  </div>
  <select class="filter-select" id="statusFilter" onchange="clientFilter()">
    <option value="">All Statuses</option>
    <option value="Pending">Pending</option>
    <option value="Approved">Approved</option>
    <option value="Rejected">Rejected</option>
  </select>
</div>

<div class="card">
  <div class="card-header">
    <div>
      <div class="card-title">Association / Organization Registrations</div>
      <div class="card-subtitle">{{ $data->firstItem() }}–{{ $data->lastItem() }} of {{ $data->total() }} entries</div>
    </div>
  </div>
  <div style="overflow-x:auto">
    <table class="data-table" id="mainTable">
      <thead>
        <tr>
          <th><input type="checkbox" style="cursor:pointer"/></th>
          <th>#</th>
          <th>Firm Name</th>
          <th>Proprietor</th>
          <th>District</th>
          <th>Mobile</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="tableBody">
        @forelse($data as $item)
        <tr>
          <td><input type="checkbox" style="cursor:pointer"/></td>
          <td style="color:var(--text-muted)">{{ $item->id }}</td>
          <td>
            <div class="user-name">{{ $item->firm_name }}</div>
            @if($item->association)
            <div class="user-email">{{ $item->association }}</div>
            @endif
          </td>
          <td style="color:var(--text-secondary)">{{ $item->proprietor }}</td>
          <td style="color:var(--text-secondary)">{{ $item->district }}</td>
          <td style="color:var(--text-secondary)">{{ $item->mobile_primary }}</td>
          <td>
            @php
              $cls = 'tag-approved';
              if($item->status == 'Pending') $cls = 'tag-pending';
              if($item->status == 'Rejected') $cls = 'tag-rejected';
            @endphp
            <span class="tag {{ $cls }}">{{ $item->status ?? 'Pending' }}</span>
          </td>
          <td>
            <div class="action-group">
              <button class="icon-btn view" title="View Details"><i class="fa-solid fa-eye"></i></button>
              <button class="icon-btn edit" title="Approve" style="background:var(--success-soft);color:var(--success)"><i class="fa-solid fa-check"></i></button>
              <button class="icon-btn delete" title="Reject"><i class="fa-solid fa-xmark"></i></button>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="8" style="text-align:center;padding:40px;color:var(--text-muted)"><i class="fa-solid fa-building" style="font-size:24px;display:block;margin-bottom:8px"></i>No association registrations found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div style="padding:14px 20px;border-top:1px solid var(--border);background:var(--surface)">
    {{ $data->links('pagination::bootstrap-4') }}
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
    row.style.display = (!q || text.includes(q)) && (!st || text.includes(st)) ? '' : 'none';
  });
}
</script>
@endsection
