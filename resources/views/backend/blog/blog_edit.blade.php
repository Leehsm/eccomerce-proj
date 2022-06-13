@extends('admin.admin_master')
@section('admin')

<!-- Content Wrapper. Contains page content -->
<div class="container-full">
	<section class="content">
	    <div class="row"><div class="col-12">
			<div class="box">
				<div class="box-header with-border">
				    <h3 class="box-title">Edit Blog </h3>
				</div>
				<div class="box-body">
					<div class="table-responsive">
                        <form method="post" action="{{ route('blog.update', $blogs->id) }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $blogs->id }}">	
                            <input type="hidden" name="old_image" value="{{ $blogs->blogImg }}">	
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
                                <h5>Blog Title </h5>
                                <div class="controls">
                                    <input type="text"  name="title" class="form-control" value="{{ $blogs->title }}" > 
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Blog Date (DD/MM/YYYY)</h5>
                                <div class="controls">
                                    <input type="text"  name="date" class="form-control" value="{{ $blogs->date }}" > 
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Blog Short Decription </h5>
                                <div class="controls">
                                    <textarea id="description" name="description" rows="16" cols="100" required="">
                                    {!! $blogs->description !!} 
                                    </textarea>     
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Blog Long Decription </h5>
                                <div class="controls">
                                    <textarea id="long_description" name="long_description" rows="16" cols="100" required="">
                                    {!! $blogs->long_description !!} 
                                    </textarea>     
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>Blog Long Decription 2</h5>
                                <div class="controls">
                                    <textarea id="long_description2" name="long_description2" rows="16" cols="100" >
                                    {!! $blogs->long_description2 !!} 
                                    </textarea>     
                                </div>
                            </div>

                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update">					 
                            </div>
		                </form>
					</div>
				</div>
			</div>
		</div>
    </div>
	</section>

    <!-- ///////////////// Start Multiple Image Update Area ///////// -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
               <div class="box bt-3 border-info">
                    <div class="box-header">
                        <h4 class="box-title">Blog Slider Image <strong>Update</strong></h4>
                    </div>

                    <form method="post" action="{{ route('update-blog-slider-image') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row row-sm">
                            @foreach($multiImgSliders as $img)
                            <div class="col-md-3">
                                <div class="card">
                                    <img src="{{ asset($img->photo_name) }}" class="card-img-top" style="height: 130px; width: 280px;">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="{{ route('blog-multiimg-slider-delete',$img->id) }}" class="btn btn-sm btn-danger" id="delete" title="Delete Data"><i class="fa fa-trash"></i> </a>
                                        </h5>
                                        <p class="card-text"> 
                                            <div class="form-group">
                                                <label class="form-control-label">Change Image <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="file" name="multi_img[{{ $img->id }}]">
                                            </div> 
                                        </p>
                                    </div>
                                </div> 	
                            </div>
                            @endforeach
                        </div>			
                        <div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image">
                        </div>
                        <br><br>
                    </form>	
               </div>
            </div>
        </div> <!-- // end row  -->
    </section>

</div>
@endsection 