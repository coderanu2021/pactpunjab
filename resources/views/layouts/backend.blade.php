<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>@yield('title')</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
<link href="{{ asset('assets/css/main.css') }}" rel="stylesheet"/>

</head>
<body>

<!-- ── SIDEBAR ────────────────────────────────── -->
<aside id="sidebar">
  <div class="sidebar-logo">
    <div class="logo-icon"><i class="fa-solid fa-shield-halved"></i></div>
    <div class="logo-text">AdminPortal <span>Management System</span></div>
  </div>

  <nav class="sidebar-nav">

    <!-- Dashboard -->
    <div class="nav-group">
      <a class="nav-item active">
        <span class="nav-icon"><i class="fa-solid fa-gauge-high"></i></span>
        Dashboard
      </a>
    </div>

  
    <!-- Registration -->
    <div class="nav-group" onclick="toggleGroup(this)">
      <div class="nav-item">
        <span class="nav-icon"><i class="fa-solid fa-file-pen"></i></span>
        Registration
        <span class="nav-badge warning">12</span>
        <i class="fa-solid fa-chevron-right arrow"></i>
      </div>
      <div class="nav-sub">
        <a class="nav-item">Personal Registrations</a>
        <a class="nav-item">Association Registrations</a>
        <a class="nav-item">Pending Approvals <span class="nav-badge warning" style="font-size:9px">8</span></a>
        <a class="nav-item">Approved Registrations</a>
        <a class="nav-item">Rejected Registrations</a>
      </div>
    </div>

    <!-- Certificates -->
    <div class="nav-group" onclick="toggleGroup(this)">
      <div class="nav-item">
        <span class="nav-icon"><i class="fa-solid fa-certificate"></i></span>
        Certificates
        <i class="fa-solid fa-chevron-right arrow"></i>
      </div>
      <div class="nav-sub">
        <a class="nav-item">Certificate Templates</a>
        <a class="nav-item">Personal Certificates</a>
        <a class="nav-item">Association Certificates</a>
        <a class="nav-item">Generated Certificates</a>
        <a class="nav-item">Certificate Verification</a>
      </div>
    </div>

    <!-- Members -->
    <div class="nav-group" onclick="toggleGroup(this)">
      <div class="nav-item">
        <span class="nav-icon"><i class="fa-solid fa-users"></i></span>
        Members
        <i class="fa-solid fa-chevron-right arrow"></i>
      </div>
      <div class="nav-sub">
        <a class="nav-item">Members</a>
        <a class="nav-item">Member Categories</a>
      </div>
    </div>

    <!-- Events -->
    <div class="nav-group" onclick="toggleGroup(this)">
      <div class="nav-item">
        <span class="nav-icon"><i class="fa-solid fa-calendar-days"></i></span>
        Events
        <i class="fa-solid fa-chevron-right arrow"></i>
      </div>
      <div class="nav-sub">
        <a class="nav-item">Events</a>
        <a class="nav-item">Event Registrations</a>
      </div>
    </div>

    <!-- Gallery -->
    <div class="nav-group" onclick="toggleGroup(this)">
      <div class="nav-item">
        <span class="nav-icon"><i class="fa-solid fa-images"></i></span>
        Gallery
        <i class="fa-solid fa-chevron-right arrow"></i>
      </div>
      <div class="nav-sub">
        <a class="nav-item">Albums</a>
        <a class="nav-item">Images</a>
      </div>
    </div>

    <!-- Communication -->
    <div class="nav-group" onclick="toggleGroup(this)">
      <div class="nav-item">
        <span class="nav-icon"><i class="fa-solid fa-bell"></i></span>
        Communication
        <span class="nav-badge">5</span>
        <i class="fa-solid fa-chevron-right arrow"></i>
      </div>
      <div class="nav-sub">
        <a class="nav-item">Notifications</a>
        <a class="nav-item">Circulars</a>
        <a class="nav-item">Newsletter</a>
        <a class="nav-item">Enquiries <span class="nav-badge" style="font-size:9px">5</span></a>
      </div>
    </div>

    <!-- Documents -->
    <div class="nav-group" onclick="toggleGroup(this)">
      <div class="nav-item">
        <span class="nav-icon"><i class="fa-solid fa-folder-open"></i></span>
        Documents
        <i class="fa-solid fa-chevron-right arrow"></i>
      </div>
      <div class="nav-sub">
        <a class="nav-item">Reports</a>
        <a class="nav-item">Downloads</a>
      </div>
    </div>

    <!-- CMS -->
    <div class="nav-group" onclick="toggleGroup(this)">
      <div class="nav-item">
        <span class="nav-icon"><i class="fa-solid fa-layer-group"></i></span>
        CMS Management
        <i class="fa-solid fa-chevron-right arrow"></i>
      </div>
      <div class="nav-sub">
        <a class="nav-item">Home Page</a>
        <a class="nav-item">About Us</a>
        <a class="nav-item">Contact Us</a>
        <a class="nav-item">Dynamic Pages</a>
      </div>
    </div>

    <!-- Settings -->
    <div class="nav-group" onclick="toggleGroup(this)">
      <div class="nav-item">
        <span class="nav-icon"><i class="fa-solid fa-gear"></i></span>
        Settings
        <i class="fa-solid fa-chevron-right arrow"></i>
      </div>
      <div class="nav-sub">
        <a class="nav-item">Website Settings</a>
        <a class="nav-item">Email Settings</a>
        <a class="nav-item">General Settings</a>
      </div>
    </div>

  </nav>

  <div class="sidebar-footer">
    <div class="user-avatar">SA</div>
    <div class="user-info">
      <strong>Super Admin</strong>
      <span>admin@portal.com</span>
    </div>
    <i class="fa-solid fa-right-from-bracket logout-btn"></i>
  </div>
</aside>

<!-- ── TOPBAR ─────────────────────────────────── -->
<header id="topbar">
  <button class="hamburger" onclick="toggleSidebar()"><i class="fa-solid fa-bars"></i></button>
  <div class="topbar-title">Dashboard <span>/ Overview</span></div>
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
    <button class="action-btn" title="Profile">
      <i class="fa-solid fa-user"></i>
    </button>
  </div>
</header>

@yield('content')
<!-- ── MAIN ───────────────────────────────────── -->

@yield('script')

<script src="{{ asset('assets/js/main.js') }}"> </script>
</body>
</html>
