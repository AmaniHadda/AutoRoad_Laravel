@extends('BackOffice.home')
@section('content')
<div class="content-wrapper">
    @auth
    <div class="container-xxl flex-grow-1 container-p-y">
        <span class="text-muted fw-light">
            <div class="d-flex">
                <a href='/admin/vehicules'>
                    <h4 class="fw-bold py-3 mb-4">Vehicle </h4>
                </a>
                <h4 class="fw-bold py-3 mb-4"> / Rent</h4>
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
                                    Reserve the Car For Renting
                                </h2>
                                <form method="post" action="{{ route('stripebackoffice', $Vehicle_id) }}" class="bg-light p-5 contact-form">
                                    @csrf
                                    <div>
                                        <x-input-label for="PUD" value="Pick-up date" />
                                        <x-text-input id="PUD" name="PUD" type="date" class="form-control" autofocus autocomplete="PUD" />
                                        @if($errors->has('PUD'))
                                        <div class="text-danger">{{ $errors->first('PUD') }}</div>
                                        @endif
                                    </div><br />
                                
                                    <div class="form-group">
                                        <label class="label">Select Offer Type:</label><br />
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="offerType" id="offerPerHour" value="hour">
                                            <label class="form-check-label" for="offerPerHour">Offer per hour</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="offerType" id="offerPerDay" value="day">
                                            <label class="form-check-label" for="offerPerDay">Offer per day</label>
                                        </div>
                                        @if($errors->has('offerType'))
                                        <div class="text-danger">{{ $errors->first('offerType') }}</div>
                                        @endif
                                        
                                    </div>
                                    <br />
                                
                                    <div id="durationInputHour">
                                        <x-input-label for="NbreHours" value="Number of Hours" />
                                        <x-text-input id="NbreHours" name="NbreHours" type="number" class="form-control" value="" autofocus autocomplete="NbreHours" />
                                        @if($errors->has('NbreHours'))
                                        <div class="text-danger">{{ $errors->first('NbreHours') }}</div>
                                        @endif
                                    </div>
                                
                                    <div id="durationInputDay" style="display: none;">
                                        <x-input-label for="NbreDays" value="Number of Days" />
                                        <x-text-input id="NbreDays" name="NbreDays" type="number" class="form-control" value="" autofocus autocomplete="NbreDays" />
                                        @if($errors->has('NbreDays'))
                                        <div class="text-danger">{{ $errors->first('NbreDays') }}</div>
                                        @endif
                                    </div>
                                
                                    <div>
                                        <x-input-label for="PUT" value="Pick Up Time" />
                                        <x-text-input id="PUT" name="PUT" type="time" class="form-control" autofocus autocomplete="PUT" />
                                        @if($errors->has('PUT'))
                                        <div class="text-danger">{{ $errors->first('PUT') }}</div>
                                        @endif
                                    </div>
                                
                                    <div class="flex items-center gap-4">
                                        <x-primary-button class="btn btn-primary py-3 px-5 mt-3" type="submit">Save</x-primary-button>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {
        const offerPerHourRadio = $("#offerPerHour");
        const offerPerDayRadio = $("#offerPerDay");
        const durationInputHour = $("#durationInputHour");
        const durationInputDay = $("#durationInputDay");

        // Event listener for the offerPerHour radio button
        offerPerHourRadio.on("change", function() {
            durationInputHour.show();
            durationInputDay.hide();
        });

        // Event listener for the offerPerDay radio button
        offerPerDayRadio.on("change", function() {
            durationInputHour.hide();
            durationInputDay.show();
        });
    });
            </script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

            @endauth
        </div>
        @endsection