@extends('layouts.frontend')
@section('title', 'Grievance Cell')

@section('content')
<style>
.griev-intro{display:grid;grid-template-columns:1.2fr .8fr;gap:56px;align-items:center;margin-bottom:80px}
.griev-intro p{font-size:15px;color:var(--muted);line-height:1.85;margin-bottom:16px}
.griev-intro p strong{color:var(--navy)}
.griev-card{background:var(--navy);border-radius:22px;padding:36px;position:relative;overflow:hidden}
.griev-card::after{content:'⚖️';position:absolute;font-size:120px;right:-10px;bottom:-20px;opacity:.07}
.griev-card-label{display:inline-flex;align-items:center;gap:8px;background:rgba(245,166,35,.15);border:1px solid rgba(245,166,35,.3);padding:6px 14px;border-radius:20px;margin-bottom:18px}
.griev-card-label span{font-size:11px;font-weight:700;color:var(--gold2);letter-spacing:1px;text-transform:uppercase}
.griev-card h3{font-size:18px;font-weight:800;color:#fff;margin-bottom:14px;line-height:1.3}
.griev-points{display:flex;flex-direction:column;gap:12px;position:relative;z-index:1}
.griev-point{display:flex;align-items:flex-start;gap:11px}
.griev-point-ico{width:34px;height:34px;border-radius:9px;background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.1);display:flex;align-items:center;justify-content:center;font-size:14px;flex-shrink:0}
.griev-point strong{display:block;font-size:13px;font-weight:700;color:#fff;margin-bottom:2px}
.griev-point span{font-size:12px;color:rgba(255,255,255,.45);line-height:1.5}

.process-steps-griev{display:grid;grid-template-columns:repeat(5,1fr);gap:0;position:relative;margin-bottom:80px}
.process-steps-griev::before{content:'';position:absolute;top:34px;left:10%;right:10%;height:2px;background:linear-gradient(90deg,var(--blue2),var(--accent));z-index:0}
.griev-step{text-align:center;padding:0 10px;position:relative;z-index:1}
.griev-step-circle{width:68px;height:68px;border-radius:50%;border:3px solid var(--border);background:#fff;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:22px;position:relative;transition:border-color .2s}
.griev-step:hover .griev-step-circle{border-color:var(--blue2);box-shadow:0 0 0 6px rgba(30,80,162,.08)}
.griev-step-num{position:absolute;top:-4px;right:-4px;width:22px;height:22px;border-radius:50%;background:var(--blue2);color:#fff;font-size:10px;font-weight:800;display:flex;align-items:center;justify-content:center}
.griev-step h5{font-size:12px;font-weight:700;color:var(--navy);margin-bottom:5px}
.griev-step p{font-size:11px;color:var(--muted);line-height:1.6}

.griev-form-section{background:var(--light);border-radius:22px;padding:52px 48px;margin-bottom:80px}
.form-two-col{display:grid;grid-template-columns:1fr 1fr;gap:18px}
.form-group-griev{display:flex;flex-direction:column;gap:6px}
.form-label-g{font-size:12px;font-weight:700;color:var(--navy);letter-spacing:.3px}
.form-label-g .req{color:var(--accent)}
.form-ctrl{padding:11px 16px;border:1.5px solid var(--border);border-radius:10px;font-family:var(--font);font-size:14px;color:var(--text);background:#fff;outline:none;transition:border-color .2s,box-shadow .2s;width:100%}
.form-ctrl:focus{border-color:var(--blue2);box-shadow:0 0 0 3px rgba(30,80,162,.1)}
.form-ctrl::placeholder{color:#B0BEC5}
textarea.form-ctrl{resize:vertical;min-height:110px}
.form-section-sep{grid-column:1/-1;font-size:11px;font-weight:800;color:var(--navy);text-transform:uppercase;letter-spacing:1.5px;padding-bottom:10px;border-bottom:1px solid var(--border);margin-top:8px;display:flex;align-items:center;gap:8px}
.form-section-sep i{font-size:12px;color:var(--blue2)}
.griev-notice{background:rgba(245,166,35,.08);border:1px solid rgba(245,166,35,.25);border-radius:12px;padding:16px 20px;display:flex;align-items:flex-start;gap:10px;font-size:13px;color:#7A4A00;line-height:1.65;margin-bottom:24px;grid-column:1/-1}
.griev-notice i{color:var(--gold);flex-shrink:0;margin-top:2px}

.faq-griev{display:flex;flex-direction:column;gap:12px;margin-bottom:80px}
.faq-item-g{background:#fff;border:1px solid var(--border);border-radius:14px;overflow:hidden}
.faq-q-g{padding:18px 22px;display:flex;align-items:center;justify-content:space-between;gap:16px;cursor:pointer;font-size:14px;font-weight:700;color:var(--navy)}
.faq-q-g i{font-size:12px;color:var(--muted);transition:transform .3s;flex-shrink:0}
.faq-item-g.open .faq-q-g i{transform:rotate(180deg);color:var(--blue2)}
.faq-a-g{max-height:0;overflow:hidden;transition:max-height .35s ease}
.faq-item-g.open .faq-a-g{max-height:200px}
.faq-a-g p{padding:0 22px 18px;font-size:13px;color:var(--muted);line-height:1.75}

@media(max-width:1100px){.griev-intro{grid-template-columns:1fr}.process-steps-griev{grid-template-columns:1fr 1fr;gap:24px}.process-steps-griev::before{display:none}}
@media(max-width:768px){.form-two-col{grid-template-columns:1fr}.griev-form-section{padding:32px 24px}.griev-step{grid-column:span 1}}
</style>

<div class="page-hero">
  <div class="hero-glow"></div><div class="hero-glow2"></div>
  <div class="page-hero-inner">
    <div class="breadcrumb">
      <a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a><i class="fas fa-chevron-right"></i>
      <a href="#">Services</a><i class="fas fa-chevron-right"></i>
      <span class="active">Grievance Cell</span>
    </div>
    <div class="page-hero-tag"><span>Services</span></div>
    <h1>Grievance <span>Cell</span></h1>
    <p>PACT's independent dispute resolution mechanism — providing fair, confidential, and amicable resolution of trade disputes for all members without the cost and delay of litigation.</p>
    <div class="hero-chips">
      <div class="hero-chip"><i class="fas fa-balance-scale"></i> Fair & Impartial</div>
      <div class="hero-chip"><i class="fas fa-lock"></i> Confidential</div>
      <div class="hero-chip"><i class="fas fa-clock"></i> 30-Day Resolution</div>
      <div class="hero-chip"><i class="fas fa-rupee-sign"></i> Free for Members</div>
    </div>
  </div>
</div>

<div class="page-body">

  <!-- INTRO -->
  <div class="griev-intro">
    <div>
      <div class="eyebrow">About the Grievance Cell</div>
      <h2 class="sec-title">Protecting Your Business <span class="hl">Interests</span></h2>
      <p>PACT's Grievance Cell provides a structured, impartial, and confidential mechanism for resolving disputes between members, distributors, manufacturers, and third parties in the IT trade sector.</p>
      <p>Whether it's a payment dispute with a distributor, a warranty disagreement with a supplier, or a contractual misunderstanding between member firms — PACT's Grievance Committee works to achieve <strong>amicable resolution without the cost, delay, and adversarial nature of litigation</strong>.</p>
      <p>The Grievance Cell operates under the supervision of the PACT Executive Committee and is chaired by the Joint Secretary. All proceedings are <strong>strictly confidential</strong> and both parties must agree to participate in good faith.</p>
      <div class="pull-quote" style="margin-top:24px">
        <p>Trade disputes destroy relationships. PACT's Grievance Cell resolves disputes while preserving them — that's what makes us different from a court.</p>
        <cite>— Pankaj Kapoor, Joint Secretary & Grievance Cell Chairperson</cite>
      </div>
    </div>
    <div class="griev-card">
      <div class="griev-card-label"><span>Key Features</span></div>
      <h3>What Makes PACT Grievance Cell Different</h3>
      <div class="griev-points">
        <div class="griev-point"><div class="griev-point-ico">⚡</div><div><strong>Fast Resolution</strong><span>Target resolution within 30 days — not months or years like litigation</span></div></div>
        <div class="griev-point"><div class="griev-point-ico">🔒</div><div><strong>Confidential</strong><span>All proceedings are strictly confidential — no public records</span></div></div>
        <div class="griev-point"><div class="griev-point-ico">⚖️</div><div><strong>Impartial Panel</strong><span>5-member committee with no conflict of interest in any case</span></div></div>
        <div class="griev-point"><div class="griev-point-ico">💰</div><div><strong>No Cost</strong><span>Free for all PACT members — no filing fees or legal costs</span></div></div>
        <div class="griev-point"><div class="griev-point-ico">🤝</div><div><strong>Relationship Preserving</strong><span>Focus on amicable resolution, not adversarial outcomes</span></div></div>
      </div>
    </div>
  </div>

  <!-- PROCESS -->
  <div class="eyebrow">How It Works</div>
  <h2 class="sec-title" style="margin-bottom:48px">Grievance Resolution <span class="hl">Process</span></h2>
  <div class="process-steps-griev">
    <div class="griev-step">
      <div class="griev-step-circle">📝<div class="griev-step-num">1</div></div>
      <h5>File Application</h5>
      <p>Submit the Grievance Application Form with full details of the dispute and supporting documents.</p>
    </div>
    <div class="griev-step">
      <div class="griev-step-circle">✅<div class="griev-step-num">2</div></div>
      <h5>Acceptance Review</h5>
      <p>PACT Secretariat reviews and registers your application within 5 working days of receipt.</p>
    </div>
    <div class="griev-step">
      <div class="griev-step-circle">📢<div class="griev-step-num">3</div></div>
      <h5>Notice to Other Party</h5>
      <p>The other party is formally notified and invited to respond and participate in mediation.</p>
    </div>
    <div class="griev-step">
      <div class="griev-step-circle">🤝<div class="griev-step-num">4</div></div>
      <h5>Mediation Hearing</h5>
      <p>Both parties present their case before the Grievance Committee — typically one or two hearings.</p>
    </div>
    <div class="griev-step">
      <div class="griev-step-circle">📋<div class="griev-step-num">5</div></div>
      <h5>Resolution & Order</h5>
      <p>Committee issues its resolution — either agreed settlement or a binding recommendation.</p>
    </div>
  </div>

  <!-- FORM -->
  <div class="griev-form-section" id="grievanceForm">
    <div style="margin-bottom:32px">
      <div class="eyebrow">File a Grievance</div>
      <h2 class="sec-title">Submit Your <span class="hl">Grievance Application</span></h2>
      <p style="font-size:14px;color:var(--muted);margin-top:4px">Please fill in all fields accurately. Incomplete applications may be returned for clarification.</p>
    </div>
    <form onsubmit="return false">
      <div class="form-two-col">

        <div class="form-section-sep"><i class="fas fa-user"></i> Your Details (Complainant)</div>

        <div class="form-group-griev">
          <label class="form-label-g">Your Name / Firm Name <span class="req">*</span></label>
          <input type="text" class="form-ctrl" placeholder="Full name or firm name" required>
        </div>
        <div class="form-group-griev">
          <label class="form-label-g">PACT Member ID <span class="req">*</span></label>
          <input type="text" class="form-ctrl" placeholder="e.g. PACT/MEM/2024/00001" required>
        </div>
        <div class="form-group-griev">
          <label class="form-label-g">Mobile Number <span class="req">*</span></label>
          <input type="tel" class="form-ctrl" placeholder="+91 XXXXX XXXXX" required>
        </div>
        <div class="form-group-griev">
          <label class="form-label-g">Email Address <span class="req">*</span></label>
          <input type="email" class="form-ctrl" placeholder="your@email.com" required>
        </div>

        <div class="form-section-sep"><i class="fas fa-user-slash"></i> Other Party Details</div>

        <div class="form-group-griev">
          <label class="form-label-g">Name / Firm of Other Party <span class="req">*</span></label>
          <input type="text" class="form-ctrl" placeholder="Other party's name or firm" required>
        </div>
        <div class="form-group-griev">
          <label class="form-label-g">Relationship to You <span class="req">*</span></label>
          <select class="form-ctrl" required>
            <option value="">— Select —</option>
            <option>Fellow PACT Member</option>
            <option>Distributor / Supplier</option>
            <option>Customer / Buyer</option>
            <option>Manufacturer / OEM</option>
            <option>Other</option>
          </select>
        </div>
        <div class="form-group-griev">
          <label class="form-label-g">Other Party's Mobile / Email</label>
          <input type="text" class="form-ctrl" placeholder="Contact details of other party">
        </div>
        <div class="form-group-griev">
          <label class="form-label-g">Dispute Amount (if applicable)</label>
          <input type="text" class="form-ctrl" placeholder="e.g. ₹1,50,000">
        </div>

        <div class="form-section-sep"><i class="fas fa-file-alt"></i> Grievance Details</div>

        <div class="form-group-griev">
          <label class="form-label-g">Nature of Dispute <span class="req">*</span></label>
          <select class="form-ctrl" required>
            <option value="">— Select —</option>
            <option>Payment Dispute</option>
            <option>Warranty / Product Defect</option>
            <option>Contract Breach</option>
            <option>Delivery / Supply Issue</option>
            <option>Fraud / Misrepresentation</option>
            <option>Other</option>
          </select>
        </div>
        <div class="form-group-griev">
          <label class="form-label-g">Date of Dispute Arising <span class="req">*</span></label>
          <input type="date" class="form-ctrl" required>
        </div>
        <div class="form-group-griev" style="grid-column:1/-1">
          <label class="form-label-g">Detailed Description of Grievance <span class="req">*</span></label>
          <textarea class="form-ctrl" rows="5" placeholder="Describe the dispute in detail — what happened, what was agreed, what went wrong, and what resolution you are seeking…" required></textarea>
        </div>
        <div class="form-group-griev" style="grid-column:1/-1">
          <label class="form-label-g">Resolution Sought <span class="req">*</span></label>
          <textarea class="form-ctrl" rows="3" placeholder="What outcome are you seeking from PACT's Grievance Cell?" required></textarea>
        </div>

        <div class="griev-notice">
          <i class="fas fa-exclamation-triangle"></i>
          <div>By submitting this form, you confirm that the information is accurate and agree to participate in PACT's mediation process in <strong>good faith</strong>. PACT Management reserves the right to accept or decline grievance applications. All proceedings are <strong>strictly confidential</strong>.</div>
        </div>

      </div>
      <div class="btn-group">
        <button type="submit" class="btn-primary" onclick="alert('Application submitted! We will contact you within 5 working days.')">
          <i class="fas fa-paper-plane"></i> Submit Grievance Application
        </button>
        <a href="downloads.html" class="btn-ghost-light"><i class="fas fa-download"></i> Download Form (PDF)</a>
      </div>
    </form>
  </div>

  <!-- FAQ -->
  <div class="eyebrow">FAQs</div>
  <h2 class="sec-title" style="margin-bottom:24px">Common <span class="hl">Questions</span></h2>
  <div class="faq-griev">
    @forelse($faqs as $faq)
    <div class="faq-item-g">
      <div class="faq-q-g" onclick="this.parentElement.classList.toggle('open')">
        {{ $faq->question }} <i class="fas fa-chevron-down"></i>
      </div>
      <div class="faq-a-g">
        <p>{{ $faq->answer }}</p>
      </div>
    </div>
    @empty
    <div style="text-align:center;padding:40px;color:var(--muted)">No FAQs found. Please add them from the Admin Panel CMS.</div>
    @endforelse
  </div>

  <div class="cta-band-navy">
    <div class="cta-band-text"><h3>Need Help Before Filing?</h3><p>Contact the PACT Secretariat and speak to the Grievance Cell Chairperson directly before filing a formal application.</p></div>
    <div class="cta-band-btns">
      <a href="tel:+919417223355" class="btn-gold"><i class="fas fa-phone-alt"></i> Call Secretariat</a>
      <a href="contact.html" class="btn-ghost-dark"><i class="fas fa-envelope"></i> Send a Message</a>
    </div>
  </div>

</div>

@endsection
