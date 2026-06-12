@extends('layouts.backend')
@section('title', 'Email Settings')

@section('content')

<div class="page-header">
  <div>
    <h1><i class="fa-solid fa-envelope-open-text" style="color:var(--primary);margin-right:8px"></i>Email Settings</h1>
    <p>Configure SMTP settings and email templates for system notifications.</p>
  </div>
  <div class="header-actions">
    <button class="btn btn-outline" id="testEmailBtn"><i class="fa-solid fa-paper-plane"></i> Send Test Email</button>
    <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save Changes</button>
  </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:18px">

  <!-- SMTP Configuration -->
  <div class="card" style="grid-column:1/-1">
    <div class="card-header" style="border-bottom:1px solid var(--border);padding:16px 20px">
      <div class="card-title"><i class="fa-solid fa-server" style="color:var(--primary);margin-right:6px"></i>SMTP Configuration</div>
      <div class="card-subtitle">Outgoing mail server settings</div>
    </div>
    <div style="padding:20px;display:grid;grid-template-columns:1fr 1fr;gap:16px">
      <div>
        <label class="settings-label">Mail Driver</label>
        <select class="settings-input">
          <option selected>SMTP</option>
          <option>Sendmail</option>
          <option>Mailgun</option>
          <option>SES</option>
        </select>
      </div>
      <div>
        <label class="settings-label">SMTP Host</label>
        <input type="text" class="settings-input" value="smtp.gmail.com" placeholder="smtp.example.com"/>
      </div>
      <div>
        <label class="settings-label">SMTP Port</label>
        <input type="number" class="settings-input" value="587"/>
      </div>
      <div>
        <label class="settings-label">Encryption</label>
        <select class="settings-input">
          <option selected>TLS</option>
          <option>SSL</option>
          <option>None</option>
        </select>
      </div>
      <div>
        <label class="settings-label">SMTP Username</label>
        <input type="text" class="settings-input" placeholder="your@gmail.com"/>
      </div>
      <div>
        <label class="settings-label">SMTP Password</label>
        <input type="password" class="settings-input" placeholder="••••••••••••"/>
      </div>
    </div>
  </div>

  <!-- From Details -->
  <div class="card">
    <div class="card-header" style="border-bottom:1px solid var(--border);padding:16px 20px">
      <div class="card-title"><i class="fa-solid fa-user-pen" style="color:var(--success);margin-right:6px"></i>From Details</div>
    </div>
    <div style="padding:20px;display:flex;flex-direction:column;gap:14px">
      <div>
        <label class="settings-label">From Name</label>
        <input type="text" class="settings-input" value="PACT Punjab"/>
      </div>
      <div>
        <label class="settings-label">From Email</label>
        <input type="email" class="settings-input" value="noreply@pactpunjab.in"/>
      </div>
      <div>
        <label class="settings-label">Reply-To Email</label>
        <input type="email" class="settings-input" value="info@pactpunjab.in"/>
      </div>
    </div>
  </div>

  <!-- Notification Toggles -->
  <div class="card">
    <div class="card-header" style="border-bottom:1px solid var(--border);padding:16px 20px">
      <div class="card-title"><i class="fa-solid fa-toggle-on" style="color:var(--warning);margin-right:6px"></i>Email Notification Triggers</div>
    </div>
    <div style="padding:20px;display:flex;flex-direction:column;gap:14px">
      @php
      $toggles = [
        ['label'=>'New Registration Submitted','checked'=>true],
        ['label'=>'Registration Approved','checked'=>true],
        ['label'=>'Registration Rejected','checked'=>true],
        ['label'=>'Certificate Issued','checked'=>true],
        ['label'=>'New Enquiry Received','checked'=>false],
        ['label'=>'Event Registration Confirmed','checked'=>true],
      ];
      @endphp
      @foreach($toggles as $t)
      <label style="display:flex;align-items:center;justify-content:space-between;cursor:pointer;padding:8px 12px;background:var(--bg);border-radius:8px;border:1px solid var(--border)">
        <span style="font-size:13px;color:var(--text-secondary)">{{ $t['label'] }}</span>
        <input type="checkbox" {{ $t['checked'] ? 'checked' : '' }} style="width:16px;height:16px;accent-color:var(--primary);cursor:pointer"/>
      </label>
      @endforeach
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
document.getElementById('testEmailBtn').addEventListener('click', function() {
  const email = prompt('Enter email address to send a test email:');
  if(email) {
    this.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Sending…';
    setTimeout(() => {
      this.innerHTML = '<i class="fa-solid fa-check"></i> Sent!';
      this.style.color = 'var(--success)';
      setTimeout(() => {
        this.innerHTML = '<i class="fa-solid fa-paper-plane"></i> Send Test Email';
        this.style.color = '';
      }, 2000);
    }, 1500);
  }
});
</script>
@endsection
