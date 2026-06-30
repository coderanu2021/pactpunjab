
@extends('layouts.frontend')
@section('title') this is title @endsection
@section('content')
<style>
/* ── COMMONS ── */
.eyebrow{font-size:11px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:var(--accent);margin-bottom:10px;display:flex;align-items:center;gap:8px}
.eyebrow::before{content:'';width:22px;height:2px;background:var(--accent);border-radius:2px;display:inline-block}
.eyebrow.gold-ew{color:var(--gold);} .eyebrow.gold-ew::before{background:var(--gold)}
.eyebrow.blue-ew{color:var(--blue2);} .eyebrow.blue-ew::before{background:var(--blue2)}
.sec-title{font-size:clamp(22px,2.5vw,34px);font-weight:800;color:var(--navy);line-height:1.2;margin-bottom:14px;letter-spacing:-.5px}
.sec-title .hl{color:var(--accent)}
.sec-sub{font-size:15px;color:var(--muted);line-height:1.75;max-width:640px;margin-bottom:42px}
.sec-hrow{display:flex;align-items:flex-end;justify-content:space-between;gap:20px;flex-wrap:wrap;margin-bottom:36px}
.link-more{display:inline-flex;align-items:center;gap:7px;font-size:13px;font-weight:700;color:var(--blue2);border-bottom:2px solid var(--border);padding-bottom:3px;transition:border-color .2s,gap .2s;white-space:nowrap}
.link-more:hover{border-color:var(--blue2);gap:11px}

/* ── TAB NAV ── */
.tab-nav{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:48px;border-bottom:2px solid var(--border);padding-bottom:0}
.tab-btn{padding:11px 22px;border-radius:10px 10px 0 0;font-size:13px;font-weight:600;color:var(--muted);background:transparent;border:none;cursor:pointer;font-family:var(--font);transition:color .2s,background .2s;display:flex;align-items:center;gap:8px;border-bottom:2px solid transparent;margin-bottom:-2px}
.tab-btn i{font-size:13px}
.tab-btn:hover{color:var(--blue2);background:var(--light)}
.tab-btn.active{color:var(--blue2);background:var(--light);border-bottom:2px solid var(--blue2);font-weight:700}
.tab-panel{display:none}
.tab-panel.active{display:block}

/* ── ACTIVITIES CARDS ── */
.act-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:22px}
.act-card{background:var(--white);border:1px solid var(--border);border-radius:18px;overflow:hidden;transition:transform .25s,box-shadow .25s}
.act-card:hover{transform:translateY(-6px);box-shadow:var(--card-shadow-hover)}
.act-thumb{height:160px;display:flex;align-items:center;justify-content:center;font-size:54px;position:relative}
.act-cat{position:absolute;top:12px;left:12px;padding:4px 11px;border-radius:20px;font-size:10px;font-weight:700;letter-spacing:.8px;text-transform:uppercase;color:#fff}
.act-body{padding:22px 22px 20px}
.act-body h4{font-size:15px;font-weight:700;color:var(--navy);margin-bottom:8px;line-height:1.35}
.act-body p{font-size:13px;color:var(--muted);line-height:1.68;margin-bottom:14px}
.act-footer{display:flex;align-items:center;justify-content:space-between}
.act-tag{font-size:11px;font-weight:600;color:var(--muted);display:flex;align-items:center;gap:5px}
.act-tag i{font-size:11px;color:var(--blue2)}
.act-link{font-size:12px;font-weight:700;color:var(--blue2);display:inline-flex;align-items:center;gap:5px;transition:gap .2s}
.act-link:hover{gap:9px}

/* ── SERVICES LIST ── */
.srv-list{display:flex;flex-direction:column;gap:18px}
.srv-row{background:var(--white);border:1px solid var(--border);border-radius:16px;padding:26px 28px;display:flex;align-items:flex-start;gap:20px;transition:transform .2s,box-shadow .2s}
.srv-row:hover{transform:translateX(4px);box-shadow:var(--card-shadow)}
.srv-ico{width:52px;height:52px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:21px;flex-shrink:0}
.srv-ico.b{background:rgba(30,80,162,.09);color:var(--blue2)}
.srv-ico.r{background:rgba(224,58,18,.09);color:var(--accent)}
.srv-ico.g{background:rgba(16,140,80,.09);color:#108C50}
.srv-ico.y{background:rgba(245,166,35,.13);color:#C47D00}
.srv-ico.p{background:rgba(120,60,200,.09);color:#7C3AED}
.srv-ico.t{background:rgba(14,165,233,.1);color:#0EA5E9}
.srv-content{flex:1}
.srv-content h4{font-size:15px;font-weight:700;color:var(--navy);margin-bottom:6px}
.srv-content p{font-size:13px;color:var(--muted);line-height:1.68;margin-bottom:12px}
.srv-tags{display:flex;gap:8px;flex-wrap:wrap}
.srv-tag{background:var(--light);border:1px solid var(--border);padding:3px 10px;border-radius:20px;font-size:11px;font-weight:600;color:var(--muted)}
.srv-arrow{flex-shrink:0;width:38px;height:38px;border-radius:50%;border:1.5px solid var(--border);display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:12px;transition:all .2s;align-self:center}
.srv-row:hover .srv-arrow{background:var(--blue2);border-color:var(--blue2);color:#fff}

/* ── HIGHLIGHTS BAND ── */
.highlights-band{background:var(--navy2);border-radius:22px;padding:52px 48px;margin-bottom:80px;position:relative;overflow:hidden}
.highlights-band::after{content:'';position:absolute;width:400px;height:400px;border-radius:50%;background:radial-gradient(circle,rgba(30,80,162,.3) 0%,transparent 70%);right:-100px;top:-100px;pointer-events:none}
.highlights-band .eyebrow{color:var(--gold2)}
.highlights-band .eyebrow::before{background:var(--gold2)}
.highlights-band .sec-title{color:#fff}
.hl-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-top:36px;position:relative;z-index:1}
.hl-item{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.09);border-radius:14px;padding:24px 20px;transition:background .2s,transform .2s}
.hl-item:hover{background:rgba(255,255,255,.09);transform:translateY(-3px)}
.hl-n{font-size:34px;font-weight:900;color:var(--gold2);line-height:1}
.hl-n sup{font-size:16px}
.hl-l{font-size:11px;color:rgba(255,255,255,.45);font-weight:600;text-transform:uppercase;letter-spacing:.8px;margin-top:6px}
.hl-desc{font-size:12px;color:rgba(255,255,255,.4);margin-top:8px;line-height:1.5}

/* ── CALENDAR STRIP ── */
.calendar-section{margin-bottom:80px}
.cal-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:16px}
.cal-row{background:var(--white);border:1px solid var(--border);border-radius:14px;padding:20px 22px;display:flex;align-items:center;gap:16px;transition:box-shadow .2s,transform .2s}
.cal-row:hover{box-shadow:var(--card-shadow);transform:translateX(3px)}
.cal-date{width:52px;height:52px;border-radius:12px;background:var(--navy);display:flex;flex-direction:column;align-items:center;justify-content:center;flex-shrink:0}
.cal-date .day{font-size:18px;font-weight:900;color:var(--gold2);line-height:1}
.cal-date .mon{font-size:9px;font-weight:700;color:rgba(255,255,255,.5);text-transform:uppercase;letter-spacing:.8px;margin-top:2px}
.cal-info h5{font-size:14px;font-weight:700;color:var(--navy);margin-bottom:3px}
.cal-info p{font-size:12px;color:var(--muted)}
.cal-badge{margin-left:auto;padding:4px 10px;border-radius:20px;font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.5px;flex-shrink:0}
.cal-badge.past{background:rgba(100,116,139,.1);color:var(--muted)}
.cal-badge.upcoming{background:rgba(16,140,80,.1);color:#108C50}
.cal-badge.live{background:rgba(224,58,18,.1);color:var(--accent)}

/* ── CTA STRIP ── */
.cta-strip{background:linear-gradient(135deg,var(--accent),#8B1A06);border-radius:22px;padding:44px 48px;display:flex;align-items:center;justify-content:space-between;gap:32px;flex-wrap:wrap;position:relative;overflow:hidden}
.cta-strip::after{content:'';position:absolute;width:350px;height:350px;border-radius:50%;border:2px solid rgba(255,255,255,.06);bottom:-180px;right:-80px;pointer-events:none}
.cta-text h3{font-size:24px;font-weight:900;color:#fff;margin-bottom:8px;letter-spacing:-.3px}
.cta-text p{font-size:14px;color:rgba(255,255,255,.65);line-height:1.7;max-width:480px}
.cta-btns{display:flex;gap:12px;flex-shrink:0;flex-wrap:wrap}
.btn-w{background:#fff;color:var(--accent);padding:13px 28px;border-radius:25px;font-size:13px;font-weight:800;transition:all .25s;box-shadow:0 4px 16px rgba(0,0,0,.2);display:inline-flex;align-items:center;gap:8px;white-space:nowrap}
.btn-w:hover{transform:translateY(-2px);box-shadow:0 10px 28px rgba(0,0,0,.25)}
.btn-ghost-w{border:2px solid rgba(255,255,255,.4);color:#fff;padding:11px 24px;border-radius:25px;font-size:13px;font-weight:700;transition:all .25s;display:inline-flex;align-items:center;gap:8px;white-space:nowrap}
.btn-ghost-w:hover{border-color:#fff;background:rgba(255,255,255,.1)}

/* ── RESPONSIVE ── */
@media(max-width:1100px){
  .act-grid{grid-template-columns:1fr 1fr}
  .hl-grid{grid-template-columns:1fr 1fr}
}
@media(max-width:768px){
  .page-body{padding:48px 5%}
  .act-grid{grid-template-columns:1fr}
  .cal-grid{grid-template-columns:1fr}
  .highlights-band{padding:36px 24px}
  .hl-grid{grid-template-columns:1fr 1fr}
  .cta-strip{flex-direction:column;align-items:flex-start;padding:32px 28px}
  .tab-btn span{display:none}
}
</style>


<!-- PAGE HERO -->
<x-ui.page-hero title="Activities & Services" subtitle="About Us" description="From government advocacy and GST helpdesks to sports meets and CSR drives."
    :breadcrumbs="[
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'About Us', 'url' => '#'],
        ['label' => 'Activities & Services']
    ]"
>
    <x-slot:chips>
        <div class="hero-chip"><i class="fas fa-calendar-alt"></i>50+ Events / Year</div>
        <div class="hero-chip"><i class="fas fa-users"></i>600+ Members Served</div>
        <div class="hero-chip"><i class="fas fa-landmark"></i>Govt. Advocacy</div>
        <div class="hero-chip"><i class="fas fa-heart"></i>Active CSR</div>
    </x-slot:chips>

</x-ui.page-hero>

<!-- MAIN CONTENT -->
<div class="page-body">

  <!-- TAB NAVIGATION -->
  <div class="tab-nav">
    <button class="tab-btn active" onclick="switchTab('activities',this)">
      <i class="fas fa-calendar-alt"></i><span>Activities</span>
    </button>
    <button class="tab-btn" onclick="switchTab('services',this)">
      <i class="fas fa-concierge-bell"></i><span>Member Services</span>
    </button>
    <button class="tab-btn" onclick="switchTab('calendar',this)">
      <i class="fas fa-calendar-check"></i><span>Event Calendar</span>
    </button>
  </div>

  <!-- ══ TAB: ACTIVITIES ══ -->
  <div class="tab-panel active" id="tab-activities">
    <div class="section-block">
      <div class="sec-hrow">
        <div>
          <div class="eyebrow">What We Do</div>
          <h2 class="sec-title">Our Core <span class="hl">Activities</span></h2>
        </div>
        <a href="events.html" class="link-more">View All Events <i class="fas fa-arrow-right" style="font-size:11px"></i></a>
      </div>

      <div class="act-grid">
        @forelse($services->where('category', 'Activity') as $service)
        <div class="act-card">
          <div class="act-thumb" style="background:linear-gradient(135deg,#1A1442,#3B1FA8)">
            <i class="{{ $service->icon_class ?? 'fas fa-star' }}" style="color:#fff"></i>
            <span class="act-cat" style="background:#6D28D9">{{ $service->category }}</span>
          </div>
          <div class="act-body">
            <h4>{{ $service->title }}</h4>
            <p>{{ $service->description }}</p>
            <div class="act-footer">
              <span class="act-tag"><i class="fas fa-calendar"></i> Regular</span>
              <a href="#" class="act-link">Explore <i class="fas fa-arrow-right" style="font-size:10px"></i></a>
            </div>
          </div>
        </div>
        @empty
        <div style="grid-column:1/-1;text-align:center;padding:40px;color:var(--muted)">No activities found. Please add them from the Admin Panel CMS.</div>
        @endforelse
      </div>
    </div>
  </div>

  <!-- ══ TAB: SERVICES ══ -->
  <div class="tab-panel" id="tab-services">
    <div class="section-block">
      <div class="sec-hrow">
        <div>
          <div class="eyebrow">Member Benefits</div>
          <h2 class="sec-title">Services Available to <span class="hl">All Members</span></h2>
        </div>
      </div>

      <div class="srv-list">
        @forelse($services->where('category', 'Service') as $service)
        <a href="#" class="srv-row">
          <div class="srv-ico {{ ['b', 'r', 'g', 'y', 'p', 't'][array_rand(['b', 'r', 'g', 'y', 'p', 't'])] }}">
            <i class="{{ $service->icon_class ?? 'fas fa-star' }}"></i>
          </div>
          <div class="srv-content">
            <h4>{{ $service->title }}</h4>
            <p>{{ $service->description }}</p>
            <div class="srv-tags">
              <span class="srv-tag">PACT Service</span>
            </div>
          </div>
          <div class="srv-arrow"><i class="fas fa-arrow-right"></i></div>
        </a>
        @empty
        <div style="text-align:center;padding:40px;color:var(--muted)">No services found. Please add them from the Admin Panel CMS.</div>
        @endforelse
      </div>
    </div>
  </div>

  <!-- ══ TAB: CALENDAR ══ -->
  <div class="tab-panel" id="tab-calendar">
    <div class="section-block">
      <div class="sec-hrow">
        <div>
          <div class="eyebrow">Upcoming & Recent</div>
          <h2 class="sec-title">Event <span class="hl">Calendar 2025–26</span></h2>
        </div>
        <a href="events.html" class="link-more">Full Events Page <i class="fas fa-arrow-right" style="font-size:11px"></i></a>
      </div>

      <div class="cal-grid">
        <div class="cal-row">
          <div class="cal-date"><div class="day">22</div><div class="mon">Feb</div></div>
          <div class="cal-info">
            <h5>Compass Premier League — Cricket 2026</h5>
            <p>Annual cricket tournament for PACT members &amp; affiliates</p>
          </div>
          <span class="cal-badge past">Past</span>
        </div>
        <div class="cal-row">
          <div class="cal-date"><div class="day">25</div><div class="mon">Nov</div></div>
          <div class="cal-info">
            <h5>Ideal Insurance Brokers — Industry Workshop</h5>
            <p>Seminar on risk management &amp; business insurance for IT traders</p>
          </div>
          <span class="cal-badge past">Past</span>
        </div>
        <div class="cal-row">
          <div class="cal-date"><div class="day">16</div><div class="mon">Nov</div></div>
          <div class="cal-info">
            <h5>Free Eye Operation — Community Health Camp</h5>
            <p>CSR health initiative — free eye check-up and operations</p>
          </div>
          <span class="cal-badge past">Past</span>
        </div>
        <div class="cal-row">
          <div class="cal-date"><div class="day">26</div><div class="mon">Oct</div></div>
          <div class="cal-info">
            <h5>Diwali Milan 2025 — Fellowship Celebration</h5>
            <p>Annual festive fellowship meet for all PACT members &amp; families</p>
          </div>
          <span class="cal-badge past">Past</span>
        </div>
        <div class="cal-row">
          <div class="cal-date" style="background:var(--accent)"><div class="day">TBA</div><div class="mon">2025</div></div>
          <div class="cal-info">
            <h5>PACT Annual Meet 2025 — Punjab IT Mahakumbh</h5>
            <p>Flagship annual event — registration open now</p>
          </div>
          <span class="cal-badge live">Open</span>
        </div>
        <div class="cal-row">
          <div class="cal-date" style="background:var(--blue)"><div class="day">TBA</div><div class="mon">2026</div></div>
          <div class="cal-info">
            <h5>GST Compliance Seminar 2026</h5>
            <p>Annual GST update workshop — date to be announced</p>
          </div>
          <span class="cal-badge upcoming">Upcoming</span>
        </div>
      </div>
    </div>
  </div>

  <!-- HIGHLIGHTS BAND (always visible) -->
  <div class="highlights-band">
    <div class="eyebrow">Our Impact in Numbers</div>
    <h2 class="sec-title" style="color:#fff">Activities That <span style="color:var(--gold2)">Make a Difference</span></h2>
    <div class="hl-grid">
      <div class="hl-item">
        <div class="hl-n">50<sup>+</sup></div>
        <div class="hl-l">Events Per Year</div>
        <div class="hl-desc">Seminars, sports meets, fellowship events, CSR camps, and more.</div>
      </div>
      <div class="hl-item">
        <div class="hl-n">6<sup>+</sup></div>
        <div class="hl-l">Member Services</div>
        <div class="hl-desc">From GST helpdesks to grievance cells — comprehensive member support.</div>
      </div>
      <div class="hl-item">
        <div class="hl-n">600<sup>+</sup></div>
        <div class="hl-l">Members Served</div>
        <div class="hl-desc">Every activity and service is designed to benefit our entire membership.</div>
      </div>
      <div class="hl-item">
        <div class="hl-n">29<sup>yr</sup></div>
        <div class="hl-l">Of Continuous Service</div>
        <div class="hl-desc">Nearly three decades of uninterrupted activities and advocacy.</div>
      </div>
    </div>
  </div>

  <!-- CTA STRIP -->
  <div class="cta-strip">
    <div class="cta-text">
      <h3>Access All Activities & Services</h3>
      <p>Membership unlocks every service, every event, and the full 600+ member directory. One annual fee — unlimited access to Punjab & Chandigarh's most active IT trade community.</p>
    </div>
    <div class="cta-btns">
      <a href="become-member.html" class="btn-w"><i class="fas fa-user-plus"></i> Join P A C T</a>
      <a href="notifications.html" class="btn-ghost-w"><i class="fas fa-bell"></i> View Circulars</a>
    </div>
  </div>

</div><!-- /page-body -->
@endsection