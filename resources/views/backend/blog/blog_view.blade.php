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
                            <h3 class="box-title">Blog List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Blog Image </th>
                                        <th>Title</th>
                                        <th>Date (DD/MM/YYYY) </th>
                                        <th>Status</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($blog as $item)
                                    <tr>
                                        <td><img src="{{ asset($item->blogImg) }}" style="width: 70px; height: 40px;"> </td>
                                        <td>
                                            @if($item->title == NULL)
                                            <span class="badge badge-pill badge-danger"> No Title </span>
                                            @else
                                            {{ $item->title }}
                                            @endif
                                        </td>
                                        <td>{{ $item->date }}</td>
                                        <td>
                                            @if($item->status == 1)
                                                <span class="badge badge-pill badge-success"> Active </span>
                                            @else
                                                <span class="badge badge-pill badge-danger"> InActive </span>
                                            @endif

                                        </td>
                                        <td width="30%">   
                                            <a href="{{ route('blog.edit',$item->id) }}" class="btn btn-info btn-sm" title="Edit Data"><i class="fa fa-pencil"></i> </a>
                                            <a href="{{ route('blog.delete',$item->id) }}" class="btn btn-danger btn-sm" title="Delete Data" id="delete">
                                            <i class="fa fa-trash"></i></a>

                                            @if($item->status == 1)
                                                <a href="{{ route('blog.inactive',$item->id) }}" class="btn btn-danger btn-sm" title="Inactive Now"><i class="fa fa-arrow-down"></i> </a>
                                            @else
                                                <a href="{{ route('blog.active',$item->id) }}" class="btn btn-success btn-sm" title="Active Now"><i class="fa fa-arrow-up"></i> </a>
                                            @endif
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
        </div>
        <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

@endsection 