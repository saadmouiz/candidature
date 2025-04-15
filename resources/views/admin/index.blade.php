<!-- resources/views/admin/index.blade.php -->
@extends('layouts.app')

@section('styles')
<style>
    .dashboard-container {
        background-color: #f8f9fe;
        padding: 30px 0;
        min-height: calc(100vh - 100px);
    }
    
    .dashboard-header {
        margin-bottom: 30px;
    }
    
    .dashboard-title {
        color: #5e72e4;
        font-weight: 700;
        font-size: 2rem;
        letter-spacing: 0.5px;
        position: relative;
        padding-bottom: 15px;
    }
    
    .dashboard-title:after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        height: 4px;
        width: 60px;
        background: linear-gradient(to right, #5e72e4, #825ee4);
        border-radius: 2px;
    }
    
    .stat-card {
        transition: all 0.3s ease;
        overflow: hidden;
        border-radius: 15px;
        border: none;
        height: 100%;
    }
    
    .stat-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .beneficiaires-card {
        background: linear-gradient(to right, #ffffff, #f5f7ff);
        border-left: 4px solid #5e72e4;
    }
    
    .candidatures-card {
        background: linear-gradient(to right, #ffffff, #f2fff5);
        border-left: 4px solid #2dce89;
    }
    
    .card-body-custom {
        padding: 25px;
    }
    
    .card-title-custom {
        font-weight: 700;
        font-size: 1.2rem;
        color: #444;
        margin-bottom: 15px;
    }
    
    .stat-number {
        font-size: 3.5rem;
        font-weight: 700;
        line-height: 1;
        margin-bottom: 15px;
    }
    
    .beneficiaires-number {
        color: #5e72e4;
    }
    
    .candidatures-number {
        color: #2dce89;
    }
    
    .card-text-custom {
        color: #8898aa;
        font-size: 0.95rem;
    }
    
    .card-footer-custom {
        padding: 15px;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .beneficiaires-footer {
        background-color: #5e72e4;
        color: white;
    }
    
    .candidatures-footer {
        background-color: #2dce89;
        color: white;
    }
    
    .card-link {
        text-decoration: none;
        color: inherit;
        display: block;
        height: 100%;
    }
    
    .footer-text {
        font-weight: 600;
        margin-right: 5px;
    }
    
    .stats-details-card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
        margin-bottom: 30px;
    }
    
    .stats-header {
        background-color: #f6f9fc;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        padding: 20px 25px;
        border-radius: 15px 15px 0 0;
    }
    
    .stats-title {
        margin: 0;
        color: #525f7f;
        font-weight: 600;
        font-size: 1.25rem;
    }
    
    .stat-item {
        padding: 20px 10px;
        text-align: center;
    }
    
    .stat-label {
        font-size: 0.9rem;
        color: #8898aa;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 10px;
    }
    
    .stat-value {
        font-size: 1.5rem;
        font-weight: 700;
    }
    
    .awaiting {
        color: #fb6340;
    }
    
    .accepted {
        color: #2dce89;
    }
    
    .rejected {
        color: #f5365c;
    }
    
    .icon-circle {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
    }
    
    .icon-circle-primary {
        background-color: rgba(94, 114, 228, 0.1);
        color: #5e72e4;
    }
    
    .icon-circle-success {
        background-color: rgba(45, 206, 137, 0.1);
        color: #2dce89;
    }
    
    .icon-circle-warning {
        background-color: rgba(251, 99, 64, 0.1);
        color: #fb6340;
    }
    
    .icon-circle-danger {
        background-color: rgba(245, 54, 92, 0.1);
        color: #f5365c;
    }
</style>
@endsection

@section('content')
<div class="dashboard-container">
    <div class="container">
        <div class="dashboard-header">
            <h1 class="dashboard-title">Tableau de bord administrateur</h1>
        </div>
        
        <div class="row">
            <!-- Carte Bénéficiaires -->
            <div class="col-md-6 mb-4">
                <a href="{{ route('beneficiaire.index') }}" class="card-link">
                    <div class="stat-card beneficiaires-card shadow">
                        <div class="card-body-custom">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="icon-circle icon-circle-primary">
                                        <i class="fas fa-users fa-2x"></i>
                                    </div>
                                </div>
                                <div class="col">
                                    <h5 class="card-title-custom">Bénéficiaires</h5>
                                    <div class="stat-number beneficiaires-number">{{ $totalBeneficiaires }}</div>
                                    <p class="card-text-custom">Nombre total de bénéficiaires dans le système</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer-custom beneficiaires-footer">
                            <span class="footer-text">Voir la liste des bénéficiaires</span>
                            <i class="fas fa-arrow-right ml-2"></i>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Carte Candidatures -->
            <div class="col-md-6 mb-4">
                <a href="{{ route('candidature.index') }}" class="card-link">
                    <div class="stat-card candidatures-card shadow">
                        <div class="card-body-custom">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="icon-circle icon-circle-success">
                                        <i class="fas fa-file-alt fa-2x"></i>
                                    </div>
                                </div>
                                <div class="col">
                                    <h5 class="card-title-custom">Candidatures</h5>
                                    <div class="stat-number candidatures-number">{{ $totalCandidatures }}</div>
                                    <p class="card-text-custom">Nombre total de candidatures reçues</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer-custom candidatures-footer">
                            <span class="footer-text">Voir la liste des candidatures</span>
                            <i class="fas fa-arrow-right ml-2"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Statistiques détaillées des candidatures -->
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="stats-details-card">
                    <div class="stats-header">
                        <h5 class="stats-title">
                            <i class="fas fa-chart-pie mr-2"></i> Statistiques des candidatures
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stat-item">
                                    <div class="icon-circle icon-circle-warning">
                                        <i class="fas fa-clock fa-lg"></i>
                                    </div>
                                    <h6 class="stat-label">En attente</h6>
                                    <div class="stat-value awaiting">{{ $candidaturesEnAttente ?? 0 }}</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stat-item">
                                    <div class="icon-circle icon-circle-success">
                                        <i class="fas fa-check fa-lg"></i>
                                    </div>
                                    <h6 class="stat-label">Acceptées</h6>
                                    <div class="stat-value accepted">{{ $candidaturesAcceptees ?? 0 }}</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stat-item">
                                    <div class="icon-circle icon-circle-danger">
                                        <i class="fas fa-times fa-lg"></i>
                                    </div>
                                    <h6 class="stat-label">Refusées</h6>
                                    <div class="stat-value rejected">{{ $candidaturesRefusees ?? 0 }}</div>
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

@section('scripts')
<script>
    // Script pour ajouter des animations ou fonctionnalités supplémentaires si nécessaire
    document.addEventListener('DOMContentLoaded', function() {
        // Animation d'entrée pour les cartes
        const cards = document.querySelectorAll('.stat-card');
        cards.forEach((card, index) => {
            setTimeout(() => {
                card.style.opacity = '1';
            }, 100 * index);
        });
    });
</script>
@endsection