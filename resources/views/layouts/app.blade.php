<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Candidatures') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.12.0/dist/cdn.min.js"></script>
    @yield('styles')
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=nunito:400,500,600&display=swap" rel="stylesheet" />
    <style>
        /* Define common styles that can be used across the site */
        .text-gradient {
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            background-image: linear-gradient(to right, #EF4444, #FB7185);
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes slideUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slideUp {
            animation: slideUp 0.6s ease-out forwards;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div id="app">
        <!-- Default navbar hidden by default -->
        <nav class="bg-white shadow hidden">
            <div class="container mx-auto px-4">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ url('/') }}" class="text-xl font-bold text-gray-800">
                                <title>Association Al Amal</title>

                            </a>
                        </div>

                        <!-- Ajout des liens de navigation -->
                        <div class="hidden md:ml-6 md:flex md:space-x-4">
                            @auth
                                <a href="{{ route('beneficiaire.index') }}"
                                    class="inline-flex items-center px-3 py-2 text-gray-600 hover:text-blue-600 hover:border-b-2 hover:border-blue-500 transition duration-150 {{ request()->routeIs('beneficiaire.*') ? 'text-blue-600 border-b-2 border-blue-500' : '' }}">
                                    Bénéficiaires
                                </a>
                                <a href="{{ route('candidature.index') }}"
                                    class="inline-flex items-center px-3 py-2 text-gray-600 hover:text-blue-600 hover:border-b-2 hover:border-blue-500 transition duration-150 {{ request()->routeIs('candidature.*') ? 'text-blue-600 border-b-2 border-blue-500' : '' }}">
                                    Candidatures
                                </a>
                            @endauth
                        </div>
                    </div>

                    <div class="flex items-center">
                        @guest
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}"
                                    class="text-gray-600 hover:text-gray-900 px-3 py-2">{{ __('Login') }}</a>
                            @endif
                        @else
                            <!-- Menu mobile pour les liens de navigation -->
                            <div class="md:hidden mr-4">
                                <button id="mobile-menu-button" class="text-gray-600 hover:text-gray-900">
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6h16M4 12h16M4 18h16" />
                                    </svg>
                                </button>
                            </div>

                            <div class="relative">
                                <button id="user-menu" class="flex items-center text-gray-700 hover:text-gray-900">
                                    <span>{{ Auth::user()->name }}</span>
                                    <svg class="ml-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <div id="dropdown-menu"
                                    class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10">
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        {{ Auth::user()->name }}
                                    </a>

                                    <a href="{{ route('logout') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>

            <!-- Menu mobile -->
            <div id="mobile-menu" class="hidden md:hidden border-t border-gray-200">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    @auth
                        <a href="{{ route('beneficiaire.index') }}"
                            class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 {{ request()->routeIs('beneficiaire.*') ? 'bg-gray-100 text-gray-900' : '' }}">
                            Bénéficiaires
                        </a>
                        <a href="{{ route('candidature.index') }}"
                            class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 {{ request()->routeIs('candidature.*') ? 'bg-gray-100 text-gray-900' : '' }}">
                            Candidatures
                        </a>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Include the custom navbar component -->
        @include('partials.navbar')

        <main class="">
            @yield('content')
        </main>
    </div>

    <script>
        // Simple dropdown toggle for user menu
        document.addEventListener('DOMContentLoaded', function () {
            const userMenu = document.getElementById('user-menu');
            const dropdownMenu = document.getElementById('dropdown-menu');

            if (userMenu && dropdownMenu) {
                userMenu.addEventListener('click', function () {
                    dropdownMenu.classList.toggle('hidden');
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', function (event) {
                    if (!userMenu.contains(event.target) && !dropdownMenu.contains(event.target)) {
                        dropdownMenu.classList.add('hidden');
                    }
                });
            }

            // Mobile menu toggle
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function () {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });
    </script>
    @yield('scripts')

</body>

</html>