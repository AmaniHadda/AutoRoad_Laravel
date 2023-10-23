@extends('BackOffice.home')

@section('content')
<div class="content-wrapper">
    @auth
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Trajets</h4>
        </div>
        <br />
        <div class="card">
            <h5 class="card-header">Trajet Table</h5>
            <div class="table-responsive text-nowrap">
                <table class="table"id="contactsTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Depart</th>
                            <th>Destination</th>
                            <th>Date depart</th>
                            <th>Owner</th>
                            <th class="text-center">Actions</th> <!-- Utilisez text-center pour centrer le contenu -->
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach($listTrajets as $trajet)
                        <tr>
                            <td>{{ $trajet->id }}</td>
                            <td>{{ $trajet->depart }}</td>
                            <td>{{ $trajet->destination }}</td>
                            <td>{{ $trajet->date_depart }}</td>
                            <td >
                           <span class="badge badge-pill bg-label-primary text-primary me-1"> {{ $trajet->user->name}}</span>
                  <!-- {{ $trajet->user->name  }} -->
                </span>
                            </td>
                            <td class="text-center"> <!-- Utilisez text-center pour centrer le contenu -->
                                <div class="btn-group">
                                    <a class="btn btn-link" href="{{ route('showTrajet', $trajet->id) }}">
                                        <i class="bx bx-show" style="color: blue;"></i>
                                    </a>
                                    <!-- <a class="btn btn-link" href="{{ route('getEditTrajet', $trajet->id) }}">
                                        <i class="bx bx-edit-alt" style="color: grey;"></i>
                                    </a> -->
                                    <a href="{{ route('deleteTrajet', $trajet->id) }}" onclick="event.preventDefault();
                                    if (confirm('Are you sure you want to delete this ride?')) {
                                        document.getElementById('delete-vehicle-form-{{ $trajet->id }}').submit();
                                    }" class="btn btn-link">
                                        <i class="bx bx-trash" style="color: red;"></i>
                                    </a>
                                    <form id="delete-vehicle-form-{{ $trajet->id }}"
                                        action="{{ route('deleteTrajet', $trajet->id) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endauth
</div>
<script>
    function performSearch() {
        var searchTerm = document.getElementById("searchInput").value.toLowerCase();
        var table = document.getElementById("contactsTable");
        var rows = table.getElementsByTagName("tr");

        for (var i = 1; i < rows.length; i++) {  // Start from 1 to skip the header row
            var row = rows[i];
            var cells = row.getElementsByTagName("td");
            var found = false;

            for (var j = 0; j < cells.length; j++) {
                var cell = cells[j];
                if (cell.textContent.toLowerCase().includes(searchTerm)) {
                    found = true;
                    break; // No need to check other cells in the same row
                }
            }

            if (found) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        }
    }

    document.getElementById("searchInput").addEventListener("keyup", performSearch);
</script>
@endsection
