@extends('admin.admin_master')
@section('admin')
    
<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="box box-inverse bg-img" style="background-image: url(../images/gallery/full/1.jpg);" data-overlay="2">
                <div class="flexbox px-20 pt-20">
                  <label class="toggler toggler-danger text-white">
                    <input type="checkbox">
                    <i class="fa fa-heart"></i>
                  </label>
                  <div class="dropdown">
                    <a data-toggle="dropdown" href="#"><i class="ti-more-alt rotate-90 text-white"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="{{ route('admin.profile.edit') }}"><i class="fa fa-user"></i> Edit Profile</a>
                      <a class="dropdown-item" href="#"><i class="fa fa-picture-o"></i> Shots</a>
                      <a class="dropdown-item" href="#"><i class="ti-check"></i> Follow</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#"><i class="fa fa-ban"></i> Block</a>
                    </div>
                  </div>
                </div>

                <div class="box-body text-center pb-50">
                  <a href="#">
                    <img class="avatar avatar-xxl avatar-bordered" 
                      src="{{ (!empty($adminData->profile_photo_path)) 
                      ? url('upload/admin_images/'.$adminData->profile_photo_path)
                      :url('upload/no_image.jpg') }}" alt="">
                  </a>
                  <h4 class="mt-2 mb-0">{{ $adminData->name }}</h4>
                  <span> {{ $adminData->email}}</span>
                </div>

                <ul class="box-body flexbox flex-justified text-center" data-overlay="4">
                  <li>
                    <span class="opacity-60">Followers</span><br>
                    <span class="font-size-20">8.6K</span>
                  </li>
                  <li>
                    <span class="opacity-60">Following</span><br>
                    <span class="font-size-20">8457</span>
                  </li>
                  <li>
                    <span class="opacity-60">Tweets</span><br>
                    <span class="font-size-20">2154</span>
                  </li>
                </ul>
              </div>
        </div>
    </section>
    <!-- /.content -->
</div>

@endsection
