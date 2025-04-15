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
                    <a href="{{route('admin.deposits.index')}}" class="btn btn-info">Pending Deposits</a>
                    <a href="{{route('admin.deposits.completed')}}" class="btn btn-outline-success">Completed Deposits</a>
                    <a href="{{route('admin.deposits.failed')}}" class="btn btn-outline-warning">Failed Deposits</a>
                </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>User</th>
                        <th>Transaction Id</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Date Created</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($deposits as $deposit)
                        <tr>
                            <td>{{ $deposit->user->first_name.' '.$deposit->user->last_name }}</td>
                            <td>{{$deposit->transaction_id}}</td>
                            <td>{{$deposit->user->account_currency}} {{$deposit->amount}}</td>
                            <td>{{ $deposit->payment_method }}</td>
                            <td>{{$deposit->created_at}}</td>
                            <td>
                                <span class="">{{ ucfirst($deposit->status) }}</span>
                            </td>
                            <td>
                                <a href="{{route('admin.deposits.detail',['id'=>$deposit->id])}}" class="btn btn-primary mt-4">
                                    <i class="fa fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
