@extends('front.layouts.app')
@section('content')
<!-- BEGIN SLIDER -->
<div class="page-slider margin-bottom-35">
    <div id="carousel-example-generic" class="carousel slide carousel-slider">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            <li data-target="#carousel-example-generic" data-slide-to="3"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <!-- First slide -->
            <div class="item carousel-item-four active">
                <img class="slide-image-opacity" src="{{ asset('front-assets/corporate/img/slider01.jpg') }}" alt="Slide 1 Image" />

                <div class="container">
                    <div class="carousel-position-four text-center">

                        <h2 class="margin-bottom-20 animate-delay carousel-title-v3 border-bottom-title text-uppercase" data-animation="animated fadeInDown">
                            Tones of <br /><span class="color-red-v2">Shop UI Features</span><br /> designed
                        </h2>
                        <p class="carousel-subtitle-v2" data-animation="animated fadeInUp">Lorem ipsum dolor sit amet constectetuer diam <br />
                            adipiscing elit euismod ut laoreet dolore.</p>
                        <a class="carousel-btn" href="{{ route('front.shop')}}" data-animation="animated fadeInUp">Shop Now !</a>

                    </div>
                </div>
            </div>

            <!-- Second slide -->
            <div class="item carousel-item-five">
                <img class="slide-image-opacity" src="{{ asset('front-assets/corporate/img/slider02.jpg') }}" alt="Slide 2 Image" />

                <div class="container">

                    <div class="carousel-position-four text-center">
                        <h2 class="margin-bottom-20 animate-delay carousel-title-v3 border-bottom-title text-uppercase" data-animation="animated fadeInDown">
                            Tones of <br /><span class="color-red-v2">Shop UI Features</span><br /> designed
                        </h2>
                        <p class="carousel-subtitle-v2" data-animation="animated fadeInUp">Lorem ipsum dolor sit amet constectetuer diam <br />
                            adipiscing elit euismod ut laoreet dolore.</p>
                        <a class="carousel-btn" href="#" data-animation="animated fadeInUp">Shop Now !</a>
                    </div>
                    <!-- <img class="carousel-position-five animate-delay hidden-sm hidden-xs" src="front-assets/pages/img/shop-slider/slide2/price.png" alt="Price" data-animation="animated zoomIn"> -->
                </div>
            </div>

            <!-- Third slide -->
            <div class="item carousel-item-six">
                <img class="slide-image-opacity" src="{{ asset('front-assets/corporate/img/slider03.jpg') }}" alt="Slide 3 Image" />
                <div class="container">
                    <div class="carousel-position-four text-center">
                        <span class="carousel-subtitle-v3 margin-bottom-15" data-animation="animated fadeInDown">
                            Full Admin &amp; Frontend
                        </span>
                        <h2 class="margin-bottom-20 animate-delay carousel-title-v3 border-bottom-title text-uppercase" data-animation="animated fadeInDown">
                            <span class="color-red-v2">Ecommerce</span>
                        </h2>
                        <p class="carousel-subtitle-v3" data-animation="animated fadeInDown">
                            Is Ready For Your Project
                        </p>
                        <a class="carousel-btn" href="#" data-animation="animated fadeInUp">Shop Now !</a>

                    </div>
                </div>
            </div>

            <!-- Fourth slide -->
            <!-- <div class="item carousel-item-seven">
                    <img class="slide-image-opacity" src="front-assets\corporate\img\slider04.jpg" alt="Slide 1 Image" />

                    <div class="center-block">
                        <div class="center-block-wrap">
                            <div class="center-block-body">
                                <h2 class="carousel-title-v1 margin-bottom-20" data-animation="animated fadeInDown">
                                    The most <br />
                                    wanted bijouterie
                                </h2>
                                <a class="carousel-btn" href="#" data-animation="animated fadeInUp">But It Now!</a>
                            </div>
                        </div>
                    </div>
                </div> -->
        </div>

        <!-- Controls -->
        <a class="left carousel-control carousel-control-shop" href="#carousel-example-generic" role="button" data-slide="prev">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
        </a>
        <a class="right carousel-control carousel-control-shop" href="#carousel-example-generic" role="button" data-slide="next">
            <i class="fa fa-angle-right" aria-hidden="true"></i>
        </a>
    </div>
</div>
<!-- END SLIDER -->
<div class="main">
    <div class="container">
        <!-- BEGIN SALE PRODUCT & NEW ARRIVALS -->
        <div class="row margin-bottom-40">
            <!-- BEGIN SALE PRODUCT -->
            <div class="col-md-12 sale-product">
                <h2>New Arrivals</h2>
                <div class="owl-carousel owl-carousel5">

                    @if ($latestProducts->isNotEmpty())
                    @foreach($latestProducts as $product)
                    @php
                    $productImage = $product->product_images->first();
                    @endphp
                    <div>
                        <div class="product-item">
                            <div class="pi-img-wrapper">
                                @if (!empty($productImage->image))
                                <img src="{{ asset('uploads/product/small/' . $productImage->image )}}" class="img-responsive" width="50">
                                @else
                                <img src="{{ asset('admin-assets/media/icons/download.jpg')}}" class="img-responsive" width="50">
                                @endif <div>
                                    <a href="javascript:void(0);" onclick="addToCart('{{ $product->id }}');" class="btn btn-default fancybox-fast-view">Add To Cart</a>
                                </div>
                            </div>
                            <h3><a href="{{ route('front.product', $product->slug)}}">{{ $product->title}}</a></h3>
                            <div>
                                <span class="h5"><strong style="color: #28a745;">${{ $product->price}}</strong></span>
                                @if($product->compare_price > 0 )
                                <span class="text-underline"><del>${{ $product->compare_price}}</del></span>

                                @endif
                            </div>

                            <!-- <div class="pi-price">${{ $product->price}}</div><br>
                            <div class="pi-price text-underline">${{ $product->compare_price}}</div> -->
                            <a href="javascript:void(0);" onclick="addToCart('{{ $product->id }}');" class=" btn btn-default add2cart">Add to cart</a>
                            <div class="sticker sticker-sale"></div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
            <!-- END SALE PRODUCT -->
        </div>
        <!-- END SALE PRODUCT & NEW ARRIVALS -->

        <!-- BEGIN SALE PRODUCT & NEW ARRIVALS -->
        <div class="row margin-bottom-40">
            <!-- BEGIN SALE PRODUCT -->
            <div class="col-md-12 sale-product">
                <h2>FEATURED</h2>
                <div class="owl-carousel owl-carousel5">

                    @if ($featuredProducts->isNotEmpty())
                    @foreach($featuredProducts as $product)
                    @php
                    $productImage = $product->product_images->first();
                    @endphp
                    <div>
                        <div class="product-item">
                            <div class="pi-img-wrapper">
                                @if (!empty($productImage->image))
                                <img src="{{ asset('uploads/product/small/' . $productImage->image )}}" class="img-responsive" width="50">
                                @else
                                <img src="{{ asset('admin-assets/media/icons/download.jpg')}}" class="img-responsive" width="50">
                                @endif
                                <div>
                                    <a href="javascript:void(0);" onclick="addToCart('{{ $product->id }}');" class=" btn btn-default fancybox-fast-view">Add To Cart</a>
                                </div>
                            </div>
                            <h3><a href="{{ route('front.product', $product->slug)}}">{{ $product->title}}</a></h3>
                            <div>
                                <span class="h5"><strong style="color: #28a745;">${{ $product->price}}</strong></span>
                                @if($product->compare_price > 0 )
                                <span class="text-underline"><del>${{ $product->compare_price}}</del></span>

                                @endif
                            </div>

                            <!-- <div class="pi-price">${{ $product->price}}</div><br>
                            <div class="pi-price text-underline">${{ $product->compare_price}}</div> -->
                            <a href="javascript:void(0);" onclick="addToCart('{{ $product->id }}');" class=" btn btn-default add2cart">Add to cart</a>
                            <div class="sticker sticker-sale"></div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
            <!-- END SALE PRODUCT -->
        </div>
        <!-- END SALE PRODUCT & NEW ARRIVALS -->
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40 ">
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
            </div>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="col-md-9 col-sm-8">
                <h2>Catégories</h2>
                <div class="owl-carousel owl-carousel3">
                    @if(getCategories()->isNotEmpty())
                    @foreach ( getCategories() as $category)
                    <div>
                        <a href="{{ route('front.shop',[$category->slug])}}" class="product-item-link">
                            <div class="product-item">
                                <div class="pi-img-wrapper">
                                    @if($category->image != "")
                                    <img src="{{ asset('uploads/category/thumb/'.$category->image) }}" class="img-responsive" alt="Jeux videos">
                                    @endif
                                </div>
                                <h3>{{ $category->name }}</h3>
                                <div class="sticker sticker-new"></div>
                            </div>
                        </a>

                    </div>
                    @endforeach
                    @endif

                    <!-- <div>
                        <div class="product-item">
                            <div class="pi-img-wrapper">
                                <img src="front-assets/pages/img/products/k4.jpg" class="img-responsive" alt="Berry Lace Dress">
                                <div>
                                    <a href="front-assets/pages/img/products/k4.jpg" class="btn btn-default fancybox-button">Zoom</a>
                                    <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                                </div>
                            </div>
                            <h3><a href="shop-item.html">Berry Lace Dress4</a></h3>
                            <div class="pi-price">$29.00</div>
                            <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                            <div class="sticker sticker-sale"></div>
                        </div>
                    </div>
                    <div>
                        <div class="product-item">
                            <div class="pi-img-wrapper">
                                <img src="front-assets/pages/img/products/k1.jpg" class="img-responsive" alt="Berry Lace Dress">
                                <div>
                                    <a href="front-assets/pages/img/products/k1.jpg" class="btn btn-default fancybox-button">Zoom</a>
                                    <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                                </div>
                            </div>
                            <h3><a href="shop-item.html">Berry Lace Dress5</a></h3>
                            <div class="pi-price">$29.00</div>
                            <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                        </div>
                    </div>
                    <div>
                        <div class="product-item">
                            <div class="pi-img-wrapper">
                                <img src="front-assets/pages/img/products/k2.jpg" class="img-responsive" alt="Berry Lace Dress">
                                <div>
                                    <a href="front-assets/pages/img/products/k2.jpg" class="btn btn-default fancybox-button">Zoom</a>
                                    <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                                </div>
                            </div>
                            <h3><a href="shop-item.html">Berry Lace Dress6</a></h3>
                            <div class="pi-price">$29.00</div>
                            <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                        </div>
                    </div> -->
                </div>
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->

        <!-- BEGIN TWO PRODUCTS & PROMO -->
        <div class="row margin-bottom-35 ">
            {{-- <div class="col-md-6 two-items-bottom-items">
                <h2>Two items</h2>
                <div class="owl-carousel owl-carousel2">
                    <div>
                        <div class="product-item">
                            <div class="pi-img-wrapper">
                                <img src="front-assets/pages/img/products/k4.jpg" class="img-responsive" alt="Berry Lace Dress">
                                <div>
                                    <a href="front-assets/pages/img/products/k4.jpg" class="btn btn-default fancybox-button">Zoom</a>
                                    <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">Add To Cart</a>
                                </div>
                            </div>
                            <h3><a href="shop-item.html">Berry Lace Dress</a></h3>
                            <div class="pi-price">$29.00</div>
                            <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                        </div>
                    </div>
                    <div>
                        <div class="product-item">
                            <div class="pi-img-wrapper">
                                <img src="front-assets/pages/img/products/k2.jpg" class="img-responsive" alt="Berry Lace Dress">
                                <div>
                                    <a href="front-assets/pages/img/products/k2.jpg" class="btn btn-default fancybox-button">Zoom</a>
                                    <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">Add To Cart</a>
                                </div>
                            </div>
                            <h3><a href="shop-item.html">Berry Lace Dress</a></h3>
                            <div class="pi-price">$29.00</div>
                            <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                        </div>
                    </div>
                    <div>
                        <div class="product-item">
                            <div class="pi-img-wrapper">
                                <img src="front-assets/pages/img/products/k3.jpg" class="img-responsive" alt="Berry Lace Dress">
                                <div>
                                    <a href="front-assets/pages/img/products/k3.jpg" class="btn btn-default fancybox-button">Zoom</a>
                                    <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">Add To Cart</a>
                                </div>
                            </div>
                            <h3><a href="shop-item.html">Berry Lace Dress</a></h3>
                            <div class="pi-price">$29.00</div>
                            <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                        </div>
                    </div>
                    <div>
                        <div class="product-item">
                            <div class="pi-img-wrapper">
                                <img src="front-assets/pages/img/products/k1.jpg" class="img-responsive" alt="Berry Lace Dress">
                                <div>
                                    <a href="front-assets/pages/img/products/k1.jpg" class="btn btn-default fancybox-button">Zoom</a>
                                    <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">Add To Cart</a>
                                </div>
                            </div>
                            <h3><a href="shop-item.html">Berry Lace Dress</a></h3>
                            <div class="pi-price">$29.00</div>
                            <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                        </div>
                    </div>
                    <div>
                        <div class="product-item">
                            <div class="pi-img-wrapper">
                                <img src="front-assets/pages/img/products/k4.jpg" class="img-responsive" alt="Berry Lace Dress">
                                <div>
                                    <a href="front-assets/pages/img/products/k4.jpg" class="btn btn-default fancybox-button">Zoom</a>
                                    <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">Add To Cart</a>
                                </div>
                            </div>
                            <h3><a href="shop-item.html">Berry Lace Dress</a></h3>
                            <div class="pi-price">$29.00</div>
                            <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                        </div>
                    </div>
                    <div>
                        <div class="product-item">
                            <div class="pi-img-wrapper">
                                <img src="front-assets/pages/img/products/k3.jpg" class="img-responsive" alt="Berry Lace Dress">
                                <div>
                                    <a href="front-assets/pages/img/products/k3.jpg" class="btn btn-default fancybox-button">Zoom</a>
                                    <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">Add To Cart</a>
                                </div>
                            </div>
                            <h3><a href="shop-item.html">Berry Lace Dress</a></h3>
                            <div class="pi-price">$29.00</div>
                            <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- END TWO PRODUCTS -->
            <!-- BEGIN PROMO -->
            {{-- <div class="col-md-6 shop-index-carousel">
                <div class="content-slider">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="item active">
                                <img src="front-assets/pages/img/index-sliders/slide1.jpg" class="img-responsive" alt="Berry Lace Dress">
                            </div>
                            <div class="item">
                                <img src="front-assets/pages/img/index-sliders/slide2.jpg" class="img-responsive" alt="Berry Lace Dress">
                            </div>
                            <div class="item">
                                <img src="front-assets/pages/img/index-sliders/slide3.jpg" class="img-responsive" alt="Berry Lace Dress">
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- END PROMO -->
        </div>
        <!-- END TWO PRODUCTS & PROMO -->
    </div>
</div>
@endsection