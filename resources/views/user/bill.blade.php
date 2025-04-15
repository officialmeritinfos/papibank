@extends('user.base')
@section('content')

    <div class="container my-5">
        <div class="row justify-content-center">
            @include('templates.notification')
            <div class="col-lg-12">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white text-center py-3">
                        <h4 class="mb-0"><i class="fas fa-file-invoice-dollar"></i> Internet Banking Bill Pay</h4>
                    </div>

                    <div class="card-body">
                        <form method="post" action="{{ route('bill.new') }}">
                            @csrf
                            <div class="row">
                                <!-- Payment Account Selection -->
                                <div class="col-md-12 mb-3 mt-3">
                                    <label class="form-label">Choose Payment Account</label>
                                    <select class="form-select" required>
                                        <option selected>Select an Account</option>
                                        <option value="1">Non Resident Account - {{ auth()->user()->account_currency }}
                                            {{ number_format(auth()->user()->balance) }}</option>
                                        <option value="2">{{ auth()->user()->account_type }} - {{ auth()->user()->account_currency }}
                                            {{ number_format(auth()->user()->balance) }}</option>
                                    </select>
                                </div>

                                <!-- Address Fields -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Address 1</label>
                                    <input type="text" name="address1" class="form-control" required placeholder="Enter Address 1">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Address 2</label>
                                    <input type="text" name="address2" class="form-control" required placeholder="Enter Address 2">
                                </div>

                                <!-- City and State -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">City</label>
                                    <input type="text" name="city" class="form-control" required placeholder="Enter City">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">State</label>
                                    <input type="text" name="state" class="form-control" required placeholder="Enter State">
                                </div>

                                <!-- Zipcode -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Zipcode</label>
                                    <input type="text" name="zipcode" class="form-control" required placeholder="Enter Zipcode">
                                </div>

                                <!-- Payee Name -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Payee</label>
                                    <input type="text" name="payee" class="form-control" required placeholder="Enter Payee Name">
                                </div>

                                <!-- Delivery Method -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Delivery Method</label>
                                    <select name="delivery_method" class="form-select">
                                        <option value="Paper Check">Paper Check</option>
                                        <option value="Digital Receipt">Digital Receipt</option>
                                    </select>
                                </div>

                                <!-- Memo -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Memo (Max 80 characters)</label>
                                    <input type="text" name="memo" class="form-control" maxlength="80" placeholder="Enter Memo">
                                </div>

                                <!-- Account Number -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Account Number</label>
                                    <input type="text" name="account_number" class="form-control" required placeholder="Enter Account Number">
                                </div>

                                <!-- Amount -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Amount</label>
                                    <input type="number" name="amount" class="form-control" step="0.01" min="10.00" required placeholder="Enter Amount">
                                </div>

                                <!-- Date of Delivery -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Date of Delivery</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <select name="day" class="form-select">
                                                <option value="">Day</option>
                                                @for ($i = 1; $i <= 31; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="month" class="form-select">
                                                <option value="">Month</option>
                                                @foreach(range(1, 12) as $month)
                                                    <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <select name="year" class="form-select">
                                                <option value="">Year</option>
                                                @for ($i = date('Y'); $i <= date('Y') + 10; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Save Payee to Favorites -->
                                <div class="col-md-12 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="saveToFavorites">
                                        <label class="form-check-label" for="saveToFavorites">
                                            Add this Payee to your favorites
                                        </label>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-paper-plane"></i> Pay Bill</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="container my-5">
        <!-- List of Previous Bill Payments -->
        <div class="col-lg-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-secondary text-white">
                    <h4 class="mb-0">Your Bill Payments</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search bills...">
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="bg-dark">
                            <tr>
                                <th>Payee</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="billTable">
                            @foreach($bills as $bill)
                                <tr>
                                    <td>{{ $bill->payee }}</td>
                                    <td>${{ number_format($bill->amount, 2) }}</td>
                                    <td>
                                        <span class="badge {{ $bill->status == 'completed' ? 'bg-success' : 'bg-warning' }}">
                                            {{ ucfirst($bill->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('bill.summary', ['id'=>$bill->id]) }}" class="btn btn-sm btn-outline-primary">View</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="mt-5">
                            {{ $bills->links() }}
                        </div>
                    </div>

                    @if($bills->isEmpty())
                        <p class="text-muted text-center">No bill payments found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>


    @push('js')
        <script>
            document.getElementById("searchInput").addEventListener("keyup", function() {
                let searchValue = this.value.toLowerCase();
                let rows = document.querySelectorAll("#billTable tr");

                rows.forEach(row => {
                    let payee = row.cells[0].textContent.toLowerCase();
                    let amount = row.cells[1].textContent.toLowerCase();
                    row.style.display = (payee.includes(searchValue) || amount.includes(searchValue)) ? "" : "none";
                });
            });
        </script>
    @endpush
@endsection
