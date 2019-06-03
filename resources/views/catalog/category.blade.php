@extends('layouts.master')
@section('title', $category->meta_title)
@section('description', $category->meta_description)
@section('canonical', $canonical)
@section('banner')
@section('banner')
    <header class="masthead-category">
        <div class="containe">
            <div class="row align-items-center">
                <h1>{{$category->heading}}</h1>
                <div class="clearfix"></div>
                <div class="bread">
                   <li><a href="{{URL('')}}"> <i class="fa fa-home"></i> </a></li>
                   -<li><a href="{{URL($category->seo_url)}}"> {{$category->name}}</a></li>
                </div>
            </div>
        </div>
    </header>
@endsection
@endsection

@section('content')
<div class="home-container m-auto">
    <div class="categoryGrid row">
        @foreach($products as $product)
        <div class="product">
            <div class="product-container">
                <div class="product-name">
                    <a href="{{$product['seo_url']}}"><img  src="{{ $product['image']}}" width="400" height="auto" /></a>
                </div>
                <div class="product-name">
                    <a href="{{$product['seo_url']}}" class="title" >{{$product['name']}}</a>

                    @if ($product['special'])
                        <a class="price" >Rs {{$product['special']['price']}}             <span class="old_price"> Rs {{$product['price']}} </span></a><br/>

                    @else
                        <a class="price" >Rs {{$product['price']}} </a><br/>

                    @endif
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