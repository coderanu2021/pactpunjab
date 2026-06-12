@extends('layouts.backend')
@section('title', 'Contact Us — CMS')

@section('content')

<div class="page-header">
  <div>
    <h1><i class="fa-solid fa-phone" style="color:var(--primary);margin-right:8px"></i>Contact Us Page</h1>
    <p>Update the contact information and address details shown on the Contact page.</p>
  </div>
  <div class="header-actions">
    <span class="tag tag-approved" style="padding:6px 14px;font-size:12px"><i class="fa-solid fa-circle-dot"></i> Live</span>
    <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save Changes</button>
  </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:18px">

  <!-- Page Hero -->
  <div class="card" style="grid-column:1/-1">
    <div class="card-header" style="border-bottom:1px solid var(--border);padding:16px 20px">
      <div class="card-title"><i class="fa-solid fa-star" style="color:var(--warning);margin-right:6px"></i>Page Header</div>
    </div>
    <div style="padding:20px;display:grid;grid-template-columns:1fr 1fr;gap:16px">
      <div>
        <label class="cms-label">Page Title</label>
        <input type="text" class="cms-input" value="Contact Us"/>
      </div>
      <div>
        <label class="cms-label">Sub Heading</label>
        <input type="text" class="cms-input" value="Get in touch with PACT Punjab"/>
      </div>
    </div>
  </div>

  <!-- Contact Details -->
  <div class="card">
    <div class="card-header" style="border-bottom:1px solid var(--border);padding:16px 20px">
      <div class="card-title"><i class="fa-solid fa-address-book" style="color:var(--primary);margin-right:6px"></i>Contact Details</div>
    </div>
    <div style="padding:20px;display:flex;flex-direction:column;gap:14px">
      <div><label class="cms-label">Phone Number</label><input type="text" class="cms-input" value="+91 98765 43210"/></div>
      <div><label class="cms-label">Secondary Phone</label><input type="text" class="cms-input" value="+91 98765 00000"/></div>
      <div><label class="cms-label">Email Address</label><input type="email" class="cms-input" value="info@pactpunjab.in"/></div>
      <div><label class="cms-label">Support Email</label><input type="email" class="cms-input" value="support@pactpunjab.in"/></div>
    </div>
  </div>

  <!-- Address & Map -->
  <div class="card">
    <div class="card-header" style="border-bottom:1px solid var(--border);padding:16px 20px">
      <div class="card-title"><i class="fa-solid fa-location-dot" style="color:var(--danger);margin-right:6px"></i>Office Address</div>
    </div>
    <div style="padding:20px;display:flex;flex-direction:column;gap:14px">
      <div><label class="cms-label">Street Address</label><input type="text" class="cms-input" value="123, Main Market, Ludhiana"/></div>
      <div><label class="cms-label">City</label><input type="text" class="cms-input" value="Ludhiana"/></div>
      <div><label class="cms-label">State</label><input type="text" class="cms-input" value="Punjab"/></div>
      <div><label class="cms-label">PIN Code</label><input type="text" class="cms-input" value="141001"/></div>
      <div><label class="cms-label">Google Maps Embed URL</label><input type="text" class="cms-input" placeholder="https://maps.google.com/…"/></div>
    </div>
  </div>

  <!-- Office Hours -->
  <div class="card" style="grid-column:1/-1">
    <div class="card-header" style="border-bottom:1px solid var(--border);padding:16px 20px">
      <div class="card-title"><i class="fa-solid fa-clock" style="color:var(--warning);margin-right:6px"></i>Office Hours</div>
    </div>
    <div style="padding:20px;display:grid;grid-template-columns:1fr 1fr;gap:14px">
      <div><label class="cms-label">Weekdays (Mon–Fri)</label><input type="text" class="cms-input" value="9:00 AM – 6:00 PM"/></div>
      <div><label class="cms-label">Saturday</label><input type="text" class="cms-input" value="10:00 AM – 2:00 PM"/></div>
      <div><label class="cms-label">Sunday</label><input type="text" class="cms-input" value="Closed"/></div>
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
