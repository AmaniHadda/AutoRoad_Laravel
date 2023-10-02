@extends('FrontOffice.layout')
@section('content')

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
      <div class="col-md-9 ftco-animate pb-5">
        <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Reclamations <i class="ion-ios-arrow-forward"></i></span></p>
        <h1 class="mb-3 bread">Submit a Reclamation</h1>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section">
  <div class="container">
    <div class="row d-flex justify-content-center">
      <div class="col-md-10 text-center d-flex ftco-animate">
        <div class="reclamation-entry justify-content-end">
          <!-- You can add a form here for users to submit their reclamation -->
          <form action="{{ route('reclamations.store') }}" method="post">
            @csrf
            <!-- Add form fields for the reclamation details -->
            <div class="form-group">
              <label for="reclamationSubject">Reclamation Subject</label>
              <input type="text" class="form-control" id="reclamationSubject" name="reclamationSubject" required>
            </div>
            <div class="form-group">
              <label for="reclamationMessage">Reclamation Message</label>
              <textarea class="form-control" id="reclamationMessage" name="reclamationMessage" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn-custom">Submit Reclamation</button>
          </form>
        </div>
      </div>
    </div>
    <!-- Display a list of existing reclamations here if needed -->
    <!-- Example: You can loop through your reclamation data and display it in a similar way as the blog entries -->
  </div>
</section>

@endsection
