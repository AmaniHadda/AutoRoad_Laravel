@extends('BackOffice.home')
@section('content')
<div class="content-wrapper">
    @auth
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Rentings</h4>
        </div>
        <br />
        <div class="card">
            <h5 class="card-header">Renting Table</h5>
            <div class="table-responsive text-nowrap">
                <table class="table"id="contactsTable">
                    <thead>
                        <tr>
                            <th>Pick Up Date</th>
                            <th>Pick Up Time</th>
                            <th>STATUS</th>
                            <th>Drop Off Date</th>
                            <th>Confirmation</th>
                            <th>renting Price</th>
                            <th>Vehicle Model</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach($listRentings as $Renting)
                        <tr>
                            <td>{{$Renting->PUD}}</td>
                            <td>{{$Renting->PUT}}</td>
                            <td>
                                <span class="badge bg-label-{{ $Renting->STATUS === "Approved" ? "success" : "warning"
                                    }} me-1">
                                    {{ $Renting->STATUS }}
                                </span>
                            </td>
                            <td>{{$Renting->DOD}}</td>
                            <td> <span class="badge bg-label-{{ $Renting->Confirmation ==="payed" ? "success"
                                    : "warning" }} me-1">
                                    {{$Renting->Confirmation}}
                                </span></td>
                            <td>{{$Renting->rentingPrice}} DT</td>
                            <td>{{ $Renting->vehicle->Model }}</td>
                            <td>
                                <div class="d-flex">
                                    <div class="col">
                                        <a href="{{ route('getEditRenting', ['Renting_id' => $Renting->id]) }}" class="btn">
                                            <i class="bx bx-edit-alt  " style="color: grey;"></i>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <button class="btn text-danger" type="button" class="btn btn-primary"
                                            data-bs-toggle="modal" data-bs-target="#modal-{{ $Renting->id }}"><i
                                                class="bx bx-trash "></i></button>
                                    </div>
                                    <!--confirmation modal-->
                                    <div class="modal fade" id="modal-{{ $Renting->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel1">Confirmation</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="row g-2">
                                                            <div class="col">
                                                                Are you sure you want to delete the Rent Of "
                                                                {{$Renting->vehicle->Model}} " ? </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <form action="/admin/delete/{{$Renting->id}}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" data-bs-toggle="tooltip"
                                                            data-bs-offset="0,2" data-bs-placement="bottom"
                                                            data-bs-html="true" title="<span>Delete</span>"
                                                            class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <!--end confirmation modal-->
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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