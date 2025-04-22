@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-danger text-white">
            <h1 class="h4 mb-0">Erreur de génération du contrat PDF</h1>
        </div>
        
        <div class="card-body">
            <div class="alert alert-warning">
                <h5 class="alert-heading">Nous n'avons pas pu générer le contrat PDF demandé</h5>
                <p>Il semble y avoir un problème technique avec la génération du PDF. L'extension PHP GD, nécessaire pour traiter les images, n'est probablement pas installée sur le serveur.</p>
            </div>
            
            <h4>Informations de la candidature</h4>
            <div class="mb-4 p-3 bg-light border rounded">
                <p><strong>Candidat :</strong> {{ $candidature->prenom }} {{ $candidature->nom }}</p>
                <p><strong>CIN :</strong> {{ $candidature->cin }}</p>
                <p><strong>Email :</strong> {{ $candidature->email }}</p>
                <p><strong>Téléphone :</strong> {{ $candidature->tel }}</p>
                <p><strong>Date d'acceptation :</strong> {{ $candidature->updated_at->format('d/m/Y') }}</p>
            </div>
            
            <div class="alert alert-info mt-4">
                <h5>Note pour l'administrateur</h5>
                <p>Pour résoudre ce problème, veuillez installer l'extension PHP GD sur le serveur. Sur Windows, cela peut être fait en activant l'extension dans le fichier php.ini.</p>
                <p>Si vous êtes sur Windows, vous pouvez l'activer en modifiant votre fichier php.ini comme suit :</p>
                <ol>
                    <li>Ouvrir php.ini (généralement dans C:\php ou un dossier similaire)</li>
                    <li>Chercher la ligne <code>;extension=gd</code></li>
                    <li>Retirer le point-virgule au début pour la décommenter : <code>extension=gd</code></li>
                    <li>Redémarrer votre serveur web (Apache, Nginx, ou le serveur de développement Laravel)</li>
                </ol>
                <p><strong>Erreur détaillée :</strong> <code>{{ $error ?? 'Extension GD non disponible' }}</code></p>
            </div>
            
            <div class="alert alert-secondary">
                <p>Si vous ne pouvez pas installer l'extension GD immédiatement, vous pouvez temporairement générer un contrat simplifié sans images en utilisant un autre service ou format.</p>
            </div>
            
            <div class="mt-4">
                <a href="{{ url()->previous() }}" class="btn btn-primary">Retour</a>
            </div>
        </div>
    </div>
</div>
@endsection 