@extends('FrontOffice.layout')
@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url('../images/image_1.jpg');"
  data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
      <div class="col-md-9 ftco-animate pb-5">
        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">HOME <i
                class="ion-ios-arrow-forward"></i></a></span> <span>Vehicle details<i
              class="ion-ios-arrow-forward"></i></span></p>
        <h1 class="mb-3 bread">Vehicle Details</h1>
      </div>
    </div>
  </div>
</section>
<div class="card  mt-4">
  <div class="row mt-5 ">
    <div class="card-header" style="flex: 1;">
      <img src="/images/Vehicles/{{$vehicle->Image}}" alt="{{$vehicle->Model}}'s Image"
        style="max-width: 100%; height: auto;">
    </div>
    <div class="card-body">
      <div class="mt-5 " style="flex: 2;">
        <div class="d-flex justify-content-between align-items-center">
          <div style="flex: 1;">
            <h5><strong>Vehicle Model : </strong> {{$vehicle->Model}}</h5>
            <h5><strong>Features : </strong> {{$vehicle->Features}}</h5>
            <h5><strong>Price : </strong>{{$vehicle->Price}} DT</h5>
            <h5><strong>Color : </strong> {{$vehicle->Color}}</h5>
          </div>
          <div style="flex: 1;">
            <h5><strong>Vehicle Condition : </strong>{{$vehicle->Vehicle_Condition}}</h5>
            <h5><strong>Fuel Type : </strong>{{$vehicle->Fuel_Type}}</h5>
            <h5><strong>Fuel Consumption : </strong>{{$vehicle->Fuel_Consumption}}</h5>
            <br />
            <span
              class="badge badge-pill {{ $vehicle->Status === 'Available' ? 'bg-custom-orange' : 'bg-warning' }} me-1"
              style="font-size: larger; background-color: orange;color:white">{{$vehicle->Status}}</span>
          </div>
        </div>

      </div>
      @if($vehicle->Status !== 'Rented')
      <a class="badge" style="background-color: rgb(138, 246, 138); color: white; font-size: larger;"
        href="{{ route('paiement', $vehicle) }}">Rent Now</a>
      @endif

    </div>
  </div>
</div>