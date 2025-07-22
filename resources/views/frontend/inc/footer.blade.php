  

  @php
  $profile = \App\Models\CompanyDetail::select('phone1', 'email1', 'facebook','linkedin')->first();
@endphp
  
  
  <!-- Footer -->
<footer class="footer py-4 mt-5">
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


  {{-- <footer class="bg-light text-center py-3">
        <a href="#">Home</a> | <a href="#">Spanish Editions</a> | <a href="#">About Paulo</a> | <a href="#">Books</a> | <a href="#">Blog</a> | <a href="#">Resources</a> | <a href="#">Paulo in the News</a>
        <p class="mt-2">© 2023 HarperCollins Publishers</p>
    </footer> --}}