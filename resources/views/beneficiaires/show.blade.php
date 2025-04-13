<!-- resources/views/beneficiaires/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-center">
        <div class="w-full md:w-2/3 lg:w-1/2">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4 flex justify-between items-center">
                    <h2 class="text-white text-xl font-semibold">Détails du bénéficiaire</h2>
                    <a href="{{ route('beneficiaire.index') }}" class="text-white hover:text-green-100 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                </div>

                <div class="p-6">
                    <div class="mb-8 flex flex-col items-center">
                        <div class="w-32 h-32 mb-4 rounded-full overflow-hidden border-4 border-green-100 shadow-md">
                            <img src="{{ asset('storage/' . $beneficiaire->photo_path) }}" alt="Photo du bénéficiaire" class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $beneficiaire->prenom }} {{ $beneficiaire->nom }}</h3>
                        <p class="text-gray-500">CIN: {{ $beneficiaire->cin }}</p>
                    </div>

                    <div class="border-t border-gray-200 pt-6 space-y-6">
                        <div>
                            <h4 class="text-lg font-medium text-gray-800 mb-2">Informations personnelles</h4>
                            <div class="bg-gray-50 rounded-lg p-4 grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500">Nom</p>
                                    <p class="font-medium">{{ $beneficiaire->nom }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Prénom</p>
                                    <p class="font-medium">{{ $beneficiaire->prenom }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">CIN</p>
                                    <p class="font-medium">{{ $beneficiaire->cin }}</p>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-500">Date de Naissance </p>
                                    <p class="font-medium">{{ $beneficiaire->date_naissance }}</p>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-500">Email</p>
                                    <p class="font-medium">{{ $beneficiaire->email }}</p>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-500">Téléphone</p>
                                    <p class="font-medium">{{ $beneficiaire->tel }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Niveau Scolaire</p>
                                    <p class="font-medium">
                                        @switch($beneficiaire->niveau_scolaire)
                                            @case('bac')
                                                Baccalauréat
                                                @break
                                            @case('bac+2')
                                                Bac+2
                                                @break
                                            @case('bac+3')
                                                Bac+3
                                                @break
                                            @default
                                                {{ $beneficiaire->niveau_scolaire }}
                                        @endswitch
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Statut</p>
                                    <p class="font-medium">
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Bénéficiaire</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-lg font-medium text-gray-800 mb-2">Documents soumis</h4>
                            <div class="space-y-4">
                                <div class="bg-gray-50 rounded-lg p-4 flex justify-between items-center">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <span>Baccalauréat</span>
                                    </div>
                                    <a href="{{ asset('storage/' . $beneficiaire->baccalaureat_path) }}" target="_blank" class="px-3 py-1 bg-green-100 text-green-600 rounded-md hover:bg-green-200 transition">
                                        Voir
                                    </a>
                                </div>

                                <div class="bg-gray-50 rounded-lg p-4 flex justify-between items-center">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                        </svg>
                                        <span>CIN (Document)</span>
                                    </div>
                                    <a href="{{ asset('storage/' . $beneficiaire->cin_path) }}" target="_blank" class="px-3 py-1 bg-green-100 text-green-600 rounded-md hover:bg-green-200 transition">
                                        Voir
                                    </a>
                                </div>


                                <div class="bg-gray-50 rounded-lg p-4 flex justify-between items-center">
                                    <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <span>Acte De Naissance (Document)</span>
                                    </div>
                                    <a href="{{ asset('storage/' . $beneficiaire->acte_path) }}" target="_blank" class="px-3 py-1 bg-green-100 text-green-600 rounded-md hover:bg-green-200 transition">
                                        Voir
                                    </a>
                                </div>

                                <div class="bg-gray-50 rounded-lg p-4 flex justify-between items-center">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        <span>Relevé de notes</span>
                                    </div>
                                    <a href="{{ asset('storage/' . $beneficiaire->releve_notes_path) }}" target="_blank" class="px-3 py-1 bg-green-100 text-green-600 rounded-md hover:bg-green-200 transition">
                                        Voir
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 text-center">
                <a href="{{ route('beneficiaire.index') }}" class="text-green-600 hover:text-green-800 transition">
                    Retour à la liste des bénéficiaires
                </a>
            </div>
        </div>
    </div>
</div>
@endsection