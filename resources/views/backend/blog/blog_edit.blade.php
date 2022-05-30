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
                                    <textarea id="description2" name="description2" rows="16" cols="100" required="">
                                    {!! $blogs->description2 !!} 
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
</div>
@endsection 