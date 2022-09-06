@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
    // dd($prefix);
@endphp

<aside class="main-sidebar">
    <!-- sidebar-->
  <section class="sidebar">	
    <div class="user-profile">
      <div class="ulogo">
        <a href="index.html">
          <!-- logo for regular state and mobile devices -->
          <div class="d-flex align-items-center justify-content-center">			
            <img src="{{ asset('backend/images/logo.png') }}" alt="" style="width: 25%">
              <h3><b>Sahira</b> Shop</h3>
          </div>
        </a>
        <!-- item-->
        {{-- <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a> --}}
        <!-- item-->
        <a href="{{ route('stock-cart') }}" class="link" data-toggle="tooltip" title="" data-original-title="Stock Cart"><i class="ti-agenda"></i></a>
        <!-- item-->
        <a href="{{ route('admin.logout') }}" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
      </div>
    </div>
    <!-- sidebar menu-->
    <ul class="sidebar-menu" data-widget="tree">  
      <li class="{{ ($route == 'dashboard')? 'active':'' }}">
        <a href="{{ url('admin/dashboard') }}">
          <i data-feather="trello"></i>
          <span>Dashboard</span>
        </a>
      </li>  
      <li class="treeview {{ ($prefix == '/brand')? 'active':'' }}">
        <a href="#">
          <i data-feather="award"></i>
          <span>Brand</span>
          <span class="pull-right-container">
          <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'all.brand')? 'active':'' }}"><a href="{{ route('all.brand') }}"><i class="ti-more"></i>All Brand</a></li>
        </ul>
      </li> 
      <li class="treeview {{ ($prefix == '/category')? 'active':'' }}">
        <a href="#">
          <i data-feather="image"></i> <span>Category</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'all.category')? 'active':'' }}"><a href="{{ route('all.category') }}"><a href="{{ route('all.category') }}"><i class="ti-more"></i>All Category</a></li>
          <li class="{{ ($route == 'all.subcategory')? 'active':'' }}"><a href="{{ route('all.subcategory') }}"><a href="{{ route('all.subcategory') }}"><i class="ti-more"></i>All Sub Category</a></li>
          <li class="{{ ($route == 'all.subsubcategory')? 'active':'' }}"><a href="{{ route('all.subsubcategory') }}"><a href="{{ route('all.subsubcategory') }}"><i class="ti-more"></i>All Sub Sub Category</a></li>
        </ul>
      </li>
      <li class="treeview {{ ($prefix == '/product')? 'active':'' }}">
        <a href="#">
          <i data-feather="tag"></i>
          <span>Products</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'add-product')? 'active':'' }}"><a href="{{ route('add-product') }}" ><i class="ti-more"></i>Add Product</a></li>
          <li class="{{ ($route == 'product-manage')? 'active':'' }}"><a href="{{ route('product-manage') }}" ><i class="ti-more"></i>Manage Product</a></li>
        </ul>
      </li> 	
      <li class="treeview {{ ($prefix == '/slider')? 'active':'' }}">
        <a href="#">
          <i data-feather="airplay"></i>
          <span>Sliders</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          {{-- <li class="{{ ($route == 'add-product')? 'active':'' }}"><a href="{{ route('add-product') }}" ><i class="ti-more"></i>Add Slider</a></li> --}}
          <li class="{{ ($route == 'manage-slider')? 'active':'' }}"><a href="{{ route('manage-slider') }}" ><i class="ti-more"></i>Manage Slider</a></li>
        </ul>
      </li> 
      <li class="treeview {{ ($prefix == '/coupons')?'active':'' }}  ">
        <a href="#">
          <i data-feather="percent"></i>
          <span>Coupons</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'manage-coupon')? 'active':'' }}"><a href="{{ route('manage-coupon') }}"><i class="ti-more"></i>Manage Coupon</a></li>
        </ul>
      </li>      
      {{-- <li class="treeview {{ ($prefix == '/shipping')?'active':'' }}  ">
        <a href="#">
          <i data-feather="bookmark"></i>
          <span>Shipping Area</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'manage-division')? 'active':'' }}"><a href="{{ route('manage-division') }}"><i class="ti-more"></i>Ship State</a></li>
          <li class="{{ ($route == 'manage-district')? 'active':'' }}"><a href="{{ route('manage-district') }}"><i class="ti-more"></i>Ship District</a></li>
          <li class="{{ ($route == 'manage-state')? 'active':'' }}"><a href="{{ route('manage-state') }}"><i class="ti-more"></i>Ship Country</a></li>  
        </ul>
      </li> --}}


      <li class="header nav-small-cap">Sales</li>
      <li class="treeview {{ ($prefix == '/orders')?'active':'' }}  ">
        <a href="#">
          <i data-feather="package"></i>
          <span>Customer Orders</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'pending-orders')? 'active':'' }}"><a href="{{ route('pending-orders') }}"><i class="ti-more"></i>Pending Orders</a></li>
          <li class="{{ ($route == 'confirmed-orders')? 'active':'' }}"><a href="{{ route('confirmed-orders') }}"><i class="ti-more"></i>Confirmed Orders</a></li>
          <li class="{{ ($route == 'processing-orders')? 'active':'' }}"><a href="{{ route('processing-orders') }}"><i class="ti-more"></i>Processing Orders</a></li>
          <li class="{{ ($route == 'picked-orders')? 'active':'' }}"><a href="{{ route('picked-orders') }}"><i class="ti-more"></i>Picked Orders</a></li>
          <li class="{{ ($route == 'shipped-orders')? 'active':'' }}"><a href="{{ route('shipped-orders') }}"><i class="ti-more"></i>Shipped Orders</a></li>
          <li class="{{ ($route == 'delivered-orders')? 'active':'' }}"><a href="{{ route('delivered-orders') }}"><i class="ti-more"></i>Delivered Orders</a></li>
          <li class="{{ ($route == 'cancel-orders')? 'active':'' }}"><a href="{{ route('cancel-orders') }}"><i class="ti-more"></i>Cancel Orders</a></li>
        </ul>
      </li>
      <li class="treeview {{ ($prefix == '/report')?'active':'' }}  ">
        <a href="#">
          <i data-feather="file-text"></i>
          <span>Report</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'all-report')? 'active':'' }}"><a href="{{ route('all-report') }}"><i class="ti-more"></i>By Date, Month & Year</a></li>
          <li class="{{ ($route == 'report-by-cust-name')? 'active':'' }}"><a href="{{ route('report-by-cust-name') }}"><i class="ti-more"></i>By Customer Name</a></li>
        </ul>
      </li> 		  
      <li class="treeview {{ ($prefix == '/alluser')?'active':'' }}  ">
        <a href="#">
          <i data-feather="users"></i>
          <span>All User</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'all-user')? 'active':'' }}"><a href="{{ route('all-user') }}"><i class="ti-more"></i>All User</a></li>
        </ul>
      </li> 


      <li class="header nav-small-cap">Others</li>
      <li class="treeview {{ ($prefix == '/blog')?'active':'' }}  ">
        <a href="#">
          <i data-feather="book-open"></i>
          <span>Blog</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'all-blog')? 'active':'' }}"><a href="{{ route('all-blog') }}"><i class="ti-more"></i>All Blog</a></li>
          <li class="{{ ($route == 'blog.add')? 'active':'' }}"><a href="{{ route('blog.add') }}"><i class="ti-more"></i>Add Blog</a></li>
        </ul>
      </li>

      <li class="treeview {{ ($prefix == '/contact')?'active':'' }}  ">
        <a href="#">
          <i data-feather="phone-call"></i>
          <span>Contact</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'all-contact')? 'active':'' }}"><a href="{{ route('all-contact') }}"><i class="ti-more"></i>All Contact</a></li>
          <li class="{{ ($route == 'contact.add')? 'active':'' }}"><a href="{{ route('contact.add') }}"><i class="ti-more"></i>Add Contact</a></li>
        </ul>
      </li>
    </ul>


  </section>
	{{-- <div class="sidebar-footer">
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
		<!-- item-->
		<a href="{{ route('stock-cart') }}" class="link" data-toggle="tooltip" title="" data-original-title="Stock Cart"><i class="ti-agenda"></i></a>
		<!-- item-->
		<a href="{{ route('admin.logout') }}" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
	</div> --}}
</aside>