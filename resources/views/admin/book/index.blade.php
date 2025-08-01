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
                        <h3 class="card-title" id="cardTitle">Add New Book</h3>
                    </div>
                    <div class="card-body">
                        <div class="ermsg"></div>
                        <form id="createThisForm">
                            @csrf
                            <input type="hidden" class="form-control" id="productId" name="productId">
                            <input type="hidden" class="form-control" id="codeid" name="codeid">

                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label for="name">Name<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="price">Price<span style="color: red;">*</span></label>
                                    <input type="number" class="form-control" id="price" name="price" placeholder="Enter price">
                                </div>
                                
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="short_description">Short Description<span style="color: red;">*</span></label>
                                    <textarea class="form-control" id="short_description" name="short_description" rows="3" placeholder="Enter short description"></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="description">Long Description<span style="color: red;">*</span></label>
                                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter long description"></textarea>
                                </div>
                            </div>

                            <div id="category-container">
                                <div class="form-row category-row">
                                    <div class="form-group col-md-4">
                                        <label for="category">Category<span style="color: red;">*</span></label>
                                        <select class="form-control category">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4 subcategory-section" style="display: none;">
                                        <label for="subcategory">Sub Category</label>
                                        <select class="form-control subcategory">
                                            <option value="">Select Sub Category</option>
                                            @foreach($subCategories as $subcategory)
                                                <option class="subcategory-option category-{{ $subcategory->category_id }}" value="{{ $subcategory->id }}" style="display: none;">
                                                    {{ $subcategory->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-1 d-flex align-items-end">
                                        <button type="button" class="btn btn-success add-row">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
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
                                <div class="col-sm-12">
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
                                <div class="form-group col-md-6 d-none" id="warranty-section">
                                    <label>Default Warranty Duration<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="warranty_duration" name="warranty_duration" placeholder="Enter warranty duration">
                                </div>
                            </div>

                            <!-- Image part start -->
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="feature-img">Feature Image</label>
                                    <input type="file" class="form-control-file" id="feature-img" accept="image/*">
                                    <img id="preview-image" src="#" alt="" style="max-width: 300px; width: 100%; height: auto; margin-top: 20px;">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Slider Images</label>
                                    <div id="dynamicImages">
                                        <div class="image-input-wrapper">
                                            <img src="#" alt="Choose image" id="previewImage1" style="width: 150px; height: auto;">
                                            <div class="image-input-icon">
                                                <i class="fas fa-times-circle remove-image" title="Remove this image"></i>
                                            </div>
                                            <input type="file" class="form-control-file" id="imageUpload1" onchange="loadFile(event)" multiple accept="image/*">
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-secondary btn-sm" onclick="addMoreImages()">+ Add More</button>
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
                                    <th>Product</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Category</th>
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
                                        @if(file_exists($imagePath))
                                            <img src="{{ asset('images/products/' . $data->feature_image) }}" 
                                                alt="Product Image" 
                                                style="width: 50px; height: 50px; object-fit: cover;">
                                        @endif
                                    </td>
                                    <td>{{ $data->price }}</td>
                                    <td>
                                        @foreach ($data->categoryProducts as $categoryProduct)
                                            <span class="badge bg-info">{{ $categoryProduct->category->name ?? '' }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input toggle-status" id="customSwitch{{ $data->id }}" data-id="{{ $data->id }}" {{ $data->status == 1 ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="customSwitch{{ $data->id }}"></label>
                                        </div>
                                    </td>

                                    <td>

                                        <button type="button" 
                                            class="btn btn-info btn-sm view-details" 
                                            data-id="{{ $data->id }}"
                                            data-name="{{ $data->name }}"
                                            data-description="{{ $data->description }}"
                                            data-short_description="{{ $data->short_description }}"
                                            data-price="{{ $data->price }}"
                                            data-meta_title="{{ $data->meta_title }}"
                                            data-meta_description="{{ $data->meta_description }}"
                                            data-meta_keywords="{{ $data->meta_keywords }}"
                                            data-feature_image="{{ $data->feature_image }}"
                                        >
                                            <i class="fa fa-eye"></i>
                                        </button>

                                        <a id="EditBtn" rid="{{ $data->id }}">
                                            <i class="fa fa-edit" style="color: #2196f3; font-size:16px;"></i>
                                        </a>
                                        <a id="deleteBtn" rid="{{ $data->id }}">
                                            <i class="fa fa-trash-o" style="color: red; font-size:16px;"></i>
                                        </a>
                                        
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
    #dynamicImages {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

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
    $(document).ready(function() {
        $('#subcategory-section').hide();
        //category change
        $(document).on('change', '.category', function() {
            var categoryId = $(this).val();
            var $row = $(this).closest('.category-row');

            if (categoryId) {
                $row.find('.subcategory').val('').find('option').hide();
                $row.find('.subcategory-option.category-' + categoryId).show();
                $row.find('.subcategory-section').show();

            } else {
                $row.find('.subcategory').val('').find('option').hide();
                $row.find('.subcategory-section').hide();
            }
        });

        // Handle subcategory change
        $(document).on('change', '.subcategory', function() {
            var subcategoryId = $(this).val();
            var $row = $(this).closest('.category-row');

        });

        // Add new row
        $(document).on("click", ".add-row", function () {
            let row = $(this).closest(".category-row").clone();

            row.find(".category").val("");
            row.find(".subcategory").val("");
            row.find('input[name="category_product_ids[]"]').val("");
            row.find('.subcategory-section').hide();

            row.find("button").removeClass("btn-success add-row").addClass("btn-danger remove-row").html('<i class="fas fa-minus"></i>');

            $("#category-container").append(row);
        });

        // Remove row
        $(document).on("click", ".remove-row", function () {
            $(this).closest(".category-row").remove();
        });
    });
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

      var url = "{{URL::to('/admin/book')}}";
      var upurl = "{{URL::to('/admin/book-update')}}";

      $("#addBtn").click(function(){

          if($(this).val() == 'Create') {
              var form_data = new FormData();
                form_data.append("name", $("#name").val());
                form_data.append("description", $("#description").val());
                form_data.append("short_description", $("#short_description").val());
                form_data.append("price", $("#price").val());
                form_data.append("qty", $("#qty").val());
                form_data.append("meta_title", $("#meta_title").val());
                form_data.append("meta_description", $("#meta_description").val());
                form_data.append("meta_keywords", $("#meta_keywords").val());

                let categories = [];

                $('.category-row').each(function() {
                    let categoryId = $(this).find('.category').val();
                    let subcategoryId = $(this).find('.subcategory').val();

                    categories.push({
                        category_id: categoryId || null,
                        sub_category_id: subcategoryId || null
                    });
                });

                form_data.append("categories", JSON.stringify(categories));

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


                var featureImgInput = document.getElementById('feature-img');
                if(featureImgInput.files && featureImgInput.files[0]) {
                    form_data.append("feature_image", featureImgInput.files[0]);
                }

                prepareImageData(form_data);

                function prepareImageData(form_data) {
                    $(".image-input-wrapper").each(function(index) {
                        var imageInputs = $(this).find('input[type=file]');
                        imageInputs.each(function() {
                            var files = this.files; 
                            if (files && files.length > 0) {
                                Array.from(files).forEach(file => {
                                    form_data.append("images[]", file);
                                });
                            }
                        });
                    });
                }

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
                            text: "Product Created",
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
                form_data.append("price", $("#price").val());
                form_data.append("category_id", $("#category").val());
                form_data.append("sub_category_id", $("#subcategory").val());
                form_data.append("brand_id", $("#brand").val());
                form_data.append("product_model_id", $("#model").val());
                form_data.append("group_id", $("#group").val());
                form_data.append("unit_id", $("#unit").val());
                form_data.append("product_code", $("#product_code").val());
                form_data.append("qty", $("#qty").val());
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


                collectAndAppendImages(form_data);


                function collectAndAppendImages(form_data) {
                    $(".image-input-wrapper").each(function() {
                        var hasPrePopulatedImage = $(this).find('img[src*="/images/products/"]').length > 0;

                        var imageInputs = $(this).find('input[type=file]');
                        imageInputs.each(function() {
                            var files = this.files; 
                            if (files && files.length > 0) {
                                Array.from(files).forEach(file => {
                                    form_data.append("images[]", file);
                                });
                            }
                        });

                        if (hasPrePopulatedImage) {
                            var imgSrc = $(this).find('img[src*="/images/products/"]').attr('src');
                            var imageName = imgSrc.substring(imgSrc.lastIndexOf('/') + 1);
                            form_data.append("images[]", imageName);
                        }
                    });
                }

                let categories = [];

                $('.category-row').each(function() {
                    let categoryId = $(this).find('.category').val();
                    let subcategoryId = $(this).find('.subcategory').val();
                    let categoryProductId = $(this).find('input[name="category_product_ids[]"]').val();

                    categories.push({
                        categoryProductId: categoryProductId,
                        category_id: categoryId,
                        sub_category_id: subcategoryId,
                    });
                });

                form_data.append("categories", JSON.stringify(categories));

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
          $("#qty").val(data.qty);
          $("#meta_title").val(data.meta_title);
          $("#meta_description").val(data.meta_description);
          $("#meta_keywords").val(data.meta_keywords);
          $("#description").val(data.description);
          $('#description').summernote('code', data.description);

          $("#short_description").val(data.short_description);
          $('#short_description').summernote('code', data.short_description);

          $("#price").val(data.price);
          $("#product_code").val(data.product_code);
          $("#is_featured").prop('checked', data.is_featured == 1 ? true : false);
          $("#is_recent").prop('checked', data.is_recent == 1 ? true : false);
          $("#is_new_arrival").prop('checked', data.is_new_arrival == 1 ? true : false);
          $("#is_top_rated").prop('checked', data.is_top_rated == 1 ? true : false);
          $("#is_popular").prop('checked', data.is_popular == 1 ? true : false);
          $("#is_trending").prop('checked', data.is_trending == 1 ? true : false);



            $("#category-container").empty();

            if (data.category_products && data.category_products.length > 0) {
                data.category_products.forEach(function(categoryProduct, index) {
                    appendCategoryRow(categoryProduct.category_id, categoryProduct.sub_category_id, categoryProduct.sub_sub_category_id, categoryProduct.id, index === 0);
                });
            }  else {
                appendCategoryRow('', '', '', '', true);
            }

          $("#brand").val(data.brand_id);
          $("#model").val(data.product_model_id);
          $("#group").val(data.group_id);
          $("#unit").val(data.unit_id);

          $('#warranty-section').hide();

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

          if (data.images && data.images.length > 0) {
            var imagesHTML = '';
            data.images.forEach(function(image) {
                var imagePath = '/images/products/' + image.image;
                imagesHTML += '<div class="image-input-wrapper">';
                imagesHTML += '<img src="' + imagePath + '" alt="Product Image" style="width: 150px; height: 150px; object-fit: cover;">';
                imagesHTML += '<div class="image-input-icon"><i class="fas fa-times-circle remove-image" title="Remove this image"></i></div>';
                imagesHTML += '</div>';
            });
            $('#dynamicImages').html(imagesHTML);

             $('#dynamicImages').on('click', '.remove-image', function(e) {
                e.preventDefault();
                $(this).closest('.image-input-wrapper').remove();
            });
        }

        function appendCategoryRow(categoryId, subCategoryId, categoryProductId, isFirstRow = false) {
            var categoryRow = `
                <div class="form-row category-row">
                    <div class="form-group col-md-4">
                        <label for="category">Category<span style="color: red;">*</span></label>
                        <input type="hidden" name="category_product_ids[]" value="${categoryProductId}">
                        <select class="form-control category" data-category-product-id="${categoryProductId}">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" ${categoryId == {{ $category->id }} ? 'selected' : ''}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4 subcategory-section" style="display: ${categoryProductId ? 'block' : 'none'};">
                        <label for="subcategory">Sub Category</label>
                        <select class="form-control subcategory">
                            <option value="">Select Sub Category</option>
                            @foreach($subCategories as $subcategory)
                                <option class="subcategory-option category-{{ $subcategory->category_id }}" value="{{ $subcategory->id }}" 
                                    data-category-id="{{ $subcategory->category_id }}" 
                                    ${categoryId == {{ $subcategory->category_id }} ? '' : 'style="display: none;"'} 
                                    ${subCategoryId == {{ $subcategory->id }} ? 'selected' : ''}>
                                    {{ $subcategory->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>



                    <div class="form-group col-md-1 d-flex align-items-end">
                        ${isFirstRow 
                            ? `<button type="button" class="btn btn-success add-row"><i class="fas fa-plus"></i></button>` 
                            : `<button type="button" class="btn btn-danger remove-row"><i class="fas fa-minus"></i></button>`}
                    </div>

                    <input type="hidden" name="category_product_ids[]" value="${categoryProductId}" />
                </div>
            `;

            $("#category-container").append(categoryRow);
        }

      }
      function clearform(){
          $('#createThisForm')[0].reset();
          $("#addBtn").val('Create').text('Create');
          $("#addBtn").val('Create');
          $("#codeid").val('');
          $("#cardTitle").text('Add new data');
          $('#preview-image').attr('src', '#');
          $('#dynamicImages').empty();
          $('#feature-img').val('');
          $('#imageUpload1').val('');
          $("#description").summernote('code', '');
          $("#short_description").summernote('code', '');
          $("#category-container .category-row:not(:first)").remove();
          var firstRow = $("#category-container .category-row:first");
          firstRow.find(".category").val('');
          firstRow.find(".subcategory").val('');
          firstRow.find(".category").removeAttr("data-category-product-id");
          firstRow.find(".subcategory-section").hide();
          $('#addBtn').attr('disabled', false);
      }


      // view details in modal
    $("#contentContainer").on('click', '.view-details', function() {
        var name = $(this).data('name');
        var description = $(this).data('description');
        var short_description = $(this).data('short_description');
        var price = $(this).data('price');
        var meta_title = $(this).data('meta_title');
        var meta_description = $(this).data('meta_description');
        var meta_keywords = $(this).data('meta_keywords');
        var feature_image = $(this).data('feature_image');

        var modalHtml = `
            <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">${name}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <img src="/images/products/${feature_image}" alt="Feature Image" style="max-width:200px; margin-bottom:15px;">
                    <p><strong>Price:</strong> ${price}</p>
                    <p><strong>Short Description:</strong> ${short_description}</p>
                    <p><strong>Description:</strong> ${description}</p>
                    <p><strong>Meta Title:</strong> ${meta_title}</p>
                    <p><strong>Meta Description:</strong> ${meta_description}</p>
                    <p><strong>Meta Keywords:</strong> ${meta_keywords}</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
        `;

        // Remove any existing modal
        $('#detailsModal').remove();
        // Append modal to body
        $('body').append(modalHtml);
        // Show modal
        $('#detailsModal').modal('show');
    });


  });
</script>

<script>
   let imagesCount = 1;

    function loadFile(event) {
        const output = document.getElementById('previewImage' + event.target.id.split('imageUpload')[1]);
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = () => URL.revokeObjectURL(output.src);
    }

    function addMoreImages() {
        imagesCount++;
        const newInputDiv = document.createElement('div');
        newInputDiv.classList.add('image-input-wrapper');

        newInputDiv.innerHTML = `
            <img src="#" alt="Choose image" id="previewImage${imagesCount}" style="width: 150px; height: 150px; object-fit: cover;">
            <div class="image-input-icon">
                <i class="fas fa-times-circle remove-image" title="Remove this image"></i>
            </div>
            <input type="file" class="form-control-file" id="imageUpload${imagesCount}" onchange="loadFile(event)" multiple accept="image/*">`;

        document.getElementById('dynamicImages').appendChild(newInputDiv);

        newInputDiv.querySelector('.remove-image').addEventListener('click', function() {
            newInputDiv.remove();
        });
    }

</script>

<script>
    $(document).ready(function() {
        // Status Toggle
        $(document).on('change', '.toggle-status', function () {
            var isChecked = $(this).is(':checked');
            var itemId = $(this).data('id');

            $.ajax({
                url: '{{ route('booktoggleStatus') }}',
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

        // Featured Toggle
        $(document).on('change', '.toggle-featured', function () {
            var isChecked = $(this).is(':checked');
            var itemId = $(this).data('id');

            $.ajax({
                url: '/admin/toggle-featured',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: itemId,
                    is_featured: isChecked ? 1 : 0
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

        // Popular Toggle
        $(document).on('change', '.toggle-popular', function () {
            var isChecked = $(this).is(':checked');
            var itemId = $(this).data('id');

            $.ajax({
                url: '/admin/toggle-popular',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: itemId,
                    is_popular: isChecked ? 1 : 0
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

        // Trending Toggle
        $(document).on('change', '.toggle-trending', function () {
            var isChecked = $(this).is(':checked');
            var itemId = $(this).data('id');

            $.ajax({
                url: '/admin/toggle-trending',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: itemId,
                    is_trending: isChecked ? 1 : 0
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

        // Recent Toggle
        $(document).on('change', '.toggle-recent', function () {
            var isChecked = $(this).is(':checked');
            var itemId = $(this).data('id');

            $.ajax({
                url: '/admin/toggle-recent',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: itemId,
                    is_recent: isChecked ? 1 : 0
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