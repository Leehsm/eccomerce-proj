@extends('frontend.main_master')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@section('title')
FPX Payment Page 
@endsection

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href={{url('/')}}>Home</a></li>
				<li><a href="{{route('checkout')}}">Checkout</a></li>
				<li class='active'>FPX Payment</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
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
										<li>
											@if(Session::has('coupon'))
												@if($data['state_id'] != '3' && $data['state_id'] != '4')
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
												@if($data['state_id'] != '3' && $data['state_id'] != '4')
													<strong>SubTotal: </strong> RM{{ $cartTotal }} 
													<hr>
													<strong>Shipping Price : </strong> RM 10.00
													<hr>
													<strong>Grand Total : </strong> RM{{ $cartTotal + 10.00}}
													<hr>
												@else
													<strong>SubTotal: </strong> RM{{ $cartTotal }} 
													<hr>
													<strong>Shipping Price : </strong> RM 15.00
													<hr>
													<strong>Grand Total : </strong> RM{{ $cartTotal +15.00}}
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
									<h4 class="unicase-checkout-title">FPX Payment</h4>
								</div>
								{{-- <form id="payment-form" action="{{route('toyyibpay-create')}} " method="post" id="payment-form"> --}}
								<form id="payment-form" >
									@csrf
									<div class="form-row">
										<label for="card-element">
											<input type="hidden" name="name" value="{{ $data['shipping_name'] }}">
											<input type="hidden" name="email" value="{{ $data['shipping_email'] }}">
											<input type="hidden" name="phone" value="{{ $data['shipping_phone'] }}">
											<input type="hidden" name="address1" value="{{ $data['address1'] }}">
											<input type="hidden" name="address2" value="{{ $data['address2'] }}">
											<input type="hidden" name="post_code" value="{{ $data['post_code'] }}">
											<input type="hidden" name="division_id" value="{{ $data['division_id'] }}">
											<input type="hidden" name="district_id" value="{{ $data['district_id'] }}">
											<input type="hidden" name="state_id" value="{{ $data['state_id'] }}">
											<input type="hidden" name="notes" value="{{ $data['notes'] }}"> 
										</label>
									</div>
									<br>
									<label for="fpx-bank-element">FPX Bank</label>
									<div id="fpx-bank-element">
										<!-- A Stripe Element will be inserted here. -->ini fpx
									</div>
									<button class="btn btn-primary">Pay
										@if($data['state_id'] != '3' && $data['state_id'] != '4')
											@if(Session::has('coupon'))
												RM{{ session()->get('coupon')['total_amount'] + 10.00}} 
											@else
												RM{{ $cartTotal + 10.00}} 
											@endif 
										@else
											@if(Session::has('coupon'))
												RM{{ session()->get('coupon')['total_amount'] + 15.00}} 
											@else
												RM{{ $cartTotal + 15.00}} 
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

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', async() => {
		const stripe = Stripe('sk_test_51Kl2mfAXlhPfw81sbjS5rLjGKHGq4Ehi19jkQnxYlMxvBYESfXsJgLNq5eOefDoUtU5kIlykvdkdisPP1BdGx5wy008MtvwEON');

		const elements = stripe.elements();
		const fpxBank = elements.create('fpxBank',{
			accountHolderType: 'individual',
		})
		fpxBank.mount('#fpx-bank-element');

		const form = document.querySelector('#payment-form');
		form.addEventListener('submit', async (e) => {
			e.preventDefault();

			//Create a payment intent on the server
			const {
				error: backendError,
				clientSecret
			} = await fetch('/create-payment-intent', {
				method: 'POST',
				header: {
					'Content-Type': 'application/json',
				},
				body: JSON.stringify({
					paymentMethodType: 'fpx',
					currency: 'myr',
				}),
			}).then(r => r.json());

			if(backendError){
				addMessage(backendError.message);
				return;
			}

			//Confirm the payment on the client
			const nameInput = document.querySelector('#name');
			const {error, paymentIntent} = await Stripe.confirmFpxPayment(
				clientSecret, {
					payment_method:{
						fpx: fpxBank,
						billing_details:{
							name: nameInput.value,
						},
					},
					return_url: `${window.location.origin}/return.html`
				}
			)
			if(error) {
				addMessage(error.message);
				return;
			}
		});
	});
</script>

@endsection 