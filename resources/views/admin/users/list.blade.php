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
                    <a href="{{route('admin.users.inactive')}}" class="btn btn-outline-warning">View Deactivated Users</a>
                    <a href="{{route('admin.users.index')}}" class="btn btn-success">View Active Users</a>
                    <a href="{{ route('admin.users.new') }}" class="btn btn-primary">Add New User</a>
                </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Balance</th>
                        <th>Country</th>
                        <th>Occupation</th>
                        <th>Date Registered</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->first_name.' '.$user->last_name }}</td>
                            <td>{{$user->username}}</td>
                            <td>{{$user->email}}</td>
                            <td> {{ $user->account_currency }} {{number_format($user->balance,2)}}</td>
                            <td> {{ $user->countrys->name }}</td>
                            <td>{{ $user->occupation }}</td>
                            <td>{{$user->created_at}}</td>
                            <td>
                                <span class="">{{ ucfirst($user->status) }}</span>
                            </td>
                            <td>
                                <a href="{{route('admin.users.details',['id'=>$user->id])}}" class="btn btn-primary mt-4">
                                    <i class="fa fa-eye"></i> View
                                </a>

                                <a href="{{route('admin.users.login',['id'=>$user->id])}}" class="btn btn-info mt-4">
                                    <i class="fa fa-eye"></i> Access User
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Balance</th>
                        <th>Country</th>
                        <th>Occupation</th>
                        <th>Date Registered</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

@endsection
