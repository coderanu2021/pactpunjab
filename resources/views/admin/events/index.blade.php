@extends('layouts.backend')
@section('title', 'Events')

@section('content')

<div class="page-header">
  <div>
    <h1><i class="fa-solid fa-calendar-days" style="color:var(--primary);margin-right:8px"></i>Events</h1>
    <p>Create, manage and track association events and meetings.</p>
  </div>
  <div class="header-actions">
    <button class="btn btn-outline"><i class="fa-solid fa-download"></i> Export</button>
    <button class="btn btn-primary" onclick="document.getElementById('addModal').classList.add('open')"><i class="fa-solid fa-plus"></i> Add Event</button>
  </div>
</div>

<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Total Events</div><div class="stat-value" style="margin-top:8px">{{ $data->total() }}</div></div>
      <div class="stat-icon" style="background:var(--primary-soft);color:var(--primary)"><i class="fa-solid fa-calendar-days"></i></div>
    </div>
    <div class="stat-footer"><span class="stat-footer-label">All time</span></div>
  </div>
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Upcoming</div><div class="stat-value" style="margin-top:8px;color:var(--success)">{{ $data->where('status','Active')->count() }}</div></div>
      <div class="stat-icon" style="background:var(--success-soft);color:var(--success)"><i class="fa-solid fa-calendar-check"></i></div>
    </div>
    <div class="stat-footer"><span class="stat-footer-label">Scheduled events</span></div>
  </div>
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Completed</div><div class="stat-value" style="margin-top:8px;color:var(--primary)">{{ $data->where('status','Completed')->count() }}</div></div>
      <div class="stat-icon" style="background:var(--primary-soft);color:var(--primary)"><i class="fa-solid fa-circle-check"></i></div>
    </div>
    <div class="stat-footer"><span class="stat-footer-label">Past events</span></div>
  </div>
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Cancelled</div><div class="stat-value" style="margin-top:8px;color:var(--danger)">{{ $data->where('status','Cancelled')->count() }}</div></div>
      <div class="stat-icon" style="background:var(--danger-soft);color:var(--danger)"><i class="fa-solid fa-circle-xmark"></i></div>
    </div>
    <div class="stat-footer"><span class="stat-footer-label">Cancelled events</span></div>
  </div>
</div>

<div class="filters-bar">
  <div class="search-box">
    <i class="fa-solid fa-magnifying-glass"></i>
    <input type="text" placeholder="Search by name, ID, location…" id="searchInput" oninput="clientFilter()"/>
  </div>
  <select class="filter-select" id="statusFilter" onchange="clientFilter()">
    <option value="">All Statuses</option>
    <option value="Active">Active</option>
    <option value="Completed">Completed</option>
    <option value="Cancelled">Cancelled</option>
  </select>
</div>

<div class="card">
  <div class="card-header">
    <div>
      <div class="card-title">All Events</div>
      <div class="card-subtitle">{{ $data->firstItem() }}–{{ $data->lastItem() }} of {{ $data->total() }} entries</div>
    </div>
  </div>
  <div style="overflow-x:auto">
    <table class="data-table" id="mainTable">
      <thead>
        <tr>
          <th><input type="checkbox" style="cursor:pointer"/></th>
          <th>Event ID</th>
          <th>Event Name</th>
          <th>Date</th>
          <th>Location</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="tableBody">
        @forelse($data as $item)
        <tr>
          <td><input type="checkbox" style="cursor:pointer"/></td>
          <td style="font-weight:600;color:var(--primary);font-family:monospace">{{ $item->event_id }}</td>
          <td><div class="user-name">{{ $item->name }}</div></td>
          <td style="color:var(--text-secondary)">{{ $item->event_date ? \Carbon\Carbon::parse($item->event_date)->format('d M Y') : '—' }}</td>
          <td style="color:var(--text-secondary)">{{ $item->location ?? '—' }}</td>
          <td>
            @php
              $cls = 'tag-approved';
              if($item->status == 'Cancelled') $cls = 'tag-rejected';
              if($item->status == 'Completed') $cls = 'tag-info';
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
        <tr><td colspan="7" style="text-align:center;padding:40px;color:var(--text-muted)"><i class="fa-solid fa-calendar-xmark" style="font-size:24px;display:block;margin-bottom:8px"></i>No events found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div style="padding:14px 20px;border-top:1px solid var(--border);background:var(--surface)">
    {{ $data->links('pagination::bootstrap-4') }}
  </div>
</div>

<!-- Add Modal -->
<div class="modal-overlay" id="addModal">
  <div class="modal">
    <div class="modal-header">
      <h2><i class="fa-solid fa-calendar-plus" style="color:var(--primary);margin-right:8px"></i>Add New Event</h2>
      <button class="modal-close" onclick="document.getElementById('addModal').classList.remove('open')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body">
      <form>
        <div class="detail-grid">
          <div class="detail-item"><label>Event ID</label><input type="text" class="form-input" placeholder="EVT-001"/></div>
          <div class="detail-item"><label>Event Name</label><input type="text" class="form-input" placeholder="Event title"/></div>
          <div class="detail-item"><label>Date</label><input type="date" class="form-input"/></div>
          <div class="detail-item"><label>Location</label><input type="text" class="form-input" placeholder="City / Venue"/></div>
          <div class="detail-item"><label>Status</label>
            <select class="form-input"><option>Active</option><option>Completed</option><option>Cancelled</option></select>
          </div>
        </div>
      </form>
    </div>
    <div class="modal-footer">
      <button class="btn btn-outline" onclick="document.getElementById('addModal').classList.remove('open')">Cancel</button>
      <button class="btn btn-primary"><i class="fa-solid fa-save"></i> Save Event</button>
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
    row.style.display = (!q || text.includes(q)) && (!st || text.includes(st)) ? '' : 'none';
  });
}
document.querySelectorAll('.modal-overlay').forEach(m => {
  m.addEventListener('click', e => { if(e.target === m) m.classList.remove('open'); });
});
</script>
@endsection
