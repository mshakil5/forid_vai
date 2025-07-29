@extends('layouts.app')

@section('content')
    
@php
$profile = \App\Models\CompanyDetail::select('company_name', 'position', 'about_us','logo')->first();
$data = \App\Models\Publication::select('id','slug', 'description', 'name','feature_image','short_description')->orderby('id', 'DESC')->get();
@endphp
<!-- Content Section -->
<main class="content">
  

    <div class="container py-5">
        
        @foreach ($data as $story)
            <div class="container py-4">
                <div class="row d-flex align-items-center justify-content-center {{ $loop->iteration % 2 == 0 ? 'bg-light' : '' }}">
                    @if ($loop->iteration % 2 == 0)
                        <!-- Image Left -->
                        <div class="col-md-5">
                            @if ($story->feature_image)
                                <img src="{{ asset('images/products/'.$story->feature_image) }}" alt="Project Image" class="img-fluid rounded">
                            @endif
                        </div>
                        <div class="col-md-1"></div>
                        <!-- Text Right -->
                        <div class="col-md-6">
                            <h2 class="fw-bold title">
                                <a href="{{ route('research.show', $story->slug) }}">{{ $story->name }}</a>
                            </h2>
                            <p>
                                {!! Str::limit(strip_tags($story->description), 200) !!}
                                <a href="{{ route('research.show', $story->slug) }}" class="btn btn-link">See More</a>
                            </p>
                        </div>
                    @else
                        <!-- Text Left -->
                        <div class="col-md-6">
                            <h2 class="fw-bold title">
                                <a href="{{ route('research.show', $story->slug) }}">{{ $story->name }}</a>
                            </h2>
                            <p>
                                {!! Str::limit(strip_tags($story->description), 200) !!}
                                <a href="{{ route('research.show', $story->slug) }}" class="btn btn-link">See More</a>
                            </p>
                        </div>
                        <div class="col-md-1"></div>
                        <!-- Image Right -->
                        <div class="col-md-5">
                            @if ($story->feature_image)
                                <img src="{{ asset('images/products/'.$story->feature_image) }}" alt="Project Image" class="img-fluid rounded">
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        @endforeach


    </div>

    
</main>


@endsection