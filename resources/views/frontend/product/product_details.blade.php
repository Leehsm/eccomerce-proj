@extends('frontend.main_master')
@section('content')

@section('title')
{{ $product->product_name_en }}
@endsection

<div class="body-content outer-top-xs">
	<div class='container'>
		<div class='row single-product'>
            <div class='col-md-12'>
                <div class="detail-block">
                    <div class="row  wow fadeInUp">
                        {{-- Image --}}
                        <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                            <div class="product-item-holder size-big single-product-gallery small-gallery">
                                <div id="owl-single-product">
                                    @foreach($multiImag as $img)
                                        <div class="single-product-gallery-item" id="slide{{ $img->id }}">
                                            <a data-lightbox="image-1" data-title="Gallery" href="{{ asset($img->photo_name ) }} ">
                                                <img class="img-responsive" alt="" src="{{ asset($img->photo_name ) }} " data-echo="{{ asset($img->photo_name ) }} " />
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                                <h6 style="padding-left: 40%"> Swipe for more</h6>
                            </div>
                        </div>
                        {{-- End Image --}}

                        <div class='col-sm-6 col-md-7 product-info-block'>
                            <div class="product-info">
                                {{-- Name --}}
                                <h1 class="name" id="pname">
                                   {{ $product->product_name_en }} 
                                </h1>
                                {{-- End Name --}}

                                @if($product->product_qty >= 1)
                                    {{-- Availability & stock --}}
                                    <div class="stock-container info-container m-t-10">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="stock-box">
                                                    <span class="label">Availability :</span>
                                                </div>	
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="stock-box">
                                                    {{-- <span class="value">In Stock</span><br> --}}
                                                    @foreach ($size as $sizes)
                                                        <span class="value">{{ $sizes->size_type }}: {{ $sizes->quantity }} left</span>
                                                    @endforeach
                                                </div>	
                                            </div>
                                        </div>	
                                    </div>
                                    {{-- Availability & stock--}}

                                    {{-- Short Desc --}}
                                    <div class="description-container m-t-20">
                                        {{ $product->short_desc_en }} 
                                    </div>
                                    {{-- End Short Desc --}}

                                    {{-- Price --}}
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
                                        </div>
                                    </div>
                                    {{-- End Price --}}
                                    
                                    @if ($product->category_id != '22')
                                        {{-- Product color & Size for Product Other than Skincare--}}
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="info-title control-label">Color <span> </span></label>
                                                    <select class="form-control unicase-form-control selectpicker" style="display: none;" id="color" required>
                                                        @foreach($product_color_en as $color)
                                                            <option value="{{ $color }}">{{ ucwords($color) }}</option>
                                                        @endforeach
                                                    </select> 
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="info-title control-label">Choose Size <span> </span></label>
                                                    <select class="form-control unicase-form-control selectpicker" style="display: none;" id="size" required>
                                                        @foreach($size as $sizes)
                                                            @if($sizes->quantity > 0)
                                                                <option value="{{ $sizes->size_type }}" data-max="{{ $sizes->quantity }}">{{ ucwords($sizes->size_type ) }}</option>
                                                            @else
                                                                <option value="{{ $sizes->size_type }}" disabled>{{ ucwords($sizes->size_type ) . " (SOLD OUT) " }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select> 
                                                </div> 
                                            </div> 
                                        </div>
                                        {{-- End Product color & Size for Product Other than Skincare --}}
                                        
                                        <label> !! Do not enter quantity more than stock left !! </label>
                                        
                                        {{-- Quantity for Product Other than Skincare--}}
                                        <div class="quantity-container info-container">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <span class="label">Quantity :</span>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="cart-quantity">
                                                        <div class="quant-input">
                                                            <input type="number" id="qty" name="quantity" min="1" max="" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" id="product_id" value="{{ $product->id }}" min="1">
                                                <div class="col-sm-7">
                                                    <button type="submit" onclick="addToCart()" class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</button>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- End Quantity for Product Other than Skincare--}}

                                    @else

                                        {{-- Quantity for Skincare--}}
                                        <div class="quantity-container info-container">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <span class="label">Quantity :</span>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="cart-quantity">
                                                        <div class="quant-input">
                                                            <input type="number" id="qty" name="quantity" min="1" max="" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" id="product_id" value="{{ $product->id }}" min="1">
                                                <div class="col-sm-7">
                                                    <button type="submit" onclick="addToCart()" class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</button>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- End Quantity for Skincare--}}

                                    @endif                                    
                                @else                                    
                                    {{-- Availability & stock for out of stock --}}
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
                                        </div>	
                                    </div>
                                    {{-- End Availability & stock for out of stock --}}

                                    {{-- Short Desc --}}
                                    <div class="description-container m-t-20">
                                        {{ $product->short_desc_en }} 
                                    </div>
                                    {{-- End Short Desc --}}

                                    {{-- Sold Out Sign --}}
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
                                        </div>
                                    </div>
                                    {{-- End Sold Out Sign --}}

                                    {{-- End Product color & Size --}}
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="info-title control-label">Color <span> </span></label>
                                                <select class="form-control unicase-form-control selectpicker" style="display: none;" id="color" required>
                                                    <option selected="" disabled="">--Choose Color--</option>
                                                    @foreach($product_color_en as $color)
                                                        <option value="{{ $color }}" disabled>{{ ucwords($color) }}</option>
                                                    @endforeach
                                                </select> 
                                            </div> 
                                        </div> 
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="info-title control-label">Choose Size <span> </span></label>
                                                <select class="form-control unicase-form-control selectpicker" style="display: none;" id="size" required>
                                                    <option selected="" disabled="">--Choose Size--</option>
                                                    @foreach($size as $sizes)
                                                    @if($sizes->quantity > 0)
                                                        <option value="{{ $sizes->size_type }}" data-max="{{ $sizes->quantity }}">{{ ucwords($sizes->size_type ) }}</option>
                                                    @else
                                                        <option value="{{ $sizes->size_type }}" disabled>{{ ucwords($sizes->size_type ) . " (SOLD OUT) " }}</option>
                                                    @endif
                                                @endforeach
                                                </select> 
                                            </div> 
                                        </div> 
                                    </div>
                                    {{-- End Product color & Size  --}}

                                    {{-- Quantity --}}
                                    <div class="quantity-container info-container">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <span class="label">Quantity :</span>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="cart-quantity">
                                                    <div class="quant-input">
                                                        <input type="number" id="qty" name="quantity" min="1" max="" >                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" id="product_id" value="{{ $product->id }}" min="1" disabled>
                                            <div class="col-sm-7">
                                                <button type="submit" class="btn btn-primary" disabled><i class="fa fa-shopping-cart inner-right-vs"></i> SOLD OUT</button>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- End Quantity --}}

                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Long Desc & Size Chart--}}
                @if ($product->category_id != 22)
                    <div class="product-tabs inner-bottom-xs  wow fadeInUp">
                        <div class="row">
                            <div class="col-sm-3">
                                <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                    <li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
                                    <li><a data-toggle="tab" href="#review">Size Chart</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-9">
                                <div class="tab-content">
                                    {{-- Long Desc for non Skincare--}}
                                    <div id="description" class="tab-pane in active">
                                        <div class="product-tab">
                                            <p class="text">
                                                {!! $product->long_desc_en !!} 
                                            </p>
                                        </div>		
                                    </div>
                                    {{-- End Long Desc --}}
                                    
                                    {{-- Sizing Info for Non skincare--}}
                                    <div id="review" class="tab-pane">
                                        <div class="product-tab">
                                            <div class="product-reviews">
                                                <h4 class="title">Sizing Information</h4>
                                                <div class="reviews">
                                                        <div class="single-product-gallery-item">
                                                            <img style="width: 50%" class="img-responsive" alt="" src="{{ asset($product->size_chart ) }} " data-echo="{{ asset($product->size_chart ) }} " />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- End Sizing Info --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="product-tabs inner-bottom-xs  wow fadeInUp">
                        <div class="row">
                            <div class="col-sm-3">
                                <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                    <li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-9">
                                <div class="tab-content">
                                    {{-- Long Desc Skincare --}}
                                    <div id="description" class="tab-pane in active">
                                        <div class="product-tab">
                                            <p class="text">
                                                {!! $product->long_desc_en !!} 
                                            </p>
                                        </div>		
                                    </div>
                                    {{-- End Long Desc Skincare --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- End Long Desc & Size Chart--}}
                

                <!-- ============================================== UPSELL PRODUCTS ============================================== -->
                <section class="section featured-product wow fadeInUp">
                    <h3 class="section-title">Related products</h3>
                    <div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">
                        @foreach($relatedProduct as $product)
                            <div class="item item-carousel">
                                <div class="products">
                                    <div class="product">		
                                        <div class="product-image">
                                            <div class="image">
                                                <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a>
                                            </div>
                                        </div>
                                        <div class="product-info text-left">
                                            <h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">
                                                @if(session()->get('language') == 'malay') {{ $product->product_name_my }} @else {{ $product->product_name_en }} @endif</a>
                                            </h3>                            
                                            @if ($product->discount_price == NULL)
                                                <div class="product-price">		
                                                    <span class="price">
                                                        RM{{ $product->selling_price }}	 
                                                    </span> 
                                                </div>
                                            @else
                                                <div class="product-price">		
                                                    <span class="price">
                                                        RM{{ $product->discount_price }}	 </span>
                                                    <span class="price-before-discount">RM {{ $product->selling_price }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        @endforeach		
                    </div>
                </section>
                <!-- ============================================== UPSELL PRODUCTS : END ============================================== -->

            </div>
	        <div class="clearfix">
            </div>
        </div>
    </div>
</div>
{{-- <script>
$('select').change(function (e) {
    var selectedIndex = $('select').prop("selectedIndex");
    var selectedOption = $('select').find("option")[selectedIndex];
    $('input[type=number]').attr('max', $(selectedOption).data('max'));
});
    // $(document).ready(function() {
    //     $('select[data-max="max"]').on('change', function(){
    //         var max = $(this).val();
    //         $('input[type=number]').attr('max', $('option:selected',this).data('max'));
    //     });
    // });

    // $('#form-control').change(function () {
    //     $('input[type=number]').attr('max', $('option:selected',this).data('max'));
    // });

    // function check(qty) {
    //     div.addEventListener('click', function () { });
    //     var max = select.getAttribute("data-max");
    //     if (parseInt(qty.value) > parseInt(max)) {
    //         alert("Amount out of max!");
    //     }
    // };
</script> --}}
@endsection