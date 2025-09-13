@extends('layouts.app')

@section('content')
    



@section('title', isset($metadata->name) ? $metadata->name : '')
@section('meta_title', isset($metadata->name) ? $metadata->name : '')
@section('meta_description', isset($metadata->description) ? $metadata->description : '')
@section('meta_image', isset($metadata->feature_image) ? asset('images/products/' . $metadata->feature_image) : '')


@php
$profile = \App\Models\CompanyDetail::select('phone1', 'email1', 'facebook','linkedin')->first();
@endphp

<!-- Content Section -->
<main class="content">
  <div class="container py-5">
      <div class="row justify-content-center">
          <div class="col-md-6">
              <h2>Contact</h2>
              <p>Looking forward to hearing from you</p>
              <p><strong>Phone</strong><br>{{$profile->phone1}}</p>
              <p><strong>Email</strong><br>{{$profile->email1}}</p>
          </div>
          <div class="col-md-6">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
              <form method="POST" action="{{route('contact.store')}}">
                @csrf
                  <div class="row mb-3">
                      <div class="col">
                          <input type="text" name="first_name" class="form-control" placeholder="First Name *" required>
                      </div>
                      <div class="col">
                          <input type="text" name="last_name" class="form-control" placeholder="Last Name *" required>
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col">
                          <input type="email" name="email" class="form-control" placeholder="Email *" required>
                      </div>
                      <div class="col">
                          <input type="text" name="subject" class="form-control" placeholder="Subject">
                      </div>
                  </div>
                  <div class="mb-3">
                      <textarea class="form-control" name="message" rows="4" placeholder="Message"></textarea>
                  </div>
                  <button type="submit" class="btn btn-warning w-100">Submit</button>
              </form>
          </div>
      </div>
  </div>
  
</main>



@endsection