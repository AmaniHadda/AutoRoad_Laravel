
@extends('FrontOffice.layout')
@section('content')

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('../images/bg_2.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
      <div class="col-md-9 ftco-animate pb-5">
          <p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="ion-ios-arrow-forward"></i></a></span> 
            <span class="mr-2"><a href="/event">event <i class="ion-ios-arrow-forward"></i></a></span>
            <span>details</span>
        </p>
        <h1 class="mb-3 bread">Event details</h1>
      </div>
    </div>
  </div>
</section>
@if (session()->has('message')) 
    <div class="alert alert-success d-flex justify-content-between" role="alert">
      <div>{{session()->get('message')}}</div>
      <div><small><i class="icon-bell"></i> 1 sec ago</small></div>
    </div>
     @endif 
@if (session()->has('error')) 
     <div class="alert alert-danger d-flex justify-content-between" role="alert">
       <div>{{session()->get('error')}}</div>
       <div><small><i class="icon-bell"></i> 1 sec ago</small></div>
     </div>
      @endif 

<section class="ftco-section">
  <div class="container">
    <div class="row d-flex justify-content-center">
      <div class="col-md-10 text-center d-flex ftco-animate">
          <div class="blog-entry justify-content-end">
          <img class="img-fluid w-75" src="/images/{{$event->image_path}}" alt="">
          
          <div class="text pt-4">
              <div class="meta mb-3">
              <div><a href="#">{{$event->date_event}}</a></div>
              <div><a href="#">{{$event->user->name}}</a></div>
            </div>
            <h3 class="heading mt-2"><a href="#">{{$event->title}}</a></h3>
            <p>{{$event->description}}</p>
            @if (Auth::user())
            <form action="/participatEvent" method="POST" >
              @csrf
              <input type="text" hidden name="event_id" value="{{$event->id}}"/>
            <p><button type="submit" href="#" style="background: none;border: none;cursor: pointer;" class="btn-custom">
              @if ($event->users->contains(Auth::user()))
              See receipt
          @else
              Participate
          @endif
              
              <span class="icon-long-arrow-right"></span></button></p>
            </form>
            @endif
          </div>
        </div>
      </div>
  </div>
</section>

@endsection