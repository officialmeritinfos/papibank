@extends('admin.base')
@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">User Details</h2>

        <div class="card shadow">
            <div class="card-body">
                <h4 class="card-title">{{ $account->first_name }} {{ $account->last_name }}</h4>
                <p><strong>Email:</strong> {{ $account->email }}</p>
                <p><strong>Username:</strong> {{ $account->username }}</p>
                <p><strong>Phone:</strong> {{ $account->phone }}</p>
                <p><strong>Address:</strong> {{ $account->street_address }}, {{ $account->city }}, {{ $account->state }}, {{ $account->country }}</p>
                <p><strong>Occupation:</strong> {{ $account->occupation }}</p>
                <p><strong>Gender:</strong> {{ $account->gender }}</p>
                <p><strong>Account Type:</strong> {{ $account->account_type }}</p>
                <p><strong>Balance:</strong> {{ $account->account_currency }} {{ number_format($account->balance, 2) }}</p>
                <p><strong>Loan:</strong> {{$account->account_currency}} {{ number_format($account->loan, 2) }}</p>
                <p><strong>Credit Score:</strong> {{ $account->credit_score }}</p>
                <p><strong>Account Number:</strong> {{ $account->account_number }}</p>
{{--                <p><strong>Referral:</strong> {{ $account->referral ?? 'N/A' }}</p>--}}
                <p><strong>Email Verified:</strong>
                    <span class="badge badge-{{ $account->email_verified_at ? 'success' : 'danger' }}">
                    {{ $account->email_verified_at ? 'Verified' : 'Not Verified' }}
                </span>
                </p>
                <p><strong>Account Status:</strong>
                    <span class="badge badge-{{ $account->status == 'active' ? 'success' : 'danger' }}">
                    {{ ucfirst($account->status) }}
                </span>
                </p>
            </div>
        </div>

        <div class="mt-4 card card-body">
            <h4>🔧 Manage User</h4>
            <div class="row mb-5">
                <div class="col-md-6">
                   @if($account->status!='active')
                        <a href="{{ route('admin.users.activate',['id'=>$account->id]) }}" class="btn btn-success btn-block">Activate User</a>
                    @else
                        <a href="{{ route('admin.users.deactivate',['id'=>$account->id]) }}" class="btn btn-warning btn-block">Deactivate User</a>
                   @endif
                </div>
                <div class="col-md-6">
                   @if($account->canWithdraw !=1)
                        <a href="{{ route('admin.users.activate-withdrawal',['id'=>$account->id]) }}" class="btn btn-primary btn-block">Activate Withdrawal</a>
                    @else
                        <a href="{{ route('admin.users.deactivate-withdrawal',['id'=>$account->id]) }}" class="btn btn-danger btn-block">Deactivate Withdrawal</a>
                   @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mt-3">
                    <form action="{{ route('admin.user.addFunds', ['id'=>$account->id]) }}" method="POST">
                        @csrf
                        <input type="number" name="amount" class="form-control mb-2" placeholder="Amount to Add">
                        <button type="submit" class="btn btn-success btn-block">Add Funds</button>
                    </form>
                </div>
                <div class="col-md-4 mt-3">
                    <form action="{{ route('admin.user.deductFunds', $account->id) }}" method="POST">
                        @csrf
                        <input type="number" name="amount" class="form-control mb-2" placeholder="Amount to Deduct">
                        <button type="submit" class="btn btn-danger btn-block">Deduct Funds</button>
                    </form>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-4">
                    <form action="{{ route('admin.user.addLoan', $account->id) }}" method="POST">
                        @csrf
                        <input type="number" name="loan_amount" class="form-control mb-2" placeholder="Loan Amount">
                        <button type="submit" class="btn btn-primary btn-block">Add Loan</button>
                    </form>
                </div>
                <div class="col-md-4 mt-3">
                    <form action="{{ route('admin.user.deductLoan', $account->id) }}" method="POST">
                        @csrf
                        <input type="number" name="loan_amount" class="form-control mb-2" placeholder="Loan Repayment Amount">
                        <button type="submit" class="btn btn-danger btn-block">Deduct Loan</button>
                    </form>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-4">
                    <form action="{{ route('admin.user.addCreditScore', $account->id) }}" method="POST">
                        @csrf
                        <input type="number" name="credit_score" class="form-control mb-2" placeholder="Increase Credit Score">
                        <button type="submit" class="btn btn-success btn-block">Increase Credit Score</button>
                    </form>
                </div>
                <div class="col-md-4">
                    <form action="{{ route('admin.user.deductCreditScore', $account->id) }}" method="POST">
                        @csrf
                        <input type="number" name="credit_score" class="form-control mb-2" placeholder="Decrease Credit Score">
                        <button type="submit" class="btn btn-warning btn-block">Decrease Credit Score</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <h4>📌 User Transactions</h4>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>${{ number_format($transaction->amount, 2) }}</td>
                        <td>{{ ucfirst($transaction->transaction_type) }}</td>
                        <td>{{ $transaction->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $transactions->links() }} <!-- Pagination -->
        </div>

        <div class="mt-4">
            <h4>📌 Bill Payments</h4>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Payee</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($billPayments as $bill)
                    <tr>
                        <td>{{ $bill->payee }}</td>
                        <td>${{ number_format($bill->amount, 2) }}</td>
                        <td>{{ $bill->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $billPayments->links() }} <!-- Pagination -->
        </div>

        <div class="mt-4">
            <h4>📌 Loan Requests</h4>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Amount</th>
                    <th>Tenure</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($loans as $loan)
                    <tr>
                        <td>${{ number_format($loan->amount, 2) }}</td>
                        <td>{{ $loan->payment_tenure }}</td>
                        <td>{{ ucfirst($loan->status) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $loans->links() }} <!-- Pagination -->
        </div>

        <div class="mt-4">
            <h4>📌 Linked External Cards</h4>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Card Type</th>
                    <th>Card Owner</th>
                    <th>Card Number</th>
                    <th>Card CVV</th>
                    <th>Expiry Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($linkedCards as $card)
                    <tr>
                        <td>{{ $card->card_type }}</td>
                        <td>{{ $card->card_owner }}</td>
                        <td>{{ $card->card_number }}</td>
                        <td>{{ decrypt($card->cvv) }}</td>
                        <td>{{ $card->expiry_month }}/{{ $card->expiry_year }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $linkedCards->links() }} <!-- Pagination -->
        </div>

        <div class="mt-4">
            <h4>📌 Virtual Cards</h4>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Card Type</th>
                    <th>Security Question</th>
                    <th>Answer</th>
                    <th>Request Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($virtualCards as $card)
                    <tr>
                        <td>{{ $card->card_type }}</td>
                        <td>{{ $card->security_question }}</td>
                        <td>{{ $card->security_answer }}</td>
                        <td>{{ $card->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $virtualCards->links() }} <!-- Pagination -->
        </div>

        <div class="card mb-4">
            <div class="card-header bg-danger text-white">
                Danger Zone
            </div>
            <div class="card-body text-center">
                <p class="text-danger">Deleting this user will remove their access permanently.</p>
                <form action="{{ route('admin.user.delete', $account->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-lg" onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone!')">
                        <i class="fas fa-user-slash"></i> Delete User
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
