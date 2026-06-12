@extends('layouts.backend')
@section('title') Dashboard @endsection

@section('content')

  <!-- Page Header -->
  <div class="page-header">
    <div>
      <h1>Welcome back, Admin 👋</h1>
      <p>Here's what's happening across your portal today — Tuesday, 9 June 2026</p>
    </div>
    <div class="header-actions">
      <button class="btn btn-outline"><i class="fa-solid fa-download"></i> Export</button>
      <button class="btn btn-primary"><i class="fa-solid fa-plus"></i> Quick Add</button>
    </div>
  </div>

  <!-- ── KPI STATS ───────────────────────────── -->
  <div class="stats-grid">

    <div class="stat-card">
      <div class="stat-top">
        <div class="stat-label">Total Members</div>
        <div class="stat-icon" style="background:#EFF6FF;color:#2563EB"><i class="fa-solid fa-users"></i></div>
      </div>
      <div class="stat-value">4,832</div>
      <div class="stat-footer">
        <span class="badge-change badge-up"><i class="fa-solid fa-arrow-trend-up"></i> 8.4%</span>
        <span class="stat-footer-label">vs last month</span>
      </div>
    </div>

    <div class="stat-card">
      <div class="stat-top">
        <div class="stat-label">Pending Approvals</div>
        <div class="stat-icon" style="background:#FFFBEB;color:#D97706"><i class="fa-solid fa-hourglass-half"></i></div>
      </div>
      <div class="stat-value">38</div>
      <div class="stat-footer">
        <span class="badge-change badge-down"><i class="fa-solid fa-arrow-trend-down"></i> 3</span>
        <span class="stat-footer-label">since yesterday</span>
      </div>
    </div>

    <div class="stat-card">
      <div class="stat-top">
        <div class="stat-label">Certificates Issued</div>
        <div class="stat-icon" style="background:#F5F3FF;color:#7C3AED"><i class="fa-solid fa-certificate"></i></div>
      </div>
      <div class="stat-value">1,209</div>
      <div class="stat-footer">
        <span class="badge-change badge-up"><i class="fa-solid fa-arrow-trend-up"></i> 14%</span>
        <span class="stat-footer-label">vs last month</span>
      </div>
    </div>

    <div class="stat-card">
      <div class="stat-top">
        <div class="stat-label">Upcoming Events</div>
        <div class="stat-icon" style="background:#F0FDF4;color:#16A34A"><i class="fa-solid fa-calendar-check"></i></div>
      </div>
      <div class="stat-value">7</div>
      <div class="stat-footer">
        <span class="badge-change badge-up"><i class="fa-solid fa-arrow-trend-up"></i> 2 new</span>
        <span class="stat-footer-label">this week</span>
      </div>
    </div>

  </div>

  <!-- ── MODULE QUICK ACCESS ─────────────────── -->
  <div class="module-grid">
    <div class="module-card">
      <div class="module-icon" style="background:#EFF6FF;color:#2563EB"><i class="fa-solid fa-file-pen"></i></div>
      <div class="module-text"><strong>Registrations</strong><span>248 total</span></div>
    </div>
    <div class="module-card">
      <div class="module-icon" style="background:#F5F3FF;color:#7C3AED"><i class="fa-solid fa-certificate"></i></div>
      <div class="module-text"><strong>Certificates</strong><span>1,209 issued</span></div>
    </div>
    <div class="module-card">
      <div class="module-icon" style="background:#FFFBEB;color:#D97706"><i class="fa-solid fa-calendar-days"></i></div>
      <div class="module-text"><strong>Events</strong><span>7 upcoming</span></div>
    </div>
    <div class="module-card">
      <div class="module-icon" style="background:#F0FDF4;color:#16A34A"><i class="fa-solid fa-images"></i></div>
      <div class="module-text"><strong>Gallery</strong><span>14 albums</span></div>
    </div>
    <div class="module-card">
      <div class="module-icon" style="background:#FEF2F2;color:#DC2626"><i class="fa-solid fa-bell"></i></div>
      <div class="module-text"><strong>Notifications</strong><span>5 unread</span></div>
    </div>
    <div class="module-card">
      <div class="module-icon" style="background:#F0F9FF;color:#0EA5E9"><i class="fa-solid fa-folder-open"></i></div>
      <div class="module-text"><strong>Documents</strong><span>32 files</span></div>
    </div>
    <div class="module-card">
      <div class="module-icon" style="background:#EFF6FF;color:#2563EB"><i class="fa-solid fa-layer-group"></i></div>
      <div class="module-text"><strong>CMS Pages</strong><span>4 pages</span></div>
    </div>
    <div class="module-card">
      <div class="module-icon" style="background:#F5F3FF;color:#7C3AED"><i class="fa-solid fa-gear"></i></div>
      <div class="module-text"><strong>Settings</strong><span>Configure</span></div>
    </div>
  </div>

  <!-- ── REGISTRATIONS CHART + PENDING ──────── -->
  <div class="row row-3-2">

    <div class="card">
      <div class="card-header">
        <div>
          <div class="card-title">Registration Overview</div>
          <div class="card-subtitle">Personal & Association — last 7 months</div>
        </div>
        <a class="card-link" href="#">View all →</a>
      </div>
      <div class="card-body">
        <!-- Legend -->
        <div style="display:flex;gap:18px;margin-bottom:12px">
          <div style="display:flex;align-items:center;gap:6px;font-size:12px;color:var(--text-secondary)">
            <span style="width:10px;height:10px;border-radius:3px;background:linear-gradient(180deg,var(--primary),var(--accent));display:inline-block"></span>Personal
          </div>
          <div style="display:flex;align-items:center;gap:6px;font-size:12px;color:var(--text-secondary)">
            <span style="width:10px;height:10px;border-radius:3px;background:#CBD5E1;display:inline-block"></span>Association
          </div>
        </div>
        <div class="chart-bars">
          <div class="bar-wrap"><div class="bar" style="height:55%"></div><div class="bar secondary" style="height:35%"></div><div class="bar-label">Dec</div></div>
          <div class="bar-wrap"><div class="bar" style="height:65%"></div><div class="bar secondary" style="height:40%"></div><div class="bar-label">Jan</div></div>
          <div class="bar-wrap"><div class="bar" style="height:50%"></div><div class="bar secondary" style="height:30%"></div><div class="bar-label">Feb</div></div>
          <div class="bar-wrap"><div class="bar" style="height:75%"></div><div class="bar secondary" style="height:50%"></div><div class="bar-label">Mar</div></div>
          <div class="bar-wrap"><div class="bar" style="height:85%"></div><div class="bar secondary" style="height:60%"></div><div class="bar-label">Apr</div></div>
          <div class="bar-wrap"><div class="bar" style="height:70%"></div><div class="bar secondary" style="height:45%"></div><div class="bar-label">May</div></div>
          <div class="bar-wrap"><div class="bar" style="height:90%"></div><div class="bar secondary" style="height:65%"></div><div class="bar-label">Jun</div></div>
        </div>
        <!-- Summary -->
        <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:14px;margin-top:18px">
          <div style="text-align:center;padding:10px;background:var(--bg);border-radius:8px">
            <div style="font-size:18px;font-weight:700;color:var(--primary)">248</div>
            <div style="font-size:11px;color:var(--text-muted)">Total</div>
          </div>
          <div style="text-align:center;padding:10px;background:var(--success-soft);border-radius:8px">
            <div style="font-size:18px;font-weight:700;color:var(--success)">192</div>
            <div style="font-size:11px;color:var(--text-muted)">Approved</div>
          </div>
          <div style="text-align:center;padding:10px;background:var(--warning-soft);border-radius:8px">
            <div style="font-size:18px;font-weight:700;color:var(--warning)">38</div>
            <div style="font-size:11px;color:var(--text-muted)">Pending</div>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <div>
          <div class="card-title">Pending Approvals</div>
          <div class="card-subtitle">Awaiting review</div>
        </div>
        <a class="card-link" href="#">View all →</a>
      </div>
      <div class="card-body">
        <div class="pending-list">

          <div class="pending-item">
            <div class="pending-avatar" style="background:#2563EB">RK</div>
            <div class="pending-info">
              <div class="pending-name">Raj Kumar</div>
              <div class="pending-meta">Personal · Applied 2h ago</div>
            </div>
            <div class="pending-actions">
              <button class="icon-btn approve" title="Approve"><i class="fa-solid fa-check"></i></button>
              <button class="icon-btn reject"  title="Reject"><i class="fa-solid fa-xmark"></i></button>
            </div>
          </div>

          <div class="pending-item">
            <div class="pending-avatar" style="background:#7C3AED">AP</div>
            <div class="pending-info">
              <div class="pending-name">Assoc. Pune</div>
              <div class="pending-meta">Association · Applied 5h ago</div>
            </div>
            <div class="pending-actions">
              <button class="icon-btn approve" title="Approve"><i class="fa-solid fa-check"></i></button>
              <button class="icon-btn reject"  title="Reject"><i class="fa-solid fa-xmark"></i></button>
            </div>
          </div>

          <div class="pending-item">
            <div class="pending-avatar" style="background:#0EA5E9">SM</div>
            <div class="pending-info">
              <div class="pending-name">Sunita Mehta</div>
              <div class="pending-meta">Personal · Applied 1d ago</div>
            </div>
            <div class="pending-actions">
              <button class="icon-btn approve" title="Approve"><i class="fa-solid fa-check"></i></button>
              <button class="icon-btn reject"  title="Reject"><i class="fa-solid fa-xmark"></i></button>
            </div>
          </div>

          <div class="pending-item">
            <div class="pending-avatar" style="background:#16A34A">VB</div>
            <div class="pending-info">
              <div class="pending-name">Vijay Bhat</div>
              <div class="pending-meta">Personal · Applied 1d ago</div>
            </div>
            <div class="pending-actions">
              <button class="icon-btn approve" title="Approve"><i class="fa-solid fa-check"></i></button>
              <button class="icon-btn reject"  title="Reject"><i class="fa-solid fa-xmark"></i></button>
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>

  <!-- ── CERTS + EVENTS + GALLERY ───────────── -->
  <div class="row row-equal">

    <!-- Recent Certificates -->
    <div class="card">
      <div class="card-header">
        <div>
          <div class="card-title">Recent Certificates</div>
          <div class="card-subtitle">Latest issued</div>
        </div>
        <a class="card-link" href="#">All →</a>
      </div>
      <div class="card-body">
        <div class="cert-list">
          <div class="cert-item">
            <div class="cert-icon" style="background:#EFF6FF;color:#2563EB"><i class="fa-solid fa-id-badge"></i></div>
            <div class="cert-info">
              <div class="cert-name">Membership Certificate</div>
              <div class="cert-type">Personal · Anita Sharma</div>
            </div>
            <span class="cert-badge tag-approved">Issued</span>
          </div>
          <div class="cert-item">
            <div class="cert-icon" style="background:#F5F3FF;color:#7C3AED"><i class="fa-solid fa-award"></i></div>
            <div class="cert-info">
              <div class="cert-name">Association Cert.</div>
              <div class="cert-type">Association · Delhi Chapter</div>
            </div>
            <span class="cert-badge tag-approved">Issued</span>
          </div>
          <div class="cert-item">
            <div class="cert-icon" style="background:#FFFBEB;color:#D97706"><i class="fa-solid fa-scroll"></i></div>
            <div class="cert-info">
              <div class="cert-name">Participation Cert.</div>
              <div class="cert-type">Personal · Rohit Nair</div>
            </div>
            <span class="cert-badge tag-pending">Pending</span>
          </div>
          <div class="cert-item">
            <div class="cert-icon" style="background:#F0FDF4;color:#16A34A"><i class="fa-solid fa-medal"></i></div>
            <div class="cert-info">
              <div class="cert-name">Excellence Award</div>
              <div class="cert-type">Personal · Priya Singh</div>
            </div>
            <span class="cert-badge tag-approved">Issued</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Upcoming Events -->
    <div class="card">
      <div class="card-header">
        <div>
          <div class="card-title">Upcoming Events</div>
          <div class="card-subtitle">Next 30 days</div>
        </div>
        <a class="card-link" href="#">All →</a>
      </div>
      <div class="card-body">
        <div class="event-list">
          <div class="event-item">
            <div class="event-date-box">
              <div class="eday">14</div>
              <div class="emon">Jun</div>
            </div>
            <div class="event-info">
              <div class="event-name">Annual General Meeting</div>
              <div class="event-meta"><i class="fa-solid fa-location-dot" style="font-size:10px"></i> New Delhi · 10:00 AM</div>
            </div>
            <span class="event-reg">42 reg.</span>
          </div>
          <div class="event-item" style="border-left-color:#7C3AED">
            <div class="event-date-box">
              <div class="eday" style="color:#7C3AED">20</div>
              <div class="emon">Jun</div>
            </div>
            <div class="event-info">
              <div class="event-name">Member Orientation</div>
              <div class="event-meta"><i class="fa-solid fa-location-dot" style="font-size:10px"></i> Online · 3:00 PM</div>
            </div>
            <span class="event-reg" style="background:#F5F3FF;color:#7C3AED">28 reg.</span>
          </div>
          <div class="event-item" style="border-left-color:#16A34A">
            <div class="event-date-box">
              <div class="eday" style="color:#16A34A">28</div>
              <div class="emon">Jun</div>
            </div>
            <div class="event-info">
              <div class="event-name">Workshop: Leadership</div>
              <div class="event-meta"><i class="fa-solid fa-location-dot" style="font-size:10px"></i> Mumbai · 9:00 AM</div>
            </div>
            <span class="event-reg" style="background:#F0FDF4;color:#16A34A">15 reg.</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Gallery / Communication -->
    <div class="card">
      <div class="card-header">
        <div>
          <div class="card-title">Gallery</div>
          <div class="card-subtitle">14 Albums · 386 Images</div>
        </div>
        <a class="card-link" href="#">Manage →</a>
      </div>
      <div class="card-body">
        <div class="gallery-thumbs">
          <div class="gallery-thumb"><i class="fa-solid fa-image"></i></div>
          <div class="gallery-thumb g2"><i class="fa-solid fa-images"></i></div>
          <div class="gallery-thumb g3"><i class="fa-solid fa-photo-film"></i></div>
          <div class="gallery-thumb g4"><i class="fa-solid fa-camera"></i></div>
          <div class="gallery-thumb g5"><i class="fa-solid fa-image"></i></div>
          <div class="gallery-thumb g6"><i class="fa-solid fa-panorama"></i></div>
        </div>
        <div style="margin-top:14px;padding-top:14px;border-top:1px solid var(--border)">
          <div class="card-title" style="margin-bottom:10px">Communication</div>
          <div class="comm-stat-list">
            <div class="comm-stat-item">
              <div class="comm-icon" style="background:#EFF6FF;color:#2563EB"><i class="fa-solid fa-bell"></i></div>
              <div class="comm-info">
                <div class="comm-label">Notifications sent</div>
                <div class="comm-value">84</div>
              </div>
              <div style="flex:1">
                <div class="comm-bar-outer"><div class="comm-bar-inner" style="width:84%;background:#2563EB"></div></div>
              </div>
            </div>
            <div class="comm-stat-item">
              <div class="comm-icon" style="background:#F0FDF4;color:#16A34A"><i class="fa-solid fa-envelope-open"></i></div>
              <div class="comm-info">
                <div class="comm-label">Newsletters sent</div>
                <div class="comm-value">12</div>
              </div>
              <div style="flex:1">
                <div class="comm-bar-outer"><div class="comm-bar-inner" style="width:60%;background:#16A34A"></div></div>
              </div>
            </div>
            <div class="comm-stat-item">
              <div class="comm-icon" style="background:#FFFBEB;color:#D97706"><i class="fa-solid fa-question-circle"></i></div>
              <div class="comm-info">
                <div class="comm-label">Open Enquiries</div>
                <div class="comm-value">5</div>
              </div>
              <div style="flex:1">
                <div class="comm-bar-outer"><div class="comm-bar-inner" style="width:25%;background:#D97706"></div></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- ── RECENT REGISTRATIONS TABLE ─────────── -->
  <div class="card" style="margin-bottom:24px">
    <div class="card-header">
      <div>
        <div class="card-title">Recent Registrations</div>
        <div class="card-subtitle">Latest 5 submissions across all types</div>
      </div>
      <a class="card-link" href="#">View all →</a>
    </div>
    <div class="card-body" style="padding:0 0 4px">
      <table class="data-table">
        <thead>
          <tr>
            <th>Applicant</th>
            <th>Type</th>
            <th>Category</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><span class="table-avatar" style="background:#2563EB">RK</span>Raj Kumar</td>
            <td>Personal</td>
            <td>Regular Member</td>
            <td>09 Jun 2026</td>
            <td><span class="tag tag-pending">⏳ Pending</span></td>
            <td><a class="card-link" href="#">Review</a></td>
          </tr>
          <tr>
            <td><span class="table-avatar" style="background:#7C3AED">AP</span>Assoc. Pune</td>
            <td>Association</td>
            <td>Chapter</td>
            <td>09 Jun 2026</td>
            <td><span class="tag tag-pending">⏳ Pending</span></td>
            <td><a class="card-link" href="#">Review</a></td>
          </tr>
          <tr>
            <td><span class="table-avatar" style="background:#16A34A">AS</span>Anita Sharma</td>
            <td>Personal</td>
            <td>Life Member</td>
            <td>08 Jun 2026</td>
            <td><span class="tag tag-approved">✓ Approved</span></td>
            <td><a class="card-link" href="#">View</a></td>
          </tr>
          <tr>
            <td><span class="table-avatar" style="background:#0EA5E9">DC</span>Delhi Chapter</td>
            <td>Association</td>
            <td>State Chapter</td>
            <td>07 Jun 2026</td>
            <td><span class="tag tag-approved">✓ Approved</span></td>
            <td><a class="card-link" href="#">View</a></td>
          </tr>
          <tr>
            <td><span class="table-avatar" style="background:#DC2626">MJ</span>Mohit Joshi</td>
            <td>Personal</td>
            <td>Regular Member</td>
            <td>06 Jun 2026</td>
            <td><span class="tag tag-rejected">✕ Rejected</span></td>
            <td><a class="card-link" href="#">View</a></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- ── ACTIVITY + DOCUMENTS ───────────────── -->
  <div class="row row-3-2">

    <div class="card">
      <div class="card-header">
        <div>
          <div class="card-title">Recent Activity</div>
          <div class="card-subtitle">Portal-wide actions log</div>
        </div>
        <a class="card-link" href="#">Full log →</a>
      </div>
      <div class="card-body">
        <div class="activity-list">

          <div class="activity-item">
            <div class="activity-dot" style="background:#EFF6FF;color:#2563EB"><i class="fa-solid fa-user-plus"></i></div>
            <div class="activity-info">
              <div class="activity-text"><strong>New registration</strong> submitted by Raj Kumar (Personal)</div>
              <div class="activity-time">2 hours ago</div>
            </div>
          </div>

          <div class="activity-item">
            <div class="activity-dot" style="background:#F0FDF4;color:#16A34A"><i class="fa-solid fa-certificate"></i></div>
            <div class="activity-info">
              <div class="activity-text">Certificate issued to <strong>Anita Sharma</strong> — Membership</div>
              <div class="activity-time">4 hours ago</div>
            </div>
          </div>

          <div class="activity-item">
            <div class="activity-dot" style="background:#FFFBEB;color:#D97706"><i class="fa-solid fa-calendar-plus"></i></div>
            <div class="activity-info">
              <div class="activity-text">New event <strong>Annual General Meeting</strong> created for Jun 14</div>
              <div class="activity-time">6 hours ago</div>
            </div>
          </div>

          <div class="activity-item">
            <div class="activity-dot" style="background:#F5F3FF;color:#7C3AED"><i class="fa-solid fa-envelope"></i></div>
            <div class="activity-info">
              <div class="activity-text">Newsletter <strong>"June Bulletin"</strong> sent to 840 members</div>
              <div class="activity-time">Yesterday, 4:30 PM</div>
            </div>
          </div>

          <div class="activity-item">
            <div class="activity-dot" style="background:#FEF2F2;color:#DC2626"><i class="fa-solid fa-xmark-circle"></i></div>
            <div class="activity-info">
              <div class="activity-text">Registration of <strong>Mohit Joshi</strong> rejected — incomplete documents</div>
              <div class="activity-time">Yesterday, 2:15 PM</div>
            </div>
          </div>

          <div class="activity-item">
            <div class="activity-dot" style="background:#F0F9FF;color:#0EA5E9"><i class="fa-solid fa-image"></i></div>
            <div class="activity-info">
              <div class="activity-text">12 new images uploaded to album <strong>"Annual Meet 2025"</strong></div>
              <div class="activity-time">Yesterday, 11:00 AM</div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <!-- Documents + CMS quick stats -->
    <div style="display:flex;flex-direction:column;gap:18px">

      <div class="card">
        <div class="card-header">
          <div class="card-title">Documents</div>
          <a class="card-link" href="#">Manage →</a>
        </div>
        <div class="card-body" style="padding-top:14px">
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px">
            <div style="padding:14px;background:var(--bg);border-radius:8px;text-align:center">
              <div style="font-size:24px;font-weight:700;color:#2563EB">18</div>
              <div style="font-size:11px;color:var(--text-muted);margin-top:2px">Reports</div>
            </div>
            <div style="padding:14px;background:var(--bg);border-radius:8px;text-align:center">
              <div style="font-size:24px;font-weight:700;color:#7C3AED">14</div>
              <div style="font-size:11px;color:var(--text-muted);margin-top:2px">Downloads</div>
            </div>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <div class="card-title">CMS Status</div>
          <a class="card-link" href="#">Edit →</a>
        </div>
        <div class="card-body" style="padding-top:14px">
          <div style="display:flex;flex-direction:column;gap:8px">
            <div style="display:flex;justify-content:space-between;align-items:center;font-size:12.5px">
              <span style="color:var(--text-secondary)"><i class="fa-solid fa-house" style="width:16px;color:var(--primary)"></i> Home Page</span>
              <span class="tag tag-approved">Live</span>
            </div>
            <div style="display:flex;justify-content:space-between;align-items:center;font-size:12.5px">
              <span style="color:var(--text-secondary)"><i class="fa-solid fa-circle-info" style="width:16px;color:var(--primary)"></i> About Us</span>
              <span class="tag tag-approved">Live</span>
            </div>
            <div style="display:flex;justify-content:space-between;align-items:center;font-size:12.5px">
              <span style="color:var(--text-secondary)"><i class="fa-solid fa-phone" style="width:16px;color:var(--primary)"></i> Contact Us</span>
              <span class="tag tag-approved">Live</span>
            </div>
            <div style="display:flex;justify-content:space-between;align-items:center;font-size:12.5px">
              <span style="color:var(--text-secondary)"><i class="fa-solid fa-file-lines" style="width:16px;color:var(--warning)"></i> Dynamic Pages</span>
              <span class="tag tag-pending">Draft</span>
            </div>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <div class="card-title">System Health</div>
        </div>
        <div class="card-body" style="padding-top:14px">
          <div style="display:flex;flex-direction:column;gap:10px">
            <div>
              <div style="display:flex;justify-content:space-between;font-size:12px;margin-bottom:5px">
                <span style="color:var(--text-secondary)">Storage</span>
                <span style="font-weight:600;color:var(--text-main)">64%</span>
              </div>
              <div class="comm-bar-outer"><div class="comm-bar-inner" style="width:64%;background:#2563EB"></div></div>
            </div>
            <div>
              <div style="display:flex;justify-content:space-between;font-size:12px;margin-bottom:5px">
                <span style="color:var(--text-secondary)">Email Quota</span>
                <span style="font-weight:600;color:var(--text-main)">38%</span>
              </div>
              <div class="comm-bar-outer"><div class="comm-bar-inner" style="width:38%;background:#16A34A"></div></div>
            </div>
            <div>
              <div style="display:flex;justify-content:space-between;font-size:12px;margin-bottom:5px">
                <span style="color:var(--text-secondary)">DB Usage</span>
                <span style="font-weight:600;color:var(--warning)">81%</span>
              </div>
              <div class="comm-bar-outer"><div class="comm-bar-inner" style="width:81%;background:#D97706"></div></div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

@endsection