
  

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

          <div class="d-flex align-items-center">
            <a href="{{route('homepage')}}" class="d-flex align-items-center text-decoration-none">
              <img src="{{asset('images/company/'.$profile->header_logo)}}" alt="Profile Image" class="rounded-circle shadow-sm" style="width: 50px; height: 50px;">
              <div class="ms-2">
                <h1 class="h5 mb-0 fw-bold">{{$profile->company_name}}</h1>
                <span class="text-muted" style="font-size: 12px;">{{$profile->position}}</span>
              </div>
            </a>
          </div>


        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item"><a href="{{route('homepage')}}" class="nav-link fw-bold">Home</a></li>
              <li class="nav-item"><a href="{{route('essay')}}" class="nav-link fw-bold">Essay</a></li>
              <li class="nav-item"><a href="{{route('research')}}" class="nav-link fw-bold">Research</a></li>
              <li class="nav-item"><a href="{{route('stories')}}" class="nav-link fw-bold">Stories</a></li>
              <li class="nav-item"><a href="{{route('poetries')}}" class="nav-link fw-bold">Poetry</a></li>
              <li class="nav-item"><a href="{{route('book')}}" class="nav-link fw-bold">Book</a></li>
              <li class="nav-item"><a href="#" class="nav-link fw-bold">International Publications</a></li>
              <li class="nav-item"><a href="{{route('contact')}}" class="nav-link fw-bold">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>


  

