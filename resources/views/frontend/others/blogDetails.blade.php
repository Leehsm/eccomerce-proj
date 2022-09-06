@extends('frontend.main_master')
@section('content')

@section('title')
Blog
@endsection

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{ url('/') }}">Home</a></li>
				<li><a href="{{ url('/blog') }}">Blog</a></li>
				<li class='active'>Blog Detail</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="row">
			<div class="blog-page">
				<div class="col-md-12">
					<div class="blog-post wow fadeInUp">
                        <img class="img-responsive" src="{{ asset($blogs->blogImg) }}" style="display: block; margin-left: auto; margin-right: auto;">
                        <h1>{{ $blogs->title }}</h1>
                        <span class="date-time">{{ $blogs->date }}</span>
                        <p style="text-align: justify; text-justify: inter-word;">{{ $blogs->long_description }}</p>    
                        <br><br>
                        
                        <div id="hero" style="width: 68%;margin-left: 15%">
                            <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
                              @foreach($multiImageBlogs as $multiImageBlog)
                                <a >
                                  <div class="item" style="background-image: url({{ asset($multiImageBlog->photo_name) }});"></div>
                                </a>
                                <!-- /.item -->
                              @endforeach
                            </div>
                            <!-- /.owl-carousel --> 
                        </div>     
                        
                        <br><br>
                        <p style="text-align: justify; text-justify: inter-word;">{{ $blogs->long_description }}</p>  

                        <div class="social-media">
                            <span>share post:</span>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-whatsapp"></i></a>
                        </div>
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
            
        </div><!-- /.owl-carousel #logo-slider -->
    </div><!-- /.logo-slider-inner -->
</div><!-- /.logo-slider -->
@endsection