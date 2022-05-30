<div class="sidebar-widget outer-bottom-small wow fadeInUp">
    <h3 class="section-title">Special Offer</h3>
    <div class="sidebar-widget-body outer-top-xs">
      <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
        <div class="item">
          <div class="products special-product">
            @foreach($special_offer as $product)
              @if($product->product_qty >= 1)
                <div class="product">
                  <div class="product-micro">
                    <div class="row product-micro-row">
                      <div class="col col-xs-5">
                        <div class="product-image">
                          <div class="image"> <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}"> <img src="{{ asset($product->product_thambnail) }}" alt=""> </a> </div>
                        </div>
                        <!-- /.product-image --> 
                      </div>
                      <!-- /.col -->
                      <div class="col col-xs-7">
                        <div class="product-info">
                          <h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">@if(session()->get('language') == 'malay') {{ $product->product_name_my }} @else {{ $product->product_name_en }} @endif</a></h3>
                          {{-- <div class="rating rateit-small"></div> --}}
                          <div class="product-price"> <span class="price"> RM{{ $product->selling_price }} </span> </div>
                        </div>
                      </div>
                      <!-- /.col --> 
                    </div>
                    <!-- /.product-micro-row --> 
                  </div>
                  <!-- /.product-micro --> 
                </div>
              @else
                <div class="product">
                  <div class="product-micro">
                    <div class="row product-micro-row">
                      <div class="col col-xs-5">
                        <div class="product-image">
                          <div class="image"> 
                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">
                            <img src="{{ asset($product->product_thambnail) }}" alt=""> 
                          </div>
                        </div>
                        <!-- /.product-image --> 
                      </div>
                      <!-- /.col -->
                      <div class="col col-xs-7">
                        <div class="product-info">
                          <h3 class="name"><a  href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">@if(session()->get('language') == 'malay') {{ $product->product_name_my }} @else {{ $product->product_name_en }} @endif</a></h3>
                          <div class="product-price"> <span class="price"> SOLD OUT </span> </div>
                        </div>
                      </div>
                      <!-- /.col --> 
                    </div>
                    <!-- /.product-micro-row --> 
                  </div>
                  <!-- /.product-micro --> 
                </div>
                <br>
              @endif
            @endforeach <!-- // end special offer foreach -->
          </div>
        </div>
      </div>
    </div>
    <!-- /.sidebar-widget-body --> 
  </div>
  <!-- /.sidebar-widget --> 