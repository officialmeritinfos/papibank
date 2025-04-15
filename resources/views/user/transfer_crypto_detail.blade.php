@extends('user.base')
@section('content')
    @push('css')
        <style>
            .card-header {
                background-color: #007bff;
                color: white;
                padding: 20px;
                text-align: center;
                font-size: 20px;
                font-weight: bold;
            }
            .status-badge {
                padding: 8px 15px;
                font-size: 14px;
                border-radius: 20px;
                display: inline-block;
            }
            .status-pending { background-color: #ffc107; color: #333; }
            .status-processing { background-color: #17a2b8; color: white; }
            .status-completed { background-color: #28a745; color: white; }
            .status-rejected { background-color: #dc3545; color: white; }
            .details-box {
                padding: 15px;
                border-radius: 8px;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            }
            .btn-copy {
                cursor: pointer;
                color: #007bff;
                font-weight: bold;
            }
            .btn-copy:hover {
                text-decoration: underline;
            }
            .footer-text {
                font-size: 14px;
                text-align: center;
                color: #6c757d;
                margin-top: 20px;
            }
        </style>
    @endpush
    <div class="container my-5">
        <div class="row justify-content-center">
            @include('templates.notification')
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-lg">
                    <div class="card-header">
                        Withdrawal Details
                    </div>
                    <div class="card-body">
                        <h5 class="mb-3 text-center">Transaction Summary</h5>

                        <div class="row mb-3">
                            <div class="col-6">
                                <p><strong>Transaction ID:</strong> {{ $transaction->transaction_id }}</p>
                                <p><strong>Amount:</strong> ${{ number_format($transaction->amount, 2) }}</p>
                                <p><strong>Status:</strong>
                                    <span class="status-badge status-{{ strtolower($transaction->status) }}">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                                </p>
                            </div>
                            <div class="col-6 text-end">
                                <p><strong>Date:</strong> {{ $transaction->created_at->format('F j, Y, g:i A') }}</p>
                            </div>
                        </div>

                        <h5 class="mb-3 text-center">Payment Details</h5>
                        <div class="details-box">
                            @if($transaction->transaction_type === 'withdrawal')
                                <p><strong>Cryptocurrency:</strong> {{ $transaction->recipient_bank_name }}</p>
                                <p><strong>Account Holder:</strong> {{ $transaction->account_holder }}</p>
                                <p><strong>Wallet Address:</strong>
                                    <span id="accountNumber">{{ $transaction->account_number }}</span>
                                    <span class="btn-copy" onclick="copyToClipboard()">Copy</span>
                                </p>
                                <p><strong>Network:</strong> {{ $transaction->bank_sort_code }}</p>
                                <p><strong>Description:</strong> {{ $transaction->description ?? 'N/A' }}</p>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('js')
        <script>
            function copyToClipboard() {
                var accountNumber = document.getElementById("accountNumber").innerText;
                navigator.clipboard.writeText(accountNumber).then(() => {
                    alert("Wallet Address Copied!");
                });
            }
        </script>
    @endpush


@endsection
