<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue à la Newsletter d'Al Amal</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.7;
            color: #1F2937;
            margin: 0;
            padding: 0;
            background-color: #F9FAFB;
        }
        .container {
            max-width: 600px;
            margin: 24px auto;
            padding: 0;
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        .header {
            background-color: #FEF2F2;
            text-align: center;
            padding: 32px 0;
        }
        .logo {
            width: 80px;
            height: auto;
        }
        .content {
            padding: 40px 32px;
        }
        .footer {
            background-color: #F9FAFB;
            text-align: center;
            padding: 32px;
            color: #6B7280;
            font-size: 14px;
        }
        h1 {
            color: #111827;
            font-weight: 700;
            font-size: 24px;
            margin-top: 0;
            margin-bottom: 24px;
            line-height: 1.3;
        }
        p {
            margin-bottom: 20px;
            color: #4B5563;
            font-size: 16px;
        }
        .highlight {
            color: #EF4444;
            font-weight: 600;
        }
        .btn {
            display: inline-block;
            background-color: #EF4444;
            color: #ffffff;
            padding: 14px 28px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            margin: 24px 0;
            transition: background-color 0.2s;
        }
        .btn:hover {
            background-color: #DC2626;
        }
        .social-links {
            margin-top: 24px;
            margin-bottom: 24px;
        }
        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #EF4444;
            text-decoration: none;
            font-weight: 500;
        }
        .social-links a:hover {
            text-decoration: underline;
        }
        ul {
            padding-left: 24px;
            margin-bottom: 24px;
        }
        li {
            color: #4B5563;
            margin-bottom: 8px;
            position: relative;
        }
        .gradient-text {
            background: linear-gradient(to right, #EF4444, #F87171);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            font-weight: 700;
        }
        .divider {
            height: 1px;
            background-color: #E5E7EB;
            margin: 32px 0;
        }
        .greeting {
            font-size: 17px;
            font-weight: 500;
            color: #374151;
        }
        @media only screen and (max-width: 480px) {
            .container {
                margin: 0;
                border-radius: 0;
            }
            .content {
                padding: 32px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- <div class="header">
            <img src="https://alamal-online.com/assets/logo_ico.png" alt="Logo Al Amal" class="logo">
        </div> -->
        
        <div class="content">
            <h1>Merci pour votre inscription à notre newsletter!</h1>
            
            <p class="greeting">Cher(ère) membre de la communauté Al Amal,</p>
            
            <p>Nous sommes ravis de vous accueillir dans notre newsletter! Votre adresse <span class="highlight">{{ $email }}</span> a été ajoutée avec succès à notre liste de diffusion.</p>
            
            <div class="divider"></div>
            
            <p>Chez <span class="highlight">Association Al Amal</span>, nous croyons fermement en l'égalité des chances dans l'éducation. Chaque année, nous accompagnons des centaines d'étudiants ambitieux dans leur parcours d'études supérieures.</p>
            
            <p>En tant qu'abonné(e) à notre newsletter, vous recevrez régulièrement :</p>
            
            <ul>
                <li>Des témoignages inspirants de nos bénéficiaires</li>
                <li>Des informations sur nos programmes d'accompagnement</li>
                <li>Des actualités sur nos événements et initiatives</li>
                <li>Des conseils pour les étudiants en quête de soutien</li>
            </ul>
            
            <p>Ensemble, nous pouvons façonner un <span class="gradient-text">avenir meilleur</span> grâce à l'éducation.</p>
            
            <center>
                <a href="{{ url('/') }}" class="btn">Visiter notre site</a>
            </center>
            
            <div class="divider"></div>
            
            <p>Si vous avez des questions ou besoin d'informations supplémentaires, n'hésitez pas à nous contacter à <a href="mailto:contact@aiais.org" style="color: #EF4444; text-decoration: none; font-weight: 500;">contact@aiais.org</a>.</p>
            
            <p>Cordialement,<br>L'équipe Al Amal</p>
        </div>
        
        <div class="footer">
            <div class="social-links">
                <a href="#">Facebook</a>
                <a href="#">Twitter</a>
                <a href="#">LinkedIn</a>
                <a href="#">Instagram</a>
            </div>
            <p>&copy; {{ date('Y') }} Association Al Amal - Tous droits réservés</p>
            <p>Boulevard Bir Anzarane, Casablanca, Maroc</p>
        </div>
    </div>
</body>
</html> 