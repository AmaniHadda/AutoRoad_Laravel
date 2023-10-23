@extends('BackOffice.home')
@section('content')

          <div class="content-wrapper">
            @auth
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Contacts</h4>
              <div class="card">
                <h3 class="card-header">Contacts Table</h3>
                <div class="table-responsive text-nowrap">
                  <table class="table"id="contactsTable">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Categorie</th>
                        <th>Message</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($donnees as $donnee)
                          <tr>
                              <td>{{$donnee->name}}</td>
                              <td>
                                  <a href="mailto: {{$donnee->email}}">
                                      {{$donnee->email}}
                                  </a>
                              </td>
                              <td>{{$donnee->subject}}</td>
                              <td>{{$donnee->risques->categorie}}</td>
                              <td>{{$donnee->message}}</td>

                              <td>
                                <a href="modifContact/{{$donnee->id}}"> <i class="bx bx-edit-alt me-2" style="color:grey"></i></a>
                                <a href="deleteContact/{{$donnee->id}}"><i class="bx bx-trash me-2" style="color:red"></i></a>
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
