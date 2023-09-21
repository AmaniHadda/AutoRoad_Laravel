@extends('FrontOffice.layout')
    @section('content')
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
          <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
            <div class="col-md-9 ftco-animate pb-5" >
                <p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Register <i class="ion-ios-arrow-forward"></i></span></p>
              <h1 class="mb-3 bread">Fogot Password</h1>
            </div>
          </div>
        </div>
      </section>
      <section class="ftco-section contact-section">
        <div class="container">
      <div class="row block-9 justify-content-center mb-5">
        <div class="col-md-8 md-5">
           <div>
            <h4 class=" text-center">Forgot your password?</h4>
            <p class="mb-4 text-center">No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.🚀</p>
           </div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" style="color: green;" />

    <form method="POST" action="{{ route('password.email') }}" class="bg-light p-5 contact-form">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="form-control"  type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" style="color: #e15757; list-style:none" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="btn btn-primary py-3 px-5 ">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</div></div></div></section>
@endsection

