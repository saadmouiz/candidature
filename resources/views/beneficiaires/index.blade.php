@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Liste des bénéficiaires</div>

                <div class="card-body">
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
                                    <td>
                                        <a href="{{ route('beneficiaire.show', $beneficiaire) }}" class="btn btn-sm btn-info">Voir</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $beneficiaires->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection