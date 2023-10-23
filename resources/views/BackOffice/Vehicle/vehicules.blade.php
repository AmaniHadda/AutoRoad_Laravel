@extends('BackOffice.home')
@section('content')
<div class="content-wrapper">
  <style>
.rent-label {
    display: none;
    text-align: center;
    background-color: #a7cdf7;
    color: #fff;
    padding: 2px 10px;
    border: 2px solid #a7cdf7;
    border-radius: 5px;
    position: relative;
    top: 5px;
}
.btn:hover .rent-label {
    display: block;
}
  </style>
  @auth
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Vehicles</h4>
      <div class="text-right">
        <a type="submit" class="btn btn-primary" data-bs-target="#basicModal" href="{{ route('getaddVehicle') }}">
          <i class='bx bx-message-square-add pb-1'></i>
          Add Vehicle
        </a>
      </div>
    </div>
    <br />
    <div class="card">
      <h5 class="card-header">Vehicle Table</h5>
      <div class="table-responsive text-nowrap">
        <table class="table"id="contactsTable">
          <thead>
            <tr>
              <th>Model</th>
              <th>Status</th>
              <th>Color</th>
              <th>Price</th>
              <th>Fuel Type</th>
              <th>Image</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @foreach($listvehicules as $vehicule)
            <tr>
              <td>{{$vehicule->Model}}</td>
              <td>
                <span class="badge bg-label-{{ $vehicule->Status === "Available" ? "success" : "warning" }} me-1">
                  {{ $vehicule->Status }}
                </span>
              </td>

              <td>{{$vehicule->Color}}</td>
              <td>{{$vehicule->Price}} DT</td>
              <td>{{$vehicule->Fuel_Type}}</td>
              <td>
                <div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                  class="avatar avatar-xs pull-up" style="width:50px;height:50px">
                  <img src="/images/Vehicles/{{$vehicule->Image}}" alt="{{$vehicule->Model}}'s Image">
                </div>
              </td>
              <td>
                <div class="d-flex">
                  <div class="col">
                    <a href="{{ route('ShowVehicle', ['Vehicle_id' => $vehicule->id]) }}" class="btn">
                      <i class="bx bx-show" style="color: blue;"></i>
                    </a>
                  </div>
                  <div class="col">
                    <a href="{{ route('getEditVehicle', ['Vehicle_id' => $vehicule->id]) }}" class="btn">
                      <i class="bx bx-edit-alt  " style="color: grey;"></i>
                    </a>
                  </div>
                  <div class="col">
                    <a href="{{route('getaddRenting' ,['Vehicle_id' => $vehicule->id])}}" class="btn">
                        <i class="bx bx-cart" style="color: #a7cdf7;"></i>
                        <span class="rent-label">Rent</span>
                    </a>
                </div>
                  <div class="col">
                    <button class="btn text-danger" type="button" class="btn btn-primary" data-bs-toggle="modal"
                      data-bs-target="#modal-{{ $vehicule->id }}"><i class="bx bx-trash "></i></button>
                  </div>
                  <div class="modal fade" id="modal-{{ $vehicule->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel1">Confirmation</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <div class="row g-2">
                              <div class="col">
                                Are you sure you want to delete this vehicle " {{$vehicule->Model}} " ? </div>
                            </div>
                          </div>

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                          </button>
                          <form action="/admin/deletevehicle/{{$vehicule->id}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" data-bs-toggle="tooltip" data-bs-offset="0,2"
                              data-bs-placement="bottom" data-bs-html="true" title="<span>Delete</span>"
                              class="btn btn-danger">Delete</button>
                          </form>
                        </div>
                      </div>
                    </div>


                  </div>
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