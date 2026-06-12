@extends('layouts.backend')
@section('title', 'Personal Certificates')

@section('content')

<div class="page-header">
  <div>
    <h1><i class="fa-solid fa-id-badge" style="color:var(--primary);margin-right:8px"></i>Personal Certificates</h1>
    <p>View and manage certificates issued to individual members.</p>
  </div>
  <div class="header-actions">
    <button class="btn btn-outline"><i class="fa-solid fa-download"></i> Export</button>
    <button class="btn btn-primary" onclick="document.getElementById('addModal').classList.add('open')"><i class="fa-solid fa-plus"></i> Issue Certificate</button>
  </div>
</div>

<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Total Issued</div><div class="stat-value" style="margin-top:8px">{{ $data->total() }}</div></div>
      <div class="stat-icon" style="background:var(--primary-soft);color:var(--primary)"><i class="fa-solid fa-certificate"></i></div>
    </div>
    <div class="stat-footer"><span class="stat-footer-label">All personal certs</span></div>
  </div>
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Valid</div><div class="stat-value" style="margin-top:8px;color:var(--success)">{{ $data->where('status','Active')->count() }}</div></div>
      <div class="stat-icon" style="background:var(--success-soft);color:var(--success)"><i class="fa-solid fa-circle-check"></i></div>
    </div>
    <div class="stat-footer"><span class="stat-footer-label">Currently active</span></div>
  </div>
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Expired</div><div class="stat-value" style="margin-top:8px;color:var(--danger)">{{ $data->where('status','Expired')->count() }}</div></div>
      <div class="stat-icon" style="background:var(--danger-soft);color:var(--danger)"><i class="fa-solid fa-hourglass-end"></i></div>
    </div>
    <div class="stat-footer"><span class="stat-footer-label">Past expiry date</span></div>
  </div>
</div>

<div class="filters-bar">
  <div class="search-box">
    <i class="fa-solid fa-magnifying-glass"></i>
    <input type="text" placeholder="Search by cert ID, issued to…" id="searchInput" oninput="clientFilter()"/>
  </div>
  <select class="filter-select" id="statusFilter" onchange="clientFilter()">
    <option value="">All Statuses</option>
    <option value="Active">Active</option>
    <option value="Expired">Expired</option>
    <option value="Revoked">Revoked</option>
  </select>
</div>

<div class="card">
  <div class="card-header">
    <div>
      <div class="card-title">Personal Certificates</div>
      <div class="card-subtitle">{{ $data->firstItem() }}–{{ $data->lastItem() }} of {{ $data->total() }} entries</div>
    </div>
  </div>
  <div style="overflow-x:auto">
    <table class="data-table" id="mainTable">
      <thead>
        <tr>
          <th><input type="checkbox" style="cursor:pointer"/></th>
          <th>Cert ID</th>
          <th>Issued To</th>
          <th>Issue Date</th>
          <th>Expiry Date</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="tableBody">
        @forelse($data as $item)
        <tr>
          <td><input type="checkbox" style="cursor:pointer"/></td>
          <td style="font-weight:600;color:var(--primary);font-family:monospace">{{ $item->cert_id }}</td>
          <td><div class="user-name">{{ $item->issued_to }}</div></td>
          <td style="color:var(--text-secondary)">{{ $item->issue_date ? \Carbon\Carbon::parse($item->issue_date)->format('d M Y') : '—' }}</td>
          <td style="color:var(--text-secondary)">{{ $item->expiry_date ? \Carbon\Carbon::parse($item->expiry_date)->format('d M Y') : '—' }}</td>
          <td>
            @php
              $cls = 'tag-approved';
              if($item->status == 'Expired') $cls = 'tag-rejected';
              if($item->status == 'Revoked') $cls = 'tag-rejected';
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
        <tr><td colspan="7" style="text-align:center;padding:40px;color:var(--text-muted)"><i class="fa-solid fa-certificate" style="font-size:24px;display:block;margin-bottom:8px"></i>No certificates found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div style="padding:14px 20px;border-top:1px solid var(--border);background:var(--surface)">
    {{ $data->links('pagination::bootstrap-4') }}
  </div>
</div>

<!-- Issue Modal -->
<div class="modal-overlay" id="addModal">
  <div class="modal">
    <div class="modal-header">
      <h2><i class="fa-solid fa-id-badge" style="color:var(--primary);margin-right:8px"></i>Issue Personal Certificate</h2>
      <button class="modal-close" onclick="document.getElementById('addModal').classList.remove('open')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body">
      <form>
        <div class="detail-grid">
          <div class="detail-item"><label>Certificate ID</label><input type="text" class="form-input" placeholder="CERT-001"/></div>
          <div class="detail-item"><label>Issued To</label><input type="text" class="form-input" placeholder="Member name"/></div>
          <div class="detail-item"><label>Issue Date</label><input type="date" class="form-input"/></div>
          <div class="detail-item"><label>Expiry Date</label><input type="date" class="form-input"/></div>
          <div class="detail-item"><label>Status</label>
            <select class="form-input"><option>Active</option><option>Expired</option><option>Revoked</option></select>
          </div>
        </div>
      </form>
    </div>
    <div class="modal-footer">
      <button class="btn btn-outline" onclick="document.getElementById('addModal').classList.remove('open')">Cancel</button>
      <button class="btn btn-primary"><i class="fa-solid fa-certificate"></i> Issue</button>
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
