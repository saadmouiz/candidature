@extends('layouts.app')
@section('title', 'Candidatures Dashboard')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-light text-gray-900 mb-2">Gestion des <span class="font-semibold text-gradient">candidatures</span></h1>
            <p class="text-gray-600">Consultez, évaluez et gérez toutes les candidatures des étudiants de manière efficace.</p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-xl shadow-soft p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-50 text-blue-500 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Total Candidatures</p>
                        <p class="text-2xl font-semibold text-gray-800">{{ $totalCount }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-soft p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-50 text-green-500 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Candidatures Acceptées</p>
                        <p class="text-2xl font-semibold text-gray-800">{{ $acceptedCount }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-soft p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-red-50 text-red-500 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Candidatures Refusées</p>
                        <p class="text-2xl font-semibold text-gray-800">{{ $rejectedCount }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-soft p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-50 text-yellow-500 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">En Attente</p>
                        <p class="text-2xl font-semibold text-gray-800">{{ $pendingCount }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden rounded-2xl shadow-soft mb-8">
            <div class="p-6 bg-gradient-to-r from-brand-dark to-brand text-white rounded-t-2xl">
                <h2 class="text-xl font-semibold">Liste des candidatures en attente</h2>
            </div>

            <div class="p-6">
                @if (session('success'))
                    <div class="mb-6 bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg" role="alert">
                        <p class="font-medium">{{ session('success') }}</p>
                    </div>
                @endif
                
                <!-- Simple Search and Filters with Vanilla JS -->
                <div class="mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="col-span-2">
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Recherche</label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" id="searchInput"
                                       class="focus:ring-brand focus:border-brand block w-full pl-10 pr-3 py-2 border border-gray-200 rounded-lg" 
                                       placeholder="Rechercher par nom, email, CIN...">
                            </div>
                        </div>
                        
                        <div>
                            <label for="sort" class="block text-sm font-medium text-gray-700 mb-1">Trier par</label>
                            <select id="sortOption"
                                    class="focus:ring-brand focus:border-brand block w-full py-2 px-3 border border-gray-200 rounded-lg">
                                <option value="newest">Plus récents</option>
                                <option value="oldest">Plus anciens</option>
                                <option value="name_asc">Nom (A-Z)</option>
                                <option value="name_desc">Nom (Z-A)</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="niveau_scolaire" class="block text-sm font-medium text-gray-700 mb-1">Niveau scolaire</label>
                            <select id="niveauFilter"
                                    class="focus:ring-brand focus:border-brand block w-full py-2 px-3 border border-gray-200 rounded-lg">
                                <option value="">Tous les niveaux</option>
                                <option value="bac">Baccalauréat</option>
                                <option value="bac+2">Bac+2</option>
                                <option value="bac+3">Bac+3</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="w-full overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100 table-auto">
                        <thead>
                            <tr>
                                <th scope="col" class="px-4 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-4 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                                <th scope="col" class="px-4 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prénom</th>
                                <th scope="col" class="px-4 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CIN</th>
                                <th scope="col" class="px-4 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th scope="col" class="px-4 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Téléphone</th>
                                <th scope="col" class="px-4 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Niveau</th>
                                <th scope="col" class="px-4 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-4 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($candidatures as $candidature)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $candidature->id }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">{{ $candidature->nom }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">{{ $candidature->prenom }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">{{ $candidature->cin }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">{{ $candidature->email }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">{{ $candidature->tel }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">{{ $candidature->niveau_scolaire }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">{{ $candidature->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm">
                                        <div class="flex flex-row space-x-2">
                                            <a href="{{ route('candidature.show', $candidature) }}" 
                                               class="inline-flex items-center justify-center px-2 py-1 bg-white border border-blue-200 text-blue-600 rounded-md hover:bg-blue-50 transition-colors shadow-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            
                                            <form action="{{ route('candidature.accepter', $candidature) }}" method="POST" class="inline">
                                                @csrf
                                                <input type="hidden" name="admin_id" value="{{ Auth::id() }}">
                                                <button type="submit" 
                                                        class="inline-flex items-center justify-center px-2 py-1 bg-white border border-green-200 text-green-600 rounded-md hover:bg-green-50 transition-colors shadow-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </button>
                                            </form>

                                            <form action="{{ route('candidature.refuser', $candidature) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" 
                                                        class="inline-flex items-center justify-center px-2 py-1 bg-white border border-red-200 text-red-600 rounded-md hover:bg-red-50 transition-colors shadow-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Simple Pagination -->
                <div class="mt-6 flex justify-center">
                    {{ $candidatures->links() }}
                </div>
            </div>
        </div>
        
        <!-- Quick Tips Section -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 shadow-inner">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Conseils pour l'évaluation des candidatures</h3>
            <div class="grid md:grid-cols-2 gap-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0 mr-3">
                        <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">1</div>
                    </div>
                    <div>
                        <p class="text-gray-700 font-medium">Vérifiez les documents</p>
                        <p class="text-gray-600 text-sm">Assurez-vous que tous les documents requis sont présents et valides.</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="flex-shrink-0 mr-3">
                        <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">2</div>
                    </div>
                    <div>
                        <p class="text-gray-700 font-medium">Examinez les antécédents académiques</p>
                        <p class="text-gray-600 text-sm">Vérifiez les relevés de notes pour évaluer la performance académique.</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="flex-shrink-0 mr-3">
                        <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">3</div>
                    </div>
                    <div>
                        <p class="text-gray-700 font-medium">Évaluez la motivation</p>
                        <p class="text-gray-600 text-sm">La lettre de motivation doit démontrer un réel intérêt et des objectifs clairs.</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="flex-shrink-0 mr-3">
                        <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">4</div>
                    </div>
                    <div>
                        <p class="text-gray-700 font-medium">Considérez le potentiel</p>
                        <p class="text-gray-600 text-sm">Parfois, le potentiel et la détermination peuvent compenser des résultats académiques plus faibles.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.text-gradient {
    background-clip: text;
    -webkit-background-clip: text;
    color: transparent;
    background-image: linear-gradient(to right, #EF4444, #FB7185);
}
</style>
@endsection
