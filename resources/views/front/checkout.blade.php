@extends('front.layouts.app')
@section('content')
<div class="main">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{route('front.home')}}">Home</a></li>
            <li><a href="{{route('front.shop')}}">Store</a></li>
            <li class="active">Checkout</li>
        </ul>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
            <!-- BEGIN CONTENT -->
            <div class="col-md-12 col-sm-12">
                <h1>Checkout</h1>
                <!-- BEGIN CHECKOUT PAGE -->
                <div class="panel-group checkout-page accordion scrollable" id="checkout-page">
                    <form action="" id="orderForm" name="orderForm" method="post">
                        <!-- BEGIN SHIPPING ADDRESS -->
                        <div id="shipping-address" class="panel panel-default">
                            <div class="panel-heading">
                                <h2 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#checkout-page" href="#shipping-address-content" class="accordion-toggle">
                                        Step 1: Delivery Details
                                    </a>
                                </h2>
                            </div>
                            <div id="shipping-address-content" class="panel-collapse collapse in">
                                <div class="panel-body row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="firstname-dd">First Name <span class="require">*</span></label>
                                            <input type="text" id="first_name" name="first_name" class="form-control" value="{{ (!empty($customerAddress)) ? $customerAddress->first_name : ''}}">
                                            <p class="text-danger mt-2"></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="lastname-dd">Last Name <span class="require">*</span></label>
                                            <input type="text" id="last_name" name="last_name" class="form-control" value="{{ (!empty($customerAddress)) ? $customerAddress->last_name : ''}}">
                                            <p class="text-danger mt-2"></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="email-dd">E-Mail <span class="require">*</span></label>
                                            <input type="text" id="email" name="email" class="form-control" value="{{ (!empty($customerAddress)) ? $customerAddress->email : ''}}">
                                            <p class="text-danger mt-2"></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="country-dd">Country <span class="require">*</span></label>
                                            <select class="form-control input-sm" id="country" name="country">
                                                <option value=""> --- Please Select --- </option>
                                                @if ($countries->isNotEmpty())
                                                @foreach ($countries as $country)
                                                <option {{ (!empty($customerAddress) && $customerAddress->country_id==$country->id ) ? 'selected' : ''}} value="{{$country->id}}">{{$country->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <p class="text-danger mt-2"></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="telephone-dd">Telephone <span class="require">*</span></label>
                                            <input type="text" id="mobile" name="mobile" value="{{ (!empty($customerAddress)) ? $customerAddress->mobile : ''}}" class="form-control">
                                            <p class="text-danger mt-2"></p>
                                        </div>
                                        <div class="form-group payment_form">
                                            <div class="form-check">
                                                <input type="radio" checked id="payment_method_one" name="payment_method" value="cod">
                                                <label for="payment_method_one" class="form-check-label">Cash On Delivery<span class="require">*</span></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="payment_method_two" name="payment_method" value="card">
                                                <label for="payment_method_two" class="form-check-label">Card<span class="require">*</span></label>
                                            </div>
                                            <div class="card-body p-0" id="card-payment-form">
                                                <div class="">
                                                    <label for="cardnumber">Card Number<span class="require">*</span></label>
                                                    <input type="text" id="cardnumber" class="form-control">
                                                    <p class="text-danger mt-2"></p>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Expired Date<span class="require">*</span></label>
                                                        <input type="text" id="expireddate" class="form-control" placeholder="MM/YY">
                                                        <p class="text-danger mt-2"></p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>CVV <span class="require">*</span></label>
                                                        <input type="text" id="cvv" class="form-control" placeholder="CVV">
                                                        <p class="text-danger mt-2"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="address1-dd">Address 1</label>
                                            <input type="text" id="address" name="address" value="{{ (!empty($customerAddress)) ? $customerAddress->address : ''}}" class="form-control">
                                            <p class="text-danger mt-2"></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="address2-dd">Apartement</label>
                                            <input type="text" id="apartment" name="apartment" placeholder="(optional)" value="{{ (!empty($customerAddress)) ? $customerAddress->apartment : ''}}" class="form-control">
                                            <p class="text-danger mt-2"></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="city-dd">City <span class="require">*</span></label>
                                            <input type="text" id="city" name="city" value="{{ (!empty($customerAddress)) ? $customerAddress->city : ''}}" class="form-control">
                                            <p class="text-danger mt-2"></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="state-dd">State <span class="require">*</span></label>
                                            <input type="text" id="state" name="state" value="{{ (!empty($customerAddress)) ? $customerAddress->state : ''}}" class="form-control">
                                            <p class="text-danger mt-2"></p>

                                        </div>
                                        <div class="form-group">
                                            <label for="post-code-dd">Post Code <span class="require">*</span></label>
                                            <input type="text" id="zip" name="zip" value="{{ (!empty($customerAddress)) ? $customerAddress->zip : ''}}" class="form-control">
                                            <p class="text-danger mt-2"></p>

                                        </div>
                                        <div class="form-group">
                                            <label for="Order-Note-dd">Order Note <span class="require">*</span></label>
                                            <input type="text" id="notes" placeholder="(optional)" name="notes" {{ (!empty($customerAddress)) ? $customerAddress->notes : ''}} class="form-control">
                                            <p class="text-danger mt-2"></p>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-12 clearfix">
                                    <div class="table-wrapper-responsive">
                                        <table>
                                            <tr>
                                                <th class="checkout-image">Image</th>
                                                <th class="checkout-description">Description</th>
                                                <th class="checkout-quantity">Quantity</th>
                                                <th class="checkout-price">Price</th>
                                                <th class="checkout-total">Total</th>
                                            </tr>
                                            @foreach (Cart::content() as $item)
                                            <tr>
                                                <td class="checkout-image">
                                                    <a href="javascript:;"><img src="{{ asset('uploads/product/small/' . $item->options->productImage->image )}}" alt="{{$item->name}}"></a>
                                                </td>
                                                <td class="checkout-description">
                                                    <h3><a href="javascript:;">{{ $item->name}}</a></h3>
                                                    <p><strong>{{ $item->qty}}</strong></p>
                                                </td>
                                                <td class="checkout-quantity"><strong>{{ $item->qty}}</strong></td>
                                                <td class="checkout-price"><strong><span>$</span>{{ $item->price}}</strong></td>
                                                <td class="checkout-total"><strong><span>$</span>{{ $item->price * $item->qty }}</strong></td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                    <div class="checkout-total-block">
                                        <ul>
                                            <li>
                                                <em>Sub total</em>
                                                <strong class="price"><span>$</span>{{Cart::subtotal()}}</strong>
                                            </li>
                                            <li>
                                                <em>Shipping cost</em>
                                                <strong class="price" id="shippingAmount"><span>$</span>{{ number_format($totalShippingCharge,2)}}</strong>
                                            </li>
                                            <li class="checkout-total-price">
                                                <em>Total</em>
                                                <strong class="price" id="grandTotal"><span>$</span>{{ number_format($grandTotal,2)}}</strong>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="clearfix"></div>
                                    <button class="btn btn-primary pull-right confirm-btn" type="submit" id="">Confirm Order</button>
                                    <button type="button" class="btn btn-default pull-right margin-right-20 cancel-btn">Cancel</button>
                                </div>
                            </div>

                        </div>
                </div>
                </form>
                <button class="btn btn-sm fw-bold btn-info print-btn" onclick="window.print();">
                    Print
                </button>
            </div>
            <!-- END CHECKOUT PAGE -->
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END SIDEBAR & CONTENT -->
</div>
</div>
@endsection
@section('customJs')
<script>
    $(document).ready(function() {
        $('#card-payment-form').hide(); // Initialement, masquer le formulaire de paiement par carte
        // Basculer la visibilité du formulaire de paiement par carte en fonction de la sélection du bouton radio
        $("input[name='payment_method']").change(function() {
            if ($('#payment_method_two').is(":checked")) {
                $('#card-payment-form').show(); // Afficher le formulaire de paiement par carte si "Carte" est sélectionné
            } else {
                $('#card-payment-form').hide(); // Masquer le formulaire de paiement par carte si "Paiement à la livraison" est sélectionné
            }
        });
    });
    $("#orderForm").submit(function(event) {
        event.preventDefault(); // Empêche le rechargement de la page lors de la soumission du formulaire
        $.ajax({
            url: "{{route('front.processCheckout')}}",
            type: 'post',
            data: $(this).serializeArray(),
            dataType: 'json',
            success: function(response) {
                var errors = response.errors;

                if (Response.status == false) {
                    // Gestion des erreurs de validation des champs du formulaire
                    // Affichage des messages d'erreur sous les champs concernés
                    if (errors.first_name) {
                        $('#first_name').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.first_name);
                    } else {
                        $('#first_name').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }
                    if (errors.last_name) {
                        $('#last_name').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.last_name);
                    } else {
                        $('#last_name').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }
                    if (errors.email) {
                        $('#email').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.email);
                    } else {
                        $('#email').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }
                    if (errors.country) {
                        $('#country').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.country);
                    } else {
                        $('#country').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }
                    if (errors.address) {
                        $('#address').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.address);
                    } else {
                        $('#address').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }
                    if (errors.city) {
                        $('#city').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.city);
                    } else {
                        $('#city').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }
                    if (errors.state) {
                        $('#state').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.state);
                    } else {
                        $('#state').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }
                    if (errors.zip) {
                        $('#zip').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.zip);
                    } else {
                        $('#zip').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }
                    if (errors.mobile) {
                        $('#mobile').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.mobile);
                    } else {
                        $('#mobile').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }
                } else {
                    // Réinitialisation des messages d'erreur si la validation réussit
                    $('#firstname').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    $('#lastname').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    $('#email').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    $('#country').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    $('#address').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    $('#city').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    $('#state').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    $('#zip').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    $('#mobile').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    // Redirection vers la page de confirmation de commande avec l'identifiant de la commande
                    window.location.href = "{{ url('/thanks/') }}/"+response.orderId;
                }
            },
            error: function(JQXHR, execption) {
                console.log("Something Went Wrong");
            }
        });
    });
    // Exécute une requête AJAX lorsque le pays est modifié
    $('#country').change(function(){
        $.ajax({
            url : "{{route('front.getOrdedrSummery')}}",
            type: 'POST',
            data: {country_id: $(this).val()},
            dataType : 'json',
            success: function(response){
                // Gérer la réponse de la requête AJAX
                if (response.status == true){
                    $("#shippingAmount").html('$'+response.shippingCharge);
                    $("#grandTotal").html('$'+response.grandTotal);
                }
            }
        });
    });
</script>
@endsection