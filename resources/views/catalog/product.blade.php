@extends('layouts.master')
@section('title', $product->meta_title)
@section('description', $product->meta_description)
@section('canonical', $canonical)
@section('css')
<link rel="stylesheet" href="{{ asset('css/product.css') }}" >
@endsection
@section('content')
    <div class="container">
        <div class="card">
            <div class="container-fliud">
                <div class="alert alert-success" style="display: none;"> <icon class="fa fa-check"></icon> Your Item has been added to your  <a href="{{URL('cart')}}">cart</a>  </div>
                <div class="wrapper row">
                    <div class="preview col-md-6">

                        <div class="preview-pic tab-content">
                            @php
                                $i = 1
                            @endphp
                            @foreach($productImages as $image)
                                <div class="tab-pane {{ ($i ==1 ) ? 'active' : '' }} " id="pic-{{$i}}"><img src="{{asset($image->image)}}" /></div>
                                @php
                                    $i = $i + 1;
                                @endphp
                            @endforeach;
                        </div>
                        <ul class="preview-thumbnail nav nav-tabs">
                            @php
                                $i = 1
                            @endphp
                            @foreach($productImages as $image)
                                <li class="{{ ($i ==1 ) ? 'active' : '' }} "><a data-target="#pic-{{$i}}" data-toggle="tab"><img src="{{asset($image->image)}}" /></a></li>
                                @php
                                    $i = $i + 1;
                                @endphp
                            @endforeach;
                        </ul>

                    </div>
                    <div class="details col-md-6">
                        <h3 class="product-title">{{$product->name}}</h3>
                        <div class="rating d-none">
                            <div class="stars">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>
                            <span class="review-no">41 reviews</span>
                        </div>
                        <p class="product-description">{!! html_entity_decode($product->description) !!} </p>
                        @if ($productSpecial)
                           <h4 class="price">current price: <span>{{$productSpecial->price}}</span>  <span class="old_price">{{$product->price}}</span></h4>
                        @else
                            <h4 class="price">current price: <span>{{$product->price}}</span></h4>
                        @endif
                        <form id="addToCart">
                        <input type="hidden" name="product_id" value="{{$product->product_id}}" />
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <input type="hidden" name="quantity"  value="1">

                            @include('catalog.variation')
                        </form>
                        <div class="action">
                            <div id="cart-resp"></div>
                            <button class="add-to-cart btn btn-default" type="button">add to cart</button>
                            <button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
    $(document).ready(function(){
        $('.add-to-cart').click(function () {
             $.ajax({
                url:' {{URL('cart/add')}}',
                type: 'post',
                dataType: 'json',
                data: $('#addToCart').serialize(),
                beforeSend: function() {
                    $('.add-to-cart').button('loading');
                },
                complete: function() {
                    $('.add-to-cart').button('reset');
                },
                success: function(json) {
                    $('.cart-resp').html();

                    if (json['error']) {
                        //$('#abdq').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
                    }

                    if (json['success']) {
                        $('.alert-success').show();
                        $('html, body').animate({
                            scrollTop: $(".alert-success").offset().top - 200
                        }, 1000);



                    }
                }
            });
        });

    });
    </script>
@endsection