@extends('layouts.app')

@section('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    brand: {
                        DEFAULT: '#EF4444',
                        light: '#FEF2F2',
                        dark: '#B91C1C'
                    },
                    dark: '#121826',
                },
                fontFamily: {
                    sans: ['Inter', 'sans-serif'],
                },
                boxShadow: {
                    'soft': '0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04)',
                }
            }
        }
    }
</script>
<style>
    @keyframes slideUp {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    
    .animate-slideUp {
        animation: slideUp 0.6s ease-out forwards;
    }
    
    .glass {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .text-gradient {
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        background-image: linear-gradient(to right, #EF4444, #FB7185);
    }
    
    input:focus, select:focus {
        border-color: #EF4444;
        --tw-ring-color: rgba(239, 68, 68, 0.2);
    }
    
    .file-input-wrapper:hover .file-overlay {
        opacity: 1;
    }
</style>
@endsection

@section('content')
<div class="min-h-screen bg-gray-50 font-sans text-dark antialiased pb-16">
    <!-- Fixed background with gradient overlay -->
    <div class="absolute inset-0 -z-10 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-dark/70 to-black/50"></div>
        <div class="absolute inset-0 bg-brand-light/90"></div>
    </div>
    
    <div class="container max-w-6xl mx-auto px-4 relative z-10">
        <!-- Header Section -->
        <!-- <div class="text-center mb-12 animate-slideUp">
            <span class="inline-block px-4 py-1.5 bg-brand/10 rounded-full text-brand text-sm font-medium mb-4">Association Al Amal</span>
            <h1 class="text-4xl md:text-5xl font-light mb-6">
                Formulaire de <span class="font-semibold text-gradient">Candidature</span>
            </h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Complétez ce formulaire pour soumettre votre candidature et rejoindre notre programme d'accompagnement académique.
            </p>
        </div> -->
        
        <!-- Form Card -->
        <div class="bg-white rounded-3xl shadow-soft overflow-hidden mb-12 animate-slideUp" style="animation-delay: 0.2s;">
            <!-- Error Alert -->
            @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-brand p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-brand" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-brand">Veuillez corriger les erreurs suivantes:</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            
            <form method="POST" action="{{ route('candidature.store') }}" enctype="multipart/form-data" class="p-6 md:p-10">
                @csrf
                
                <!-- Personal Information Section -->
                <div class="mb-10">
                    <div class="flex items-center mb-6">
                        <div class="w-8 h-8 rounded-full bg-brand/10 flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-medium">Informations Personnelles</h2>
                    </div>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="relative">
                            <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                            <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required
                                class="block w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-brand focus:border-brand transition-all outline-none"
                                placeholder="Votre nom">
                        </div>
                        
                        <div class="relative">
                            <label for="prenom" class="block text-sm font-medium text-gray-700 mb-1">Prénom</label>
                            <input type="text" id="prenom" name="prenom" value="{{ old('prenom') }}" required
                                class="block w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-brand focus:border-brand transition-all outline-none"
                                placeholder="Votre prénom">
                        </div>
                        
                        <div class="relative">
                            <label for="cin" class="block text-sm font-medium text-gray-700 mb-1">CIN</label>
                            <input type="text" id="cin" name="cin" value="{{ old('cin') }}" required
                                class="block w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-brand focus:border-brand transition-all outline-none"
                                placeholder="Votre numéro CIN">
                        </div>
                        
                        <div class="relative">
                            <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Date de naissance</label>
                            <input type="date" id="date" name="date" value="{{ old('date') }}" required
                                class="block w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-brand focus:border-brand transition-all outline-none">
                        </div>
                    </div>
                </div>
                
                <!-- Contact Information Section -->
                <div class="mb-10">
                    <div class="flex items-center mb-6">
                        <div class="w-8 h-8 rounded-full bg-brand/10 flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-medium">Coordonnées</h2>
                    </div>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="relative">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                class="block w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-brand focus:border-brand transition-all outline-none"
                                placeholder="votre@email.com">
                        </div>
                        
                        <div class="relative">
                            <label for="tel" class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                            <input type="text" id="tel" name="tel" value="{{ old('tel') }}" required
                                class="block w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-brand focus:border-brand transition-all outline-none"
                                placeholder="Votre numéro de téléphone">
                        </div>
                    </div>
                </div>
                
                <!-- Education Section -->
                <div class="mb-10">
                    <div class="flex items-center mb-6">
                        <div class="w-8 h-8 rounded-full bg-brand/10 flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-medium">Formation</h2>
                    </div>
                    
                    <div class="relative">
                        <label for="niveau_scolaire" class="block text-sm font-medium text-gray-700 mb-1">Niveau scolaire</label>
                        <select id="niveau_scolaire" name="niveau_scolaire" required
                            class="block w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-brand focus:border-brand transition-all outline-none appearance-none bg-white">
                            <option value="">Sélectionnez votre niveau</option>
                            <option value="bac" {{ old('niveau_scolaire') == 'bac' ? 'selected' : '' }}>Bac</option>
                            <option value="bac+2" {{ old('niveau_scolaire') == 'bac+2' ? 'selected' : '' }}>Bac+2</option>
                            <option value="bac+3" {{ old('niveau_scolaire') == 'bac+3' ? 'selected' : '' }}>Bac+3</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none top-6">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>
                
                <!-- Documents Section -->
                <div class="mb-10">
                    <div class="flex items-center mb-6">
                        <div class="w-8 h-8 rounded-full bg-brand/10 flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-medium">Documents Requis</h2>
                    </div>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 rounded-xl p-5 hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                            <div class="flex items-center mb-3">
                                <div class="w-8 h-8 rounded-full bg-brand/10 flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <label for="baccalaureat" class="block text-sm font-medium text-gray-700">Baccalauréat</label>
                            </div>
                            <div class="relative file-input-wrapper">
                                <input type="file" id="baccalaureat" name="baccalaureat" required
                                    class="absolute inset-0 opacity-0 w-full h-full cursor-pointer z-10" />
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-brand transition-colors">
                                    <svg class="mx-auto h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-600">Cliquez pour sélectionner un fichier</p>
                                    <p class="mt-1 text-xs text-gray-500">PDF, JPG, PNG (Max 5MB)</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 rounded-xl p-5 hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                            <div class="flex items-center mb-3">
                                <div class="w-8 h-8 rounded-full bg-brand/10 flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                    </svg>
                                </div>
                                <label for="cin_doc" class="block text-sm font-medium text-gray-700">CIN (document)</label>
                            </div>
                            <div class="relative file-input-wrapper">
                                <input type="file" id="cin_doc" name="cin_doc" required
                                    class="absolute inset-0 opacity-0 w-full h-full cursor-pointer z-10" />
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-brand transition-colors">
                                    <svg class="mx-auto h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-600">Cliquez pour sélectionner un fichier</p>
                                    <p class="mt-1 text-xs text-gray-500">PDF, JPG, PNG (Max 5MB)</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 rounded-xl p-5 hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                            <div class="flex items-center mb-3">
                                <div class="w-8 h-8 rounded-full bg-brand/10 flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <label for="acte_doc" class="block text-sm font-medium text-gray-700">Acte</label>
                            </div>
                            <div class="relative file-input-wrapper">
                                <input type="file" id="acte_doc" name="acte_doc" required
                                    class="absolute inset-0 opacity-0 w-full h-full cursor-pointer z-10" />
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-brand transition-colors">
                                    <svg class="mx-auto h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-600">Cliquez pour sélectionner un fichier</p>
                                    <p class="mt-1 text-xs text-gray-500">PDF, JPG, PNG (Max 5MB)</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 rounded-xl p-5 hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                            <div class="flex items-center mb-3">
                                <div class="w-8 h-8 rounded-full bg-brand/10 flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <label for="releve_notes" class="block text-sm font-medium text-gray-700">Relevé de notes</label>
                            </div>
                            <div class="relative file-input-wrapper">
                                <input type="file" id="releve_notes" name="releve_notes" required
                                    class="absolute inset-0 opacity-0 w-full h-full cursor-pointer z-10" />
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-brand transition-colors">
                                    <svg class="mx-auto h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-600">Cliquez pour sélectionner un fichier</p>
                                    <p class="mt-1 text-xs text-gray-500">PDF, JPG, PNG (Max 5MB)</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="md:col-span-2 bg-gray-50 rounded-xl p-5 hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                            <div class="flex items-center mb-3">
                                <div class="w-8 h-8 rounded-full bg-brand/10 flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <label for="photo" class="block text-sm font-medium text-gray-700">Photo d'identité</label>
                            </div>
                            <div class="relative file-input-wrapper">
                                <input type="file" id="photo" name="photo" required
                                    class="absolute inset-0 opacity-0 w-full h-full cursor-pointer z-10" />
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-brand transition-colors">
                                    <svg class="mx-auto h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-600">Cliquez pour sélectionner une photo</p>
                                    <p class="mt-1 text-xs text-gray-500">JPG, PNG (Max 2MB)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="bg-gradient-to-r from-brand to-brand-dark text-white font-medium py-3 px-8 rounded-xl shadow-soft transition-all duration-300 inline-flex items-center justify-center hover:shadow-lg hover:-translate-y-1 group">
                        Soumettre ma candidature
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Return link -->
        <div class="text-center animate-slideUp" style="animation-delay: 0.4s;">
            <a href="{{ url('/') }}" class="inline-flex items-center text-brand hover:text-brand-dark font-medium transition-colors group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Retour à l'accueil
            </a>
        </div>
    </div>
</div>

<script>
    // Display selected file name
    document.addEventListener('DOMContentLoaded', function() {
        const fileInputs = document.querySelectorAll('input[type="file"]');
        
        fileInputs.forEach(input => {
            input.addEventListener('change', function() {
                const fileName = this.files[0]?.name;
                if (fileName) {
                    const fileDisplay = this.nextElementSibling.querySelector('p.text-sm');
                    fileDisplay.textContent = fileName;
                }
            });
        });
    });
</script>
@endsection
