@extends('frontend.main_master')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@section('title')
FPX Payment Page 
@endsection

<div class="breadcrumb">
	<div class="container">
		{{-- <div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href={{url('/')}}>Home</a></li>
				<li><a href="{{route('checkout')}}">Checkout</a></li>
				<li class='active'>FPX Payment</li>
			</ul>
		</div><!-- /.breadcrumb-inner --> --}}
	</div><!-- /.container -->
</div><!-- /.breadcrumb --> 

<div class="body-content">
	<div class="container">
		<div class="checkout-box ">
			<div class="row">
				<div class="col-md-6">
					<!-- checkout-progress-sidebar -->
					<div class="checkout-progress-sidebar ">
						<div class="panel-group">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="unicase-checkout-title">Your Shopping Amount </h4>
								</div>
								<div class="">
									<ul class="nav nav-checkout-progress list-unstyled">
										<hr>
										<strong>Name : </strong>  {{ $data['shipping_name'] }} <hr>
										<strong>Email : </strong>  {{ $data['shipping_email'] }} <hr>
										<strong>Phone : </strong>  {{ $data['shipping_phone'] }} <hr>
										<strong>Address : </strong> {{ $data['address1'] }}, {{ $data['address2'] }}, 
																	{{ $data['post_code'] }}, {{ $data['district'] }}, 
																	{{$data['state'] }}, {{ $data['country'] }} <hr>
										<strong>Notes : </strong>  {{ $data['notes'] }} <hr>								
										<li>
											@if(Session::has('coupon'))
												@if($data['state'] != 'SABAH' && $data['state'] != 'SARAWAK')
													<strong>SubTotal: </strong> RM{{ $cartTotal }} <hr>
													<strong>Coupon Name : </strong> {{ session()->get('coupon')['coupon_name'] }}
													( {{ session()->get('coupon')['coupon_discount'] }} % )
													<hr>
													<strong>Coupon Discount : </strong> RM{{ session()->get('coupon')['discount_amount'] }} 
													<hr>
													<strong>Shipping Price : </strong> RM 10.00
													<hr>
													<strong>Grand Total : </strong> RM{{ session()->get('coupon')['total_amount'] + 10.00 }} 
													<hr>
												@else
													<strong>SubTotal: </strong> RM{{ $cartTotal }} <hr>
													<strong>Coupon Name : </strong> {{ session()->get('coupon')['coupon_name'] }}
													( {{ session()->get('coupon')['coupon_discount'] }} % )
													<hr>
													<strong>Coupon Discount : </strong> RM{{ session()->get('coupon')['discount_amount'] }} 
													<hr>
													<strong>Shipping Price : </strong> RM 15.00
													<hr>
													<strong>Grand Total : </strong> RM{{ session()->get('coupon')['total_amount'] + 15.00 }} 
													<hr>
												@endif
											@else
												@if($data['state'] != 'SABAH' && $data['state'] != 'SARAWAK')
													<strong>SubTotal: </strong> RM{{ $cartTotal}} 
													<hr>
													<strong>Coupon Discount : </strong> 0 
													<hr>
													<strong>Shipping Price : </strong> RM 10.00
													<hr>
													<strong>Grand Total : </strong> RM{{ $data['amount']}}
													<hr>
												@else
													<strong>SubTotal: </strong> RM{{ $cartTotal}} 
													<hr>
													<strong>Coupon Discount : </strong> 0
													<hr>
													<strong>Shipping Price : </strong> RM 15.00
													<hr>
													<strong>Grand Total : </strong> RM{{ $data['amount']}}
													<hr>
												@endif
											@endif 
										</li>
									</ul>		
								</div>
							</div>
						</div>
					</div> 
				<!-- checkout-progress-sidebar -->
				</div> <!--  // end col md 6 -->
				<div class="col-md-6">				<!-- checkout-progress-sidebar -->
					<div class="checkout-progress-sidebar ">
						<div class="panel-group">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="unicase-checkout-title">Proceed Your Payment</h4>
								</div>
								{{-- <form id="payment-form" action="{{route('toyyibpay-create')}} " method="post" id="payment-form"> --}}
								<form method="POST" action="{{route('toyyibpay-create')}}" id="payment-form" >
								{{-- <form method="POST" action="{{url('/billplzcheckout')}}" id="payment-form" > --}}
									@csrf
									<input type="hidden" name="name" value="{{ $data['shipping_name'] }}">
									<input type="hidden" name="email" value="{{ $data['shipping_email'] }}">
									<input type="hidden" name="phone" value="{{ $data['shipping_phone'] }}">
									<input type="hidden" name="address1" value="{{ $data['address1'] }}">
									<input type="hidden" name="address2" value="{{ $data['address2'] }}">
									<input type="hidden" name="post_code" value="{{ $data['post_code'] }}">
									<input type="hidden" name="division_id" value="{{ $data['district'] }}">
									<input type="hidden" name="district_id" value="{{ $data['state'] }}">
									<input type="hidden" name="state_id" value="{{ $data['country'] }}">
									<input type="hidden" name="notes" value="{{ $data['notes'] }}"> 
									{{-- <input type="hidden" name="amount" value="{{ $data['amount'] }}">  --}}
									<br>
									{{-- <label for="fpx-bank-element">FPX Bank</label>
									<div id="fpx-bank-element">
										<!-- A Stripe Element will be inserted here. -->ini fpx
									</div> --}}
									<button class="btn btn-primary">Pay
										@if($data['state'] != 'SABAH' && $data['state'] != 'SARAWAK')
											@if(Session::has('coupon'))
												RM{{ session()->get('coupon')['total_amount'] + 10.00}} 
											@else
												RM{{ $amount+ 10.00}} 
											@endif 
										@else
											@if(Session::has('coupon'))
												RM{{ session()->get('coupon')['total_amount'] + 15.00}} 
											@else
												RM{{ $amount+ 15.00}} 
											@endif
										@endif
									</button>
								</form>
							</div>
						</div>
					</div> 
				</div><!--  // end col md 6 -->
				</form>
			</div><!-- /.row -->
		</div><!-- /.checkout-box -->
	</div><!-- /.container -->
</div><!-- /.body-content -->

@endsection 