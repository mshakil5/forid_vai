@extends('layouts.app')

@section('content')
    
@php
$profile = \App\Models\CompanyDetail::select('company_name', 'position', 'about_us','logo')->first();
@endphp

<!-- Content Section -->
<main class="content">

    <section class="page-container mt-5">
        <div class="row">
            <div class="col-md-4">
                <img src="{{asset('images/products/'.$story->feature_image)}}" class="img-fluid rounded shadow" alt="Project Image">
            </div>
            <div class="col-md-8">
                <h2 class="mb-3">{{$story->name}}</h2>
                {{-- <p class="text-muted">Author: Nicol Rider</p>
                <p class="text-muted">Published: January 1, 2023</p> --}}
                <p class="mt-4">
                    {!! $story->description !!}
                </p>
                
            </div>
        </div>
    </section>


</main>



@endsection