@extends('layouts.backend')
@section('title', 'Rejected Registrations')

@section('content')

<div class="page-header">
  <div>
    <h1><i class="fa-solid fa-circle-xmark" style="color:var(--danger);margin-right:8px"></i>Rejected Registrations</h1>
    <p>Registrations that were reviewed and rejected.</p>
  </div>
  <div class="header-actions">
    <button class="btn btn-outline"><i class="fa-solid fa-download"></i> Export</button>
  </div>
</div>

<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Total Rejected</div><div class="stat-value" style="margin-top:8px;color:var(--danger)">{{ $data->total() }}</div></div>
      <div class="stat-icon" style="background:var(--danger-soft);color:var(--danger)"><i class="fa-solid fa-circle-xmark"></i></div>
    </div>
    <div class="stat-footer"><span class="stat-footer-label">Rejected applications</span></div>
  </div>
</div>

<div class="filters-bar">
  <div class="search-box">
    <i class="fa-solid fa-magnifying-glass"></i>
    <input type="text" placeholder="Search rejected applications…" id="searchInput" oninput="clientFilter()"/>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <div>
      <div class="card-title">Rejected Registrations</div>
      <div class="card-subtitle">{{ $data->total() }} rejected applications</div>
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
          <th>Email</th>
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
          <td style="color:var(--text-secondary)">{{ $item->email }}</td>
          <td><span class="tag tag-rejected">Rejected</span></td>
          <td>
            <div class="action-group">
              <button class="icon-btn view" title="View Reason"><i class="fa-solid fa-eye"></i></button>
              <button class="icon-btn edit" title="Reconsider" style="background:var(--warning-soft);color:var(--warning)"><i class="fa-solid fa-rotate-left"></i></button>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="9" style="text-align:center;padding:40px;color:var(--text-muted)"><i class="fa-solid fa-inbox" style="font-size:24px;display:block;margin-bottom:8px"></i>No rejected registrations found.</td></tr>
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
  document.querySelectorAll('#tableBody tr').forEach(row => {
    row.style.display = (!q || row.innerText.toLowerCase().includes(q)) ? '' : 'none';
  });
}
</script>
@endsection
