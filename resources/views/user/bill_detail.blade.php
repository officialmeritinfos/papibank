@extends('user.base')
@section('content')

    <div class="container mt-5  pd-top-40 mg-top-50">
        @include('templates.notification')
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Bill Payment Details</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <h5 class="text-primary">Payment Information</h5>
                        <p><strong>Payee Name:</strong> {{ $bill->nickname }}</p>
                        <p><strong>Account Number:</strong> {{ $bill->account_number }}</p>
                        <p><strong>Amount Paid:</strong> ${{ number_format($bill->amount, 2) }}</p>
                        <p><strong>Payment Status:</strong>
                            <span class="badge {{ $bill->status == 'completed' ? 'bg-success' : 'bg-warning' }}">
                            {{ ucfirst($bill->status) }}
                        </span>
                        </p>
                        <p><strong>Payment Method:</strong> {{ ucfirst($bill->delivery_method) }}</p>
                        <p><strong>Transaction Date:</strong> {{ $bill->created_at->format('d M, Y h:i A') }}</p>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6">
                        <h5 class="text-primary">Billing Address</h5>
                        <p><strong>Address 1:</strong> {{ $bill->address1 }}</p>
                        <p><strong>Address 2:</strong> {{ $bill->address2 }}</p>
                        <p><strong>City:</strong> {{ $bill->city }}</p>
                        <p><strong>State:</strong> {{ $bill->state }}</p>
                        <p><strong>Zip Code:</strong> {{ $bill->zipcode }}</p>
                    </div>
                </div>

                <!-- Payment Receipt -->
                @if($bill->delivery_method == 'Digital Receipt' && $bill->receipt)
                    <div class="mt-4">
                        <h5 class="text-primary">Payment Receipt</h5>
                        <a href="{{ asset('storage/receipts/' . $bill->receipt) }}" target="_blank" class="btn btn-outline-primary">
                            <i class="fas fa-file-invoice"></i> View Receipt
                        </a>
                    </div>
                @endif

                <!-- Admin Actions (Only show for admin users) -->
                @if(auth()->user()->is_admin)
                    <div class="mt-4 mb-4">
                        <h5 class="text-danger">Admin Actions</h5>
                        <form action="{{ route('bill.updateStatus', $bill->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" class="form-select w-50 d-inline-block">
                                <option value="pending" {{ $bill->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $bill->status == 'process' ? 'selected' : '' }}>Processing</option>
                                <option value="completed" {{ $bill->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="failed" {{ $bill->status == 'failed' ? 'selected' : '' }}>Failed</option>
                            </select>
                            <button type="submit" class="btn btn-success ms-2">Update Status</button>
                        </form>
                    </div>
                @endif
            </div>

            <!-- Footer -->
            <div class="card-footer bg-light text-center">
                <a href="{{ route('bill.index') }}" class="btn btn-secondary">Back to Bills</a>
            </div>
        </div>
    </div>

@endsection
