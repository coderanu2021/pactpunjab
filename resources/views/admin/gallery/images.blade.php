@extends('layouts.backend')
@section('title', 'Gallery Images')

@section('content')

<div class="page-header">
  <div>
    <h1><i class="fa-solid fa-image" style="color:var(--primary);margin-right:8px"></i>Gallery Images</h1>
    <p>Upload and manage images across all gallery albums.</p>
  </div>
  <div class="header-actions">
    <button class="btn btn-primary" onclick="document.getElementById('addModal').classList.add('open')"><i class="fa-solid fa-upload"></i> Upload Image</button>
  </div>
</div>

<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Total Images</div><div class="stat-value" style="margin-top:8px">{{ $data->total() }}</div></div>
      <div class="stat-icon" style="background:var(--primary-soft);color:var(--primary)"><i class="fa-solid fa-image"></i></div>
    </div>
    <div class="stat-footer"><span class="stat-footer-label">Across all albums</span></div>
  </div>
</div>

<div class="filters-bar">
  <div class="search-box">
    <i class="fa-solid fa-magnifying-glass"></i>
    <input type="text" placeholder="Search by title…" id="searchInput" oninput="clientFilter()"/>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <div>
      <div class="card-title">All Images</div>
      <div class="card-subtitle">{{ $data->firstItem() }}–{{ $data->lastItem() }} of {{ $data->total() }} images</div>
    </div>
  </div>
  <div style="overflow-x:auto">
    <table class="data-table" id="mainTable">
      <thead>
        <tr>
          <th><input type="checkbox" style="cursor:pointer"/></th>
          <th>Preview</th>
          <th>Title</th>
          <th>Album ID</th>
          <th>File Path</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="tableBody">
        @forelse($data as $item)
        <tr>
          <td><input type="checkbox" style="cursor:pointer"/></td>
          <td>
            <div style="width:48px;height:48px;border-radius:8px;background:var(--primary-soft);display:flex;align-items:center;justify-content:center;color:var(--primary);font-size:18px;overflow:hidden">
              @if($item->file_path)
              <img src="{{ asset('storage/'.$item->file_path) }}" alt="{{ $item->title }}" style="width:100%;height:100%;object-fit:cover" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
              <i class="fa-solid fa-image" style="display:none"></i>
              @else
              <i class="fa-solid fa-image"></i>
              @endif
            </div>
          </td>
          <td><div class="user-name">{{ $item->title ?? '—' }}</div></td>
          <td style="color:var(--text-secondary);font-family:monospace">{{ $item->album_id }}</td>
          <td style="color:var(--text-muted);font-size:12px;max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ $item->file_path ?? '—' }}</td>
          <td>
            <div class="action-group">
              <button class="icon-btn view" title="View"><i class="fa-solid fa-eye"></i></button>
              <button class="icon-btn edit" title="Edit"><i class="fa-solid fa-pen"></i></button>
              <button class="icon-btn delete" title="Delete"><i class="fa-solid fa-trash"></i></button>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="6" style="text-align:center;padding:40px;color:var(--text-muted)"><i class="fa-solid fa-image" style="font-size:24px;display:block;margin-bottom:8px"></i>No images found.</td></tr>
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
      <h2><i class="fa-solid fa-upload" style="color:var(--primary);margin-right:8px"></i>Upload Image</h2>
      <button class="modal-close" onclick="document.getElementById('addModal').classList.remove('open')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body">
      <form enctype="multipart/form-data">
        <div class="detail-grid">
          <div class="detail-item" style="grid-column:1/-1"><label>Image Title</label><input type="text" class="form-input" placeholder="Image caption or title"/></div>
          <div class="detail-item"><label>Album</label>
            <select class="form-input"><option>Select album</option></select>
          </div>
          <div class="detail-item"><label>Image File</label><input type="file" class="form-input" accept="image/*"/></div>
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
  document.querySelectorAll('#tableBody tr').forEach(row => {
    row.style.display = (!q || row.innerText.toLowerCase().includes(q)) ? '' : 'none';
  });
}
document.querySelectorAll('.modal-overlay').forEach(m => {
  m.addEventListener('click', e => { if(e.target === m) m.classList.remove('open'); });
});
</script>
@endsection
