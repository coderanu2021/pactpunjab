@extends('layouts.frontend');
@Section('title')Profile @endsection
@section('content')
<style>
/* ── COMMONS ── */
.eyebrow{font-size:11px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:var(--accent);margin-bottom:10px;display:flex;align-items:center;gap:8px}
.eyebrow::before{content:'';width:22px;height:2px;background:var(--accent);border-radius:2px;display:inline-block}
.sec-title{font-size:clamp(22px,2.5vw,34px);font-weight:800;color:var(--navy);line-height:1.2;margin-bottom:14px;letter-spacing:-.5px}
.sec-title .hl{color:var(--accent)}
.sec-sub{font-size:15px;color:var(--muted);line-height:1.75;max-width:640px;margin-bottom:48px}

/* ── INTRO BANNER ── */
.intro-banner{display:grid;grid-template-columns:1.2fr .8fr;gap:56px;align-items:center;margin-bottom:80px}
.intro-banner p{font-size:15px;color:var(--muted);line-height:1.85;margin-bottom:16px}
.intro-banner p strong{color:var(--navy);font-weight:700}
.intro-banner p:last-child{margin-bottom:0}

.aim-card{background:linear-gradient(140deg,var(--navy),var(--navy2));border-radius:22px;padding:36px;position:relative;overflow:hidden}
.aim-card::after{content:'AIM';position:absolute;font-size:90px;font-weight:900;color:rgba(255,255,255,.04);right:-8px;bottom:-10px;letter-spacing:-3px;line-height:1}
.aim-card-label{display:inline-flex;align-items:center;gap:8px;background:rgba(245,166,35,.15);border:1px solid rgba(245,166,35,.3);padding:6px 14px;border-radius:20px;margin-bottom:20px}
.aim-card-label span{font-size:11px;font-weight:700;color:var(--gold2);letter-spacing:1px;text-transform:uppercase}
.aim-card h3{font-size:20px;font-weight:800;color:#fff;line-height:1.3;margin-bottom:14px}
.aim-card p{font-size:13px;color:rgba(255,255,255,.55);line-height:1.8;position:relative;z-index:1}
.aim-divider{height:1px;background:rgba(255,255,255,.08);margin:20px 0}
.aim-quick{display:flex;flex-direction:column;gap:10px;position:relative;z-index:1}
.aim-quick-item{display:flex;align-items:center;gap:10px;font-size:13px;color:rgba(255,255,255,.7);font-weight:500}
.aim-quick-item i{color:var(--gold2);font-size:12px;flex-shrink:0}

/* ── OBJECTIVES NUMBERED GRID ── */
.obj-section{margin-bottom:80px}
.obj-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:22px}
.obj-card{background:var(--white);border:1px solid var(--border);border-radius:18px;padding:28px 24px;position:relative;overflow:hidden;transition:transform .25s,box-shadow .25s}
.obj-card:hover{transform:translateY(-6px);box-shadow:var(--card-shadow-hover)}
.obj-card::before{content:attr(data-num);position:absolute;top:-10px;right:16px;font-size:80px;font-weight:900;color:rgba(30,80,162,.05);line-height:1;pointer-events:none}
.obj-ico{width:48px;height:48px;border-radius:13px;display:flex;align-items:center;justify-content:center;font-size:20px;margin-bottom:18px;flex-shrink:0}
.obj-ico.blue{background:rgba(30,80,162,.09);color:var(--blue2)}
.obj-ico.red{background:rgba(224,58,18,.09);color:var(--accent)}
.obj-ico.gold{background:rgba(245,166,35,.14);color:#C47D00}
.obj-ico.green{background:rgba(16,140,80,.09);color:#108C50}
.obj-ico.purple{background:rgba(120,60,200,.09);color:#7C3AED}
.obj-ico.teal{background:rgba(14,165,233,.1);color:#0EA5E9}
.obj-ico.navy{background:rgba(7,17,31,.07);color:var(--navy)}
.obj-ico.orange{background:rgba(234,88,12,.1);color:#EA580C}
.obj-ico.pink{background:rgba(219,39,119,.08);color:#DB2777}
.obj-card h4{font-size:15px;font-weight:700;color:var(--navy);margin-bottom:8px;line-height:1.35}
.obj-card p{font-size:13px;color:var(--muted);line-height:1.68}

/* ── FOCUS AREAS (WIDE BAND) ── */
.focus-band{background:var(--navy2);border-radius:22px;padding:52px 48px;margin-bottom:80px;position:relative;overflow:hidden}
.focus-band::before{content:'FOCUS';position:absolute;font-size:160px;font-weight:900;color:rgba(255,255,255,.03);right:-20px;top:50%;transform:translateY(-50%);letter-spacing:-6px;pointer-events:none}
.focus-band .eyebrow{color:var(--gold2)}
.focus-band .eyebrow::before{background:var(--gold2)}
.focus-band .sec-title{color:#fff}
.focus-band .sec-title .hl{color:var(--gold2)}
.focus-band .sec-sub{color:rgba(255,255,255,.5);margin-bottom:36px}
.focus-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;position:relative;z-index:1}
.focus-item{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.09);border-radius:14px;padding:22px 18px;text-align:center;transition:background .2s,border-color .2s,transform .2s}
.focus-item:hover{background:rgba(255,255,255,.09);border-color:rgba(255,255,255,.18);transform:translateY(-3px)}
.focus-item-ico{font-size:32px;margin-bottom:12px}
.focus-item h5{font-size:13px;font-weight:700;color:#fff;margin-bottom:6px}
.focus-item p{font-size:11px;color:rgba(255,255,255,.45);line-height:1.6}

/* ── HOW WE WORK ── */
.how-section{margin-bottom:80px}
.how-steps{display:grid;grid-template-columns:repeat(4,1fr);gap:0;position:relative}
.how-steps::before{content:'';position:absolute;top:36px;left:calc(12.5%);right:calc(12.5%);height:2px;background:linear-gradient(90deg,var(--blue2),var(--accent));z-index:0}
.how-step{text-align:center;padding:0 16px;position:relative;z-index:1}
.how-step-circle{width:72px;height:72px;border-radius:50%;border:3px solid var(--border);background:#fff;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;font-size:24px;transition:border-color .2s,box-shadow .2s;position:relative}
.how-step:hover .how-step-circle{border-color:var(--blue2);box-shadow:0 0 0 6px rgba(30,80,162,.08)}
.how-step-num{position:absolute;top:-4px;right:-4px;width:22px;height:22px;border-radius:50%;background:var(--blue2);color:#fff;font-size:10px;font-weight:800;display:flex;align-items:center;justify-content:center}
.how-step h5{font-size:13px;font-weight:700;color:var(--navy);margin-bottom:6px}
.how-step p{font-size:12px;color:var(--muted);line-height:1.6}

/* ── COMMITMENT STRIP ── */
.commit-strip{background:linear-gradient(135deg,var(--accent),#8B1A06);border-radius:22px;padding:44px 48px;display:flex;align-items:center;justify-content:space-between;gap:32px;flex-wrap:wrap;position:relative;overflow:hidden}
.commit-strip::after{content:'';position:absolute;width:400px;height:400px;border-radius:50%;border:2px solid rgba(255,255,255,.07);bottom:-200px;right:-100px;pointer-events:none}
.commit-text h3{font-size:24px;font-weight:900;color:#fff;margin-bottom:8px;letter-spacing:-.4px}
.commit-text p{font-size:14px;color:rgba(255,255,255,.65);line-height:1.7;max-width:500px}
.commit-btns{display:flex;gap:12px;flex-shrink:0;flex-wrap:wrap}
.btn-w{background:#fff;color:var(--accent);padding:13px 28px;border-radius:25px;font-size:13px;font-weight:800;transition:all .25s;box-shadow:0 4px 16px rgba(0,0,0,.2);display:inline-flex;align-items:center;gap:8px;white-space:nowrap}
.btn-w:hover{transform:translateY(-2px);box-shadow:0 10px 28px rgba(0,0,0,.25)}
.btn-ghost-w{border:2px solid rgba(255,255,255,.4);color:#fff;padding:11px 24px;border-radius:25px;font-size:13px;font-weight:700;transition:all .25s;display:inline-flex;align-items:center;gap:8px;white-space:nowrap}
.btn-ghost-w:hover{border-color:#fff;background:rgba(255,255,255,.1)}

/* ── RESPONSIVE ── */
@media(max-width:1100px){
  .intro-banner{grid-template-columns:1fr;gap:36px}
  .obj-grid{grid-template-columns:1fr 1fr}
  .focus-grid{grid-template-columns:1fr 1fr}
  .how-steps{grid-template-columns:1fr 1fr;gap:32px}
  .how-steps::before{display:none}
}
@media(max-width:700px){
  .page-body{padding:50px 5%}
  .obj-grid{grid-template-columns:1fr}
  .focus-grid{grid-template-columns:1fr 1fr}
  .focus-band{padding:36px 24px}
  .commit-strip{flex-direction:column;align-items:flex-start;padding:32px 28px}
  .how-steps{grid-template-columns:1fr 1fr}
}
</style>


<!-- PAGE HERO -->
<div class="page-hero">
  <div class="page-hero-glow"></div>
  <div class="page-hero-glow2"></div>
  <div class="page-hero-inner">
    <div class="breadcrumb">
      <a href="index.html"><i class="fas fa-home"></i> Home</a>
      <i class="fas fa-chevron-right"></i>
      <a href="#">About Us</a>
      <i class="fas fa-chevron-right"></i>
      <span class="active">Aim & Objectives</span>
    </div>
    <div class="page-hero-tag"><span>About Us</span></div>
    <h1>Aim & <span>Objectives</span></h1>
    <p>The guiding purpose and strategic goals that drive everything P A C T does — for 600+ IT traders across Punjab & Chandigarh.</p>
  </div>
</div>

<!-- MAIN CONTENT -->
<div class="page-body">

  <!-- INTRO BANNER -->
  <div class="intro-banner">
    <div>
      <div class="eyebrow">Our Purpose</div>
      <h2 class="sec-title">Why P A C T <span class="hl">Exists</span></h2>
      <p>P A C T was founded on a simple but powerful belief — that IT traders across Punjab & Chandigarh are stronger together than apart. Every policy we lobby for, every seminar we host, every grievance we resolve, and every connection we facilitate flows from that core conviction.</p>
      <p>Our <strong>aim</strong> is to be the definitive platform for IT entrepreneurs in the region — providing them with advocacy, knowledge, community, and the resources to grow their businesses in an increasingly complex environment.</p>
      <p>Our <strong>objectives</strong> set out the specific, measurable actions through which we pursue that aim — from government engagement and compliance support to networking events and industry recognition.</p>
    </div>

    <div class="aim-card">
      <div class="aim-card-label"><span>Core Aim</span></div>
      <h3>To Foster Sustainable Growth of the IT Industry Across Punjab & Chandigarh</h3>
      <p>By uniting traders, advocating at government level, sharing knowledge, and building community — P A C T creates the conditions for every member's business to succeed.</p>
      <div class="aim-divider"></div>
      <div class="aim-quick">
        <div class="aim-quick-item"><i class="fas fa-check-circle"></i> Advocate for IT traders at State & Central level</div>
        <div class="aim-quick-item"><i class="fas fa-check-circle"></i> Provide compliance & legal support</div>
        <div class="aim-quick-item"><i class="fas fa-check-circle"></i> Create networking & growth opportunities</div>
        <div class="aim-quick-item"><i class="fas fa-check-circle"></i> Represent 600+ members as a unified voice</div>
      </div>
    </div>
  </div>

  <!-- OBJECTIVES GRID -->
  <div class="obj-section">
    <div class="eyebrow">Our Objectives</div>
    <h2 class="sec-title">What We Set Out <span class="hl">To Achieve</span></h2>
    <p class="sec-sub">Nine strategic objectives guide P A C T's work — each one translating our broader aim into specific, actionable commitments for the IT trading community.</p>

    <div class="obj-grid">
      <div class="obj-card" data-num="01">
        <div class="obj-ico blue"><i class="fas fa-landmark"></i></div>
        <h4>Government Representation & Policy Advocacy</h4>
        <p>Actively liaise with Punjab State Government, the Government of India, and all relevant regulatory bodies on matters of taxation, import duty, digital infrastructure, and IT sector policy — ensuring the interests of IT traders are always heard.</p>
      </div>
      <div class="obj-card" data-num="02">
        <div class="obj-ico red"><i class="fas fa-gavel"></i></div>
        <h4>Grievance Redressal & Dispute Resolution</h4>
        <p>Provide a fair, efficient, and amicable mechanism for resolving disputes between members, distributors, manufacturers, and third parties — protecting businesses and upholding ethical trade practices across the sector.</p>
      </div>
      <div class="obj-card" data-num="03">
        <div class="obj-ico gold"><i class="fas fa-receipt"></i></div>
        <h4>GST, Taxation & Legal Compliance Support</h4>
        <p>Equip members with expert guidance on GST compliance, e-Way Bills, e-Invoicing, TDS returns, and all legal requirements — reducing compliance burden and protecting businesses from penalties and litigation.</p>
      </div>
      <div class="obj-card" data-num="04">
        <div class="obj-ico green"><i class="fas fa-network-wired"></i></div>
        <h4>Industry Networking & Community Building</h4>
        <p>Create meaningful opportunities for IT traders to connect, collaborate, and build business relationships — through events, seminars, fellowship meets, and the members' directory — strengthening the fabric of the Punjab IT ecosystem.</p>
      </div>
      <div class="obj-card" data-num="05">
        <div class="obj-ico purple"><i class="fas fa-chalkboard-teacher"></i></div>
        <h4>Knowledge Sharing & Capacity Building</h4>
        <p>Organise seminars, workshops, and industry briefings to keep members informed about the latest developments in technology, regulation, and business strategy — empowering them to make better decisions and stay competitive.</p>
      </div>
      <div class="obj-card" data-num="06">
        <div class="obj-ico teal"><i class="fas fa-chart-line"></i></div>
        <h4>Market Development & Business Growth</h4>
        <p>Identify and create new market opportunities for IT traders in Punjab & Chandigarh, expand distribution networks, promote product awareness, and support members in reaching new customers and geographies.</p>
      </div>
      <div class="obj-card" data-num="07">
        <div class="obj-ico navy"><i class="fas fa-award"></i></div>
        <h4>Industry Recognition & Awards</h4>
        <p>Honour outstanding contributions by IT entrepreneurs, innovative businesses, and industry leaders through structured awards and recognition programmes — celebrating excellence and inspiring others across the sector.</p>
      </div>
      <div class="obj-card" data-num="08">
        <div class="obj-ico orange"><i class="fas fa-heart"></i></div>
        <h4>Corporate Social Responsibility</h4>
        <p>Lead CSR initiatives in health, education, and community welfare — from free eye operation camps to scholarship drives — demonstrating that the IT trading community invests not just in business, but in the region it calls home.</p>
      </div>
      <div class="obj-card" data-num="09">
        <div class="obj-ico pink"><i class="fas fa-sitemap"></i></div>
        <h4>Strengthening City-Level Associations</h4>
        <p>Support and empower the 11+ city-level IT associations affiliated with P A C T across Punjab — providing them with resources, training, and coordination to build strong local chapters that amplify the collective voice of IT traders.</p>
      </div>
    </div>
  </div>

  <!-- FOCUS AREAS BAND -->
  <div class="focus-band">
    <div class="eyebrow">Strategic Focus</div>
    <h2 class="sec-title">Key <span class="hl">Areas of Work</span></h2>
    <p class="sec-sub">Four pillars underpin all of P A C T's activities — each one essential to fulfilling our objectives.</p>
    <div class="focus-grid">
      <div class="focus-item">
        <div class="focus-item-ico">🏛️</div>
        <h5>Policy & Advocacy</h5>
        <p>Representing IT traders at government level on taxation, regulation, and digital infrastructure.</p>
      </div>
      <div class="focus-item">
        <div class="focus-item-ico">⚖️</div>
        <h5>Compliance & Legal</h5>
        <p>GST helpdesk, grievance cell, legal advisory, and dispute resolution services for all members.</p>
      </div>
      <div class="focus-item">
        <div class="focus-item-ico">🤝</div>
        <h5>Community & Networks</h5>
        <p>Events, fellowship meets, sports, and a comprehensive 600+ member directory.</p>
      </div>
      <div class="focus-item">
        <div class="focus-item-ico">🌱</div>
        <h5>Growth & CSR</h5>
        <p>Market development, capacity building, industry awards, and community welfare programmes.</p>
      </div>
    </div>
  </div>

  <!-- HOW WE WORK -->
  <div class="how-section">
    <div class="eyebrow">Our Approach</div>
    <h2 class="sec-title" style="margin-bottom:48px">How P A C T <span class="hl">Delivers</span> on Its Objectives</h2>
    <div class="how-steps">
      <div class="how-step">
        <div class="how-step-circle">
          🎙️
          <div class="how-step-num">1</div>
        </div>
        <h5>Listen to Members</h5>
        <p>We actively gather concerns, issues, and suggestions from our 600+ members through meetings, circulars, and direct engagement.</p>
      </div>
      <div class="how-step">
        <div class="how-step-circle">
          📋
          <div class="how-step-num">2</div>
        </div>
        <h5>Formulate Positions</h5>
        <p>Our executive committee and advisory board develop clear, evidence-based policy positions and member support frameworks.</p>
      </div>
      <div class="how-step">
        <div class="how-step-circle">
          🏛️
          <div class="how-step-num">3</div>
        </div>
        <h5>Engage Government</h5>
        <p>We present our positions directly to State and Central Government bodies — lobbying for fair policies and swift resolution of sector-wide issues.</p>
      </div>
      <div class="how-step">
        <div class="how-step-circle">
          📢
          <div class="how-step-num">4</div>
        </div>
        <h5>Inform & Empower</h5>
        <p>Outcomes, updates, and actionable guidance are communicated back to members through circulars, seminars, and our digital channels.</p>
      </div>
    </div>
  </div>

  <!-- COMMITMENT STRIP -->
  <div class="commit-strip">
    <div class="commit-text">
      <h3>Ready to Be Part of This Mission?</h3>
      <p>When you join P A C T, you don't just get access to services — you become part of a collective that shapes the future of Punjab & Chandigarh's IT industry. Every member strengthens our voice.</p>
    </div>
    <div class="commit-btns">
      <a href="become-member.html" class="btn-w"><i class="fas fa-user-plus"></i> Join P A C T</a>
      <a href="profile.html" class="btn-ghost-w"><i class="fas fa-info-circle"></i> Our Profile</a>
    </div>
  </div>

</div><!-- /page-body -->

@endsection