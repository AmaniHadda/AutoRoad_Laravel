@extends('BackOffice.home')
@section('content')

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
      <div class="col-md-9 ftco-animate pb-5">
          <h3 class="breadcrumbs d-flex">
            <span ><a href="/admin/listRisque" class="menu-link" style="color:#32333798">
             <strong> Risks</strong>
            </span>
            <span style="color:#32333798">
              /Edit Risk
            </span>
              <a>
              </h3>
      </div>
    </div>
      
    <div class="row block-9 justify-content-center mb-5">
      <div class="col-md-8 mb-md-5">
        <h2>Modifier Risque</h2>
        <form action="{{url('admin/editRisque')}}" method="POST" class="bg-light p-5 contact-form">
          @csrf
          <input type="text" hidden name="id" value="{{$donnees['id']}}">
          <div class="form-group">
              <label for="title">Title : </label>
              <input type="text" name="title" id="title" class="form-control" placeholder="Title" value="{{$donnees->title}}">
              @error('title')
              <div class="text-danger">{{ $message }}</div>
          @enderror
          </div>
          <div class="form-group">
              <label for="description">Description : </label>
              <input type="text" name="description" id="description" class="form-control" placeholder="Description" value="{{$donnees->description}}">
              @error('description')
              <div class="text-danger">{{ $message }}</div>
          @enderror
          </div>
          <div class="form-group">
              <label for="categorie">Categorie : </label>
              <input type="text" name="categorie" id="categorie" class="form-control" placeholder="Categorie" value="{{$donnees->categorie}}">
              @error('categorie')
              <div class="text-danger">{{ $message }}</div>
          @enderror
          </div>
          <div class="form-group">
              <label for="probabilite">Pourcentage : </label>
              <input type="number" name="probabilite" id="probabilite" class="form-control" placeholder="Probabilite" value="{{$donnees->probabilite}}">
              @error('probabilite')
              <div class="text-danger">{{ $message }}</div>
          @enderror
          </div>
          <input type="submit" value="Update risk" class="btn btn-primary py-3 px-5 mt-3">
      </form>
      
      </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div id="map" class="bg-white"></div>
        </div>
    </div>
  </div>
</section>
@endsection