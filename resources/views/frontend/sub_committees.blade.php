
@extends('layouts.frontend')
@section('title')
Executive Committee – P A C T Punjab & Chandigarh
@endsection

@section('content')
<style>
/* ── COMMITTEE CARDS ── */
.committee-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:28px;margin-bottom:80px}
.com-card{background:#fff;border:1px solid var(--border);border-radius:22px;overflow:hidden;transition:transform .25s,box-shadow .25s}
.com-card:hover{transform:translateY(-5px);box-shadow:var(--card-shadow-hover)}
.com-card-header{padding:28px 30px;position:relative;overflow:hidden}
.com-card-header::after{content:attr(data-abbr);position:absolute;font-size:80px;font-weight:900;right:-8px;bottom:-16px;opacity:.1;color:#fff;letter-spacing:-2px;line-height:1;pointer-events:none}
.com-header-top{display:flex;align-items:center;gap:14px;margin-bottom:14px}
.com-ico{width:52px;height:52px;border-radius:14px;background:rgba(255,255,255,.15);display:flex;align-items:center;justify-content:center;font-size:22px;flex-shrink:0}
.com-card-header h3{font-size:18px;font-weight:800;color:#fff;line-height:1.25;position:relative;z-index:1}
.com-card-header p{font-size:13px;color:rgba(255,255,255,.6);line-height:1.6;position:relative;z-index:1}
.com-chair-row{display:flex;align-items:center;gap:10px;margin-top:16px;padding-top:14px;border-top:1px solid rgba(255,255,255,.12);position:relative;z-index:1}
.com-chair-avatar{width:36px;height:36px;border-radius:9px;background:rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:800;color:#fff;font-family:var(--font);flex-shrink:0}
.com-chair-info strong{display:block;font-size:12px;font-weight:700;color:#fff}
.com-chair-info span{font-size:11px;color:rgba(255,255,255,.5)}
.com-card-body{padding:24px 30px}
.com-mandate-title{font-size:11px;font-weight:800;color:var(--navy);text-transform:uppercase;letter-spacing:1.2px;margin-bottom:12px;display:flex;align-items:center;gap:7px}
.com-mandate-title i{font-size:11px;color:var(--blue2)}
.com-mandate-list{display:flex;flex-direction:column;gap:8px;margin-bottom:18px}
.com-mandate-item{display:flex;align-items:flex-start;gap:9px;font-size:12px;color:var(--muted);line-height:1.5}
.com-mandate-item i{font-size:10px;color:var(--blue2);flex-shrink:0;margin-top:3px}
.com-members-row{display:flex;align-items:center;justify-content:space-between;border-top:1px solid var(--border);padding-top:14px}
.com-members-row span{font-size:12px;color:var(--muted);font-weight:600;display:flex;align-items:center;gap:5px}
.com-members-row span i{font-size:11px;color:var(--blue2)}
.com-members-row a{font-size:12px;font-weight:700;color:var(--blue2);display:flex;align-items:center;gap:5px;transition:gap .2s}
.com-members-row a:hover{gap:9px}

/* ── HOW COMMITTEES WORK ── */
.how-band{background:var(--light);border-radius:22px;padding:48px;margin-bottom:80px}
.how-steps-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;margin-top:32px}
.how-step{background:#fff;border:1px solid var(--border);border-radius:14px;padding:22px 18px;text-align:center;position:relative}
.how-step-n{width:36px;height:36px;border-radius:50%;background:var(--navy);color:var(--gold2);font-size:14px;font-weight:900;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;font-family:var(--font)}
.how-step h5{font-size:13px;font-weight:700;color:var(--navy);margin-bottom:6px}
.how-step p{font-size:12px;color:var(--muted);line-height:1.6}

/* ── MEETINGS CALENDAR ── */
.meetings-section{margin-bottom:80px}
.meetings-list{display:flex;flex-direction:column;gap:12px}
.meeting-row{background:#fff;border:1px solid var(--border);border-radius:14px;padding:18px 22px;display:flex;align-items:center;gap:16px;transition:box-shadow .2s,transform .2s}
.meeting-row:hover{box-shadow:var(--card-shadow);transform:translateX(3px)}
.meeting-date-box{width:52px;height:52px;border-radius:12px;background:var(--navy);display:flex;flex-direction:column;align-items:center;justify-content:center;flex-shrink:0}
.meeting-date-box .mday{font-size:18px;font-weight:900;color:var(--gold2);line-height:1}
.meeting-date-box .mmon{font-size:9px;font-weight:700;color:rgba(255,255,255,.5);text-transform:uppercase;letter-spacing:.8px;margin-top:2px}
.meeting-info{flex:1}
.meeting-info h5{font-size:14px;font-weight:700;color:var(--navy);margin-bottom:3px}
.meeting-info p{font-size:12px;color:var(--muted)}
.meeting-badge{padding:4px 12px;border-radius:20px;font-size:11px;font-weight:700;flex-shrink:0}

@media(max-width:1100px){
  .committee-grid{grid-template-columns:1fr}
  .how-steps-grid{grid-template-columns:1fr 1fr}
}
@media(max-width:700px){
  .how-steps-grid{grid-template-columns:1fr 1fr}
  .how-band{padding:32px 24px}
}
</style>


<x-ui.page-hero title="Sub Committees" subtitle="Management" description="Six specialised sub-committees that execute PACT's work across key areas — from GST compliance 
        to events, CSR, and grievance resolution."
    :breadcrumbs="[
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'Management', 'url' => '#'],
        ['label' => 'Sub Committees']
    ]">
    <x-slot:chips>
   <div class="hero-chip"><i class="fas fa-sitemap"></i> 6 Sub-Committees</div>
      <div class="hero-chip"><i class="fas fa-users"></i> 40+ Members</div>
      <div class="hero-chip"><i class="fas fa-calendar"></i> Quarterly Meetings</div>
    </x-slot:chips>

</x-ui.page-hero>

<div class="page-body">

  <div class="eyebrow">Our Committees</div>
  <h2 class="sec-title" style="margin-bottom:10px">Six Committees That <span class="hl">Power PACT</span></h2>
  <p class="sec-sub">Each sub-committee is chaired by an EC member and comprises 5–8 PACT members who volunteer their time and expertise.</p>

  <div class="committee-grid">

    @php
        $groupedMembers = $members->groupBy('designation');
        // Define some visual styles for the committees to maintain the page structure
        $styles = [
            ['bg' => 'linear-gradient(135deg,#2E1065,#6D28D9)', 'ico' => '⚖️'],
            ['bg' => 'linear-gradient(135deg,#0C2F5E,#1E50A2)', 'ico' => '🎪'],
            ['bg' => 'linear-gradient(135deg,#7C1D1D,#DC2626)', 'ico' => '⚡'],
            ['bg' => 'linear-gradient(135deg,#064E3B,#059669)', 'ico' => '❤️'],
            ['bg' => 'linear-gradient(135deg,#78350F,#D97706)', 'ico' => '🤝'],
            ['bg' => 'linear-gradient(135deg,#0C4A6E,#0284C7)', 'ico' => '🏏'],
        ];
        $styleIndex = 0;
    @endphp

    @forelse($groupedMembers as $committeeName => $group)
    @php
        $style = $styles[$styleIndex % count($styles)];
        $styleIndex++;
        $chair = $group->first(); // Assuming first is chair or we just pick the first
    @endphp
    <div class="com-card">
      <div class="com-card-header" style="background:{{ $style['bg'] }}" data-abbr="{{ strtoupper(substr(str_replace(['Committee', ' '], '', $committeeName ?? 'COM'), 0, 3)) }}">
        <div class="com-header-top">
          <div class="com-ico">{{ $style['ico'] }}</div>
          <h3>{{ $committeeName ?: 'General Sub Committee' }}</h3>
        </div>
        <p>A dedicated sub-committee of PACT focusing on specific core areas of our mandate.</p>
        
        @if($chair)
        <div class="com-chair-row">
          <div class="com-chair-avatar">{{ strtoupper(substr($chair->name, 0, 2)) }}</div>
          <div class="com-chair-info"><strong>{{ $chair->name }}</strong><span>Chairperson</span></div>
        </div>
        @endif
      </div>
      <div class="com-card-body">
        <div class="com-mandate-title"><i class="fas fa-tasks"></i> Committee Mandate</div>
        <div class="com-mandate-list">
          <div class="com-mandate-item"><i class="fas fa-check-circle"></i>Executes the strategic goals and mandate assigned by the Executive Committee</div>
          <div class="com-mandate-item"><i class="fas fa-check-circle"></i>Coordinates member participation and activities in this specific domain</div>
        </div>
        <div class="com-members-row">
          <span><i class="fas fa-users"></i> {{ $group->count() }} Members</span>
          <a href="#">View Members <i class="fas fa-arrow-right" style="font-size:10px"></i></a>
        </div>
      </div>
    </div>
    @empty
    <div style="grid-column:1/-1;text-align:center;padding:40px;color:var(--muted)">No sub-committees found. Please add them from the Admin Panel CMS.</div>
    @endforelse

  </div>

  <!-- HOW COMMITTEES WORK -->
  <div class="how-band">
    <div class="eyebrow">Process</div>
    <h2 class="sec-title">How Sub-Committees <span class="hl">Operate</span></h2>
    <div class="how-steps-grid">
      <div class="how-step">
        <div class="how-step-n">1</div>
        <h5>Annual Mandate</h5>
        <p>Each committee receives its annual mandate and budget from the Executive Committee at the start of the term.</p>
      </div>
      <div class="how-step">
        <div class="how-step-n">2</div>
        <h5>Quarterly Meetings</h5>
        <p>Committees meet at least once per quarter to review progress, plan activities, and resolve operational issues.</p>
      </div>
      <div class="how-step">
        <div class="how-step-n">3</div>
        <h5>EC Reporting</h5>
        <p>Each committee submits a progress report to the Executive Committee at every EC meeting for review and guidance.</p>
      </div>
      <div class="how-step">
        <div class="how-step-n">4</div>
        <h5>Annual Review</h5>
        <p>Committee performance is reviewed at the AGM and reflected in the Annual Report for full member transparency.</p>
      </div>
    </div>
  </div>

  <!-- UPCOMING COMMITTEE MEETINGS -->
  <div class="meetings-section">
    <div class="eyebrow">Schedule</div>
    <h2 class="sec-title" style="margin-bottom:28px">Upcoming Committee <span class="hl">Meetings</span></h2>
    <div class="meetings-list">
      <div class="meeting-row">
        <div class="meeting-date-box"><div class="mday">15</div><div class="mmon">Jul</div></div>
        <div class="meeting-info"><h5>GST & Legal Committee — Q2 2025 Meeting</h5><p>Review of recent GST notifications · Helpdesk statistics · Pre-budget memorandum planning</p></div>
        <span class="meeting-badge" style="background:rgba(124,58,237,.09);color:#7C3AED">GST Committee</span>
      </div>
      <div class="meeting-row">
        <div class="meeting-date-box" style="background:var(--blue2)"><div class="mday">22</div><div class="mmon">Jul</div></div>
        <div class="meeting-info"><h5>Events Committee — Annual Meet 2025 Planning</h5><p>Venue finalisation · Speaker invitations · Registration system review</p></div>
        <span class="meeting-badge" style="background:rgba(30,80,162,.09);color:var(--blue2)">Events Committee</span>
      </div>
      <div class="meeting-row">
        <div class="meeting-date-box" style="background:var(--accent)"><div class="mday">05</div><div class="mmon">Aug</div></div>
        <div class="meeting-info"><h5>Sports Committee — CPL 2026 Pre-Planning</h5><p>Venue booking · Team registration format · Sponsorship outreach</p></div>
        <span class="meeting-badge" style="background:rgba(14,165,233,.1);color:#0369A1">Sports Committee</span>
      </div>
      <div class="meeting-row">
        <div class="meeting-date-box" style="background:#059669"><div class="mday">12</div><div class="mmon">Aug</div></div>
        <div class="meeting-info"><h5>CSR Committee — Health Camp Q3 Planning</h5><p>NGO partner review · Venue identification · Volunteer coordination</p></div>
        <span class="meeting-badge" style="background:rgba(5,150,105,.09);color:#065F46">CSR Committee</span>
      </div>
    </div>
  </div>

  <!-- CTA -->
  <div class="cta-band-red">
    <div class="cta-band-text">
      <h3>Interested in Joining a Sub-Committee?</h3>
      <p>PACT members can apply to join any sub-committee and contribute their expertise. Sub-committee participation is a great way to give back to the community and build your network.</p>
    </div>
    <div class="cta-band-btns">
      <a href="contact.html" class="btn-white"><i class="fas fa-paper-plane"></i> Express Interest</a>
      <a href="become-member.html" class="btn-ghost-dark"><i class="fas fa-user-plus"></i> Become a Member</a>
    </div>
  </div>

</div>
@endsection