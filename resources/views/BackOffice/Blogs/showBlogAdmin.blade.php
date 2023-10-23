@extends('BackOffice.home')  
@section('content')
<div class="content-wrapper">
<div class="container-xxl flex-grow-1 container-p-y">
  

  
  <h2 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Autoroad /</span> Details Blog</h2>

 <div class="row mb-5">
   <div class="col-md-12">
     <div class="card mb-3">
       <div class="row g-0">
         <div class="col-md-4">
           <img class="card-img card-img-left" src="../../images/blogs/{{$blog->image}}" alt="Card image" style="width: 400px; height: 450px"/>
         </div>
         <div class="col-md-8">
           <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h1 class="card-title">{{$blog->title}}</h1>
              </div>
              <div>
                <a href="/admin/blogs" class="btn btn-icon btn-outline-secondary"><i class='bx bx-arrow-back'></i></a>
              </div>
            </div>
             <p class="text-muted">By {{$blog->user->name}} on {{date('d-m-Y', strtotime($blog->created_at))}}</p>
             <p class="mb-0 mt-1">
                {{$blog->description}}
             </p>
             <p class="card-text mt-4">
                <small class="text-muted">
                    @php
                        $updatedAt = \Carbon\Carbon::parse($blog->updated_at);
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
            
            {{-- <a href="/admin/blogs/{{$blog->id}}/edit" class="btn btn-primary">Edit blog</a> --}}
            @if ($nbComments !=0)
            <h3 class="card-header">{{$nbComments}} Comments</h3>
            <div class="demo-inline-spacing mt-3">
              <div class="list-group list-group-flush">
                @foreach ($c as $comment)               
                    <a href="javascript:void(0);" class="list-group-item list-group-item-action">
                      <div class="d-flex justify-content-between align-items-center"><div><p> <i class='bx bxs-comment-dots'></i> {{$comment->message}} </p></div><div><p class="text-muted">By {{$comment->user->name}} on {{date('d-m-Y', strtotime($blog->created_at))}}</p></div></div>
                      <div>
                        <div>
                          <form action="/admin/comments/{{$comment->id}}/{{$blog->id}}" method="post">
                            @csrf
                            @method('delete')
                          <button type="submit" class="btn btn-xs btn-outline-danger mx-2">Delete</button>
                          </form>
                        </div>
                      </div>
                      </a>
                   
                    @endforeach
                  </div>
                </div>
                
           
            @endif
           
                
           </div>
         </div>
       </div>
     </div>
   </div>
  
 </div>
 <!--/ Horizontal -->
 @endsection