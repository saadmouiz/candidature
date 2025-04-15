<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue - Candidature</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-100 via-white to-blue-100 font-sans">

    <!-- NAVBAR -->
    <nav class="bg-white shadow-md py-4">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <a href="#" class="text-xl font-bold text-blue-600">Association Al Amal</a>
            <div>
                <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition">
                    Login
                </a>
            </div>
        </div>
    </nav>

    <!-- CONTENU -->
    <div class="flex items-center justify-center min-h-screen -mt-16">
        <div class="bg-white rounded-xl shadow-xl p-10 w-full max-w-2xl">
            <h1 class="text-3xl font-semibold text-center text-blue-600 mb-6">Bienvenue sur notre plateforme</h1>
            
            <div class="flex justify-center space-x-6">
                <a href="{{ route('candidature.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition transform hover:scale-105">
                    Postuler
                </a>
                
            </div>

            <p class="text-center text-gray-500 mt-6">Merci de votre confiance ❤️</p>
        </div>
    </div>

</body>
</html>
