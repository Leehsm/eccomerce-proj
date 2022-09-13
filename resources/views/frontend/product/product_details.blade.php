@extends('frontend.main_master')
@section('content')

@section('title')
{{ $product->product_name_en }} Product Details
@endsection

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{ url('/') }}">Home</a></li>
				<li class='active'>{{ $product->product_name_en }}</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
	<div class='container'>
		<div class='row single-product'>
			<div class='col-md-3 sidebar'>
				<div class="sidebar-module-container">
			    </div>
		    </div><!-- /.sidebar -->
            <div class='col-md-12'>
                <div class="detail-block">
                    <div class="row  wow fadeInUp">
                        <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                            <div class="product-item-holder size-big single-product-gallery small-gallery">
                                <div id="owl-single-product">
                                    @foreach($multiImag as $img)
                                        <div class="single-product-gallery-item" id="slide{{ $img->id }}">
                                            <a data-lightbox="image-1" data-title="Gallery" href="{{ asset($img->photo_name ) }} ">
                                                <img class="img-responsive" alt="" src="{{ asset($img->photo_name ) }} " data-echo="{{ asset($img->photo_name ) }} " />
                                            </a>
                                        </div><!-- /.single-product-gallery-item -->
                                    @endforeach
                                </div><!-- /.single-product-slider -->
                                <h6 style="padding-left: 40%"> Swipe for more</h6>
                                {{-- <div class="single-product-gallery-thumbs gallery-thumbs">
                                    <div id="owl-single-product-thumbnails">
                                        @foreach($multiImag as $img)
                                            <div class="item">
                                                <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="1" href="#slide{{ $img->id }}">
                                                    <img class="img-responsive" width="85" alt="" src="{{ asset($img->photo_name ) }} " data-echo="{{ asset($img->photo_name ) }} " />
                                                </a>
                                            </div>
                                        @endforeach
                                    </div><!-- /#owl-single-product-thumbnails -->

                                </div><!-- /.gallery-thumbs --> --}}
                            </div><!-- /.single-product-gallery -->
                        </div><!-- /.gallery-holder -->        			
                        <div class='col-sm-6 col-md-7 product-info-block'>
                            <div class="product-info">
                                <h1 class="name" id="pname">
                                    @if(session()->get('language') == 'malay') 
                                        {{ $product->product_name_my }} 
                                    @else 
                                        {{ $product->product_name_en }} 
                                    @endif
                                </h1>
                                @if($product->product_qty >= 1)
                                    <div class="stock-container info-container m-t-10">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="stock-box">
                                                    <span class="label">Availability :</span>
                                                </div>	
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="stock-box">
                                                    <span class="value">In Stock</span>
                                                </div>	
                                            </div>
                                        </div><!-- /.row -->	
                                    </div><!-- /.stock-container -->
                                    <div class="description-container m-t-20">
                                        @if(session()->get('language') == 'malay') 
                                            {{ $product->short_desc_my }} 
                                        @else 
                                            {{ $product->short_desc_en }} 
                                        @endif
                                    </div><!-- /.description-container -->
                                    <div class="price-container info-container m-t-20">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="price-box">
                                                    @if ($product->discount_price == NULL)
                                                        <span class="price">RM{{ $product->selling_price }}</span>
                                                    @else
                                                        <span class="price">RM{{ $product->discount_price }}</span>
                                                        <span class="price-strike">RM{{ $product->selling_price }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            {{-- <div class="col-sm-6">
                                                <div class="favorite-button m-t-10">
                                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" id="{{ $product->id }}" onclick="addToWishList(this.id)">
                                                        <i class="fa fa-heart"></i>
                                                    </a> --}}
                                                    
                                                    {{-- <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="share" href="#">
                                                        <i class="fa fa-share">{{ $shareButtons }}</i>
                                                    </a> --}}
                                                {{-- </div>
                                            </div> --}}

                                        </div><!-- /.row -->
                                    </div><!-- /.price-container -->
                                    <!--     /// Add Product Color And Product Size ///// -->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="info-title control-label">Choose Color <span> </span></label>
                                                <select class="form-control unicase-form-control selectpicker" style="display: none;" id="color" required>
                                                    {{-- <option selected="" disabled="">--Choose Color--</option> --}}
                                                    @foreach($product_color_en as $color)
                                                        <option value="{{ $color }}">{{ ucwords($color) }}</option>
                                                    @endforeach
                                                </select> 
                                            </div> <!-- // end form group -->
                                        </div> <!-- // end col 6 -->
                                        
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="info-title control-label">Choose Size <span> </span></label>
                                                <select class="form-control unicase-form-control selectpicker" style="display: none;" id="size" required>
                                                    {{-- <option selected="" disabled="">--Choose Size--</option> --}}
                                                    @foreach($size as $sizes)
                                                        @if($sizes->quantity > 0)
                                                            <option value="{{ $sizes->size_type }}">{{ ucwords($sizes->size_type ) . " ( " . $sizes->quantity . " left " .")"}}</option>
                                                        @else
                                                            <option value="{{ $sizes->size_type }}" disabled>{{ ucwords($sizes->size_type ) . " (SOLD OUT) " }}</option>
                                                        @endif
                                                    @endforeach
                                                </select> 
                                            </div> <!-- // end form group -->
                                        </div> <!-- // end col 6 -->
                                    </div><!-- /.row -->
                                    <!--     /// End Add Product Color And Product Size ///// -->
                                    <div class="quantity-container info-container">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <span class="label">Quantity :</span>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="cart-quantity">
                                                    <div class="quant-input">
                                                        {{-- <div class="arrows">
                                                            <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
                                                            <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
                                                        </div> --}}
                                                        <input type="number" id="qty" name="quantity" min="1" max="100" step="1" value="1">
                                                        {{-- <input type="integer" id="qty" value="1" min="1" > --}}
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" id="product_id" value="{{ $product->id }}" min="1">
                                            <div class="col-sm-7">
                                                <button type="submit" onclick="addToCart()" class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</button>
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.quantity-container -->
                                @else
                                    <div class="stock-container info-container m-t-10">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="stock-box">
                                                    <span class="label">Availability :</span>
                                                </div>	
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="stock-box">
                                                    <span class="value">Out Of Stock</span>
                                                </div>	
                                            </div>
                                        </div><!-- /.row -->	
                                    </div><!-- /.stock-container -->
                                    <div class="description-container m-t-20">
                                        @if(session()->get('language') == 'malay') 
                                            {{ $product->short_desc_my }} 
                                        @else 
                                            {{ $product->short_desc_en }} 
                                        @endif
                                    </div><!-- /.description-container -->
                                    <div class="price-container info-container m-t-20">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="price-box">
                                                    @if ($product->discount_price == NULL)
                                                        <span class="price">SOLD OUT</span>
                                                    @else
                                                        <span class="price">SOLD OUT</span>
                                                    @endif
                                                </div>
                                            </div>
                                            {{-- <div class="col-sm-6">
                                                <div class="favorite-button m-t-10">
                                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" id="{{ $product->id }}" onclick="addToWishList(this.id)">
                                                        <i class="fa fa-heart"></i>
                                                    </a> --}}
                                                    {{-- <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="share" href="{{ $shareButtons }}">
                                                        <i class="fa fa-share">{{ $shareButtons }}</i>
                                                    </a> --}}
                                                {{-- </div>
                                            </div> --}}
                                        </div><!-- /.row -->
                                    </div><!-- /.price-container -->
                                    <!--     /// Add Product Color And Product Size ///// -->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="info-title control-label">Choose Color <span> </span></label>
                                                <select class="form-control unicase-form-control selectpicker" style="display: none;" id="color" required>
                                                    <option selected="" disabled="">--Choose Color--</option>
                                                    @foreach($product_color_en as $color)
                                                        <option value="{{ $color }}" disabled>{{ ucwords($color) }}</option>
                                                    @endforeach
                                                </select> 
                                            </div> <!-- // end form group -->
                                        </div> <!-- // end col 6 -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="info-title control-label">Choose Size <span> </span></label>
                                                <select class="form-control unicase-form-control selectpicker" style="display: none;" id="size" required>
                                                    <option selected="" disabled="">--Choose Size--</option>
                                                    @foreach($size as $sizes)
                                                        @if($sizes->quantity > 0)
                                                            <option value="{{ $sizes->size_type }}">{{ ucwords($sizes->size_type ) }}</option>
                                                        @else
                                                            <option value="{{ $sizes->size_type }}" disabled>{{ ucwords($sizes->size_type ) . " (SOLD OUT) " }}</option>
                                                        @endif
                                                    @endforeach
                                                </select> 
                                            </div> <!-- // end form group -->
                                        </div> <!-- // end col 6 -->
                                    </div><!-- /.row -->
                                    <!--     /// End Add Product Color And Product Size ///// -->
                                    <div class="quantity-container info-container">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <span class="label">Quantity :</span>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="cart-quantity">
                                                    <div class="quant-input">
                                                        {{-- <div class="arrows">
                                                            <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
                                                            <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
                                                        </div> --}}
                                                        <input type="number" id="qty" name="quantity" min="1" max="100" step="1" value="1">
                                                        {{-- <input type="integer" id="qty" value="1" min="1" > --}}
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" id="product_id" value="{{ $product->id }}" min="1" disabled>
                                            <div class="col-sm-7">
                                                <button type="submit" class="btn btn-primary" disabled><i class="fa fa-shopping-cart inner-right-vs"></i> SOLD OUT</button>
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.quantity-container -->
                                @endif
                            </div><!-- /.product-info -->
                        </div><!-- /.col-sm-7 -->
                    </div><!-- /.row -->
                </div>
                <div class="product-tabs inner-bottom-xs  wow fadeInUp">
                    <div class="row">
                        <div class="col-sm-3">
                            <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                <li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
                                <li><a data-toggle="tab" href="#review">Size Chart</a></li>
                            </ul><!-- /.nav-tabs #product-tabs -->
                        </div>
                        <div class="col-sm-9">
                            <div class="tab-content">
                                <div id="description" class="tab-pane in active">
                                    <div class="product-tab">
                                        <p class="text">
                                            @if(session()->get('language') == 'malay') 
                                                {!! $product->long_desc_my !!} 
                                            @else 
                                                {!! $product->long_desc_en !!} 
                                            @endif
                                        </p>
                                    </div>		
                                </div><!-- /.tab-pane -->
                                <div id="review" class="tab-pane">
                                    <div class="product-tab">
                                        <div class="product-reviews">
                                            <h4 class="title">Sizing Information</h4>
                                            <div class="reviews">
                                                {{-- <div class="review-title"><span class="summary">Sizing Chart</span></div><div id="owl-single-product"> --}}
                                                    <div class="single-product-gallery-item">
                                                        <img style="width: 50%" class="img-responsive" alt="" src="{{ asset($product->size_chart ) }} " data-echo="{{ asset($product->size_chart ) }} " />
                                                    {{-- </div> --}}
                                                </div><!-- /.single-product-slider -->
                                            </div><!-- /.reviews -->
                                        </div><!-- /.product-reviews -->
                                        {{-- <div class="product-add-review">
                                            <h4 class="title">Write your own review</h4>
                                            <div class="review-table">
                                                <div class="table-responsive">
                                                    <table class="table">	
                                                        <thead>
                                                            <tr>
                                                                <th class="cell-label">&nbsp;</th>
                                                                <th>1 star</th>
                                                                <th>2 stars</th>
                                                                <th>3 stars</th>
                                                                <th>4 stars</th>
                                                                <th>5 stars</th>
                                                            </tr>
                                                        </thead>	
                                                        <tbody>
                                                            <tr>
                                                                <td class="cell-label">Quality</td>
                                                                <td><input type="radio" name="quality" class="radio" value="1"></td>
                                                                <td><input type="radio" name="quality" class="radio" value="2"></td>
                                                                <td><input type="radio" name="quality" class="radio" value="3"></td>
                                                                <td><input type="radio" name="quality" class="radio" value="4"></td>
                                                                <td><input type="radio" name="quality" class="radio" value="5"></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="cell-label">Price</td>
                                                                <td><input type="radio" name="quality" class="radio" value="1"></td>
                                                                <td><input type="radio" name="quality" class="radio" value="2"></td>
                                                                <td><input type="radio" name="quality" class="radio" value="3"></td>
                                                                <td><input type="radio" name="quality" class="radio" value="4"></td>
                                                                <td><input type="radio" name="quality" class="radio" value="5"></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="cell-label">Value</td>
                                                                <td><input type="radio" name="quality" class="radio" value="1"></td>
                                                                <td><input type="radio" name="quality" class="radio" value="2"></td>
                                                                <td><input type="radio" name="quality" class="radio" value="3"></td>
                                                                <td><input type="radio" name="quality" class="radio" value="4"></td>
                                                                <td><input type="radio" name="quality" class="radio" value="5"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table><!-- /.table .table-bordered -->
                                                </div><!-- /.table-responsive -->
                                            </div><!-- /.review-table -->
                                            <div class="review-form">
                                                <div class="form-container">
                                                    <form role="form" class="cnt-form">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="exampleInputName">Your Name <span class="astk">*</span></label>
                                                                    <input type="text" class="form-control txt" id="exampleInputName" placeholder="">
                                                                </div><!-- /.form-group -->
                                                                <div class="form-group">
                                                                    <label for="exampleInputSummary">Summary <span class="astk">*</span></label>
                                                                    <input type="text" class="form-control txt" id="exampleInputSummary" placeholder="">
                                                                </div><!-- /.form-group -->
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="exampleInputReview">Review <span class="astk">*</span></label>
                                                                    <textarea class="form-control txt txt-review" id="exampleInputReview" rows="4" placeholder=""></textarea>
                                                                </div><!-- /.form-group -->
                                                            </div>
                                                        </div><!-- /.row -->
                                                        <div class="action text-right">
                                                            <button class="btn btn-primary btn-upper">SUBMIT REVIEW</button>
                                                        </div><!-- /.action -->
                                                    </form><!-- /.cnt-form -->
                                                </div><!-- /.form-container -->
                                            </div><!-- /.review-form -->
                                        </div><!-- /.product-add-review -->										 --}}
                                    </div><!-- /.product-tab -->
                                </div><!-- /.tab-pane -->
                            </div><!-- /.tab-content -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.product-tabs -->

                <!-- ============================================== UPSELL PRODUCTS ============================================== -->
                <section class="section featured-product wow fadeInUp">
                    <h3 class="section-title">Related products</h3>
                    <div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">
                        @foreach($relatedProduct as $product)
                            {{-- @if($product->product_qty >= 1) --}}
                                <div class="item item-carousel">
                                    <div class="products">

                                        <div class="product">		
                                            <div class="product-image">
                                                <div class="image">
                                                    <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a>
                                                </div><!-- /.image -->			
                                                {{-- <div class="tag sale"><span>sale</span></div>            		    --}}
                                            </div><!-- /.product-image -->
                                            <div class="product-info text-left">
                                                <h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">
                                                    @if(session()->get('language') == 'malay') {{ $product->product_name_my }} @else {{ $product->product_name_en }} @endif</a>
                                                </h3>
                                                {{-- <div class="rating rateit-small"></div> --}}
                                                <div class="description"></div>

                                                @if ($product->discount_price == NULL)
                                                    <div class="product-price">		
                                                        <span class="price">
                                                            RM{{ $product->selling_price }}	 
                                                        </span> 
                                                    </div><!-- /.product-price -->
                                                @else
                                                    <div class="product-price">		
                                                        <span class="price">
                                                            RM{{ $product->discount_price }}	 </span>
                                                        <span class="price-before-discount">RM {{ $product->selling_price }}</span>
                                                    </div><!-- /.product-price -->
                                                @endif
                                            </div><!-- /.product-info -->
                                            {{-- <div class="cart clearfix animate-effect">
                                                <div class="action">
                                                    <ul class="list-unstyled">
                                                        <li class="add-cart-button btn-group">
                                                            <button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal" data-target="#exampleModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i class="fa fa-shopping-cart"></i> </button>
                                                            <button class="btn btn-primary cart-btn" type="button" data-toggle="modal" data-target="#exampleModal" id="{{ $product->id }}" onclick="productView(this.id)">Add to cart</button>
                                                        </li>
                                                        <button class="btn btn-primary icon" type="button" title="Wishlist" id="{{ $product->id }}" onclick="addToWishList(this.id)"> <i class="fa fa-heart"></i> </button>
                                                    </ul> --}}
                                                {{-- </div><!-- /.action --> --}}
                                            {{-- </div><!-- /.cart --> --}}
                                        </div><!-- /.product -->
                                    </div><!-- /.products -->
                                </div><!-- /.item -->
                            
                            {{-- @endif --}}
                        @endforeach		
                    </div><!-- /.home-owl-carousel -->
                </section><!-- /.section -->
                <!-- ============================================== UPSELL PRODUCTS : END ============================================== -->

            </div><!-- /.col -->
	        <div class="clearfix">
            </div>
        </div><!-- /.row -->
    </div>
</div>
@endsection