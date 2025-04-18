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

    .page-title {
        font-size: 2.25rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .page-subtitle {
        color: var(--text-secondary);
        font-size: 1.125rem;
        margin-bottom: 2rem;
    }

    /* Dashboard header */
    .dashboard-header {
        background-color: white;
        border-radius: 1rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
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

    /* Stats cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background-color: white;
        border-radius: 1rem;
        padding: 2rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(to right, #EF4444, #FB7185);
    }

    .stat-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 60px;
        background-color: rgba(239, 68, 68, 0.1);
        color: var(--primary);
        border-radius: 50%;
        margin-bottom: 1.25rem;
        font-size: 1.5rem;
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
        line-height: 1;
    }

    .stat-label {
        color: var(--text-secondary);
        font-size: 0.875rem;
    }

    /* Tabs */
    .tab-container {
        margin-bottom: 2rem;
    }

    .tab-headers {
        display: flex;
        gap: 1rem;
        border-bottom: 1px solid var(--border-color);
        margin-bottom: 2rem;
    }

    .tab-btn {
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        color: var(--text-secondary);
        background-color: transparent;
        border: none;
        border-bottom: 2px solid transparent;
        cursor: pointer;
        transition: all 0.2s;
    }

    .tab-btn.active {
        color: var(--primary);
        border-bottom-color: var(--primary);
    }

    /* Table styling */
    .table-container {
        background-color: white;
        border-radius: 1rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .table-header {
        padding: 1.5rem;
        background: linear-gradient(to right, #EF4444, #FB7185);
        color: white;
        font-weight: 600;
        font-size: 1.25rem;
    }

    .table-content {
        padding: 1.5rem;
    }

    .data-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .data-table th {
        background-color: #f9fafb;
        padding: 1rem;
        text-align: left;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-secondary);
    }

    .data-table td {
        padding: 1rem;
        color: var(--text-primary);
        border-top: 1px solid var(--border-color);
        vertical-align: middle;
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
        padding: 0.375rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
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
        width: 36px;
        height: 36px;
        border-radius: 0.375rem;
        background-color: rgba(239, 68, 68, 0.1);
        color: var(--primary);
        border: 1px solid transparent;
        transition: all 0.2s;
    }

    .action-btn:hover {
        background-color: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    /* Pagination */
    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
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
        width: 40px;
        height: 40px;
        border-radius: 0.5rem;
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
        width: 80px;
        height: 80px;
        background-color: rgba(239, 68, 68, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: var(--primary);
        margin-bottom: 1.5rem;
    }

    .empty-title {
        font-size: 1.25rem;
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

        <!-- Stats overview -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="stat-value">{{ $beneficiaires->total() }}</div>
                <div class="stat-label">Total des bénéficiaires</div>
            </div>
            
            @php
                $bacCount = $beneficiaires->where('niveau_scolaire', 'like', '%bac%')->count();
                $bac2Count = $beneficiaires->where('niveau_scolaire', 'like', '%bac+2%')->count();
                $bac3Count = $beneficiaires->where('niveau_scolaire', 'like', '%bac+3%')->count();
            @endphp
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <div class="stat-value">{{ $bac2Count + $bac3Count }}</div>
                <div class="stat-label">Niveau supérieur</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
                <div class="stat-value">{{ $beneficiaires->where('created_at', '>=', now()->subDays(30))->count() }}</div>
                <div class="stat-label">Nouveaux ce mois</div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="tab-container">
            <div class="tab-headers">
                <button class="tab-btn active" id="allTab">Tous les bénéficiaires</button>
                <button class="tab-btn" id="bacTab">Baccalauréat</button>
                <button class="tab-btn" id="bac2Tab">Bac+2</button>
                <button class="tab-btn" id="bac3Tab">Bac+3</button>
            </div>
        </div>

        <!-- Beneficiaries Table -->
        <div class="table-container">
            <div class="table-header">
                <i class="fa-solid fa-list mr-2"></i> Liste des bénéficiaires
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
        searchInput.addEventListener('keyup', function() {
            const searchText = this.value.toLowerCase();
            const rows = document.querySelectorAll('.beneficiary-row');
            
            rows.forEach(function(row) {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchText) ? '' : 'none';
            });
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
        
        allTab.addEventListener('click', function() {
            setActiveTab(this);
            rows.forEach(row => row.style.display = '');
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
        });
        
        // Animation for rows
        rows.forEach((row, index) => {
            row.style.opacity = '0';
            row.style.transform = 'translateY(10px)';
            setTimeout(() => {
                row.style.transition = 'all 0.3s ease';
                row.style.opacity = '1';
                row.style.transform = 'translateY(0)';
            }, 50 * index);
        });
    });
</script>
@endsection
