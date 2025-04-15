@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Détails de la candidature</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ asset('storage/' . $candidature->photo_path) }}" class="img-fluid rounded" alt="Photo du candidat">
                        </div>
                        <div class="col-md-8">
                            <h4>{{ $candidature->prenom }} {{ $candidature->nom }}</h4>
                            <p><strong>CIN :</strong> {{ $candidature->cin }}</p>
                            <p><strong>Date de naissance :</strong> {{ $candidature->date_naissance }}</p>
                            <p><strong>Email :</strong> {{ $candidature->email }}</p>
                            <p><strong>Téléphone :</strong> {{ $candidature->tel }}</p>
                            <p><strong>Niveau scolaire :</strong> {{ $candidature->niveau_scolaire }}</p>
                            <p><strong>Statut :</strong> 
                                @if($candidature->status == 'en_attente')
                                    <span class="badge bg-warning">En attente</span>
                                @elseif($candidature->status == 'accepte')
                                    <span class="badge bg-success">Acceptée</span>
                                @else
                                    <span class="badge bg-danger">Refusée</span>
                                @endif
                            </p>
                            <p><strong>Date de soumission :</strong> {{ $candidature->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h5>Documents</h5>
                        <div class="list-group">
                            <a href="{{ asset('storage/' . $candidature->baccalaureat_path) }}" class="list-group-item list-group-item-action" target="_blank">
                                Baccalauréat
                            </a>
                            <a href="{{ asset('storage/' . $candidature->cin_path) }}" class="list-group-item list-group-item-action" target="_blank">
                                CIN
                            </a>
                            <a href="{{ asset('storage/' . $candidature->acte_path) }}" class="list-group-item list-group-item-action" target="_blank">
                                Acte
                            </a>
                            <a href="{{ asset('storage/' . $candidature->releve_notes_path) }}" class="list-group-item list-group-item-action" target="_blank">
                                Relevé de notes
                            </a>
                        </div>
                    </div>

                    <div class="mt-4">
                        @if($candidature->status == 'en_attente')
                            <form action="{{ route('candidature.accepter', $candidature) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success">Accepter cette candidature</button>
                            </form>
                            <form action="{{ route('candidature.refuser', $candidature) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger">Refuser cette candidature</button>
                            </form>
                        @endif
                        <a href="{{ route('candidature.index') }}" class="btn btn-secondary">Retour à la liste</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection