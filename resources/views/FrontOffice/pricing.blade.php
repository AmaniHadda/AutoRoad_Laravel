@extends('FrontOffice.layout')
@section('content')
@auth
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_2.jpg');"
    data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
            <div class="col-md-9 ftco-animate pb-5">
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home <i
                            class="ion-ios-arrow-forward"></i></a></span> <span>Pricing <i
                        class="ion-ios-arrow-forward"></i></span></p>
                <h1 class="mb-3 bread">Car Pricing</h1>
            </div>
        </div>
    </div>
</section>
<div class="mb-3 mr-3">
    <button type="button" class="btn  btn-block btn-rounded mt-3" data-toggle="modal" style="background-color:#ea9244e8"
        data-target="#myModal">
        <h4 style="color:white">Click Here to see Your Rented Cars</h4>
    </button>
    @include('FrontOffice.Vehicle.Search')
</div>
<link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css">

{{-- Modal My Rentings --}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    style="position: fixed; margin: auto; width: 320px; height: 100%;">
    <div class="modal-dialog" role="document" style="position: fixed; margin: auto; width: 320px; height: 100%;">
        <div class="modal-content" style="height: 100%; overflow-y: auto;">
            <div class="modal-header" style="display: flex; justify-content: space-between; align-items: center;">
                <h4 class="modal-title" id="myModalLabel">My Rentings</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 15px 15px 80px">
                <ul>
                    @foreach ($listvehicules as $vehicle)
                        @if ($vehicle->Status == 'Rented' && $vehicle->user_id == auth()->user()->id)
                            <li style="display: flex; justify-content: space-between; align-items: center;">
                                <div style="display: flex; align-items: center;">
                                    <div style="margin-right: 10px;">
                                        <img src="{{ asset('../images/Vehicles/' . $vehicle->Image) }}" alt="{{ $vehicle->Model }}" width="100" height="80"> <!-- Increase the width -->
                                    </div>
                                    <span style="font-size: 18px;">{{ $vehicle->Model }}</span> <!-- Increase the font size -->
                                </div>
                                <a href="{{ route('Show', $vehicle->id) }}">
                                    <i class="bx bx-show" style="color: blue; font-size: 24px;"></i> <!-- Increase the icon size -->
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="car-list">
                    <table class="table">
                        <thead class="thead-primary">
                            <tr class="text-center">
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th class="bg-primary heading">Per Hour Rate</th>
                                <th class="bg-dark heading">Per Day Rate</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listvehicules as $vehicle)
                            <tr class="">
                                <td class="car-image">
                                    <div class="img"
                                        style="background-image: url({{ asset('../images/Vehicles/' . $vehicle->Image) }})">
                                    </div>
                                </td>
                                <td class="product-name">
                                    <h3>{{$vehicle->Model}}</h3>
                                    <p class="mb-0">
                                        <span>{{$vehicle->Vehicle_Condition}}</span>
                                    </p>
                                </td>
                                <td class="price">
                                    @if($vehicle->Status == 'Rented')
                                    <p class="btn-custom">
                                        <button style="background-color:white;color:orange"
                                            href="#" disabled>Car Currently
                                            rented</button>
                                    </p>
                                    @else
                                    <p class="btn-custom">
                                        <a href="{{ route('paiement', $vehicle) }}">Rent a car per hour</a>
                                    </p>
                                    @endif
                                    <div class="price-rate">
                                        <h3>
                                            <span class="num">
                                                <small class="currency">DT</small>
                                                <span style="margin-left: 10px">{{ $vehicle->Price }}</span>
                                            </span>
                                            <span class="per">/per hour</span>
                                        </h3>
                                        <span class="subheading">3DT/hour fuel surcharges</span>
                                    </div>
                                </td>
                                <td class="price">
                                    @if($vehicle->Status == 'Rented')
                                    <p class="btn-custom">
                                        <button href="{{ route('paiement', $vehicle) }}"
                                            style="background-color:white;color:orange" disabled>Car Currently
                                            Rented</button>
                                    </p>
                                    @else
                                    <p class="btn-custom">
                                        <a href="{{ route('paiement', $vehicle) }}">Rent a car per day</a>
                                    </p>
                                    @endif
                                    <div class="price-rate">
                                        <h3>
                                            <span class="num">
                                                <small class="currency">DT</small>
                                                <span style="margin-left: 10px">{{ $vehicle->PriceDay }}</span>
                                            </span>
                                            <span class="per">/per day</span>
                                        </h3>
                                        <span class="subheading">Save Up to 20%</span>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endauth
@endsection
