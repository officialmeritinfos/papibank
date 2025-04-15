@extends('user.base')
@section('content')
@inject('injected','App\Defaults\Custom')

<!-- balance start -->
<div class="balance-area pd-top-40 mg-top-50">
    <div class="container">
        <div class="balance-area-bg balance-area-bg-home">
            <div class="balance-title text-center">
                <h6>Welcome! <br> Dear {{ $user->name }} - {{ $siteName }} Wallet</h6>
            </div>
            <div class="ba-balance-inner text-center" style="background-image: url({{ asset('dashboard/client/img/bg/2.png') }});">
                <div class="icon">
                    <img src="{{ asset($user->profile_picture) }}" alt="img">
                </div>
                <h5 class="title">Account Type:</h5>
                <h6 class="mb-0">{{ $user->account_type }}</h6>
                <h5 class="mb-1 mt-3">Account Number</h5>
                <h6 class="fw-bold">{{ ($user->account_number) }}</h6>

                <h6 class="mt-3">Available Balance</h6>
                <h5 class="amount">{{ $user->account_currency }} {{ number_format($user->balance,2) }}</h5>
            </div>
        </div>
    </div>
</div>
<!-- balance End -->

<!-- add balance start -->
<div class="add-balance-area pd-top-40">
    <div class="container">
        <div class="ba-add-balance-title ba-add-balance-btn">
            <h5>Add Balance</h5>
            <a href="{{ route('deposit.index') }}">
                <i class="fa fa-plus"></i>
            </a>
        </div>
        <div class="ba-add-balance-inner mg-top-40">
            <div class="row custom-gutters-20">
                <div class="col-6">
                    <a class="btn btn-blue ba-add-balance-btn" href="{{ route('transfer.index') }}">Withdraw <i class="fa fa-arrow-down"></i></a>
                </div>
                <div class="col-6">
                    <a class="btn btn-red ba-add-balance-btn" href="{{ route('wallet.link-external-wallet') }}">Wallet Connect <i class="fa fa-arrow-right"></i></a>
                </div>
                <div class="col-6">
                    <a class="btn btn-purple ba-add-balance-btn" href="{{ route('card.virtual-card') }}">Cards <i class="fa fa-credit-card-alt "></i></a>
                </div>
                <div class="col-6">
                    <a class="btn btn-green ba-add-balance-btn" href="{{ route('loan.index') }}">Loan <i class="fa fa-arrow-down"></i></a>
                </div>
                <div class="col-6">
                    <a class="btn btn-purple ba-add-balance-btn" href="{{ route('bill.index') }}">Pay Bill <i class="fa fa-credit-card-alt "></i></a>
                </div>
                <div class="col-6">
                    <a class="btn btn-green ba-add-balance-btn" href="{{ route('account.summary') }}">Account Summary <i class="fa fa-arrow-down"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- add balance End -->



<!-- transaction start -->
<div class="transaction-area pd-top-40">
    <div class="container">
        <div class="section-title">
            <h3 class="title">Transactions</h3>
            <a href="{{ route('account.summary') }}">View All</a>
        </div>
        <ul class="transaction-inner">
            @if($transactions->count() > 0)
                @foreach($transactions as $index => $transaction)
                    <li class="ba-single-transaction">
                        <div class="thumb">
                            <img src="{{ asset('dashboard/client/img/icon/2.png') }}" alt="img">
                        </div>
                        <div class="details">
                            <h5>
                                @if($transaction->transaction_type === 'deposit')
                                    Deposit
                                @else
                                    Withdrawal
                                @endif
                            </h5>
                            <p>
                                {{ $transaction->transaction_id }}
                            </p>
                            <h5 class="amount">
                                @if($transaction->transaction_type === 'deposit')
                                    {{ $user->account_currency }} {{ number_format($transaction->amount, 2) }}
                                @else
                                    - {{ $user->account_currency }} {{ number_format($transaction->amount, 2) }}
                                @endif
                            </h5>
                        </div>
                    </li>
                @endforeach
            @endif

        </ul>
    </div>
</div>
<!-- transaction End -->

<!-- Support Section -->
<div class="row mt-4 mb-4">
    <div class="col-lg-12">
        <div class="card shadow-sm border-0 text-center">
            <div class="card-body">
                <h5>We’re here to help you!</h5>
                <p class="text-muted">Ask a question, report an issue, or request support. Our team will get back to you via email.</p>
                <a href="{{ route('home.contact') }}" class="btn btn-primary">Get Support Now</a>
            </div>
        </div>
    </div>
</div>

@endsection
