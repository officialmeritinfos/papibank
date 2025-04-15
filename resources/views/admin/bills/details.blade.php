@extends('admin.base')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Bill Payment Details</h2>

        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Payment Information</h5>
                <ul class="list-group">
                    <li class="list-group-item"><strong>User:</strong> {{ $bill->user->first_name }} {{ $bill->user->last_name }}</li>
                    <li class="list-group-item"><strong>Payee:</strong> {{ $bill->payee }}</li>
                    <li class="list-group-item"><strong>Account Number:</strong> {{ $bill->account_number }}</li>
                    <li class="list-group-item"><strong>Amount:</strong> ${{ number_format($bill->amount, 2) }}</li>
                    <li class="list-group-item"><strong>Address:</strong> {{ $bill->address1 }}, {{ $bill->address2 }}</li>
                    <li class="list-group-item"><strong>City:</strong> {{ $bill->city }}, {{ $bill->state }}</li>
                    <li class="list-group-item"><strong>Zipcode:</strong> {{ $bill->zipcode }}</li>
                    <li class="list-group-item"><strong>Delivery Method:</strong> {{ $bill->delivery_method }}</li>
                    <li class="list-group-item"><strong>Memo:</strong> {{ $bill->memo }}</li>
                    <li class="list-group-item"><strong>Delivery Date:</strong> {{ date('M d, Y',strtotime($bill->delivery_date)) }}</li>
                    <li class="list-group-item"><strong>Status:</strong>
                        @if ($bill->status === 'pending')
                            <span class="badge badge-warning">Pending</span>
                        @elseif ($bill->status === 'processing')
                            <span class="badge badge-primary">Processing</span>
                        @elseif ($bill->status === 'completed')
                            <span class="badge badge-success">Completed</span>
                        @elseif ($bill->status === 'failed')
                            <span class="badge badge-danger">Failed</span>
                        @endif
                    </li>
                </ul>

                <form action="{{ route('admin.bills.update_status', $bill->id) }}" method="POST" class="mt-4">
                    @csrf
                    <div class="form-group">
                        <label for="status">Update Status:</label>
                        <select name="status" class="form-control" required>
                            <option value="pending" @if($bill->status == 'pending') selected @endif>Pending</option>
                            <option value="processing" @if($bill->status == 'processing') selected @endif>Processing</option>
                            <option value="completed" @if($bill->status == 'completed') selected @endif>Completed</option>
                            <option value="failed" @if($bill->status == 'failed') selected @endif>Failed</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </form>
            </div>
        </div>
    </div>
@endsection
