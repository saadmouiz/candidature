@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-danger text-white">
            <h1 class="h4 mb-0">Erreur de génération du PDF</h1>
        </div>
        
        <div class="card-body">
            <div class="alert alert-warning">
                <h5 class="alert-heading">Nous n'avons pas pu générer le document PDF demandé</h5>
                <p>Il semble y avoir un problème technique avec la génération du PDF. L'extension PHP GD, nécessaire pour traiter les images, n'est probablement pas installée sur le serveur.</p>
            </div>
            
            <h4>Informations du rendez-vous</h4>
            <div class="mb-4 p-3 bg-light border rounded">
                <p><strong>Bénéficiaire :</strong> {{ $beneficiaire->prenom }} {{ $beneficiaire->nom }}</p>
                <p><strong>Date du rendez-vous :</strong> {{ \Carbon\Carbon::parse($beneficiaire->appointment_date)->format('d/m/Y H:i') }}</p>
                <p><strong>Lieu :</strong> Centre de Formation, 123 Boulevard Principal, Casablanca</p>
                <p><strong>Contact :</strong> Service des bénéficiaires (+212 522 XX XX XX)</p>
            </div>
            
            <h4>Documents à apporter</h4>
            <ul>
                <li>Carte d'identité nationale (CIN)</li>
                <li>Copie du contrat signé</li>
                <li>Toutes attestations ou documents pouvant appuyer votre dossier</li>
            </ul>
            
            <div class="alert alert-info mt-4">
                <h5>Note pour l'administrateur</h5>
                <p>Pour résoudre ce problème, veuillez installer l'extension PHP GD sur le serveur. Sur Windows, cela peut être fait en activant l'extension dans le fichier php.ini.</p>
                <p><strong>Erreur détaillée :</strong> <code>{{ $error ?? 'Extension GD non disponible' }}</code></p>
            </div>
            
            <div class="mt-4">
                <a href="{{ route('beneficiaire.show', $beneficiaire) }}" class="btn btn-primary">Retour au profil du bénéficiaire</a>
            </div>
        </div>
    </div>
</div>
@endsection 