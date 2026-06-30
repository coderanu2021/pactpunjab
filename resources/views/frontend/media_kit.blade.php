@extends('layouts.frontend')
@section('title', 'Media Kit')

@section('content')
<style>
.fact-sheet{background:linear-gradient(135deg,var(--navy2),var(--navy));border-radius:22px;padding:48px;margin-bottom:80px;position:relative;overflow:hidden;border:1px solid rgba(245,166,35,.12)}
.fact-sheet::before{content:'📊';position:absolute;font-size:180px;right:-20px;bottom:-30px;opacity:.05}
.fact-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:18px;margin-top:32px;position:relative;z-index:1}
.fact-item{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:20px;text-align:center}
.fact-n{font-size:30px;font-weight:900;color:var(--gold2);line-height:1}
.fact-l{font-size:11px;font-weight:600;color:rgba(255,255,255,.4);text-transform:uppercase;letter-spacing:.8px;margin-top:5px}

.kit-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-bottom:80px}
.kit-card{background:#fff;border:1px solid var(--border);border-radius:18px;padding:26px 22px;text-align:center;transition:transform .25s,box-shadow .25s}
.kit-card:hover{transform:translateY(-5px);box-shadow:var(--card-shadow-hover)}
.kit-ico{font-size:40px;margin-bottom:14px}
.kit-card h4{font-size:15px;font-weight:700;color:var(--navy);margin-bottom:8px}
.kit-card p{font-size:12px;color:var(--muted);line-height:1.65;margin-bottom:16px}

.bio-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:20px;margin-bottom:80px}
.bio-card{background:#fff;border:1px solid var(--border);border-radius:16px;padding:24px 22px;display:flex;gap:16px;align-items:flex-start;transition:box-shadow .2s}
.bio-card:hover{box-shadow:var(--card-shadow)}
.bio-avatar{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:18px;font-weight:900;color:#fff;flex-shrink:0;font-family:'Poppins',sans-serif}
.bio-card h5{font-size:15px;font-weight:700;color:var(--navy);margin-bottom:2px}
.bio-card .bio-title{font-size:12px;color:var(--blue2);font-weight:600;margin-bottom:8px}
.bio-card p{font-size:12px;color:var(--muted);line-height:1.6}

.color-palette{display:grid;grid-template-columns:repeat(5,1fr);gap:14px;margin-bottom:80px}
.color-swatch{border-radius:14px;height:100px;display:flex;flex-direction:column;justify-content:flex-end;padding:12px;position:relative;overflow:hidden}
.color-swatch span{font-size:11px;font-weight:700;color:#fff;background:rgba(0,0,0,.25);padding:3px 8px;border-radius:6px;display:inline-block;width:fit-content}

@media(max-width:1100px){.fact-grid{grid-template-columns:1fr 1fr}.kit-grid{grid-template-columns:1fr 1fr}.bio-grid{grid-template-columns:1fr}.color-palette{grid-template-columns:repeat(3,1fr)}}
@media(max-width:700px){.kit-grid{grid-template-columns:1fr}.fact-sheet{padding:32px 24px}.color-palette{grid-template-columns:1fr 1fr}}
</style>

<div class="page-hero">
  <div class="hero-glow"></div><div class="hero-glow2"></div>
  <div class="page-hero-inner">
    <div class="breadcrumb">
      <a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a><i class="fas fa-chevron-right"></i>
      <a href="#">Press</a><i class="fas fa-chevron-right"></i>
      <span class="active">Media Kit</span>
    </div>
    <div class="page-hero-tag"><span>Press</span></div>
    <h1>Media <span>Kit</span></h1>
    <p>{{ $settings['page_media_kit_intro'] ?? 'Everything journalists and media partners need to cover P A C T — fact sheet, brand assets, leadership bios, and press contact information.' }}</p>
    <div class="hero-chips">
      <div class="hero-chip"><i class="fas fa-image"></i> Logo Pack</div>
      <div class="hero-chip"><i class="fas fa-chart-bar"></i> Fact Sheet</div>
      <div class="hero-chip"><i class="fas fa-user-tie"></i> Leadership Bios</div>
    </div>
  </div>
</div>

<div class="page-body">

  <!-- FACT SHEET -->
  <div class="fact-sheet">
    <div class="eyebrow ew-gold2">Fact Sheet</div>
    <h2 class="sec-title on-dark">P A C T at a <span class="hl-gold">Glance</span></h2>
    <p style="color:rgba(255,255,255,.55);font-size:14px;max-width:600px">Key statistics for journalists and media partners covering Punjab & Chandigarh's largest IT trade association.</p>
    <div class="fact-grid">
      <div class="fact-item"><div class="fact-n">1996</div><div class="fact-l">Year Founded</div></div>
      <div class="fact-item"><div class="fact-n">620<sup style="font-size:14px">+</sup></div><div class="fact-l">Members</div></div>
      <div class="fact-item"><div class="fact-n">11<sup style="font-size:14px">+</sup></div><div class="fact-l">City Associations</div></div>
      <div class="fact-item"><div class="fact-n">50<sup style="font-size:14px">+</sup></div><div class="fact-l">Events / Year</div></div>
      <div class="fact-item"><div class="fact-n">29<sup style="font-size:14px">yr</sup></div><div class="fact-l">Legacy</div></div>
      <div class="fact-item"><div class="fact-n">14</div><div class="fact-l">Past Presidents</div></div>
      <div class="fact-item"><div class="fact-n">2</div><div class="fact-l">State / UT Reach</div></div>
      <div class="fact-item"><div class="fact-n">5<sup style="font-size:14px">+</sup></div><div class="fact-l">Industry Awards</div></div>
    </div>
  </div>

  <!-- DOWNLOAD KIT -->
  <div class="eyebrow">Download Assets</div>
  <h2 class="sec-title" style="margin-bottom:28px">Brand & <span class="hl">Media Assets</span></h2>
  <div class="kit-grid">
    <div class="kit-card">
      <div class="kit-ico">🖼️</div>
      <h4>Logo Pack</h4>
      <p>Official PACT logo in PNG, SVG, EPS — light and dark versions, all resolutions.</p>
      <button class="btn-primary" style="padding:9px 20px;font-size:12px"><i class="fas fa-download"></i> Download ZIP</button>
    </div>
    <div class="kit-card">
      <div class="kit-ico">🎨</div>
      <h4>Brand Style Guide</h4>
      <p>Official colours, typography, logo usage rules, and visual identity guidelines.</p>
      <button class="btn-primary" style="padding:9px 20px;font-size:12px"><i class="fas fa-download"></i> Download PDF</button>
    </div>
    <div class="kit-card">
      <div class="kit-ico">📸</div>
      <h4>Press Photos</h4>
      <p>High-resolution photos of leadership, events, and PACT headquarters for press use.</p>
      <button class="btn-primary" style="padding:9px 20px;font-size:12px"><i class="fas fa-download"></i> Download ZIP</button>
    </div>
  </div>

  <!-- LEADERSHIP BIOS -->
  <div class="eyebrow">Leadership Bios</div>
  <h2 class="sec-title" style="margin-bottom:28px">For Press <span class="hl">Reference</span></h2>
  <div class="bio-grid">
    <div class="bio-card">
      <div class="bio-avatar" style="background:linear-gradient(140deg,var(--gold),#C47D00)">SW</div>
      <div>
        <h5>Sanjeev Walia</h5>
        <div class="bio-title">President, PACT (Term 2024–26)</div>
        <p>Sanjeev Walia leads PACT's 600+ member association, focused on government advocacy, member services expansion, and the Annual Meet. Based in Chandigarh, with two decades of IT trade industry experience.</p>
      </div>
    </div>
    <div class="bio-card">
      <div class="bio-avatar" style="background:linear-gradient(140deg,#059669,#065F46)">SK</div>
      <div>
        <h5>Sunil Kumar</h5>
        <div class="bio-title">Secretary General, PACT</div>
        <p>Sunil Kumar manages PACT's secretariat operations, member communications, and AGM proceedings. Available for queries on association administration and membership matters.</p>
      </div>
    </div>
    <div class="bio-card">
      <div class="bio-avatar" style="background:linear-gradient(140deg,#D97706,#78350F)">PS</div>
      <div>
        <h5>Priya Sharma</h5>
        <div class="bio-title">PRO & Media, PACT</div>
        <p>Priya Sharma is PACT's primary press contact, managing media relations, social channels, and press releases. First point of contact for journalists and media partners.</p>
      </div>
    </div>
    <div class="bio-card">
      <div class="bio-avatar" style="background:linear-gradient(140deg,#7C3AED,#4C1D95)">RG</div>
      <div>
        <h5>Rohit Gupta</h5>
        <div class="bio-title">Treasurer, PACT</div>
        <p>Rohit Gupta oversees PACT's financial operations and annual reports. Available for queries related to financial statements and association funding.</p>
      </div>
    </div>
  </div>

  <!-- COLOR PALETTE -->
  <div class="eyebrow">Brand Colours</div>
  <h2 class="sec-title" style="margin-bottom:28px">Official <span class="hl">Colour Palette</span></h2>
  <div class="color-palette">
    <div class="color-swatch" style="background:#07111F"><span>#07111F Navy</span></div>
    <div class="color-swatch" style="background:#1E50A2"><span>#1E50A2 Blue</span></div>
    <div class="color-swatch" style="background:#E03A12"><span>#E03A12 Accent</span></div>
    <div class="color-swatch" style="background:#F5A623"><span>#F5A623 Gold</span></div>
    <div class="color-swatch" style="background:#F2F6FC;border:1px solid var(--border)"><span style="color:var(--navy);background:rgba(255,255,255,.7)">#F2F6FC Light</span></div>
  </div>

  <div class="cta-band-red">
    <div class="cta-band-text"><h3>Press & Media Enquiries</h3><p>For interviews, statements, or additional information, reach out to PACT's PRO directly.</p></div>
    <div class="cta-band-btns">
      <a href="mailto:media@pact.org.in" class="btn-white"><i class="fas fa-envelope"></i> media@pact.org.in</a>
      <a href="tel:+919417223355" class="btn-ghost-dark"><i class="fas fa-phone"></i> +91 94172-23355</a>
    </div>
  </div>

</div>

@endsection
