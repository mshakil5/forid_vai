@extends('layouts.app')

@section('content')
<style>
  /* ========== Variables ========== */
  :root{
    --slider-height-desktop: 582px;   /* desktop carousel height */
    --slider-height-tablet: 520px;
    --bio-width-desktop: 38%;
    --bio-bg-desktop: rgba(0,0,0,0.45);
    --bio-padding: 1.25rem;
    --bio-radius: 12px;

    /* Mobile preview height for collapsed bio (adjust if you want more preview) */
    --bio-mobile-preview-height: 120px;
  }

  /* ========== Base slider ========== */
  #slider{
    position: relative;
    overflow: hidden;
  }
  .carousel-inner, .carousel-item { width: 100%; }

  /* Desktop/tabled fixed-height area (so overlay sits at center) */
  @media (min-width: 768px) {
    #slider { height: var(--slider-height-desktop); }
    @media (min-width: 992px) {
      #slider { height: var(--slider-height-desktop); }
    }
  }

  /* ========== Carousel item background for md+ (desktop) ========== */
  .carousel-item-bg {
    display: none; /* only used on md+ as background */
  }
  @media (min-width: 768px) {
    .carousel-item-bg {
      display: block;
      position: absolute;
      inset: 0;
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center center;
      z-index: 0;
    }
    .carousel-inner, .carousel-item { height: 100%; }
  }

  /* ========== Hero image for mobile: show full image (uncropped) ========== */
  .hero-img {
    width: 100%;
    height: auto;
    display: block;
    object-fit: contain; /* keep full image visible */
  }
  @media (min-width: 768px) {
    .hero-img { display: none; } /* hide on md+ (we use background image there) */
  }

  /* ========== Desktop Bio overlay (right, vertically centered) ========== */
  .bio {
    display: none; /* only desktop/tablet overlay */
  }
  @media (min-width: 768px) {
    .bio {
      display: block;
      position: absolute;
      top: 50%;
      right: 5%;
      transform: translateY(-50%);
      width: var(--bio-width-desktop);
      background: var(--bio-bg-desktop);
      color: #fff;
      padding: var(--bio-padding);
      border-radius: var(--bio-radius);
      z-index: 5;
      box-shadow: 0 6px 18px rgba(0,0,0,0.35);

      /* scrolling if long */
      max-height: calc(var(--slider-height-desktop) - 60px);
      overflow-y: auto;
    }
  }

  .bio h4 { margin: 0 0 0.5rem; font-weight:700; font-size:1.25rem; }
  .bio .bio-content { margin: 0; line-height: 1.55; white-space: pre-wrap; }

  /* subtle scrollbar */
  .bio::-webkit-scrollbar { width: 8px; }
  .bio::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.14); border-radius:8px; }

  /* ========== Mobile bio (below image) ========== */
  .bio-mobile {
    display: block;
    background: rgba(0,0,0,0.65);
    color: #fff;
    padding: 1rem;
    border-radius: 12px 12px 8px 8px;
    margin: 12px 12px 20px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.25);
    line-height: 1.5;
  }

  /* Collapsed preview state with gradient fade */
  .bio-mobile .preview {
    max-height: var(--bio-mobile-preview-height);
    overflow: hidden;
    position: relative;
    transition: max-height .28s ease;
    white-space: pre-wrap;
  }
  .bio-mobile .preview::after{
    content: "";
    position: absolute;
    left: 0; right: 0; bottom: 0;
    height: 3.4rem;
    background: linear-gradient(to bottom, rgba(0,0,0,0), rgba(0,0,0,0.66));
    pointer-events: none;
  }
  .bio-mobile.expanded .preview {
    max-height: none;
  }
  .bio-mobile.expanded .preview::after { display: none; }

  .bio-mobile .actions {
    margin-top: 0.6rem;
    display:flex;
    gap:.5rem;
    align-items:center;
  }
  .btn-see {
    background: transparent;
    border: 1px solid rgba(255,255,255,0.14);
    color: #fff;
    padding: .35rem .7rem;
    border-radius: 999px;
    cursor: pointer;
    font-weight: 600;
  }

  /* Hide mobile bio on md+ (desktop shows overlay) */
  @media (min-width: 768px) {
    .bio-mobile { display: none; }
  }

  /* ========== Slight responsive tweaks ========== */
  @media (max-width: 576px) {
    :root { --bio-mobile-preview-height: 110px; }
    .bio-mobile { margin: 10px; padding: 0.9rem; border-radius: 10px; }
  }

  /* carousel controls stacking */
  .carousel-control-prev, .carousel-control-next {
    z-index: 6; /* above desktop overlay */
  }
</style>

@php
    $profile = \App\Models\CompanyDetail::select('company_name', 'position', 'about_us','about_us_eng','logo')->first();
    $banner = asset('banner.jpg'); /* replace with dynamic if you store banner path in DB */
@endphp

<div id="slider" class="carousel slide" data-bs-ride="carousel" aria-label="Hero carousel">
  <div class="carousel-inner">
    {{-- Slide 1 --}}
    <div class="carousel-item active">
      {{-- Background for md+ (absolute fill) --}}
      <div class="carousel-item-bg" style="background-image: url('{{ $banner }}');"></div>

      {{-- Mobile: show full image so it's never cropped --}}
      <img class="hero-img d-block d-md-none" src="{{ $banner }}" alt="Banner image">

      {{-- Desktop overlay (right-middle) --}}
      <div class="bio" role="region" aria-label="Company bio">
        <h4>{{ $profile->company_name ?? 'Your Name' }}</h4>
        <div class="bio-content">{!! $profile->about_us ?? '' !!}</div>
      </div>

      {{-- Mobile block below image (provides collapsed preview + see more) --}}
      <div class="bio-mobile d-md-none" id="bio-mobile-1" aria-live="polite">
        <h4 style="margin:0 0 .4rem;">{{ $profile->company_name ?? 'Your Name' }}</h4>
        <div class="preview">{!! $profile->about_us ?? '' !!}</div>
        <div class="actions">
          <button class="btn-see" data-target="#bio-mobile-1" aria-expanded="false">See more</button>
        </div>
      </div>
    </div>

    {{-- Slide 2: English about (same banner) --}}
    <div class="carousel-item">
      <div class="carousel-item-bg" style="background-image: url('{{ $banner }}');"></div>
      <img class="hero-img d-block d-md-none" src="{{ $banner }}" alt="Banner image">

      <div class="bio" role="region" aria-label="Company bio english">
        <h4>{{ $profile->company_name ?? 'Your Name' }}</h4>
        <div class="bio-content">{!! $profile->about_us_eng ?? $profile->about_us ?? '' !!}</div>
      </div>

      <div class="bio-mobile d-md-none" id="bio-mobile-2" aria-live="polite">
        <h4 style="margin:0 0 .4rem;">{{ $profile->company_name ?? 'Your Name' }}</h4>
        <div class="preview">{!! $profile->about_us_eng ?? $profile->about_us ?? '' !!}</div>
        <div class="actions">
          <button class="btn-see" data-target="#bio-mobile-2" aria-expanded="false">See more</button>
        </div>
      </div>
    </div>
  </div>

  {{-- Controls --}}
  <button class="carousel-control-prev" type="button" data-bs-target="#slider" data-bs-slide="prev" aria-label="Previous slide">
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#slider" data-bs-slide="next" aria-label="Next slide">
    <span class="visually-hidden">Next</span>
  </button>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  (function($){
    $(document).ready(function(){
      // mobile "See more" toggle (expands/collapses preview)
      $('.btn-see').on('click', function(){
        var btn = $(this);
        var target = $(btn.data('target'));
        var expanded = btn.attr('aria-expanded') === 'true';

        if(!expanded){
          target.addClass('expanded');
          btn.text('See less');
          btn.attr('aria-expanded', 'true');
        } else {
          target.removeClass('expanded');
          btn.text('See more');
          btn.attr('aria-expanded', 'false');

          // scroll a bit to make sure user sees the top of the collapsed block (nice UX)
          $('html,body').animate({ scrollTop: target.offset().top - 12 }, 300);
        }
      });

      // Optional: pause carousel when user interacts with the mobile bio to avoid accidental slide changes.
      $('.bio-mobile, .btn-see').on('touchstart click', function(e){
        $('#slider').carousel('pause');
      });

      // When sliding, ensure any expanded mobile bio collapses
      $('#slider').on('slide.bs.carousel', function () {
        $('.bio-mobile.expanded').removeClass('expanded').find('.btn-see').text('See more').attr('aria-expanded','false');
      });
    });
  })(jQuery);
</script>
@endsection
