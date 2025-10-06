@extends('layouts.app')

@section('title', isset($metadata->name) ? $metadata->name : '')
@section('meta_title', isset($metadata->name) ? $metadata->name : '')
@section('meta_description', isset($metadata->description) ? $metadata->description : '')
@section('meta_image', isset($metadata->feature_image) ? asset('images/products/' . $metadata->feature_image) : '')

@section('content')

@php
    $profile = \App\Models\CompanyDetail::select('company_name', 'position', 'about_us','about_us_eng','logo')->first();
    $banner = asset('banner.jpg');
@endphp



  <style>
    /* Section wrapper */
    .carousel-section{ padding: 48px 0; }

    /* Card style that holds each slide */
    .carousel-card{
      border-radius: 18px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(44,52,71,0.08);
      background: linear-gradient(180deg, rgba(255,255,255,0.9), rgba(250,251,255,0.9));
    }

    /* Left image column - uses background-image for desktop */
    .slide-image{
      min-height: 420px;
      background-size: cover;
      background-position: center;
      position: relative;
    }
    .slide-image::after{
      /* subtle gradient overlay to improve text contrast */
      content: "";
      position: absolute;
      inset: 0;
      background: linear-gradient(180deg, rgba(0,0,0,0.06), rgba(0,0,0,0.06));
      pointer-events: none;
    }

    /* Mobile image (img tag) visible only on small screens */
    .mobile-slide-img{ display: none; }

    /* Right description column */
    .desc-content{
      padding: 36px 40px;
      min-height: 420px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      transition: transform 0.5s ease, opacity 0.5s ease;
      opacity: 0; transform: translateY(18px);
    }
    .carousel-item.active .desc-content{ opacity: 1; transform: translateY(0); }

    .slide-title{ font-size: 1.5rem; font-weight: 700; margin-bottom: 8px; }
    .slide-sub{ color: var(--muted); margin-bottom: 18px; }

    .feature-list{ gap: 14px; }
    .feature-item{ display:flex; gap:12px; align-items:flex-start; }
    .feature-item .bi{ font-size: 1.2rem; margin-top:4px; }

    .btn-cta{ border-radius: 10px; padding: 10px 18px; }


    /* Indicators smaller and placed left */
    .carousel-indicators{ bottom: 18px; }
    .carousel-indicators [data-bs-target]{ width: 10px; height: 10px; border-radius: 50%; }

    /* Responsive tweaks */
    @media (max-width: 767.98px){
      .slide-image{ min-height: 220px; }
      .desc-content{ padding: 20px; min-height: auto; }
      .mobile-slide-img{ display: block; width: 100%; height: auto; object-fit: cover; }
    }
  </style>

<style>
  /* ================== Book Slider ================== */
    #bookSlider .carousel-inner .carousel-item { padding: 1.25rem 0; }
    #bookSlider .carousel-book {
      text-align: center;
      padding: 0.65rem;
      width: 280px;
    }
    .carousel-book a{
      text-decoration: none;
      color: inherit;
    }
    #bookSlider .carousel-book img {
      width: 240px;
      height: 310px;
      object-fit: cover;
      border-radius: 6px;
      display: block;
      margin: 0 auto 0.6rem;
    }
    #bookSlider .book-title {
      font-weight: 700;
      font-size: .95rem;
      margin: 0;
    }
    #bookSlider .book-price {
      color: #666;
      font-size: .9rem;
      margin: 0.15rem 0 0;
    }

    /* Mobile horizontal scroll */
    .books-scroll {
      display: flex;
      gap: 1rem;
      overflow-x: auto;
      padding: 12px 8px;
      -webkit-overflow-scrolling: touch;
    }
    .books-scroll .carousel-book {
      flex: 0 0 auto;
      width: 140px;
    }

    /* Hide/show responsive */
    @media (max-width: 767.98px) {
      #bookSlider { display: none !important; }
      .books-scroll { display: flex; }
    }
    @media (min-width: 768px) {
      .books-scroll { display: none; }
    }

</style>



<div id="slider" class="carousel slide" data-bs-ride="carousel" aria-label="Hero carousel">
  <div class="carousel-inner">
    {{-- Slide 1 --}}
    <div class="carousel-item ">
      <div class="carousel-item-bg" style="background-image: url('{{ $banner }}');"></div>
      <img class="hero-img d-block d-md-none" src="{{ $banner }}" alt="Banner image">
      <div class="bio" role="region" aria-label="Company bio">
        <h4>{{ $profile->company_name ?? 'Your Name' }}</h4>
        <div class="bio-content">{!! $profile->about_us ?? '' !!}</div>
      </div>

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

<div class="container section-container" id="online-articles-section">
  <!-- Online Articles Section -->
  <h2 class="section-title">Books</h2>


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

  </div>

  
</div>

<!-- ================== Books Carousel ================== -->
<div class="container section-container" id="books-carousel-section">
  <h2 class="section-title">Featured Poetry</h2>

  <!-- Desktop Carousel -->
  <div id="bookSlider"
       class="carousel slide d-none d-md-block"
       data-bs-ride="carousel"
       data-bs-interval="3500"  
       data-bs-pause="hover">    
    <div class="carousel-inner">

      @foreach ($poetries->chunk(4) as $chunkIndex => $chunk)
        <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
          <div class="d-flex justify-content-center flex-wrap">
            @foreach ($chunk as $poetry)
              <div class="carousel-book">
                <img loading="lazy"
                     src="{{ asset('images/products/' . $poetry->feature_image) }}"
                     alt="{{ $poetry->name }}">
                <a href="{{ route('poetries.show', $poetry->slug) }}">
                  <p class="book-title">{{ $poetry->name }}</p>
                </a>
              </div>
            @endforeach
          </div>
        </div>
      @endforeach

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#bookSlider" data-bs-slide="prev">
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#bookSlider" data-bs-slide="next">
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <!-- Mobile Horizontal Scroll -->
  <div class="books-scroll d-md-none">
    @foreach ($books as $book)
      <div class="carousel-book">
        <img loading="lazy"
             src="{{ asset('images/products/' . $book->feature_image) }}"
             alt="{{ $book->name }}">
        <a href="{{ route('book.bookDetails', $book->slug) }}">
          <p class="book-title">{{ $book->name }}</p>
        </a>
        @if(!empty($book->price))
          <p class="book-price">${{ $book->price }}</p>
        @endif
      </div>
    @endforeach
  </div>
</div>




  <section class="carousel-section">
    <div class="container">
      <div class="carousel-card">
        <div id="twoColCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="6000" data-bs-keyboard="true" aria-label="Two column feature carousel">



          <div class="carousel-inner">

            @foreach ($events as $key =>  $event)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                  <div class="row g-0 align-items-stretch">
                    <div class="col-md-6 order-md-1">
                      <div class="slide-image" role="img" aria-label="{{ $event->name }}" style="background-image: url({{ asset('images/products/' . $event->feature_image) }});"></div>
                      <img src="{{ asset('images/products/' . $event->feature_image) }}" alt="{{ $event->name }}" class="mobile-slide-img d-block d-md-none">
                    </div>
                    <div class="col-md-6">
                      <div class="desc-content">
                        <div>
                          <h3 class="slide-title">{{ $event->name }}</h3>
                          <p class="slide-sub">{!! $event->short_description !!}</p>

                          <div class="mt-3">
                            <a href="{{route('eventsDetails', $event->slug)}}" class="btn btn-outline-secondary btn-cta">See more</a>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
            @endforeach

            <!-- Slide 2 -->
            

            <!-- Slide 3 -->
            <div class="carousel-item d-none">
              <div class="row g-0 align-items-stretch">
                <div class="col-md-6">
                  <div class="slide-image" role="img" aria-label="Cozy cafe scene" style="background-image: url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=1400&auto=format&fit=crop');"></div>
                  <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=800&auto=format&fit=crop" alt="Cafe" class="mobile-slide-img d-block d-md-none">
                </div>
                <div class="col-md-6">
                  <div class="desc-content">
                    <div>
                      <h3 class="slide-title">Elevate your everyday rituals</h3>
                      <p class="slide-sub">Tools and tastes to help make daily routines calmer, richer, and more intentional.</p>

                      <div class="mt-3">
                        <a href="#" class="btn btn-outline-secondary btn-cta">Gift guide</a>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>

          </div>


        </div>
      </div>
    </div>
  </section>




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

<script>
document.addEventListener('DOMContentLoaded', function () {
  const bookSlider = document.querySelector('#bookSlider');
  if (bookSlider) {
    const carousel = new bootstrap.Carousel(bookSlider, {
      interval: 3500,  // autoplay speed
      pause: 'hover',  // pause on hover
      ride: 'carousel'
    });
  }
});
</script>

  <script>
    // Small enhancements using jQuery: reset / animate description content on slide change
    (function($){
      $(function(){
        var carouselEl = $('#twoColCarousel');

        // When slide starts changing, hide the description quickly so the incoming one can animate in
        carouselEl.on('slide.bs.carousel', function(){
          $('.desc-content').css({ opacity: 0, transform: 'translateY(18px)' });
        });

        // After slide has changed, allow CSS to animate in the new active description
        carouselEl.on('slid.bs.carousel', function(){
          // small timeout so that the class is applied after bootstrap's internal changes
          setTimeout(function(){
            $('.carousel-item.active .desc-content').css({ opacity: 1, transform: 'translateY(0)' });
          }, 50);
        });

        // Accessibility: make indicators keyboard-focus friendly
        $('.carousel-indicators button').on('keydown', function(e){
          if(e.key === 'Enter' || e.key === ' '){ e.preventDefault(); $(this).trigger('click'); }
        });

        // Pause on hover (Bootstrap supports data-bs-pause, but we implement explicitly for reliability)
        carouselEl.hover(function(){
          carouselEl.carousel('pause');
        }, function(){
          carouselEl.carousel('cycle');
        });

      });
    })(jQuery);
  </script>
@endsection
