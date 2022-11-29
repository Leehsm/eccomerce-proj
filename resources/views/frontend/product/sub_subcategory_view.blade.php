@extends('frontend.main_master')
@section('content')
@section('title')
Sub - Subcategory Product 
@endsection

<!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
  <div class='container'>
    <div class='row'>
        <div class='col-md-12'> 
            <!-- == ==== SECTION – HERO === ====== -->

            <!--    //////////////////// START Product Grid View  ////////////// -->
            <div class="search-result-container ">
                <div id="myTabContent" class="tab-content category-list">
                    <div class="tab-pane active " id="grid-container">
                        <div class="category-product">
                            <div class="row">
                                @foreach($products as $product)
                                    @if($product->product_qty >= 1)
                                        <div class="col-sm-6 col-md-3 wow fadeInUp">
                                            <div class="products">
                                                <div class="product">
                                                    <div class="product-image">
                                                        <div class="image"> <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a> </div>
                                                        <!-- /.image -->
                                                        @php
                                                            $amount = $product->selling_price - $product->discount_price;
                                                            $discount = ($amount/$product->selling_price) * 100;
                                                        @endphp     

                                                        <div>
                                                            @if ($product->discount_price == NULL)
                                                                {{-- <div class="tag new"><span>new</span></div> --}}
                                                            @else
                                                                <div class="tag hot"><span>{{ round($discount) }}%</span></div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <!-- /.product-image -->
                                                    <div class="product-info text-left">
                                                        <h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">
                                                            @if(session()->get('language') == 'malay') {{ $product->product_name_my }} @else {{ $product->product_name_en }} @endif</a></h3>
                                                        {{-- <div class="rating rateit-small"></div> --}}
                                                        <div class="description"></div>
                                                        @if ($product->discount_price == NULL)
                                                            <div class="product-price"> <span class="price"> RM {{ $product->selling_price }} </span>   </div>
                                                        @else
                                                            <div class="product-price"> <span class="price"> RM {{ $product->discount_price }} </span> <span class="price-before-discount">RM {{ $product->selling_price }}</span> </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-sm-6 col-md-3 wow fadeInUp">
                                            <div class="products">
                                                <div class="product">
                                                    <div class="product-image">
                                                        <div class="image"> 
                                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">
                                                            <img  src="{{ asset($product->product_thambnail) }}" alt=""> 
                                                        </div>
                                                        <!-- /.image -->
                                                        @php
                                                            $amount = $product->selling_price - $product->discount_price;
                                                            $discount = ($amount/$product->selling_price) * 100;
                                                        @endphp     
                                                    </div>
                                                    <!-- /.product-image -->
                                                    <div class="product-info text-left">
                                                        <h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">
                                                            @if(session()->get('language') == 'malay') {{ $product->product_name_my }} @else {{ $product->product_name_en }} @endif</a></h3>
                                                        {{-- <div class="rating rateit-small"></div> --}}
                                                        <div class="description"></div>
                                                        @if ($product->discount_price == NULL)
                                                            <div class="product-price"> <span class="price"> SOLD OUT </span>   </div>
                                                        @else
                                                            <div class="product-price"> <span class="price"> SOLD OUT </span> </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                </div>
                            </div>
                        </div>
            <!--            //////////////////// END Product Grid View  ////////////// -->
                    </div>
                    <!-- /.tab-content -->
                    <div class="clearfix filters-container">
                        <div class="text-right">
                            <div class="pagination-container">
                                <ul class="list-inline list-unstyled">
                                    {{ $products->links()  }}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        <div id="brands-carousel" class="logo-slider wow fadeInUp">
            <div class="logo-slider-inner">
                <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
                    
                </div>
            </div>
        </div>
      <!-- ============================================== BRANDS CAROUSEL : END ============================================== --> 
    </div>
</div>
@endsection