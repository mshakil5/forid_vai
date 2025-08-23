@extends('layouts.app')

@section('content')
<style>
  /* ---- Minimal, focused CSS ---- */
  :root{
    --slider-height: 582px;
    --bio-width-desktop: 38%;
    --bio-bg: rgba(0,0,0,0.45);
    --bio-padding: 1.25rem;
    --bio-radius: 12px;
  }

  /* Slider (make it the positioning context for .bio) */
  #slider{
    position: relative; /* KEY: so .bio absolute positions relative to this */
    height: var(--slider-height);
    background-image: url('{{ asset('banner.jpg') }}');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center center;
    overflow: hidden;
  }

  /* Make carousel fill the slider height */
  .carousel-inner,
  .carousel-item { height: 100%; }

  /* Bio overlay: right side, vertically centered, scrolls when content is big */
  .bio{
    position: absolute;
    top: 50%;
    right: 5%;
    transform: translateY(-50%); /* true vertical centering */
    width: var(--bio-width-desktop);
    background: var(--bio-bg);
    color: #fff;
    padding: var(--bio-padding);
    border-radius: var(--bio-radius);
    z-index: 5;
    box-shadow: 0 6px 18px rgba(0,0,0,0.35);

    /* scrolling when content exceeds space */
    max-height: calc(var(--slider-height) - 60px); /* keep breathing room above/below */
    overflow-y: auto;
  }

  .bio h4 { margin: 0 0 0.5rem; font-weight:700; font-size:1.25rem; }
  .bio .bio-content { margin:0; line-height:1.55; white-space: pre-wrap; }

  /* Small scrollbar styling (optional, subtle) */
  .bio::-webkit-scrollbar { width: 10px; }
  .bio::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.12); border-radius:8px; }
  .bio::-webkit-scrollbar-track { background: transparent; }

  /* Responsive tweaks */
  @media (max-width: 992px) {
    :root { --bio-width-desktop: 50%; --slider-height: 520px; }
    .bio { right:4%; }
    .bio h4 { font-size:1.1rem; }
  }
  @media (max-width: 768px) {
    :root { --bio-width-desktop: 86%; --slider-height: 420px; }
    #slider { height: var(--slider-height); }
    .bio {
      right:2%;
      left:2%;
      width: auto;
      top: 6%;           /* on small screens put it near top for better UX */
      transform: translateY(0);
      max-height: calc(100vh - 120px);
    }
  }
  @media (max-width: 576px) {
    :root { --slider-height: 360px; }
    .bio { top: 5%; padding: 0.9rem; border-radius:10px; }
  }
</style>

@php
    $profile = \App\Models\CompanyDetail::select('company_name', 'position', 'about_us','about_us_eng','logo')->first();
@endphp

<div id="slider" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner home-banner-slider">
        <div class="carousel-item active">
            <!-- the bio overlay -->
            <div class="bio" role="region" aria-label="Company bio">
                <h4>{{ $profile->company_name ?? 'Your Name' }}</h4>
                <p class="bio-content">{!! $profile->about_us ?? '' !!}</p>
            </div>
        </div>
        
        <div class="carousel-item">
            <!-- the bio overlay -->
            <div class="bio" role="region" aria-label="Company bio">
                <h4>{{ $profile->company_name ?? 'Your Name' }}</h4>
                <p class="bio-content">{!! $profile->about_us_eng ?? '' !!}</p>
            </div>
        </div>


    </div>

    <!-- accessible controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#slider" data-bs-slide="prev">
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#slider" data-bs-slide="next">
        <span class="visually-hidden">Next</span>
    </button>
</div>
@endsection

@section('script')
<!-- jquery kept only for optional small behavior (non-essential for bio scroll) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(function(){
    // No JS required for centering or scrolling.
    // If you want "See more" toggles later you can wire them here safely.
  });
</script>
@endsection
