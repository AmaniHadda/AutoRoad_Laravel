@extends('BackOffice.home')  
@section('content')
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Events / Edit event</h4>


            <div class="row ">
                <div class="offset-1 col-10">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Basic Layout</h5>
                      <a class="float-end" href="/admin/events">
                        <button type="button" class="btn btn-icon btn-outline-secondary">
                          <span class='bx bx-left-arrow-alt'></span>
                        </button>                 
                      </a> 
                    </div>
                    <div class="card-body">
                      <form action="/admin/events/{{$event->id}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')


                        <div class="mb-3">
                          <label class="form-label" for="Title">Title</label>
                          <input type="text" class="form-control" name="title" id="Title" value="{{$event->title}}" placeholder="Enter the title" />
                          @error('title')
                          <div class="text-danger">
                            {{$message}}
                          </div>
                          @enderror
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="Date">Event date</label>
                          <input type="date" class="form-control" name="date" id="Date" value="{{$event->date_event}}"/>
                          @error('date')
                          <div class="text-danger">
                            {{$message}}
                          </div>
                          @enderror
                        </div>
                        <div class="mb-3 row d-flex align-items-center"> 
                          <label class="form-label" for="Image">Image</label>
                            <div class="col-2">
                              @if ($event->image_path)
                            <img style="width: 100px; height: 90px;" src="/images/{{$event->image_path}}"  alt="Event Image">
                            @endif
                          </div>
                          <div class="col-10">
                            <input
                            type="file"
                            name="image"
                            id="Image"
                            class="form-control"
                          />
                          </div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="Description">Description</label>
                          <textarea
                            id="Description"
                            name="description"
                            class="form-control"
                            placeholder="Enter the description"
                            
                          >{{$event->description}}</textarea>
                          @error('description')
                          <div class="text-danger">
                            {{$message}}
                          </div>
                          @enderror
                        </div>
                        <div class="text-end">
                        <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                      </form>
                      
                    </div>
                  </div>
                </div>
              </div>
              </div>
              </div>

        <!-- / Content -->
@endsection