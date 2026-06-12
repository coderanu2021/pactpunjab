<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Admin Login — PACT Punjab</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  body {
    font-family: 'Poppins', sans-serif;
    background: #F1F5F9;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    padding: 24px;
  }

  .login-wrapper {
    display: flex;
    width: 100%;
    max-width: 900px;
    min-height: 540px;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(15,23,42,.14);
  }

  /* ── Left panel ── */
  .login-left {
    flex: 1;
    background: linear-gradient(145deg, #1E3A5F, #2563EB);
    padding: 48px 40px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    color: #fff;
    position: relative;
    overflow: hidden;
  }
  .login-left::before {
    content: '';
    position: absolute;
    width: 400px; height: 400px;
    border-radius: 50%;
    background: rgba(255,255,255,.04);
    top: -120px; right: -80px;
    pointer-events: none;
  }
  .login-left::after {
    content: '';
    position: absolute;
    width: 280px; height: 280px;
    border-radius: 50%;
    background: rgba(255,255,255,.04);
    bottom: -80px; left: -60px;
    pointer-events: none;
  }
  .brand { display: flex; align-items: center; gap: 12px; }
  .brand-icon {
    width: 44px; height: 44px; border-radius: 11px;
    background: rgba(255,255,255,.15);
    display: flex; align-items: center; justify-content: center;
    font-size: 20px;
  }
  .brand-name { font-size: 18px; font-weight: 700; line-height: 1.2; }
  .brand-name span { display: block; font-size: 11px; font-weight: 400; opacity: .6; }

  .left-body { position: relative; z-index: 1; }
  .left-body h1 { font-size: 28px; font-weight: 800; line-height: 1.3; margin-bottom: 14px; }
  .left-body p { font-size: 13px; opacity: .65; line-height: 1.75; }

  .left-features { display: flex; flex-direction: column; gap: 10px; position: relative; z-index: 1; }
  .left-feat {
    display: flex; align-items: center; gap: 10px;
    background: rgba(255,255,255,.07);
    padding: 10px 14px; border-radius: 10px;
    font-size: 13px; opacity: .9;
  }
  .left-feat i { font-size: 14px; opacity: .8; }

  /* ── Right panel ── */
  .login-right {
    width: 400px;
    background: #fff;
    padding: 48px 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  .login-right h2 { font-size: 22px; font-weight: 700; color: #0F172A; margin-bottom: 6px; }
  .login-right p  { font-size: 13px; color: #94A3B8; margin-bottom: 32px; }

  .form-group { margin-bottom: 20px; }
  .form-group label {
    display: block; font-size: 12px; font-weight: 600;
    color: #64748B; text-transform: uppercase; letter-spacing: .05em;
    margin-bottom: 6px;
  }
  .input-wrap { position: relative; }
  .input-wrap i {
    position: absolute; left: 14px; top: 50%;
    transform: translateY(-50%); color: #94A3B8; font-size: 13px;
  }
  .form-control {
    width: 100%; padding: 11px 14px 11px 38px;
    border: 1.5px solid #E2E8F0; border-radius: 9px;
    font-family: 'Poppins', sans-serif; font-size: 13px;
    color: #0F172A; outline: none; transition: all .15s;
    background: #F8FAFC;
  }
  .form-control:focus { border-color: #2563EB; background: #fff; box-shadow: 0 0 0 3px #DBEAFE; }

  .btn-login {
    width: 100%; background: #2563EB; color: #fff;
    border: none; padding: 13px; border-radius: 9px;
    font-family: 'Poppins', sans-serif; font-size: 14px;
    font-weight: 600; cursor: pointer; transition: all .2s;
    display: flex; align-items: center; justify-content: center; gap: 8px;
    margin-top: 8px;
  }
  .btn-login:hover { background: #1D4ED8; transform: translateY(-1px); box-shadow: 0 4px 14px rgba(37,99,235,.35); }
  .btn-login:active { transform: translateY(0); }

  .error-msg {
    background: #FEF2F2; color: #DC2626;
    padding: 10px 14px; border-radius: 8px;
    font-size: 12.5px; margin-bottom: 20px;
    border: 1px solid #FECACA;
    display: flex; align-items: flex-start; gap: 8px;
  }

  .login-footer-text {
    text-align: center; margin-top: 24px;
    font-size: 11.5px; color: #94A3B8;
  }

  @media (max-width: 700px) {
    .login-left { display: none; }
    .login-right { width: 100%; padding: 36px 28px; }
    .login-wrapper { max-width: 420px; }
  }
</style>
</head>
<body>

<div class="login-wrapper">

  <!-- Left decorative panel -->
  <div class="login-left">
    <div class="brand">
      <div class="brand-icon"><i class="fa-solid fa-shield-halved"></i></div>
      <div class="brand-name">PACT Punjab <span>Admin Portal</span></div>
    </div>

    <div class="left-body">
      <h1>Manage Your Association with Confidence</h1>
      <p>Punjab Association of Computer Traders — the central hub for registrations, certifications, members, events and more.</p>
    </div>

    <div class="left-features">
      <div class="left-feat"><i class="fa-solid fa-certificate"></i> Certificate Generation & Verification</div>
      <div class="left-feat"><i class="fa-solid fa-users"></i> Member & Registration Management</div>
      <div class="left-feat"><i class="fa-solid fa-calendar-check"></i> Events & Communication Tools</div>
    </div>
  </div>

  <!-- Right login form -->
  <div class="login-right">
    <h2>Welcome Back</h2>
    <p>Sign in to continue to your admin dashboard</p>

    @if($errors->any())
    <div class="error-msg">
      <i class="fa-solid fa-circle-exclamation" style="margin-top:1px;flex-shrink:0"></i>
      <span>{{ $errors->first() }}</span>
    </div>
    @endif

    @if(session('error'))
    <div class="error-msg">
      <i class="fa-solid fa-circle-exclamation" style="margin-top:1px;flex-shrink:0"></i>
      <span>{{ session('error') }}</span>
    </div>
    @endif

    <form action="{{ route('admin.authenticate') }}" method="POST">
      @csrf
      <div class="form-group">
        <label>Email Address</label>
        <div class="input-wrap">
          <i class="fa-solid fa-envelope"></i>
          <input type="email" name="email" class="form-control"
            placeholder="admin@pactpunjab.in"
            value="{{ old('email') }}" required autocomplete="email"/>
        </div>
      </div>
      <div class="form-group">
        <label>Password</label>
        <div class="input-wrap">
          <i class="fa-solid fa-lock"></i>
          <input type="password" name="password" class="form-control"
            placeholder="Enter your password" required autocomplete="current-password"/>
        </div>
      </div>
      <button type="submit" class="btn-login">
        <i class="fa-solid fa-right-to-bracket"></i> Sign In
      </button>
    </form>

    <div class="login-footer-text">
      &copy; {{ date('Y') }} PACT Punjab. All rights reserved.
    </div>
  </div>

</div>

</body>
</html>
