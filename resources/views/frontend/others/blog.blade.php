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
				<li class='active'>Blog</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="row">
			<div class="blog-page">
				<div class="col-md-12" align="center">
                    @foreach($blogs as $blog)
					<div class="blog-post  wow fadeInUp">
                        <a><img class="img-responsive" src="{{ asset($blog->blogImg) }}" alt=""></a>
                        <h1>{{ $blog->title }}</h1>
                        <div style="width:80%">
                            <span class="date-time">{{ $blog->date }}</span>
                            <p style="text-align: justify; text-justify: inter-word;">{{ $blog->description }}</p>
                            <a href="{{ url('blog/blog-details/'.$blog->id)}}" class="btn btn-upper btn-primary read-more">read more</a>
                        </div>
                    </div>
                    @endforeach
                    <div class="clearfix blog-pagination filters-container  wow fadeInUp" style="padding:0px; background:none; box-shadow:none; margin-top:15px; border:none">
                        <div class="text-right">
                            <div class="pagination-container">
                                <ul class="list-inline list-unstyled">
                                    <li class="prev"><a href="#"><i class="fa fa-angle-left"></i></a></li>
                                    <li><a href="#">1</a></li>	
                                    <li class="active"><a href="#">2</a></li>	
                                    <li><a href="#">3</a></li>	
                                    <li><a href="#">4</a></li>	
                                    <li class="next"><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                </ul><!-- /.list-inline -->
                            </div><!-- /.pagination-container -->    
                        </div><!-- /.text-right -->
                    </div><!-- /.filters-container -->				
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