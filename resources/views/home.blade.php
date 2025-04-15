@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bienvenue</div>

                <div class="card-body">
                    <p>Bienvenue sur notre plateforme de candidature.</p>
                    <div class="text-center mt-4">
                        <a href="{{ route('candidature.create') }}" class="btn btn-primary btn-lg">Postuler maintenant</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection