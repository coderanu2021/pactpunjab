@extends('layouts.frontend')
@section('title', 'Press Release')

@section('content')
<style>
.pr-feat{background:linear-gradient(135deg,var(--navy2),var(--navy));border-radius:22px;padding:48px;margin-bottom:80px;position:relative;overflow:hidden;border:1px solid rgba(245,166,35,.12)}
.pr-feat::before{content:'📣';position:absolute;font-size:180px;right:-20px;bottom:-30px;opacity:.05}
.pr-feat-tag{display:inline-flex;align-items:center;gap:8px;background:rgba(245,166,35,.15);border:1px solid rgba(245,166,35,.3);padding:6px 14px;border-radius:20px;margin-bottom:16px}
.pr-feat-tag span{font-size:11px;font-weight:700;color:var(--gold2);letter-spacing:1.5px;text-transform:uppercase}
.pr-feat h2{font-size:clamp(20px,2.5vw,30px);font-weight:900;color:#fff;margin-bottom:12px;max-width:680px;line-height:1.3}
.pr-feat p{font-size:14px;color:rgba(255,255,255,.55);line-height:1.75;max-width:600px;margin-bottom:20px}
.pr-feat-meta{display:flex;gap:20px;flex-wrap:wrap}
.pr-feat-meta span{font-size:12px;color:rgba(255,255,255,.5);display:flex;align-items:center;gap:6px}
.pr-feat-meta i{color:var(--gold2);font-size:11px}

.pr-list{display:flex;flex-direction:column;gap:16px;margin-bottom:48px}
.pr-row{background:#fff;border:1px solid var(--border);border-radius:16px;padding:24px 26px;transition:box-shadow .2s,transform .2s;cursor:pointer}
.pr-row:hover{box-shadow:var(--card-shadow-hover);transform:translateX(4px)}
.pr-row-top{display:flex;align-items:center;gap:10px;margin-bottom:8px;flex-wrap:wrap}
.pr-date-tag{font-size:11px;font-weight:700;color:var(--muted);background:var(--light);padding:3px 10px;border-radius:20px}
.pr-cat-tag{font-size:10px;font-weight:700;padding:3px 10px;border-radius:20px;text-transform:uppercase;letter-spacing:.5px}
.pr-row h4{font-size:16px;font-weight:800;color:var(--navy);margin-bottom:8px;line-height:1.4}
.pr-row p{font-size:13px;color:var(--muted);line-height:1.7;margin-bottom:14px}
.pr-row-footer{display:flex;align-items:center;justify-content:space-between}
.pr-read-link{font-size:12px;font-weight:700;color:var(--blue2);display:flex;align-items:center;gap:6px;transition:gap .2s}
.pr-row:hover .pr-read-link{gap:10px}

@media(max-width:768px){.pr-feat{padding:32px 24px}}
</style>

<div class="page-hero">
  <div class="hero-glow"></div><div class="hero-glow2"></div>
  <div class="page-hero-inner">
    <div class="breadcrumb">
      <a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a><i class="fas fa-chevron-right"></i>
      <a href="#">Press</a><i class="fas fa-chevron-right"></i>
      <span class="active">Press Release</span>
    </div>
    <div class="page-hero-tag"><span>Press</span></div>
    <h1>Press <span>Releases</span></h1>
    <p>Official statements, announcements, and media communications from P A C T — Punjab & Chandigarh's leading IT trade association.</p>
    <div class="hero-chips">
      <div class="hero-chip"><i class="fas fa-bullhorn"></i> Official Statements</div>
      <div class="hero-chip"><i class="fas fa-newspaper"></i> Media Ready</div>
    </div>
  </div>
</div>

<div class="page-body">

  @if($releases->count() > 0)
  @php $featPR = $releases->first(); @endphp
  <!-- FEATURED -->
  <div class="pr-feat">
    <div class="pr-feat-tag"><span>📣 Latest Release</span></div>
    <h2>{{ $featPR->title }}</h2>
    <p>{{ $featPR->description }}</p>
    <div class="pr-feat-meta">
      <span><i class="fas fa-calendar"></i> {{ $featPR->published_date->format('d F Y') }}</span>
      @if($featPR->outlet)
      <span><i class="fas fa-tag"></i> {{ $featPR->outlet }}</span>
      @endif
    </div>
    <div class="btn-group" style="margin-top:24px">
      @if($featPR->file_path)
      <a href="{{ asset('storage/' . $featPR->file_path) }}" download class="btn-gold"><i class="fas fa-download"></i> Download Press Release</a>
      @endif
      <a href="{{ route('media-kit') }}" class="btn-ghost-dark"><i class="fas fa-briefcase"></i> Media Kit</a>
    </div>
  </div>
  @endif

  <!-- ALL RELEASES -->
  <div class="eyebrow">All Releases</div>
  <h2 class="sec-title" style="margin-bottom:28px">Press Release <span class="hl">Archive</span></h2>

  <div class="pr-list">
    @forelse($releases->skip(1) as $pr)
      @php
        $colors = [
            ['bg' => 'rgba(245,166,35,.12)', 'color' => '#7A4A00'],
            ['bg' => 'rgba(124,58,237,.09)', 'color' => '#7C3AED'],
            ['bg' => 'rgba(16,140,80,.09)', 'color' => '#108C50'],
            ['bg' => 'rgba(5,150,105,.09)', 'color' => '#065F46'],
            ['bg' => 'rgba(30,80,162,.09)', 'color' => 'var(--blue2)'],
        ];
        $style = $colors[$loop->index % count($colors)];
      @endphp
      <div class="pr-row">
        <div class="pr-row-top"><span class="pr-date-tag">{{ $pr->published_date->format('d M Y') }}</span>
          @if($pr->outlet)
          <span class="pr-cat-tag" style="background:{{ $style['bg'] }};color:{{ $style['color'] }}">{{ $pr->outlet }}</span>
          @endif
        </div>
        <h4>{{ $pr->title }}</h4>
        <p>{{ Str::limit($pr->description, 180) }}</p>
        <div class="pr-row-footer">
          <span style="font-size:11px;color:var(--muted)">
            @if($pr->file_path) PDF @else Text @endif
          </span>
          @if($pr->file_path)
          <a href="{{ asset('storage/' . $pr->file_path) }}" download class="pr-read-link" style="text-decoration:none;">Download Release <i class="fas fa-download" style="font-size:10px"></i></a>
          @elseif($pr->url)
          <a href="{{ $pr->url }}" target="_blank" class="pr-read-link" style="text-decoration:none;">Read Full Release <i class="fas fa-arrow-right" style="font-size:10px"></i></a>
          @endif
        </div>
      </div>
    @empty
      <div style="text-align:center;padding:40px;color:var(--muted)">No press releases available at the moment.</div>
    @endforelse
  </div>

  <div class="cta-band-red">
    <div class="cta-band-text"><h3>Media Enquiries</h3><p>Journalists and media professionals can reach PACT's PRO directly for interviews, statements, or additional information.</p></div>
    <div class="cta-band-btns">
      <a href="mailto:media@pact.org.in" class="btn-white"><i class="fas fa-envelope"></i> media@pact.org.in</a>
      <a href="media-kit.html" class="btn-ghost-dark"><i class="fas fa-briefcase"></i> Media Kit</a>
    </div>
  </div>

</div>

@endsection
