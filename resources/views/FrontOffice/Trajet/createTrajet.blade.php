@extends('FrontOffice.layout')
    @section('content')
<div class="content-wrapper">
    @auth
    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home <i class="ion-ios-arrow-forward"></i></a></span> 
              <span><a href="{{ route('showRideByUser', ['id' => auth()->user()->id]) }}">my rides <i class="ion-ios-arrow-forward"></i></a></span>

            <span>Add ride <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">Add Ride</h1>
          </div>
        </div>
      </div>
    </section>
    <div class="container-xxl flex-grow-1 container-p-y">
        <span class="text-muted fw-light">
            <!-- <div class="d-flex">
                <a href='trajets'>
                    <h4 class="fw-bold py-3 mb-4">Trajets </h4>
                </a>
                <h4 class="fw-bold py-3 mb-4"> / Add New Trajet</h4>
            </div> -->
        </span>
        <header>
        </header>
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <section class="ftco-section contact-section">
                    <div class="container">
                        <div class="row d-flex contact-info justify-content-center">
                            <div class="col-md-8">
                                <h2 class="text-lg font-medium text-gray-900">
                                    Make your ride
                                </h2>
                                <form method="post" action="{{ route('addRide') }}" enctype="multipart/form-data" class="bg-light p-5 contact-form">
                                    @csrf
                                    <div>
                                        <x-input-label for="Départ" value="Départ" />
                                        <input id="depart" name="depart" type="text" class="form-control"  autofocus autocomplete="depart" />
                                        @if($errors->has('depart'))
                                         <div class="text-danger">{{ $errors->first('depart') }}</div>
                                       @endif
                                    </div>
                                    <div>
                                        <x-input-label for="Destination" value="Destination" />
                                        <input id="destination" name="destination" type="text" class="form-control"  autofocus autocomplete="destination" />
                                        @if($errors->has('destination'))
                                         <div class="text-danger">{{ $errors->first('destination') }}</div>
                                       @endif
                                    </div>
                                    <div>
                                        <x-input-label for="Date du départ" value="Date du départ" />
                                        <input id="date_depart" name="date_depart" type="date" class="form-control"  autofocus autocomplete="date_depart" />
                                        @if($errors->has('date_depart'))
                                         <div class="text-danger">{{ $errors->first('date_depart') }}</div>
                                       @endif
                                    </div>
                                    <div>
                                        <x-input-label for="Heure du départ" value="Heure du départ" />
                                        <input id="heure_depart" name="heure_depart" type="time" class="form-control"  autofocus autocomplete="heure_depart" />
                                        @if($errors->has('heure_depart'))
                                         <div class="text-danger">{{ $errors->first('heure_depart') }}</div>
                                       @endif
                                    </div>
                                    <div>
                                        <x-input-label for="Nombre du places disponibles" value="Nombre du places disponibles" />
                                        <input id="nombre_places_disponibles" name="nombre_places_disponibles" type="number" class="form-control"  autofocus autocomplete="nombre_places_disponibles" />
                                        @if($errors->has('nombre_places_disponibles'))
                                         <div class="text-danger">{{ $errors->first('nombre_places_disponibles') }}</div>
                                       @endif
                                    </div>
                                    <div>
                                        <x-input-label for="Prix par passager" value="Prix par passager" />
                                        <input id="prix_par_passager" name="prix_par_passager" type="number" class="form-control"  autofocus autocomplete="prix_par_passager" />
                                        @if($errors->has('prix_par_passager'))
                                         <div class="text-danger">{{ $errors->first('prix_par_passager') }}</div>
                                       @endif
                                    </div>
                             
                                    <div class="flex justify-center items-center  gap-4" style="text-align: center;">
                                       <x-primary-button class="btn btn-primary py-2 px-4 mt-3 " type="submit">Save</x-primary-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    @endauth
</div>
@endsection
