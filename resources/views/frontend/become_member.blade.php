@extends('layouts.frontend')
@section('title') Become a Member – P A C T Punjab & Chandigarh @endsection

@section('content')
<style>
/* ── WHY JOIN GRID ── */
.why-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:22px;margin-bottom:80px}
.why-card{
  background:#fff;border:1px solid var(--border);border-radius:20px;
  padding:30px 24px;transition:transform .25s,box-shadow .25s;
  position:relative;overflow:hidden;
}
.why-card:hover{transform:translateY(-6px);box-shadow:var(--card-shadow-hover)}
.why-card::before{content:attr(data-num);position:absolute;top:-10px;right:12px;
  font-size:72px;font-weight:900;color:rgba(7,17,31,.04);line-height:1}
.why-ico{width:52px;height:52px;border-radius:14px;display:flex;align-items:center;
  justify-content:center;font-size:22px;margin-bottom:18px}
.why-card h4{font-size:15px;font-weight:700;color:var(--navy);margin-bottom:8px;line-height:1.3}
.why-card p{font-size:13px;color:var(--muted);line-height:1.7}

/* ── MEMBERSHIP TIERS ── */
.tiers-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin-bottom:80px}
.tier-card{
  border-radius:22px;overflow:hidden;border:1px solid var(--border);
  transition:transform .25s,box-shadow .25s;position:relative;
}
.tier-card:hover{transform:translateY(-6px);box-shadow:var(--card-shadow-hover)}
.tier-card.featured{border-color:var(--gold);box-shadow:0 0 0 3px rgba(245,166,35,.15)}
.tier-header{padding:32px 28px 24px;text-align:center;position:relative}
.tier-popular-badge{
  position:absolute;top:16px;right:16px;
  background:var(--gold);color:var(--navy);
  font-size:10px;font-weight:800;padding:4px 12px;border-radius:20px;
  text-transform:uppercase;letter-spacing:.5px;
}
.tier-icon{font-size:36px;margin-bottom:14px}
.tier-name{font-size:20px;font-weight:800;margin-bottom:8px}
.tier-price{font-size:36px;font-weight:900;line-height:1;margin-bottom:4px}
.tier-price sup{font-size:18px;vertical-align:top;margin-top:6px}
.tier-price-label{font-size:11px;font-weight:500;opacity:.6;margin-bottom:16px}
.tier-desc{font-size:12px;line-height:1.6;opacity:.7}
.tier-body{padding:24px 28px;background:#fff}
.tier-features{display:flex;flex-direction:column;gap:10px;margin-bottom:22px}
.tier-feat{display:flex;align-items:center;gap:10px;font-size:13px;color:var(--text)}
.tier-feat i{font-size:13px;flex-shrink:0}
.tier-feat.disabled{color:var(--muted)}
.tier-feat.disabled i{color:var(--border)}
.tier-btn{
  width:100%;padding:13px;border-radius:25px;font-family:var(--font);
  font-size:13px;font-weight:700;border:none;cursor:pointer;
  transition:all .2s;display:flex;align-items:center;justify-content:center;gap:8px;
}

/* ── PROCESS STEPS ── */
.process-section{margin-bottom:80px}
.process-steps{display:grid;grid-template-columns:repeat(5,1fr);gap:0;position:relative}
.process-steps::before{
  content:'';position:absolute;top:34px;
  left:calc(10%);right:calc(10%);
  height:2px;background:linear-gradient(90deg,var(--blue2),var(--accent));z-index:0;
}
.proc-step{text-align:center;padding:0 10px;position:relative;z-index:1}
.proc-circle{
  width:68px;height:68px;border-radius:50%;
  border:3px solid var(--border);background:#fff;
  display:flex;align-items:center;justify-content:center;
  margin:0 auto 18px;font-size:22px;
  transition:border-color .2s,box-shadow .2s;position:relative;
}
.proc-step:hover .proc-circle{border-color:var(--blue2);box-shadow:0 0 0 6px rgba(30,80,162,.08)}
.proc-num{
  position:absolute;top:-4px;right:-4px;
  width:22px;height:22px;border-radius:50%;
  background:var(--blue2);color:#fff;
  font-size:10px;font-weight:800;
  display:flex;align-items:center;justify-content:center;
}
.proc-step h5{font-size:13px;font-weight:700;color:var(--navy);margin-bottom:5px}
.proc-step p{font-size:11px;color:var(--muted);line-height:1.6}

/* ── FAQ ── */
.faq-section{margin-bottom:80px}
.faq-list{display:flex;flex-direction:column;gap:12px}
.faq-item{background:#fff;border:1px solid var(--border);border-radius:14px;overflow:hidden;transition:box-shadow .2s}
.faq-item:hover{box-shadow:var(--card-shadow)}
.faq-q{
  padding:18px 22px;display:flex;align-items:center;
  justify-content:space-between;gap:16px;cursor:pointer;
  font-size:14px;font-weight:700;color:var(--navy);
}
.faq-q i{font-size:12px;color:var(--muted);transition:transform .3s;flex-shrink:0}
.faq-item.open .faq-q i{transform:rotate(180deg);color:var(--blue2)}
.faq-a{
  max-height:0;overflow:hidden;transition:max-height .35s ease;
}
.faq-item.open .faq-a{max-height:200px}
.faq-a p{padding:0 22px 18px;font-size:13px;color:var(--muted);line-height:1.75}

/* ── FORM SECTION ── */
.membership-form-section{
  background:var(--light);border-radius:22px;
  padding:52px 48px;margin-bottom:80px;
}
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:18px}
.form-grid.three{grid-template-columns:1fr 1fr 1fr}
.form-group{display:flex;flex-direction:column;gap:6px}
.form-label{font-size:12px;font-weight:700;color:var(--navy);letter-spacing:.3px}
.form-label .req{color:var(--accent)}
.form-control{
  padding:11px 16px;border:1.5px solid var(--border);border-radius:10px;
  font-family:var(--font);font-size:14px;color:var(--text);background:#fff;
  outline:none;transition:border-color .2s,box-shadow .2s;
}
.form-control:focus{border-color:var(--blue2);box-shadow:0 0 0 3px rgba(30,80,162,.1)}
.form-control::placeholder{color:#B0BEC5}
textarea.form-control{resize:vertical;min-height:100px}
.form-section-divider{
  grid-column:1/-1;font-size:11px;font-weight:800;color:var(--navy);
  text-transform:uppercase;letter-spacing:1.5px;
  padding-bottom:10px;border-bottom:1px solid var(--border);
  margin-top:8px;display:flex;align-items:center;gap:8px;
}
.form-section-divider i{font-size:12px;color:var(--blue2)}

@media(max-width:1100px){
  .why-grid{grid-template-columns:1fr 1fr}
  .tiers-grid{grid-template-columns:1fr}
  .process-steps{grid-template-columns:1fr 1fr;gap:28px}
  .process-steps::before{display:none}
  .form-grid.three{grid-template-columns:1fr 1fr}
}
@media(max-width:768px){
  .why-grid{grid-template-columns:1fr}
  .form-grid{grid-template-columns:1fr}
  .form-grid.three{grid-template-columns:1fr}
  .process-steps{grid-template-columns:1fr 1fr}
  .membership-form-section{padding:32px 24px}
}
</style>

<!-- PAGE HERO -->
<div class="page-hero">
  <div class="hero-glow"></div>
  <div class="hero-glow2"></div>
  <div class="page-hero-inner">
    <div class="breadcrumb">
      <a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a>
      <i class="fas fa-chevron-right"></i>
      <a href="#">Members</a>
      <i class="fas fa-chevron-right"></i>
      <span class="active">Become a Member</span>
    </div>
    <div class="page-hero-tag"><span>Membership</span></div>
    <h1>Join <span>P A C T</span></h1>
    <p>{{ $settings['page_become_member_intro'] ?? "Become part of Punjab & Chandigarh's largest and most impactful IT trade association. One membership — unlimited access to advocacy, services, events, and a 600+ strong network." }}</p>
    <div class="hero-chips">
      <div class="hero-chip"><i class="fas fa-users"></i> 600+ Active Members</div>
      <div class="hero-chip"><i class="fas fa-rupee-sign"></i> Affordable Annual Fee</div>
      <div class="hero-chip"><i class="fas fa-clock"></i> Quick Approval</div>
      <div class="hero-chip"><i class="fas fa-gift"></i> Instant Benefits</div>
    </div>
  </div>
</div>

<div class="page-body">

  <!-- WHY JOIN -->
  <div class="eyebrow">Why Join?</div>
  <h2 class="sec-title" style="margin-bottom:10px">6 Reasons to Be a <span class="hl">PACT Member</span></h2>
  <p class="sec-sub">Every rupee of your membership fee works harder than you think.</p>

  <div class="why-grid">
    <div class="why-card" data-num="01">
      <div class="why-ico ico-box blue lg"><i class="fas fa-landmark"></i></div>
      <h4>Government Advocacy</h4>
      <p>Your voice reaches State and Central Government through PACT's direct lobbying on GST, import policy, and IT sector regulation. We fight for your business interests so you don't have to.</p>
    </div>
    <div class="why-card" data-num="02">
      <div class="why-ico ico-box gold lg"><i class="fas fa-receipt"></i></div>
      <h4>GST & Legal Helpdesk</h4>
      <p>Free access to PACT's expert GST helpdesk — get answers on compliance, e-Way Bills, e-Invoicing, and legal matters without expensive consultant fees.</p>
    </div>
    <div class="why-card" data-num="03">
      <div class="why-ico ico-box green lg"><i class="fas fa-network-wired"></i></div>
      <h4>600+ Member Network</h4>
      <p>Access the most comprehensive IT trader directory in Punjab & Chandigarh. Find reliable partners, suppliers, and customers from a verified network of 600+ businesses.</p>
    </div>
    <div class="why-card" data-num="04">
      <div class="why-ico ico-box red lg"><i class="fas fa-gavel"></i></div>
      <h4>Grievance Protection</h4>
      <p>PACT's Grievance Cell resolves disputes with suppliers, distributors, and customers — protecting your business without the cost and delay of going to court.</p>
    </div>
    <div class="why-card" data-num="05">
      <div class="why-ico ico-box purple lg"><i class="fas fa-calendar-alt"></i></div>
      <h4>50+ Events Per Year</h4>
      <p>Seminars, workshops, fellowship meets, sports events, and the flagship Annual Meet — all included in your membership. Real connections, real opportunities.</p>
    </div>
    <div class="why-card" data-num="06">
      <div class="why-ico ico-box teal lg"><i class="fas fa-award"></i></div>
      <h4>Recognition & Awards</h4>
      <p>Eligible for PACT's annual Excellence Awards — gaining industry recognition that builds your firm's credibility with customers, suppliers, and government.</p>
    </div>
  </div>

  <!-- MEMBERSHIP TIERS -->
  <div class="eyebrow">Membership Plans</div>
  <h2 class="sec-title" style="margin-bottom:10px">Choose Your <span class="hl">Membership Type</span></h2>
  <p class="sec-sub">All membership types include full access to PACT's core services, events, and member directory.</p>

  <div class="tiers-grid">

    @forelse($categories as $cat)
    <div class="tier-card {{ $cat->is_popular ? 'featured' : '' }}">
      <div class="tier-header" style="{{ $cat->is_popular ? 'background:linear-gradient(135deg,var(--navy2),var(--navy))' : 'background:linear-gradient(135deg,var(--light),#E8F0FE)' }}">
        @if($cat->is_popular)
        <div class="tier-popular-badge">Most Popular</div>
        <div class="tier-icon">⭐</div>
        @else
        <div class="tier-icon">🏢</div>
        @endif
        <div class="tier-name" style="{{ $cat->is_popular ? 'color:#fff' : 'color:var(--navy)' }}">{{ $cat->name }}</div>
        <div class="tier-price" style="{{ $cat->is_popular ? 'color:var(--gold2)' : 'color:var(--blue2)' }}"><sup>₹</sup>{{ number_format($cat->annual_fee) }}</div>
        <div class="tier-price-label" style="{{ $cat->is_popular ? 'color:rgba(255,255,255,.5)' : 'color:var(--muted)' }}">per year + GST</div>
        <div class="tier-desc" style="{{ $cat->is_popular ? 'color:rgba(255,255,255,.6)' : 'color:var(--muted)' }}">{{ $cat->description }}</div>
      </div>
      <div class="tier-body">
        <div class="tier-features">
          @if($cat->features && is_array($cat->features))
            @foreach($cat->features as $feat)
            <div class="tier-feat"><i class="fas fa-check-circle" style="color:#108C50"></i> {{ $feat }}</div>
            @endforeach
          @endif
        </div>
        <button class="tier-btn" style="{{ $cat->is_popular ? 'background:var(--gold);color:var(--navy)' : 'background:var(--navy);color:var(--gold2)' }}" onclick="scrollToForm()">
          <i class="fas {{ $cat->is_popular ? 'fa-star' : 'fa-user-plus' }}"></i> Apply as {{ $cat->name }}
        </button>
      </div>
    </div>
    @empty
    <div style="grid-column:1/-1;text-align:center;padding:40px;background:var(--light);border-radius:12px;color:var(--text-muted)">
      No membership plans available at the moment.
    </div>
    @endforelse

  </div>

  <!-- HOW TO JOIN PROCESS -->
  <div class="process-section">
    <div class="eyebrow">How to Join</div>
    <h2 class="sec-title" style="margin-bottom:48px">Simple <span class="hl">5-Step Process</span></h2>
    <div class="process-steps">
      <div class="proc-step">
        <div class="proc-circle">📝<div class="proc-num">1</div></div>
        <h5>Fill Application</h5>
        <p>Complete the membership application form below with your firm details.</p>
      </div>
      <div class="proc-step">
        <div class="proc-circle">📎<div class="proc-num">2</div></div>
        <h5>Submit Documents</h5>
        <p>Upload your business registration, GST certificate, and ID proof.</p>
      </div>
      <div class="proc-step">
        <div class="proc-circle">✅<div class="proc-num">3</div></div>
        <h5>EC Verification</h5>
        <p>PACT's Membership Committee reviews and verifies your application.</p>
      </div>
      <div class="proc-step">
        <div class="proc-circle">💳<div class="proc-num">4</div></div>
        <h5>Pay Fee</h5>
        <p>Make payment via UPI, NEFT, or cheque — receipt issued immediately.</p>
      </div>
      <div class="proc-step">
        <div class="proc-circle">🎉<div class="proc-num">5</div></div>
        <h5>Welcome!</h5>
        <p>Receive your member ID, certificate, and access to all PACT services.</p>
      </div>
    </div>
  </div>

  <!-- APPLICATION FORM -->
  <div class="membership-form-section" id="membershipForm">
    <div style="margin-bottom:32px">
      <div class="eyebrow">Apply Online</div>
      <h2 class="sec-title">Membership <span class="hl">Application Form</span></h2>
      <p style="font-size:14px;color:var(--muted);margin-top:4px">Fill in all required fields. Our team will contact you within 2 working days.</p>
    </div>

    <form onsubmit="return submitMembership(event)">

      <div class="form-grid">
        <div class="form-group" style="grid-column:1/-1">
          <span class="form-section-divider"><i class="fas fa-building"></i> Firm Information</span>
        </div>

        <div class="form-group">
          <label class="form-label">Name of Firm <span class="req">*</span></label>
          <input type="text" class="form-control" placeholder="e.g. Sharma Computer Traders" required>
        </div>
        <div class="form-group">
          <label class="form-label">Type of Business <span class="req">*</span></label>
          <select class="form-control" required>
            <option value="">— Select —</option>
            <option>Proprietorship</option>
            <option>Partnership</option>
            <option>Private Limited</option>
            <option>LLP</option>
            <option>Other</option>
          </select>
        </div>
        <div class="form-group">
          <label class="form-label">GSTIN</label>
          <input type="text" class="form-control" placeholder="27AAAAA0000A1Z5">
        </div>
        <div class="form-group">
          <label class="form-label">Year of Establishment <span class="req">*</span></label>
          <input type="number" class="form-control" placeholder="e.g. 2010" min="1980" max="2026" required>
        </div>

        <div class="form-group" style="grid-column:1/-1">
          <label class="form-label">Complete Address with Pin Code <span class="req">*</span></label>
          <textarea class="form-control" rows="2" placeholder="Shop/Office No., Street, Area, City — Pin Code" required></textarea>
        </div>

        <div class="form-group">
          <label class="form-label">District <span class="req">*</span></label>
          <select class="form-control" required>
            <option value="">— Select District —</option>
            <option>Chandigarh (UT)</option><option>Ludhiana</option><option>Amritsar</option>
            <option>Jalandhar</option><option>Patiala</option><option>Mohali (SAS Nagar)</option>
            <option>Bathinda</option><option>Pathankot</option><option>Hoshiarpur</option>
            <option>Gurdaspur</option><option>Ropar (Rupnagar)</option><option>Sangrur</option>
            <option>Faridkot</option><option>Moga</option><option>Ferozepur</option>
            <option>Kapurthala</option><option>Fatehgarh Sahib</option><option>Barnala</option>
            <option>Mansa</option><option>Muktsar</option><option>Tarn Taran</option>
          </select>
        </div>
        <div class="form-group">
          <label class="form-label">City Association <span class="req">*</span></label>
          <select class="form-control" required>
            <option value="">— Select Association —</option>
            <option>Chandigarh IT Association</option>
            <option>Ludhiana Computer Traders</option>
            <option>Amritsar IT Association</option>
            <option>Jalandhar Computer Dealers</option>
            <option>Patiala IT Traders</option>
            <option>Mohali Tech Association</option>
            <option>Bathinda IT Traders</option>
            <option>Other</option>
          </select>
        </div>
      </div>

      <div class="form-grid" style="margin-top:18px">
        <div class="form-group" style="grid-column:1/-1">
          <span class="form-section-divider"><i class="fas fa-user-tie"></i> Proprietor / Contact Details</span>
        </div>
        <div class="form-group">
          <label class="form-label">Proprietor / Partner / Director <span class="req">*</span></label>
          <input type="text" class="form-control" placeholder="Full name" required>
        </div>
        <div class="form-group">
          <label class="form-label">Designation</label>
          <input type="text" class="form-control" placeholder="e.g. Proprietor, MD, CEO">
        </div>
        <div class="form-group">
          <label class="form-label">Mobile Number <span class="req">*</span></label>
          <input type="tel" class="form-control" placeholder="+91 XXXXX XXXXX" required>
        </div>
        <div class="form-group">
          <label class="form-label">Email Address <span class="req">*</span></label>
          <input type="email" class="form-control" placeholder="info@yourfirm.com" required>
        </div>
        <div class="form-group">
          <label class="form-label">Website</label>
          <input type="url" class="form-control" placeholder="https://www.yourwebsite.com">
        </div>
        <div class="form-group">
          <label class="form-label">Membership Type <span class="req">*</span></label>
          <select class="form-control" required>
            <option value="">— Select —</option>
            <option>Regular Member — ₹2,500/year</option>
            <option>Associate Member — ₹5,000/year</option>
            <option>Life Member — ₹25,000 one-time</option>
          </select>
        </div>
      </div>

      <div class="form-grid" style="margin-top:18px">
        <div class="form-group" style="grid-column:1/-1">
          <span class="form-section-divider"><i class="fas fa-industry"></i> Business Profile</span>
        </div>
        <div class="form-group" style="grid-column:1/-1">
          <label class="form-label">Companies / Brands Dealt With <span class="req">*</span></label>
          <input type="text" class="form-control" placeholder="e.g. HP, Dell, Lenovo, Acer, Intel, Microsoft" required>
        </div>
        <div class="form-group" style="grid-column:1/-1">
          <label class="form-label">Brief Description of Business</label>
          <textarea class="form-control" rows="3" placeholder="Briefly describe your business operations, products, and services…"></textarea>
        </div>
      </div>

      <div style="margin-top:28px;padding:18px 20px;background:rgba(30,80,162,.05);border:1px solid rgba(30,80,162,.15);border-radius:12px;display:flex;align-items:flex-start;gap:12px">
        <input type="checkbox" id="termsCheck" style="margin-top:3px;accent-color:var(--blue2);flex-shrink:0;width:16px;height:16px" required>
        <label for="termsCheck" style="font-size:13px;color:var(--text);cursor:pointer;line-height:1.6">
          I confirm that the information provided is accurate and I agree to PACT's
          <a href="#" style="color:var(--blue2);font-weight:600">Terms & Conditions</a>
          and the
          <a href="#" style="color:var(--blue2);font-weight:600">Code of Conduct for Members</a>.
          I understand that PACT Management reserves the right to accept or reject my application.
        </label>
      </div>

      <div style="display:flex;gap:14px;margin-top:24px;flex-wrap:wrap">
        <button type="submit" class="btn-primary" style="padding:14px 36px;font-size:14px">
          <i class="fas fa-paper-plane"></i> Submit Membership Application
        </button>
        <button type="reset" class="btn-ghost-light" style="padding:14px 28px">
          <i class="fas fa-redo"></i> Clear Form
        </button>
      </div>

    </form>
  </div>

  <!-- FAQ -->
  <div class="faq-section">
    <div class="eyebrow">FAQs</div>
    <h2 class="sec-title" style="margin-bottom:28px">Common <span class="hl">Questions</span></h2>
    <div class="faq-list">
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">Who is eligible to become a PACT member? <i class="fas fa-chevron-down"></i></div>
        <div class="faq-a"><p>Any IT trading business, distributor, system integrator, or IT service provider operating in Punjab or Chandigarh is eligible. The proprietor, partner, or director must be an Indian citizen. New businesses and established firms are both welcome.</p></div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">How long does the approval process take? <i class="fas fa-chevron-down"></i></div>
        <div class="faq-a"><p>Most applications are reviewed and approved within 5–7 working days of receiving the completed application and documents. You will receive an email confirmation once approved, followed by your member ID and certificate.</p></div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">What documents are required for membership? <i class="fas fa-chevron-down"></i></div>
        <div class="faq-a"><p>You will need: (1) Business registration certificate / trade license, (2) GST registration certificate, (3) Proprietor/Director photo ID proof (Aadhar/PAN), and (4) Two passport-size photographs. Documents can be submitted online or at the PACT office.</p></div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">Can I be a member of both PACT and my city association? <i class="fas fa-chevron-down"></i></div>
        <div class="faq-a"><p>Yes — PACT membership is separate from city-level association membership. In fact, we strongly encourage you to be a member of both. Your city association handles local activities while PACT represents you at the state and national level.</p></div>
      </div>
      <div class="faq-item">
        <div class="faq-q" onclick="toggleFaq(this)">Is the membership fee refundable if my application is rejected? <i class="fas fa-chevron-down"></i></div>
        <div class="faq-a"><p>If your application is rejected, the fee will be refunded in full within 15 working days after deduction of a nominal processing charge of ₹200. We recommend submitting all required documents carefully to avoid rejection.</p></div>
      </div>
    </div>
  </div>

  <!-- CTA -->
  <div class="cta-band-red">
    <div class="cta-band-text">
      <h3>Still Have Questions? Talk to Our Team.</h3>
      <p>Our membership team is available Monday to Saturday, 10 AM to 5 PM. Call us, email us, or visit the PACT office in Chandigarh.</p>
    </div>
    <div class="cta-band-btns">
      <a href="tel:+919417223355" class="btn-white"><i class="fas fa-phone-alt"></i> +91 94172-23355</a>
      <a href="#" class="btn-ghost-dark"><i class="fas fa-envelope"></i> Send a Message</a>
    </div>
  </div>

</div>

<script>
function scrollToForm(){
  document.getElementById('membershipForm').scrollIntoView({behavior:'smooth',block:'start'});
}
function toggleFaq(el){
  const item = el.parentElement;
  item.classList.toggle('open');
}
function submitMembership(e){
  e.preventDefault();
  alert('Application submitted successfully!\nOur team will contact you within 2 working days.\nThank you for applying to PACT.');
  return false;
}
</script>
@endsection
