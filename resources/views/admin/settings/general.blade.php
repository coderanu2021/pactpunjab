@extends('layouts.backend')
@section('title', 'General Settings')

@section('content')

<div class="page-header">
  <div>
    <h1><i class="fa-solid fa-sliders" style="color:var(--primary);margin-right:8px"></i>General Settings</h1>
    <p>Configure system-wide options including timezone, currency, date format and registration controls.</p>
  </div>
  <div class="header-actions">
    <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save Changes</button>
  </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:18px">

  <!-- Localisation -->
  <div class="card">
    <div class="card-header" style="border-bottom:1px solid var(--border);padding:16px 20px">
      <div class="card-title"><i class="fa-solid fa-earth-asia" style="color:var(--primary);margin-right:6px"></i>Localisation</div>
    </div>
    <div style="padding:20px;display:flex;flex-direction:column;gap:14px">
      <div>
        <label class="settings-label">Timezone</label>
        <select class="settings-input">
          <option selected>Asia/Kolkata (IST +5:30)</option>
          <option>UTC</option>
          <option>America/New_York</option>
        </select>
      </div>
      <div>
        <label class="settings-label">Date Format</label>
        <select class="settings-input">
          <option selected>d M Y (09 Jun 2026)</option>
          <option>d/m/Y (09/06/2026)</option>
          <option>Y-m-d (2026-06-09)</option>
        </select>
      </div>
      <div>
        <label class="settings-label">Currency</label>
        <select class="settings-input">
          <option selected>INR (₹)</option>
          <option>USD ($)</option>
          <option>EUR (€)</option>
        </select>
      </div>
      <div>
        <label class="settings-label">Language</label>
        <select class="settings-input">
          <option selected>English</option>
          <option>Hindi</option>
          <option>Punjabi</option>
        </select>
      </div>
    </div>
  </div>

  <!-- Registration Settings -->
  <div class="card">
    <div class="card-header" style="border-bottom:1px solid var(--border);padding:16px 20px">
      <div class="card-title"><i class="fa-solid fa-file-pen" style="color:var(--success);margin-right:6px"></i>Registration Settings</div>
    </div>
    <div style="padding:20px;display:flex;flex-direction:column;gap:14px">
      @php
      $regToggles = [
        ['label'=>'Allow New Registrations','desc'=>'Enable or disable public registration form','checked'=>true],
        ['label'=>'Auto-Approve Registrations','desc'=>'Skip manual review and auto-approve','checked'=>false],
        ['label'=>'Send Confirmation Email','desc'=>'Email applicant on submission','checked'=>true],
        ['label'=>'Require Document Upload','desc'=>'Make document upload mandatory','checked'=>false],
      ];
      @endphp
      @foreach($regToggles as $t)
      <label style="display:flex;align-items:flex-start;justify-content:space-between;cursor:pointer;padding:10px 12px;background:var(--bg);border-radius:8px;border:1px solid var(--border);gap:12px">
        <div>
          <div style="font-size:13px;font-weight:500;color:var(--text-main)">{{ $t['label'] }}</div>
          <div style="font-size:11px;color:var(--text-muted);margin-top:2px">{{ $t['desc'] }}</div>
        </div>
        <input type="checkbox" {{ $t['checked'] ? 'checked' : '' }} style="width:16px;height:16px;accent-color:var(--primary);cursor:pointer;flex-shrink:0;margin-top:2px"/>
      </label>
      @endforeach
    </div>
  </div>

  <!-- Pagination & Records -->
  <div class="card">
    <div class="card-header" style="border-bottom:1px solid var(--border);padding:16px 20px">
      <div class="card-title"><i class="fa-solid fa-table-list" style="color:var(--warning);margin-right:6px"></i>Records Per Page</div>
    </div>
    <div style="padding:20px;display:grid;grid-template-columns:1fr 1fr;gap:14px">
      <div><label class="settings-label">Members</label><select class="settings-input"><option>10</option><option selected>25</option><option>50</option></select></div>
      <div><label class="settings-label">Registrations</label><select class="settings-input"><option>10</option><option selected>25</option><option>50</option></select></div>
      <div><label class="settings-label">Certificates</label><select class="settings-input"><option selected>10</option><option>25</option><option>50</option></select></div>
      <div><label class="settings-label">Documents</label><select class="settings-input"><option selected>10</option><option>25</option><option>50</option></select></div>
    </div>
  </div>

  <!-- Security -->
  <div class="card">
    <div class="card-header" style="border-bottom:1px solid var(--border);padding:16px 20px">
      <div class="card-title"><i class="fa-solid fa-shield-halved" style="color:var(--danger);margin-right:6px"></i>Security</div>
    </div>
    <div style="padding:20px;display:flex;flex-direction:column;gap:14px">
      <div>
        <label class="settings-label">Session Timeout (minutes)</label>
        <input type="number" class="settings-input" value="120"/>
      </div>
      <div>
        <label class="settings-label">Max Login Attempts</label>
        <input type="number" class="settings-input" value="5"/>
      </div>
      <label style="display:flex;align-items:center;justify-content:space-between;cursor:pointer;padding:10px 12px;background:var(--bg);border-radius:8px;border:1px solid var(--border)">
        <div>
          <div style="font-size:13px;font-weight:500;color:var(--text-main)">Force HTTPS</div>
          <div style="font-size:11px;color:var(--text-muted)">Redirect all HTTP to HTTPS</div>
        </div>
        <input type="checkbox" checked style="width:16px;height:16px;accent-color:var(--primary);cursor:pointer"/>
      </label>
      <label style="display:flex;align-items:center;justify-content:space-between;cursor:pointer;padding:10px 12px;background:var(--bg);border-radius:8px;border:1px solid var(--border)">
        <div>
          <div style="font-size:13px;font-weight:500;color:var(--text-main)">Two-Factor Authentication</div>
          <div style="font-size:11px;color:var(--text-muted)">Require 2FA for admin login</div>
        </div>
        <input type="checkbox" style="width:16px;height:16px;accent-color:var(--primary);cursor:pointer"/>
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
@endsection
