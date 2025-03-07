@extends('layouts.app')

@section('content')
    
@php
$profile = \App\Models\CompanyDetail::select('company_name', 'position', 'about_us','logo')->first();
@endphp
<!-- Content Section -->
<main class="content">
  

  <div class="container py-5">
    
    <div class="row align-items-center  justify-content-center py-4">
        <div class="col-md-4">
            <h2 class="fw-bold">Project Name 01</h2>
            <p>
                I'm a paragraph. Click here to add your own text and edit me. It's easy. 
                Just click “Edit Text” or double click me to add your own content and make changes to the font. 
                I’m a great place for you to tell a story and let your users know a little more about you.
            </p>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-4">
            <img src="{{asset('images/company/'.$profile->logo)}}" alt="Project Image" class="img-fluid">
        </div>
    </div>
    
    <div class="row align-items-center  justify-content-center py-4">
        <div class="col-md-4">
            <h2 class="fw-bold">Project Name 01</h2>
            <p>
                I'm a paragraph. Click here to add your own text and edit me. It's easy. 
                Just click “Edit Text” or double click me to add your own content and make changes to the font. 
                I’m a great place for you to tell a story and let your users know a little more about you.
            </p>
        </div>
        
        <div class="col-md-1"></div>

        <div class="col-md-4">
            <img src="{{asset('images/company/'.$profile->logo)}}" alt="Project Image" class="img-fluid">
        </div>
    </div>
    
    <div class="row align-items-center  justify-content-center py-4">
        <div class="col-md-4">
            <h2 class="fw-bold">Project Name 01</h2>
            <p>
                I'm a paragraph. Click here to add your own text and edit me. It's easy. 
                Just click “Edit Text” or double click me to add your own content and make changes to the font. 
                I’m a great place for you to tell a story and let your users know a little more about you.
            </p>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-4">
            <img src="{{asset('images/company/'.$profile->logo)}}" alt="Project Image" class="img-fluid">
        </div>
    </div>
</div>

    
</main>


@endsection