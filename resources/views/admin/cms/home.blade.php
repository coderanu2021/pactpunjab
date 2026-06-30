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
    <button form="cms-home-form" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save Changes</button>
  </div>
</div>

<form id="cms-home-form" action="{{ route('admin.cms.settings.update') }}" method="POST">
  @csrf

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
        <input type="text" name="home_hero_title" class="cms-input" value="{{ $settings['home_hero_title'] ?? 'Punjab Association of Computer Traders' }}" placeholder="Hero title…"/>
      </div>
      <div>
        <label class="cms-label">Hero Sub-title</label>
        <input type="text" name="home_hero_subtitle" class="cms-input" value="{{ $settings['home_hero_subtitle'] ?? 'Empowering Technology Businesses' }}" placeholder="Sub-title…"/>
      </div>
      <div style="grid-column:1/-1">
        <label class="cms-label">Hero Description</label>
        <textarea name="home_hero_desc" class="cms-input" rows="3" placeholder="Brief introductory text for the hero section…">{{ $settings['home_hero_desc'] ?? 'PACT Punjab connects and supports computer traders across Punjab, driving growth through association, certification, and community.' }}</textarea>
      </div>
      <div>
        <label class="cms-label">CTA Button Text</label>
        <input type="text" name="home_hero_cta_text" class="cms-input" value="{{ $settings['home_hero_cta_text'] ?? 'Register Now' }}" placeholder="Button label…"/>
      </div>
      <div>
        <label class="cms-label">CTA Button Link</label>
        <input type="text" name="home_hero_cta_link" class="cms-input" value="{{ $settings['home_hero_cta_link'] ?? '/registration-certificate' }}" placeholder="/page-link"/>
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
        <input type="text" name="home_about_title" class="cms-input" value="{{ $settings['home_about_title'] ?? 'About PACT Punjab' }}"/>
      </div>
      <div>
        <label class="cms-label">Content</label>
        <textarea name="home_about_desc" class="cms-input" rows="4" placeholder="About text…">{{ $settings['home_about_desc'] ?? 'Founded in 1996, PACT Punjab is the leading association for computer traders in Punjab, providing certification, training, and networking opportunities.' }}</textarea>
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
      <div><label class="cms-label">Members Count</label><input type="text" name="home_stat1_count" class="cms-input" value="{{ $settings['home_stat1_count'] ?? '4,832+' }}"/></div>
      <div><label class="cms-label">Members Label</label><input type="text" name="home_stat1_label" class="cms-input" value="{{ $settings['home_stat1_label'] ?? 'Registered Members' }}"/></div>
      <div><label class="cms-label">Years Count</label><input type="text" name="home_stat2_count" class="cms-input" value="{{ $settings['home_stat2_count'] ?? '28+' }}"/></div>
      <div><label class="cms-label">Years Label</label><input type="text" name="home_stat2_label" class="cms-input" value="{{ $settings['home_stat2_label'] ?? 'Years of Service' }}"/></div>
      <div><label class="cms-label">Events Count</label><input type="text" name="home_stat3_count" class="cms-input" value="{{ $settings['home_stat3_count'] ?? '200+' }}"/></div>
      <div><label class="cms-label">Events Label</label><input type="text" name="home_stat3_label" class="cms-input" value="{{ $settings['home_stat3_label'] ?? 'Events Organised' }}"/></div>
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
      <div><label class="cms-label">Phone Number</label><input type="text" name="contact_phone" class="cms-input" value="{{ $settings['contact_phone'] ?? '+91 98765 43210' }}"/></div>
      <div><label class="cms-label">Email Address</label><input type="text" name="contact_email" class="cms-input" value="{{ $settings['contact_email'] ?? 'info@pactpunjab.com' }}"/></div>
      <div><label class="cms-label">Location / City</label><input type="text" name="contact_address" class="cms-input" value="{{ $settings['contact_address'] ?? 'Chandigarh, India' }}"/></div>
    </div>
  </div>

</div>
</form>

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
