@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --primary: #ef4444;
        --primary-hover: #dc2626;
        --primary-light: #fee2e2;
        --background: #f9fafb;
        --card-bg: #ffffff;
        --text-primary: #1f2937;
        --text-secondary: #6b7280;
        --text-light: #9ca3af;
        --border-color: #e5e7eb;
        --shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    body {
        background-color: var(--background);
        color: var(--text-primary);
        font-family: system-ui, -apple-system, sans-serif;
    }

    .beneficiary-container {
        max-width: 1024px;
        margin: 0 auto;
        padding: 1.5rem;
    }

    .page-header {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--text-secondary);
        text-decoration: none;
        font-weight: 500;
        font-size: 0.875rem;
        transition: all 0.2s;
        padding: 0.5rem 0.75rem;
        border-radius: 0.375rem;
    }

    .back-link:hover {
        background-color: #f3f4f6;
        color: var(--text-primary);
        text-decoration: none;
    }

    .main-card {
        background-color: var(--card-bg);
        border-radius: 0.75rem;
        box-shadow: var(--shadow);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .beneficiary-header {
        padding: 1.5rem;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .beneficiary-name {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--text-primary);
    }

    .beneficiary-name span {
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        background-image: linear-gradient(to right, #EF4444, #FB7185);
    }

    .beneficiary-details {
        color: var(--text-secondary);
        font-size: 0.875rem;
        margin-bottom: 1rem;
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.25rem 0.75rem;
        background-color: rgba(239, 68, 68, 0.1);
        color: var(--primary);
        border-radius: 9999px;
        font-weight: 500;
        font-size: 0.75rem;
    }

    .section-header {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .section-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0;
    }

    .section-icon {
        color: var(--primary);
        font-size: 0.875rem;
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
        font-size: 0.75rem;
        color: var(--text-light);
        margin-bottom: 0.25rem;
        text-transform: uppercase;
        letter-spacing: 0.025em;
    }

    .info-value {
        font-size: 0.9375rem;
        color: var(--text-primary);
        font-weight: 500;
    }

    /* Document Attachments */
    .documents-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .document-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 1rem;
        border: 1px solid var(--border-color);
        border-radius: 0.5rem;
        background-color: #f9fafb;
        transition: all 0.2s ease;
    }

    .document-item:hover {
        border-color: #d1d5db;
        background-color: #f3f4f6;
    }

    .document-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .document-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 0.375rem;
        background-color: rgba(239, 68, 68, 0.1);
        color: var(--primary);
    }

    .document-details {
        display: flex;
        flex-direction: column;
    }

    .document-title {
        font-weight: 500;
        font-size: 0.9375rem;
        color: var(--text-primary);
        margin-bottom: 0.125rem;
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
        width: 2rem;
        height: 2rem;
        border-radius: 0.375rem;
        background-color: white;
        color: var(--text-secondary);
        border: 1px solid var(--border-color);
        transition: all 0.2s;
    }

    .document-btn:hover {
        background-color: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    @media (max-width: 768px) {
        .info-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .document-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.75rem;
        }
        
        .document-actions {
            width: 100%;
            justify-content: flex-end;
        }
    }
</style>
@endsection

@section('content')
<div class="beneficiary-container">
    <div class="page-header">
        <a href="{{ route('beneficiaire.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i>
            <span>Retour à la liste</span>
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
            <i class="fas fa-user section-icon"></i>
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
    </div>
    
    <!-- Documents Section -->
    <div class="main-card">
        <div class="section-header">
            <i class="fas fa-file-alt section-icon"></i>
            <h2 class="section-title">Documents officiels</h2>
        </div>
        <div class="section-content">
            <div class="documents-list">
                <!-- Photo Document -->
                <div class="document-item">
                    <div class="document-info">
                        <div class="document-icon">
                            <i class="fas fa-id-badge"></i>
                        </div>
                        <div class="document-details">
                            <div class="document-title">Photo d'identité</div>
                            <div class="document-date">Ajouté le {{ $beneficiaire->created_at->format('d/m/Y') }}</div>
                        </div>
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
                
                <!-- CIN Document -->
                <div class="document-item">
                    <div class="document-info">
                        <div class="document-icon">
                            <i class="fas fa-id-card"></i>
                        </div>
                        <div class="document-details">
                            <div class="document-title">Carte d'identité nationale</div>
                            <div class="document-date">Ajouté le {{ $beneficiaire->created_at->format('d/m/Y') }}</div>
                        </div>
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
                
                <!-- Baccalauréat Document -->
                <div class="document-item">
                    <div class="document-info">
                        <div class="document-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="document-details">
                            <div class="document-title">Baccalauréat</div>
                            <div class="document-date">Ajouté le {{ $beneficiaire->created_at->format('d/m/Y') }}</div>
                        </div>
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
                
                <!-- Acte Document -->
                <div class="document-item">
                    <div class="document-info">
                        <div class="document-icon">
                            <i class="fas fa-file-contract"></i>
                        </div>
                        <div class="document-details">
                            <div class="document-title">Acte</div>
                            <div class="document-date">Ajouté le {{ $beneficiaire->created_at->format('d/m/Y') }}</div>
                        </div>
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
                
                <!-- Relevé de notes Document -->
                <div class="document-item">
                    <div class="document-info">
                        <div class="document-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="document-details">
                            <div class="document-title">Relevé de notes</div>
                            <div class="document-date">Ajouté le {{ $beneficiaire->created_at->format('d/m/Y') }}</div>
                        </div>
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
@endsection