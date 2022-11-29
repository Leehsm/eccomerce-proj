@extends('admin.admin_master')
@section('admin')

<!-- Content Wrapper. Contains page content -->
<div class="container-full">
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Cancel Order Details</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Cancel Order</li>
                            <li class="breadcrumb-item active" aria-current="page">Cancel Order Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="box box-bordered border-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title"><strong>Shipping Details</strong></h4>
                    </div>
                    <table class="table">
                        <tr>
                            <th> Name : </th>
                            <th> {{ $order->name }} </th>
                        </tr>
                        <tr>
                            <th> Phone : </th>
                            <th> {{ $order->phone }} </th>
                        </tr>
                        <tr>
                            <th> Email : </th>
                            <th> {{ $order->email }} </th>
                        </tr>
                        <tr>
                            <th> Address : </th>
                            <th> {{ $order->address1 }}, 
                                {{ $order->address2 }}, 
                                {{ $order->post_code }}, 
                                {{ $order->district }},
                                {{ $order->state }}, 
                                {{ $order->country }} </th>
                        </tr>
                        <tr>
                            <th> Order Date : </th>
                            <th> {{ $order->order_date }} </th>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="box box-bordered border-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title">
                            <strong>Order Details <span class="text-danger"> #{{ $order->invoice_no }}</span></strong>
                        </h4>
                    </div>
                    <table class="table">
                        <tr>
                            <th>  Name : </th>
                            <th> {{ $order->user->name }} </th>
                        </tr>
                        <tr>
                            <th>  Phone : </th>
                            <th> {{ $order->user->phone }} </th>
                        </tr>
                        <tr>
                            <th> Payment Type : </th>
                            <th> {{ $order->payment_method }} </th>
                        </tr>
                        <tr>
                            <th> Tranx ID : </th>
                            <th> {{ $order->transaction_id }} </th>
                        </tr>
                        <tr>
                            <th> Invoice  : </th>
                            <th class="text-danger"> {{ $order->invoice_no }} </th>
                        </tr>
                        <tr>
                            <th> Order Total : </th>
                            <th>{{ $order->amount }} </th>
                        </tr>
                        <tr>
                            <th> Order : </th>
                            <th> 
                                <span class="badge badge-pill badge-primary">  {{$order->status}} </span>
                            </th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-12">
            <div class="box box-bordered border-primary">
                <table class="table">
                    <tbody>
                        <tr >
                            <td width="10%">
                                <label for=""> Image</label>
                            </td>
                            <td width="20%">
                                <label for=""> Product Name </label>
                            </td>
                            <td width="10%">
                                <label for=""> Product Code</label>
                            </td>
                            <td width="10%">
                                <label for=""> Color </label>
                            </td>
                            <td width="10%">
                                <label for=""> Size </label>
                            </td>
                            <td width="10%">
                                <label for=""> Quantity </label>
                            </td>
                            <td width="10%">
                                <label for=""> Price </label>
                            </td>
                        </tr>
                        @foreach($orderItem as $item)
                        <tr>
                            <td width="10%">
                                <label for=""><img src="{{ asset($item->product->product_thambnail) }}" height="50px;" width="50px;"> </label>
                            </td>
                            <td width="20%">
                                <label for=""> {{ $item->product->product_name_en }}</label>
                            </td>
                            <td width="10%">
                                <label for=""> {{ $item->product->product_code }}</label>
                            </td>
                            <td width="10%">
                                <label for=""> {{ $item->color }}</label>
                            </td>
                            <td width="10%">
                                <label for=""> {{ $item->size }}</label>
                            </td>
                            <td width="10%">
                                <label for=""> {{ $item->qty }}</label>
                            </td>
                            <td width="10%">
                                <label for=""> Rm{{ $item->price }}
                                    <br>
                                    ( RM{{ $item->price * $item->qty}} ) 
                                </label>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Main content -->
    </section>
    <!-- /.content -->
</div>
@endsection 