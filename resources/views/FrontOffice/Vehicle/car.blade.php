<div id="car-section">
    <section class="ftco-section">
        <div class="container-fluid px-4">
            <div class="row justify-content-center">
                <div class="col-md-12 heading-section text-center ftco-animate mb-5">
                    <span class="subheading">What we offer</span>
                    <h2 class="mb-2">Choose Your Car</h2>
                </div>
            </div>
            <div class="row">
                @foreach ($listvehicules as $vehicle)
                <div class="col-md-3">
                    <div class="car-wrap ftco-animate">
                        <div class="img d-flex align-items-end"
                            style="background-image: url({{ asset('images/Vehicles/' . $vehicle->Image) }});">
                            <div class="price-wrap d-flex">
                                <span class="rate">{{ $vehicle->Price }}DT</span>
                                <p class="from-day">
                                    <span>From</span>
                                    <span>/Day</span>
                                </p>
                            </div>
                        </div>
                        <div class="text p-4 text-center">
                            <h2 class="mb-0"><a href="#">{{ $vehicle->Model }}</a></h2>
                            <span>{{ $vehicle->Brand }}</span>
                            <p class="d-flex mb-0 d-block">
                                @if($vehicle->Status == 'Rented')
                                <button style="background-color:white;color:orange" href="#" disabled>Car
                                    Rented</button>
                                @else
                                <a href="{{ route('paiement', $vehicle) }}"
                                    class="btn btn-black btn-outline-black mr-1">Book now</a>
                                @endif
                                <a href="{{ route('Show', ['Vehicle_id' => $vehicle->id]) }}"
                                    class="btn btn-black btn-outline-black ml-1">Details</a>
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-md-12 text-center">
                    {{ $listvehicules->links('custom_pagination', ['next_class' => 'next-link']) }}
                </div>
            </div>
        </div>
    </section>
</div>