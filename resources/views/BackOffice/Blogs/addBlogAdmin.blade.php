@extends('BackOffice.home')  
@section('content')
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <h2 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Autoroad /</span> Add Blog</h2>
  <div class="col-xl">
    <div class="card mb-4">
      
      <div class="card-body">
        <form action="/admin/blogs" method="Post" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label class="form-label" for="basic-icon-default-fullname">Title</label>
            <div class="input-group input-group-merge">
              <span id="basic-icon-default-fullname2" class="input-group-text"
                ><i class="bx bx-text"></i
              ></span>
              <input
                type="text"
                class="form-control"
                id="basic-icon-default-fullname"
                name="title"
                placeholder="Title here !"
                aria-label="John Doe"
                aria-describedby="basic-icon-default-fullname2"
              />
            </div>
          </div>
          <div class="text-danger">
            @error('title')
                <p><i class='bx bx-error-circle'></i>{{$message}}</p>
            @enderror</div>
          <div class="mb-3">
            <label class="form-label" for="basic-icon-default-message">Description</label>
            <div class="input-group input-group-merge">
              <span id="basic-icon-default-message2" class="input-group-text"
                ><i class="bx bx-comment"></i
              ></span>
              <textarea
                id="basic-icon-default-message"
                class="form-control"
                name="description"
                placeholder="Description here !"
                aria-label="Hi, Do you have a moment to talk ?"
                aria-describedby="basic-icon-default-message2"
              ></textarea>
            </div>
            <div class="text-danger">
            @error('description')
                <p><i class='bx bx-error-circle'></i>{{$message}}</p>
            @enderror</div>
          </div>
          <div class="mb-3">
            <label for="formFile" class="form-label">Picture</label>
            <input class="form-control" name="image" type="file" id="formFile" />
          </div>
          <div class="text-danger">
            @error('image')
                <p><i class='bx bx-error-circle'></i>{{$message}}</p>
            @enderror</div>
          <button type="submit" class="btn btn-primary">Save</button>
          <a href="/admin/blogs" class="btn btn-secondary">Cancel</a>
        </form>
      </div>
    </div>
  </div>
</div></div>
  @endsection