@extends('layouts.frontend')
@section('title')
Profile
@endsection
<style>
    /* ── PAGE HERO / BREADCRUMB ── */
.page-hero{
  background:var(--navy);
  padding:60px 5% 70px;
  position:relative;
  overflow:hidden;
}
.page-hero::before{
  content:'';position:absolute;inset:0;
  background-image:linear-gradient(rgba(255,255,255,.04) 1px,transparent 1px),
                   linear-gradient(90deg,rgba(255,255,255,.04) 1px,transparent 1px);
  background-size:52px 52px;
}
.page-hero-glow{
  position:absolute;width:500px;height:500px;border-radius:50%;
  background:radial-gradient(circle,rgba(30,80,162,.35) 0%,transparent 70%);
  top:-150px;right:-80px;pointer-events:none;
}
.page-hero-inner{max-width:1280px;margin:0 auto;position:relative;z-index:1}
.breadcrumb{display:flex;align-items:center;gap:8px;margin-bottom:18px}
.breadcrumb a,.breadcrumb span{font-size:12px;color:rgba(255,255,255,.45);font-weight:500}
.breadcrumb a:hover{color:var(--gold2)}
.breadcrumb i{font-size:9px;color:rgba(255,255,255,.25)}
.breadcrumb .active{color:var(--gold2);font-weight:600}
.page-hero h1{font-size:clamp(28px,3.5vw,48px);font-weight:900;color:#fff;letter-spacing:-1px;margin-bottom:12px;line-height:1.1}
.page-hero h1 span{color:var(--gold2)}
.page-hero p{font-size:15px;color:rgba(255,255,255,.55);max-width:560px;line-height:1.75}
.page-hero-tag{display:inline-flex;align-items:center;gap:8px;background:rgba(245,166,35,.12);border:1px solid rgba(245,166,35,.25);padding:6px 16px;border-radius:30px;margin-bottom:20px}
.page-hero-tag span{font-size:11px;font-weight:700;color:var(--gold2);letter-spacing:1.5px;text-transform:uppercase}

/* ── MAIN CONTENT WRAPPER ── */
.page-body{max-width:1280px;margin:0 auto;padding:70px 5%}

/* ── SECTION COMMONS ── */
.eyebrow{font-size:11px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:var(--accent);margin-bottom:10px;display:flex;align-items:center;gap:8px}
.eyebrow::before{content:'';width:22px;height:2px;background:var(--accent);border-radius:2px;display:inline-block}
.sec-title{font-size:clamp(22px,2.5vw,34px);font-weight:800;color:var(--navy);line-height:1.2;margin-bottom:14px;letter-spacing:-.5px}
.sec-title .hl{color:var(--accent)}

/* ── INTRO BLOCK ── */
.intro-grid{display:grid;grid-template-columns:1.15fr .85fr;gap:64px;align-items:center;margin-bottom:80px}
.intro-text p{font-size:15px;color:var(--muted);line-height:1.85;margin-bottom:18px}
.intro-text p strong{color:var(--navy);font-weight:700}
.intro-text p:last-child{margin-bottom:0}

/* quote pull */
.pull-quote{margin:28px 0;padding:22px 28px;border-left:4px solid var(--gold);background:linear-gradient(90deg,rgba(245,166,35,.06),transparent);border-radius:0 12px 12px 0}
.pull-quote p{font-size:15px;font-style:italic;color:var(--navy);font-weight:600;line-height:1.65}
.pull-quote cite{display:block;font-size:12px;color:var(--muted);font-style:normal;margin-top:8px;font-weight:600}

/* founding card */
.founding-card{background:var(--navy);border-radius:22px;padding:36px;position:relative;overflow:hidden}
.founding-card::before{content:'1996';position:absolute;font-size:110px;font-weight:900;color:rgba(255,255,255,.04);right:-10px;bottom:-20px;letter-spacing:-4px;line-height:1;pointer-events:none}
.founding-badge{display:inline-flex;align-items:center;gap:8px;background:rgba(245,166,35,.15);border:1px solid rgba(245,166,35,.3);padding:6px 14px;border-radius:20px;margin-bottom:20px}
.founding-badge span{font-size:11px;font-weight:700;color:var(--gold2);letter-spacing:1px;text-transform:uppercase}
.founding-card h3{font-size:22px;font-weight:800;color:#fff;margin-bottom:12px;line-height:1.3}
.founding-card p{font-size:13px;color:rgba(255,255,255,.55);line-height:1.75;margin-bottom:22px}
.found-stats{display:grid;grid-template-columns:1fr 1fr;gap:12px}
.fstat{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.09);border-radius:12px;padding:16px 18px;text-align:center}
.fstat-n{font-size:26px;font-weight:900;color:var(--gold2);line-height:1}
.fstat-n sup{font-size:13px}
.fstat-l{font-size:10px;font-weight:600;color:rgba(255,255,255,.4);text-transform:uppercase;letter-spacing:.8px;margin-top:4px}

/* ── TIMELINE ── */
.timeline-section{margin-bottom:80px}
.timeline-section .sec-title{margin-bottom:40px}
.timeline{position:relative;padding-left:32px}
.timeline::before{content:'';position:absolute;left:0;top:8px;bottom:0;width:2px;background:linear-gradient(to bottom,var(--blue2),var(--border));border-radius:2px}
.tl-item{position:relative;margin-bottom:36px;padding-left:28px}
.tl-item:last-child{margin-bottom:0}
.tl-dot{position:absolute;left:-39px;top:6px;width:16px;height:16px;border-radius:50%;background:var(--blue2);border:3px solid var(--white);box-shadow:0 0 0 2px var(--blue2)}
.tl-item.gold .tl-dot{background:var(--gold);box-shadow:0 0 0 2px var(--gold)}
.tl-item.accent .tl-dot{background:var(--accent);box-shadow:0 0 0 2px var(--accent)}
.tl-year{font-size:11px;font-weight:700;color:var(--blue2);letter-spacing:1.5px;text-transform:uppercase;margin-bottom:4px}
.tl-item.gold .tl-year{color:var(--gold)}
.tl-item.accent .tl-year{color:var(--accent)}
.tl-title{font-size:15px;font-weight:700;color:var(--navy);margin-bottom:5px;line-height:1.35}
.tl-desc{font-size:13px;color:var(--muted);line-height:1.65}

/* ── PILLARS / MISSION VISION ── */
.mv-grid{display:grid;grid-template-columns:1fr 1fr 1fr;gap:20px;margin-bottom:80px}
.mv-card{border-radius:18px;padding:32px 28px;position:relative;overflow:hidden;border:1px solid var(--border);transition:transform .25s,box-shadow .25s}
.mv-card:hover{transform:translateY(-5px);box-shadow:var(--card-shadow-hover)}
.mv-card.mission{background:linear-gradient(140deg,var(--navy),var(--navy2))}
.mv-card.vision{background:var(--white)}
.mv-card.values{background:linear-gradient(140deg,#FFF8EC,#FFF3D6)}
.mv-ico{width:52px;height:52px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:22px;margin-bottom:22px}
.mv-card.mission .mv-ico{background:rgba(255,255,255,.1)}
.mv-card.vision .mv-ico{background:rgba(30,80,162,.08)}
.mv-card.values .mv-ico{background:rgba(245,166,35,.18)}
.mv-card h3{font-size:17px;font-weight:800;margin-bottom:10px;line-height:1.2}
.mv-card.mission h3{color:#fff}
.mv-card.vision h3{color:var(--navy)}
.mv-card.values h3{color:#7A4A00}
.mv-card p{font-size:13px;line-height:1.7}
.mv-card.mission p{color:rgba(255,255,255,.55)}
.mv-card.vision p{color:var(--muted)}
.mv-card.values p{color:#8B5E00}
.mv-label{display:inline-block;font-size:10px;font-weight:700;letter-spacing:2px;text-transform:uppercase;padding:4px 10px;border-radius:20px;margin-bottom:16px}
.mv-card.mission .mv-label{background:rgba(245,166,35,.2);color:var(--gold2)}
.mv-card.vision .mv-label{background:rgba(30,80,162,.08);color:var(--blue2)}
.mv-card.values .mv-label{background:rgba(245,166,35,.3);color:#7A4A00}

/* ── LEADERSHIP SNAPSHOT ── */
.leadership-section{margin-bottom:80px}
.leader-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:20px}
.leader-card{background:var(--white);border:1px solid var(--border);border-radius:16px;padding:24px 20px;text-align:center;transition:transform .25s,box-shadow .25s}
.leader-card:hover{transform:translateY(-5px);box-shadow:var(--card-shadow)}
.leader-avatar{width:64px;height:64px;border-radius:16px;background:linear-gradient(140deg,var(--blue2),var(--navy));display:flex;align-items:center;justify-content:center;font-size:20px;font-weight:900;color:#fff;margin:0 auto 14px;font-family:var(--font)}
.leader-avatar.gold{background:linear-gradient(140deg,var(--gold),#E08C00)}
.leader-card h5{font-size:14px;font-weight:700;color:var(--navy);margin-bottom:3px}
.leader-card span{font-size:11px;color:var(--muted);font-weight:500}
.leader-card .role-badge{display:inline-block;margin-top:10px;font-size:10px;font-weight:700;padding:3px 10px;border-radius:20px;background:rgba(30,80,162,.07);color:var(--blue2);border:1px solid rgba(30,80,162,.15)}
.leader-card .role-badge.president{background:rgba(245,166,35,.12);color:#7A4A00;border-color:rgba(245,166,35,.3)}

/* ── AFFILIATION STRIP ── */
.affil-section{background:var(--light);border-radius:22px;padding:40px 44px;margin-bottom:80px}
.affil-section h3{font-size:20px;font-weight:800;color:var(--navy);margin-bottom:6px}
.affil-section > p{font-size:14px;color:var(--muted);margin-bottom:28px}
.affil-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:14px}
.affil-item{background:#fff;border:1px solid var(--border);border-radius:12px;padding:18px 16px;display:flex;align-items:center;gap:12px;transition:box-shadow .2s,transform .2s}
.affil-item:hover{box-shadow:var(--card-shadow);transform:translateY(-2px)}
.affil-ico{width:40px;height:40px;border-radius:10px;background:rgba(30,80,162,.08);display:flex;align-items:center;justify-content:center;font-size:17px;flex-shrink:0;color:var(--blue2)}
.affil-name{font-size:12px;font-weight:700;color:var(--navy);line-height:1.3}
.affil-type{font-size:10px;color:var(--muted);font-weight:500;margin-top:2px}

/* ── CONTACT STRIP ── */
.contact-strip{background:var(--navy2);border-radius:22px;padding:40px 44px;display:flex;align-items:center;justify-content:space-between;gap:24px;flex-wrap:wrap}
.contact-strip h3{font-size:22px;font-weight:800;color:#fff;margin-bottom:6px}
.contact-strip p{font-size:14px;color:rgba(255,255,255,.5)}
.contact-details{display:flex;gap:28px;flex-wrap:wrap}
.cdet{display:flex;align-items:center;gap:10px}
.cdet i{width:36px;height:36px;border-radius:10px;background:rgba(255,255,255,.08);display:flex;align-items:center;justify-content:center;font-size:14px;color:var(--gold2);flex-shrink:0}
.cdet-info span{display:block;font-size:10px;color:rgba(255,255,255,.35);font-weight:600;text-transform:uppercase;letter-spacing:.8px}
.cdet-info a{font-size:13px;color:#fff;font-weight:600;transition:color .2s}
.cdet-info a:hover{color:var(--gold2)}

/* ── RESPONSIVE ── */
@media(max-width:1100px){
  .intro-grid{grid-template-columns:1fr;gap:40px}
  .mv-grid{grid-template-columns:1fr 1fr}
  .leader-grid{grid-template-columns:repeat(2,1fr)}
  .affil-grid{grid-template-columns:repeat(2,1fr)}
}
@media(max-width:700px){
  .page-body{padding:50px 5%}
  .mv-grid{grid-template-columns:1fr}
  .leader-grid{grid-template-columns:1fr 1fr}
  .affil-grid{grid-template-columns:1fr 1fr}
  .contact-strip{flex-direction:column;align-items:flex-start}
  .contact-details{flex-direction:column;gap:16px}
  .found-stats{grid-template-columns:1fr 1fr}
}
    </style>
@section('content')



<x-ui.page-hero title="Organisation Profile" subtitle="About Us" description="Get to know the story, structure, and spirit of Punjab & Chandigarh's leading IT trade body — P A C T.s"
    :breadcrumbs="[
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'About Us', 'url' => '#'],
        ['label' => 'Organisation Profile']
    ]"
>
   
</x-ui.page-hero>

<!-- MAIN CONTENT -->
<div class="page-body">

  <!-- INTRO -->
  <div class="intro-grid">
    <div class="intro-text">
      <div class="eyebrow">Who We Are</div>
      <h2 class="sec-title">Punjab Association of<br><span class="hl">Computer Traders</span></h2>

      <p><strong>Punjab Association of Computer Traders (P A C T)</strong> is the foremost representative body for IT entrepreneurs, traders, and businesses operating across Punjab and Chandigarh. Established in <strong>1996</strong>, P A C T has been the region's most trusted voice in the technology trade sector for nearly three decades.</p>

      <p>Headquartered in <strong>Chandigarh</strong>, the association unites over <strong>600 member businesses</strong> spanning hardware trading, software services, IT peripherals, system integration, and allied sectors. Our geographic reach extends across <strong>11+ city-level associations</strong> throughout Punjab, making us the largest IT trade network in the region.</p>

      <div class="pull-quote">
        <p>Together we will take P A C T to unprecedented heights — because teamwork makes the dream work, and our best chapters are still ahead.</p>
        <cite>— Sanjeev Walia, President, P A C T</cite>
      </div>

      <p>P A C T actively engages with both <strong>State and Central Government</strong> bodies to advocate for policies that protect and promote the interest of IT entrepreneurs. From GST compliance support and legal helpdesks to seminars, awards, and sports events — P A C T is far more than a trade association; it is a thriving community.</p>
    </div>

    <div>
      <div class="founding-card">
        <div class="founding-badge"><span>Est. 1996</span></div>
        <h3>Three Decades of Empowering IT Entrepreneurs</h3>
        <p>From a small collective of Chandigarh IT traders to a 600-strong association spanning all of Punjab — P A C T's journey reflects the growth of the region's technology industry itself.</p>
        <div class="found-stats">
          <div class="fstat">
            <div class="fstat-n">600<sup>+</sup></div>
            <div class="fstat-l">Active Members</div>
          </div>
          <div class="fstat">
            <div class="fstat-n">29<sup>yr</sup></div>
            <div class="fstat-l">Legacy</div>
          </div>
          <div class="fstat">
            <div class="fstat-n">11<sup>+</sup></div>
            <div class="fstat-l">City Assocs.</div>
          </div>
          <div class="fstat">
            <div class="fstat-n">50<sup>+</sup></div>
            <div class="fstat-l">Events / Year</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- MISSION / VISION / VALUES -->
  <div class="sec-title" style="margin-bottom:28px">Our <span class="hl">Mission, Vision & Values</span></div>
  <div class="mv-grid">
    <div class="mv-card mission">
      <span class="mv-label">Mission</span>
      <div class="mv-ico">🎯</div>
      <h3>Our Mission</h3>
      <p>To represent, support, and empower IT traders and entrepreneurs across Punjab & Chandigarh — through advocacy, knowledge sharing, networking, and community-driven initiatives that drive sustainable business growth.</p>
    </div>
    <div class="mv-card vision">
      <span class="mv-label">Vision</span>
      <div class="mv-ico" style="background:rgba(30,80,162,.08);color:var(--blue2);font-size:22px">🔭</div>
      <h3>Our Vision</h3>
      <p>To be the most impactful IT trade association in North India — a body that shapes policy, accelerates innovation, and creates an ecosystem where every IT entrepreneur can thrive at the highest level.</p>
    </div>
    <div class="mv-card values">
      <span class="mv-label">Values</span>
      <div class="mv-ico">⭐</div>
      <h3>Our Values</h3>
      <p>Integrity in advocacy. Inclusiveness for all members. Commitment to the community. Transparency in governance. Collaboration over competition — these are the principles that define how P A C T operates every day.</p>
    </div>
  </div>

  <!-- TIMELINE -->
  <div class="timeline-section">
    <div class="eyebrow">Our Journey</div>
    <h2 class="sec-title">Milestones That Shaped <span class="hl">P A C T</span></h2>

    <div class="timeline">
      <div class="tl-item gold">
        <div class="tl-dot"></div>
        <div class="tl-year">1996 — Foundation</div>
        <div class="tl-title">P A C T is Established in Chandigarh</div>
        <div class="tl-desc">A group of visionary IT traders in Chandigarh came together to form Punjab Association of Computer Traders, laying the foundation for the region's first dedicated IT trade body.</div>
      </div>
      <div class="tl-item">
        <div class="tl-dot"></div>
        <div class="tl-year">Early 2000s — Expansion</div>
        <div class="tl-title">Regional Expansion Across Punjab</div>
        <div class="tl-desc">P A C T extended its reach beyond Chandigarh, establishing city-level associations in Ludhiana, Amritsar, Jalandhar, and other major Punjab cities — creating the region's most extensive IT trade network.</div>
      </div>
      <div class="tl-item">
        <div class="tl-dot"></div>
        <div class="tl-year">2005–2010 — Advocacy</div>
        <div class="tl-title">Government Liaison & Policy Advocacy</div>
        <div class="tl-desc">P A C T established formal channels with State and Central Government bodies, becoming the primary voice for IT traders on issues of taxation, import policy, and digital infrastructure.</div>
      </div>
      <div class="tl-item accent">
        <div class="tl-dot"></div>
        <div class="tl-year">2017 — GST Era</div>
        <div class="tl-title">GST Helpdesk & Compliance Support</div>
        <div class="tl-desc">With the roll-out of GST, P A C T launched a dedicated helpdesk providing expert compliance guidance to all members, easing the transition and protecting businesses from penalties.</div>
      </div>
      <div class="tl-item">
        <div class="tl-dot"></div>
        <div class="tl-year">2020–2022 — Resilience</div>
        <div class="tl-title">Digital Pivot During the Pandemic</div>
        <div class="tl-desc">P A C T continued to serve members through virtual seminars, online networking, and digital circulars — supporting the IT community through one of its most challenging periods.</div>
      </div>
      <div class="tl-item gold">
        <div class="tl-dot"></div>
        <div class="tl-year">2025 — Annual Meet</div>
        <div class="tl-title">Punjab IT Mahakumbh — Annual Meet 2025</div>
        <div class="tl-desc">P A C T's biggest event yet — the Punjab IT Mahakumbh — brought together 600+ members, industry leaders, and government representatives to celebrate and shape the future of Punjab's IT sector.</div>
      </div>
    </div>
  </div>

  <!-- LEADERSHIP SNAPSHOT -->
  <div class="leadership-section">
    <div class="eyebrow">Leadership</div>
    <h2 class="sec-title">Current Office <span class="hl">Bearers</span></h2>

    <div class="leader-grid">
      <div class="leader-card">
        <div class="leader-avatar gold">SW</div>
        <h5>Sanjeev Walia</h5>
        <span>Chandigarh</span>
        <div class="role-badge president">⭐ President</div>
      </div>
      <div class="leader-card">
        <div class="leader-avatar">VP</div>
        <h5>Vice President</h5>
        <span>Punjab Region</span>
        <div class="role-badge">Vice President</div>
      </div>
      <div class="leader-card">
        <div class="leader-avatar">SG</div>
        <h5>Secretary General</h5>
        <span>Chandigarh HQ</span>
        <div class="role-badge">Secy. General</div>
      </div>
      <div class="leader-card">
        <div class="leader-avatar">TR</div>
        <h5>Treasurer</h5>
        <span>Punjab Region</span>
        <div class="role-badge">Treasurer</div>
      </div>
    </div>

    <div style="margin-top:22px;text-align:right">
      <a href="office-bearers.html" style="display:inline-flex;align-items:center;gap:7px;font-size:13px;font-weight:700;color:var(--blue2);border-bottom:2px solid var(--border);padding-bottom:3px;transition:border-color .2s,gap .2s">
        View Full Management Team <i class="fas fa-arrow-right" style="font-size:11px"></i>
      </a>
    </div>
  </div>

  <!-- AFFILIATIONS -->
  <div class="affil-section">
    <h3>Affiliations & Industry Bodies</h3>
    <p>P A C T is affiliated with and actively participates in leading national and regional IT industry organisations.</p>
    <div class="affil-grid">
      <div class="affil-item">
        <div class="affil-ico"><i class="fas fa-landmark"></i></div>
        <div>
          <div class="affil-name">MAIT</div>
          <div class="affil-type">Manufacturers' Association for IT</div>
        </div>
      </div>
      <div class="affil-item">
        <div class="affil-ico"><i class="fas fa-network-wired"></i></div>
        <div>
          <div class="affil-name">NASSCOM</div>
          <div class="affil-type">National IT Industry Body</div>
        </div>
      </div>
      <div class="affil-item">
        <div class="affil-ico"><i class="fas fa-city"></i></div>
        <div>
          <div class="affil-name">CII Punjab</div>
          <div class="affil-type">Confederation of Indian Industry</div>
        </div>
      </div>
      <div class="affil-item">
        <div class="affil-ico"><i class="fas fa-handshake"></i></div>
        <div>
          <div class="affil-name">FICCI</div>
          <div class="affil-type">Federation of Indian Chambers</div>
        </div>
      </div>
    </div>
  </div>

  <!-- CONTACT STRIP -->
  <div class="contact-strip">
    <div>
      <h3>Get in Touch with P A C T</h3>
      <p>Reach out to the Chandigarh headquarters for membership, partnerships, or general enquiries.</p>
    </div>
    <div class="contact-details">
      <div class="cdet">
        <i class="fas fa-phone-alt"></i>
        <div class="cdet-info">
          <span>Phone</span>
          <a href="tel:+919417223355">+91 94172-23355</a>
        </div>
      </div>
      <div class="cdet">
        <i class="fas fa-envelope"></i>
        <div class="cdet-info">
          <span>Email</span>
          <a href="mailto:info@pact.org.in">info@pact.org.in</a>
        </div>
      </div>
      <div class="cdet">
        <i class="fas fa-map-marker-alt"></i>
        <div class="cdet-info">
          <span>Location</span>
          <a href="#">Chandigarh, Punjab</a>
        </div>
      </div>
    </div>
  </div>

</div><!-- /page-body -->

@endsection
