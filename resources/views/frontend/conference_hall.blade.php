@extends('layouts.frontend')
@section('title', 'Conference Hall')

@section('content')
<style>
.hall-hero-card{background:linear-gradient(135deg,var(--navy2),var(--navy));border-radius:22px;padding:52px 48px;margin-bottom:80px;display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:center;position:relative;overflow:hidden;border:1px solid rgba(30,80,162,.2)}
.hall-hero-card::before{content:'🏛️';position:absolute;font-size:200px;right:-20px;bottom:-30px;opacity:.05}
.hall-tag{display:inline-flex;align-items:center;gap:8px;background:rgba(245,166,35,.15);border:1px solid rgba(245,166,35,.3);padding:6px 14px;border-radius:20px;margin-bottom:16px}
.hall-tag span{font-size:11px;font-weight:700;color:var(--gold2);letter-spacing:1.5px;text-transform:uppercase}
.hall-hero-card h2{font-size:clamp(20px,2.5vw,32px);font-weight:900;color:#fff;margin-bottom:12px;letter-spacing:-.3px;line-height:1.25}
.hall-hero-card p{font-size:14px;color:rgba(255,255,255,.55);line-height:1.75;margin-bottom:24px}
.hall-specs{display:grid;grid-template-columns:1fr 1fr;gap:12px;position:relative;z-index:1}
.hall-spec{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:12px;padding:16px 18px}
.hall-spec-ico{font-size:20px;margin-bottom:8px}
.hall-spec h5{font-size:13px;font-weight:700;color:#fff;margin-bottom:3px}
.hall-spec p{font-size:11px;color:rgba(255,255,255,.45);line-height:1.5}

.amenities-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:18px;margin-bottom:80px}
.amenity-item{background:#fff;border:1px solid var(--border);border-radius:14px;padding:22px 18px;text-align:center;transition:box-shadow .2s,transform .2s}
.amenity-item:hover{box-shadow:var(--card-shadow);transform:translateY(-3px)}
.amenity-ico{font-size:30px;margin-bottom:12px}
.amenity-item h5{font-size:13px;font-weight:700;color:var(--navy);margin-bottom:4px}
.amenity-item p{font-size:11px;color:var(--muted);line-height:1.55}

.seating-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-bottom:80px}
.seating-card{background:#fff;border:1px solid var(--border);border-radius:16px;padding:24px;transition:box-shadow .2s,transform .2s}
.seating-card:hover{box-shadow:var(--card-shadow);transform:translateY(-3px)}
.seating-card.featured{background:var(--navy);border-color:var(--navy)}
.seating-ico{font-size:32px;margin-bottom:14px}
.seating-card h4{font-size:15px;font-weight:800;margin-bottom:6px}
.seating-card h4,.seating-card.featured h4{color:var(--navy)}
.seating-card.featured h4{color:#fff}
.seating-capacity{font-size:28px;font-weight:900;color:var(--blue2);margin-bottom:4px;line-height:1}
.seating-card.featured .seating-capacity{color:var(--gold2)}
.seating-cap-label{font-size:11px;color:var(--muted);margin-bottom:12px;font-weight:600}
.seating-card.featured .seating-cap-label{color:rgba(255,255,255,.45)}
.seating-card p{font-size:12px;color:var(--muted);line-height:1.65}
.seating-card.featured p{color:rgba(255,255,255,.55)}

.booking-form-section{background:var(--light);border-radius:22px;padding:52px 48px;margin-bottom:80px}
.booking-grid{display:grid;grid-template-columns:1fr 1fr;gap:18px}
.form-grp{display:flex;flex-direction:column;gap:6px}
.form-lbl{font-size:12px;font-weight:700;color:var(--navy);letter-spacing:.3px}
.form-lbl .req{color:var(--accent)}
.form-ctrl{padding:11px 16px;border:1.5px solid var(--border);border-radius:10px;font-family:var(--font);font-size:14px;color:var(--text);background:#fff;outline:none;transition:border-color .2s,box-shadow .2s;width:100%}
.form-ctrl:focus{border-color:var(--blue2);box-shadow:0 0 0 3px rgba(30,80,162,.1)}
.form-ctrl::placeholder{color:#B0BEC5}
textarea.form-ctrl{resize:vertical;min-height:100px}
.booking-notice{grid-column:1/-1;background:rgba(30,80,162,.06);border:1px solid rgba(30,80,162,.15);border-radius:12px;padding:14px 18px;font-size:13px;color:var(--blue2);display:flex;align-items:flex-start;gap:10px;line-height:1.65}
.booking-notice i{flex-shrink:0;margin-top:2px}

.pricing-band{background:var(--navy2);border-radius:22px;padding:44px 48px;margin-bottom:80px}
.pricing-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:18px;margin-top:28px}
.pricing-card{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.09);border-radius:14px;padding:24px;text-align:center;transition:background .2s}
.pricing-card:hover{background:rgba(255,255,255,.09)}
.pricing-card.featured-price{background:rgba(245,166,35,.12);border-color:rgba(245,166,35,.3)}
.pricing-name{font-size:13px;font-weight:700;color:rgba(255,255,255,.6);margin-bottom:10px;text-transform:uppercase;letter-spacing:1px}
.pricing-amt{font-size:32px;font-weight:900;color:#fff;line-height:1;margin-bottom:4px}
.pricing-amt sup{font-size:16px;color:var(--gold2)}
.pricing-card.featured-price .pricing-amt{color:var(--gold2)}
.pricing-period{font-size:11px;color:rgba(255,255,255,.35);margin-bottom:14px}
.pricing-features{display:flex;flex-direction:column;gap:8px}
.pricing-feat{font-size:12px;color:rgba(255,255,255,.55);display:flex;align-items:center;gap:7px}
.pricing-feat i{font-size:11px;color:var(--gold2)}

@media(max-width:1100px){.hall-hero-card{grid-template-columns:1fr}.amenities-grid{grid-template-columns:1fr 1fr}.seating-grid{grid-template-columns:1fr 1fr}.pricing-grid{grid-template-columns:1fr 1fr}}
@media(max-width:768px){.amenities-grid{grid-template-columns:1fr 1fr}.seating-grid{grid-template-columns:1fr}.booking-grid{grid-template-columns:1fr}.booking-form-section{padding:32px 24px}.pricing-band{padding:32px 24px}.pricing-grid{grid-template-columns:1fr}}
</style>

<div class="page-hero">
  <div class="hero-glow"></div><div class="hero-glow2"></div>
  <div class="page-hero-inner">
    <div class="breadcrumb">
      <a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a><i class="fas fa-chevron-right"></i>
      <a href="#">Services</a><i class="fas fa-chevron-right"></i>
      <span class="active">Conference Hall</span>
    </div>
    <div class="page-hero-tag"><span>Services</span></div>
    <h1>Conference <span>Hall</span></h1>
    <p>{{ $settings['page_conference_hall_intro'] ?? "PACT's fully equipped conference and meeting facility in Chandigarh — available to all members for board meetings, training sessions, client presentations, and corporate events." }}</p>
    <div class="hero-chips">
      <div class="hero-chip"><i class="fas fa-users"></i> Up to 80 Capacity</div>
      <div class="hero-chip"><i class="fas fa-projector"></i> AV Equipped</div>
      <div class="hero-chip"><i class="fas fa-wifi"></i> High-Speed Wi-Fi</div>
      <div class="hero-chip"><i class="fas fa-rupee-sign"></i> Members Discount</div>
    </div>
  </div>
</div>

<div class="page-body">

  <!-- HALL HERO -->
  <div class="hall-hero-card">
    <div style="position:relative;z-index:1">
      <div class="hall-tag"><span>🏛️ PACT Headquarters</span></div>
      <h2>State-of-the-Art Conference Facilities in Chandigarh</h2>
      <p>{{ $settings['page_conference_hall_desc'] ?? "PACT's conference hall at our Chandigarh headquarters is a professional, fully equipped space designed for the modern IT business — whether you're hosting a board meeting, a training session, or a product launch." }}</p>
      <div class="btn-group">
        <a href="#bookingForm" class="btn-gold"><i class="fas fa-calendar-check"></i> Book Now</a>
        <a href="tel:+919417223355" class="btn-ghost-dark"><i class="fas fa-phone"></i> Call for Availability</a>
      </div>
    </div>
    <div class="hall-specs">
      <div class="hall-spec"><div class="hall-spec-ico">👥</div><h5>Capacity</h5><p>Up to 80 persons (theatre) or 40 (boardroom)</p></div>
      <div class="hall-spec"><div class="hall-spec-ico">📍</div><h5>Location</h5><p>PACT Headquarters, Chandigarh — city centre</p></div>
      <div class="hall-spec"><div class="hall-spec-ico">🕒</div><h5>Availability</h5><p>Mon–Sat, 9 AM – 7 PM. Advance booking required</p></div>
      <div class="hall-spec"><div class="hall-spec-ico">🅿️</div><h5>Parking</h5><p>Ample parking available at PACT HQ premises</p></div>
    </div>
  </div>

  <!-- AMENITIES -->
  <div class="eyebrow">Facilities</div>
  <h2 class="sec-title" style="margin-bottom:28px">Everything You <span class="hl">Need</span></h2>
  <div class="amenities-grid">
    <div class="amenity-item"><div class="amenity-ico">📽️</div><h5>HD Projector & Screen</h5><p>Full HD projector with 100" motorised screen — crystal clear for any presentation.</p></div>
    <div class="amenity-item"><div class="amenity-ico">📺</div><h5>LED Display Panel</h5><p>85" 4K LED display panel for boardroom-style meetings and video calls.</p></div>
    <div class="amenity-item"><div class="amenity-ico">🎤</div><h5>PA System & Mics</h5><p>Professional PA system with 2 wireless lapel mics and 2 podium microphones.</p></div>
    <div class="amenity-item"><div class="amenity-ico">💻</div><h5>Video Conferencing</h5><p>Zoom & Teams compatible VC setup with wide-angle camera and echo cancellation.</p></div>
    <div class="amenity-item"><div class="amenity-ico">📶</div><h5>High-Speed Wi-Fi</h5><p>Dedicated 100 Mbps leased line — reliable for all attendees simultaneously.</p></div>
    <div class="amenity-item"><div class="amenity-ico">❄️</div><h5>Centralised AC</h5><p>Full centralised air conditioning — individually controlled for comfort.</p></div>
    <div class="amenity-item"><div class="amenity-ico">☕</div><h5>Refreshments</h5><p>Tea, coffee, and snacks available on request (additional charge applies).</p></div>
    <div class="amenity-item"><div class="amenity-ico">🖨️</div><h5>Printing & Stationery</h5><p>Printer, whiteboard, and stationery kits available for all bookings.</p></div>
  </div>

  <!-- SEATING ARRANGEMENTS -->
  <div class="eyebrow">Seating Options</div>
  <h2 class="sec-title" style="margin-bottom:28px">Choose Your <span class="hl">Setup</span></h2>
  <div class="seating-grid">
    <div class="seating-card featured">
      <div class="seating-ico">🎭</div>
      <h4>Theatre Style</h4>
      <div class="seating-capacity">80</div>
      <div class="seating-cap-label">Persons Maximum</div>
      <p>Rows of chairs facing the screen/stage — ideal for seminars, training sessions, presentations, and product launches where audience interaction is minimal.</p>
    </div>
    <div class="seating-card">
      <div class="seating-ico">🟦</div>
      <h4>Boardroom Style</h4>
      <div class="seating-capacity" style="color:var(--blue2)">40</div>
      <div class="seating-cap-label">Persons Maximum</div>
      <p>U-shape or hollow square table arrangement — ideal for board meetings, strategy sessions, committee meetings, and discussions requiring face-to-face interaction.</p>
    </div>
    <div class="seating-card">
      <div class="seating-ico">🪑</div>
      <h4>Classroom Style</h4>
      <div class="seating-capacity" style="color:var(--blue2)">50</div>
      <div class="seating-cap-label">Persons Maximum</div>
      <p>Tables and chairs in rows — ideal for training workshops, seminars with note-taking, and certification programmes where participants need desk space.</p>
    </div>
  </div>

  <!-- PRICING -->
  <div class="pricing-band">
    <div class="eyebrow ew-gold2">Rental Rates</div>
    <h2 class="sec-title on-dark">Affordable <span class="hl-gold">Pricing</span></h2>
    <div class="pricing-grid">
      <div class="pricing-card">
        <div class="pricing-name">Half Day (4 hrs)</div>
        <div class="pricing-amt"><sup>₹</sup>2,500</div>
        <div class="pricing-period">Members · + GST</div>
        <div class="pricing-features">
          <div class="pricing-feat"><i class="fas fa-check"></i> Up to 4 hours</div>
          <div class="pricing-feat"><i class="fas fa-check"></i> AV equipment included</div>
          <div class="pricing-feat"><i class="fas fa-check"></i> Wi-Fi included</div>
          <div class="pricing-feat"><i class="fas fa-check"></i> 1 attendant</div>
        </div>
      </div>
      <div class="pricing-card featured-price">
        <div class="pricing-name">Full Day (8 hrs)</div>
        <div class="pricing-amt"><sup>₹</sup>4,500</div>
        <div class="pricing-period">Members · + GST</div>
        <div class="pricing-features">
          <div class="pricing-feat"><i class="fas fa-check"></i> Up to 8 hours</div>
          <div class="pricing-feat"><i class="fas fa-check"></i> Full AV setup</div>
          <div class="pricing-feat"><i class="fas fa-check"></i> Wi-Fi + printing</div>
          <div class="pricing-feat"><i class="fas fa-check"></i> Tea/coffee (2 rounds)</div>
          <div class="pricing-feat"><i class="fas fa-check"></i> 2 attendants</div>
        </div>
      </div>
      <div class="pricing-card">
        <div class="pricing-name">Non-Member Rate</div>
        <div class="pricing-amt"><sup>₹</sup>7,500</div>
        <div class="pricing-period">Full Day · + GST</div>
        <div class="pricing-features">
          <div class="pricing-feat"><i class="fas fa-check"></i> Up to 8 hours</div>
          <div class="pricing-feat"><i class="fas fa-check"></i> Full AV setup</div>
          <div class="pricing-feat"><i class="fas fa-check"></i> Wi-Fi included</div>
          <div class="pricing-feat"><i class="fas fa-check"></i> 1 attendant</div>
        </div>
      </div>
    </div>
  </div>

  <!-- BOOKING FORM -->
  <div class="booking-form-section" id="bookingForm">
    <div style="margin-bottom:28px">
      <div class="eyebrow">Book Online</div>
      <h2 class="sec-title">Conference Hall <span class="hl">Booking Request</span></h2>
      <p style="font-size:14px;color:var(--muted);margin-top:4px">Submit your booking request and we will confirm availability within 24 hours.</p>
    </div>
    <form onsubmit="return false">
      <div class="booking-grid">
        <div class="form-grp"><label class="form-lbl">Your Name / Firm <span class="req">*</span></label><input type="text" class="form-ctrl" placeholder="Full name or firm name" required></div>
        <div class="form-grp"><label class="form-lbl">PACT Member ID</label><input type="text" class="form-ctrl" placeholder="e.g. PACT/MEM/2024/00001"></div>
        <div class="form-grp"><label class="form-lbl">Mobile Number <span class="req">*</span></label><input type="tel" class="form-ctrl" placeholder="+91 XXXXX XXXXX" required></div>
        <div class="form-grp"><label class="form-lbl">Email Address <span class="req">*</span></label><input type="email" class="form-ctrl" placeholder="your@email.com" required></div>
        <div class="form-grp"><label class="form-lbl">Preferred Date <span class="req">*</span></label><input type="date" class="form-ctrl" required></div>
        <div class="form-grp"><label class="form-lbl">Time Slot <span class="req">*</span></label><select class="form-ctrl" required><option value="">— Select —</option><option>Morning Half Day (9 AM – 1 PM)</option><option>Afternoon Half Day (2 PM – 6 PM)</option><option>Full Day (9 AM – 6 PM)</option></select></div>
        <div class="form-grp"><label class="form-lbl">Expected Attendees <span class="req">*</span></label><input type="number" class="form-ctrl" placeholder="e.g. 25" min="5" max="80" required></div>
        <div class="form-grp"><label class="form-lbl">Seating Arrangement</label><select class="form-ctrl"><option>Theatre Style (max 80)</option><option>Boardroom Style (max 40)</option><option>Classroom Style (max 50)</option></select></div>
        <div class="form-grp" style="grid-column:1/-1"><label class="form-lbl">Purpose of Booking</label><textarea class="form-ctrl" rows="3" placeholder="Brief description of your event or meeting…"></textarea></div>
        <div class="booking-notice"><i class="fas fa-info-circle"></i><div>Bookings are subject to availability and confirmation by the PACT Secretariat. <strong>Member rates</strong> apply on production of a valid member ID. Payment is due at least 48 hours before the booking date.</div></div>
      </div>
      <div class="btn-group" style="margin-top:4px">
        <button class="btn-primary" onclick="alert('Booking request submitted! We will confirm within 24 hours.')"><i class="fas fa-calendar-check"></i> Submit Booking Request</button>
        <a href="tel:+919417223355" class="btn-ghost-light"><i class="fas fa-phone"></i> Call for Instant Booking</a>
      </div>
    </form>
  </div>

  <div class="cta-band-red">
    <div class="cta-band-text"><h3>Members Get 40% Off Non-Member Rates</h3><p>Another great reason to be a PACT member — access our fully equipped conference hall at preferential rates year-round.</p></div>
    <div class="cta-band-btns">
      <a href="{{ route('become-member') }}" class="btn-white"><i class="fas fa-user-plus"></i> Join PACT</a>
      <a href="contact.html" class="btn-ghost-dark"><i class="fas fa-envelope"></i> Contact Us</a>
    </div>
  </div>

</div>

@endsection
