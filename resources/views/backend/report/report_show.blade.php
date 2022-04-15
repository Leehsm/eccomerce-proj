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
                        <h3 class="box-title">Orders List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Date </th>
                                    <th>Customer Name </th>
                                    <th>Invoice</th>
                                    <th>Amount </th>
                                    <th>Payment </th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $item)
                                <tr>
                                    <td> {{ $item->order_date }}  </td>
                                    <td> {{ $item->name }} </td>
                                    <td> {{ $item->invoice_no }} </td>
                                    <td> RM{{ $item->amount }} </td>
                                    <td> {{ $item->payment_method }} </td>
                                    <td> 
                                        @if($item->status == 'Pending')
                                            <span class="badge badge-pill badge-danger"> {{$item->status}} </span>
                                        @elseif($item->status == 'Confirm')
                                            <span class="badge badge-pill badge-warning"> {{$item->status}} </span>
                                        @elseif($item->status == 'Processing')
                                            <span class="badge badge-pill badge-light"> {{$item->status}} </span>
                                        @elseif($item->status == 'Picked')
                                            <span class="badge badge-pill badge-dark"> {{$item->status}} </span>
                                        @elseif($item->status == 'Shipped')
                                            <span class="badge badge-pill badge-info"> {{$item->status}} </span>
                                        @elseif($item->status == 'Delivered')
                                            <span class="badge badge-pill badge-success"> {{$item->status}} </span>
                                        @else
                                            <span class="badge badge-pill badge-warning"> {{$item->status}} </span>
                                        @endif

                                    </td>
                                    <td width="25%">
                                        <a href="{{ route('confirmed-orders-details',$item->id) }}" class="btn btn-info" title="Edit Data"><i class="fa fa-eye"></i> </a>
                                        <a  target="_blank" href="{{ route('invoice-download',$item->id) }}" class="btn btn-danger" title="Invoice">
                                        <i class="fa fa-download"></i></a>
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