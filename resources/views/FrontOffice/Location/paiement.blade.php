@extends('FrontOffice.layout')
@section('content')
@auth
<div class="hero-wrap" style="background-image: url('../images/bg_20.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text justify-content-start align-items-center">
      <div class="col-lg-6 col-md-6 ftco-animate d-flex align-items-end">
        <div class="text">
          <h1 class="mb-4"><span>Book Now</span> <span>Your Ride</span></h1>
          <p style="font-size: 18px;">
            We prioritize reducing congestion, carbon emissions, and commute times,
            while simultaneously enhancing accessibility and safety for all citizens.
          </p>
          <a href="https://vimeo.com/45830194" class="icon-wrap popup-vimeo d-flex align-items-center mt-4">
            <div class="icon d-flex align-items-center justify-content-center">
              <span class="ion-ios-play"></span>
            </div>
            <div class="heading-title ml-5">
              <span>Easy steps to book a car</span>
            </div>
          </a>
        </div>
      </div>
      <div class="col-lg-2 col"></div>
      <div class="col-lg-4 col-md-6 mt-0 mt-md-5 d-flex">




        <div class="form-group">
          @if(isset($rentingPrice))
          <a class="btn btn-primary py-3 px-4"
            href="{{ route('stripePaiementInterface', ['rentingPrice' => $rentingPrice, 'vehicle' => $vehicle]) }}">Proceed
            To Pay</a>
          @else

          <form action="{{route('stripe',$vehicle)}}" class="request-form ftco-animate" method="POST">
            @csrf
            <h2>Rent Your Vehicle</h2>
            <div class="form-group">
              <label for="PUD" class="label">Pick-up date</label>
              <input type="date" id="PUD" name="PUD" class="form-control" placeholder="dd/mm/yyyy">
              @if($errors->has('PUD'))
              <div class="text-danger">{{ $errors->first('PUD') }}</div>
              @endif
            </div>
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
            </div>
            @if($errors->has('offerType'))
            <div class="text-danger">{{ $errors->first('offerType') }}</div>
            @endif
            <div class="form-group" id="durationInputHour">
              <label for="NbreHours" class="label">Number Of Hours</label>
              <input type="number" id="NbreHours" name="NbreHours" class="form-control" placeholder="Number Of Hours"
                value="">
              @if($errors->has('NbreHours'))
              <div class="text-danger">{{ $errors->first('NbreHours') }}</div>
              @endif
            </div>
            <div class="form-group" id="durationInputDay" style="display: none;">
              <label for="NbreDays" class="label">Number Of Days</label>
              <input type="number" id="NbreDays" name="NbreDays" class="form-control" placeholder="Number Of Days"
                value="">
              @if($errors->has('NbreDays'))
              <div class="text-danger">{{ $errors->first('NbreDays') }}</div>
              @endif
            </div>
            <div class="d-flex">
              <div class="form-group ml-2">
                <label for="PUT" class="label">Pick-up time</label>
                <input type="time" id="PUT" name="PUT" class="form-control" placeholder="Time">
                @if($errors->has('PUT'))
                <div class="text-danger">{{ $errors->first('PUT') }}</div>
                @endif
              </div>
            </div>
            <div class="form-group">
              <input type="submit" value="Book Vehicle" class="btn btn-primary py-3 px-4">
            </div>
        </div>

        </form>

        @endif
      </div>
    </div>
  </div>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
  $(document).ready(function () {
              var rentedDates= {!! json_encode($rentedDates) !!};
              $('#PUD').on('change', function () {
                  var selectedDate = $(this).val();
                  if (rentedDates.includes(selectedDate)) {
                      // Date is in the list of rented dates
                      // You can prevent form submission or show an error message
                      toastr.error('This date is already rented.');
                      $(this).val(''); // Clear the input field
                  }
              });
          });
</script>

<script>
  @if (isset($error))
      toastr.error('{{ $error }}');
  @endif
</script>

@endauth
@endsection