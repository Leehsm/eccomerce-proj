@extends('frontend.main_master')
@section('content')

@section('title')
Contact Us
@endsection

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{ url('/') }}">Home</a></li>
				<li class='active'>Contact Us</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-xs">
	<div class="container">
        <div class="product-comparison">
            <div>
                <h1 class="page-title text-center heading-title">Contact Us</h1>
                <div class="table-responsive">
                    <table style="margin-left: auto; margin-right: auto;">
                        <tr>
                            <td>
                                <div class="product-info text-center">
                                    <a target="blank_" href={{ $contacts->contact_call }}> 
                                        {{-- https://linktr.ee/sahirashopadmin --}}
                                        <img src="{{ asset('frontend/assets/images/contactus/smartphone-call.png') }}">
                                    </a>
                                </div>
                                <div class="product-info text-center">
                                    <h4><a  href={{ $contacts->contact_call }}>PRODUCT & ORDERS</a></h4>
                                    <h5>09:00 - 23:00<br>7 days a week</h5>
                                    <br>
                                </div>
                            </td>
                        </tr>
                    </table>

                    <table style="margin-left: auto; margin-right: auto;">
                        <tr>                       
                            <td>
                                <div class="product-info text-center">
                                    <a target="blank_" href={{ $contacts->contact_company }}>
                                        {{-- "https://linktr.ee/sahirashopadmin" --}}
                                        <img src="{{ asset('frontend/assets/images/contactus/smartphone-call.png') }}">
                                    </a>
                                </div>
                                <div class="product-info text-center">
                                    <h4><a href={{ $contacts->contact_company }}>COMPANY INFO & ENQUIRIES</a></h4>
                                    {{-- "tel:+6019-749-5646" --}}
                                    <h5>10:00 - 19:00<br>Monday - Friday</h5>
                                    <br>
                                </div>
                            </td>
                        </tr>
                    </table>

                    <table style="margin-left: auto; margin-right: auto;">
                        <tr>  
                            <td>
                                <div class="product-info text-center">
                                    <a target="blank_" href={{ $contacts->contact_company }}>
                                        {{-- https://g.co/kgs/AQryHW --}}
                                        <img src="{{ asset('frontend/assets/images/contactus/pin.png') }}">
                                    </a>
                                </div>
                                <div class="product-info text-center">
                                    <h4><a href={{ $contacts->contact_company }}>BOUTIQUE LOCATOR</a></h4>
                                    <h5>Find Sahira Shop</h5>
                                    <br>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        <div id="brands-carousel" class="logo-slider wow fadeInUp">
            <div class="logo-slider-inner">	
                <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
                    
                </div><!-- /.owl-carousel #logo-slider -->
            </div><!-- /.logo-slider-inner -->
        </div><!-- /.logo-slider -->
<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	
	</div>
</div>
@endsection