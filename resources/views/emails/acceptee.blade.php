<!-- resources/views/emails/candidature-acceptee.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Candidature acceptée</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #eee;
        }
        .header {
            background-color: #10B981;
            color: white;
            padding: 15px;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
        .button {
            display: inline-block;
            background-color: #10B981;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 0.8em;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Félicitations!</h1>
        </div>
        <div class="content">
            <p>Bonjour {{ $candidature->prenom }} {{ $candidature->nom }},</p>
            
            <p>Nous avons le plaisir de vous informer que votre candidature a été <strong>acceptée</strong>!</p>
            
            <p>Vous êtes maintenant officiellement bénéficiaire de notre programme. Nous vous félicitons pour cette réussite et nous sommes ravis de vous accueillir parmi nous.</p>
            
            <p>Prochaines étapes :</p>
            <ol>
                <li>Un membre de notre équipe vous contactera prochainement pour vous donner plus de détails sur la suite du processus.</li>
                <li>Une réunion d'information sera organisée dans les semaines à venir.</li>
            </ol>
            
            <p>Si vous avez des questions, n'hésitez pas à nous contacter par email ou par téléphone.</p>
            
           <!-- Dans resources/views/emails/candidature-acceptee.blade.php -->
<!-- Ajoutez ce code quelque part dans la section content -->

<p>Nous avons joint à cet email un contrat officialisant votre acceptation. Veuillez l'imprimer, le signer et nous le retourner dans les plus brefs délais.</p>

<p>Si vous ne parvenez pas à ouvrir la pièce jointe, vous pouvez également <a href="{{ URL::signedRoute('contrats.telecharger', ['candidature' => $candidature->id]) }}">télécharger le contrat ici</a>.</p>
            
            <p>Cordialement,<br>
            L'équipe du programme</p>
        </div>
        <div class="footer">
            <p>Ceci est un email automatique, merci de ne pas y répondre.</p>
        </div>
    </div>
</body>
</html>