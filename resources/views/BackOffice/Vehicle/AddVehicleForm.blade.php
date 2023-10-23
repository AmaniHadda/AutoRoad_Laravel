@extends('BackOffice.home')
@section('content')
<div class="content-wrapper">
    @auth
    <div class="container-xxl flex-grow-1 container-p-y">
        <span class="text-muted fw-light">
            <div class="d-flex">
                <a href='vehicules'>
                    <h4 class="fw-bold py-3 mb-4">Vehicles </h4>
                </a>
                <h4 class="fw-bold py-3 mb-4"> / Add New Vehicle</h4>
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
                                    Add Vehicle
                                </h2>
                                <form method="post" action="{{ route('addVehicle') }}" enctype="multipart/form-data" class="bg-light p-5 contact-form">
                                    @csrf
                                    <div>
                                        <x-input-label for="Model" value="Model" />
                                        <x-text-input id="Model" name="Model" type="text" class="form-control" 
                                            autofocus autocomplete="Model" />    @if($errors->has('Model'))
                                            <div class="text-danger">{{ $errors->first('Model') }}</div>
                                            @endif
                                    </div>
                                    <div>
                                        <x-input-label for="Vehicle_Condition" value="Vehicle_Condition" />
                                        <x-text-input id="Vehicle_Condition" name="Vehicle_Condition" type="text"
                                            class="form-control"  autofocus autocomplete="Vehicle_Condition" />
                                            @if($errors->has('Vehicle_Condition'))
                                            <div class="text-danger">{{ $errors->first('Vehicle_Condition') }}</div>
                                            @endif
                                    </div>
                                    <div>
                                        <x-input-label for="Color" value="Color" />
                                        <x-text-input id="Color" name="Color" type="color" class="form-control" 
                                            autofocus autocomplete="Color" />
                                            @if($errors->has('Color'))
                                            <div class="text-danger">{{ $errors->first('Color') }}</div>
                                            @endif
                                    </div>
                                    <div>
                                        <x-input-label for="Price" value="Price" />
                                        <x-text-input id="Price" name="Price" type="number" class="form-control" 
                                            autofocus autocomplete="Price" />
                                            @if($errors->has('Price'))
                                            <div class="text-danger">{{ $errors->first('Price') }}</div>
                                            @endif
                                    </div>
                                    <div>
                                        <x-input-label for="Fuel_Type" value="Fuel_Type" />
                                        <x-text-input id="Fuel_Type" name="Fuel_Type" type="text" class="form-control"
                                             autofocus autocomplete="Fuel_Type" />
                                            @if($errors->has('Fuel_Type'))
                                            <div class="text-danger">{{ $errors->first('Fuel_Type') }}</div>
                                            @endif
                                    </div>
                                    <div>
                                        <x-input-label for="Fuel_Consumption" value="Fuel_Consumption" />
                                        <x-text-input id="Fuel_Consumption" name="Fuel_Consumption" type="text"
                                            class="form-control" autofocus autocomplete="Fuel_Consumption" />
                                            @if($errors->has('Fuel_Consumption'))
                                            <div class="text-danger">{{ $errors->first('Fuel_Consumption') }}</div>
                                            @endif
                                    </div>
                                    <div>
                                        <x-input-label for="Features" value="Features" />
                                        <x-text-input id="Features" name="Features" type="text" class="form-control"
                                         autofocus autocomplete="Features" />
                                            @if($errors->has('Features'))
                                            <div class="text-danger">{{ $errors->first('Features') }}</div>
                                            @endif
                                    </div>
                                    <div>
                                        <x-input-label for="Image" value="Image" />
                                        <x-text-input id="Image" name="Image" type="file" class="form-control" 
                                            autofocus autocomplete="Image" />
                                            @if($errors->has('Image'))
                                            <div class="text-danger">{{ $errors->first('Image') }}</div>
                                            @endif
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <x-primary-button class="btn btn-primary py-3 px-5 mt-3" type="submit">Save
                                        </x-primary-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            @endauth
        </div>
        @endsection