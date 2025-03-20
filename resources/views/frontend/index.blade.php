@extends('layouts.app')

@section('content')
    
  @php
      $profile = \App\Models\CompanyDetail::select('company_name', 'position', 'about_us','logo')->first();
  @endphp
  <!-- Content Section -->
  {{-- <main class="content">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-4 text-center p-2">
          <div class="p-3 text-center">
            <!-- Profile Picture -->
            <div class="d-flex justify-content-center">
              <img src="{{asset('images/company/'.$profile->logo)}}" alt="Profile Image" class="profile-img shadow p-3">

              
            </div>
          </div>
          <div class=" p-3">
            <div class="profile-title" style="font-family: 'Times New Roman', Times, serif; font-weight: bold;">মুহাম্মদ ফরিদ হাসান</div>

              {!! Str::before($profile->about_us, '</p>') !!}

          </div>
        </div>
        <div class="col-md-5 p-2">
            <div class=" p-3">

                <div class="row justify-content-center pt-4">
                  <div class="col-12 col-md-4 profile-buttons p-2">
                    <a href="{{route('research')}}" class="btn btn-danger">Research</a>
                  </div> 
                  <div class="col-12 col-md-4 profile-buttons p-2">
                    <a href="{{route('essay')}}" class="btn btn-secondary">Essay</a>
                  </div> 
                    <div class="col-12 col-md-4 profile-buttons p-2">
                      <a href="{{route('stories')}}" class="btn btn-success">Stories</a>
                    </div> 
                    <div class="col-12 col-md-4 profile-buttons p-2">
                      <a href="{{route('poetries')}}" class="btn btn-warning">Poetry</a>
                    </div> 
                    <div class="col-12 col-md-4 profile-buttons p-2">
                      <a href="{{route('book')}}" class="btn btn-info">Book</a>
                    </div> 
                    
                    <div class="col-12 col-md-4 profile-buttons p-2">
                      <a href="#" class="btn btn-dark" style="font-size: 13px;">International Publications</a>
                    </div> 
                    
                </div>

            </div>
        </div>
      </div>


    </div>
  </main> --}}
  <main class="content py-5">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Profile Section -->
            <div class="col-md-10 col-lg-8">
                <div class="card shadow-lg p-4 border-0 rounded-4 text-center">
                    <div class="d-flex justify-content-center">
                        <img src="{{asset('images/company/'.$profile->logo)}}" alt="Profile Image" class="profile-img shadow-lg rounded-circle p-3" style="width: 180px; height: 180px; object-fit: cover; border: 5px solid #f8f9fa;">
                    </div>
                    <div class="mt-3">
                        <h3 class="fw-bold" style="font-family: 'Times New Roman', serif;">মুহাম্মদ ফরিদ হাসান</h3>
                        <p class="text-muted">{!! Str::before($profile->about_us, '</p>') !!}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Buttons Section -->
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 col-lg-8">
                <div class="card shadow-lg p-4 border-0 rounded-4 text-center">
                    <h4 class="fw-bold mb-3">Explore</h4>
                    <div class="row g-3 justify-content-center">
                        <div class="col-6 col-md-4 col-lg-3">
                            <a href="{{route('research')}}" class="btn btn-danger w-100 py-3 rounded-pill shadow-sm">Research</a>
                        </div>
                        <div class="col-6 col-md-4 col-lg-3">
                            <a href="{{route('essay')}}" class="btn btn-secondary w-100 py-3 rounded-pill shadow-sm">Essay</a>
                        </div>
                        <div class="col-6 col-md-4 col-lg-3">
                            <a href="{{route('stories')}}" class="btn btn-success w-100 py-3 rounded-pill shadow-sm">Stories</a>
                        </div>
                        <div class="col-6 col-md-4 col-lg-3">
                            <a href="{{route('poetries')}}" class="btn btn-warning w-100 py-3 rounded-pill shadow-sm">Poetry</a>
                        </div>
                        <div class="col-12 col-md-4 col-lg-6">
                            <a href="#" class="btn btn-dark w-100 py-3 rounded-pill shadow-sm" style="font-size: 14px;">International Publications</a>
                        </div>
                        <div class="col-6 col-md-4 col-lg-3">
                            <a href="{{route('book')}}" class="btn btn-info w-100 py-3 rounded-pill shadow-sm">Book</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

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
</style>



@endsection