<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    @stack('css')
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{asset('home/images/'.$web->logo)}}">
    <!-- Title -->
    <title>{{$pageName}} - {{$siteName}}</title>

    <!-- Stylesheet File -->
    <link rel="stylesheet" href="{{ asset('dashboard/client/css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/client/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/client/css/responsive.css') }}">
</head>

<body>

<!-- preloader area start -->
<div class="preloader" id="preloader">
    <div class="preloader-inner">
        <div class="spinner">
            <div class="dot1"></div>
            <div class="dot2"></div>
        </div>
    </div>
</div>
<!-- preloader area end -->


<!-- header start -->
<div class="header-area" style="background-image: url({{ asset('dashboard/client/img/bg/1.png') }});">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-3">
                <div class="menu-bar">
                    <i class="fa fa-bars"></i>
                </div>
            </div>
            <div class="col-sm-4 col-4 text-center">
                <a href="{{url('account/dashboard')}}" class="logo">
                    <img src="{{asset('home/images/'.$web->logo)}}" alt="logo" style="width: 100px;">
                </a>
            </div>
            <div class="col-sm-4 col-5 text-right">
                <ul class="header-right">
                    <li>
                        <a class="header-user" href="{{url('account/settings')}}">
                            <img src="{{empty($user->profile_picture)?'https://ui-avatars.com/api/?name='.$user->name:asset($user->profile_picture)}}"
                                 alt="img" class="rounded-circle" style="width: 50px;">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- header end -->

<!-- navbar end -->
<div class="ba-navbar">
    <div class="ba-navbar-user">
        <div class="menu-close">
            <i class="la la-times"></i>
        </div>
        <div class="thumb">
            <img src="{{empty($user->profile_picture)?'https://ui-avatars.com/api/?name='.$user->name:asset($user->profile_picture)}}"
                 style="width: 50px;" alt="user">
        </div>
        <div class="details">
            <h5>{{ $user->first_name.' '.$user->last_name }}</h5>
            <p>Account Number: {{ $user->account_number }}</p>
        </div>
    </div>
    <div class="ba-add-balance-title">
        <h5>Balance</h5>
        <p>{{ $user->account_currency }} {{ number_format($user->balance,2) }}</p>
    </div>
    <div class="ba-add-balance-title style-two">
        <h5>Deposit</h5>
        <a href="{{ route('deposit.index') }}">
            <i class="fa fa-plus"></i>
        </a>
    </div>
    <div class="ba-main-menu">
        <h5>Menu</h5>
        <ul>
            <li><a href="{{ route('user.dashboard') }}">Overview</a></li>
            <li><a href="{{ route('account.summary') }}">Account Summary</a></li>
            <li><a href="{{ route('transfer.index') }}">Transfer</a></li>
            <li><a href="{{ route('deposit.index') }}">Deposit</a></li>
            <li><a href="{{ route('bill.index') }}">Pay Bills</a></li>
            <li><a href="{{ route('card.virtual-card') }}">Virtual Cards</a></li>
            <li><a href="{{route('card.link-external-card')}}">Link External card</a></li>
            <li><a href="{{route('wallet.link-external-wallet')}}">Link External Wallet</a></li>
            <li><a href="{{url('account/settings')}}">Account Settings </a></li>
            <li><a href="{{ route('loan.index') }}">United Nations Assistance Program </a></li>
        </ul>
        <a class="btn btn-purple" href="{{ url('account/logout') }}">Logout</a>
    </div>
</div>
<!-- navbar end -->
<div class="mb-4 mt-5 pd-top-40 mg-top-50">
    @include('templates.notification')
</div>
@yield('content')

<!-- Footer Area -->
<div class="footer-area">
    <div class="footer-top text-center" style="background-image: url({{ asset('dashboard/client/img/bg/7.png') }});">
        <div class="container">
            <p>Copyright © {{ $siteName }} {{ date('Y') }}. All Rights Reserved.</p>
        </div>
    </div>
    <div class="container">
        <div class="footer-bottom text-center">
            <ul>
                <li>
                    <a href="{{ route('user.dashboard') }}">
                        <i class="fa fa-home"></i>
                        <p>Home</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('transfer.index') }}">
                        <i class="fa fa-send"></i>
                        <p>Transfer</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('deposit.index') }}">
                        <i class="fa fa-plus"></i>
                        <p>Deposit</p>
                    </a>
                </li>
                <li>
                    <a class="menu-bar" href="#">
                        <i class="fa fa-bars"></i>
                        <p>Menu</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('account.summary') }}">
                        <i class="fa fa-file-image-o"></i>
                        <p> Summary</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- back to top area start -->
<div class="back-to-top">
    <span class="back-top"><i class="fa fa-angle-up"></i></span>
</div>
<!-- back to top area end -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- All Js File here -->
<script src="{{ asset('dashboard/client/js/vendor.js') }}"></script>
<script src="{{ asset('dashboard/client/js/main.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.10/dist/clipboard.min.js"></script>
<script>
    new ClipboardJS('.copy');
</script>
@stack('js')


<!-- Google language start -->
<style>

    #google_translate_element {
        z-index: 9999999;
        position: fixed;
        bottom: 25px;
        left: 15px;
    }

    .goog-te-gadget {
        font-family: Roboto, "Open Sans", sans-serif !important;
        text-transform: uppercase;
    }
    .goog-te-gadget-simple
    {
        padding: 0px !important;
        line-height: 1.428571429;
        color: white;
        vertical-align: middle;
        background-color: black;
        border: 1px solid #a5a5a599;
        border-radius: 4px;
        float: right;
        margin-top: -4px;
        z-index: 999999;
    }
    .goog-te-banner-frame.skiptranslate
    {
        display: none !important;
        color: white;
    }
    .goog-te-gadget-icon
    {
        background: none !important;
        display: none;
        color: white;
    }
    .goog-te-gadget-simple .goog-te-menu-value
    {
        font-size: 12px;
        color: white;
        font-family: 'Open Sans' , sans-serif;
    }
</style>
<div id="google_translate_element"></div>
<script type="text/javascript">
    window.onload = function googleTranslateElementInit() {
        new google.translate.TranslateElement({ pageLanguage: 'en' }, 'google_translate_element');
    }
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

</body>
</html>
