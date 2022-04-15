@extends('admin.admin_master')
@section('admin') 


<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row"> 
            <div class="col-8">
                <div class="box">
                    <div class="box-header with-border">
                    <h3 class="box-title">Report By Customer Name</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="post" action="{{ route('search-by-cust-name') }}">
                                @csrf
                                <div class="form-group">
                                    <h5>Insert Customer Name<span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <input type="text" name="customerName" id="customerName" class="form-control">
                                        @error('customerName')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Search">
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection