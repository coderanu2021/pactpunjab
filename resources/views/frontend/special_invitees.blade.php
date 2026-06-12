
@extends('layouts.frontend')
@section('title')
Special Invitees – P A C T Punjab & Chandigarh
@endsection

@section('content')
<style>
/* ── INTRO BAND ── */
.intro-band{
  background:linear-gradient(135deg,var(--navy2),var(--navy));
  border-radius:22px;padding:44px 48px;margin-bottom:80px;
  display:grid;grid-template-columns:1.2fr .8fr;gap:40px;align-items:center;
  position:relative;overflow:hidden;
}
.intro-band::before{content:'';position:absolute;width:400px;height:400px;border-radius:50%;background:radial-gradient(circle,rgba(245,166,35,.1) 0%,transparent 70%);right:-80px;top:-80px;pointer-events:none}
.intro-band h2{font-size:clamp(20px,2.5vw,30px);font-weight:900;color:#fff;margin-bottom:10px}
.intro-band p{font-size:14px;color:rgba(255,255,255,.55);line-height:1.75}
.intro-band-right{display:flex;flex-direction:column;gap:12px;position:relative;z-index:1}
.intro-stat{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:12px;padding:16px 20px;display:flex;align-items:center;gap:14px}
.intro-stat-ico{width:40px;height:40px;border-radius:10px;background:rgba(245,166,35,.15);display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0}
.intro-stat strong{display:block;font-size:14px;font-weight:800;color:#fff}
.intro-stat span{font-size:11px;color:rgba(255,255,255,.45)}

/* ── INVITEE CARDS ── */
.invitee-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin-bottom:80px}
.invitee-card{
  background:#fff;border:1px solid var(--border);border-radius:20px;
  overflow:hidden;transition:transform .25s,box-shadow .25s;
}
.invitee-card:hover{transform:translateY(-6px);box-shadow:var(--card-shadow-hover)}
.invitee-card-top{padding:28px 24px;display:flex;flex-direction:column;align-items:center;text-align:center;position:relative}
.invitee-avatar{
  width:80px;height:80px;border-radius:20px;
  display:flex;align-items:center;justify-content:center;
  font-size:24px;font-weight:900;color:#fff;
  margin-bottom:14px;font-family:var(--font);
  box-shadow:0 8px 24px rgba(0,0,0,.12);
}
.invitee-badge{position:absolute;top:14px;right:14px;padding:3px 10px;border-radius:20px;font-size:10px;font-weight:700}
.invitee-card-top h4{font-size:16px;font-weight:800;color:var(--navy);margin-bottom:3px}
.invitee-card-top .inv-org{font-size:12px;color:var(--muted);margin-bottom:6px;font-weight:500}
.invitee-card-top .inv-city{font-size:11px;color:var(--muted);display:flex;align-items:center;justify-content:center;gap:4px}
.invitee-card-top .inv-city i{font-size:10px;color:var(--blue2)}
.invitee-card-body{padding:18px 24px;border-top:1px solid var(--border)}
.invitee-card-body p{font-size:12px;color:var(--muted);line-height:1.65;margin-bottom:12px}
.inv-expertise{display:flex;flex-wrap:wrap;gap:6px}
.inv-tag{padding:3px 10px;border-radius:20px;font-size:10px;font-weight:600;background:var(--light);border:1px solid var(--border);color:var(--muted)}

/* ── WHY INVITEES ── */
.why-section{background:var(--light);border-radius:22px;padding:48px;margin-bottom:80px}
.why-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-top:32px}
.why-item{background:#fff;border:1px solid var(--border);border-radius:14px;padding:22px 18px;text-align:center;transition:box-shadow .2s,transform .2s}
.why-item:hover{box-shadow:var(--card-shadow);transform:translateY(-3px)}
.why-item .why-ico{font-size:32px;margin-bottom:12px}
.why-item h5{font-size:14px;font-weight:700;color:var(--navy);margin-bottom:6px}
.why-item p{font-size:12px;color:var(--muted);line-height:1.6}

@media(max-width:1100px){
  .invitee-grid{grid-template-columns:1fr 1fr}
  .intro-band{grid-template-columns:1fr}
  .why-grid{grid-template-columns:1fr 1fr}
}
@media(max-width:700px){
  .invitee-grid{grid-template-columns:1fr}
  .why-grid{grid-template-columns:1fr}
  .intro-band{padding:32px 24px}
  .why-section{padding:32px 24px}
}
</style>



<x-ui.page-hero title="Special Invitees" subtitle="Management" description="Distinguished industry leaders, government officials, and domain experts 
        who contribute their expertise to PACT's governance and activities."
    :breadcrumbs="[
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'Management', 'url' => '#'],
        ['label' => 'Special Invitees']
    ]">
    <x-slot:chips>
       <div class="hero-chip"><i class="fas fa-star"></i> Distinguished Members</div>
      <div class="hero-chip"><i class="fas fa-landmark"></i> Govt. Officials</div>
      <div class="hero-chip"><i class="fas fa-industry"></i> Industry Experts</div>
    </x-slot:chips>

</x-ui.page-hero>

<div class="page-body">

  <!-- INTRO BAND -->
  <div class="intro-band">
    <div style="position:relative;z-index:1">
      <div class="eyebrow ew-gold2">About Special Invitees</div>
      <h2>Distinguished Voices That Strengthen PACT</h2>
      <p>Special Invitees are individuals invited by the PACT Executive Committee to contribute their specialised knowledge, government relationships, or industry standing to PACT's work. They attend EC meetings, advise on policy matters, and lend their authority to PACT's advocacy efforts — without holding an elected position.</p>
    </div>
    <div class="intro-band-right">
      <div class="intro-stat">
        <div class="intro-stat-ico">🏛️</div>
        <div><strong>Government Officials</strong><span>Senior IAS, IPS & tech ministry representatives</span></div>
      </div>
      <div class="intro-stat">
        <div class="intro-stat-ico">🏭</div>
        <div><strong>Industry Leaders</strong><span>CXOs from leading IT companies & OEMs</span></div>
      </div>
      <div class="intro-stat">
        <div class="intro-stat-ico">⚖️</div>
        <div><strong>Legal & Tax Experts</strong><span>GST practitioners, trade law specialists</span></div>
      </div>
    </div>
  </div>

  <!-- INVITEES GRID -->
  <div class="eyebrow">Distinguished Members</div>
  <h2 class="sec-title" style="margin-bottom:10px">Our <span class="hl">Special Invitees</span></h2>
  <p class="sec-sub">Invited by the EC for their expertise, standing, and contribution to PACT's mission.</p>

  <div class="invitee-grid">

    <div class="invitee-card">
      <div class="invitee-card-top" style="background:linear-gradient(180deg,rgba(30,80,162,.05),#fff)">
        <div class="invitee-avatar" style="background:linear-gradient(140deg,var(--blue2),var(--navy))">AK</div>
        <span class="invitee-badge" style="background:rgba(30,80,162,.1);color:var(--blue2)">Govt. Official</span>
        <h4>Anil Kumar (IAS)</h4>
        <div class="inv-org">Dept. of IT, Govt. of Punjab</div>
        <div class="inv-city"><i class="fas fa-map-marker-alt"></i> Chandigarh</div>
      </div>
      <div class="invitee-card-body">
        <p>Additional Secretary, IT Department, Government of Punjab. Represents the state government's perspective on digital infrastructure and IT trade policy in PACT's deliberations.</p>
        <div class="inv-expertise">
          <span class="inv-tag">IT Policy</span><span class="inv-tag">Digital Punjab</span><span class="inv-tag">Govt. Procurement</span>
        </div>
      </div>
    </div>

    <div class="invitee-card">
      <div class="invitee-card-top" style="background:linear-gradient(180deg,rgba(245,166,35,.05),#fff)">
        <div class="invitee-avatar" style="background:linear-gradient(140deg,var(--gold),#C47D00)">RS</div>
        <span class="invitee-badge" style="background:rgba(245,166,35,.12);color:#7A4A00">Industry Leader</span>
        <h4>Rajesh Srivastava</h4>
        <div class="inv-org">MAIT — National Council Member</div>
        <div class="inv-city"><i class="fas fa-map-marker-alt"></i> Delhi / Chandigarh</div>
      </div>
      <div class="invitee-card-body">
        <p>National Council Member of MAIT (Manufacturers' Association for IT) and veteran IT industry leader with 30+ years experience bridging the gap between manufacturers and traders.</p>
        <div class="inv-expertise">
          <span class="inv-tag">MAIT</span><span class="inv-tag">IT Manufacturing</span><span class="inv-tag">Trade Policy</span>
        </div>
      </div>
    </div>

    <div class="invitee-card">
      <div class="invitee-card-top" style="background:linear-gradient(180deg,rgba(124,58,237,.05),#fff)">
        <div class="invitee-avatar" style="background:linear-gradient(140deg,#7C3AED,#4C1D95)">SK</div>
        <span class="invitee-badge" style="background:rgba(124,58,237,.1);color:#7C3AED">Legal Expert</span>
        <h4>Suresh Kapila</h4>
        <div class="inv-org">GST & Tax Law Practitioner</div>
        <div class="inv-city"><i class="fas fa-map-marker-alt"></i> Chandigarh</div>
      </div>
      <div class="invitee-card-body">
        <p>Senior GST and indirect tax practitioner with deep expertise in IT hardware & software taxation. Advises PACT's GST Helpdesk and represents members in complex compliance matters.</p>
        <div class="inv-expertise">
          <span class="inv-tag">GST</span><span class="inv-tag">Indirect Tax</span><span class="inv-tag">Trade Law</span>
        </div>
      </div>
    </div>

    <div class="invitee-card">
      <div class="invitee-card-top" style="background:linear-gradient(180deg,rgba(5,150,105,.05),#fff)">
        <div class="invitee-avatar" style="background:linear-gradient(140deg,#059669,#065F46)">PM</div>
        <span class="invitee-badge" style="background:rgba(5,150,105,.1);color:#065F46">Industry Leader</span>
        <h4>Poonam Mehta</h4>
        <div class="inv-org">HP India — Channel Director (North)</div>
        <div class="inv-city"><i class="fas fa-map-marker-alt"></i> Chandigarh</div>
      </div>
      <div class="invitee-card-body">
        <p>Channel Director (North India) at HP India with responsibility for the entire Punjab & Chandigarh dealer network. Facilitates stronger OEM-trader relationships for PACT members.</p>
        <div class="inv-expertise">
          <span class="inv-tag">HP Channel</span><span class="inv-tag">OEM Relations</span><span class="inv-tag">Distribution</span>
        </div>
      </div>
    </div>

    <div class="invitee-card">
      <div class="invitee-card-top" style="background:linear-gradient(180deg,rgba(220,38,38,.05),#fff)">
        <div class="invitee-avatar" style="background:linear-gradient(140deg,#DC2626,#991B1B)">VB</div>
        <span class="invitee-badge" style="background:rgba(220,38,38,.1);color:#991B1B">Trade Expert</span>
        <h4>Vijay Batra</h4>
        <div class="inv-org">CII Punjab — IT Sector Chair</div>
        <div class="inv-city"><i class="fas fa-map-marker-alt"></i> Ludhiana</div>
      </div>
      <div class="invitee-card-body">
        <p>Chair of the IT Sector Committee at CII (Confederation of Indian Industry) Punjab Chapter. Represents PACT's interests in cross-industry policy forums and government engagement.</p>
        <div class="inv-expertise">
          <span class="inv-tag">CII</span><span class="inv-tag">Industry Policy</span><span class="inv-tag">Trade Advocacy</span>
        </div>
      </div>
    </div>

    <div class="invitee-card">
      <div class="invitee-card-top" style="background:linear-gradient(180deg,rgba(14,165,233,.05),#fff)">
        <div class="invitee-avatar" style="background:linear-gradient(140deg,#0284C7,#0C4A6E)">MG</div>
        <span class="invitee-badge" style="background:rgba(14,165,233,.1);color:#0369A1">Tech Expert</span>
        <h4>Meera Gupta</h4>
        <div class="inv-org">Cybersecurity Specialist & Author</div>
        <div class="inv-city"><i class="fas fa-map-marker-alt"></i> Chandigarh</div>
      </div>
      <div class="invitee-card-body">
        <p>Certified cybersecurity expert and published author advising PACT's SIG on digital security matters. Runs PACT's annual cybersecurity awareness seminar for IT trader members.</p>
        <div class="inv-expertise">
          <span class="inv-tag">Cybersecurity</span><span class="inv-tag">Data Protection</span><span class="inv-tag">IT Act</span>
        </div>
      </div>
    </div>

  </div>

  <!-- WHY SPECIAL INVITEES -->
  <div class="why-section">
    <div class="eyebrow">Their Role</div>
    <h2 class="sec-title">Why Special Invitees <span class="hl">Matter</span></h2>
    <div class="why-grid">
      <div class="why-item">
        <div class="why-ico">🏛️</div>
        <h5>Government Access</h5>
        <p>Invitees with government backgrounds open doors for PACT that would otherwise require months of formal channels to access.</p>
      </div>
      <div class="why-item">
        <div class="why-ico">🧠</div>
        <h5>Expert Knowledge</h5>
        <p>Legal, tax, and technology experts provide PACT's leadership with specialised guidance unavailable within the elected committee.</p>
      </div>
      <div class="why-item">
        <div class="why-ico">🔗</div>
        <h5>Industry Connections</h5>
        <p>Senior industry figures bring OEM relationships, national body connections, and market intelligence that benefits all PACT members.</p>
      </div>
    </div>
  </div>

  <!-- CTA -->
  <div class="cta-band-navy">
    <div class="cta-band-text">
      <h3>Know Someone Who Should Be Invited?</h3>
      <p>PACT welcomes nominations for Special Invitees who can contribute meaningfully to the IT trading community. Nominations are reviewed by the Executive Committee annually.</p>
    </div>
    <div class="cta-band-btns">
      <a href="contact.html" class="btn-gold"><i class="fas fa-paper-plane"></i> Submit Nomination</a>
      <a href="advisory-board.html" class="btn-ghost-dark"><i class="fas fa-chalkboard-teacher"></i> Advisory Board</a>
    </div>
  </div>

</div>
@endsection