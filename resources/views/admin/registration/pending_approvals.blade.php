@extends('layouts.backend')
@section('title', 'Pending Approvals')

@section('content')

<div class="page-header">
  <div>
    <h1><i class="fa-solid fa-hourglass-half" style="color:var(--warning);margin-right:8px"></i>Pending Approvals</h1>
    <p>Registrations awaiting review and approval decision.</p>
  </div>
  <div class="header-actions">
    <button class="btn btn-outline"><i class="fa-solid fa-download"></i> Export</button>
  </div>
</div>

<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Pending Reviews</div><div class="stat-value" style="margin-top:8px;color:var(--warning)">{{ $data->total() }}</div></div>
      <div class="stat-icon" style="background:var(--warning-soft);color:var(--warning)"><i class="fa-solid fa-hourglass-half"></i></div>
    </div>
    <div class="stat-footer"><span class="stat-footer-label">Require your action</span></div>
  </div>
</div>

<div class="filters-bar">
  <div class="search-box">
    <i class="fa-solid fa-magnifying-glass"></i>
    <input type="text" placeholder="Search pending applications…" id="searchInput" oninput="clientFilter()"/>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <div>
      <div class="card-title">Pending Registrations</div>
      <div class="card-subtitle">{{ $data->total() }} applications awaiting action</div>
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
          <td>
            <div class="action-group">
              <button class="icon-btn view" title="View Details"><i class="fa-solid fa-eye"></i></button>
              <button class="icon-btn" title="Approve" style="background:var(--success-soft);color:var(--success)"><i class="fa-solid fa-check"></i></button>
              <button class="icon-btn delete" title="Reject"><i class="fa-solid fa-xmark"></i></button>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="8" style="text-align:center;padding:40px;color:var(--text-muted)"><i class="fa-solid fa-circle-check" style="font-size:24px;display:block;margin-bottom:8px;color:var(--success)"></i>No pending approvals. All clear!</td></tr>
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
