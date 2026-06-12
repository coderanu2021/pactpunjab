@extends('layouts.backend')
@section('title', 'Home Page — CMS')

@section('content')

<div class="page-header">
  <div>
    <h1><i class="fa-solid fa-house" style="color:var(--primary);margin-right:8px"></i>Home Page</h1>
    <p>Edit the content sections of the website's home page.</p>
  </div>
  <div class="header-actions">
    <span class="tag tag-approved" style="padding:6px 14px;font-size:12px"><i class="fa-solid fa-circle-dot"></i> Live</span>
    <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save Changes</button>
  </div>
</div>

<!-- Section cards -->
<div style="display:grid;grid-template-columns:1fr 1fr;gap:18px">

  <!-- Hero Section -->
  <div class="card" style="grid-column:1/-1">
    <div class="card-header" style="border-bottom:1px solid var(--border);padding:16px 20px">
      <div>
        <div class="card-title"><i class="fa-solid fa-star" style="color:var(--warning);margin-right:6px"></i>Hero / Banner Section</div>
        <div class="card-subtitle">Main hero banner at the top of the home page</div>
      </div>
      <span class="tag tag-approved">Active</span>
    </div>
    <div style="padding:20px;display:grid;grid-template-columns:1fr 1fr;gap:16px">
      <div>
        <label class="cms-label">Hero Title</label>
        <input type="text" class="cms-input" value="Punjab Association of Computer Traders" placeholder="Hero title…"/>
      </div>
      <div>
        <label class="cms-label">Hero Sub-title</label>
        <input type="text" class="cms-input" value="Empowering Technology Businesses" placeholder="Sub-title…"/>
      </div>
      <div style="grid-column:1/-1">
        <label class="cms-label">Hero Description</label>
        <textarea class="cms-input" rows="3" placeholder="Brief introductory text for the hero section…">PACT Punjab connects and supports computer traders across Punjab, driving growth through association, certification, and community.</textarea>
      </div>
      <div>
        <label class="cms-label">CTA Button Text</label>
        <input type="text" class="cms-input" value="Register Now" placeholder="Button label…"/>
      </div>
      <div>
        <label class="cms-label">CTA Button Link</label>
        <input type="text" class="cms-input" value="/registration-certificate" placeholder="/page-link"/>
      </div>
    </div>
  </div>

  <!-- About Snippet -->
  <div class="card">
    <div class="card-header" style="border-bottom:1px solid var(--border);padding:16px 20px">
      <div>
        <div class="card-title"><i class="fa-solid fa-circle-info" style="color:var(--primary);margin-right:6px"></i>About Snippet</div>
        <div class="card-subtitle">Short about section on home page</div>
      </div>
    </div>
    <div style="padding:20px;display:flex;flex-direction:column;gap:14px">
      <div>
        <label class="cms-label">Section Title</label>
        <input type="text" class="cms-input" value="About PACT Punjab"/>
      </div>
      <div>
        <label class="cms-label">Content</label>
        <textarea class="cms-input" rows="4" placeholder="About text…">Founded in 1996, PACT Punjab is the leading association for computer traders in Punjab, providing certification, training, and networking opportunities.</textarea>
      </div>
    </div>
  </div>

  <!-- Stats Section -->
  <div class="card">
    <div class="card-header" style="border-bottom:1px solid var(--border);padding:16px 20px">
      <div>
        <div class="card-title"><i class="fa-solid fa-chart-bar" style="color:var(--success);margin-right:6px"></i>Stats / Counter Section</div>
        <div class="card-subtitle">Numbers displayed on the home page</div>
      </div>
    </div>
    <div style="padding:20px;display:grid;grid-template-columns:1fr 1fr;gap:12px">
      <div><label class="cms-label">Members Count</label><input type="text" class="cms-input" value="4,832+"/></div>
      <div><label class="cms-label">Members Label</label><input type="text" class="cms-input" value="Registered Members"/></div>
      <div><label class="cms-label">Years Count</label><input type="text" class="cms-input" value="28+"/></div>
      <div><label class="cms-label">Years Label</label><input type="text" class="cms-input" value="Years of Service"/></div>
      <div><label class="cms-label">Events Count</label><input type="text" class="cms-input" value="200+"/></div>
      <div><label class="cms-label">Events Label</label><input type="text" class="cms-input" value="Events Organised"/></div>
    </div>
  </div>

  <!-- Contact Strip -->
  <div class="card" style="grid-column:1/-1">
    <div class="card-header" style="border-bottom:1px solid var(--border);padding:16px 20px">
      <div>
        <div class="card-title"><i class="fa-solid fa-phone" style="color:var(--primary);margin-right:6px"></i>Contact Strip</div>
        <div class="card-subtitle">Contact information shown in the footer strip</div>
      </div>
    </div>
    <div style="padding:20px;display:grid;grid-template-columns:1fr 1fr 1fr;gap:14px">
      <div><label class="cms-label">Phone Number</label><input type="text" class="cms-input" value="+91 98765 43210"/></div>
      <div><label class="cms-label">Email Address</label><input type="text" class="cms-input" value="info@pactpunjab.in"/></div>
      <div><label class="cms-label">Address</label><input type="text" class="cms-input" value="Ludhiana, Punjab"/></div>
    </div>
  </div>

</div>

<div style="display:flex;justify-content:flex-end;margin-top:20px;gap:10px">
  <button class="btn btn-outline">Reset</button>
  <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save All Changes</button>
</div>

@endsection

@section('script')
<style>
.cms-label { display:block;font-size:11px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:5px }
.cms-input { width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:8px;font-family:var(--font);font-size:13px;color:var(--text-main);outline:none;background:var(--bg);resize:vertical;transition:border-color .15s }
.cms-input:focus { border-color:var(--primary) }
</style>
@endsection
