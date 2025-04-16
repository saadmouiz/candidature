@extends('layouts.app')
@section('title', 'Détails du bénéficiaire')

@section('content')
<style>
    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .card-header {
        background-color: #007bff;
        color: white;
        font-weight: bold;
        font-size: 1.2rem;
    }

    .table th, .table td {
        vertical-align: middle !important;
        text-align: center;
    }

    .btn-info {
        background-color: #17a2b8;
        border: none;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
    }

    .btn-sm {
        margin-bottom: 5px;
    }

    .pagination {
        justify-content: center;
    }

    form {
        display: inline-block;
    }
</style>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Liste des candidatures en attente</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-primary">
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>CIN</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Niveau scolaire</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($candidatures as $candidature)
                                    <tr>
                                        <td>{{ $candidature->id }}</td>
                                        <td>{{ $candidature->nom }}</td>
                                        <td>{{ $candidature->prenom }}</td>
                                        <td>{{ $candidature->cin }}</td>
                                        <td>{{ $candidature->email }}</td>
                                        <td>{{ $candidature->tel }}</td>
                                        <td>{{ $candidature->niveau_scolaire }}</td>
                                        <td>{{ $candidature->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('candidature.show', $candidature) }}" class="btn btn-sm btn-info">Voir</a>
                                            
                                            <form action="{{ route('candidature.accepter', $candidature) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="admin_id" value="{{ Auth::id() }}">
                                                <button type="submit" class="btn btn-sm btn-success">Accepter</button>
                                            </form>

                                            <form action="{{ route('candidature.refuser', $candidature) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger">Refuser</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $candidatures->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
