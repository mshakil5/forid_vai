
  
<!-- Bootstrap Icons CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">

<!-- Header -->
<header class="d-flex justify-content-between align-items-center px-4 py-3 bg-white shadow-sm fixed-top">
  <div class="d-flex align-items-center">
    <a href="{{route('homepage')}}" class="d-flex align-items-center text-decoration-none">
      <img src="{{asset('images/company/'.$profile->header_logo)}}" alt="Profile Image" class="rounded-circle shadow-sm" style="width: 50px; height: 50px;">
      <div class="ms-2">
        <h1 class="h5 mb-0 fw-bold">{{$profile->company_name}}</h1>
        <span class="text-muted" style="font-size: 12px;">{{$profile->position}}</span>
      </div>
    </a>
  </div>

  <!-- Desktop Navigation -->
  <nav class="d-none d-md-block">
    <ul class="nav">
      <li class="nav-item">
        <a href="{{route('homepage')}}" class="nav-link text-dark fw-semibold px-3">Home</a>
      </li>
      <li class="nav-item">
        <a href="{{route('essay')}}" class="nav-link text-dark fw-semibold px-3">Essay</a>
      </li>
      <li class="nav-item">
        <a href="{{route('research')}}" class="nav-link text-dark fw-semibold px-3">Research</a>
      </li>
      <li class="nav-item">
        <a href="{{route('stories')}}" class="nav-link text-dark fw-semibold px-3">Stories</a>
      </li>
      <li class="nav-item">
        <a href="{{route('poetries')}}" class="nav-link text-dark fw-semibold px-3">Poetry</a>
      </li>
      <li class="nav-item">
        <a href="{{route('book')}}" class="nav-link text-dark fw-semibold px-3">Book</a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link text-dark fw-semibold px-3">International Publications</a>
      </li>
      <li class="nav-item">
        <a href="{{route('contact')}}" class="nav-link text-dark fw-semibold px-3">Contact</a>
      </li>
      <li class="nav-item dropdown d-none">
        <a href="#" class="nav-link text-dark fw-semibold px-3 dropdown-toggle" id="moreDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          More
        </a>
        <ul class="dropdown-menu shadow border-0">
          <li><a class="dropdown-item" href="#">About</a></li>
          <li><a class="dropdown-item" href="#">Services</a></li>
          <li><a class="dropdown-item" href="#">Blog</a></li>
        </ul>
      </li>
    </ul>
  </nav>

  <!-- Navbar Toggle for Mobile -->
  <button class="btn btn-outline-secondary d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu">
    <i class="bi bi-list" style="font-size: 1.5rem;"></i>
  </button>
</header>

<!-- Offcanvas Mobile Menu -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenu">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title">Menu</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="nav flex-column">
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

<!-- CSS Styles -->
<style>
  .nav-link {
    transition: all 0.3s ease-in-out;
    padding: 8px 15px;
    border-radius: 5px;
    position: relative;
  }

  .nav-link:hover {
    color: #007bff !important;
    background-color: #f8f9fa;
    border-radius: 5px;
    box-shadow: 0px 4px 8px rgba(0, 123, 255, 0.3);
  }

  .nav-link::after {
    content: "";
    position: absolute;
    inset: 0;
    border: 2px solid transparent;
    transition: all 0.3s ease-in-out;
  }

  .nav-link:hover::after {
    border-color: #ececece2;
    border-radius: 5px;
    box-shadow: 0px 4px 8px rgba(0, 123, 255, 0.3);
  }

  .dropdown-menu {
    display: none;
    position: absolute;
    background: white;
    border-radius: 8px;
    padding: 10px;
    min-width: 150px;
  }

  .dropdown:hover .dropdown-menu {
    display: block;
  }

  .dropdown-item {
    transition: all 0.2s;
  }

  .dropdown-item:hover {
    background: #f8f9fa;
  }

  @media (max-width: 768px) {
    .fixed-top {
      position: relative;
    }

    .nav-link {
      border: 1px solid gray;
      background-color: #111111;
      color: #ffffff;
    }
    .nav-item{
      padding-top: 1px;
      padding-bottom: 1px;
    }

  }

  .mobile-menu-btn {
    background: white;
    border: 2px solid #c5c7c9;
    border-radius: 5px;
    padding: 10px 12px;
    box-shadow: 0px 4px 8px rgba(0, 123, 255, 0.3);
    transition: all 0.3s ease-in-out;
    font-size: 1.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .mobile-menu-btn:hover {
    background: #007bff;
    color: white;
    transform: scale(1.05);
  }

  .mobile-menu-btn:active {
    transform: scale(0.95);
    box-shadow: 0px 2px 5px rgba(0, 123, 255, 0.5);
  }

</style>



  



  <!-- Old data below -->



  <!-- Header -->
  {{-- <header class="d-flex justify-content-between align-items-center px-4 py-3 bg-white shadow header">
    <div class="d-flex align-items-center">
      <div class="rounded-circle">
        <img src="{{asset('images/company/'.$profile->header_logo)}}" alt="Profile Image" class="rounded-circle" style="width: 50px; height: 50px;">
      </div>
      <h1 class="h5 ms-2 mb-0">{{$profile->company_name}} <br>
        <span class="text-muted ms-2" style="font-size: 12px; padding-top: 7px;">{{$profile->position}}</span>
        
      </h1> <br>
    </div>

    <!-- Navbar Toggle for Mobile -->
    <button class="btn btn-outline-secondary d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Desktop Navigation -->
    <nav class="d-none d-md-block">
      <ul class="nav">
        <li class="nav-item"><a href="{{route('homepage')}}" class="nav-link text-secondary">Home</a></li>
        <li class="nav-item"><a href="#" class="nav-link text-secondary">Projects</a></li>
        <li class="nav-item"><a href="{{route('contact')}}" class="nav-link text-secondary">Contact</a></li>
        <li class="nav-item"><a href="#" class="nav-link text-secondary">More</a></li>
      </ul>
    </nav>
  </header> --}}

  <!-- Offcanvas Menu (Mobile Drawer) -->
  {{-- <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasMenuLabel">Menu</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <ul class="nav flex-column">
        <li class="nav-item"><a href="{{route('homepage')}}" class="nav-link text-secondary">Home</a></li>
        <li class="nav-item"><a href="#" class="nav-link text-secondary">Projects</a></li>
        <li class="nav-item"><a href="{{route('contact')}}" class="nav-link text-secondary">Contact</a></li>
        <li class="nav-item"><a href="#" class="nav-link text-secondary">More</a></li>
      </ul>
    </div>
  </div> --}}