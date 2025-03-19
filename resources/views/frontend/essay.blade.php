@extends('layouts.app')

@section('content')
    
@php
$profile = \App\Models\CompanyDetail::select('company_name', 'position', 'about_us','logo')->first();
$stories = \App\Models\Essay::select('id','slug' ,'description', 'name','feature_image','short_description')->get();
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
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. <br>

                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    {{-- {!! Str::before($story->description, '</p>') !!} --}}
                    {{-- {!! Str::words($story->description, 100, ' (...)') !!} --}}
                    <a href="{{route('essay.show', $story->slug)}}" class="btn btn-link">See More</a>
                </p>
            </div>
        @else
            <div class="col-md-7">
                <h2 class="fw-bold">{{$story->name}}</h2>
                <p>

                    
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. <br>

                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.

                    
                    {{-- {!! Str::words($story->description, 100, ' (...)') !!} --}}
                    <a href="{{route('essay.show', $story->slug)}}" class="btn btn-link">See More</a>
                        {{-- {!! Str::before($story->description, '</p>') !!} --}}
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