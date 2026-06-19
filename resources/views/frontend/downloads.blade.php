@extends('layouts.frontend')
@section('title') Downloads – P A C T Punjab & Chandigarh @endsection

@section('content')
<style>
/* ── CATEGORY TABS ── */
.dl-cat-tabs{display:flex;gap:10px;flex-wrap:wrap;margin-bottom:36px}
.dl-tab{padding:10px 20px;border-radius:25px;font-size:13px;font-weight:600;
  border:1.5px solid var(--border);color:var(--muted);background:#fff;
  cursor:pointer;transition:all .2s;font-family:var(--font);
  display:flex;align-items:center;gap:8px;}
.dl-tab:hover{border-color:var(--blue2);color:var(--blue2)}
.dl-tab.active{background:var(--navy);border-color:var(--navy);color:var(--gold2)}
.dl-tab-count{background:rgba(255,255,255,.15);color:inherit;
  padding:1px 7px;border-radius:20px;font-size:10px;font-weight:700}
.dl-tab:not(.active) .dl-tab-count{background:var(--light);color:var(--muted)}

/* ── DOWNLOAD CARDS ── */
.dl-section{margin-bottom:60px}
.dl-section-title{font-size:13px;font-weight:800;color:var(--navy);
  text-transform:uppercase;letter-spacing:1.5px;margin-bottom:20px;
  display:flex;align-items:center;gap:10px;}
.dl-section-title::after{content:'';flex:1;height:1px;
  background:linear-gradient(90deg,var(--border),transparent)}
.dl-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:18px}
.dl-card{
  background:#fff;border:1px solid var(--border);border-radius:16px;
  padding:22px 20px;display:flex;align-items:flex-start;gap:14px;
  transition:box-shadow .2s,transform .2s;
}
.dl-card:hover{box-shadow:var(--card-shadow);transform:translateY(-3px)}
.dl-file-ico{
  width:48px;height:48px;border-radius:12px;
  display:flex;align-items:center;justify-content:center;
  font-size:22px;flex-shrink:0;
}
.dl-card-info{flex:1;min-width:0}
.dl-card-info h5{font-size:13px;font-weight:700;color:var(--navy);
  margin-bottom:3px;line-height:1.35;}
.dl-card-info p{font-size:11px;color:var(--muted);margin-bottom:8px;line-height:1.5}
.dl-card-meta{display:flex;gap:10px;align-items:center;flex-wrap:wrap}
.dl-meta-tag{font-size:10px;font-weight:600;padding:2px 8px;
  border-radius:20px;background:var(--light);color:var(--muted);
  border:1px solid var(--border)}
.dl-btn{
  flex-shrink:0;width:36px;height:36px;border-radius:10px;
  background:var(--navy);color:var(--gold2);border:none;
  cursor:pointer;display:flex;align-items:center;justify-content:center;
  font-size:14px;transition:all .2s;align-self:center;
}
.dl-btn:hover{background:var(--blue2);color:#fff;transform:translateY(-1px)}

/* ── STATS BAND ── */
.dl-stats{
  background:var(--light);border-radius:22px;padding:36px 44px;
  display:flex;align-items:center;justify-content:space-around;
  gap:20px;flex-wrap:wrap;margin-bottom:80px;
}
.dl-stat{text-align:center}
.dl-stat .n{font-size:32px;font-weight:900;color:var(--blue2);line-height:1}
.dl-stat .l{font-size:11px;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.8px;margin-top:4px}

/* ── REQUEST BAND ── */
.request-band{
  background:var(--navy2);border-radius:22px;padding:44px 48px;
  display:flex;align-items:center;justify-content:space-between;
  gap:32px;flex-wrap:wrap;margin-bottom:80px;
}
.req-text h3{font-size:20px;font-weight:800;color:#fff;margin-bottom:6px}
.req-text p{font-size:14px;color:rgba(255,255,255,.5);max-width:480px;line-height:1.7}

@media(max-width:1100px){.dl-grid{grid-template-columns:1fr 1fr}}
@media(max-width:700px){.dl-grid{grid-template-columns:1fr}.request-band{flex-direction:column;align-items:flex-start;padding:32px 24px}}
</style>

<div class="page-hero">
  <div class="hero-glow"></div><div class="hero-glow2"></div>
  <div class="page-hero-inner">
    <div class="breadcrumb">
      <a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a><i class="fas fa-chevron-right"></i>
      <a href="#">Members</a><i class="fas fa-chevron-right"></i>
      <span class="active">Downloads</span>
    </div>
    <div class="page-hero-tag"><span>Members</span></div>
    <h1>Member <span>Downloads</span></h1>
    <p>All PACT resources in one place — forms, circulars, annual reports, certificates, guidelines, and press kits available for instant download.</p>
    <div class="hero-chips">
      <div class="hero-chip"><i class="fas fa-download"></i> 50+ Resources</div>
      <div class="hero-chip"><i class="fas fa-file-pdf"></i> PDF & Word</div>
      <div class="hero-chip"><i class="fas fa-lock-open"></i> Free for Members</div>
    </div>
  </div>
</div>

<div class="page-body">

  <!-- STATS -->
  <div class="dl-stats">
    <div class="dl-stat"><div class="n">{{ $downloads->count() }}</div><div class="l">Total Files</div></div>
    @php
      $cats = $downloads->pluck('category')->filter()->countBy();
    @endphp
    @foreach($cats as $catName => $count)
    <div class="dl-stat"><div class="n">{{ $count }}</div><div class="l">{{ $catName }}</div></div>
    @endforeach
  </div>

  <!-- ALL DOWNLOADS SECTION -->
  <div class="dl-section" data-cat="forms">
    <div class="dl-section-title"><i class="fas fa-file-alt" style="color:var(--blue2)"></i> Downloads</div>
    <div class="dl-grid">
      @forelse($downloads as $download)
      <div class="dl-card">
        <div class="dl-file-ico ico-box blue lg"><i class="fas fa-file-download"></i></div>
        <div class="dl-card-info">
          <h5>{{ $download->title }}</h5>
          <p>{{ $download->category ?? 'General' }}</p>
          <div class="dl-card-meta">
            <span class="dl-meta-tag">{{ strtoupper(pathinfo($download->file_path, PATHINFO_EXTENSION)) }}</span>
            <span class="dl-meta-tag">{{ $download->created_at->format('M Y') }}</span>
          </div>
        </div>
        <a href="{{ asset('storage/' . $download->file_path) }}" download class="dl-btn"><i class="fas fa-download"></i></a>
      </div>
      @empty
      <p>No downloads available at the moment.</p>
      @endforelse
    </div>
  </div>

  <!-- REQUEST BAND -->
  <div class="request-band">
    <div class="req-text">
      <div class="eyebrow ew-gold2">Can't Find It?</div>
      <h3>Request a Specific Document</h3>
      <p>If you need a document not listed here, contact the PACT Secretariat and we will locate or prepare it for you within 2 working days.</p>
    </div>
    <div class="btn-group">
      <a href="#" class="btn-gold"><i class="fas fa-paper-plane"></i> Request a Document</a>
      <a href="#" class="btn-ghost-dark"><i class="fas fa-bell"></i> View Circulars</a>
    </div>
  </div>

</div>
@endsection
