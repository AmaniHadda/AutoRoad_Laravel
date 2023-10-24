@extends('BackOffice.home')  
@section('content')
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h2 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Autoroad /</span> Users</h2>

              <!-- Basic Bootstrap Table -->
              <div class="card">
                <h5 class="card-header">Table Users</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>email</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0 alldata" >
                      @foreach ($listUsers as $b)
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger"></i><i class="bx bx-user me-2"></i> <strong>{{$b->name}}</strong></td>
                        <td> <i class="menu-icon tf-icons bx bx-book-content"></i>{{$b->email}}</td>
                        <td>
                         
                          {{date('d-m-Y ', strtotime($b->updated_at))}} at {{date('h:m ', strtotime($b->updated_at))}}
                          
                        </td>
                        <td>
                         
                              {{date('d-m-Y ', strtotime($b->updated_at))}} at {{date('h:m ', strtotime($b->updated_at))}}
                          
                        </td>
                        <td>
                          <span class="badge bg-label-success me-1">Actif</span>
                        </td>
                        <td>
                          {{-- <div class="d-flex align-items-center">
                       
                            <a class="btn text-primary" href="/admin/blogs/{{$b->id}}" data-bs-toggle="tooltip" data-bs-offset="0,2" data-bs-placement="bottom" data-bs-html="true"  title="<span>Show</span>"><i class='bx bxs-show '></i></a>
                              <a class="btn text-secondary" href="/admin/blogs/{{$b->id}}/edit" data-bs-toggle="tooltip" data-bs-offset="0,2" data-bs-placement="bottom" data-bs-html="true"  title=" <span>Edit</span>" ><i class="bx bx-edit-alt"></i></a>
                                <button class="btn text-danger" type="button"class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-{{ $b->id }}" ><i class="bx bx-trash "></i></button>
                                
                            </div> --}}
                        </td>
                      </tr>  
                      @endforeach
                    </tbody>
                   
                  </table>
                  <div style="margin-left: 85%">
                 {{$listUsers->links()}} 
                    </div>
              <!--/ Basic Bootstrap Table -->
            </div>
            <!-- / Content --></div></div></div>

        

@endsection