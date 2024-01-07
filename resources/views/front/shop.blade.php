@extends('front.layouts.app')
@section('content')
<div class="main">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{route('front.home')}}">Home</a></li>
            <li><a href="{{route('front.shop')}}">Store</a></li>
        </ul>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
            <!-- BEGIN SIDEBAR -->
            <div class="sidebar col-md-3 col-sm-5">
                <ul class="list-group margin-bottom-25 sidebar-menu">
                    @if($categories->isNotEmpty())
                    @foreach ($categories as $key => $category)
                    <li class="list-group-item clearfix dropdown active {{ ($categorySelected == $category->id) ? 'show' : '' }}">
                        <a href="{{ route('front.shop',$category->slug)}}" class="collapsed {{ ($categorySelected == $category->id) ? 'show' : '' }}">
                            <i class="fa fa-angle-right"></i>
                            {{$category->name}}
                        </a>
                        <ul class="dropdown-menu" style="display:block;">
                            @if($category->sub_category->isNotEmpty())
                            @foreach ($category->sub_category as $subCategory)
                            <li><a href="{{ route('front.shop',[$category->slug,$subCategory->slug])}}" id="collapseOne-{{$key}}" class="{{ ($subCategorySelected == $subCategory->id) ? 'text-primary' : '' }}"><i class="fa fa-angle-right"></i> {{$subCategory->name}}</a></li>
                            @endforeach
                            @endif
                        </ul>
                    </li>
                    @endforeach
                    @endif
                </ul>

                <div class="sidebar-filter margin-bottom-25">
                    <!-- <h3>Availability</h3>
                    <div class="checkbox-list">
                        <label><input type="checkbox"> Not Available (3)</label>
                        <label><input type="checkbox"> In Stock (26)</label>
                    </div> -->
                    <div class="sub-title mt-5">
                        <h3>Brand</h3>
                        <hr class="brand-divider">
                    </div>
                    @if($brands->isNotEmpty())
                    @foreach ($brands as $brand)
                    <div class="checkbox-list">
                        <label class="form-check-label" for="brand-{{ $brand->id }}">
                            <input {{ (is_array($brandsArray) && in_array($brand->id, $brandsArray)) ? 'checked' : ''  }} class="form-check-input brand-label" type="checkbox" value="{{ $brand->id }}" id="brand-{{ $brand->id }}" name="brand[]">
                            {{ $brand->name }}
                        </label>
                    </div>
                    @endforeach
                    @endif
                    <!-- <div class="sub-title mt-5">
                        <h3>Price</h3>
                        <hr class="brand-divider">
                    </div>
                    <div class="card">
                        <div class="card-bord">
                            <input type="text" name="my_range" id="amount" class="js-range-slider">
                        </div>
                    </div> -->
                </div>

                <div class="sidebar-products clearfix">
                    <h2>Categories</h2>
                    @if($categories->isNotEmpty())
                    @foreach ($categories as $key => $category)
                    <div class="item">
                        <a href="{{ route('front.shop',$category->slug)}}"><img src="{{ asset('front-assets/pages/img/products/k1.jpg') }}" alt="{{$category->name}}"></a>
                        <h3><a href="{{ route('front.shop',$category->slug)}}"> {{$category->name}}</a></h3>
                        <!-- <div class="price">${{$category->price}}</div> -->
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="col-md-9 col-sm-7">
                <div class="row list-view-sorting clearfix">
                    <div class="col-md-2 col-sm-2 list-view">
                        <a href="javascript:;"><i class="fa fa-th-large"></i></a>
                        <a href="javascript:;"><i class="fa fa-th-list"></i></a>
                    </div>
                    <div class="col-md-10 col-sm-10">
                        <!-- <div class="pull-right">
                            <label class="control-label">Show:</label>
                            <select class="form-control input-sm">
                                <option value="#?limit=24" selected="selected">24</option>
                                <option value="#?limit=25">25</option>
                                <option value="#?limit=50">50</option>
                                <option value="#?limit=75">75</option>
                                <option value="#?limit=100">100</option>
                            </select>
                        </div> -->
                        <div class="pull-right">
                            <label class="control-label">Sort&nbsp;By:</label>
                            <select class="form-control input-sm" name="sort" id="sort">
                                <option value="" selected>Sort By</option>
                                <option value="latest" <?php echo ($sort == 'latest') ? 'selected' : ''; ?>>Latest</option>
                                <option value="price_desc" <?php echo ($sort == 'price_desc') ? 'selected' : ''; ?>>Price (High &gt; Low)</option>
                                <option value="price_asc" <?php echo ($sort == 'price_asc') ? 'selected' : ''; ?>>Price (Low &gt; High)</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- BEGIN PRODUCT LIST -->
                <div class="row product-list">
                    <!-- PRODUCT ITEM START -->
                    @if ($products->isNotEmpty())
                    @foreach($products as $key => $product)
                    @php
                    $productImage = $product->product_images->first();
                    @endphp
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="product-item">
                            <div class="pi-img-wrapper">
                                @if (!empty($productImage->image))
                                <img src="{{ asset('uploads/product/small/' . $productImage->image)}}" class="img-responsive" alt="{{ $product->title }}">
                                <div>
                                    <a href="{{ asset('uploads/product/small/' . $productImage->image)}} javascript:void(0);" onclick="addToCart('{{ $product->id }}');" class="btn btn-default fancybox-button">Add To Cart</a>
                                </div>
                                @else
                                <img src="{{ asset('admin-assets/media/icons/download.jpg')}}" class="img-responsive" alt="{{ $product->title }}">
                                <div>
                                    <a href="javascript:void(0);" onclick="addToCart('{{ $product->id }}');" class="btn btn-default fancybox-button">Add To Cart</a>
                                </div>
                                @endif
                            </div>
                            <h3><a href="shop-item.html">{{ $product->title }}</a></h3>
                            <div class="pi-price">${{ $product->price }}</div>
                            <a href="javascript:void(0);" onclick="addToCart('{{ $product->id }}');" class="btn btn-default add2cart">Add to cart</a>
                        </div>
                    </div>
                    @if (($key + 1) % 3 === 0) <!-- Fermeture de la ligne après chaque troisième élément -->
                </div>
                <div class="row product-list">
                    @endif
                    @endforeach
                    @endif
                </div>



                <!-- END PRODUCT LIST -->
                <!-- BEGIN PAGINATOR -->
                <div class="row">
                    <div class="col-md-12 col-sm-12 text-center">
                        {{ $products->withQueryString()->links()}}
                    </div>
                </div>
                <!-- END PAGINATOR -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
    </div>
</div>
@endsection
@section('customJs')
<script>
    // Lorsqu'un changement est détecté dans les éléments ayant la classe ".brand-label", la fonction apply_filters() est appelée.
    $(".brand-label").change(function() {
        apply_filters();
    });
    // Lorsqu'un changement est détecté dans l'élément avec l'ID "#sort", la fonction apply_filters() est appelée.
    $("#sort").change(function() {
        apply_filters();
    });
    // Fonction qui applique les filtres
    function apply_filters() {
        var brands = [];
        // Parcours de tous les éléments avec la classe ".brand-label"
        $(".brand-label").each(function() {
            // Si une case à cocher est cochée, sa valeur est ajoutée au tableau "brands"
            if ($(this).is(":checked") == true) {
                brands.push($(this).val());
            }
        });
        var url = '{{ url()->current() }}?';
        // Filtrage par marque
        if (brands.length > 0) {
            url += '&brand=' + brands.toString();
        }
        // Filtrage par tri
        url += '&sort=' + $('#sort').val();
        // Redirection vers la nouvelle URL avec les filtres appliqués
        window.location.href = url;
};
</script>
@endsection