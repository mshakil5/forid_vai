  

  @php
  $profile = \App\Models\CompanyDetail::select('phone1', 'email1', 'facebook','linkedin','footer_content','header_logo','company_name')->first();
  $books = \App\Models\Book::latest()->limit(5)->get();
@endphp
  
  
  <!-- Footer -->
<footer class="footer py-4 mt-5 d-none">
  <div class="container">
    <div class="row text-center text-md-start">
      <div class="col-md-3 footer-item">
        <p class="mb-1 fw-bold">Phone</p>
        <p class="text-muted">{{$profile->phone1}}</p>
      </div>
      <div class="col-md-3 footer-item">
        <p class="mb-1 fw-bold">Email</p>
        <p class="text-muted">{{$profile->email1}}</p>
      </div>
      <div class="col-md-3 footer-item">
        <p class="mb-1 fw-bold">Follow Me</p>

        <!-- Facebook -->
        <i class="fa fa-facebook" style="color: #3b5998;"></i>

        <!-- Twitter -->
        <i class="fa fa-twitter" style="color: #55acee;"></i>


        <!-- Instagram -->
        <i class="fa fa-instagram" style="color: #ac2bac;"></i>

        <!-- youtube -->
        <i class="fa fa-youtube" style="color: #0082ca;"></i>

      </div>
      <div class="col-md-3 text-md-end">
        {{-- <p class="text-muted">&copy; 2035 by Nicol Rider. Powered and secured by Wix</p> --}}
      </div>
    </div>
  </div>
</footer>

<style>
    /* Small custom styles for footer */
    .site-footer { background: #0d1117; color: #d6d8db; }
    .site-footer a { color: #d6d8db; text-decoration: none; }
    .site-footer a:hover { color: #a0d3a2; text-decoration: none; }
    .author-avatar {
      width:72px; height:72px; border-radius:50%; object-fit:cover;
      border: 2px solid rgba(255,255,255,0.08);
    }
    .footer-social a { font-size:1.05rem; margin-right:12px; opacity:0.9; }
    .footer-social a:hover { opacity:1; transform: translateY(-2px); }
    .small-muted { color: rgba(214,216,219,0.7); }
    @media (max-width:575.98px) {
      .footer-col { margin-bottom:1.25rem; }
    }


</style>

<footer class="site-footer mt-auto">
    <div class="container py-5">
      <div class="row g-4">
        <!-- Author / About -->
        <div class="col-12 col-md-6 col-lg-4 footer-col">
          <div class="d-flex align-items-start">
            <img src="{{asset('images/company/'.$profile->header_logo)}}" alt="Author photo" class="author-avatar me-3" />
            <div>
              <h5 class="mb-1">{{$profile->company_name}}</h5>
              <p class="small-muted mb-1">
                {{-- {{$profile->footer_content}} --}}
                Muhammad Farid Hasan (b. 1992, Chandpur, Bangladesh) is a writer, researcher, and journalist with over 12 years of experience in publication and literary editing. He is the author of 31 books published in both India and Bangladesh. His certificate name is Md. Mostafizur Rahaman.
              </p>
              <a href="{{route('homepage')}}" class="btn btn-sm btn-outline-light">About the author</a>
            </div>
          </div>
        </div>

        <!-- Recent posts -->
        <div class="col-6 col-md-3 col-lg-3 footer-col">
          <h6>Recent Story</h6>
          <ul class="list-unstyled small">
            @foreach ($books as $book)
            <li><a href="{{ route('book.bookDetails', $book->slug)}}">{{ $book->name }}</a></li>
            @endforeach

          </ul>
        </div>

        <!-- Quick links / sitemap -->
        <div class="col-6 col-md-3 col-lg-3 footer-col">
          <h6>Quick links</h6>
          <ul class="list-unstyled small">
            <li><a href="{{route('essay')}}">Essay</a></li>
            <li><a href="{{route('research')}}">Research</a></li>
            <li><a href="{{route('stories')}}">Stories</a></li>
            <li><a href="{{route('poetries')}}">Poetry</a></li>
            <li><a href="{{route('book')}}">Book</a></li>
            <li><a href="{{route('publications')}}">International Publications</a></li>
            <li><a href="{{route('contact')}}">Contact</a></li>      
          </ul>
        </div>

        <!-- Newsletter -->
        <div class="col-12 col-md-12 col-lg-2 footer-col">
          <h6>Newsletter</h6>
          <p class="small-muted">Monthly notes, reading picks, and book news.</p>

          <form id="newsletterForm" class="d-flex" aria-label="Subscribe to newsletter">
            <label for="newsletterEmail" class="visually-hidden">Email address</label>
            <input id="newsletterEmail" type="email" class="form-control form-control-sm me-2" placeholder="you@example.com" required>
            <button class="btn btn-sm btn-primary" type="submit">Subscribe</button>
          </form>

          <div id="newsletterMsg" class="mt-2 small" role="status" aria-live="polite"></div>
        </div>
      </div>

      <hr class="mt-4" style="border-color: rgba(255,255,255,0.06)">

      <div class="d-flex flex-column flex-md-row justify-content-between align-items-center py-3 d-none">
        <div class="mb-2 mb-md-0 small-muted">
          &copy; <span id="year"></span> Jane Doe — All rights reserved.
        </div>

        <div class="d-flex align-items-center">
          <nav class="footer-social me-3" aria-label="Author social links">
            <!-- Replace hrefs with your real profiles -->
            <a href="https://twitter.com/" target="_blank" rel="noopener" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
            <a href="https://instagram.com/" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="https://facebook.com/" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
            <a href="https://www.linkedin.com/" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
          </nav>

          <div class="small-muted">
            <a href="/press-kit" class="me-2">Press kit</a>
            <a href="/sitemap.xml">Sitemap</a>
          </div>
        </div>
      </div>
    </div>
  </footer>

  {{-- <footer class="bg-light text-center py-3">
        <a href="#">Home</a> | <a href="#">Spanish Editions</a> | <a href="#">About Paulo</a> | <a href="#">Books</a> | <a href="#">Blog</a> | <a href="#">Resources</a> | <a href="#">Paulo in the News</a>
        <p class="mt-2">© 2023 HarperCollins Publishers</p>
    </footer> --}}