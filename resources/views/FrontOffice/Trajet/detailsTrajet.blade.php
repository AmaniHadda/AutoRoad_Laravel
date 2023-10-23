@extends('FrontOffice.layout')

@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url('../images/bg_2.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
      <div class="col-md-9 ftco-animate pb-5">
        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">HOME <i class="ion-ios-arrow-forward"></i></a></span><span><a href="{{ route('rides') }}">rides List <i class="ion-ios-arrow-forward"></i></a></span> <span>ride details<i class="ion-ios-arrow-forward"></i></span></p>
        <h1 class="mb-3 bread">Ride Details</h1>
      </div>
    </div>
  </div>
</section>

<div class="content-wrapper">
    @auth
    <div class="container-xxl flex-grow-1 container-p-y">
        <span class="text-muted fw-light">
            <div class="card border-0 shadow-lg rounded-lg">
                <div class="row">
                <h2 class="text-lg font-medium text-gray-900 text-center mt-4 ml-5 " style="color:orange;">
                            Information about your ride {{$trajet->depart}} - {{$trajet->destination}}
                        </h2></div>
                        <div class="row">   
                    <div class="col-md-6">
                        <img src="/images/ride1.jpg" alt="Image" class="img-fluid">
                    </div>
                    <div class="col-md-6 p-4">
                      
                      
                    <h5 class="mb-4">  Départ : {{$trajet->depart}}</h5>
                      
                      
                            <h5 class="mb-4">Destination :  
                          {{$trajet->destination}}</h5>
                     
                        <h5 class="mb-4">Prix par passager : {{$trajet->prix_par_passager}} DT</h5>
                        <h5 class="mb-4">Date du départ : {{$trajet->date_depart}}</h5>
                        <h5 class="mb-4">Heure du départ : {{$trajet->heure_depart}}</h5>
                        <h5 class="mb-4">Nombre de personnes disponibles : {{$trajet->nombre_places_disponibles}}</h5>
                        <h5 class="mb-4">Owner: {{$trajet->user->name}}</h5>
                    </div>
                </div>
            </div>
        </span>
    </div>
    @endauth
</div>
@endsection
