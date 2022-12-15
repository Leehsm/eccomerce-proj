@extends('admin.admin_master_stock')
@section('admin') 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div class="container-full">

    <!-- Main content -->
    <section class="content">
    <!-- Basic Forms -->
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">Add Customer Membership</h4>
        </div>
            <div class="row">
                <div class="col-12">
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="post" action="{{ route('membership.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <h5>Name<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text"  name="name" class="form-control" > 
                                        @error('name') 
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Ic</h5>
                                    <div class="controls">
                                        <input type="text"  name="ic" class="form-control" > 
                                        @error('ic') 
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Email</h5>
                                    <div class="controls">
                                        <input type="email"  name="email" class="form-control" > 
                                        @error('email') 
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Phone<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text"  name="phone" class="form-control" > 
                                        @error('phone') 
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Type<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text"  name="type" class="form-control" > 
                                        @error('type') 
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror 
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
            <!-- /.row -->
    </div>
    </section>
    <!-- /.content -->
</div>
@endsection