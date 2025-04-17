@extends('home.base')
@section('content')

    <!-- banner-style-two -->
    <section class="banner-style-two p_relative centred">
        <div class="banner-carousel owl-theme owl-carousel owl-dots-none">
            <div class="slide-item p_relative">
                <div class="image-layer p_absolute" style="background-image:url({{ asset('home/images/banner/banner-6.jpg') }})"></div>
                <div class="auto-container">
                    <div class="content-box">
                        <span>Personalized Banking Solutions</span>
                        <h2>Secure Your Financial Future with {{ $siteName }}</h2>
                        <p>Experience tailored financial services designed to help you achieve your goals. Trust and innovation at the heart of everything we do.</p>
                        <div class="btn-box">
                            <a href="{{ route('register') }}" class="theme-btn-one">Create an Account</a>
                            <a href="{{ route('login') }}" class="theme-btn-one mt-2">Login</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slide-item p_relative">
                <div class="image-layer p_absolute" style="background-image:url({{ asset('home/images/banner/banner-7.jpg') }})"></div>
                <div class="auto-container">
                    <div class="content-box">
                        <span>Committed to Your Success</span>
                        <h2>Partnering with You for a Prosperous Tomorrow</h2>
                        <p>At {{ $siteName }}, we provide comprehensive financial solutions with a personal touch, ensuring your success every step of the way.</p>
                        <div class="btn-box">
                            <a href="{{ route('register') }}" class="theme-btn-one">Create an Account</a>
                            <a href="{{ route('login') }}" class="theme-btn-one mt-2">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner-style-two end -->



    <!-- feature-style-two -->
    <section class="feature-style-two bg-color-2 pt_150 pb_150">
        <div class="pattern-layer">
            <div class="pattern-1" style="background-image: url({{ asset('home/images/shape/shape-22.png') }});"></div>
            <div class="pattern-2" style="background-image: url({{ asset('home/images/shape/shape-23.png') }});"></div>
        </div>
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-6 col-sm-12 title-column">
                    <div class="sec-title light pr_100">
                        <span class="sub-title">Features</span>
                        <h2>Innovative and Customer-Centric Banking Solutions</h2>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                    <div class="feature-block-two mt_50 wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-7"></i></div>
                            <h3><a href="#">Personalized Financial Planning</a></h3>
                            <p>Receive tailored financial advice and strategies to meet your unique goals and aspirations.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                    <div class="feature-block-two mt_50 wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-9"></i></div>
                            <h3><a href="#">Advanced Business Intelligence</a></h3>
                            <p>Leverage data-driven insights to optimize your business operations and drive growth effectively.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- feature-style-two -->



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
                                <p>At {{ $siteName }}, we have been dedicated to providing exceptional banking services for over two decades. Our commitment to innovation, customer satisfaction, and community engagement has established us as a trusted financial partner.</p>
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



    <!-- testimonial-style-two -->
    <section class="testimonial-style-two p_relative">
        <div class="auto-container">
            <div class="sec-title mb_50 centred">
                <span class="sub-title">Testimonials</span>
                <h2>What They’re Saying <br />About Us</h2>
            </div>
            <div class="three-item-carousel owl-carousel owl-theme owl-dots-one owl-nav-none">
                <!-- Testimonial 1 -->
                <div class="testimonial-block-two">
                    <figure class="thumb-box">
                        <img src="https://ui-avatars.com/api/?name=Emily+Johnson" alt="Emily Johnson">
                    </figure>
                    <div class="inner-box">
                        <h3>Emily Johnson</h3>
                        <span class="designation">Financial Analyst</span>
                        <p>“The services provided by {{ $siteName }} have been exceptional. Their team is knowledgeable and always ready to assist with any queries.”</p>
                        <ul class="rating clearfix">
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                        </ul>
                    </div>
                </div>
                <!-- Testimonial 2 -->
                <div class="testimonial-block-two">
                    <figure class="thumb-box">
                        <img src="https://ui-avatars.com/api/?name=James+Smith" alt="James Smith">
                    </figure>
                    <div class="inner-box">
                        <h3>James Smith</h3>
                        <span class="designation">Entrepreneur</span>
                        <p>“Partnering with {{ $siteName }} has significantly improved our financial operations. Their innovative solutions are top-notch.”</p>
                        <ul class="rating clearfix">
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="far fa-star"></i></li>
                        </ul>
                    </div>
                </div>
                <!-- Testimonial 3 -->
                <div class="testimonial-block-two">
                    <figure class="thumb-box">
                        <img src="https://ui-avatars.com/api/?name=Olivia+Williams" alt="Olivia Williams">
                    </figure>
                    <div class="inner-box">
                        <h3>Olivia Williams</h3>
                        <span class="designation">Marketing Director</span>
                        <p>“I appreciate the personalized approach of {{ $siteName }}. They understand our needs and provide tailored solutions.”</p>
                        <ul class="rating clearfix">
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="far fa-star"></i></li>
                        </ul>
                    </div>
                </div>
                <!-- Testimonial 4 -->
                <div class="testimonial-block-two">
                    <figure class="thumb-box">
                        <img src="https://ui-avatars.com/api/?name=Lucas+Müller" alt="Lucas Müller">
                    </figure>
                    <div class="inner-box">
                        <h3>Lucas Müller</h3>
                        <span class="designation">Business Consultant</span>
                        <p>“The expertise and professionalism of {{ $siteName }} have been instrumental in our company's growth.”</p>
                        <ul class="rating clearfix">
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="far fa-star"></i></li>
                        </ul>
                    </div>
                </div>
                <!-- Testimonial 5 -->
                <div class="testimonial-block-two">
                    <figure class="thumb-box">
                        <img src="https://ui-avatars.com/api/?name=Isabella+Garcia" alt="Isabella Garcia">
                    </figure>
                    <div class="inner-box">
                        <h3>Isabella Garcia</h3>
                        <span class="designation">Project Manager</span>
                        <p>“Working with {{ $siteName }} has been a game-changer for us. Their insights and support are invaluable.”</p>
                        <ul class="rating clearfix">
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="far fa-star"></i></li>
                        </ul>
                    </div>
                </div>
                <!-- Testimonial 6 -->
                <div class="testimonial-block-two">
                    <figure class="thumb-box">
                        <img src="https://ui-avatars.com/api/?name=Noah+Dubois" alt="Noah Dubois">
                    </figure>
                    <div class="inner-box">
                        <h3>Noah Dubois</h3>
                        <span class="designation">IT Specialist</span>
                        <p>“{{ $siteName }} offers reliable and efficient services that have streamlined our processes remarkably.”</p>
                        <ul class="rating clearfix">
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="far fa-star"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- testimonial-style-two end -->



    <!-- chooseus-style-two -->
    <section class="chooseus-style-two sec-pad">
        <div class="bg-layer parallax-bg" data-parallax='{"y": 100}' style="background-image: url({{ asset('home/images/background/chooseus-bg-2.jpg') }});"></div>
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-xl-6 col-lg-12 offset-xl-6 content-column">
                    <div class="content_block_six">
                        <div class="content-box p_relative ml_30">
                            <div class="sec-title mb_50">
                                <span class="sub-title">Why Choose {{ $siteName }}</span>
                                <h2>Reasons for Choosing Our Bank</h2>
                            </div>
                            <ul class="accordion-box">
                                <li class="accordion block active-block">
                                    <div class="acc-btn active">
                                        <div class="icon-box"></div>
                                        <h3>Personalized Financial Solutions</h3>
                                    </div>
                                    <div class="acc-content current">
                                        <div class="text">
                                            <p>At {{ $siteName }}, we understand that each customer has unique financial goals. Our experienced consultants work closely with you to tailor solutions that align with your individual needs, ensuring a personalized banking experience.</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="accordion block">
                                    <div class="acc-btn">
                                        <div class="icon-box"></div>
                                        <h3>Competitive Interest Rates</h3>
                                    </div>
                                    <div class="acc-content">
                                        <div class="text">
                                            <p>We offer attractive interest rates on savings accounts and loans, helping you maximize your earnings and minimize borrowing costs. Our commitment is to provide value-driven financial products that support your financial well-being.</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="accordion block">
                                    <div class="acc-btn">
                                        <div class="icon-box"></div>
                                        <h3>Comprehensive Digital Banking</h3>
                                    </div>
                                    <div class="acc-content">
                                        <div class="text">
                                            <p>Our state-of-the-art digital banking platform offers seamless access to your accounts, enabling you to manage your finances anytime, anywhere. With robust security measures, you can trust that your information is protected.</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="accordion block">
                                    <div class="acc-btn">
                                        <div class="icon-box"></div>
                                        <h3>Community-Centric Approach</h3>
                                    </div>
                                    <div class="acc-content">
                                        <div class="text">
                                            <p>{{ $siteName }} is deeply invested in the communities we serve. We actively participate in local initiatives and support economic development, reflecting our commitment to social responsibility and ethical banking practices.</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="accordion block">
                                    <div class="acc-btn">
                                        <div class="icon-box"></div>
                                        <h3>Transparent Fee Structure</h3>
                                    </div>
                                    <div class="acc-content">
                                        <div class="text">
                                            <p>Transparency is at the core of our operations. We maintain a clear and straightforward fee structure, ensuring you are fully informed about any charges, thereby building trust and fostering long-term relationships.</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- chooseus-style-two end -->


@endsection
