@extends('layouts.frontend')
@section('title')
Page Title
@endsection

@section('content')
<style>
/* ── AWARDS HERO OVERRIDE ── */
.page-hero{ background: linear-gradient(135deg, var(--navy) 60%, #1a2a0a 100%);}
.hero-glow{ background: radial-gradient(circle, rgba(245,166,35,.3) 0%, transparent 70%);}

/* ── FEATURED AWARD BANNER ── */
.featured-band{
  background: linear-gradient(135deg,var(--navy2),var(--navy));
  border-radius:22px; padding:48px; margin-bottom:80px;
  display:grid; grid-template-columns:1fr auto; gap:40px; align-items:center;
  position:relative; overflow:hidden; border:1px solid rgba(245,166,35,.15);
}
.featured-band::before{
  content:'🏆'; position:absolute; font-size:220px;
  right:-20px; bottom:-40px; opacity:.06; pointer-events:none;
}
.featured-tag{display:inline-flex;align-items:center;gap:8px;background:rgba(245,166,35,.15);border:1px solid rgba(245,166,35,.3);padding:6px 14px;border-radius:20px;margin-bottom:16px}
.featured-tag span{font-size:11px;font-weight:700;color:var(--gold2);letter-spacing:1.5px;text-transform:uppercase}
.featured-band h2{font-size:clamp(22px,2.8vw,36px);font-weight:900;color:#fff;margin-bottom:12px;letter-spacing:-.5px;line-height:1.2}
.featured-band p{font-size:14px;color:rgba(255,255,255,.55);line-height:1.75;max-width:540px}
.featured-trophy{text-align:center;flex-shrink:0}
.trophy-circle{
  width:140px;height:140px;border-radius:50%;
  background:linear-gradient(140deg,var(--gold),#C47D00);
  display:flex;align-items:center;justify-content:center;
  font-size:64px; margin:0 auto 16px;
  box-shadow:0 0 0 12px rgba(245,166,35,.12), 0 0 0 24px rgba(245,166,35,.06);
}
.featured-trophy p{font-size:13px;font-weight:700;color:rgba(255,255,255,.6);text-align:center}

/* ── AWARD CATEGORY TABS ── */
.cat-tabs{display:flex;gap:10px;flex-wrap:wrap;margin-bottom:40px}
.cat-tab{
  padding:9px 20px;border-radius:25px;font-size:13px;font-weight:600;
  border:1.5px solid var(--border);color:var(--muted);background:#fff;
  cursor:pointer;transition:all .2s;font-family:var(--font);
  display:flex;align-items:center;gap:7px;
}
.cat-tab:hover{border-color:var(--blue2);color:var(--blue2)}
.cat-tab.active{background:var(--navy);border-color:var(--navy);color:var(--gold2);font-weight:700}

/* ── AWARD CARDS ── */
.awards-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin-bottom:80px}
.award-card{
  background:#fff;border:1px solid var(--border);border-radius:20px;
  overflow:hidden;transition:transform .25s,box-shadow .25s;
}
.award-card:hover{transform:translateY(-7px);box-shadow:var(--card-shadow-hover)}
.award-card-top{
  padding:32px 28px 24px;position:relative;overflow:hidden;
  display:flex;flex-direction:column;align-items:center;text-align:center;
}
.award-card-top::before{
  content:'';position:absolute;inset:0;
  background:linear-gradient(180deg,transparent 40%,rgba(0,0,0,.08));
}
.award-medal{
  width:72px;height:72px;border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  font-size:30px;margin-bottom:16px;position:relative;z-index:1;
  box-shadow:0 8px 24px rgba(0,0,0,.15);
}
.award-card-top h3{font-size:16px;font-weight:800;color:#fff;margin-bottom:6px;position:relative;z-index:1;line-height:1.3}
.award-card-top p{font-size:12px;color:rgba(255,255,255,.7);position:relative;z-index:1;line-height:1.5}
.award-year-badge{
  position:absolute;top:14px;right:14px;
  background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.25);
  padding:3px 10px;border-radius:20px;font-size:10px;font-weight:700;color:#fff;
}
.award-card-body{padding:22px 24px}
.award-winner-row{display:flex;align-items:center;gap:12px;margin-bottom:14px}
.award-winner-avatar{
  width:40px;height:40px;border-radius:10px;
  background:linear-gradient(140deg,var(--blue2),var(--navy));
  display:flex;align-items:center;justify-content:center;
  font-size:14px;font-weight:800;color:#fff;flex-shrink:0;font-family:var(--font);
}
.award-winner-info strong{display:block;font-size:13px;font-weight:700;color:var(--navy);margin-bottom:2px}
.award-winner-info span{font-size:11px;color:var(--muted)}
.award-desc{font-size:12px;color:var(--muted);line-height:1.65;margin-bottom:14px}
.award-footer{display:flex;align-items:center;justify-content:space-between}
.award-cat-tag{font-size:10px;font-weight:700;padding:3px 10px;border-radius:20px;text-transform:uppercase;letter-spacing:.5px}

/* ── HALL OF FAME ── */
.hof-section{margin-bottom:80px}
.hof-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:18px}
.hof-card{
  background:var(--white);border:1px solid var(--border);border-radius:16px;
  padding:24px 18px;text-align:center;
  transition:transform .25s,box-shadow .25s;position:relative;overflow:hidden;
}
.hof-card:hover{transform:translateY(-5px);box-shadow:var(--card-shadow)}
.hof-card::before{content:attr(data-rank);position:absolute;top:-8px;right:10px;font-size:60px;font-weight:900;color:rgba(7,17,31,.04);line-height:1}
.hof-avatar{
  width:58px;height:58px;border-radius:14px;
  background:linear-gradient(140deg,var(--blue2),var(--navy));
  display:flex;align-items:center;justify-content:center;
  font-size:18px;font-weight:900;color:#fff;margin:0 auto 12px;
}
.hof-avatar.gold-av{background:linear-gradient(140deg,var(--gold),#C47D00)}
.hof-card h5{font-size:13px;font-weight:700;color:var(--navy);margin-bottom:3px}
.hof-card .hof-firm{font-size:11px;color:var(--muted);margin-bottom:8px}
.hof-award-name{font-size:11px;font-weight:700;padding:3px 10px;border-radius:20px;display:inline-block}
.hof-year{font-size:10px;color:var(--muted);margin-top:6px}

/* ── NOMINATION BAND ── */
.nom-band{
  background:linear-gradient(135deg,var(--navy2),var(--navy));
  border-radius:22px;padding:52px 48px;margin-bottom:80px;
  display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:center;
  position:relative;overflow:hidden;
}
.nom-band::after{
  content:'';position:absolute;
  width:400px;height:400px;border-radius:50%;
  background:radial-gradient(circle,rgba(245,166,35,.1) 0%,transparent 70%);
  top:-100px;right:-100px;pointer-events:none;
}
.nom-text .eyebrow{color:var(--gold2)}
.nom-text .eyebrow::before{background:var(--gold2)}
.nom-text h2{font-size:clamp(20px,2.5vw,30px);font-weight:900;color:#fff;margin-bottom:12px;letter-spacing:-.3px}
.nom-text p{font-size:14px;color:rgba(255,255,255,.55);line-height:1.75}
.nom-form{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.09);border-radius:16px;padding:28px;position:relative;z-index:1}
.nom-form .form-label{color:rgba(255,255,255,.7)}
.nom-form .form-control{background:rgba(255,255,255,.08);border-color:rgba(255,255,255,.15);color:#fff}
.nom-form .form-control::placeholder{color:rgba(255,255,255,.3)}
.nom-form .form-control:focus{border-color:var(--gold2);box-shadow:0 0 0 3px rgba(245,166,35,.15)}

/* ── PAST YEARS STRIP ── */
.year-strip{display:flex;gap:10px;flex-wrap:wrap;margin-bottom:40px}
.year-pill{
  padding:8px 20px;border-radius:25px;font-size:13px;font-weight:700;
  border:1.5px solid var(--border);color:var(--muted);background:#fff;
  cursor:pointer;transition:all .2s;font-family:var(--font);
}
.year-pill:hover{border-color:var(--blue2);color:var(--blue2)}
.year-pill.active{background:var(--navy);border-color:var(--navy);color:var(--gold2)}

@media(max-width:1100px){
  .awards-grid{grid-template-columns:1fr 1fr}
  .hof-grid{grid-template-columns:1fr 1fr}
  .nom-band{grid-template-columns:1fr}
  .featured-band{grid-template-columns:1fr}
  .featured-trophy{display:none}
}
@media(max-width:700px){
  .awards-grid{grid-template-columns:1fr}
  .hof-grid{grid-template-columns:1fr 1fr}
  .nom-band{padding:32px 24px}
}
</style>


<div class="page-hero">
  <div class="hero-glow"></div>
  <div class="hero-glow2"></div>
  <div class="page-hero-inner">
    <div class="breadcrumb">
      <a href="index.html"><i class="fas fa-home"></i> Home</a>
      <i class="fas fa-chevron-right"></i>
      <a href="#">About Us</a>
      <i class="fas fa-chevron-right"></i>
      <span class="active">Awards & Recognition</span>
    </div>
    <div class="page-hero-tag"><span>About Us</span></div>
    <h1>Awards & <span>Recognition</span></h1>
    <p>Celebrating excellence across Punjab & Chandigarh's IT trading community — honouring the businesses and individuals who go above and beyond.</p>
    <div class="hero-chips">
      <div class="hero-chip"><i class="fas fa-trophy"></i> 5+ Award Categories</div>
      <div class="hero-chip"><i class="fas fa-calendar-alt"></i> Annual Ceremony</div>
      <div class="hero-chip"><i class="fas fa-users"></i> 600+ Eligible Members</div>
      <div class="hero-chip"><i class="fas fa-star"></i> Since 2002</div>
    </div>
  </div>
</div>

<div class="page-body">

  <!-- FEATURED BANNER -->
  <div class="featured-band">
    <div>
      <div class="featured-tag"><span>✨ Awards Season 2025</span></div>
      <h2>PACT Excellence Awards 2025 — Nominations Now Open</h2>
      <p>The most prestigious recognition in Punjab & Chandigarh's IT trade sector. Nominate deserving businesses and individuals before the deadline. Winners will be felicitated at the Annual Meet 2025 — Punjab IT Mahakumbh.</p>
      <div class="btn-group" style="margin-top:24px">
        <a href="#nominate" class="btn-gold"><i class="fas fa-pen"></i> Nominate Now</a>
        <a href="#categories" class="btn-ghost-dark"><i class="fas fa-list"></i> View Categories</a>
      </div>
    </div>
    <div class="featured-trophy">
      <div class="trophy-circle">🏆</div>
      <p>PACT Excellence<br>Awards 2025</p>
    </div>
  </div>

  <!-- AWARD CATEGORIES -->
  <div id="categories" class="section-block">
    <div class="eyebrow">Award Categories</div>
    <h2 class="sec-title">This Year's <span class="hl">Award Categories</span></h2>
    <p class="sec-sub">Six prestigious awards recognising different dimensions of excellence in Punjab & Chandigarh's IT trading community.</p>

    <div class="awards-grid">
      <div class="award-card">
        <div class="award-card-top" style="background:linear-gradient(140deg,#0C2F5E,#1E50A2)">
          <span class="award-year-badge">2025</span>
          <div class="award-medal" style="background:linear-gradient(140deg,#FFD700,#FFA500)">🏆</div>
          <h3>Best IT Trader of the Year</h3>
          <p>Recognising the most outstanding IT trading business across Punjab & Chandigarh</p>
        </div>
        <div class="award-card-body">
          <div class="award-desc">Awarded to the member business that has demonstrated exceptional growth, customer service, ethical trade practices, and overall contribution to the IT ecosystem in the region.</div>
          <div class="award-footer">
            <span class="award-cat-tag" style="background:rgba(30,80,162,.09);color:var(--blue2)">Business Excellence</span>
            <a href="#nominate" style="font-size:12px;font-weight:700;color:var(--blue2);display:flex;align-items:center;gap:5px">Nominate <i class="fas fa-arrow-right" style="font-size:10px"></i></a>
          </div>
        </div>
      </div>

      <div class="award-card">
        <div class="award-card-top" style="background:linear-gradient(140deg,#78350F,#D97706)">
          <span class="award-year-badge">2025</span>
          <div class="award-medal" style="background:linear-gradient(140deg,#C0C0C0,#A0A0A0)">🥈</div>
          <h3>Best New Entrant Award</h3>
          <p>For businesses that joined the IT trade in the last 3 years and shown exceptional promise</p>
        </div>
        <div class="award-card-body">
          <div class="award-desc">Celebrating the most impressive debut by a new IT trading business — judged on growth trajectory, innovation, community engagement, and business acumen.</div>
          <div class="award-footer">
            <span class="award-cat-tag" style="background:rgba(217,119,6,.1);color:#92400E">New Business</span>
            <a href="#nominate" style="font-size:12px;font-weight:700;color:var(--blue2);display:flex;align-items:center;gap:5px">Nominate <i class="fas fa-arrow-right" style="font-size:10px"></i></a>
          </div>
        </div>
      </div>

      <div class="award-card">
        <div class="award-card-top" style="background:linear-gradient(140deg,#064E3B,#059669)">
          <span class="award-year-badge">2025</span>
          <div class="award-medal" style="background:linear-gradient(140deg,#CD7F32,#A0522D)">🥉</div>
          <h3>CSR Excellence Award</h3>
          <p>Honouring the member that has made the greatest contribution to community welfare</p>
        </div>
        <div class="award-card-body">
          <div class="award-desc">Recognising IT businesses and individuals who have gone beyond profit to invest meaningfully in healthcare, education, and community upliftment across Punjab & Chandigarh.</div>
          <div class="award-footer">
            <span class="award-cat-tag" style="background:rgba(5,150,105,.09);color:#065F46">Social Impact</span>
            <a href="#nominate" style="font-size:12px;font-weight:700;color:var(--blue2);display:flex;align-items:center;gap:5px">Nominate <i class="fas fa-arrow-right" style="font-size:10px"></i></a>
          </div>
        </div>
      </div>

      <div class="award-card">
        <div class="award-card-top" style="background:linear-gradient(140deg,#2E1065,#6D28D9)">
          <span class="award-year-badge">2025</span>
          <div class="award-medal" style="background:linear-gradient(140deg,#7C3AED,#5B21B6)">💡</div>
          <h3>Innovation & Technology Award</h3>
          <p>For the member who has most effectively embraced new technology and innovation</p>
        </div>
        <div class="award-card-body">
          <div class="award-desc">Celebrating IT businesses that have led the way in adopting new technologies, creating innovative solutions, or helping customers embrace digital transformation.</div>
          <div class="award-footer">
            <span class="award-cat-tag" style="background:rgba(124,58,237,.09);color:#6D28D9">Innovation</span>
            <a href="#nominate" style="font-size:12px;font-weight:700;color:var(--blue2);display:flex;align-items:center;gap:5px">Nominate <i class="fas fa-arrow-right" style="font-size:10px"></i></a>
          </div>
        </div>
      </div>

      <div class="award-card">
        <div class="award-card-top" style="background:linear-gradient(140deg,#7C1D1D,#DC2626)">
          <span class="award-year-badge">2025</span>
          <div class="award-medal" style="background:linear-gradient(140deg,var(--gold),#C47D00)">⭐</div>
          <h3>Lifetime Achievement Award</h3>
          <p>The highest honour — for a lifetime of contribution to Punjab & Chandigarh's IT sector</p>
        </div>
        <div class="award-card-body">
          <div class="award-desc">Awarded to an individual who has, over a career spanning decades, made an indelible contribution to growing and shaping the IT trade ecosystem in Punjab & Chandigarh.</div>
          <div class="award-footer">
            <span class="award-cat-tag" style="background:rgba(245,166,35,.12);color:#7A4A00">Lifetime</span>
            <a href="#nominate" style="font-size:12px;font-weight:700;color:var(--blue2);display:flex;align-items:center;gap:5px">Nominate <i class="fas fa-arrow-right" style="font-size:10px"></i></a>
          </div>
        </div>
      </div>

      <div class="award-card">
        <div class="award-card-top" style="background:linear-gradient(140deg,#0C4A6E,#0284C7)">
          <span class="award-year-badge">2025</span>
          <div class="award-medal" style="background:linear-gradient(140deg,#0EA5E9,#0369A1)">🤝</div>
          <h3>Best Association Award</h3>
          <p>For the most active and impactful city-level association affiliated with PACT</p>
        </div>
        <div class="award-card-body">
          <div class="award-desc">Recognising the city-level IT association that has demonstrated the most growth, member engagement, advocacy activity, and community contribution during the year.</div>
          <div class="award-footer">
            <span class="award-cat-tag" style="background:rgba(14,165,233,.1);color:#0369A1">Association</span>
            <a href="#nominate" style="font-size:12px;font-weight:700;color:var(--blue2);display:flex;align-items:center;gap:5px">Nominate <i class="fas fa-arrow-right" style="font-size:10px"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- HALL OF FAME -->
  <div class="hof-section">
    <div style="display:flex;align-items:flex-end;justify-content:space-between;gap:20px;flex-wrap:wrap;margin-bottom:18px">
      <div>
        <div class="eyebrow">Past Winners</div>
        <h2 class="sec-title">Hall of <span class="hl">Fame</span></h2>
      </div>
      <div class="year-strip">
        <div class="year-pill active">2024</div>
        <div class="year-pill">2023</div>
        <div class="year-pill">2022</div>
        <div class="year-pill">2021</div>
        <div class="year-pill">All Years</div>
      </div>
    </div>

    <div class="hof-grid">
      <div class="hof-card" data-rank="01">
        <div class="hof-avatar gold-av">RK</div>
        <h5>Rajesh Kumar</h5>
        <div class="hof-firm">RK Computers, Chandigarh</div>
        <div class="hof-award-name" style="background:rgba(245,166,35,.12);color:#7A4A00">Best IT Trader 2024</div>
        <div class="hof-year">Annual Meet 2024</div>
      </div>
      <div class="hof-card" data-rank="02">
        <div class="hof-avatar">PS</div>
        <h5>Priya Sharma</h5>
        <div class="hof-firm">TechVision, Ludhiana</div>
        <div class="hof-award-name" style="background:rgba(124,58,237,.09);color:#6D28D9">Innovation 2024</div>
        <div class="hof-year">Annual Meet 2024</div>
      </div>
      <div class="hof-card" data-rank="03">
        <div class="hof-avatar" style="background:linear-gradient(140deg,#059669,#064E3B)">AM</div>
        <h5>Amit Mehta</h5>
        <div class="hof-firm">DigiCare, Amritsar</div>
        <div class="hof-award-name" style="background:rgba(5,150,105,.09);color:#065F46">CSR Excellence 2024</div>
        <div class="hof-year">Annual Meet 2024</div>
      </div>
      <div class="hof-card" data-rank="04">
        <div class="hof-avatar" style="background:linear-gradient(140deg,var(--accent),#8B1A06)">SK</div>
        <h5>Suresh Kapoor</h5>
        <div class="hof-firm">Kapoor IT Solutions, Jalandhar</div>
        <div class="hof-award-name" style="background:rgba(224,58,18,.08);color:var(--accent)">Lifetime Achievement 2024</div>
        <div class="hof-year">Annual Meet 2024</div>
      </div>
      <div class="hof-card" data-rank="05">
        <div class="hof-avatar">NB</div>
        <h5>Neha Bhasin</h5>
        <div class="hof-firm">CloudBridge, Mohali</div>
        <div class="hof-award-name" style="background:rgba(30,80,162,.09);color:var(--blue2)">Best New Entrant 2024</div>
        <div class="hof-year">Annual Meet 2024</div>
      </div>
      <div class="hof-card" data-rank="06">
        <div class="hof-avatar" style="background:linear-gradient(140deg,#0284C7,#0C4A6E)">PA</div>
        <h5>Patiala IT Association</h5>
        <div class="hof-firm">Patiala</div>
        <div class="hof-award-name" style="background:rgba(14,165,233,.1);color:#0369A1">Best Association 2024</div>
        <div class="hof-year">Annual Meet 2024</div>
      </div>
      <div class="hof-card" data-rank="07">
        <div class="hof-avatar gold-av">VG</div>
        <h5>Vikram Gupta</h5>
        <div class="hof-firm">NextGen IT, Ludhiana</div>
        <div class="hof-award-name" style="background:rgba(245,166,35,.12);color:#7A4A00">Best IT Trader 2023</div>
        <div class="hof-year">Annual Meet 2023</div>
      </div>
      <div class="hof-card" data-rank="08">
        <div class="hof-avatar" style="background:linear-gradient(140deg,#6D28D9,#2E1065)">MK</div>
        <h5>Mohan Kumar</h5>
        <div class="hof-firm">SecureIT, Chandigarh</div>
        <div class="hof-award-name" style="background:rgba(124,58,237,.09);color:#6D28D9">Innovation 2023</div>
        <div class="hof-year">Annual Meet 2023</div>
      </div>
    </div>
  </div>

  <!-- NOMINATION FORM -->
  <div id="nominate" class="nom-band">
    <div class="nom-text">
      <div class="eyebrow ew-gold2">Nominations Open</div>
      <h2>Nominate for PACT Excellence Awards 2025</h2>
      <p>Know an IT trader or business that deserves recognition? Submit your nomination before the deadline. All nominations are reviewed by the PACT Awards Committee.</p>
      <div style="margin-top:24px;display:flex;flex-direction:column;gap:10px">
        <div style="display:flex;align-items:center;gap:10px;font-size:13px;color:rgba(255,255,255,.6)">
          <i class="fas fa-calendar" style="color:var(--gold2);font-size:12px"></i>
          Nomination Deadline: <strong style="color:#fff">30 September 2025</strong>
        </div>
        <div style="display:flex;align-items:center;gap:10px;font-size:13px;color:rgba(255,255,255,.6)">
          <i class="fas fa-gavel" style="color:var(--gold2);font-size:12px"></i>
          Judging: <strong style="color:#fff">October 2025</strong>
        </div>
        <div style="display:flex;align-items:center;gap:10px;font-size:13px;color:rgba(255,255,255,.6)">
          <i class="fas fa-trophy" style="color:var(--gold2);font-size:12px"></i>
          Ceremony: <strong style="color:#fff">PACT Annual Meet 2025</strong>
        </div>
      </div>
    </div>
    <div class="nom-form">
      <div class="form-group">
        <label class="form-label">Your Name <span class="req">*</span></label>
        <input type="text" class="form-control" placeholder="Your full name">
      </div>
      <div class="form-group">
        <label class="form-label">Nominee Name / Firm <span class="req">*</span></label>
        <input type="text" class="form-control" placeholder="Name of person or firm">
      </div>
      <div class="form-group">
        <label class="form-label">Award Category <span class="req">*</span></label>
        <select class="form-control">
          <option value="">— Select Category —</option>
          <option>Best IT Trader of the Year</option>
          <option>Best New Entrant Award</option>
          <option>CSR Excellence Award</option>
          <option>Innovation & Technology Award</option>
          <option>Lifetime Achievement Award</option>
          <option>Best Association Award</option>
        </select>
      </div>
      <div class="form-group">
        <label class="form-label">Reason for Nomination <span class="req">*</span></label>
        <textarea class="form-control" rows="3" placeholder="Why does this person / firm deserve this award?"></textarea>
      </div>
      <button class="btn-gold" style="width:100%;justify-content:center">
        <i class="fas fa-paper-plane"></i> Submit Nomination
      </button>
    </div>
  </div>

  <!-- CTA -->
  <div class="cta-band-red">
    <div class="cta-band-text">
      <h3>Be Part of the Most Celebrated Night in Punjab IT</h3>
      <p>The PACT Excellence Awards ceremony is the highlight of the Annual Meet. Join 600+ IT traders to celebrate the best in the business.</p>
    </div>
    <div class="cta-band-btns">
      <a href="events.html" class="btn-white"><i class="fas fa-ticket-alt"></i> Register for Annual Meet</a>
      <a href="become-member.html" class="btn-ghost-dark"><i class="fas fa-user-plus"></i> Join PACT</a>
    </div>
  </div>

</div>
@endsection