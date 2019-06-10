@extends('layouts.master')
@section('title', 'CARVE CART')
@section('content')
    <style>
        /* Global settings */

        .product-image {
            float: left;
            width: 20%;
        }

        .product-details {
            float: left;
            width: 37%;
        }

        .product-price {
            float: left;
            width: 12%;
        }

        .product-quantity {
            float: left;
            width: 10%;
        }

        .product-removal {
            float: left;
            width: 9%;
        }

        .product-line-price {
            float: left;
            width: 12%;
            text-align: right;
        }

        /* This is used as the traditional .clearfix class */
        .group:before, .shopping-cart:before, .column-labels:before, .product:before, .totals-item:before,
        .group:after,
        .shopping-cart:after,
        .column-labels:after,
        .product:after,
        .totals-item:after {
            content: '';
            display: table;
        }

        .group:after, .shopping-cart:after, .column-labels:after, .product:after, .totals-item:after {
            clear: both;
        }

        .group, .shopping-cart, .column-labels, .product, .totals-item {
            zoom: 1;
        }


        h1 {
            font-weight: 100;
        }

        label {
            color: #000;
        }

        .shopping-cart {
            margin-top: -45px;
        }

        /* Column headers */
        .column-labels label {
            padding-bottom: 15px;
            margin-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        .column-labels .product-image, .column-labels .product-details, .column-labels .product-removal {
            text-indent: -9999px;
        }

        /* Product entries */
        .product {
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        .product .product-image {
            text-align: center;
        }
        .product .product-image img {
            width: 100px;
        }
        .product .product-details .product-title {
            margin-right: 20px;
            font-family: "HelveticaNeue-Medium", "Helvetica Neue Medium";
        }
        .product .product-details .product-description {
            margin: 5px 20px 5px 0;
            line-height: 1.4em;
        }
        .product .product-quantity input {
            width: 40px;
        }
        .product .remove-product {
            border: 0;
            padding: 4px 8px;
            background-color: #c66;
            color: #fff;
            font-family: "HelveticaNeue-Medium", "Helvetica Neue Medium";
            font-size: 12px;
            border-radius: 3px;
        }
        .product .remove-product:hover {
            background-color: #a44;
        }

        /* Totals section */
        .totals .totals-item {
            float: right;
            clear: both;
            width: 100%;
            margin-bottom: 10px;
        }
        .totals .totals-item label {
            float: left;
            clear: both;
            width: 79%;
            text-align: right;
        }
        .totals .totals-item .totals-value {
            float: right;
            width: 21%;
            text-align: right;
        }
        .totals .totals-item-total {
            font-family: "HelveticaNeue-Medium", "Helvetica Neue Medium";
        }

        .checkout {
            float: right;
            border: 0;
            margin-top: 20px;
            padding: 6px 25px;
            background-color: #6b6;
            color: #fff;
            font-size: 25px;
            border-radius: 3px;
        }

        .checkout:hover {
            background-color: #494;
        }

        /* Make adjustments for tablet */
        @media screen and (max-width: 650px) {
            .shopping-cart {
                margin: 0;
                padding-top: 20px;
                border-top: 1px solid #eee;
            }

            .column-labels {
                display: none;
            }

            .product-image {
                float: right;
                width: auto;
            }
            .product-image img {
                margin: 0 0 10px 10px;
            }

            .product-details {
                float: none;
                margin-bottom: 10px;
                width: auto;
            }

            .product-price {
                clear: both;
                width: 70px;
            }

            .product-quantity {
                width: 100px;
            }
            .product-quantity input {
                margin-left: 20px;
            }

            .product-quantity:before {
                content: 'x';
            }

            .product-removal {
                width: auto;
            }

            .product-line-price {
                float: right;
                width: 70px;
            }
        }
        /* Make more adjustments for phone */
        @media screen and (max-width: 350px) {
            .product-removal {
                float: right;
            }

            .product-line-price {
                float: right;
                clear: left;
                width: auto;
                margin-top: 10px;
            }

            .product .product-line-price:before {
                content: 'Item Total: $';
            }

            .totals .totals-item label {
                width: 60%;
            }
            .totals .totals-item .totals-value {
                width: 40%;
            }
        }
    </style>
    @if (!empty($cart))
    <h1>Shopping Cart</h1>
    <div class="shopping-cart">

        <div class="column-labels">
            <label class="product-image">Image</label>
            <label class="product-details">Product</label>
            <label class="product-price">Price</label>
            <label class="product-quantity">Quantity</label>
            <label class="product-removal">Remove</label>
            <label class="product-line-price">Total</label>
        </div>
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        @php $total = 0 @endphp
        @foreach($cart as $key => $product)
        <div class="product">
            <div class="product-image">
                <a href="{{$product['url']}}"><img src="{{$product['image']}}"></a>
            </div>
            <div class="product-details">
                <div class="product-title"><a href="{{$product['url']}}">{{$product['name']}}</a></div>
                <p class="product-description">{!! html_entity_decode($product['description']) !!}.</p>
                <p>@foreach($product['variation'] as $value)
                        <small><strong>{{$value->name}}</strong>:{{$value->value_name}}</small><br/>
                    @endforeach</p>

            </div>
            <div class="product-price">{{$product['item_price']}}</div>
            <div class="product-quantity">
                <icon class="fa fa-minus qty" data-key="{{$key}}"  data-math="-"></icon>
                <input id="number_{{$key}}" type="number" value="{{$product['quantity']}}" min="1">
                <icon class="fa fa-plus qty" data-key="{{$key}}" data-math="+"></icon>
            </div>
            <div class="product-removal">
                <button class="remove-product" data-key="{{$key}}">
                    Remove
                </button>
            </div>
            <div class="product-line-price">{{$product['item_total']}}</div>
        </div>
            @php $total = $total + $product['item_price'] @endphp
        @endforeach

        <div>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                Add Shipping
            </button>
            <!-- The Modal -->
            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">ADD SHIPPING</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div id="shipping-error" class="alert alert-danger" style="display: none;"> <icon class="fa fa-times"></icon> Please Select Province and City</div>

                        <form id="shippment">
                        <div class="modal-body">
                             <div class="form-group">
                                <label for="state">Provincies</label>
                                 <select class="custom-select d-block w-100 form-control" id="state" name="state" >
                                    <option value="0">Select Province</option>
                                    @foreach($zones as $zone)
                                        <option value="{{$zone->zone_id}}">{{$zone->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="city">Select City</label>
                                <select class="custom-select d-block w-100 form-control" id="city" name="city" >
                                    <option value="0">Choose...</option>
                                </select>
                            </div>

                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-lg btn-danger text-center d-block m-auto add-shipping" data-dismiss="modal" >ADD</button>

                        </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>


        <div class="totals">
            <div class="totals-item">
                <label>Subtotal</label>
                <div class="totals-value" id="cart-subtotal">{{$cartDetail->sub_total}} RS</div>
            </div>

            <div class="totals-item shipping-cost {{($cartDetail->shipping ) ? '' : 'd-none' }}">
                <label>Shipping</label>
                <div class="totals-value" id="shipping">{{ ($cartDetail->shipping == 0) ? 'Free' :$cartDetail->shipping }} RS</div>
            </div>
            <div class="totals-item totals-item-total">
                <label>Grand Total</label>
                <div class="totals-value" id="grant_total">{{$cartDetail->grant_total}} RS</div>
            </div>
        </div>



        <a href="{{URL('checkout')}}" class="checkout">Checkout</a>
        @else
            <div class="alert alert-danger" role="alert">
                <strong>YOUR CART IS EMPTY  </strong> <a href="#" class="alert-link">Change a few things up</a> and try submitting again.
            </div>
        @endif
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $('.qty').click(function () {

                val = parseInt($('#number_'+$(this).data('key')).val())
                if($(this).data('math') == "+"){
                    val = val + 1
                } else if($(this).data('math') == "-")  {
                    val = val - 1
                }
                if( val <= 0 ){
                    val =1 ;
                }
                $('#number_'+$(this).data('key')).val(val)


                $.ajax({
                    url:' {{URL('cart/update')}}',
                    type: 'post',
                    dataType: 'json',
                    data: {'key':$(this).data('key'),'quantity':$('#number_'+$(this).data('key')).val(),'_token':$('#token').val(),'operation':$(this).data('math')},
                    beforeSend: function() {

                    },
                    complete: function() {

                    },
                    success: function(json) {
                        if(json.done){
                            location.reload();
                        }



                    }
                });


            })




            $('.remove-product').click(function () {
                $.ajax({
                    url:' {{URL('cart/remove')}}',
                    type: 'post',
                    dataType: 'json',
                    data: {'key':$(this).data('key'),'_token':$('#token').val()},
                    beforeSend: function() {
                        $('.remove-product').button('loading');
                    },
                    complete: function() {
                        $('.remove-product').button('reset');
                    },
                    success: function(json) {
                        if(json.done){
                            location.reload();
                        }



                    }
                });




        });
            $('#state').change(function() {
                $.ajax({
                    url: 'checkout/cities?id='+$(this).val(),
                    dataType: 'json',
                    Type: 'GET',
                    success: function(json){
                        html = '<option value="0" selected="selected">Choose</option>';
                        if (json) {
                            for (i = 0; i < json.length; i++) {
                                html += '<option value="' + json[i]['zone_city_id'] + '"';
                                if (json[i]['city_id'] == '41') {
                                    //html += ' selected="selected"';
                                }

                                html += '>' + json[i]['name'] + '</option>';
                            }
                        }
                        $('select[name=\'city\']').html(html).trigger('change');
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }

                })
            });
            $('.add-shipping').click(function () {
                if($("#city").val() == 0 || $("#state").val() == 0){
                    $('#shipping-error').show()
                    return false
                }
                $('#shipping-error').hide()
                $.ajax({
                    url:' {{URL('cart/shipping')}}',
                    type: 'post',
                    dataType: 'json',
                    data: {'city':$("#city").val(),'state':$("#state").val(),'_token':$('#token').val()},
                    success: function(json) {
                        if(json.success){
                            $('#shipping').html(json.shipping)
                            $('.shipping-cost').removeClass('d-none')
                            $('#grant_total').html(json.grant_total)
                        } else if(json.error){
                            $('#shipping-error').show()
                        }



                    }
                });
            });
        });
    </script>
@endsection


