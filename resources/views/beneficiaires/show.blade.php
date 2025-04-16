@extends('layouts.app')

@section('styles')
<style>
    .profile-card {
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border-radius: 15px;
        overflow: hidden;
        border: none;
    }
    
    .profile-header {
        background: linear-gradient(to right, #3a7bd5, #00d2ff);
        color: white;
        padding: 20px;
        font-weight: bold;
    }
    
    .profile-img {
        width: 200px;
        height: 200px;
        object-fit: cover;
        border: 5px solid white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .document-link {
        display: block;
        padding: 12px 15px;
        margin-bottom: 10px;
        background-color: #f8f9fa;
        border-radius: 8px;
        color: #333;
        text-decoration: none;
        transition: all 0.3s;
    }
    
    .document-link:hover {
        background-color: #007bff;
        color: white;
        transform: translateX(5px);
    }
    
    .back-btn {
        background-color: #f8f9fa;
        color: #333;
        border-radius: 30px;
        padding: 8px 20px;
        transition: all 0.3s;
    }
    
    .back-btn:hover {
        background-color: #333;
        color: white;
    }
    
    .info-label {
        font-weight: bold;
        color: #666;
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card profile-card">
                <div class="profile-header">
                    Détails du bénéficiaire
                </div>

                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-4 text-center mb-4">
                            <img src="{{ asset('storage/' . $beneficiaire->photo_path) }}" 
                                 class="profile-img rounded-circle mb-3" 
                                 alt="Photo du bénéficiaire">
                            
                            <h4 class="mb-0">{{ $beneficiaire->prenom }} {{ $beneficiaire->nom }}</h4>
                            <p class="text-muted">{{ $beneficiaire->niveau_scolaire }}</p>
                        </div>
                        
                        <div class="col-md-8">
                            <div class="row mb-3">
                                <div class="col-sm-4 info-label">CIN:</div>
                                <div class="col-sm-8">{{ $beneficiaire->cin }}</div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-sm-4 info-label">Date de naissance:</div>
                                <div class="col-sm-8">{{ $beneficiaire->date_naissance }}</div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-sm-4 info-label">Email:</div>
                                <div class="col-sm-8">{{ $beneficiaire->email }}</div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-sm-4 info-label">Téléphone:</div>
                                <div class="col-sm-8">{{ $beneficiaire->tel }}</div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-sm-4 info-label">Date d'acceptation:</div>
                                <div class="col-sm-8">{{ $beneficiaire->created_at->format('d/m/Y H:i') }}</div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-4 info-label">valide Par :</div>
                                <div class="col-sm-8">{{ $beneficiaire->admin ? $beneficiaire->admin->name : 'Non spécifié' }}</div>
                            </div>

                            
                            
                            <hr class="my-4">
                            
                            <h5 class="mb-4">Documents</h5>
                            
                            <a href="{{ asset('storage/' . $beneficiaire->baccalaureat_path) }}" class="document-link" target="_blank">
                                Baccalauréat
                            </a>
                            
                            <a href="{{ asset('storage/' . $beneficiaire->cin_path) }}" class="document-link" target="_blank">
                                Carte d'identité
                            </a>
                            
                            <a href="{{ asset('storage/' . $beneficiaire->acte_path) }}" class="document-link" target="_blank">
                                Acte
                            </a>
                            
                            <a href="{{ asset('storage/' . $beneficiaire->releve_notes_path) }}" class="document-link" target="_blank">
                                Relevé de notes
                            </a>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <a href="{{ route('beneficiaire.index') }}" class="btn back-btn">
                            Retour à la liste
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection