<!-- resources/views/admin/index.blade.php -->
@extends('layouts.app')

@section('styles')
<style>
    :root {
        --primary: #6366f1;
        --primary-light: #818cf8;
        --primary-dark: #4f46e5;
        --success: #10b981;
        --success-light: #34d399;
        --warning: #f59e0b;
        --warning-light: #fbbf24;
        --danger: #ef4444;
        --danger-light: #f87171;
        --background: #f9fafb;
        --card-bg: #ffffff;
        --text-primary: #1f2937;
        --text-secondary: #6b7280;
        --border-color: #e5e7eb;
    }

    .dashboard-container {
        background-color: var(--background);
        padding: 2rem 0;
        min-height: calc(100vh - 80px);
    }
    
    .dashboard-header {
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .dashboard-title {
        color: var(--text-primary);
        font-weight: 800;
        font-size: 1.875rem;
        letter-spacing: -0.025em;
        position: relative;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .stat-card {
        background: var(--card-bg);
        border-radius: 1rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        height: 100%;
        position: relative;
        isolation: isolate;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        z-index: 1;
    }
    
    .beneficiaires-card::before {
        background: linear-gradient(to right, var(--primary), var(--primary-light));
    }
    
    .candidatures-card::before {
        background: linear-gradient(to right, var(--success), var(--success-light));
    }
    
    .card-body-custom {
        padding: 1.5rem;
        position: relative;
    }
    
    .card-icon {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        top: 1.5rem;
        right: 1.5rem;
    }
    
    .icon-primary {
        background-color: rgba(99, 102, 241, 0.1);
        color: var(--primary);
    }
    
    .icon-success {
        background-color: rgba(16, 185, 129, 0.1);
        color: var(--success);
    }
    
    .card-title-custom {
        font-weight: 600;
        font-size: 1rem;
        color: var(--text-secondary);
        margin-bottom: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .stat-number {
        font-size: 2.75rem;
        font-weight: 700;
        line-height: 1.2;
        margin-bottom: 0.75rem;
        transition: all 0.3s ease;
    }
    
    .beneficiaires-number {
        color: var(--primary);
    }
    
    .candidatures-number {
        color: var(--success);
    }
    
    .card-text-custom {
        color: var(--text-secondary);
        font-size: 0.875rem;
    }
    
    .card-footer-custom {
        padding: 1rem 1.5rem;
        background-color: rgba(249, 250, 251, 0.5);
        border-top: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: all 0.3s ease;
    }
    
    .stats-details-card {
        background: var(--card-bg);
        border-radius: 1rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        overflow: hidden;
        margin-bottom: 2rem;
    }
    
    .stats-header {
        background-color: rgba(249, 250, 251, 0.8);
        border-bottom: 1px solid var(--border-color);
        padding: 1.25rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .stats-title {
        margin: 0;
        color: var(--text-primary);
        font-weight: 600;
        font-size: 1.125rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .stats-grid-detailed {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }
    
    .stat-item {
        padding: 1.5rem;
        text-align: center;
        position: relative;
    }
    
    .stat-item:not(:last-child)::after {
        content: '';
        position: absolute;
        top: 20%;
        right: 0;
        height: 60%;
        width: 1px;
        background-color: var(--border-color);
    }
    
    .stat-label {
        font-size: 0.875rem;
        color: var(--text-secondary);
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.025em;
        margin-bottom: 0.75rem;
    }
    
    .stat-value {
        font-size: 1.75rem;
        font-weight: 700;
        transition: all 0.3s ease;
    }
    
    .awaiting {
        color: var(--warning);
    }
    
    .accepted {
        color: var(--success);
    }
    
    .rejected {
        color: var(--danger);
    }
    
    .icon-circle {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        transition: all 0.3s ease;
    }
    
    .icon-circle-warning {
        background-color: rgba(245, 158, 11, 0.1);
        color: var(--warning);
    }
    
    .icon-circle-success {
        background-color: rgba(16, 185, 129, 0.1);
        color: var(--success);
    }
    
    .icon-circle-danger {
        background-color: rgba(239, 68, 68, 0.1);
        color: var(--danger);
    }
    
    .footer-link {
        color: var(--text-secondary);
        text-decoration: none;
        font-weight: 500;
        font-size: 0.875rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
    }
    
    .footer-link:hover {
        color: var(--primary);
    }
    
    .card-link {
        text-decoration: none;
        color: inherit;
        display: block;
        height: 100%;
    }
    
    .refresh-button {
        background-color: var(--primary);
        color: white;
        border: none;
        border-radius: 0.5rem;
        padding: 0.5rem 1rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .refresh-button:hover {
        background-color: var(--primary-dark);
    }
    
    .card-content {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    /* Animation */
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    
    .pulse {
        animation: pulse 0.8s ease-in-out;
    }
    
    /* Dark mode support */
    @media (prefers-color-scheme: dark) {
        :root {
            --background: #111827;
            --card-bg: #1f2937;
            --text-primary: #f9fafb;
            --text-secondary: #d1d5db;
            --border-color: #374151;
        }
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .stats-grid-detailed {
            grid-template-columns: 1fr;
        }
        
        .stat-item:not(:last-child)::after {
            right: auto;
            bottom: 0;
            top: auto;
            height: 1px;
            width: 80%;
            left: 10%;
        }
    }
</style>
@endsection

@section('content')
<div class="dashboard-container">
    <div class="container">
        <div class="dashboard-header">
            <h1 class="dashboard-title">Tableau de bord administrateur</h1>
            <button id="refresh-stats" class="refresh-button">
                <i class="fas fa-sync-alt"></i>
                <span>Rafraîchir</span>
            </button>
        </div>
        
        <div class="stats-grid">
            <!-- Carte Bénéficiaires -->
            <a href="{{ route('beneficiaire.index') }}" class="card-link">
                <div class="stat-card beneficiaires-card">
                    <div class="card-body-custom">
                        <div class="card-icon icon-primary">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-content">
                            <h5 class="card-title-custom">Bénéficiaires</h5>
                            <div class="stat-number beneficiaires-number" id="beneficiaires-count">{{ $totalBeneficiaires }}</div>
                            <p class="card-text-custom">Nombre total de bénéficiaires enregistrés</p>
                        </div>
                    </div>
                    <div class="card-footer-custom">
                        <span class="footer-link">
                            <span>Voir la liste complète</span>
                            <i class="fas fa-arrow-right"></i>
                        </span>
                        <span class="footer-link">
                            <i class="fas fa-chart-line"></i>
                        </span>
                    </div>
                </div>
            </a>

            <!-- Carte Candidatures -->
            <a href="{{ route('candidature.index') }}" class="card-link">
                <div class="stat-card candidatures-card">
                    <div class="card-body-custom">
                        <div class="card-icon icon-success">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="card-content">
                            <h5 class="card-title-custom">Candidatures</h5>
                            <div class="stat-number candidatures-number" id="candidatures-count">{{ $totalCandidatures }}</div>
                            <p class="card-text-custom">Nombre total de candidatures reçues</p>
                        </div>
                    </div>
                    <div class="card-footer-custom">
                        <span class="footer-link">
                            <span>Voir la liste complète</span>
                            <i class="fas fa-arrow-right"></i>
                        </span>
                        <span class="footer-link">
                            <i class="fas fa-chart-line"></i>
                        </span>
                    </div>
                </div>
            </a>
        </div>

        <!-- Statistiques détaillées des candidatures -->
        <div class="stats-details-card">
            <div class="stats-header">
                <h5 class="stats-title">
                    <i class="fas fa-chart-pie"></i>
                    <span>Statistiques des candidatures</span>
                </h5>
                <span id="last-updated" class="text-secondary" style="font-size: 0.875rem; color: var(--text-secondary);">
                    Dernière mise à jour: {{ date('H:i:s') }}
                </span>
            </div>
            <div class="stats-grid-detailed">
                <div class="stat-item">
                    <div class="icon-circle icon-circle-warning">
                        <i class="fas fa-clock"></i>
                    </div>
                    <a href="{{ route('candidature.index') }}" class="card-link">
                        <h6 class="stat-label">En attente</h6>
                        <div class="stat-value awaiting" id="awaiting-count">{{ $candidaturesEnAttente ?? 0 }}</div>
                    </a>
                </div>
                <div class="stat-item">
                    <div class="icon-circle icon-circle-success">
                        <i class="fas fa-check"></i>
                    </div>
                    <a href="{{ route('beneficiaire.index') }}" class="card-link">
                        <h6 class="stat-label">Acceptées</h6>
                        <div class="stat-value accepted" id="accepted-count">{{ $candidaturesAcceptees ?? 0 }}</div>
                    </a>
                </div>
                <div class="stat-item">
                    <div class="icon-circle icon-circle-danger">
                        <i class="fas fa-times"></i>
                    </div>
                    <a href="{{ route('candidature.refusees') }}" class="card-link">
                        <h6 class="stat-label">Refusées</h6>
                        <div class="stat-value rejected" id="rejected-count">{{ $candidaturesRefusees ?? 0 }}</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initial animation for elements
        const animateElements = document.querySelectorAll('.stat-card, .stats-details-card');
        animateElements.forEach((el, index) => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            setTimeout(() => {
                el.style.transition = 'all 0.5s ease';
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }, 100 * index);
        });
        
        // Function to update statistics
        function updateStats() {
            fetch('{{ route("admin.stats") }}')
                .then(response => response.json())
                .then(data => {
                    // Update statistics with animation
                    updateWithAnimation('beneficiaires-count', data.totalBeneficiaires);
                    updateWithAnimation('candidatures-count', data.totalCandidatures);
                    updateWithAnimation('awaiting-count', data.candidaturesEnAttente);
                    updateWithAnimation('accepted-count', data.candidaturesAcceptees);
                    updateWithAnimation('rejected-count', data.candidaturesRefusees);
                    
                    // Update last refresh time
                    const now = new Date();
                    const timeString = now.getHours().toString().padStart(2, '0') + ':' + 
                                    now.getMinutes().toString().padStart(2, '0') + ':' + 
                                    now.getSeconds().toString().padStart(2, '0');
                    document.getElementById('last-updated').textContent = 'Dernière mise à jour: ' + timeString;
                })
                .catch(error => console.error('Erreur lors de la mise à jour des statistiques:', error));
        }
        
        // Function to update element with animation
        function updateWithAnimation(id, newValue) {
            const element = document.getElementById(id);
            if (element && element.textContent !== newValue.toString()) {
                element.classList.add('pulse');
                element.textContent = newValue;
                setTimeout(() => {
                    element.classList.remove('pulse');
                }, 800);
            }
        }
        
        // Set up manual refresh button
        document.getElementById('refresh-stats').addEventListener('click', function() {
            const icon = this.querySelector('i');
            icon.classList.add('fa-spin');
            this.disabled = true;
            
            updateStats();
            
            setTimeout(() => {
                icon.classList.remove('fa-spin');
                this.disabled = false;
            }, 1000);
        });
        
        // Auto refresh every 30 seconds
        setInterval(updateStats, 30000);
    });
</script>
@endsection