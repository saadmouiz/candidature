<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rendez-vous de suivi</title>
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
        .appointment-details {
            background-color: #fee2e2;
            border-left: 4px solid #ef4444;
            border-radius: 4px;
            padding: 20px;
            margin: 20px 0;
        }
        .appointment-details p {
            margin: 8px 0;
        }
        .appointment-details .label {
            font-weight: 600;
            color: #111827;
        }
        .note {
            background-color: #f9fafb;
            padding: 15px;
            border-radius: 4px;
            margin-top: 20px;
        }
        .documents {
            background-color: #e0f2fe;
            border-left: 4px solid #0ea5e9;
            border-radius: 4px;
            padding: 15px;
            margin-top: 20px;
        }
        .documents ul {
            margin-top: 10px;
            padding-left: 20px;
        }
        .documents li {
            margin-bottom: 8px;
        }
        .warning {
            background-color: #fef3c7;
            border-left: 4px solid #f59e0b;
            border-radius: 4px;
            padding: 15px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2 style="margin-top: 0; margin-bottom: 10px;">PROGRAMME DE BÉNÉFICIAIRES</h2>
            <h1>Rendez-vous de suivi</h1>
        </div>
        <div class="content">
            <div class="title">Votre rendez-vous a été programmé</div>
            
            <p>Bonjour {{ $beneficiaire->prenom }} {{ $beneficiaire->nom }},</p>
            
            <p>Nous avons le plaisir de vous informer que votre rendez-vous de suivi a été programmé.</p>
            
            <div class="appointment-details">
                <p><span class="label">Date :</span> {{ \Carbon\Carbon::parse($beneficiaire->appointment_date)->format('d/m/Y') }}</p>
                <p><span class="label">Heure :</span> {{ \Carbon\Carbon::parse($beneficiaire->appointment_date)->format('H:i') }}</p>
                <p><span class="label">Lieu :</span> 1er étage, 45 Boulevard Bir Anzarane, Casablanca 20370</p>
                <p><span class="label">Contact :</span> Service des bénéficiaires (05266-22626)</p>
                
                <div style="margin-top: 20px;">
                    <p><span class="label">Lieu sur la carte :</span></p>
                  <p> https://maps.app.goo.gl/aA15fk8GffvgD2XT8</p> 
                </div>
            </div>
            
            <div class="documents">
                <p><strong>Documents à apporter impérativement :</strong></p>
                <ul>
                    <li>2 copies du diplôme de baccalauréat</li>
                    <li>2 copies des relevés de notes</li>
                    <li>2 copies d'acte de naissance</li>
                    <li>2 copies de la carte d'identité nationale (CIN)</li>
                    <li>3 photos d'identité récentes</li>
                    <li>Le contrat légalisé (reçu dans l'email précédent)</li>
                </ul>
                <p><strong>Attention :</strong> L'absence d'un de ces documents pourrait retarder le traitement de votre dossier.</p>
            </div>
            
            @if(isset($pdfGenerationFailed) && $pdfGenerationFailed)
                <div class="warning">
                    <p><strong>Note :</strong> Nous n'avons pas pu générer le document PDF détaillé pour votre rendez-vous en raison d'un problème technique.</p>
                    <p>Veuillez noter les informations ci-dessus et apporter tous les documents mentionnés lors de votre rendez-vous.</p>
                    <p>Pour toute question, n'hésitez pas à nous contacter.</p>
                </div>
            @else
                <p>Veuillez trouver ci-joint le document détaillant votre rendez-vous. Ce document contient des informations supplémentaires concernant votre rendez-vous.</p>
                
                <p>Si vous ne parvenez pas à ouvrir la pièce jointe, vous pouvez également <a href="{{ URL::signedRoute('appointments.download', ['beneficiaire' => $beneficiaire->id]) }}" style="color: #ef4444; font-weight: 500;">télécharger le document ici</a>.</p>
            @endif
            
            
            
            <p>Nous nous réjouissons de vous rencontrer bientôt.</p>
            
            <p>Cordialement,<br>
            L'équipe du programme</p>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} Programme de Bénéficiaires | Ceci est un email automatique, merci de ne pas y répondre.</p>
        </div>
    </div>
</body>
</html>