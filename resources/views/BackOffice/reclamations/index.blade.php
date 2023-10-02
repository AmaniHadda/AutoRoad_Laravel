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
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($reclamations as $reclamation)
                        <tr>
                            <td>{{ $reclamation->subject }}</td>
                            <td>{{ $reclamation->message }}</td>
                            <td>{{ $reclamation->user->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->
    </div>
    <!-- / Content -->
</div>
@endsection
