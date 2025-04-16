@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span>Liste des bénéficiaires</span>
                    <input type="text" id="searchInput" placeholder="🔍 Rechercher...">
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>CIN</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Niveau scolaire</th>
                                    <th>Date d'acceptation</th>
                                    <th>Valide par </th>
                                    <th>Actions</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($beneficiaires as $beneficiaire)
                                    <tr>
                                        <td>{{ $beneficiaire->id }}</td>
                                        <td>{{ $beneficiaire->nom }}</td>
                                        <td>{{ $beneficiaire->prenom }}</td>
                                        <td>{{ $beneficiaire->cin }}</td>
                                        <td>{{ $beneficiaire->email }}</td>
                                        <td>{{ $beneficiaire->tel }}</td>
                                        <td>{{ $beneficiaire->niveau_scolaire }}</td>
                                        <td>{{ $beneficiaire->created_at->format('d/m/Y H:i') }}</td>
                                        <td>{{ $beneficiaire->admin ? $beneficiaire->admin->name : 'Non spécifié' }}</td>
                                        <td>
                                            <a href="{{ route('beneficiaire.show', $beneficiaire) }}" class="btn btn-info btn-sm">Voir</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $beneficiaires->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        margin-bottom: 30px;
        overflow: hidden;
    }

    .card-header {
        background-color: #4e54c8;
        background-image: linear-gradient(315deg, #4e54c8 0%, #8f94fb 74%);
        color: white;
        font-size: 1.25rem;
        font-weight: bold;
        padding: 16px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: none;
    }

    #searchInput {
        max-width: 250px;
        border-radius: 20px;
        background-color:white;
        color:black;
        border: 1px solid #ccc;
        padding: 6px 14px;
        font-size: 14px;
    }

    .table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 10px;
    }

    .table thead {
        background-color: #f5f6fa;
    }

    .table th, .table td {
        padding: 12px 16px;
        text-align: left;
        border-bottom: 1px solid #eaeaea;
    }

    .table th {
        font-weight: 600;
        color: #555;
    }

    .table tbody tr:hover {
        background-color: #eef4ff;
        transition: 0.2s ease;
    }

    .btn-info {
        background-color: #4e54c8;
        border: none;
        border-radius: 6px;
        padding: 6px 12px;
        color: white;
        font-size: 14px;
    }

    .btn-info:hover {
        background-color: #6a71e0;
    }

    .pagination {
        margin-top: 20px;
        display: flex;
        justify-content: center;
    }
</style>

<script>
    // Recherche simple
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        
        searchInput.addEventListener('keyup', function() {
            const searchText = this.value.toLowerCase();
            const tableRows = document.querySelectorAll('tbody tr');
            
            tableRows.forEach(function(row) {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchText) ? '' : 'none';
            });
        });
    });
</script>
@endsection
