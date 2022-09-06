@extends('admin.admin_master')
@section('admin')

<!-- Content Wrapper. Contains page content -->
<div class="container-full">
<!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Contact List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Contact call </th>
                                    <th>Contact company</th>
                                    <th>Contact location </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contacts as $contact)
                                <tr>
                                    <td> {{ $contact->contact_call }} </td>
                                    <td> {{ $contact->contact_company }} </td>
                                    <td> {{ $contact->contact_location }} </td>
                                    <td width="30%">   
                                        <a href="{{ route('contact.edit',$contact->id) }}" class="btn btn-info btn-sm" title="Edit Data"><i class="fa fa-pencil"></i> </a>
                                        <a href="{{ route('contact.delete',$contact->id) }}" class="btn btn-danger btn-sm" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->

<!--   ------------ Add Category Page -------- -->

            <div class="col-4">
                <div class="box">
                    <div class="box-header with-border">
                    <h3 class="box-title">Add Contact </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="post" action="{{ route('contact.store') }}" >
                                @csrf
                                <div class="form-group">
                                    <h5> Contact call  <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text"  name="contact_call" class="form-control" > 
                                        @error('contact_call') 
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5> Contact company  <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text"  name="contact_company" class="form-control" > 
                                        @error('contact_company') 
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5> Contact location  <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text"  name="contact_location" class="form-control" > 
                                        @error('contact_location') 
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
                <!-- /.box --> 
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection 