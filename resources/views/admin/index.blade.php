@extends('admin.admin_master')
@section('admin')

@php

$date = date('DD m YY');
$date2 = date('DD');
$month = date('m');
$month2 = date('F');

$DailyCustomer = DB::table('users')->where('created_at', 'LIKE', "%-%-$date2")->count();
$montlyCustomer = DB::table('users')->where('created_at', 'LIKE', "%-$month-%")->count();
$totalCustomer = DB::table('users')->count();

$dailyOrder = DB::table('orders')->where('order_date',$date)->count();
$monthlyOrder = DB::table('orders')->where('order_month', 'LIKE', "$month2")->count();
$totalOrder = DB::table('orders')->count();

$dailySales = DB::table('orders')->where('order_date',$date)->where('status', '!=', 'CANCEL / UNSUCCESSFUL')->sum('amount');
$monthlySales = DB::table('orders')->where('order_date', 'LIKE', "%$month2%")->where('status', '!=', 'CANCEL / UNSUCCESSFUL')->sum('amount');
$totalSales = DB::table('orders')->where('status', '!=', 'CANCEL / UNSUCCESSFUL')->sum('amount');

$orders = DB::table('orders')->orderBy('order_date','DESC')->get();

$orderTrial1 = DB::table('products')
                ->join('order_items', 'products.id', '=', 'order_items.product_id')
                ->get(['product_qty', 'qty']);
               
$orderTrial2 = DB::table('products')
               ->join('order_items', 'products.id', '=', 'order_items.product_id')
               ->get(['qty']);

$orderTrial3 = DB::table('products')
                ->join('order_items', 'products.id', '=', 'order_items.product_id')
                ->select('products.*', 'order_items.product_id');

@endphp
    
<div class="container-full">
    {{-- {{$orderTrial1}} --}}
    {{-- {{$orderTrial2}} --}}
    {{-- {{$orderTrial3}} --}}
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xl-4 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">							
                        <div class="icon bg-primary-light rounded w-60 h-60">
                            <i class="text-primary mr-0 font-size-24 mdi mdi-account-multiple"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">New Users</p>
                            <h3 class="text-white mb-0 font-weight-500">{{$DailyCustomer}} </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">							
                        <div class="icon bg-primary-light rounded w-60 h-60">
                            <i class="text-primary mr-0 font-size-24 mdi mdi-account-multiple"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">Monthly New Users</p>
                            <h3 class="text-white mb-0 font-weight-500">{{$montlyCustomer}} </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">							
                        <div class="icon bg-primary-light rounded w-60 h-60">
                            <i class="text-primary mr-0 font-size-24 mdi mdi-account-multiple"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">Total Users</p>
                            <h3 class="text-white mb-0 font-weight-500">{{$totalCustomer}} </h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">							
                        <div class="icon bg-danger-light rounded w-60 h-60">
                            <i class="text-danger mr-0 font-size-24 mdi mdi-cart-outline"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">Daily Order</p>
                            <h3 class="text-white mb-0 font-weight-500">{{$dailyOrder}} </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">							
                        <div class="icon bg-danger-light rounded w-60 h-60">
                            <i class="text-danger mr-0 font-size-24 mdi mdi-cart-outline"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">Monthly Order</p>
                            <h3 class="text-white mb-0 font-weight-500">{{$monthlyOrder}} </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">							
                        <div class="icon bg-danger-light rounded w-60 h-60">
                            <i class="text-danger mr-0 font-size-24 mdi mdi-cart-outline"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">Total Order</p>
                            <h3 class="text-white mb-0 font-weight-500">{{$totalOrder}}</h3>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-4 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">							
                        <div class="icon bg-info-light rounded w-60 h-60">
                            <i class="text-info mr-0 font-size-24 mdi mdi-sale mdi-spin"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">Daily Sales</p>
                            <h3 class="text-white mb-0 font-weight-500">RM {{ $dailySales }} </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">							
                        <div class="icon bg-info-light rounded w-60 h-60">
                            <i class="text-info mr-0 font-size-24 mdi mdi-sale mdi-spin"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">Monthly Sales</p>
                            <h3 class="text-white mb-0 font-weight-500">RM {{ $monthlySales }} </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">							
                        <div class="icon bg-info-light rounded w-60 h-60">
                            <i class="text-info mr-0 font-size-24 mdi mdi-sale mdi-spin"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">Total sales</p>
                            <h3 class="text-white mb-0 font-weight-500">RM {{ $totalSales }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title align-items-start flex-column">
                            List Orders
                        </h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-border">
                                <thead>
                                    <tr class="text-uppercase bg-lightest">
                                        <th style="min-width: 150px"><span class="text-white">Order Date</span></th>
                                        <th style="min-width: 150px"><span class="text-white">Invoice Number</span></th>
                                        <th style="min-width: 100px"><span class="text-white">Customer Name</span></th>
                                        <th style="min-width: 100px"><span class="text-white">Order Total</span></th>
                                        <th style="min-width: 100px"><span class="text-white">Payment Method</span></th>
                                        <th style="min-width: 100px"><span class="text-white">Status</span></th>
                                        <th style="min-width: 120px"><span class="text-white">Action</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach($orders as $item)
                                        <tr>
                                            <td>
                                                <span class="text-fade font-weight-600 d-block font-size-16">
                                                    {{ $item->order_date }}
                                                </span>
                                            </td>
                                            <td class="pl-0 py-8">
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <span class="text-fade d-block">{{ $item->invoice_no }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-fade font-weight-600 d-block font-size-16">
                                                    {{ $item->name }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-fade font-weight-600 d-block font-size-16">
                                                    RM {{ $item->amount }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-fade font-weight-600 d-block font-size-16">
                                                    {{ $item->payment_method }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($item->status == 'Pending')
                                                    <span class="badge badge-pill badge-danger">Pending</span>
                                                @elseif ($item->status == 'Confirm') 
                                                    <span class="badge badge-pill badge-warning">Confirm</span>
                                                @elseif ($item->status == 'Processing') 
                                                    <span class="badge badge-pill badge-light">Processing</span>
                                                @elseif ($item->status == 'Picked') 
                                                    <span class="badge badge-pill badge-dark">Picked</span>
                                                @elseif ($item->status == 'Shipped') 
                                                    <span class="badge badge-pill badge-info">Shipped</span>
                                                @elseif ($item->status == 'Delivered') 
                                                    <span class="badge badge-pill badge-success">Delivered</span>
                                                @else 
                                                    <span class="badge badge-primary-light badge-lg">Cancel</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('pending-orders-details',$item->id) }}" class="waves-effect waves-light btn btn-info btn-circle mx-5" title="Edit Data"><span class="fa fa-eye"></span></a>
                                            </td>
                                        </tr>
                                        @endforeach	
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

@endsection
