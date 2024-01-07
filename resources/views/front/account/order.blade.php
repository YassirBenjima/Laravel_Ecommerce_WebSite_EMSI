@extends('front.layouts.app')
@section('content')
<main>
  <section class="section-5 pt-3 pb-3 mb-3 bg-white">
      <div class="container">
          <div class="light-font">
              <ol class="breadcrumb primary-color mb-0">
                  <li class="breadcrumb-item"><a class="white-text" href="{{route('account.profile')}}">My Account</a></li>
                  <li class="breadcrumb-item">My Orders</li>
              </ol>
          </div>
      </div>
  </section>

  <section class=" section-11 ">
      <div class="container  mt-5">
          <div class="row">
            <div class="sidebar col-md-3 col-sm-3">
              <ul class="list-group margin-bottom-25 sidebar-menu">
                <li class="list-group-item clearfix"><a href="{{route('account.profile')}}"> My Profile</a></li>
                <li class="list-group-item clearfix"><a href="{{route('account.order')}}"> My Orders</a></li>
                <li class="list-group-item clearfix"><a href="javascript:;"> Wish list</a></li>
                <li class="list-group-item clearfix"><a href="javascript:;">Restore Password</a></li>
                <li class="list-group-item clearfix"><a href="{{route('account.logout')}}">Logout</a></li>
              </ul>
            </div>
              <div class="col-md-9">
                  <div class="card">
                      <div class="card-header">
                          <h2 class="h5 mb-0 pt-2 pb-2">My Orders</h2>
                      </div>
                      <div class="card-body p-4">
                          <div class="table-responsive">
                              <table class="table">
                                  <thead> 
                                      <tr>
                                          <th>Orders #</th>
                                          <th>Date Purchased</th>
                                          <th>Status</th>
                                          <th>Total</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @if ($orders->isNotEmpty())
                                    @foreach($orders as $order)
                                      <tr>
                                          <td>
                                              <a href="order-detail.php">{{$order->id}}</a>
                                          </td>
                                          <td>{{  \Carbon\Carbon::parse($order->created_at)->format('d M, Y')  }}</td>
                                          <td>
                                              @if ($order->status == 'pending')
                                                <span class="badge btn-danger bg-danger">Pending</span>
                                              @elseif ($order->status == 'shipped')
                                                <span class="badge btn-info bg-info">Shipped</span>
                                              @else
                                                <span class="badge btn-success bg-success">Delivered</span>
                                              @endif
                                          </td>
                                          <td>$ {{ number_format($order->grand_total,2)}}</td>
                                      </tr>  
                                      @endforeach  
                                      @else
                                        <tr>
                                            <td colspan="3">Orders Nout Found</td>
                                        </tr>  
                                      @endif                   
                                  </tbody>
                              </table>
                          </div>                            
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
</main>
<div class="mb-5"></div>
@endsection