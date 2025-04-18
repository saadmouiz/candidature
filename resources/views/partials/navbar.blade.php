<!-- Navbar Component -->
<nav x-data="{ open: false }" class="fixed top-4 left-0 right-0 z-50 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="rounded-xl bg-white/80 backdrop-blur-md shadow-lg">
        <div class="relative flex h-24 px-8 items-center justify-between">
            <!-- Logo and main navigation -->
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <a href="{{ url('/') }}" class="flex items-center">
                        <img src="{{ asset('/assets/logo_ico.png') }}" alt="Logo" class="h-10 w-auto">
                    </a>
                </div>
            </div>

            <!-- Navigation Links - Desktop -->
            <div class="hidden sm:flex sm:items-center sm:ml-6 sm:space-x-4">
                @guest
                    <a href="{{ url('/') }}" class="text-gray-700 hover:text-red-500 px-3 py-2 text-sm font-medium transition duration-150">
                        Accueil
                    </a>
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-red-500 px-3 py-2 text-sm font-medium transition duration-150">
                        Se connecter
                    </a>
                @else
                    <a href="{{ route('beneficiaire.index') }}" class="text-gray-700 hover:text-red-500 px-3 py-2 text-sm font-medium transition duration-150 {{ request()->routeIs('beneficiaire.*') ? 'text-red-500 font-semibold' : '' }}">
                        Bénéficiaires
                    </a>

                    
                    <!-- Candidatures Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center text-gray-700 hover:text-red-500 px-3 py-2 text-sm font-medium transition duration-150 {{ request()->routeIs('candidature.*') ? 'text-red-500 font-semibold' : '' }}">
                            <span>Candidatures</span>
                            <svg class="ml-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        
                        <div x-show="open" 
                             @click.away="open = false"
                             class="absolute left-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95">
                            
                            <a href="{{ route('candidature.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request()->routeIs('candidature.create') ? 'text-red-500 bg-gray-50' : '' }}">
                                Postuler
                            </a>
                            <a href="{{ route('candidature.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request()->routeIs('candidature.index') ? 'text-red-500 bg-gray-50' : '' }}">
                                Candidatures Dashboard
                            </a>
                            <a href="{{ route('candidature.refusees') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request()->routeIs('candidature.refusees') ? 'text-red-500 bg-gray-50' : '' }}">
                                Refuser
                            </a>
                        </div>
                    </div>
                    
                    <!-- User Dropdown -->
                    <div class="ml-3 relative" x-data="{ open: false }">
                        <div>
                            <button @click="open = !open" class="flex items-center text-sm font-medium text-gray-700 hover:text-red-500 focus:outline-none transition duration-150 ease-in-out">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="ml-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                        
                        <div x-show="open" 
                             @click.away="open = false"
                             class="absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95">
                            
                            <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Déconnexion
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endguest
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-red-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden">
        <div class="mt-2 pt-2 pb-3 bg-white/90 backdrop-blur-md rounded-xl shadow-lg">
            @guest
                <a href="{{ url('/') }}" class="block px-4 py-2 text-base font-medium text-gray-700 hover:text-red-500 hover:bg-gray-50">
                    Accueil
                </a>
                <a href="{{ route('login') }}" class="block px-4 py-2 text-base font-medium text-gray-700 hover:text-red-500 hover:bg-gray-50">
                    Se connecter
                </a>
            @else
                <a href="{{ route('beneficiaire.index') }}" class="block px-4 py-2 text-base font-medium text-gray-700 hover:text-red-500 hover:bg-gray-50 {{ request()->routeIs('beneficiaire.*') ? 'text-red-500 bg-gray-50' : '' }}">
                    Bénéficiaires
                </a>
                <!-- Candidatures Menu for Mobile -->
                <div x-data="{ candidatureOpen: false }" class="relative">
                    <button @click="candidatureOpen = !candidatureOpen" class="w-full flex items-center justify-between px-4 py-2 text-base font-medium text-gray-700 hover:text-red-500 hover:bg-gray-50 {{ request()->routeIs('candidature.*') ? 'text-red-500 bg-gray-50' : '' }}">
                        <span>Candidatures</span>
                        <svg class="ml-1 h-5 w-5 transition-transform" :class="{'rotate-180': candidatureOpen}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="candidatureOpen" class="pl-4 pb-1">
                        <a href="{{ route('candidature.create') }}" class="block px-4 py-2 text-base font-medium text-gray-700 hover:text-red-500 hover:bg-gray-50 {{ request()->routeIs('candidature.create') ? 'text-red-500 bg-gray-50' : '' }}">
                            Postuler
                        </a>
                        <a href="{{ route('candidature.index') }}" class="block px-4 py-2 text-base font-medium text-gray-700 hover:text-red-500 hover:bg-gray-50 {{ request()->routeIs('candidature.index') ? 'text-red-500 bg-gray-50' : '' }}">
                            Candidatures Dashboard
                        </a>
                        <a href="{{ route('candidature.refusees') }}" class="block px-4 py-2 text-base font-medium text-gray-700 hover:text-red-500 hover:bg-gray-50 {{ request()->routeIs('candidature.refusees') ? 'text-red-500 bg-gray-50' : '' }}">
                            Refuser
                        </a>
                    </div>
                </div>
                <div class="border-t border-gray-200 pt-4 pb-3">
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();"
                           class="block px-4 py-2 text-base font-medium text-gray-700 hover:text-red-500 hover:bg-gray-50">
                            Déconnexion
                        </a>
                        <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </div>
                </div>
            @endguest
        </div>
    </div>
</nav>

<!-- Spacer to compensate for fixed navbar -->
<div class="h-32 bg-[#F9FAFB]"></div>

<script>
    // Mobile menu toggle
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');
        
        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
                menuIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('hidden');
            });
        }
    });
</script> 