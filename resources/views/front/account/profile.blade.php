@extends('front.layouts.app')
<link href="{{asset('admin-assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('admin-assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
@section('content')
<div class="main">
    <div class="container">
      <ul class="breadcrumb">
          <li><a href="{{ route('front.home')}}">Home</a></li>
          <li class="active">My Profile</li>
      </ul>
      <!-- BEGIN SIDEBAR & CONTENT -->
      <div class="row margin-bottom-40">
        <!-- BEGIN SIDEBAR -->
        <div class="sidebar col-md-3 col-sm-3">
          <ul class="list-group margin-bottom-25 sidebar-menu">
            <li class="list-group-item clearfix"><a href="{{route('account.profile')}}"> My Profile</a></li>
            <li class="list-group-item clearfix"><a href="{{route('account.order')}}"> My Orders</a></li>
            <li class="list-group-item clearfix"><a href="javascript:;"> Wish list</a></li>
            <li class="list-group-item clearfix"><a href="javascript:;">Restore Password</a></li>
            <li class="list-group-item clearfix"><a href="{{route('account.logout')}}">Logout</a></li>
          </ul>
        </div>
        <!-- END SIDEBAR -->

        <!-- BEGIN CONTENT -->
        <div class="col-md-9 col-sm-9">
          <div class="content-page">
            <h2>Personel Informations</h2>            
            <!-- BEGIN FORM-->
            <form action="#" class="default-form" role="form">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name">
              </div>
              <div class="form-group">
                <label for="email">Email <span class="require">*</span></label>
                <input type="text" class="form-control" name="email" id="email">
              </div>
              <div class="form-group">
                <label for="phone">Phone <span class="require">*</span></label>
                <input type="text" class="form-control" name="phone" id="phone">
              </div>
              <div class="form-group">
                <label for="Address">Address</label>
                <textarea class="form-control" rows="8" name="address" id="address"></textarea>
              </div>
              <div class="padding-top-20">                  
                <button type="submit" class="btn btn-success">Submit</button>
              </div>
            </form>
            <!-- END FORM-->          
          </div>
        </div>
        <!-- END CONTENT -->
      </div>
      <!-- END SIDEBAR & CONTENT -->
    </div>
  </div>
<div class="mb-5"></div>

@endsection
@section('customJs')
<script src="{{asset('admin-assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('admin-assets/js/scripts.bundle.js')}}"></script>
<script src="{{asset('admin-assets/js/custom/authentication/sign-up/general.js')}}"></script>

@endsection