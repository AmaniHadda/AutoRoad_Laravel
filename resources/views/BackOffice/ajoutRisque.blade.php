@extends('BackOffice.home')
@section('content')
<section class="ftco-section contact-section">
    <div class="row block-9 justify-content-center mb-5">
      <div class="col-md-8 mb-md-5">
        <h2 class="text-center"><br><br>Add a new Risque</h2>
        <form method="post" action="ajoutRisque" class="bg-light p-5 contact-form">
        @csrf
   
        <div>
            <x-input-label for="title"  :value="__('Title : ')"/>
            <x-text-input id="title"  name="title" type="text" class="form-control"  autofocus autocomplete="title" />
            @error('title')
            <div class="text-danger">{{ $message }}</div>
        @enderror

        </div>
        <div>
            <x-input-label for="description"  :value="__('description : ')"/>
            <x-text-input id="description" name="description" type="text" class="form-control"  autofocus autocomplete="description" />
            @error('description')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        </div>
        <div>
            <x-input-label for="categorie"  :value="__('categorie : ')"/>
            <x-text-input id="categorie" name="categorie" type="text" class="form-control"  autofocus autocomplete="categorie" />
            @error('categorie')
            <div class="text-danger">{{ $message }}</div>
        @enderror
            </div>
        <div>
            <x-input-label for="probabilite"  :value="__('Pourcentage : ')"/>
            <x-text-input id="probabilite" name="probabilite" type="number" class="form-control"  autofocus autocomplete="probabilite" />
            @error('probabilite')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        </div>
        <div class="flex items-center gap-4">
            <x-primary-button class="btn btn-primary py-3 px-5 mt-3">Add</x-primary-button>
        </div>
        </form>
    </div>
</div>
</section>
@endsection