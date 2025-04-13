@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
    <div class="bg-white shadow-md rounded-lg max-w-xl w-full p-8">
        <h2 class="text-2xl font-bold text-center text-green-600 mb-4">Merci de votre candidature</h2>
        <p class="text-center text-gray-700 mb-2">
            Votre candidature a été enregistrée avec succès.
        </p>
        <p class="text-center text-gray-700 mb-6">
            Nous l'examinerons dans les plus brefs délais.
        </p>
        <div class="flex justify-center">
            <a href="{{ route('welcome') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                Retour à l'accueil
            </a>
        </div>
    </div>
</div>
@endsection
