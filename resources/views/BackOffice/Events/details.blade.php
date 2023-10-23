@extends('BackOffice.home')  
@section('content')
<div class="content-wrapper">
<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Events / Details of the Event</h3><!-- Horizontal -->
 <div class="row mb-5">
   <div class="col-md-12">

     <div class="card mb-3">
       <div class="row g-0">
         <div class="col-md-4">
           <img class="card-img card-img-left" src="/images/{{$event->image_path}}" alt="Card image" style="width: 400px; height: 400px"/>
         </div>
         <div class="col-md-7">
           <div class="card-body">
             <h1 class="card-title">{{$event->title}}</h1>
             <p class="card-text">
              <small class="text-muted">
                  @php
                      $updatedAt = \Carbon\Carbon::parse($event->updated_at);
                      $now = \Carbon\Carbon::now();
                      $diffInSeconds = $updatedAt->diffInSeconds($now);
                      $diffInMinutes = $updatedAt->diffInMinutes($now);
                      $diffInHours = $updatedAt->diffInHours($now);
                      $diffInDays = $updatedAt->diffInDays($now);
                      
                      if ($diffInDays > 0) {
                          echo "Last updated $diffInDays days ago";
                      } elseif ($diffInHours > 0) {
                          echo "Last updated $diffInHours hours ago";
                      } elseif ($diffInMinutes > 0) {
                          echo "Last updated $diffInMinutes minutes ago";
                      } else {
                          echo "Last updated $diffInSeconds seconds ago";
                      }
                  @endphp
              </small>
            </p>
             <p class="mb-0 mt-2">
                {{$event->description}}
             </p>

             @if (count($event->users)>0)    
          <div>
             <div class="mt-4">
             <strong>
               Users who participated in this event:
              </strong>
             </div>
              <div class="mt-1">
                @foreach ($event->users as $user)
              <span class="badge bg-label-primary">{{$user->name}}</span>
              @endforeach
             </div>
          </div>
          @endif
             <p class="card-text mt-4"><small class="text-muted">Event date : {{$event->date_event}}</small></p>
              

           </div>
         </div>
         <div class="col-md-1 px-3 py-3 ">
            <a class="float-end" href="/admin/events">
                <button type="button" class="btn btn-icon btn-outline-secondary">
                  <span class='bx bx-left-arrow-alt'></span>
                </button>                 
              </a> 
           </div>
       </div>
     </div>
   </div>
  
 </div>
 <!--/ Horizontal -->
 @endsection