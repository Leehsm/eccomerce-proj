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
												<strong>SubTotal: </strong> RM{{ $cartTotal }} <hr>
												<strong>Coupon Name : </strong> {{ session()->get('coupon')['coupon_name'] }}
												( {{ session()->get('coupon')['coupon_discount'] }} % )
												<hr>
												<strong>Coupon Discount : </strong> RM{{ session()->get('coupon')['discount_amount'] }} 
												<hr>
												<strong>Grand Total : </strong> RM{{ session()->get('coupon')['total_amount'] }} 
												<hr>
											@else
												<strong>SubTotal: </strong> RM{{ $cartTotal }} <hr>
												<strong>Grand Total : </strong> RM{{ $cartTotal }} <hr>
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
									<h4 class="unicase-checkout-title">Selected Payment Method</h4>
								</div>
								<form id="payment-form">
                                    <div class="form-row">
                                      <div>
                                        <label for="fpx-bank-element">
                                          FPX Bank
                                        </label>
                                        <div id="fpx-bank-element">
                                          <!-- A Stripe Element will be inserted here. -->
                                        </div>
                                      </div>
                                    </div>
                                    <button id="fpx-button" >Pay
										@if(Session::has('coupon'))
											RM{{ session()->get('coupon')['total_amount'] }} 
										@else
											RM{{ $cartTotal }} 
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