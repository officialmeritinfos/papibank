@extends('user.base')
@section('content')

    <div class="container my-5  pd-top-40 mg-top-50">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-lg border-0">
                    <div class="card-body text-center p-5">
                        <!-- Icon -->
                        <div class="mb-4">
                            <i class="bx bx-credit-card-front text-primary" style="font-size: 50px;"></i>
                        </div>

                        <!-- Title & Description -->
                        <h2 class="fw-bold">Virtual Debit Card</h2>
                        <p class="text-muted lead">
                            Secure and flexible digital payment card designed for online transactions.
                        </p>

                        <!-- Card Content -->
                        <div class="mt-4">
                            <p class="text-muted">
                                <strong>Florida Capital Bank</strong> Virtual Debit Card is a digital payment card designed for
                                frequent online shoppers, providing a <strong>secure</strong> and <strong>flexible</strong> alternative to physical cards.
                                The virtual card is <strong>instantly issued upon request</strong>
                            </p>
                        </div>

                        <!-- Request Button -->
                        <a href="{{ route('card.virtual-card.request') }}" class="btn btn-primary btn-lg px-4 mt-3">
                            <i class="fas fa-plus-circle"></i> Request a New Virtual Card
                        </a>

                        <!-- Contact Support -->
                        <div class="mt-4">
                            <p class="text-muted">
                                Have any questions? Contact our support team at
                                <a href="mailto:{{$web->email}}" class="fw-bold text-primary">{{$web->email}}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
