@extends('layouts.app')

@section('content')


@php
    $profile = \App\Models\CompanyDetail::select('company_name', 'position', 'about_us','about_us_eng','logo')->first();
    $banner = asset('banner.jpg'); /* replace with dynamic if you store banner path in DB */
@endphp

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
