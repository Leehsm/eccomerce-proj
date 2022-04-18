@extends('frontend.main_master')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@section('title')
FPX Payment Page 
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
								<form action="{{route('fpx.order')}} " method="post" id="payment-form">
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
    var style = {
        base: {
            // Add your base input styles here. For example:
            padding: '10px 12px',
            color: '#32325d',
            fontSize: '16px',
        },
    };

// Create an instance of the fpxBank Element.
    var fpxBank = elements.create(
    'fpxBank',
    {
        style: style,
        accountHolderType: 'individual',
    }
    );

    // Add an instance of the fpxBank Element into the container with id `fpx-bank-element`.
    fpxBank.mount('#fpx-bank-element');

    var form = document.getElementById('payment-form');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        var fpxButton = document.getElementById('fpx-button');
        var clientSecret = fpxButton.dataset.secret;
        stripe.confirmFpxPayment(clientSecret, {
            payment_method: {
            fpx: fpxBank,
            },
            // Return URL where the customer should be redirected after the authorization
            return_url: `${window.location.href}`,
        }).then((result) => {
            if (result.error) {
            // Inform the customer that there was an error.
            var errorElement = document.getElementById('error-message');
            errorElement.textContent = result.error.message;
            }
        });
    });
</script>

@endsection 