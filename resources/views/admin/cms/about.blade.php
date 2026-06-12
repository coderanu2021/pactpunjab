@extends('layouts.backend')
@section('title', 'About Us — CMS')

@section('content')

<div class="page-header">
  <div>
    <h1><i class="fa-solid fa-circle-info" style="color:var(--primary);margin-right:8px"></i>About Us Page</h1>
    <p>Edit the About Us page content — history, mission, vision and team.</p>
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
      <div class="card-title"><i class="fa-solid fa-star" style="color:var(--warning);margin-right:6px"></i>Page Hero / Banner</div>
    </div>
    <div style="padding:20px;display:grid;grid-template-columns:1fr 1fr;gap:16px">
      <div>
        <label class="cms-label">Page Title</label>
        <input type="text" class="cms-input" value="About PACT Punjab"/>
      </div>
      <div>
        <label class="cms-label">Breadcrumb Text</label>
        <input type="text" class="cms-input" value="Home / About Us"/>
      </div>
      <div style="grid-column:1/-1">
        <label class="cms-label">Hero Description</label>
        <textarea class="cms-input" rows="2" placeholder="Short description for page hero…">Learn about our history, mission, and the vision that drives PACT Punjab forward since 1996.</textarea>
      </div>
    </div>
  </div>

  <!-- Introduction -->
  <div class="card" style="grid-column:1/-1">
    <div class="card-header" style="border-bottom:1px solid var(--border);padding:16px 20px">
      <div class="card-title"><i class="fa-solid fa-align-left" style="color:var(--primary);margin-right:6px"></i>Introduction / Overview</div>
    </div>
    <div style="padding:20px">
      <label class="cms-label">Introduction Text</label>
      <textarea class="cms-input" rows="5" placeholder="Main introduction paragraph…">PACT Punjab (Punjab Association of Computer Traders) was established in 1996 with the mission of uniting, supporting, and empowering computer traders across Punjab. Over the past 28 years, we have grown into the most trusted association for the IT trade community in the region.</textarea>
    </div>
  </div>

  <!-- Mission & Vision -->
  <div class="card">
    <div class="card-header" style="border-bottom:1px solid var(--border);padding:16px 20px">
      <div class="card-title"><i class="fa-solid fa-bullseye" style="color:var(--danger);margin-right:6px"></i>Mission Statement</div>
    </div>
    <div style="padding:20px">
      <textarea class="cms-input" rows="4" placeholder="Mission statement…">To promote, protect, and advance the interests of computer traders in Punjab through certification, advocacy, and community development.</textarea>
    </div>
  </div>

  <div class="card">
    <div class="card-header" style="border-bottom:1px solid var(--border);padding:16px 20px">
      <div class="card-title"><i class="fa-solid fa-eye" style="color:var(--success);margin-right:6px"></i>Vision Statement</div>
    </div>
    <div style="padding:20px">
      <textarea class="cms-input" rows="4" placeholder="Vision statement…">A thriving, certified, and globally competitive computer trade community in Punjab that drives digital transformation across India.</textarea>
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
