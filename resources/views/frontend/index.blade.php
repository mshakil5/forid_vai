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
    <div class="carousel-item ">
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
    <div class="carousel-item active">
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












<!-- ARTICLES & BOOKS SECTION - paste AFTER your slider -->
<style>
  /* section styles */
  .section-title {
    font-weight: 800;
    font-size: 1.25rem;
    letter-spacing: .02em;
    margin: 2.25rem 0 1rem;
    text-align: center;
  }

  /* Tabs & mobile categories */
  #mobile-categories { margin-bottom: 1rem; }
  #mobile-categories .list-group-item { cursor: pointer; }
  .category-tag {
    display: inline-block;
    font-size: .75rem;
    background: rgba(0,0,0,0.06);
    color: #333;
    padding: .18rem .5rem;
    border-radius: 10px;
    margin-bottom: .45rem;
    font-weight: 600;
  }

  /* Article cards */
  .article-card .card {
    border: 0;
    border-radius: .5rem;
    overflow: hidden;
    box-shadow: 0 6px 18px rgba(12, 18, 26, 0.06);
    transition: transform .18s ease, box-shadow .18s ease;
    height: 100%;
  }
  .article-card .card:hover { transform: translateY(-6px); box-shadow: 0 10px 30px rgba(12,18,26,0.12); }

  .article-card .card-img-top {
    height: 160px;
    object-fit: cover;
    width: 100%;
    display: block;
  }
  @media (max-width: 576px) {
    .article-card .card-img-top { height: 200px; } /* make image taller on extra-small for visual */
  }

  .article-title { font-size: 1rem; margin: 0.25rem 0; font-weight:700; }
  .article-date { color:#666; font-size:.85rem; margin:0; }

  /* hide/show animation */
  .article-card { transition: opacity .18s ease, transform .18s ease; }
  .article-card.hidden { opacity: 0; pointer-events: none; transform: scale(.995); display: none; }
  .article-card a{ text-decoration: none; color: inherit; }

  /* Pagination styling (centered already by Bootstrap) */
  .pagination .page-link { border-radius: .35rem; }

  /* Books carousel / list */
  .carousel-book { text-align:center; padding: 0.65rem; }
  .carousel-book img { width: 140px; height: 210px; object-fit: cover; border-radius: 6px; display:block; margin: 0 auto 0.6rem; }
  .book-title { font-weight:700; font-size:.95rem; margin:0; }
  .book-price { color:#666; font-size:.9rem; margin:0.15rem 0 0; }

  /* Desktop: show carousel (slides contain multiple .carousel-book) */
  #bookCarousel .carousel-inner .carousel-item { padding: 1.25rem 0; }
  #bookCarousel .carousel-book { width: 180px; }

  /* Mobile books: horizontal scroller (visible only on small screens) */
  .books-scroll { display:flex; gap:1rem; overflow-x:auto; padding: 12px 8px; -webkit-overflow-scrolling: touch; }
  .books-scroll .carousel-book { flex: 0 0 auto; width: 140px; }

  /* Hide desktop carousel on small screens and hide scroller on md+ */
  @media (max-width: 767.98px) {
    #bookCarousel .d-md-block { display:none !important; } /* ensure desktop-style multi-item carousel hidden */
    .books-scroll { display:flex; }
  }
  @media (min-width: 768px) {
    .books-scroll { display:none; }
  }

  /* small tweaks */
  .section-container { padding: 1.25rem 0 3rem; }
  .category-filter.active, .list-group-item.active { background-color:#0d6efd; color:#fff; border-color:#0d6efd; }
</style>

<div class="container section-container" id="online-articles-section">
  <!-- Online Articles Section -->
  <h2 class="section-title">Books</h2>

  <!-- Mobile Categories Toggle (visible only on xs-sm) -->
  {{-- <div id="mobile-categories" class="d-md-none">
    <button class="btn btn-outline-secondary mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#categoriesCollapse" aria-expanded="false" aria-controls="categoriesCollapse">
      Categories
    </button>
    <div class="collapse" id="categoriesCollapse">
      <ul class="list-group">
        <li class="list-group-item active" data-li-category="all">All</li>
        <li class="list-group-item" data-li-category="fiction">Fiction, Poetry & Reviews</li>
        <li class="list-group-item" data-li-category="hidden-japan">Hidden Japan</li>
        <li class="list-group-item" data-li-category="in-translation">In Translation</li>
        <li class="list-group-item" data-li-category="insights">Insights From Asia</li>
        <li class="list-group-item" data-li-category="our-japan">Our Japan</li>
        <li class="list-group-item" data-li-category="our-kyoto">Our Kyoto</li>
        <li class="list-group-item" data-li-category="tokonoma">Tokonoma</li>
      </ul>
    </div>
  </div> --}}

  <!-- Desktop Tabs (hidden on small) -->
  {{-- <ul class="nav nav-tabs justify-content-center mb-4 d-none d-md-flex flex-wrap">
    <li class="nav-item"><a class="nav-link category-filter active" href="#" data-category="all">All</a></li>
    <li class="nav-item"><a class="nav-link category-filter" href="#" data-category="fiction">Fiction, Poetry & Reviews</a></li>
    <li class="nav-item"><a class="nav-link category-filter" href="#" data-category="hidden-japan">Hidden Japan</a></li>
    <li class="nav-item"><a class="nav-link category-filter" href="#" data-category="in-translation">In Translation</a></li>
    <li class="nav-item"><a class="nav-link category-filter" href="#" data-category="insights">Insights From Asia</a></li>
    <li class="nav-item"><a class="nav-link category-filter" href="#" data-category="our-japan">Our Japan</a></li>
    <li class="nav-item"><a class="nav-link category-filter" href="#" data-category="our-kyoto">Our Kyoto</a></li>
    <li class="nav-item"><a class="nav-link category-filter" href="#" data-category="tokonoma">Tokonoma</a></li>
  </ul> --}}

  <!-- Articles Grid -->
  <div class="row g-3">
    

    @foreach ($books as $book)
        <div class="col-12 col-sm-6 col-md-3 article-card" data-categories="tokonoma">
          <div class="card h-100">
            <img loading="lazy" src="{{ asset('images/products/' . $book->feature_image) }}" alt="{{ $book->name }}" class="card-img-top">
            <div class="card-body">
              <a href="{{ route('book.bookDetails', $book->slug)}}">
                <h5 class="article-title">{{ $book->name }}</h5>
              </a>
            </div>
          </div>
        </div>
    @endforeach





    <!-- add remaining articles in same pattern (loop server-side) -->
  </div>

  <!-- Pagination (static markup; wire up server-side or client-side as needed) -->
  {{-- <nav aria-label="Page navigation" class="mt-4">
    <ul class="pagination justify-content-center">
      <li class="page-item"><a class="page-link" href="#">Previous</a></li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item active"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">Next</a></li>
    </ul>
  </nav> --}}


  
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

<script>
/* Client-side filtering and mobile category UX - vanilla JS */
document.addEventListener('DOMContentLoaded', function () {
  // Filtering from desktop tabs (.category-filter) or mobile list-group-items
  const filters = document.querySelectorAll('.category-filter');
  const listGroupItems = document.querySelectorAll('#categoriesCollapse .list-group-item');
  const articleCards = Array.from(document.querySelectorAll('.article-card'));

  function applyFilter(cat) {
    // normalize
    const category = (cat || 'all').toString().trim();

    // activate desktop tab UI
    document.querySelectorAll('.category-filter').forEach(el => {
      el.classList.toggle('active', el.dataset.category === category);
    });
    // activate mobile list group items
    document.querySelectorAll('#categoriesCollapse .list-group-item').forEach(li => {
      li.classList.toggle('active', li.dataset.liCategory === category);
    });

    // show/hide cards
    if (category === 'all') {
      articleCards.forEach(card => {
        card.style.display = '';
        card.classList.remove('hidden');
      });
    } else {
      articleCards.forEach(card => {
        const cats = (card.dataset.categories || '').split(',').map(s => s.trim());
        if (cats.indexOf(category) !== -1) {
          card.style.display = '';
          card.classList.remove('hidden');
        } else {
          card.style.display = 'none';
          card.classList.add('hidden');
        }
      });
    }

    // collapse mobile categories if open (Bootstrap collapse API)
    const collapseEl = document.getElementById('categoriesCollapse');
    if (collapseEl && collapseEl.classList.contains('show')) {
      try {
        const bsCollapse = bootstrap.Collapse.getInstance(collapseEl) || new bootstrap.Collapse(collapseEl, {toggle:false});
        bsCollapse.hide();
      } catch (e) { /* ignore */ }
    }
  }

  filters.forEach(f => {
    f.addEventListener('click', function (e) {
      e.preventDefault();
      applyFilter(this.dataset.category || 'all');
      // scroll to articles on small screens so user sees results
      if (window.innerWidth < 768) {
        const section = document.getElementById('online-articles-section');
        section && window.scrollTo({ top: section.offsetTop - 12, behavior: 'smooth' });
      }
    });
  });

  listGroupItems.forEach(li => {
    li.addEventListener('click', function () {
      applyFilter(this.dataset.liCategory || 'all');
    });
  });

  // init - show all
  applyFilter('all');

  // Optional: if you want keyboard accessibility for list-group items
  listGroupItems.forEach(li => {
    li.setAttribute('tabindex','0');
    li.addEventListener('keypress', function (e) {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        this.click();
      }
    });
  });
});
</script>
@endsection
