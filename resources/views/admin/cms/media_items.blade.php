@extends('layouts.backend')
@section('title', 'Media Items')
@section('content')
<div class="page-header">
  <div>
    <h1><i class="fa-solid fa-newspaper" style="color:var(--primary);margin-right:8px"></i>Media & Press</h1>
    <p>Manage media coverage articles and official press releases.</p>
  </div>
  <div class="header-actions">
    <button class="btn btn-primary" onclick="openModal('addModal')"><i class="fa-solid fa-plus"></i> Add Media Item</button>
  </div>
</div>

<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Total Items</div><div class="stat-value" style="margin-top:8px">{{ $data->total() }}</div></div>
      <div class="stat-icon" style="background:var(--primary-soft);color:var(--primary)"><i class="fa-solid fa-list"></i></div>
    </div>
  </div>
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Media Coverage</div><div class="stat-value" style="margin-top:8px;color:var(--success)">{{ \App\Models\MediaItem::where('type','coverage')->count() }}</div></div>
      <div class="stat-icon" style="background:var(--success-soft);color:var(--success)"><i class="fa-solid fa-camera"></i></div>
    </div>
  </div>
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Press Releases</div><div class="stat-value" style="margin-top:8px;color:var(--warning)">{{ \App\Models\MediaItem::where('type','release')->count() }}</div></div>
      <div class="stat-icon" style="background:var(--warning-soft);color:var(--warning)"><i class="fa-solid fa-bullhorn"></i></div>
    </div>
  </div>
</div>

<form method="GET" class="filters-bar">
  <div class="search-box">
    <i class="fa-solid fa-magnifying-glass"></i>
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search titles or outlets…" oninput="this.form.submit()"/>
  </div>
  <select name="type" class="filter-select" onchange="this.form.submit()">
    <option value="">All Types</option>
    <option value="coverage" {{ request('type')=='coverage'?'selected':'' }}>Media Coverage</option>
    <option value="release" {{ request('type')=='release'?'selected':'' }}>Press Releases</option>
  </select>
</form>

<div class="card">
  <div class="card-header">
    <div class="card-title">Media Items</div>
    <div class="card-subtitle">{{ $data->firstItem()??0 }}–{{ $data->lastItem()??0 }} of {{ $data->total() }}</div>
  </div>
  <div style="overflow-x:auto">
    <table class="data-table">
      <thead>
        <tr>
          <th>#</th>
          <th>Type</th>
          <th>Title & Outlet</th>
          <th>Published Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($data as $item)
        <tr>
          <td style="color:var(--text-muted)">{{ $item->id }}</td>
          <td>
            @if($item->type == 'coverage')
              <span class="tag tag-approved">Coverage</span>
            @else
              <span class="tag tag-pending">Release</span>
            @endif
          </td>
          <td>
            <div style="display:flex;align-items:center;gap:10px">
              <div style="width:34px;height:34px;border-radius:8px;background:var(--primary-soft);color:var(--primary);display:flex;align-items:center;justify-content:center;font-size:16px;">
                @if($item->type == 'coverage')
                  <i class="fa-solid fa-newspaper"></i>
                @else
                  <i class="fa-solid fa-bullhorn"></i>
                @endif
              </div>
              <div>
                <div class="user-name">{{ $item->title }}</div>
                <div style="font-size:11px;color:var(--text-muted)">{{ $item->outlet }}</div>
              </div>
            </div>
          </td>
          <td style="color:var(--text-muted);font-size:13px">{{ $item->published_date ? $item->published_date->format('M d, Y') : '—' }}</td>
          <td>
            <div class="action-group">
              @if($item->url)
                <a href="{{ $item->url }}" target="_blank" class="icon-btn view" style="text-decoration:none" title="View URL"><i class="fa-solid fa-link"></i></a>
              @elseif($item->file_path)
                <a href="{{ asset('storage/'.$item->file_path) }}" target="_blank" class="icon-btn view" style="text-decoration:none" title="View File"><i class="fa-solid fa-file"></i></a>
              @endif
              <button class="icon-btn edit" onclick="editMedia({{ $item->id }})"><i class="fa-solid fa-pen"></i></button>
              <button class="icon-btn delete" onclick="crudDelete('/admin/cms/media-items/{{ $item->id }}','{{ addslashes($item->title) }}')"><i class="fa-solid fa-trash"></i></button>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="5" style="text-align:center;padding:40px;color:var(--text-muted)">No media items found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div style="padding:14px 20px;border-top:1px solid var(--border)">{{ $data->links('pagination::bootstrap-4') }}</div>
</div>

<!-- Add Modal -->
<div class="modal-overlay" id="addModal">
  <div class="modal">
    <div class="modal-header">
      <h2><i class="fa-solid fa-plus" style="color:var(--primary);margin-right:8px"></i>Add Media Item</h2>
      <button class="modal-close" type="button" onclick="closeModal('addModal')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body">
      <form id="addForm" enctype="multipart/form-data">
        <div class="detail-grid" style="gap:14px">
          <div class="detail-item" style="grid-column:1/-1">
            <label>Type *</label>
            <select class="form-input" name="type">
              <option value="coverage">Media Coverage (External News)</option>
              <option value="release">Press Release (Internal)</option>
            </select>
          </div>
          <div class="detail-item" style="grid-column:1/-1">
            <label>Title *</label>
            <input type="text" class="form-input" name="title" placeholder="News Headline or Release Title" required/>
          </div>
          <div class="detail-item">
            <label>Publication Outlet / Source</label>
            <input type="text" class="form-input" name="outlet" placeholder="e.g. The Tribune, Times of India"/>
          </div>
          <div class="detail-item">
            <label>Published Date *</label>
            <input type="date" class="form-input" name="published_date" required/>
          </div>
          <div class="detail-item" style="grid-column:1/-1">
            <label>External URL (Optional, mostly for Coverage)</label>
            <input type="url" class="form-input" name="url" placeholder="https://..."/>
          </div>
          <div class="detail-item" style="grid-column:1/-1">
            <label>File/Image Attachment (Optional)</label>
            <input type="file" class="form-input" name="file" accept=".jpg,.jpeg,.png,.pdf"/>
          </div>
          <div class="detail-item" style="grid-column:1/-1">
            <label>Description (Optional excerpt)</label>
            <textarea class="form-input" name="description" rows="3"></textarea>
          </div>
        </div>
        <div id="addError" class="form-error" style="display:none;margin-top:10px;"></div>
      </form>
    </div>
    <div class="modal-footer">
      <button class="btn btn-outline" type="button" onclick="closeModal('addModal')">Cancel</button>
      <button class="btn btn-primary" type="button" onclick="submitAdd()"><i class="fa-solid fa-save"></i> Save</button>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal-overlay" id="editModal">
  <div class="modal">
    <div class="modal-header">
      <h2><i class="fa-solid fa-pen" style="color:var(--warning);margin-right:8px"></i>Edit Media Item</h2>
      <button class="modal-close" type="button" onclick="closeModal('editModal')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body">
      <form id="editForm" enctype="multipart/form-data">
        <input type="hidden" id="eId"/>
        <input type="hidden" name="_method" value="PUT">
        <div class="detail-grid" style="gap:14px">
          <div class="detail-item" style="grid-column:1/-1">
            <label>Type *</label>
            <select class="form-input" name="type" id="eType">
              <option value="coverage">Media Coverage (External News)</option>
              <option value="release">Press Release (Internal)</option>
            </select>
          </div>
          <div class="detail-item" style="grid-column:1/-1">
            <label>Title *</label>
            <input type="text" class="form-input" name="title" id="eTitle" required/>
          </div>
          <div class="detail-item">
            <label>Publication Outlet / Source</label>
            <input type="text" class="form-input" name="outlet" id="eOutlet"/>
          </div>
          <div class="detail-item">
            <label>Published Date *</label>
            <input type="date" class="form-input" name="published_date" id="eDate" required/>
          </div>
          <div class="detail-item" style="grid-column:1/-1">
            <label>External URL (Optional)</label>
            <input type="url" class="form-input" name="url" id="eUrl"/>
          </div>
          <div class="detail-item" style="grid-column:1/-1">
            <label>Replace File/Image (Leave blank to keep existing)</label>
            <input type="file" class="form-input" name="file" accept=".jpg,.jpeg,.png,.pdf"/>
          </div>
          <div class="detail-item" style="grid-column:1/-1">
            <label>Description</label>
            <textarea class="form-input" name="description" id="eDescription" rows="3"></textarea>
          </div>
        </div>
        <div id="editError" class="form-error" style="display:none;margin-top:10px;"></div>
      </form>
    </div>
    <div class="modal-footer">
      <button class="btn btn-outline" type="button" onclick="closeModal('editModal')">Cancel</button>
      <button class="btn btn-primary" type="button" onclick="submitEdit()"><i class="fa-solid fa-floppy-disk"></i> Update</button>
    </div>
  </div>
</div>
@endsection

@section('script')
@include('partials.crud-script')
<script>
function post(url, fd, errId, cb) {
  fetch(url, {
    method: 'POST',
    body: fd,
    headers: {
      'X-CSRF-TOKEN': _CSRF,
      'X-Requested-With': 'XMLHttpRequest',
      'Accept': 'application/json'
    }
  }).then(r => r.json()).then(res => {
    if (res.success) {
      showToast(res.message);
      cb();
    } else {
      const e = document.getElementById(errId);
      if (e) {
        e.textContent = res.message || 'Validation error';
        e.style.display = 'block';
      } else {
        showToast(res.message, 'error');
      }
    }
  }).catch(() => showToast('Network error', 'error'));
}

function submitAdd() {
  const form = document.getElementById('addForm');
  const fd = new FormData(form);
  post('/admin/cms/media-items', fd, 'addError', () => {
    closeModal('addModal');
    _reload();
  });
}

function editMedia(id) {
  fetch(`/admin/cms/media-items/${id}`, {
    headers: {
      'Accept': 'application/json',
      'X-Requested-With': 'XMLHttpRequest'
    }
  }).then(r => r.json()).then(d => {
    document.getElementById('eId').value = d.id;
    document.getElementById('eType').value = d.type;
    document.getElementById('eTitle').value = d.title;
    document.getElementById('eOutlet').value = d.outlet || '';
    
    // Format date for date input
    let dateStr = '';
    if (d.published_date) {
      dateStr = d.published_date.split('T')[0];
    }
    document.getElementById('eDate').value = dateStr;
    
    document.getElementById('eUrl').value = d.url || '';
    document.getElementById('eDescription').value = d.description || '';
    
    // Clear file input
    document.querySelector('#editForm input[type="file"]').value = '';
    
    openModal('editModal');
  }).catch(() => showToast('Failed to fetch data','error'));
}

function submitEdit() {
  const id = document.getElementById('eId').value;
  const form = document.getElementById('editForm');
  const fd = new FormData(form);
  
  post(`/admin/cms/media-items/${id}`, fd, 'editError', () => {
    closeModal('editModal');
    _reload();
  });
}
</script>
@endsection
