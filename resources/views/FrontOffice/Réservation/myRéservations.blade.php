@extends('FrontOffice.layout')

@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url('../images/bg_2.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
            <div class="col-md-9 ftco-animate pb-5">
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home <i class="ion-ios-arrow-forward"></i></a></span><span><a href="{{ route('rides') }}">rides List <i class="ion-ios-arrow-forward"></i></a></span><span>My Reservations<i class="ion-ios-arrow-forward"></i></span></p>
                <h1 class="mb-3 bread">My Reservations</h1>
            </div>
        </div>
    </div>
</section>

<div class="content-wrapper">
    @auth

    <div class="row">
        <div class="col-md-6">
            <h2 class="mt-4 ml-4" style="color: orange;">List of my reservations</h2>
        </div>
        <!-- <div class="col-md-6 col-sm-6 text-md-right">
    <a href="{{ route('rides') }}" class="btn btn-primary btn-add-ride mr-5 mt-3">Rides List</a>
</div> -->

    </div>
    @if (count($réservations) > 0)
 <div class="row">
            @foreach($réservations as $réservation)
            <div class="col-md-4 mb-4">
                <div class="card custom-card" style="margin-left: 20px; margin-top: 30px; margin-right: 20px;">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="mr-3">
                                <iconify-icon class="icon" icon="uil:car"></iconify-icon>
                            </div>
                            <h5 class="card-title" style="color: hsla(189, 89%, 17%, 1)">
                                {{ $réservation->trajet->depart }}
                                <iconify-icon class="icon ml-3 mr-3" icon="typcn:arrow-up-outline" rotate="270deg" flip="horizontal,vertical" style="font-size: 25px;"></iconify-icon>
                                {{  $réservation->trajet->destination }}
                            </h5>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="mr-3">
                                <iconify-icon class="icon" icon="uil:calendar-alt"></iconify-icon>
                            </div>
                            <p class="card-text">
                                {{$réservation->trajet->date_depart }}
                            </p>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="mr-3">
                                <iconify-icon class="icon" icon="uil:clock"></iconify-icon>
                            </div>
                            <p class="card-text">
                                {{ $réservation->trajet->heure_depart }}
                            </p>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="mr-3">
                                <iconify-icon class="icon" icon="uil:usd-circle"></iconify-icon>
                            </div>
                            <p class="card-text">
                                {{  $réservation->trajet->prix_par_passager }} DT
                            </p>
                        </div>
                        <div class="d-flex align-items-center mb-3 ">
  
<div class="mr-3">
    @php
        $icon = '';
        switch ($réservation->status) {
            case 'Accepté':
                $icon = 'gg:check-o';
                break;
            case 'Refusé':
                $icon = 'tabler:xbox-x';
                break;
            case 'En cours de traitement':
                $icon = 'clarity:clock-outline-badged';
                break;
            default:
                $icon = 'ion:alert-circle';
        }
    @endphp
    <iconify-icon class="icon" icon="{{ $icon }}"></iconify-icon>
</div>

@php
    $badgeClass = '';

    switch ($réservation->status) {
        case 'Accepté':
            $badgeClass = 'success';
            break;
        case 'Refusé':
            $badgeClass = 'danger';
            break;
        case 'En cours de traitement':
            $badgeClass = 'info';
            break;
        default:
            $badgeClass = 'warning';
    }
@endphp

<span class="badge bg-{{ $badgeClass }} text-white me-1" style="font-size: 14px;">
    {{ $réservation->status }}
</span>

</div>
                      
                       
 

<div class=" d-flex justify-content-center align-items-center mt-4">
                        <!-- <div class="mt-3 text-right">
                            <a href="{{ route('showRide', ['id' => $réservation->trajet_id]) }}" class="text-decoration-none">
                            <iconify-icon icon="material-symbols:slideshow-outline" flip="vertical"style="font-size: 30px;"></iconify-icon>
                           
                        </a>
                      
                        </div> -->
                    
        <a href="{{ route('destroyRéservation', $réservation->id) }}" onclick="event.preventDefault();
            if (confirm('Are you sure you want to delete this reservation?')) {
                document.getElementById('delete-vehicle-form-{{ $réservation->id }}').submit();
            }" class="text-decoration-none">
            <iconify-icon icon="ant-design:delete-outlined" style="font-size: 30px;"></iconify-icon>
        </a>
    </div>

                        <form id="delete-vehicle-form-{{ $réservation->id }}"
                            action="{{ route('destroyRéservation', $réservation->id) }}" method="POST"
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
                {{ $réservations->links('custom_pagination', ['next_class' => 'next-link']) }}

                </div>
            </div>
        @else
    <div class="text-center mt-5">
        <h3 class="mb-5">You don't have any reservations yet.</h3>
       
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
