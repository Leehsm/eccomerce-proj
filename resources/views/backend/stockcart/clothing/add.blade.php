@extends('admin.admin_master_stock')
@section('admin') 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div class="container-full">

    <!-- Main content -->
    <section class="content">
        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Add Clothing</h4>
            </div>
                <div class="row">
                    <div class="col-12">
                        <div class="box-body">
                            <div class="table-responsive">
                            <form method="post" action="{{ route('cloth.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <h5>Category<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="hidden"  name="category" class="form-control" value="Clothing" readonly> 
                                        @error('category') 
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror 
                                    </div>
                                </div>
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
                                    <h5>Size<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text"  name="size" class="form-control" > 
                                        @error('size') 
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Color<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text"  name="color" class="form-control" > 
                                        @error('color') 
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Quantity<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text"  name="quantity" class="form-control" > 
                                        @error('quantity') 
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror 
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <h5>Price<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text"  name="price" class="form-control"> 
                                        @error('price') 
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Image<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" name="image" class="form-control" >
                                        @error('image') 
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