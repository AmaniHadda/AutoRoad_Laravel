@extends('FrontOffice.layout')
    @section('content')
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
          <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
            <div class="col-md-9 ftco-animate pb-5" >
                <p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Register <i class="ion-ios-arrow-forward"></i></span></p>
              <h1 class="mb-3 bread">Register</h1>
            </div>
          </div>
        </div>
      </section>
      <section class="ftco-section contact-section">
        <div class="container">
      <div class="row block-9 justify-content-center mb-5">
        <div class="col-md-8 md-5">
           <div>
            <h4 class=" text-center">Welcome to <a class="navbar-brand" href="/">Auto<span>road</span></a>! 👋</h4>
            <p class="mb-4 text-center">Adventure starts here 🚀</p>
           </div>
{{-- <x-guest-layout> --}}
    <!-- Session Status -->
    <x-auth-session-status class="" :status="session('status')" />

    <form method="POST" action="{{ route('register') }}" class="bg-light p-5 contact-form">
        <div class="col-md-12 heading-section text-center ftco-animate">
            <span class="subheading">Register</span>
          <h2 class="">Enter your credentials</h2>
        </div>
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Enter your name"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2" style="color: #e15757; list-style:none" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Enter your email"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" style="color: #e15757; list-style:none" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="form-control"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="Enter your password"/>

            <x-input-error :messages="$errors->get('password')" class="mt-2" style="color: #e15757; list-style:none" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="form-control"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password"/>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" style="color: #e15757; list-style:none" />
        </div>

        <div class="flex items-center justify-end mt-4">
            

            <x-primary-button class="btn btn-primary py-3 px-5 ">
                {{ __('Register') }}
            </x-primary-button>
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mx-5" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        </div>
    </form>
{{-- </x-guest-layout> --}}
</div></div></div></section>
@endsection
