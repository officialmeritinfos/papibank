@extends('user.base')
@section('content')
    @push('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    @endpush
    <div class="container my-5  pd-top-40 mg-top-50">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12">
                <div class="card shadow-lg border-0">
                    <div class="card-body ">
                        @include('templates.notification')
                        <!-- Title & Description -->
                        <h2 class="text-center fw-bold">Visual Card Application</h2>
                        <p class="text-center text-muted">Your virtual card will be issued instantly upon approval.</p>
                        <hr>

                        <!-- Form Start -->
                        <form action="{{ route('card.virtual-card.request.process') }}" method="POST">
                            @csrf

                            <!-- Personal Details -->
                            <h5 class="fw-bold mt-4">Personal Details</h5>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Card Holder Name</label>
                                    <input type="text" class="form-control" name="fullname" value="{{ $user->first_name.' '.$user->last_name }}" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" name="phone" value="{{ auth()->user()->phone }}" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" readonly>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control" name="address" value="{{ auth()->user()->street_address }}" readonly>
                                </div>
                            </div>

                            <!-- Security Question -->
                            <h5 class="fw-bold mt-4">Security Question</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Select Question</label>
                                    <select class="form-control" name="question" required>
                                        <option value="">Choose a question...</option>
                                        <option value="What is your pet name?">What is your pet name?</option>
                                        <option value="What is the name of your first car?">What is the name of your first car?</option>
                                        <option value="Your favorite music?">Your favorite music?</option>
                                        <option value="Favorite state?">Favorite state?</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Answer</label>
                                    <input type="text" class="form-control" name="answer" required>
                                </div>
                            </div>

                            <!-- Card Preference -->
                            <h5 class="fw-bold mt-4">Card Preference</h5>
                            <div class="mb-3">
                                <p>Select your preferred card type:</p>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="radio" class="btn-check" name="card_type" value="Visa Card" id="visa" required>
                                    <label class="btn btn-outline-primary w-100 mb-2" for="visa">
                                        <i class="fab fa-cc-visa"></i> Visa Card
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <input type="radio" class="btn-check" name="card_type" value="Master Card" id="mastercard">
                                    <label class="btn btn-outline-danger w-100 mb-2" for="mastercard">
                                        <i class="fab fa-cc-mastercard"></i> Master Card
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <input type="radio" class="btn-check" name="card_type" value="China Union Pay" id="unionpay">
                                    <label class="btn btn-outline-warning w-100 mb-2" for="unionpay">
                                        <i class="fas fa-credit-card"></i> China Union Pay
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <input type="radio" class="btn-check" name="card_type" value="Dollar Card" id="dollarcard">
                                    <label class="btn btn-outline-success w-100" for="dollarcard">
                                        <i class="fas fa-dollar-sign"></i> Dollar Card
                                    </label>
                                </div>
                            </div>

                            <!-- Terms & Conditions -->
                            <div class="mt-3">
                                <input type="checkbox" required> I agree to the Terms & Conditions and Privacy Policy
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary btn-lg">Apply Now</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
