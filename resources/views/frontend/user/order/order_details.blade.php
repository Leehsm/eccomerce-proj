@extends('frontend.main_master')
@section('content')

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{ url('dashboard') }}">Dashboard</a></li>
				<li><a href="{{ route('my.orders') }}">OrderHistory</a></li>
				<li class='active'>Order Details</li>
			</ul>
		</div>
	</div>
</div>

<div class="body-content">
	<div class="container">
		<div class="row">
			{{-- @include('frontend.common.user_sidebar') --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><h4>Shipping Details</h4></div>
                    <hr>
                    <div class="card-body" style="background: #E9EBEC;">
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
            </div> <!-- // end col md -5 -->
            
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header"><h4>Order Details
                        <span class="text-danger"> Invoice : {{ $order->invoice_no }}</span></h4>
                    </div>
                    <hr>
                    <div class="card-body" style="background: #E9EBEC;">
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
                                <th> Notes : </th>
                                <th>{{ $order->notes }} </th>
                            </tr>
                            <tr>
                                <th> Order : </th>
                                <th>   
                                    <span class="badge badge-pill badge-warning" style="background: #418DB9;">{{ $order->status }} </span> 
                                </th>
                            </tr>
                        </table>
                    </div> 
                </div>
            </div> <!-- // 2ND end col md -5 -->
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr style="background: #e2e2e2;">
                                <td class="col-md-1">
                                    <label for=""> Image</label>
                                </td>
                                <td class="col-md-3">
                                    <label for=""> Product Name </label>
                                </td>
                
                                <td class="col-md-3">
                                    <label for=""> Product Code</label>
                                </td>
                                <td class="col-md-2">
                                    <label for=""> Color </label>
                                </td>
                                <td class="col-md-2">
                                    <label for=""> Size </label>
                                </td>
                                <td class="col-md-1">
                                    <label for=""> Quantity </label>
                                </td>
                                <td class="col-md-1">
                                    <label for=""> Price </label>
                                </td>
                                <td class="col-md-1">
                                    <label for=""> Total </label>
                                </td>
                            </tr>
                            @foreach($orderItem as $item)
                            <tr>
                                <td class="col-md-1">
                                    <label for=""><img src="{{ asset($item->product->product_thambnail) }}" height="50px;" width="50px;"> </label>
                                </td>
                                <td class="col-md-3">
                                    <label for=""> {{ $item->product->product_name_en }}</label>
                                </td>
                                <td class="col-md-3">
                                    <label for=""> {{ $item->product->product_code }}</label>
                                </td>
                                <td class="col-md-2">
                                    <label for=""> {{ $item->color }}</label>
                                </td>
                                <td class="col-md-2">
                                    <label for=""> {{ $item->size }}</label>
                                </td>
                                <td class="col-md-2">
                                    <label for=""> {{ $item->qty }}</label>
                                </td>
                                <td class="col-md-2">
                                    <label for=""> Rm{{ $item->price }}</label>
                                </td>
                                <td class="col-md-2">
                                    <label for="">RM{{ $item->price * $item->qty}}</label>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div> <!-- / end col md 8 -->
            </div> <!-- // END ORDER ITEM ROW -->
        </div> <!-- // end row -->
	</div>
</div>
@endsection 