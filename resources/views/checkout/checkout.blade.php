@extends('layouts.master')
@section('title', 'CARVE CHECKOUT')
@section('css')
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

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

        /* Apply clearfix in a few places */
        /* Apply dollar signs */
        .product .product-price:before, .product .product-line-price:before, .totals-value:before {
            content: '$';
        }

        /* Body/Header stuff */


        h1 {
            font-weight: 100;
        }

        label {
            color: #191818;
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


        .bubble{
            display: inline-block;
            font-size: 12px;
            line-height: 1.1em;
            margin: 0;
            padding: 8px 14px;
            color: #fff;
            background-color: #cf0803;
            text-align: center;
            font-weight: 700;
            white-space: normal;
            position: absolute;
            width:230px;
            top: 7px;
            right: 16px;
            height:30px;
            -webkit-transition: -webkit-transform .2s ease,opacity .2s ease;
            transition: transform .2s ease,opacity .2s ease;
            /*-webkit-transform: scale(0);
            -ms-transform: scale(0);
            transform: scale(0);*/
            will-change: transition,opacity;
            z-index: 2;
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

        .form-control {
            background:#f3f3f3;
            padding:10px 10px ;
            font-size: 18px;


        }
        .dno {
            display: none;
        }

        .form-control:focus{
            background:#f3f3f3;
        }

        select.form-control{
            height: 49px !important;
        }

        .valid-error{
            background:#cfadab;
        }
        .valid-error:focus{

            box-shadow:0 0 0 0.2rem #cf0803;
            border:1px solid #cf0803;
        }

        .valid-feedback-icon{
            right: 40px;
            top: 45px;
        }

        .valid-feedback-icon-error {
            color: #cf0803;
        }
        .valid-feedback-icon-success {
            color:#494;
        }

        .checkout:hover {
            background-color: #494;
        }

        .custom-control-label::before{
            background: #6c757d;
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
@endsection
@section('content')
    <br/>
    <div class="container">
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">You have <span class="badge badge-secondary badge-pill">{{$quantity}}</span> item{{($quantity==1) ? '' : 's'}} </span>
                    <a href="{{URL('cart')}}">{{'Edit Cart'}}</a>
                </h4>
                <ul class="list-group mb-3">
                    @php
                        $total = 0;
                        $shipping = 100;
                    @endphp
                    @foreach($cart as $key => $product)
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">{{$product['name']}}</h6>
                            <small class="text-muted"><strong>QUANTITY:</strong> {{$product['quantity']}}</small><br/>
                            @foreach($product['variation'] as $variant)
                                <small class="text-muted"><strong>{{$variant->name}}:</strong> {{$variant->value_name}}</small><br/>
                            @endforeach
                        </div>
                        <span class="text-muted">{{$product['item_total']}}RS</span>
                    </li>
                        @php
                            $total = $total  + $product['item_total'];
                        @endphp

                    @endforeach
                    <li class="list-group-item d-none justify-content-between bg-light ">
                        <div class="text-success">
                            <h6 class="my-0">Promo code</h6>
                            <small>EXAMPLECODE</small>
                        </div>
                        <span class="text-success">-$5</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span> SUB TOTAL</span>
                        <strong>{{$cartDetail->sub_total }} Rs</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span> DELIVERY CHARGES</span>
                        <strong id="shipping">{{($cartDetail->shipping == 0) ? 'Free' :$cartDetail->shipping. ' Rs' }} </strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span class="font-weight-bold"> GRAND TOTAL</span>
                        <strong id="grant_total">{{$cartDetail->grant_total}} Rs</strong>
                    </li>
                </ul>

                <form class="card p-2 d-none">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Promo code">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-secondary">Redeem</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Delivery Address</h4>
                <form id="checkout-form" >
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

                    <div class="row">
                        <div class="col-md-6 mb-3 position-relative">
                            <label for="firstName">Full Name</label>
                            <div id="fullName-error-message"  class="dno bubble">Name Should Not Be Empty.</div>
                            <div id="fullName-success" class="valid-feedback-icon valid-feedback-icon-success dno position-absolute"><icon class="fa fa-check"></icon></div>
                            <div id="fullName-error"  class="valid-feedback-icon valid-feedback-icon-error  dno position-absolute"><icon class="fa fa-times"></icon></div>
                            <input type="text" class="form-control validate" id="fullName" placeholder="" name="fullName"  data-type="text">

                        </div>
                        <div class="col-md-6"></div>
                        <div class="clearfix"></div>
                        <div class="col-md-6 mb-3 position-relative">
                            <label for="phone">Phone</label>
                            <div id="phone-error-message"  class="dno bubble">Phone No Should be Valid.</div>
                            <div id="phone-success" class="valid-feedback-icon valid-feedback-icon-success dno position-absolute"><icon class="fa fa-check"></icon></div>
                            <div id="phone-error"  class="valid-feedback-icon valid-feedback-icon-error  dno position-absolute"><icon class="fa fa-times"></icon></div>
                            <input type="tel" name="phone" class="form-control" id="phone">
                        </div>
                        <div class="col-md-12 mb-3 position-relative">
                            <label for="email">Email</label>
                            <div id="email-error-message"  class="dno bubble">Email Should be in valid format.</div>
                            <div id="email-success" class="valid-feedback-icon valid-feedback-icon-success dno position-absolute"><icon class="fa fa-check"></icon></div>
                            <div id="email-error"  class="valid-feedback-icon valid-feedback-icon-error  dno position-absolute"><icon class="fa fa-times"></icon></div>
                            <input type="email" name="email" class="form-control" id="email">
                        </div>
                        <div class="clearfix"></div>

                    </div>
                    <div class="mb-3 position-relative">
                        <label for="address">Address</label>
                        <div id="address-error-message"  class="dno bubble">Address  Should Not Be Empty..</div>
                        <div id="address-success" class="valid-feedback-icon valid-feedback-icon-success dno position-absolute"><icon class="fa fa-check"></icon></div>
                        <div id="address-error"  class="valid-feedback-icon valid-feedback-icon-error  dno position-absolute"><icon class="fa fa-times"></icon></div>
                        <textarea type="text" class="form-control" id="address" name="address"  ></textarea>
                    </div>



                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="country">Country</label>
                            <select class="custom-select d-block w-100 form-control" name="country" class="form-control" id="country" >
                                <option value="162">Pakistan</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3 position-relative">
                            <label for="state">Provincies</label>
                            <div id="state-error-message"  class="dno bubble">Provincie Should Not Be Selected.</div>
                            <div id="state-success" class="valid-feedback-icon valid-feedback-icon-success dno position-absolute"><icon class="fa fa-check"></icon></div>
                            <div id="state-error"  class="valid-feedback-icon valid-feedback-icon-error  dno position-absolute"><icon class="fa fa-times"></icon></div>
                            <select class="custom-select d-block w-100 form-control" id="state" name="state" >
                                <option value="0">Choose...</option>
                                @foreach($zones as $zone)
                                    <option value="{{$zone->zone_id}}">{{$zone->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="zip">City</label>
                            <div id="city-error-message"  class="dno bubble">City Should Be Selected.</div>
                            <div id="city-success" class="valid-feedback-icon valid-feedback-icon-success dno position-absolute"><icon class="fa fa-check"></icon></div>
                            <div id="city-error"  class="valid-feedback-icon valid-feedback-icon-error  dno position-absolute"><icon class="fa fa-times"></icon></div>
                            <select class="custom-select d-block w-100 form-control" id="city" name="city" >
                                <option value="0">Choose...</option>

                            </select>
                        </div>
                    </div>

                    <hr class="mb-4">
                    <h4 class="mb-3">Payment Method</h4>
                    <div class="row">
                    <div class="d-block my-3 col-md-4">
                        <div class="custom-control custom-radio">
                            <input id="cod" name="payment" type="radio" class="custom-control-input" checked="checked" value="cod">
                            <label class="custom-control-label" for="cod">Cash On Delivery (COD)</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="bktransfer" name="payment" type="radio" class="custom-control-input"  value="bktransfer">
                            <label class="custom-control-label" for="bktransfer">Bank Transfer</label>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="cod_detail payment_detail" >
                            <h4 class="display-6 text-center">CASH ON DELIVERY </h4>
                            <p class="text-center m-auto">Pay when you recieve the parcel</p>
                        </div>
                        <div class="bktransfer_detail payment_detail dno" >
                            <h4 class="display-6 text-center">BANK TRANSFER</h4>
                            <p class=" m-auto"><strong>BANK : HABIB BANK LIMITED (HBL)</strong></p>
                            <p class=" m-auto"><strong>ACCOUNT NO : 1001111111111111111</strong></p>
                            <p class=" m-auto"><strong>ACCOUNT TITLE : CARVE</strong></p>
                            <p class="r m-auto"><strong>IBAN: EQA2 4346 4356 2315 95021</strong></p>
                            <p class="r m-auto"><strong>SWIFT CODE: EQA2</strong></p>
                        </div>

                    </div>
                    </div>


                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-reg-primary add-order" type="button">Place An Order</button>
                </form>
            </div>
        </div>

    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {

            $('input[name="payment"]').click(function(){
                var radioValue = $("input[name='payment']:checked"). val();
                if(radioValue == 'cod'){
                    $('.payment_detail').hide();
                    $('.cod_detail').show();
                } else {
                    $('.payment_detail').hide();
                    $('.bktransfer_detail').show();
                }
            })




            $('#fullName').keyup(function() {
                if($('#fullName').val().length >= 3 ) {
                    $('#fullName-success').show()
                    $('#fullName-error').hide()
                    $('#fullName-error-message').hide()
                    $('#fullName').removeClass('valid-error')
                } else {
                    $('#fullName-success').hide()
                    $('#fullName-error').show()
                    $('#fullName-error-message').show()
                    $('#fullName').addClass('valid-error')
                }

            });
            $('#phone').keyup(function() {
                var letters = /^[A-Za-z]+$/;

                if($('#phone').val().length >= 9  && !$('#phone').val().match(letters)) {
                    $('#phone-success').show()
                    $('#phone-error').hide()
                    $('#phone-error-message').hide()
                    $('#phone').removeClass('valid-error')
                } else {
                    $('#phone-success').hide()
                    $('#phone-error').show()
                    $('#phone-error-message').show()
                    $('#phone').addClass('valid-error')
                }

            });
            $('#email').keyup(function() {
                if( validateEmail($('#email').val()) && $('#email').val().length > 2){
                    $('#email-success').show()
                    $('#email-error').hide()
                    $('#email-error-message').hide()
                    $('#email').removeClass('valid-error')
                } else {
                    $('#email-success').hide()
                    $('#email-error').show()
                    $('#email-error-message').show()
                    $('#email').addClass('valid-error')
                }

            });
            $('#address').keyup(function() {
                if($('#address').val().length >= 5 ) {
                    $('#address-success').show()
                    $('#address-error').hide()
                    $('#address-error-message').hide()
                    $('#address').removeClass('valid-error')
                } else {
                    $('#address-success').hide()
                    $('#address-error').show()
                    $('#address-error-message').show()
                    $('#address').addClass('valid-error')
                }

            });
            $('#state').blur(function() {
                if($('#state').val() !=  0 ) {
                    $('#state-success').show()
                    $('#state-error').hide()
                    $('#state-error-message').hide()
                    $('#state').removeClass('valid-error')
                } else {
                    $('#state-success').hide()
                    $('#state-error').show()
                    $('#state-error-message').show()
                    $('#state').addClass('valid-error')
                }

            });

            $('#state').change(function() {
                if($('#state').val() !=  0 ) {
                    $('#state-success').show()
                    $('#state-error').hide()
                    $('#state-error-message').hide()
                    $('#state').removeClass('valid-error')
                } else {
                    $('#state-success').hide()
                    $('#state-error').show()
                    $('#state-error-message').show()
                    $('#state').addClass('valid-error')
                }

            });




            $('#city').blur(function() {
                if($('#city').val() !=  0 ) {
                    $('#city-success').show()
                    $('#city-error').hide()
                    $('#city-error-message').hide()
                    $('#city').removeClass('valid-error')
                } else {
                    $('#city-success').hide()
                    $('#city-error').show()
                    $('#city-error-message').show()
                    $('#city').addClass('valid-error')
                }

            });

            $('#city').change(function() {
                if($('#city').val() !=  0 ) {
                    $('#city-success').show()
                    $('#city-error').hide()
                    $('#city').removeClass('valid-error')
                    $.ajax({
                        url:' {{URL('cart/shipping')}}',
                        type: 'post',
                        dataType: 'json',
                        data: {'city':$("#city").val(),'state':$("#state").val(),'_token':$('#token').val()},

                        success: function(json) {
                            console.log(json)
                            if(json.success){
                                $('#shipping').html(json.shipping)
                                $('#grant_total').html(json.grant_total)
                            } else if(json.error){
                                $('#state-success').hide()
                                $('#state-error-message').show()
                                $('#state').addClass('valid-error')
                            }



                        }
                    });

                } else {
                    $('#city-success').hide()
                    $('#city-error').show()
                    $('#city-error-message').show()
                    $('#city').addClass('valid-error')
                }

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
            
            
            $('.add-order').click(function () {
                validate = true;
                if(!$('#fullName').val()){
                    $('#fullName-error').show()
                    $('#fullName-error-message').show()
                    $('#fullName').addClass('valid-error')
                    validate = false;
                }
                if(!$('#phone').val()){
                    $('#phone-error').show()
                    $('#phone-error-message').show()
                    $('#phone').addClass('valid-error')
                    validate = false;
                }
                if(!$('#email').val() &&  validateEmail($('#email').val()) ){
                    $('#email-error').show()
                    $('#email-error-message').show()
                    $('#email').addClass('valid-error')
                    validate = false;
                }

                if($('#state').val( ) == 0){
                    $('#state-error').show()
                    $('#state-error-message').show()
                    $('#state').addClass('valid-error')
                    validate = false;
                }

                if($('#city').val() == 0 || $('#city').val() == '' ){
                    $('#city-error').show()
                    $('#city-error-message').show()
                    $('#city').addClass('valid-error')
                    validate = false;
                }

                if(!$('#address').val()){
                    $('#address-error').show()
                    $('#address-error-message').show()
                    $('#address').addClass('valid-error')
                    validate = false;
                }
                if(validate) {
                    $.ajax({
                        url: 'checkout/validate',
                        type: 'post',
                        dataType: 'json',
                        data: $('#checkout-form').serialize(),
                        beforeSend: function () {
                            $('.add-order').text('loading');
                        },
                        complete: function () {
                            $('.add-order').text('Place An Order');
                        },
                        success: function (json) {
                            $('.add-order').text('Place An Order');
                            if(json.success){
                                location.href = json.redirect
                            }

                        }
                    });
                }


            })
            
            
            
        });

        function validateEmail($email) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return emailReg.test( $email );
        }
    </script>
@endsection


