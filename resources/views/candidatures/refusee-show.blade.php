@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h2>Détails de la candidature refusée</h2>
                    <a href="{{ route('refusee.index') }}" class="btn btn-secondary float-right">Retour à la liste</a>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center mb-4">
                            <img src="{{ asset('storage/' . $refusee->photo_path) }}" alt="Photo du candidat" class="img-fluid rounded" style="max-height: 200px;">
                        </div>
                        <div class="col-md-8">
                            <h3>{{ $refusee->nom }} {{ $refusee->prenom }}</h3>
                            <p class="text-muted">CIN: {{ $refusee->cin }}</p>
                            
                            <div class="alert alert-danger">
                                <strong>Candidature refusée par:</strong> {{ $refusee->admin->name ?? 'N/A' }}<br>
                                <strong>Date de refus:</strong> {{ $refusee->created_at->format('d/m/Y H:i') }}
                                
                                @if($refusee->raison_refus)
                                <hr>
                                <strong>Raison du refus:</strong><br>
                                {{ $refusee->raison_refus }}
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header">Informations personnelles</div>
                                <div class="card-body">
                                    <p><strong>Date de naissance:</strong> {{ $refusee->date_naissance }}</p>
                                    <p><strong>Email:</strong> {{ $refusee->email }}</p>
                                    <p><strong>Téléphone:</strong> {{ $refusee->tel }}</p>
                                    <p><strong>Niveau scolaire:</strong> {{ $refusee->niveau_scolaire }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">Documents soumis</div>
                                <div class="card-body">
                                    <div class="list-group">
                                        <a href="{{ asset('storage/' . $refusee->baccalaureat_path) }}" target="_blank" class="list-group-item list-group-item-action">
                                            <i class="fas fa-file-pdf"></i> Baccalauréat
                                        </a>
                                        <a href="{{ asset('storage/' . $refusee->cin_path) }}" target="_blank" class="list-group-item list-group-item-action">
                                            <i class="fas fa-id-card"></i> CIN
                                        </a>
                                        <a href="{{ asset('storage/' . $refusee->acte_path) }}" target="_blank" class="list-group-item list-group-item-action">
                                            <i class="fas fa-file-alt"></i> Acte de naissance
                                        </a>
                                        <a href="{{ asset('storage/' . $refusee->releve_notes_path) }}" target="_blank" class="list-group-item list-group-item-action">
                                            <i class="fas fa-file-alt"></i> Relevé de notes
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection