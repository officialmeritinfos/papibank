@extends('user.base')
@section('content')

    <div class="container py-5  pd-top-40 mg-top-50">
        <h2 class="text-center mb-4">Deposit Details</h2>

        @include('templates.notification')

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <h5 class="card-title">Transaction Summary</h5>
                <table class="table table-bordered">
                    <tr>
                        <th class="text-muted">Deposit ID</th>
                        <td>{{ ucfirst($transaction->transaction_id) }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Deposit Type</th>
                        <td>{{ ucfirst($transaction->deposit_type) }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Amount</th>
                        <td>${{ number_format($transaction->amount, 2) }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Status</th>
                        <td><span class="badge bg-warning">{{ ucfirst($transaction->status) }}</span></td>
                    </tr>
                    <tr>
                        <th class="text-muted">Date</th>
                        <td>{{ $transaction->created_at->format('F j, Y, g:i a') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="card-title">Payment Instructions</h5>
                <p>Please follow the instructions below to complete your deposit:</p>
                <p><strong>Method:</strong> {{ ucfirst($transaction->deposit_type) }}</p>

                @foreach($paymentDetails as $key => $value)
                    <p><strong>{{ $key }}:</strong> {{ $value }}</p>
                @endforeach
            </div>
        </div>

        <div class="card shadow-sm border-0 mt-3">
            <div class="card-body">
                <h5 class="card-title">Payment Proof</h5>

                @if($transaction->deposit_type === 'crypto' && $transaction->transaction_hash)
                    <p><strong>Transaction Hash:</strong></p>
                    <div class="alert alert-info">
                        <code>{{ $transaction->transaction_hash }}</code>
                    </div>
                @elseif($transaction->deposit_type === 'gift_card' && $transaction->gift_card_code)
                    <p><strong>Gift Card Code:</strong></p>
                    <div class="alert alert-warning">
                        <code>{{ $transaction->gift_card_code }}</code>
                    </div>
                @elseif($transaction->deposit_type === 'bank' && $transaction->payment_receipt)
                    <p><strong>Payment Receipt:</strong></p>
                    <div class="alert alert-success">
                        <a href="{{ asset('storage/' . $transaction->payment_receipt) }}" target="_blank" class="btn btn-primary">
                            View Receipt
                        </a>
                    </div>
                @else
                    <p class="text-muted">No payment proof has been submitted yet.</p>
                @endif
            </div>
        </div>


        <div class="card shadow-sm border-0 mt-4">
            <div class="card-body">
                <h5 class="card-title">Submit Payment Proof</h5>
                <form action="{{ route('deposit.submitProof', ['id'=>$transaction->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if($transaction->deposit_type == 'crypto')
                        <div class="mb-3">
                            <label class="form-label">Transaction Hash</label>
                            <input type="text" name="transaction_hash" class="form-control" placeholder="Enter Transaction Hash" required>
                        </div>
                    @elseif($transaction->deposit_type == 'gift_card')
                        <div class="mb-3">
                            <label class="form-label">Gift Card Code</label>
                            <input type="text" name="gift_card_code" class="form-control" placeholder="Enter Gift Card Code" required>
                        </div>
                    @elseif($transaction->deposit_type == 'bank')
                        <div class="mb-3">
                            <label class="form-label">Upload Payment Receipt</label>
                            <input type="file" name="payment_receipt" class="form-control" accept="image/*,application/pdf" required>
                        </div>
                    @endif
                    <button type="submit" class="btn btn-primary">Submit Proof</button>
                </form>
            </div>
        </div>
    </div>

@endsection
