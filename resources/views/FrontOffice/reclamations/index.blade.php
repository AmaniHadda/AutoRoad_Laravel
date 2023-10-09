@extends('FrontOffice.layout')
@section('content')

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
      <div class="ftco-animate pb-5">
        <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Reclamations <i class="ion-ios-arrow-forward"></i></span></p>
        <h1 class="mb-3 bread">Reclamation Interface</h1>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section">
  <div class="container">
    <div class="grid-container">
      <div class="form-section mb-4">
        <h1>Submit a reclamation</h1>
        <form action="{{ route('reclamations.store') }}" method="post">
          @csrf
          <div class="form-group">
            <label for="reclamationSubject" class="sr-only">Reclamation Subject</label>
            <input type="text" class="form-control" name="reclamationSubject" placeholder="Enter Reclamation Subject" required>
          </div>

          <div class="form-group">
            <label for="reclamationMessage" class="sr-only">Reclamation Message</label>
            <textarea class="form-control" name="reclamationMessage" rows="6" placeholder="Enter Reclamation Message" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary btn-lg">Submit Reclamation</button>
        </form>
      </div>

      <div class="reclamations-section">
        <h1>List of Reclamations</h1>
        <div class="table-responsive text-nowrap">
            <table class="table">
              <thead>
                <tr>
                    <th>Subject</th>
                    <th>Message</th>
                    <th class="text-right">Status</th>
                </tr>
            </thead>            
                <tbody>
                  @foreach (auth()->user()->reclamations as $reclamation)
                  <tr>
                      <td style="max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; padding: 5px;">{{ $reclamation->subject }}</td>
                      <td style="max-width: 400px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; padding: 5px;">{{ $reclamation->message }}</td>
                      <td style="padding: 20px;" class="text-right">
                          @if ($reclamation->treated)
                              <span class="badge badge-success">Treated</span>
                          @else
                              <span class="badge badge-danger">Not Treated</span>
                          @endif
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

@endsection
