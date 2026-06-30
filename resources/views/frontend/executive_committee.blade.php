
@extends('layouts.frontend')
@section('title')
Executive Committee – P A C T Punjab & Chandigarh
@endsection

@section('content')
<style>
/* ── COMMITTEE INTRO BAND ── */
.committee-band{
  background:linear-gradient(135deg,var(--navy2),var(--navy));
  border-radius:22px;padding:44px 48px;margin-bottom:80px;
  display:flex;align-items:center;justify-content:space-between;gap:32px;flex-wrap:wrap;
  position:relative;overflow:hidden;border:1px solid rgba(30,80,162,.2);
}
.committee-band::before{content:'';position:absolute;width:400px;height:400px;border-radius:50%;background:radial-gradient(circle,rgba(30,80,162,.25) 0%,transparent 70%);right:-80px;top:-80px;pointer-events:none}
.cb-text h2{font-size:clamp(20px,2.5vw,30px);font-weight:900;color:#fff;margin-bottom:8px;letter-spacing:-.3px}
.cb-text p{font-size:14px;color:rgba(255,255,255,.55);line-height:1.75;max-width:520px}
.cb-stats{display:flex;gap:28px;flex-wrap:wrap;flex-shrink:0;position:relative;z-index:1}
.cb-stat{text-align:center;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.09);border-radius:14px;padding:18px 24px}
.cb-stat .n{font-size:28px;font-weight:900;color:var(--gold2);line-height:1}
.cb-stat .l{font-size:10px;color:rgba(255,255,255,.4);font-weight:600;text-transform:uppercase;letter-spacing:.8px;margin-top:4px}

/* ── FILTER / SEARCH BAR ── */
.member-toolbar{display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap;margin-bottom:36px}
.city-filters{display:flex;gap:8px;flex-wrap:wrap}
.city-pill{padding:7px 16px;border-radius:25px;font-size:12px;font-weight:600;border:1.5px solid var(--border);color:var(--muted);background:#fff;cursor:pointer;transition:all .2s;font-family:var(--font)}
.city-pill:hover{border-color:var(--blue2);color:var(--blue2)}
.city-pill.active{background:var(--navy);border-color:var(--navy);color:var(--gold2)}

/* ── EC MEMBER CARDS ── */
.ec-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;margin-bottom:80px}
.ec-card{
  background:#fff;border:1px solid var(--border);border-radius:18px;
  padding:24px 18px;text-align:center;
  transition:transform .25s,box-shadow .25s;
}
.ec-card:hover{transform:translateY(-5px);box-shadow:var(--card-shadow-hover)}
.ec-avatar{
  width:64px;height:64px;border-radius:16px;
  display:flex;align-items:center;justify-content:center;
  font-size:20px;font-weight:900;color:#fff;
  margin:0 auto 14px;font-family:var(--font);
}
.ec-card h5{font-size:14px;font-weight:700;color:var(--navy);margin-bottom:4px}
.ec-card .ec-firm{font-size:11px;color:var(--muted);margin-bottom:4px}
.ec-card .ec-city{font-size:11px;color:var(--muted);display:flex;align-items:center;justify-content:center;gap:4px;margin-bottom:10px}
.ec-card .ec-city i{font-size:10px;color:var(--blue2)}
.ec-role-tag{display:inline-block;padding:3px 10px;border-radius:20px;font-size:10px;font-weight:700;margin-bottom:10px}
.ec-card .ec-contact{display:flex;gap:6px;justify-content:center;margin-top:10px}
.econ{width:28px;height:28px;border-radius:7px;border:1.5px solid var(--border);display:flex;align-items:center;justify-content:center;font-size:11px;color:var(--muted);transition:all .2s;cursor:pointer}
.econ:hover{border-color:var(--blue2);color:var(--blue2)}

/* ── STRUCTURE CHART ── */
.structure-section{margin-bottom:80px}
.org-chart{background:var(--light);border-radius:22px;padding:48px;text-align:center}
.oc-top{display:inline-block;background:var(--navy);border-radius:14px;padding:16px 32px;margin-bottom:32px;position:relative}
.oc-top::after{content:'';position:absolute;left:50%;bottom:-20px;transform:translateX(-50%);width:2px;height:20px;background:var(--border)}
.oc-top span{font-size:14px;font-weight:800;color:var(--gold2)}
.oc-top small{display:block;font-size:11px;color:rgba(255,255,255,.4);margin-top:2px}
.oc-row{display:flex;align-items:flex-start;justify-content:center;gap:16px;flex-wrap:wrap;margin-bottom:28px;position:relative}
.oc-row::before{content:'';position:absolute;left:50%;top:-20px;transform:translateX(-50%);width:2px;height:20px;background:var(--border)}
.oc-node{background:#fff;border:1px solid var(--border);border-radius:12px;padding:12px 18px;min-width:140px;text-align:center;transition:box-shadow .2s}
.oc-node:hover{box-shadow:var(--card-shadow)}
.oc-node span{display:block;font-size:13px;font-weight:700;color:var(--navy)}
.oc-node small{font-size:10px;color:var(--muted);font-weight:500}
.oc-connector{display:flex;justify-content:center;gap:16px;margin-bottom:8px}
.oc-connector::before{content:'';position:absolute;top:0;left:25%;right:25%;height:2px;background:var(--border)}

/* ── RESPONSIBILITIES ── */
.ec-resp{background:#fff;border:1px solid var(--border);border-radius:22px;padding:40px;margin-bottom:80px}
.ec-resp h3{font-size:20px;font-weight:800;color:var(--navy);margin-bottom:24px;padding-bottom:16px;border-bottom:1px solid var(--border)}
.ec-resp-grid{display:grid;grid-template-columns:1fr 1fr;gap:18px}
.ec-resp-item{display:flex;align-items:flex-start;gap:14px;padding:16px;background:var(--light);border-radius:12px}
.ec-resp-item-ico{width:38px;height:38px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:15px;flex-shrink:0}
.ec-resp-item h6{font-size:13px;font-weight:700;color:var(--navy);margin-bottom:4px}
.ec-resp-item p{font-size:12px;color:var(--muted);line-height:1.6}

@media(max-width:1100px){
  .ec-grid{grid-template-columns:repeat(3,1fr)}
  .committee-band{flex-direction:column}
  .ec-resp-grid{grid-template-columns:1fr}
}
@media(max-width:768px){
  .ec-grid{grid-template-columns:1fr 1fr}
  .org-chart{padding:28px 18px}
}
@media(max-width:480px){
  .ec-grid{grid-template-columns:1fr}
}
</style>

<!-- PAGE HERO -->
<x-ui.page-hero title="Activities & Services" subtitle="Management" description="The 24-member Executive Committee that drives PACT's governance, policy decisions, and member services across Punjab & Chandigarh."
    :breadcrumbs="[
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'Management', 'url' => '#'],
        ['label' => 'Executive Committee']
    ]">
    <x-slot:chips>
      <div class="hero-chip"><i class="fas fa-users"></i> 24 Members</div>
      <div class="hero-chip"><i class="fas fa-vote-yea"></i> Elected 2024</div>
      <div class="hero-chip"><i class="fas fa-map-marker-alt"></i> All Regions</div>
      <div class="hero-chip"><i class="fas fa-calendar"></i> Term 2024–26</div>
    </x-slot:chips>

</x-ui.page-hero>

<div class="page-body">

  <!-- COMMITTEE INTRO BAND -->
  <div class="committee-band">
    <div class="cb-text">
      <div class="eyebrow ew-gold2">About the EC</div>
      <h2>The Governing Body of P A C T</h2>
      <p>The Executive Committee is PACT's primary decision-making body. It meets quarterly to review activities, approve budgets, guide policy positions, and ensure the association delivers on its mandate to all 600+ members.</p>
    </div>
    <div class="cb-stats">
      <div class="cb-stat"><div class="n">24</div><div class="l">EC Members</div></div>
      <div class="cb-stat"><div class="n">4</div><div class="l">Meetings/Year</div></div>
      <div class="cb-stat"><div class="n">11<sup style="font-size:12px">+</sup></div><div class="l">Cities Rep.</div></div>
    </div>
  </div>

  <!-- TOOLBAR -->
  <div class="member-toolbar">
    <div class="city-filters">
      <div class="city-pill active" onclick="filterCity(this,'all')">All Cities</div>
      <div class="city-pill" onclick="filterCity(this,'chandigarh')">Chandigarh</div>
      <div class="city-pill" onclick="filterCity(this,'ludhiana')">Ludhiana</div>
      <div class="city-pill" onclick="filterCity(this,'amritsar')">Amritsar</div>
      <div class="city-pill" onclick="filterCity(this,'jalandhar')">Jalandhar</div>
      <div class="city-pill" onclick="filterCity(this,'patiala')">Patiala</div>
    </div>
    <div class="search-bar" style="max-width:240px">
      <input type="text" placeholder="Search member…" oninput="searchEC(this.value)">
      <button><i class="fas fa-search"></i></button>
    </div>
  </div>

  <!-- EC GRID -->
  <div class="ec-grid" id="ec-grid">
      @forelse($members as $member)
      <div class="ec-card" data-city="punjab">
        <div class="ec-avatar" style="background:linear-gradient(140deg,var(--gold),#C47D00)">{{ strtoupper(substr($member->name, 0, 2)) }}</div>
        <h5>{{ $member->name }}</h5>
        <div class="ec-firm">Punjab</div>
        <div class="ec-city"><i class="fas fa-map-marker-alt"></i> Punjab & Chandigarh</div>
        <div class="ec-role-tag" style="background:rgba(245,166,35,.12);color:#7A4A00">{{ $member->designation ?? $member->type }}</div>
        <div class="ec-contact"><div class="econ"><i class="fas fa-envelope"></i></div><div class="econ"><i class="fas fa-phone"></i></div></div>
      </div>
      @empty
      <div style="grid-column:1/-1;text-align:center;padding:40px;color:var(--muted)">No executive committee members found. Please add them from the Admin Panel CMS.</div>
      @endforelse
  </div><!-- /ec-grid -->

  <!-- RESPONSIBILITIES -->
  <div class="ec-resp">
    <h3><i class="fas fa-tasks" style="color:var(--blue2);margin-right:10px"></i>Executive Committee — Roles & Functions</h3>
    <div class="ec-resp-grid">
      <div class="ec-resp-item">
        <div class="ec-resp-item-ico ico-box blue md"><i class="fas fa-gavel"></i></div>
        <div><h6>Policy Decision-Making</h6><p>The EC meets quarterly to review all major decisions, approve budgets, and set PACT's official positions on industry and regulatory matters.</p></div>
      </div>
      <div class="ec-resp-item">
        <div class="ec-resp-item-ico ico-box red md"><i class="fas fa-landmark"></i></div>
        <div><h6>Government Liaison</h6><p>EC members represent PACT in interactions with Punjab Government, central ministries, and regulatory bodies on behalf of all 600+ members.</p></div>
      </div>
      <div class="ec-resp-item">
        <div class="ec-resp-item-ico ico-box gold md"><i class="fas fa-calendar-check"></i></div>
        <div><h6>Event Oversight</h6><p>The EC approves and oversees PACT's annual calendar of events — from the flagship Annual Meet to sports tournaments, seminars, and CSR drives.</p></div>
      </div>
      <div class="ec-resp-item">
        <div class="ec-resp-item-ico ico-box green md"><i class="fas fa-user-check"></i></div>
        <div><h6>Membership Approval</h6><p>New member applications and certification registrations are reviewed and approved by the EC, ensuring quality and eligibility standards are maintained.</p></div>
      </div>
      <div class="ec-resp-item">
        <div class="ec-resp-item-ico ico-box purple md"><i class="fas fa-balance-scale"></i></div>
        <div><h6>Grievance Oversight</h6><p>The EC supervises the Grievance Cell and acts as the final escalation authority for disputes that cannot be resolved at the operational level.</p></div>
      </div>
      <div class="ec-resp-item">
        <div class="ec-resp-item-ico ico-box teal md"><i class="fas fa-chart-line"></i></div>
        <div><h6>Strategic Planning</h6><p>The EC reviews PACT's long-term strategy annually, sets membership growth targets, and approves new services and initiatives for the coming year.</p></div>
      </div>
    </div>
  </div>

  <!-- CTA -->
  <div class="cta-band-navy">
    <div class="cta-band-text">
      <h3>Want to Join the Executive Committee?</h3>
      <p>EC positions are filled through democratic elections open to all PACT members in good standing. Start by becoming a member and engaging with your local chapter.</p>
    </div>
    <div class="cta-band-btns">
      <a href="become-member.html" class="btn-gold"><i class="fas fa-user-plus"></i> Become a Member</a>
      <a href="office-bearers.html" class="btn-ghost-dark"><i class="fas fa-id-badge"></i> Office Bearers</a>
    </div>
  </div>

</div>
<!-- <?php include 'includes/footer.php'; ?> -->

<script>
function filterCity(btn, city) {
  document.querySelectorAll('.city-pill').forEach(p => p.classList.remove('active'));
  btn.classList.add('active');
  document.querySelectorAll('.ec-card').forEach(card => {
    card.style.display = (city === 'all' || card.dataset.city === city) ? 'block' : 'none';
  });
}
function searchEC(val) {
  const q = val.toLowerCase();
  document.querySelectorAll('.ec-card').forEach(card => {
    card.style.display = card.innerText.toLowerCase().includes(q) ? 'block' : 'none';
  });
}
</script>
@endsection