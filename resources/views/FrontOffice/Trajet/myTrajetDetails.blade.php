@extends('FrontOffice.layout')

@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url('../images/bg_2.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
      <div class="col-md-9 ftco-animate pb-5">
        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">HOME <i class="ion-ios-arrow-forward"></i></a></span><span><a href="{{ route('showRideByUser', ['id' => auth()->user()->id]) }}">My rides<i class="ion-ios-arrow-forward"></i></a></span> <span>ride details<i class="ion-ios-arrow-forward"></i></span></p>
        <h1 class="mb-3 bread">Ride Details</h1>
      </div>
    </div>
  </div>
</section>

<div class="content-wrapper">
  @if(session('message'))
    <div class="alert alert-success text-center">{{ session('message') }}</div>
  @endif
  @auth
  <div class="container-xxl flex-grow-1 container-p-y">
    <span class="text-muted fw-light">
      <div class="card border-0 shadow-sm small rounded">
        <div class="row">
          <div class="col-md-6">
            <h3 class="mt-4 ml-4" style="color: orange;">Information about your ride {{$trajet->depart}} - {{$trajet->destination}}</h3>
          </div>
          <div class="col-md-6 col-sm-6 text-md-right">
            <a href="" class="btn btn-primary btn-add-ride mr-5 mt-3" data-toggle="modal" data-target="#myModal">Reservations List</a>
          </div>
        </div>

        <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="position: fixed; margin: auto; width: 320px; height: 100%;">
          <div class="modal-dialog" role="document" style="position: fixed; margin: auto; width: 450px; height: 100%;">
            <div class="modal-content" style="height: 100%; overflow-y: auto;">
              <div class="modal-header" style="display: flex; justify-content: space-between; align-items: center;">
                <h4 class="modal-title" id="myModalLabel">My Ride Reservations </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" style="padding: 15px 15px 80px">
                @if ($reservations->count() > 0)
                  @foreach ($reservations as $reservation)
                    <div class="card mb-3 shadow-sm">
                      <div class="card-body">
                        <h5 class="card-title">Reservation by {{ $reservation->user->name }}</h5>
                        <p class="card-text" style="font-size: 14px;">Status {{ $reservation->status }}</p>
                        <p class="card-text" style="font-size: 14px;">Created at {{ $reservation->created_at }}</p>
                        <div class="d-flex justify-content-between">
                          <a href="{{ route('acceptReservation', $reservation->id) }}" style="color: green;"> <iconify-icon icon="radix-icons:check" style="font-size: 20px;"></iconify-icon></a>
                          <a href="{{ route('refuserReservation', $reservation->id) }}" style="color: red;"> <iconify-icon icon="dashicons:no-alt" style="font-size: 20px;"></iconify-icon></a>
                        </div>
                      </div>
                    </div>
                  @endforeach
                @else
                  <p>No reservations available.</p>
                @endif
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <img src="/images/ride1.jpg" alt="Image" class="img-fluid">
          </div>
          <div class="col-md-6 p-4">
            <h5 class="mb-4">Départ : {{$trajet->depart}}</h5>
            <h5 class="mb-4">Destination : {{$trajet->destination}}</h5>
            <h5 class="mb-4">Prix par passager : {{$trajet->prix_par_passager}} DT</h5>
            <h5 class="mb-4">Date du départ : {{$trajet->date_depart}}</h5>
            <h5 class="mb-4">Heure du départ : {{$trajet->heure_depart}}</h5>
            <h5 class="mb-4">Nombre de places disponibles : {{$trajet->nombre_places_disponibles}}</h5>
            <h5 class="mb-4">Owner: {{$trajet->user->name}}</h5>
          </div>
        </div>
      </div>
    </span>
  </div>
  @endauth
</div>
@endsection
