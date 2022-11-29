@extends('frontend.main_master')
@section('content')

<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h3 class="text-center">
                        <span class="text-danger">Hi </span><strong>{{  Auth::user()->name }}</strong> 
                        Welcome To Sahira. <br>
                        Hope you enjoy shopping here ;)
                    </h3>
                </div>
                @include('frontend.common.user_sidebar')
            </div>
        </div>
    </div>
</div>

@endsection