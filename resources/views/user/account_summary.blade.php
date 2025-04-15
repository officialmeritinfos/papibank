@extends('user.base')
@section('content')
    @push('css')
        <style>
            card-header {
                background-color: #007bff;
                color: white;
                text-align: center;
                font-size: 20px;
                font-weight: bold;
            }
            .table-hover tbody tr:hover {
                background-color: #f1f1f1;
            }
            .status-badge {
                padding: 6px 12px;
                border-radius: 5px;
                font-size: 14px;
                display: inline-block;
            }
            .status-pending { background-color: #ffc107; color: #333; }
            .status-processing { background-color: #17a2b8; color: white; }
            .status-completed { background-color: #28a745; color: white; }
            .status-rejected { background-color: #dc3545; color: white; }
            .pagination-container {
                text-align: center;
                margin-top: 20px;
            }
        </style>
    @endpush

    <div class="container my-5  pd-top-40 mg-top-50">
        <div class="row justify-content-center">
            <div class="col-lg-12 mt-5 mb-5">
                <div class="card shadow-lg">
                    <div class="card-header">
                        Account Summary
                    </div>
                    <div class="card-body">
                        <!-- Search Bar -->
                        <div class="mb-3">
                            <input type="text" id="searchInput" class="form-control" placeholder="Search transactions..." >
                        </div>

                       <div class="table-responsive" id="transactionTableContainer">
                           @include('user.partial.transactions_table')
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('js')
        <script>
            $(document).ready(function() {
                $('#searchInput').on('keyup', function() {
                    let query = $(this).val();

                    $.ajax({
                        url: "{{ route('account.summary') }}",
                        type: "GET",
                        data: { search: query },
                        success: function(response) {
                            $('#transactionTableContainer').html(response.transactions);
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
