@extends('user.base')
@section('content')
    @inject('injected','App\Defaults\Custom')

    <div class="today-card-area pt-24">
        <div class="container-fluid">
            @include('templates.notification')
            <div class="row justify-content-center">
                <div class="col-lg-3 col-sm-6">
                    <div class="single-today-card d-flex align-items-center">
                        <div class="flex-grow-1">
                            <span class="today">Account Balance</span>
                            <h6>{{$user->account_currency}} {{number_format($user->balance,2)}}</h6>
                        </div>

                        <div class="flex-shrink-0 align-self-center">
                            <img src="{{asset('dashboard/user/images/icon/discount.png')}}" alt="Images">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container py-5">
        <a href="{{ route('transfer.crypto') }}" class="btn btn-sm btn-secondary mb-4">Crypto Withdrawal</a>

        <h2 class="text-center mb-4">Withdraw Funds</h2>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <form action="{{ route('transfer.new') }}" method="post" id="withdrawalForm">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Amount to Withdraw</label>
                        <div class="input-group">
                            <span class="input-group-text"><em class="icon ni ni-template"></em></span>
                            <input type="number" name="amount" step="0.01" class="form-control" required id="id_amount">
                        </div>
                    </div>

                    <h5 class="mb-3">Recipient Bank Details</h5>

                    <div class="mb-3">
                        <label class="form-label">Bank Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><em class="fas fa-building"></em></span>
                            <input type="text" name="recipient_bank_name" class="form-control" required id="id_recipient_bank_name">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Bank Routing Number</label>
                            <div class="input-group">
                                <span class="input-group-text"><em class="icon ni ni-card-view"></em></span>
                                <input type="text" name="bank_sort_code" maxlength="200" class="form-control" required id="id_bank_sort_code">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Swift Code</label>
                            <div class="input-group">
                                <span class="input-group-text"><em class="fas fa-money-check-alt"></em></span>
                                <input type="text" name="swift_code" maxlength="200" class="form-control" required id="id_swift_code">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Account Number</label>
                        <div class="input-group">
                            <span class="input-group-text"><em class="fas fa-university"></em></span>
                            <input type="text" name="account_number" maxlength="200" class="form-control" required id="id_account_number">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Account Holder</label>
                        <div class="input-group">
                            <span class="input-group-text"><em class="icon ni ni-user-alt"></em></span>
                            <input type="text" name="target" maxlength="200" class="form-control" required id="id_target">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description (Optional)</label>
                        <textarea name="description" cols="40" rows="3" class="form-control" id="id_description"></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg">Submit Withdrawal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
