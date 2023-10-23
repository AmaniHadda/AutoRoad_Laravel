@extends('BackOffice.home')  
@section('content')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script>
    Pusher.logToConsole = true;
    var pusher = new Pusher('0bcb6a9f0ce9bd19e425', {
      cluster: 'ap1'
    });
    var channel = pusher.subscribe('popup-channel');
    channel.bind('like-event', function(data) {
      toastr.info(JSON.stringify(data.title) +" leave a comment to this blog : "+ JSON.stringify(data.name));
    });
  </script>
          <div class="content-wrapper">
            <!-- Content -->
            @if(session()->has('message'))
                <div class="bs-toast toast show m-2 bg-success top-0 end-0" style="position: fixed;"  data-delay="2000" role="alert" aria-live="assertive" aria-atomic="true">
                  <div class="toast-header">
                    <i class="bx bx-bell me-2"></i>
                    <div class="me-auto fw-semibold">Alert</div>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                  </div>
                  <div class="toast-body">
                    {{session()->get('message')}}
                  </div>
                </div>
              @endif
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="start-0">
               <h2 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Autoroad /</span> Blogs</h2>
              </div>
              <div class="d-flex align-items-center justify-content-between mb-3">
              <div class="start-0">
                <div class="input-group input-group-merge ">
                  <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                  <input
                    type="search"
                    id="search"
                    class="form-control"
                    placeholder="Search..."
                    aria-label="Search..."
                    aria-describedby="basic-addon-search31"
                  />
                </div>
              </div>
              <div class="end-0">
                <!-- Button trigger modal -->
                <form method="Get" action='/admin/blogs/create'>
                <button
                  type="submit"
                  class="btn btn-primary"
                  data-bs-toggle="modal"
                  data-bs-target="#basicModal"
                >
                <i class='bx bx-message-square-add pb-1'></i>
                Add Blog
                </button></form></div>
              </div>
              <!-- Basic Bootstrap Table -->
              <div class="card">
                <div class="table-responsive text-nowrap mt-2">
                  <table class="table" id="contactsTable">
                    <thead>
                      <tr>
                        <th class="text-center">Title</th>
                        <th class="text-center">Description</th>
                        <th class="text-center">Image</th>
                        <th class="text-center">Owner</th>
                        <th class="text-center">Created at</th>
                        <th class="text-center">Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0 alldata" >
                      @foreach ($listBlogs as $b)
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$b->title}}</strong></td>
                        <td><?php echo substr($b->description, 0, 50); ?>...</td>
                        <td>
                         
                              <img src="../images/blogs/{{$b->image}}" alt="Avatar" style="width:80px; height:80px" />
                          
                        </td>
                        <td><span class="badge bg-label-primary me-1">{{$b->user->name}}</span></td>
                        <td>
                         
                              {{date('d-m-Y', strtotime($b->created_at))}}
                          
                        </td>
                        <td>
                          <div class="d-flex align-items-center">
                       
                            <a class="btn text-primary" href="/admin/blogs/{{$b->id}}" data-bs-toggle="tooltip" data-bs-offset="0,2" data-bs-placement="bottom" data-bs-html="true"  title="<span>Show</span>"><i class='bx bxs-show '></i></a>
                              <a class="btn text-secondary" href="/admin/blogs/{{$b->id}}/edit" data-bs-toggle="tooltip" data-bs-offset="0,2" data-bs-placement="bottom" data-bs-html="true"  title=" <span>Edit</span>" ><i class="bx bx-edit-alt"></i></a>
                                <button class="btn text-danger" type="button"class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-{{ $b->id }}" ><i class="bx bx-trash "></i></button>
                                
                            </div>
                        </td>
                      </tr>  
                      <div class="modal fade" id="modal-{{ $b->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel1">Confirmation</h5>
                              <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                              ></button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="row g-2">
                                  <div class="col">
                               Are you sure you want to delete this blog " {{$b->title}} " ? </div></div>
                              </div>
                              
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                              </button>
                              <form action="/admin/blogs/{{$b->id}}" method="post">
                                @csrf
                                @method('delete')
                                <button  type="submit" data-bs-toggle="tooltip"
                                data-bs-offset="0,2"
                                data-bs-placement="bottom"
                                data-bs-html="true"  
                                title="<span>Delete</span>"
                                class="btn btn-danger"
                                >Delete</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      @endforeach
                    </tbody>
                    <tbody id="ContentSearch" class="table-border-bottom-0 searchdata">
                    </tbody>
                  </table>
                  <div style="margin-left: 85%">
                 {{$listBlogs->links()}} 
                    </div>
                </div>
              </div>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
            <script type="text/javascript">
              $(document).ready(function() {
                $('#search').on('keyup', function() {
                  var $value = $(this).val();
                  if($value){
                    $('.alldata').hide();
                    $('.searchdata').show();
                  }
                  else{
                    $('.alldata').show();
                    $('.searchdata').hide();
                  }
                  $.ajax({
                    type: 'GET',
                    url: '{{ route('search') }}',
                    data: { 'search': $value },
                    success: function(data) {
                      console.log("test");
                      $('#ContentSearch').html(data);                     
                    }
                  });
                });
              });
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