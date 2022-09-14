<header class="header-style-1"> 
    <!-- ============================================== TOP MENU ============================================== -->
    <div class="top-bar animate-dropdown">
      <div class="container">
        <div class="header-top-inner">
          <div class="cnt-account">
            <ul class="list-unstyled">
              {{-- <li><a href="{{ route('wishlist') }}"><i class="icon fa fa-heart"></i>Wishlist</a></li> --}}
              <li><a href="{{ route('my.orders') }}"><i class="icon fa fa-history"></i>Order History</a></li>
              <li>
                <a href="{{ route('mycart') }}"><i class="icon fa fa-shopping-cart"></i>
                  @if(session()->get('language') == 'malay') 
                    Troli saya
                  @else 
                    My Cart
                  @endif
                </a>
              </li>

              @auth
              <li>
                <a href="{{ route('dashboard') }}"><i class="icon fa fa-user"></i>
                  @if(session()->get('language') == 'malay') 
                    Akaun Saya 
                  @else 
                    My Account 
                  @endif
                </a>
              </li>
              <li>
                <a href="{{ route('user.logout') }}"><i class="icon fa fa-lock"></i>
                  @if(session()->get('language') == 'malay') 
                    Log Keluar
                  @else 
                    Log Out
                  @endif
                </a>
              </li>
              @else
              <li>
                <a href="{{ route('login') }}"><i class="icon fa fa-lock"></i>
                  @if(session()->get('language') == 'malay') 
                    Log Masuk/Daftar
                  @else 
                    Login/Register
                  @endif
                </a>
              </li>
              @endauth
            </ul>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
    <!-- ============================================== TOP MENU : END ============================================== -->

    <div class="main-header">
      <div class="container">
        <div class="row">

          <!-- ============================================================= LOGO ============================================================= -->
          <div class="col-xs-12 col-sm-12 col-md-3 logo-holder"> 
            <div class="logo"> 
              <a href="{{ url('/') }}"> 
                <img src="{{ asset('frontend/assets/images/slogo.png') }}" alt="logo" style="width: 60%"> 
              </a> 
            </div>
          </div>
          <!-- ============================================================= LOGO ============================================================= -->
          
          <!-- ============================================================= SEARCH AREA ============================================================= -->
          <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder"> 
            <div class="search-area">
              <form method="post" action="{{ route('product.search') }}">
                @csrf
                <div class="control-group">
                  <input class="search-field" type="search" name="search" placeholder="Search here..." />
                  <button type="submit"class="search-button"></button>
                </div>
              </form>
            </div>
          </div>
          <!-- ============================================================= SEARCH AREA : END ============================================================= --> 
          
          <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
          <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row"> 
            <div class="dropdown dropdown-cart"> 
              <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
              <div class="items-cart-inner">
                <div class="basket"> 
                  <i class="glyphicon glyphicon-shopping-cart"></i> 
                </div>
                <div class="basket-item-count">
                  <span class="count" id="cartQty"> </span>
                </div>
                <div class="total-price-basket"> 
                  <span class="lbl">cart -</span> 
                  <span class="total-price"> 
                    <span class="sign">RM</span>
                    <span class="value" id="cartSubTotal"> </span> 
                  </span> 
                </div>
              </div>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <!--   // Mini Cart Start with Ajax -->
                  <div id="miniCart">

                  </div>
                  <!--   // End Mini Cart Start with Ajax -->
                  <div class="clearfix cart-total">
                    <div class="pull-right"> <span class="text">Sub Total : RM</span>
                      <span class='price'  id="cartSubTotal"> </span> 
                    </div>
                    <div class="clearfix"></div>
                    <a href="{{ route('mycart') }}" class="btn btn-upper btn-primary btn-block m-t-20">View Cart</a> 
                  </div>
                </li>
              </ul>
            </div>
          </div>
          <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= --> 

        </div>
      </div>
    </div>
    
    <!-- ============================================== NAVBAR ============================================== -->
    <div class="header-nav animate-dropdown">
      <div class="container">
        <div class="yamm navbar navbar-default" role="navigation">
          <div class="navbar-header">
         <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> 
         <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
          </div>
          <div class="nav-bg-class">
            <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
              <div class="nav-outer">
                <ul class="nav navbar-nav">
                  {{-- Start --}}
                  {{-- <li class="active dropdown yamm-fw"> <a href="{{ url('/') }}" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">Home</a> </li> --}}
                  <li class="active dropdown yamm-fw"> 
                    <a href="{{ url('/') }}" data-hover="dropdown" class="dropdown-toggle" >
                      @if(session()->get('language') == 'malay') 
                        Laman Utama 
                      @else
                        Home 
                      @endif
                    </a> 
                  </li>
                <!--   // Get Category Table Data -->
                  @php
                    $categories = App\Models\Category::orderBy('category_name_en','ASC')->get();
                  @endphp

                  @foreach($categories as $category)
                    {{-- <li class="dropdown yamm mega-menu"><a href="home.html" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">{{ $category->category_name_en }}</a> --}}
                    <li class="dropdown yamm mega-menu"> 
                      <a href="home.html" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">
                        @if(session()->get('language') == 'malay') 
                          {{ $category->category_name_my }} 
                        @else 
                          {{ $category->category_name_en }} 
                        @endif
                      </a>
                      <ul class="dropdown-menu container">
                        <li>
                          <div class="yamm-content ">
                            <div class="row">
                              <!--   // Get SubCategory Table Data -->
                              @php
                                $subcategories = App\Models\SubCategory::where('category_id',$category->id)->orderBy('subcategory_name_en','ASC')->get();
                              @endphp

                              @foreach($subcategories as $subcategory)
                                <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                                  {{-- <h2 class="title">{{ $subcategory->subcategory_name_en }}</h2> --}}
                                  <a href="{{ url('subcategory/product/'.$subcategory->id.'/'.$subcategory->subcategory_slug_en ) }}">
                                    <h2 class="title">
                                      @if(session()->get('language') == 'malay') 
                                        {{ $subcategory->subcategory_name_my }} 
                                      @else 
                                        {{ $subcategory->subcategory_name_en }} 
                                      @endif
                                    </h2>
                                  </a>

                                  <!--   // Get SubSubCategory Table Data -->
                                  @php
                                    $subsubcategories = App\Models\SubSubCategory::where('subcategory_id',$subcategory->id)->orderBy('subsubcategory_name_en','ASC')->get();
                                  @endphp          

                                  @foreach($subsubcategories as $subsubcategory)
                                    <ul class="links">
                                      {{-- <li><a href="#">{{ $subsubcategory->subsubcategory_name_en }}</a></li> --}}
                                      <li>
                                        <li><a href="{{ url('subsubcategory/product/'.$subsubcategory->id.'/'.$subsubcategory->subsubcategory_slug_en ) }}">
                                          @if(session()->get('language') == 'malay') 
                                            {{ $subsubcategory->subsubcategory_name_my }} 
                                          @else 
                                            {{ $subsubcategory->subsubcategory_name_en }} 
                                          @endif
                                        </a>
                                      </li>
                                    </ul>
                                  @endforeach <!-- // End SubSubCategory Foreach -->

                                </div>
                              @endforeach <!-- // End SubCategory Foreach -->

                              {{-- GAMBAR --}}
                              {{-- <div class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image"> <img class="img-responsive" src="{{ asset('frontend/assets/images/banners/ramadhan.png') }}" alt=""> </div> --}}
                              <!-- /.yamm-content --> 
                            </div>
                          </div>
                        </li>
                      </ul>
                    </li>
                  @endforeach <!-- // End Category Foreach -->
                  {{-- <li class="dropdown  navbar-right special-menu"> <a href="#">Todays offer</a> </li> --}}
                  {{-- END --}}
                </ul>
                <!-- /.navbar-nav -->
                <div class="clearfix"></div>
              </div>
              <!-- /.nav-outer --> 
            </div>
            <!-- /.navbar-collapse --> 
            
          </div>
          <!-- /.nav-bg-class --> 
        </div>
        <!-- /.navbar-default --> 
      </div>
      <!-- /.container-class --> 
      
    </div>
    <!-- /.header-nav --> 
    <!-- ============================================== NAVBAR : END ============================================== --> 
    
</header>