@extends('layouts.app')

@section('content')
    
@php
$profile = \App\Models\CompanyDetail::select('company_name', 'position', 'about_us','logo')->first();
@endphp
    <style>
        .book-cover {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            background-color: #f8f9fa;
        }
        .book-quote {
            border-left: 4px solid #dc3545;
            padding-left: 15px;
            margin-top: 20px;
        }
        .btn-sample {
            background-color: #dc3545;
            color: white;
        }
        .btn-sample:hover {
            background-color: #c82333;
            color: white;
        }
    </style>


<div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="book-cover text-center">
                    <img src="{{ asset('images/products/' . $data->feature_image) }}" alt="{{ $data->name }}" class="img-fluid">
                </div>
            </div>
            <div class="col-md-8">
                <h1>{{ $data->name }}</h1>
                <p class="text-muted">By: {{$profile->company_name}}</p>
                <div class="mb-3">
                    @foreach ($data->categoryProducts as $categoryProduct)
                    <a href="#" class="btn btn-primary btn-sample">{{ $categoryProduct->category->name ?? '' }}</a>
                    @endforeach
                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="about-tab" data-bs-toggle="tab" data-bs-target="#about" type="button" role="tab">About</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="product-details-tab" data-bs-toggle="tab" data-bs-target="#product-details" type="button" role="tab">Book Details</button>
                    </li>
                    <li class="nav-item d-none" role="presentation">
                        <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab">Reviews</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="about" role="tabpanel">
                        
                        
                        {!! $data->description !!}
                        
                    </div>
                    <div class="tab-pane fade" id="product-details" role="tabpanel">
                        
                        {!! $data->short_description !!}
                        


                    </div>
                    <div class="tab-pane fade" id="reviews" role="tabpanel">
                        <p class="mt-3">No reviews yet.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection