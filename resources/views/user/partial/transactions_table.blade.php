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
                        <a href="{{ route('transfer.detail', $transaction->id) }}" class="btn btn-primary">
                            View Details
                        </a>
                    @else
                        <a href="{{ route('deposit.detail', $transaction->id) }}" class="btn btn-secondary ">
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

<div class="pagination-container">
    {{ $transactions->links() }}
</div>
