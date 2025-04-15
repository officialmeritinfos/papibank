@extends('admin.base')
@section('content')
    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4>Deposit Details - #{{ str_pad($transaction->id, 6, '0', STR_PAD_LEFT) }}</h4>
            </div>
            <div class="card-body">
                <h5 class="text-primary">User Information</h5>
                <table class="table table-bordered">
                    <tr><th>Username</th><td>{{ $transaction->user->username }}</td></tr>
                    <tr><th>Email</th><td>{{ $transaction->user->email }}</td></tr>
                    <tr><th>Phone</th><td>{{ $transaction->user->phone }}</td></tr>
                </table>

                <h5 class="text-primary mt-3">Deposit Details</h5>
                <table class="table table-bordered">
                    <tr><th>Transaction ID</th><td>{{ $transaction->transaction_id }}</td></tr>
                    <tr><th>Amount</th><td>{{$transaction->user->account_currency}}{{ number_format($transaction->amount, 2) }}</td></tr>
                    <tr><th>Fee</th><td>{{$transaction->user->account_currency}}{{ number_format($transaction->fee, 2) }}</td></tr>
                    <tr><th>Final Amount</th><td>{{$transaction->user->account_currency}}{{ number_format($transaction->final_amount, 2) }}</td></tr>
                    <tr><th>Deposit Type</th><td>{{ ucfirst($transaction->deposit_type) }}</td></tr>
                    <tr><th>Status</th>
                        <td>
                        <span class="badge bg-{{ $transaction->status == 'completed' ? 'success' : ($transaction->status == 'pending' ? 'warning' : 'danger') }}">
                            {{ ucfirst($transaction->status) }}
                        </span>
                        </td>
                    </tr>
                </table>

                @if($transaction->deposit_type == 'crypto')
                    <h5 class="text-primary mt-3">Crypto Payment</h5>
                    <table class="table table-bordered">
                        <tr><th>Transaction Hash</th><td>{{ $transaction->transaction_hash ?? 'N/A' }}</td></tr>
                    </table>
                @endif

                @if($transaction->deposit_type == 'gift_card')
                    <h5 class="text-primary mt-3">Gift Card Payment</h5>
                    <table class="table table-bordered">
                        <tr><th>Gift Card Code</th><td>{{ $transaction->gift_card_code ?? 'N/A' }}</td></tr>
                    </table>
                @endif

                @if($transaction->deposit_type == 'bank' && $transaction->payment_receipt)
                    <h5 class="text-primary mt-3">Bank Transfer Payment</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Payment Receipt</th>
                            <td>
                                <a href="{{ asset('storage/' . $transaction->payment_receipt) }}" target="_blank" class="btn btn-sm btn-success">View Receipt</a>
                            </td>
                        </tr>
                    </table>
                @endif

                <h5 class="text-primary mt-3">Admin Actions</h5>
                <form action="{{ route('admin.deposits.update', $transaction->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <select name="status" class="form-control">
                                <option value="pending" {{ $transaction->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ $transaction->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="failed" {{ $transaction->status == 'failed' ? 'selected' : '' }}>Failed</option>
                                <option value="processing" {{ $transaction->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Update Status</button>
                </form>

                <form action="{{ route('admin.deposits.transactions.delete', $transaction->id) }}" method="POST"
                     class="mt-5" onsubmit="return confirm('Are you sure you want to delete this transaction?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Transaction</button>
                </form>
            </div>
        </div>
    </div>
@endsection
