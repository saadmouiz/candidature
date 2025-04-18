@extends('layouts.app')
@section('title', 'Gestion des Bénéficiaires')

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
        --border-color: #e5e7eb;
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

    /* Modern Filters */
    .filter-container {
        background-color: white;
        border-radius: 0.75rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        padding: 1.25rem;
        margin-bottom: 1.5rem;
    }
    
    .filter-label {
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--text-secondary);
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
    }
    
    .filter-label i {
        margin-right: 0.5rem;
        color: var(--primary);
    }
    
    .filter-options {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
    }
    
    .filter-btn {
        padding: 0.5rem 1.25rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--text-secondary);
        background-color: var(--background);
        border: none;
        border-radius: 9999px;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .filter-btn i {
        font-size: 0.75rem;
    }
    
    .filter-btn:hover {
        background-color: #f3f4f6;
        color: var(--text-primary);
    }
    
    .filter-btn.active {
        background-color: var(--primary);
        color: white;
    }
    
    .filter-btn.active i {
        opacity: 1;
    }
    
    .filter-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(255, 255, 255, 0.25);
        color: white;
        font-size: 0.75rem;
        min-width: 1.5rem;
        height: 1.5rem;
        border-radius: 9999px;
        padding: 0 0.375rem;
    }
    
    .filter-btn:not(.active) .filter-count {
        background-color: #e5e7eb;
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
        
        .filter-options {
            overflow-x: auto;
            padding-bottom: 0.5rem;
            -webkit-overflow-scrolling: touch;
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
                <h1>Gestion des <span class="text-gradient">bénéficiaires</span></h1>
                <p>Visualisez et gérez tous les bénéficiaires acceptés</p>
            </div>
            
            <div class="header-actions">
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    <input type="text" id="searchInput" class="search-input" placeholder="Rechercher un bénéficiaire...">
                </div>
            </div>
        </div>

        <!-- Modern Filters -->
        @php
            $allCount = $beneficiaires->count();
            $bacCount = $beneficiaires->filter(function($b) {
                return !str_contains(strtolower($b->niveau_scolaire), 'bac+');
            })->count();
            $bac2Count = $beneficiaires->filter(function($b) {
                return str_contains(strtolower($b->niveau_scolaire), 'bac+2');
            })->count();
            $bac3Count = $beneficiaires->filter(function($b) {
                return str_contains(strtolower($b->niveau_scolaire), 'bac+3');
            })->count();
        @endphp
        
        <div class="filter-container">
            <div class="filter-label">
                <i class="fa-solid fa-filter"></i> Filtrer par niveau d'études
            </div>
            <div class="filter-options">
                <button class="filter-btn active" id="allTab">
                    <i class="fa-solid fa-layer-group"></i>
                    Tous
                    <span class="filter-count">{{ $allCount }}</span>
                </button>
                <button class="filter-btn" id="bacTab">
                    <i class="fa-solid fa-graduation-cap"></i>
                    Baccalauréat
                    <span class="filter-count">{{ $bacCount }}</span>
                </button>
                <button class="filter-btn" id="bac2Tab">
                    <i class="fa-solid fa-user-graduate"></i>
                    Bac+2
                    <span class="filter-count">{{ $bac2Count }}</span>
                </button>
                <button class="filter-btn" id="bac3Tab">
                    <i class="fa-solid fa-award"></i>
                    Bac+3
                    <span class="filter-count">{{ $bac3Count }}</span>
                </button>
            </div>
        </div>

        <!-- Beneficiaries Table -->
        <div class="table-container">
            <div class="table-header">
                <div class="table-header-left">
                    <i class="fa-solid fa-list"></i> Liste des bénéficiaires
                </div>
                <div class="results-count">
                    <span id="visibleCount">{{ $beneficiaires->count() }}</span> résultats
                </div>
            </div>
            
            <div class="table-content">
                @if($beneficiaires->count() > 0)
                    <div class="table-responsive">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Bénéficiaire</th>
                                    <th>CIN</th>
                                    <th>Niveau</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Date d'acceptation</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($beneficiaires as $beneficiaire)
                                    <tr class="beneficiary-row" 
                                        data-level="{{ Str::contains(strtolower($beneficiaire->niveau_scolaire), 'bac+3') ? 'bac3' : (Str::contains(strtolower($beneficiaire->niveau_scolaire), 'bac+2') ? 'bac2' : 'bac') }}">
                                        <td>#{{ $beneficiaire->id }}</td>
                                        <td>
                                            <div class="user-cell">
                                                <div class="user-name">{{ $beneficiaire->nom }} {{ $beneficiaire->prenom }}</div>
                                                <div class="user-email">Validé par: {{ $beneficiaire->admin ? $beneficiaire->admin->name : 'Admin' }}</div>
                                            </div>
                                        </td>
                                        <td>{{ $beneficiaire->cin }}</td>
                                        <td>
                                            @php
                                                $levelClass = 'status-bac';
                                                if (str_contains(strtolower($beneficiaire->niveau_scolaire), 'bac+2')) {
                                                    $levelClass = 'status-bac2';
                                                } elseif (str_contains(strtolower($beneficiaire->niveau_scolaire), 'bac+3')) {
                                                    $levelClass = 'status-bac3';
                                                }
                                            @endphp
                                            <span class="status-pill {{ $levelClass }}">
                                                {{ $beneficiaire->niveau_scolaire }}
                                            </span>
                                        </td>
                                        <td>{{ $beneficiaire->email }}</td>
                                        <td>{{ $beneficiaire->tel }}</td>
                                        <td>{{ $beneficiaire->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <div class="actions-cell">
                                                <a href="{{ route('beneficiaire.show', $beneficiaire) }}" class="action-btn" title="Voir les détails">
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
                        {{ $beneficiaires->links() }}
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <h3 class="empty-title">Aucun bénéficiaire trouvé</h3>
                        <p class="empty-desc">Il semble qu'aucun bénéficiaire n'a encore été accepté. Vous verrez ici la liste une fois que des candidatures auront été acceptées.</p>
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
            const rows = document.querySelectorAll('.beneficiary-row');
            let count = 0;
            
            rows.forEach(function(row) {
                const text = row.textContent.toLowerCase();
                const isVisible = text.includes(searchText);
                row.style.display = isVisible ? '' : 'none';
                if (isVisible) count++;
            });
            
            visibleCount.textContent = count;
        });
        
        // Tab filtering
        const allTab = document.getElementById('allTab');
        const bacTab = document.getElementById('bacTab');
        const bac2Tab = document.getElementById('bac2Tab');
        const bac3Tab = document.getElementById('bac3Tab');
        const rows = document.querySelectorAll('.beneficiary-row');
        
        function setActiveTab(activeTab) {
            [allTab, bacTab, bac2Tab, bac3Tab].forEach(tab => {
                tab.classList.remove('active');
            });
            activeTab.classList.add('active');
        }
        
        function updateVisibleCount() {
            let count = 0;
            rows.forEach(row => {
                if (row.style.display !== 'none') count++;
            });
            visibleCount.textContent = count;
        }
        
        allTab.addEventListener('click', function() {
            setActiveTab(this);
            rows.forEach(row => row.style.display = '');
            updateVisibleCount();
        });
        
        bacTab.addEventListener('click', function() {
            setActiveTab(this);
            rows.forEach(row => {
                if (row.getAttribute('data-level') === 'bac') {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
            updateVisibleCount();
        });
        
        bac2Tab.addEventListener('click', function() {
            setActiveTab(this);
            rows.forEach(row => {
                if (row.getAttribute('data-level') === 'bac2') {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
            updateVisibleCount();
        });
        
        bac3Tab.addEventListener('click', function() {
            setActiveTab(this);
            rows.forEach(row => {
                if (row.getAttribute('data-level') === 'bac3') {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
            updateVisibleCount();
        });
    });
</script>
@endsection
