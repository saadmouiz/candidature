<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidature acceptée</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            line-height: 1.6;
            color: #1f2937;
            background-color: #f9fafb;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        .header {
            background-color: #ef4444;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 10px;
        }
        .content {
            padding: 30px;
            background-color: #ffffff;
        }
        .title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #ef4444;
        }
        .button {
            display: inline-block;
            background-color: #ef4444;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 500;
            margin-top: 20px;
        }
        .button:hover {
            background-color: #dc2626;
        }
        .footer {
            padding: 20px;
            text-align: center;
            font-size: 0.85em;
            color: #6b7280;
            background-color: #f3f4f6;
        }
        .note {
            margin-top: 20px;
            padding: 15px;
            background-color: #fee2e2;
            border-left: 4px solid #ef4444;
            border-radius: 4px;
        }
        .steps {
            background-color: #f9fafb;
            padding: 15px 20px;
            border-radius: 4px;
            margin: 20px 0;
        }
        .steps ol {
            margin: 0;
            padding-left: 20px;
        }
        .steps li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2 style="margin-top: 0; margin-bottom: 10px;">PROGRAMME DE BÉNÉFICIAIRES</h2>
            <h1>Félicitations!</h1>
        </div>
        <div class="content">
            <div class="title">Votre candidature a été acceptée</div>
            
            <p>Bonjour {{ $candidature->prenom }} {{ $candidature->nom }},</p>
            
            <p>Nous avons le plaisir de vous informer que votre candidature a été <strong>acceptée</strong>!</p>
            
            <p>Vous êtes maintenant officiellement bénéficiaire de notre programme. Nous vous félicitons pour cette réussite et nous sommes ravis de vous accueillir parmi nous.</p>
            
            <div class="steps">
                <p><strong>Prochaines étapes :</strong></p>
                <ol>
                    <li>Un membre de notre équipe va programmer un rendez-vous pour vous dans les prochains jours.</li>
                    <li>Vous recevrez un email séparé avec les détails de ce rendez-vous (date, heure et modalités).</li>
                    <li>Lors de ce rendez-vous, nous vous présenterons tous les détails du programme et répondrons à vos questions.</li>
                </ol>
            </div>
            
            <div class="note">
                <p>Nous avons joint à cet email un contrat officialisant votre acceptation. Veuillez l'imprimer, le signer et nous le retourner dans les plus brefs délais.</p>
                
                <p>Si vous ne parvenez pas à ouvrir la pièce jointe, vous pouvez également <a href="{{ URL::signedRoute('contrats.telecharger', ['candidature' => $candidature->id]) }}" style="color: #ef4444; font-weight: 500;">télécharger le contrat ici</a>.</p>
            </div>
            
            <p>En attendant de recevoir l'email concernant votre rendez-vous, si vous avez des questions urgentes, n'hésitez pas à nous contacter par email ou par téléphone.</p>
            
            <p>Cordialement,<br>
            L'équipe du programme</p>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} Programme de Bénéficiaires | Ceci est un email automatique, merci de ne pas y répondre.</p>
        </div>
    </div>
</body>
</html>