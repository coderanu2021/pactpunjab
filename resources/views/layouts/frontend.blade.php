

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title')</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link href="{{ asset('assets/css/frontend/main.css')}}" rel="stylesheet">
<link href="{{ asset('assets/css/frontend/common.css')}}" rel="stylesheet">


</head>
<body>

<!-- TOPBAR -->
<div class="topbar">
  <div class="ticker-wrap">
    <div class="ticker">
      <span><span class="tick-dot"></span><a href="#">Register for PACT Annual Meet 2025 — Punjab IT Mahakumbh →</a></span>
      <span><span class="tick-dot"></span>New Office Bearers elected &nbsp;|&nbsp; PACT Annual Meeting Concluded</span>
      <span><span class="tick-dot"></span><a href="#">GST Circular: 2FA mandatory for turnover above ₹100Cr from July 2023 →</a></span>
      <span><span class="tick-dot"></span><a href="#">Register for PACT Annual Meet 2025 — Punjab IT Mahakumbh →</a></span>
      <span><span class="tick-dot"></span>New Office Bearers elected &nbsp;|&nbsp; PACT Annual Meeting Concluded</span>
      <span><span class="tick-dot"></span><a href="#">GST Circular: 2FA mandatory for turnover above ₹100Cr from July 2023 →</a></span>
    </div>
  </div>
  <div class="topbar-right">
    <a href="tel:+916290910140"><i class="fas fa-phone-alt"></i> +91 94172-23355</a>
    <a href="/cdn-cgi/l/email-protection#442d2a222b043425273034312a2e25266a272b29"><i class="fas fa-envelope"></i> <span class="__cf_email__" data-cfemail="82ebece4edc2f2e3e1f6f2f7ece8e3e0ace1edef">[email&#160;protected]</span></a>
  </div>
</div>

<!-- ANNOUNCEMENT -->
<div class="announcement">
  <div class="ann-left">
    <span class="ann-badge">🔥 Live</span>
    <span class="ann-text">PACT Annual Meet 2025 — <strong>Punjab IT Mahakumbh</strong> — Registration Open Now!</span>
  </div>
  <button class="ann-btn">Register Now →</button>
</div>

<!-- HEADER -->
<header class="header">
  <div class="header-inner">
    <a href="#" class="logo">
      <div class="logo-icon">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 3v18M3 12h18M6.34 6.34l11.32 11.32M17.66 6.34L6.34 17.66"/></svg>
      </div>
      <div class="logo-words">
        <strong>P A C T</strong>
        <span>Punjab & Chandigarh IT Association</span>
      </div>
    </a>

    <nav>
      <div class="nav-item active">
        <a class="nav-link" href="#">Home</a>
      </div>
      <div class="nav-item">
        <div class="nav-link">About Us <i class="fas fa-chevron-down chevron"></i></div>
        <div class="dropdown">
          <a href="{{ route('profile') }}"><i class="fas fa-user-circle"></i> Profile</a>
          <a href="{{ route('aim-objective') }}"><i class="fas fa-bullseye"></i> Aim &amp; Objectives</a>
          <a href="{{ route('activities-services') }}"><i class="fas fa-cogs"></i> Activities &amp; Services</a>
          <a href="{{ route('intrest-group') }}"><i class="fas fa-layer-group"></i> Special Interest Groups</a>
          <div class="dd-divider"></div>
          <a href="{{ route('awards-recognition') }}"><i class="fas fa-award"></i> Awards &amp; Recognition</a>
          <a href="{{ route('annual-reports') }}"><i class="fas fa-file-alt"></i> Annual Reports</a>
          <a href="#"><i class="fas fa-map-marker-alt"></i> Contact Us</a>
        </div>
      </div>
      <div class="nav-item">
        <div class="nav-link">Management <i class="fas fa-chevron-down chevron"></i></div>
        <div class="dropdown">
          <a href="{{ route('office-bearers') }}"><i class="fas fa-id-badge"></i> Office Bearers</a>
          <a href="{{ route('executive-committee') }}"><i class="fas fa-users"></i> Executive Committee</a>
          <a href="{{ route('special-invitees') }}"><i class="fas fa-star"></i> Special Invitees</a>
          <a href="{{ route('sub-committees') }}"><i class="fas fa-sitemap"></i> Sub Committees</a>
          <a href="{{ route('advisory-board') }}"><i class="fas fa-chalkboard-teacher"></i> Advisory Board</a>
          <a href="#"><i class="fas fa-history"></i> Past Presidents</a>
        </div>
      </div>
      <div class="nav-item">
        <div class="nav-link">Members <i class="fas fa-chevron-down chevron"></i></div>
        <div class="dropdown">
          <a href="{{ route('become-member') }}"><i class="fas fa-user-plus"></i> Become a Member</a>
          <a href="#"><i class="fas fa-address-book"></i> Members Directory</a>
          <a href="#"><i class="fas fa-bell"></i> Member Circulars</a>
          <a href="#"><i class="fas fa-newspaper"></i> Newsletter</a>
          <a href="{{ route('downloads') }}"><i class="fas fa-download"></i> Downloads</a>
        </div>
      </div>
      <div class="nav-item">
        <div class="nav-link">Activities <i class="fas fa-chevron-down chevron"></i></div>
        <div class="dropdown">
          <a href="{{ route('events') }}"><i class="fas fa-calendar-alt"></i> Events</a>
          <a href="{{ route('gallery') }}"><i class="fas fa-images"></i> Photo Gallery</a>
          <a href="#"><i class="fas fa-chalkboard"></i> Seminars &amp; Workshop</a>
          <a href="#"><i class="fas fa-cricket"></i> PACT Sports Events</a>
          <a href="#"><i class="fas fa-handshake"></i> Fellowship Meets</a>
          <a href="#"><i class="fas fa-heart"></i> CSR Activities</a>
        </div>
      </div>
      <div class="nav-item">
        <div class="nav-link">Services <i class="fas fa-chevron-down chevron"></i></div>
        <div class="dropdown">
          <a href="#"><i class="fas fa-bell"></i> Circulars &amp; Notifications</a>
          <a href="#"><i class="fas fa-gavel"></i> Grievance Cell</a>
          <a href="#"><i class="fas fa-building"></i> Conference Hall</a>
          <a href="#"><i class="fas fa-receipt"></i> GST &amp; Legal Helpdesk</a>
          <a href="#"><i class="fas fa-comment-dots"></i> Appeal &amp; Advisory</a>
        </div>
      </div>
      <div class="nav-item">
        <div class="nav-link">Press <i class="fas fa-chevron-down chevron"></i></div>
        <div class="dropdown">
          <a href="#"><i class="fas fa-newspaper"></i> Press Release</a>
          <a href="#"><i class="fas fa-tv"></i> Media Coverage</a>
          <a href="#"><i class="fas fa-briefcase"></i> Media Kit</a>
        </div>
      </div>
    </nav>

    <div class="header-actions">
      <a href="{{ route('login') }}" class="btn-outline-sm" style="text-decoration:none; display:inline-flex; align-items:center;">Member Login</a>
      <a href="{{ route('become-member') }}" class="btn-cta" style="text-decoration:none;">Join P A C T <i class="fas fa-arrow-right" style="font-size:11px"></i></a>
    </div>
  </div>
</header>

<main>
    @yield('content')
</main>

<!-- FOOTER -->
<footer>
  <div class="footer-main">
    <div class="fbrand">
      <div class="logo">
        <div class="logo-icon" style="width:46px;height:46px;border-radius:12px;background:linear-gradient(140deg,#1E50A2,#07111F);display:flex;align-items:center;justify-content:center;flex-shrink:0">
          <svg viewBox="0 0 24 24" style="width:24px;height:24px;fill:none;stroke:#fff;stroke-width:1.8"><circle cx="12" cy="12" r="9"/><path d="M12 3v18M3 12h18"/></svg>
        </div>
        <div class="logo-words">
          <strong style="display:block;font-size:15px;font-weight:800;color:#fff">P A C T</strong>
          <span style="font-size:10px;color:rgba(255,255,255,.35)">Punjab & Chandigarh IT Association</span>
        </div>
      </div>
      <p>Fostering the sustainable growth of the IT industry in Punjab & Chandigarh since 1996. The voice of IT entrepreneurs across the region — connecting, advocating, and enabling growth.</p>
      <div class="fsocials">
        <a href="#" class="fsoc"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="fsoc"><i class="fab fa-youtube"></i></a>
        <a href="#" class="fsoc"><i class="fab fa-linkedin-in"></i></a>
        <a href="#" class="fsoc"><i class="fab fa-twitter"></i></a>
      </div>
    </div>
    <div class="fcol">
      <h6>About</h6>
      <ul>
        <li><a href="#"><i class="fas fa-chevron-right"></i>Profile</a></li>
        <li><a href="#"><i class="fas fa-chevron-right"></i>Aim &amp; Objectives</a></li>
        <li><a href="#"><i class="fas fa-chevron-right"></i>Activities</a></li>
        <li><a href="#"><i class="fas fa-chevron-right"></i>Awards</a></li>
        <li><a href="#"><i class="fas fa-chevron-right"></i>Annual Reports</a></li>
        <li><a href="#"><i class="fas fa-chevron-right"></i>Contact Us</a></li>
      </ul>
    </div>
    <div class="fcol">
      <h6>Members</h6>
      <ul>
        <li><a href="{{ route('become-member') }}"><i class="fas fa-chevron-right"></i>Become a Member</a></li>
        <li><a href="#"><i class="fas fa-chevron-right"></i>Directory</a></li>
        <li><a href="#"><i class="fas fa-chevron-right"></i>Newsletter</a></li>
        <li><a href="{{ route('downloads') }}"><i class="fas fa-chevron-right"></i>Downloads</a></li>
        <li><a href="#"><i class="fas fa-chevron-right"></i>President's Message</a></li>
      </ul>
    </div>
    <div class="fcol">
      <h6>Activities</h6>
      <ul>
        <li><a href="{{ route('events') }}"><i class="fas fa-chevron-right"></i>Events</a></li>
        <li><a href="{{ route('gallery') }}"><i class="fas fa-chevron-right"></i>Gallery</a></li>
        <li><a href="#"><i class="fas fa-chevron-right"></i>Seminars</a></li>
        <li><a href="#"><i class="fas fa-chevron-right"></i>Premier League</a></li>
        <li><a href="#"><i class="fas fa-chevron-right"></i>Fellowship Meets</a></li>
        <li><a href="#"><i class="fas fa-chevron-right"></i>CSR Activities</a></li>
      </ul>
    </div>
    <div class="fcol">
      <h6>Services</h6>
      <ul>
        <li><a href="#"><i class="fas fa-chevron-right"></i>Notifications</a></li>
        <li><a href="#"><i class="fas fa-chevron-right"></i>Grievance Cell</a></li>
        <li><a href="#"><i class="fas fa-chevron-right"></i>GST Helpdesk</a></li>
        <li><a href="#"><i class="fas fa-chevron-right"></i>Conference Hall</a></li>
        <li><a href="#"><i class="fas fa-chevron-right"></i>Press / Media</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-divider"></div>
  <div class="footer-bot">
    <p>© 2026 P A C T — Computer Association of Punjab & Chandigarh. All rights reserved. | Punjab & Chandigarh Region</p>
    <div class="footer-bot-links">
      <a href="#">Privacy Policy</a>
      <a href="#">Terms &amp; Conditions</a>
      <a href="#">Payment Policy</a>
      <a href="#">Refund Policy</a>
    </div>
  </div>
</footer>
<script src="{{asset('assets/css/frontend/js/main.js')}}"> </script>
<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script defer src="https://static.cloudflareinsights.com/beacon.min.js/v833ccba57c9e4d2798f2e76cebdd09a11778172276447" integrity="sha512-57MDmcccJXYtNnH+ZiBwzC4jb2rvgVCEokYN+L/nLlmO8rfYT/gIpW2A569iJ/3b+0UEasghjuZH/ma3wIs/EQ==" data-cf-beacon='{"version":"2024.11.0","token":"79983e1b26f14ddbb98c6c2ab1562988","r":1,"server_timing":{"name":{"cfCacheStatus":true,"cfEdge":true,"cfExtPri":true,"cfL4":true,"cfOrigin":true,"cfSpeedBrain":true},"location_startswith":null}}' crossorigin="anonymous"></script>
</body>
</html>

