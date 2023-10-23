@extends('BackOffice.home')
@section('content')
<div class="content-wrapper">
    @auth
    <div class="container-xxl flex-grow-1 container-p-y">
        <span class="text-muted fw-light">
            <div class="d-flex">
            <a href="{{ route('TrajetsAdmin') }}">
                    <h4 class="fw-bold py-3 mb-4">Trajets </h4>
                </a>
                <h4 class="fw-bold py-3 mb-4"> / Trajet Details</h4>
            </div>
        </span>
        <div class="card">
            <h4 class="card-header">Trajet Details</h5>
            <div class="row">
                <div class="card-header" style="flex: 1;">
                    <img src="/images/ride1.jpg" alt="Image"
                        style="max-width: 100%; height: auto;">
                </div>

                <div style="flex: 2;">
                    <!-- <div class="d-flex align-items-center"><h5 class="text-primary">Départ: </h5><h5> {{$trajet->depart}}</h5></div> -->
                    <h5>Départ : {{$trajet->depart}}</h5>
                    <h5>Destination : {{$trajet->destination}}</h5>
                    <h5>Prix par passager : {{$trajet->prix_par_passager}} DT</h5>
                    <h5>Date du départ : {{$trajet->date_depart}}</h5>
                    <h5>Heure du départ : {{$trajet->heure_depart}}</h5>
                    <h5>Nombre de personnes disponibles : {{$trajet->nombre_places_disponibles}}</h5>
                    <h5>Owner: {{$trajet->user->name}}</h5>
                    
                </div>
            </div>
        </div>
        @endauth
    </div>
</div>
@endsection