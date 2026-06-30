@extends('layouts.frontend')
@section('title', 'Appeal & Advisory')

@section('content')
<style>
.adv-intro{display:grid;grid-template-columns:1.2fr .8fr;gap:56px;align-items:center;margin-bottom:80px}
.adv-intro p{font-size:15px;color:var(--muted);line-height:1.85;margin-bottom:16px}
.adv-intro p strong{color:var(--navy)}
.adv-card{background:var(--navy);border-radius:22px;padding:36px;position:relative;overflow:hidden}
.adv-card::after{content:'🏛️';position:absolute;font-size:120px;right:-10px;bottom:-20px;opacity:.07}
.adv-card-label{display:inline-flex;align-items:center;gap:8px;background:rgba(245,166,35,.15);border:1px solid rgba(245,166,35,.3);padding:6px 14px;border-radius:20px;margin-bottom:18px}
.adv-card-label span{font-size:11px;font-weight:700;color:var(--gold2);letter-spacing:1px;text-transform:uppercase}
.adv-card h3{font-size:18px;font-weight:800;color:#fff;margin-bottom:16px;line-height:1.3}
.adv-list{display:flex;flex-direction:column;gap:12px;position:relative;z-index:1}
.adv-item{display:flex;align-items:flex-start;gap:11px}
.adv-item-ico{width:34px;height:34px;border-radius:9px;background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.1);display:flex;align-items:center;justify-content:center;font-size:14px;flex-shrink:0}
.adv-item strong{display:block;font-size:13px;font-weight:700;color:#fff;margin-bottom:2px}
.adv-item span{font-size:12px;color:rgba(255,255,255,.45);line-height:1.5}

.wins-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:22px;margin-bottom:80px}
.win-card{background:#fff;border:1px solid var(--border);border-radius:18px;padding:26px 24px;transition:transform .25s,box-shadow .25s}
.win-card:hover{transform:translateY(-5px);box-shadow:var(--card-shadow-hover)}
.win-year-badge{display:inline-block;font-size:10px;font-weight:700;padding:3px 10px;border-radius:20px;background:rgba(16,140,80,.09);color:#108C50;margin-bottom:14px}
.win-card h4{font-size:15px;font-weight:800;color:var(--navy);margin-bottom:8px;line-height:1.35}
.win-card p{font-size:13px;color:var(--muted);line-height:1.7}

.process-flow{display:grid;grid-template-columns:repeat(4,1fr);gap:0;position:relative;margin-bottom:80px}
.process-flow::before{content:'';position:absolute;top:34px;left:12%;right:12%;height:2px;background:linear-gradient(90deg,var(--blue2),var(--accent));z-index:0}
.flow-step{text-align:center;padding:0 12px;position:relative;z-index:1}
.flow-circle{width:68px;height:68px;border-radius:50%;border:3px solid var(--border);background:#fff;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:22px;transition:border-color .2s}
.flow-step:hover .flow-circle{border-color:var(--blue2);box-shadow:0 0 0 6px rgba(30,80,162,.08)}
.flow-step h5{font-size:13px;font-weight:700;color:var(--navy);margin-bottom:6px}
.flow-step p{font-size:11px;color:var(--muted);line-height:1.6}

.appeal-form-section{background:var(--light);border-radius:22px;padding:52px 48px;margin-bottom:80px}
.aform-grid{display:grid;grid-template-columns:1fr 1fr;gap:18px}
.aform-grp{display:flex;flex-direction:column;gap:6px}
.aform-lbl{font-size:12px;font-weight:700;color:var(--navy);letter-spacing:.3px}
.aform-lbl .req{color:var(--accent)}
.aform-ctrl{padding:11px 16px;border:1.5px solid var(--border);border-radius:10px;font-family:var(--font);font-size:14px;color:var(--text);background:#fff;outline:none;transition:border-color .2s,box-shadow .2s;width:100%}
.aform-ctrl:focus{border-color:var(--blue2);box-shadow:0 0 0 3px rgba(30,80,162,.1)}
textarea.aform-ctrl{resize:vertical;min-height:110px}

@media(max-width:1100px){.adv-intro{grid-template-columns:1fr}.wins-grid{grid-template-columns:1fr 1fr}.process-flow{grid-template-columns:1fr 1fr;gap:24px}.process-flow::before{display:none}}
@media(max-width:768px){.wins-grid{grid-template-columns:1fr}.aform-grid{grid-template-columns:1fr}.appeal-form-section{padding:32px 24px}}
</style>

<div class="page-hero">
  <div class="hero-glow"></div><div class="hero-glow2"></div>
  <div class="page-hero-inner">
    <div class="breadcrumb">
      <a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a><i class="fas fa-chevron-right"></i>
      <a href="#">Services</a><i class="fas fa-chevron-right"></i>
      <span class="active">Appeal & Advisory</span>
    </div>
    <div class="page-hero-tag"><span>Services</span></div>
    <h1>Appeal & <span>Advisory</span></h1>
    <p>{{ $settings['page_advisory_intro'] ?? 'Strategic representation and guidance on government appeals, regulatory matters, and industry policy issues — PACT stands with members navigating complex bureaucratic processes.' }}</p>
    <div class="hero-chips">
      <div class="hero-chip"><i class="fas fa-landmark"></i> Govt. Representation</div>
      <div class="hero-chip"><i class="fas fa-balance-scale"></i> Policy Advocacy</div>
      <div class="hero-chip"><i class="fas fa-comments"></i> Strategic Advice</div>
    </div>
  </div>
</div>

<div class="page-body">

  <!-- INTRO -->
  <div class="adv-intro">
    <div>
      <div class="eyebrow">About This Service</div>
      <h2 class="sec-title">When You Need a <span class="hl">Stronger Voice</span></h2>
      <p>{{ $settings['page_advisory_desc'] ?? "Some challenges are too big for a single business to navigate alone — a problematic government policy, an unfair administrative decision, or a regulatory ambiguity affecting the entire IT trade sector. That's where PACT's Appeal & Advisory service comes in." }}</p>
      <p>PACT's leadership, advisory board, and special invitees combine their <strong>government relationships, legal expertise, and collective influence</strong> to represent member interests before State and Central authorities — turning individual concerns into industry-wide advocacy.</p>
      <p>We also provide <strong>strategic advisory</strong> on navigating bureaucratic processes — from licensing applications to policy clarifications — drawing on decades of institutional experience.</p>
    </div>
    <div class="adv-card">
      <div class="adv-card-label"><span>What We Do</span></div>
      <h3>Two Core Functions</h3>
      <div class="adv-list">
        <div class="adv-item"><div class="adv-item-ico">📜</div><div><strong>Policy Appeals</strong><span>Representing collective member concerns to government on regulatory matters</span></div></div>
        <div class="adv-item"><div class="adv-item-ico">🧭</div><div><strong>Process Advisory</strong><span>Guiding individual members through complex bureaucratic procedures</span></div></div>
        <div class="adv-item"><div class="adv-item-ico">🤝</div><div><strong>Stakeholder Liaison</strong><span>Connecting members with the right government officials and departments</span></div></div>
        <div class="adv-item"><div class="adv-item-ico">📋</div><div><strong>Memoranda Drafting</strong><span>Preparing formal representations and pre-budget memoranda</span></div></div>
      </div>
    </div>
  </div>

  <!-- PAST WINS -->
  <div class="eyebrow">Track Record</div>
  <h2 class="sec-title" style="margin-bottom:28px">Advocacy <span class="hl">Wins</span></h2>
  <div class="wins-grid">
    <div class="win-card"><span class="win-year-badge">2023</span><h4>E-Way Bill Job Work Notification Deferred</h4><p>PACT's representation led to the deferral of a problematic E-Way Bill notification affecting job work transactions — kept in abeyance pending further review.</p></div>
    <div class="win-card"><span class="win-year-badge">2022</span><h4>GST Amnesty Scheme Awareness Drive</h4><p>PACT successfully lobbied for extended amnesty scheme deadlines and ran an awareness campaign helping 80+ members regularise their GST status.</p></div>
    <div class="win-card"><span class="win-year-badge">2021</span><h4>COVID-19 Relief Measures for IT Traders</h4><p>PACT's representation to State Government resulted in deferred compliance deadlines and relief measures for IT businesses during the pandemic.</p></div>
    <div class="win-card"><span class="win-year-badge">2019</span><h4>Simplified IT Hardware Customs Classification</h4><p>Successful advocacy with the Customs Department led to clearer HSN classification guidelines, reducing disputes for hardware importers.</p></div>
    <div class="win-card"><span class="win-year-badge">2017</span><h4>GST Transition Support Framework</h4><p>PACT established a structured support framework helping 400+ members transition smoothly to the new GST regime with minimal disruption.</p></div>
    <div class="win-card"><span class="win-year-badge">2015</span><h4>Punjab IT Policy Consultation</h4><p>PACT was formally consulted in drafting Punjab's State IT Policy, ensuring trader interests were reflected in the final framework.</p></div>
  </div>

  <!-- PROCESS -->
  <div class="eyebrow">How It Works</div>
  <h2 class="sec-title" style="margin-bottom:48px">Our Advisory <span class="hl">Process</span></h2>
  <div class="process-flow">
    <div class="flow-step"><div class="flow-circle">📥</div><h5>Submit Concern</h5><p>Member submits a policy concern or seeks advisory guidance via the form below.</p></div>
    <div class="flow-step"><div class="flow-circle">🔍</div><h5>Assessment</h5><p>EC and Advisory Board assess whether this is an individual or sector-wide issue.</p></div>
    <div class="flow-step"><div class="flow-circle">📜</div><h5>Formal Action</h5><p>Memorandum drafted and submitted, or direct guidance provided to the member.</p></div>
    <div class="flow-step"><div class="flow-circle">📢</div><h5>Outcome Reported</h5><p>Member is updated on progress and final outcome through circulars or direct contact.</p></div>
  </div>

  <!-- FORM -->
  <div class="appeal-form-section">
    <div style="margin-bottom:28px">
      <div class="eyebrow">Submit a Request</div>
      <h2 class="sec-title">Request <span class="hl">Advisory Support</span></h2>
      <p style="font-size:14px;color:var(--muted);margin-top:4px">Whether it's an individual issue or a sector-wide policy concern, let us know.</p>
    </div>
    <form onsubmit="return false">
      <div class="aform-grid">
        <div class="aform-grp"><label class="aform-lbl">Your Name / Firm <span class="req">*</span></label><input type="text" class="aform-ctrl" placeholder="Full name or firm name" required></div>
        <div class="aform-grp"><label class="aform-lbl">PACT Member ID <span class="req">*</span></label><input type="text" class="aform-ctrl" placeholder="PACT/MEM/YYYY/XXXXX" required></div>
        <div class="aform-grp"><label class="aform-lbl">Mobile Number <span class="req">*</span></label><input type="tel" class="aform-ctrl" placeholder="+91 XXXXX XXXXX" required></div>
        <div class="aform-grp"><label class="aform-lbl">Email <span class="req">*</span></label><input type="email" class="aform-ctrl" placeholder="your@email.com" required></div>
        <div class="aform-grp" style="grid-column:1/-1"><label class="aform-lbl">Nature of Request <span class="req">*</span></label>
          <select class="aform-ctrl" required><option value="">— Select —</option><option>Policy / Regulatory Concern (Sector-wide)</option><option>Individual Government Process Guidance</option><option>Department / Authority Liaison Request</option><option>Pre-Budget Memorandum Suggestion</option><option>Other</option></select>
        </div>
        <div class="aform-grp" style="grid-column:1/-1"><label class="aform-lbl">Describe Your Concern <span class="req">*</span></label><textarea class="aform-ctrl" rows="5" placeholder="Provide full details of the issue, relevant department/authority, and what outcome you are seeking…" required></textarea></div>
      </div>
      <div class="btn-group" style="margin-top:24px">
        <button class="btn-primary" onclick="alert('Request submitted! The Advisory Board will review and respond.')"><i class="fas fa-paper-plane"></i> Submit Request</button>
        <a href="advisory-board.html" class="btn-ghost-light"><i class="fas fa-chalkboard-teacher"></i> Meet the Advisory Board</a>
      </div>
    </form>
  </div>

  <div class="cta-band-navy">
    <div class="cta-band-text"><h3>Your Voice Matters at PACT</h3><p>Every member's concern is taken seriously — and when it affects the whole sector, PACT's collective voice ensures it reaches the right people.</p></div>
    <div class="cta-band-btns">
      <a href="{{ route('become-member') }}" class="btn-gold"><i class="fas fa-user-plus"></i> Join PACT</a>
      <a href="aim-objectives.html" class="btn-ghost-dark"><i class="fas fa-bullseye"></i> Aim & Objectives</a>
    </div>
  </div>

</div>

@endsection
