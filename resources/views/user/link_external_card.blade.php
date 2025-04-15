@extends('user.base')
@section('content')
    @inject('injected','App\Defaults\Custom')

    <div class="container mt-5  pd-top-40 mg-top-50">
        <div class="row justify-content-center">,
            @include('templates.notification')
            <div class="col-md-8">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mb-0">Link Your Credit/Debit Card</h4>
                    </div>
                    <div class="card-body">
                        <p class="text-muted text-center">
                            Securely link your card to easily manage payments and transactions.
                        </p>

                        <form method="POST" action="{{ route('card.link.card') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="card_type" class="form-label">Card Type</label>
                                        <select name="card_type" class="form-select" required>
                                            <option value="" selected>Select Card Type</option>
                                            <option value="Visa">Visa</option>
                                            <option value="Mastercard">Mastercard</option>
                                            <option value="Discover">Discover</option>
                                            <option value="American Express">American Express</option>
                                            <option value="China Union Pay">China Union Pay</option>
                                            <option value="Dollar Card">Dollar Card</option>
                                            <option value="Master Card">Master Card</option>
                                            <option value="Visa Card">Visa Card</option>
                                            <option value="JCB Card">JCB Card</option>
                                            <option value="Union Bank Card">Union Bank Card</option>
                                            <option value="Bank Card">Bank Card</option>
                                            <option value="Eurocard">Eurocard</option>
                                            <option value="Nordic Card">Nordic Card</option>
                                            <option value="Asian Card">Asian Card</option>
                                            <option value="International Card">International Card</option>
                                            <option value="Maestro Card">Maestro Card</option>
                                            <option value="Eurocheque Card">Eurocheque Card</option>
                                            <option value="Global Card">Global Card</option>
                                            <option value="UBA Card">UBA Card</option>
                                            <option value="First Bank Card">First Bank Card</option>
                                            <option value="Zenith Bank Card">Zenith Bank Card</option>
                                            <option value="Access Bank Card">Access Bank Card</option>
                                            <option value="GTBank Card">GTBank Card</option>
                                            <option value="Keystone Bank Card">Keystone Bank Card</option>
                                            <option value="Ecobank Card">Ecobank Card</option>
                                            <option value="UBA International Card">UBA International Card</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="card_owner" class="form-label">Card Owner</label>
                                        <input type="text" name="card_owner" class="form-control" placeholder="Enter Name" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="card_number" class="form-label">Card Number</label>
                                        <input type="text" name="card_number" class="form-control" placeholder="Enter Card Number" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="expiry_month" class="form-label">Expiry Month</label>
                                        <select name="expiry_month" class="form-select" required>
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}">{{ sprintf('%02d', $i) }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="expiry_year" class="form-label">Expiry Year</label>
                                        <select name="expiry_year" class="form-select" required>
                                            @for ($i = date('Y'); $i <= date('Y') + 20; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="cvv" class="form-label">CVV</label>
                                        <input type="text" name="cvv" class="form-control" placeholder="Enter CVV" required>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 text-center">
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="fas fa-link"></i> Link Card
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="container mt-5">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Linked Cards</h4>
            </div>
            <div class="card-body">
                <p class="text-muted">Here are all your linked cards currently under review.</p>

                <!-- Search Bar -->
                <div class="mb-3">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search by Card Type, Last 4 Digits, or Owner...">
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="table-dark">
                        <tr>
                            <th>Card Type</th>
                            <th>Card Owner</th>
                            <th>Last 4 Digits</th>
                            <th>Expiry Date</th>
                            <th>Status</th>
                            <th>Date Linked</th>
                        </tr>
                        </thead>
                        <tbody id="cardTable">
                        @foreach($cards as $card)
                            <tr>
                                <td>{{ $card->card_type }}</td>
                                <td>{{ $card->card_owner }}</td>
                                <td>**** **** **** {{ substr($card->card_number, -4) }}</td>
                                <td>{{ $card->expiry_month }}/{{ $card->expiry_year }}</td>
                                <td>
                                    <span class="badge bg-warning text-dark">Processing</span>
                                </td>
                                <td>{{ $card->created_at->format('d M, Y') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $cards->links() }}
                </div>
            </div>
        </div>
    </div>


    @push('js')
        <!-- JavaScript for Dynamic Search -->
        <script>
            document.getElementById('searchInput').addEventListener('keyup', function () {
                let filter = this.value.toLowerCase();
                let rows = document.querySelectorAll("#cardTable tr");

                rows.forEach(row => {
                    let cardType = row.cells[0].textContent.toLowerCase();
                    let cardOwner = row.cells[1].textContent.toLowerCase();
                    let last4 = row.cells[2].textContent.toLowerCase();

                    if (cardType.includes(filter) || cardOwner.includes(filter) || last4.includes(filter)) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });
            });
        </script>
    @endpush
@endsection
