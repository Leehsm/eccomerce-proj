@extends('admin.admin_master_stock')
@section('admin')

<!-- Content Wrapper. Contains page content -->
<div class="container-full">
	<!-- Content Header (Page header) -->
	<!-- Main content -->
	<section class="content">
	    <div class="row">

<!--   ------------ Edit Slider Page -------- -->

        <div class="col-12">
			<div class="box">
				<div class="box-header with-border">
				    <h3 class="box-title">Edit Skincare</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
                        <form method="post" action="{{ route('skincare.update') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $skincare->id }}">	
                            <input type="hidden" name="old_image" value="{{ $skincare->image }}">	
                            <div class="form-group">
                                <h5>Category <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text"  name="category" class="form-control" value="{{ $skincare->category }}" > 
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="name" class="form-control" value="{{ $skincare->name }}" >
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Size <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="size" class="form-control" value="{{ $skincare->size }}" >
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Color <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="color" class="form-control" value="{{ $skincare->color }}" >
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Quantity <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="quantity" class="form-control" value="{{ $skincare->quantity }}" >
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Image <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="file" name="image" class="form-control" >
                                    @error('image') 
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror 
                                </div>
                            </div>
                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update">					 
                            </div>
		                </form>
					</div>
				</div>
			<!-- /.box-body -->
			</div>
	    <!-- /.box --> 
		</div>
    </div>
	<!-- /.row -->
	</section>
<!-- /.content -->
</div>
@endsection 