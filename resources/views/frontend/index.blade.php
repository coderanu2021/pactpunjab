@extends('layouts.frontend')
@section('title')  Page Title  @endsection

@section('content')
<!-- HERO -->
<section class="hero">
  <div class="hero-bg-grid"></div>
  <div class="hero-glow"></div>
  <div class="hero-glow2"></div>
  <div class="hero-inner">
    <div>
      <div class="hero-pill"><span class="dot"></span><span>{{ $settings['home_hero_pill'] ?? "Punjab & Chandigarh's Premier IT Trade Body" }}</span></div>
      <h1>{{ $settings['home_hero_title'] ?? 'Empowering' }} <span class="hl">{{ $settings['home_hero_subtitle'] ?? 'IT Traders' }}</span></h1>
      <p>{{ $settings['home_hero_desc'] ?? 'PACT Punjab connects and supports computer traders across Punjab, driving growth through association, certification, and community.' }}</p>
      <div class="hero-btns">
        <a href="{{ $settings['home_hero_cta_link'] ?? route('become-member') }}" class="btn-hero-primary"><i class="fas fa-user-plus"></i> {{ $settings['home_hero_cta_text'] ?? 'Join P A C T' }}</a>
        <a href="{{ route('events') }}" class="btn-hero-ghost"><i class="fas fa-calendar-alt"></i> Upcoming Events</a>
      </div>
      <div class="hero-kpis">
        <div class="kpi"><div class="kpi-n">{{ $settings['home_stat1_count'] ?? '600+' }}</div><div class="kpi-l">{{ $settings['home_stat1_label'] ?? 'Members' }}</div></div>
        <div class="kpi"><div class="kpi-n">{{ $settings['home_stat2_count'] ?? '28+' }}</div><div class="kpi-l">{{ $settings['home_stat2_label'] ?? 'Established' }}</div></div>
        <div class="kpi"><div class="kpi-n">{{ $settings['home_stat3_count'] ?? '50+' }}</div><div class="kpi-l">{{ $settings['home_stat3_label'] ?? 'Events' }}</div></div>
        <div class="kpi"><div class="kpi-n">11<sup>+</sup></div><div class="kpi-l">City Assocs.</div></div>
      </div>
    </div>
    @if($president)
    <div class="pres-card">
      <div class="pres-header">
        <div class="pres-avatar">{{ strtoupper(substr($president->name, 0, 2)) }}</div>
        <div class="pres-meta">
          <strong>{{ $president->name }}</strong>
          <span>{{ $president->designation }}, PACT</span>
        </div>
        <div class="pres-badge">⭐ {{ $president->designation }}</div>
      </div>
      <p class="pres-quote">I am truly grateful to all members for this honour. Together we will take P A C T to unprecedented heights — because teamwork makes the dream work, and our best chapters are still ahead.</p>
      <a href="#" class="pres-link">Read Full Message <i class="fas fa-arrow-right" style="font-size:11px"></i></a>
      <div class="event-chips">
        <span class="chip">🏏 PACT Sports Meet</span>
        <span class="chip">🎪 Annual Meet 2025</span>
        <span class="chip">📋 AGM 2025</span>
        <span class="chip">🌱 CSR Active</span>
      </div>
    </div>
    @endif
  </div>
</section>

<!-- ABOUT -->
<section class="section about">
  <div class="section-inner">
    <div class="about-grid">
      <div>
        <div class="eyebrow">Who We Are</div>
        <h2 class="sec-title">{!! $settings['home_about_title'] ?? 'The Association That Drives<br>Punjab & Chandigarh\'s <span class="hl">IT Industry</span>' !!}</h2>
        <div class="about-text">
          <p>{{ $settings['home_about_desc'] ?? 'Founded in 1996, PACT Punjab is the leading association for computer traders in Punjab, providing certification, training, and networking opportunities.' }}</p>
        </div>
        <div class="feat-list">
          <div class="feat">
            <div class="feat-ico blue"><i class="fas fa-landmark"></i></div>
            <div class="feat-body"><strong>Government Advocacy</strong><span>Direct policy lobbying with State &amp; Central Government on IT sector issues</span></div>
          </div>
          <div class="feat">
            <div class="feat-ico red"><i class="fas fa-network-wired"></i></div>
            <div class="feat-body"><strong>Industry Networking</strong><span>Connecting 600+ member businesses across the full Punjab & Chandigarh IT ecosystem</span></div>
          </div>
          <div class="feat">
            <div class="feat-ico green"><i class="fas fa-chart-line"></i></div>
            <div class="feat-body"><strong>Business Growth</strong><span>Expanding market reach, opportunities, and competitiveness for all stakeholders</span></div>
          </div>
        </div>
      </div>
      <div class="stats-mosaic">
        <div class="stat-tile">
          <div class="stat-n">{{ $settings['home_stat1_count'] ?? '600+' }}</div>
          <div class="stat-l">{{ $settings['home_stat1_label'] ?? 'Active Members' }}</div>
        </div>
        <div class="stat-tile accent">
          <div class="stat-n">{{ $settings['home_stat2_count'] ?? '28+' }}</div>
          <div class="stat-l">{{ $settings['home_stat2_label'] ?? 'Years of Legacy' }}</div>
        </div>
        <div class="stat-tile accent">
          <div class="stat-n">{{ $settings['home_stat3_count'] ?? '50+' }}</div>
          <div class="stat-l">{{ $settings['home_stat3_label'] ?? 'Events Per Year' }}</div>
        </div>
        <div class="stat-tile">
          <div class="stat-n">6<sup>+</sup></div>
          <div class="stat-l">SIG Groups</div>
        </div>
        <div class="stat-tile wide">
          <div class="wide-ico"><i class="fas fa-map-marker-alt" style="color:var(--gold2);font-size:20px"></i></div>
          <div>
            <div class="stat-n">Chandigarh / Ludhiana</div>
            <div class="stat-l">Punjab & Chandigarh Region</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- EVENTS -->
<section class="section" style="background:#fff">
  <div class="section-inner">
    <div class="sec-header">
      <div class="sec-hrow">
        <div>
          <div class="eyebrow">What's Happening</div>
          <h2 class="sec-title">Recent & Upcoming <span class="hl">Events</span></h2>
        </div>
        <a href="#" class="link-more">View All Events <i class="fas fa-arrow-right" style="font-size:11px"></i></a>
      </div>
    </div>
    <div class="events-grid">
      @forelse($events as $event)
      <div class="ev-card">
        <div class="ev-thumb" style="background:linear-gradient(135deg,#0C2F5E,#1A3C6E)">
          <i class="{{ $event->icon_class ?? 'fas fa-calendar' }}" style="color:#fff; font-size: 24px;"></i>
          <span class="ev-cat-pill" style="background:#1E50A2">{{ $event->category ?? 'Event' }}</span>
        </div>
        <div class="ev-body">
          <div class="ev-meta"><span class="ev-date"><i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</span></div>
          <div class="ev-title">{{ $event->title }}</div>
          <div class="ev-footer">
            <div class="ev-status"><span class="dot"></span>Upcoming</div>
            <div class="ev-arrow"><i class="fas fa-arrow-right"></i></div>
          </div>
        </div>
      </div>
      @empty
      <div style="grid-column:1/-1;text-align:center;padding:40px;color:var(--muted)">No upcoming events found.</div>
      @endforelse
    </div>
  </div>
</section>

<!-- SERVICES -->
<section class="section services-sec">
  <div class="section-inner">
    <div class="sec-header">
      <div class="sec-hrow">
        <div>
          <div class="eyebrow">What We Offer</div>
          <h2 class="sec-title" style="color:#fff">Member <span style="color:var(--gold2)">Services</span></h2>
          <p class="sec-sub" style="color:rgba(255,255,255,.5)">Comprehensive support for every IT entrepreneur — legal, compliance, networking, and more.</p>
        </div>
        <a href="#" class="link-more" style="color:var(--gold2);border-color:rgba(245,166,35,.3)">All Services <i class="fas fa-arrow-right" style="font-size:11px"></i></a>
      </div>
    </div>
    <div class="srv-grid">
      @forelse($services as $service)
      <a href="#" class="srv-card">
        <div class="srv-ico {{ ['b', 'r', 'g', 'y', 'p', 't'][array_rand(['b', 'r', 'g', 'y', 'p', 't'])] }}">
          <i class="{{ $service->icon_class ?? 'fas fa-star' }}"></i>
        </div>
        <h4>{{ $service->title }}</h4>
        <p>{{ Str::limit($service->description, 100) }}</p>
        <span class="srv-card-link">Explore <i class="fas fa-arrow-right" style="font-size:10px"></i></span>
      </a>
      @empty
      @endforelse
      <a href="#" class="srv-card" style="border:1px solid rgba(245,166,35,.25);background:rgba(245,166,35,.04)">
        <div class="srv-ico c"><i class="fas fa-star"></i></div>
        <h4>Become a Member</h4>
        <p>Join 600+ IT entrepreneurs. One membership unlocks all services, events, networking, and the member directory.</p>
        <span class="srv-card-link" style="color:var(--gold2)">Join Today <i class="fas fa-arrow-right" style="font-size:10px"></i></span>
      </a>
    </div>
  </div>
</section>

<!-- NOTIFICATIONS -->
<section class="section notif-sec">
  <div class="section-inner">
    <div class="sec-header">
      <div class="eyebrow">Stay Informed</div>
      <h2 class="sec-title">Notifications &amp; <span class="hl">Circulars</span></h2>
      <p class="sec-sub">The latest statutory updates and member communications, curated by P A C T.</p>
    </div>
    <div class="notif-layout">
      <div>
        <div class="notif-box" style="margin-bottom:0">
          <div class="notif-box-head">
            <h4><i class="fas fa-landmark" style="color:var(--blue2);margin-right:8px"></i>Statutory Notifications</h4>
            <span class="notif-count">GST</span>
          </div>
          <div class="notif-list">
            <div class="notif-row">
              <span class="ntag gst">17 Aug '23</span>
              <div class="ncontent">
                <div class="nref">Central Tax Notification 24/2023</div>
                <div class="ndesc">Amnesty scheme relief for taxpayers who received assessment orders under Section 62 of the CGST Act.</div>
              </div>
            </div>
            <div class="notif-row">
              <span class="ntag gst">12 Jul '23</span>
              <div class="ncontent">
                <div class="nref">50th GST Council — Press Release</div>
                <div class="ndesc">Key policy decisions from the 50th GST Council meeting affecting the IT sector.</div>
              </div>
            </div>
            <div class="notif-row">
              <span class="ntag other">6 Jul '23</span>
              <div class="ncontent">
                <div class="nref">TDS Returns Q1 2023–24</div>
                <div class="ndesc">Revised due date for Q1 TDS Returns extended through 30th September 2023.</div>
              </div>
            </div>
            <div class="notif-row">
              <span class="ntag gst">29 Jun '23</span>
              <div class="ncontent">
                <div class="nref">Return Compliance — Form DRC-01B</div>
                <div class="ndesc">Guidelines for compliance in Form DRC-01B under GST regulations.</div>
              </div>
            </div>
            <div class="notif-row">
              <span class="ntag gst">13 Jun '23</span>
              <div class="ncontent">
                <div class="nref">e-Way Bill &amp; e-Invoice 2FA</div>
                <div class="ndesc">Two-Factor Authentication becomes mandatory from 15 July 2023 for taxpayers with annual turnover above ₹100Cr.</div>
              </div>
            </div>
          </div>
        </div>
        <div style="margin-top:16px;display:flex;justify-content:flex-end">
          <a href="#" class="link-more">View All Notifications <i class="fas fa-arrow-right" style="font-size:11px"></i></a>
        </div>
        <div class="notif-box" style="margin-top:24px">
          <div class="notif-box-head">
            <h4><i class="fas fa-envelope-open-text" style="color:var(--blue2);margin-right:8px"></i>Member Circulars</h4>
            <span class="notif-count blue">Latest</span>
          </div>
          <div class="notif-list">
            <div class="notif-row">
              <span class="ntag gst">21 Dec '23</span>
              <div class="ncontent">
                <div class="nref">GST Updates — December 2023</div>
                <div class="ndesc">Summary of latest changes and GST regulation updates impacting IT businesses in Punjab & Chandigarh.</div>
              </div>
            </div>
            <div class="notif-row">
              <span class="ntag other">18 Dec '23</span>
              <div class="ncontent">
                <div class="nref">Punjab & Chandigarh — Important Notification</div>
                <div class="ndesc">Earlier notification on E-Way Bill applicability for Job Work is kept in abeyance till further notice.</div>
              </div>
            </div>
          </div>
        </div>
        <div style="margin-top:16px;display:flex;justify-content:flex-end">
          <a href="#" class="link-more">View All Circulars <i class="fas fa-arrow-right" style="font-size:11px"></i></a>
        </div>
      </div>
      <div class="side-cards">
        <div class="side-card">
          <div class="side-card-img" style="background:linear-gradient(135deg,#EBF4FF,#C7DEFF)">🤝</div>
          <div class="side-card-body">
            <h5>Become a Member</h5>
            <p>Be part of Punjab & Chandigarh's leading IT trade body. Network with 600+ traders and access exclusive member benefits.</p>
            <a href="#" class="side-card-link">Join Now <i class="fas fa-arrow-right" style="font-size:10px"></i></a>
          </div>
        </div>
        <div class="side-card">
          <div class="side-card-img" style="background:linear-gradient(135deg,#ECFDF5,#A7F3D0)">📖</div>
          <div class="side-card-body">
            <h5>Members Directory</h5>
            <p>Access a comprehensive, searchable directory of all 600+ P A C T members with advanced search capabilities.</p>
            <a href="#" class="side-card-link">Browse Directory <i class="fas fa-arrow-right" style="font-size:10px"></i></a>
          </div>
        </div>
        <div class="side-card">
          <div class="side-card-img" style="background:linear-gradient(135deg,#FFF7ED,#FED7AA)">💚</div>
          <div class="side-card-body">
            <h5>CSR Activities</h5>
            <p>See how P A C T gives back to the community through regular education and healthcare initiatives.</p>
            <a href="#" class="side-card-link">View Initiatives <i class="fas fa-arrow-right" style="font-size:10px"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA BAND -->
<div class="cta-band">
  <h2>Ready to Join Punjab & Chandigarh's Largest IT Community?</h2>
  <p>Network with 600+ IT traders, get GST &amp; legal support, and grow your IT business with P A C T.</p>
  <div class="cta-btn-row">
    <a href="#" class="btn-w"><i class="fas fa-ticket-alt"></i> Register for Annual Meet 2025</a>
    <a href="#" class="btn-ghost-w"><i class="fas fa-info-circle"></i> Learn More</a>
  </div>
</div>

<!-- GALLERY -->
<section class="section" style="background:#fff">
  <div class="section-inner">
    <div class="sec-header">
      <div class="sec-hrow">
        <div>
          <div class="eyebrow">Moments &amp; Memories</div>
          <h2 class="sec-title">From the <span class="hl">Gallery</span></h2>
        </div>
        <a href="#" class="link-more">View All Photos <i class="fas fa-arrow-right" style="font-size:11px"></i></a>
      </div>
    </div>
    <div class="gallery-grid">
      <div class="g-item" style="background:linear-gradient(135deg,#0D1F38,#1A3C6E)">
        <div class="g-inner">🏛️</div>
        <div class="g-overlay"><div class="g-cat-label">AGM</div><div class="g-title">PACT Annual General Meeting</div></div>
      </div>
      <div class="g-item" style="background:linear-gradient(135deg,#2E1065,#4C1D95)">
        <div class="g-inner">🏆</div>
        <div class="g-overlay"><div class="g-cat-label">Seminar</div><div class="g-title">Awards for Innovative Solutions</div></div>
      </div>
      <div class="g-item" style="background:linear-gradient(135deg,#064E3B,#065F46)">
        <div class="g-inner">📖</div>
        <div class="g-overlay"><div class="g-cat-label">Other Events</div><div class="g-title">PACT Member Directory Launch</div></div>
      </div>
    </div>
  </div>
</section>

<!-- SPONSORS / QUICK STATS -->
<div class="sponsors-sec">
  <div class="sponsors-inner">
    <p class="sponsors-label">Our Reach &amp; Impact</p>
    <div class="sponsors-row">
      <div class="sponsor-item"><span class="si-num">600+</span>Active Members</div>
      <div class="sponsor-item"><span class="si-num">20yr</span>Established</div>
      <div class="sponsor-item"><span class="si-num">50+</span>Events Hosted</div>
      <div class="sponsor-item"><span class="si-num">11+</span>City Associations</div>
      <div class="sponsor-item"><span class="si-num">2</span>State/UT Reach</div>
      <div class="sponsor-item"><span class="si-num">5+</span>Industry Awards</div>
    </div>
  </div>
</div>

@endsection