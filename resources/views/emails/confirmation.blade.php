<!-- resources/views/emails/candidature-confirmation.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Confirmation de candidature</title>
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
            <h1>Confirmation de candidature</h1>
        </div>
        <div class="content">
            <p>Bonjour {{ $candidature->prenom }} {{ $candidature->nom }},</p>
            
            <p>Nous avons bien reçu votre candidature et nous vous en remercions.</p>
            
            <p>Voici un récapitulatif de vos informations :</p>
            <ul>
                <li><strong>Nom :</strong> {{ $candidature->nom }}</li>
                <li><strong>Prénom :</strong> {{ $candidature->prenom }}</li>
                <li><strong>CIN :</strong> {{ $candidature->cin }}</li>
                <li><strong>Email :</strong> {{ $candidature->email }}</li>
                <li><strong>Téléphone :</strong> {{ $candidature->tel }}</li>
                <li><strong>Niveau scolaire :</strong> 
                    @switch($candidature->niveau_scolaire)
                        @case('bac')
                            Baccalauréat
                            @break
                        @case('bac+2')
                            Bac+2
                            @break
                        @case('bac+3')
                            Bac+3
                            @break
                        @default
                            {{ $candidature->niveau_scolaire }}
                    @endswitch
                </li>
            </ul>
            
            <p>Notre équipe va étudier votre candidature dans les plus brefs délais. Vous serez notifié(e) par email dès qu'une décision sera prise.</p>
            
            <p>Merci de votre intérêt pour notre programme.</p>
            
            <p>Cordialement,<br>
            L'équipe du programme</p>
        </div>
        <div class="footer">
            <p>Ceci est un email automatique, merci de ne pas y répondre.</p>
        </div>
    </div>
</body>
</html>