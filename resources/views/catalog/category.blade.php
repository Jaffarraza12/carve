@extends('layouts.master')
@section('title', $category->meta_title)
@section('description', $category->meta_description)
@section('canonical', $canonical)
@section('content')
<div class="container">
    <div class="categoryGrid row">
        @foreach($products as $product)
        <div class="product">
            <div class="product-container">
                <div class="product-name">
                    <a href="{{$product['seo_url']}}"><img  src="{{asset($product['image'])}}" width="400" height="auto" /></a>
                </div>
                <div class="product-name">
                    <a href="{{$product['seo_url']}}" class="title" >{{$product['name']}}</a>

                    @if ($product['special'])
                        <a class="price" >{{$product['special']['price']}} RS            <span class="old_price">{{$product['price']}} RS</span></a><br/>

                    @else
                        <a class="price" >{{$product['price']}} RS</a><br/>

                    @endif
                    <a class="btn btn-reg-primary-short text-center m-auto" href="{{$product['seo_url']}}">SHOP NOW</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
@section('js')
    <script>
     $(document).ready(function () {

            var Interval
            $('.product').hover(function () {
                overlay = $(this).find('.overlay')
                overlay.show()
                Interval = setInterval(function () {
                    overlay.css({'border-color':'transparent'})
                },2000)
            },function(){
                overlay.hide();
                overlay.css({'border-color':'#fff'})
                clearInterval(Interval)
            })

        });


    </script>
@stop