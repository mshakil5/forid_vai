@extends('layouts.app')

@section('content')
    
@php
$profile = \App\Models\CompanyDetail::select('company_name', 'position', 'about_us','logo')->first();
@endphp

<style>
    .home-banner-slider img{
        width: 253px !important;
    }


    .book-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr); /* 5 columns of equal width */
        gap: 20px;
        padding: 40px 0;
    }
    .book-card {
        text-align: center;
        border: 1px solid #ffffff;
        padding: 10px;
        background-color: #fff;
        text-decoration: none;
    }
    .book-card img {
        max-width: 100%;
        height: auto;
    }

    .book-link {
        color: #000; /* Default text color */
        text-decoration: none; /* Remove underline */
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {
        .book-grid {
            grid-template-columns: repeat(3, 1fr); /* 3 columns for medium screens */
        }
    }
    @media (max-width: 576px) {
        .book-grid {
            grid-template-columns: repeat(2, 1fr); /* 2 columns for small screens */
        }
        .book-card {
            padding: 5px;
            text-decoration: none
        }
        .book-card img {
            max-width: 80%;
        }
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


    {{-- <div id="slider" class="carousel slide" data-bs-ride="carousel" style="background-image: url('{{ asset('slider-bg.jpg') }}'); background-repeat:no-repeat;background-size:cover; background-position:center center;">
        <div class="carousel-inner home-banner-slider">
            <div class="carousel-item active">
                <img src="{{asset('slide2-1.png')}}" class="d-block w-100" alt="Slide 1">
                <div class="carousel-caption">
                    <h5>What are the words you want to live by?</h5>
                    <a href="#" class="btn btn-dark">Learn More</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{asset('slide2-1.png')}}" class="d-block w-100" alt="Slide 2">
                <div class="carousel-caption">
                    <h5>Explore The Alchemist</h5>
                    <a href="#" class="btn btn-dark">Learn More</a>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#slider" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#slider" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div> --}}

    <div id="slider" class="carousel slide" data-bs-ride="carousel" style="background-image: url('{{ asset('slider-bg.jpg') }}'); background-repeat:no-repeat; background-size:cover; background-position:center center;">
        <div class="carousel-inner home-banner-slider">

            @foreach ($data as $key => $item)
                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                    <div class="d-flex justify-content-end m-3">
                        <img src="{{ asset('images/products/' . $item->feature_image) }}" class="d-block m-5" style="height:300px" alt="{{ $item->name }}">
                    </div>
                    <div class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100">
                        <h5>{{ $item->name }}</h5>
                        <a href="{{ route('book.bookDetails', $item->slug)}}" class="btn btn-dark">See More</a>
                    </div>
                </div>
            @endforeach
            

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#slider" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#slider" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container">
        <h2 class="text-center my-4"> BOOKS</h2>
        <div class="book-grid">
            @foreach ($data as $book)
                <div class="book-card">
                    <a href="{{ route('book.bookDetails', $book->slug)}}" class="book-link"><img src="{{ asset('images/products/' . $book->feature_image) }}" alt="{{ $book->name }}">
                    <p>{{ $book->name }}</p></a>
                </div>
                
            @endforeach
        </div>
    </div>

    <div class="newsletter d-none">
        <div class="container">
            <h3>SIGN UP FOR EXCLUSIVE PAULO COELHO NEWS</h3>
            <form>
                <div class="mb-3">
                    <input type="email" class="form-control" placeholder="Email Address">
                </div>
                <button type="submit" class="btn btn-dark">Subscribe</button>
            </form>
            <p class="small mt-2">This is a promoted service of HarperCollins Publishers LLC - 195 Broadway, New York, NY 10007 providing information about the products of HarperCollins & its affiliates. By submitting your email address, you understand that you will receive email communications at any time. If you have questions, please review our privacy policy or email us at privacy@harpercollins.com</p>
        </div>
    </div>

    <div class="container resources d-none">
        <h2 class="text-center my-4">RESOURCES</h2>
        <div id="resourceCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row justify-content-center">
                        <div class="col-md-3 col-6 col-lg-3"><div class="card"><img src="{{ asset('resource.png')}}" alt="Warrior Reading Guide"><p>Warrior of the Light Reading Guide</p></div></div>
                        <div class="col-md-3 col-6 col-lg-3"><div class="card"><img src="{{ asset('resource.png')}}" alt="Witch Reading Guide"><p>The Witch of Portobello Reading Guide</p></div></div>
                        <div class="col-md-3 col-6 col-lg-3"><div class="card"><img src="{{ asset('resource.png')}}" alt="Pilgrimage Reading Guide"><p>The Pilgrimage Reading Guide</p></div></div>
                        <div class="col-md-3 col-6 col-lg-3"><div class="card"><img src="{{ asset('resource.png')}}" alt="Maktub Reading Guide"><p>Maktub Reading Guide</p></div></div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row justify-content-center">
                        <div class="col-md-3 col-6 col-lg-3"><div class="card"><img src="{{ asset('resource.png')}}" alt="Pilgrimage Reading Guide2"><p>The Pilgrimage Reading Guide2</p></div></div>
                        <div class="col-md-3 col-6 col-lg-3"><div class="card"><img src="{{ asset('resource.png')}}" alt="Maktub Reading Guide2"><p>Maktub Reading Guide2</p></div></div>
                        <div class="col-md-3 col-6 col-lg-3"><div class="card"><img src="{{ asset('resource.png')}}" alt="Pilgrimage Reading Guide3"><p>The Pilgrimage Reading Guide3</p></div></div>
                        <div class="col-md-3 col-6 col-lg-3"><div class="card"><img src="{{ asset('resource.png')}}" alt="Maktub Reading Guide3"><p>Maktub Reading Guide3</p></div></div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#resourceCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#resourceCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>



@endsection