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
				    <h3 class="box-title">Edit Membership</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
                        <form method="post" action="{{ route('membership.update') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $membership->id }}">
                            <div class="form-group">
                                <h5>Name<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text"  name="name" class="form-control" value="{{ $membership->name }}" > 
                                    @error('name') 
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror 
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Ic</h5>
                                <div class="controls">
                                    <input type="text"  name="ic" class="form-control" value="{{ $membership->ic }}"> 
                                    @error('ic') 
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror 
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Email</h5>
                                <div class="controls">
                                    <input type="email"  name="email" class="form-control" value="{{ $membership->email }}"> 
                                    @error('email') 
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror 
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Phone<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text"  name="phone" class="form-control" value="{{ $membership->phone }}"> 
                                    @error('phone') 
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror 
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Type<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text"  name="type" class="form-control" value="{{ $membership->type }}"> 
                                    @error('type') 
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