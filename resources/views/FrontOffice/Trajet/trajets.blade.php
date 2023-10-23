@extends('FrontOffice.layout')

@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
  <!-- Votre en-tête ici -->
</section>

<div class="content-wrapper">
    @auth
    <style>
        .rent-label {
            display: none;
            text-align: center;
            background-color: #f2daa3;
            color: #ffffff;
            padding: 2px 2px;
            border: 1px solid #f2daa3;
            border-radius: 5px;
            position: relative;
            top: 5px;
        }
        .btn:hover .rent-label {
            display: block;
        }
          </style>
    @if(session('message'))
            <div class="alert alert-success text-center">{{ session('message') }}</div>
    @endif
    <div class="container-xxl flex-grow-1 container-p-y">
        <h2 class="text-center mt-4" style="color: orange;">Choose Your Ride</h2>
        <section class="ftco-section ftco-no-pb ftco-no-pt">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="search-wrap-1 ftco-animate ">
                            <form action="{{ route('filterRides') }}" method="post" class="search-property-1">
                                @csrf
                                <div class="row">
                                    <div class="col-lg align-items-end">
                                        <div class="form-group">
                                            <label for="#">Select Depart Date</label>
                                            <div class="form-field">
                                                <div class="select-wrap">
                                                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                                    <input type="date" name="date_depart" value="date_depart" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg align-items-end">
                                        <div class="form-group">
                                            <label for="#">Select Depart</label>
                                            <div class="form-field">
                                                <div class="select-wrap">
                                                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                                    <select name="depart" class="form-control" value="depart">
                                                        <option value="">Select Depart</option>
                                                       
                                                         <option value="Ariana">Ariana</option>
                                                         <option value="Beja">Béja</option>
                                                         <option value="Ben Arous">Ben Arous</option>
                                                        <option value="Bizerte">Bizerte</option>
                                                        <option value="Gabes">Gabès</option>
                                                         <option value="Gafsa">Gafsa</option>
                                                         <option value="Jendouba">Jendouba</option>
                                                        <option value="Kairouan">Kairouan</option>
                                                        <option value="Kasserine">Kasserine</option>
                                                        <option value="Kebili">Kébili</option>
                                                        <option value="Le Kef">Le Kef</option>
                                                        <option value="Mahdia">Mahdia</option>
                                                        <option value="Manouba">La Manouba</option>
                                                         <option value="Medenine">Médenine</option>
                                                         <option value="Monastir">Monastir</option>
                                                      <option value="Nabeul">Nabeul</option>
                                                      <option value="Sfax">Sfax</option>
                                                     <option value="Sidi Bouzid">Sidi Bouzid</option>
                                                     <option value="Siliana">Siliana</option>
                                                     <option value="Sousse">Sousse</option>
                                                      <option value="Tataouine">Tataouine</option>
                                                        <option value="Tozeur">Tozeur</option>
                                                        <option value="Tunis">Tunis</option>
                                                      <option value="Zaghouan">Zaghouan</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg align-items-end">
                                        <div class="form-group">
                                            <label for="#">Select Destination</label>
                                            <div class="form-field">
                                                <div class="select-wrap">
                                                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                                    <select name="destination" class="form-control" value="destination">
                                                        <option value="">Select Destination</option>
                                                        <option value="Ariana">Ariana</option>
                                                         <option value="Beja">Béja</option>
                                                         <option value="Ben Arous">Ben Arous</option>
                                                        <option value="Bizerte">Bizerte</option>
                                                        <option value="Gabes">Gabès</option>
                                                         <option value="Gafsa">Gafsa</option>
                                                         <option value="Jendouba">Jendouba</option>
                                                        <option value="Kairouan">Kairouan</option>
                                                        <option value="Kasserine">Kasserine</option>
                                                        <option value="Kebili">Kébili</option>
                                                        <option value="Le Kef">Le Kef</option>
                                                        <option value="Mahdia">Mahdia</option>
                                                        <option value="Manouba">La Manouba</option>
                                                         <option value="Medenine">Médenine</option>
                                                         <option value="Monastir">Monastir</option>
                                                      <option value="Nabeul">Nabeul</option>
                                                      <option value="Sfax">Sfax</option>
                                                     <option value="Sidi Bouzid">Sidi Bouzid</option>
                                                     <option value="Siliana">Siliana</option>
                                                     <option value="Sousse">Sousse</option>
                                                      <option value="Tataouine">Tataouine</option>
                                                        <option value="Tozeur">Tozeur</option>
                                                        <option value="Tunis">Tunis</option>
                                                      <option value="Zaghouan">Zaghouan</option>
                                                    
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg align-self-end">
                                        <div class="form-group">
                                            <div class="form-field">
                                                <input type="submit" value="Search" class="form-control btn btn-primary">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="row">
            @foreach($listTrajets as $trajet)
            <div class="col-md-4 mb-1">
                <div class="card custom-card" style="margin-left: 20px; margin-top: 30px; margin-right: 20px;">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="mr-3">
                                <iconify-icon class="icon" icon="uil:car"></iconify-icon>
                            </div>
                            <h5 class="card-title" style="color: hsla(189, 89%, 17%, 1)"> <!-- Changer la couleur en noir -->
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
                        <div class="mt-3 text-right">
                            <a href="{{ route('showRide', ['id' => $trajet->id]) }}" class="text-decoration-none">
                            <iconify-icon icon="mdi:eye"  style="font-size: 30px;"></iconify-icon>
                        </a>
                        </div>
                        <div class="mt-3 text-left">
                            <a href="{{ route('addRéservation', ['id' => $trajet->id]) }}" class="btn" style="font-size: 33px;color:orange">
                            <iconify-icon icon="typcn:plus-outline"></iconify-icon>
                            <span class="rent-label" style="width:60px;height:35px;font-size:20px">Book</span>
                        </a>
                        </div>
                     
                    </div>
                    </div>
                </div>
            </div>
            @endforeach
           
        </div>
        <div class="row justify-content-center  mb-4 ">
                <div class="col-md-12 text-center">
                {{ $listTrajets->links('custom_pagination', ['next_class' => 'next-link']) }}

                </div>
            </div>
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
        margin: 30px 0; /* Marges supérieure et inférieure */
        padding: 15px;
    }

    .custom-card .card-title {
        font-size: 18px;
        margin-bottom: 2px;
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
</style>
@endsection