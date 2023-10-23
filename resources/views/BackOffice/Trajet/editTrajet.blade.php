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
                <h4 class="fw-bold py-3 mb-4"> / Edit Trajet</h4>
            </div>
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
                                    Edit Trajet
                                </h2>
                                <form method="post" action="{{ route('editTrajet', $Trajet->id) }}"
                                    enctype="multipart/form-data" class="bg-light p-5 contact-form">
                                    @csrf
                                    @method('put')
                                    <div>
                                        <x-input-label for="Départ" value="Départ" />
                                        <input id="depart" name="depart" type="text" value="{{ $Trajet->depart }}"class="form-control" required autofocus autocomplete="depart" />
                                    </div>
                                    <div>
                                        <x-input-label for="Destination" value="Destination" />
                                        <input id="destination" name="destination" type="text" value="{{$Trajet->destination}}" class="form-control" required autofocus autocomplete="destination" />
                                    </div>
                                    <div>
                                        <x-input-label for="Date du départ" value="Date du départ" />
                                        <input id="date_depart" name="date_depart" type="date" value="{{$Trajet->date_depart}}" class="form-control" required autofocus autocomplete="date_depart" />
                                    </div>
                                    <div>
                                        <x-input-label for="Heure du départ" value="Heure du départ" />
                                        <input id="heure_depart" name="heure_depart" type="time" value="{{$Trajet->heure_depart}}" class="form-control" required autofocus autocomplete="heure_depart" />
                                    </div>
                                    <div>
                                        <x-input-label for="Nombre du places disponibles" value="Nombre du places disponibles" />
                                        <input id="nombre_places_disponibles" name="nombre_places_disponibles" type="number" value="{{$Trajet->nombre_places_disponibles}}" class="form-control" required autofocus autocomplete="nombre_places_disponibles" />
                                    </div>
                                    <div>
                                        <x-input-label for="Prix par passager" value="Prix par passager" />
                                        <input id="prix_par_passager" name="prix_par_passager" type="number" value="{{$Trajet->prix_par_passager}}" class="form-control" required autofocus autocomplete="prix_par_passager" />
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
