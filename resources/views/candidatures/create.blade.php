@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-center">
        <div class="w-full md:w-3/4 lg:w-2/3">
            <div class="bg-white rounded-lg shadow-xl overflow-hidden">
                <div class="bg-gradient-to-r from-[#a2140f] to-[#c41f1b] px-6 py-6">
                    <h2 class="text-white text-2xl font-bold">Formulaire de candidature</h2>
                    <p class="text-white opacity-80 mt-1">Complétez tous les champs pour soumettre votre candidature</p>
                </div>

                <div class="p-8">
                    <form method="POST" action="{{ route('candidature.store') }}" enctype="multipart/form-data" class="space-y-8">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Informations personnelles -->
                            <div class="col-span-2">
                                <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#a2140f]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Informations personnelles
                                </h3>
                            </div>

                            <div class="group">
                                <label for="nom" class="block text-sm font-medium text-gray-700 mb-1 group-focus-within:text-[#a2140f]">Nom</label>
                                <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-[#a2140f] focus:border-[#a2140f] transition-colors @error('nom') border-red-500 @enderror" 
                                    id="nom" name="nom" value="{{ old('nom') }}" required placeholder="Votre nom de famille">
                                @error('nom')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="group">
                                <label for="prenom" class="block text-sm font-medium text-gray-700 mb-1 group-focus-within:text-[#a2140f]">Prénom</label>
                                <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-[#a2140f] focus:border-[#a2140f] transition-colors @error('prenom') border-red-500 @enderror" 
                                    id="prenom" name="prenom" value="{{ old('prenom') }}" required placeholder="Votre prénom">
                                @error('prenom')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="group">
                                <label for="cin" class="block text-sm font-medium text-gray-700 mb-1 group-focus-within:text-[#a2140f]">CIN</label>
                                <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-[#a2140f] focus:border-[#a2140f] transition-colors @error('cin') border-red-500 @enderror" 
                                    id="cin" name="cin" value="{{ old('cin') }}" required placeholder="Exemple: AB123456">
                                @error('cin')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="group">
                                <label for="date" class="block text-sm font-medium text-gray-700 mb-1 group-focus-within:text-[#a2140f]">Date de naissance</label>
                                <input type="date" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-[#a2140f] focus:border-[#a2140f] transition-colors @error('date') border-red-500 @enderror" 
                                    id="date" name="date" value="{{ old('date') }}" required>
                                @error('date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="group">
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1 group-focus-within:text-[#a2140f]">Email</label>
                                <input type="email" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-[#a2140f] focus:border-[#a2140f] transition-colors @error('email') border-red-500 @enderror" 
                                    id="email" name="email" value="{{ old('email') }}" required placeholder="exemple@email.com">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="group">
                                <label for="tel" class="block text-sm font-medium text-gray-700 mb-1 group-focus-within:text-[#a2140f]">Téléphone</label>
                                <input type="tel" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-[#a2140f] focus:border-[#a2140f] transition-colors @error('tel') border-red-500 @enderror" 
                                    id="tel" name="tel" value="{{ old('tel') }}" required placeholder="Exemple: 0612345678">
                                @error('tel')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="group col-span-2">
                                <label for="niveau_scolaire" class="block text-sm font-medium text-gray-700 mb-1 group-focus-within:text-[#a2140f]">Niveau Scolaire</label>
                                <select class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-[#a2140f] focus:border-[#a2140f] transition-colors @error('niveau_scolaire') border-red-500 @enderror" 
                                    id="niveau_scolaire" name="niveau_scolaire" required>
                                    <option value="" selected disabled>Sélectionnez votre niveau</option>
                                    <option value="bac" {{ old('niveau_scolaire') == 'bac' ? 'selected' : '' }}>Baccalauréat</option>
                                    <option value="bac+2" {{ old('niveau_scolaire') == 'bac+2' ? 'selected' : '' }}>Bac+2</option>
                                    <option value="bac+3" {{ old('niveau_scolaire') == 'bac+3' ? 'selected' : '' }}>Bac+3</option>
                                </select>
                                @error('niveau_scolaire')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Documents requis -->
                            <div class="col-span-2 pt-4">
                                <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#a2140f]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Documents requis
                                </h3>
                                <p class="text-sm text-gray-500 mb-4">Formats acceptés: PDF, JPG, JPEG, PNG (Max: 2MB)</p>
                            </div>

                            <div class="col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="baccalaureat" class="block text-sm font-medium text-gray-700 mb-2">Baccalauréat</label>
                                    <div class="flex items-center">
                                        <label class="w-full flex items-center px-4 py-3 bg-white text-gray-700 rounded-lg shadow-sm border border-gray-300 cursor-pointer hover:bg-gray-50 hover:border-[#a2140f] transition-colors group">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400 group-hover:text-[#a2140f]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                            <span class="text-sm file-name">Sélectionner un fichier</span>
                                            <input type="file" class="hidden file-input @error('baccalaureat') border-red-500 @enderror" id="baccalaureat" name="baccalaureat" required>
                                        </label>
                                    </div>
                                    @error('baccalaureat')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="cin_doc" class="block text-sm font-medium text-gray-700 mb-2">CIN (Document)</label>
                                    <div class="flex items-center">
                                        <label class="w-full flex items-center px-4 py-3 bg-white text-gray-700 rounded-lg shadow-sm border border-gray-300 cursor-pointer hover:bg-gray-50 hover:border-[#a2140f] transition-colors group">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400 group-hover:text-[#a2140f]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                            <span class="text-sm file-name">Sélectionner un fichier</span>
                                            <input type="file" class="hidden file-input @error('cin_doc') border-red-500 @enderror" id="cin_doc" name="cin_doc" required>
                                        </label>
                                    </div>
                                    @error('cin_doc')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="acte_doc" class="block text-sm font-medium text-gray-700 mb-2">Acte de naissance</label>
                                    <div class="flex items-center">
                                        <label class="w-full flex items-center px-4 py-3 bg-white text-gray-700 rounded-lg shadow-sm border border-gray-300 cursor-pointer hover:bg-gray-50 hover:border-[#a2140f] transition-colors group">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400 group-hover:text-[#a2140f]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                            <span class="text-sm file-name">Sélectionner un fichier</span>
                                            <input type="file" class="hidden file-input @error('acte_doc') border-red-500 @enderror" id="acte_doc" name="acte_doc" required>
                                        </label>
                                    </div>
                                    @error('acte_doc')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="releve_notes" class="block text-sm font-medium text-gray-700 mb-2">Relevé de notes</label>
                                    <div class="flex items-center">
                                        <label class="w-full flex items-center px-4 py-3 bg-white text-gray-700 rounded-lg shadow-sm border border-gray-300 cursor-pointer hover:bg-gray-50 hover:border-[#a2140f] transition-colors group">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400 group-hover:text-[#a2140f]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                            <span class="text-sm file-name">Sélectionner un fichier</span>
                                            <input type="file" class="hidden file-input @error('releve_notes') border-red-500 @enderror" id="releve_notes" name="releve_notes" required>
                                        </label>
                                    </div>
                                    @error('releve_notes')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">Photo d'identité</label>
                                    <div class="flex items-center">
                                        <label class="w-full flex items-center px-4 py-3 bg-white text-gray-700 rounded-lg shadow-sm border border-gray-300 cursor-pointer hover:bg-gray-50 hover:border-[#a2140f] transition-colors group">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400 group-hover:text-[#a2140f]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                            <span class="text-sm file-name">Sélectionner un fichier</span>
                                            <input type="file" class="hidden file-input @error('photo') border-red-500 @enderror" id="photo" name="photo" required 
                                                accept="image/jpeg, image/png, image/jpg">
                                        </label>
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500">Format image uniquement (JPG, JPEG, PNG)</p>
                                    @error('photo')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="pt-6">
                            <button type="submit" class="w-full py-3 px-4 bg-[#a2140f] hover:bg-[#8a1109] text-white font-medium rounded-md shadow-md focus:outline-none focus:ring-2 focus:ring-[#a2140f] focus:ring-offset-2 transition-colors text-lg">
                                Soumettre ma candidature
                            </button>
                            <p class="text-center text-sm text-gray-500 mt-4">En soumettant ce formulaire, vous confirmez que toutes les informations fournies sont correctes.</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Script pour afficher le nom du fichier sélectionné
    const fileInputs = document.querySelectorAll('.file-input');
    
    fileInputs.forEach(input => {
        input.addEventListener('change', function() {
            const fileName = this.files[0]?.name;
            const fileNameElement = this.parentElement.querySelector('.file-name');
            
            if (fileName) {
                fileNameElement.textContent = fileName.length > 20 
                    ? fileName.substring(0, 17) + '...' 
                    : fileName;
            } else {
                fileNameElement.textContent = 'Sélectionner un fichier';
            }
        });
    });
});
</script>
@endsection