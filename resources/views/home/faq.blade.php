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


    <!--
    =====================================================
        FAQ Section
    =====================================================
    -->
    <div class="faq-section-one bg-four position-relative z-1 pt-150 lg-pt-80 pb-120 lg-pb-60 border-30 mb-30 lg-mb-20 mt-30 lg-mt-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="accordion accordion-style-one" id="accordionOne">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    What is this platform?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionOne">
                                <div class="accordion-body">
                                    <p class="fs-22">
                                        Our platform provides <strong>secure, fast, and seamless financial services</strong>, including virtual debit cards, global money transfers, and multi-currency accounts.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    How do I create an account?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionOne">
                                <div class="accordion-body">
                                    <p class="fs-22">
                                        Creating an account is simple. Click on the <strong>"Sign Up"</strong> button, provide your details, verify your identity, and start using our services in minutes.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                    What are the available payment methods?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionOne">
                                <div class="accordion-body">
                                    <p class="fs-22">
                                        You can fund your account using <strong>bank transfers, credit/debit cards, cryptocurrency, and gift cards</strong>. Withdrawals can be made directly to your bank or linked e-wallets.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                    Are there any transaction fees?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionOne">
                                <div class="accordion-body">
                                    <p class="fs-22">
                                        We offer <strong>low transaction fees</strong>. You can check our detailed fee structure on our <a href="pricing.html"><strong>pricing page</strong></a>.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                    Is my money safe with this platform?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionOne">
                                <div class="accordion-body">
                                    <p class="fs-22">
                                        Yes. We use <strong>bank-grade security, two-factor authentication (2FA), and encrypted transactions</strong> to keep your money and data safe.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Second Column -->
                <div class="col-lg-6">
                    <div class="accordion accordion-style-one" id="accordionTwo">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAOne" aria-expanded="false" aria-controls="collapseAOne">
                                    Can I withdraw money from my virtual card?
                                </button>
                            </h2>
                            <div id="collapseAOne" class="accordion-collapse collapse" data-bs-parent="#accordionTwo">
                                <div class="accordion-body">
                                    <p class="fs-22">
                                        Yes, you can withdraw funds from your virtual card directly to your <strong>linked bank account or e-wallet</strong>.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseATwo" aria-expanded="false" aria-controls="collapseATwo">
                                    How do I activate my virtual debit card?
                                </button>
                            </h2>
                            <div id="collapseATwo" class="accordion-collapse collapse" data-bs-parent="#accordionTwo">
                                <div class="accordion-body">
                                    <p class="fs-22">
                                        After ordering your card, go to your account dashboard and select <strong>"Activate Card"</strong>. Follow the instructions to complete activation.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAThree" aria-expanded="true" aria-controls="collapseAThree">
                                    How can I contact customer support?
                                </button>
                            </h2>
                            <div id="collapseAThree" class="accordion-collapse collapse" data-bs-parent="#accordionTwo">
                                <div class="accordion-body">
                                    <p class="fs-22">
                                        Our <strong>24/7 customer support</strong> is available via <strong>live chat, email, and phone</strong>. Visit our <a href="contact-v1.html"><strong>Contact Us</strong></a> page for more details.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAFour" aria-expanded="true" aria-controls="collapseAFour">
                                    Can I link external bank accounts?
                                </button>
                            </h2>
                            <div id="collapseAFour" class="accordion-collapse collapse" data-bs-parent="#accordionTwo">
                                <div class="accordion-body">
                                    <p class="fs-22">
                                        Yes, you can link external bank accounts for <strong>funding and withdrawals</strong> within your account settings.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact CTA -->
            <div class="text-center mt-60 lg-mt-40">
                <h4 class="mb-35">Didn’t find the answer you were looking for?</h4>
                <a href="{{ route('home.contact') }}" class="btn-two xl">Contact Us</a>
            </div>
        </div>
    </div>

@endsection
