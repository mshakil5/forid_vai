@extends('layouts.app')

@section('content')
    
@php
$profile = \App\Models\CompanyDetail::select('company_name', 'position', 'about_us','logo')->first();
@endphp

<!-- Content Section -->
<main class="content">

    <section class="page-container mt-5">
        <!-- Feature Image (Full Width on Desktop) -->
        <div class="story-image">
            <img src="{{ asset('images/products/'.$story->feature_image) }}" 
                 class="img-fluid rounded shadow-lg w-100" 
                 alt="Story Image">
        </div>
    
        <!-- Story Content -->
        <div class="story-content mt-4">
            <h1 class="fw-bold text-primary text-center">{{ $story->name }}</h1>
            <div class="story-description fs-5 text-secondary mt-3">
                {!! $story->description !!}
            </div>
        </div>
    </section>
    
    <style>
        .page-container {
            max-width: 900px;
            margin: auto;
            padding: 20px;
        }
        .story-image img {
            object-fit: cover;
            max-height: 400px; /* Adjustable */
        }
        .story-content h1 {
            font-size: 2rem;
        }
        .story-description {
            line-height: 1.8;
        }
        @media (max-width: 768px) {
            .page-container {
                padding: 15px;
            }
            .story-image img {
                max-height: 250px;
            }
            .story-content h1 {
                font-size: 1.5rem;
                text-align: center;
            }
            .story-description {
                font-size: 1rem;
                text-align: justify;
            }
        }
    </style>
    
    


</main>



@endsection