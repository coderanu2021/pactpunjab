

@extends('layouts.frontend')
@section('title')
Advisory Board – P A C T Punjab & Chandigarh<
@endsection

@section('content')
<style>
/* ── ADVISORY INTRO ── */
.advisory-intro{display:grid;grid-template-columns:1.2fr .8fr;gap:56px;align-items:center;margin-bottom:80px}
.advisory-intro p{font-size:15px;color:var(--muted);line-height:1.85;margin-bottom:16px}
.advisory-intro p strong{color:var(--navy)}
.advisory-role-card{background:var(--navy);border-radius:22px;padding:32px}
.arc-label{display:inline-flex;align-items:center;gap:8px;background:rgba(245,166,35,.15);border:1px solid rgba(245,166,35,.3);padding:6px 14px;border-radius:20px;margin-bottom:18px}
.arc-label span{font-size:11px;font-weight:700;color:var(--gold2);letter-spacing:1px;text-transform:uppercase}
.arc-list{display:flex;flex-direction:column;gap:12px}
.arc-item{display:flex;align-items:flex-start;gap:11px}
.arc-item-ico{width:32px;height:32px;border-radius:8px;background:rgba(255,255,255,.07);display:flex;align-items:center;justify-content:center;font-size:13px;flex-shrink:0}
.arc-item strong{display:block;font-size:12px;font-weight:700;color:#fff;margin-bottom:2px}
.arc-item span{font-size:11px;color:rgba(255,255,255,.45);line-height:1.4}

/* ── ADVISOR CARDS ── */
.advisor-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:28px;margin-bottom:80px}
.advisor-card{background:#fff;border:1px solid var(--border);border-radius:22px;overflow:hidden;transition:transform .25s,box-shadow .25s}
.advisor-card:hover{transform:translateY(-5px);box-shadow:var(--card-shadow-hover)}
.advisor-card-top{padding:32px 28px;display:flex;gap:20px;align-items:flex-start}
.adv-avatar{width:80px;height:80px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:24px;font-weight:900;color:#fff;font-family:var(--font);flex-shrink:0}
.adv-meta{flex:1}
.adv-meta h4{font-size:17px;font-weight:800;color:var(--navy);margin-bottom:3px}
.adv-meta .adv-title{font-size:13px;color:var(--blue2);font-weight:600;margin-bottom:3px}
.adv-meta .adv-org{font-size:12px;color:var(--muted);margin-bottom:10px}
.adv-domain-tags{display:flex;flex-wrap:wrap;gap:6px}
.adv-tag{padding:3px 10px;border-radius:20px;font-size:10px;font-weight:600;background:var(--light);border:1px solid var(--border);color:var(--muted)}
.advisor-card-body{padding:0 28px 24px}
.adv-bio{font-size:13px;color:var(--muted);line-height:1.7;margin-bottom:16px}
.adv-contributions{background:var(--light);border-radius:12px;padding:16px 18px}
.adv-contributions h6{font-size:11px;font-weight:800;color:var(--navy);text-transform:uppercase;letter-spacing:1px;margin-bottom:10px;display:flex;align-items:center;gap:6px}
.adv-contributions h6 i{color:var(--blue2);font-size:11px}
.adv-contrib-list{display:flex;flex-direction:column;gap:6px}
.adv-contrib-item{font-size:12px;color:var(--muted);display:flex;align-items:flex-start;gap:7px}
.adv-contrib-item i{font-size:10px;color:var(--blue2);flex-shrink:0;margin-top:3px}

/* ── ADVISORY PROCESS ── */
.process-band{background:var(--light);border-radius:22px;padding:48px;margin-bottom:80px}
.process-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-top:32px}
.process-item{background:#fff;border:1px solid var(--border);border-radius:14px;padding:24px 20px;text-align:center}
.proc-ico{font-size:32px;margin-bottom:12px}
.process-item h5{font-size:14px;font-weight:700;color:var(--navy);margin-bottom:7px}
.process-item p{font-size:12px;color:var(--muted);line-height:1.65}

@media(max-width:1100px){
  .advisor-grid{grid-template-columns:1fr}
  .advisory-intro{grid-template-columns:1fr}
  .process-grid{grid-template-columns:1fr 1fr}
}
@media(max-width:700px){
  .process-grid{grid-template-columns:1fr}
  .process-band{padding:32px 24px}
  .advisor-card-top{flex-direction:column}
}
</style>




<!-- PAGE HERO -->
<x-ui.page-hero title="Advisory Board" subtitle="Management" description="Eminent industry veterans, policy experts, and business leaders who guide PACT's strategic direction with
         decades of collective wisdom."
    :breadcrumbs="[
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'Management', 'url' => '#'],
        ['label' => 'Advisory Board']
    ]">
    <x-slot:chips>
    <div class="hero-chip"><i class="fas fa-chalkboard-teacher"></i> 6 Advisors</div>
      <div class="hero-chip"><i class="fas fa-star"></i> Industry Veterans</div>
      <div class="hero-chip"><i class="fas fa-lightbulb"></i> Strategic Guidance</div>
    </x-slot:chips>

</x-ui.page-hero>

<div class="page-body">

  <!-- INTRO -->
  <div class="advisory-intro">
    <div>
      <div class="eyebrow">About the Advisory Board</div>
      <h2 class="sec-title">Wisdom That <span class="hl">Shapes Strategy</span></h2>
      <p>PACT's Advisory Board comprises eminent individuals — former government officials, industry captains, and domain experts — who provide strategic guidance to the Executive Committee without holding elected positions.</p>
      <p>Unlike the EC, advisory board members are <strong>appointed, not elected</strong>. They serve in a consultative capacity, offering their expertise, networks, and perspective to help PACT navigate complex challenges and pursue long-term goals.</p>
      <p>The Advisory Board meets <strong>twice a year</strong> with the President and EC to review PACT's strategy, provide sector intelligence, and offer guidance on major policy decisions.</p>
    </div>
    <div class="advisory-role-card">
      <div class="arc-label"><span>Board's Role</span></div>
      <div class="arc-list">
        <div class="arc-item">
          <div class="arc-item-ico">🎯</div>
          <div><strong>Strategic Guidance</strong><span>Long-term direction and major policy positions</span></div>
        </div>
        <div class="arc-item">
          <div class="arc-item-ico">🔗</div>
          <div><strong>Industry Connections</strong><span>Leveraging networks at national level</span></div>
        </div>
        <div class="arc-item">
          <div class="arc-item-ico">⚖️</div>
          <div><strong>Policy Review</strong><span>Expert review of PACT's submissions to government</span></div>
        </div>
        <div class="arc-item">
          <div class="arc-item-ico">📚</div>
          <div><strong>Knowledge Transfer</strong><span>Mentoring elected leaders and future generations</span></div>
        </div>
      </div>
    </div>
  </div>

  <!-- ADVISOR CARDS -->
  <div class="eyebrow">Board Members</div>
  <h2 class="sec-title" style="margin-bottom:10px">Meet the <span class="hl">Advisory Board</span></h2>
  <p class="sec-sub">Six distinguished individuals who bring national-level expertise and decades of experience to PACT's governance.</p>

  <div class="advisor-grid">

    @forelse($members as $member)
    <div class="advisor-card">
      <div class="advisor-card-top">
        <div class="adv-avatar" style="background:linear-gradient(140deg,var(--gold),#C47D00)">{{ strtoupper(substr($member->name, 0, 2)) }}</div>
        <div class="adv-meta">
          <h4>{{ $member->name }}</h4>
          <div class="adv-title">{{ $member->designation ?? $member->type }}</div>
          <div class="adv-org">Punjab</div>
          <div class="adv-domain-tags">
            <span class="adv-tag">PACT</span><span class="adv-tag">Advisor</span>
          </div>
        </div>
      </div>
      <div class="advisor-card-body">
        <div class="adv-bio">A member of the advisory board providing strategic guidance to PACT.</div>
        <div class="adv-contributions">
          <h6><i class="fas fa-star"></i> Key Contributions to PACT</h6>
          <div class="adv-contrib-list">
            <div class="adv-contrib-item"><i class="fas fa-check"></i>Advises the executive committee on policy matters</div>
          </div>
        </div>
      </div>
    </div>
    @empty
    <div style="grid-column:1/-1;text-align:center;padding:40px;color:var(--muted)">No advisory board members found. Please add them from the Admin Panel CMS.</div>
    @endforelse

  </div>

  <!-- ADVISORY PROCESS -->
  <div class="process-band">
    <div class="eyebrow">How It Works</div>
    <h2 class="sec-title">The Advisory <span class="hl">Process</span></h2>
    <div class="process-grid">
      <div class="process-item">
        <div class="proc-ico">📅</div>
        <h5>Bi-Annual Meetings</h5>
        <p>The full Advisory Board meets with the President and EC twice a year — in January and July — for strategic review sessions.</p>
      </div>
      <div class="process-item">
        <div class="proc-ico">📋</div>
        <h5>Policy Reviews</h5>
        <p>Major policy positions, government submissions, and pre-budget memoranda are circulated to advisors for review and comment before submission.</p>
      </div>
      <div class="process-item">
        <div class="proc-ico">🔗</div>
        <h5>Network Activation</h5>
        <p>When PACT needs access to specific government officials or industry bodies, advisory board members activate their networks on PACT's behalf.</p>
      </div>
    </div>
  </div>

  <!-- CTA -->
  <div class="cta-band-navy">
    <div class="cta-band-text">
      <h3>Interested in Contributing Your Expertise?</h3>
      <p>PACT periodically invites distinguished individuals to join the Advisory Board. If you have relevant expertise and a desire to contribute to Punjab's IT ecosystem, we'd love to hear from you.</p>
    </div>
    <div class="cta-band-btns">
      <a href="contact.html" class="btn-gold"><i class="fas fa-paper-plane"></i> Get in Touch</a>
      <a href="office-bearers.html" class="btn-ghost-dark"><i class="fas fa-id-badge"></i> Office Bearers</a>
    </div>
  </div>

</div>
@endsection