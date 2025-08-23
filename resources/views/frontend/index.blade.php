@extends('layouts.app')

@section('content')
<style>
  .btn:hover {
      transform: scale(1.05);
      transition: all 0.3s ease-in-out;
  }
  .profile-img {
      transition: transform 0.3s ease-in-out;
  }
  .profile-img:hover {
      transform: scale(1.1);
  }
  .d-none {
    display: none;
  }
  .btn-size {
    font-size: 24px;
    padding: 10px 20px;
  }
  
    .home-banner-slider img{
        width: 253px !important;
    }

    .carousel-inner {
        position: relative;
        height: 400px; /* Fixed height for consistency */
    }
    .carousel-item img {
        height: 100%;
        object-fit: contain; /* Ensure image scales without distortion */
    }
    .carousel-caption {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: #fff; /* Ensure text is readable against background */
        text-shadow: 0 0 5px rgba(0, 0, 0, 0.5); /* Improve readability */
    }
    .carousel-caption h5 {
        font-size: 1.5rem;
        margin-bottom: 15px;
    }
    .carousel-caption .btn {
        font-size: 1rem;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .carousel-inner {
            height: 250px;
        }
        .carousel-item img {
            max-width: 40%; /* Slightly smaller image on mobile */
        }
        .carousel-caption h5 {
            font-size: 1.2rem;
        }
        .carousel-caption .btn {
            font-size: 0.9rem;
            padding: 8px 16px;
        }
    }
    @media (max-width: 576px) {
        .carousel-inner {
            height: 200px;
        }
        .carousel-item img {
            max-width: 35%;
        }
        .carousel-caption h5 {
            font-size: 1rem;
        }
        .carousel-caption .btn {
            font-size: 0.8rem;
            padding: 6px 12px;
        }
    }

</style>



  @php
      $profile = \App\Models\CompanyDetail::select('company_name', 'position', 'about_us','about_us_eng','logo')->first();
  @endphp


    <div id="slider" class="carousel slide" data-bs-ride="carousel" style="background-image: url('{{ asset('banner.jpg') }}'); background-repeat:no-repeat; background-size:cover; height: 582px; background-position:center center;">
        <div class="carousel-inner home-banner-slider">

          
                <div class="carousel-item active">
                    <div class="d-flex justify-content-end m-3">
                      <p>test data</p>
                    </div>
                    <div class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100">
                      
                    </div>
                </div>

                
          
                <div class="carousel-item">
                    <div class="d-flex justify-content-end m-3">
                      <p>test data 2</p>
                    </div>
                    <div class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100">
                      
                    </div>
                </div>
                
            

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#slider" data-bs-slide="prev">
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#slider" data-bs-slide="next">
            <span class="visually-hidden">Next</span>
        </button>


    </div>




<main class="content py-5">
    <div class="container">
        <div class="row">
            <!-- Profile Section -->
            <div class="col-md-10 col-lg-12">
              <div class="card shadow-lg p-4 border-0 rounded-4">
                  <div class="row">
                      <!-- Left Side: About Us Content -->
                      <div class="col-md-4 text-start">
                          <h4 class="fw-bold">About Me</h4>
                          <div class="text-muted" id="short-about">
                              <p>{!! Str::before($profile->about_us, '</p>') !!}</p>
                          </div>
                          <div class="text-muted d-none" id="full-about">
                              <p>{!! $profile->about_us !!}</p>
                          </div>
                          <button class="btn btn-light mt-2 fw-bold text-dark" id="see-more-btn">See more</button>
                      </div>
          
                      <!-- Middle: Profile Image -->
                      <div class="col-md-4 text-center">
                          <img src="{{asset('images/company/'.$profile->logo)}}" alt="Profile Image" 
                               class="profile-img shadow-lg rounded-circle p-3" 
                               style="width: 180px; height: 180px; object-fit: cover; border: 5px solid #f8f9fa;">
                          <h3 class="fw-bold mt-3" style="font-family: 'Times New Roman', serif;">
                              মুহাম্মদ ফরিদ হাসান
                          </h3>
                          <h5>
                            লেখক, গবেষক ও সাংবাদিক
                          </h5>
                      </div>
          
                      <!-- Right Side: Additional Text -->
                      <div class="col-md-4 text-end">
                        <h4 class="fw-bold">About Me</h4>
                        <div class="text-muted" id="short-about-eng">
                            <p>{!! Str::limit(strip_tags($profile->about_us_eng), 300) !!}</p>
                        </div>
                        <div class="text-muted d-none" id="full-about_eng">
                            <p>{!! $profile->about_us_eng !!}</p>
                        </div>
                        <button class="btn btn-light mt-2 fw-bold text-dark" id="see-more-eng-btn">See more</button>
                      </div>
                  </div>
              </div>
          </div>
          
        </div>
        
        <!-- Buttons Section -->
        <div class="row justify-content-center mt-4 d-none">
            <div class="col-md-10 col-lg-12">
                <div class="card shadow-lg p-4 border-0 rounded-4 text-center">
                    <h4 class="fw-bold mb-3">Explore</h4>
                    <div class="row g-3 justify-content-center">
                        <div class="col-6 col-md-4 col-lg-3">
                            <a href="{{route('research')}}" class="btn btn-danger w-100 rounded-pill shadow-sm btn-size ">Research</a>
                        </div>
                        <div class="col-6 col-md-4 col-lg-3">
                            <a href="{{route('essay')}}" class="btn btn-secondary w-100 rounded-pill shadow-sm btn-size">Essay</a>
                        </div>
                        <div class="col-6 col-md-4 col-lg-3">
                            <a href="{{route('stories')}}" class="btn btn-success w-100 rounded-pill shadow-sm btn-size">Stories</a>
                        </div>
                        <div class="col-6 col-md-4 col-lg-3">
                            <a href="{{route('poetries')}}" class="btn btn-warning w-100 rounded-pill shadow-sm btn-size">Poetry</a>
                        </div>
                        <div class="col-12 col-md-4 col-lg-6">
                            <a href="#" class="btn btn-dark w-100 rounded-pill shadow-sm btn-size" >International Publications</a>
                        </div>
                        <div class="col-6 col-md-4 col-lg-3">
                            <a href="{{route('book')}}" class="btn btn-info w-100 rounded-pill shadow-sm btn-size">Book</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>





@endsection

@section('script')
<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
      $("#see-more-btn").click(function() {
          $("#short-about").addClass("d-none");
          $("#full-about").removeClass("d-none");
          $(this).hide();
      });
      $("#see-more-eng-btn").click(function() {
          $("#short-about-eng").addClass("d-none");
          $("#full-about_eng").removeClass("d-none");
          $(this).hide();
      });
  });
</script>
@endsection