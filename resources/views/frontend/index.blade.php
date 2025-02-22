@extends('layouts.app')

@section('content')
    
  @php
      $profile = \App\Models\CompanyDetail::select('company_name', 'position', 'about_us','logo')->first();
  @endphp
  <!-- Content Section -->
  <main class="content">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-4 text-center p-2">
          <div class="p-3 text-center">
            <!-- Profile Picture -->
            <div class="d-flex justify-content-center">
              <img src="{{asset('images/company/'.$profile->logo)}}" alt="Profile Image" class="profile-img shadow p-3">
            </div>
          </div>
        </div>
        <div class="col-md-5 p-2">
            <div class=" p-3">
            <div class="profile-title" style="font-family: 'Times New Roman', Times, serif; font-weight: bold;">Hello</div>
                {{-- <h3>About Me</h3>
                <p id="about-me">I am a passionate editor with experience in writing and content creation. I love crafting stories and refining content to perfection.</p>
                <h5>Contact Info</h5>
                <ul class="list-unstyled">
                    <li><strong>Email:</strong> <span id="user-email">info@mysite.com</span></li>
                    <li><strong>Phone:</strong> <span id="user-phone">123-456-7890</span></li>
                </ul> --}}

                {!! $profile->about_us !!}


                <div class="row justify-content-center ">
                    <div class="col-12 col-md-4 profile-buttons">
                      <a href="{{route('stories')}}" class="btn btn-success">Stories</a>
                    </div> 
                    <div class="col-12 col-md-4 profile-buttons">
                      <button class="btn btn-warning">Resume</button>
                    </div> 
                    <div class="col-12 col-md-4 profile-buttons">
                      <button class="btn btn-danger">Contact</button>
                    </div> 
                </div>

            </div>
        </div>
      </div>
    </div>
  </main>



@endsection