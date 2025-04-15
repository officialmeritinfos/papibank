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
                    <a href="{{route('admin.bills.index')}}" class="btn btn-info">Pending Bills</a>
                    <a href="{{route('admin.bills.approved')}}" class="btn btn-outline-success">Approved Bills</a>
                    <a href="{{route('admin.bills.failed')}}" class="btn btn-outline-warning">Rejected Bills</a>
                </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Payee</th>
                        <th>Amount</th>
                        <th>Delivery Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($bills as $bill)
                        <tr>
                            <td>{{ str_pad($bill->id, 6, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $bill->user->first_name }} {{ $bill->user->last_name }}</td>
                            <td>{{ $bill->payee }}</td>
                            <td>{{ $bill->user->account_currency }} {{ number_format($bill->amount, 2) }}</td>
                            <td>{{ date('M d, Y',strtotime($bill->delivery_date)) }}</td>
                            <td>
                                @if ($bill->status === 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                @elseif ($bill->status === 'processing')
                                    <span class="badge badge-primary">Processing</span>
                                @elseif ($bill->status === 'completed')
                                    <span class="badge badge-success">Completed</span>
                                @elseif ($bill->status === 'failed')
                                    <span class="badge badge-danger">Failed</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.bills.details', $bill->id) }}" class="btn btn-info btn-sm">View</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
