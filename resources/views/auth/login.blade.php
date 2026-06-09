<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Admin Panel</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;700&display=swap');

  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --bg:        #f1f5f9;
    --surface:   #ffffff;
    --card:      #f8fafc;
    --border:    #e2e8f0;
    --accent:    #4f7cff;
    --accent2:   #7c3aed;
    --green:     #10b981;
    --red:       #ef4444;
    --yellow:    #f59e0b;
    --text:      #0f172a;
    --muted:     #94a3b8;
    --sidebar-w: 240px;
  }

  body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; transition: background .2s, color .2s; }

  /* Dark mode override */
  body.dark {
    --bg:        #0b0f1a;
    --surface:   #111827;
    --card:      #1a2235;
    --border:    #1f2d44;
    --text:      #e2e8f0;
    --muted:     #64748b;
  }

  /* ── LOGIN PAGE ── */
  #login-page {
    display: flex; align-items: center; justify-content: center;
    min-height: 100vh;
    background: radial-gradient(ellipse 80% 60% at 50% 0%, #1a2a5e55, transparent),
                radial-gradient(ellipse 50% 40% at 80% 80%, #4f7cff22, transparent), var(--bg);
  }
  .login-box {
    width: 400px; background: var(--surface);
    border: 1px solid var(--border); border-radius: 20px;
    padding: 44px 40px; box-shadow: 0 32px 64px #00000055;
  }
  .login-logo {
    display: flex; align-items: center; gap: 10px; margin-bottom: 32px;
  }
  .login-logo .dot {
    width: 36px; height: 36px; border-radius: 10px;
    background: linear-gradient(135deg, var(--accent), var(--accent2));
    display: flex; align-items: center; justify-content: center;
    font-size: 18px;
  }
  .login-logo span { font-family: 'Space Grotesk', sans-serif; font-weight: 700; font-size: 20px; }
  .login-box h2 { font-size: 24px; font-weight: 700; margin-bottom: 6px; }
  .login-box p { color: var(--muted); font-size: 14px; margin-bottom: 28px; }
  .field { margin-bottom: 18px; }
  .field label { display: block; font-size: 13px; font-weight: 500; color: var(--muted); margin-bottom: 6px; }
  .field input {
    width: 100%; padding: 11px 14px; background: var(--card);
    border: 1px solid var(--border); border-radius: 10px; color: var(--text);
    font-size: 14px; font-family: inherit; outline: none; transition: border .2s;
  }
  .field input:focus { border-color: var(--accent); box-shadow: 0 0 0 3px #4f7cff22; }
  .field input::placeholder { color: var(--muted); }
  .login-btn {
    width: 100%; padding: 12px; background: linear-gradient(135deg, var(--accent), var(--accent2));
    border: none; border-radius: 10px; color: #fff; font-size: 15px; font-weight: 600;
    cursor: pointer; transition: opacity .2s, transform .1s; margin-top: 4px;
  }
  .login-btn:hover { opacity: .9; }
  .login-btn:active { transform: scale(.98); }
  .login-err { color: var(--red); font-size: 13px; margin-top: 10px; display: none; text-align: center; }
  .login-hint { margin-top: 20px; font-size: 12px; color: var(--muted); text-align: center; }
  .login-hint span { color: var(--accent); }

  /* ── DASHBOARD ── */
  #dashboard { display: none; min-height: 100vh; }

  /* Sidebar */
  .sidebar {
    position: fixed; left: 0; top: 0; bottom: 0; width: var(--sidebar-w);
    background: var(--surface); border-right: 1px solid var(--border);
    display: flex; flex-direction: column; z-index: 100;
  }
  .sidebar-top { padding: 24px 20px 16px; border-bottom: 1px solid var(--border); }
  .brand { display: flex; align-items: center; gap: 10px; }
  .brand .dot {
    width: 32px; height: 32px; border-radius: 9px;
    background: linear-gradient(135deg, var(--accent), var(--accent2));
    display: flex; align-items: center; justify-content: center; font-size: 15px;
  }
  .brand span { font-family: 'Space Grotesk', sans-serif; font-weight: 700; font-size: 17px; }
  .nav { flex: 1; padding: 16px 12px; overflow-y: auto; }
  .nav-label { font-size: 10px; font-weight: 600; color: var(--muted); text-transform: uppercase;
    letter-spacing: .08em; padding: 0 8px; margin: 12px 0 6px; }
  .nav-item {
    display: flex; align-items: center; gap: 10px; padding: 10px 12px;
    border-radius: 10px; cursor: pointer; font-size: 14px; font-weight: 500;
    color: var(--muted); transition: all .18s; margin-bottom: 2px;
  }
  .nav-item:hover { background: var(--card); color: var(--text); }
  .nav-item.active { background: linear-gradient(135deg,#4f7cff18,#7c3aed18); color: var(--accent); }
  .nav-item .icon { font-size: 16px; width: 20px; text-align: center; }
  .nav-item .badge {
    margin-left: auto; background: var(--red); color: #fff;
    font-size: 10px; font-weight: 700; padding: 2px 6px; border-radius: 99px;
  }
  .sidebar-footer {
    padding: 16px 12px; border-top: 1px solid var(--border);
  }
  .admin-card {
    display: flex; align-items: center; gap: 10px; padding: 10px 12px;
    background: var(--card); border-radius: 12px; cursor: pointer;
  }
  .avatar {
    width: 34px; height: 34px; border-radius: 50%;
    background: linear-gradient(135deg, var(--accent), var(--accent2));
    display: flex; align-items: center; justify-content: center;
    font-weight: 700; font-size: 14px; flex-shrink: 0;
  }
  .admin-info { flex: 1; min-width: 0; }
  .admin-name { font-size: 13px; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
  .admin-role { font-size: 11px; color: var(--muted); }
  .logout-btn {
    background: none; border: none; color: var(--muted); cursor: pointer;
    font-size: 16px; padding: 4px; border-radius: 6px; transition: color .2s;
  }
  .logout-btn:hover { color: var(--red); }

  /* Main content */
  .main { margin-left: var(--sidebar-w); padding: 28px 32px; min-height: 100vh; }
  .topbar {
    display: flex; align-items: center; justify-content: space-between; margin-bottom: 28px;
  }
  .topbar-left h1 { font-family: 'Space Grotesk', sans-serif; font-size: 22px; font-weight: 700; }
  .topbar-left p { font-size: 13px; color: var(--muted); margin-top: 2px; }
  .topbar-right { display: flex; align-items: center; gap: 12px; }
  .search-bar {
    display: flex; align-items: center; gap: 8px;
    background: var(--surface); border: 1px solid var(--border);
    border-radius: 10px; padding: 8px 14px; font-size: 13px; color: var(--muted);
    cursor: text;
  }
  .notif-btn {
    width: 38px; height: 38px; background: var(--surface); border: 1px solid var(--border);
    border-radius: 10px; display: flex; align-items: center; justify-content: center;
    cursor: pointer; position: relative; font-size: 16px;
  }
  .notif-dot {
    position: absolute; top: 7px; right: 7px; width: 7px; height: 7px;
    background: var(--red); border-radius: 50%; border: 2px solid var(--bg);
  }

  /* Stats grid */
  .stats { display: grid; grid-template-columns: repeat(4,1fr); gap: 18px; margin-bottom: 24px; }
  .stat-card {
    background: var(--surface); border: 1px solid var(--border); border-radius: 16px; padding: 22px;
    position: relative; overflow: hidden;
  }
  .stat-card::before {
    content: ''; position: absolute; top: -20px; right: -20px;
    width: 80px; height: 80px; border-radius: 50%; opacity: .08;
  }
  .stat-card.blue::before  { background: var(--accent); }
  .stat-card.green::before { background: var(--green); }
  .stat-card.purple::before { background: var(--accent2); }
  .stat-card.yellow::before { background: var(--yellow); }
  .stat-icon { font-size: 20px; margin-bottom: 12px; }
  .stat-val { font-size: 28px; font-weight: 700; font-family: 'Space Grotesk', sans-serif; }
  .stat-label { font-size: 13px; color: var(--muted); margin-top: 4px; }
  .stat-change { font-size: 12px; margin-top: 8px; display: flex; align-items: center; gap: 4px; }
  .stat-change.up { color: var(--green); }
  .stat-change.down { color: var(--red); }

  /* Two-col layout */
  .two-col { display: grid; grid-template-columns: 1.6fr 1fr; gap: 20px; margin-bottom: 24px; }
  .panel {
    background: var(--surface); border: 1px solid var(--border); border-radius: 16px; padding: 22px;
  }
  .panel-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px; }
  .panel-title { font-size: 15px; font-weight: 600; }
  .panel-action { font-size: 12px; color: var(--accent); cursor: pointer; }

  /* Chart */
  .chart-wrap { height: 160px; position: relative; }
  .chart-bars { display: flex; align-items: flex-end; gap: 8px; height: 100%; }
  .bar-group { flex: 1; display: flex; flex-direction: column; align-items: center; gap: 4px; }
  .bar {
    width: 100%; border-radius: 6px 6px 0 0; transition: opacity .2s;
    cursor: pointer;
  }
  .bar:hover { opacity: .8; }
  .bar-lbl { font-size: 10px; color: var(--muted); }

  /* Activity list */
  .activity-list { display: flex; flex-direction: column; gap: 12px; }
  .activity-item { display: flex; align-items: flex-start; gap: 12px; }
  .act-dot {
    width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; margin-top: 5px;
  }
  .act-text { font-size: 13px; }
  .act-meta { font-size: 11px; color: var(--muted); margin-top: 2px; }

  /* Users table */
  .table-wrap { overflow-x: auto; }
  table { width: 100%; border-collapse: collapse; font-size: 13px; }
  th {
    text-align: left; padding: 10px 14px; color: var(--muted);
    font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: .06em;
    border-bottom: 1px solid var(--border);
  }
  td { padding: 13px 14px; border-bottom: 1px solid var(--border); }
  tr:last-child td { border-bottom: none; }
  tr:hover td { background: #ffffff05; }
  .td-user { display: flex; align-items: center; gap: 10px; }
  .u-av {
    width: 30px; height: 30px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 700; flex-shrink: 0;
  }
  .u-name { font-weight: 500; }
  .u-email { font-size: 11px; color: var(--muted); }
  .badge {
    display: inline-flex; align-items: center; padding: 3px 9px;
    border-radius: 99px; font-size: 11px; font-weight: 600;
  }
  .badge.active  { background: #10b98122; color: var(--green); }
  .badge.pending { background: #f59e0b22; color: var(--yellow); }
  .badge.inactive { background: #ef444422; color: var(--red); }
  .badge.admin   { background: #4f7cff22; color: var(--accent); }
  .badge.user    { background: #ffffff11; color: var(--muted); }

  /* History panel */
  .history-list { display: flex; flex-direction: column; gap: 0; max-height: 320px; overflow-y: auto; }
  .history-list::-webkit-scrollbar { width: 4px; }
  .history-list::-webkit-scrollbar-track { background: transparent; }
  .history-list::-webkit-scrollbar-thumb { background: var(--border); border-radius: 4px; }
  .hist-item {
    display: flex; align-items: flex-start; gap: 14px; padding: 14px 0;
    border-bottom: 1px solid var(--border);
  }
  .hist-item:last-child { border-bottom: none; }
  .hist-icon {
    width: 32px; height: 32px; border-radius: 9px;
    display: flex; align-items: center; justify-content: center; font-size: 14px; flex-shrink: 0;
  }
  .hist-icon.login   { background: #4f7cff18; }
  .hist-icon.user    { background: #10b98118; }
  .hist-icon.setting { background: #f59e0b18; }
  .hist-icon.delete  { background: #ef444418; }
  .hist-icon.export  { background: #7c3aed18; }
  .hist-body { flex: 1; min-width: 0; }
  .hist-action { font-size: 13px; font-weight: 500; }
  .hist-detail { font-size: 12px; color: var(--muted); margin-top: 2px; }
  .hist-time { font-size: 11px; color: var(--muted); flex-shrink: 0; }

  /* Page sections */
  .page { display: none; }
  .page.active { display: block; }

  /* Mini line chart svg */
  .sparkline { width: 100%; height: 40px; }

  /* Scrollbar global */
  ::-webkit-scrollbar { width: 5px; height: 5px; }
  ::-webkit-scrollbar-track { background: transparent; }
  ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 4px; }
</style>
</head>
<body>

<!-- ────────── LOGIN PAGE ────────── -->
<div id="login-page">
  <div class="login-box">
    <div class="login-logo">
      <div class="dot">⚡</div>
      <span>AdminX</span>
    </div>
    <h2>Welcome back</h2>
    <p>Sign in to your admin account</p>
    <div class="field">
      <label>Email address</label>
      <input type="email" id="login-email" placeholder="admin@example.com" />
    </div>
    <div class="field">
      <label>Password</label>
      <input type="password" id="login-pass" placeholder="••••••••" />
    </div>
    <button class="login-btn" onclick="doLogin()">Sign In</button>
    <div class="login-err" id="login-err">❌ Invalid credentials. Try admin / admin123</div>
    <div class="login-hint">Demo: email <span>admin@adminx.com</span> · password <span>admin123</span></div>
  </div>
</div>

<!-- ────────── DASHBOARD ────────── -->
<div id="dashboard">
  <!-- Sidebar -->
  <aside class="sidebar">
    <div class="sidebar-top">
      <div class="brand"><div class="dot">⚡</div><span>AdminX</span></div>
    </div>
    <nav class="nav">
      <div class="nav-label">Main</div>
      <div class="nav-item active" onclick="showPage('overview',this)">
        <span class="icon">📊</span> Overview
      </div>
      <div class="nav-item" onclick="showPage('users',this)">
        <span class="icon">👥</span> Users <span class="badge">4</span>
      </div>
      <div class="nav-item" onclick="showPage('analytics',this)">
        <span class="icon">📈</span> Analytics
      </div>
      <div class="nav-label">System</div>
      <div class="nav-item" onclick="showPage('history',this)">
        <span class="icon">🕐</span> History
      </div>
      <div class="nav-item" onclick="showPage('settings',this)">
        <span class="icon">⚙️</span> Settings
      </div>
    </nav>
    <div class="sidebar-footer">
      <div class="admin-card">
        <div class="avatar">A</div>
        <div class="admin-info">
          <div class="admin-name">Admin User</div>
          <div class="admin-role">Super Admin</div>
        </div>
        <button class="logout-btn" title="Logout" onclick="doLogout()">⏻</button>
      </div>
    </div>
  </aside>

  <!-- Main -->
  <main class="main">
    <div class="topbar">
      <div class="topbar-left">
        <h1 id="page-title">Overview</h1>
        <p id="page-sub">Welcome back, Admin 👋</p>
      </div>
      <div class="topbar-right">
        <div class="search-bar">🔍 &nbsp;Search...</div>
        <div class="notif-btn">🔔<div class="notif-dot"></div></div>
      </div>
    </div>

    <!-- OVERVIEW PAGE -->
    <div class="page active" id="page-overview">
      <div class="stats">
        <div class="stat-card blue">
          <div class="stat-icon">👤</div>
          <div class="stat-val">2,847</div>
          <div class="stat-label">Total Users</div>
          <div class="stat-change up">▲ 12.4% this month</div>
        </div>
        <div class="stat-card green">
          <div class="stat-icon">💰</div>
          <div class="stat-val">₹4.2L</div>
          <div class="stat-label">Revenue</div>
          <div class="stat-change up">▲ 8.1% this month</div>
        </div>
        <div class="stat-card purple">
          <div class="stat-icon">📦</div>
          <div class="stat-val">1,293</div>
          <div class="stat-label">Orders</div>
          <div class="stat-change down">▼ 2.3% this week</div>
        </div>
        <div class="stat-card yellow">
          <div class="stat-icon">⭐</div>
          <div class="stat-val">94.2%</div>
          <div class="stat-label">Satisfaction</div>
          <div class="stat-change up">▲ 1.8% this month</div>
        </div>
      </div>

      <div class="two-col">
        <!-- Bar chart -->
        <div class="panel">
          <div class="panel-header">
            <span class="panel-title">Monthly Revenue</span>
            <span class="panel-action">View report →</span>
          </div>
          <div class="chart-wrap">
            <div class="chart-bars" id="bar-chart"></div>
          </div>
        </div>
        <!-- Recent activity -->
        <div class="panel">
          <div class="panel-header">
            <span class="panel-title">Recent Activity</span>
            <span class="panel-action" onclick="showPage('history', document.querySelector('[onclick*=history]'))">See all →</span>
          </div>
          <div class="activity-list">
            <div class="activity-item"><div class="act-dot" style="background:var(--green)"></div><div><div class="act-text">New user registered: Priya S.</div><div class="act-meta">2 min ago</div></div></div>
            <div class="activity-item"><div class="act-dot" style="background:var(--accent)"></div><div><div class="act-text">Order #1082 completed</div><div class="act-meta">15 min ago</div></div></div>
            <div class="activity-item"><div class="act-dot" style="background:var(--yellow)"></div><div><div class="act-text">Settings updated by Admin</div><div class="act-meta">1 hr ago</div></div></div>
            <div class="activity-item"><div class="act-dot" style="background:var(--red)"></div><div><div class="act-text">Failed login attempt detected</div><div class="act-meta">2 hr ago</div></div></div>
            <div class="activity-item"><div class="act-dot" style="background:var(--accent2)"></div><div><div class="act-text">Report exported to CSV</div><div class="act-meta">3 hr ago</div></div></div>
          </div>
        </div>
      </div>

      <!-- Recent users table -->
      <div class="panel">
        <div class="panel-header">
          <span class="panel-title">Recent Users</span>
          <span class="panel-action" onclick="showPage('users', document.querySelector('[onclick*=users]'))">Manage users →</span>
        </div>
        <div class="table-wrap">
          <table>
            <thead>
              <tr><th>User</th><th>Role</th><th>Status</th><th>Joined</th><th>Orders</th></tr>
            </thead>
            <tbody id="mini-user-table"></tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- USERS PAGE -->
    <div class="page" id="page-users">
      <div class="panel">
        <div class="panel-header">
          <span class="panel-title">All Users</span>
          <button style="background:var(--accent);color:#fff;border:none;border-radius:8px;padding:8px 16px;font-size:13px;font-weight:600;cursor:pointer;">+ Add User</button>
        </div>
        <div class="table-wrap">
          <table>
            <thead>
              <tr><th>User</th><th>Role</th><th>Status</th><th>Joined</th><th>Orders</th><th>Actions</th></tr>
            </thead>
            <tbody id="full-user-table"></tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- ANALYTICS PAGE -->
    <div class="page" id="page-analytics">
      <div class="stats">
        <div class="stat-card blue"><div class="stat-icon">👁</div><div class="stat-val">48.2K</div><div class="stat-label">Page Views</div><div class="stat-change up">▲ 18% this week</div></div>
        <div class="stat-card green"><div class="stat-icon">⏱</div><div class="stat-val">3m 42s</div><div class="stat-label">Avg Session</div><div class="stat-change up">▲ 4%</div></div>
        <div class="stat-card purple"><div class="stat-icon">📉</div><div class="stat-val">24.1%</div><div class="stat-label">Bounce Rate</div><div class="stat-change down">▼ Good</div></div>
        <div class="stat-card yellow"><div class="stat-icon">🌍</div><div class="stat-val">38</div><div class="stat-label">Countries</div><div class="stat-change up">▲ 3 new</div></div>
      </div>
      <div class="two-col">
        <div class="panel">
          <div class="panel-header"><span class="panel-title">Traffic Sources</span></div>
          <div style="display:flex;flex-direction:column;gap:14px;margin-top:8px;">
            <div>
              <div style="display:flex;justify-content:space-between;font-size:13px;margin-bottom:6px;"><span>Organic Search</span><span style="color:var(--green);font-weight:600;">42%</span></div>
              <div style="height:6px;background:var(--border);border-radius:3px;"><div style="width:42%;height:100%;background:var(--green);border-radius:3px;"></div></div>
            </div>
            <div>
              <div style="display:flex;justify-content:space-between;font-size:13px;margin-bottom:6px;"><span>Direct</span><span style="color:var(--accent);font-weight:600;">28%</span></div>
              <div style="height:6px;background:var(--border);border-radius:3px;"><div style="width:28%;height:100%;background:var(--accent);border-radius:3px;"></div></div>
            </div>
            <div>
              <div style="display:flex;justify-content:space-between;font-size:13px;margin-bottom:6px;"><span>Social Media</span><span style="color:var(--accent2);font-weight:600;">18%</span></div>
              <div style="height:6px;background:var(--border);border-radius:3px;"><div style="width:18%;height:100%;background:var(--accent2);border-radius:3px;"></div></div>
            </div>
            <div>
              <div style="display:flex;justify-content:space-between;font-size:13px;margin-bottom:6px;"><span>Referral</span><span style="color:var(--yellow);font-weight:600;">12%</span></div>
              <div style="height:6px;background:var(--border);border-radius:3px;"><div style="width:12%;height:100%;background:var(--yellow);border-radius:3px;"></div></div>
            </div>
          </div>
        </div>
        <div class="panel">
          <div class="panel-header"><span class="panel-title">Device Breakdown</span></div>
          <div style="display:flex;flex-direction:column;gap:16px;margin-top:12px;">
            <div style="display:flex;align-items:center;gap:14px;">
              <div style="font-size:24px;">📱</div>
              <div style="flex:1;"><div style="font-size:13px;font-weight:500;">Mobile</div><div style="font-size:11px;color:var(--muted);">58% of sessions</div></div>
              <div style="font-size:15px;font-weight:700;color:var(--accent);">58%</div>
            </div>
            <div style="display:flex;align-items:center;gap:14px;">
              <div style="font-size:24px;">💻</div>
              <div style="flex:1;"><div style="font-size:13px;font-weight:500;">Desktop</div><div style="font-size:11px;color:var(--muted);">34% of sessions</div></div>
              <div style="font-size:15px;font-weight:700;color:var(--green);">34%</div>
            </div>
            <div style="display:flex;align-items:center;gap:14px;">
              <div style="font-size:24px;">📟</div>
              <div style="flex:1;"><div style="font-size:13px;font-weight:500;">Tablet</div><div style="font-size:11px;color:var(--muted);">8% of sessions</div></div>
              <div style="font-size:15px;font-weight:700;color:var(--yellow);">8%</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- HISTORY PAGE -->
    <div class="page" id="page-history">
      <div class="panel">
        <div class="panel-header">
          <span class="panel-title">Admin Action History</span>
          <div style="display:flex;gap:8px;">
            <button onclick="clearHistory()" style="background:var(--card);border:1px solid var(--border);color:var(--muted);border-radius:8px;padding:6px 14px;font-size:12px;cursor:pointer;">🗑 Clear</button>
            <button onclick="exportHistory()" style="background:var(--accent);color:#fff;border:none;border-radius:8px;padding:6px 14px;font-size:12px;font-weight:600;cursor:pointer;">⬇ Export</button>
          </div>
        </div>
        <div class="history-list" id="history-list"></div>
      </div>
    </div>

    <!-- SETTINGS PAGE -->
    <div class="page" id="page-settings">
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
        <div class="panel">
          <div class="panel-header"><span class="panel-title">Profile Settings</span></div>
          <div class="field"><label>Display Name</label><input type="text" value="Admin User" style="width:100%;padding:10px 12px;background:var(--card);border:1px solid var(--border);border-radius:8px;color:var(--text);font-size:13px;outline:none;font-family:inherit;" /></div>
          <div class="field" style="margin-top:14px;"><label>Email</label><input type="email" value="admin@adminx.com" style="width:100%;padding:10px 12px;background:var(--card);border:1px solid var(--border);border-radius:8px;color:var(--text);font-size:13px;outline:none;font-family:inherit;" /></div>
          <div class="field" style="margin-top:14px;"><label>Role</label><input type="text" value="Super Admin" disabled style="width:100%;padding:10px 12px;background:var(--bg);border:1px solid var(--border);border-radius:8px;color:var(--muted);font-size:13px;outline:none;font-family:inherit;" /></div>
          <button onclick="addHistory('⚙️','setting','Profile settings updated','Saved display name & email')" style="margin-top:18px;background:var(--accent);color:#fff;border:none;border-radius:8px;padding:10px 20px;font-size:13px;font-weight:600;cursor:pointer;">Save Changes</button>
        </div>
        <div class="panel">
          <div class="panel-header"><span class="panel-title">Security</span></div>
          <div class="field"><label>Current Password</label><input type="password" placeholder="••••••••" style="width:100%;padding:10px 12px;background:var(--card);border:1px solid var(--border);border-radius:8px;color:var(--text);font-size:13px;outline:none;font-family:inherit;" /></div>
          <div class="field" style="margin-top:14px;"><label>New Password</label><input type="password" placeholder="••••••••" style="width:100%;padding:10px 12px;background:var(--card);border:1px solid var(--border);border-radius:8px;color:var(--text);font-size:13px;outline:none;font-family:inherit;" /></div>
          <div style="margin-top:20px;display:flex;align-items:center;justify-content:space-between;padding:14px;background:var(--card);border-radius:10px;">
            <div><div style="font-size:13px;font-weight:500;">Two-Factor Auth</div><div style="font-size:11px;color:var(--muted);">Extra security layer</div></div>
            <div id="2fa-toggle" onclick="toggle2fa()" style="width:42px;height:24px;background:var(--green);border-radius:12px;cursor:pointer;position:relative;transition:background .2s;">
              <div style="width:18px;height:18px;background:#fff;border-radius:50%;position:absolute;top:3px;right:3px;transition:right .2s;"></div>
            </div>
          </div>
          <button style="margin-top:18px;background:var(--card);color:var(--text);border:1px solid var(--border);border-radius:8px;padding:10px 20px;font-size:13px;font-weight:600;cursor:pointer;">Update Password</button>
        </div>
      </div>
    </div>

  </main>
</div>

<script>
// ─── DATA ───
const USERS = [
  { name: 'Priya Sharma',  email: 'priya@ex.com',  role: 'admin',  status: 'active',   joined: 'Jan 12, 2025', orders: 142, color: '#4f7cff' },
  { name: 'Rohan Mehta',   email: 'rohan@ex.com',  role: 'user',   status: 'active',   joined: 'Feb 3, 2025',  orders: 89,  color: '#10b981' },
  { name: 'Anita Singh',   email: 'anita@ex.com',  role: 'user',   status: 'pending',  joined: 'Mar 19, 2025', orders: 23,  color: '#f59e0b' },
  { name: 'Vikram Patel',  email: 'vikram@ex.com', role: 'user',   status: 'inactive', joined: 'Apr 5, 2025',  orders: 5,   color: '#ef4444' },
  { name: 'Sneha Das',     email: 'sneha@ex.com',  role: 'admin',  status: 'active',   joined: 'May 1, 2025',  orders: 201, color: '#7c3aed' },
  { name: 'Arjun Nair',    email: 'arjun@ex.com',  role: 'user',   status: 'active',   joined: 'May 20, 2025', orders: 67,  color: '#06b6d4' },
];

const MONTHS = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
const REVENUE = [18,24,19,31,27,42,38,35,47,52,44,61];

// ─── HISTORY ───
let history = JSON.parse(localStorage.getItem('adminHistory') || '[]');
if (!history.length) {
  history = [
    { icon:'🔐', type:'login',   action:'Admin logged in',          detail:'IP: 192.168.1.1 · Chrome/Windows',   time: ago(2) },
    { icon:'👤', type:'user',    action:'User Priya S. added',      detail:'Role: Admin · Status: Active',        time: ago(60) },
    { icon:'⚙️', type:'setting', action:'Email notifications enabled', detail:'Setting: Notifications → ON',     time: ago(120) },
    { icon:'📤', type:'export',  action:'User report exported',     detail:'Format: CSV · 6 records',             time: ago(180) },
    { icon:'🗑️', type:'delete',  action:'Draft order #1071 deleted', detail:'Order value: ₹2,400',               time: ago(300) },
    { icon:'🔐', type:'login',   action:'Admin logged in',          detail:'IP: 192.168.1.1 · Firefox/Mac',      time: ago(1440) },
  ];
  saveHistory();
}

function ago(mins) {
  const d = new Date(Date.now() - mins*60000);
  return d.toLocaleString('en-IN',{day:'2-digit',month:'short',hour:'2-digit',minute:'2-digit'});
}
function saveHistory() { localStorage.setItem('adminHistory', JSON.stringify(history)); }
function addHistory(icon, type, action, detail) {
  history.unshift({ icon, type, action, detail, time: new Date().toLocaleString('en-IN',{day:'2-digit',month:'short',hour:'2-digit',minute:'2-digit'}) });
  saveHistory();
  renderHistory();
}
function renderHistory() {
  const el = document.getElementById('history-list');
  if (!history.length) { el.innerHTML = '<div style="text-align:center;color:var(--muted);padding:40px;font-size:14px;">No history yet.</div>'; return; }
  el.innerHTML = history.map(h => `
    <div class="hist-item">
      <div class="hist-icon ${h.type}">${h.icon}</div>
      <div class="hist-body">
        <div class="hist-action">${h.action}</div>
        <div class="hist-detail">${h.detail}</div>
      </div>
      <div class="hist-time">${h.time}</div>
    </div>`).join('');
}
function clearHistory() {
  if (confirm('Clear all history?')) { history = []; saveHistory(); renderHistory(); }
}
function exportHistory() {
  const csv = ['Action,Detail,Time', ...history.map(h => `"${h.action}","${h.detail}","${h.time}"`)].join('\n');
  const a = document.createElement('a');
  a.href = 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv);
  a.download = 'admin-history.csv';
  a.click();
  addHistory('📤','export','History exported','Format: CSV');
}

// ─── LOGIN ───
function doLogin() {
  const email = document.getElementById('login-email').value.trim();
  const pass  = document.getElementById('login-pass').value;
  const err   = document.getElementById('login-err');
  if (email === 'admin@adminx.com' && pass === 'admin123') {
    document.getElementById('login-page').style.display = 'none';
    document.getElementById('dashboard').style.display = 'block';
    addHistory('🔐','login','Admin logged in','IP: 127.0.0.1 · Browser session');
    init();
  } else {
    err.style.display = 'block';
    setTimeout(() => err.style.display='none', 3000);
  }
}
function doLogout() {
  addHistory('🔐','login','Admin logged out','Session ended');
  document.getElementById('dashboard').style.display='none';
  document.getElementById('login-page').style.display='flex';
  document.getElementById('login-email').value='';
  document.getElementById('login-pass').value='';
}

// ─── PAGES ───
function showPage(id, el) {
  document.querySelectorAll('.page').forEach(p=>p.classList.remove('active'));
  document.querySelectorAll('.nav-item').forEach(n=>n.classList.remove('active'));
  document.getElementById('page-'+id).classList.add('active');
  if(el) el.classList.add('active');
  const titles={overview:'Overview',users:'Users',analytics:'Analytics',history:'Action History',settings:'Settings'};
  const subs={overview:'Welcome back, Admin 👋',users:'Manage your user base',analytics:'Site performance insights',history:'Full audit log of admin actions',settings:'Account & security settings'};
  document.getElementById('page-title').textContent = titles[id]||id;
  document.getElementById('page-sub').textContent   = subs[id]||'';
}

// ─── RENDER ───
function renderBarChart() {
  const el = document.getElementById('bar-chart');
  const max = Math.max(...REVENUE);
  el.innerHTML = REVENUE.map((v,i) => `
    <div class="bar-group">
      <div class="bar" style="height:${Math.round(v/max*130)}px;background:${i===11?'linear-gradient(180deg,var(--accent),var(--accent2))':'var(--border)'};"></div>
      <div class="bar-lbl">${MONTHS[i]}</div>
    </div>`).join('');
}

function renderUserRow(u) {
  return `<tr>
    <td><div class="td-user"><div class="u-av" style="background:${u.color}22;color:${u.color};">${u.name[0]}</div><div><div class="u-name">${u.name}</div><div class="u-email">${u.email}</div></div></div></td>
    <td><span class="badge ${u.role}">${u.role}</span></td>
    <td><span class="badge ${u.status}">${u.status}</span></td>
    <td style="color:var(--muted);font-size:12px;">${u.joined}</td>
    <td style="font-weight:600;">${u.orders}</td>
  </tr>`;
}

function renderUserRowFull(u) {
  return `<tr>
    <td><div class="td-user"><div class="u-av" style="background:${u.color}22;color:${u.color};">${u.name[0]}</div><div><div class="u-name">${u.name}</div><div class="u-email">${u.email}</div></div></div></td>
    <td><span class="badge ${u.role}">${u.role}</span></td>
    <td><span class="badge ${u.status}">${u.status}</span></td>
    <td style="color:var(--muted);font-size:12px;">${u.joined}</td>
    <td style="font-weight:600;">${u.orders}</td>
    <td>
      <button onclick="addHistory('👤','user','Edited user: ${u.name}','Role: ${u.role}')" style="background:var(--card);border:1px solid var(--border);color:var(--text);border-radius:6px;padding:4px 10px;font-size:12px;cursor:pointer;margin-right:4px;">Edit</button>
      <button onclick="addHistory('🗑️','delete','Deleted user: ${u.name}','Email: ${u.email}')" style="background:#ef444420;border:1px solid #ef444440;color:var(--red);border-radius:6px;padding:4px 10px;font-size:12px;cursor:pointer;">Del</button>
    </td>
  </tr>`;
}

function toggle2fa() {
  const el = document.getElementById('2fa-toggle');
  const on = el.style.background === 'var(--green)';
  el.style.background = on ? 'var(--border)' : 'var(--green)';
  el.querySelector('div').style.right = on ? 'auto' : '3px';
  el.querySelector('div').style.left  = on ? '3px' : 'auto';
  addHistory('⚙️','setting','Two-Factor Auth ' + (on?'disabled':'enabled'),'Security setting changed');
}

function init() {
  renderBarChart();
  renderHistory();
  document.getElementById('mini-user-table').innerHTML = USERS.slice(0,4).map(renderUserRow).join('');
  document.getElementById('full-user-table').innerHTML = USERS.map(renderUserRowFull).join('');
}

// Enter key on login
document.addEventListener('keydown', e => {
  if (e.key === 'Enter' && document.getElementById('login-page').style.display !== 'none') doLogin();
});
</script>
</body>
</html>
