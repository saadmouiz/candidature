@extends('layouts.app')

@section('styles')
<!-- Add Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    :root {
        --primary: #ef4444;
        --primary-hover: #dc2626;
        --primary-light: #fee2e2;
        --secondary: #475569;
        --secondary-light: #f1f5f9;
        --success: #10b981;
        --success-light: #d1fae5;
        --warning: #f59e0b;
        --warning-light: #fef3c7;
        --background: #f8fafc;
        --card-bg: #ffffff;
        --text-dark: #1e293b;
        --text-gray: #64748b;
        --text-light: #94a3b8;
        --border: #e2e8f0;
        --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
    }

    body {
        background-color: var(--background);
        color: var(--text-dark);
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
    }

    .beneficiary-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 1.5rem;
    }

    .page-header {
        display: flex;
        align-items: center;
        margin-bottom: 2rem;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--secondary);
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
    }

    .back-link:hover {
        background-color: var(--secondary-light);
        color: var(--text-dark);
        text-decoration: none;
    }

    .main-card {
        background-color: var(--card-bg);
        border-radius: 1rem;
        box-shadow: var(--shadow);
        overflow: hidden;
    }

    .beneficiary-header {
        padding: 2rem;
        border-bottom: 1px solid var(--border);
        text-align: center;
    }

    .beneficiary-name {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: var(--text-dark);
    }

    .beneficiary-name span {
        background: linear-gradient(to right, var(--primary), #fb7185);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .beneficiary-details {
        color: var(--text-gray);
        font-size: 1rem;
        margin-bottom: 1rem;
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.375rem 1rem;
        background-color: var(--primary-light);
        color: var(--primary);
        border-radius: 9999px;
        font-weight: 500;
        font-size: 0.875rem;
    }

    .section-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: 0.75rem;
        background-color: var(--secondary-light);
    }

    .section-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--text-dark);
        margin: 0;
    }

    .section-content {
        padding: 1.5rem;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .info-item {
        margin-bottom: 1rem;
    }

    .info-label {
        font-size: 0.875rem;
        color: var(--text-light);
        margin-bottom: 0.375rem;
    }

    .info-value {
        font-size: 1rem;
        color: var(--text-dark);
        font-weight: 500;
    }

    .documents-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .document-item {
        border: 1px solid var(--border);
        border-radius: 0.75rem;
        overflow: hidden;
        transition: all 0.2s;
    }

    .document-item:hover {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .document-preview {
        height: 180px;
        background-color: #f1f5f9;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .document-preview img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .document-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.3);
        opacity: 0;
        transition: opacity 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .document-item:hover .document-overlay {
        opacity: 1;
    }

    .document-info {
        padding: 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: white;
    }

    .document-details {
        flex: 1;
    }

    .document-title {
        font-weight: 600;
        font-size: 1rem;
        color: var(--text-dark);
        margin-bottom: 0.25rem;
    }

    .document-date {
        font-size: 0.75rem;
        color: var(--text-light);
    }

    .document-actions {
        display: flex;
        gap: 0.5rem;
    }

    .document-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 2.25rem;
        height: 2.25rem;
        border-radius: 0.5rem;
        background-color: var(--secondary-light);
        color: var(--text-gray);
        border: none;
        transition: all 0.2s;
    }

    .document-btn:hover {
        background-color: var(--primary);
        color: white;
    }

    @media (max-width: 768px) {
        .info-grid, .documents-list {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="beneficiary-container">
    <div class="page-header">
        <a href="{{ route('beneficiaire.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i>
            <span>Retour</span>
        </a>
    </div>
    
    <div class="main-card">
        <div class="beneficiary-header">
            <h1 class="beneficiary-name">{{ $beneficiaire->prenom }} <span>{{ $beneficiaire->nom }}</span></h1>
            <div class="beneficiary-details">Bénéficiaire #{{ $beneficiaire->id }} | CIN: {{ $beneficiaire->cin }}</div>
            <div class="status-pill">
                <i class="fas fa-check-circle"></i>
                <span>Accepté le {{ $beneficiaire->created_at->format('d/m/Y') }}</span>
            </div>
        </div>
        
        <!-- Personal Information Section -->
        <div class="section-header">
            <i class="fas fa-user text-primary"></i>
            <h2 class="section-title">Informations personnelles</h2>
        </div>
        <div class="section-content">
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Nom complet</div>
                    <div class="info-value">{{ $beneficiaire->prenom }} {{ $beneficiaire->nom }}</div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">CIN</div>
                    <div class="info-value">{{ $beneficiaire->cin }}</div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">Date de naissance</div>
                    <div class="info-value">{{ $beneficiaire->date_naissance }}</div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">Email</div>
                    <div class="info-value">{{ $beneficiaire->email }}</div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">Téléphone</div>
                    <div class="info-value">{{ $beneficiaire->tel }}</div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">Niveau d'éducation</div>
                    <div class="info-value">{{ $beneficiaire->niveau_scolaire }}</div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">Date d'acceptation</div>
                    <div class="info-value">{{ $beneficiaire->created_at->format('d/m/Y H:i') }}</div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">Validé par</div>
                    <div class="info-value">{{ $beneficiaire->admin ? $beneficiaire->admin->name : 'Non spécifié' }}</div>
                </div>
            </div>
        </div>
        
        <!-- Documents Section -->
        <div class="section-header">
            <i class="fas fa-file-alt text-primary"></i>
            <h2 class="section-title">Documents officiels</h2>
        </div>
        <div class="section-content">
            <div class="documents-list">
                <!-- Photo Document -->
                <div class="document-item">
                    <div class="document-preview">
                        <img src="{{ asset('storage/' . $beneficiaire->photo_path) }}" alt="Photo d'identité">
                        <div class="document-overlay">
                            <a href="{{ asset('storage/' . $beneficiaire->photo_path) }}" download class="document-btn" title="Télécharger">
                                <i class="fas fa-download"></i>
                            </a>
                        </div>
                    </div>
                    <div class="document-info">
                        <div class="document-details">
                            <div class="document-title">Photo d'identité</div>
                            <div class="document-date">Ajouté le {{ $beneficiaire->created_at->format('d/m/Y') }}</div>
                        </div>
                        <div class="document-actions">
                            <a href="{{ asset('storage/' . $beneficiaire->photo_path) }}" target="_blank" class="document-btn" title="Visualiser">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ asset('storage/' . $beneficiaire->photo_path) }}" download class="document-btn" title="Télécharger">
                                <i class="fas fa-download"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- CIN Document -->
                <div class="document-item">
                    <div class="document-preview">
                        <img src="{{ asset('storage/' . $beneficiaire->cin_path) }}" alt="CIN" onerror="this.src='https://placehold.co/600x400?text=CIN+Document';this.onerror='';">
                        <div class="document-overlay">
                            <a href="{{ asset('storage/' . $beneficiaire->cin_path) }}" download class="document-btn" title="Télécharger">
                                <i class="fas fa-download"></i>
                            </a>
                        </div>
                    </div>
                    <div class="document-info">
                        <div class="document-details">
                            <div class="document-title">Carte d'identité nationale</div>
                            <div class="document-date">Ajouté le {{ $beneficiaire->created_at->format('d/m/Y') }}</div>
                        </div>
                        <div class="document-actions">
                            <a href="{{ asset('storage/' . $beneficiaire->cin_path) }}" target="_blank" class="document-btn" title="Visualiser">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ asset('storage/' . $beneficiaire->cin_path) }}" download class="document-btn" title="Télécharger">
                                <i class="fas fa-download"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Baccalauréat Document -->
                <div class="document-item">
                    <div class="document-preview">
                        <img src="{{ asset('storage/' . $beneficiaire->baccalaureat_path) }}" alt="Baccalauréat" onerror="this.src='https://placehold.co/600x400?text=Baccalauréat';this.onerror='';">
                        <div class="document-overlay">
                            <a href="{{ asset('storage/' . $beneficiaire->baccalaureat_path) }}" download class="document-btn" title="Télécharger">
                                <i class="fas fa-download"></i>
                            </a>
                        </div>
                    </div>
                    <div class="document-info">
                        <div class="document-details">
                            <div class="document-title">Baccalauréat</div>
                            <div class="document-date">Ajouté le {{ $beneficiaire->created_at->format('d/m/Y') }}</div>
                        </div>
                        <div class="document-actions">
                            <a href="{{ asset('storage/' . $beneficiaire->baccalaureat_path) }}" target="_blank" class="document-btn" title="Visualiser">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ asset('storage/' . $beneficiaire->baccalaureat_path) }}" download class="document-btn" title="Télécharger">
                                <i class="fas fa-download"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Acte Document -->
                <div class="document-item">
                    <div class="document-preview">
                        <img src="{{ asset('storage/' . $beneficiaire->acte_path) }}" alt="Acte" onerror="this.src='https://placehold.co/600x400?text=Acte';this.onerror='';">
                        <div class="document-overlay">
                            <a href="{{ asset('storage/' . $beneficiaire->acte_path) }}" download class="document-btn" title="Télécharger">
                                <i class="fas fa-download"></i>
                            </a>
                        </div>
                    </div>
                    <div class="document-info">
                        <div class="document-details">
                            <div class="document-title">Acte</div>
                            <div class="document-date">Ajouté le {{ $beneficiaire->created_at->format('d/m/Y') }}</div>
                        </div>
                        <div class="document-actions">
                            <a href="{{ asset('storage/' . $beneficiaire->acte_path) }}" target="_blank" class="document-btn" title="Visualiser">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ asset('storage/' . $beneficiaire->acte_path) }}" download class="document-btn" title="Télécharger">
                                <i class="fas fa-download"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Relevé de notes Document -->
                <div class="document-item">
                    <div class="document-preview">
                        <img src="{{ asset('storage/' . $beneficiaire->releve_notes_path) }}" alt="Relevé de notes" onerror="this.src='https://placehold.co/600x400?text=Relevé+de+Notes';this.onerror='';">
                        <div class="document-overlay">
                            <a href="{{ asset('storage/' . $beneficiaire->releve_notes_path) }}" download class="document-btn" title="Télécharger">
                                <i class="fas fa-download"></i>
                            </a>
                        </div>
                    </div>
                    <div class="document-info">
                        <div class="document-details">
                            <div class="document-title">Relevé de notes</div>
                            <div class="document-date">Ajouté le {{ $beneficiaire->created_at->format('d/m/Y') }}</div>
                        </div>
                        <div class="document-actions">
                            <a href="{{ asset('storage/' . $beneficiaire->releve_notes_path) }}" target="_blank" class="document-btn" title="Visualiser">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ asset('storage/' . $beneficiaire->releve_notes_path) }}" download class="document-btn" title="Télécharger">
                                <i class="fas fa-download"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection