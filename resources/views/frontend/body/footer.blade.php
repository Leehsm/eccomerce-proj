<footer id="footer" class="footer color-bg">
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-3">
          <div class="module-heading">
            <h4 class="module-title"></h4>
          </div>
          <!-- /.module-heading -->
          
          <div class="module-body">
            <ul class="toggle-footer" style="">
              <li class="media">
                <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-map-marker fa-stack-1x fa-inverse"></i> </span> </div>
                <div class="media-body">
                  <p><a href="https://goo.gl/maps/CPH4cmsrjp7w77o47">No. 10 Kampung Batu 25, 81500 Pontian Johor</a></p>
                </div>
              </li>
              <li class="media">
                <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-mobile fa-stack-1x fa-inverse"></i> </span> </div>
                <div class="media-body">
                  <p><a href="tel:123-456-7890"> 123-4567</a><br>
                </div>
              </li>
              <li class="media">
                <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-envelope fa-stack-1x fa-inverse"></i> </span> </div>
                <div class="media-body"> <span><a href="mailto: sahirashop25@gmail.com">sahirashop@gmail.com</a></span> </div>
              </li>
            </ul>
          </div>
          <!-- /.module-body --> 
        </div>
        <!-- /.col -->
        
        <div class="col-xs-12 col-sm-6 col-md-3">
          <div class="module-heading">
            <h4 class="module-title">Get Help</h4>
          </div>
          <!-- /.module-heading -->
          
          <div class="module-body">
            <ul class='list-unstyled'>
              @auth
              <li class="first"><a href="{{ route('dashboard') }}" title="My Account">My Account</a></li>
              <li><a href="{{ route('my.orders') }}" title="Order History">Order History</a></li>
              @endauth
              <li><a href="{{ route('faq') }}" title="faq">FAQ</a></li>
              <li><a href="{{ route('delivery') }}" title="Delivery">Delivery</a></li>
              <li class="last"><a href="{{ route('contact-us') }}" title="Contact Us">Contact Us</a></li>
            </ul>
          </div>
          <!-- /.module-body --> 
        </div>
        <!-- /.col -->
        
        <div class="col-xs-12 col-sm-6 col-md-3">
          <div class="module-heading">
            <h4 class="module-title">About Sahira</h4>
          </div>
          <!-- /.module-heading -->
          
          <div class="module-body">
            <ul class='list-unstyled'>
              <li class="first"><a title="Company" href="#">Company</a></li>
              <li><a title="Blogs" href="#">Blogs</a></li>
              <li class="last"><a title="Membership">Membership (Coming Soon)</a></li>
            </ul>
          </div>
          <!-- /.module-body --> 
        </div>
        <!-- /.col -->
        
        <div class="col-xs-12 col-sm-6 col-md-3">
          <div class="module-heading">
            <h4 class="module-title">Find Us:</h4>
          </div>
          <!-- /.module-heading -->
          
          <div class="module-body">
            <a target="_blank" href="https://web.facebook.com/TonerSerumHouse" title="Facebook"><img src="{{ asset('frontend/assets/images/social/facebook.png') }}" style="width: 15%; height: 15%"></a></li>
            <a target="_blank" href="https://www.instagram.com/_sahirashop_/?hl=en" title="Instagram"><img src="{{ asset('frontend/assets/images/social/instagram.png') }}" style="width: 17%; height: 17%"></a></li>
            <a target="_blank" href="https://www.tiktok.com/@_sahirashop_" title="Tiktok"><img src="{{ asset('frontend/assets/images/social/tik-tok.png') }}" style="width: 15%; height: 15%"></a></li>
            <a target="_blank" href="https://www.youtube.com/channel/UCmowQRy-W0_Evqzcz925uwg" title="Youtube"><img src="{{ asset('frontend/assets/images/social/youtube.png') }}" style="width: 15%; height: 15%"></a></li>               
          </div>
          <!-- /.module-body --> 
        </div>
      </div>
    </div>
  </div>
</footer>