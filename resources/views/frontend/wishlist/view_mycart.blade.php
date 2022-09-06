@extends('frontend.main_master')
@section('content')

@section('title')
My Cart Page 
@endsection


<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="home.html">Home</a></li>
				<li class='active'>MyCart</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content">
	<div class="container">
		<div class="row ">
			<div class="shopping-cart">
				<div class="shopping-cart-table ">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="cart-romove item">Image</th>
                                    <th class="cart-description item">Name</th>
                                    <th class="cart-product-name item">Color</th>
                                    <th class="cart-edit item">Size</th>
                                    <th class="cart-qty item">Quantity</th>
                                    <th class="cart-sub-total item">Subtotal</th>
                                    <th class="cart-total last-item"></th>
                                </tr>
                            </thead>
                            <tbody id="cartPage">
                            </tbody>
                        </table>
                    </div>
                </div>		
                
                <div class="col-md-4 col-sm-12 estimate-ship-tax">
                </div><!-- /.estimate-ship-tax -->
                <div class="col-md-4 col-sm-12 estimate-ship-tax">
                </div>
                <div class="col-md-4 col-sm-12 cart-shopping-total">
                    @if(Session::has('coupon'))
                        
                    @else
                        <table class="table" id="couponField">
                                <tr>
                                    <th>
                                        <div class="form-group">
                                            <input type="text" class="form-control unicase-form-control text-input" placeholder="Discount Code" id="coupon_name">
                                        </div>
                                        <div class="clearfix pull-right">
                                            <button type="submit" class="btn-upper btn btn-primary" onclick="applyCoupon()">APPLY</button>
                                        </div>
                                    </th>
                                </tr>
                        </table><!-- /table -->     
                    @endif

                    <table class="table">
                        <thead id="couponCalField">
                            
                        </thead><!-- /thead -->
                        <tbody>
                                <tr>
                                    <td>
                                        <div class="cart-checkout-btn pull-right">
                                            <a href="{{ route('checkout') }}" type="submit" class="btn btn-primary checkout-btn">PROCCED TO CHEKOUT</a>                
                                        </div>
                                    </td>
                                </tr>
                        </tbody><!-- /tbody -->
                    </table><!-- /table -->
                </div><!-- /.cart-shopping-total -->                    
            </div><!-- /.row -->
        </div><!-- /.sigin-in-->
        <br>
        @include('frontend.body.brand')
    </div>
</div>
@endsection