@extends('BackOffice.home')

@section('content')
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Reclamations</h4>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Reclamation Table</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>User</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($reclamations as $reclamation)
                        <tr>
                            <td>{{ $reclamation->subject }}</td>
                            <td>{{ $reclamation->message }}</td>
                            <td>{{ $reclamation->user->name }}</td>
                            <td>{{ $reclamation->treated ? 'Treated' : 'Not Treated' }}</td>
                            <td>
                                @if (!$reclamation->treated)
                                <form action="{{ route('markAsTreated', $reclamation->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">Mark as Treated</button>
                                </form>
                                @else
                                <form action="{{ route('markAsNotTreated', $reclamation->id) }}" method="POST">
                                    @csrf
                                    @method('PUT') {{-- Use PUT method for marking as not treated --}}
                                    <button type="submit" class="btn btn-warning">Mark as Not Treated</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
