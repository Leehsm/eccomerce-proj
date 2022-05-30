@extends('frontend.main_master')
@section('content')

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{ url('/') }}">Home</a></li>
				<li class='active'>Sign Up</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="sign-in-page" style="width: 80%; margin-left: auto; margin-right: auto;">
			<div class="row">
				<div class="col-md-12 col-sm-12 create-new-account">
					<h4 class="checkout-subtitle">Create a new account</h4>
					<p class="text title-tag-line">Create your new account.</p>
					<form method="POST" action="{{ route('register') }}">
						@csrf
						<div class="form-group">
							<label class="info-title" for="exampleInputEmail1">Name <span>*</span></label>
							<input id="name" type="text" name="name" class="form-control unicase-form-control text-input">
							@error('name')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
						<div class="form-group">
							<label class="info-title" for="exampleInputEmail2">Email Address <span>*</span></label>
							<input id="email" type="email" name="email" class="form-control unicase-form-control text-input">
							@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
						<div class="form-group">
							<label class="info-title" for="exampleInputEmail1">Phone Number <span>*</span></label>
							<input type="text" id="phone" name="phone" class="form-control unicase-form-control text-input" id="exampleInputEmail1" >
							@error('phone')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
						<div class="form-group">
							<label class="info-title" for="exampleInputEmail1">Password <span>*</span></label>
							<input type="password" id="password" name="password" class="form-control unicase-form-control text-input">
							@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
						<div class="form-group">
							<label class="info-title" for="exampleInputEmail1">Confirm Password <span>*</span></label>
							<input type="password" id="password_confirmation" name="password_confirmation" class="form-control unicase-form-control text-input" >
							@error('password_confirmation')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
						<button type="submit" class="btn-upper btn btn-primary checkout-page-button">Sign Up</button>
					</form>	
				</div>	
			</div>
		</div>
		@include('frontend.body.brand')
	</div>
</div>

@endsection