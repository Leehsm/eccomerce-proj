@extends('frontend.main_master')
@section('content')
@section('title')
SahiraShop
@endsection
    
<div class="body-content outer-top-xs" id="top-banner-and-menu">
  <div class="container">
    <div class="row"> 
      <br>
      <!-- ============================================== CONTENT ============================================== -->
      <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder"> 
        <!-- ========================================== SECTION – Slider ========================================= -->
        <div id="hero">
          <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
            @foreach($sliders as $slider)
              <a>
                <div class="item" style="background-image: url({{ asset($slider->slider_img) }});">
                </div>
              </a>
              <!-- /.item -->
            @endforeach
          </div>
          <!-- /.owl-carousel --> 
        </div>
        <!-- ========================================= SECTION – Slider : END ========================================= --> 

        <!-- ============================================== SCROLL TABS ============================================== -->
        <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
          <div class="more-info-tab clearfix ">
            <h3 class="new-product-title pull-left">New Products</h3>
            <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
              <li class="active"><a data-transition-type="backSlide" href="#all" data-toggle="tab">All</a></li>
              @foreach($categories as $category)
                <li>
                  <a data-transition-type="backSlide" href="#category{{ $category->id }}" data-toggle="tab">
                    {{ $category->category_name_en }}
                  </a>
                </li>
              @endforeach
            </ul> 
          </div>
          <div class="tab-content outer-top-xs">
            <div class="tab-pane in active" id="all">
              <div class="product-slider">
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                  @foreach($products as $product)
                    @if($product->product_qty >= 1)
                      <div class="item item-carousel">
                        <div class="products">
                          <div class="product">
                            <div class="product-image">
                              {{-- image --}}
                              <div class="image"> 
                                <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">
                                  <img  src="{{ asset($product->product_thambnail) }}" alt="">
                                </a> 
                              </div>
                              @php
                                $amount = $product->selling_price - $product->discount_price;
                                $discount = ($amount/$product->selling_price) * 100;
                              @endphp  
                            </div>              

                            <div class="product-info text-left">
                              {{-- Name --}}
                              <h3 class="name">
                                <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">
                                  @if(session()->get('language') == 'malay') 
                                    {{ $product->product_name_my }} 
                                  @else 
                                    {{ $product->product_name_en }} 
                                  @endif
                                </a>
                              </h3>
                              <div class="description"></div>
                              {{-- Price --}}
                                @if ($product->discount_price == NULL)
                                  <div class="product-price"> 
                                    <span class="price"> 
                                      RM {{ $product->selling_price }} 
                                    </span>  
                                  </div>
                                @else
                                  <div class="product-price"> 
                                    <span class="price"> 
                                      RM {{ $product->discount_price }} 
                                    </span> 
                                    <span class="price-before-discount">
                                      RM {{ $product->selling_price }}
                                    </span> 
                                  </div>
                                @endif
                            </div>
                          </div>                          
                        </div>
                      </div>
                    @else
                      <div class="item item-carousel">
                        <div class="products">
                          <div class="product">
                            <div class="product-image">
                              {{-- Image --}}
                              <div class="image"> 
                                <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">
                                  <img  src="{{ asset($product->product_thambnail) }}" alt="">
                                </a> 
                              </div>
                              @php
                                $amount = $product->selling_price - $product->discount_price;
                                $discount = ($amount/$product->selling_price) * 100;
                              @endphp  
                            </div>
                            <div class="product-info text-left">
                              {{-- Name --}}
                              <h3 class="name">
                                <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">
                                  @if(session()->get('language') == 'malay') 
                                    {{ $product->product_name_my }} 
                                  @else 
                                    {{ $product->product_name_en }} 
                                  @endif
                                </a>
                              </h3>
                              <div class="description"></div>
                                {{-- price --}}
                                <div class="product-price"> 
                                  <span class="price"> 
                                    SOLD OUT
                                  </span>  
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endif
                  @endforeach
                  <!--  // end all optionproduct foreach  -->
                </div>
              </div>
            </div>
            
            @foreach($categories as $category)
              <div class="tab-pane" id="category{{ $category->id }}">
                <div class="product-slider">
                  <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                    @php
                      $catwiseProduct = App\Models\Product::where('category_id',$category->id)->orderBy('id','DESC')->get(); 
                    @endphp

                    @forelse($catwiseProduct as $product)
                      @if($product->product_qty >= 1)
                        <div class="item item-carousel">
                          <div class="products">
                            <div class="product">
                              <div class="product-image">
                                <div class="image"> 
                                  <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">
                                    <img  src="{{ asset($product->product_thambnail) }}" alt="">
                                  </a> 
                                </div>
                                <!-- /.image -->
                                @php
                                  $amount = $product->selling_price - $product->discount_price;
                                  $discount = ($amount/$product->selling_price) * 100;
                                @endphp   
                              </div>
                              <!-- /.product-image -->
                              
                              <div class="product-info text-left">
                                <h3 class="name">
                                  <h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">
                                    @if(session()->get('language') == 'malay') 
                                      {{ $product->product_name_my }} 
                                    @else 
                                      {{ $product->product_name_en }} 
                                    @endif
                                  </a>
                                </h3>
                                <div class="description"></div>
                                @if ($product->discount_price == NULL)
                                  <div class="product-price"> 
                                    <span class="price"> 
                                      RM {{ $product->selling_price }} 
                                    </span>  
                                  </div>
                                @else
                                  <div class="product-price"> 
                                    <span class="price"> 
                                      RM {{ $product->discount_price }} 
                                    </span> 
                                    <span class="price-before-discount">
                                      RM {{ $product->selling_price }}
                                    </span> 
                                  </div>
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                      @else
                        <div class="item item-carousel">
                          <div class="products">
                            <div class="product">
                              <div class="product-image">
                                <div class="image"> 
                                  <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">
                                    <img  src="{{ asset($product->product_thambnail) }}" alt="">
                                  </a> 
                                </div>
                                <!-- /.image -->
                                @php
                                  $amount = $product->selling_price - $product->discount_price;
                                  $discount = ($amount/$product->selling_price) * 100;
                                @endphp   
                              </div>
                              <!-- /.product-image -->
                              
                              <div class="product-info text-left">
                                <h3 class="name">
                                  <h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">
                                    @if(session()->get('language') == 'malay') 
                                      {{ $product->product_name_my }} 
                                    @else 
                                      {{ $product->product_name_en }} 
                                    @endif
                                  </a>
                                </h3>
                                <div class="description"></div>
                                  <div class="product-price"> 
                                    <span class="price"> 
                                      SOLD OUT 
                                    </span>  
                                  </div>                      
                              </div>
                            </div>
                          </div>
                        </div>
                      @endif
                      @empty
                          <h5 class="text-danger">No Product Found</h5>
                    @endforelse
                    <!--  // end all optionproduct foreach  -->                   
                    
                  </div>
                </div>
              </div>
            @endforeach 
            <!-- end categor foreach -->
          </div>
        </div>
        <!-- ============================================== SCROLL TABS : END ============================================== --> 

        <!-- ============================================== FEATURED PRODUCTS ============================================== -->
        <section class="section featured-product wow fadeInUp">
          <h3 class="section-title">Featured products</h3>
          <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">

            @foreach($featured as $product)
              @if($product->product_qty >= 1)
              <div class="item item-carousel">
                <div class="products">
                  <div class="product">
                    <div class="product-image">
                      <div class="image"> 
                        <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">
                          <img  src="{{ asset($product->product_thambnail) }}" alt="">
                        </a> 
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
                        @if(session()->get('language') == 'malay') 
                          {{ $product->product_name_my }} 
                        @else 
                          {{ $product->product_name_en }} 
                        @endif
                        </a>
                      </h3>
                      <div class="description"></div>
                      @if ($product->discount_price == NULL)
                        <div class="product-price"> <span class="price"> RM{{ $product->selling_price }} </span>  </div>
                      @else
                        <div class="product-price"> <span class="price"> RM{{ $product->discount_price }} </span> <span class="price-before-discount">RM {{ $product->selling_price }}</span> </div>
                      @endif

                      <!-- /.product-price --> 

                    </div>
                  </div>
                </div> 
              </div>
              @else
              <div class="item item-carousel">
                <div class="products">
                  <div class="product">
                    <div class="product-image">
                      <div class="image"> 
                        <a >
                          <img  src="{{ asset($product->product_thambnail) }}" alt="">
                        </a> 
                      </div>
                      <!-- /.image -->

                      @php
                      $amount = $product->selling_price - $product->discount_price;
                      $discount = ($amount/$product->selling_price) * 100;
                      @endphp                  
                    </div>
                    <!-- /.product-image -->
                    <div class="product-info text-left">
                      <h3 class="name">
                        <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">
                          @if(session()->get('language') == 'malay') 
                            {{ $product->product_name_my }} 
                          @else 
                            {{ $product->product_name_en }} 
                          @endif
                        </a>
                      </h3>
                      {{-- <div class="rating rateit-small"></div> --}}
                      <div class="description"></div>

                      @if ($product->discount_price == NULL)
                        <div class="product-price"> <span class="price"> SOLD OUT </span>  </div>
                      @else
                        <div class="product-price"> <span class="price"> SOLD OUT </span>  </div>
                      @endif

                      <!-- /.product-price --> 
                    </div>
                  </div>
                </div>
              </div>
              @endif
            @endforeach
          </div>
        </section>
        <!-- ============================================== FEATURED PRODUCTS : END ============================================== --> 

        <!-- == === skip_product_0 PRODUCTS == ==== -->

        <section class="section featured-product wow fadeInUp">
          <h3 class="section-title">
            @if(session()->get('language') == 'malay') {{ $skip_category_0->category_name_my }} @else {{ $skip_category_0->category_name_en }} @endif
          </h3>
          <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
          @foreach($skip_product_0 as $product)
            @if($product->product_qty >= 1)
              <div class="item item-carousel">
                <div class="products" >
                  <div class="product" >
                    <div class="product-image" >
                      <div class="image"> <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a> </div>
                      <!-- /.image -->
                        @php
                          $amount = $product->selling_price - $product->discount_price;
                          $discount = ($amount/$product->selling_price) * 100;
                        @endphp  
                    </div>
                    <!-- /.product-image -->
                    <div class="product-info text-left">
                      <h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">
                        @if(session()->get('language') == 'malay') {{ $product->product_name_my }} @else {{ $product->product_name_en }} @endif
                      </a></h3>
                      {{-- <div class="rating rateit-small"></div> --}}
                      <div class="description"></div>

                      @if ($product->discount_price == NULL)
                        <div class="product-price"> <span class="price"> RM{{ $product->selling_price }} </span>  </div>
                      @else
                        <div class="product-price"> <span class="price"> RM{{ $product->discount_price }} </span> <span class="price-before-discount">RM {{ $product->selling_price }}</span> </div>
                      @endif

                      <!-- /.product-price --> 
                    </div>
                  </div>
                </div>
              </div>
            @else
              <div class="item item-carousel">
                <div class="products">
                  <div class="product">
                    <div class="product-image">
                      <div class="image"> <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a> </div>
                      <!-- /.image -->
                        @php
                          $amount = $product->selling_price - $product->discount_price;
                          $discount = ($amount/$product->selling_price) * 100;
                        @endphp     
                    </div>
                    <!-- /.product-image -->
                    <div class="product-info text-left">
                      <h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">
                        @if(session()->get('language') == 'malay') {{ $product->product_name_my }} @else {{ $product->product_name_en }} @endif
                      </a></h3>
                      {{-- <div class="rating rateit-small"></div> --}}
                      <div class="description"></div>
                      <div class="product-price"> <span class="price"> SOLD OUT </span>  </div>
                    </div>
                  </div>
                </div>
              </div>
            @endif
          @endforeach
          </div>
        </section>
        <!-- == ==== skip_product_0 PRODUCTS : END ==== === --> 

        <!-- == === skip_product_1 PRODUCTS == ==== -->
        <section class="section featured-product wow fadeInUp">
          <h3 class="section-title">
            @if(session()->get('language') == 'malay') {{ $skip_category_1->category_name_my }} @else {{ $skip_category_1->category_name_en }} @endif
          </h3>
          <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">

          @foreach($skip_product_1 as $product)
            @if($product->product_qty >= 1)
              <div class="item item-carousel">
                  <div class="products">
                    <div class="product">
                      <div class="product-image">
                        <div class="image"> <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a> </div>
                        <!-- /.image -->

                        @php
                          $amount = $product->selling_price - $product->discount_price;
                          $discount = ($amount/$product->selling_price) * 100;
                        @endphp 
                      </div>
                      <!-- /.product-image -->
                      <div class="product-info text-left">
                        <h3 class="name">
                          <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">
                            @if(session()->get('language') == 'malay') {{ $product->product_name_my }} @else {{ $product->product_name_en }} @endif
                          </a>  
                        </h3>
                        <div class="description"></div>
                        @if ($product->discount_price == NULL)
                          <div class="product-price"> <span class="price"> RM{{ $product->selling_price }} </span>  </div>
                        @else
                          <div class="product-price"> <span class="price"> RM{{ $product->discount_price }} </span> <span class="price-before-discount">RM {{ $product->selling_price }}</span> </div>
                        @endif
                        <!-- /.product-price --> 
                      </div>
                    </div>
                  </div>
                </div>
              @else
                <div class="item item-carousel">
                  <div class="products">
                    <div class="product">
                      <div class="product-image">
                        <div class="image"> <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a> </div>
                        <!-- /.image -->

                        @php
                          $amount = $product->selling_price - $product->discount_price;
                          $discount = ($amount/$product->selling_price) * 100;
                        @endphp                  

                      </div>
                      <!-- /.product-image -->
                      <div class="product-info text-left">
                        <h3 class="name">
                          <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">
                            @if(session()->get('language') == 'malay') {{ $product->product_name_my }} @else {{ $product->product_name_en }} @endif
                          </a>  
                        </h3>
                        {{-- <div class="rating rateit-small"></div> --}}
                        <div class="description"></div>
                        <div class="product-price"> <span class="price"> SOLD OUT </span>  </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endif
            @endforeach
          </div>
        </section>
        <!-- /.section --> 
        <!-- == ==== skip_product_1 PRODUCTS : END ==== === -->

        <!-- == === skip_brand_product_1 PRODUCTS == ==== -->
        {{-- <section class="section featured-product wow fadeInUp">
          <h3 class="section-title">
              @if(session()->get('language') == 'malay') {{ $skip_brand_1->brand_name_my }} @else {{ $skip_brand_1->brand_name_en }} @endif
          </h3>
          <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">

            @foreach($skip_brand_product_1 as $product)
              @if($product->product_qty >= 1)
                <div class="item item-carousel">
                  <div class="products">
                    <div class="product">
                      <div class="product-image">
                        <div class="image"> <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a> </div>

                        @php
                          $amount = $product->selling_price - $product->discount_price;
                          $discount = ($amount/$product->selling_price) * 100;
                        @endphp                  

                      </div>

                        <div class="product-info text-left">
                        <h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">
                          @if(session()->get('language') == 'malay') {{ $product->product_name_my }} @else {{ $product->product_name_en }} @endif
                        </a></h3>
                        <div class="description"></div>

                        @if ($product->discount_price == NULL)
                          <div class="product-price"> <span class="price"> RM{{ $product->selling_price }} </span>  </div>
                        @else
                          <div class="product-price"> <span class="price"> RM{{ $product->discount_price }} </span> <span class="price-before-discount">RM {{ $product->selling_price }}</span> </div>
                        @endif

                      </div>
                    </div>
                  </div>
                </div>
              @else
                <div class="item item-carousel">
                  <div class="products">
                    <div class="product">
                      <div class="product-image">
                        <div class="image"> <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a> </div>

                        @php
                          $amount = $product->selling_price - $product->discount_price;
                          $discount = ($amount/$product->selling_price) * 100;
                        @endphp                  

                      </div>

                      <div class="product-info text-left">
                        <h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">
                          @if(session()->get('language') == 'malay') {{ $product->product_name_my }} @else {{ $product->product_name_en }} @endif
                        </a></h3>
                        <div class="description"></div>
                        <div class="product-price"> <span class="price"> SOLD OUT </span>  </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endif
            @endforeach
          </div>
        </section> --}}
        <!-- /.section --> 
        <!-- == ==== skip_brand_product_1 PRODUCTS : END ==== === --> 
        
        <!-- ============================================== BLOG SLIDER ============================================== -->
        {{-- <section class="section latest-blog outer-bottom-vs wow fadeInUp">
          <h3 class="section-title">latest form blog</h3>
          <div class="blog-slider-container outer-top-xs">
            <div class="owl-carousel blog-slider custom-carousel">
              <div class="item">
                <div class="blog-post">
                  <div class="blog-post-image">
                    <div class="image"> <a href="blog.html"><img src="{{ asset('frontend/assets/images/blog-post/post1.jpg') }}" alt=""></a> </div>
                  </div>
                  <!-- /.blog-post-image -->
                  
                  <div class="blog-post-info text-left">
                    <h3 class="name"><a href="#">Voluptatem accusantium doloremque laudantium</a></h3>
                    <span class="info">By Jone Doe &nbsp;|&nbsp; 21 March 2016 </span>
                    <p class="text">Sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
                    <a href="#" class="lnk btn btn-primary">Read more</a> </div>
                  <!-- /.blog-post-info --> 
                  
                </div>
                <!-- /.blog-post --> 
              </div>
              <!-- /.item -->
              
              <div class="item">
                <div class="blog-post">
                  <div class="blog-post-image">
                    <div class="image"> <a href="blog.html"><img src="{{ asset('frontend/assets/images/blog-post/post2.jpg') }}" alt=""></a> </div>
                  </div>
                  <!-- /.blog-post-image -->
                  
                  <div class="blog-post-info text-left">
                    <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas nulla pariatur</a></h3>
                    <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                    <p class="text">Sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
                    <a href="#" class="lnk btn btn-primary">Read more</a> </div>
                  <!-- /.blog-post-info --> 
                  
                </div>
                <!-- /.blog-post --> 
              </div>
              <!-- /.item --> 
              
              <!-- /.item -->
              
              <div class="item">
                <div class="blog-post">
                  <div class="blog-post-image">
                    <div class="image"> <a href="blog.html"><img src="{{ asset('frontend/assets/images/blog-post/post1.jpg') }}" alt=""></a> </div>
                  </div>
                  <!-- /.blog-post-image -->
                  
                  <div class="blog-post-info text-left">
                    <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas nulla pariatur</a></h3>
                    <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                    <p class="text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium</p>
                    <a href="#" class="lnk btn btn-primary">Read more</a> </div>
                  <!-- /.blog-post-info --> 
                  
                </div>
                <!-- /.blog-post --> 
              </div>
              <!-- /.item -->
              
              <div class="item">
                <div class="blog-post">
                  <div class="blog-post-image">
                    <div class="image"> <a href="blog.html"><img src="{{ asset('frontend/assets/images/blog-post/post2.jpg') }}" alt=""></a> </div>
                  </div>
                  <!-- /.blog-post-image -->
                  
                  <div class="blog-post-info text-left">
                    <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas nulla pariatur</a></h3>
                    <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                    <p class="text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium</p>
                    <a href="#" class="lnk btn btn-primary">Read more</a> </div>
                  <!-- /.blog-post-info --> 
                  
                </div>
                <!-- /.blog-post --> 
              </div>
              <!-- /.item -->
              
              <div class="item">
                <div class="blog-post">
                  <div class="blog-post-image">
                    <div class="image"> <a href="blog.html"><img src="{{ asset('frontend/assets/images/blog-post/post1.jpg') }}" alt=""></a> </div>
                  </div>
                  <!-- /.blog-post-image -->
                  
                  <div class="blog-post-info text-left">
                    <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas nulla pariatur</a></h3>
                    <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                    <p class="text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium</p>
                    <a href="#" class="lnk btn btn-primary">Read more</a> </div>
                  <!-- /.blog-post-info --> 
                  
                </div>
                <!-- /.blog-post --> 
              </div>
              <!-- /.item --> 
              
            </div>
            <!-- /.owl-carousel --> 
          </div>
          <!-- /.blog-slider-container --> 
        </section> --}}
        <!-- /.section --> 
        <!-- ============================================== BLOG SLIDER : END ============================================== -->  
               
      </div>
      <!-- ============================================== SIDEBAR ============================================== -->
      <div class="col-xs-12 col-sm-12 col-md-3 sidebar"> 
        
        <!-- ================================== TOP NAVIGATION ================================== -->
        {{-- @include('frontend.common.vertical_menu') --}}
        <!-- ================================== TOP NAVIGATION : END ================================== --> 
      
        <!-- ============================================== HOT DEALS ============================================== -->
        @include('frontend.common.hot_deals')
        <!-- ============================================== HOT DEALS: END ============================================== --> 

        <!-- ============================================== SPECIAL OFFER ============================================== -->
        @include('frontend.common.special_offer')
        <!-- ============================================== SPECIAL OFFER : END ============================================== --> 
        
        <!-- ============================================== PRODUCT TAGS ============================================== -->
        @include('frontend.common.product_tags')
        <!-- ============================================== PRODUCT TAGS : END ============================================== --> 
        <br>
        <!-- ============================================== SPECIAL DEALS ============================================== -->
        @include('frontend.common.special_deal')
        <!-- ============================================== SPECIAL DEALS : END ============================================== -->  
      </div>
      <!-- /.sidemenu-holder --> 
      <!-- ============================================== SIDEBAR : END ============================================== --> 
      
      
      <!-- /.homebanner-holder --> 
      <!-- ============================================== CONTENT : END ============================================== --> 
    </div>
    <!-- /.row --> 
    <!-- ============================================== BRANDS CAROUSEL ============================================== -->
    @include('frontend.body.brand')
    <!-- /.logo-slider --> 
    <!-- ============================================== BRANDS CAROUSEL : END ============================================== --> 
  </div>
  <!-- /.container --> 
</div>

@endsection