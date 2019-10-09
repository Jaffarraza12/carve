@extends('layouts.master')
@section('title', 'CARVE HOME FASHION')
@section('banner')
    <header class="masthead">
        <div class="container">
            <div class="row align-items-center">

            </div>
        </div>
    </header>
@endsection
@section('content')
   <div class="">
       <div class="bell-borad">
           <h3 class="text-center">FREE SHIPPING OVER 1500 RS</h3>
       </div>
   </div>
   <div class="contanier homeContent">
       <div class="row">
       <div class="col">
           <h2 class="text-center m-auto">DISCOVER THE BEAUTY WITHIN</h2>
           <p class="text-center m-auto">
               WE BELIEVE FASHION IS WHAT MAKES US LOOK OUR BEST - IT SHOULD ALWAYS BE PERSONAL - NEVER MAINSTREAM.
           </p>
           <p class="text-center m-auto small">
               From choosing the right fabric for an event to discovering the colors that suit you best. Designs deeply-rooted from the rich culture of Pakistan; crafted with tailor-made cuts made for your uniquely beautiful body type. All the while, aiming for a perfect and balanced fashion statement.</p>
       </div>
       </div>
   </div>

    <div class="home-container m-auto">
        <div class="row">
            <div class="col-lg-6 homeGrid">
                <div class="categoryImage m-auto text-center">
                    <a href="/uptown"> <img class=" " src="{{ asset('images/Collection-Banner-1.jpg')}}"  width="500" height="auto"/></a>
                </div>
                <div class="categoryDetail">
                    <a href="/uptown" class="categoryTitle text-center d-block text-uppercase">Uptown</a>
                </div>
            </div>
            <div class="col-lg-6 homeGrid">
                <div class="categoryImage m-auto text-center">
                    <a href="/eminence"> <img class=" " src="{{ asset('images/Collection-Banner-2.jpg')}}"  width="500" height="auto"/></a>
                </div>
                <div class="categoryDetail">
                    <a href="//eminence" class="categoryTitle text-center d-block text-uppercase">Eminence</a>
                </div>
            </div>
        </div>
    </div>
@endsection



