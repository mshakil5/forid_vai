@extends('admin.layouts.admin')



@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">



<!-- Main content -->
<section class="content mt-3" id="addThisFormContainer">
  <div class="container-fluid">
    <div class="row justify-content-md-center">
      <!-- right column -->
      <div class="col-md-12">
        <!-- general form elements disabled -->
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">My Informations</h3>
          </div>

          @if(session()->has('success'))

            <div class="alert alert-success" id="successMessage">{{ session()->get('success') }}</div>
              
          @endif
          @if(session()->has('error'))
          
            <div class="alert alert-danger" id="errMessage">{{ session()->get('error') }}</div>
              
          @endif
          <!-- /.card-header -->
          <div class="card-body">
            <div class="ermsg"></div>
            <form id="createThisForm" action="{{ route('admin.companyDetails') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <input type="hidden" class="form-control" id="codeid" name="codeid" value="{{$data->id}}">
              <div class="row">

                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Full name*</label>
                    <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name" value="{{$data->company_name}}">
                    @error('company_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Position</label>
                    <input type="text" class="form-control @error('position') is-invalid @enderror" id="position" name="position"  value="{{$data->position}}">
                  </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                    <label>Email (1)</label>
                    <input type="email" class="form-control @error('email1') is-invalid @enderror" id="email1" name="email1" value="{{$data->email1}}">
                    </div>
                </div>

                <div class="col-sm-4 d-none">
                    <div class="form-group">
                    <label>Email (2)</label>
                    <input type="email" class="form-control @error('email2') is-invalid @enderror" id="email2" name="email2" value="{{$data->email2}}">
                    </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Phone (1)</label>
                    <input type="text" class="form-control @error('phone1') is-invalid @enderror" id="phone1" name="phone1"  value="{{$data->phone1}}">
                  </div>
                </div>

                <div class="col-sm-3 d-none">
                    <div class="form-group">
                      <label>Phone (2)</label>
                      <input type="text" class="form-control @error('phone2') is-invalid @enderror" id="phone2" name="phone2" value="{{$data->phone2}}">
                    </div>
                </div>

                <div class="col-sm-3 d-none">
                    <div class="form-group">
                      <label>Phone (3)</label>
                      <input type="text" class="form-control @error('phone3') is-invalid @enderror" id="phone3" name="phone3" value="{{$data->phone3}}">
                    </div>
                </div>

                <div class="col-sm-3 d-none">
                    <div class="form-group">
                    <label>Phone (4)</label>
                    <input type="text" class="form-control @error('phone4') is-invalid @enderror" id="phone4" name="phone4" value="{{$data->phone4}}">
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                    <label>Address (1)</label>
                    <input type="text" class="form-control @error('address1') is-invalid @enderror" id="address1" name="address1" value="{{$data->address1}}">
                    </div>
                </div>

                <div class="col-sm-6 d-none">
                    <div class="form-group">
                    <label>Address (2)</label>
                    <input type="text" class="form-control @error('address2') is-invalid @enderror" id="address2" name="address2" value="{{$data->address2}}">
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                    <label>Facebook</label>
                    <input type="text" class="form-control @error('facebook') is-invalid @enderror" id="facebook" name="facebook" value="{{$data->facebook}}">
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                    <label>Instagram</label>
                    <input type="text" class="form-control @error('instagram') is-invalid @enderror" id="instagram" name="instagram" value="{{$data->instagram}}">
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                    <label>Twitter</label>
                    <input type="text" class="form-control @error('twitter') is-invalid @enderror" id="twitter" name="twitter" value="{{$data->twitter}}">
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                    <label>LinkedIn</label>
                    <input type="text" class="form-control @error('linkedin') is-invalid @enderror" id="linkedin" name="linkedin" value="{{$data->linkedin}}">
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                    <label>Youtube</label>
                    <input type="text" class="form-control @error('youtube') is-invalid @enderror" id="youtube" name="youtube" value="{{$data->youtube}}">
                    </div>
                </div>

                <div class="col-sm-4 d-none">
                    <div class="form-group">
                    <label>Tawkto</label>
                    <input type="text" class="form-control @error('tawkto') is-invalid @enderror" id="tawkto" name="tawkto" value="{{$data->tawkto}}">
                    </div>
                </div>

                <div class="col-sm-6 d-none">
                    <div class="form-group">
                    <label>App store link</label>
                    <input type="text" class="form-control @error('google_appstore_link') is-invalid @enderror" id="google_appstore_link" name="google_appstore_link" value="{{$data->google_appstore_link}}">
                    </div>
                </div>
                <div class="col-sm-6 d-none">
                    <div class="form-group">
                    <label>google playstore link</label>
                    <input type="text" class="form-control @error('google_play_link') is-invalid @enderror" id="google_play_link" name="google_play_link" value="{{$data->google_play_link}}">
                    </div>
                </div>

                <div class="col-sm-12 d-none">
                    <div class="form-group">
                    <label>Footer Content</label>
                    <textarea name="footer_content" id="footer_content" class="form-control @error('footer_content') is-invalid @enderror" cols="30" rows="3">{{$data->footer_content}}</textarea>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                    <label>About Us</label>
                    <textarea name="about_us" id="about_us" class="form-control @error('about_us') is-invalid @enderror" cols="30" rows="3">{{$data->about_us}}</textarea>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                    <label>Meta Title</label>

                    <input type="text"  name="meta_title" id="meta_title" class="form-control @error('meta_title') is-invalid @enderror" value="{{$data->meta_title}}">
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                    <label>Meta Description</label>
                    <input type="text"  name="meta_description" id="meta_description" class="form-control @error('meta_description') is-invalid @enderror" value="{{$data->meta_description}}">
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                    <label>Meta Keywords</label>
                    <input type="text" name="meta_keywords" id="meta_keywords" class="form-control @error('meta_keywords') is-invalid @enderror" value="{{$data->meta_keywords}}" >
                    </div>
                </div>

                <div class="col-sm-12 d-none">
                    <div class="form-group">
                    <label>Google Map source code</label>
                    <textarea name="google_map" id="google_map" class="form-control @error('google_map') is-invalid @enderror" cols="30" rows="3">{{$data->google_map}}</textarea>
                    </div>
                </div>
                



                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Homepage Header Logo*</label>
                    <input type="file" class="form-control @error('header_logo') is-invalid @enderror" id="header_logo" name="header_logo">
                    
                    @error('header_logo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>

                  <div class="card card-outline card-info">
                        <!-- /.card-header -->
                        <div class="card-body">
                        
                            @if (isset($data->header_logo))
                            <img src="{{asset('images/company/'.$data->header_logo)}}" alt="" style="width: 230px">
                            @endif
                            
                        </div>
                    </div>


                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                      <label>Footer Logo*</label>
                      <input type="file" class="form-control @error('footer_logo') is-invalid @enderror" id="footer_logo" name="footer_logo">
                      
                      @error('footer_logo')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>

                    <div class="card card-outline card-info">
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if (isset($data->footer_logo))
                            <img src="{{asset('images/company/'.$data->footer_logo)}}" alt="" style="width: 230px">
                            @endif
                            
                        </div>
                    </div>


                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                      <label>Logo*</label>
                      <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo" name="logo">
                      
                      @error('logo')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>

                    <div class="card card-outline card-info">
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if (isset($data->logo))
                            <img src="{{asset('images/company/'.$data->logo)}}" alt="" style="width: 230px">
                            @endif
                            
                        </div>
                    </div>

                </div>


                


                
              </div>






              
          </div>

          
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-secondary" value="Update">Update</button>
            <button type="submit" id="FormCloseBtn" class="btn btn-default">Cancel</button>
          </div>
        </form>
          <!-- /.card-footer -->
          <!-- /.card-body -->
        </div>
      </div>
      <!--/.col (right) -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection



@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('#about_us').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>

<script>
  $(document).ready(function () {
    
      //header for csrf-token is must in laravel
      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
      //

      
      
      
  });
</script>
@endsection