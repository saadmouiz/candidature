@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Détails du bénéficiaire</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ asset('storage/' . $beneficiaire->photo_path) }}" class="img-fluid rounded" alt="Photo du bénéficiaire">
                        </div>
                        <div class="col-md-8">
                            <h4>{{ $beneficiaire->prenom }} {{ $beneficiaire->nom }}</h4>
                            <p><strong>CIN :</strong> {{ $beneficiaire->cin }}</p>
                            <p><strong>Date de naissance :</strong> {{ $beneficiaire->date_naissance }}</p>
                            <p><strong>Email :</strong> {{ $beneficiaire->email }}</p>
                            <p><strong>Téléphone :</strong> {{ $beneficiaire->tel }}</p>
                            <p><strong>Niveau scolaire :</strong> {{ $beneficiaire->niveau_scolaire }}</p>
                            <p><strong>Date d'acceptation :</strong> {{ $beneficiaire->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h5>Documents</h5>
                        <div class="list-group">
                            <a href="{{ asset('storage/' . $beneficiaire->baccalaureat_path) }}" class="list-group-item list-group-item-action" target="_blank">
                                Baccalauréat
                            </a>
                            <a href="{{ asset('storage/' . $beneficiaire->cin_path) }}" class="list-group-item list-group-item-action" target="_blank">
                                CIN
                            </a>
                            <a href="{{ asset('storage/' . $beneficiaire->acte_path) }}" class="list-group-item list-group-item-action" target="_blank">
                                Acte
                            </a>
                            <a href="{{ asset('storage/' . $beneficiaire->releve_notes_path) }}" class="list-group-item list-group-item-action" target="_blank">
                                Relevé de notes
                            </a>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('beneficiaire.index') }}" class="btn btn-secondary">Retour à la liste</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection