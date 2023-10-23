@extends('Backoffice.home')

@section('content')

    <div class="content-wrapper">
        @auth
            <div class="container-xxl flex-grow-1 container-p-y">

                <!-- Formulaire de Recherche -->
                <form action="{{route('searchRisques')}}" method="POST">
                    @csrf <!-- Ajoutez ce champ CSRF pour des raisons de sécurité -->
                    <br><h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Recherche de Risques</h4>
                    <div class="form-group">
                        <label for="category">Category :</label>
                        <input type="text" name="category" id="category" class="form-control" placeholder="Enter category">
                    </div>
                    <button type="submit" class="btn btn-primary">Rechercher</button><br><br>
                </form>
            </div>
        @endauth
    </div>
@endsection
