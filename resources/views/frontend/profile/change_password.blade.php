@extends('frontend.main_master')
@section('content')

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{ url('dashboard') }}">Dashboard</a></li>
				<li class='active'>Update Password</li>
			</ul>
		</div>
	</div>
</div>
<div class="body-content">
    <div class="container">
        <div class="row">
            {{-- @include('frontend.common.user_sidebar') --}}
            <div class="col-md-2">
                
            </div>
            <div class="col-md-8">
                <div class="card">
                    <h3 class="text-center">
                        <span class="text-danger"></span><strong></strong> Change Your Password
                    </h3>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.password.update')}}">
                            @csrf
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Current Password <span>*</span></label>
                                <input type="password" id="current_password" name="current_password" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">New Password <span>*</span></label>
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Confirm New Password <span>*</span></label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection