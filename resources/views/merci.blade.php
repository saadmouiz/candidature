@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Merci !</div>

                <div class="card-body">
                    <p>Votre candidature a été soumise avec succès.</p>
                    <p>Un email de confirmation vous a été envoyé. Notre équipe va examiner votre dossier dans les meilleurs délais.</p>
                    <div class="text-center mt-4">
                        <a href="{{ route('welcome') }}" class="btn btn-primary">Retour à l'accueil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection