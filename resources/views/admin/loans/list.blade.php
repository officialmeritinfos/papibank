@extends('admin.base')

@section('content')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List</h6>
        </div>
        <div class="card-body">
            @include('templates.notification')
            <div class="table-responsive">
                <div class="text-center">
                    <a href="{{route('admin.loans.index')}}" class="btn btn-info">Pending Loans</a>
                    <a href="{{route('admin.loans.approved')}}" class="btn btn-outline-success">Approved Loans</a>
                    <a href="{{route('admin.loans.rejected')}}" class="btn btn-outline-warning">Rejected Loans</a>
                </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Amount</th>
                        <th>Facility</th>
                        <th>Tenure</th>
                        <th>Status</th>
                        <th>Requested At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($loans as $loan)
                        <tr>
                            <td>{{ str_pad($loan->id, 6, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $loan->user->first_name }} {{ $loan->user->last_name }}</td>
                            <td>{{ $bill->user->account_currency }} {{ number_format($loan->amount, 2) }}</td>
                            <td>{{ $loan->credit_facility }}</td>
                            <td>{{ $loan->payment_tenure }}</td>
                            <td>
                                @if ($loan->status === 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                @elseif ($loan->status === 'approved')
                                    <span class="badge badge-success">Approved</span>
                                @elseif ($loan->status === 'rejected')
                                    <span class="badge badge-danger">Rejected</span>
                                @endif
                            </td>
                            <td>{{ $loan->created_at->format('M d, Y H:i A') }}</td>
                            <td>
                                @if ($loan->status === 'pending')
                                    <form action="{{ route('admin.loans.approve', $loan->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                    </form>

                                    <form action="{{ route('admin.loans.reject', $loan->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm">Reject</button>
                                    </form>
                                @endif

                                <form action="{{ route('admin.loans.delete', $loan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this loan request?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
