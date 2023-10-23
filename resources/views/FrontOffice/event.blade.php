@extends('FrontOffice.layout')
    @section('content')
    
    
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Events <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">Events</h1>
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
        <div class="row justify-content-center mb-5">
          <div class="offset-md-3 col-md-6 heading-section text-center ftco-animate">
          	<span class="subheading">Events</span>
            <h2>Available Events</h2>
          </div>
          <div class="col-md-3 d-flex justify-content-end">
            <p><a href="/event/favoris" class="btn btn-black btn-outline-black mr-1 p-2" style="font-size: 17px">
              <i class="icon-heart"></i>
              
              Favoris ({{$favoris}})
             
            </a></p>
          </div>

        </div>
        <div class="row d-flex">
          @foreach ($events as $event)
          <div class="col-md-4 d-flex ftco-animate">
          	<div class="blog-entry justify-content-end">
              <a href="/event/{{$event->id}}" class="block-20" style="background-image: url('/images/{{$event->image_path}}');">
              </a>
              <div class="text pt-4">
              	<div class="meta mb-3">
                  <div><a href="#">{{$event->date_event}}</a></div>
                  <div><a href="#">{{$event->user->name}}</a></div>
                </div>
                <h3 class="heading mt-2"><a href="/event/{{$event->id}}">{{$event->title}}</a></h3>
                <p>{{ \Illuminate\Support\Str::limit($event->description, $limit = 80, $end = '...') }}</p>
                @if (Auth::user())
                <form action="/event/favoris/" method="POST" >
                  @csrf
                  <input type="text" hidden name="event_id" value="{{$event->id}}"/>
                <p><button type="submit" style="border: none;background: none;cursor: pointer;" class="btn-custom"><a >Add favoris</a> <span class="icon-long-arrow-right"></span></button></p>
                @endif
                </form>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>	


   @endsection