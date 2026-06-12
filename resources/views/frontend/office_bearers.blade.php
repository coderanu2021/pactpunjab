
@extends('layouts.frontend')
@section('title')
Office Bearers – P A C T Punjab & Chandigarh
@endsection

@section('content')
<style>
/* ── PRESIDENT SPOTLIGHT ── */
.president-spotlight{
  background:linear-gradient(135deg,var(--navy2),var(--navy));
  border-radius:22px;padding:52px;margin-bottom:80px;
  display:grid;grid-template-columns:auto 1fr;gap:48px;align-items:center;
  position:relative;overflow:hidden;border:1px solid rgba(245,166,35,.15);
}
.president-spotlight::before{content:'';position:absolute;width:500px;height:500px;border-radius:50%;background:radial-gradient(circle,rgba(245,166,35,.08) 0%,transparent 70%);right:-100px;top:-100px;pointer-events:none}
.pres-avatar-big{
  width:160px;height:160px;border-radius:24px;
  background:linear-gradient(140deg,var(--gold),#C47D00);
  display:flex;align-items:center;justify-content:center;
  font-size:52px;font-weight:900;color:var(--navy);
  font-family:var(--font);flex-shrink:0;position:relative;z-index:1;
  box-shadow:0 0 0 8px rgba(245,166,35,.12),0 20px 60px rgba(0,0,0,.3);
}
.pres-spotlight-badge{display:inline-flex;align-items:center;gap:8px;background:rgba(245,166,35,.15);border:1px solid rgba(245,166,35,.3);padding:6px 14px;border-radius:20px;margin-bottom:16px}
.pres-spotlight-badge span{font-size:11px;font-weight:700;color:var(--gold2);letter-spacing:1.5px;text-transform:uppercase}
.president-spotlight h2{font-size:clamp(22px,2.8vw,36px);font-weight:900;color:#fff;margin-bottom:4px;letter-spacing:-.5px}
.president-spotlight .pres-from{font-size:14px;color:rgba(255,255,255,.5);margin-bottom:20px;font-weight:500}
.president-spotlight blockquote{font-size:14px;color:rgba(255,255,255,.65);line-height:1.8;font-style:italic;border-left:3px solid var(--gold2);padding-left:18px;margin-bottom:24px;position:relative;z-index:1}
.pres-social{display:flex;gap:10px}
.psoc{width:36px;height:36px;border-radius:9px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.5);font-size:14px;transition:all .2s;cursor:pointer}
.psoc:hover{background:var(--gold);color:var(--navy);border-color:var(--gold)}

/* ── BEARER CARDS ── */
.bearers-section{margin-bottom:80px}
.bearers-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:22px}
.bearer-card{
  background:#fff;border:1px solid var(--border);border-radius:20px;
  padding:28px 20px;text-align:center;
  transition:transform .25s,box-shadow .25s;position:relative;overflow:hidden;
}
.bearer-card:hover{transform:translateY(-6px);box-shadow:var(--card-shadow-hover)}
.bearer-card::before{content:attr(data-pos);position:absolute;top:-8px;right:10px;font-size:55px;font-weight:900;color:rgba(7,17,31,.04);line-height:1}
.bearer-avatar{
  width:76px;height:76px;border-radius:18px;
  display:flex;align-items:center;justify-content:center;
  font-size:22px;font-weight:900;color:#fff;margin:0 auto 16px;
  font-family:var(--font);
}
.bearer-card h4{font-size:15px;font-weight:800;color:var(--navy);margin-bottom:3px}
.bearer-card .bearer-city{font-size:12px;color:var(--muted);margin-bottom:12px;display:flex;align-items:center;justify-content:center;gap:5px}
.bearer-card .bearer-city i{font-size:10px;color:var(--blue2)}
.bearer-role{display:inline-block;padding:5px 14px;border-radius:20px;font-size:11px;font-weight:700;margin-bottom:14px}
.bearer-card p{font-size:12px;color:var(--muted);line-height:1.6}
.bearer-contact{display:flex;gap:8px;justify-content:center;margin-top:14px}
.bcon{width:32px;height:32px;border-radius:8px;border:1.5px solid var(--border);display:flex;align-items:center;justify-content:center;font-size:12px;color:var(--muted);transition:all .2s;cursor:pointer}
.bcon:hover{border-color:var(--blue2);color:var(--blue2);background:rgba(30,80,162,.05)}

/* ── ELECTED TERM BAND ── */
.term-band{
  background:var(--light);border-radius:22px;padding:40px 44px;
  margin-bottom:80px;display:flex;align-items:center;justify-content:space-between;gap:32px;flex-wrap:wrap;
}
.term-info h3{font-size:20px;font-weight:800;color:var(--navy);margin-bottom:6px}
.term-info p{font-size:14px;color:var(--muted);max-width:480px;line-height:1.7}
.term-stats{display:flex;gap:28px;flex-wrap:wrap}
.term-stat{text-align:center}
.term-stat .n{font-size:28px;font-weight:900;color:var(--blue2);line-height:1}
.term-stat .l{font-size:11px;color:var(--muted);font-weight:600;text-transform:uppercase;letter-spacing:.8px;margin-top:4px}

/* ── RESPONSIBILITIES GRID ── */
.resp-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:18px;margin-bottom:80px}
.resp-card{background:#fff;border:1px solid var(--border);border-radius:16px;padding:24px 20px;transition:transform .2s,box-shadow .2s}
.resp-card:hover{transform:translateY(-4px);box-shadow:var(--card-shadow)}
.resp-card .resp-ico{width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:18px;margin-bottom:14px}
.resp-card h5{font-size:14px;font-weight:700;color:var(--navy);margin-bottom:6px}
.resp-card p{font-size:12px;color:var(--muted);line-height:1.65}

@media(max-width:1100px){
  .bearers-grid{grid-template-columns:1fr 1fr}
  .president-spotlight{grid-template-columns:1fr;text-align:center}
  .pres-avatar-big{margin:0 auto}
  .president-spotlight blockquote{text-align:left}
  .pres-social{justify-content:center}
  .resp-grid{grid-template-columns:1fr 1fr}
}
@media(max-width:700px){
  .bearers-grid{grid-template-columns:1fr 1fr}
  .resp-grid{grid-template-columns:1fr}
  .term-band{flex-direction:column;align-items:flex-start}
  .president-spotlight{padding:32px 24px}
}
@media(max-width:480px){
  .bearers-grid{grid-template-columns:1fr}
}
</style>
<x-ui.page-hero title="Activities & Services" subtitle="Management" description="The elected leadership team steering PACT's vision, advocacy, and day-to-day 
        operations for the current term 2024–26."
    :breadcrumbs="[
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'Management', 'url' => '#'],
        ['label' => 'Office Bearers']
    ]">
    <x-slot:chips>
    <div class="hero-chip"><i class="fas fa-vote-yea"></i> Democratically Elected</div>
      <div class="hero-chip"><i class="fas fa-calendar"></i> Term 2024–26</div>
      <div class="hero-chip"><i class="fas fa-users"></i> 8 Office Bearers</div>
    </x-slot:chips>

</x-ui.page-hero>



<div class="page-body">

  <!-- PRESIDENT SPOTLIGHT -->
  <div class="president-spotlight">
    <div class="pres-avatar-big">SW</div>
    <div style="position:relative;z-index:1">
      <div class="pres-spotlight-badge"><span>⭐ President — Term 2024–26</span></div>
      <h2>Sanjeev Walia</h2>
      <div class="pres-from"><i class="fas fa-map-marker-alt" style="color:var(--gold2);margin-right:6px"></i>Chandigarh IT Association</div>
      <blockquote>I am truly grateful to all members for this honour. Together we will take P A C T to unprecedented heights — because teamwork makes the dream work, and our best chapters are still ahead. My focus will be on strengthening government advocacy, expanding member services, and making PACT the most impactful IT trade body in North India.</blockquote>
      <div class="btn-group">
        <a href="#" class="btn-gold"><i class="fas fa-envelope"></i> Message the President</a>
        <a href="#" class="btn-ghost-dark"><i class="fas fa-file-alt"></i> Full Message</a>
      </div>
      <div class="pres-social" style="margin-top:20px">
        <div class="psoc"><i class="fab fa-linkedin-in"></i></div>
        <div class="psoc"><i class="fab fa-twitter"></i></div>
        <div class="psoc"><i class="fas fa-envelope"></i></div>
        <div class="psoc"><i class="fas fa-phone"></i></div>
      </div>
    </div>
  </div>

  <!-- TERM BAND -->
  <div class="term-band">
    <div class="term-info">
      <h3>Elected Term 2024–26</h3>
      <p>The current office bearers were elected at the PACT Annual General Meeting 2024. All positions are filled through a democratic election process open to all eligible PACT members.</p>
    </div>
    <div class="term-stats">
      <div class="term-stat"><div class="n">8</div><div class="l">Office Bearers</div></div>
      <div class="term-stat"><div class="n">2</div><div class="l">Year Term</div></div>
      <div class="term-stat"><div class="n">600<sup style="font-size:14px">+</sup></div><div class="l">Votes Cast</div></div>
      <div class="term-stat"><div class="n">2026</div><div class="l">Next Election</div></div>
    </div>
  </div>

  <!-- OFFICE BEARERS GRID -->
  <div class="bearers-section">
    <div class="eyebrow">Current Team</div>
    <h2 class="sec-title" style="margin-bottom:32px">All Office <span class="hl">Bearers 2024–26</span></h2>

    <div class="bearers-grid">
      <div class="bearer-card" data-pos="01">
        <div class="bearer-avatar" style="background:linear-gradient(140deg,var(--gold),#C47D00)">SW</div>
        <h4>Sanjeev Walia</h4>
        <div class="bearer-city"><i class="fas fa-map-marker-alt"></i> Chandigarh</div>
        <div class="bearer-role" style="background:rgba(245,166,35,.12);color:#7A4A00">⭐ President</div>
        <p>Leading PACT's vision, advocacy, and external representation at state and national levels.</p>
        <div class="bearer-contact">
          <div class="bcon"><i class="fas fa-envelope"></i></div>
          <div class="bcon"><i class="fas fa-phone"></i></div>
          <div class="bcon"><i class="fab fa-linkedin-in"></i></div>
        </div>
      </div>

      <div class="bearer-card" data-pos="02">
        <div class="bearer-avatar" style="background:linear-gradient(140deg,var(--blue2),var(--navy))">VP</div>
        <h4>Rajinder Singh</h4>
        <div class="bearer-city"><i class="fas fa-map-marker-alt"></i> Ludhiana</div>
        <div class="bearer-role" style="background:rgba(30,80,162,.09);color:var(--blue2)">Vice President</div>
        <p>Supporting the President and leading the Ludhiana chapter's engagement with PACT.</p>
        <div class="bearer-contact">
          <div class="bcon"><i class="fas fa-envelope"></i></div>
          <div class="bcon"><i class="fas fa-phone"></i></div>
          <div class="bcon"><i class="fab fa-linkedin-in"></i></div>
        </div>
      </div>

      <div class="bearer-card" data-pos="03">
        <div class="bearer-avatar" style="background:linear-gradient(140deg,var(--blue2),var(--navy))">AM</div>
        <h4>Arun Mehta</h4>
        <div class="bearer-city"><i class="fas fa-map-marker-alt"></i> Amritsar</div>
        <div class="bearer-role" style="background:rgba(30,80,162,.09);color:var(--blue2)">Vice President</div>
        <p>Representing Amritsar region members and overseeing SIG coordination activities.</p>
        <div class="bearer-contact">
          <div class="bcon"><i class="fas fa-envelope"></i></div>
          <div class="bcon"><i class="fas fa-phone"></i></div>
          <div class="bcon"><i class="fab fa-linkedin-in"></i></div>
        </div>
      </div>

      <div class="bearer-card" data-pos="04">
        <div class="bearer-avatar" style="background:linear-gradient(140deg,#059669,#064E3B)">SK</div>
        <h4>Sunil Kumar</h4>
        <div class="bearer-city"><i class="fas fa-map-marker-alt"></i> Chandigarh</div>
        <div class="bearer-role" style="background:rgba(16,140,80,.09);color:#065F46">Secretary General</div>
        <p>Managing PACT's secretariat, records, communications, and member correspondence.</p>
        <div class="bearer-contact">
          <div class="bcon"><i class="fas fa-envelope"></i></div>
          <div class="bcon"><i class="fas fa-phone"></i></div>
          <div class="bcon"><i class="fab fa-linkedin-in"></i></div>
        </div>
      </div>

      <div class="bearer-card" data-pos="05">
        <div class="bearer-avatar" style="background:linear-gradient(140deg,var(--accent),#8B1A06)">PK</div>
        <h4>Pankaj Kapoor</h4>
        <div class="bearer-city"><i class="fas fa-map-marker-alt"></i> Jalandhar</div>
        <div class="bearer-role" style="background:rgba(224,58,18,.08);color:var(--accent)">Joint Secretary</div>
        <p>Assisting the Secretary General and leading the Jalandhar chapter's administrative work.</p>
        <div class="bearer-contact">
          <div class="bcon"><i class="fas fa-envelope"></i></div>
          <div class="bcon"><i class="fas fa-phone"></i></div>
          <div class="bcon"><i class="fab fa-linkedin-in"></i></div>
        </div>
      </div>

      <div class="bearer-card" data-pos="06">
        <div class="bearer-avatar" style="background:linear-gradient(140deg,#7C3AED,#2E1065)">RG</div>
        <h4>Rohit Gupta</h4>
        <div class="bearer-city"><i class="fas fa-map-marker-alt"></i> Patiala</div>
        <div class="bearer-role" style="background:rgba(124,58,237,.09);color:#7C3AED">Treasurer</div>
        <p>Overseeing PACT's finances, accounts, audits, and annual financial reporting.</p>
        <div class="bearer-contact">
          <div class="bcon"><i class="fas fa-envelope"></i></div>
          <div class="bcon"><i class="fas fa-phone"></i></div>
          <div class="bcon"><i class="fab fa-linkedin-in"></i></div>
        </div>
      </div>

      <div class="bearer-card" data-pos="07">
        <div class="bearer-avatar" style="background:linear-gradient(140deg,#0284C7,#0C4A6E)">NB</div>
        <h4>Navdeep Bhatia</h4>
        <div class="bearer-city"><i class="fas fa-map-marker-alt"></i> Mohali</div>
        <div class="bearer-role" style="background:rgba(14,165,233,.1);color:#0369A1">Joint Treasurer</div>
        <p>Supporting the Treasurer and managing Mohali chapter's financial activities.</p>
        <div class="bearer-contact">
          <div class="bcon"><i class="fas fa-envelope"></i></div>
          <div class="bcon"><i class="fas fa-phone"></i></div>
          <div class="bcon"><i class="fab fa-linkedin-in"></i></div>
        </div>
      </div>

      <div class="bearer-card" data-pos="08">
        <div class="bearer-avatar" style="background:linear-gradient(140deg,#D97706,#78350F)">PS</div>
        <h4>Priya Sharma</h4>
        <div class="bearer-city"><i class="fas fa-map-marker-alt"></i> Chandigarh</div>
        <div class="bearer-role" style="background:rgba(217,119,6,.1);color:#92400E">PRO & Media</div>
        <p>Managing PACT's public relations, media communications, and digital presence.</p>
        <div class="bearer-contact">
          <div class="bcon"><i class="fas fa-envelope"></i></div>
          <div class="bcon"><i class="fas fa-phone"></i></div>
          <div class="bcon"><i class="fab fa-linkedin-in"></i></div>
        </div>
      </div>
    </div>
  </div>

  <!-- RESPONSIBILITIES -->
  <div class="section-block">
    <div class="eyebrow">Roles & Responsibilities</div>
    <h2 class="sec-title" style="margin-bottom:32px">What Each <span class="hl">Office Bearer Does</span></h2>
    <div class="resp-grid">
      <div class="resp-card">
        <div class="resp-ico ico-box gold md"><i class="fas fa-star"></i></div>
        <h5>President</h5>
        <p>Heads the association, chairs all meetings, represents PACT at government and industry forums, and sets the strategic direction for the term.</p>
      </div>
      <div class="resp-card">
        <div class="resp-ico ico-box blue md"><i class="fas fa-user-tie"></i></div>
        <h5>Vice Presidents (2)</h5>
        <p>Support the President, lead regional chapters, deputise in the President's absence, and oversee specific portfolio areas.</p>
      </div>
      <div class="resp-card">
        <div class="resp-ico ico-box green md"><i class="fas fa-file-alt"></i></div>
        <h5>Secretary General</h5>
        <p>Manages all administrative functions, records, member communications, AGM proceedings, and official correspondence.</p>
      </div>
      <div class="resp-card">
        <div class="resp-ico ico-box red md"><i class="fas fa-pen"></i></div>
        <h5>Joint Secretary</h5>
        <p>Assists the Secretary General, coordinates sub-committee activities, and leads specific member outreach programmes.</p>
      </div>
      <div class="resp-card">
        <div class="resp-ico ico-box purple md"><i class="fas fa-rupee-sign"></i></div>
        <h5>Treasurer</h5>
        <p>Maintains PACT's accounts, manages funds, oversees the annual audit, and presents financial statements at the AGM.</p>
      </div>
      <div class="resp-card">
        <div class="resp-ico ico-box teal md"><i class="fas fa-bullhorn"></i></div>
        <h5>PRO & Media</h5>
        <p>Manages press releases, media relations, social media, website content, and PACT's public communications strategy.</p>
      </div>
    </div>
  </div>

  <!-- CTA -->
  <div class="cta-band-navy">
    <div class="cta-band-text">
      <h3>Want to Contribute to PACT's Leadership?</h3>
      <p>Office bearer elections are held every two years and are open to all eligible PACT members. Start by becoming a member and getting involved in your local chapter.</p>
    </div>
    <div class="cta-band-btns">
      <a href="become-member.html" class="btn-gold"><i class="fas fa-user-plus"></i> Join PACT</a>
      <a href="executive-committee.html" class="btn-ghost-dark"><i class="fas fa-users"></i> Executive Committee</a>
    </div>
  </div>

</div>
@endsection