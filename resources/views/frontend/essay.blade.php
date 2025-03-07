@extends('layouts.app')

@section('content')
    
@php
$profile = \App\Models\CompanyDetail::select('company_name', 'position', 'about_us','logo')->first();
$stories = \App\Models\Essay::select('id', 'description', 'name','feature_image','short_description')->get();
@endphp
<!-- Content Section -->
<main class="content">
  

<div class="page-container py-2">
    

    @foreach ($stories as $story)
    <div class="row align-items-center justify-content-center py-4 {{ $loop->iteration % 2 == 0 ? 'bg-light' : '' }}">
        @if ($loop->iteration % 2 == 0)
            <div class="col-md-4">
                @if ($story->feature_image)
                    <img src="{{asset('images/products/'.$story->feature_image)}}" alt="Project Image" class="img-fluid">
                @endif
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-7">
                <h2 class="fw-bold title">
                    <a href="#">{{$story->name}}</a>
                </h2>
                <p>
                    {{-- {!! Str::before(Str::after($story->description, '<p>'), '</p><p>') !!} --}}

                        {!! Str::words($story->description, 400, ' (...)') !!}
                </p>
            </div>
        @else
            <div class="col-md-7">
                <h2 class="fw-bold">{{$story->name}}</h2>
                <p>
                    {!! Str::words($story->description, 400, ' (...)') !!}
                </p>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-4">
                @if ($story->feature_image)
                    <img src="{{asset('images/products/'.$story->feature_image)}}" alt="Project Image" class="img-fluid">
                @endif
            </div>
        @endif
    </div>
    @endforeach
    
    
    


</div>

    
</main>


@endsection