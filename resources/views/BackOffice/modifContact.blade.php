@extends('BackOffice.home')
@section('content')
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
          	<h3 class="breadcrumbs">
              <span class="mr-2">
                <a href="/admin/listContact" style="color:#32333798">
                 <strong> Contacts </strong>
                  <i class="ion-ios-arrow-forward"></i>
                </a>
              </span> 
              <span style="color:#32333798">
                /Edit Contact 
                <i class="ion-ios-arrow-forward"></i>
              </span>
            </h3>
          </div>
        </div>
      </div>
    </section>

		<section class="ftco-section contact-section">
      <div class="container">
        <div class="row block-9 justify-content-center mb-5">
          <div class="col-md-8 mb-md-5">
          	<h2 class="text-center">Update Contact</h2>
            <form action="{{url('admin/editContact')}}" method="post" class="bg-light p-5 contact-form">
              @csrf
                <input type="text" hidden name="id" value="{{$donnees['id']}}">
              <div class="form-group">
                <input type="text" name="name" class="form-control mt-3" placeholder="Your Name" value="{{$donnees->name}}" >
                @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
              </div>
              <div class="form-group">
                <input type="text" name="email" class="form-control mt-3" placeholder="Your Email" value="{{$donnees->email}}" >
                @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
              </div>
              <div class="form-group">
                <input type="text" name="subject" class="form-control mt-3" placeholder="Subject" value="{{$donnees->subject}}" >
                @error('subject')
                <div class="text-danger">{{ $message }}</div>
            @enderror
              </div>
              <div class="form-group">
                <textarea name="message" id="" cols="30" rows="7" class="form-control mt-3" placeholder="Message" >{{$donnees->message}}</textarea>
                @error('message')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>
            
              <div class="form-group">
                <input type="submit" value="Update Message" class="btn btn-primary py-3 px-5 mt-3">
              </div>
            </form>

          </div>
        </div>
        <div class="row justify-content-center">
        	<div class="col-md-10">
        		<div id="map" class="bg-white"></div>
        	</div>
        </div>
      </div>
    </section>
@endsection
