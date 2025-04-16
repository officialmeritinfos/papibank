<!doctype html>
<html lang="zxx">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap Min CSS -->
    <link rel="stylesheet" href="{{asset('dashboard/user/css/bootstrap.min.css')}}">
    <!-- Owl Theme Default Min CSS -->
    <link rel="stylesheet" href="{{asset('dashboard/user/css/owl.theme.default.min.css')}}">
    <!-- Owl Carousel Min CSS -->
    <link rel="stylesheet" href="{{asset('dashboard/user/css/owl.carousel.min.css')}}">
    <!-- Animate Min CSS -->
    <link rel="stylesheet" href="{{asset('dashboard/user/css/animate.min.css')}}">
    <!-- Remixicon CSS -->
    <link rel="stylesheet" href="{{asset('dashboard/user/css/remixicon.css')}}">
    <!-- boxicons CSS -->
    <link rel="stylesheet" href="{{asset('dashboard/user/css/boxicons.min.css')}}">
    <!-- MetisMenu Min CSS -->
    <link rel="stylesheet" href="{{asset('dashboard/user/css/metismenu.min.css')}}">
    <!-- Simplebar Min CSS -->
    <link rel="stylesheet" href="{{asset('dashboard/user/css/simplebar.min.css')}}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{asset('dashboard/user/css/style.css')}}">
    <!-- Dark Mode CSS -->
    <link rel="stylesheet" href="{{asset('dashboard/user/css/dark-mode.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('dashboard/user/css/responsive.css')}}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{asset('home/images/'.$web->logo)}}">
    <title>{{$pageName}} - {{$siteName}}</title>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body class="body-bg-f5f5f5">
<!-- Start Preloader Area -->
<div class="preloader">
    <div class="content">
        <div class="box"></div>
    </div>
</div>
<!-- End Preloader Area -->

<!-- Start User Area -->
<section class="user-area">
    <div class="container">
        <div class="user-form-content">
            <h3>Register</h3>
            <p>Register to continue to {{$siteName}}.</p>

            <form class="user-form" method="post" action="{{route('auth.register')}}" enctype="multipart/form-data" id="registerForm">
                @include('templates.notification')
                @csrf

                <h4 class="section-title"><i class="fas fa-user mr-2"></i> Personal Details</h4>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>First Name</label>
                            <input class="form-control" type="text" name="first_name" value="{{old('first_name')}}" placeholder="Enter your first name">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input class="form-control" type="text" name="last_name" value="{{old('last_name')}}" placeholder="Enter your last name">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Username(This is for signing-in to your account)</label>
                            <input class="form-control" type="text" name="username" value="{{old('username')}}" placeholder="Enter your username">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Email(This is for receiving mails from the Bank)</label>
                            <input class="form-control" type="email" name="email" value="{{old('email')}}" placeholder="Enter your email">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Phone</label>
                            <input class="form-control" type="text" name="phone" value="{{old('phone')}}" placeholder="Enter your phone number">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input class="form-control" type="date" name="dob" value="{{old('dob')}}">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Gender</label>
                            <select class="form-control" name="gender">
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                                <option value="Other">Others</option>
                            </select>
                        </div>
                    </div>
                </div>

                <h4 class="section-title"><i class="fas fa-key mr-2"></i> Security</h4>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control" type="text" name="password" placeholder="Enter your password">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input class="form-control" type="text" name="password_confirmation" placeholder="Repeat your password">
                        </div>
                    </div>
                </div>

                <h4 class="section-title"><i class="fas fa-briefcase mr-2"></i> Employment Information</h4>
                <div class="form-group">
                    <label>Occupation</label>
                    <select class="form-control" name="occupation">
                        <option value="Self Employed">Self Employed</option>
                        <option value="Public/Government Office">Public/Government Office</option>
                        <option value="Private/Partnership Office">Private/Partnership Office</option>
                        <option value="Business/Sales">Business/Sales</option>
                        <option value="Trading/Market">Trading/Market</option>
                        <option value="Military/Paramilitary">Military/Paramilitary</option>
                        <option value="Politician/Celebrity">Politician/Celebrity</option>
                    </select>
                </div>

                <h4 class="section-title"><i class="fas fa-map-marked-alt mr-2"></i> Address Information</h4>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Country</label>

                            <select class="form-control" name="country" >
                                @foreach($countries as $country)
                                    <option value="{{ $country->iso2 }}">{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>State</label>
                            <input class="form-control" type="text" name="state" value="{{old('state')}}" placeholder="Enter your state">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>City</label>
                            <input class="form-control" type="text" name="city" value="{{old('city')}}" placeholder="Enter your city">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Postal Code</label>
                            <input class="form-control" type="text" name="postal_code" value="{{old('postal_code')}}" placeholder="Enter your postal code">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Street Address</label>
                            <textarea class="form-control" type="text" name="street_address"  placeholder="Enter your street address">{{old('street_address')}}</textarea>
                        </div>
                    </div>
                </div>

                <h4 class="section-title"><i class="fas fa-piggy-bank mr-2"></i> Banking Details</h4>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Account Type</label>
                            <select class="form-control" name="account_type">
                                <option value="Savings Account">Savings Account</option>
                                <option value="Current Account">Current Account</option>
                                <option value="Crypto Currency Account">Crypto Currency Account</option>
                                <option value="Investment Account">Investment Account</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Account Currency</label>
                            <select class="form-control" name="account_currency" >
                                @foreach($currencies as $currency)
                                    <option value="{{ $currency->currency }}">{{$currency->currency}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <h4 class="section-title"><i class="fas fa-camera mr-2"></i> Upload ID Photograph</h4>
                <div class="form-group">
                    <input type="file" class="form-control" name="picture" accept="image/*" required>
                </div>

                <div class="row">

                    <div class="col-md-12">

                        <div class="form-group">

                            <strong>ReCaptcha:</strong>

                            <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>

                            @if ($errors->has('g-recaptcha-response'))

                                <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>

                            @endif

                        </div>

                    </div>

                </div>

                <div class="col-12">
                    <button class="default-btn register" type="submit">Sign up</button>
                </div>
                <div class="col-12">
                    <p class="create">Already have an account? <a href="{{route('login')}}">Sign in</a></p>
                </div>
            </form>

        </div>
    </div>
</section>
<!-- End User Area -->

<div class="dark-bar">
    <a href="#" class="d-flex align-items-center">
        <span class="dark-title">Enable Dark Theme</span>
    </a>

    <div class="form-check form-switch">
        <input type="checkbox" class="checkbox" id="darkSwitch">
    </div>
</div>

<!-- Start Go Top Area -->
<div class="go-top">
    <i class="ri-arrow-up-s-fill"></i>
    <i class="ri-arrow-up-s-fill"></i>
</div>
<!-- End Go Top Area -->

<!-- Jquery Min JS -->
<script src="{{asset('dashboard/user/js/jquery.min.js')}}"></script>
<!-- Bootstrap Bundle Min JS -->
<script src="{{asset('dashboard/user/js/bootstrap.bundle.min.js')}}"></script>
<!-- Owl Carousel Min JS -->
<script src="{{asset('dashboard/user/js/owl.carousel.min.js')}}"></script>
<!-- Metismenu Min JS -->
<script src="{{asset('dashboard/user/js/metismenu.min.js')}}"></script>
<!-- Simplebar Min JS -->
<script src="{{asset('dashboard/user/js/simplebar.min.js')}}"></script>
<!-- mixitup Min JS -->
<script src="{{asset('dashboard/user/js/mixitup.min.js')}}"></script>
<!-- Dark Mode Switch Min JS -->
<script src="{{asset('dashboard/user/js/dark-mode-switch.min.js')}}"></script>
<!-- Form Validator Min JS -->
<script src="{{asset('dashboard/user/js/form-validator.min.js')}}"></script>
<!-- Contact JS -->
<script src="{{asset('dashboard/user/js/contact-form-script.js')}}"></script>
<!-- Ajaxchimp Min JS -->
<script src="{{asset('dashboard/user/js/ajaxchimp.min.js')}}"></script>
<!-- Custom JS -->
<script src="{{asset('dashboard/user/js/custom.js')}}"></script>
</body>
</html>
