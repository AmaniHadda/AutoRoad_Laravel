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
    var channel = pusher.subscribe('channel-event');
    channel.bind('participate-event', function(data) {
      console.log(data)
      toastr.info(data.user +" participates in this event "+ data.event+" now.");
    });
  </script>



          <div class="content-wrapper">
            <!-- Content -->
            @if (session()->has('message'))
            <div
            class="bs-toast toast fade show bg-success mx-5 my-5 position-absolute top-0 end-0"
            role="alert"
            aria-live="assertive"
            aria-atomic="true"
          >
            <div class="toast-header">
              <i class="bx bx-bell me-2"></i>
              <div class="me-auto fw-semibold">AutoRoad</div>
              <small>1 sec ago</small>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
              {{session()->get('message')}}
            </div>
          </div>
            @endif
          
            
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Autoroad /</span> Events</h4>
              <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="start-0">
              <div class="input-group input-group-merge">
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
                <a href="events/create">
                  <button class="btn btn-primary" type="button">
                    <i class='bx bx-message-square-add pb-1'></i> 
                    Add event</button>
              </a>              
            </div>
</div>
              <!-- Basic Bootstrap Table -->
              <div class="card">
                <h5 class="card-header">Table Events</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Owner</th>
                        <th>participations</th>
                        <th style="padding-left: 75px">Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0 alldata">
                      
                      @foreach ($events as $event)
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$event->title}}</strong></td>
                        <td><img style="width: 50px; height: 50px;" src="/images/{{$event->image_path}}" alt=""></td>
                        <td>{{ \Illuminate\Support\Str::limit($event->description, $limit = 20, $end = '...') }}</td>

                      </td>
                        <td>
                          {{$event->date_event}}
                        </td>
                        <td><span class="badge bg-label-primary me-1">{{$event->user->name}}</span></td>
                        <td>
                          {{$event->users()->count()}} person
                        </td>
                        <td>
                          
                            <div class="d-flex ">
                              <a class="btn text-primary" href="/admin/events/{{$event->id}}"
                                data-bs-toggle="tooltip"
                                data-bs-offset="0,2"
                                data-bs-placement="bottom"
                                data-bs-html="true"  
                                title=" <span>Show</span>"
                                ><i class='bx bxs-show me-1'></i> </a
                              >
                              <a class="btn" href="/admin/events/{{$event->id}}/edit"
                                data-bs-toggle="tooltip"
                                data-bs-offset="0,2"
                                data-bs-placement="bottom"
                                data-bs-html="true"  
                                title=" <span>Edit</span>"
                                ><i class="bx bx-edit-alt me-1"></i> </a
                              >


                                
                            
                                  <button class="btn text-danger" 
                                  data-bs-target="#modal-{{ $event->id }}"
                                  data-bs-toggle="modal"
                          data-bs-target="#modalToggle"
                                  data-bs-toggle="tooltip"
                                data-bs-offset="0,2"
                                data-bs-placement="bottom"
                                data-bs-html="true"  
                                title=" <span>Delete</span>"
                                  ><i class="bx bx-trash me-1"></i> </button>
                                  
                                   <div
                                      class="modal fade"
                                      id="modal-{{ $event->id }}"
                                      aria-labelledby="modalToggleLabel"
                                      tabindex="-1"
                                      style="display: none"
                                      aria-hidden="true"
                                        >
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="modalToggleLabel">Confirmation</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                              <div class="modal-body">Are you sure you want to delete {{$event->title}} ?</div>
                              <div class="modal-footer">
                                <form action="/admin/events/{{$event->id}}" method="POST">
                                  @csrf
                                  @method('delete')
                                <button
                                type="submit"
                                  class="btn btn-danger"
                                  data-bs-target="#modalToggle2"
                                  data-bs-toggle="modal"
                                  data-bs-dismiss="modal"
                                >
                                  Delete
                                </button>
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
                    <tbody id="ContentSearch" class="table-border-bottom-0 searchdata">
                    </tbody>
                  </table>
                  <div class="m-3 d-flex justify-content-end">
                    {{$events->links()}}
                  </div>
                </div>
              </div>
              <!--/ Basic Bootstrap Table -->
            </div>
            <!-- / Content -->

        
 
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
            </script>
@endsection
