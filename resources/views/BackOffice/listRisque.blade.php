@extends('BackOffice.home')
@section('content')
    <div class="content-wrapper">
        @auth
        <div class="container-xxl flex-grow-1 container-p-y ">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="fw-bold py-3 "><span class="text-muted fw-light"></span> Risks</h4>
        <div >
            <a type="submit" class="btn btn-primary" data-bs-target="#basicModal" href="ajoutRisque">
              <i class='bx bx-message-square-add pb-1'></i>
              Add Risk
            </a>
          </div>
        </div>
            <div class="d-flex justify-content-between">
            </div>
            
            <div class="card">
                <h3 class="card-header">Risks Table</h3>
                <div class="table-responsive text-nowrap">
                    <table class="table"id="contactsTable">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Categorie</th>
                            <th>Pourcentage</th>
                            <th>Actions</th>
                        </tr>

                        </thead>
                        <tbody>
                        @foreach($donnees as $donnee)
                            <tr>
                                <td>{{$donnee->title}}</td>
                                <td>{{$donnee->description}}</td>
                                <td>{{$donnee->categorie}}</td>
                                <td>{{$donnee->probabilite}} %</td>

                                <td>
                                    <a href="modifRisque/{{$donnee->id}}"> <i class="bx bx-edit-alt me-2" style="color:grey"></i></a>
                                    <a href="deleteRisque/{{$donnee->id}}"><i class="bx bx-trash me-2" style="color:red"></i></a>
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
        
                for (var i = 1; i < rows.length; i++) {
                    var row = rows[i];
                    var cells = row.getElementsByTagName("td");
                    var found = false;
        
                    for (var j = 0; j < cells.length; j++) {
                        var cell = cells[j];
                        if (cell.textContent.toLowerCase().includes(searchTerm)) {
                            found = true;
                            break;
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
