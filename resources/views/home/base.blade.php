<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="Gen Z bank of the future.">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{$siteName}} - {{$pageName}}">
    <meta name='og:image' content='{{asset('home/images/'.$web->logo)}}'>
    <title>{{$pageName}} - {{$siteName}}</title>

    @stack('css')

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link href="{{ asset('home/css/font-awesome-all.css') }}" rel="stylesheet">
    <link href="{{ asset('home/css/flaticon.css') }}" rel="stylesheet">
    <link href="{{ asset('home/css/owl.css') }}" rel="stylesheet">
    <link href="{{ asset('home/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('home/css/jquery.fancybox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('home/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('home/css/nice-select.css') }}" rel="stylesheet">
    <link href="{{ asset('home/css/color.css') }}" rel="stylesheet">
    <link href="{{ asset('home/css/elpath.css') }}" rel="stylesheet">
    <link href="{{ asset('home/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('home/css/elements-css/banner.css') }}" rel="stylesheet">
    <link href="{{ asset('home/css/elements-css/feature.css') }}" rel="stylesheet">
    <link href="{{ asset('home/css/elements-css/about.css') }}" rel="stylesheet">
    <link href="{{ asset('home/css/elements-css/service.css') }}" rel="stylesheet">
    <link href="{{ asset('home/css/elements-css/cta.css') }}" rel="stylesheet">
    <link href="{{ asset('home/css/elements-css/testimonial.css') }}" rel="stylesheet">
    <link href="{{ asset('home/css/elements-css/chooseus.css') }}" rel="stylesheet">
    <link href="{{ asset('home/css/elements-css/working-process.css') }}" rel="stylesheet">
    <link href="{{ asset('home/css/elements-css/projects.css') }}" rel="stylesheet">
    <link href="{{ asset('home/css/elements-css/news.css') }}" rel="stylesheet">
    <link href="{{ asset('home/css/elements-css/subscribe.css') }}" rel="stylesheet">
    <link href="{{ asset('home/css/responsive.css') }}" rel="stylesheet">

    <link href="{{ asset('home/css/elements-css/page-title.css') }}" rel="stylesheet">

</head>


<!-- page wrapper -->
<body>

<div class="boxed_wrapper">


    <!-- preloader -->
    <div class="loader-wrap">
        <div class="preloader">
            <div class="preloader-close">x</div>
            <div id="handle-preloader" class="handle-preloader">
                <div class="animation-preloader">
                    <div class="spinner"></div>
                    <div class="txt-loading">
                        @foreach (str_split($siteName) as $char)
                            <span data-text-preloader=" {{ $char }}" class="letters-loading">
                                 {{ $char }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- preloader end -->


    <!-- main header -->
    <header class="main-header header-style-two">
        <!-- header-top -->
        <div class="header-top">
            <div class="auto-container">
                <div class="top-inner">
                    <div class="top-left">
                        <ul class="info clearfix">
                            <li><i class="icon-1"></i>Mon-Fri 8:00 am-6:00 pm</li>
                            @if($web->phone)
                                <li><i class="icon-2"></i><a href="tel:{{$web->phone}}">{{ $web->phone }}</a></li>
                            @endif
                            <li><i class="icon-3"></i><a href="mailto:{{ $web->email }}">{{ $web->email }}</a></li>
                        </ul>
                    </div>
                    <div class="top-right">
                        <div class="login"><a href="{{ route('login') }}">Login</a></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header-lower -->
        <div class="header-lower">
            <div class="auto-container">
                <div class="outer-box">
                    <div class="logo-box">
                        <figure class="logo"><a href="{{ url('/') }}"><img src="{{ asset('home/images/'.$web->logo) }}" alt=""></a></figure>
                    </div>
                    <div class="menu-area clearfix">
                        <!--Mobile Navigation Toggler-->
                        <div class="mobile-nav-toggler">
                            <i class="icon-bar"></i>
                            <i class="icon-bar"></i>
                            <i class="icon-bar"></i>
                        </div>
                        <nav class="main-menu navbar-expand-md navbar-light">
                            <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                <ul class="navigation clearfix">

                                    <li><a href="{{ route('home') }}">Home</a></li>
                                    <li><a href="{{ route('about') }}">About Us</a></li>
                                    <li><a href="{{ route('services') }}">Our Services</a></li>
                                    <li><a href="{{ route('faqs') }}">Our FAQs</a></li>
                                    <li><a href="{{ route('register') }}">Create Account</a></li>

                                    <li><a href="{{ route('home.contact') }}">Contact Us</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <ul class="menu-right-content">
                        <li class="btn-box">
                            <a href="{{ route('register') }}" class="theme-btn-one">Create an Account</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!--sticky Header-->
        <div class="sticky-header">
            <div class="auto-container">
                <div class="outer-box">
                    <div class="logo-box">
                        <figure class="logo"><a href="{{ route('home') }}"><img src="{{ asset('home/images/'.$web->logo) }}" alt=""></a></figure>
                    </div>
                    <div class="menu-area clearfix">
                        <nav class="main-menu clearfix">
                            <!--Keep This Empty / Menu will come through Javascript-->
                        </nav>
                    </div>
                    <ul class="menu-right-content">
                        <li class="btn-box">
                            <a href="{{ route('register') }}">Get Started</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <!-- main-header end -->

    <!-- Mobile Menu  -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn"><i class="fas fa-times"></i></div>

        <nav class="menu-box">
            <div class="nav-logo"><a href="{{ route('home') }}"><img src="{{ asset('home/images/'.$web->logo) }}" alt="" title=""></a></div>
            <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
            <div class="contact-info">
                <h4>Contact Info</h4>
                <ul>
                    <li>{!! $web->address !!}</li>
                    @if($web->phone)
                        <li><a href="tel:{{ $web->phone }}">{{ $web->phone }}</a></li>
                    @endif
                    <li><a href="mailto:{{ $web->email }}">{{ $web->email }}</a></li>
                </ul>
            </div>
        </nav>
    </div><!-- End Mobile Menu -->


    @yield('content')



    <!-- main-footer -->
    <footer class="main-footer alternat-2">
        <div class="widget-section">
            <div class="pattern-layer">
                <div class="pattern-1" style="background-image: url({{ asset('home/images/shape/shape-27.png') }});"></div>
                <div class="pattern-2" style="background-image: url({{ asset('home/images/shape/shape-28.png') }});"></div>
            </div>
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                        <div class="logo-widget footer-widget">
                            <figure class="footer-logo"><a href="{{ route('home') }}"><img src="{{ asset('home/images/'.$web->logo) }}" alt=""></a></figure>
                            <div class="text">
                                <p>
                                    At {{ $siteName }}, we understand that navigating the financial landscape can be daunting.
                                    That's why we've streamlined our processes to ensure a seamless experience for you.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                        <div class="links-widget footer-widget ml_50">
                            <div class="widget-title">
                                <h3>Quick Link</h3>
                            </div>
                            <div class="widget-content">
                                <ul class="links-list clearfix">
                                    <li><a href="{{ route('about') }}">About Us</a></li>
                                    <li><a href="{{ route('services') }}">Services</a></li>
                                    <li><a href="{{ route('home.contact') }}">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                        <div class="links-widget footer-widget ml_30">
                            <div class="widget-title">
                                <h3>Useful Links</h3>
                            </div>
                            <div class="widget-content">
                                <ul class="links-list clearfix">
                                    <li><a href="{{ route('terms') }}">Terms & Condition</a></li>
                                    <li><a href="{{ route('faqs') }}">FAQs</a></li>
                                    <li><a href="{{ route('login') }}">Login</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                        <div class="contact-widget footer-widget">
                            <div class="widget-title">
                                <h3>Contact</h3>
                            </div>
                            <div class="widget-content">
                                <p>Contact Us at: </p>
                                <ul class="info-list clearfix">
                                    <li><i class="icon-23"></i>{!! $web->address !!}</li>
                                    <li><i class="icon-3"></i><a href="mailto:{{ $web->email }}">{{ $web->email }}</a></li>
                                    @if($web->phone)
                                        <li><i class="icon-2"></i><a href="tel:{{ $web->phone }}">{{ $web->phone }}</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom centred">
            <div class="auto-container">
                <div class="copyright">
                    <p>Copyright 2015 - {{ date('Y') }} by <a href="{{ route('home') }}">{{ $siteName }}</a> All Right Reserved.</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- main-footer end -->



    <!--Scroll to top-->
    <div class="scroll-to-top">
        <div>
            <div class="scroll-top-inner">
                <div class="scroll-bar">
                    <div class="bar-inner"></div>
                </div>
                <div class="scroll-bar-text">Go To Top</div>
            </div>
        </div>
    </div>
    <!-- Scroll to top end -->

</div>


<!-- jequery plugins -->
<script src="{{ asset('home/js/jquery.js') }}"></script>
<script src="{{ asset('home/js/popper.min.js') }}"></script>
<script src="{{ asset('home/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('home/js/owl.js') }}"></script>
<script src="{{ asset('home/js/wow.js') }}"></script>
<script src="{{ asset('home/js/validation.js') }}"></script>
<script src="{{ asset('home/js/jquery.fancybox.js') }}"></script>
<script src="{{ asset('home/js/appear.js') }}"></script>
<script src="{{ asset('home/js/scrollbar.js') }}"></script>
<script src="{{ asset('home/js/isotope.js') }}"></script>
<script src="{{ asset('home/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('home/js/parallax-scroll.js') }}"></script>

<!-- main-js -->
<script src="{{ asset('home/js/script.js') }}"></script>
<!-- Smartsupp Live Chat script -->
<script type="text/javascript">
    var _smartsupp = _smartsupp || {};
    _smartsupp.key = '25e339660dc9976e572a5df4cf6449be15c018a6';
    window.smartsupp||(function(d) {
        var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
        s=d.getElementsByTagName('script')[0];c=d.createElement('script');
        c.type='text/javascript';c.charset='utf-8';c.async=true;
        c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
    })(document);
</script>
<noscript> Powered by <a href=“https://www.smartsupp.com” target=“_blank”>Smartsupp</a></noscript>
</body>
</html>
