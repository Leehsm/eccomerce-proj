@extends('admin.admin_master')
@section('admin')

<!-- Content Wrapper. Contains page content -->
<div class="container-full">
<!-- Content Header (Page header) -->
<!-- Main content -->
	<section class="content">
		<div class="row">
<!--   ------------ Add contact Page -------- -->
            <div class="col-12">
			    <div class="box">
				    <div class="box-header with-border">
                        <h3 class="box-title">Edit Contact </h3>
                    </div>
				    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="post" action="{{ route('contact.update',$contacts->id) }}" >
                                @csrf
                                <div class="form-group">
                                    <h5>Contact call  <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text"  call="contact_call" class="form-control" value="{{ $contacts->contact_call }}"> 
                                        @error('contact_call') 
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror 
                                    </div>
                                </div>
	                            <div class="form-group">
                                    <h5>Contact company <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text"  call="contact_company" class="form-control" value="{{ $contacts->contact_company }}"> 
                                        @error('contact_company') 
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Contact location <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text"  call="contact_location" class="form-control" value="{{ $contacts->contact_location }}"> 
                                        @error('contact_location') 
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