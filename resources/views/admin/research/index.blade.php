@extends('admin.layouts.admin')



@section('content')

<!-- Main content -->
<section class="content" id="newBtnSection">
    <div class="container-fluid">
      <div class="row">
        <div class="col-2">
            <button type="button" class="btn btn-secondary my-3" id="newBtn">Add new</button>
        </div>
      </div>
    </div>
</section>
<!-- /.content -->


<section class="content mt-3" id="addThisFormContainer">
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title" id="cardTitle">Add New </h3>
                    </div>
                    <div class="card-body">
                        <div class="ermsg"></div>
                        <form id="createThisForm">
                            @csrf
                            <input type="hidden" class="form-control" id="productId" name="productId">
                            <input type="hidden" class="form-control" id="codeid" name="codeid">

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="name"> Title<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                                </div>
                                
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="short_description">Short Description<span style="color: red;">*</span></label>
                                    <textarea class="form-control" id="short_description" name="short_description" rows="1" placeholder="Enter short description"></textarea>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="description">Long Description<span style="color: red;">*</span></label>
                                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter long description"></textarea>
                                </div>
                            </div>

                            <div class="form-row category-row">
                                <div class="form-group col-md-4">
                                    <label for="category">category<span style="color: red;">*</span></label>
                                    <select class="form-control category" id="category_id" name="category_id">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>


                            <div class="form-row">
                                <div class="form-group col-md-1 d-none">
                                    <label for="is_featured">Featured</label>
                                    <input type="checkbox" class="form-control" id="is_featured" name="is_featured" value="1">
                                </div>
                                <div class="form-group col-md-1 d-none">
                                    <label for="is_recent">Recent</label>
                                    <input type="checkbox" class="form-control" id="is_recent" name="is_recent" value="1">
                                </div>
                                <div class="form-group col-md-1 d-none">
                                    <label for="is_new_arrival">New Arriv.</label>
                                    <input type="checkbox" class="form-control" id="is_new_arrival" name="is_new_arrival" value="1">
                                </div>
                                <div class="form-group col-md-1 d-none">
                                    <label for="is_top_rated">Top Rated</label>
                                    <input type="checkbox" class="form-control" id="is_top_rated" name="is_top_rated" value="1">
                                </div>
                                <div class="form-group col-md-1 d-none">
                                    <label for="is_popular">Popular</label>
                                    <input type="checkbox" class="form-control" id="is_popular" name="is_popular" value="1">
                                </div>
                                <div class="form-group col-md-1 d-none">
                                    <label for="is_trending">Trending</label>
                                    <input type="checkbox" class="form-control" id="is_trending" name="is_trending" value="1">
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Meta Title</label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Meta Description</label>
                                        <textarea class="form-control" id="meta_description" name="meta_description" rows="3" placeholder="Enter meta description"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Meta Keywords</label>
                                        <textarea class="form-control" id="meta_keywords" name="meta_keywords" rows="3" placeholder="Enter meta keywords"></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Image part start -->
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="feature-img">Feature Image</label>
                                    <input type="file" class="form-control-file" id="feature-img" accept="image/*">
                                    <img id="preview-image" src="#" alt="" style="max-width: 300px; width: 100%; height: auto; margin-top: 20px;">
                                </div>
   
                            </div>
                             <!-- Image part end -->

                        </form>
                    </div>
                    <div class="card-footer">
                        <button type="submit" id="addBtn" class="btn btn-secondary" value="Create">Create</button>
                        <button type="submit" id="FormCloseBtn" class="btn btn-default">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="content" id="contentContainer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">All Data</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $data)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $data->name }}</td>
                                    @php
                                        $imagePath = public_path('images/products/' . $data->feature_image);
                                    @endphp
                                    <td>
                                        @if ($data->feature_image)
                                            @if(file_exists($imagePath))
                                                <img src="{{ asset('images/products/' . $data->feature_image) }}" 
                                                    alt="Product Image" 
                                                    style="width: 50px; height: 50px; object-fit: cover;">
                                            @endif
                                        @endif
                                        
                                    </td>
                                    <td>
                                        {!! Str::before($data->description, '</p>') !!}
                                    </td>
                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input toggle-status" id="customSwitch{{ $data->id }}" data-id="{{ $data->id }}" {{ $data->status == 1 ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="customSwitch{{ $data->id }}"></label>
                                        </div>
                                    </td>

                                    <td>
                                        {{-- <a id="viewBtn" href="{{ route('product.show', $data->slug) }}">
                                            <i class="fa fa-eye" style="color: #4CAF50; font-size:16px;"></i>
                                        </a> --}}
                                        <a id="EditBtn" rid="{{ $data->id }}">
                                            <i class="fa fa-edit" style="color: #2196f3; font-size:16px;"></i>
                                        </a>
                                        <a id="deleteBtn" rid="{{ $data->id }}">
                                            <i class="fa fa-trash-o" style="color: red; font-size:16px;"></i>
                                        </a>
                                        {{-- <a href="{{ route('product.reviews.show', $data->id) }}" class="reviewBtn">
                                            <i class="fa fa-comments" style="color: #FF5722; font-size:16px; margin-right: 10px;" title="View Reviews"></i>
                                        </a> --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>

    .image-input-wrapper {
        flex: 0 0 auto;
        display: inline-block; 
        vertical-align: top;
        text-align: center;
        width: calc(25% - 10px);
        margin-bottom: 10px;
        position: relative;
    }

    .image-input-wrapper img {
        max-width: 100%;
        height: auto;
    }

    .image-input-icon {
        position: absolute;
        top: 5px;
        right: 5px;
        z-index: 10;
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 50%;
        padding: 5px;
        cursor: pointer;
    }

    .image-input-icon i {
        color: red;
    }

</style>

@endsection

@section('script')

<script>

    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false, "pageLength": 100,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });


</script>

<script>
  $(document).ready(function () {
      $("#addThisFormContainer").hide();
      $("#newBtn").click(function(){
          clearform();
          $("#newBtn").hide(100);
          $("#addThisFormContainer").show(300);
          $('#warranty-section').show();

      });
      $("#FormCloseBtn").click(function(){
          $("#addThisFormContainer").hide(200);
          $("#newBtn").show(100);
          clearform();
      });

      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

      var url = "{{URL::to('/admin/research')}}";
      var upurl = "{{URL::to('/admin/research-update')}}";

      $("#addBtn").click(function(){

          if($(this).val() == 'Create') {
              var form_data = new FormData();
                form_data.append("name", $("#name").val());
                form_data.append("description", $("#description").val());
                form_data.append("short_description", $("#short_description").val());
                form_data.append("category_id", $("#category_id").val());
                form_data.append("meta_title", $("#meta_title").val());
                form_data.append("meta_description", $("#meta_description").val());
                form_data.append("meta_keywords", $("#meta_keywords").val());


                var is_featured = $("#is_featured").is(":checked") ? 1 : 0;
                form_data.append("is_featured", is_featured);

                var is_recent = $("#is_recent").is(":checked") ? 1 : 0;
                form_data.append("is_recent", is_recent);

                var is_new_arrival = $("#is_new_arrival").is(":checked") ? 1 : 0;
                form_data.append("is_new_arrival", is_new_arrival);

                var is_top_rated = $("#is_top_rated").is(":checked") ? 1 : 0;
                form_data.append("is_top_rated", is_top_rated);

                var is_popular = $("#is_popular").is(":checked") ? 1 : 0;
                form_data.append("is_popular", is_popular);

                var is_trending = $("#is_trending").is(":checked") ? 1 : 0;
                form_data.append("is_trending", is_trending);


                    // for (var pair of form_data.entries()) {
                    //     console.log(pair[0]+ ', ' + pair[1]); 
                    // }

              $.ajax({
                url: url,
                method: "POST",
                contentType: false,
                processData: false,
                data:form_data,
                success: function (d) {
                    if (d.status == 400) {
                        $(".ermsg").html(d.message);
                        pagetop();
                    }else if(d.status == 300){
                        swal({
                            text: "Data Created",
                            icon: "success",
                            button: {
                                text: "OK",
                                className: "swal-button--confirm"
                            }
                        }).then(() => {
                            location.reload();
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                 }
              });
          }
          //create  end

          //Update
          if($(this).val() == 'Update'){
              var form_data = new FormData();
                form_data.append("name", $("#name").val());
                form_data.append("description", $("#description").val());
                form_data.append("short_description", $("#short_description").val());
                form_data.append("category_id", $("#category_id").val());
                form_data.append("meta_title", $("#meta_title").val());
                form_data.append("meta_description", $("#meta_description").val());
                form_data.append("meta_keywords", $("#meta_keywords").val());
                
                var is_featured = $("#is_featured").is(":checked") ? 1 : 0;
                form_data.append("is_featured", is_featured);

                var is_recent = $("#is_recent").is(":checked") ? 1 : 0;
                form_data.append("is_recent", is_recent);

                var is_new_arrival = $("#is_new_arrival").is(":checked") ? 1 : 0;
                form_data.append("is_new_arrival", is_new_arrival);

                var is_top_rated = $("#is_top_rated").is(":checked") ? 1 : 0;
                form_data.append("is_top_rated", is_top_rated);

                var is_popular = $("#is_popular").is(":checked") ? 1 : 0;
                form_data.append("is_popular", is_popular);

                var is_trending = $("#is_trending").is(":checked") ? 1 : 0;
                form_data.append("is_trending", is_trending);

                var featureImgInput = document.querySelector('#feature-img');
                if(featureImgInput.files && featureImgInput.files[0]) {
                    form_data.append("feature_image", featureImgInput.files[0]);
                }

                form_data.append("codeid", $("#codeid").val());

                // for (var pair of form_data.entries()) {
                //     console.log(pair[0]+ ', ' + pair[1]); 
                // }
 
              $.ajax({
                  url:upurl,
                  type: "POST",
                  dataType: 'json',
                  contentType: false,
                  processData: false,
                  data:form_data,
                  success: function(d){
                    //   console.log(d);
                      if (d.status == 400) {
                          $(".ermsg").html(d.message);
                          pagetop();
                      }else if(d.status == 300){
                          swal({
                            text: "Product Updated",
                            icon: "success",
                            button: {
                                text: "OK",
                                className: "swal-button--confirm"
                            }
                        }).then(() => {
                            location.reload();
                        });
                      }
                  },
                  error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                  }
              });
          }
        //Update  end
      });
      //Edit
      $("#contentContainer").on('click','#EditBtn', function(){
          $("#cardTitle").text('Update this data');
          codeid = $(this).attr('rid');
          info_url = url + '/'+codeid+'/edit';
          $.get(info_url,{},function(d){
              populateForm(d);
              pagetop();
          });
      });
      //Edit  end

      //Delete
      $("#contentContainer").on('click','#deleteBtn', function(){
            if(!confirm('Sure?')) return;
            codeid = $(this).attr('rid');
            info_url = url + '/'+codeid;
            $.ajax({
                url:info_url,
                method: "GET",
                type: "DELETE",
                data:{
                },
                success: function(d){
                    if(d.success) {
                        swal({
                          text: "Deleted",
                          icon: "success",
                          button: {
                              text: "OK",
                              className: "swal-button--confirm"
                          }
                      }).then(() => {
                          location.reload();
                      });
                    }
                },
                error:function(d){
                    // console.log(d);
                }
            });
        });
      //Delete  
      function populateForm(data){

          $("#name").val(data.name);
          $("#category_id").val(data.category_id);
          $("#meta_title").val(data.meta_title);
          $("#meta_description").val(data.meta_description);
          $("#meta_keywords").val(data.meta_keywords);
          $("#description").val(data.description);
          $('#description').summernote('code', data.description);

          $("#short_description").val(data.short_description);
          $('#short_description').summernote('code', data.short_description);

          $("#is_featured").prop('checked', data.is_featured == 1 ? true : false);
          $("#is_recent").prop('checked', data.is_recent == 1 ? true : false);
          $("#is_new_arrival").prop('checked', data.is_new_arrival == 1 ? true : false);
          $("#is_top_rated").prop('checked', data.is_top_rated == 1 ? true : false);
          $("#is_popular").prop('checked', data.is_popular == 1 ? true : false);
          $("#is_trending").prop('checked', data.is_trending == 1 ? true : false);



          $("#codeid").val(data.id);
          $("#addBtn").val('Update');
          $("#addBtn").html('Update');
          $("#addThisFormContainer").show(300);
          $("#newBtn").hide(100);

          var featureImagePreview = document.getElementById('preview-image');
            if (data.feature_image) { 
                featureImagePreview.src = '/images/products/' + data.feature_image; 
            } else {
                featureImagePreview.src = "#";
            }

          



      }
      function clearform(){
          $('#createThisForm')[0].reset();
          $("#addBtn").val('Create').text('Create');
          $("#addBtn").val('Create');
          $("#codeid").val('');
          $("#cardTitle").text('Add new data');
          $('#preview-image').attr('src', '#');
          $('#feature-img').val('');
          $('#imageUpload1').val('');
          $("#description").summernote('code', '');
          $("#short_description").summernote('code', '');
          $('#addBtn').attr('disabled', false);
      }
  });
</script>

<script>
    $(document).ready(function() {
        // Status Toggle
        $(document).on('change', '.toggle-status', function () {
            var isChecked = $(this).is(':checked');
            var itemId = $(this).data('id');

            $.ajax({
                url: '{{ route('researchtoggleStatus') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: itemId,
                    is_On: isChecked ? 1 : 0
                },
                success: function(d) {
                    swal({
                          text: "Status updated",
                          icon: "success",
                          button: {
                              text: "OK",
                              className: "swal-button--confirm"
                          }
                      });
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        });


    });
</script>

<script>
    $(document).ready(function(){
        $("#feature-img").change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $("#preview-image").attr("src", e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#description, #short_description').summernote({
            height: 200,
        });
    });
</script>

@endsection