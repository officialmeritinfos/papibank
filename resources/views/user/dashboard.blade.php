@extends('user.base')
@section('content')
@inject('injected','App\Defaults\Custom')

<div class="container-fluid py-4">
    @include('templates.notification')
    <div class="row">
        <!-- Overview Section -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Overview</h5>
                </div>
                <div class="card-body text-center">
                    <img class="rounded-circle border border-white"
                         src="{{ asset('storage/'.$user->profile_picture) }}" width="100" height="100">
                    <h6 class="mt-3">Available Balance</h6>
                    <p class="fs-4 fw-bold">{{$user->account_currency}} {{number_format($user->balance,2)}}</p>
                    <p class="text-muted">{{ $user->first_name.' '.$user->last_name }}</p>
                </div>
            </div>
        </div>
        <!-- Current Account -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-secondary text-white d-flex justify-content-between">
                    <h5 class="mb-0">{{ $user->account_type }}</h5>
                    <a href="{{ route('transfer.index') }}" class="btn btn-sm btn-light">Transfer Fund</a>
                </div>
                <div class="card-body">
                    <p class="mb-1">Account Number</p>
                    <h5 class="fw-bold">{{ ($user->account_number) }}</h5>
                    <p class="fs-4 fw-bold">{{$user->account_currency}} {{number_format($user->balance,2)}}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Sections -->
    <div class="row mt-4">
        <div class="col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white d-flex justify-content-between">
                    <h6 class="mb-0">Loans and Credit</h6>
                    <a href="{{ route('bill.index') }}" class="btn btn-sm btn-light">Pay Bills</a>
                </div>
                <div class="card-body">
                    <p>Business Support Loan: <span class="fw-bold">{{$user->account_currency}} {{number_format($user->loan,2)}}</span></p>
                    <p>Credit Score: <span class="fw-bold">{{ $user->credit_score }}</span></p>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0">Recent Transactions</h6>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover text-center">
                        <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Transaction ID</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Details</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($transactions->count() > 0)
                            @foreach($transactions as $index => $transaction)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $transaction->created_at->format('F j, Y, g:i A') }}</td>
                                    <td>{{ $transaction->transaction_id }}</td>
                                    <td>
                                        @if($transaction->transaction_type === 'deposit')
                                            <span class="badge bg-success">Deposit</span>
                                        @else
                                            <span class="badge bg-danger">Withdrawal</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->account_currency }} {{ number_format($transaction->amount, 2) }}</td>
                                    <td>
                        <span class="status-badge status-{{ strtolower($transaction->status) }}">
                            {{ ucfirst($transaction->status) }}
                        </span>
                                    </td>
                                    <td>
                                        @if($transaction->transaction_type === 'withdrawal')
                                            <a href="{{ route('transfer.detail', $transaction->id) }}" class="btn btn-primary btn-sm">
                                                View Details
                                            </a>
                                        @else
                                            <a href="{{ route('deposit.detail', $transaction->id) }}" class="btn btn-secondary btn-sm">
                                                View Details
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-muted text-center">No transactions found.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Support Section -->
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <h5>We’re here to help you!</h5>
                    <p class="text-muted">Ask a question, report an issue, or request support. Our team will get back to you via email.</p>
                    <a href="{{ route('home.contact') }}" class="btn btn-lg btn-primary">Get Support Now</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
