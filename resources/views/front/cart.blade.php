@extends('front.layouts.app')
@section('content')
<div class="main">
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success" id="successMessage">
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger" id="dangerMessage">
            {{ session('error') }}
        </div>
        @endif
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
            <!-- BEGIN CONTENT -->
            <div class="col-md-12 col-sm-12">
                <h1>Shopping cart</h1>
                <div class="goods-page">
                    <div class="goods-data clearfix">
                        <div class="table-wrapper-responsive">
                            <table summary="Shopping cart">
                                <tr>
                                    <th class="goods-page-item">Products</th>
                                    <th class="goods-page-item hidden-xs">Name</th>
                                    <th class="goods-page-price">Price</th>
                                    <th class="goods-page-quantity">Quantity</th>
                                    <th class="goods-page-total">Total</th>
                                    <th class="goods-page-remove">Remove</th>
                                </tr>
                                @if(!empty($cartContent))
                                @foreach( $cartContent as $item )
                                <tr>
                                    <td class="goods-page-image">
                                        <div class="d-flex align-items-center">
                                            <a href="#"><img src="{{ asset('uploads/product/small/' . $item->options->productImage->image )}}" alt="{{$item->name}}"></a>
                                        </div>
                                    </td>
                                    <td> <strong>{{$item->name}}</strong></td>

                                    <td class="goods-page-price">
                                        <strong><span>$</span>{{$item->price}}</strong>
                                    </td>
                                    <td>
                                        <div class="input-group quantity mx-auto" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-success btn-minus p-2 pt-1 pb-1 sub" data-id=" {{$item->rowId}}">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text" class="form-control form-control-sm border-0 text-center" value="{{$item->qty}}" />
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-success btn-plus p-2 pt-1 pb-1 add" data-id=" {{$item->rowId}}">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="goods-page-total">
                                        <strong><span>$</span>{{$item->price * $item->qty }}</strong>
                                    </td>
                                    <td class="del-goods-col">
                                        <button onclick="removeFromCart('{{$item->rowId}}')" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                                @endif

                            </table>
                        </div>

                        <div class="shopping-total">
                            <ul>
                                <li>
                                    <em>Sub total</em>
                                    <strong class="price"><span>$</span>{{Cart::subtotal()}}</strong>
                                </li>
                                <li>
                                    <em>Shipping cost</em>
                                    <strong class="price"><span>$</span>0.00</strong>
                                </li>
                                <li class="shopping-total-price">
                                    <em>Total</em>
                                    <strong class="price"><span>$</span>{{Cart::subtotal()}}</strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <a href="{{route('front.shop')}}" class="btn btn-default" type="submit">Continue shopping <i class="fa fa-shopping-cart"></i></a>
                    <a href="{{route('front.checkout')}}" class="btn btn-primary" type="submit">Checkout <i class="fa fa-check"></i></a>
                </div>
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->

        <!-- BEGIN SIMILAR PRODUCTS -->

        <!-- END SIMILAR PRODUCTS -->
    </div>
</div>
@endsection
@section('customJs')
<script>
    $('.add').click(function() {
        var qtyElement = $(this).parent().prev(); // Qty Input
        var qtyValue = parseInt(qtyElement.val());
        if (qtyValue < 10) {
            qtyElement.val(qtyValue + 1);
            var rowId = $(this).data('id');
            var newQty = qtyElement.val();
            updateCart(rowId, newQty);
        }
    });

    $('.sub').click(function() {
        var qtyElement = $(this).parent().next();
        var qtyValue = parseInt(qtyElement.val());
        if (qtyValue > 1) {
            qtyElement.val(qtyValue - 1);
            var rowId = $(this).data('id');
            var newQty = qtyElement.val();
            updateCart(rowId, newQty);
        }
    });

    function updateCart(rowId, qty) {
        $.ajax({
            url: ' {{route("front.updateCart")}}',
            type: 'post',
            data: {
                rowId: rowId,
                qty: qty,
            },
            dataType: 'json',
            success: function(response) {
                window.location.href = '{{route("front.cart")}}'
            }
        });
    }

    function removeFromCart(rowId) {
        if (confirm("Are you sure you want to delete ?")) {
            $.ajax({
                url: ' {{route("front.removeFromCart.cart")}}',
                type: 'post',
                data: {
                    rowId: rowId
                },
                dataType: 'json',
                success: function(response) {
                    window.location.href = '{{route("front.cart")}}'
                }
            });
        }
    }
</script>
@endsection