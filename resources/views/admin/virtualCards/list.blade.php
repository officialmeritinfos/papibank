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
                    <a href="{{route('admin.virtual.cards.index')}}" class="btn btn-info">Pending Requests</a>
                    <a href="{{route('admin.virtual.cards.approved')}}" class="btn btn-outline-success">Approved Requests</a>
                    <a href="{{route('admin.virtual.cards.rejected')}}" class="btn btn-outline-warning">Rejected Requests</a>
                </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Card Type</th>
                        <th>Security Question</th>
                        <th>Security Answer</th>
                        <th>Status</th>
                        <th>Requested At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($cardRequests as $request)
                        <tr>
                            <td>{{ str_pad($request->id, 6, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $request->user->first_name }} {{ $request->user->last_name }}</td>
                            <td>{{ $request->card_type }}</td>
                            <td>{{ $request->security_question }}</td>
                            <td>{{ $request->security_answer }}</td>
                            <td>
                                @if ($request->status === 'Pending')
                                    <span class="badge badge-warning">Pending</span>
                                @elseif ($request->status === 'Approved')
                                    <span class="badge badge-success">Approved</span>
                                @elseif ($request->status === 'Rejected')
                                    <span class="badge badge-danger">Rejected</span>
                                @endif
                            </td>
                            <td>{{ $request->created_at->format('M d, Y') }}</td>
                            <td>
                                <form action="{{ route('admin.virtual.cards.update_status', $request->id) }}" method="POST" class="mt-4">
                                    @csrf
                                    <div class="form-group">
                                        <label for="status">Update Status:</label>
                                        <select name="status" class="form-control" required>
                                            <option value="Pending" @if($request->status == 'Pending') selected @endif>Pending</option>
                                            <option value="Approved" @if($request->status == 'Approved') selected @endif>Approved</option>
                                            <option value="Rejected" @if($request->status == 'Rejected') selected @endif>Rejected</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Status</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
