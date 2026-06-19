@extends('layouts.frontend')
@section('title') Events – P A C T Punjab & Chandigarh @endsection

@section('content')
<style>
/* ── FEATURED EVENT ── */
.feat-event{
  background:linear-gradient(135deg,var(--navy2),var(--navy));
  border-radius:22px;padding:48px;margin-bottom:80px;
  display:grid;grid-template-columns:1fr auto;gap:48px;align-items:center;
  position:relative;overflow:hidden;border:1px solid rgba(224,58,18,.2);
}
.feat-event::before{content:'🎪';position:absolute;font-size:200px;right:-20px;bottom:-30px;opacity:.05}
.feat-live-badge{display:inline-flex;align-items:center;gap:8px;
  background:rgba(224,58,18,.2);border:1px solid rgba(224,58,18,.4);
  padding:6px 14px;border-radius:20px;margin-bottom:16px}
.feat-live-badge span{font-size:11px;font-weight:700;color:var(--accent2);letter-spacing:1.5px;text-transform:uppercase}
.feat-live-dot{width:8px;height:8px;border-radius:50%;background:var(--accent2);animation:pulse 2s ease-in-out infinite}
@keyframes pulse{0%,100%{opacity:1}50%{opacity:.3}}
.feat-event h2{font-size:clamp(20px,2.8vw,34px);font-weight:900;color:#fff;margin-bottom:10px;letter-spacing:-.5px;line-height:1.2}
.feat-event p{font-size:14px;color:rgba(255,255,255,.55);line-height:1.75;max-width:520px;margin-bottom:24px}
.feat-meta{display:flex;gap:20px;flex-wrap:wrap;margin-bottom:24px}
.feat-meta-item{display:flex;align-items:center;gap:7px;font-size:12px;color:rgba(255,255,255,.5)}
.feat-meta-item i{font-size:11px;color:var(--gold2)}
.feat-meta-item strong{color:rgba(255,255,255,.8)}
.event-countdown{background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.12);
  border-radius:16px;padding:28px;text-align:center;flex-shrink:0;min-width:200px;position:relative;z-index:1}
.countdown-label{font-size:10px;font-weight:700;color:rgba(255,255,255,.4);text-transform:uppercase;letter-spacing:1.5px;margin-bottom:14px}
.countdown-nums{display:flex;gap:10px;justify-content:center}
.cd-block{text-align:center}
.cd-num{font-size:28px;font-weight:900;color:var(--gold2);line-height:1;display:block}
.cd-unit{font-size:9px;color:rgba(255,255,255,.35);font-weight:600;text-transform:uppercase;letter-spacing:.8px;margin-top:3px}
.cd-sep{font-size:24px;font-weight:900;color:rgba(255,255,255,.2);align-self:flex-start;padding-top:2px}

/* ── FILTER PILLS ── */
.ev-filter-row{display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap;margin-bottom:32px}
.ev-pills{display:flex;gap:8px;flex-wrap:wrap}
.ev-pill{padding:8px 18px;border-radius:25px;font-size:12px;font-weight:600;
  border:1.5px solid var(--border);color:var(--muted);background:#fff;
  cursor:pointer;transition:all .18s;font-family:var(--font);display:flex;align-items:center;gap:6px}
.ev-pill:hover{border-color:var(--blue2);color:var(--blue2)}
.ev-pill.active{background:var(--navy);border-color:var(--navy);color:var(--gold2)}

/* ── EVENT CARDS ── */
.events-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin-bottom:80px}
.ev-card{background:#fff;border:1px solid var(--border);border-radius:20px;overflow:hidden;transition:transform .25s,box-shadow .25s}
.ev-card:hover{transform:translateY(-7px);box-shadow:var(--card-shadow-hover)}
.ev-thumb{height:180px;display:flex;align-items:center;justify-content:center;font-size:60px;position:relative;overflow:hidden}
.ev-status-badge{position:absolute;top:12px;right:12px;padding:4px 12px;border-radius:20px;font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.5px}
.ev-cat-pill{position:absolute;top:12px;left:12px;padding:4px 11px;border-radius:20px;font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.8px;color:#fff}
.ev-body{padding:22px 22px 20px}
.ev-date-row{display:flex;align-items:center;gap:8px;margin-bottom:10px}
.ev-date-badge{background:var(--navy);color:var(--gold2);border-radius:8px;padding:6px 10px;text-align:center;flex-shrink:0}
.ev-date-badge .day{font-size:18px;font-weight:900;line-height:1}
.ev-date-badge .mon{font-size:9px;font-weight:700;text-transform:uppercase;letter-spacing:.5px;opacity:.7}
.ev-date-info{font-size:11px;color:var(--muted);font-weight:500}
.ev-title{font-size:15px;font-weight:800;color:var(--navy);margin-bottom:8px;line-height:1.4}
.ev-desc{font-size:12px;color:var(--muted);line-height:1.65;margin-bottom:14px}
.ev-footer{display:flex;align-items:center;justify-content:space-between;padding-top:12px;border-top:1px solid var(--border)}
.ev-location{font-size:11px;color:var(--muted);display:flex;align-items:center;gap:5px;font-weight:600}
.ev-location i{font-size:10px;color:var(--blue2)}
.ev-reg-btn{padding:7px 16px;border-radius:20px;font-size:11px;font-weight:700;
  background:var(--navy);color:var(--gold2);border:none;cursor:pointer;font-family:var(--font);transition:all .2s}
.ev-reg-btn:hover{background:var(--blue2);color:#fff}
.ev-reg-btn.past{background:var(--light);color:var(--muted);cursor:default}

/* ── TIMELINE ── */
.ev-timeline-section{margin-bottom:80px}
.ev-tl-item{display:flex;gap:24px;margin-bottom:32px;position:relative}
.ev-tl-item:not(:last-child)::after{content:'';position:absolute;left:35px;top:72px;bottom:-32px;width:2px;background:var(--border)}
.ev-tl-date{width:72px;flex-shrink:0;text-align:center}
.ev-tl-date-box{background:var(--navy);border-radius:12px;padding:10px 8px;margin-bottom:8px}
.ev-tl-date-box .day{font-size:22px;font-weight:900;color:var(--gold2);line-height:1}
.ev-tl-date-box .mon{font-size:9px;font-weight:700;color:rgba(255,255,255,.5);text-transform:uppercase}
.ev-tl-year{font-size:10px;color:var(--muted);font-weight:600}
.ev-tl-card{flex:1;background:#fff;border:1px solid var(--border);border-radius:14px;padding:18px 20px;transition:box-shadow .2s}
.ev-tl-card:hover{box-shadow:var(--card-shadow)}
.ev-tl-card h5{font-size:14px;font-weight:700;color:var(--navy);margin-bottom:4px}
.ev-tl-card p{font-size:12px;color:var(--muted);line-height:1.6;margin-bottom:10px}
.ev-tl-tags{display:flex;gap:7px;flex-wrap:wrap}
.ev-tl-tag{padding:3px 9px;border-radius:20px;font-size:10px;font-weight:600;background:var(--light);border:1px solid var(--border);color:var(--muted)}

@media(max-width:1100px){.events-grid{grid-template-columns:1fr 1fr}.feat-event{grid-template-columns:1fr}.event-countdown{display:none}}
@media(max-width:700px){.events-grid{grid-template-columns:1fr}}
</style>

<div class="page-hero">
  <div class="hero-glow"></div><div class="hero-glow2"></div>
  <div class="page-hero-inner">
    <div class="breadcrumb">
      <a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a><i class="fas fa-chevron-right"></i>
      <a href="#">Activities</a><i class="fas fa-chevron-right"></i>
      <span class="active">Events</span>
    </div>
    <div class="page-hero-tag"><span>Activities</span></div>
    <h1>PACT <span>Events</span></h1>
    <p>From the flagship Annual Meet to sports tournaments, fellowship gatherings, and CSR drives — 50+ events every year connecting Punjab & Chandigarh's IT community.</p>
    <div class="hero-chips">
      <div class="hero-chip"><i class="fas fa-calendar-alt"></i> 50+ Events/Year</div>
      <div class="hero-chip"><i class="fas fa-fire"></i> Registration Open</div>
      <div class="hero-chip"><i class="fas fa-map-marker-alt"></i> Punjab & Chandigarh</div>
    </div>
  </div>
</div>

<div class="page-body">

  @if($events->count() > 0)
    <!-- FEATURED UPCOMING EVENT (LATEST ACTIVE) -->
    <div class="feat-event">
      <div>
        <div class="feat-live-badge"><span class="feat-live-dot"></span><span>{{ $events->first()->status }}</span></div>
        <h2>{{ $events->first()->name }}</h2>
        <p>Join PACT IT traders, industry leaders, and government officials for this event.</p>
        <div class="feat-meta">
          <div class="feat-meta-item"><i class="fas fa-calendar"></i><span>Date: <strong>{{ \Carbon\Carbon::parse($events->first()->event_date)->format('d M Y') }}</strong></span></div>
          <div class="feat-meta-item"><i class="fas fa-map-marker-alt"></i><span>Venue: <strong>{{ $events->first()->location }}</strong></span></div>
        </div>
        <div class="btn-group">
          <a href="#" class="btn-primary"><i class="fas fa-ticket-alt"></i> Register Now</a>
          <a href="#" class="btn-ghost-dark"><i class="fas fa-info-circle"></i> More Details</a>
        </div>
      </div>
      <div class="event-countdown">
        <div class="countdown-label">Countdown</div>
        <div class="countdown-nums">
          <div class="cd-block"><span class="cd-num" id="cdDays">—</span><div class="cd-unit">Days</div></div>
          <div class="cd-sep">:</div>
          <div class="cd-block"><span class="cd-num" id="cdHrs">—</span><div class="cd-unit">Hrs</div></div>
          <div class="cd-sep">:</div>
          <div class="cd-block"><span class="cd-num" id="cdMins">—</span><div class="cd-unit">Mins</div></div>
        </div>
        <div style="margin-top:16px;font-size:11px;color:rgba(255,255,255,.3)">{{ \Carbon\Carbon::parse($events->first()->event_date)->format('d M Y') }}</div>
      </div>
    </div>
  @endif

  <!-- FILTERS -->
  <div class="ev-filter-row">
    <div class="ev-pills">
      <div class="ev-pill active" onclick="filterEv(this,'all')">All Events</div>
      @php
        $cats = $events->pluck('category')->filter()->unique();
      @endphp
      @foreach($cats as $cat)
      @php $catSlug = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $cat)); @endphp
      <div class="ev-pill" onclick="filterEv(this,'{{ $catSlug }}')">{{ $cat }}</div>
      @endforeach
    </div>
    <div class="search-bar" style="max-width:240px">
      <input type="text" placeholder="Search events…"><button><i class="fas fa-search"></i></button>
    </div>
  </div>

  <!-- EVENTS GRID -->
  <div class="events-grid" id="evGrid">
    @forelse($events as $event)
      @php $catSlug = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $event->category ?? 'other')); @endphp
      <div class="ev-card" data-cat="{{ $catSlug }}">
        <div class="ev-thumb" style="background:linear-gradient(135deg,#0C2F5E,#1E50A2)">📅
          <span class="ev-cat-pill" style="background:var(--blue2)">{{ $event->category ?? 'Event' }}</span>
          <span class="ev-status-badge" style="background:rgba(224,58,18,.9);color:#fff">{{ $event->status }}</span>
        </div>
        <div class="ev-body">
          <div class="ev-date-row">
            <div class="ev-date-badge">
              <div class="day">{{ \Carbon\Carbon::parse($event->event_date)->format('d') }}</div>
              <div class="mon">{{ \Carbon\Carbon::parse($event->event_date)->format('M') }}</div>
            </div>
            <div class="ev-date-info">{{ \Carbon\Carbon::parse($event->event_date)->format('F Y') }} · {{ $event->location }}</div>
          </div>
          <div class="ev-title">{{ $event->name }}</div>
          <div class="ev-desc">{{ $event->description ?? 'PACT Event: '.$event->name.' scheduled for '.\Carbon\Carbon::parse($event->event_date)->format('d M Y').'.' }}</div>
          <div class="ev-footer">
            <span class="ev-location"><i class="fas fa-map-marker-alt"></i> {{ $event->location }}</span>
            <button class="ev-reg-btn">Register →</button>
          </div>
        </div>
      </div>
    @empty
      <p>No upcoming events currently scheduled.</p>
    @endforelse
  </div>

  <!-- CTA -->
  <div class="cta-band-red">
    <div class="cta-band-text">
      <h3>Don't Miss the Next PACT Event</h3>
      <p>Subscribe for event notifications and be the first to register for PACT's upcoming activities across Punjab & Chandigarh.</p>
    </div>
    <div class="cta-band-btns">
      <a href="{{ route('become-member') }}" class="btn-white"><i class="fas fa-user-plus"></i> Join PACT</a>
      <a href="{{ route('gallery') }}" class="btn-ghost-dark"><i class="fas fa-images"></i> Photo Gallery</a>
    </div>
  </div>

</div>

<script>
function filterEv(btn, cat) {
  document.querySelectorAll('.ev-pill').forEach(p => p.classList.remove('active'));
  btn.classList.add('active');
  document.querySelectorAll('.ev-card').forEach(c => {
    c.style.display = (cat === 'all' || c.dataset.cat === cat) ? '' : 'none';
  });
}
</script>
@endsection
