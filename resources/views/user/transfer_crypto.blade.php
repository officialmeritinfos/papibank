@extends('user.base')
@section('content')
    @inject('injected','App\Defaults\Custom')

    <div class="container pd-top-40 mg-top-50">
        <a href="{{ route('transfer.index') }}" class="btn btn-sm btn-secondary mb-4"> ←  Bank Withdrawal</a>

        <h2 class="text-center mb-4">Withdraw Funds</h2>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <form action="{{ route('transfer.crypto.new') }}" method="post" id="withdrawalForm">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Amount to Withdraw</label>
                        <div class="input-group">
                            <span class="input-group-text"><em class="icon ni ni-template"></em></span>
                            <input type="number" name="amount" step="0.01" class="form-control" required id="id_amount">
                        </div>
                    </div>

                    <h5 class="mb-3">Recipient Details</h5>

                    <div class="mb-3">
                        <label class="form-label">Cryptocurrency</label>
                        <div class="input-group">
                            <span class="input-group-text"><em class="fas fa-building"></em></span>
                            <input type="text" name="recipient_coin" class="form-control" required id="id_recipient_bank_name"
                            placeholder="BTC, ETH, USDT">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cryptocurrency Network</label>
                        <div class="input-group">
                            <span class="input-group-text"><em class="fas fa-building"></em></span>
                            <input type="text" name="recipient_coin_network" class="form-control" id="id_recipient_bank_name" required
                            placeholder="BTC, ERC20, TRC20">
                        </div>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Wallet Address</label>
                        <div class="input-group">
                            <span class="input-group-text"><em class="fas fa-university"></em></span>
                            <input type="text" name="wallet_address" maxlength="200" class="form-control" required id="id_account_number">
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
