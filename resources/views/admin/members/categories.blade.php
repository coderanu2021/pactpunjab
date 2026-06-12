@extends('layouts.backend')
@section('title', 'Member Categories')

@section('content')

<div class="page-header">
  <div>
    <h1><i class="fa-solid fa-tags" style="color:var(--primary);margin-right:8px"></i>Member Categories</h1>
    <p>Manage membership tiers, categories and associated fees.</p>
  </div>
  <div class="header-actions">
    <button class="btn btn-primary" onclick="document.getElementById('addModal').classList.add('open')"><i class="fa-solid fa-plus"></i> Add Category</button>
  </div>
</div>

<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Total Categories</div><div class="stat-value" style="margin-top:8px">{{ $data->total() }}</div></div>
      <div class="stat-icon" style="background:var(--primary-soft);color:var(--primary)"><i class="fa-solid fa-layer-group"></i></div>
    </div>
    <div class="stat-footer"><span class="stat-footer-label">All membership types</span></div>
  </div>
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Active</div><div class="stat-value" style="margin-top:8px;color:var(--success)">{{ $data->where('status','Active')->count() }}</div></div>
      <div class="stat-icon" style="background:var(--success-soft);color:var(--success)"><i class="fa-solid fa-circle-check"></i></div>
    </div>
    <div class="stat-footer"><span class="stat-footer-label">Available for signup</span></div>
  </div>
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Inactive</div><div class="stat-value" style="margin-top:8px;color:var(--danger)">{{ $data->where('status','Inactive')->count() }}</div></div>
      <div class="stat-icon" style="background:var(--danger-soft);color:var(--danger)"><i class="fa-solid fa-circle-xmark"></i></div>
    </div>
    <div class="stat-footer"><span class="stat-footer-label">Disabled categories</span></div>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <div>
      <div class="card-title">All Member Categories</div>
      <div class="card-subtitle">{{ $data->total() }} categories found</div>
    </div>
  </div>
  <div style="overflow-x:auto">
    <table class="data-table">
      <thead>
        <tr>
          <th>#</th>
          <th>Category Name</th>
          <th>Annual Fee (₹)</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($data as $item)
        <tr>
          <td style="color:var(--text-muted)">{{ $loop->iteration }}</td>
          <td style="font-weight:600;color:var(--text-main)">{{ $item->name }}</td>
          <td style="font-weight:600;color:var(--primary)">₹ {{ number_format($item->annual_fee, 2) }}</td>
          <td>
            @php $cls = $item->status == 'Active' ? 'tag-approved' : 'tag-rejected'; @endphp
            <span class="tag {{ $cls }}">{{ $item->status }}</span>
          </td>
          <td>
            <div class="action-group">
              <button class="icon-btn edit" title="Edit"><i class="fa-solid fa-pen"></i></button>
              <button class="icon-btn delete" title="Delete"><i class="fa-solid fa-trash"></i></button>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="5" style="text-align:center;padding:40px;color:var(--text-muted)"><i class="fa-solid fa-inbox" style="font-size:24px;display:block;margin-bottom:8px"></i>No categories found.</td></tr>
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
      <h2><i class="fa-solid fa-tag" style="color:var(--primary);margin-right:8px"></i>Add Member Category</h2>
      <button class="modal-close" onclick="document.getElementById('addModal').classList.remove('open')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body">
      <form>
        <div class="detail-grid">
          <div class="detail-item" style="grid-column:1/-1"><label>Category Name</label><input type="text" class="form-input" placeholder="e.g. Life Member"/></div>
          <div class="detail-item"><label>Annual Fee (₹)</label><input type="number" class="form-input" placeholder="0.00"/></div>
          <div class="detail-item"><label>Status</label>
            <select class="form-input"><option>Active</option><option>Inactive</option></select>
          </div>
        </div>
      </form>
    </div>
    <div class="modal-footer">
      <button class="btn btn-outline" onclick="document.getElementById('addModal').classList.remove('open')">Cancel</button>
      <button class="btn btn-primary"><i class="fa-solid fa-save"></i> Save</button>
    </div>
  </div>
</div>

@endsection

@section('script')
<script>
document.querySelectorAll('.modal-overlay').forEach(m => {
  m.addEventListener('click', e => { if(e.target === m) m.classList.remove('open'); });
});
</script>
@endsection
