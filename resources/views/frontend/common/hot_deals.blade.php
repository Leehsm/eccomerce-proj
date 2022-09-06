@php
$hot_deals = App\Models\Product::where('hot_deals',1)
                                ->where('status',1)
                                ->orderBy('id','DESC')
                                ->latest()
                                ->get();
@endphp

<div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
    <h3 class="section-title">Hot Deals</h3>
    <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
        @csrf
        @foreach($hot_deals as $product)
            @if($product->product_qty >= 1)
                <div class="item">
                    <div class="products">
                    <div class="hot-deal-wrapper"> 
                        <div class="image"> 
                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">
                            <img src="{{ asset($product->product_thambnail) }}" alt=""> 
                        </div>
                            @php
                            $amount = $product->selling_price - $product->discount_price;
                            $discount = ($amount/$product->selling_price) * 100;
                            @endphp   

                            {{-- @if ($product->discount_price == NULL)
                                <div class="tag new"><span>new</span></div>
                            @else
                                <div class="sale-offer-tag"><span>{{ round($discount) }}%<br>
                                off</span></div>
                            @endif --}}
                            
                        </div>
                <!-- /.hot-deal-wrapper -->

                        <div class="product-info text-left m-t-20">
                            <h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">
                            @if(session()->get('language') == 'malay') {{ $product->product_name_my }} @else {{ $product->product_name_en }} @endif</a></h3>
                            {{-- <div class="rating rateit-small"></div> --}}
                            @if ($product->discount_price == NULL)
                                <div class="product-price"> <span class="price"> RM{{ $product->selling_price }} </span>  </div>
                            @else
                                <div class="product-price"> <span class="price"> RM{{ $product->discount_price }} </span> <span class="price-before-discount">RM{{ $product->selling_price }}</span> </div>
                            @endif
                <!-- /.product-price --> 
                        </div>
                <!-- /.product-info -->
                        {{-- <div class="cart clearfix animate-effect">
                            <div class="action">
                            <div class="add-cart-button btn-group">
                                <button class="btn btn-primary cart-btn" type="button" data-toggle="modal" data-target="#exampleModal" id="{{ $product->id }}" onclick="productView(this.id)">Add to cart</button>
                            </div>
                            </div>
                            <!-- /.action --> 
                        </div> --}}
                <!-- /.cart --> 
                    </div>
                </div>
            @else
                <div class="item">
                    <div class="products">
                    <div class="hot-deal-wrapper"> 
                        <div class="image">
                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">
                            <img src="{{ asset($product->product_thambnail) }}" alt=""> 
                        </div>
                            @php
                            $amount = $product->selling_price - $product->discount_price;
                            $discount = ($amount/$product->selling_price) * 100;
                            @endphp   

                            {{-- @if ($product->discount_price == NULL)
                                <div class="tag new"><span>new</span></div>
                            @else
                                <div class="sale-offer-tag"><span>{{ round($discount) }}%<br>
                                off</span></div>
                            @endif --}}
                            
                        </div>
                <!-- /.hot-deal-wrapper -->

                        <div class="product-info text-left m-t-20">
                            <h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">
                            @if(session()->get('language') == 'malay') {{ $product->product_name_my }} @else {{ $product->product_name_en }} @endif</a></h3>
                            {{-- <div class="rating rateit-small"></div> --}}
                            <div class="product-price"> <span class="price"> SOLD OUT </span>  </div>
                            <!-- /.product-price --> 
                        </div>
                <!-- /.product-info -->
                        <div class="cart clearfix animate-effect">
                            <div class="action">
                            <div class="add-cart-button btn-group">
                                {{-- <button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal" data-target="#exampleModal" id="{{ $product->id }}" onclick="productView(this.id)" disabled> <i class="fa fa-shopping-cart"></i> </button> --}}
                                <button class="btn btn-primary cart-btn" type="button" data-toggle="modal" disabled>SOLD OUT</button>
                            </div>
                            </div>
                            <!-- /.action --> 
                        </div>
                <!-- /.cart --> 
                    </div>
                </div>
            @endif
        @endforeach <!-- // end hot deals foreach -->
    </div>
    <!-- /.sidebar-widget --> 
</div> 