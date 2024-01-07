@extends('front.layouts.app')
@section('content')
<div class="main">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{ route('front.home')}}">Home</a></li>
            <li><a href="{{ route('front.shop')}}">Shop</a></li>
            <li class="active">{{ $product->title}}</li>
        </ul>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
            <!-- BEGIN SIDEBAR -->
            <div class="sidebar col-md-3 col-sm-5">
                <ul class="list-group margin-bottom-25 sidebar-menu">
                    @if(getCategories()->isNotEmpty())
                    @foreach (getCategories() as $key => $category)
                    <li class="list-group-item clearfix dropdown active">
                        <a href="{{ route('front.shop',$category->slug)}}" class="collapsed">
                            <i class="fa fa-angle-right"></i>
                            {{$category->name}}
                        </a>
                        <ul class="dropdown-menu" style="display:block;">
                            @if($category->sub_category->isNotEmpty())
                            @foreach ($category->sub_category as $subCategory)
                            <li><a href="{{ route('front.shop',[$category->slug,$subCategory->slug])}}"><i class="fa fa-angle-right"></i> {{$subCategory->name}}</a></li>
                            @endforeach
                            @endif
                        </ul>
                    </li>
                    @endforeach
                    @endif
                </ul>

                <div class="sidebar-products clearfix">
                    <h2>Related Products</h2>
                    @if (!empty($relatedProducts))
                    @foreach ($relatedProducts as $relProduct)
                    @php
                    $productImage = $relProduct->product_images->first();
                    @endphp
                    <div class="item">
                        <a href="{{ route('front.product', $relProduct->slug)}}"><img src="{{ asset('uploads/product/small/' . $productImage->image )}}" alt="{{$relProduct -> title}}" /></a>
                        <h3>
                            <a href="{{ route('front.product', $relProduct->slug)}}">{{$relProduct -> title}}</a>
                        </h3>
                        <div class="price">${{$relProduct -> price}}</div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
            <!-- END SIDEBAR -->

            <!-- BEGIN CONTENT -->
            <div class="col-md-9 col-sm-7">
                <div class="product-page">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="product-main-image">
                                @php
                                $productImage = $product->product_images->first();
                                @endphp
                                <img src="{{ asset('uploads/product/small/' . $productImage->image) }}" alt="Cool green dress with red bell" class="img-responsive" data-BigImgsrc="assets/pages/img/products/model7.jpg" />
                            </div>
                            <div class="product-other-images">
                                @if ($product->product_images)
                                @foreach ($product->product_images as $key => $productImage)
                                <img alt="Berry Lace Dress" src="{{ asset('uploads/product/small/' . $productImage->image) }}" />
                                @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <h1>{{ $product->title}}</h1>
                            <div class="price-availability-block clearfix">
                                <div class="price">
                                    <strong><span>$</span>{{ $product->price}}</strong>
                                    <em>$<span>{{ $product->compare_price}}</span></em>
                                </div>
                                <div class="availability">
                                    @if( $product->qty > 0 ) Availability: <strong>In Stock</strong>
                                    @else
                                    Availability: <strong>Out Of Stock</strong>
                                    @endif
                                </div>
                            </div>
                            <div class="description">
                                <p> <!-- {!!$product->description!!} -->

                                    {{ html_entity_decode(strip_tags($product->short_description)) }}
                                </p>
                            </div>
                            <!-- <div class="product-page-options">
                                <div class="pull-left">
                                    <label class="control-label">Size:</label>
                                    <select class="form-control input-sm">
                                        <option>L</option>
                                        <option>M</option>
                                        <option>XL</option>
                                    </select>
                                </div>
                                <div class="pull-left">
                                    <label class="control-label">Color:</label>
                                    <select class="form-control input-sm">
                                        <option>Red</option>
                                        <option>Blue</option>
                                        <option>Black</option>
                                    </select>
                                </div>
                            </div> -->
                            <div class="product-page-cart">
                                <div class="product-quantity">
                                    <input id="product-quantity" type="text" value="1" readonly class="form-control input-sm" />
                                </div>
                                <a href="javascript:void(0);" onclick="addToCart('{{ $product->id }}');" class="btn btn-primary">
                                    Add to cart
                                </a>
                                
                            </div>
                            <div class="review">
                                <!-- <input type="range" value="4" step="0.25" id="backing4" /> -->
                                <div class="rateit" data-rateit-backingfld="#backing4" data-rateit-resetable="false" data-rateit-ispreset="true" data-rateit-min="0" data-rateit-max="5"></div>
                                <!-- <a href="javascript:;">7 reviews</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:;">Write a review</a> -->
                            </div>
                            <!-- <ul class="social-icons">
                                <li>
                                    <a class="facebook" data-original-title="facebook" href="javascript:;"></a>
                                </li>
                                <li>
                                    <a class="twitter" data-original-title="twitter" href="javascript:;"></a>
                                </li>
                                <li>
                                    <a class="googleplus" data-original-title="googleplus" href="javascript:;"></a>
                                </li>
                                <li>
                                    <a class="evernote" data-original-title="evernote" href="javascript:;"></a>
                                </li>
                                <li>
                                    <a class="tumblr" data-original-title="tumblr" href="javascript:;"></a>
                                </li>
                            </ul> -->
                        </div>

                        <div class="product-page-content">
                            <ul id="myTab" class="nav nav-tabs">
                                <li>
                                    <a href="#Description" data-toggle="tab">Description</a>
                                </li>
                                <li>
                                    <a href="#Information" data-toggle="tab">Information</a>
                                </li>
                                <li class="active">
                                    <a href="#Reviews" data-toggle="tab">Shipping & Returns</a>
                                </li>
                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <div class="tab-pane fade" id="Description">
                                    <p>
                                        {!!$product->description!!}
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="Information">
                                    {!!$product->short_description!!}
                                </div>
                                <div class="tab-pane fade" id="Information">
                                    {!!$product->shipping_returns!!}
                                </div>
                            </div>
                        </div>

                        <div class="sticker sticker-sale"></div>
                    </div>
                </div>
            </div>
            <!-- END CONTENT -->
        </div>
        @endsection
        @section('customJs')

        @endsection