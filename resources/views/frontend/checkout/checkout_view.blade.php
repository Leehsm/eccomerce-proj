@extends('frontend.main_master')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@section('title')
My Checkout
@endsection

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{ url('/') }}">Home</a></li>
				<li class='active'>Checkout</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb --> 
<div class="body-content">
	<div class="container">
		<div class="checkout-box ">
			<div class="row">
				<div class="col-md-8">
					<div class="panel-group checkout-steps" id="accordion">
						<!-- checkout-step-01  -->
                        <div class="panel panel-default checkout-step-01">
                            <h4 class="checkout-subtitle"><b>Shipping Infomation</b> (Please double check infomation you inserted)</h4>
                        <!-- panel-heading -->
                        <!-- panel-heading -->
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <!-- panel-body  -->
                                <div class="panel-body">
                                    <div class="row">		
                                        <!-- guest-login -->			
                                        <div class="col-md-12 col-sm-6 already-registered-login">
                                            <form class="register-form" action="{{ route('checkout.store') }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1"><b>Full Name</b>  <span>*</span></label>
                                                    <input type="text" name="shipping_name" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Full Name" value="{{ Auth::user()->name }}" required="">
                                                </div>  <!-- // end form group  -->
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1"><b>Email </b> <span>*</span></label>
                                                    <input type="email" name="shipping_email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Email" value="{{ Auth::user()->email }}" required="">
                                                </div>  <!-- // end form group  -->
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1"><b>Phone</b>  <span>*</span></label>
                                                    <input type="text" name="shipping_phone" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Phone" value="{{ Auth::user()->phone }}" required="">
                                                </div>  <!-- // end form group  -->
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1"><b>Address Line 1</b> <span>*</span></label>
                                                    <input type="text" name="address1" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Address Line 1" required="">
                                                </div>  <!-- // end form group  -->
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1"><b>Address Line 2</b> <span>*</span></label>
                                                    <input type="text" name="address2" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Address Line 2" required="">
                                                </div>  <!-- // end form group  -->
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1"><b>Post Code </b> <span>*</span></label>
                                                    <input type="text" name="post_code" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Post Code" required="">
                                                </div>  <!-- // end form group  -->
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1"><b>State</b> <span>*</span></label>
                                                    <div class="controls">
                                                        <select name="division_id" class="form-control" required="" >
                                                            <option value="" selected="" disabled="">State</option>
                                                            @foreach($divisions as $item)
                                                                <option value="{{ $item->id }}">{{ $item->division_name }}</option>	
                                                            @endforeach
                                                        </select>
                                                        @error('division_id') 
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror 
                                                    </div>
                                                </div> <!-- // end form group -->
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1"><b>District</b>  <span>*</span></label>
                                                    <div class="controls">
                                                        <select name="district_id" class="form-control" required="" >
                                                            <option value="" selected="" disabled="">District</option>
                                                        </select>
                                                        @error('district_id') 
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror 
                                                    </div>
                                                </div> <!-- // end form group -->
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1"><b>Country</b> <span>*</span></label>
                                                    <div class="controls">
                                                        <select name="state_id" class="form-control" required="" >
                                                            <option value="" selected="" disabled="">Country</option>
                                                        </select>
                                                        @error('state_id') 
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror 
                                                    </div>
                                                </div> <!-- // end form group -->
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1">Notes</label>
                                                    <textarea class="form-control" cols="30" rows="5" placeholder="Notes" name="notes"></textarea>
                                                </div>
                                        </div>			
                                    </div>			
                                </div>
                            </div>
                        </div>			  	
                    </div>
                </div>

                <div class="col-md-4">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Your Checkout Progress</h4>
                                </div>
                                <div class="">
                                    <ul class="nav nav-checkout-progress list-unstyled">
                                        @foreach($carts as $item)
                                        <table>
                                            <tr>
                                                <th><strong>Item : </strong></th>
                                                <td><img src="{{ asset($item->options->image) }}" style="height: 50px; width: 50px;"></td>
                                            </tr>
                                            <tr>
                                                <th><strong>Name :</strong></th>
                                                <td>{{ $item->name }}</td>
                                            </tr>
                                            <tr>
                                                <th><strong>Quantity:</strong></th>
                                                <td>{{ $item->qty }}</td>
                                            </tr>
                                            <tr>
                                                <th><strong>Color :</strong></th>
                                                <td>{{ $item->options->color }}</td>
                                            </tr>
                                            <tr>
                                                <th><strong>Size :</strong></th>
                                                <td>{{ $item->options->size }}</td>
                                            </tr>
                                        </table>
                                        @endforeach 
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
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Select Payment Method</h4>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Stripe</label> 		
                                        <input type="radio" name="payment_method" value="stripe">
                                        <img src="{{ asset('frontend/assets/images/payments/3.png') }}">		    		
                                    </div> <!-- end col md 4 -->
                                    <div class="col-md-4">
                                        <label for="">FPX</label> 		
                                        <input type="radio" name="payment_method" value="fpx" >	
                                        <img src="{{ asset('frontend/assets/images/payments/fpx.jpg') }}" style="width: 50%">    		
                                    </div> <!-- end col md 4 -->
                                    {{-- <div class="col-md-4">
                                        <label for="">Cash</label> 		
                                        <input type="radio" name="payment_method" value="cash">	
                                        <img src="{{ asset('frontend/assets/images/payments/2.png') }}">  		
                                    </div> <!-- end col md 4 --> --}}
                                </div> <!-- // end row  -->
                                <hr>
                                <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Payment Step</button>
                            </div>
                        </div>
                    </div> 
                    <!-- checkout-progress-sidebar --> 
                </div>

                <div class="col-md-4">
                    
                </div>
            </form>
            </div><!-- /.row -->
        </div><!-- /.checkout-box -->
        <!-- === ===== BRANDS CAROUSEL ==== ======== -->
    <!-- ===== == BRANDS CAROUSEL : END === === -->	
    </div><!-- /.container -->
</div><!-- /.body-content -->

<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="division_id"]').on('change', function(){
            var division_id = $(this).val();
            if(division_id) {
                $.ajax({
                    url: "{{  url('/district-get/ajax') }}/"+division_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                        $('select[name="state_id"]').empty(); 
                        var d =$('select[name="district_id"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="district_id"]').append('<option value="'+ value.id +'">' + value.district_name + '</option>');
                            });
                    },
                });
            } else {
                alert('danger');
            }
        });

        $('select[name="district_id"]').on('change', function(){
            var district_id = $(this).val();
            if(district_id) {
                $.ajax({
                    url: "{{  url('/state-get/ajax') }}/"+district_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                       var d =$('select[name="state_id"]').empty();
                          $.each(data, function(key, value){
                              $('select[name="state_id"]').append('<option value="'+ value.id +'">' + value.state_name + '</option>');
                          });
                    },
                });
            } else {
                alert('danger');
            }
        });
    });
    </script>
@endsection