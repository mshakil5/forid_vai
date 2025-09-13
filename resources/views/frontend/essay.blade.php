@extends('layouts.app')

@section('content')
    


@section('title', isset($metadata->name) ? $metadata->name : '')
@section('meta_title', isset($metadata->name) ? $metadata->name : '')
@section('meta_description', isset($metadata->description) ? $metadata->description : '')
@section('meta_image', isset($metadata->feature_image) ? asset('images/products/' . $metadata->feature_image) : '')


@php
$profile = \App\Models\CompanyDetail::select('company_name', 'position', 'about_us','logo')->first();
$stories = \App\Models\Essay::select('id','slug' ,'description', 'name','feature_image','short_description')->get();
@endphp
<!-- Content Section -->
<main class="content">
  

<div class="page-container py-2">
    

    @foreach ($stories as $story)
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
                            <a href="{{ route('essay.show', $story->slug) }}">{{ $story->name }}</a>
                        </h2>
                        <p>
                            {!! Str::limit(strip_tags($story->description), 200) !!}
                            <a href="{{ route('essay.show', $story->slug) }}" class="btn btn-link">See More</a>
                        </p>
                    </div>
                @else
                    <!-- Text Left -->
                    <div class="col-md-6">
                        <h2 class="fw-bold title">
                            <a href="{{ route('essay.show', $story->slug) }}">{{ $story->name }}</a>
                        </h2>
                        <p>
                            {!! Str::limit(strip_tags($story->description), 200) !!}
                            <a href="{{ route('essay.show', $story->slug) }}" class="btn btn-link">See More</a>
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