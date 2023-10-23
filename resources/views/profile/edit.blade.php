@extends('FrontOffice.layout')
    @section('content')
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
          <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
            <div class="col-md-9 ftco-animate pb-5" >
                <p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Profile <i class="ion-ios-arrow-forward"></i></span></p>
              <h1 class="mb-3 bread">Profile</h1>
            </div>
          </div>
        </div>
      </section>
      <section class="ftco-section contact-section">
        <div class="container">
          <div class="row d-flex contact-info justify-content-center">
              <div class="col-md-8">
                    @include('profile.partials.update-profile-information-form')
              </div></div>
                  <div class="row d-flex mt-5 contact-info justify-content-center">
                      <div class="col-md-8 ">
                    @include('profile.partials.update-password-form')
                </div></div></div></section>

@endsection
