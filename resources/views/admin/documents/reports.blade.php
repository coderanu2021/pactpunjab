@extends('layouts.backend')
@section('title', 'Reports')

@section('content')

<div class="page-header">
  <div>
    <h1><i class="fa-solid fa-file-chart-column" style="color:var(--primary);margin-right:8px"></i>Reports</h1>
    <p>Upload and manage official reports and publications.</p>
  </div>
  <div class="header-actions">
    <button class="btn btn-outline"><i class="fa-solid fa-download"></i> Export List</button>
    <button class="btn btn-primary" onclick="document.getElementById('addModal').classList.add('open')"><i class="fa-solid fa-upload"></i> Upload Report</button>
  </div>
</div>

<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Total Reports</div><div class="stat-value" style="margin-top:8px">{{ $data->total() }}</div></div>
      <div class="stat-icon" style="background:var(--primary-soft);color:var(--primary)"><i class="fa-solid fa-file-lines"></i></div>
    </div>
    <div class="stat-footer"><span class="stat-footer-label">All uploaded reports</span></div>
  </div>
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Published</div><div class="stat-value" style="margin-top:8px;color:var(--success)">{{ $data->where('status','Published')->count() }}</div></div>
      <div class="stat-icon" style="background:var(--success-soft);color:var(--success)"><i class="fa-solid fa-circle-check"></i></div>
    </div>
    <div class="stat-footer"><span class="stat-footer-label">Visible to public</span></div>
  </div>
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Draft</div><div class="stat-value" style="margin-top:8px;color:var(--warning)">{{ $data->where('status','Draft')->count() }}</div></div>
      <div class="stat-icon" style="background:var(--warning-soft);color:var(--warning)"><i class="fa-solid fa-file-pen"></i></div>
    </div>
    <div class="stat-footer"><span class="stat-footer-label">Not yet published</span></div>
  </div>
</div>

<div class="filters-bar">
  <div class="search-box">
    <i class="fa-solid fa-magnifying-glass"></i>
    <input type="text" placeholder="Search reports…" id="searchInput" oninput="clientFilter()"/>
  </div>
  <select class="filter-select" id="statusFilter" onchange="clientFilter()">
    <option value="">All Statuses</option>
    <option value="Published">Published</option>
    <option value="Draft">Draft</option>
  </select>
</div>

<div class="card">
  <div class="card-header">
    <div>
      <div class="card-title">All Reports</div>
      <div class="card-subtitle">{{ $data->firstItem() }}–{{ $data->lastItem() }} of {{ $data->total() }} entries</div>
    </div>
  </div>
  <div style="overflow-x:auto">
    <table class="data-table" id="mainTable">
      <thead>
        <tr>
          <th><input type="checkbox" style="cursor:pointer"/></th>
          <th>#</th>
          <th>Title</th>
          <th>File</th>
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
            <div style="display:flex;align-items:center;gap:10px">
              <div style="width:34px;height:34px;border-radius:8px;background:var(--danger-soft);color:var(--danger);display:flex;align-items:center;justify-content:center;font-size:15px;flex-shrink:0">
                <i class="fa-solid fa-file-pdf"></i>
              </div>
              <div class="user-name">{{ $item->title }}</div>
            </div>
          </td>
          <td style="color:var(--text-muted);font-size:12px">{{ $item->file_path ? basename($item->file_path) : '—' }}</td>
          <td>
            @php $cls = ($item->status == 'Published') ? 'tag-approved' : 'tag-pending'; @endphp
            <span class="tag {{ $cls }}">{{ $item->status }}</span>
          </td>
          <td>
            <div class="action-group">
              @if($item->file_path)
              <a href="{{ asset('storage/'.$item->file_path) }}" target="_blank" class="icon-btn view" title="Download" style="text-decoration:none"><i class="fa-solid fa-download"></i></a>
              @else
              <button class="icon-btn view" title="View"><i class="fa-solid fa-eye"></i></button>
              @endif
              <button class="icon-btn edit" title="Edit"><i class="fa-solid fa-pen"></i></button>
              <button class="icon-btn delete" title="Delete"><i class="fa-solid fa-trash"></i></button>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="6" style="text-align:center;padding:40px;color:var(--text-muted)"><i class="fa-solid fa-file-lines" style="font-size:24px;display:block;margin-bottom:8px"></i>No reports found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div style="padding:14px 20px;border-top:1px solid var(--border);background:var(--surface)">
    {{ $data->links('pagination::bootstrap-4') }}
  </div>
</div>

<!-- Upload Modal -->
<div class="modal-overlay" id="addModal">
  <div class="modal">
    <div class="modal-header">
      <h2><i class="fa-solid fa-file-arrow-up" style="color:var(--primary);margin-right:8px"></i>Upload Report</h2>
      <button class="modal-close" onclick="document.getElementById('addModal').classList.remove('open')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body">
      <form enctype="multipart/form-data">
        <div class="detail-grid">
          <div class="detail-item" style="grid-column:1/-1"><label>Report Title</label><input type="text" class="form-input" placeholder="Annual Report 2025…"/></div>
          <div class="detail-item"><label>PDF File</label><input type="file" class="form-input" accept=".pdf"/></div>
          <div class="detail-item"><label>Status</label>
            <select class="form-input"><option>Published</option><option>Draft</option></select>
          </div>
        </div>
      </form>
    </div>
    <div class="modal-footer">
      <button class="btn btn-outline" onclick="document.getElementById('addModal').classList.remove('open')">Cancel</button>
      <button class="btn btn-primary"><i class="fa-solid fa-upload"></i> Upload</button>
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
