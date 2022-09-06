@extends('frontend.main_master')
@section('content')

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href={{ url('/') }}>Home</a></li>
				<li class='active'>Login</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="sign-in-page" style="width: 80%; margin-left: auto; margin-right: auto;">
			<div class="row">
				<!-- Sign-in -->			
				<div class="col-md-12 col-sm-12 sign-in">
					<h4 class="">Sign in</h4>
					<p class="">Hello, Welcome to your account.</p>
					<div class="social-sign-in outer-top-xs" style="margin-left: auto; margin-right: auto;">
						{{-- <a href="#" class="facebook-sign-in"><i class="fa fa-facebook"></i> Sign In with Facebook</a>
						<a href="{{ route('google.login') }}" class="twitter-sign-in"><i class="fa fa-google"></i> Sign In with Google</a> --}}
					</div>
					{{-- <br> --}}
					<form method="POST" action="{{ isset($guard) ? url($guard.'/login') : route('login') }}">
						@csrf
						<div class="form-group">
							<label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
							<input type="email" id="email" name="email" class="form-control unicase-form-control text-input">
							@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
						<div class="form-group">
							<label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
							<input type="password" id="password" name="password" class="form-control unicase-form-control text-input" >
							<a href="{{ route('password.request') }}" class="forgot-password pull-right">Forgot your Password?</a>
							@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
						{{-- <div class="radio outer-xs">
							<label>
								<input type="checkbox" name="rememberMe" id="rememberMe" value="Remember Me">
								<label for="rememberMe"> Remember Me!</label><br>
							</label>
						</div> --}}
						<button type="submit" class="btn-upper btn btn-primary checkout-page-button">Login</button>
						<button type="button" class="btn-upper btn btn-primary checkout-page-button"><a href="{{ route('user.register') }}" style="color: aliceblue">Sign Up</a></button>
					</form>					
				</div>	
			</div><!-- /.row -->
		</div><!-- /.sigin-in-->  
	@include('frontend.body.brand')
	</div><!-- /.body-content -->
</div>
@endsection