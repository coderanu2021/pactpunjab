@extends('layouts.frontend')
@section('title')
Page Title
@endsection

@section('content')
<style>

/* ── PAGE HERO ── */
.page-hero{background:var(--navy);padding:60px 5% 70px;position:relative;overflow:hidden}
.page-hero::before{content:'';position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,.04) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.04) 1px,transparent 1px);background-size:52px 52px}
.hero-glow{position:absolute;width:520px;height:520px;border-radius:50%;background:radial-gradient(circle,rgba(30,80,162,.35) 0%,transparent 70%);top:-160px;right:-80px;pointer-events:none}
.hero-glow2{position:absolute;width:320px;height:320px;border-radius:50%;background:radial-gradient(circle,rgba(245,166,35,.15) 0%,transparent 70%);bottom:-80px;left:5%;pointer-events:none}
.page-hero-inner{max-width:1280px;margin:0 auto;position:relative;z-index:1}
.breadcrumb{display:flex;align-items:center;gap:8px;margin-bottom:18px}
.breadcrumb a,.breadcrumb span{font-size:12px;color:rgba(255,255,255,.45);font-weight:500}
.breadcrumb a:hover{color:var(--gold2)}
.breadcrumb i{font-size:9px;color:rgba(255,255,255,.25)}
.breadcrumb .active{color:var(--gold2);font-weight:600}
.page-hero-tag{display:inline-flex;align-items:center;gap:8px;background:rgba(245,166,35,.12);border:1px solid rgba(245,166,35,.25);padding:6px 16px;border-radius:30px;margin-bottom:20px}
.page-hero-tag span{font-size:11px;font-weight:700;color:var(--gold2);letter-spacing:1.5px;text-transform:uppercase}
.page-hero h1{font-size:clamp(28px,3.5vw,48px);font-weight:900;color:#fff;letter-spacing:-1px;margin-bottom:12px;line-height:1.1}
.page-hero h1 span{color:var(--gold2)}
.page-hero p{font-size:15px;color:rgba(255,255,255,.55);max-width:580px;line-height:1.75}
.hero-chips{display:flex;gap:12px;flex-wrap:wrap;margin-top:28px}
.hero-chip{background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.12);padding:8px 18px;border-radius:30px;font-size:12px;color:rgba(255,255,255,.75);font-weight:600;display:flex;align-items:center;gap:7px}
.hero-chip i{color:var(--gold2);font-size:11px}

/* ── LAYOUT ── */
.page-body{max-width:1280px;margin:0 auto;padding:70px 5%}

/* ── COMMONS ── */
.eyebrow{font-size:11px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:var(--accent);margin-bottom:10px;display:flex;align-items:center;gap:8px}
.eyebrow::before{content:'';width:22px;height:2px;background:var(--accent);border-radius:2px;display:inline-block}
.sec-title{font-size:clamp(22px,2.5vw,34px);font-weight:800;color:var(--navy);line-height:1.2;margin-bottom:14px;letter-spacing:-.5px}
.sec-title .hl{color:var(--accent)}
.sec-sub{font-size:15px;color:var(--muted);line-height:1.75;max-width:640px;margin-bottom:48px}

/* ── WHAT IS SIG INTRO ── */
.intro-grid{display:grid;grid-template-columns:1.2fr .8fr;gap:56px;align-items:center;margin-bottom:80px}
.intro-text p{font-size:15px;color:var(--muted);line-height:1.85;margin-bottom:16px}
.intro-text p strong{color:var(--navy);font-weight:700}
.sig-why-card{background:var(--navy);border-radius:22px;padding:36px;position:relative;overflow:hidden}
.sig-why-card::after{content:'SIG';position:absolute;font-size:90px;font-weight:900;color:rgba(255,255,255,.04);right:-8px;bottom:-10px;letter-spacing:-3px;line-height:1}
.sig-why-card-label{display:inline-flex;align-items:center;gap:8px;background:rgba(245,166,35,.15);border:1px solid rgba(245,166,35,.3);padding:6px 14px;border-radius:20px;margin-bottom:20px}
.sig-why-card-label span{font-size:11px;font-weight:700;color:var(--gold2);letter-spacing:1px;text-transform:uppercase}
.sig-why-card h3{font-size:19px;font-weight:800;color:#fff;line-height:1.35;margin-bottom:14px}
.sig-why-list{display:flex;flex-direction:column;gap:12px;position:relative;z-index:1}
.sig-why-item{display:flex;align-items:flex-start;gap:12px}
.sig-why-item-ico{width:34px;height:34px;border-radius:9px;background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.1);display:flex;align-items:center;justify-content:center;font-size:14px;flex-shrink:0;margin-top:1px}
.sig-why-item-body strong{display:block;font-size:13px;font-weight:700;color:#fff;margin-bottom:2px}
.sig-why-item-body span{font-size:12px;color:rgba(255,255,255,.45);line-height:1.5}

/* ── SIG CARDS MAIN GRID ── */
.sig-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin-bottom:80px}
.sig-card{border-radius:20px;overflow:hidden;border:1px solid var(--border);transition:transform .3s,box-shadow .3s;cursor:pointer;background:var(--white)}
.sig-card:hover{transform:translateY(-7px);box-shadow:var(--card-shadow-hover)}
.sig-card-header{padding:32px 28px 24px;position:relative;overflow:hidden}
.sig-card-header::after{content:attr(data-label);position:absolute;font-size:70px;font-weight:900;opacity:.06;right:-8px;bottom:-16px;letter-spacing:-2px;line-height:1;color:#fff;pointer-events:none}
.sig-emoji{font-size:40px;margin-bottom:16px;display:block}
.sig-card-header h3{font-size:17px;font-weight:800;color:#fff;margin-bottom:6px;line-height:1.3;position:relative;z-index:1}
.sig-card-header p{font-size:12px;color:rgba(255,255,255,.6);line-height:1.6;position:relative;z-index:1}
.sig-card-body{padding:22px 28px 24px;border-top:1px solid var(--border)}
.sig-focus-label{font-size:10px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:1.2px;margin-bottom:10px}
.sig-tags{display:flex;flex-wrap:wrap;gap:7px;margin-bottom:16px}
.sig-tag{padding:4px 11px;border-radius:20px;font-size:11px;font-weight:600;border:1px solid var(--border);color:var(--muted);background:var(--light)}
.sig-meta{display:flex;align-items:center;justify-content:space-between}
.sig-members{font-size:12px;color:var(--muted);display:flex;align-items:center;gap:5px;font-weight:600}
.sig-members i{color:var(--blue2);font-size:11px}
.sig-join-btn{font-size:12px;font-weight:700;color:var(--blue2);display:inline-flex;align-items:center;gap:5px;transition:gap .2s}
.sig-join-btn:hover{gap:9px}

/* color themes for each SIG header */
.sig-card.hardware .sig-card-header{background:linear-gradient(135deg,#0C2A5E,#1A3C6E)}
.sig-card.software .sig-card-header{background:linear-gradient(135deg,#1E1060,#4C1D95)}
.sig-card.networking .sig-card-header{background:linear-gradient(135deg,#064E3B,#065F46)}
.sig-card.security .sig-card-header{background:linear-gradient(135deg,#7C1D1D,#B91C1C)}
.sig-card.cloud .sig-card-header{background:linear-gradient(135deg,#0C4A6E,#0369A1)}
.sig-card.startups .sig-card-header{background:linear-gradient(135deg,#78350F,#B45309)}

/* ── HOW TO JOIN STRIP ── */
.join-band{background:var(--light);border-radius:22px;padding:52px 48px;margin-bottom:80px}
.join-band .sec-title{margin-bottom:36px}
.join-steps{display:grid;grid-template-columns:repeat(4,1fr);gap:20px}
.join-step{background:var(--white);border:1px solid var(--border);border-radius:16px;padding:24px 20px;text-align:center;transition:box-shadow .2s,transform .2s;position:relative}
.join-step:hover{box-shadow:var(--card-shadow);transform:translateY(-3px)}
.join-step-num{width:38px;height:38px;border-radius:50%;background:var(--navy);color:var(--gold2);font-size:14px;font-weight:900;display:flex;align-items:center;justify-content:center;margin:0 auto 16px}
.join-step h5{font-size:14px;font-weight:700;color:var(--navy);margin-bottom:7px}
.join-step p{font-size:12px;color:var(--muted);line-height:1.6}
/* arrow connector */
.join-step:not(:last-child)::after{content:'\f054';font-family:'Font Awesome 6 Free';font-weight:900;position:absolute;right:-12px;top:50%;transform:translateY(-50%);font-size:11px;color:var(--border);z-index:1}

/* ── UPCOMING SIG EVENTS ── */
.sig-events-section{margin-bottom:80px}
.sig-event-list{display:flex;flex-direction:column;gap:14px}
.sig-event-row{background:var(--white);border:1px solid var(--border);border-radius:14px;padding:20px 24px;display:flex;align-items:center;gap:16px;transition:box-shadow .2s,transform .2s}
.sig-event-row:hover{box-shadow:var(--card-shadow);transform:translateX(3px)}
.sig-event-dot{width:12px;height:12px;border-radius:50%;flex-shrink:0}
.sig-event-info{flex:1}
.sig-event-info h5{font-size:14px;font-weight:700;color:var(--navy);margin-bottom:3px}
.sig-event-info p{font-size:12px;color:var(--muted)}
.sig-event-badge{padding:4px 12px;border-radius:20px;font-size:11px;font-weight:700;white-space:nowrap;flex-shrink:0}
.sig-event-date{font-size:12px;font-weight:600;color:var(--muted);white-space:nowrap;flex-shrink:0}

/* ── CTA STRIP ── */
.cta-strip{background:linear-gradient(135deg,var(--blue),var(--navy));border-radius:22px;padding:44px 48px;display:flex;align-items:center;justify-content:space-between;gap:32px;flex-wrap:wrap;position:relative;overflow:hidden}
.cta-strip::after{content:'';position:absolute;width:380px;height:380px;border-radius:50%;border:2px solid rgba(255,255,255,.06);bottom:-190px;right:-90px;pointer-events:none}
.cta-text h3{font-size:24px;font-weight:900;color:#fff;margin-bottom:8px;letter-spacing:-.3px}
.cta-text p{font-size:14px;color:rgba(255,255,255,.6);line-height:1.7;max-width:500px}
.cta-btns{display:flex;gap:12px;flex-shrink:0;flex-wrap:wrap}
.btn-gold{background:var(--gold);color:var(--navy);padding:13px 28px;border-radius:25px;font-size:13px;font-weight:800;transition:all .25s;box-shadow:0 4px 16px rgba(245,166,35,.35);display:inline-flex;align-items:center;gap:8px;white-space:nowrap}
.btn-gold:hover{background:var(--gold2);transform:translateY(-2px);box-shadow:0 10px 28px rgba(245,166,35,.45)}
.btn-ghost-w{border:2px solid rgba(255,255,255,.35);color:#fff;padding:11px 24px;border-radius:25px;font-size:13px;font-weight:700;transition:all .25s;display:inline-flex;align-items:center;gap:8px;white-space:nowrap}
.btn-ghost-w:hover{border-color:#fff;background:rgba(255,255,255,.1)}

/* ── RESPONSIVE ── */
@media(max-width:1100px){
  .sig-grid{grid-template-columns:1fr 1fr}
  .intro-grid{grid-template-columns:1fr;gap:36px}
  .join-steps{grid-template-columns:1fr 1fr}
  .join-step:not(:last-child)::after{display:none}
}
@media(max-width:700px){
  .page-body{padding:48px 5%}
  .sig-grid{grid-template-columns:1fr}
  .join-steps{grid-template-columns:1fr 1fr}
  .join-band{padding:36px 24px}
  .cta-strip{flex-direction:column;align-items:flex-start;padding:32px 28px}
}
</style>


<!-- PAGE HERO -->


<x-ui.page-hero title="Special Interest Groups" subtitle="About Us" description="Focused communities within P A C T — where members with shared specialisations connect,
         collaborate, and grow together at a deeper level."
    :breadcrumbs="[
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'About Us', 'url' => '#'],
        ['label' => 'Special Interest Groups']
    ]"
>
    <x-slot:chips>
      <div class="hero-chip"><i class="fas fa-layer-group"></i> 6+ Active SIGs</div>
      <div class="hero-chip"><i class="fas fa-users"></i> Open to All Members</div>
      <div class="hero-chip"><i class="fas fa-calendar-alt"></i> Dedicated Events</div>
      <div class="hero-chip"><i class="fas fa-comments"></i> Peer Networks</div>
    </x-slot:chips>

</x-ui.page-hero>

<!-- MAIN CONTENT -->
<div class="page-body">

  <!-- WHAT IS A SIG -->
  <div class="intro-grid">
    <div class="intro-text">
      <div class="eyebrow">What Are SIGs?</div>
      <h2 class="sec-title">Focused Communities <span class="hl">Within P A C T</span></h2>
      <p>{{ $settings['page_sig_intro'] ?? 'Special Interest Groups (SIGs) are focused sub-communities within P A C T that bring together members who share a common specialisation, technology domain, or business interest. While P A C T serves the entire IT trading ecosystem, SIGs allow members to go deeper — connecting with peers who truly understand their specific segment.' }}</p>
      <p>Each SIG has its own <strong>dedicated forum, events, and working groups</strong> — covering everything from technical seminars and peer roundtables to joint advocacy on niche regulatory issues. SIGs are the heart of P A C T's knowledge-sharing culture.</p>
      <p>Membership in any SIG is <strong>open to all P A C T members at no additional cost</strong>. Members are encouraged to join multiple SIGs based on their business focus and personal interests.</p>
    </div>

    <div class="sig-why-card">
      <div class="sig-why-card-label"><span>Why Join a SIG?</span></div>
      <h3>Deeper Connections. Sharper Knowledge. Stronger Business.</h3>
      <div class="sig-why-list">
        <div class="sig-why-item">
          <div class="sig-why-item-ico">🎯</div>
          <div class="sig-why-item-body">
            <strong>Niche Advocacy</strong>
            <span>Your SIG raises segment-specific issues directly with P A C T leadership and government bodies.</span>
          </div>
        </div>
        <div class="sig-why-item">
          <div class="sig-why-item-ico">🤝</div>
          <div class="sig-why-item-body">
            <strong>Peer Networking</strong>
            <span>Build relationships with members who share your exact domain — hardware, cloud, security, and more.</span>
          </div>
        </div>
        <div class="sig-why-item">
          <div class="sig-why-item-ico">📚</div>
          <div class="sig-why-item-body">
            <strong>Exclusive Knowledge</strong>
            <span>SIG-specific seminars, whitepapers, regulatory briefings, and expert sessions.</span>
          </div>
        </div>
        <div class="sig-why-item">
          <div class="sig-why-item-ico">🚀</div>
          <div class="sig-why-item-body">
            <strong>Business Opportunities</strong>
            <span>Joint partnerships, referrals, and collaborative business development within your SIG.</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- SIG CARDS -->
  <div class="eyebrow">Our Groups</div>
  <h2 class="sec-title" style="margin-bottom:10px">The 6 Active <span class="hl">Special Interest Groups</span></h2>
  <p class="sec-sub">Each SIG operates with its own leadership, dedicated events, and working agenda — all under the P A C T umbrella.</p>

  <div class="sig-grid">

    <!-- SIG 1: Hardware & Peripherals -->
    <div class="sig-card hardware">
      <div class="sig-card-header" data-label="HW">
        <span class="sig-emoji">🖥️</span>
        <h3>Hardware & Peripherals SIG</h3>
        <p>For traders and distributors of computer hardware, peripherals, components, and accessories across Punjab & Chandigarh.</p>
      </div>
      <div class="sig-card-body">
        <div class="sig-focus-label">Focus Areas</div>
        <div class="sig-tags">
          <span class="sig-tag">Import Policy</span>
          <span class="sig-tag">Distribution</span>
          <span class="sig-tag">GST on Hardware</span>
          <span class="sig-tag">Warranty Issues</span>
          <span class="sig-tag">OEM Relations</span>
        </div>
        <div class="sig-meta">
          <span class="sig-members"><i class="fas fa-users"></i> 150+ Members</span>
          <a href="#" class="sig-join-btn">Join SIG <i class="fas fa-arrow-right" style="font-size:10px"></i></a>
        </div>
      </div>
    </div>

    <!-- SIG 2: Software & Solutions -->
    <div class="sig-card software">
      <div class="sig-card-header" data-label="SW">
        <span class="sig-emoji">💻</span>
        <h3>Software & Solutions SIG</h3>
        <p>Connecting IT solution providers, software resellers, and system integrators focused on enterprise and SMB software markets.</p>
      </div>
      <div class="sig-card-body">
        <div class="sig-focus-label">Focus Areas</div>
        <div class="sig-tags">
          <span class="sig-tag">Licensing</span>
          <span class="sig-tag">ERP / CRM</span>
          <span class="sig-tag">Piracy Issues</span>
          <span class="sig-tag">SaaS Reselling</span>
          <span class="sig-tag">Partner Programs</span>
        </div>
        <div class="sig-meta">
          <span class="sig-members"><i class="fas fa-users"></i> 120+ Members</span>
          <a href="#" class="sig-join-btn">Join SIG <i class="fas fa-arrow-right" style="font-size:10px"></i></a>
        </div>
      </div>
    </div>

    <!-- SIG 3: Networking & Infrastructure -->
    <div class="sig-card networking">
      <div class="sig-card-header" data-label="NW">
        <span class="sig-emoji">🌐</span>
        <h3>Networking & Infrastructure SIG</h3>
        <p>For businesses involved in network equipment, structured cabling, surveillance systems, and IT infrastructure projects.</p>
      </div>
      <div class="sig-card-body">
        <div class="sig-focus-label">Focus Areas</div>
        <div class="sig-tags">
          <span class="sig-tag">Network Hardware</span>
          <span class="sig-tag">Surveillance</span>
          <span class="sig-tag">Govt. Tenders</span>
          <span class="sig-tag">Cabling</span>
          <span class="sig-tag">ISP Relations</span>
        </div>
        <div class="sig-meta">
          <span class="sig-members"><i class="fas fa-users"></i> 90+ Members</span>
          <a href="#" class="sig-join-btn">Join SIG <i class="fas fa-arrow-right" style="font-size:10px"></i></a>
        </div>
      </div>
    </div>

    <!-- SIG 4: Cybersecurity -->
    <div class="sig-card security">
      <div class="sig-card-header" data-label="SEC">
        <span class="sig-emoji">🛡️</span>
        <h3>Cybersecurity SIG</h3>
        <p>Dedicated to traders, resellers, and consultants in the cybersecurity space — addressing the rapidly growing demand for digital security across businesses in the region.</p>
      </div>
      <div class="sig-card-body">
        <div class="sig-focus-label">Focus Areas</div>
        <div class="sig-tags">
          <span class="sig-tag">Antivirus / EDR</span>
          <span class="sig-tag">Firewall</span>
          <span class="sig-tag">Data Protection</span>
          <span class="sig-tag">IT Act</span>
          <span class="sig-tag">Threat Intel</span>
        </div>
        <div class="sig-meta">
          <span class="sig-members"><i class="fas fa-users"></i> 70+ Members</span>
          <a href="#" class="sig-join-btn">Join SIG <i class="fas fa-arrow-right" style="font-size:10px"></i></a>
        </div>
      </div>
    </div>

    <!-- SIG 5: Cloud & Digital Services -->
    <div class="sig-card cloud">
      <div class="sig-card-header" data-label="CLD">
        <span class="sig-emoji">☁️</span>
        <h3>Cloud & Digital Services SIG</h3>
        <p>For members engaged in cloud solutions, managed services, digital transformation, and subscription-based IT offerings for SMEs and enterprises.</p>
      </div>
      <div class="sig-card-body">
        <div class="sig-focus-label">Focus Areas</div>
        <div class="sig-tags">
          <span class="sig-tag">Cloud Reselling</span>
          <span class="sig-tag">MSP</span>
          <span class="sig-tag">Microsoft / AWS</span>
          <span class="sig-tag">Digital Transformation</span>
          <span class="sig-tag">Subscriptions</span>
        </div>
        <div class="sig-meta">
          <span class="sig-members"><i class="fas fa-users"></i> 80+ Members</span>
          <a href="#" class="sig-join-btn">Join SIG <i class="fas fa-arrow-right" style="font-size:10px"></i></a>
        </div>
      </div>
    </div>

    <!-- SIG 6: Young IT Entrepreneurs -->
    <div class="sig-card startups">
      <div class="sig-card-header" data-label="YIT">
        <span class="sig-emoji">🚀</span>
        <h3>Young IT Entrepreneurs SIG</h3>
        <p>A vibrant community for next-generation IT business owners and entrepreneurs under 40 — focused on growth, mentorship, and shaping the future of Punjab's IT sector.</p>
      </div>
      <div class="sig-card-body">
        <div class="sig-focus-label">Focus Areas</div>
        <div class="sig-tags">
          <span class="sig-tag">Mentorship</span>
          <span class="sig-tag">Startup Support</span>
          <span class="sig-tag">Funding</span>
          <span class="sig-tag">Digital Marketing</span>
          <span class="sig-tag">Leadership</span>
        </div>
        <div class="sig-meta">
          <span class="sig-members"><i class="fas fa-users"></i> 100+ Members</span>
          <a href="#" class="sig-join-btn">Join SIG <i class="fas fa-arrow-right" style="font-size:10px"></i></a>
        </div>
      </div>
    </div>

  </div><!-- /sig-grid -->

  <!-- HOW TO JOIN -->
  <div class="join-band">
    <div class="eyebrow">Get Involved</div>
    <h2 class="sec-title">How to Join a <span class="hl">Special Interest Group</span></h2>
    <div class="join-steps">
      <div class="join-step">
        <div class="join-step-num">1</div>
        <h5>Become a P A C T Member</h5>
        <p>SIG membership is exclusively available to current P A C T members. If you're not yet a member, start your application today.</p>
      </div>
      <div class="join-step">
        <div class="join-step-num">2</div>
        <h5>Choose Your SIG(s)</h5>
        <p>Review the six active SIGs and select those that match your business domain. You can join multiple SIGs simultaneously.</p>
      </div>
      <div class="join-step">
        <div class="join-step-num">3</div>
        <h5>Submit Your Interest</h5>
        <p>Contact the P A C T Secretariat or submit a simple SIG enrolment form available at the Chandigarh office or online.</p>
      </div>
      <div class="join-step">
        <div class="join-step-num">4</div>
        <h5>Start Participating</h5>
        <p>Attend SIG meetings, connect with fellow members, participate in events, and contribute to working groups and advocacy efforts.</p>
      </div>
    </div>
  </div>

  <!-- UPCOMING SIG EVENTS -->
  <div class="sig-events-section">
    <div style="display:flex;align-items:flex-end;justify-content:space-between;gap:20px;flex-wrap:wrap;margin-bottom:28px">
      <div>
        <div class="eyebrow">SIG Activities</div>
        <h2 class="sec-title">Recent & Upcoming <span class="hl">SIG Events</span></h2>
      </div>
      <a href="events.html" style="display:inline-flex;align-items:center;gap:7px;font-size:13px;font-weight:700;color:var(--blue2);border-bottom:2px solid var(--border);padding-bottom:3px;transition:border-color .2s,gap .2s;white-space:nowrap">
        View All Events <i class="fas fa-arrow-right" style="font-size:11px"></i>
      </a>
    </div>

    <div class="sig-event-list">
      <div class="sig-event-row">
        <div class="sig-event-dot" style="background:#1E50A2"></div>
        <div class="sig-event-info">
          <h5>Hardware SIG — Import Duty Impact Roundtable</h5>
          <p>Discussion on revised customs duties on IT hardware components &amp; distributor impact</p>
        </div>
        <span class="sig-event-badge" style="background:rgba(30,80,162,.09);color:var(--blue2)">Hardware SIG</span>
        <span class="sig-event-date"><i class="fas fa-calendar" style="margin-right:5px;font-size:10px"></i>Mar 2026</span>
      </div>
      <div class="sig-event-row">
        <div class="sig-event-dot" style="background:#7C3AED"></div>
        <div class="sig-event-info">
          <h5>Software SIG — Microsoft Licensing Update Briefing</h5>
          <p>Understanding new Microsoft CSP licensing changes and their impact on resellers</p>
        </div>
        <span class="sig-event-badge" style="background:rgba(124,58,237,.09);color:#7C3AED">Software SIG</span>
        <span class="sig-event-date"><i class="fas fa-calendar" style="margin-right:5px;font-size:10px"></i>Feb 2026</span>
      </div>
      <div class="sig-event-row">
        <div class="sig-event-dot" style="background:#B91C1C"></div>
        <div class="sig-event-info">
          <h5>Cybersecurity SIG — Data Protection Act Seminar</h5>
          <p>Expert session on India's Digital Personal Data Protection Act 2023 compliance for IT businesses</p>
        </div>
        <span class="sig-event-badge" style="background:rgba(185,28,28,.09);color:#B91C1C">Security SIG</span>
        <span class="sig-event-date"><i class="fas fa-calendar" style="margin-right:5px;font-size:10px"></i>Jan 2026</span>
      </div>
      <div class="sig-event-row">
        <div class="sig-event-dot" style="background:#B45309"></div>
        <div class="sig-event-info">
          <h5>Young Entrepreneurs SIG — Mentorship Connect 2025</h5>
          <p>Speed mentoring session pairing young IT entrepreneurs with senior P A C T members</p>
        </div>
        <span class="sig-event-badge" style="background:rgba(180,83,9,.09);color:#B45309">Young IT SIG</span>
        <span class="sig-event-date"><i class="fas fa-calendar" style="margin-right:5px;font-size:10px"></i>Dec 2025</span>
      </div>
    </div>
  </div>

  <!-- CTA -->
  <div class="cta-strip">
    <div class="cta-text">
      <h3>Find Your Community Within P A C T</h3>
      <p>Join a Special Interest Group today and connect with fellow IT professionals in your exact domain. All SIGs are included in your P A C T membership — no extra fees, no extra forms.</p>
    </div>
    <div class="cta-btns">
      <a href="become-member.html" class="btn-gold"><i class="fas fa-user-plus"></i> Become a Member</a>
      <a href="contact.html" class="btn-ghost-w"><i class="fas fa-envelope"></i> Contact Secretariat</a>
    </div>
  </div>

</div><!-- /page-body -->
@endsection