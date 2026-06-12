@extends('layouts.backend')
@section('title', 'Website Settings')

@section('content')

<div class="page-header">
  <div>
    <h1><i class="fa-solid fa-globe" style="color:var(--primary);margin-right:8px"></i>Website Settings</h1>
    <p>Configure global website identity, logo, favicon and meta information.</p>
  </div>
  <div class="header-actions">
    <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save Changes</button>
  </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:18px">

  <!-- Site Identity -->
  <div class="card" style="grid-column:1/-1">
    <div class="card-header" style="border-bottom:1px solid var(--border);padding:16px 20px">
      <div class="card-title"><i class="fa-solid fa-building-shield" style="color:var(--primary);margin-right:6px"></i>Site Identity</div>
      <div class="card-subtitle">Basic details about your website</div>
    </div>
    <div style="padding:20px;display:grid;grid-template-columns:1fr 1fr;gap:16px">
      <div>
        <label class="settings-label">Site Name</label>
        <input type="text" class="settings-input" value="PACT Punjab Admin Portal"/>
      </div>
      <div>
        <label class="settings-label">Site Tagline</label>
        <input type="text" class="settings-input" value="Punjab Association of Computer Traders"/>
      </div>
      <div>
        <label class="settings-label">Site URL</label>
        <input type="url" class="settings-input" value="https://pactpunjab.in"/>
      </div>
      <div>
        <label class="settings-label">Admin URL Prefix</label>
        <input type="text" class="settings-input" value="/admin"/>
      </div>
      <div style="grid-column:1/-1">
        <label class="settings-label">Meta Description</label>
        <textarea class="settings-input" rows="2">PACT Punjab – Punjab Association of Computer Traders. Official portal for registration, certification and member management.</textarea>
      </div>
    </div>
  </div>

  <!-- Logo & Favicon -->
  <div class="card">
    <div class="card-header" style="border-bottom:1px solid var(--border);padding:16px 20px">
      <div class="card-title"><i class="fa-solid fa-image" style="color:var(--warning);margin-right:6px"></i>Logo</div>
    </div>
    <div style="padding:20px;display:flex;flex-direction:column;gap:14px">
      <div style="width:120px;height:80px;border:2px dashed var(--border);border-radius:10px;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:6px;color:var(--text-muted);font-size:12px;cursor:pointer;transition:border-color .15s" onmouseover="this.style.borderColor='var(--primary)'" onmouseout="this.style.borderColor='var(--border)'">
        <i class="fa-solid fa-image" style="font-size:20px"></i>
        Current Logo
      </div>
      <div>
        <label class="settings-label">Upload New Logo</label>
        <input type="file" class="settings-input" accept="image/*" style="padding:6px"/>
      </div>
      <div>
        <label class="settings-label">Logo Alt Text</label>
        <input type="text" class="settings-input" value="PACT Punjab Logo"/>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header" style="border-bottom:1px solid var(--border);padding:16px 20px">
      <div class="card-title"><i class="fa-solid fa-star" style="color:var(--warning);margin-right:6px"></i>Favicon & Social</div>
    </div>
    <div style="padding:20px;display:flex;flex-direction:column;gap:14px">
      <div>
        <label class="settings-label">Favicon (32×32 px)</label>
        <input type="file" class="settings-input" accept="image/x-icon,image/png" style="padding:6px"/>
      </div>
      <div>
        <label class="settings-label">OG Image (1200×630 px)</label>
        <input type="file" class="settings-input" accept="image/*" style="padding:6px"/>
      </div>
      <div>
        <label class="settings-label">Twitter Card Type</label>
        <select class="settings-input">
          <option selected>summary_large_image</option>
          <option>summary</option>
        </select>
      </div>
    </div>
  </div>

  <!-- Maintenance Mode -->
  <div class="card" style="grid-column:1/-1">
    <div class="card-header" style="border-bottom:1px solid var(--border);padding:16px 20px">
      <div class="card-title"><i class="fa-solid fa-wrench" style="color:var(--danger);margin-right:6px"></i>Maintenance Mode</div>
    </div>
    <div style="padding:20px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px">
      <div>
        <div style="font-size:14px;font-weight:600;color:var(--text-main);margin-bottom:4px">Enable Maintenance Mode</div>
        <div style="font-size:13px;color:var(--text-muted)">When enabled, visitors will see a maintenance page instead of the website.</div>
      </div>
      <label style="display:flex;align-items:center;gap:10px;cursor:pointer">
        <div style="position:relative;width:46px;height:24px">
          <input type="checkbox" id="maintenanceToggle" style="opacity:0;width:0;height:0;position:absolute" onchange="updateToggle(this)"/>
          <div id="toggleTrack" style="position:absolute;inset:0;background:var(--border);border-radius:12px;transition:background .2s"></div>
          <div id="toggleThumb" style="position:absolute;top:3px;left:3px;width:18px;height:18px;background:#fff;border-radius:50%;transition:left .2s;box-shadow:0 1px 3px rgba(0,0,0,.2)"></div>
        </div>
        <span style="font-size:13px;font-weight:500;color:var(--text-secondary)" id="toggleLabel">Off</span>
      </label>
    </div>
  </div>

</div>

<div style="display:flex;justify-content:flex-end;margin-top:20px;gap:10px">
  <button class="btn btn-outline">Reset Defaults</button>
  <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save Settings</button>
</div>

@endsection

@section('script')
<style>
.settings-label { display:block;font-size:11px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:5px }
.settings-input { width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:8px;font-family:var(--font);font-size:13px;color:var(--text-main);outline:none;background:var(--bg);resize:vertical;transition:border-color .15s }
.settings-input:focus { border-color:var(--primary) }
</style>
<script>
function updateToggle(el) {
  const track = document.getElementById('toggleTrack');
  const thumb = document.getElementById('toggleThumb');
  const label = document.getElementById('toggleLabel');
  if(el.checked) {
    track.style.background = 'var(--danger)';
    thumb.style.left = '25px';
    label.textContent = 'On';
  } else {
    track.style.background = 'var(--border)';
    thumb.style.left = '3px';
    label.textContent = 'Off';
  }
}
</script>
@endsection
