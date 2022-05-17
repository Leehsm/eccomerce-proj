@extends('frontend.main_master')
@section('content')

@section('title')
FAQ
@endsection

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{ url('/') }}">Home</a></li>
				<li class='active'>FAQ</ol>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="terms-conditions-page">
			<div class="row">
				<div class="col-md-8 terms-conditions">
                    <h2 class="heading-title">Frequently Asked Questions</h2>
                    <h3>WHAT PAYMENT OPTIONS CAN I USE?</h3>
                    <h5>We want to make buying your favourite item online fast and easy, and we accept the following payment options:</h5>
                    <ol>
                        <ol>Visa, Mastercard, American Express, Visa Electron, Maestro</ol>
                        <ol>FPX (COMING SOON)</ol>
                        <ol>Cash On Delivery (COMING SOON)</ol>
                    </ol>
                    <br>

                    <h3>Can I pay for my order with multiple methods?</h3>
                    <h5>No, payment for your orders can't be split between multiple payment methods.</h5>
                    <br>

                    <h3>Can I pay for my order with a bank transfer?</h3>
                    <h5>Yes, you need to take a picture or screenshot of the item you want to buy and directly chat our admin thru Whatsapp. They will serve you thru Whatsapp</h5>
                    <h5>Go to contact us, and click Product & Orders</h5>
                    <br>
                    
                    <h3>WHAT ARE SAHIRA'S DELIVERY OPTIONS?</h3>
                    <h5>Jnt</h5>

                    <h3>ADDITIONAL INFORMATION</h3>
                    <h5>Orders are processed and delivered Monday–Friday, except for national holidays. Be aware that orders may experience longer processing and delivery times during holidays.</h5>
                    <h5>Orders can't be delivered to addresses outside of Malaysia</h5>
                    <br>
                </div>	
                <div class="col-md-4 terms-conditions">
                    <br><br><br><br><br>
                    <a target="blank_" href="https://linktr.ee/sahirashopadmin">
                        <img style="width:40%" src="{{ asset('frontend/assets/images/contactus/smartphone-call.png') }}">
                    </a>
                    <h4><a target="blank_" href="https://linktr.ee/sahirashopadmin">PRODUCT & ORDERS</a></h4>
                    <h5>09:00 - 23:00<br>7 days a week</h5>

                    <br>

                    <a target="blank_" href="tel:+6019-749-5646">
                        <img style="width:40%" src="{{ asset('frontend/assets/images/contactus/smartphone-call.png') }}">
                    </a>
                    <h4><a target="blank_" href="tel:+6019-749-5646">COMPANY INFO & ENQUIRIES</a></h4>
                    <h5>10:00 - 19:00<br>Monday - Friday</h5>

                    <br>

                    <a target="blank_"  href="https://g.co/kgs/AQryHW">
                        <img style="width:40%" src="{{ asset('frontend/assets/images/contactus/pin.png') }}">
                    </a>
                    <h4><a target="blank_" href="https://g.co/kgs/AQryHW">BOUTIQUE LOCATOR</a></h4>
                    <h5>Find Sahira Shop</h5>
                </div>		
            </div><!-- /.row -->
		</div><!-- /.sigin-in-->
		<!-- ============================================== BRANDS CAROUSEL ============================================== -->
        <div id="brands-carousel" class="logo-slider wow fadeInUp">
            <div class="logo-slider-inner">	
                <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
                    
                </div><!-- /.owl-carousel #logo-slider -->
            </div><!-- /.logo-slider-inner -->
        </div><!-- /.logo-slider -->
<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	
    </div><!-- /.container -->
</div><!-- /.body-content -->
@endsection
