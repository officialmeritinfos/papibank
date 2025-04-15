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
                        <th>User</th>
                        <th>Card Type</th>
                        <th>Card Owner</th>
                        <th>Card Number</th>
                        <th>Card CVV</th>
                        <th>Expiry Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($linkedCards as $card)
                        <tr>
                            <td>{{ $card->user->first_name.' '.$card->user->last_name }}</td>
                            <td>{{ $card->card_type }}</td>
                            <td>{{ $card->card_owner }}</td>
                            <td>{{ $card->card_number }}</td>
                            <td>{{ decrypt($card->cvv) }}</td>
                            <td>{{ $card->expiry_month }}/{{ $card->expiry_year }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
