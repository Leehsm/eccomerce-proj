@extends('frontend.main_master')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@section('title')
Stripe Payment Page 
@endsection

<style>
    /**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
.StripeElement {
  box-sizing: border-box;
  height: 40px;
  padding: 10px 12px;
  border: 1px solid transparent;
  border-radius: 4px;
  background-color: white;
  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}
.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}
.StripeElement--invalid {
  border-color: #fa755a;
}
.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;}
</style>

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href={{url('/')}}>Home</a></li>
				<li><a href="{{route('checkout')}}">Checkout</a></li>
				<li class='active'>Stripe Payment</li>
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
									<h4 class="unicase-checkout-title">Credit or debit card</h4>
								</div>
								
								<form action="{{route('stripe.order')}} " method="post" id="payment-form">
									@csrf
									<div class="form-row">
										<label for="card-element">
											<input type="hidden" name="name" value="{{ $data['shipping_name'] }}">
											<input type="hidden" name="email" value="{{ $data['shipping_email'] }}">
											<input type="hidden" name="phone" value="{{ $data['shipping_phone'] }}">
											<input type="hidden" name="address1" value="{{ $data['address1'] }}">
											<input type="hidden" name="address2" value="{{ $data['address2'] }}">
											<input type="hidden" name="post_code" value="{{ $data['post_code'] }}">
											<input type="hidden" name="district" value="{{ $data['district'] }}">
											<input type="hidden" name="state" value="{{ $data['state'] }}">
											<input type="hidden" name="country" value="{{ $data['country'] }}">
											<input type="hidden" name="notes" value="{{ $data['notes'] }}"> 
										</label>
										<input type="text" name="holdername" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Name on Card" required="">
										<br>
										<input type="text" name="bankname" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Bank Name" required="">
										<br>
										<div id="card-element">
										<!-- A Stripe Element will be inserted here. -->
										</div>
										<!-- Used to display form errors. -->
										<div id="card-errors" role="alert"></div>
									</div>
									<br>
									<button class="btn btn-primary">Pay
										@if($data['state'] != '3' && $data['state'] != '4')
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
				</div>
				</form>
			</div><!-- /.row -->
		</div><!-- /.checkout-box -->
	</div><!-- /.container -->
</div><!-- /.body-content -->

<script type="text/javascript">
    // Create a Stripe client. Publishable key
	var stripe = Stripe('pk_test_51Kl2mfAXlhPfw81skeYYDFiv0n3Qu6Mc9j39gGetS6QyFIJEeQUzR9KiGd2FRWL3io9TBhCRKamOtC1251RPiyAY00N0aUMTOE');
	// Create an instance of Elements.
	var elements = stripe.elements();
	// Custom styling can be passed to options when creating an Element.
	// (Note that this demo uses a wider set of styles than the guide below.)
	var style = {
		base: {
			color: '#32325d',
			fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
			fontSmoothing: 'antialiased',
			fontSize: '16px',
			'::placeholder': {
			color: '#aab7c4'
			}
		},
		invalid: {
			color: '#fa755a',
			iconColor: '#fa755a'
		}
	};
	// Create an instance of the card Element.
	var card = elements.create('card', {style: style});
	// Add an instance of the card Element into the `card-element` <div>.
	card.mount('#card-element');
	// Handle real-time validation errors from the card Element.
	card.on('change', function(event) {
		var displayError = document.getElementById('card-errors');
		if (event.error) {
			displayError.textContent = event.error.message;
		} else {
			displayError.textContent = '';
		}
	});
	// Handle form submission.
	var form = document.getElementById('payment-form');
	form.addEventListener('submit', function(event) {
		event.preventDefault();
		stripe.createToken(card).then(function(result) {
			if (result.error) {
			// Inform the user if there was an error.
			var errorElement = document.getElementById('card-errors');
			errorElement.textContent = result.error.message;
			} else {
			// Send the token to your server.
			stripeTokenHandler(result.token);
			}
		});
	});
	// Submit the form with the token ID.
	function stripeTokenHandler(token) {
		// Insert the token ID into the form so it gets submitted to the server
		var form = document.getElementById('payment-form');
		var hiddenInput = document.createElement('input');
		hiddenInput.setAttribute('type', 'hidden');
		hiddenInput.setAttribute('name', 'stripeToken');
		hiddenInput.setAttribute('value', token.id);
		form.appendChild(hiddenInput);
		// Submit the form
		form.submit();
	}
</script>

@endsection 