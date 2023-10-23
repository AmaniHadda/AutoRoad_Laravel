{{-- @extends('BackOffice.home')

@section('content')
    <div class="content-wrapper">
        
        @auth
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-primary text-white">Recherche de Contacts</div>

                            <div class="card-body">
                                <form action="{{ route('searchResults') }}" method="POST">
                                    @csrf <!-- Ajoutez ce champ CSRF pour des raisons de sécurité -->

                                    <div class="form-group">
                                        <label for="subject">Subject :</label>
                                        <input type="text" name="subject" id="subject" class="form-control" placeholder="Entrez la subject">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Rechercher</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endauth
    </div>
@endsection 
<nav
class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
<div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
        <i class="bx bx-menu bx-sm"></i>
    </a>
</div>

<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
    <!-- Search -->
    <div class="navbar-nav align-items-center">
        <div class="nav-item d-flex align-items-center">
            <i class="bx bx-search fs-4 lh-0"></i>
            <input
                type="text"
                class="form-control border-0 shadow-none"
                placeholder="Search..."
                aria-label="Search..."
            />
        </div>
    </div> --}}