@extends('layouts.frontend')
@section('title') Photo Gallery – P A C T Punjab & Chandigarh @endsection

@section('content')
<style>
.album-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:22px;margin-bottom:80px}
.album-card{border-radius:18px;overflow:hidden;cursor:pointer;position:relative;
  aspect-ratio:4/3;display:flex;align-items:center;justify-content:center;font-size:64px;
  transition:transform .3s;border:1px solid var(--border);background:#fff;background-size:cover;background-position:center;}
.album-card:hover{transform:scale(1.02);box-shadow:var(--card-shadow-hover)}
.album-overlay{position:absolute;inset:0;background:linear-gradient(to top,rgba(7,17,31,.9) 0%,transparent 50%);
  opacity:0;transition:opacity .3s;display:flex;flex-direction:column;justify-content:flex-end;padding:22px}
.album-card:hover .album-overlay{opacity:1}
.album-cat{font-size:10px;font-weight:700;color:var(--gold2);letter-spacing:1.5px;text-transform:uppercase;margin-bottom:6px}
.album-title{font-size:15px;font-weight:800;color:#fff;line-height:1.3}
.album-count{font-size:11px;color:rgba(255,255,255,.5);margin-top:4px}
.album-card-wide{grid-column:span 2}
.album-card-tall{grid-row:span 2}

/* Lightbox */
.lightbox{display:none;position:fixed;inset:0;background:rgba(7,17,31,.95);z-index:2000;
  align-items:center;justify-content:center;flex-direction:column;gap:20px}
.lightbox.open{display:flex}
.lb-close{position:absolute;top:20px;right:24px;width:40px;height:40px;border-radius:10px;
  background:rgba(255,255,255,.1);border:none;color:#fff;font-size:18px;cursor:pointer;
  display:flex;align-items:center;justify-content:center;}
.lb-content{background:rgba(255,255,255,.06);border-radius:16px;padding:20px;font-size:80px;
  border:1px solid rgba(255,255,255,.1); display:flex; align-items:center; justify-content:center;}
.lb-content img { max-height:60vh; max-width:90vw; border-radius:8px; display:block; object-fit:contain; }
.lb-caption{font-size:15px;font-weight:700;color:#fff;text-align:center}
.lb-sub{font-size:12px;color:rgba(255,255,255,.4);margin-top:4px;text-align:center}
.lb-nav{display:flex;gap:12px;margin-top:8px}
.lb-nav-btn{padding:9px 20px;border-radius:20px;border:1.5px solid rgba(255,255,255,.2);
  background:transparent;color:#fff;font-family:'Poppins',sans-serif;font-size:13px;cursor:pointer;transition:all .2s}
.lb-nav-btn:hover{background:rgba(255,255,255,.1)}

@media(max-width:900px){.album-grid{grid-template-columns:1fr 1fr}.album-card-wide{grid-column:span 1}}
@media(max-width:600px){.album-grid{grid-template-columns:1fr}}
</style>

<div class="page-hero">
  <div class="hero-glow"></div><div class="hero-glow2"></div>
  <div class="page-hero-inner">
    <div class="breadcrumb">
      <a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a><i class="fas fa-chevron-right"></i>
      <a href="#">Activities</a><i class="fas fa-chevron-right"></i>
      <span class="active">Photo Gallery</span>
    </div>
    <div class="page-hero-tag"><span>Activities</span></div>
    <h1>Photo <span>Gallery</span></h1>
    <p>Moments and memories from PACT events — AGMs, sports days, fellowship meets, CSR drives, seminars, and award nights across Punjab & Chandigarh.</p>
    <div class="hero-chips">
      <div class="hero-chip"><i class="fas fa-images"></i> 500+ Photos</div>
      <div class="hero-chip"><i class="fas fa-calendar-alt"></i> All Events</div>
      <div class="hero-chip"><i class="fas fa-video"></i> Event Videos</div>
    </div>
  </div>
</div>
<div class="page-body">
  <div class="eyebrow">Our Moments</div>
  <h2 class="sec-title" style="margin-bottom:10px">Events <span class="hl">Gallery</span></h2>
  <p class="sec-sub">Click any album to explore photos from that event.</p>

  <div class="album-grid">
    @forelse($albums as $album)
      @php
         $firstImage = $album->images->first();
         $bgImage = $firstImage ? asset('storage/' . $firstImage->file_path) : '';
         $imagesJson = $album->images->map(function($img) {
            return ['src' => asset('storage/' . $img->file_path), 'title' => $img->title];
         })->toJson();
      @endphp
      <div class="album-card" 
           style="background: {{ $bgImage ? 'url('.$bgImage.')' : 'linear-gradient(135deg,#0C2F5E,#1A3C6E)' }}; background-size: cover; background-position: center;"
           onclick="openAlbumLightbox({{ $imagesJson }}, '{{ $album->title }}')">
        @if(!$bgImage)
          📸
        @endif
        <div class="album-overlay">
          <div class="album-cat">{{ $album->category ?? 'Album' }}</div>
          <div class="album-title">{{ $album->title }}</div>
          <div class="album-count">{{ $album->images->count() }} photos</div>
        </div>
      </div>
    @empty
      <p>No albums available at the moment.</p>
    @endforelse
  </div>

  <div class="cta-band-red">
    <div class="cta-band-text">
      <h3>Share Your PACT Moments</h3>
      <p>Members can submit event photos for inclusion in the official PACT gallery. Send your photos to media@pact.org.in.</p>
    </div>
    <div class="cta-band-btns">
      <a href="mailto:media@pact.org.in" class="btn-white"><i class="fas fa-camera"></i> Submit Photos</a>
      <a href="{{ route('events') }}" class="btn-ghost-dark"><i class="fas fa-calendar-alt"></i> Upcoming Events</a>
    </div>
  </div>
</div>

<!-- Lightbox -->
<div class="lightbox" id="lightbox" onclick="closeLb(event)">
  <button class="lb-close" onclick="closeLb(event)"><i class="fas fa-xmark"></i></button>
  <div class="lb-content" id="lbContent">📸</div>
  <div class="lb-caption" id="lbCaption">—</div>
  <div class="lb-sub" id="lbSub">—</div>
  <div class="lb-nav">
    <button class="lb-nav-btn" onclick="prevImg(event)"><i class="fas fa-chevron-left"></i> Previous</button>
    <button class="lb-nav-btn" onclick="nextImg(event)">Next <i class="fas fa-chevron-right"></i></button>
  </div>
</div>

<script>
let currentAlbumImages = [];
let currentImageIndex = 0;

function openAlbumLightbox(images, albumTitle) {
  if (!images || images.length === 0) {
    alert("No images in this album yet.");
    return;
  }
  currentAlbumImages = images;
  currentImageIndex = 0;
  
  document.getElementById('lbSub').textContent = "Album: " + albumTitle;
  showImage(0);
  
  document.getElementById('lightbox').classList.add('open');
  event.stopPropagation();
}

function showImage(index) {
  const imgData = currentAlbumImages[index];
  document.getElementById('lbContent').innerHTML = `<img src="${imgData.src}" alt="${imgData.title}" />`;
  document.getElementById('lbCaption').textContent = imgData.title || `Photo ${index + 1} of ${currentAlbumImages.length}`;
}

function prevImg(e) {
  if (e) e.stopPropagation();
  currentImageIndex = (currentImageIndex - 1 + currentAlbumImages.length) % currentAlbumImages.length;
  showImage(currentImageIndex);
}

function nextImg(e) {
  if (e) e.stopPropagation();
  currentImageIndex = (currentImageIndex + 1) % currentAlbumImages.length;
  showImage(currentImageIndex);
}

function closeLb(e) { 
  if (e && e.target !== document.getElementById('lightbox') && e.target !== document.querySelector('.lb-close') && e.target !== document.querySelector('.lb-close i')) return;
  document.getElementById('lightbox').classList.remove('open'); 
}
</script>
@endsection
