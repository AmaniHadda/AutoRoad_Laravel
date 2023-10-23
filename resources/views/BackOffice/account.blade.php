    @extends('BackOffice.home')  
    @section('content')
    <div class="content-wrapper">
      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>
      <section class="ftco-section contact-section">
        <div class="container">
          <div class="row d-flex contact-info justify-content-center">
              <div class="col-md-8">
                    @include('profile.partialsAdmin.update-profile-information-form')
              </div></div>
                  <div class="row d-flex mt-5 contact-info justify-content-center">
                      <div class="col-md-8 ">
                    @include('profile.partialsAdmin.update-password-form')
                </div></div></div>
              </section>
      </div></div>
@endsection
