@extends('layouts.app')
@section('title', 'Candidatures refusées')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Liste des candidatures refusées</h3>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-danger">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>CIN</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Niveau scolaire</th>
                            <th>Date</th>
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $candidatures->links() }}
        </div>
    </div>
</div>
@endsection
