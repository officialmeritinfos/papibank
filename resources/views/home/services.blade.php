@extends('home.base')
@section('content')

    <!-- page-title -->
    <section class="page-title centred">
        <div class="bg-layer" style="background-image: url({{asset('home/images/background/page-title.jpg')}});"></div>
        <div class="auto-container">
            <div class="content-box">
                <h1>{{ $pageName }}</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>{{ $pageName }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- page-title end -->

    <!-- service-style-two -->
    <section class="service-style-two p_relative bg-color-1">
        <div class="auto-container">
            <div class="sec-title centred mb_50">
                <span class="sub-title">Our Services</span>
                <h2>Comprehensive Financial Solutions Tailored for You</h2>
            </div>
            <div class="row clearfix">
                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-two wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <figure class="image-box"><img src="{{ asset('home/images/service/service-1.jpg') }}" alt=""></figure>
                            <div class="lower-content">
                                <div class="inner">
                                    <div class="icon-box"><i class="icon-7"></i></div>
                                    <h3><a href="#">Strategy & Planning</a></h3>
                                    <p>
                                        Comprehensive financial planning services assist clients in developing strategies
                                        to achieve their financial goals, including retirement planning, investment strategies, and risk management.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-two wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <figure class="image-box"><img src="{{ asset('home/images/service/service-2.jpg') }}" alt=""></figure>
                            <div class="lower-content">
                                <div class="inner">
                                    <div class="icon-box"><i class="icon-12"></i></div>
                                    <h3><a href="#">Program Manager</a></h3>
                                    <p>
                                        Effective management of financial programs ensures that projects are completed on time and within budget, aligning with the institution's strategic objectives.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-two wow fadeInUp animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <figure class="image-box"><img src="{{ asset('home/images/service/service-3.jpg') }}" alt=""></figure>
                            <div class="lower-content">
                                <div class="inner">
                                    <div class="icon-box"><i class="icon-8"></i></div>
                                    <h3><a href="#">Tax Management</a></h3>
                                    <p>
                                        Expert tax services help clients navigate complex tax regulations, optimize tax liabilities, and ensure compliance with local and international tax laws.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-two wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <figure class="image-box"><img src="{{ asset('home/images/service/service-4.jpg') }}" alt=""></figure>
                            <div class="lower-content">
                                <div class="inner">
                                    <div class="icon-box"><i class="icon-13"></i></div>
                                    <h3><a href="#">Investment Policy</a></h3>
                                    <p>
                                        Tailored investment policies guide clients in making informed decisions about asset allocation, portfolio management, and investment strategies to maximize returns while managing risk.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-two wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <figure class="image-box"><img src="{{ asset('home/images/service/service-5.jpg') }}" alt=""></figure>
                            <div class="lower-content">
                                <div class="inner">
                                    <div class="icon-box"><i class="icon-14"></i></div>
                                    <h3><a href="#">Financial Advices</a></h3>
                                    <p>
                                        Personalized financial advice supports clients in making informed decisions about
                                        savings, investments, and financial planning, contributing to long-term financial health.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-two wow fadeInUp animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <figure class="image-box"><img src="{{ asset('home/images/service/service-6.jpg') }}" alt=""></figure>
                            <div class="lower-content">
                                <div class="inner">
                                    <div class="icon-box"><i class="icon-15"></i></div>
                                    <h3><a href="#">Insurance Strategy</a></h3>
                                    <p>
                                        Customized insurance solutions protect clients' assets and income, providing peace
                                        of mind through risk management and financial security.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- service-style-two end -->

@endsection
