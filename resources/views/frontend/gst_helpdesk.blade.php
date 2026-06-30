@extends('layouts.frontend')
@section('title', 'GST & Legal Helpdesk')

@section('content')
<style>
.helpdesk-intro{display:grid;grid-template-columns:1.15fr .85fr;gap:56px;align-items:center;margin-bottom:80px}
.helpdesk-intro p{font-size:15px;color:var(--muted);line-height:1.85;margin-bottom:16px}
.helpdesk-intro p strong{color:var(--navy)}
.helpdesk-quick-card{background:var(--navy);border-radius:22px;padding:36px;position:relative;overflow:hidden}
.helpdesk-quick-card::after{content:'⚖️';position:absolute;font-size:120px;right:-10px;bottom:-20px;opacity:.07}
.hq-label{display:inline-flex;align-items:center;gap:8px;background:rgba(245,166,35,.15);border:1px solid rgba(245,166,35,.3);padding:6px 14px;border-radius:20px;margin-bottom:18px}
.hq-label span{font-size:11px;font-weight:700;color:var(--gold2);letter-spacing:1px;text-transform:uppercase}
.hq-card h3{font-size:18px;font-weight:800;color:#fff;margin-bottom:16px;line-height:1.3}
.hq-contact-list{display:flex;flex-direction:column;gap:12px;position:relative;z-index:1}
.hq-contact-item{display:flex;align-items:center;gap:12px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:11px;padding:14px 16px}
.hq-contact-ico{width:36px;height:36px;border-radius:9px;background:rgba(245,166,35,.15);display:flex;align-items:center;justify-content:center;font-size:15px;flex-shrink:0}
.hq-contact-info strong{display:block;font-size:12px;font-weight:700;color:#fff}
.hq-contact-info a{font-size:11px;color:rgba(255,255,255,.5);transition:color .2s}
.hq-contact-info a:hover{color:var(--gold2)}
.hq-hours{background:rgba(245,166,35,.1);border:1px solid rgba(245,166,35,.2);border-radius:10px;padding:12px 16px;font-size:12px;color:rgba(255,255,255,.6);margin-top:14px;display:flex;align-items:center;gap:8px;position:relative;z-index:1}
.hq-hours i{color:var(--gold2);font-size:12px}

.services-covered{display:grid;grid-template-columns:repeat(3,1fr);gap:18px;margin-bottom:80px}
.service-cov-card{background:#fff;border:1px solid var(--border);border-radius:16px;padding:24px 20px;transition:transform .2s,box-shadow .2s}
.service-cov-card:hover{transform:translateY(-4px);box-shadow:var(--card-shadow)}
.scc-ico{width:46px;height:46px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:20px;margin-bottom:14px}
.service-cov-card h4{font-size:14px;font-weight:700;color:var(--navy);margin-bottom:7px}
.service-cov-card p{font-size:12px;color:var(--muted);line-height:1.65}

.query-form-section{background:var(--light);border-radius:22px;padding:52px 48px;margin-bottom:80px}
.query-grid{display:grid;grid-template-columns:1fr 1fr;gap:18px}
.qform-grp{display:flex;flex-direction:column;gap:6px}
.qform-lbl{font-size:12px;font-weight:700;color:var(--navy);letter-spacing:.3px}
.qform-lbl .req{color:var(--accent)}
.qform-ctrl{padding:11px 16px;border:1.5px solid var(--border);border-radius:10px;font-family:var(--font);font-size:14px;color:var(--text);background:#fff;outline:none;transition:border-color .2s,box-shadow .2s;width:100%}
.qform-ctrl:focus{border-color:var(--blue2);box-shadow:0 0 0 3px rgba(30,80,162,.1)}
.qform-ctrl::placeholder{color:#B0BEC5}
textarea.qform-ctrl{resize:vertical;min-height:110px}

.experts-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-bottom:80px}
.expert-card{background:#fff;border:1px solid var(--border);border-radius:18px;padding:26px 22px;text-align:center;transition:transform .25s,box-shadow .25s}
.expert-card:hover{transform:translateY(-5px);box-shadow:var(--card-shadow-hover)}
.expert-avatar{width:68px;height:68px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:22px;font-weight:900;color:#fff;margin:0 auto 14px;font-family:var(--font)}
.expert-card h5{font-size:15px;font-weight:800;color:var(--navy);margin-bottom:3px}
.expert-card .exp-title{font-size:12px;color:var(--muted);margin-bottom:10px}
.expert-speciality{display:flex;flex-wrap:wrap;gap:6px;justify-content:center;margin-bottom:14px}
.exp-tag{padding:3px 10px;border-radius:20px;font-size:10px;font-weight:600;background:rgba(30,80,162,.08);color:var(--blue2);border:1px solid rgba(30,80,162,.15)}

.faq-helpdesk{display:flex;flex-direction:column;gap:12px;margin-bottom:80px}
.faqh-item{background:#fff;border:1px solid var(--border);border-radius:14px;overflow:hidden}
.faqh-q{padding:18px 22px;display:flex;align-items:center;justify-content:space-between;gap:16px;cursor:pointer;font-size:14px;font-weight:700;color:var(--navy)}
.faqh-q i{font-size:12px;color:var(--muted);transition:transform .3s;flex-shrink:0}
.faqh-item.open .faqh-q i{transform:rotate(180deg);color:var(--blue2)}
.faqh-a{max-height:0;overflow:hidden;transition:max-height .35s ease}
.faqh-item.open .faqh-a{max-height:250px}
.faqh-a p{padding:0 22px 18px;font-size:13px;color:var(--muted);line-height:1.75}

@media(max-width:1100px){.helpdesk-intro{grid-template-columns:1fr}.services-covered{grid-template-columns:1fr 1fr}.experts-grid{grid-template-columns:1fr 1fr}}
@media(max-width:768px){.services-covered{grid-template-columns:1fr}.experts-grid{grid-template-columns:1fr}.query-grid{grid-template-columns:1fr}.query-form-section{padding:32px 24px}}
</style>

<div class="page-hero">
  <div class="hero-glow"></div><div class="hero-glow2"></div>
  <div class="page-hero-inner">
    <div class="breadcrumb">
      <a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a><i class="fas fa-chevron-right"></i>
      <a href="#">Services</a><i class="fas fa-chevron-right"></i>
      <span class="active">GST & Legal Helpdesk</span>
    </div>
    <div class="page-hero-tag"><span>Services</span></div>
    <h1>GST & Legal <span>Helpdesk</span></h1>
    <p>Expert guidance on GST compliance, e-Way Bills, e-Invoicing, ITC claims, and all legal matters affecting IT businesses — available free to all PACT members.</p>
    <div class="hero-chips">
      <div class="hero-chip"><i class="fas fa-rupee-sign"></i> Free for Members</div>
      <div class="hero-chip"><i class="fas fa-headset"></i> Expert Advisors</div>
      <div class="hero-chip"><i class="fas fa-clock"></i> 48hr Response</div>
      <div class="hero-chip"><i class="fas fa-lock"></i> Confidential</div>
    </div>
  </div>
</div>

<div class="page-body">

  <!-- INTRO -->
  <div class="helpdesk-intro">
    <div>
      <div class="eyebrow">About the Helpdesk</div>
      <h2 class="sec-title">Your Personal GST & Legal <span class="hl">Support Team</span></h2>
      <p>PACT's GST & Legal Helpdesk was established to ensure that no PACT member ever has to navigate India's complex tax and compliance environment alone. Our panel of experienced tax practitioners and legal advisors provides <strong>practical, actionable guidance</strong> tailored specifically to the IT trading sector.</p>
      <p>The helpdesk covers everything from day-to-day GST return queries to complex ITC reversal disputes, e-Invoice issues, customs classification problems, and trade law matters. All advice is provided in <strong>plain language</strong> — no legal jargon, no unnecessary complexity.</p>
      <p>Members can reach the helpdesk by phone, email, or the query form below. Complex queries are typically responded to within <strong>48 working hours</strong>.</p>
    </div>
    <div class="helpdesk-quick-card">
      <div class="hq-label"><span>Contact Helpdesk</span></div>
      <h3>Reach Our Experts Directly</h3>
      <div class="hq-contact-list">
        <div class="hq-contact-item"><div class="hq-contact-ico">📞</div><div class="hq-contact-info"><strong>Helpdesk Hotline</strong><a href="tel:+919417223355">+91 94172-23355</a></div></div>
        <div class="hq-contact-item"><div class="hq-contact-ico">📧</div><div class="hq-contact-info"><strong>Email Helpdesk</strong><a href="mailto:gst@pact.org.in">gst@pact.org.in</a></div></div>
        <div class="hq-contact-item"><div class="hq-contact-ico">💬</div><div class="hq-contact-info"><strong>WhatsApp Group</strong><a href="#">PACT GST Updates Group</a></div></div>
      </div>
      <div class="hq-hours"><i class="fas fa-clock"></i> Mon – Sat, 10 AM – 5 PM · 48hr email response</div>
    </div>
  </div>

  <!-- SERVICES COVERED -->
  <div class="eyebrow">What We Cover</div>
  <h2 class="sec-title" style="margin-bottom:10px">Helpdesk <span class="hl">Services</span></h2>
  <p class="sec-sub">Six core areas of expert support available to every PACT member — free of charge.</p>
  <div class="services-covered">
    <div class="service-cov-card"><div class="scc-ico ico-box purple lg"><i class="fas fa-receipt"></i></div><h4>GST Return Filing</h4><p>Guidance on GSTR-1, GSTR-3B, GSTR-9 filing, common errors, late fees, and reconciliation with GSTR-2B for ITC claims.</p></div>
    <div class="service-cov-card"><div class="scc-ico ico-box blue lg"><i class="fas fa-file-invoice"></i></div><h4>e-Invoice & e-Way Bill</h4><p>Help with e-Invoice generation, IRN cancellation, e-Way Bill creation, extensions, Part-B updates, and 2FA compliance.</p></div>
    <div class="service-cov-card"><div class="scc-ico ico-box gold lg"><i class="fas fa-hand-holding-usd"></i></div><h4>ITC Claims & Reversals</h4><p>Expert advice on Input Tax Credit eligibility, blocked credits, ITC reversals under Rule 42/43, and GSTR-2B reconciliation disputes.</p></div>
    <div class="service-cov-card"><div class="scc-ico ico-box red lg"><i class="fas fa-gavel"></i></div><h4>GST Notices & Appeals</h4><p>Guidance on responding to GST assessment orders, demand notices, SCNs, and filing appeals before the Appellate Authority.</p></div>
    <div class="service-cov-card"><div class="scc-ico ico-box green lg"><i class="fas fa-shipping-fast"></i></div><h4>Import & Customs</h4><p>Advice on customs duty classification, BOE filing, import licensing, and duty drawback claims for IT hardware traders.</p></div>
    <div class="service-cov-card"><div class="scc-ico ico-box teal lg"><i class="fas fa-balance-scale"></i></div><h4>Trade Law & Contracts</h4><p>General guidance on trade contracts, warranty obligations, consumer protection, IT Act compliance, and supplier agreements.</p></div>
  </div>

  <!-- OUR EXPERTS -->
  <div class="eyebrow">Our Experts</div>
  <h2 class="sec-title" style="margin-bottom:28px">The <span class="hl">Helpdesk Team</span></h2>
  <div class="experts-grid">
    <div class="expert-card">
      <div class="expert-avatar" style="background:linear-gradient(140deg,#7C3AED,#4C1D95)">SK</div>
      <h5>Suresh Kapila</h5>
      <div class="exp-title">Senior GST Practitioner · 22 Years Experience</div>
      <div class="expert-speciality"><span class="exp-tag">GST Returns</span><span class="exp-tag">ITC</span><span class="exp-tag">Appeals</span></div>
      <p style="font-size:12px;color:var(--muted)">Heads PACT's GST helpdesk — primary advisor on all GST compliance and litigation matters.</p>
    </div>
    <div class="expert-card">
      <div class="expert-avatar" style="background:linear-gradient(140deg,#059669,#065F46)">SP</div>
      <h5>Satish Puri</h5>
      <div class="exp-title">Retd. Commissioner of Customs · 30 Years</div>
      <div class="expert-speciality"><span class="exp-tag">Customs</span><span class="exp-tag">Import</span><span class="exp-tag">Duty</span></div>
      <p style="font-size:12px;color:var(--muted)">Specialist in IT hardware customs classification, import licensing, and BOE filing queries.</p>
    </div>
    <div class="expert-card">
      <div class="expert-avatar" style="background:linear-gradient(140deg,var(--blue2),var(--navy))">RA</div>
      <h5>Rohini Arora</h5>
      <div class="exp-title">Trade Lawyer · High Court Advocate</div>
      <div class="expert-speciality"><span class="exp-tag">Trade Law</span><span class="exp-tag">Contracts</span><span class="exp-tag">IT Act</span></div>
      <p style="font-size:12px;color:var(--muted)">Handles trade law, contract disputes, and legal opinion queries for PACT members.</p>
    </div>
  </div>

  <!-- QUERY FORM -->
  <div class="query-form-section" id="queryForm">
    <div style="margin-bottom:28px">
      <div class="eyebrow">Submit a Query</div>
      <h2 class="sec-title">Send Your <span class="hl">Helpdesk Query</span></h2>
      <p style="font-size:14px;color:var(--muted);margin-top:4px">Our experts respond within 48 working hours. Provide as much detail as possible for accurate guidance.</p>
    </div>
    <form onsubmit="return false">
      <div class="query-grid">
        <div class="qform-grp"><label class="qform-lbl">Your Name <span class="req">*</span></label><input type="text" class="qform-ctrl" placeholder="Full name" required></div>
        <div class="qform-grp"><label class="qform-lbl">PACT Member ID <span class="req">*</span></label><input type="text" class="qform-ctrl" placeholder="PACT/MEM/YYYY/XXXXX" required></div>
        <div class="qform-grp"><label class="qform-lbl">Mobile Number <span class="req">*</span></label><input type="tel" class="qform-ctrl" placeholder="+91 XXXXX XXXXX" required></div>
        <div class="qform-grp"><label class="qform-lbl">Email <span class="req">*</span></label><input type="email" class="qform-ctrl" placeholder="your@email.com" required></div>
        <div class="qform-grp" style="grid-column:1/-1"><label class="qform-lbl">Query Category <span class="req">*</span></label><select class="qform-ctrl" required><option value="">— Select Category —</option><option>GST Return Filing</option><option>e-Invoice / e-Way Bill</option><option>ITC Claims & Reversals</option><option>GST Notice / Appeal</option><option>Import & Customs</option><option>Trade Law & Contracts</option><option>Other</option></select></div>
        <div class="qform-grp" style="grid-column:1/-1"><label class="qform-lbl">Your Query in Detail <span class="req">*</span></label><textarea class="qform-ctrl" rows="5" placeholder="Describe your query in as much detail as possible. Include GSTIN, relevant amounts, notice numbers, or any other pertinent information…" required></textarea></div>
        <div class="qform-grp" style="grid-column:1/-1"><label class="qform-lbl">Preferred Response Mode</label><select class="qform-ctrl"><option>Email Response</option><option>Phone Call Back</option><option>WhatsApp Message</option></select></div>
      </div>
      <div class="btn-group" style="margin-top:24px">
        <button class="btn-primary" onclick="alert('Query submitted! Our expert will respond within 48 working hours.')"><i class="fas fa-paper-plane"></i> Submit Query</button>
        <a href="tel:+919417223355" class="btn-ghost-light"><i class="fas fa-phone"></i> Call Helpdesk Directly</a>
      </div>
    </form>
  </div>

  <!-- FAQ -->
  <div class="eyebrow">FAQs</div>
  <h2 class="sec-title" style="margin-bottom:24px">Common <span class="hl">Compliance Questions</span></h2>
  <div class="faq-helpdesk">
    @forelse($faqs as $faq)
    <div class="faqh-item">
      <div class="faqh-q" onclick="this.parentElement.classList.toggle('open')">
        {{ $faq->question }} <i class="fas fa-chevron-down"></i>
      </div>
      <div class="faqh-a">
        <p>{{ $faq->answer }}</p>
      </div>
    </div>
    @empty
    <div style="text-align:center;padding:40px;color:var(--muted)">No FAQs found. Please add them from the Admin Panel CMS.</div>
    @endforelse
  </div>

  <div class="cta-band-red">
    <div class="cta-band-text"><h3>GST Helpdesk is a Member-Only Service</h3><p>Become a PACT member today and get free access to our expert GST helpdesk — saving you thousands in consultant fees every year.</p></div>
    <div class="cta-band-btns">
      <a href="{{ route('become-member') }}" class="btn-white"><i class="fas fa-user-plus"></i> Join PACT</a>
      <a href="notifications.html" class="btn-ghost-dark"><i class="fas fa-bell"></i> View Circulars</a>
    </div>
  </div>

</div>

@endsection
