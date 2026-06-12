@extends('layouts.backend')
@section('title', 'Enquiries')

@section('content')

<div class="page-header">
  <div>
    <h1><i class="fa-solid fa-messages" style="color:var(--primary);margin-right:8px"></i>Enquiries</h1>
    <p>Manage and respond to incoming enquiries from users and the public.</p>
  </div>
  <div class="header-actions">
    <button class="btn btn-outline"><i class="fa-solid fa-download"></i> Export</button>
  </div>
</div>

<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Total Enquiries</div><div class="stat-value" style="margin-top:8px">{{ $data->total() }}</div></div>
      <div class="stat-icon" style="background:var(--primary-soft);color:var(--primary)"><i class="fa-solid fa-question-circle"></i></div>
    </div>
    <div class="stat-footer"><span class="stat-footer-label">All received</span></div>
  </div>
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Open</div><div class="stat-value" style="margin-top:8px;color:var(--warning)">{{ $data->where('status','Open')->count() }}</div></div>
      <div class="stat-icon" style="background:var(--warning-soft);color:var(--warning)"><i class="fa-solid fa-envelope-open"></i></div>
    </div>
    <div class="stat-footer"><span class="stat-footer-label">Awaiting response</span></div>
  </div>
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Resolved</div><div class="stat-value" style="margin-top:8px;color:var(--success)">{{ $data->where('status','Resolved')->count() }}</div></div>
      <div class="stat-icon" style="background:var(--success-soft);color:var(--success)"><i class="fa-solid fa-circle-check"></i></div>
    </div>
    <div class="stat-footer"><span class="stat-footer-label">Closed enquiries</span></div>
  </div>
</div>

<div class="filters-bar">
  <div class="search-box">
    <i class="fa-solid fa-magnifying-glass"></i>
    <input type="text" placeholder="Search by sender, subject, ID…" id="searchInput" oninput="clientFilter()"/>
  </div>
  <select class="filter-select" id="statusFilter" onchange="clientFilter()">
    <option value="">All Statuses</option>
    <option value="Open">Open</option>
    <option value="Resolved">Resolved</option>
    <option value="Closed">Closed</option>
  </select>
</div>

<div class="card">
  <div class="card-header">
    <div>
      <div class="card-title">All Enquiries</div>
      <div class="card-subtitle">{{ $data->firstItem() }}–{{ $data->lastItem() }} of {{ $data->total() }} entries</div>
    </div>
  </div>
  <div style="overflow-x:auto">
    <table class="data-table" id="mainTable">
      <thead>
        <tr>
          <th><input type="checkbox" style="cursor:pointer"/></th>
          <th>Enquiry ID</th>
          <th>Sender Name</th>
          <th>Subject</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="tableBody">
        @forelse($data as $item)
        <tr>
          <td><input type="checkbox" style="cursor:pointer"/></td>
          <td style="font-weight:600;color:var(--primary);font-family:monospace">{{ $item->enquiry_id }}</td>
          <td>
            <div style="display:flex;align-items:center;gap:8px">
              <div style="width:30px;height:30px;border-radius:50%;background:var(--primary);display:flex;align-items:center;justify-content:center;color:#fff;font-size:11px;font-weight:700;flex-shrink:0">
                {{ strtoupper(substr($item->sender_name, 0, 2)) }}
              </div>
              <div class="user-name">{{ $item->sender_name }}</div>
            </div>
          </td>
          <td style="color:var(--text-secondary)">{{ $item->subject }}</td>
          <td>
            @php
              $cls = 'tag-approved';
              if($item->status == 'Open') $cls = 'tag-pending';
              if($item->status == 'Closed') $cls = 'tag-rejected';
            @endphp
            <span class="tag {{ $cls }}">{{ $item->status }}</span>
          </td>
          <td>
            <div class="action-group">
              <button class="icon-btn view" title="View / Reply"><i class="fa-solid fa-reply"></i></button>
              <button class="icon-btn edit" title="Mark Resolved"><i class="fa-solid fa-circle-check"></i></button>
              <button class="icon-btn delete" title="Delete"><i class="fa-solid fa-trash"></i></button>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="6" style="text-align:center;padding:40px;color:var(--text-muted)"><i class="fa-solid fa-inbox" style="font-size:24px;display:block;margin-bottom:8px"></i>No enquiries found.</td></tr>
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
