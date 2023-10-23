@extends('FrontOffice.layout')

@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url('../images/bg_2.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
            <div class="col-md-9 ftco-animate pb-5">
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home <i class="ion-ios-arrow-forward"></i></a></span><span><a href="{{ route('rides') }}">rides List <i class="ion-ios-arrow-forward"></i></a></span><span>My rides <i class="ion-ios-arrow-forward"></i></span></p>
                <h1 class="mb-3 bread">My Rides</h1>
            </div>
        </div>
    </div>
</section>

<div class="content-wrapper">
    @auth

    <div class="row">
        <div class="col-md-6">
            <h2 class="mt-4 ml-4" style="color: orange;">List of my rides</h2>
        </div>
        <div class="col-md-6 col-sm-6 text-md-right">
    <a href="{{ route('getAddRide') }}" class="btn btn-primary btn-add-ride mr-5 mt-3">Add Ride</a>
</div>

    </div>
    @if (count($trajets) > 0)
 <div class="row">
            @foreach($trajets as $trajet)
            <div class="col-md-4 mb-4">
                <div class="card custom-card" style="margin-left: 20px; margin-top: 30px; margin-right: 20px;">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="mr-3">
                                <iconify-icon class="icon" icon="uil:car"></iconify-icon>
                            </div>
                            <h5 class="card-title" style="color: hsla(189, 89%, 17%, 1)">
                                {{ $trajet->depart }}
                                <iconify-icon class="icon ml-3 mr-3" icon="typcn:arrow-up-outline" rotate="270deg" flip="horizontal,vertical" style="font-size: 25px;"></iconify-icon>
                                {{ $trajet->destination }}
                            </h5>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="mr-3">
                                <iconify-icon class="icon" icon="uil:usd-circle"></iconify-icon>
                            </div>
                            <p class="card-text">
                                {{ $trajet->prix_par_passager }} DT
                            </p>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="mr-3">
                                <iconify-icon class="icon" icon="uil:calendar-alt"></iconify-icon>
                            </div>
                            <p class="card-text">
                                {{ $trajet->date_depart }}
                            </p>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="mr-3">
                                <iconify-icon class="icon" icon="uil:clock"></iconify-icon>
                            </div>
                            <p class="card-text">
                                {{ $trajet->heure_depart }}
                            </p>
                        </div>
                        <div class="mt-3 d-flex justify-content-between align-items-center">
    <div>
        <a href="{{ route('deleteRide', $trajet->id) }}" onclick="event.preventDefault();
            if (confirm('Are you sure you want to delete this ride?')) {
                document.getElementById('delete-vehicle-form-{{ $trajet->id }}').submit();
            }" class="text-decoration-none">
            <iconify-icon icon="ph:x-bold" style="font-size: 30px;"></iconify-icon>
        </a>
    </div>
    <div>
        <a href="{{ route('getEditRide', ['id' => $trajet->id]) }}" class="text-decoration-none mr-2">
            <iconify-icon icon="carbon:edit" style="font-size: 30px;"></iconify-icon>
        </a>
    </div>
    <div>
        <a href="{{ route('showMyRide', ['id' => $trajet->id]) }}" class="text-decoration-none">
            <iconify-icon icon="mdi:eye"  style="font-size: 30px;"></iconify-icon>
        </a>
    </div>
</div>



                        <form id="delete-vehicle-form-{{ $trajet->id }}"
                            action="{{ route('deleteRide', $trajet->id) }}" method="POST"
                            style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row justify-content-center  mb-4 ">
                <div class="col-md-12 text-center">
                {{ $trajets->links('custom_pagination', ['next_class' => 'next-link']) }}

                </div>
            </div>
        @else
    <div class="text-center mt-5">
        <h3 class="mb-5">You don't have any rides yet.</h3>
       
    </div>
    @endif
    </div>
    @endauth
</div>

<style>
    .card-text {
        color: hsla(189, 89%, 17%, 1);
    }

    /* Styles pour les cartes personnalisées */
    .custom-card {
        border-radius: 10px; /* Coins arrondis */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Ombre */
        margin: 20px 0; /* Marges supérieure et inférieure */
        padding: 15px;
    }

    .custom-card .card-title {
        font-size: 18px;
        margin-bottom: 10px;
    }

    .custom-card .card-text {
        font-size: 16px; /* Augmenter la taille du texte */
    }

    /* Styles pour les icônes */
    .icon {
        font-size: 24px; /* Augmenter la taille des icônes */
        color: hsla(189, 89%, 17%, 1); /* Changer la couleur des icônes en bleu */
        vertical-align: middle; /* Aligner les icônes verticalement avec le texte */
    }

    /* Style pour le bouton "Add Ride" */
    .btn-add-ride {
        margin-top: 10px;
    }
</style>
@endsection
