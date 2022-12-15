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
        <a href="{{url('/stock-cart')}}">
          <!-- logo for regular state and mobile devices -->
          <div class="d-flex align-items-center justify-content-center">					 	
              <img src="{{ asset('backend/images/logo.png') }}" alt="" style="width: 25%">
              <h3><b>Stock </b> Cart</h3>
          </div>
        </a>
        <!-- item-->
        {{-- <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a> --}}
        <!-- item-->
        <a href="{{ url('/admin/dashboard') }}" class="link" data-toggle="tooltip" title="" data-original-title="Manage Shop"><i class="ti-shopping-cart-full"></i></a>
        <!-- item-->
        <a href="{{ route('admin.logout') }}" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
      </div>
    </div>
    <!-- sidebar menu-->
    <ul class="sidebar-menu" data-widget="tree">  
      <li class="{{ ($route == 'stock-cart')? 'active':'' }}">
        <a href="{{ url('/stock-cart') }}">
          <i data-feather="trello"></i>
          <span>Dashboard</span>
        </a>
      </li>  
      <li class="treeview {{ ($prefix == '/clothing')? 'active':'' }}">
        <a href="#">
          <i data-feather="award"></i>
          <span>Clothing</span>
          <span class="pull-right-container">
          <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'manage-cloth')? 'active':'' }}"><a href="{{ route('manage-cloth') }}"><a href="{{ route('manage-cloth') }}"><i class="ti-more"></i>View</a></li>
          <li class="{{ ($route == 'add-cloth')? 'active':'' }}"><a href="{{ route('add-cloth') }}"><a href="{{ route('add-cloth') }}"><i class="ti-more"></i>Add</a></li>
        </ul>
      </li> 
      <li class="treeview {{ ($prefix == '/bag')? 'active':'' }}">
        <a href="#">
          <i data-feather="image"></i> <span>Bag</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'manage-bag')? 'active':'' }}"><a href="{{ route('manage-bag') }}"><a href="{{ route('manage-bag') }}"><i class="ti-more"></i>View</a></li>
          <li class="{{ ($route == 'add-bag')? 'active':'' }}"><a href="{{ route('add-bag') }}"><a href="{{ route('add-bag') }}"><i class="ti-more"></i>Add</a></li>
        </ul>
      </li>      
      <li class="treeview {{ ($prefix == '/wallet')? 'active':'' }}">
        <a href="#">
          <i data-feather="airplay"></i>
          <span>Wallet / Purse</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'manage-wallet')? 'active':'' }}"><a href="{{ route('manage-wallet') }}"><a href="{{ route('manage-wallet') }}"><i class="ti-more"></i>View</a></li>
          <li class="{{ ($route == 'add-wallet')? 'active':'' }}"><a href="{{ route('add-wallet') }}"><a href="{{ route('add-wallet') }}"><i class="ti-more"></i>Add</a></li>
        </ul>
      </li> 
      <li class="treeview {{ ($prefix == '/skincare')?'active':'' }}  ">
        <a href="#">
          <i data-feather="percent"></i>
          <span>Skincare</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'manage-skincare')? 'active':'' }}"><a href="{{ route('manage-skincare') }}"><a href="{{ route('manage-skincare') }}"><i class="ti-more"></i>View</a></li>
          <li class="{{ ($route == 'add-skincare')? 'active':'' }}"><a href="{{ route('add-skincare') }}"><a href="{{ route('add-skincare') }}"><i class="ti-more"></i>Add</a></li>
        </ul>
      </li> 
      <li class="treeview {{ ($prefix == '/membership')?'active':'' }}  ">
        <a href="#">
          <i data-feather="users"></i>
          <span>Membership</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'manage-membership')? 'active':'' }}"><a href="{{ route('manage-membership') }}"><a href="{{ route('manage-membership') }}"><i class="ti-more"></i>View</a></li>
          <li class="{{ ($route == 'add-membership')? 'active':'' }}"><a href="{{ route('add-membership') }}"><a href="{{ route('add-membership') }}"><i class="ti-more"></i>Add</a></li>
        </ul>
      </li>            
    </ul>


  </section>
</aside>