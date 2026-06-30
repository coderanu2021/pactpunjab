@extends('layouts.frontend')
@section('title', 'Contact Us')

@section('content')
<style>
.contact-layout{display:grid;grid-template-columns:1fr 1.2fr;gap:48px;margin-bottom:80px;align-items:start}
.contact-cards{display:flex;flex-direction:column;gap:16px}
.contact-info-card{background:#fff;border:1px solid var(--border);border-radius:16px;padding:22px 24px;display:flex;align-items:flex-start;gap:16px;transition:box-shadow .2s,transform .2s}
.contact-info-card:hover{box-shadow:var(--card-shadow);transform:translateY(-2px)}
.cic-ico{width:48px;height:48px;border-radius:13px;display:flex;align-items:center;justify-content:center;font-size:19px;flex-shrink:0}
.cic-content h5{font-size:14px;font-weight:700;color:var(--navy);margin-bottom:5px}
.cic-content p{font-size:13px;color:var(--muted);line-height:1.6}
.cic-content a{color:var(--blue2);font-weight:600}

.map-embed{background:var(--light);border-radius:18px;height:200px;display:flex;align-items:center;justify-content:center;font-size:48px;border:1px solid var(--border);margin-top:16px}

.contact-form-card{background:#fff;border:1px solid var(--border);border-radius:22px;padding:36px}
.cform-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px}
.cform-grp{display:flex;flex-direction:column;gap:6px}
.cform-lbl{font-size:12px;font-weight:700;color:var(--navy)}
.cform-lbl .req{color:var(--accent)}
.cform-ctrl{padding:11px 16px;border:1.5px solid var(--border);border-radius:10px;font-family:var(--font);font-size:14px;color:var(--text);background:#fff;outline:none;transition:border-color .2s,box-shadow .2s;width:100%}
.cform-ctrl:focus{border-color:var(--blue2);box-shadow:0 0 0 3px rgba(30,80,162,.1)}
textarea.cform-ctrl{resize:vertical;min-height:120px}

.dept-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:80px}
.dept-card{background:#fff;border:1px solid var(--border);border-radius:14px;padding:20px;text-align:center;transition:box-shadow .2s,transform .2s}
.dept-card:hover{box-shadow:var(--card-shadow);transform:translateY(-3px)}
.dept-ico{font-size:26px;margin-bottom:10px}
.dept-card h5{font-size:13px;font-weight:700;color:var(--navy);margin-bottom:4px}
.dept-card a{font-size:11px;color:var(--blue2);font-weight:600}

@media(max-width:1100px){.contact-layout{grid-template-columns:1fr}.dept-grid{grid-template-columns:1fr 1fr}}
@media(max-width:700px){.cform-grid{grid-template-columns:1fr}.contact-form-card{padding:24px}.dept-grid{grid-template-columns:1fr}}
</style>

<div class="page-hero">
  <div class="hero-glow"></div><div class="hero-glow2"></div>
  <div class="page-hero-inner">
    <div class="breadcrumb">
      <a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a><i class="fas fa-chevron-right"></i>
      <a href="#">About Us</a><i class="fas fa-chevron-right"></i>
      <span class="active">Contact Us</span>
    </div>
    <div class="page-hero-tag"><span>About Us</span></div>
    <h1>Contact <span>Us</span></h1>
    <p>{{ $settings['page_contact_intro'] ?? 'Reach out to the P A C T Secretariat in Chandigarh for membership, partnerships, media, or any general enquiries.' }}</p>
    <div class="hero-chips">
      <div class="hero-chip"><i class="fas fa-clock"></i> Mon–Sat, 10 AM–5 PM</div>
      <div class="hero-chip"><i class="fas fa-map-marker-alt"></i> Chandigarh HQ</div>
    </div>
  </div>
</div>

<div class="page-body">

  <div class="contact-layout">

    <!-- CONTACT INFO -->
    <div>
      <div class="eyebrow">Get in Touch</div>
      <h2 class="sec-title" style="margin-bottom:24px">Contact <span class="hl">Information</span></h2>

      <div class="contact-cards">
        <div class="contact-info-card">
          <div class="cic-ico ico-box blue md"><i class="fas fa-map-marker-alt"></i></div>
          <div class="cic-content"><h5>Office Address</h5><p>{{ $settings['contact_address'] ?? 'PACT Headquarters, Sector 17, Chandigarh, 160017, India' }}</p></div>
        </div>
        <div class="contact-info-card">
          <div class="cic-ico ico-box red md"><i class="fas fa-phone-alt"></i></div>
          <div class="cic-content"><h5>Phone</h5><p><a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings['contact_phone'] ?? '+919417223355') }}">{{ $settings['contact_phone'] ?? '+91 94172-23355' }}</a></p></div>
        </div>
        <div class="contact-info-card">
          <div class="cic-ico ico-box gold md"><i class="fas fa-envelope"></i></div>
          <div class="cic-content"><h5>Email</h5><p><a href="mailto:{{ $settings['contact_email'] ?? 'info@pact.org.in' }}">{{ $settings['contact_email'] ?? 'info@pact.org.in' }}</a></p></div>
        </div>
        <div class="contact-info-card">
          <div class="cic-ico ico-box green md"><i class="fas fa-clock"></i></div>
          <div class="cic-content"><h5>Office Hours</h5><p>{{ $settings['office_hours'] ?? 'Monday – Saturday: 10:00 AM – 5:00 PM' }}<br>Sunday: Closed</p></div>
        </div>
        <div class="contact-info-card">
          <div class="cic-ico ico-box purple md"><i class="fas fa-share-alt"></i></div>
          <div class="cic-content"><h5>Follow Us</h5><p>Facebook · LinkedIn · Twitter · YouTube — search "PACT Punjab"</p></div>
        </div>
      </div>

      <div class="map-embed">🗺️</div>
    </div>

    <!-- CONTACT FORM -->
    <div class="contact-form-card">
      <div class="eyebrow">Send a Message</div>
      <h2 class="sec-title" style="margin-bottom:6px">We'd Love to <span class="hl">Hear From You</span></h2>
      <p style="font-size:13px;color:var(--muted);margin-bottom:24px">Fill out the form and our team will respond within 2 working days.</p>

      <form onsubmit="return false">
        <div class="cform-grid">
          <div class="cform-grp"><label class="cform-lbl">Full Name <span class="req">*</span></label><input type="text" class="cform-ctrl" placeholder="Your full name" required></div>
          <div class="cform-grp"><label class="cform-lbl">Mobile Number <span class="req">*</span></label><input type="tel" class="cform-ctrl" placeholder="+91 XXXXX XXXXX" required></div>
        </div>
        <div class="cform-grid" style="margin-top:16px">
          <div class="cform-grp"><label class="cform-lbl">Email Address <span class="req">*</span></label><input type="email" class="cform-ctrl" placeholder="your@email.com" required></div>
          <div class="cform-grp"><label class="cform-lbl">I am a…</label>
            <select class="cform-ctrl"><option>PACT Member</option><option>Prospective Member</option><option>Journalist / Media</option><option>Government / Official</option><option>Other</option></select>
          </div>
        </div>
        <div class="cform-grp" style="margin-top:16px">
          <label class="cform-lbl">Subject <span class="req">*</span></label>
          <select class="cform-ctrl" required>
            <option value="">— Select Subject —</option>
            <option>Membership Enquiry</option><option>GST / Legal Helpdesk</option><option>Grievance / Dispute</option>
            <option>Conference Hall Booking</option><option>Media / Press Enquiry</option><option>Sponsorship / Partnership</option><option>Other</option>
          </select>
        </div>
        <div class="cform-grp" style="margin-top:16px">
          <label class="cform-lbl">Your Message <span class="req">*</span></label>
          <textarea class="cform-ctrl" rows="5" placeholder="How can we help you?" required></textarea>
        </div>
        <button class="btn-primary" style="margin-top:20px;width:100%;justify-content:center;padding:14px" onclick="alert('Message sent! We will respond within 2 working days.')">
          <i class="fas fa-paper-plane"></i> Send Message
        </button>
      </form>
    </div>

  </div>

  <!-- DEPARTMENTS -->
  <div class="eyebrow">Direct Contacts</div>
  <h2 class="sec-title" style="margin-bottom:28px">Reach the Right <span class="hl">Department</span></h2>
  <div class="dept-grid">
    <div class="dept-card"><div class="dept-ico">👥</div><h5>Membership</h5><a href="mailto:membership@pact.org.in">membership@pact.org.in</a></div>
    <div class="dept-card"><div class="dept-ico">⚖️</div><h5>GST Helpdesk</h5><a href="mailto:gst@pact.org.in">gst@pact.org.in</a></div>
    <div class="dept-card"><div class="dept-ico">📣</div><h5>Media & Press</h5><a href="mailto:media@pact.org.in">media@pact.org.in</a></div>
    <div class="dept-card"><div class="dept-ico">🎪</div><h5>Events</h5><a href="mailto:events@pact.org.in">events@pact.org.in</a></div>
  </div>

  <div class="cta-band-navy">
    <div class="cta-band-text"><h3>Not a Member Yet?</h3><p>Join 600+ IT traders across Punjab & Chandigarh. Membership applications are processed within 5–7 working days.</p></div>
    <div class="cta-band-btns">
      <a href="{{ route('become-member') }}" class="btn-gold"><i class="fas fa-user-plus"></i> Join PACT</a>
      <a href="{{ route('profile') }}" class="btn-ghost-dark"><i class="fas fa-info-circle"></i> About PACT</a>
    </div>
  </div>

</div>

@endsection
