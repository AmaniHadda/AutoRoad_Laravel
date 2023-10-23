@extends('BackOffice.home')
@section('content')
<div class="content-wrapper">
    @auth
    <div class="container-xxl flex-grow-1 container-p-y">
        <span class="text-muted fw-light">
            <div class="d-flex">
                <a href="{{route('VehiculesAdmin')}}">
                    <h4 class="fw-bold py-3 mb-4">Vehicles </h4>
                </a>
                <h4 class="fw-bold py-3 mb-4"> / Edit Vehicle</h4>
            </div>
        </span>
        <header>
            <meta name="viewport" content="width=device-width, initial-scale=1">
        </header>
        <div class="card">
            <h5 class="card-header"><strong>Vehicle Details</strong></h5>
            <div class="row">
                <div class="card-header" style="flex: 1;">
                    <img src="/images/Vehicles/{{$vehicle->Image}}" alt="{{$vehicle->Model}}'s Image"
                        style="max-width: 100%; height: auto;">
                </div>

                <div style="flex: 2;">
                    <h5><strong> Vehicle Model : </strong>{{$vehicle->Model}}</h5>
                    <h5><strong> Price : </strong>{{$vehicle->Price}} DT</h5>
                    <h5><strong> Color : </strong>{{$vehicle->Color}}</h5>
                    <h5><strong> Features : </strong>{{$vehicle->Features}}</h5>
                    <h5><strong> Vehicle Condition : </strong>{{$vehicle->Vehicle_Condition}}</h5>
                    <h5><strong> Fuel Type : </strong>{{$vehicle->Fuel_Type}}</h5>
                    <h5><strong> Fuel Consumption : </strong>{{$vehicle->Fuel_Consumption}}</h5>
                    <h5><strong> Current Owner : </strong>{{$vehicle->Current_Owner}}</h5>
                    <div class="d-flex">
                    <h5><strong> Status :  </strong></h5><h5 class="badge bg-label-danger  me-1" >{{$vehicle->Status}}</h5>
                    </div>
                </div>
            </div>
        </div>
        @endauth
    </div>
</div>
@endsection