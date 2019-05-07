<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <meta name="robots" content="index,follow">
    <meta name="description" content="@yield('description')" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" >
    <link rel="stylesheet" href="{{ asset('js/vendor/owl.carousel/owl.carousel.min.css') }}" >
    <link rel="stylesheet" href="{{ asset('js/vendor/owl.carousel/owl.theme.default.min.css') }}" >
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" >
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" >
    @yield('css')
    <link rel="canonical" href="@yield('canonical')"  />
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#"><img src="resources/images/carve.png" /> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<header class="masthead">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12 text-center">
                <h1 class="font-weight-light">Vertically Centered Masthead Content</h1>
                <p class="lead">A great starter layout for a landing page</p>
            </div>
        </div>
    </div>
</header>
<section class="py-20">
    @yield('content')
</section>
<script src="https://code.jquery.com/jquery-3.4.0.min.js"  ></script>
<script src="{{ asset('js/bootstrap.min.js') }}" ></script>
<script src="{{ asset('js/vendor/owl.carousel/owl.carousel.min.js') }}" ></script>

<script>
    $(document).ready(function(){
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            lazyLoad: true,
            responsiveClass: true,
            responsive: {
                0: {
                    items:1,
                    nav: true
                },
                600: {
                    items: 2,
                    nav: false
                }
            }
        })
        $( ".owl-prev").html('<i class="fa fa-angle-left carve-arrow carve-arrow-left"></i>');
        $( ".owl-next").html('<i class="fa fa-angle-right carve-arrow carve-arrow-right"></i>');
    });
</script>
@yield('js')
</body>
</html>