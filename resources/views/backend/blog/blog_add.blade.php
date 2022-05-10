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
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Blog </h3>
                        </div>
                        <!-- /.box-header -->
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
                                            <textarea id="long_description" name="long_description" rows="10" cols="130" required="">
                                                Blog Long Description  
                                            </textarea>     
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
<!-- /.box --> 
</div>
@endsection