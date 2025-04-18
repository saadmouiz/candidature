@extends('layouts.app')
@section('title', 'Candidatures refusées')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --primary: #ef4444;
        --primary-light: #f87171;
        --primary-dark: #dc2626;
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
        --text-light: #9ca3af;
        --border-color: #e5e7eb;
        --shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .text-gradient {
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        background-image: linear-gradient(to right, #EF4444, #FB7185);
    }

    .page-container {
        background-color: var(--background);
        min-height: 100vh;
        padding: 2rem 0;
        display: flex;
        justify-content: center;
    }

    .content-wrapper {
        width: 100%;
        max-width: 1280px;
    }

    /* Dashboard header */
    .dashboard-header {
        background-color: white;
        border-radius: 0.75rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1.5rem;
    }

    .header-title-group h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.25rem;
    }

    .header-title-group p {
        color: var(--text-secondary);
        font-size: 0.875rem;
    }

    .header-actions {
        display: flex;
        gap: 1rem;
    }

    .search-box {
        position: relative;
    }

    .search-input {
        width: 300px;
        padding: 0.75rem 1rem 0.75rem 2.75rem;
        border: 1px solid var(--border-color);
        border-radius: 0.5rem;
        font-size: 0.875rem;
        color: var(--text-primary);
        background-color: white;
        transition: all 0.2s;
    }

    .search-input:focus {
        outline: none;
        box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.25);
        border-color: var(--primary);
    }

    .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-secondary);
    }

    /* Table styling */
    .table-container {
        background-color: white;
        border-radius: 0.75rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .table-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--border-color);
        color: var(--text-primary);
        font-weight: 600;
        font-size: 1.125rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .table-header-left {
        display: flex;
        align-items: center;
    }
    
    .table-header i {
        margin-right: 0.5rem;
        color: var(--primary);
    }
    
    .results-count {
        font-size: 0.875rem;
        color: var(--text-secondary);
        font-weight: normal;
    }

    .table-content {
        padding: 0;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table th {
        padding: 1rem 1.5rem;
        text-align: left;
        font-weight: 500;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-secondary);
        border-bottom: 1px solid var(--border-color);
    }

    .data-table td {
        padding: 1rem 1.5rem;
        color: var(--text-primary);
        border-bottom: 1px solid var(--border-color);
        vertical-align: middle;
    }

    .data-table tr:last-child td {
        border-bottom: none;
    }

    .data-table tr:hover td {
        background-color: #f9fafb;
    }

    .user-cell {
        display: flex;
        flex-direction: column;
    }

    .user-name {
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.25rem;
    }

    .user-email {
        font-size: 0.75rem;
        color: var(--text-secondary);
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.25rem 0.625rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .status-bac {
        background-color: rgba(239, 68, 68, 0.1);
        color: var(--primary);
    }

    .status-bac2 {
        background-color: rgba(16, 185, 129, 0.1);
        color: var(--success);
    }

    .status-bac3 {
        background-color: rgba(245, 158, 11, 0.1);
        color: var(--warning);
    }

    .actions-cell {
        display: flex;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border-radius: 0.375rem;
        background-color: rgba(239, 68, 68, 0.1);
        color: var(--primary);
        border: none;
        transition: all 0.2s;
    }

    .action-btn:hover {
        background-color: var(--primary);
        color: white;
    }

    /* Pagination */
    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 1.5rem;
        padding: 1rem 0;
    }

    .pagination {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .page-item {
        margin: 0 0.25rem;
    }

    .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 0.375rem;
        font-weight: 500;
        color: var(--text-primary);
        border: 1px solid var(--border-color);
        text-decoration: none;
        transition: all 0.2s;
    }

    .page-item.active .page-link {
        background-color: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    .page-link:hover {
        background-color: #f9fafb;
        text-decoration: none;
    }

    .page-item.active .page-link:hover {
        background-color: var(--primary);
    }

    /* Empty state */
    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 4rem 2rem;
        text-align: center;
    }

    .empty-icon {
        width: 64px;
        height: 64px;
        background-color: rgba(239, 68, 68, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: var(--primary);
        margin-bottom: 1.5rem;
    }

    .empty-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .empty-desc {
        color: var(--text-secondary);
        max-width: 400px;
        margin-bottom: 1.5rem;
    }

    @media (max-width: 768px) {
        .dashboard-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .header-actions {
            width: 100%;
            flex-direction: column;
        }
        
        .search-input {
            width: 100%;
        }
        
        .data-table td:nth-child(3),
        .data-table th:nth-child(3),
        .data-table td:nth-child(5),
        .data-table th:nth-child(5),
        .data-table td:nth-child(6),
        .data-table th:nth-child(6) {
            display: none;
        }
    }
</style>
@endsection

@section('content')
<div class="page-container">
    <div class="content-wrapper">
        <!-- Dashboard header -->
        <div class="dashboard-header">
            <div class="header-title-group">
                <h1>Candidatures <span class="text-gradient">refusées</span></h1>
                <p>Visualisez et gérez toutes les candidatures refusées</p>
            </div>
            
            <div class="header-actions">
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    <input type="text" id="searchInput" class="search-input" placeholder="Rechercher une candidature...">
                </div>
            </div>
        </div>

        <!-- Candidatures Table -->
        <div class="table-container">
            <div class="table-header">
                <div class="table-header-left">
                    <i class="fa-solid fa-times-circle"></i> Liste des candidatures refusées
                </div>
                <div class="results-count">
                    <span id="visibleCount">{{ $candidatures->count() }}</span> résultats
                </div>
            </div>
            
            <div class="table-content">
                @if($candidatures->count() > 0)
                    <div class="table-responsive">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Candidat</th>
                                    <th>CIN</th>
                                    <th>Niveau</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Date de refus</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($candidatures as $candidature)
                                    <tr class="candidature-row">
                                        <td>#{{ $candidature->id }}</td>
                                        <td>
                                            <div class="user-cell">
                                                <div class="user-name">{{ $candidature->nom }} {{ $candidature->prenom }}</div>
                                                <div class="user-email">Refusée par: </div>
                                            </div>
                                        </td>
                                        <td>{{ $candidature->cin }}</td>
                                        <td>
                                            @php
                                                $levelClass = 'status-bac';
                                                if (str_contains(strtolower($candidature->niveau_scolaire), 'bac+2')) {
                                                    $levelClass = 'status-bac2';
                                                } elseif (str_contains(strtolower($candidature->niveau_scolaire), 'bac+3')) {
                                                    $levelClass = 'status-bac3';
                                                }
                                            @endphp
                                            <span class="status-pill {{ $levelClass }}">
                                                {{ $candidature->niveau_scolaire }}
                                            </span>
                                        </td>
                                        <td>{{ $candidature->email }}</td>
                                        <td>{{ $candidature->tel }}</td>
                                        <td>{{ $candidature->updated_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <div class="actions-cell">
                                                <a href="{{ route('candidature.show', $candidature->id) }}" class="action-btn" title="Voir les détails">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="pagination-container">
                        {{ $candidatures->links() }}
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fa-solid fa-times-circle"></i>
                        </div>
                        <h3 class="empty-title">Aucune candidature refusée</h3>
                        <p class="empty-desc">Il semble qu'aucune candidature n'a encore été refusée. Vous verrez ici la liste une fois que des candidatures auront été refusées.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search functionality
        const searchInput = document.getElementById('searchInput');
        const visibleCount = document.getElementById('visibleCount');
        
        searchInput.addEventListener('keyup', function() {
            const searchText = this.value.toLowerCase();
            const rows = document.querySelectorAll('.candidature-row');
            let count = 0;
            
            rows.forEach(function(row) {
                const text = row.textContent.toLowerCase();
                const isVisible = text.includes(searchText);
                row.style.display = isVisible ? '' : 'none';
                if (isVisible) count++;
            });
            
            visibleCount.textContent = count;
        });
    });
</script>
@endsection
