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
<div class="header-top">
    <div class="container">
        <div class="row hidden-mbl">
            <div class="col phone">
                <li class="hidden-mbl"><a href="tel:03142006655" class="text-white" >CALL OR WHATSAPP 0314 200 6655</a></li>

            </div>
            <div class="col">
                <div class="pull-right rightLinks">
                    <li class="px-20"><a ><i class="fa fa-question-circle"></i>  HELP</a></li>
                    <li class="px-20"><a ><i class="fa fa-phone"></i> CONTACT US</a></li>
                </div>
            </div>
        </div>
        <div class="row  hidden-desk">
            <div class="mbl-row"><a href="tel:03142006655" class="text-white"><i class="fa fa-phone"></i> CALL</a></div>
            <div class="mbl-row"><a ><i class="fa fa-question-circle"></i>  HELP</a></div>
            <div class="mbl-row"><i class="fa fa-phone"></i> CONTACT US </div>
        </div>
    </div>
</div>
<div class="container bg-white">
    <div class="row">

        <div class="col col-lg-2">
           {{-- <form>
                <div class="form-group position-relative search-form">
                    <input  type="search" placeholder="Search Something New." name="search" class="form-control search-query"/> <i class="search-button  fa fa-search"></i>
                </div>
            </form>--}}
            <button class="nav_menu_toggler_icon"><span class="fa fa-bars"></span></button>
            <a class="navbar-brand hidden-mbl" href="{{URL('/')}}"><img class="m-auto text-center" src="resources/images/carve.png" /> </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

        </div>
        <div class="col m-auto hidden-desk ">
            <a class="navbar-brand hidden-desk" href="{{URL('/')}}"><img class="m-auto text-center" src="resources/images/carve.png" /> </a>

        </div>
        <div class="col col-lg-10">
            <div class="btn-group pull-right hidden-desk">
                <a href="{{URL('/cart')}}"  class="ShoppingCart position-relative cart-link">
                    <i class="fa fa-shopping-bag" aria-hidden="true"></i><div class="position-absolute" ><span id="cart_quantity" >{{$cart_quantity}}</span></div>
                </a>{{--<div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Separated link</a>
                </div>--}}

            </div>
            <div class="menu-container clearfix">
                <nav class="manu clearfix" >
                    <ul class="m-auto d-block">
                        <li><a href="{{URL('/')}}"><i class="fa fa-home"></i></a></li>
                        <li ><a href="#">Our Collection</a>
                            <ul>
                                <li><a href="#">School</a>
                                    <ul>
                                        <li><a href="#">Lidership</a></li>
                                        <li><a href="#">History</a></li>
                                        <li><a href="#">Locations</a></li>
                                        <li><a href="#">Careers</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Study</a>
                                    <ul>
                                        <li><a href="#">Undergraduate</a></li>
                                        <li><a href="#">Masters</a></li>
                                        <li><a href="#">International</a></li>
                                        <li><a href="#">Online</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Research</a>
                                    <ul>
                                        <li><a href="#">Undergraduate research</a></li>
                                        <li><a href="#">Masters research</a></li>
                                        <li><a href="#">Funding</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Something</a>
                                    <ul>
                                        <li><a href="#">Sub something</a></li>
                                        <li><a href="#">Sub something</a></li>
                                        <li><a href="#">Sub something</a></li>
                                        <li><a href="#">Sub something</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li><a href="#">Graphic T-Shirt</a>
                            <ul>
                                <li><a href="#">School</a>
                                    <ul>
                                        <li><a href="#">Lidership</a></li>
                                        <li><a href="#">History</a></li>
                                        <li><a href="#">Locations</a></li>
                                        <li><a href="#">Careers</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Study</a>
                                    <ul>
                                        <li><a href="#">Undergraduate</a></li>
                                        <li><a href="#">Masters</a></li>
                                        <li><a href="#">International</a></li>
                                        <li><a href="#">Online</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Study</a>
                                    <ul>
                                        <li><a href="#">Undergraduate</a></li>
                                        <li><a href="#">Masters</a></li>
                                        <li><a href="#">International</a></li>
                                        <li><a href="#">Online</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Empty sub</a></li>
                            </ul>
                        </li>
                        <li><a href="#">New Arrivals</a></li>
                        <li><a href="#">Our Story</a></li>
                    </ul>
                </nav>
            </div>

        </div>
    </div>
</div>

@yield('banner')






{{----}}
<section class="py-20">
    @yield('content')
</section>


<div class="footer full-width site-footer">
    <div class="pattern">
            <div class="site-footer-inner container">
                <div class="row footer-contact">
                    <div class="footer-contact-phone col-sm-3 col-xs-12 footer-content-block">
                        <span class="iconhidden-xs" aria-hidden="true"></span>
                        <div class="icon-push">
                            <a href="tel:0314 200 6655" id="footerPhoneNumberLink">
                                <div class="headed"><icon class="fa fa-phone-square"></icon> <span class="sr-only">Call us at</span>0314 200 6655</div> </a>
                            <p> Mon–Sat, 9am – 7pm</p>
                        </div>
                    </div>
                    <div class="footer-contact-email col-sm-3 col-xs-12 footer-content-block">
                        <span class="icon " aria-hidden="true"></span>
                        <div class="icon-push">
                            <a href="/contact" target="_blank" rel="noopener">
                                <div class="headed"><icon class="fa fa-envelope"></icon> Email Us</div> </a>
                            <p> We will respond as quickly as we can. </p>
                        </div>
                    </div>
                    <div class="footer-contact-chat no-gutter col-sm-3 col-xs-12 footer-content-block"> <span class="icon icon-rei-chat" aria-hidden="true"></span> <div class="icon-push">
                            <a href="/contact" target="_blank" rel="noopener">
                                <div class="headed"><icon class="fa fa-comment"></icon> Live Chat</div> </a>
                            <p> Mon–Sat, 9am – 7pm </p>
                        </div>
                    </div>
                    <div class="footer-contact-help col-sm-3 col-xs-12 footer-content-block">
                        <div class="icon-push">
                            <a href="/help"> <div class="headed"> <icon class="fa fa-question-circle"></icon> Help Center</div> </a>
                            <p> Find answers online anytime. </p>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3  m-auto text-center">
                            <a href="/about_us">About Us</a>
                        </div>
                        <div class="col-lg-3  m-auto text-center">
                            <a href="https://www.bargain.pk/your-orders">Your Orders </a>
                        </div>
                        <div class="col-lg-3  m-auto text-center">
                            <a href="https://www.bargain.pk/">Payment Methods</a>
                        </div>
                        <div class="col-lg-3 m-auto text-center">
                            <a href="https://www.bargain.pk/return-refund">Return &amp; Refund</a>
                        </div>
                        <div class="col-lg-3  m-auto text-center">
                            <<a href="https://www.bargain.pk/delivery">Shipping &amp; Deliveries</a>
                        </div>
                        <div class="col-lg-3  m-auto text-center">
                            <a href="https://www.bargain.pk/secure-payment"> Secure Shopping</a>
                        </div>
                        <div class="col-lg-3  m-auto text-center">
                            <a href="https://www.bargain.pk/contact">Contact Us</a>
                        </div>
                        <div class="col-lg-3  m-auto text-center">
                            <a href="https://www.bargain.pk/privacy">Privacy &amp; Policy</a>
                        </div>

                    </div>
                </div>
                <div class="row footer-difference-banner ">
                    <div class=" m-auto text-center">
                        <h4 class="text-center">The CARVE Difference:<br>100 % satisfaction guaranteed. The Right Product &amp; Best Advice. <br>Huge Savings Everyday</h4>
                    </div>
                </div>
                <div class="container">
                    <div class=" footer-apps-social-legal">
                        <div class=" center CenterAlign">
                            <div class="footer-social ">
                                <div class="m-auto text-center">
                                    <a class="text-center" href="https://twitter.com/BargainPk" target="_blank">
                                        <icon class="fa fa-twitter"></icon>
                                        <span class="sr-only">twitter</span> </a>
                                    <a class="text-center" href="https://facebook.com/BargainPk" target="_blank">
                                        <icon class="fa fa-facebook"></icon>
                                        <span class="sr-only">facebook</span> </a>
                                    <a  class="text-center" href="https://www.pinterest.com/bargainpakistan" target="_blank">
                                        <icon class="fa fa-pinterest"></icon>
                                        <span class="sr-only">pinterest</span> </a>
                                    <a  class="text-center" href="https://www.youtube.com/channel/UCKX_Ut65akaqWWP11oVLeiQ?view_as=subscriber">
                                        <icon class="fa fa-youtube"></icon>
                                        <span class="sr-only">youtube</span> </a>
                                    <a class="text-center hidden" href="https://www.instagram.com/rei/" target="_blank">
                                        <icon class="fa fa-instagram"></icon>
                                        <span class="sr-only">instagram</span> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-legal">
                    <div class="text-center m-auto" >
                        <p class="copyright" data-ui="footer-rei-copyright"> © {{date('Y')}} Bargain Pakistan. All rights reserved.</p>
                    </div>
                </div>

            </div>
  </div>
    <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="{{ asset('js/vendor/owl.carousel/owl.carousel.min.js') }}" ></script>
<script src="{{ asset('js/menu.js') }}" ></script>


<script>
    $(document).ready(function(){
        $('ul.nav li.dropdown').hover(function() {
            $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
        }, function() {
            $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
        });
        $('.masthead').alert()
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