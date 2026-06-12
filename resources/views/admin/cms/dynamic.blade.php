@extends('layouts.backend')
@section('title', 'Dynamic Pages — CMS')

@section('content')

<div class="page-header">
  <div>
    <h1><i class="fa-solid fa-file-lines" style="color:var(--primary);margin-right:8px"></i>Dynamic Pages</h1>
    <p>Manage custom content pages for the website (news, announcements, policies etc.).</p>
  </div>
  <div class="header-actions">
    <button class="btn btn-primary" onclick="document.getElementById('addModal').classList.add('open')"><i class="fa-solid fa-plus"></i> New Page</button>
  </div>
</div>

<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Total Pages</div><div class="stat-value" style="margin-top:8px">6</div></div>
      <div class="stat-icon" style="background:var(--primary-soft);color:var(--primary)"><i class="fa-solid fa-file-lines"></i></div>
    </div>
    <div class="stat-footer"><span class="stat-footer-label">All dynamic pages</span></div>
  </div>
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Published</div><div class="stat-value" style="margin-top:8px;color:var(--success)">4</div></div>
      <div class="stat-icon" style="background:var(--success-soft);color:var(--success)"><i class="fa-solid fa-circle-check"></i></div>
    </div>
    <div class="stat-footer"><span class="stat-footer-label">Live on website</span></div>
  </div>
  <div class="stat-card">
    <div class="stat-top">
      <div><div class="stat-label">Draft</div><div class="stat-value" style="margin-top:8px;color:var(--warning)">2</div></div>
      <div class="stat-icon" style="background:var(--warning-soft);color:var(--warning)"><i class="fa-solid fa-file-pen"></i></div>
    </div>
    <div class="stat-footer"><span class="stat-footer-label">Not yet published</span></div>
  </div>
</div>

<div class="card">
  <div class="card-header" style="border-bottom:1px solid var(--border)">
    <div class="card-title">All Dynamic Pages</div>
    <div class="card-subtitle">Click a page to edit its content</div>
  </div>
  <div style="overflow-x:auto">
    <table class="data-table">
      <thead>
        <tr>
          <th>#</th>
          <th>Page Title</th>
          <th>Slug / URL</th>
          <th>Last Modified</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @php
        $pages = [
          ['id'=>1,'title'=>'Privacy Policy','slug'=>'/privacy-policy','date'=>'10 Jun 2026','status'=>'Published'],
          ['id'=>2,'title'=>'Terms & Conditions','slug'=>'/terms','date'=>'10 Jun 2026','status'=>'Published'],
          ['id'=>3,'title'=>'Refund Policy','slug'=>'/refund-policy','date'=>'05 Jun 2026','status'=>'Published'],
          ['id'=>4,'title'=>'Disclaimer','slug'=>'/disclaimer','date'=>'01 Jun 2026','status'=>'Published'],
          ['id'=>5,'title'=>'Annual Report 2025 Page','slug'=>'/annual-report-2025','date'=>'28 May 2026','status'=>'Draft'],
          ['id'=>6,'title'=>'Events Announcement','slug'=>'/events-2026','date'=>'20 May 2026','status'=>'Draft'],
        ];
        @endphp
        @foreach($pages as $page)
        <tr>
          <td style="color:var(--text-muted)">{{ $page['id'] }}</td>
          <td>
            <div style="display:flex;align-items:center;gap:10px">
              <div style="width:32px;height:32px;border-radius:8px;background:var(--primary-soft);color:var(--primary);display:flex;align-items:center;justify-content:center;font-size:14px;flex-shrink:0">
                <i class="fa-solid fa-file-lines"></i>
              </div>
              <div class="user-name">{{ $page['title'] }}</div>
            </div>
          </td>
          <td style="font-family:monospace;font-size:12px;color:var(--text-secondary)">{{ $page['slug'] }}</td>
          <td style="color:var(--text-secondary)">{{ $page['date'] }}</td>
          <td>
            @php $cls = ($page['status']=='Published') ? 'tag-approved' : 'tag-pending'; @endphp
            <span class="tag {{ $cls }}">{{ $page['status'] }}</span>
          </td>
          <td>
            <div class="action-group">
              <button class="icon-btn view" title="Preview"><i class="fa-solid fa-eye"></i></button>
              <button class="icon-btn edit" title="Edit"><i class="fa-solid fa-pen"></i></button>
              <button class="icon-btn delete" title="Delete"><i class="fa-solid fa-trash"></i></button>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- Add Page Modal -->
<div class="modal-overlay" id="addModal">
  <div class="modal">
    <div class="modal-header">
      <h2><i class="fa-solid fa-file-plus" style="color:var(--primary);margin-right:8px"></i>Create New Page</h2>
      <button class="modal-close" onclick="document.getElementById('addModal').classList.remove('open')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body">
      <div class="detail-grid">
        <div class="detail-item" style="grid-column:1/-1"><label>Page Title</label><input type="text" class="form-input" placeholder="e.g. Privacy Policy"/></div>
        <div class="detail-item"><label>URL Slug</label><input type="text" class="form-input" placeholder="/privacy-policy"/></div>
        <div class="detail-item"><label>Status</label>
          <select class="form-input"><option>Draft</option><option>Published</option></select>
        </div>
        <div class="detail-item" style="grid-column:1/-1"><label>Page Content</label>
          <textarea class="form-input" rows="5" placeholder="Page content…"></textarea>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-outline" onclick="document.getElementById('addModal').classList.remove('open')">Cancel</button>
      <button class="btn btn-primary"><i class="fa-solid fa-save"></i> Create Page</button>
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
