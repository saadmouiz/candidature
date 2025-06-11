@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.tailwindcss.com"></script>
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
                    'glass': '0 8px 32px 0 rgba(31, 38, 135, 0.37)',
                }
            }
        }
    }
</script>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    
    body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .glass {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    @keyframes bounce {
        0%, 20%, 53%, 80%, 100% {
            transform: translate3d(0,0,0);
        }
        40%, 43% {
            transform: translate3d(0, -30px, 0);
        }
        70% {
            transform: translate3d(0, -15px, 0);
        }
        90% {
            transform: translate3d(0, -4px, 0);
        }
    }

    .bounce {
        animation: bounce 1s ease;
    }

    @keyframes slideUp {
        0% {
            opacity: 0;
            transform: translateY(30px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .slide-up {
        animation: slideUp 0.6s ease-out forwards;
    }

    .success-gradient {
        background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
    }

    .error-gradient {
        background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
    }

    .btn-glass {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
    }

    .btn-glass:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }
</style>
@endsection

@section('content')
<div class="w-full max-w-md mx-auto p-6">
    <div class="glass rounded-3xl p-8 text-center shadow-glass slide-up">
        <!-- Result Icon -->
        <div class="mb-6">
            @if($success)
                <div class="w-24 h-24 mx-auto success-gradient rounded-full flex items-center justify-center bounce shadow-glass">
                    <i class="fas fa-check text-4xl text-white"></i>
                </div>
            @else
                <div class="w-24 h-24 mx-auto error-gradient rounded-full flex items-center justify-center bounce shadow-glass">
                    <i class="fas fa-times text-4xl text-white"></i>
                </div>
            @endif
        </div>

        <!-- Title -->
        <h1 class="text-3xl font-bold text-white mb-4">
            @if($success)
                Présence Confirmée
            @else
                Erreur
            @endif
        </h1>

        <!-- Message -->
        <p class="text-white/80 text-lg mb-6 leading-relaxed">
            {{ $message }}
        </p>

        <!-- Beneficiary Info -->
        @if($beneficiaire)
            <div class="glass rounded-2xl p-6 mb-6 text-left">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-white text-lg"></i>
                    </div>
                    <div>
                        <div class="text-white font-semibold text-lg">
                            {{ $beneficiaire->prenom }} {{ $beneficiaire->nom }}
                        </div>
                        <div class="text-white/70 text-sm">
                            ID: {{ $beneficiaire->id }} • CIN: {{ $beneficiaire->cin }}
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Timestamp -->
        <div class="glass rounded-xl p-4 mb-6">
            <div class="flex items-center justify-center gap-2 text-white/70 text-sm">
                <i class="fas fa-clock"></i>
                <span>{{ now()->format('d/m/Y à H:i:s') }}</span>
            </div>
        </div>

        <!-- Action Button -->
        <a href="{{ route('qr.scanner') }}" class="btn-glass px-8 py-3 rounded-xl font-medium text-white inline-flex items-center gap-2 hover:text-white no-underline">
            <i class="fas fa-qrcode"></i>
            <span>Scanner un autre QR code</span>
        </a>
    </div>
</div>
@endsection 