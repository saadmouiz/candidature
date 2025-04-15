@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- Card Bénéficiaires -->
        <div class="col-md-6">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Bénéficiaires</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $nombreBeneficiaires }}</h5>
                    <p class="card-text">Nombre total de bénéficiaires enregistrés</p>
                </div>
            </div>
        </div>

        <!-- Card Candidatures -->
        <div class="col-md-6">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Candidatures</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $nombreCandidatures }}</h5>
                    <p class="card-text">Nombre total de candidatures reçues</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
