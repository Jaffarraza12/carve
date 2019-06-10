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
                <div class="alert alert-danger" style="display: none;"> </div>
                <h1 class="product-title">{{$product->name}}</h1>

                <div class="wrapper row">
                    <div class="clearfix"></div>

                    <div class="preview col-md-6">

                        <div class="preview-pic tab-content">
                            @php
                                $i = 1;
                            @endphp
                            @foreach($productImages as $image)
                                <div class="tab-pane {{ ($i ==1 ) ? 'active' : '' }} " id="pic-{{$i}}"><img src="{{ $image }}" width="400" /></div>
                                @php
                                    $i = $i + 1;
                                @endphp
                            @endforeach
                        </div>
                        <div class="m-auto text-center d-block">
                        <ul class="preview-thumbnail nav nav-tabs  ">
                            @php
                                $i = 1
                            @endphp
                            @foreach($productImages as $image)
                                <li class="{{ ($i ==1 ) ? 'active' : '' }}  text-center "><a data-target="#pic-{{$i}}" data-toggle="tab">
                                        <img src="{{$image}}" width="200" /></a>
                                </li>
                                @php
                                    $i = $i + 1;
                                @endphp
                            @endforeach
                        </ul></div>

                    </div>
                    <div class="details col-md-6">
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
                        <p class="product-description">{!! html_entity_decode($product->short_description) !!} </p>
                        @if ($productSpecial)
                           <h4 class="price ">Price: <span> Rs {{$productSpecial->price}}</span>  <span class="old_price">Rs {{$product->price}}</span></h4>
                        @else
                            <h4 class="price">Price: <span>Rs {{$product->price}}</span></h4>
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
        @if($product->description)
        <div class="description">
            <h2>Description</h2>
            <p>{!! html_entity_decode($product->description) !!}</p>
        </div>
        @endif

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
                        $('.alert-danger').show();
                        $('html, body').animate({
                            scrollTop: $(".alert-danger").offset().top - 200
                        }, 1000);
                        $('.alert-danger').html(json['error']);

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