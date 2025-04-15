@extends('admin.base')

@section('content')
    <div class="container-fluid mt-4">
            @include('templates.notification')
        <!-- Cryptocurrency Methods -->
        <div class="card shadow-sm mb-4">
            <div class="card-header d-flex justify-content-between">
                <h5>Cryptocurrency Methods</h5>
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#cryptoModal">Add Crypto</button>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th>Name</th>
                        <th>Wallet</th>
                        <th>Network</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($cryptos as $crypto)
                        <tr>
                            <td>{{ $crypto->name }}</td>
                            <td>{{ $crypto->wallet }}</td>
                            <td>{{ $crypto->network }}</td>
                            <td>
                                <form action="{{ route('admin.payment_methods.destroy_crypto', $crypto->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Gift Card Methods -->
        <div class="card shadow-sm mb-4">
            <div class="card-header d-flex justify-content-between">
                <h5>Gift Card Methods</h5>
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#giftCardModal">Add Gift Card</button>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th>Merchant</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($giftCards as $giftCard)
                        <tr>
                            <td>{{ $giftCard->merchant }}</td>
                            <td>
                                <form action="{{ route('admin.payment_methods.destroy_giftcard', $giftCard->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Bank Transfer Methods -->
        <div class="card shadow-sm mb-4">
            <div class="card-header d-flex justify-content-between">
                <h5>Bank Transfer Methods</h5>
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#bankModal">Add Bank</button>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th>Method</th>
                        <th>Name</th>
                        <th>Detail</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($banks as $bank)
                        <tr>
                            <td>{{ $bank->method }}</td>
                            <td>{{ $bank->name }}</td>
                            <td>{{ $bank->detail }}</td>
                            <td>
                                <form action="{{ route('admin.payment_methods.destroy_bank', $bank->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @include('admin.paymentMethod.modals') <!-- Include Bootstrap Modals -->
    </div>
@endsection
