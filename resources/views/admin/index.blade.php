@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-center">
        <div class="w-full lg:w-3/4">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-4">
                    <h2 class="text-white text-xl font-semibold">Tableau de bord</h2>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Candidatures Card -->
                        <div class="bg-white rounded-lg shadow-md border border-gray-100 transition-all duration-300 hover:shadow-xl hover:scale-105">
                            <div class="p-6 text-center">
                                <div class="flex justify-center mb-4">
                                    <div class="rounded-full bg-blue-100 p-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                </div>
                                <h3 class="text-lg font-medium text-gray-800 mb-2">Candidatures en attente</h3>
                                <p class="text-4xl font-bold text-blue-600 mb-4">{{ $candidatures_count }}</p>
                                <a href="{{ route('candidature.index') }}" class="inline-block px-5 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    Voir les candidatures
                                </a>
                            </div>
                        </div>

                        <!-- Bénéficiaires Card -->
                        <div class="bg-white rounded-lg shadow-md border border-gray-100 transition-all duration-300 hover:shadow-xl hover:scale-105">
                            <div class="p-6 text-center">
                                <div class="flex justify-center mb-4">
                                    <div class="rounded-full bg-green-100 p-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <h3 class="text-lg font-medium text-gray-800 mb-2">Bénéficiaires</h3>
                                <p class="text-4xl font-bold text-green-600 mb-4">{{ $beneficiaires_count }}</p>
                                <a href="{{ route('beneficiaire.index') }}" class="inline-block px-5 py-2 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                    Voir les bénéficiaires
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection