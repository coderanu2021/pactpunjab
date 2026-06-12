@extends('layouts.backend')
@section('title', 'Event Registrations')

@section('content')

<div class="page-header">
  <div>
    <h1><i class="fa-solid fa-clipboard-list" style="color:var(--primary);margin-right:8px"></i>Event Registrations</h1>
    <p>Track attendee registrations and payment status for all events.</p>
  </div>
  <div class="header-actions">
    <button class="btn btn-outline"><i class="fa-solid fa-download"></i> Export</button>
  </div>
</div>

<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Total Registrations</div><div class="stat-value" style="margin-top:8px">{{ $data->total() }}</div></div>
      <div class="stat-icon" style="background:var(--primary-soft);color:var(--primary)"><i class="fa-solid fa-clipboard-list"></i></div>
    </div>
    <div class="stat-footer"><span class="stat-footer-label">All events combined</span></div>
  </div>
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Confirmed</div><div class="stat-value" style="margin-top:8px;color:var(--success)">{{ $data->where('status','Confirmed')->count() }}</div></div>
      <div class="stat-icon" style="background:var(--success-soft);color:var(--success)"><i class="fa-solid fa-circle-check"></i></div>
    </div>
    <div class="stat-footer"><span class="stat-footer-label">Confirmed attendees</span></div>
  </div>
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Pending Payment</div><div class="stat-value" style="margin-top:8px;color:var(--warning)">{{ $data->where('payment_status','Pending')->count() }}</div></div>
      <div class="stat-icon" style="background:var(--warning-soft);color:var(--warning)"><i class="fa-solid fa-clock"></i></div>
    </div>
    <div class="stat-footer"><span class="stat-footer-label">Awaiting payment</span></div>
  </div>
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Cancelled</div><div class="stat-value" style="margin-top:8px;color:var(--danger)">{{ $data->where('status','Cancelled')->count() }}</div></div>
      <div class="stat-icon" style="background:var(--danger-soft);color:var(--danger)"><i class="fa-solid fa-circle-xmark"></i></div>
    </div>
    <div class="stat-footer"><span class="stat-footer-label">Cancelled registrations</span></div>
  </div>
</div>

<div class="filters-bar">
  <div class="search-box">
    <i class="fa-solid fa-magnifying-glass"></i>
    <input type="text" placeholder="Search by name, reg ID…" id="searchInput" oninput="clientFilter()"/>
  </div>
  <select class="filter-select" id="statusFilter" onchange="clientFilter()">
    <option value="">All Statuses</option>
    <option value="Confirmed">Confirmed</option>
    <option value="Pending">Pending</option>
    <option value="Cancelled">Cancelled</option>
  </select>
  <select class="filter-select" id="paymentFilter" onchange="clientFilter()">
    <option value="">All Payments</option>
    <option value="Paid">Paid</option>
    <option value="Pending">Pending</option>
  </select>
</div>

<div class="card">
  <div class="card-header">
    <div>
      <div class="card-title">All Event Registrations</div>
      <div class="card-subtitle">{{ $data->firstItem() }}–{{ $data->lastItem() }} of {{ $data->total() }} entries</div>
    </div>
  </div>
  <div style="overflow-x:auto">
    <table class="data-table" id="mainTable">
      <thead>
        <tr>
          <th><input type="checkbox" style="cursor:pointer"/></th>
          <th>Reg ID</th>
          <th>Attendee Name</th>
          <th>Event ID</th>
          <th>Payment</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="tableBody">
        @forelse($data as $item)
        <tr>
          <td><input type="checkbox" style="cursor:pointer"/></td>
          <td style="font-weight:600;color:var(--primary);font-family:monospace">{{ $item->reg_id }}</td>
          <td><div class="user-name">{{ $item->attendee_name }}</div></td>
          <td style="color:var(--text-secondary);font-family:monospace">{{ $item->event_id }}</td>
          <td>
            @php $pcls = $item->payment_status == 'Paid' ? 'tag-approved' : 'tag-pending'; @endphp
            <span class="tag {{ $pcls }}">{{ $item->payment_status }}</span>
          </td>
          <td>
            @php
              $cls = 'tag-approved';
              if($item->status == 'Pending') $cls = 'tag-pending';
              if($item->status == 'Cancelled') $cls = 'tag-rejected';
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
        <tr><td colspan="7" style="text-align:center;padding:40px;color:var(--text-muted)"><i class="fa-solid fa-inbox" style="font-size:24px;display:block;margin-bottom:8px"></i>No registrations found.</td></tr>
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
  const py = document.getElementById('paymentFilter').value.toLowerCase();
  document.querySelectorAll('#tableBody tr').forEach(row => {
    const text = row.innerText.toLowerCase();
    row.style.display = (!q || text.includes(q)) && (!st || text.includes(st)) && (!py || text.includes(py)) ? '' : 'none';
  });
}
</script>
@endsection
