@extends('admin.base')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h4>Withdrawal Details</h4>
                <a href="{{ route('admin.withdrawals.index') }}" class="btn btn-light btn-sm">Back to Withdrawals</a>
            </div>

            <div class="card-body">
                <div class="row">
                    <!-- Left: Transaction Details -->
                    <div class="col-md-6">
                        <h5 class="text-primary">Transaction Information</h5>
                        <ul class="list-group mb-3">
                            <li class="list-group-item"><strong>Transaction ID:</strong> {{ str_pad($withdrawal->id, 8, '0', STR_PAD_LEFT) }}</li>
                            <li class="list-group-item"><strong>User:</strong> <a href="{{ route('admin.users.details', $withdrawal->user->id) }}">{{ $withdrawal->user->first_name }} {{ $withdrawal->user->last_name }}</a></li>
                            <li class="list-group-item"><strong>Amount:</strong> {{ number_format($withdrawal->amount, 2) }} {{ $withdrawal->user->account_currency }}</li>
                            <li class="list-group-item"><strong>Fee:</strong> {{ number_format($withdrawal->fee, 2) }} {{ $withdrawal->user->account_currency }}</li>
                            <li class="list-group-item"><strong>Final Amount:</strong> {{ number_format($withdrawal->final_amount, 2) }} {{ $withdrawal->user->account_currency }}</li>
                            <li class="list-group-item"><strong>Status:</strong>
                                @if($withdrawal->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($withdrawal->status == 'completed')
                                    <span class="badge bg-success">Completed</span>
                                @elseif($withdrawal->status == 'failed')
                                    <span class="badge bg-danger">Failed</span>
                                @elseif($withdrawal->status == 'processing')
                                    <span class="badge bg-info">Processing</span>
                                @endif
                            </li>
                            <li class="list-group-item"><strong>Date Requested:</strong> {{ $withdrawal->created_at->format('M d, Y h:i A') }}</li>
                        </ul>
                    </div>

                    <!-- Right: User Information -->
                    <div class="col-md-6">
                        <h5 class="text-primary">User Information</h5>
                        <ul class="list-group mb-3">
                            <li class="list-group-item"><strong>Name:</strong> {{ $withdrawal->user->first_name }} {{ $withdrawal->user->last_name }}</li>
                            <li class="list-group-item"><strong>Email:</strong> {{ $withdrawal->user->email }}</li>
                            <li class="list-group-item"><strong>Phone:</strong> {{ $withdrawal->user->phone }}</li>
                            <li class="list-group-item"><strong>Account Type:</strong> {{ $withdrawal->user->account_type }}</li>
                            <li class="list-group-item"><strong>Balance:</strong> {{ number_format($withdrawal->user->balance, 2) }} {{ $withdrawal->user->account_currency }}</li>
                        </ul>

                    </div>
                    <div class="col-12 mt-3">

                        <!-- Recipient Details (If Bank Transfer) -->
                        @if($withdrawal->transaction_type == 'withdrawal')
                            <h5 class="text-primary">Recipient Bank Details</h5>
                            <ul class="list-group mb-3">
                                <li class="list-group-item"><strong>Bank Name:</strong> {{ $withdrawal->recipient_bank_name }}</li>
                                <li class="list-group-item"><strong>Account Number:</strong> {{ $withdrawal->account_number }}</li>
                                <li class="list-group-item"><strong>Account Holder:</strong> {{ $withdrawal->account_holder }}</li>
                                <li class="list-group-item"><strong>SWIFT Code:</strong> {{ $withdrawal->swift_code }}</li>
                                <li class="list-group-item"><strong>Sort Code:</strong> {{ $withdrawal->bank_sort_code }}</li>
                            </ul>
                        @endif
                    </div>
                </div>

                <!-- Admin Actions -->
                <h5 class="text-primary mt-4">Admin Actions</h5>
                <form method="POST" action="{{ route('admin.withdrawals.update', $withdrawal->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-12">
                            <label for="status" class="form-label">Update Status:</label>
                            <select class="form-select" name="status" required>
                                <option value="pending" {{ $withdrawal->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $withdrawal->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="completed" {{ $withdrawal->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="failed" {{ $withdrawal->status == 'failed' ? 'selected' : '' }}>Failed</option>
                            </select>
                        </div>

                    </div>

                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-primary">Update Withdrawal</button>
                    </div>
                </form>


                <form action="{{ route('admin.withdrawal.transactions.delete', $withdrawal->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this transaction?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Transaction</button>
                </form>

            </div>
        </div>
    </div>
@endsection
