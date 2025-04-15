@extends('admin.base')

@section('content')


    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Users </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{$totalUsers}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-gifts fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                               Total Deposits </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                               {{$totalDeposits}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-gifts fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Total Pending Deposits </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                              {{$pendingDeposits}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-gifts fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Total Withdrawals </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                              {{$totalWithdrawals}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-gifts fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Total Pending Withdrawals </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                              {{$pendingWithdrawals}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-gifts fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Total External Cards </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                              {{$externalCards}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-gifts fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Total Virtual Cards Applications </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                              {{$virtualCards}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-gifts fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                               Total Loan Applications </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{$loans}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-plane fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                               Total Bill Payments </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{$bills}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-plane fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                               Pending Bill Payments </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{$pendingBills}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-plane fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>
@endsection
