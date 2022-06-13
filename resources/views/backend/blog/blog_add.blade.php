@extends('admin.admin_master')
@section('admin')

<!-- Content Wrapper. Contains page content -->
<div class="container-full">
	<!-- Content Header (Page header) -->
	    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Blog</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="post" action="{{ route('blog.store') }}" enctype="multipart/form-data">
                            @csrf
                                <div class="form-group">
                                    <h5>Blog Image </h5>
                                    <div class="controls">
                                        <input type="file" name="blogImg" class="form-control" >
                                        @error('blogImg') 
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Blog Title  </h5>
                                    <div class="controls">
                                        <input type="text"  name="title" class="form-control" > 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Blog Date (DD/MM/YYYY) </h5>
                                    <div class="controls">
                                        <input type="text"  name="date" class="form-control" > 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Blog Short Description </h5>
                                    <div class="controls">
                                        <textarea id="description" name="description" rows="10" cols="130" required="">
                                            Blog Description  
                                        </textarea>     
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Blog Long Description </h5>
                                    <div class="controls">
                                        <textarea id="long_description" name="long_description" rows="10" cols="130">
                                            Blog Long Description  
                                        </textarea>     
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Blog Long Description 2</h5>
                                    <div class="controls">
                                        <textarea id="long_description2" name="long_description2" rows="10" cols="130">
                                            Blog Long Description  2
                                        </textarea>     
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Multiple Image <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="multi_img_blog[]" class="form-control" multiple="" id="multiImgBlog" required>
                                            @error('multi_img') 
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <div class="row" id="preview_img_blog"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add New">					 
                                </div>
                            </form>
                        </div>
                    </div>
                        <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ---------------------------Show Multi Image JavaScript Code ------------------------ --}}

<script>
 
    $(document).ready(function(){
     $('#multiImgBlog').on('change', function(){ //on file input change
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {
            var data = $(this)[0].files; //this file data
             
            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                    return function(e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                    .height(80); //create image element 
                        $('#preview_img_blog').append(img); //append image to output element
                    };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });
             
        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }
     });
    });
     
</script>
  {{-- ================================= End Show Multi Image JavaScript Code. ==================== --}}

@endsection