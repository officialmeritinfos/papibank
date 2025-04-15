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
                    <a href="{{route('admin.withdrawals.index')}}" class="btn btn-info">Pending withdrawals</a>
                    <a href="{{route('admin.withdrawals.completed')}}" class="btn btn-outline-success">Completed withdrawals</a>
                    <a href="{{route('admin.withdrawals.failed')}}" class="btn btn-outline-warning">Failed withdrawals</a>
                </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>User</th>
                        <th>Transaction Id</th>
                        <th>Amount</th>
                        <th>Date Created</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($withdrawals as $withdrawal)
                        <tr>
                            <td>{{ $withdrawal->user->first_name.' '.$withdrawal->user->last_name }}</td>
                            <td>{{$withdrawal->transaction_id}}</td>
                            <td>{{$withdrawal->user->account_currency}} {{$withdrawal->amount}}</td>
                            <td>{{$withdrawal->created_at}}</td>
                            <td>
                                <span class="">{{ ucfirst($withdrawal->status) }}</span>
                            </td>
                            <td>
                                <a href="{{route('admin.withdrawals.detail',['id'=>$withdrawal->id])}}" class="btn btn-primary mt-4">
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
