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
                            <th>Driver</th>
                            <th>Status</th>
                            <th>Action</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($reclamations as $reclamation)
                        <tr>
                            <td>{{ $reclamation->subject }}</td>
                            <td>{{ $reclamation->message }}</td>
                            <td>{{ $reclamation->user->name }}</td>
                            <td>{{ $reclamation->driver_name}}</td>
                            <td>{{ $reclamation->treated ? 'Treated' : 'Not Treated' }}</td>
                            <td>
                                @if (!$reclamation->treated)
                                <form action="{{ route('markAsTreated', $reclamation->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" style="background: none; border: green; padding: 0;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: green;">
                                            <path d="M18.5 2h-12C4.57 2 3 3.57 3 5.5V22l7-3.5 7 3.5v-9h5V5.5C22 3.57 20.43 2 18.5 2zM15 18.764l-5-2.5-5 2.5V5.5C5 4.673 5.673 4 6.5 4h8.852A3.451 3.451 0 0 0 15 5.5v13.264zM20 11h-3V5.5c0-.827.673-1.5 1.5-1.5s1.5.673 1.5 1.5V11z"></path>
                                            <path d="M11 7H9v2H7v2h2v2h2v-2h2V9h-2z"></path>
                                        </svg>
                                    </button>
                                    
                                </form>
                                @else
                                <form action="{{ route('markAsNotTreated', $reclamation->id) }}" method="POST">
                                    @csrf
                                    @method('PUT') {{-- Use PUT method for marking as not treated --}}
                                    <button type="submit" style="background: none; border: green; padding: 0;">
                                        <svg xmlns="http://www.w3.org/2000/svg" style="fill: orange;" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M18.5 2h-12C4.57 2 3 3.57 3 5.5V22l7-3.5 7 3.5v-9h5V5.5C22 3.57 20.43 2 18.5 2zM13 11H7V9h6v2zm7 0h-3V5.5c0-.827.673-1.5 1.5-1.5s1.5.673 1.5 1.5V11z"></path></svg>
                                    </button>
                                </form>
                                @endif
                            </td>
                            <td>  {{-- Delete Form --}}
                                <form action="{{ route('reclamations.destroy', $reclamation->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: none; border: none; padding: 0;">
                                        <svg xmlns="http://www.w3.org/2000/svg" style="fill: red;" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1); transform: ; msFilter:;">
                                            <path d="M5 20a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8h2V6h-4V4a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v2H3v2h2zM9 4h6v2H9zM8 8h9v12H7V8z"></path>
                                            <path d="M9 10h2v8H9zm4 0h2v8h-2z"></path>
                                        </svg>
                                    </button>                                   
                                </form>
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
