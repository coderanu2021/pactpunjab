<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>@yield('title') — PACT Punjab Admin</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
<link href="{{ asset('assets/css/main.css') }}" rel="stylesheet"/>
<style>
/* ── FORM INPUTS (used in modals across all pages) ── */
.form-input {
  width: 100%; padding: 9px 12px;
  border: 1px solid var(--border); border-radius: 8px;
  font-family: var(--font); font-size: 13px; color: var(--text-main);
  background: var(--bg); outline: none; transition: border-color .15s;
  resize: vertical;
}
.form-input:focus { border-color: var(--primary); box-shadow: 0 0 0 3px var(--primary-mid); }
select.form-input { cursor: pointer; }

/* ── MODAL SHARED STYLES ── */
.modal-overlay {
  display: none; position: fixed; inset: 0;
  background: rgba(15,23,42,.45); z-index: 200;
  align-items: center; justify-content: center;
}
.modal-overlay.open { display: flex; }
.modal {
  background: var(--surface); border-radius: 16px;
  width: 600px; max-width: 95vw; max-height: 90vh;
  overflow-y: auto; box-shadow: 0 20px 60px rgba(15,23,42,.18);
}
.modal-header {
  padding: 20px 24px; border-bottom: 1px solid var(--border);
  display: flex; align-items: center; justify-content: space-between;
}
.modal-header h2 { font-size: 16px; font-weight: 700; }
.modal-close {
  width: 32px; height: 32px; border-radius: 8px;
  border: none; background: var(--bg); cursor: pointer;
  font-size: 14px; color: var(--text-secondary);
  display: flex; align-items: center; justify-content: center;
}
.modal-close:hover { background: var(--danger-soft); color: var(--danger); }
.modal-body { padding: 24px; }
.modal-footer {
  padding: 16px 24px; border-top: 1px solid var(--border);
  display: flex; gap: 10px; justify-content: flex-end;
}
.detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
.detail-item label {
  display: block; font-size: 11px; font-weight: 600;
  color: var(--text-muted); text-transform: uppercase;
  letter-spacing: .05em; margin-bottom: 4px;
}
.detail-item p { font-size: 13px; color: var(--text-main); font-weight: 500; }

/* ── ACTION BUTTONS (table rows) ── */
.action-group { display: flex; gap: 6px; }
.icon-btn {
  width: 30px; height: 30px; border-radius: 7px;
  border: none; cursor: pointer;
  display: flex; align-items: center; justify-content: center;
  font-size: 12px; transition: all .15s;
}
.icon-btn.view   { background: var(--primary-soft); color: var(--primary); }
.icon-btn.edit   { background: var(--warning-soft); color: var(--warning); }
.icon-btn.delete { background: var(--danger-soft);  color: var(--danger);  }
.icon-btn:hover  { filter: brightness(.9); }

/* ── FILTERS BAR ── */
.filters-bar { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; flex-wrap: wrap; }
.search-box { position: relative; flex: 1; min-width: 200px; max-width: 320px; }
.search-box i { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 13px; }
.search-box input {
  width: 100%; background: var(--surface); border: 1px solid var(--border);
  border-radius: 8px; padding: 8px 14px 8px 34px;
  font-family: var(--font); font-size: 13px; color: var(--text-main);
  outline: none; transition: border-color .15s;
}
.search-box input:focus { border-color: var(--primary); }
.filter-select {
  background: var(--surface); border: 1px solid var(--border);
  border-radius: 8px; padding: 8px 14px; font-family: var(--font);
  font-size: 13px; color: var(--text-secondary); outline: none; cursor: pointer;
}
.filters-right { margin-left: auto; display: flex; gap: 8px; }

/* ── PAGE HEADER (inner pages) ── */
.page-header {
  display: flex; align-items: flex-start;
  justify-content: space-between; margin-bottom: 28px;
  flex-wrap: wrap; gap: 12px;
}
.page-header h1 { font-size: 22px; font-weight: 700; color: var(--text-main); }
.page-header p  { font-size: 13px; color: var(--text-muted); margin-top: 2px; }
.header-actions { display: flex; gap: 10px; flex-wrap: wrap; align-items: center; }

/* ── CARD HEADER (overrides) ── */
.card-header {
  padding: 18px 20px; display: flex; align-items: center;
  justify-content: space-between; border-bottom: 1px solid var(--border);
}
.card-title    { font-size: 14px; font-weight: 600; color: var(--text-main); }
.card-subtitle { font-size: 12px; color: var(--text-muted); margin-top: 1px; }
.card-link     { font-size: 12px; font-weight: 500; color: var(--primary); text-decoration: none; }
.card-link:hover { text-decoration: underline; }

/* ── USER CELL ── */
.user-name  { font-weight: 500; font-size: 13px; color: var(--text-main); }
.user-email { font-size: 11px; color: var(--text-muted); }
</style>
</head>
<body>

<!-- ── SIDEBAR ────────────────────────────────── -->
<aside id="sidebar">
  <div class="sidebar-logo">
    <div class="logo-icon"><i class="fa-solid fa-shield-halved"></i></div>
    <div class="logo-text">PACT Punjab <span>Admin Portal</span></div>
  </div>

  <nav class="sidebar-nav">

    <!-- Dashboard -->
    <div class="nav-group">
      <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fa-solid fa-gauge-high"></i></span>
        Dashboard
      </a>
    </div>

    <!-- Registration -->
    <div class="nav-group {{ request()->routeIs('admin.registration.*') ? 'open' : '' }}" onclick="toggleGroup(this)">
      <div class="nav-item {{ request()->routeIs('admin.registration.*') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fa-solid fa-file-pen"></i></span>
        Registrations
        <i class="fa-solid fa-chevron-right arrow"></i>
      </div>
      <div class="nav-sub">
        <a href="{{ route('admin.registration.personal') }}"    class="nav-item {{ request()->routeIs('admin.registration.personal')    ? 'active' : '' }}">Personal Registrations</a>
        <a href="{{ route('admin.registration.association') }}" class="nav-item {{ request()->routeIs('admin.registration.association') ? 'active' : '' }}">Association Registrations</a>
        <a href="{{ route('admin.registration.pending') }}"    class="nav-item {{ request()->routeIs('admin.registration.pending')    ? 'active' : '' }}">Pending Approvals</a>
        <a href="{{ route('admin.registration.approved') }}"   class="nav-item {{ request()->routeIs('admin.registration.approved')   ? 'active' : '' }}">Approved</a>
        <a href="{{ route('admin.registration.rejected') }}"   class="nav-item {{ request()->routeIs('admin.registration.rejected')   ? 'active' : '' }}">Rejected</a>
      </div>
    </div>

    <!-- Certificates -->
    <div class="nav-group {{ request()->routeIs('admin.certificates.*') ? 'open' : '' }}" onclick="toggleGroup(this)">
      <div class="nav-item {{ request()->routeIs('admin.certificates.*') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fa-solid fa-certificate"></i></span>
        Certificates
        <i class="fa-solid fa-chevron-right arrow"></i>
      </div>
      <div class="nav-sub">
        <a href="{{ route('admin.certificates.templates') }}"    class="nav-item {{ request()->routeIs('admin.certificates.templates')    ? 'active' : '' }}">Templates</a>
        <a href="{{ route('admin.certificates.personal') }}"     class="nav-item {{ request()->routeIs('admin.certificates.personal')     ? 'active' : '' }}">Personal Certificates</a>
        <a href="{{ route('admin.certificates.association') }}"  class="nav-item {{ request()->routeIs('admin.certificates.association')  ? 'active' : '' }}">Association Certificates</a>
        <a href="{{ route('admin.certificates.generated') }}"    class="nav-item {{ request()->routeIs('admin.certificates.generated')    ? 'active' : '' }}">Generate Certificate</a>
        <a href="{{ route('admin.certificates.verification') }}" class="nav-item {{ request()->routeIs('admin.certificates.verification') ? 'active' : '' }}">Verification</a>
      </div>
    </div>

    <!-- Members -->
    <div class="nav-group {{ request()->routeIs('admin.members.*') ? 'open' : '' }}" onclick="toggleGroup(this)">
      <div class="nav-item {{ request()->routeIs('admin.members.*') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fa-solid fa-users"></i></span>
        Members
        <i class="fa-solid fa-chevron-right arrow"></i>
      </div>
      <div class="nav-sub">
        <a href="{{ route('admin.members.index') }}"      class="nav-item {{ request()->routeIs('admin.members.index')      ? 'active' : '' }}">All Members</a>
        <a href="{{ route('admin.members.categories') }}" class="nav-item {{ request()->routeIs('admin.members.categories') ? 'active' : '' }}">Member Categories</a>
      </div>
    </div>

    <!-- Events -->
    <div class="nav-group {{ request()->routeIs('admin.events.*') ? 'open' : '' }}" onclick="toggleGroup(this)">
      <div class="nav-item {{ request()->routeIs('admin.events.*') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fa-solid fa-calendar-days"></i></span>
        Events
        <i class="fa-solid fa-chevron-right arrow"></i>
      </div>
      <div class="nav-sub">
        <a href="{{ route('admin.events.index') }}"         class="nav-item {{ request()->routeIs('admin.events.index')         ? 'active' : '' }}">All Events</a>
        <a href="{{ route('admin.events.registrations') }}" class="nav-item {{ request()->routeIs('admin.events.registrations') ? 'active' : '' }}">Event Registrations</a>
      </div>
    </div>

    <!-- Gallery -->
    <div class="nav-group {{ request()->routeIs('admin.gallery.*') ? 'open' : '' }}" onclick="toggleGroup(this)">
      <div class="nav-item {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fa-solid fa-images"></i></span>
        Gallery
        <i class="fa-solid fa-chevron-right arrow"></i>
      </div>
      <div class="nav-sub">
        <a href="{{ route('admin.gallery.albums') }}" class="nav-item {{ request()->routeIs('admin.gallery.albums') ? 'active' : '' }}">Albums</a>
        <a href="{{ route('admin.gallery.images') }}" class="nav-item {{ request()->routeIs('admin.gallery.images') ? 'active' : '' }}">Images</a>
      </div>
    </div>

    <!-- Communication -->
    <div class="nav-group {{ request()->routeIs('admin.communication.*') ? 'open' : '' }}" onclick="toggleGroup(this)">
      <div class="nav-item {{ request()->routeIs('admin.communication.*') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fa-solid fa-bell"></i></span>
        Communication
        <i class="fa-solid fa-chevron-right arrow"></i>
      </div>
      <div class="nav-sub">
        <a href="{{ route('admin.communication.notifications') }}" class="nav-item {{ request()->routeIs('admin.communication.notifications') ? 'active' : '' }}">Notifications</a>
        <a href="{{ route('admin.communication.circulars') }}"     class="nav-item {{ request()->routeIs('admin.communication.circulars')     ? 'active' : '' }}">Circulars</a>
        <a href="{{ route('admin.communication.newsletter') }}"    class="nav-item {{ request()->routeIs('admin.communication.newsletter')    ? 'active' : '' }}">Newsletter</a>
        <a href="{{ route('admin.communication.enquiries') }}"     class="nav-item {{ request()->routeIs('admin.communication.enquiries')     ? 'active' : '' }}">Enquiries</a>
      </div>
    </div>

    <!-- Documents -->
    <div class="nav-group {{ request()->routeIs('admin.documents.*') ? 'open' : '' }}" onclick="toggleGroup(this)">
      <div class="nav-item {{ request()->routeIs('admin.documents.*') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fa-solid fa-folder-open"></i></span>
        Documents
        <i class="fa-solid fa-chevron-right arrow"></i>
      </div>
      <div class="nav-sub">
        <a href="{{ route('admin.documents.reports') }}"   class="nav-item {{ request()->routeIs('admin.documents.reports')   ? 'active' : '' }}">Reports</a>
        <a href="{{ route('admin.documents.downloads') }}" class="nav-item {{ request()->routeIs('admin.documents.downloads') ? 'active' : '' }}">Downloads</a>
      </div>
    </div>

    <!-- CMS -->
    <div class="nav-group {{ request()->routeIs('admin.cms.*') ? 'open' : '' }}" onclick="toggleGroup(this)">
      <div class="nav-item {{ request()->routeIs('admin.cms.*') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fa-solid fa-layer-group"></i></span>
        CMS Management
        <i class="fa-solid fa-chevron-right arrow"></i>
      </div>
      <div class="nav-sub">
        <a href="{{ route('admin.cms.home') }}"    class="nav-item {{ request()->routeIs('admin.cms.home')    ? 'active' : '' }}">Home Page</a>
        <a href="{{ route('admin.cms.about') }}"   class="nav-item {{ request()->routeIs('admin.cms.about')   ? 'active' : '' }}">About Us</a>
        <a href="{{ route('admin.cms.contact') }}" class="nav-item {{ request()->routeIs('admin.cms.contact') ? 'active' : '' }}">Contact Us</a>
        <a href="{{ route('admin.cms.dynamic') }}" class="nav-item {{ request()->routeIs('admin.cms.dynamic') ? 'active' : '' }}">Dynamic Pages</a>
      </div>
    </div>

    <!-- Settings -->
    <div class="nav-group {{ request()->routeIs('admin.settings.*') ? 'open' : '' }}" onclick="toggleGroup(this)">
      <div class="nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fa-solid fa-gear"></i></span>
        Settings
        <i class="fa-solid fa-chevron-right arrow"></i>
      </div>
      <div class="nav-sub">
        <a href="{{ route('admin.settings.website') }}" class="nav-item {{ request()->routeIs('admin.settings.website') ? 'active' : '' }}">Website Settings</a>
        <a href="{{ route('admin.settings.email') }}"   class="nav-item {{ request()->routeIs('admin.settings.email')   ? 'active' : '' }}">Email Settings</a>
        <a href="{{ route('admin.settings.general') }}" class="nav-item {{ request()->routeIs('admin.settings.general') ? 'active' : '' }}">General Settings</a>
      </div>
    </div>

  </nav>

  <div class="sidebar-footer">
    <div class="user-avatar">{{ auth()->check() ? strtoupper(substr(auth()->user()->name, 0, 2)) : 'AD' }}</div>
    <div class="user-info">
      <strong>{{ auth()->check() ? auth()->user()->name : 'Admin' }}</strong>
      <span>{{ auth()->check() ? auth()->user()->email : '' }}</span>
    </div>
    <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
      @csrf
      <button type="submit" style="background:none;border:none;padding:0;cursor:pointer;" title="Logout">
        <i class="fa-solid fa-right-from-bracket logout-btn"></i>
      </button>
    </form>
  </div>
</aside>

<!-- ── TOPBAR ─────────────────────────────────── -->
<header id="topbar">
  <button class="hamburger" onclick="toggleSidebar()"><i class="fa-solid fa-bars"></i></button>
  <div class="topbar-title">@yield('title') <span>/ PACT Punjab</span></div>
  <div class="topbar-search">
    <i class="fa-solid fa-magnifying-glass"></i>
    <input type="text" placeholder="Search anything…"/>
  </div>
  <div class="topbar-actions">
    <button class="action-btn" title="Notifications">
      <i class="fa-solid fa-bell"></i><span class="dot"></span>
    </button>
    <button class="action-btn" title="Messages">
      <i class="fa-solid fa-envelope"></i>
    </button>
    <a href="{{ route('admin.settings.website') }}" class="action-btn" title="Settings" style="text-decoration:none">
      <i class="fa-solid fa-gear"></i>
    </a>
  </div>
</header>

<!-- ── MAIN CONTENT ───────────────────────────── -->
<main id="main">
@yield('content')
</main>

@yield('script')

<script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
