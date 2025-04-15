@extends('user.base')

@section('content')
    @push('css')
        <!-- FontAwesome CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    @endpush
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h2 class="fw-normal text-center">Your Loan Requests</h2>
                        <p class="text-center text-muted">See the full list of loan requests you have made so far.</p>

                        <div class="nk-block nk-block-sm">
                            <div class="tranx-list tranx-list-stretch card card-bordered">

                                @forelse ($loans as $loan)
                                    <div class="tranx-item d-flex justify-content-between align-items-center p-3 border-bottom">
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                @if($loan->status == 'approved')
                                                    <i class="fas fa-check-circle text-success" style="font-size: 40px;"></i>
                                                @elseif($loan->status == 'pending')
                                                    <i class="fas fa-exclamation-circle text-warning" style="font-size: 40px;"></i>
                                                @else
                                                    <i class="fas fa-info-circle text-primary" style="font-size: 40px;"></i>
                                                @endif
                                            </div>
                                            <div>
                                                <h5 class="mb-1">{{ $loan->credit_facility }}</h5>
                                                <small class="text-muted">Applied on: {{ $loan->created_at->format('M d, Y - h:i A') }}</small><br>
                                                <small class="text-muted">Tenure: {{ $loan->payment_tenure }}</small>
                                            </div>
                                        </div>

                                        <div class="text-end">
                                            <h5 class="mb-1">{{ number_format($loan->amount, 2) }} <span class="text-muted">{{ auth()->user()->account_currency }}</span></h5>
                                            <small class="text-muted">
                                                @if($loan->status == 'approved')
                                                    {{ number_format($loan->amount * 0.015, 2) }} <span class="text-muted">{{ auth()->user()->account_currency }}</span>/ Monthly Interest
                                                @else
                                                    No Interest Yet
                                                @endif
                                            </small><br>
                                            <small class="text-muted">Ref: {{ str_pad($loan->id, 7, '0', STR_PAD_LEFT) }}</small>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-center text-muted p-3">No loan requests found.</p>
                                @endforelse

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
