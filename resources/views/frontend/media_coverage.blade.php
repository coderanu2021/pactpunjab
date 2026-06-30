@extends('layouts.frontend')
@section('title', 'Media Coverage')

@section('content')
<style>
.coverage-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:22px;margin-bottom:80px}
.coverage-card{background:#fff;border:1px solid var(--border);border-radius:18px;overflow:hidden;transition:transform .25s,box-shadow .25s}
.coverage-card:hover{transform:translateY(-5px);box-shadow:var(--card-shadow-hover)}
.cov-thumb{height:140px;display:flex;align-items:center;justify-content:center;font-size:48px;position:relative}
.cov-outlet-badge{position:absolute;top:12px;left:12px;background:rgba(255,255,255,.95);color:var(--navy);padding:5px 12px;border-radius:20px;font-size:11px;font-weight:800}
.cov-body{padding:20px 22px}
.cov-body h4{font-size:14px;font-weight:700;color:var(--navy);margin-bottom:8px;line-height:1.4}
.cov-body p{font-size:12px;color:var(--muted);line-height:1.6;margin-bottom:12px}
.cov-meta{display:flex;align-items:center;justify-content:space-between}
.cov-date{font-size:11px;color:var(--muted);font-weight:600}
.cov-link{font-size:11px;font-weight:700;color:var(--blue2);display:flex;align-items:center;gap:5px}

.outlets-strip{background:var(--light);border-radius:22px;padding:36px 40px;margin-bottom:80px;text-align:center}
.outlets-strip p{font-size:13px;color:var(--muted);margin-bottom:24px}
.outlets-row{display:flex;align-items:center;justify-content:center;flex-wrap:wrap;gap:16px}
.outlet-pill{background:#fff;border:1px solid var(--border);border-radius:25px;padding:10px 20px;font-size:13px;font-weight:700;color:var(--navy);display:flex;align-items:center;gap:8px}
.outlet-pill i{color:var(--blue2)}

@media(max-width:1100px){.coverage-grid{grid-template-columns:1fr 1fr}}
@media(max-width:700px){.coverage-grid{grid-template-columns:1fr}}
</style>

<div class="page-hero">
  <div class="hero-glow"></div><div class="hero-glow2"></div>
  <div class="page-hero-inner">
    <div class="breadcrumb">
      <a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a><i class="fas fa-chevron-right"></i>
      <a href="#">Press</a><i class="fas fa-chevron-right"></i>
      <span class="active">Media Coverage</span>
    </div>
    <div class="page-hero-tag"><span>Press</span></div>
    <h1>Media <span>Coverage</span></h1>
    <p>P A C T in the news — coverage of our events, advocacy efforts, and impact from leading regional and national publications.</p>
    <div class="hero-chips">
      <div class="hero-chip"><i class="fas fa-newspaper"></i> Print & Digital</div>
      <div class="hero-chip"><i class="fas fa-tv"></i> TV Coverage</div>
    </div>
  </div>
</div>

<div class="page-body">

  <!-- OUTLETS -->
  <div class="outlets-strip">
    <div class="eyebrow" style="justify-content:center">As Featured In</div>
    <p>PACT's activities and advocacy regularly feature in leading Punjab & national publications.</p>
    <div class="outlets-row">
      <div class="outlet-pill"><i class="fas fa-newspaper"></i> The Tribune</div>
      <div class="outlet-pill"><i class="fas fa-newspaper"></i> Hindustan Times Chandigarh</div>
      <div class="outlet-pill"><i class="fas fa-newspaper"></i> Punjab Kesari</div>
      <div class="outlet-pill"><i class="fas fa-tv"></i> PTC News</div>
      <div class="outlet-pill"><i class="fas fa-newspaper"></i> Dainik Bhaskar</div>
      <div class="outlet-pill"><i class="fas fa-globe"></i> Times of India</div>
    </div>
  </div>

  <!-- COVERAGE GRID -->
  <div class="eyebrow">Recent Coverage</div>
  <h2 class="sec-title" style="margin-bottom:28px">PACT in the <span class="hl">News</span></h2>

  <div class="coverage-grid">
    @forelse($coverage as $item)
      @php
        $colors = [
            'linear-gradient(135deg,#0C2F5E,#1E50A2)',
            'linear-gradient(135deg,#7C1D1D,#DC2626)',
            'linear-gradient(135deg,#064E3B,#059669)',
            'linear-gradient(135deg,#78350F,#D97706)',
            'linear-gradient(135deg,#2E1065,#6D28D9)',
            'linear-gradient(135deg,#0C4A6E,#0284C7)'
        ];
        $bg = $colors[$loop->index % count($colors)];
      @endphp
      <div class="coverage-card">
        <div class="cov-thumb" style="background:{{ $bg }}">
          {{ $item->icon ?? '📰' }}
          @if($item->outlet)
          <span class="cov-outlet-badge">{{ $item->outlet }}</span>
          @endif
        </div>
        <div class="cov-body">
          <h4>{{ $item->title }}</h4>
          <p>{{ Str::limit($item->description, 120) }}</p>
          <div class="cov-meta">
            <span class="cov-date">{{ $item->published_date->format('d M Y') }}</span>
            @if($item->url)
            <a href="{{ $item->url }}" target="_blank" class="cov-link" style="text-decoration:none;">Read Article <i class="fas fa-external-link-alt" style="font-size:9px"></i></a>
            @endif
          </div>
        </div>
      </div>
    @empty
      <div style="grid-column:1/-1;text-align:center;padding:40px;color:var(--muted)">No media coverage available.</div>
    @endforelse
  </div>

  <div class="cta-band-navy">
    <div class="cta-band-text"><h3>Are You a Journalist?</h3><p>Get in touch for interviews, expert commentary on IT trade policy, or press materials about PACT's activities.</p></div>
    <div class="cta-band-btns">
      <a href="mailto:media@pact.org.in" class="btn-gold"><i class="fas fa-envelope"></i> Contact PRO</a>
      <a href="press-release.html" class="btn-ghost-dark"><i class="fas fa-bullhorn"></i> Press Releases</a>
    </div>
  </div>

</div>

@endsection
