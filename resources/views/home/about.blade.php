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

    <!-- about-style-two -->
    <section class="about-style-two sec-pad">
        <div class="auto-container">
            <div class="sec-title centred mb_60">
                <span class="sub-title">About {{ $siteName }}</span>
                <h2>Committed to Excellence in Banking Services</h2>
            </div>
            <div class="row clearfix">
                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <div class="image_block_two">
                        <div class="image-box mr_30">
                            <figure class="image"><img src="{{ asset('home/images/resource/about-3.jpg') }}" alt="About {{ $siteName }}"></figure>
                            <div class="image-content">
                                <h2>20</h2>
                                <h3>Years of Trusted Banking Experience</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="content_block_five">
                        <div class="content-box ml_30">
                            <div class="text mb_30">
                                <p>At {{ $siteName }}, we have been dedicated to providing exceptional banking services for over two decades.
                                    Our commitment to innovation, customer satisfaction, and community engagement has established us as a trusted financial partner.</p>
                                <p>
                                    At {{ $siteName }}, our mission is to deliver unparalleled banking services that empower our clients to achieve their financial goals. With over 20 years of experience, we have consistently prioritized innovation, customer satisfaction, and community engagement, establishing ourselves as a trusted financial partner.
                                </p>
                                <p>
                                    We aim to provide comprehensive financial solutions that cater to the diverse needs of our clients. By understanding individual and business financial aspirations, we tailor our services to ensure optimal outcomes.
                                </p>
                                <p>

                                </p>
                            </div>
                            <div class="inner-box mb_30">
                                <div class="single-item">
                                    <div class="icon-box"><i class="icon-11"></i></div>
                                    <h3>Solution-Focused Approach</h3>
                                    <p>We prioritize understanding your unique financial needs to offer tailored solutions that drive success.</p>
                                </div>
                                <div class="single-item">
                                    <div class="icon-box"><i class="icon-11"></i></div>
                                    <h3>99.99% Success Rate</h3>
                                    <p>Our proven track record reflects our unwavering commitment to excellence and reliability in all our services.</p>
                                </div>
                            </div>
                            <figure class="signature"><img src="{{ asset('home/images/icons/signature-1.png') }}" alt="Signature"></figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about-style-two end -->

@endsection
