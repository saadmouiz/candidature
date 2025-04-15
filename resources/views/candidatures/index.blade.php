@extends('layouts.app')

@section('content')
<div class="container">
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
                                <th>Date de création</th>
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
                                        <form action="{{ route('candidature.accepter', $candidature) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success">Accepter</button>
                                        </form>
                                        <form action="{{ route('candidature.refuser', $candidature) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">Refuser</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $candidatures->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection