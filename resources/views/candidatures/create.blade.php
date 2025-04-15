@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-lg rounded-lg overflow-hidden">
                <!-- Stylish header with wave effect -->
                <div class="card-header position-relative py-4" style="background: linear-gradient(135deg, #e60000 0%, #ff3333 100%);">
                    <div class="text-center position-relative z-index-1">
                        <h2 class="text-white mb-0 font-weight-bold">Formulaire de Candidature</h2>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="position-absolute bottom-0 left-0">
                        <path fill="#ffffff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,133.3C672,139,768,181,864,186.7C960,192,1056,160,1152,138.7C1248,117,1344,107,1392,101.3L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                    </svg>
                </div>

                <div class="card-body bg-light p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm rounded-lg">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="fas fa-exclamation-circle fa-2x text-danger"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1">Veuillez corriger les erreurs suivantes:</h5>
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('candidature.store') }}" enctype="multipart/form-data" class="mt-4">
                        @csrf
                        
                        <div class="row">
                            <!-- Personal Information Section -->
                            <div class="col-md-12 mb-4">
                                <h4 class="section-title position-relative pb-2">
                                    <span class="bg-white pe-2" style="color: #e60000;">
                                        <i class="fas fa-user-circle me-2"></i>Informations Personnelles
                                    </span>
                                    <hr class="position-absolute w-100 top-50" style="border-color: #e60000; opacity: 0.3;">
                                </h4>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom') }}" required style="border: 1px solid #ff8080; border-radius: 8px;">
                                    <label for="nom">Nom</label>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input id="prenom" type="text" class="form-control @error('prenom') is-invalid @enderror" name="prenom" value="{{ old('prenom') }}" required style="border: 1px solid #ff8080; border-radius: 8px;">
                                    <label for="prenom">Prénom</label>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input id="cin" type="text" class="form-control @error('cin') is-invalid @enderror" name="cin" value="{{ old('cin') }}" required style="border: 1px solid #ff8080; border-radius: 8px;">
                                    <label for="cin">CIN</label>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required style="border: 1px solid #ff8080; border-radius: 8px;">
                                    <label for="date">Date de naissance</label>
                                </div>
                            </div>

                            <!-- Contact Information Section -->
                            <div class="col-md-12 mb-4 mt-2">
                                <h4 class="section-title position-relative pb-2">
                                    <span class="bg-white pe-2" style="color: #e60000;">
                                        <i class="fas fa-address-book me-2"></i>Coordonnées
                                    </span>
                                    <hr class="position-absolute w-100 top-50" style="border-color: #e60000; opacity: 0.3;">
                                </h4>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required style="border: 1px solid #ff8080; border-radius: 8px;">
                                    <label for="email">Email</label>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input id="tel" type="text" class="form-control @error('tel') is-invalid @enderror" name="tel" value="{{ old('tel') }}" required style="border: 1px solid #ff8080; border-radius: 8px;">
                                    <label for="tel">Téléphone</label>
                                </div>
                            </div>

                            <!-- Education Section -->
                            <div class="col-md-12 mb-4 mt-2">
                                <h4 class="section-title position-relative pb-2">
                                    <span class="bg-white pe-2" style="color: #e60000;">
                                        <i class="fas fa-graduation-cap me-2"></i>Formation
                                    </span>
                                    <hr class="position-absolute w-100 top-50" style="border-color: #e60000; opacity: 0.3;">
                                </h4>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="form-floating">
                                    <select id="niveau_scolaire" class="form-select @error('niveau_scolaire') is-invalid @enderror" name="niveau_scolaire" required style="border: 1px solid #ff8080; border-radius: 8px;">
                                        <option value="">Sélectionnez</option>
                                        <option value="bac" {{ old('niveau_scolaire') == 'bac' ? 'selected' : '' }}>Bac</option>
                                        <option value="bac+2" {{ old('niveau_scolaire') == 'bac+2' ? 'selected' : '' }}>Bac+2</option>
                                        <option value="bac+3" {{ old('niveau_scolaire') == 'bac+3' ? 'selected' : '' }}>Bac+3</option>
                                    </select>
                                    <label for="niveau_scolaire">Niveau scolaire</label>
                                </div>
                            </div>

                            <!-- Documents Section -->
                            <div class="col-md-12 mb-4 mt-2">
                                <h4 class="section-title position-relative pb-2">
                                    <span class="bg-white pe-2" style="color: #e60000;">
                                        <i class="fas fa-file-upload me-2"></i>Documents Requis
                                    </span>
                                    <hr class="position-absolute w-100 top-50" style="border-color: #e60000; opacity: 0.3;">
                                </h4>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body">
                                        <label for="baccalaureat" class="form-label">
                                            <i class="fas fa-file-pdf me-2" style="color: #e60000;"></i>Baccalauréat
                                        </label>
                                        <input id="baccalaureat" type="file" class="form-control @error('baccalaureat') is-invalid @enderror" name="baccalaureat" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body">
                                        <label for="cin_doc" class="form-label">
                                            <i class="fas fa-id-card me-2" style="color: #e60000;"></i>CIN (document)
                                        </label>
                                        <input id="cin_doc" type="file" class="form-control @error('cin_doc') is-invalid @enderror" name="cin_doc" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body">
                                        <label for="acte_doc" class="form-label">
                                            <i class="fas fa-file-contract me-2" style="color: #e60000;"></i>Acte
                                        </label>
                                        <input id="acte_doc" type="file" class="form-control @error('acte_doc') is-invalid @enderror" name="acte_doc" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body">
                                        <label for="releve_notes" class="form-label">
                                            <i class="fas fa-file-alt me-2" style="color: #e60000;"></i>Relevé de notes
                                        </label>
                                        <input id="releve_notes" type="file" class="form-control @error('releve_notes') is-invalid @enderror" name="releve_notes" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body">
                                        <label for="photo" class="form-label">
                                            <i class="fas fa-camera me-2" style="color: #e60000;"></i>Photo d'identité
                                        </label>
                                        <input id="photo" type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            <button type="submit" class="btn btn-lg px-5 py-2" style="background: linear-gradient(135deg, #e60000 0%, #ff3333 100%); color: white; border-radius: 30px; box-shadow: 0 4px 15px rgba(230, 0, 0, 0.3);">
                                <i class="fas fa-paper-plane me-2"></i>Soumettre ma candidature
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Font Awesome for icons -->
<script src="https://kit.fontawesome.com/your-code-here.js" crossorigin="anonymous"></script>

<!-- Add custom CSS at the end of the page -->
<style>
    /* Fix the LL0000 color code to e60000 */
    body {
        background-color: #f8f9fa;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #e60000;
        box-shadow: 0 0 0 0.25rem rgba(230, 0, 0, 0.25);
    }
    
    .form-floating>.form-control:focus~label {
        color: #e60000;
    }
    
    .z-index-1 {
        z-index: 1;
    }
    
    .section-title {
        margin-bottom: 1.5rem;
    }
    
    /* Hover effect for submit button */
    button[type="submit"]:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(230, 0, 0, 0.4);
        transition: all 0.3s;
    }
    
    /* Card hover effects */
    .card:hover {
        transform: translateY(-5px);
        transition: transform 0.3s ease;
    }
</style>
@endsection