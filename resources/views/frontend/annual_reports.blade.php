@extends('layouts.frontend')
@section('title') this is title @endsection
@section('content')
<style>
<style>
/* ── FEATURED REPORT ── */
.featured-report{
  background:linear-gradient(135deg,var(--navy2),var(--navy));
  border-radius:22px;padding:48px;margin-bottom:80px;
  display:grid;grid-template-columns:1fr auto;gap:48px;align-items:center;
  position:relative;overflow:hidden;border:1px solid rgba(30,80,162,.2);
}
.featured-report::after{
  content:'2024';position:absolute;font-size:160px;font-weight:900;
  color:rgba(255,255,255,.03);right:-10px;bottom:-20px;letter-spacing:-6px;line-height:1;pointer-events:none;
}
.feat-rep-tag{display:inline-flex;align-items:center;gap:8px;background:rgba(245,166,35,.15);border:1px solid rgba(245,166,35,.3);padding:6px 14px;border-radius:20px;margin-bottom:18px}
.feat-rep-tag span{font-size:11px;font-weight:700;color:var(--gold2);letter-spacing:1.5px;text-transform:uppercase}
.featured-report h2{font-size:clamp(22px,2.8vw,36px);font-weight:900;color:#fff;margin-bottom:12px;letter-spacing:-.5px;line-height:1.2}
.featured-report p{font-size:14px;color:rgba(255,255,255,.55);line-height:1.75;max-width:520px;margin-bottom:28px}
.feat-rep-stats{display:flex;gap:32px;margin-bottom:28px}
.feat-rep-stat .n{font-size:28px;font-weight:900;color:var(--gold2);line-height:1}
.feat-rep-stat .l{font-size:11px;color:rgba(255,255,255,.4);font-weight:600;text-transform:uppercase;letter-spacing:.8px;margin-top:3px}

.report-cover{
  width:180px;flex-shrink:0;
  background:linear-gradient(140deg,#1E50A2,#0C2F5E);
  border-radius:12px;padding:24px 20px;text-align:center;
  box-shadow:0 20px 60px rgba(0,0,0,.4);
  position:relative;z-index:1;
  border:1px solid rgba(255,255,255,.1);
}
.report-cover .cover-year{font-size:36px;font-weight:900;color:var(--gold2);line-height:1;margin-bottom:6px}
.report-cover .cover-label{font-size:10px;font-weight:700;color:rgba(255,255,255,.5);text-transform:uppercase;letter-spacing:1.2px;margin-bottom:16px}
.report-cover .cover-logo{font-size:32px;margin-bottom:12px}
.report-cover .cover-pact{font-size:14px;font-weight:900;color:#fff;letter-spacing:2px}
.report-cover .cover-sub{font-size:9px;color:rgba(255,255,255,.4);margin-top:3px;line-height:1.4}

/* ── FILTER BAR ── */
.filter-bar{
  display:flex;align-items:center;justify-content:space-between;
  gap:16px;flex-wrap:wrap;margin-bottom:36px;
}
.filter-pills{display:flex;gap:8px;flex-wrap:wrap}
.filter-pill{
  padding:8px 18px;border-radius:25px;font-size:12px;font-weight:600;
  border:1.5px solid var(--border);color:var(--muted);background:#fff;
  cursor:pointer;transition:all .2s;font-family:var(--font);
}
.filter-pill:hover{border-color:var(--blue2);color:var(--blue2)}
.filter-pill.active{background:var(--navy);border-color:var(--navy);color:var(--gold2)}

/* ── REPORT GRID ── */
.reports-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:22px;margin-bottom:80px}
.rep-card{
  background:#fff;border:1px solid var(--border);border-radius:18px;
  overflow:hidden;transition:transform .25s,box-shadow .25s;
}
.rep-card:hover{transform:translateY(-6px);box-shadow:var(--card-shadow-hover)}
.rep-card-header{
  padding:28px 24px;display:flex;flex-direction:column;align-items:center;
  text-align:center;position:relative;
}
.rep-year-badge{
  font-size:40px;font-weight:900;line-height:1;margin-bottom:8px;
}
.rep-title{font-size:14px;font-weight:700;color:#fff;margin-bottom:4px}
.rep-subtitle{font-size:11px;color:rgba(255,255,255,.6)}
.rep-card-body{padding:20px 22px}
.rep-highlights{display:flex;flex-direction:column;gap:8px;margin-bottom:16px}
.rep-hl{display:flex;align-items:center;gap:8px;font-size:12px;color:var(--muted)}
.rep-hl i{font-size:11px;color:var(--blue2);width:14px;text-align:center;flex-shrink:0}
.rep-footer{display:flex;align-items:center;justify-content:space-between;padding-top:14px;border-top:1px solid var(--border)}
.rep-size{font-size:11px;color:var(--muted);font-weight:500;display:flex;align-items:center;gap:5px}
.rep-size i{font-size:10px;color:var(--blue2)}
.rep-dl-btn{
  display:inline-flex;align-items:center;gap:6px;
  padding:8px 16px;border-radius:20px;font-size:12px;font-weight:700;
  background:var(--navy);color:var(--gold2);border:none;cursor:pointer;
  font-family:var(--font);transition:all .2s;
}
.rep-dl-btn:hover{background:var(--blue2);color:#fff}

/* ── STATS TIMELINE ── */
.stats-timeline{background:var(--light);border-radius:22px;padding:48px;margin-bottom:80px}
.st-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:0;margin-top:36px;border:1px solid var(--border);border-radius:14px;overflow:hidden;background:#fff}
.st-item{padding:24px 16px;text-align:center;border-right:1px solid var(--border)}
.st-item:last-child{border-right:none}
.st-year{font-size:13px;font-weight:800;color:var(--navy);margin-bottom:12px}
.st-bars{display:flex;flex-direction:column;gap:6px}
.st-bar-row{display:flex;align-items:center;gap:6px}
.st-bar-label{font-size:9px;color:var(--muted);font-weight:600;width:36px;text-align:right;flex-shrink:0}
.st-bar-wrap{flex:1;height:6px;background:var(--light);border-radius:3px;overflow:hidden}
.st-bar-fill{height:100%;border-radius:3px}
.st-bar-val{font-size:9px;color:var(--muted);font-weight:700;width:28px}

/* ── NEWSLETTER SIGNUP ── */
.newsletter-band{
  background:linear-gradient(135deg,var(--blue),var(--navy));
  border-radius:22px;padding:44px 48px;
  display:flex;align-items:center;justify-content:space-between;
  gap:32px;flex-wrap:wrap;position:relative;overflow:hidden;
}
.newsletter-band::after{content:'';position:absolute;width:300px;height:300px;border-radius:50%;border:2px solid rgba(255,255,255,.06);bottom:-150px;right:-80px;pointer-events:none}
.nl-text h3{font-size:22px;font-weight:900;color:#fff;margin-bottom:6px}
.nl-text p{font-size:14px;color:rgba(255,255,255,.55);line-height:1.6}
.nl-form{display:flex;gap:10px;flex-shrink:0;flex-wrap:wrap;position:relative;z-index:1}
.nl-form input{
  padding:12px 18px;border-radius:25px;border:1.5px solid rgba(255,255,255,.2);
  background:rgba(255,255,255,.1);color:#fff;font-family:var(--font);
  font-size:13px;outline:none;min-width:220px;
}
.nl-form input::placeholder{color:rgba(255,255,255,.4)}
.nl-form input:focus{border-color:var(--gold2)}

@media(max-width:1100px){
  .reports-grid{grid-template-columns:1fr 1fr}
  .st-grid{grid-template-columns:1fr 1fr 1fr}
  .st-item:nth-child(3){border-right:none}
  .featured-report{grid-template-columns:1fr}
  .report-cover{display:none}
}
@media(max-width:700px){
  .reports-grid{grid-template-columns:1fr}
  .st-grid{grid-template-columns:1fr 1fr}
  .newsletter-band{flex-direction:column;align-items:flex-start;padding:32px 24px}
  .nl-form{flex-direction:column;width:100%}
  .nl-form input{min-width:unset;width:100%}
  .feat-rep-stats{gap:20px}
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
      <span class="active">Annual Reports</span>
    </div>
    <div class="page-hero-tag"><span>About Us</span></div>
    <h1>Annual <span>Reports</span></h1>
    <p>Transparent reporting on PACT's activities, financials, membership growth, and impact — year by year since our founding.</p>
    <div class="hero-chips">
      <div class="hero-chip"><i class="fas fa-file-pdf"></i> PDF Downloads</div>
      <div class="hero-chip"><i class="fas fa-history"></i> Since 2010</div>
      <div class="hero-chip"><i class="fas fa-chart-bar"></i> Annual Statistics</div>
      <div class="hero-chip"><i class="fas fa-shield-alt"></i> Audited Accounts</div>
    </div>
  </div>
</div>

<div class="page-body">

  <!-- FEATURED LATEST REPORT -->
  <div class="featured-report">
    <div>
      <div class="feat-rep-tag"><span>📄 Latest Report</span></div>
      <h2>PACT Annual Report 2023–24</h2>
      <p>The most comprehensive record of PACT's activities, events, financials, membership statistics, and advocacy outcomes for the year 2023–24. Approved at the Annual General Meeting 2024.</p>
      <div class="feat-rep-stats">
        <div class="feat-rep-stat"><div class="n">620+</div><div class="l">Members</div></div>
        <div class="feat-rep-stat"><div class="n">54</div><div class="l">Events</div></div>
        <div class="feat-rep-stat"><div class="n">12</div><div class="l">Circulars</div></div>
        <div class="feat-rep-stat"><div class="n">6</div><div class="l">CSR Drives</div></div>
      </div>
      <div class="btn-group">
        <a href="#" class="btn-gold"><i class="fas fa-download"></i> Download PDF</a>
        <a href="#" class="btn-ghost-dark"><i class="fas fa-eye"></i> View Online</a>
      </div>
    </div>
    <div class="report-cover">
      <div class="cover-logo">📋</div>
      <div class="cover-year">2024</div>
      <div class="cover-label">Annual Report</div>
      <div class="cover-pact">P A C T</div>
      <div class="cover-sub">Punjab & Chandigarh<br>IT Association</div>
    </div>
  </div>

  <!-- FILTER + REPORTS GRID -->
  <div class="section-block">
    <div class="eyebrow">All Reports</div>
    <h2 class="sec-title" style="margin-bottom:28px">Download <span class="hl">Past Reports</span></h2>

    <div class="filter-bar">
      <div class="filter-pills">
        <div class="filter-pill active">All Years</div>
        <div class="filter-pill">2020–24</div>
        <div class="filter-pill">2015–19</div>
        <div class="filter-pill">2010–14</div>
      </div>
      <div class="search-bar" style="max-width:260px">
        <input type="text" placeholder="Search by year…">
        <button><i class="fas fa-search"></i></button>
      </div>
    </div>

    <div class="reports-grid">

      <div class="rep-card">
        <div class="rep-card-header" style="background:linear-gradient(135deg,#0C2F5E,#1E50A2)">
          <div class="rep-year-badge" style="color:var(--gold2)">2023–24</div>
          <div class="rep-title">Annual Report</div>
          <div class="rep-subtitle">Approved at AGM 2024</div>
        </div>
        <div class="rep-card-body">
          <div class="rep-highlights">
            <div class="rep-hl"><i class="fas fa-users"></i> 620+ Active Members</div>
            <div class="rep-hl"><i class="fas fa-calendar"></i> 54 Events Conducted</div>
            <div class="rep-hl"><i class="fas fa-landmark"></i> 8 Govt. Representations</div>
            <div class="rep-hl"><i class="fas fa-heart"></i> 6 CSR Initiatives</div>
          </div>
          <div class="rep-footer">
            <span class="rep-size"><i class="fas fa-file-pdf"></i> PDF · 4.2 MB</span>
            <button class="rep-dl-btn"><i class="fas fa-download"></i> Download</button>
          </div>
        </div>
      </div>

      <div class="rep-card">
        <div class="rep-card-header" style="background:linear-gradient(135deg,#2E1065,#6D28D9)">
          <div class="rep-year-badge" style="color:#C4A0FF">2022–23</div>
          <div class="rep-title">Annual Report</div>
          <div class="rep-subtitle">Approved at AGM 2023</div>
        </div>
        <div class="rep-card-body">
          <div class="rep-highlights">
            <div class="rep-hl"><i class="fas fa-users"></i> 605+ Active Members</div>
            <div class="rep-hl"><i class="fas fa-calendar"></i> 48 Events Conducted</div>
            <div class="rep-hl"><i class="fas fa-landmark"></i> 6 Govt. Representations</div>
            <div class="rep-hl"><i class="fas fa-heart"></i> 4 CSR Initiatives</div>
          </div>
          <div class="rep-footer">
            <span class="rep-size"><i class="fas fa-file-pdf"></i> PDF · 3.8 MB</span>
            <button class="rep-dl-btn"><i class="fas fa-download"></i> Download</button>
          </div>
        </div>
      </div>

      <div class="rep-card">
        <div class="rep-card-header" style="background:linear-gradient(135deg,#064E3B,#059669)">
          <div class="rep-year-badge" style="color:#6EDA9F">2021–22</div>
          <div class="rep-title">Annual Report</div>
          <div class="rep-subtitle">Approved at AGM 2022</div>
        </div>
        <div class="rep-card-body">
          <div class="rep-highlights">
            <div class="rep-hl"><i class="fas fa-users"></i> 592 Active Members</div>
            <div class="rep-hl"><i class="fas fa-calendar"></i> 42 Events Conducted</div>
            <div class="rep-hl"><i class="fas fa-landmark"></i> 5 Govt. Representations</div>
            <div class="rep-hl"><i class="fas fa-heart"></i> 5 CSR Initiatives</div>
          </div>
          <div class="rep-footer">
            <span class="rep-size"><i class="fas fa-file-pdf"></i> PDF · 3.5 MB</span>
            <button class="rep-dl-btn"><i class="fas fa-download"></i> Download</button>
          </div>
        </div>
      </div>

      <div class="rep-card">
        <div class="rep-card-header" style="background:linear-gradient(135deg,#78350F,#D97706)">
          <div class="rep-year-badge" style="color:#FED7AA">2020–21</div>
          <div class="rep-title">Annual Report</div>
          <div class="rep-subtitle">COVID-19 Resilience Year</div>
        </div>
        <div class="rep-card-body">
          <div class="rep-highlights">
            <div class="rep-hl"><i class="fas fa-users"></i> 576 Active Members</div>
            <div class="rep-hl"><i class="fas fa-calendar"></i> 22 Events (Virtual)</div>
            <div class="rep-hl"><i class="fas fa-landmark"></i> 9 Govt. Representations</div>
            <div class="rep-hl"><i class="fas fa-heart"></i> 8 COVID Relief Drives</div>
          </div>
          <div class="rep-footer">
            <span class="rep-size"><i class="fas fa-file-pdf"></i> PDF · 2.9 MB</span>
            <button class="rep-dl-btn"><i class="fas fa-download"></i> Download</button>
          </div>
        </div>
      </div>

      <div class="rep-card">
        <div class="rep-card-header" style="background:linear-gradient(135deg,#0C4A6E,#0284C7)">
          <div class="rep-year-badge" style="color:#7DD8FF">2019–20</div>
          <div class="rep-title">Annual Report</div>
          <div class="rep-subtitle">Approved at AGM 2020</div>
        </div>
        <div class="rep-card-body">
          <div class="rep-highlights">
            <div class="rep-hl"><i class="fas fa-users"></i> 558 Active Members</div>
            <div class="rep-hl"><i class="fas fa-calendar"></i> 51 Events Conducted</div>
            <div class="rep-hl"><i class="fas fa-landmark"></i> 7 Govt. Representations</div>
            <div class="rep-hl"><i class="fas fa-heart"></i> 3 CSR Initiatives</div>
          </div>
          <div class="rep-footer">
            <span class="rep-size"><i class="fas fa-file-pdf"></i> PDF · 3.1 MB</span>
            <button class="rep-dl-btn"><i class="fas fa-download"></i> Download</button>
          </div>
        </div>
      </div>

      <div class="rep-card">
        <div class="rep-card-header" style="background:linear-gradient(135deg,#7C1D1D,#DC2626)">
          <div class="rep-year-badge" style="color:#FCA5A5">2018–19</div>
          <div class="rep-title">Annual Report</div>
          <div class="rep-subtitle">Approved at AGM 2019</div>
        </div>
        <div class="rep-card-body">
          <div class="rep-highlights">
            <div class="rep-hl"><i class="fas fa-users"></i> 540 Active Members</div>
            <div class="rep-hl"><i class="fas fa-calendar"></i> 46 Events Conducted</div>
            <div class="rep-hl"><i class="fas fa-landmark"></i> 6 Govt. Representations</div>
            <div class="rep-hl"><i class="fas fa-heart"></i> 3 CSR Initiatives</div>
          </div>
          <div class="rep-footer">
            <span class="rep-size"><i class="fas fa-file-pdf"></i> PDF · 2.7 MB</span>
            <button class="rep-dl-btn"><i class="fas fa-download"></i> Download</button>
          </div>
        </div>
      </div>

    </div>
    <div style="display:flex;justify-content:center">
      <div class="pagination">
        <div class="page-item disabled"><i class="fas fa-chevron-left" style="font-size:11px"></i></div>
        <div class="page-item active">1</div>
        <div class="page-item">2</div>
        <div class="page-item">3</div>
        <div class="page-item"><i class="fas fa-chevron-right" style="font-size:11px"></i></div>
      </div>
    </div>
  </div>

  <!-- GROWTH STATS TIMELINE -->
  <div class="stats-timeline">
    <div class="eyebrow">Membership Growth</div>
    <h2 class="sec-title">Five Years of <span class="hl">Progress</span></h2>
    <div class="st-grid">
      <div class="st-item">
        <div class="st-year">2019–20</div>
        <div class="st-bars">
          <div class="st-bar-row"><span class="st-bar-label">Members</span><div class="st-bar-wrap"><div class="st-bar-fill" style="width:85%;background:var(--blue2)"></div></div><span class="st-bar-val">558</span></div>
          <div class="st-bar-row"><span class="st-bar-label">Events</span><div class="st-bar-wrap"><div class="st-bar-fill" style="width:90%;background:var(--gold)"></div></div><span class="st-bar-val">51</span></div>
          <div class="st-bar-row"><span class="st-bar-label">CSR</span><div class="st-bar-wrap"><div class="st-bar-fill" style="width:40%;background:var(--accent)"></div></div><span class="st-bar-val">3</span></div>
        </div>
      </div>
      <div class="st-item">
        <div class="st-year">2020–21</div>
        <div class="st-bars">
          <div class="st-bar-row"><span class="st-bar-label">Members</span><div class="st-bar-wrap"><div class="st-bar-fill" style="width:88%;background:var(--blue2)"></div></div><span class="st-bar-val">576</span></div>
          <div class="st-bar-row"><span class="st-bar-label">Events</span><div class="st-bar-wrap"><div class="st-bar-fill" style="width:38%;background:var(--gold)"></div></div><span class="st-bar-val">22</span></div>
          <div class="st-bar-row"><span class="st-bar-label">CSR</span><div class="st-bar-wrap"><div class="st-bar-fill" style="width:90%;background:var(--accent)"></div></div><span class="st-bar-val">8</span></div>
        </div>
      </div>
      <div class="st-item">
        <div class="st-year">2021–22</div>
        <div class="st-bars">
          <div class="st-bar-row"><span class="st-bar-label">Members</span><div class="st-bar-wrap"><div class="st-bar-fill" style="width:91%;background:var(--blue2)"></div></div><span class="st-bar-val">592</span></div>
          <div class="st-bar-row"><span class="st-bar-label">Events</span><div class="st-bar-wrap"><div class="st-bar-fill" style="width:75%;background:var(--gold)"></div></div><span class="st-bar-val">42</span></div>
          <div class="st-bar-row"><span class="st-bar-label">CSR</span><div class="st-bar-wrap"><div class="st-bar-fill" style="width:55%;background:var(--accent)"></div></div><span class="st-bar-val">5</span></div>
        </div>
      </div>
      <div class="st-item">
        <div class="st-year">2022–23</div>
        <div class="st-bars">
          <div class="st-bar-row"><span class="st-bar-label">Members</span><div class="st-bar-wrap"><div class="st-bar-fill" style="width:93%;background:var(--blue2)"></div></div><span class="st-bar-val">605</span></div>
          <div class="st-bar-row"><span class="st-bar-label">Events</span><div class="st-bar-wrap"><div class="st-bar-fill" style="width:85%;background:var(--gold)"></div></div><span class="st-bar-val">48</span></div>
          <div class="st-bar-row"><span class="st-bar-label">CSR</span><div class="st-bar-wrap"><div class="st-bar-fill" style="width:45%;background:var(--accent)"></div></div><span class="st-bar-val">4</span></div>
        </div>
      </div>
      <div class="st-item">
        <div class="st-year">2023–24</div>
        <div class="st-bars">
          <div class="st-bar-row"><span class="st-bar-label">Members</span><div class="st-bar-wrap"><div class="st-bar-fill" style="width:100%;background:var(--blue2)"></div></div><span class="st-bar-val">620</span></div>
          <div class="st-bar-row"><span class="st-bar-label">Events</span><div class="st-bar-wrap"><div class="st-bar-fill" style="width:96%;background:var(--gold)"></div></div><span class="st-bar-val">54</span></div>
          <div class="st-bar-row"><span class="st-bar-label">CSR</span><div class="st-bar-wrap"><div class="st-bar-fill" style="width:65%;background:var(--accent)"></div></div><span class="st-bar-val">6</span></div>
        </div>
      </div>
    </div>
  </div>

  <!-- NEWSLETTER SIGNUP -->
  <div class="newsletter-band" style="margin-bottom:80px">
    <div class="nl-text">
      <h3>Get New Reports in Your Inbox</h3>
      <p>Subscribe to receive PACT's Annual Report and key member circulars directly by email.</p>
    </div>
    <div class="nl-form">
      <input type="email" placeholder="Enter your email address">
      <button class="btn-gold"><i class="fas fa-paper-plane"></i> Subscribe</button>
    </div>
  </div>

  <!-- CTA -->
  <div class="cta-band-red">
    <div class="cta-band-text">
      <h3>Transparency is Our Commitment</h3>
      <p>PACT publishes audited annual reports and financial summaries for all members. Join PACT and stay informed about everything your association does for you.</p>
    </div>
    <div class="cta-band-btns">
      <a href="become-member.html" class="btn-white"><i class="fas fa-user-plus"></i> Join PACT</a>
      <a href="notifications.html" class="btn-ghost-dark"><i class="fas fa-bell"></i> View Circulars</a>
    </div>
  </div>
@endsections