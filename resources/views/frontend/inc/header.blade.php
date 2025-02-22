
  

  
  <!-- Header -->
  <header class="d-flex justify-content-between align-items-center px-4 py-3 bg-white shadow header">
    <div class="d-flex align-items-center">
      <div class="rounded-circle bg-warning" style="width: 16px; height: 16px;"></div>
      <h1 class="h5 ms-2 mb-0">{{$profile->company_name}}</h1>
      <span class="text-muted ms-2">{{$profile->position}}</span>
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
  </header>

  <!-- Offcanvas Menu (Mobile Drawer) -->
  <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
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
  </div>