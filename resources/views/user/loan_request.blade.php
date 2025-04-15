@extends('user.base')
@section('content')
    <div class="container">
        @include('templates.notification')
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="card-title text-center">Apply for United Nations Compensation and Support Grant</h4>
                            <a href="{{ route('loan.requests') }}" class="btn btn-outline-primary">
                                <em class="icon ni ni-list"></em> View Loan Requests
                            </a>
                        </div>

                        <form method="POST" action="{{ route('loan.request') }}">
                            @csrf

                            <!-- Grant Amount -->
                            <div class="mb-3">
                                <label class="form-label">Grant Amount</label>
                                <input type="number" name="amount" class="form-control" step="0.01" required placeholder="Enter Amount">
                                <small class="text-muted">Min: $15,000 | Max: $150,000</small>
                            </div>

                            <!-- Support Category -->
                            <div class="mb-3">
                                <label class="form-label">Support Category</label>
                                <select name="credit_facility" class="form-select" required>
                                    <option value="">Select Category</option>
                                    <option value="Disaster Recovery Support">Disaster Recovery Support</option>
                                    <option value="Healthcare Assistance Program">Healthcare Assistance Program</option>
                                    <option value="Infrastructure Development Grant">Infrastructure Development Grant</option>
                                    <option value="Education Support Fund">Education Support Fund</option>
                                    <option value="Small Business Aid">Small Business Aid</option>
                                </select>
                            </div>

                            <!-- Grant Period -->
                            <div class="mb-3">
                                <label class="form-label">Grant Period</label>
                                <select name="payment_tenure" class="form-select" required>
                                    <option value="6 Months">6 Months</option>
                                    <option value="12 Months">12 Months</option>
                                    <option value="2 Years">2 Years</option>
                                    <option value="5 Years">5 Years</option>
                                </select>
                            </div>

                            <!-- Purpose -->
                            <div class="mb-3">
                                <label class="form-label">Purpose</label>
                                <textarea name="reason" class="form-control" rows="3" required></textarea>
                            </div>

                            <!-- Terms & Conditions -->
                            <div class="mb-3">
                                <h6>Terms & Conditions</h6>
                                <ul class="list-unstyled">
                                    <li><i class="bi bi-check-circle-fill text-success"></i> No Interest</li>
                                    <li><i class="bi bi-check-circle-fill text-success"></i> No Management Fee</li>
                                    <li><i class="bi bi-check-circle-fill text-success"></i> No Penal Charges</li>
                                    <li><i class="bi bi-check-circle-fill text-success"></i> The UN reserves the right to decline requests</li>
                                </ul>
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit Request</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
