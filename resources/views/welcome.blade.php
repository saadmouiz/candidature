<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Association Al Amal - Soutien aux Études Supérieures</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.12.0/dist/cdn.min.js"></script>
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
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        .float { animation: float 6s ease-in-out infinite; }
        
        @keyframes slideIn {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        
        .process-card {
            opacity: 0;
            transform: translateY(20px);
        }
        
        .process-card.animate {
            animation: slideIn 0.8s ease-out forwards;
        }
        
        .process-card:nth-child(2) {
            animation-delay: 0.2s;
        }
        
        .process-card:nth-child(3) {
            animation-delay: 0.4s;
        }
        
        .clip-bottom-round {
            clip-path: polygon(0 0, 100% 0, 100% 85%, 95% 100%, 5% 100%, 0 85%);
        }

        .process-step {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease-out;
        }
        
        .process-step.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        .process-step:nth-child(2) {
            transition-delay: 0.2s;
        }
        
        .process-step:nth-child(3) {
            transition-delay: 0.4s;
        }

        .process-line {
            width: 0;
            transition: width 1s ease-out;
        }

        .process-line.visible {
            width: 100%;
        }

        [x-cloak] { display: none !important; }
        
        .process-step {
            transition: all 0.5s ease-out;
        }
        
        .process-step.hidden {
            opacity: 0;
            transform: translateY(20px);
        }
        
        .process-step.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        .timeline-line {
            transition: transform 1s ease-out;
            transform-origin: top;
        }
        
        .timeline-line.hidden {
            transform: scaleY(0);
        }
        
        .timeline-line.visible {
            transform: scaleY(1);
        }
        
        /* Glass effect */
        .glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        /* Smooth scrolling for the entire page */
        html {
            scroll-behavior: smooth;
        }
        
        /* Gradient text */
        .text-gradient {
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            background-image: linear-gradient(to right, #EF4444, #FB7185);
        }
    </style>
</head>
<body class="bg-white font-sans text-dark antialiased overflow-x-hidden" x-data="{ isOpen: false }">
    <!-- NAVBAR -->
    <header class="fixed w-full z-50 px-4 py-5">
        <nav class="max-w-7xl mx-auto bg-white border border-gray-100/50 backdrop-blur-md rounded-2xl shadow-soft px-6 py-4 transition-all duration-300">
            <div class="flex justify-between items-center">
                <a href="#" class="text-xl font-medium relative group">
                    <img src="{{ asset('assets/logo_ico.png') }}" alt="Logo Al Amal" class="w-40 h-50">
                </a>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#about" class="text-gray-600 hover:text-brand transition-colors duration-300 font-medium">À propos</a>
                    <a href="#process" class="text-gray-600 hover:text-brand transition-colors duration-300 font-medium">Processus</a>
                    <a href="#impact" class="text-gray-600 hover:text-brand transition-colors duration-300 font-medium">Impact</a>
                    <a href="{{ route('login') }}" class="bg-white hover:bg-red-500 hover:text-white text-dark px-5 py-2.5 rounded-xl shadow-soft border border-gray-100 transition-all duration-300 hover:shadow-md font-medium">
                        Se connecter
                    </a>
                </div>

                <!-- Mobile menu button -->
                <button @click="isOpen = !isOpen" class="md:hidden h-10 w-10 flex items-center justify-center rounded-full hover:bg-gray-100 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div x-show="isOpen" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-4"
                 class="md:hidden mt-6 space-y-3 bg-white rounded-xl p-4 shadow-soft">
                <a href="#about" class="block py-2 px-4 text-gray-600 hover:text-brand hover:bg-gray-50 rounded-lg transition-colors">À propos</a>
                <a href="#process" class="block py-2 px-4 text-gray-600 hover:text-brand hover:bg-gray-50 rounded-lg transition-colors">Processus</a>
                <a href="#impact" class="block py-2 px-4 text-gray-600 hover:text-brand hover:bg-gray-50 rounded-lg transition-colors">Impact</a>
                <a href="{{ route('login') }}" class="block py-2 px-4 text-gray-600 hover:text-brand hover:bg-gray-50 rounded-lg transition-colors">Se connecter</a>
            </div>
        </nav>
    </header>

    <!-- HERO SECTION -->
    <section class="relative h-screen overflow-hidden">
        <!-- Background Video with Gradient Overlay -->
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-r from-dark/70 to-black/50 z-10"></div>
            <video 
                class="w-full h-full object-cover"
                autoplay 
                loop 
                muted 
                playsinline
            >
                <source src="{{ asset('assets/bg_video.mp4') }}" type="video/mp4">
            </video>
        </div>

        <!-- Hero Content -->
        <div class="relative z-20 flex items-center justify-center h-full">
            <div class="container mx-auto px-6 text-center text-white">
                <span class="inline-block px-4 py-1.5 bg-white/10 backdrop-blur-sm glass rounded-full text-white text-sm font-medium mb-6 transform transition hover:scale-105 duration-300">Association Initiative Al Amal Pour l'Intégration Sociale</span>
                <h1 class="text-5xl md:text-7xl font-light leading-tight mb-8">
                    Façonnez votre <span class="font-semibold text-gradient">avenir</span> avec confiance
                </h1>
                <p class="text-white/90 text-xl mb-12 max-w-2xl mx-auto font-light">
                    Nous accompagnons les étudiants ambitieux dans leur parcours d'études supérieures à travers un soutien personnalisé et engagé.
                </p>
                <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                    <a href="{{ route('candidature.create') }}" class="w-full sm:w-auto bg-brand hover:bg-brand-dark text-white font-medium py-4 px-8 rounded-xl shadow-soft transition-all duration-300 inline-flex items-center justify-center hover:shadow-lg hover:-translate-y-1 group">
                        Déposer ma candidature
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                    <a href="#process" class="w-full sm:w-auto glass text-white font-medium py-4 px-8 rounded-xl transition-all duration-300 inline-block hover:bg-white/20 hover:-translate-y-1">
                        Découvrir le processus
                    </a>
                </div>
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-20 animate-bounce">
            <a href="#stats" class="flex flex-col items-center text-white/70 hover:text-white">
                <span class="text-sm mb-2">Défiler</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
            </a>
        </div>
    </section>

    <!-- STATS SECTION -->
    <section id="stats" class="py-24 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="max-w-6xl mx-auto bg-white rounded-3xl shadow-soft overflow-hidden">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center p-8 md:p-12">
                    <div class="float p-6 hover:bg-gray-50 rounded-xl transition-colors">
                        <div class="text-4xl font-bold text-gradient mb-2">500+</div>
                        <div class="text-gray-600 font-medium">Étudiants accompagnés</div>
                    </div>
                    <div class="float p-6 hover:bg-gray-50 rounded-xl transition-colors" style="animation-delay: 0.5s">
                        <div class="text-4xl font-bold text-gradient mb-2">95%</div>
                        <div class="text-gray-600 font-medium">Taux de réussite</div>
                </div>
                    <div class="float p-6 hover:bg-gray-50 rounded-xl transition-colors" style="animation-delay: 1s">
                        <div class="text-4xl font-bold text-gradient mb-2">20+</div>
                        <div class="text-gray-600 font-medium">Partenaires académiques</div>
                </div>
                    <div class="float p-6 hover:bg-gray-50 rounded-xl transition-colors" style="animation-delay: 1.5s">
                        <div class="text-4xl font-bold text-gradient mb-2">6+</div>
                        <div class="text-gray-600 font-medium">Années d'expérience</div>
                </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PROCESS SECTION -->
    <section id="process" class="py-24 bg-brand-light" x-data="{ 
        init() {
            this.isVisible = false;
            const observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting) {
                    this.isVisible = true;
                }
            }, { threshold: 0.3 });
            observer.observe(this.$el);
        },
        isVisible: false
    }">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl mx-auto mb-20 text-center">
                <span class="inline-block px-4 py-1.5 bg-brand/10 rounded-full text-brand text-sm font-medium mb-4">Notre processus</span>
                <h2 class="text-4xl font-light mt-2 mb-6">Comment ça <span class="font-semibold">fonctionne</span> ?</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Un parcours structuré pour vous accompagner de la candidature jusqu'à l'obtention de votre diplôme.</p>
            </div>

            <div class="max-w-5xl mx-auto">
                <div class="relative">
                    <!-- Timeline Line -->
                    <div class="absolute left-1/2 transform -translate-x-1/2 h-full">
                        <div class="h-full w-1 bg-gray-200 rounded-full relative">
                            <div class="absolute inset-0 bg-gradient-to-b from-brand to-brand-dark rounded-full timeline-line"
                                :class="{ 'visible': isVisible, 'hidden': !isVisible }">
                            </div>
                        </div>
                    </div>

                    <!-- Process Steps -->
                    <div class="space-y-24">
                        <!-- Step 1 -->
                        <div class="process-step"
                            :class="{ 'visible': isVisible, 'hidden': !isVisible }"
                            style="transition-delay: 0ms;">
                            <div class="flex flex-col md:flex-row items-center">
                                <div class="w-full md:w-1/2 md:pr-12 text-center md:text-right mb-8 md:mb-0">
                                    <span class="inline-block px-3 py-1 bg-brand/10 rounded-full text-brand text-xs font-medium mb-4">ÉTAPE 1</span>
                                    <h3 class="text-2xl font-medium mb-4">Candidature</h3>
                                    <p class="text-gray-600 mb-6">Soumettez votre dossier complet via notre plateforme en ligne sécurisée.</p>
                                    
                                    <a href="{{ route('candidature.create') }}" class="inline-flex items-center text-brand hover:text-brand-dark font-medium transition-colors group">
                                        Commencer maintenant
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </a>
                                </div>
                                <div class="absolute left-1/2 transform -translate-x-1/2 w-16 h-16 rounded-full border-4 border-white bg-brand shadow-lg flex items-center justify-center text-white font-bold">
                                    1
                                </div>
                                <div class="w-full md:w-1/2 md:pl-12">
                                    <div class="bg-white p-6 rounded-2xl shadow-soft hover:shadow-md transition-shadow">
                                        <ul class="space-y-4">
                                        <li class="flex items-center">
                                                <div class="w-10 h-10 rounded-full bg-brand/10 flex items-center justify-center mr-4">
                                                    <svg class="w-5 h-5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                                </div>
                                                <span class="text-gray-700">Formulaire d'inscription</span>
                                        </li>
                                        <li class="flex items-center">
                                                <div class="w-10 h-10 rounded-full bg-brand/10 flex items-center justify-center mr-4">
                                                    <svg class="w-5 h-5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                                </div>
                                                <span class="text-gray-700">Documents académiques</span>
                                        </li>
                                        <li class="flex items-center">
                                                <div class="w-10 h-10 rounded-full bg-brand/10 flex items-center justify-center mr-4">
                                                    <svg class="w-5 h-5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                                </div>
                                                <span class="text-gray-700">Lettre de motivation</span>
                                        </li>
                                    </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="process-step"
                            :class="{ 'visible': isVisible, 'hidden': !isVisible }"
                            style="transition-delay: 200ms;">
                            <div class="flex flex-col-reverse md:flex-row items-center">
                                <div class="w-full md:w-1/2 md:pr-12">
                                    <div class="bg-white p-6 rounded-2xl shadow-soft hover:shadow-md transition-shadow">
                                        <ul class="space-y-4">
                                            <li class="flex items-center">
                                                <div class="w-10 h-10 rounded-full bg-brand/10 flex items-center justify-center mr-4">
                                                    <svg class="w-5 h-5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                                </div>
                                                <span class="text-gray-700">Étude approfondie du dossier</span>
                                        </li>
                                            <li class="flex items-center">
                                                <div class="w-10 h-10 rounded-full bg-brand/10 flex items-center justify-center mr-4">
                                                    <svg class="w-5 h-5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                                </div>
                                                <span class="text-gray-700">Délai de réponse : 2 semaines</span>
                                        </li>
                                    </ul>
                                    </div>
                                </div>
                                <div class="absolute left-1/2 transform -translate-x-1/2 w-16 h-16 rounded-full border-4 border-white bg-brand shadow-lg flex items-center justify-center text-white font-bold">
                                    2
                                </div>
                                <div class="w-full md:w-1/2 md:pl-12 text-center md:text-left mb-8 md:mb-0">
                                    <span class="inline-block px-3 py-1 bg-brand/10 rounded-full text-brand text-xs font-medium mb-4">ÉTAPE 2</span>
                                    <h3 class="text-2xl font-medium mb-4">Évaluation</h3>
                                    <p class="text-gray-600">Analyse rigoureuse de votre candidature par notre comité d'experts.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="process-step"
                            :class="{ 'visible': isVisible, 'hidden': !isVisible }"
                            style="transition-delay: 400ms;">
                            <div class="flex flex-col md:flex-row items-center">
                                <div class="w-full md:w-1/2 md:pr-12 text-center md:text-right mb-8 md:mb-0">
                                    <span class="inline-block px-3 py-1 bg-brand/10 rounded-full text-brand text-xs font-medium mb-4">ÉTAPE 3</span>
                                    <h3 class="text-2xl font-medium mb-4">Accompagnement</h3>
                                    <p class="text-gray-600">Soutien personnalisé tout au long de votre parcours académique.</p>
                                </div>
                                <div class="absolute left-1/2 transform -translate-x-1/2 w-16 h-16 rounded-full border-4 border-white bg-brand shadow-lg flex items-center justify-center text-white font-bold">
                                    3
                                </div>
                                <div class="w-full md:w-1/2 md:pl-12">
                                    <div class="bg-white p-6 rounded-2xl shadow-soft hover:shadow-md transition-shadow">
                                        <ul class="space-y-4">
                                        <li class="flex items-center">
                                                <div class="w-10 h-10 rounded-full bg-brand/10 flex items-center justify-center mr-4">
                                                    <svg class="w-5 h-5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                                </div>
                                                <span class="text-gray-700">Suivi académique régulier</span>
                                        </li>
                                        <li class="flex items-center">
                                                <div class="w-10 h-10 rounded-full bg-brand/10 flex items-center justify-center mr-4">
                                                    <svg class="w-5 h-5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                                </div>
                                                <span class="text-gray-700">Mentorat personnalisé</span>
                                        </li>
                                        <li class="flex items-center">
                                                <div class="w-10 h-10 rounded-full bg-brand/10 flex items-center justify-center mr-4">
                                                    <svg class="w-5 h-5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                                </div>
                                                <span class="text-gray-700">Ressources pédagogiques</span>
                                        </li>
                                    </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- IMPACT SECTION -->
    <section id="impact" class="py-24 bg-white">
        <div class="container mx-auto px-6">
            <div class="max-w-6xl mx-auto">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div>
                        <span class="inline-block px-4 py-1.5 bg-brand/10 rounded-full text-brand text-sm font-medium mb-4">Notre impact</span>
                        <h2 class="text-4xl font-light mb-6">Changeons des <span class="text-gradient font-semibold">vies</span> par l'éducation</h2>
                        <p class="text-gray-600 mb-8 leading-relaxed">Nous croyons en l'égalité des chances dans l'éducation. Chaque année, nous aidons des centaines d'étudiants à réaliser leurs rêves académiques et à construire un avenir meilleur.</p>
                        
                        <div class="flex flex-wrap gap-8">
                            <div class="flex items-center">
                                <div class="mr-3 bg-brand/10 p-3 rounded-lg">
                                    <svg class="w-6 h-6 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-xl font-semibold">500+</div>
                                    <div class="text-gray-500 text-sm">Étudiants accompagnés</div>
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="mr-3 bg-brand/10 p-3 rounded-lg">
                                    <svg class="w-6 h-6 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                        </div>
                                <div>
                                    <div class="text-xl font-semibold">95%</div>
                                    <div class="text-gray-500 text-sm">Taux de réussite</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative">
                        <div class="absolute inset-0 transform rotate-3 rounded-3xl bg-gradient-to-r from-brand to-brand-dark opacity-30 blur-xl"></div>
                        <div class="absolute inset-0 bg-brand-light rounded-3xl transform rotate-6"></div>
                        <img src="{{asset('assets/impact_img.jpg')}}" alt="Étudiants" class="relative rounded-3xl shadow-lg w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA SECTION -->
    <section class="py-16">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto rounded-3xl overflow-hidden relative">
                <div class="bg-gradient-to-r from-brand-dark to-brand p-10 text-center relative">
                    <h2 class="text-3xl font-light text-white mb-6">Prêt à façonner votre <span class="font-semibold">avenir</span> ?</h2>
                    <a href="{{ route('candidature.create') }}" class="bg-white text-brand hover:bg-gray-100 font-medium py-3 px-6 rounded-xl shadow-soft transition-all duration-300 inline-flex items-center justify-center hover:shadow-lg group">
                        Déposer ma candidature
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-gray-50 pt-20 pb-10">
        <div class="container mx-auto px-6">
            <div class="max-w-6xl mx-auto">
            <div class="grid md:grid-cols-4 gap-12">
                <div class="col-span-2 md:col-span-1">
                        <a href="#" class="text-xl font-medium inline-flex items-center">
                           <img src="{{ asset('assets/logo_ico.png') }}" alt="Logo Al Amal" class="w-40 h-50">
                        </a>
                        <p class="text-gray-600 mt-4 mb-6">Ensemble vers un avenir meilleur à travers l'éducation et l'accompagnement personnalisé.</p>
                        <div class="flex space-x-4">
                            <a href="#" class="w-10 h-10 rounded-full bg-brand/10 flex items-center justify-center text-brand hover:bg-brand hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-full bg-brand/10 flex items-center justify-center text-brand hover:bg-brand hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-full bg-brand/10 flex items-center justify-center text-brand hover:bg-brand hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-full bg-brand/10 flex items-center justify-center text-brand hover:bg-brand hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                            </a>
                        </div>
                </div>
                
                <div>
                        <h4 class="font-semibold text-lg mb-5">Navigation</h4>
                        <ul class="space-y-3">
                            <li><a href="#about" class="text-gray-600 hover:text-brand transition-colors inline-flex items-center">
                                <svg class="w-3 h-3 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                À propos
                            </a></li>
                            <li><a href="#process" class="text-gray-600 hover:text-brand transition-colors inline-flex items-center">
                                <svg class="w-3 h-3 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                Processus
                            </a></li>
                            <li><a href="#impact" class="text-gray-600 hover:text-brand transition-colors inline-flex items-center">
                                <svg class="w-3 h-3 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                Notre Impact
                            </a></li>
                            <li><a href="{{ route('login') }}" class="text-gray-600 hover:text-brand transition-colors inline-flex items-center">
                                <svg class="w-3 h-3 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                Se connecter
                            </a></li>
                    </ul>
                </div>
                
                <div>
                        <h4 class="font-semibold text-lg mb-5">Contact</h4>
                        <ul class="space-y-3">
                            <li class="text-gray-600 flex items-start">
                                <svg class="w-5 h-5 mr-3 text-brand flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                contact@aiais.org
                            </li>
                            <li class="text-gray-600 flex items-start">
                                <svg class="w-5 h-5 mr-3 text-brand flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                +212 5 26 62 26 26
                            </li>
                            <li class="text-gray-600 flex items-start">
                                <svg class="w-5 h-5 mr-3 text-brand flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Boulevard Bir Anzarane, Casablanca, Maroc
                            </li>
                    </ul>
                </div>
                
                <div>
                        <h4 class="font-semibold text-lg mb-5">Newsletter</h4>
                        <p class="text-gray-600 mb-4">Recevez nos actualités et événements.</p>
                        @if (session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('newsletter.store') }}" method="POST" class="space-y-3">
                            @csrf
                            <div>
                                <input type="email" name="email" placeholder="Votre email" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-brand focus:border-brand transition-all outline-none" required>
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="w-full bg-brand hover:bg-brand-dark text-white font-medium py-3 px-4 rounded-xl transition-colors">
                                S'inscrire
                            </button>
                        </form>
                    </div>
                </div>
                
                <div class="border-t border-gray-200 mt-16 pt-8 flex flex-col md:flex-row justify-center items-center">
                    <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} Association Al Amal - Tous droits réservés</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Smooth scroll script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add intersection observer for animation elements
            const observerOptions = {
                threshold: 0.25
            };
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate');
                    }
                });
            }, observerOptions);
            
            document.querySelectorAll('.process-card').forEach(card => {
                observer.observe(card);
            });
        });
    </script>
</body>
</html>
