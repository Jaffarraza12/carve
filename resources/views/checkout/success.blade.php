@extends('layouts.transaction')
@section('title', 'Thank you')
@section('content')
    <div class="jumbotron text-xs-center">
        <h1 class="display-5 text-center">Thank You {{$order->name }}! </h1>
        <p class="lead m-auto text-center"><strong>We have sent you Order instruction at {{$order->email}}</strong> for further instructions on how to complete your account setup.</p>
        <hr>
        <p class="m-auto w-100 text-center">
            Having trouble? <a href="{{ URL('contact') }}">Contact us</a>
        </p>
        <p class="m-auto w-100 text-center">
            <a class="btn btn-primary btn-sm" href="{{ URL('contact') }}" role="button">Continue to homepage</a>
        </p>
    </div>
@endsection



