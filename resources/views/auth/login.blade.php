<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #fff;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            max-width: 150px;
            height: auto;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #4b5563;
            font-weight: 500;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            transition: border-color 0.3s ease;
            background-color: #f9fafb;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #3b82f6;
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        button {
            width: 100%;
            padding: 14px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2563eb;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-container">
            <img src="{{ asset('assets/logo_ico.png') }}" alt="Logo" class="logo">
        </div>
        <h2>Connexion</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit">Se connecter</button>
        </form>
    </div>
</body>
</html>
