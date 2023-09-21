@extends('FrontOffice.layout')
    @section('content')
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
          <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
            <div class="col-md-9 ftco-animate pb-5" >
                <p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Login <i class="ion-ios-arrow-forward"></i></span></p>
              <h1 class="mb-3 bread">Login</h1>
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
            <p class="mb-4 text-center">Please sign-in to your account and start the adventure</p>
           </div>
{{-- <x-guest-layout> --}}
    <!-- Session Status -->
    <x-auth-session-status class="" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="bg-light p-5 contact-form">
        <div class="col-md-12 heading-section text-center ftco-animate">
            <span class="subheading">Log in</span>
          <h2 class="">Enter your credentials</h2>
        </div>
        @csrf
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Enter your email"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" style="color: #e15757; list-style:none" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="form-control"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="Enter your password"/>

            <x-input-error :messages="$errors->get('password')" class="mt-2" style="color: #e15757; list-style:none" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-4">
            
            <x-primary-button class="btn btn-primary py-3 px-5 ">
                {{ __('Sign in') }}
            </x-primary-button>
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mx-5" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>
    </form>
{{-- </x-guest-layout> --}}
</div></div></div></section>
@endsection