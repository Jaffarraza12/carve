@extends('layouts.transaction')
@section('title', 'CARVE HOME FASHION')
@section('content')
    <div class="jumbotron text-xs-center">
        <h1 class="display-3">Thank You{{$order->name }}! </h1>
        <p class="lead"><strong>We have sent you Order instruction at {{$order->email}}</strong> for further instructions on how to complete your account setup.</p>
        <hr>
        <p>
            Having trouble? <a href="{{ URL('contact') }}">Contact us</a>
        </p>
        <p class="lead">
            <a class="btn btn-primary btn-sm" href="{{ URL('contact') }}" role="button">Continue to homepage</a>
        </p>
    </div>
@endsection



